<?php
/**
*
* @package Advanced BBCode Box 3.1 testing
* @copyright (c) 2014 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\tests\functional;

/**
* @group functional
*/
class bbcode_posting_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('vse/abbc3');
	}

	/**
	* Test createing a post with one of our BBCodes
	*
	* @access public
	*/
	public function test_posting_custom_bbcode()
	{
		$this->login();

		// Test creating a post with our Highlight BBCode
		$post = $this->create_topic(2, 'Test Topic 1', '[highlight=yellow]This is a test topic posted by the testing framework.[/highlight]');

		$crawler = self::request('GET', "viewtopic.php?t={$post['topic_id']}&sid={$this->sid}");
		$this->assertContains('background-color: yellow;', $crawler->filter('div.content > span')->attr('style'));
		$this->assertContains('This is a test topic posted by the testing framework.', $crawler->filter('html')->text());
	}
}
