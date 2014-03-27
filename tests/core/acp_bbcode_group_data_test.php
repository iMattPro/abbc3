<?php
/**
*
* @package Advanced BBCode Box 3.1 testing
* @copyright (c) 2014 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\tests\core;

class acp_bbcode_group_data_test extends acp_base
{
	public static function bbcode_group_data()
	{
		return array(
			array(0, array('')),
			array(13, array('')),
			array(14, array('')),
			array(15, array(1)),
			array(16, array(2, 3)),
			array(17, array(4, 5, 6)),
		);
	}

	/**
	* @dataProvider bbcode_group_data
	*/
	public function test_get_bbcode_group_data($data, $expected)
	{
		$acp_manager = $this->acp_manager();

		$this->assertEquals($expected, $acp_manager->get_bbcode_group_data($data));
	}
}
