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

class acp_bbcode_group_select_test extends acp_base
{
	public function get_lang_instance(): void
	{
		global $phpbb_root_path, $phpEx;

		// Get instance of phpbb\user (dataProvider is called before setUp(), so this must be done here)
		$lang_loader = new language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = new language($lang_loader);
		$this->lang->add_lang('common');
	}

	protected function setUp(): void
	{
		parent::setUp();

		$this->get_lang_instance();
	}

	public function bbcode_group_select_data(): array
	{
		$this->get_lang_instance();

		return [
			[
				[],
				'<option value="5">' . $this->lang->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $this->lang->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $this->lang->lang('G_GUESTS') .
				'</option><option value="2">' . $this->lang->lang('G_REGISTERED') .
				'</option><option value="3">' . $this->lang->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[''],
				'<option value="5">' . $this->lang->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $this->lang->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $this->lang->lang('G_GUESTS') .
				'</option><option value="2">' . $this->lang->lang('G_REGISTERED') .
				'</option><option value="3">' . $this->lang->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[1],
				'<option value="5">' . $this->lang->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $this->lang->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1" selected="selected">' . $this->lang->lang('G_GUESTS') .
				'</option><option value="2">' . $this->lang->lang('G_REGISTERED') .
				'</option><option value="3">' . $this->lang->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[2, 3],
				'<option value="5">' . $this->lang->lang('G_ADMINISTRATORS') .
				'</option><option value="4">' . $this->lang->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $this->lang->lang('G_GUESTS') .
				'</option><option value="2" selected="selected">' . $this->lang->lang('G_REGISTERED') .
				'</option><option value="3" selected="selected">' . $this->lang->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
			[
				[4, 5, 6],
				'<option value="5" selected="selected">' . $this->lang->lang('G_ADMINISTRATORS') .
				'</option><option value="4" selected="selected">' . $this->lang->lang('G_GLOBAL_MODERATORS') .
				'</option><option value="1">' . $this->lang->lang('G_GUESTS') .
				'</option><option value="2">' . $this->lang->lang('G_REGISTERED') .
				'</option><option value="3">' . $this->lang->lang('G_REGISTERED_COPPA') .
				'</option>'
			],
		];
	}

	/**
	 * @dataProvider bbcode_group_select_data
	 */
	public function test_bbcode_group_select_options($data, $expected)
	{
		$acp_manager = $this->get_acp_manager();

		$this->assertEquals($expected, $acp_manager->bbcode_group_select_options($data));
	}
}
