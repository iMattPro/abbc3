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

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

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
		parent::setUp();

		$this->db = $this->new_dbal();
		$this->request = $this->getMock('\phpbb\request\request');
		$this->user = new \phpbb\user('\phpbb\datetime');
	}

	protected function get_acp_manager()
	{
		return new \vse\abbc3\core\acp_manager($this->db, $this->request, $this->user);
	}
}
