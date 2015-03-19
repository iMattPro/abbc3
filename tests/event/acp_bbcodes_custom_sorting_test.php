<?php
/**
*
* Advanced BBCode Box 3.1
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
		return array(
			array(
				array(),
				array(),
				'',
				array(
					'UA_DRAG_DROP'	=> '&action=drag_drop',
				),
				array(
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				),
			),
			array(
				array(
					'FOO'		=> 'BAR',
				),
				array(
					'SELECT'	=> 'FOO',
				),
				'&amp;u_action',
				array(
					'FOO'			=> 'BAR',
					'UA_DRAG_DROP'	=> '&u_action&action=drag_drop',
				),
				array(
					'SELECT'	=> 'FOO',
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				),
			),
		);
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
		$dispatcher->addListener('core.acp_bbcodes_display_form', array($this->listener, 'acp_bbcodes_custom_sorting'));

		$event_data = array('template_data', 'sql_ary', 'u_action');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.acp_bbcodes_display_form', $event);

		$event_data_returned = $event->get_data_filtered($event_data);
		$template_data = $event_data_returned['template_data'];
		$sql_ary = $event_data_returned['sql_ary'];

		$this->assertEquals($expected_template_data, $template_data);
		$this->assertEquals($expected_sql_ary, $sql_ary);
	}
}
