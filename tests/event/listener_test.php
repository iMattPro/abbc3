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
		self::assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

	/**
	 * Test the event listener is subscribing its events
	 */
	public function test_getSubscribedEvents()
	{
		self::assertEquals([
			'core.user_setup',
			'core.display_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql',
			'core.display_custom_bbcodes_modify_row',
			'core.text_formatter_s9e_parser_setup',
			'core.text_formatter_s9e_configure_after',
			'core.help_manager_add_block_after',
			'core.viewtopic_modify_quick_reply_template_vars',
			'core.viewtopic_modify_page_title',
		], array_keys(\vse\abbc3\event\listener::getSubscribedEvents()));
	}
}
