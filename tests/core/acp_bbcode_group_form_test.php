<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

class acp_bbcode_group_form_test extends acp_base
{
	public static function bbcode_group_data()
	{
		return array(
			array(null, ''), // empty
			array(array(1), '1'), // 1 selection
			array(array(1, 2, 3), '1,2,3'), // multiple selections
		);
	}

	/**
	* @dataProvider bbcode_group_data
	*/
	public function test_bbcode_group_form($group_data, $expected)
	{
		$this->request->expects($this->any())
			->method('variable')
			->will($this->returnValue($group_data));

		$acp_manager = $this->acp_manager();

		$this->assertEquals($expected, $acp_manager->get_bbcode_group_form_data());
	}
}
