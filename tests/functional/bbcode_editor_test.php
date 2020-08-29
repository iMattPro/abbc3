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

	public function setUp(): void
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
		self::assertGreaterThan(0, $crawler->filter('#abbc3_buttons')->count());
	}

	/**
	* Test PM posting page for presence of our BBCodes template data
	*/
	public function test_pm_posting_page()
	{
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&sid=' . $this->sid);
		self::assertGreaterThan(0, $crawler->filter('#abbc3_buttons')->count());
	}
}
