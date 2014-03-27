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
	/**
	* Get an instance of phpbb\user
	*
	* @access public
	*/
	public function get_user_instance()
	{
		// Must do this for testing with the user class
		global $config;
		$config['default_lang'] = 'en';

		// Get instance of phpbb\user (dataProvider is called before setUp(), so this must be done here)
		$this->user = new \phpbb\user();

		$this->user->add_lang('common');
	}

	public function setUp()
	{
		parent::setUp();

		$this->get_user_instance();
	}

	public function bbcode_group_select_data()
	{
		$this->get_user_instance();

		return array(
			array(
				array(''),
				'<option value="5">' . $this->user->lang('G_ADMINISTRATORS') . 
				'</option><option value="4">' . $this->user->lang('G_GLOBAL_MODERATORS') . 
				'</option><option value="1">' . $this->user->lang('G_GUESTS') . 
				'</option><option value="2">' . $this->user->lang('G_REGISTERED') . 
				'</option><option value="3">' . $this->user->lang('G_REGISTERED_COPPA') . 
				'</option>'
			),
			array(
				array(1),
				'<option value="5">' . $this->user->lang('G_ADMINISTRATORS') . 
				'</option><option value="4">' . $this->user->lang('G_GLOBAL_MODERATORS') . 
				'</option><option value="1" selected="selected">' . $this->user->lang('G_GUESTS') . 
				'</option><option value="2">' . $this->user->lang('G_REGISTERED') . 
				'</option><option value="3">' . $this->user->lang('G_REGISTERED_COPPA') . 
				'</option>'
			),
			array(
				array(2,3),
				'<option value="5">' . $this->user->lang('G_ADMINISTRATORS') . 
				'</option><option value="4">' . $this->user->lang('G_GLOBAL_MODERATORS') . 
				'</option><option value="1">' . $this->user->lang('G_GUESTS') . 
				'</option><option value="2" selected="selected">' . $this->user->lang('G_REGISTERED') . 
				'</option><option value="3" selected="selected">' . $this->user->lang('G_REGISTERED_COPPA') . 
				'</option>'
			),
			array(
				array(4,5,6),
				'<option value="5" selected="selected">' . $this->user->lang('G_ADMINISTRATORS') . 
				'</option><option value="4" selected="selected">' . $this->user->lang('G_GLOBAL_MODERATORS') . 
				'</option><option value="1">' . $this->user->lang('G_GUESTS') . 
				'</option><option value="2">' . $this->user->lang('G_REGISTERED') . 
				'</option><option value="3">' . $this->user->lang('G_REGISTERED_COPPA') . 
				'</option>'
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
