<?php
/**
*
* @package Advanced BBCode Box 3.1 testing
* @copyright (c) 2014 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\tests\core;

class acp_bbcode_group_select_test extends acp_base
{
	public static function bbcode_group_select_data()
	{
		return array(
			array(
				array(''),
				'<option value="5">' . ucfirst(strtolower('G_ADMINISTRATORS')) . '</option><option value="4">' . ucfirst(strtolower('G_GLOBAL_MODERATORS')) . '</option><option value="1">' . ucfirst(strtolower('G_GUESTS')) . '</option><option value="2">' . ucfirst(strtolower('G_REGISTERED')) . '</option><option value="3">' . ucfirst(strtolower('G_REGISTERED_COPPA')) . '</option>'
			),
			array(
				array(1),
				'<option value="5">' . ucfirst(strtolower('G_ADMINISTRATORS')) . '</option><option value="4">' . ucfirst(strtolower('G_GLOBAL_MODERATORS')) . '</option><option value="1" selected="selected">' . ucfirst(strtolower('G_GUESTS')) . '</option><option value="2">' . ucfirst(strtolower('G_REGISTERED')) . '</option><option value="3">' . ucfirst(strtolower('G_REGISTERED_COPPA')) . '</option>'
			),
			array(
				array(2,3),
				'<option value="5">' . ucfirst(strtolower('G_ADMINISTRATORS')) . '</option><option value="4">' . ucfirst(strtolower('G_GLOBAL_MODERATORS')) . '</option><option value="1">' . ucfirst(strtolower('G_GUESTS')) . '</option><option value="2" selected="selected">' . ucfirst(strtolower('G_REGISTERED')) . '</option><option value="3" selected="selected">' . ucfirst(strtolower('G_REGISTERED_COPPA')) . '</option>'
			),
			array(
				array(4,5,6),
				'<option value="5" selected="selected">' . ucfirst(strtolower('G_ADMINISTRATORS')) . '</option><option value="4" selected="selected">' . ucfirst(strtolower('G_GLOBAL_MODERATORS')) . '</option><option value="1">' . ucfirst(strtolower('G_GUESTS')) . '</option><option value="2">' . ucfirst(strtolower('G_REGISTERED')) . '</option><option value="3">' . ucfirst(strtolower('G_REGISTERED_COPPA')) . '</option>'
			),
		);
	}

	/**
	* @dataProvider bbcode_group_select_data
	*/
	public function test_bbcode_group_select_options($data, $expected)
	{
		$acp_manager = $this->acp_manager();

		$this->assertEquals($expected, $acp_manager->bbcode_group_select_options($data));
	}
}
