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

class acp_bbcode_group_form_test extends acp_base
{
	public function bbcode_group_data()
	{
		return [
			[[''], ''], // empty
			[[1], '1'], // 1 selection
			[[1, 2, 3], '1,2,3'], // multiple selections
		];
	}

	/**
	 * @dataProvider bbcode_group_data
	 */
	public function test_bbcode_group_form($group_data, $expected)
	{
		$this->request->expects(self::atMost(2))
			->method('variable')
			->willReturn($group_data);

		$acp_manager = $this->get_acp_manager();

		self::assertEquals($expected, $acp_manager->get_bbcode_group_form_data());
	}
}
