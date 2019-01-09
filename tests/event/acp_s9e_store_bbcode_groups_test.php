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

class acp_s9e_store_bbcode_groups_test extends acp_listener_base
{
	public function test_s9e_store_bbcode_groups()
	{
		$test_data = array(
			'FOO' => '',
			'BAR' => '1,2,3',
		);

		$this->set_listener();

		$this->acp_manager->expects($this->once())
			->method('get_bbcode_groups_data')
			->willReturn($test_data);

		$configurator = new \s9e\TextFormatter\Configurator();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.text_formatter_s9e_configure_after', array($this->listener, 's9e_store_bbcode_groups'));

		$event_data = array('configurator');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.text_formatter_s9e_configure_after', $event);

		$this->assertSame($test_data, $configurator->registeredVars['abbc3.bbcode_groups']);
	}
}
