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

class acp_bbcode_resync_order_test extends acp_base
{
	public function bbcode_resync_order_data()
	{
		return array(
			array( // order is good, so no change
				array(13 => 1, 14 => 2, 15 => 3, 16 => 4, 17 => 5),
				array(13 => 1, 14 => 2, 15 => 3, 16 => 4, 17 => 5),
			),
			array( // order is out of sync, so resync
				array(13 => 1, 14 => 10, 15 => 4, 16 => 3, 17 => 5),
				array(13 => 1, 16 => 2, 15 => 3, 17 => 4, 14 => 5),
			),
			array( // order is all null, so resync
				array(13 => 0, 14 => 0, 15 => 0, 16 => 0, 17 => 0),
				array(13 => 1, 14 => 2, 15 => 3, 16 => 4, 17 => 5),
			),
		);
	}

	/**
	 * @dataProvider bbcode_resync_order_data
	 */
	public function test_bbcode_resync_order($set_order, $expected_order)
	{
		// Set up the initial order
		foreach ($set_order as $id => $order)
		{
			$sql = 'UPDATE phpbb_bbcodes
				SET bbcode_order = ' . (int) $order . '
				WHERE bbcode_id = ' . (int) $id;
			$this->db->sql_query($sql);
		}

		$acp_manager = $this->get_acp_manager();

		$acp_manager->resynchronize_bbcode_order();

		// Get new order
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

		$this->assertEquals($expected_order, $bbcode_order);
	}
}
