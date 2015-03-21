<?php
/**
*
* Advanced BBCode Box 3.1
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
		return array(
			array( // in order
				array(13 => 1, 14 => 2, 15 => 3, 16 => 4, 17 => 5),
				array(13 => 1, 14 => 2, 15 => 3, 16 => 4, 17 => 5),
			),
			array( // out of order
				array(13 => 5, 14 => 4, 15 => 3, 16 => 2, 17 => 1),
				array(17 => 1, 16 => 2, 15 => 3, 14 => 4, 13 => 5),
			),
			array( // way out of order
				array(13 => 1, 14 => 20, 15 => 50, 16 => 40, 17 => 30),
				array(13 => 1, 14 => 2, 17 => 3, 16 => 4, 15 => 5),
			),
			array( // no order
				array(13 => 0, 14 => 0, 15 => 0, 16 => 0, 17 => 0),
				array(13 => 1, 14 => 2, 15 => 3, 16 => 4, 17 => 5),
			),
		);
	}

	/**
	* @dataProvider bbcode_drag_drop_data
	*/
	public function test_bbcode_drag_drop($bbcodes, $expected)
	{
		// Return true for request->is_ajax()
		$this->request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue(true));

		// Set data for request->variable()
		$this->request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap(array(
				array('tablename', '', false, \phpbb\request\request_interface::REQUEST, 'drag_drop'),
				array('drag_drop', array(0 => ''), false, \phpbb\request\request_interface::REQUEST, $bbcodes),
			))
		);

		// Handle trigger_error() output called from json_response
		$this->setExpectedTriggerError(E_WARNING);

		// Get the acp_manager
		$acp_manager = $this->get_acp_manager();

		// Call drag_drop() and assert it returns null
		$this->assertNull($acp_manager->drag_drop());

		// Get new bbcode order
		$sql = 'SELECT bbcode_id, bbcode_order
			FROM phpbb_bbcodes
			ORDER BY bbcode_order';
		$result = $this->db->sql_query($sql);
		$bbcode_order = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bbcode_order[$row['bbcode_id']] = $row['bbcode_order'];
		}
		$this->db->sql_freeresult($result);

		// Assert new order matches expected order
		$this->assertSame($expected, $bbcode_order);
	}
}
