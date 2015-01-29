<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

require_once dirname(__FILE__) . '/../../../../../includes/functions.php';

class acp_listener_test extends \phpbb_test_case
{
	/** @var \vse\abbc3\event\listener */
	protected $listener;

	protected function set_listener()
	{
		global $phpbb_root_path;

		$acp_manager = $this->getMockBuilder('\vse\abbc3\core\acp_manager')
			->disableOriginalConstructor()
			->getMock();

		$this->listener = new \vse\abbc3\event\acp_listener($acp_manager, $phpbb_root_path);
	}

	public function test_construct()
	{
		$this->set_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

	public function test_getSubscribedEvents()
	{
		$this->assertEquals(array(
			'core.acp_bbcodes_display_form',
			'core.acp_bbcodes_display_bbcodes',
			'core.acp_bbcodes_modify_create',
			'core.acp_bbcodes_edit_add',
		), array_keys(\vse\abbc3\event\acp_listener::getSubscribedEvents()));
	}

	public function acp_bbcodes_custom_sorting_buttons_data()
	{
		return array(
			array(
				array(),
				array(),
				array(
					'U_MOVE_UP'		=> '&amp;action=move_up&amp;id=&amp;hash=' . generate_link_hash('move_up'),
					'U_MOVE_DOWN'	=> '&amp;action=move_down&amp;id=&amp;hash=' . generate_link_hash('move_down'),
				),
			),
			array(
				array(
					'bbcode_id'		=> 13,
					'bbcode_tag'	=> 'center',
				),
				array(
					'BBCODE_TAG'	=> 'center',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=13',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=13',
				),
				array(
					'BBCODE_TAG'	=> 'center',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=13',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=13',
					'U_MOVE_UP'		=> '&amp;action=move_up&amp;id=13&amp;hash=' . generate_link_hash('move_up13'),
					'U_MOVE_DOWN'	=> '&amp;action=move_down&amp;id=13&amp;hash=' . generate_link_hash('move_down13'),
				),
			),
			array(
				array(
					'bbcode_id'		=> 14,
					'bbcode_tag'	=> 'foobar',
				),
				array(
					'BBCODE_TAG'	=> 'foobar',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=14',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=14',
				),
				array(
					'BBCODE_TAG'	=> 'foobar',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=14',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=14',
					'U_MOVE_UP'		=> '&amp;action=move_up&amp;id=14&amp;hash=' . generate_link_hash('move_up14'),
					'U_MOVE_DOWN'	=> '&amp;action=move_down&amp;id=14&amp;hash=' . generate_link_hash('move_down14'),
				),
			),
		);
	}

	/**
	* @dataProvider acp_bbcodes_custom_sorting_buttons_data
	*/
	public function test_acp_bbcodes_custom_sorting_buttons($row, $bbcodes_array, $expected)
	{
		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.acp_bbcodes_display_bbcodes', array($this->listener, 'acp_bbcodes_custom_sorting_buttons'));

		$event_data = array('row', 'bbcodes_array', 'u_action');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.acp_bbcodes_display_bbcodes', $event);

		$event_data_returned = $event->get_data_filtered($event_data);
		$bbcodes_array = $event_data_returned['bbcodes_array'];

		$this->assertEquals($expected, $bbcodes_array);
	}
}
