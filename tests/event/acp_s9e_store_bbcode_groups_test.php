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

class acp_s9e_store_bbcode_groups_test extends acp_listener_base
{
	public function test_s9e_store_bbcode_groups()
	{
		$test_data = [
			'FOO' => '',
			'BAR' => '1,2,3',
		];

		$this->set_listener();

		$this->acp_manager->expects($this->once())
			->method('get_bbcode_groups_data')
			->willReturn($test_data);

		$configurator = new Configurator();

		$dispatcher = new dispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_configure_after', [$this->listener, 's9e_store_bbcode_groups']);

		$event_data = ['configurator'];
		$dispatcher->trigger_event('core.text_formatter_s9e_configure_after', compact($event_data));

		$this->assertSame($test_data, $configurator->registeredVars['abbc3.bbcode_groups']);
	}
}
