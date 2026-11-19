<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use vse\abbc3\core\bbcode_catalog;

class bbcode_catalog_test extends \phpbb_test_case
{
	public function test_standalone_fallbacks_do_not_reference_extension_assets()
	{
		$catalog = new bbcode_catalog();
		foreach ($catalog->all() as $entry)
		{
			self::assertStringNotContainsString('ext/vse/abbc3', $entry['fallback']);
			self::assertStringNotContainsString('ABBC3_', $entry['fallback']);
		}
	}

	public function test_tag_variants_resolve_to_same_entry()
	{
		$catalog = new bbcode_catalog();
		self::assertSame($catalog->get('highlight'), $catalog->get('highlight='));
	}
}
