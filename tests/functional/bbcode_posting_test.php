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
		return array('vse/abbc3');
	}

	/**
	* Test creating a post with one of our BBCodes
	*/
	public function test_posting_custom_bbcode()
	{
		$this->login();

		// Test creating a post with our Highlight BBCode
		$post = $this->create_topic(2, 'Test Topic 1', '[highlight=yellow]This is a test topic posted by the testing framework.[/highlight]');

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		self::assertStringContainsString('background-color:yellow', $crawler->filter('div.content > span')->attr('style'));
		self::assertStringContainsString('This is a test topic posted by the testing framework.', $crawler->filter('html')->text());
	}
}
