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
class bbcode_editor_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('vse/abbc3');
	}

	public function setUp()
	{
		parent::setUp();
		$this->login();
	}

	/**
	* Test posting page for presence of our BBCodes template data
	*
	* @access public
	*/
	public function test_posting_page()
	{
		$crawler = self::request('GET', 'posting.php?mode=post&f=2&sid=' . $this->sid);
		$this->assertGreaterThan(0, $crawler->filter('#abbc3_buttons')->count());
	}

	/**
	* Test PM posting page for presence of our BBCodes template data
	*
	* @access public
	*/
	public function test_pm_posting_page()
	{
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&sid=' . $this->sid);
		$this->assertGreaterThan(0, $crawler->filter('#abbc3_buttons')->count());
	}
}
