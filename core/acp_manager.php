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

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param driver_interface $db
	 * @param request          $request
	 * @param user             $user
	 * @param string           $phpbb_root_path
	 * @param string           $php_ext
	 * @access public
	 */
	public function __construct(driver_interface $db, request $request, user $user, $phpbb_root_path, $php_ext)
	{
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
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

			// Update the db
			$sql = 'UPDATE ' . BBCODES_TABLE . '
				SET bbcode_order = ' . $order . '
				WHERE bbcode_id = ' . (int) $bbcode_id;
			$this->db->sql_query($sql);
		}

		$this->db->sql_transaction('commit');

		// Resync bbcode_order
		$this->resynchronize_bbcode_order();

		// return an AJAX JSON response
		$json_response = new \phpbb\json_response;
		$json_response->send(array(
			'success' => true,
		));
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
					$sql = 'UPDATE ' . BBCODES_TABLE . "
						SET bbcode_order = $order
						WHERE bbcode_id = {$row['bbcode_id']}";
					$this->db->sql_query($sql);
				}
			}
			while ($row = $this->db->sql_fetchrow($result));
		}
		$this->db->sql_freeresult($result);

		$this->db->sql_transaction('commit');
	}

	/**
	 * Installs BBCodes, used by migrations to perform add/updates
	 *
	 * @param array $bbcode_data Array of BBCode data to install
	 * @return null
	 * @access public
	 */
	public function install_bbcodes($bbcode_data)
	{
		// Load the acp_bbcode class
		if (!class_exists('acp_bbcodes'))
		{
			include($this->phpbb_root_path . 'includes/acp/acp_bbcodes.' . $this->php_ext);
		}
		$bbcode_tool = new \acp_bbcodes();

		foreach ($bbcode_data as $bbcode_name => $bbcode_array)
		{
			// Build the BBCodes
			$data = $bbcode_tool->build_regexp($bbcode_array['bbcode_match'], $bbcode_array['bbcode_tpl']);

			$bbcode_array += array(
				'bbcode_tag'			=> $data['bbcode_tag'],
				'first_pass_match'		=> $data['first_pass_match'],
				'first_pass_replace'	=> $data['first_pass_replace'],
				'second_pass_match'		=> $data['second_pass_match'],
				'second_pass_replace'	=> $data['second_pass_replace']
			);

			$sql = 'SELECT bbcode_id
				FROM ' . BBCODES_TABLE . "
				WHERE LOWER(bbcode_tag) = '" . strtolower($bbcode_name) . "'
				OR LOWER(bbcode_tag) = '" . strtolower($bbcode_array['bbcode_tag']) . "'";
			$result = $this->db->sql_query($sql);
			$row_exists = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($row_exists)
			{
				// Update existing BBCode
				$bbcode_id = $row_exists['bbcode_id'];

				$sql = 'UPDATE ' . BBCODES_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $bbcode_array) . '
					WHERE bbcode_id = ' . $bbcode_id;
				$this->db->sql_query($sql);
			}
			else
			{
				// Create new BBCode
				$sql = 'SELECT MAX(bbcode_id) AS max_bbcode_id
					FROM ' . BBCODES_TABLE;
				$result = $this->db->sql_query($sql);
				$max_bbcode_id = $this->db->sql_fetchfield('max_bbcode_id');
				$this->db->sql_freeresult($result);

				if ($max_bbcode_id)
				{
					$bbcode_id = $max_bbcode_id + 1;

					// Make sure it is greater than the core BBCode ids...
					if ($bbcode_id <= NUM_CORE_BBCODES)
					{
						$bbcode_id = NUM_CORE_BBCODES + 1;
					}
				}
				else
				{
					$bbcode_id = NUM_CORE_BBCODES + 1;
				}

				if ($bbcode_id <= BBCODE_LIMIT)
				{
					$bbcode_array['bbcode_id'] = (int) $bbcode_id;
					// set display_on_posting to 1 by default, so if 0 is desired, set it in our data array
					$bbcode_array['display_on_posting'] = (int) !isset($bbcode_array['display_on_posting']);

					$this->db->sql_query('INSERT INTO ' . BBCODES_TABLE . ' ' . $this->db->sql_build_array('INSERT', $bbcode_array));
				}
			}
		}

		$this->resynchronize_bbcode_order();
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
}
