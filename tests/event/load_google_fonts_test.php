<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2022 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class load_google_fonts_test extends listener_base
{
	/**
	 * @return array Test data
	 */
	public function load_google_fonts_data()
	{
		return [
			['', null],
			[null, null],
			[false, null],
			['foo', null],
			['[]', []],
			['[""]', [""]],
			['["Droid Sans","Roboto","Shizuru"]', ["Droid Sans","Roboto","Shizuru"]],
		];
	}

	/**
	 * @dataProvider load_google_fonts_data
	 */
	public function test_load_google_fonts_common($config, $expected)
	{
		$this->set_listener();

		$this->config_text->expects(self::once())
			->method('get')
			->willReturn($config);

		$this->template->expects(self::once())
			->method('assign_var')
			->with('abbc3_google_fonts', $expected);

		$this->listener->load_google_fonts();
	}
}
