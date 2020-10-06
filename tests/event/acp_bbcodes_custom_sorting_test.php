<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class acp_bbcodes_custom_sorting_test extends acp_listener_base
{
	/**
	 * Data set for test_acp_bbcodes_custom_sorting
	 *
	 * @return array Test data
	 */
	public function acp_bbcodes_custom_sorting_data()
	{
		return [
			[
				[],
				[],
				'',
				[
					'UA_DRAG_DROP'	=> '&action=move_drag',
				],
				[
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				],
			],
			[
				[
					'FOO'		=> 'BAR',
				],
				[
					'SELECT'	=> 'FOO',
				],
				'&amp;u_action',
				[
					'FOO'			=> 'BAR',
					'UA_DRAG_DROP'	=> '&u_action&action=move_drag',
				],
				[
					'SELECT'	=> 'FOO',
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				],
			],
		];
	}

	/**
	 * Test the acp_bbcodes_custom_sorting is updating the
	 * template_data and sql_ary events with expected data.
	 *
	 * @dataProvider acp_bbcodes_custom_sorting_data
	 */
	public function test_acp_bbcodes_custom_sorting($template_data, $sql_ary, $u_action, $expected_template_data, $expected_sql_ary)
	{
		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.acp_bbcodes_display_form', [$this->listener, 'acp_bbcodes_custom_sorting']);

		$event_data = ['template_data', 'sql_ary', 'u_action'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.acp_bbcodes_display_form', $event);

		$event_data_returned = $event->get_data_filtered($event_data);
		$template_data = $event_data_returned['template_data'];
		$sql_ary = $event_data_returned['sql_ary'];

		self::assertEquals($expected_template_data, $template_data);
		self::assertEquals($expected_sql_ary, $sql_ary);
	}

	/**
	 * Data set for test_acp_bbcodes_custom_sorting_move
	 *
	 * @return array Test data
	 */
	public function acp_bbcodes_custom_sorting_move_data()
	{
		return [
			['move_up', 'move', true],
			['move_down', 'move', true],
			['move_drag', 'move_drag', true],
			['foobar', 'move', false],
			['foobar', 'move_drag', false],
			[null, 'move', false],
			[null, 'move_drag', false],
		];
	}

	/**
	 * Test the acp_bbcodes_custom_sorting is calling the expected
	 * move() or drag_drop() methods based on the $action event data.
	 *
	 * @dataProvider acp_bbcodes_custom_sorting_move_data
	 */
	public function test_acp_bbcodes_custom_sorting_move($action, $method, $call)
	{
		$this->set_listener();

		$this->acp_manager->expects(($call ? self::once() : self::never()))
			->method($method);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.acp_bbcodes_display_form', [$this->listener, 'acp_bbcodes_custom_sorting']);

		$event_data = ['action'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.acp_bbcodes_display_form', $event);
	}
}
