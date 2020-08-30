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

class acp_listener_test extends acp_listener_base
{
	/**
	 * Test the listener constructor is instantiated
	 */
	public function test_construct()
	{
		$this->set_listener();
		self::assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

	/**
	 * Test the event listener is subscribing its events
	 */
	public function test_getSubscribedEvents()
	{
		self::assertEquals([
			'core.acp_bbcodes_display_form',
			'core.acp_bbcodes_display_bbcodes',
			'core.acp_bbcodes_modify_create',
			'core.acp_bbcodes_edit_add',
			'core.text_formatter_s9e_configure_after',
		], array_keys(\vse\abbc3\event\acp_listener::getSubscribedEvents()));
	}
}
