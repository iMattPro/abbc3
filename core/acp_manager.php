<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\core;

use phpbb\db\driver\driver_interface;
use phpbb\request\request;
use phpbb\user;

/**
 * ABBC3 ACP manager class
 */
class acp_manager
{
	/** @var driver_interface */
	protected $db;

	/** @var request */
	protected $request;

	/** @var user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param driver_interface $db
	 * @param request          $request
	 * @param user             $user
	 * @access public
	 */
	public function __construct(driver_interface $db, request $request, user $user)
	{
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
	}

	/**
	 * Update BBCode order fields in the db on move up/down
	 *
	 * @param string $action The action move_up|move_down
	 * @return null
	 * @access public
	 */
	public function move($action)
	{
		$bbcode_id = $this->request->variable('id', 0);

		if (!check_link_hash($this->request->variable('hash', ''), $action . $bbcode_id))
		{
			trigger_error($this->user->lang('FORM_INVALID'), E_USER_WARNING);
		}

		// Get current order
		$sql = 'SELECT bbcode_order
			FROM ' . BBCODES_TABLE . "
			WHERE bbcode_id = $bbcode_id";
		$result = $this->db->sql_query($sql);
		$current_order = (int) $this->db->sql_fetchfield('bbcode_order');
		$this->db->sql_freeresult($result);

		// First one can't be moved up
		if ($current_order <= 1 && $action == 'move_up')
		{
			return;
		}

		$order_total = $current_order * 2 + $this->increment($action);

		// Update the db
		$sql = 'UPDATE ' . BBCODES_TABLE . '
			SET bbcode_order = ' . $order_total . ' - bbcode_order
			WHERE ' . $this->db->sql_in_set('bbcode_order', array(
				$current_order,
				$current_order + $this->increment($action),
			));
		$this->db->sql_query($sql);
		$updated = $this->db->sql_affectedrows();

		// Resync bbcode_order
		$this->resynchronize_bbcode_order();

		// Send a JSON response if this was an AJAX request
		$this->send_json_response($updated);
	}

	/**
	 * Update BBCode order fields in the db on drag_drop
	 *
	 * @return null
	 * @access public
	 */
	public function drag_drop()
	{
		if (!$this->request->is_ajax())
		{
			return;
		}

		// Get the bbcodes html table's name
		$tablename = $this->request->variable('tablename', '');

		// Fetch the posted list
		$bbcodes_list = $this->request->variable($tablename, array(0 => ''));

		$this->db->sql_transaction('begin');

		// Run through the list
		foreach ($bbcodes_list as $order => $bbcode_id)
		{
			// First one is the header, skip it
			if ($order == 0)
			{
				continue;
			}

			$this->db->sql_query($this->update_bbcode_order($bbcode_id, $order));
		}

		$this->db->sql_transaction('commit');

		// Resync bbcode_order
		$this->resynchronize_bbcode_order();

		// Send an AJAX JSON response
		$this->send_json_response(true);
	}

	/**
	 * Retrieve the maximum value from the bbcode_order field stored in the db
	 *
	 * @return int The maximum order
	 * @access public
	 */
	public function get_max_bbcode_order()
	{
		return $this->get_max_column_value('bbcode_order');
	}

	/**
	 * Get the bbcode_group data from the posted form
	 *
	 * @return string The usergroup id numbers, comma delimited, or empty
	 * @access public
	 */
	public function get_bbcode_group_form_data()
	{
		$bbcode_group = $this->request->variable('bbcode_group', array(0));
		$bbcode_group = (!sizeof($bbcode_group)) ? $this->request->variable('bbcode_group', '') : implode(',', $bbcode_group);

		return $bbcode_group;
	}

	/**
	 * Get the bbcode_group data from the database
	 *
	 * @param int $bbcode_id Custom BBCode id
	 * @return array Custom BBCode user group ids
	 * @access public
	 */
	public function get_bbcode_group_data($bbcode_id)
	{
		$sql = 'SELECT bbcode_group
			FROM ' . BBCODES_TABLE . '
			WHERE bbcode_id = ' . (int) $bbcode_id;
		$result = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);

		return explode(',', $row['bbcode_group']);
	}

	/**
	 * Get the bbcode_group data from the database,
	 * for every BBCode that has groups assigned
	 *
	 * @return array Custom BBCode user group ids for each BBCode, by name
	 * @access public
	 */
	public function get_bbcode_groups_data()
	{
		$sql = 'SELECT bbcode_tag, bbcode_group
			FROM ' . BBCODES_TABLE . "
			WHERE bbcode_group > ''";
		$result = $this->db->sql_query($sql);
		$groups = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$groups[$row['bbcode_tag']] = $row['bbcode_group'];
		}
		$this->db->sql_freeresult($result);

		return $groups;
	}

	/**
	 * Generate a select box containing user groups
	 *
	 * @param mixed $select_id The user groups to mark as selected
	 * @return string HTML markup of user groups select box for the form
	 * @access public
	 */
	public function bbcode_group_select_options($select_id = false)
	{
		// Get all groups except bots
		$sql = 'SELECT group_id, group_name, group_type
			FROM ' . GROUPS_TABLE . "
			WHERE group_name <> 'BOTS'
			ORDER BY group_name ASC";
		$result = $this->db->sql_query($sql);

		$group_options = '';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected = (is_array($select_id)) ? ((in_array($row['group_id'], $select_id)) ? ' selected="selected"' : '') : (($row['group_id'] == $select_id) ? ' selected="selected"' : '');
			$group_options .= '<option value="' . $row['group_id'] . '"' . $selected . '>' . (($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang('G_' . $row['group_name']) : $row['group_name']) . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $group_options;
	}

	/**
	 * Resynchronize the Custom BBCodes order field
	 * (Based on Custom BBCode Sorting MOD by RMcGirr83)
	 *
	 * @return null
	 * @access public
	 */
	public function resynchronize_bbcode_order()
	{
		$this->db->sql_transaction('begin');

		// By default, check that order is valid and fix it if necessary
		$sql = 'SELECT bbcode_id, bbcode_order
			FROM ' . BBCODES_TABLE . '
			ORDER BY bbcode_order, bbcode_id';
		$result = $this->db->sql_query($sql);

		if ($row = $this->db->sql_fetchrow($result))
		{
			$order = 0;
			do
			{
				// pre-increment $order
				++$order;

				if ($row['bbcode_order'] != $order)
				{
					$this->db->sql_query($this->update_bbcode_order($row['bbcode_id'], $order));
				}
			}
			while ($row = $this->db->sql_fetchrow($result));
		}
		$this->db->sql_freeresult($result);

		$this->db->sql_transaction('commit');
	}

	/**
	 * Build SQL query to update a bbcode order value
	 *
	 * @param int $bbcode_id    ID of the bbcode
	 * @param int $bbcode_order Value of the bbcode order
	 * @return string The SQL query to run
	 * @access protected
	 */
	protected function update_bbcode_order($bbcode_id, $bbcode_order)
	{
		return 'UPDATE ' . BBCODES_TABLE . '
			SET bbcode_order = ' . (int) $bbcode_order . '
			WHERE bbcode_id = ' . (int) $bbcode_id;
	}

	/**
	 * Increment
	 *
	 * @param string $action The action move_up|move_down
	 * @return int Increment amount: Move up -1. Move down +1.
	 * @access protected
	 */
	protected function increment($action)
	{
		return ($action == 'move_up') ? -1 : 1;
	}

	/**
	 * Retrieve the maximum value in a column from the bbcodes table
	 *
	 * @param string $column Name of the column (bbcode_id|bbcode_order)
	 * @return int The maximum value in the column
	 * @access protected
	 */
	protected function get_max_column_value($column)
	{
		$sql = 'SELECT MAX(' . $this->db->sql_escape($column) . ') AS maximum
			FROM ' . BBCODES_TABLE;
		$result = $this->db->sql_query($sql);
		$maximum = $this->db->sql_fetchfield('maximum');
		$this->db->sql_freeresult($result);

		return (int) $maximum;
	}

	/**
	 * Send a JSON response
	 *
	 * @param bool $content The content of the JSON response (true|false)
	 * @return null
	 * @access protected
	 */
	protected function send_json_response($content)
	{
		if ($this->request->is_ajax())
		{
			$json_response = new \phpbb\json_response;
			$json_response->send(array(
				'success' => (bool) $content,
			));
		}
	}
}
