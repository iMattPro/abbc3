<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

class acp_bbcode_group_select_test extends acp_base
{
	protected function setUp(): void
	{
		parent::setUp();

		$this->lang->add_lang('common');
	}

	public function bbcode_group_select_data()
	{
		return [
			[[], []],
			[[''], []],
			[[1], [1]],
			[[2, '3'], [2, 3]],
			[[4, 5, 6, 7], [5, 4]],
		];
	}

	/**
	 * @dataProvider bbcode_group_select_data
	 */
	public function test_bbcode_group_select_options($selected, $expected_selection)
	{
		$acp_manager = $this->get_acp_manager();

		$choices = $acp_manager->bbcode_group_select_options($selected);

		self::assertSame([5, 4, 1, 2, 3], array_column($choices, 'ID'));
		self::assertSame([
			$this->lang->lang('G_ADMINISTRATORS'),
			$this->lang->lang('G_GLOBAL_MODERATORS'),
			$this->lang->lang('G_GUESTS'),
			$this->lang->lang('G_REGISTERED'),
			$this->lang->lang('G_REGISTERED_COPPA'),
		], array_column($choices, 'NAME'));
		$checked = array_filter($choices, static function (array $choice) {
			return $choice['S_SELECTED'];
		});
		self::assertSame($expected_selection, array_column($checked, 'ID'));
	}
}
