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
class bbcode_editor_test extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	protected function setUp(): void
	{
		parent::setUp();
		$this->login();
	}

	/**
	* Test posting page for presence of our BBCodes template data
	*/
	public function test_posting_page()
	{
		$crawler = self::request('GET', 'posting.php?mode=post&f=2&sid=' . $this->sid);
		$this->run_checks($crawler);
	}

	/**
	* Test PM posting page for presence of our BBCodes template data
	*/
	public function test_pm_posting_page()
	{
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&sid=' . $this->sid);
		$this->run_checks($crawler);
	}

	/**
	 * Test quick reply for presence of our BBCodes template data
	 */
	public function test_quick_reply()
	{
		$crawler = self::request('GET', 'viewtopic.php?f=2&p=1&sid=' . $this->sid);
		$this->run_checks($crawler);
	}

	/**
	 * Test ACP user signature for presence of our BBCodes template data
	 */
	public function test_acp_posting_page()
	{
		$this->admin_login();
		$crawler = self::request('GET', 'adm/index.php?i=users&u=2&mode=sig&sid=' . $this->sid);
		$this->run_checks($crawler);
	}

	/**
	 * Checks to run to assert ABBC3 is loaded
	 *
	 * @param $crawler
	 */
	protected function run_checks($crawler)
	{
		self::assertGreaterThan(0, $crawler->filter('#abbc3_buttons')->count());

		// test a couple of dynamic bbcodes set in the javascript
		self::assertStringContainsString('[dir=rtl]', $crawler->filter('body')->html());
		self::assertStringContainsString('[mod=admin]', $crawler->filter('body')->html());
	}
}
