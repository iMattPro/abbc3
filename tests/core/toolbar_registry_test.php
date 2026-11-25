<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

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
}
