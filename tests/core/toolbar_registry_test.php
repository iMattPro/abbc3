<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use vse\abbc3\core\toolbar_registry;
use vse\abbc3\core\toolbar_repository;

class toolbar_registry_test extends \phpbb_test_case
{
	/**
	 * Verify that the saved layout combines core and custom buttons.
	 */
	public function test_layout_combines_core_and_custom_buttons()
	{
		$repository = $this->createMock(toolbar_repository::class);
		$repository->method('get_layout')->willReturn([
			'core:bold' => ['button_key' => 'core:bold', 'placement' => 'primary', 'sort_order' => 1, 'icon' => 'bold', 'font_icon' => 'bold'],
			'bbcode:spoil' => ['button_key' => 'bbcode:spoil', 'placement' => 'more', 'sort_order' => 1, 'icon' => 'spoil', 'font_icon' => ''],
			'action:plain' => ['button_key' => 'action:plain', 'placement' => 'hidden', 'sort_order' => 1, 'icon' => 'plain', 'font_icon' => ''],
		]);

		$registry = new toolbar_registry($repository);
		$registry->add_custom([
			'type' => 'button',
			'name' => 'spoil',
			'tag' => 'spoil',
			'label' => 'Spoiler',
			'open' => '[spoil]',
			'close' => '[/spoil]',
		]);
		$buttons = $registry->get_buttons();

		self::assertSame('bold', $buttons['primary'][0]['name']);
		self::assertSame('bold', $buttons['primary'][0]['font_icon']);
		self::assertSame('spoil', $buttons['more'][0]['name']);
		self::assertSame('plain', $buttons['hidden'][0]['name']);
	}
}
