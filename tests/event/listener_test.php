<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\event;

use vse\abbc3\event\listener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener_test extends listener_base
{
	/**
	 * Test the listener constructor is instantiated
	 */
	public function test_construct()
	{
		$this->set_listener();
		$this->assertInstanceOf(EventSubscriberInterface::class, $this->listener);
	}

	/**
	 * Test the event listener is subscribing its events
	 */
	public function test_getSubscribedEvents()
	{
		$this->assertEquals([
			'core.user_setup',
			'core.page_header',
			'core.adm_page_header',
			'core.display_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql',
			'core.display_custom_bbcodes_modify_row',
			'core.text_formatter_s9e_parser_setup',
			'core.text_formatter_s9e_configure_after',
			'core.text_formatter_s9e_renderer_setup',
			'core.help_manager_add_block_after',
			'core.viewtopic_modify_quick_reply_template_vars',
			'core.viewtopic_modify_page_title',
		], array_keys(listener::getSubscribedEvents()));
	}
}
