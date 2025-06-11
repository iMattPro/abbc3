<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\event;

use phpbb\event\dispatcher;

class custom_bbcode_modify_sql_test extends listener_base
{
	/**
	 * Data set for test_custom_bbcode_modify_sql
	 *
	 * @return array Test data
	 */
	public function custom_bbcode_modify_sql_data(): array
	{
		return [
			[
				[
					'SELECT'	=> '',
					'ORDER_BY'	=> '',
				],
				[
					'SELECT'	=> ', b.bbcode_group',
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				],
			],
			[
				[
					'SELECT'	=> 'b.bbcode_id, b.bbcode_tag, b.bbcode_helpline',
					'FROM'		=> [BBCODES_TABLE => 'b'],
					'WHERE'		=> 'b.display_on_posting = 1',
					'ORDER_BY'	=> 'b.bbcode_tag',
				],
				[
					'SELECT'	=> 'b.bbcode_id, b.bbcode_tag, b.bbcode_helpline, b.bbcode_group',
					'FROM'		=> [BBCODES_TABLE => 'b'],
					'WHERE'		=> 'b.display_on_posting = 1',
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				],
			],
		];
	}

	/**
	 * Test the custom_bbcode_modify_sql is updating the
	 * sql_ary event field with expected data.
	 *
	 * @dataProvider custom_bbcode_modify_sql_data
	 */
	public function test_custom_bbcode_modify_sql($sql_ary, $expected)
	{
		$this->set_listener();

		$dispatcher = new dispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes_modify_sql', [$this->listener, 'custom_bbcode_modify_sql']);

		$num_predefined_bbcodes = 22;
		$event_data = ['sql_ary', 'num_predefined_bbcodes'];
		$event_filtered_data = $dispatcher->trigger_event('core.display_custom_bbcodes_modify_sql', compact($event_data));
		extract($event_filtered_data);

		$this->assertEquals($expected, $sql_ary);
	}
}
