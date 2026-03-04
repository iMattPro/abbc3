<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\core;

use phpbb\language\language;
use phpbb\language\language_file_loader;
use phpbb_mock_extension_manager;

class acp_bbcode_group_select_test extends acp_base
{
	public static function get_language_instance(): language
	{
		global $phpbb_root_path, $phpEx;

		$lang_loader = new language_file_loader($phpbb_root_path, $phpEx);
		$lang_loader->set_extension_manager(new phpbb_mock_extension_manager($phpbb_root_path));
		$lang = new language($lang_loader);
		$lang->add_lang('common');

		return $lang;
	}

	protected function setUp(): void
	{
		parent::setUp();

		$this->lang = self::get_language_instance();
	}

	public static function bbcode_group_select_data(): array
	{
		$language = self::get_language_instance();

		return [
			[
				[],
				'<option value="5">' . $language->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $language->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $language->lang('G_GUESTS') .
				'</option><option value="2">' . $language->lang('G_REGISTERED') .
				'</option><option value="3">' . $language->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[''],
				'<option value="5">' . $language->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $language->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $language->lang('G_GUESTS') .
				'</option><option value="2">' . $language->lang('G_REGISTERED') .
				'</option><option value="3">' . $language->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[1],
				'<option value="5">' . $language->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $language->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1" selected="selected">' . $language->lang('G_GUESTS') .
				'</option><option value="2">' . $language->lang('G_REGISTERED') .
				'</option><option value="3">' . $language->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[2, 3],
				'<option value="5">' . $language->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $language->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $language->lang('G_GUESTS') .
				'</option><option value="2" selected="selected">' . $language->lang('G_REGISTERED') .
				'</option><option value="3" selected="selected">' . $language->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[4, 5, 6],
				'<option value="5" selected="selected">' . $language->lang('G_ADMINISTRATORS') .
				'</option><option value="4" selected="selected">' . $language->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $language->lang('G_GUESTS') .
				'</option><option value="2">' . $language->lang('G_REGISTERED') .
				'</option><option value="3">' . $language->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
		];
	}

	/**
	 * @dataProvider bbcode_group_select_data
	 */
	public function test_bbcode_group_select_options($data, $expected): void
	{
		$acp_manager = $this->get_acp_manager();

		$this->assertEquals($expected, $acp_manager->bbcode_group_select_options($data));
	}
}
