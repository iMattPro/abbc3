<?php
/**
*
* @package testing
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

class extension_system_database_base_test extends extension_database_test_case
{
	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/config.xml');
	}

	public function setUp()
	{
		parent::setUp();

		$this->db = $this->new_dbal();
	}

	/**
	* Very basic test we're running here
	*
	* Mostly just to check that our test case is running
	*/
	public function test_check()
	{
		$sql = "SELECT *
			FROM phpbb_config";
		$result = $this->db->sql_query($sql);
		$this->assertEquals(array(
			array(
				'config_name'	=> 'foo',
				'config_value'	=> 'bar',
				'is_dynamic'	=> '0',
			),
		), $this->db->sql_fetchrowset($result));
		$this->db->sql_freeresult($result);
	}
}
