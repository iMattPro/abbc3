<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

class acp_base extends \phpbb_database_test_case
{
	protected static function setup_extensions()
	{
		return array('vse/abbc3');
	}

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\group\helper */
	protected $group_helper;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\request\request|\PHPUnit_Framework_MockObject_MockObject */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/bbcodes.xml');
	}

	public function setUp()
	{
		global $phpbb_root_path, $phpEx;

		parent::setUp();

		$this->db = $this->new_dbal();
		$this->request = $this->getMockBuilder('\phpbb\request\request')
			->disableOriginalConstructor()
			->getMock();
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = new \phpbb\language\language($lang_loader);
		$this->user = new \phpbb\user($this->lang, '\phpbb\datetime');
		$this->group_helper = new \phpbb\group\helper($this->lang);
	}

	protected function get_acp_manager()
	{
		return new \vse\abbc3\core\acp_manager($this->db, $this->group_helper, $this->lang, $this->request);
	}
}
