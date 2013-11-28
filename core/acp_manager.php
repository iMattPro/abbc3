<?php
/**
*
* @package Advanced BBCode Box 3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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

	/* @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\user */
	protected $user;
	
	/** @var string phpBB root path */
	protected $root_path;

	/** @var string phpBB file extension */
	protected $php_ext;

	/** @var string path to ajax script */
	public $ajax_page;

	/** @var string path to ajax success icon */
	public $ajax_icon;

	/**
	* ABBC3 acp manager constructor method
	* 
	* @param \phpbb\db\driver\driver $db
	* @param \phpbb\request\request $request
	* @param \phpbb\user $user
	* @param $root_path
	* @param $php_ext
	*/
	public function __construct(\phpbb\db\driver\driver $db, \phpbb\request\request $request, \phpbb\user $user, $root_path, $php_ext)
	{
		$this->db = $db;
		$this->request = $request;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;

		$this->ajax_page = $this->root_path . 'ext/vse/abbc3/acp/abbc3_ajax.' . $this->php_ext;
		$this->ajax_icon = $this->root_path . 'ext/vse/abbc3/images/accepted.png';
	}

	/**
	* Update the database BBCode order fields on move up/down
	*
	* Based on Custom BBCode Sorting Mod by RMcGirr83
	*
	* @param string $action The action move_up|move_down
	* @return void
	* @access public
	*/
	public function move($action)
	{
		$order = $this->request->variable('order', 0);
		$order_total = $order * 2 + (($action == 'move_up') ? -1 : 1);

		$sql = 'UPDATE ' . BBCODES_TABLE . '
			SET bbcode_order = ' . $order_total . ' - bbcode_order
			WHERE bbcode_order IN (' . $order . ', ' . (($action == 'move_up') ? $order - 1 : $order + 1) . ')';
		$this->db->sql_query($sql);
	}

	/**
	* Retrieve the maximum value from the bbcode_order field stored in the db
	*
	* Based on Custom BBCode Sorting Mod by RMcGirr83
	*
	* @return int The maximum order
	* @access public
	*/
	public function get_max_order()
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
	* @param int $bbcode_id Custom bbcode id
	* @return array Custom BBCode user group ids
	* @access public
	*/
	public function get_bbcode_group_data($bbcode_id)
	{
		$sql = 'SELECT bbcode_group
			FROM ' . BBCODES_TABLE . '
			WHERE bbcode_id = ' . $bbcode_id;
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
	public function abbc3_group_select_options($select_id = false)
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
			$group_options .= '<option value="' . $row['group_id'] . '"' . $selected . '>' . ucfirst(strtolower((($row['group_type'] == GROUP_SPECIAL) ? $this->user->lang['G_' . $row['group_name']] : $row['group_name']))) . '</option>';
		}
		$this->db->sql_freeresult($result);
		return $group_options;
	}

	/**
	* Resynchronize the Custom BBCodes order field
	*
	* Based on Custom BBCode Sorting Mod by RMcGirr83
	*
	* @return void
	* @access public
	*/
	public function resynchronize_bbcode_order()
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
