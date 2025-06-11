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

use phpbb\request\request_interface;

class acp_bbcode_move_test extends acp_base
{
	public function bbcode_move_data(): array
	{
		// bbcode_id or array of bbcode_ids
		// action move_up|move_down
		// result bbcode_order => bbcode_id
		return [
			[
				13,
				'move_up', // 1st item, moved up, no movement
				[1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17]
			],
			[
				13,
				'move_down', // 1st item, moved down one position
				[1 => 14, 2 => 13, 3 => 15, 4 => 16, 5 => 17]
			],
			[
				15,
				'move_up', // Third item, moved up one position
				[1 => 13, 2 => 15, 3 => 14, 4 => 16, 5 => 17]
			],
			[
				15,
				'move_down', // Third item, moved down one position
				[1 => 13, 2 => 14, 3 => 16, 4 => 15, 5 => 17]
			],
			[
				17,
				'move_up', // Last item, moved up one position
				[1 => 13, 2 => 14, 3 => 15, 4 => 17, 5 => 16]
			],
			[
				17,
				'move_down', // Last item, moved down, no movement
				[1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17]
			],
			[
				0,
				'move_up', // Non-existent bbcode, moved down, no movement
				[1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17]
			],
			[
				0,
				'move_down', // Non-existent bbcode, moved down, no movement
				[1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17]
			],
		];
	}

	/**
	 * @dataProvider bbcode_move_data
	 */
	public function test_bbcode_move($item, $action, $expected)
	{
		$this->request->expects($this->exactly(2))
			->method('variable')
			->with($this->anything())
			->willReturnMap([
				['id', 0, false, request_interface::REQUEST, $item],
				['hash', '', false, request_interface::REQUEST, generate_link_hash($action . $item)]
			])
		;

		// Get the acp_manager
		$acp_manager = $this->get_acp_manager();

		// Call move()
		$acp_manager->move($action);

		// Get a new order
		$sql = 'SELECT bbcode_id, bbcode_order
			FROM phpbb_bbcodes
			ORDER BY bbcode_order';
		$result = $this->db->sql_query($sql);
		$bbcode_order = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bbcode_order[$row['bbcode_order']] = $row['bbcode_id'];
		}
		$this->db->sql_freeresult($result);

		$this->assertEquals($expected, $bbcode_order);
	}

	public function bbcode_move_triggers_error_data(): array
	{
		return [
			// invalid hash
			[13, 'move_down', 'foo_bar', false, E_USER_WARNING],
			// ajax request
			[13, 'move_down', 'move_down13', true, E_WARNING],
		];
	}

	/**
	 * @dataProvider bbcode_move_triggers_error_data
	 */
	public function test_bbcode_move_triggers_error($item, $action, $hash, $ajax, $errNo)
	{
		$this->request->expects($ajax? $this->once() : $this->never())
			->method('is_ajax')
			->willReturn($ajax)
		;

		$this->request->expects($this->exactly(2))
			->method('variable')
			->with($this->anything())
			->willReturnMap([
				['id', 0, false, request_interface::REQUEST, $item],
				['hash', '', false, request_interface::REQUEST, generate_link_hash($hash)]
			])
		;

		// Handle trigger_error() output
		$this->setExpectedTriggerError($errNo);

		// Get the acp_manager
		$acp_manager = $this->get_acp_manager();

		// Call move()
		$acp_manager->move($action);
	}
}
