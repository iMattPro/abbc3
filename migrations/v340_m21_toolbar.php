<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\migrations;

use phpbb\db\migration\container_aware_migration;

class v340_m21_toolbar extends container_aware_migration
{
	// effectively_installed() guard intentionally omitted

	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v3310_m20_update_bbcodes',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_schema()
	{
		return [
			'add_tables' => [
				$this->table_prefix . 'abbc3_toolbar' => [
					'COLUMNS' => [
						'button_key' => ['VCHAR:64', ''],
						'button_type' => ['VCHAR:16', ''],
						'bbcode_id' => ['UINT', 0],
						'placement' => ['VCHAR:16', 'more'],
						'sort_order' => ['UINT', 0],
						'icon' => ['VCHAR:64', ''],
						'font_icon' => ['VCHAR:64', ''],
					],
					'PRIMARY_KEY' => 'button_key',
					'KEYS' => [
						'placement' => ['INDEX', ['placement', 'sort_order']],
						'bbcode_id' => ['INDEX', 'bbcode_id'],
					],
				],
				$this->table_prefix . 'abbc3_bbcode_groups' => [
					'COLUMNS' => [
						'bbcode_id' => ['UINT', 0],
						'group_id' => ['UINT', 0],
					],
					'PRIMARY_KEY' => ['bbcode_id', 'group_id'],
					'KEYS' => [
						'group_id' => ['INDEX', 'group_id'],
					],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function revert_schema()
	{
		return [
			'drop_tables' => [
				$this->table_prefix . 'abbc3_toolbar',
				$this->table_prefix . 'abbc3_bbcode_groups',
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['custom', [[$this, 'migrate_toolbar']]],
			['custom', [[$this, 'migrate_groups']]],
			['config.remove', ['abbc3_fresh_install']],
		];
	}

	/**
	 * Populate missing toolbar entries from the core buttons and legacy BBCode order.
	 *
	 * @return void
	 */
	public function migrate_toolbar()
	{
		$result = $this->db->sql_query('SELECT button_key FROM ' . $this->table_prefix . 'abbc3_toolbar');
		$existing = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$existing[$row['button_key']] = true;
		}
		$this->db->sql_freeresult($result);

		$fresh = !empty($this->config['abbc3_fresh_install']);
		if ($fresh)
		{
			$this->apply_fresh_install_defaults();
		}
		$order = 0;
		$core = [
			'bold' => 'bold', 'italic' => 'italic', 'underline' => 'underline',
			'quote' => 'quote', 'code' => 'code', 'list' => 'listb',
			'list_ordered' => 'listo', 'list_item' => 'listitem', 'image' => 'img',
			'url' => 'url', 'media' => 'media', 'color' => 'fontcolor', 'size' => 'size',
		];

		foreach ($core as $key => $icon)
		{
			$this->insert_button($existing, 'core:' . $key, 'core', 0, 'primary', ++$order, $icon);
		}

		$this->insert_button($existing, 'action:plain', 'action', 0, 'more', 1, 'plain');

		$sql = 'SELECT bbcode_id, bbcode_tag, display_on_posting, bbcode_order
			FROM ' . BBCODES_TABLE . '
			ORDER BY bbcode_order, bbcode_id';
		$result = $this->db->sql_query($sql);
		$custom_order = $fresh ? 10 : $order;
		while ($row = $this->db->sql_fetchrow($result))
		{
			$tag = strtolower(rtrim($row['bbcode_tag'], '='));
			$placement = empty($row['display_on_posting']) ? 'hidden' : ($fresh ? 'more' : 'primary');
			$this->insert_button($existing, 'bbcode:' . $tag, 'bbcode', (int) $row['bbcode_id'], $placement, ++$custom_order, $tag);
		}
		$this->db->sql_freeresult($result);
	}

	/**
	 * Set default posting visibility and remove the redundant SoundCloud definition on a fresh installation.
	 *
	 * @return void
	 */
	protected function apply_fresh_install_defaults()
	{
		$sql = 'UPDATE ' . BBCODES_TABLE . '
			SET display_on_posting = 1
			WHERE bbcode_helpline ' . $this->db->sql_like_expression('ABBC3_' . $this->db->get_any_char());
		$this->db->sql_query($sql);

		// BBvideo handles SoundCloud URLs. Remove only ABBC3's pristine fresh-install
		// definition; an admin-created definition with the same tag is never touched.
		$sql = 'DELETE FROM ' . BBCODES_TABLE . "
			WHERE LOWER(bbcode_tag) = 'soundcloud'
				AND bbcode_helpline = 'ABBC3_SOUNDCLOUD_HELPLINE'";
		$this->db->sql_query($sql);
	}

	/**
	 * Copy distinct legacy BBCode group assignments into the new table.
	 *
	 * @return void
	 */
	public function migrate_groups()
	{
		$table = $this->table_prefix . 'abbc3_bbcode_groups';
		$result = $this->db->sql_query('SELECT bbcode_id, group_id FROM ' . $table);
		$existing = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$existing[(int) $row['bbcode_id']][(int) $row['group_id']] = true;
		}
		$this->db->sql_freeresult($result);

		$sql = 'SELECT bbcode_id, bbcode_group
			FROM ' . BBCODES_TABLE . "
			WHERE bbcode_group <> ''";
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bbcode_id = (int) $row['bbcode_id'];
			foreach (array_unique(array_map('intval', explode(',', $row['bbcode_group']))) as $group_id)
			{
				if ($group_id > 0 && !isset($existing[$bbcode_id][$group_id]))
				{
					$sql_ary = ['bbcode_id' => $bbcode_id, 'group_id' => $group_id];
					$this->db->sql_query('INSERT INTO ' . $table . ' ' . $this->db->sql_build_array('INSERT', $sql_ary));
				}
			}
		}
		$this->db->sql_freeresult($result);
	}

	/**
	 * Insert a toolbar entry if its key is still missing.
	 *
	 * @param array $existing Existing toolbar keys, updated after insertion
	 * @param string $key Toolbar button key
	 * @param string $type Button type
	 * @param int $bbcode_id Custom BBCode ID, or zero for a built-in control
	 * @param string $placement Toolbar placement
	 * @param int $order Sort position
	 * @param string $icon Image icon name
	 * @return void
	 */
	protected function insert_button(array &$existing, $key, $type, $bbcode_id, $placement, $order, $icon)
	{
		if (isset($existing[$key]))
		{
			return;
		}

		$sql_ary = [
			'button_key' => $key,
			'button_type' => $type,
			'bbcode_id' => (int) $bbcode_id,
			'placement' => $placement,
			'sort_order' => (int) $order,
			'icon' => $icon,
			'font_icon' => '',
		];
		$this->db->sql_query('INSERT INTO ' . $this->table_prefix . 'abbc3_toolbar ' . $this->db->sql_build_array('INSERT', $sql_ary));
		$existing[$key] = true;
	}
}
