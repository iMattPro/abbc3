<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

class acp_bbcode_drag_drop_test extends acp_base
{
	public function bbcode_drag_drop_data()
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
		$this->request->expects(self::atMost(2))
			->method('is_ajax')
			->willReturn(true)
		;

		// Set data for request->variable()
		$this->request->expects(self::exactly(2))
			->method('variable')
			->with(self::anything())
			->willReturnMap([
				['tablename', '', false, \phpbb\request\request_interface::REQUEST, 'drag_drop'],
				['drag_drop', [0 => ''], false, \phpbb\request\request_interface::REQUEST, $bbcodes],
			])
		;

		// Handle trigger_error() output called from json_response
		$this->setExpectedTriggerError(E_WARNING);

		// Get the acp_manager
		$acp_manager = $this->get_acp_manager();

		// Call move_drag() and assert it returns null
		self::assertNull($acp_manager->move_drag());
	}

	public function test_bbcode_drag_drop_fails()
	{
		// Return true for request->is_ajax()
		$this->request->expects(self::once())
			->method('is_ajax')
			->willReturn(false);

		// Check request->variable is not called
		$this->request->expects(self::never())
			->method('variable');

		// Get the acp_manager
		$acp_manager = $this->get_acp_manager();

		// Call move_drag() and assert it returns null
		self::assertNull($acp_manager->move_drag());
	}
}
