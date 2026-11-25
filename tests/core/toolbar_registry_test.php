<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use phpbb\db\tools\factory;
use vse\abbc3\core\toolbar_registry;
use vse\abbc3\core\toolbar_repository;

class toolbar_registry_test extends acp_base
{
	public function test_editor_and_admin_views_use_the_saved_layout()
	{
		foreach ([
			['core:bold', 'core', 0, 'primary', 8, 'bold', 'bold'],
			['core:italic', 'core', 0, 'primary', 2, 'italic', ''],
			['bbcode:font', 'bbcode', 13, 'more', 1, 'custom-font', ''],
			['action:plain', 'action', 0, 'hidden', 1, '', ''],
			['bbcode:orphan', 'bbcode', 999, 'hidden', 2, '', ''],
		] as $row)
		{
			$columns = ['button_key', 'button_type', 'bbcode_id', 'placement', 'sort_order', 'icon', 'font_icon'];
			$this->db->sql_query('INSERT INTO phpbb_abbc3_toolbar ' . $this->db->sql_build_array('INSERT', array_combine($columns, $row)));
		}
		$this->db->sql_query("UPDATE " . BBCODES_TABLE . " SET bbcode_helpline = 'Font &amp; family' WHERE bbcode_id = 13");

		$repository = new toolbar_repository($this->db, 'phpbb_');
		$repository->sync_visibility();
		$registry = new toolbar_registry($repository);
		$registry->add_custom(['name' => 'font', 'tag' => 'FONT=', 'type' => 'font', 'label' => 'Font & family', 'open' => '[font=Arial]', 'close' => '[/font]']);

		$editor = $registry->get_editor_buttons();
		self::assertSame(['primary', 'more'], array_keys($editor));
		self::assertSame(['core:italic', 'core:bold'], array_column($editor['primary'], 'key'));
		self::assertSame('bold', $editor['primary'][1]['font_icon']);
		self::assertSame(['bbcode:font'], array_column($editor['more'], 'key'));
		self::assertSame('[font=Arial]', $editor['more'][0]['open']);

		$admin = $registry->get_admin_buttons();
		self::assertSame(['core:italic', 'core:bold'], array_column($admin['primary'], 'key'));
		self::assertSame(['action:plain', 'bbcode:orphan'], array_column($admin['hidden'], 'key'));
		self::assertSame('orphan', $admin['hidden'][1]['label']);
		self::assertSame('Font & family', $admin['more'][0]['label']);
		self::assertSame('custom-font', $admin['more'][0]['icon']);
	}

	public function test_saving_and_clearing_toolbar_font_icon_preserves_native_icon()
	{
		$tools = (new factory())->get($this->db);
		$tools->sql_column_add(BBCODES_TABLE, 'bbcode_font_icon', ['VCHAR:64', '']);
		try
		{
			$this->db->sql_query('UPDATE ' . BBCODES_TABLE . " SET bbcode_font_icon = 'heart' WHERE bbcode_id = 14");
			$repository = new toolbar_repository($this->db, 'phpbb_');
			$registry = new toolbar_registry($repository);
			$repository->sync_bbcode(14, 'highlight=');
			$registry->add_custom(['name' => 'highlight', 'tag' => 'highlight=', 'type' => 'button', 'label' => 'Highlight']);
			$placements = ['more' => ['bbcode:highlight']];

			foreach (['star', ''] as $font_icon)
			{
				$repository->save_layout($placements, [], ['bbcode:highlight' => $font_icon]);
				$editor = $registry->get_editor_buttons()['more'][0];
				$admin = $registry->get_admin_buttons()['more'][0];
				self::assertSame($font_icon, $editor['font_icon']);
				self::assertSame($font_icon, $admin['font_icon']);
				self::assertSame('highlight', $editor['icon']);

				$result = $this->db->sql_query('SELECT bbcode_font_icon FROM ' . BBCODES_TABLE . ' WHERE bbcode_id = 14');
				$native_icon = $this->db->sql_fetchfield('bbcode_font_icon');
				$this->db->sql_freeresult($result);
				self::assertSame('heart', $native_icon);
			}
		}
		finally
		{
			$tools->sql_column_remove(BBCODES_TABLE, 'bbcode_font_icon');
		}
	}
}
