<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2017 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class plugins_test extends listener_base
{
	/**
	 * Test textformatter plugins are being loaded
	 */
	public function test_display_custom_bbcodes()
	{
		$configurator = new \s9e\TextFormatter\Configurator();
		$this->assertInstanceOf('s9e\\TextFormatter\\Configurator', $configurator);

		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_configure_after', array($this->listener, 's9e_configure_plugins'));

		// Assert plugins are NOT loaded before the event is dispatched
		$this->assertFalse(isset($configurator->plugins['PipeTables']));

		$event_data = array('configurator');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_configure_after', $event);

		// Assert plugins ARE loaded after the event is dispatched
		$this->assertTrue(isset($configurator->plugins['PipeTables']));
	}
}
