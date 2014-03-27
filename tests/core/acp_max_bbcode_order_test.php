<?php
/**
*
* @package Advanced BBCode Box 3.1 testing
* @copyright (c) 2014 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\tests\core;

class acp_max_bbcode_order_test extends acp_base
{
	public function test_get_max_bbcode_order()
	{
		$acp_manager = $this->acp_manager();
		
		$this->assertEquals(5, $acp_manager->get_max_bbcode_order());
	}
}
