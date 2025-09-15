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
use vse\abbc3\core\acp_manager;

class acp_bbcode_drag_drop_test extends acp_base
{
	public function bbcode_drag_drop_data(): array
	{
		return [
			[[0 => 0, 1 => 13, 2 => 14, 3 => 15, 4 => 16]],
			[[1 => 17, 20 => 16, 30 => 15, 40 => 14, 50 => 13]],
		];
	}

	/**
	 * @dataProvider bbcode_drag_drop_data
	 */
	public function test_bbcode_drag_drop($bbcodes)
	{
		// Return true for request->is_ajax()
		$this->request->expects($this->atMost(2))
			->method('is_ajax')
			->willReturn(true)
		;

		// Set data for request->variable()
		$this->request->expects($this->exactly(2))
			->method('variable')
			->with($this->anything())
			->willReturnMap([
				['tablename', '', false, request_interface::REQUEST, 'drag_drop'],
				['drag_drop', [0 => ''], false, request_interface::REQUEST, $bbcodes],
			])
		;

		// Expect JSON output but prevent exit()
		$this->expectOutputString('{"success":true}');

		// Get the testable acp_manager
		$acp_manager = $this->get_testable_acp_manager();

		// Call move_drag()
		$acp_manager->move_drag();
	}

	public function test_bbcode_drag_drop_fails()
	{
		// Return true for request->is_ajax()
		$this->request->expects($this->once())
			->method('is_ajax')
			->willReturn(false);

		// Check request->variable is not called
		$this->request->expects($this->never())
			->method('variable');

		// Get the acp_manager
		$acp_manager = $this->get_acp_manager();

		// Call move_drag()
		$acp_manager->move_drag();
	}

	protected function get_testable_acp_manager(): acp_manager
	{
		return new class($this->db, $this->group_helper, $this->lang, $this->request) extends acp_manager {
			protected function send_json_response(bool $content): void
			{
				if ($this->request->is_ajax())
				{
					echo json_encode(['success' => (bool) $content]);
				}
			}
		};
	}
}
