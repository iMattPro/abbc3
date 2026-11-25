<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\functional;

/**
* @group functional
*/
class bbcode_posting_test extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	/**
	* Test creating a post with one of our BBCodes
	*/
	public function test_posting_custom_bbcode()
	{
		$this->login();

		// Test creating a post with our Highlight BBCode
		$post = $this->create_topic(2, 'Test Topic 1', '[highlight=yellow]This is a test topic posted by the testing framework.[/highlight]');

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid=$this->sid");
		self::assertStringContainsString('background-color:yellow', $crawler->filter('div.content > span')->attr('style'));
		self::assertStringContainsString('This is a test topic posted by the testing framework.', $crawler->filter('html')->text());
	}

	/**
	 * Test hidden bbcode
	 */
	public function test_hidden_bbcode()
	{
		$this->login();

		$post = $this->create_topic(2, 'Test Topic Hidden', '[hidden]This is hidden text posted by the testing framework.[/hidden]');

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid=$this->sid");
		self::assertStringContainsString('Hidden content (visible to members)', $crawler->filter('.content > .hc-box')->text());
		self::assertStringContainsString('This is hidden text posted by the testing framework.', $crawler->filter('.content > .hc-box')->text());

		$this->logout();

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}");
		self::assertStringContainsString('Log in or register to view this post.', $crawler->filter('.content > .hc-box')->text());
		self::assertStringNotContainsString('This is hidden text posted by the testing framework.', $crawler->filter('.content > .hc-box')->text());
	}

	public function test_restricted_bbvideo_rejects_post()
	{
		$this->login();
		$this->add_lang('posting');
		$db = $this->get_db();
		$result = $db->sql_query("SELECT bbcode_id FROM " . BBCODES_TABLE . " WHERE bbcode_tag = 'BBvideo'");
		$bbcode_id = (int) $db->sql_fetchfield('bbcode_id', false, $result);
		$db->sql_freeresult($result);
		$result = $db->sql_query("SELECT group_id FROM " . GROUPS_TABLE . " WHERE group_name = 'GUESTS'");
		$guest_group = (int) $db->sql_fetchfield('group_id', false, $result);
		$db->sql_freeresult($result);
		self::assertGreaterThan(0, $bbcode_id);
		self::assertGreaterThan(0, $guest_group);

		$repository = new \vse\abbc3\core\toolbar_repository($db, self::$config['table_prefix']);
		$repository->set_group_ids($bbcode_id, [$guest_group]);
		$this->purge_cache();

		$subject = 'Restricted BBVideo post';
		$this->create_topic(2, $subject, '[bbvideo]https://youtu.be/sP4NMoJcFd4[/bbvideo]', [], $this->lang('UNAUTHORISED_BBCODE', '[bbvideo]'));
		$result = $db->sql_query("SELECT COUNT(*) AS total FROM " . POSTS_TABLE . " WHERE post_subject = '" . $db->sql_escape($subject) . "'");
		self::assertSame(0, (int) $db->sql_fetchfield('total', false, $result));
		$db->sql_freeresult($result);
	}
}
