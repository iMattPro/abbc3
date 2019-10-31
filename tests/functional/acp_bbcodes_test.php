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
class acp_bbcodes_test extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return array('vse/abbc3');
	}

	public function setUp(): void
	{
		parent::setUp();
		$this->login();
		$this->admin_login();
	}

	/**
	* Test BBCodes page for presence of our BBCodes
	*/
	public function test_bbcodes_page()
	{
		$crawler = self::request('GET', 'adm/index.php?i=acp_bbcodes&mode=bbcodes&sid=' . $this->sid);
		$this->assertContains('BBvideo', $crawler->filter('#acp_bbcodes')->text());
	}

	/**
	* Test BBCodes edit page for presence of our Group permissions option
	*
	* @depends test_bbcodes_page
	*/
	public function test_edit_bbcodes_page()
	{
		$crawler = self::request('GET', 'adm/index.php?i=acp_bbcodes&mode=bbcodes&action=edit&bbcode=13&sid=' . $this->sid);
		$this->assertContains($this->lang('ACP_GROUPS_PERMISSIONS'), $crawler->filter('#acp_bbcodes')->text());
	}
}
