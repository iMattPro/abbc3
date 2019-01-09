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

class acp_bbcodes_modify_create_test extends acp_listener_base
{
	/**
	 * Data set for test_acp_bbcodes_modify_create
	 *
	 * @return array Test data
	 */
	public function acp_bbcodes_modify_create_data()
	{
		return array(
			array(
				0,
				'$bbcode_group',
				'',
				array(),
				array(),
				array(
					'bbcode_group'	=> '$bbcode_group',
				),
				array(
					'bbcode_group'	=> '$bbcode_group',
				),
			),
			array(
				0,
				'$bbcode_group',
				'create',
				array(),
				array(),
				array(
					'bbcode_order'	=> 1,
					'bbcode_group'	=> '$bbcode_group',
				),
				array(
					'bbcode_group'	=> '$bbcode_group',
				),
			),
			array(
				10,
				'$bbcode_group',
				'create',
				array(
					'bbcode_order'	=> 0,
				),
				array(
					'bbcode_group'	=> '',
				),
				array(
					'bbcode_order'	=> 11,
					'bbcode_group'	=> '$bbcode_group',
				),
				array(
					'bbcode_group'	=> '$bbcode_group',
				),
			),
		);
	}

	/**
	 * Test the acp_bbcodes_modify_create is updating the
	 * hidden_fields and sql_ary events with expected data.
	 *
	 * @dataProvider acp_bbcodes_modify_create_data
	 */
	public function test_acp_bbcodes_modify_create($max_order, $bbcode_group, $action, $sql_ary, $hidden_fields, $expected_sql_ary, $expected_hidden_fields)
	{
		$this->set_listener();

		$this->acp_manager->expects($action === 'create' ? $this->once() : $this->never())
			->method('get_max_bbcode_order')
			->willReturn($max_order);
		$this->acp_manager->expects($this->once())
			->method('get_bbcode_group_form_data')
			->willReturn($bbcode_group);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.acp_bbcodes_modify_create', array($this->listener, 'acp_bbcodes_modify_create'));

		$event_data = array('action', 'sql_ary', 'hidden_fields');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.acp_bbcodes_modify_create', $event);

		$event_data_returned = $event->get_data_filtered($event_data);
		$hidden_fields = $event_data_returned['hidden_fields'];
		$sql_ary = $event_data_returned['sql_ary'];

		$this->assertEquals($expected_sql_ary, $sql_ary);
		$this->assertEquals($expected_hidden_fields, $hidden_fields);
	}
}
