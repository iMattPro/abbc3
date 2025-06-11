<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\core;

class acp_max_bbcode_order_test extends acp_base
{
	public function test_get_max_bbcode_order()
	{
		$acp_manager = $this->get_acp_manager();

		$this->assertEquals(5, $acp_manager->get_max_bbcode_order());
	}
}
