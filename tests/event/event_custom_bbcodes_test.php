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

class event_custom_bbcodes_test extends event_listener_base
{
	/**
	 * Data set for test_display_custom_bbcodes and test_allow_custom_bbcodes
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

		$this->bbcodes->expects($this->once())
			->method('display_custom_bbcodes')
			->with($this->equalTo($custom_tags), $this->equalTo($row))
			->will($this->returnValue($custom_tags));

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes_modify_row', array($this->listener, 'display_custom_bbcodes'));

		$event_data = array('custom_tags', 'row');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.display_custom_bbcodes_modify_row', $event);

		$result = $event->get_data_filtered($event_data);

		$this->assertEquals($custom_tags, $result['custom_tags']);
	}

	/**
	 * Test the allow_custom_bbcodes event is calling allow_custom_bbcodes()
	 * once and sending and returning event data to it as expected.
	 *
	 * @dataProvider custom_bbcodes_data
	 */
	public function test_allow_custom_bbcodes($bbcodes, $rowset)
	{
		$this->set_listener();

		$this->bbcodes->expects($this->once())
			->method('allow_custom_bbcodes')
			->with($this->equalTo($bbcodes), $this->equalTo($rowset))
			->will($this->returnValue($bbcodes));

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.modify_bbcode_init', array($this->listener, 'allow_custom_bbcodes'));

		$event_data = array('bbcodes', 'rowset');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.modify_bbcode_init', $event);

		$result = $event->get_data_filtered($event_data);

		$this->assertEquals($bbcodes, $result['bbcodes']);
	}
}
