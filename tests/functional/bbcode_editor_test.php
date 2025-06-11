<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\functional;

use phpbb_functional_test_case;

/**
* @group functional
*/
class bbcode_editor_test extends phpbb_functional_test_case
{
	protected static function setup_extensions(): array
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
	 * Test quick reply for the presence of our BBCodes template data
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
		$this->add_lang('acp/users');
		$crawler = self::request('GET', 'adm/index.php?i=users&u=2&mode=sig&sid=' . $this->sid);
		$this->run_checks($crawler);
	}

	/**
	 * Checks to run to assert ABBC3 is loaded
	 *
	 * @param $crawler
	 */
	protected function run_checks($crawler): void
	{
		$this->assertGreaterThan(0, $crawler->filter('#abbc3_buttons')->count());

		// test a couple of dynamic bbcodes set in the JavaScript
		$this->assertStringContainsString('[dir=rtl]', $crawler->filter('body')->html());
		$this->assertStringContainsString('[mod=admin]', $crawler->filter('body')->html());
	}
}
