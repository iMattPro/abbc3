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

class acp_bbcodes_group_select_box_test extends acp_listener_base
{
	/**
	 * Data set for test_acp_bbcodes_group_select_box
	 *
	 * @return array Test data
	 */
	public function acp_bbcodes_group_select_box_data()
	{
		return array(
			array(
				0, 'add', array(), '$group_opts',
				array(),
				array(
					'S_GROUP_OPTIONS'	=> '$group_opts',
				),
			),
			array(
				0, 'add', array(), '$group_opts',
				array(
					'FOO'				=> 'BAR',
				),
				array(
					'FOO'				=> 'BAR',
					'S_GROUP_OPTIONS'	=> '$group_opts',
				),
			),
			array(
				1, 'edit', array(1), '$group_opts',
				array(),
				array(
					'S_GROUP_OPTIONS'	=> '$group_opts',
				),
			),
			array(
				2, 'edit', array(2), '$group_opts',
				array(
					'FOO'				=> 'BAR',
				),
				array(
					'FOO'				=> 'BAR',
					'S_GROUP_OPTIONS'	=> '$group_opts',
				),
			),
		);
	}

	/**
	 * Test the acp_bbcodes_group_select_box is adding
	 * S_GROUP_OPTIONS data to the template array
	 *
	 * @dataProvider acp_bbcodes_group_select_box_data
	 */
	public function test_acp_bbcodes_group_select_box($bbcode_id, $action, $bbcode_group, $group_opts, $tpl_ary, $expected)
	{
		$this->set_listener();

		$this->acp_manager->expects($action === 'edit' ? $this->once() : $this->never())
			->method('get_bbcode_group_data')
			->with($bbcode_id)
			->willReturn($bbcode_group);
		$this->acp_manager->expects($this->once())
			->method('bbcode_group_select_options')
			->with($bbcode_group)
			->willReturn($group_opts);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.acp_bbcodes_edit_add', array($this->listener, 'acp_bbcodes_group_select_box'));

		$event_data = array('action', 'bbcode_id', 'tpl_ary');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.acp_bbcodes_edit_add', $event);

		$event_data_returned = $event->get_data_filtered($event_data);
		$tpl_ary = $event_data_returned['tpl_ary'];

		$this->assertEquals($expected, $tpl_ary);
	}
}
