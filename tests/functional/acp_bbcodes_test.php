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
class acp_bbcodes_test extends \extension_functional_test_case
{
	public function setUp()
	{
		parent::setUp();
		$this->login();
		$this->admin_login();
		$this->set_extension('vse', 'abbc3', 'Advanced BBCode Box');
		$this->enable_extension();
	}

	/**
	* Test BBCodes page for presence of our BBCodes
	*
	* @access public
	*/
	public function test_bbcodes_page()
	{
		$crawler = self::request('GET', 'adm/index.php?i=acp_bbcodes&mode=bbcodes&sid=' . $this->sid);
		$this->assertContains('BBvideo=', $crawler->filter('#acp_bbcodes')->text());
	}

	/**
	* Test BBCodes edit page for presence of our Group permissions option
	*
	* @access public
	*/
	public function test_edit_bbcodes_page()
	{
		$crawler = self::request('GET', 'adm/index.php?i=acp_bbcodes&mode=bbcodes&action=edit&bbcode=13&sid=' . $this->sid);
		$this->assertContains($this->lang('ACP_GROUPS_PERMISSIONS'), $crawler->filter('#acp_bbcodes')->text());
	}
}
