<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\functional;

use vse\abbc3\core\bbcode_catalog;
use vse\abbc3\core\toolbar_repository;

/**
 * @group functional
 */
class uninstall_test extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	public function test_definitions_remain_readable_through_disable_and_purge()
	{
		$font = (new bbcode_catalog())->get('font');

		$this->disable_ext('vse/abbc3');
		self::assertSame($font['fallback'], $this->get_font_definition()['bbcode_tpl']);

		$this->install_ext('vse/abbc3');
		self::assertSame($font['enhanced'], $this->get_font_definition()['bbcode_tpl']);

		$this->disable_ext('vse/abbc3');
		$this->delete_ext_data('vse/abbc3');
		$definition = $this->get_font_definition();
		self::assertNotFalse($definition);
		self::assertSame($font['fallback'], $definition['bbcode_tpl']);
		self::assertStringNotContainsString('abbc3', strtolower($definition['bbcode_tpl']));

		// Leave shared functional-test board ready for any later test class.
		$this->install_ext('vse/abbc3');
	}

	public function test_enable_reconciles_bbcode_visibility_changed_while_disabled()
	{
		$db = $this->get_db();
		$prefix = self::$config['table_prefix'];
		$repository = new toolbar_repository($db, $prefix);
		$show_id = $this->insert_custom_bbcode('showafterenable', false);
		$hide_id = $this->insert_custom_bbcode('hideafterenable', true);
		$repository->sync_bbcode($show_id, 'showafterenable', false);
		$repository->sync_bbcode($hide_id, 'hideafterenable', true);
		$before = $repository->get_layout();

		$this->disable_ext('vse/abbc3');
		$id = $this->insert_custom_bbcode('backfill', true);
		$db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET display_on_posting = 1 WHERE bbcode_id = ' . $show_id);
		$db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET display_on_posting = 0 WHERE bbcode_id = ' . $hide_id);

		$this->install_ext('vse/abbc3');
		$layout = (new toolbar_repository($db, $prefix))->get_layout();
		self::assertSame($id, (int) $layout['bbcode:backfill']['bbcode_id']);
		self::assertSame('more', $layout['bbcode:backfill']['placement']);
		self::assertSame('more', $layout['bbcode:showafterenable']['placement']);
		self::assertSame('hidden', $layout['bbcode:hideafterenable']['placement']);
		$changed = array_flip(['bbcode:backfill', 'bbcode:showafterenable', 'bbcode:hideafterenable']);
		self::assertSame(array_diff_key($before, $changed), array_diff_key($layout, $changed));

		$this->login();
		$crawler = self::request('GET', "posting.php?mode=post&f=2&sid=$this->sid");
		self::assertCount(1, $crawler->filter('.abbc3-more__tray [data-abbc3-name="backfill"]'));
		self::assertCount(1, $crawler->filter('.abbc3-more__tray [data-abbc3-name="showafterenable"]'));
		self::assertCount(0, $crawler->filter('[data-abbc3-name="hideafterenable"]'));
		$this->logout();

		$this->disable_ext('vse/abbc3');
		$this->install_ext('vse/abbc3');
		$repository = new toolbar_repository($db, $prefix);
		self::assertSame($layout, $repository->get_layout());

		foreach ([$id, $show_id, $hide_id] as $custom_id)
		{
			$repository->remove_bbcode($custom_id);
			$db->sql_query('DELETE FROM ' . BBCODES_TABLE . ' WHERE bbcode_id = ' . $custom_id);
		}
		$this->purge_cache();
	}

	protected function insert_custom_bbcode($tag, $display)
	{
		$db = $this->get_db();
		$result = $db->sql_query('SELECT MAX(bbcode_id) AS max_id FROM ' . BBCODES_TABLE);
		$id = (int) $db->sql_fetchfield('max_id', false, $result) + 1;
		$db->sql_freeresult($result);
		$db->sql_query('INSERT INTO ' . BBCODES_TABLE . ' ' . $db->sql_build_array('INSERT', [
			'bbcode_id' => $id,
			'bbcode_tag' => $tag,
			'bbcode_match' => '[' . $tag . ']{TEXT}[/' . $tag . ']',
			'bbcode_tpl' => '<span>{TEXT}</span>',
			'bbcode_helpline' => '',
			'display_on_posting' => (int) $display,
			'first_pass_match' => '',
			'first_pass_replace' => '',
			'second_pass_match' => '',
			'second_pass_replace' => '',
		]));

		return $id;
	}

	protected function get_font_definition()
	{
		$db = $this->get_db();
		$result = $db->sql_query("SELECT bbcode_tpl FROM phpbb_bbcodes WHERE LOWER(bbcode_tag) IN ('font', 'font=')");
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		return $row;
	}
}
