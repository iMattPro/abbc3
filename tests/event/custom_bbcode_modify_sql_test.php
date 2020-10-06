<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class custom_bbcode_modify_sql_test extends listener_base
{
	/**
	 * Data set for test_custom_bbcode_modify_sql
	 *
	 * @return array Test data
	 */
	public function custom_bbcode_modify_sql_data()
	{
		return [
			[
				[],
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

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes_modify_sql', [$this->listener, 'custom_bbcode_modify_sql']);

		$num_predefined_bbcodes = 22;
		$event_data = ['sql_ary', 'num_predefined_bbcodes'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.display_custom_bbcodes_modify_sql', $event);

		$sql_ary = $event->get_data_filtered($event_data);
		$sql_ary = $sql_ary['sql_ary'];

		self::assertEquals($expected, $sql_ary);
	}
}
