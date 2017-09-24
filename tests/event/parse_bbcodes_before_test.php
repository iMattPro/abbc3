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

class parse_bbcodes_before_test extends listener_base
{
	/**
	 * Data set for test_parse_bbcodes_before
	 *
	 * @return array Test data
	 */
	public function parse_bbcodes_before_data()
	{
		return array(
			array('', ''),
			array('This is a foo bar sample text.', 'uid000'),
		);
	}

	/**
	 * Test the parse_bbcodes_before event is calling pre_parse_bbcodes()
	 * once and sending and returning event data to it as expected.
	 *
	 * @dataProvider parse_bbcodes_before_data
	 */
	public function test_parse_bbcodes_before($text, $uid)
	{
		$this->set_listener();

		$this->parser->expects($this->once())
			->method('pre_parse_bbcodes')
			->with($this->equalTo($text), $this->equalTo($uid))
			->will($this->returnValue($text));

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.modify_text_for_display_before', array($this->listener, 'parse_bbcodes_before'));

		$event_data = array('text', 'uid');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.modify_text_for_display_before', $event);

		$result = $event->get_data_filtered($event_data);

		$this->assertEquals($text, $result['text']);
	}
}
