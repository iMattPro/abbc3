<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class acp_bbcodes_custom_sorting_buttons_test extends acp_listener_base
{
	/**
	 * Data set for test_acp_bbcodes_custom_sorting_buttons
	 *
	 * @return array Test data
	 */
	public function acp_bbcodes_custom_sorting_buttons_data()
	{
		return [
			[
				[],
				[],
				[
					'U_MOVE_UP'		=> '&amp;action=move_up&amp;id=&amp;hash=' . generate_link_hash('move_up'),
					'U_MOVE_DOWN'	=> '&amp;action=move_down&amp;id=&amp;hash=' . generate_link_hash('move_down'),
				],
			],
			[
				[
					'bbcode_id'		=> 13,
					'bbcode_tag'	=> 'center',
				],
				[
					'BBCODE_TAG'	=> 'center',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=13',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=13',
				],
				[
					'BBCODE_TAG'	=> 'center',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=13',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=13',
					'U_MOVE_UP'		=> '&amp;action=move_up&amp;id=13&amp;hash=' . generate_link_hash('move_up13'),
					'U_MOVE_DOWN'	=> '&amp;action=move_down&amp;id=13&amp;hash=' . generate_link_hash('move_down13'),
				],
			],
			[
				[
					'bbcode_id'		=> 14,
					'bbcode_tag'	=> 'foobar',
				],
				[
					'BBCODE_TAG'	=> 'foobar',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=14',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=14',
				],
				[
					'BBCODE_TAG'	=> 'foobar',
					'U_EDIT'		=> '&amp;action=edit&amp;bbcode=14',
					'U_DELETE'		=> '&amp;action=delete&amp;bbcode=14',
					'U_MOVE_UP'		=> '&amp;action=move_up&amp;id=14&amp;hash=' . generate_link_hash('move_up14'),
					'U_MOVE_DOWN'	=> '&amp;action=move_down&amp;id=14&amp;hash=' . generate_link_hash('move_down14'),
				],
			],
		];
	}

	/**
	 * Test the acp_bbcodes_custom_sorting_buttons is updating
	 * the bbcodes_array event with the expected data.
	 *
	 * @dataProvider acp_bbcodes_custom_sorting_buttons_data
	 */
	public function test_acp_bbcodes_custom_sorting_buttons($row, $bbcodes_array, $expected)
	{
		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.acp_bbcodes_display_bbcodes', [$this->listener, 'acp_bbcodes_custom_sorting_buttons']);

		$event_data = ['row', 'bbcodes_array', 'u_action'];
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.acp_bbcodes_display_bbcodes', $event);

		$event_data_returned = $event->get_data_filtered($event_data);
		$bbcodes_array = $event_data_returned['bbcodes_array'];

		self::assertEquals($expected, $bbcodes_array);
	}
}
