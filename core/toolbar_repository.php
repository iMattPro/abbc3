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

	public function __construct(driver_interface $db, $table_prefix)
	{
		$this->db = $db;
		$this->toolbar_table = $table_prefix . 'abbc3_toolbar';
		$this->groups_table = $table_prefix . 'abbc3_bbcode_groups';
	}

	public function get_layout()
	{
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

		return $layout;
	}

	public function save_layout(array $placements, array $icons, array $feature_states = [])
	{
		$layout = $this->get_layout();
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
					if (isset($icons[$key]) && preg_match('/^[a-z0-9_-]{1,64}$/i', $icons[$key]))
					{
						$sql_ary['icon'] = $icons[$key];
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

	public function sync_bbcode($bbcode_id, $tag, $display = true)
	{
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
				elseif ($display && $placement === 'hidden')
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

	protected function next_order($placement)
	{
		$sql = 'SELECT MAX(sort_order) AS max_order FROM ' . $this->toolbar_table . "
			WHERE placement = '" . $this->db->sql_escape($placement) . "'";
		$result = $this->db->sql_query($sql);
		$order = (int) $this->db->sql_fetchfield('max_order') + 1;
		$this->db->sql_freeresult($result);
		return $order;
	}

	protected function delete_button($key)
	{
		$this->db->sql_query('DELETE FROM ' . $this->toolbar_table . "
			WHERE button_key = '" . $this->db->sql_escape($key) . "'");
	}

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

	public function get_group_ids($bbcode_id)
	{
		$sql = 'SELECT group_id FROM ' . $this->groups_table . '
			WHERE bbcode_id = ' . (int) $bbcode_id;
		$result = $this->db->sql_query($sql);
		$groups = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$groups[] = (int) $row['group_id'];
		}
		$this->db->sql_freeresult($result);

		return $groups;
	}

	public function set_group_ids($bbcode_id, array $group_ids)
	{
		$this->db->sql_query('DELETE FROM ' . $this->groups_table . ' WHERE bbcode_id = ' . (int) $bbcode_id);
		foreach (array_unique(array_filter(array_map('intval', $group_ids))) as $group_id)
		{
			$row = ['bbcode_id' => (int) $bbcode_id, 'group_id' => $group_id];
			$this->db->sql_query('INSERT INTO ' . $this->groups_table . ' ' . $this->db->sql_build_array('INSERT', $row));
		}
	}

	public function remove_bbcode($bbcode_id)
	{
		$this->db->sql_query('DELETE FROM ' . $this->groups_table . ' WHERE bbcode_id = ' . (int) $bbcode_id);
		$this->db->sql_query('DELETE FROM ' . $this->toolbar_table . ' WHERE bbcode_id = ' . (int) $bbcode_id);
	}

	public function get_all_group_rules()
	{
		$sql = 'SELECT b.bbcode_tag, g.group_id
			FROM ' . BBCODES_TABLE . ' b
			JOIN ' . $this->groups_table . ' g ON g.bbcode_id = b.bbcode_id
			ORDER BY b.bbcode_id, g.group_id';
		$result = $this->db->sql_query($sql);
		$rules = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$rules[$row['bbcode_tag']][] = (int) $row['group_id'];
		}
		$this->db->sql_freeresult($result);

		return $rules;
	}
}
