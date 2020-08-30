<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class custom_bbcodes_test extends listener_base
{
	/**
	 * Data set for test_display_custom_bbcodes
	 *
	 * @return array Test data
	 */
	public function custom_bbcodes_data()
	{
		return [
			['', '', true],
			['FOO', 'BAR', true],
			[[], [], true],
			[['FOO1', 'FOO2'], ['BAR1', 'BAR2'], true],
			['', '', false],
		];
	}

	/**
	 * Test the display_custom_bbcodes event is calling display_custom_bbcodes()
	 * once and sending and returning event data to it as expected.
	 *
	 * @dataProvider custom_bbcodes_data
	 */
	public function test_display_custom_bbcodes($custom_tags, $row, $enabled)
	{
		$this->config['abbc3_bbcode_bar'] = $enabled;

		$this->set_listener();

		$this->bbcodes_display->expects($enabled ? self::once() : self::never())
			->method('display_custom_bbcodes')
			->with(self::equalTo($custom_tags), self::equalTo($row))
			->willReturn($custom_tags);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes_modify_row', [$this->listener, 'display_custom_bbcodes']);

		$event_data = ['custom_tags', 'row'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.display_custom_bbcodes_modify_row', $event);

		$result = $event->get_data_filtered($event_data);

		self::assertEquals($custom_tags, $result['custom_tags']);
	}

	/**
	 * Data set for test_s9e_allow_custom_bbcodes
	 *
	 * @return array Test data
	 */
	public function s9e_allow_custom_bbcodes_data()
	{
		return [
			[false],
			[true], //must use true last as the constant will persist through the tests.
		];
	}

	/**
	 * Test the s9e_allow_custom_bbcodes event is calling allow_custom_bbcodes()
	 * once and sending it the text formatter parser service.
	 *
	 * @dataProvider s9e_allow_custom_bbcodes_data
	 */
	public function test_s9e_allow_custom_bbcodes($in_cron)
	{
		if ($in_cron)
		{
			define('IN_CRON', $in_cron);
		}

		$this->set_listener();

		// Mock the text_formatter.parser service
		$parser = $this->getMockBuilder('\phpbb\textformatter\s9e\parser')
			->disableOriginalConstructor()
			->getMock();

		$this->bbcodes_display->expects($in_cron ? self::never() : self::once())
			->method('allow_custom_bbcodes')
			->with($parser);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_parser_setup', [$this->listener, 'allow_custom_bbcodes']);

		$event_data = ['parser'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_parser_setup', $event);
	}
}
