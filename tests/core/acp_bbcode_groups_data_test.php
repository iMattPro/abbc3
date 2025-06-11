<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\core;

class acp_bbcode_groups_data_test extends acp_base
{
	public function bbcode_groups_data(): array
	{
		return [
			[[
				'align=' 		=> '1',
				'float=' 		=> '2,3',
				'sup' 			=> '4,5,6',
			 ]],
		];
	}

	/**
	 * @dataProvider bbcode_groups_data
	 */
	public function test_get_bbcode_groups_data($expected)
	{
		$acp_manager = $this->get_acp_manager();

		$this->assertEquals($expected, $acp_manager->get_bbcode_groups_data());
	}
}
