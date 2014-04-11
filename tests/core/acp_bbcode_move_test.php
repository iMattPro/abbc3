<?php
/**
*
* @package Advanced BBCode Box 3.1 testing
* @copyright (c) 2014 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\tests\core;

class acp_bbcode_move_test extends acp_base
{
	public static function bbcode_move_data()
	{
		// bbcode_id or array of bbcode_ids
		// action move_up|move_down
		// result bbcode_order => bbcode_id
		return array(
			array(
				13,
				'move_up', // 1st item, moved up, no movement
				array(1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17)
			),
			array(
				13,
				'move_down', // 1st item, moved down one position
				array(1 => 14, 2 => 13, 3 => 15, 4 => 16, 5 => 17)
			),
			array(
				15,
				'move_up', // Third item, moved up one position
				array(1 => 13, 2 => 15, 3 => 14, 4 => 16, 5 => 17)
			),
			array(
				15,
				'move_down', // Third item, moved down one position
				array(1 => 13, 2 => 14, 3 => 16, 4 => 15, 5 => 17)
			),
			array(
				17,
				'move_up', // Last item, moved up one position
				array(1 => 13, 2 => 14, 3 => 15, 4 => 17, 5 => 16)
			),
			array(
				17,
				'move_down', // Last item, moved down, no movement
				array(1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17)
			),
			array(
				0,
				'move_up', // Non-existent bbcode, moved down, no movement
				array(1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17)
			),
			array(
				0,
				'move_down', // Non-existent bbcode, moved down, no movement
				array(1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17)
			),
// 			array(
// 				array(null, 17, 14, 15, 16, 13),
// 				'drag_drop', // Array of drag-n-dropped items in new order
// 				array(1 => 17, 2 => 14, 3 => 15, 4 => 16, 5 => 13)
// 			),
		);
	}

	/**
	* @dataProvider bbcode_move_data
	*/
	public function test_bbcode_move($item, $action, $expected)
	{
		if ($action == 'drag_drop')
		{
			$this->request->expects($this->any())
				->method('is_ajax')
				->will($this->returnValue(true)
			);
		}

		$this->request->expects($this->any())
			->method('variable')
			->with($this->anything())
			->will($this->returnValueMap(array(
				array('id', 0, false, \phpbb\request\request_interface::REQUEST, $item),
				array('hash', '', false, \phpbb\request\request_interface::REQUEST, generate_link_hash($action . $item))
			))
		);

		$acp_manager = $this->acp_manager();

		$acp_manager->move($action);

		// Get new order
		$sql = 'SELECT bbcode_id, bbcode_order
			FROM phpbb_bbcodes
			ORDER BY bbcode_order';
		$result = $this->db->sql_query($sql);
		$bbcode_order = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bbcode_order[$row['bbcode_order']] = $row['bbcode_id'];
		}
		$this->db->sql_freeresult($result);

		$this->assertEquals($expected, $bbcode_order);
	}
}
