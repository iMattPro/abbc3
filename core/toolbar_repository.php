<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\core;

use phpbb\db\driver\driver_interface;

class toolbar_repository
{
	/** @var driver_interface */
	protected $db;

	/** @var string */
	protected $toolbar_table;

	/** @var string */
	protected $groups_table;

	protected $layout;
	protected $group_ids;
	protected $group_rules;

	/**
	 * Initialize the toolbar repository for the board’s table prefix.
	 *
	 * @param driver_interface $db Database connection
	 * @param string $table_prefix Board table prefix
	 */
	public function __construct(driver_interface $db, $table_prefix)
	{
		$this->db = $db;
		$this->toolbar_table = $table_prefix . 'abbc3_toolbar';
		$this->groups_table = $table_prefix . 'abbc3_bbcode_groups';
	}

	/**
	 * Load the saved toolbar layout with custom BBCode names and help lines.
	 *
	 * @return array Layout rows keyed by button key
	 */
	public function get_layout()
	{
		if ($this->layout !== null)
		{
			return $this->layout;
		}

		$sql = 'SELECT t.*, b.bbcode_tag, b.bbcode_helpline
			FROM ' . $this->toolbar_table . ' t
			LEFT JOIN ' . BBCODES_TABLE . ' b ON b.bbcode_id = t.bbcode_id
			ORDER BY t.placement, t.sort_order, t.button_key';
		$result = $this->db->sql_query($sql);
		$layout = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$layout[$row['button_key']] = $row;
		}
		$this->db->sql_freeresult($result);

		return $this->layout = $layout;
	}

	/**
	 * Save placements and icons, then update the posting visibility of registered BBCodes.
	 *
	 * @param array $placements Ordered button keys grouped by placement
	 * @param array $icons Image icon names keyed by button key
	 * @param array $font_icons Font icon names keyed by button key
	 * @param array $feature_states Enabled flags keyed by BBCode tag
	 * @return void
	 * @throws \Throwable If writing the layout or posting flags fails
	 */
	public function save_layout(array $placements, array $icons, array $font_icons, array $feature_states = [])
	{
		$layout = $this->get_layout();
		$this->layout = null;
		$normalized = ['primary' => [], 'more' => [], 'hidden' => []];
		$seen = [];
		foreach (array_keys($normalized) as $placement)
		{
			foreach (($placements[$placement] ?? []) as $key)
			{
				if (isset($layout[$key]) && !isset($seen[$key]))
				{
					$normalized[$placement][] = $key;
					$seen[$key] = true;
				}
			}
		}
		foreach (array_keys($layout) as $key)
		{
			if (!isset($seen[$key]))
			{
				$normalized['hidden'][] = $key;
			}
		}

		$this->db->sql_transaction('begin');
		try
		{
			foreach (['primary', 'more', 'hidden'] as $placement)
			{
				foreach ($normalized[$placement] as $order => $key)
				{
					$sql_ary = [
						'placement' => $placement,
						'sort_order' => $order + 1,
					];
					if (array_key_exists($key, $icons) && preg_match('/^(?:[a-z0-9_-]{1,64})?$/i', $icons[$key]))
					{
						$sql_ary['icon'] = $icons[$key];
					}
					if (array_key_exists($key, $font_icons))
					{
						$font_icon = preg_replace('/^fa-/i', '', trim($font_icons[$key]));
						if (preg_match('/^(?:[a-z0-9-]{1,64})?$/i', $font_icon))
						{
							$sql_ary['font_icon'] = strtolower($font_icon);
						}
					}
					$sql = 'UPDATE ' . $this->toolbar_table . '
						SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . "
						WHERE button_key = '" . $this->db->sql_escape($key) . "'";
					$this->db->sql_query($sql);
					$layout[$key] = array_merge($layout[$key], $sql_ary);
				}
			}
			$this->apply_visibility($layout, $feature_states);
			$this->db->sql_transaction('commit');
		}
		catch (\Throwable $e)
		{
			$this->db->sql_transaction('rollback');
			throw $e;
		}
	}

	/**
	 * Update phpBB’s posting flags from the saved toolbar layout and feature settings.
	 *
	 * @param array $feature_states Enabled flags keyed by BBCode tag
	 * @return void
	 * @throws \Throwable If synchronizing the posting flags fails
	 */
	public function sync_visibility(array $feature_states = [])
	{
		$this->db->sql_transaction('begin');
		try
		{
			$this->apply_visibility($this->get_layout(), $feature_states);
			$this->db->sql_transaction('commit');
		}
		catch (\Throwable $e)
		{
			$this->db->sql_transaction('rollback');
			throw $e;
		}
	}

	/**
	 * Bring the saved toolbar layout into line with phpBB’s posting flags after re-enable.
	 *
	 * @param array $feature_states Enabled flags keyed by BBCode tag, used to preserve placement for disabled features
	 * @return void
	 * @throws \Throwable If reconciling a toolbar entry fails
	 */
	public function reconcile_visibility(array $feature_states)
	{
		$sql = "SELECT DISTINCT b.bbcode_id, b.bbcode_tag, b.display_on_posting
			FROM " . BBCODES_TABLE . ' b
			LEFT JOIN ' . $this->toolbar_table . " t ON t.bbcode_id = b.bbcode_id
			WHERE (b.display_on_posting = 1 AND (t.bbcode_id IS NULL OR t.placement = 'hidden'))
				OR (b.display_on_posting = 0 AND t.placement IN ('primary', 'more'))
			ORDER BY b.bbcode_id";
		$result = $this->db->sql_query($sql);
		$changes = $this->db->sql_fetchrowset($result);
		$this->db->sql_freeresult($result);

		if (!$changes)
		{
			return;
		}

		$occupied = array_column($this->get_layout(), 'bbcode_id', 'button_key');
		foreach ($changes as $row)
		{
			$tag = strtolower(rtrim($row['bbcode_tag'], '='));
			if (isset($feature_states[$tag]) && !$feature_states[$tag])
			{
				continue;
			}

			$key = 'bbcode:' . $tag;
			$id = (int) $row['bbcode_id'];
			if (isset($occupied[$key]) && (int) $occupied[$key] !== $id)
			{
				continue;
			}

			$this->sync_bbcode($id, $row['bbcode_tag'], (bool) $row['display_on_posting']);
			$occupied[$key] = $id;
		}
	}

	/**
	 * Register or update the toolbar entry for a custom BBCode.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @param string $tag Stored BBCode tag
	 * @param bool $display Whether to display the BBCode on the posting form
	 * @return void
	 * @throws \Throwable If synchronizing the toolbar entry fails
	 */
	public function sync_bbcode($bbcode_id, $tag, $display = true)
	{
		$this->layout = $this->group_ids = $this->group_rules = null;
		$bbcode_id = (int) $bbcode_id;
		$key = 'bbcode:' . strtolower(rtrim($tag, '='));
		$sql = 'SELECT * FROM ' . $this->toolbar_table . '
			WHERE bbcode_id = ' . $bbcode_id . '
			ORDER BY button_key';
		$result = $this->db->sql_query($sql);
		$rows = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$rows[$row['button_key']] = $row;
		}
		$this->db->sql_freeresult($result);
		if (count($rows) === 1 && isset($rows[$key]) && $rows[$key]['button_type'] === 'bbcode')
		{
			$hidden = $rows[$key]['placement'] === 'hidden';
			if (($display && !$hidden) || (!$display && $hidden))
			{
				return;
			}
		}

		$this->db->sql_transaction('begin');
		try
		{
			if ($rows)
			{
				$current_key = isset($rows[$key]) ? $key : key($rows);
				$current = $rows[$current_key];
				foreach (array_keys($rows) as $duplicate_key)
				{
					if ($duplicate_key !== $current_key)
					{
						$this->delete_button($duplicate_key);
					}
				}

				$placement = $current['placement'];
				$sort_order = (int) $current['sort_order'];
				if (!$display && $placement !== 'hidden')
				{
					$placement = 'hidden';
					$sort_order = $this->next_order($placement);
				}
				else if ($display && $placement === 'hidden')
				{
					$placement = 'more';
					$sort_order = $this->next_order($placement);
				}

				$sql_ary = [
					'button_key' => $key,
					'button_type' => 'bbcode',
					'bbcode_id' => $bbcode_id,
					'placement' => $placement,
					'sort_order' => $sort_order,
				];
				$sql = 'UPDATE ' . $this->toolbar_table . '
					SET ' . $this->db->sql_build_array('UPDATE', $sql_ary) . "
					WHERE button_key = '" . $this->db->sql_escape($current_key) . "'";
				$this->db->sql_query($sql);
			}
			else
			{
				$placement = $display ? 'more' : 'hidden';
				$row = [
					'button_key' => $key,
					'button_type' => 'bbcode',
					'bbcode_id' => $bbcode_id,
					'placement' => $placement,
					'sort_order' => $this->next_order($placement),
					'icon' => strtolower(rtrim($tag, '=')),
					'font_icon' => '',
				];
				$this->db->sql_query('INSERT INTO ' . $this->toolbar_table . ' ' . $this->db->sql_build_array('INSERT', $row));
			}

			$this->db->sql_transaction('commit');
		}
		catch (\Throwable $e)
		{
			$this->db->sql_transaction('rollback');
			throw $e;
		}
	}

	/**
	 * Get the next sort position within a toolbar placement.
	 *
	 * @param string $placement Toolbar placement
	 * @return int Sort position for an appended button
	 */
	protected function next_order($placement)
	{
		$sql = 'SELECT MAX(sort_order) AS max_order FROM ' . $this->toolbar_table . "
			WHERE placement = '" . $this->db->sql_escape($placement) . "'";
		$result = $this->db->sql_query($sql);
		$order = (int) $this->db->sql_fetchfield('max_order') + 1;
		$this->db->sql_freeresult($result);
		return $order;
	}

	/**
	 * Delete a toolbar entry by its key.
	 *
	 * @param string $key Toolbar button key
	 * @return void
	 */
	protected function delete_button($key)
	{
		$this->db->sql_query('DELETE FROM ' . $this->toolbar_table . "
			WHERE button_key = '" . $this->db->sql_escape($key) . "'");
	}

	/**
	 * Set phpBB’s posting flags for the registered custom BBCodes in the supplied layout.
	 *
	 * @param array $layout Toolbar layout rows
	 * @param array $feature_states Enabled flags keyed by BBCode tag
	 * @return void
	 */
	protected function apply_visibility(array $layout, array $feature_states)
	{
		$registered = [];
		$enabled = [];
		foreach ($layout as $row)
		{
			if ($row['button_type'] !== 'bbcode' || empty($row['bbcode_id']))
			{
				continue;
			}
			$bbcode_id = (int) $row['bbcode_id'];
			$registered[$bbcode_id] = $bbcode_id;
			$tag = strtolower(rtrim($row['bbcode_tag'] ?? '', '='));
			$feature_enabled = !array_key_exists($tag, $feature_states) || !empty($feature_states[$tag]);
			if ($feature_enabled && in_array($row['placement'], ['primary', 'more'], true))
			{
				$enabled[$bbcode_id] = $bbcode_id;
			}
		}

		if ($registered)
		{
			$this->db->sql_query('UPDATE ' . BBCODES_TABLE . '
				SET display_on_posting = 0
				WHERE ' . $this->db->sql_in_set('bbcode_id', array_values($registered)));
		}
		if ($enabled)
		{
			$this->db->sql_query('UPDATE ' . BBCODES_TABLE . '
				SET display_on_posting = 1
				WHERE ' . $this->db->sql_in_set('bbcode_id', array_values($enabled)));
		}
	}

	/**
	 * Get the user groups that may use a custom BBCode.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @return int[] Allowed group IDs, or an empty array for unrestricted use
	 */
	public function get_group_ids($bbcode_id)
	{
		$this->load_group_rules();
		return $this->group_ids[(int) $bbcode_id] ?? [];
	}

	/**
	 * Replace a custom BBCode’s group assignments in one transaction.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @param array $group_ids Selected group IDs, or an empty array for unrestricted use
	 * @return void
	 * @throws \Throwable If replacing the group assignments fails
	 */
	public function set_group_ids($bbcode_id, array $group_ids)
	{
		$this->group_ids = $this->group_rules = null;
		$this->db->sql_transaction('begin');
		try
		{
			$this->db->sql_query('DELETE FROM ' . $this->groups_table . ' WHERE bbcode_id = ' . (int) $bbcode_id);
			foreach (array_unique(array_filter(array_map('intval', $group_ids))) as $group_id)
			{
				$row = ['bbcode_id' => (int) $bbcode_id, 'group_id' => $group_id];
				$this->db->sql_query('INSERT INTO ' . $this->groups_table . ' ' . $this->db->sql_build_array('INSERT', $row));
			}
			$this->db->sql_transaction('commit');
		}
		catch (\Throwable $e)
		{
			$this->db->sql_transaction('rollback');
			throw $e;
		}
	}

	/**
	 * Delete a custom BBCode’s toolbar entries and group assignments.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @return void
	 */
	public function remove_bbcode($bbcode_id)
	{
		$this->layout = $this->group_ids = $this->group_rules = null;
		$this->db->sql_query('DELETE FROM ' . $this->groups_table . ' WHERE bbcode_id = ' . (int) $bbcode_id);
		$this->db->sql_query('DELETE FROM ' . $this->toolbar_table . ' WHERE bbcode_id = ' . (int) $bbcode_id);
	}

	/**
	 * Get the restrictions applied at parser setup.
	 *
	 * @return array Allowed group IDs keyed by stored BBCode tag
	 */
	public function get_all_group_rules()
	{
		$this->load_group_rules();
		return $this->group_rules;
	}

	/**
	 * Load group restrictions once per repository instance, indexed by BBCode ID and tag.
	 *
	 * @return void
	 */
	protected function load_group_rules()
	{
		if ($this->group_ids !== null)
		{
			return;
		}

		$sql = 'SELECT g.bbcode_id, g.group_id, b.bbcode_tag
			FROM ' . $this->groups_table . ' g
			LEFT JOIN ' . BBCODES_TABLE . ' b ON b.bbcode_id = g.bbcode_id
			ORDER BY g.bbcode_id, g.group_id';
		$result = $this->db->sql_query($sql);
		$ids = [];
		$rules = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$ids[(int) $row['bbcode_id']][] = (int) $row['group_id'];
			if ($row['bbcode_tag'] !== null)
			{
				$rules[$row['bbcode_tag']][] = (int) $row['group_id'];
			}
		}
		$this->db->sql_freeresult($result);
		$this->group_ids = $ids;
		$this->group_rules = $rules;
	}
}
