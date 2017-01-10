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

	/**
	 * Data set for test_s9e_allow_custom_bbcodes
	 *
	 * @return array
	 */
	public function s9e_allow_custom_bbcodes_data()
	{
		return array(
			array('FOO', '4,5', true), // data for a disabled bbcode
			array('BAR', '', false), // data for an allowed bbcode
		);
	}

	/**
	 * Test the s9e_allow_custom_bbcodes event is calling disable_bbcode()
	 * on registered bbcodes for users not in a group allowed to use it.
	 *
	 * @dataProvider s9e_allow_custom_bbcodes_data
	 */
	public function test_s9e_allow_custom_bbcodes($bbcode, $groups, $disable)
	{
		$this->set_listener();

		// Mock the text_formatter.parser service
		$parser = $this->getMockBuilder('\phpbb\textformatter\s9e\parser')
			->disableOriginalConstructor()
			->getMock();
		$parser->expects($this->once())
			->method('get_parser')
			->will($this->returnSelf());
		$parser->registeredVars['abbc3.bbcode_groups'] = array(
			$bbcode => $groups,
		);

		// Mock whether the user is allowed or not to use a bbcode
		$this->bbcodes->expects($this->once())
			->method('user_in_bbcode_group')
			->with($groups)
			->will($this->returnValue(!$disable));

		// Test if disable_bbcode is called as expected
		$parser->expects($disable ? $this->once() : $this->never())
			->method('disable_bbcode')
			->with($bbcode);

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_parser_setup', array($this->listener, 's9e_allow_custom_bbcodes'));

		$event_data = array('parser');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_parser_setup', $event);
	}
}
