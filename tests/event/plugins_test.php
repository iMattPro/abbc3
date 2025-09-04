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

use phpbb\event\dispatcher;
use s9e\TextFormatter\Configurator;

class plugins_test extends listener_base
{
	/**
	 * Test textformatter plugins are being loaded
	 */
	public function test_display_custom_bbcodes()
	{
		$configurator = new \s9e\TextFormatter\Configurator();
		$this->assertInstanceOf(Configurator::class, $configurator);

		$this->set_listener();

		$dispatcher = new dispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_configure_after', [$this->listener, 'configure_bbcodes']);

		// Assert plugins are NOT loaded before the event is dispatched
		$this->assertFalse(isset($configurator->plugins['PipeTables']));
		$this->assertFalse(isset($configurator->plugins['MediaEmbed']));
		$this->assertFalse(isset($configurator->plugins['AutoVideo']));

		// Add bbcodes here to simulate existing BBCodes
		$configurator->BBCodes->add('pipes', []);
		$configurator->BBCodes->add('bbvideo', []);

		// Dispatch event
		$event_data = ['configurator'];
		$dispatcher->trigger_event('core.text_formatter_s9e_configure_after', compact($event_data));

		// Assert plugins ARE loaded after the event is dispatched
		$this->assertTrue(isset($configurator->plugins['PipeTables']));
		$this->assertTrue(isset($configurator->plugins['MediaEmbed']));
		$this->assertTrue(isset($configurator->plugins['Autovideo']));

		// Unset bbcodes and plugins and check everything remains unset
		unset(
			$configurator->BBCodes['pipes'],
			$configurator->plugins['PipeTables'],
			$configurator->BBCodes['bbvideo'],
			$configurator->plugins['MediaEmbed'],
			$configurator->plugins['Autovideo']
		);

		$this->config['abbc3_auto_video'] = 0;

		// Dispatch event again
		$dispatcher->trigger_event('core.text_formatter_s9e_configure_after', compact($event_data));

		// Assert plugins are NOT loaded
		$this->assertFalse(isset($configurator->plugins['PipeTables']));
		$this->assertFalse(isset($configurator->plugins['MediaEmbed']));
		$this->assertFalse(isset($configurator->plugins['Autovideo']));

		// Retry Pipes with the config setting disabled
		$configurator->BBCodes->add('pipes', []);
		$this->config['abbc3_pipes'] = 0;

		// Dispatch event again
		$dispatcher->trigger_event('core.text_formatter_s9e_configure_after', compact($event_data));

		// Assert plugins are NOT loaded when their bbcodes do not exist
		$this->assertFalse(isset($configurator->plugins['PipeTables']));
	}

	/**
	 * Test set_hidden_bbcode_params method
	 */
	public function test_set_hidden_bbcode_params()
	{
		$this->set_listener();

		// Set user as anonymous
		$this->user->data['user_id'] = ANONYMOUS;
		$this->user->page = ['page' => 'test_page'];

		$renderer_mock = $this->createMock('\\phpbb\\textformatter\\s9e\\renderer');

		$expected_urls = [
			'U_LOGIN' => append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=login&redirect=' . rawurlencode('test_page')),
			'U_REGISTER' => append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=register'),
		];

		$this->bbcodes_display->expects(self::once())
			->method('set_renderer_params')
			->with($renderer_mock, $expected_urls);

		$event_data = ['renderer' => $renderer_mock];
		$event = new \phpbb\event\data($event_data);

		$this->listener->set_hidden_bbcode_params($event);
	}

	/**
	 * Test set_hidden_bbcode_params skips for logged-in users
	 */
	public function test_set_hidden_bbcode_params_logged_in_user()
	{
		$this->set_listener();

		// Set the user as logged in (not anonymous)
		$this->user->data['user_id'] = 2;

		$renderer_mock = $this->createMock('\\phpbb\\textformatter\\s9e\\renderer');

		$this->bbcodes_display->expects(self::never())
			->method('set_renderer_params');

		$event_data = ['renderer' => $renderer_mock];
		$event = new \phpbb\event\data($event_data);

		$this->listener->set_hidden_bbcode_params($event);
	}
}
