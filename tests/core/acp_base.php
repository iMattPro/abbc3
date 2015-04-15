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
	static protected function setup_extensions()
	{
		return array('vse/abbc3');
	}

	protected $db;
	protected $request;
	protected $user;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/bbcodes.xml');
	}

	public function setUp()
	{
		parent::setUp();

		$this->db = $this->new_dbal();
		$this->request = $this->getMock('\phpbb\request\request');
		$this->user = new \phpbb\user('\phpbb\datetime');
	}

	protected function get_acp_manager()
	{
		global $phpbb_root_path, $phpEx;

		return new \vse\abbc3\core\acp_manager($this->db, $this->request, $this->user, $phpbb_root_path, $phpEx);
	}
}
