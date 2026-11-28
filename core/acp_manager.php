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
use phpbb\group\helper;
use phpbb\language\language;
use phpbb\request\request;

/**
 * ABBC3 ACP manager class
 */
class acp_manager
{
	/** @var driver_interface */
	protected $db;

	/** @var helper */
	protected $group_helper;

	/** @var language */
	protected $language;

	/** @var request */
	protected $request;

	/** @var toolbar_repository */
	protected $toolbar_repository;

	/**
	 * Constructor
	 *
	 * @param driver_interface        $db
	 * @param helper                  $group_helper
	 * @param language                $language
	 * @param request                 $request
	 * @param toolbar_repository|null $toolbar_repository Toolbar and group assignment repository
	 * @access public
	 */
	public function __construct(driver_interface $db, helper $group_helper, language $language, request $request, toolbar_repository $toolbar_repository = null)
	{
		$this->db = $db;
		$this->group_helper = $group_helper;
		$this->language = $language;
		$this->request = $request;
		$this->toolbar_repository = $toolbar_repository;
	}

	/**
	 * Get the bbcode_group data from the posted form
	 *
	 * @return string The user-group id numbers, comma delimited, or empty
	 * @access public
	 */
	public function get_bbcode_group_form_data()
	{
		$bbcode_group = $this->request->variable('bbcode_group', [0]);
		return (!count($bbcode_group)) ? $this->request->variable('bbcode_group', '') : implode(',', $bbcode_group);
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
		return $this->toolbar_repository->get_group_ids($bbcode_id);
	}

	/**
	 * Save the selected user groups for a custom BBCode.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @return void
	 * @throws \Throwable If saving the group assignments fails
	 */
	public function save_bbcode_groups($bbcode_id)
	{
		$groups = $this->get_bbcode_group_form_data();
		$this->toolbar_repository->set_group_ids($bbcode_id, $groups === '' ? [] : explode(',', $groups));
	}

	/**
	 * Synchronize a saved custom BBCode with its toolbar entry.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @param string $tag Stored BBCode tag
	 * @param bool $display Whether to display the BBCode on the posting form
	 * @return void
	 * @throws \Throwable If synchronizing the toolbar entry fails
	 */
	public function register_bbcode($bbcode_id, $tag, $display)
	{
		$this->toolbar_repository->sync_bbcode($bbcode_id, $tag, $display);
	}

	/**
	 * Remove the deleted BBCode’s toolbar entry and group assignments.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @return void
	 */
	public function remove_toolbar_bbcode($bbcode_id)
	{
		$this->toolbar_repository->remove_bbcode($bbcode_id);
	}

	/**
	 * Get the groups displayed in the BBCode permissions checklist.
	 *
	 * @param array $select_id The user groups to mark as selected
	 * @return array Group IDs, display names, and selected states
	 * @access public
	 */
	public function bbcode_group_select_options(array $select_id = [])
	{
		// Exclude groups reserved for bots and AI crawlers.
		$sql = 'SELECT group_id, group_name
			FROM ' . GROUPS_TABLE . '
			WHERE ' . $this->db->sql_in_set('group_name', ['BOTS', 'AI_CRAWLERS'], true) . '
			ORDER BY group_name ASC';
		$result = $this->db->sql_query($sql);

		$group_options = [];
		$select_id = array_map('intval', $select_id);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$group_id = (int) $row['group_id'];
			$group_options[] = [
				'ID' => $group_id,
				'NAME' => html_entity_decode($this->group_helper->get_name($row['group_name']), ENT_QUOTES, 'UTF-8'),
				'S_SELECTED' => in_array($group_id, $select_id, true),
			];
		}
		$this->db->sql_freeresult($result);

		return $group_options;
	}

	/**
	 * Retain the legacy ordering hook for migrations that still call it.
	 *
	 * @return void
	 *
	 * @access public
	 */
	public function resynchronize_bbcode_order()
	{
		// Ordering is stored in ABBC3's toolbar table.
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
}
