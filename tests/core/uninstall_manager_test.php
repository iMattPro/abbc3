<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use phpbb\config\db_text;
use vse\abbc3\core\bbcode_catalog;
use vse\abbc3\core\uninstall_manager;

class uninstall_manager_test extends acp_base
{
	public function test_disable_installs_standalone_fallback_and_enable_restores_definition()
	{
		global $phpbb_root_path, $phpEx;

		$catalog = new bbcode_catalog();
		$entry = $catalog->get('font');
		$match = '[font={INTTEXT}]{TEXT}[/font]';
		$this->set_definition(13, $match, $entry['enhanced']);

		$cache = $this->createMock('\phpbb\cache\driver\driver_interface');
		$cache->expects(self::exactly(4))->method('destroy');
		$config_text = new db_text($this->db, 'phpbb_config_text');
		$manager = new uninstall_manager(
			$this->db,
			$config_text,
			$cache,
			$catalog,
			'parser',
			'renderer',
			$phpbb_root_path,
			$phpEx
		);

		$manager->prepare_disable();
		$row = $this->get_definition(13);
		self::assertSame($entry['fallback'], $row['bbcode_tpl']);
		self::assertSame('0', $row['display_on_posting']);
		self::assertNotNull($config_text->get('abbc3_disable_state'));

		// Repeated disable step must not overwrite saved enhanced definition.
		$manager->prepare_disable();
		$manager->restore_enable();
		$row = $this->get_definition(13);
		self::assertSame($entry['enhanced'], $row['bbcode_tpl']);
		self::assertSame('1', $row['display_on_posting']);
		self::assertNull($config_text->get('abbc3_disable_state'));
	}

	protected function set_definition($bbcode_id, $match, $template)
	{
		global $phpbb_root_path, $phpEx;
		if (!class_exists('acp_bbcodes'))
		{
			include $phpbb_root_path . 'includes/acp/acp_bbcodes.' . $phpEx;
		}
		$compiled = (new \acp_bbcodes())->build_regexp($match, $template);
		$data = array_replace($compiled, [
			'bbcode_match' => $match,
			'bbcode_tpl' => $template,
			'display_on_posting' => 1,
		]);
		$this->db->sql_query('UPDATE phpbb_bbcodes SET ' . $this->db->sql_build_array('UPDATE', $data) . ' WHERE bbcode_id = ' . (int) $bbcode_id);
	}

	protected function get_definition($bbcode_id)
	{
		$result = $this->db->sql_query('SELECT bbcode_tpl, display_on_posting FROM phpbb_bbcodes WHERE bbcode_id = ' . (int) $bbcode_id);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		return $row;
	}
}
