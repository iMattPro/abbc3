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
		global $phpbb_dispatcher;
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		$configurator = new \s9e\TextFormatter\Configurator();
		$this->assertInstanceOf(Configurator::class, $configurator);

		$this->set_listener();

		$dispatcher = new dispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_configure_after', [$this->listener, 'configure_bbcodes']);

		// Assert plugins are NOT loaded before the event is dispatched
		$this->assertFalse(isset($configurator->plugins['PipeTables']));
		$this->assertFalse(isset($configurator->plugins['MediaEmbed']));
		$this->assertFalse(isset($configurator->plugins['AutoVideo']));
		$this->assertFalse(isset($configurator->BBCodes['hidden']));

		// Add bbcodes here to simulate existing BBCodes
		$configurator->BBCodes->add('pipes', []);
		$configurator->BBCodes->add('hidden', []);
		$configurator->BBCodes->add('bbvideo', []);

		// Dispatch event
		$event_data = ['configurator'];
		$dispatcher->trigger_event('core.text_formatter_s9e_configure_after', compact($event_data));

		// Assert plugins ARE loaded after the event is dispatched
		$this->assertTrue(isset($configurator->plugins['PipeTables']));
		$this->assertTrue(isset($configurator->plugins['MediaEmbed']));
		$this->assertTrue(isset($configurator->plugins['Autovideo']));
		$this->assertTrue(isset($configurator->BBCodes['hidden']));

		// Unset bbcodes and plugins and check everything remains unset
		unset(
			$configurator->BBCodes['pipes'],
			$configurator->plugins['PipeTables'],
			$configurator->BBCodes['bbvideo'],
			$configurator->plugins['MediaEmbed'],
			$configurator->BBCodes['hidden'],
			$configurator->plugins['Autovideo']
		);

		$this->config['abbc3_auto_video'] = 0;

		// Dispatch event again
		$dispatcher->trigger_event('core.text_formatter_s9e_configure_after', compact($event_data));

		// Assert plugins are NOT loaded
		$this->assertFalse(isset($configurator->plugins['PipeTables']));
		$this->assertFalse(isset($configurator->plugins['MediaEmbed']));
		$this->assertFalse(isset($configurator->plugins['Autovideo']));
		$this->assertFalse(isset($configurator->BBCodes['hidden']));

		// Retry Pipes with the config setting disabled
		$configurator->BBCodes->add('pipes', []);
		$this->config['abbc3_pipes'] = 0;

		// Dispatch event again
		$dispatcher->trigger_event('core.text_formatter_s9e_configure_after', compact($event_data));

		// Assert plugins are NOT loaded when their bbcodes do not exist
		$this->assertFalse(isset($configurator->plugins['PipeTables']));
	}

	/**
	 * Test the add_render_params method
	 */
	public function test_add_render_params()
	{
		$this->set_listener();

		// Mock the renderer
		$renderer = $this->createMock('\s9e\TextFormatter\Renderer');

		// Mock the renderer wrapper
		$renderer_wrapper = $this->createMock('\phpbb\textformatter\s9e\renderer');
		$renderer_wrapper->expects($this->once())
			->method('get_renderer')
			->willReturn($renderer);

		// Set up user page data
		$this->user->page = ['page' => 'viewtopic.php?f=1&t=1'];

		// Should set parameter on first call
		$renderer->expects($this->once())
			->method('setParameter')
			->with('U_USER_PAGE_ABBC3', rawurlencode($this->user->page['page']));

		$event = new \phpbb\event\data(['renderer' => $renderer_wrapper]);
		$this->listener->add_render_params($event);
	}

	/**
	 * Test add_render_params only executes once
	 */
	public function test_add_render_params_executes_once()
	{
		$this->set_listener();

		// Mock the renderer
		$renderer = $this->createMock('\s9e\TextFormatter\Renderer');

		// Mock the renderer wrapper
		$renderer_wrapper = $this->createMock('\phpbb\textformatter\s9e\renderer');
		$renderer_wrapper->expects($this->once())
			->method('get_renderer')
			->willReturn($renderer);

		// Set up user page data
		$this->user->page = ['page' => 'viewtopic.php?f=1&t=1'];

		// Should only set parameter once despite multiple calls
		$renderer->expects($this->once())
			->method('setParameter')
			->with('U_USER_PAGE_ABBC3', rawurlencode($this->user->page['page']));

		$event = new \phpbb\event\data(['renderer' => $renderer_wrapper]);

		// Call multiple times
		$this->listener->add_render_params($event);
		$this->listener->add_render_params($event);
		$this->listener->add_render_params($event);
	}
}
