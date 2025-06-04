<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class load_language_on_setup_test extends listener_base
{
	/**
	 * Data set for test_load_language_on_setup
	 *
	 * @return array Test data
	 */
	public function load_language_on_setup_data()
	{
		return [
			[
				[],
				[
					[
						'ext_name' => 'vse/abbc3',
						'lang_set' => 'abbc3',
					],
				],
			],
			[
				[
					[
						'ext_name' => 'foo/bar',
						'lang_set' => 'foobar',
					],
				],
				[
					[
						'ext_name' => 'foo/bar',
						'lang_set' => 'foobar',
					],
					[
						'ext_name' => 'vse/abbc3',
						'lang_set' => 'abbc3',
					],
				],
			],
		];
	}

	/**
	 * Test the load_language_on_setup event will correctly
	 * load expected language files.
	 *
	 * @dataProvider load_language_on_setup_data
	 */
	public function test_load_language_on_setup($lang_set_ext, $expected_contains)
	{
		$this->set_listener();

		$dispatcher = new \phpbb\event\dispatcher();
		$dispatcher->addListener('core.user_setup', [$this->listener, 'load_language_on_setup']);

		$event_data = ['lang_set_ext'];
		$event_filtered_data = $dispatcher->trigger_event('core.user_setup', compact($event_data));
		extract($event_filtered_data);

		foreach ($expected_contains as $expected)
		{
			self::assertContains($expected, $lang_set_ext);
		}
	}
}
