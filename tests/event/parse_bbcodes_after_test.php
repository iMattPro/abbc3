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

class parse_bbcodes_after_test extends listener_base
{
	/**
	 * Data set for test_parse_bbcodes_after
	 *
	 * @return array Test data
	 */
	public function parse_bbcodes_after_data()
	{
		return array(
			array('', 'core.modify_text_for_display_after'),
			array('', 'core.modify_format_display_text_after'),
			array('This is a foo bar sample text.', 'core.modify_text_for_display_after'),
			array('This is a foo bar sample text.', 'core.modify_format_display_text_after'),
		);
	}

	/**
	 * Test the parse_bbcodes_after event is calling post_parse_bbcodes()
	 * once and sending and returning event data to it as expected.
	 *
	 * @dataProvider parse_bbcodes_after_data
	 */
	public function test_parse_bbcodes_after($text, $listener)
	{
		$this->set_listener();

		$this->parser->expects($this->once())
			->method('post_parse_bbcodes')
			->with($this->equalTo($text))
			->will($this->returnValue($text));

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener($listener, array($this->listener, 'parse_bbcodes_after'));

		$event_data = array('text');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch($listener, $event);

		$result = $event->get_data_filtered($event_data);

		$this->assertEquals($text, $result['text']);
	}
}
