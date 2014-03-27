<?php
/**
*
* @package Advanced BBCode Box 3.1 testing
* @copyright (c) 2014 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\tests\core;

class acp_base extends \extension_database_test_case
{
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
		$this->user = new \phpbb\user;
	}

	protected function acp_manager()
	{
		return new \vse\abbc3\core\acp_manager($this->db, $this->request, $this->user);
	}
}
