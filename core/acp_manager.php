<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\core;

/**
* ABBC3 acp manager class
*/
class acp_manager
{
	/** @var \phpbb\db\driver\driver */
	protected $db;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver $db
	* @param \phpbb\request\request $request
	* @param \phpbb\user $user
	* @return \vse\abbc3\core\acp_manager
	* @access public
	*/
	public function __construct(\phpbb\db\driver\driver $db, \phpbb\request\request $request, \phpbb\user $user)
	{
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
	}

	/**
	* Update BBCode order fields in the db on move up/down or drag_drop
	*
	* @param string $action The action move_up|move_down|drag_drop
	* @return null
	* @access public
	*/
	public function move($action)
	{
		if ($action == 'drag_drop')
		{
			if (!$this->request->is_ajax())
			{
				return;
			}

			// Get the bbcodes html table's name
			$tablename = $this->request->variable('tablename', '');

			// Fetch the posted list
			$bbcodes_list = $this->request->variable($tablename, array(0 => ''));

			// Run through the list
			foreach ($bbcodes_list as $order => $bbcode_id)
			{
				// First one is the header, skip it
				if ($order == 0)
				{
					continue;
				}

				// Update the db
				$sql = 'UPDATE ' . BBCODES_TABLE . '
					SET bbcode_order = ' . $order . '
					WHERE bbcode_id = ' . (int) $bbcode_id;
				$this->db->sql_query($sql);
			}

			// Resync bbcode_order
			$this->resynchronize_bbcode_order();

			// return an AJAX JSON response
			$json_response = new \phpbb\json_response;
			$json_response->send(array(
				'success' => true,
			));
		}
		else
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

			$order_total = $current_order * 2 + (($action == 'move_up') ? -1 : 1);

			// Update the db
			$sql = 'UPDATE ' . BBCODES_TABLE . '
				SET bbcode_order = ' . $order_total . ' - bbcode_order
				WHERE bbcode_order IN (' . $current_order . ', ' . (($action == 'move_up') ? $current_order - 1 : $current_order + 1) . ')';
			$this->db->sql_query($sql);

			// Resync bbcode_order
			$this->resynchronize_bbcode_order();

			// return a JSON response if this was an AJAX request
			if ($this->request->is_ajax())
			{
				$json_response = new \phpbb\json_response;
				$json_response->send(array(
					'success' => (bool) $this->db->sql_affectedrows(),
				));
			}
		}
	}

	/**
	* Retrieve the maximum value from the bbcode_order field stored in the db
	*
	* @return int The maximum order
	* @access public
	*/
	public function get_max_bbcode_order()
	{
		$sql = 'SELECT MAX(bbcode_order) AS max_bbcode_order
			FROM ' . BBCODES_TABLE;
		$result = $this->db->sql_query($sql);
		$max_order = (int) $this->db->sql_fetchfield('max_bbcode_order');
		$this->db->sql_freeresult($result);

		return $max_order;
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
	* Generate a select box containing user groups
	*
	* @param array $select_id The user groups to mark as selected
	* @return string HTML markup of user groups select box for the form
	* @access public
	*/
	public function bbcode_group_select_options($select_id = false)
	{
		// Exclude bots
		$sql = 'SELECT group_id
			FROM ' . GROUPS_TABLE . "
			WHERE group_name IN ('BOTS')";
		$result = $this->db->sql_query($sql);

		$exclude_ids = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$exclude_ids[] = $row['group_id'];
		}
		$this->db->sql_freeresult($result);

		$sql = 'SELECT group_id, group_name, group_type
			FROM ' . GROUPS_TABLE . '
			WHERE ' . $this->db->sql_in_set('group_id', array_map('intval', $exclude_ids), true) .'
			ORDER BY group_type DESC, group_name ASC';
		$result = $this->db->sql_query($sql);

		$group_options = '';
		while ($row = $this->db->sql_fetchrow($result))
		{
			$selected = (is_array($select_id)) ? ((in_array($row['group_id'], $select_id)) ? ' selected="selected"' : '') : (($row['group_id'] == $select_id) ? ' selected="selected"' : '');
			$group_options .= '<option value="' . $row['group_id'] . '"' . $selected . '>' . (($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang('G_' . $row['group_name']) : ucfirst(strtolower($row['group_name']))) . '</option>';
		}
		$this->db->sql_freeresult($result);

		return $group_options;
	}

	/**
	* Resynchronize the Custom BBCodes order field
	*
	* Based on Custom BBCode Sorting MOD by RMcGirr83
	*
	* @return null
	* @access protected
	*/
	protected function resynchronize_bbcode_order()
	{
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
					$sql = 'UPDATE ' . BBCODES_TABLE . "
						SET bbcode_order = $order
						WHERE bbcode_id = {$row['bbcode_id']}";
					$this->db->sql_query($sql);
				}
			}
			while ($row = $this->db->sql_fetchrow($result));
		}

		$this->db->sql_freeresult($result);
	}
}
