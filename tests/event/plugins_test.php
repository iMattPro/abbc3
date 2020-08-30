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
		self::assertInstanceOf('s9e\\TextFormatter\\Configurator', $configurator);

		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_configure_after', [$this->listener, 'configure_bbcodes']);

		// Assert plugins are NOT loaded before the event is dispatched
		self::assertFalse(isset($configurator->plugins['PipeTables']));
		self::assertFalse(isset($configurator->plugins['MediaEmbed']));
		self::assertFalse(isset($configurator->BBCodes['hidden']));

		// Add bbcodes here to simulate existing BBCodes
		$configurator->BBCodes->add('pipes');
		$configurator->BBCodes->add('hidden');
		$configurator->BBCodes->add('bbvideo');

		// Dispatch event
		$event_data = ['configurator'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_configure_after', $event);

		// Assert plugins ARE loaded after the event is dispatched
		self::assertTrue(isset($configurator->plugins['PipeTables']));
		self::assertTrue(isset($configurator->plugins['MediaEmbed']));
		self::assertTrue(isset($configurator->BBCodes['hidden']));

		// Un-set bbcodes and plugins and check everything remains unset
		unset($configurator->BBCodes['pipes'], $configurator->plugins['PipeTables']);
		unset($configurator->BBCodes['bbvideo'], $configurator->plugins['MediaEmbed']);
		unset($configurator->BBCodes['hidden']);

		// Dispatch event again
		$event_data = ['configurator'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_configure_after', $event);

		// Assert plugins are NOT loaded when their bbcodes do not exist
		self::assertFalse(isset($configurator->plugins['PipeTables']));
		self::assertFalse(isset($configurator->plugins['MediaEmbed']));
		self::assertFalse(isset($configurator->BBCodes['hidden']));

		// Retry Pipes with the config setting disabled
		$configurator->BBCodes->add('pipes');
		$this->config['abbc3_pipes'] = 0;

		// Dispatch event again
		$event_data = ['configurator'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_configure_after', $event);

		// Assert plugins are NOT loaded when their bbcodes do not exist
		self::assertFalse(isset($configurator->plugins['PipeTables']));
	}
}
