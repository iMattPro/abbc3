<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\functional;

use vse\abbc3\core\bbcode_catalog;

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

	protected function get_font_definition()
	{
		$db = $this->get_db();
		$result = $db->sql_query("SELECT bbcode_tpl FROM phpbb_bbcodes WHERE LOWER(bbcode_tag) IN ('font', 'font=')");
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		return $row;
	}
}
