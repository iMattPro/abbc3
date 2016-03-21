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

class listener_test extends listener_base
{
	/**
	 * Test the listener constructor is instantiated
	 */
	public function test_construct()
	{
		$this->set_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

	/**
	 * Test the event listener is subscribing its events
	 */
	public function test_getSubscribedEvents()
	{
		$this->assertEquals(array(
			'core.user_setup',
			'core.modify_text_for_display_before',
			'core.modify_text_for_display_after',
			'core.display_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql',
			'core.display_custom_bbcodes_modify_row',
			'core.modify_format_display_text_after',
			'core.modify_bbcode_init',
			'core.text_formatter_s9e_parser_setup',
		), array_keys(\vse\abbc3\event\listener::getSubscribedEvents()));
	}
}
