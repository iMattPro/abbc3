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

	/**
	 * Verify that guest search results conceal hidden text in short and full results.
	 */
	public function test_hidden_text_is_redacted_from_guest_search_results()
	{
		$this->login();
		$public = 'orchardneedle';
		$private = 'quartzshade';
		$message = $public . ' public text [hidden]' . $private . ' private marker[/hidden] ' . str_repeat('Visible filler text. ', 12);
		$this->create_topic(2, 'Hidden search result', $message);

		foreach ([80, 0] as $length)
		{
			$crawler = self::request('GET', "search.php?keywords=$private&sr=posts&ch=$length&sid=$this->sid");
			$result = $crawler->filter('.search.post .content');
			self::assertStringContainsString($private, $result->text());
			self::assertStringContainsString('private marker', $result->text());
		}
		$this->logout();

		foreach ([$public, $private] as $keyword)
		{
			foreach ([80, 0] as $length)
			{
				$crawler = self::request('GET', "search.php?keywords=$keyword&sr=posts&ch=$length");
				$result = $crawler->filter('.search.post .content');
				self::assertStringContainsString($public, $result->text());
				self::assertStringNotContainsString($private, $result->text());
				self::assertStringNotContainsString('private marker', $result->text());
				self::assertCount($length === 0 ? 1 : 0, $result->filter('.hc-box'));
				if ($length === 0)
				{
					self::assertStringContainsString('Log in or register to view this post.', $result->text());
				}
			}
		}
	}

	/**
	 * Verify that ACP group edits affect subsequent posts without a cache purge.
	 */
	public function test_bbvideo_group_changes_take_effect_without_purging_cache()
	{
		$this->login();
		$this->admin_login();
		$this->add_lang('posting');
		$this->add_lang('acp/posting');
		$db = $this->get_db();
		$result = $db->sql_query("SELECT bbcode_id FROM " . BBCODES_TABLE . " WHERE bbcode_tag = 'BBvideo'");
		$bbcode_id = (int) $db->sql_fetchfield('bbcode_id', false, $result);
		$db->sql_freeresult($result);
		$result = $db->sql_query("SELECT group_id FROM " . GROUPS_TABLE . " WHERE group_name = 'GUESTS'");
		$guest_group = (int) $db->sql_fetchfield('group_id', false, $result);
		$db->sql_freeresult($result);
		self::assertGreaterThan(0, $bbcode_id);
		self::assertGreaterThan(0, $guest_group);

		$message = '[bbvideo]https://youtu.be/sP4NMoJcFd4[/bbvideo]';
		$this->create_topic(2, 'Unrestricted BBVideo post', $message);
		$this->save_bbvideo_groups($bbcode_id, [(string) $guest_group]);
		$subject = 'Restricted BBVideo post';
		$this->create_topic(2, $subject, $message, [], $this->lang('UNAUTHORISED_BBCODE', '[bbvideo]'));
		$result = $db->sql_query("SELECT COUNT(*) AS total FROM " . POSTS_TABLE . " WHERE post_subject = '" . $db->sql_escape($subject) . "'");
		self::assertSame(0, (int) $db->sql_fetchfield('total', false, $result));
		$db->sql_freeresult($result);

		$this->save_bbvideo_groups($bbcode_id, []);
		$this->create_topic(2, 'BBVideo post after clearing group restriction', $message);
	}

	/**
	 * Save BBVideo group permissions through phpBB’s ACP form.
	 *
	 * @param int $bbcode_id BBVideo’s custom BBCode ID
	 * @param string[] $groups Selected group IDs
	 * @return void
	 */
	protected function save_bbvideo_groups($bbcode_id, array $groups)
	{
		$crawler = self::request('GET', 'adm/index.php?i=acp_bbcodes&mode=bbcodes&action=edit&bbcode=' . $bbcode_id . '&sid=' . $this->sid);
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$form['bbcode_group'] = $groups;
		$crawler = self::submit($form);
		$confirm = $crawler->selectButton($this->lang('YES'));
		if ($confirm->count())
		{
			$crawler = self::submit($confirm->form());
		}
		self::assertStringContainsString($this->lang('BBCODE_EDITED'), $crawler->filter('body')->text());
	}
}
