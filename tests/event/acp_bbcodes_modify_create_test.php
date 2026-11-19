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
		return [
			['$bbcode_group', '', [], [], [], ['bbcode_group' => '$bbcode_group']],
			['$bbcode_group', 'create', [], [], [], ['bbcode_group' => '$bbcode_group']],
			['$bbcode_group', 'create', ['unchanged' => 1], ['bbcode_group' => ''], ['unchanged' => 1], ['bbcode_group' => '$bbcode_group']],
		];
	}

	/**
	 * Test the acp_bbcodes_modify_create is updating the
	 * hidden_fields and sql_ary events with expected data.
	 *
	 * @dataProvider acp_bbcodes_modify_create_data
	 */
	public function test_acp_bbcodes_modify_create($bbcode_group, $action, $sql_ary, $hidden_fields, $expected_sql_ary, $expected_hidden_fields)
	{
		$this->set_listener();

		$this->acp_manager->expects(self::once())
			->method('get_bbcode_group_form_data')
			->willReturn($bbcode_group);

		$dispatcher = new \phpbb\event\dispatcher();
		$dispatcher->addListener('core.acp_bbcodes_modify_create', [$this->listener, 'acp_bbcodes_modify_create']);

		$event_data = ['action', 'sql_ary', 'hidden_fields'];
		$event_data_returned = $dispatcher->trigger_event('core.acp_bbcodes_modify_create', compact($event_data));
		extract($event_data_returned, EXTR_OVERWRITE);

		self::assertEquals($expected_sql_ary, $sql_ary);
		self::assertEquals($expected_hidden_fields, $hidden_fields);
	}
}
