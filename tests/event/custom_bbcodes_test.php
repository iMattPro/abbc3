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
		return array(
			array('', ''),
			array('FOO', 'BAR'),
			array(array(), array()),
			array(array('FOO1', 'FOO2'), array('BAR1', 'BAR2')),
		);
	}

	/**
	 * Test the display_custom_bbcodes event is calling display_custom_bbcodes()
	 * once and sending and returning event data to it as expected.
	 *
	 * @dataProvider custom_bbcodes_data
	 */
	public function test_display_custom_bbcodes($custom_tags, $row)
	{
		$this->set_listener();

		$this->bbcodes_display->expects($this->once())
			->method('display_custom_bbcodes')
			->with($this->equalTo($custom_tags), $this->equalTo($row))
			->willReturn($custom_tags);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes_modify_row', array($this->listener, 'display_custom_bbcodes'));

		$event_data = array('custom_tags', 'row');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.display_custom_bbcodes_modify_row', $event);

		$result = $event->get_data_filtered($event_data);

		$this->assertEquals($custom_tags, $result['custom_tags']);
	}

	/**
	 * Data set for test_s9e_allow_custom_bbcodes
	 *
	 * @return array Test data
	 */
	public function s9e_allow_custom_bbcodes_data()
	{
		return array(
			array(false),
			array(true), //must use true last as the constant will persist through the tests.
		);
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

		$this->bbcodes_display->expects($in_cron ? $this->never() : $this->once())
			->method('allow_custom_bbcodes')
			->with($parser);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_parser_setup', array($this->listener, 'allow_custom_bbcodes'));

		$event_data = array('parser');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_parser_setup', $event);
	}
}
