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

use phpbb\event\data;

class quick_reply_test extends \vse\abbc3\tests\event\listener_base
{
	public function set_quick_reply_data(): array
	{
		return [
			[1, 2],
			[0, 2],
		];
	}

	/**
	 * @dataProvider set_quick_reply_data
	 */
	public function test_set_quick_reply($enabled, $forum_id)
	{
		$this->set_listener();

		$this->config['abbc3_qr_bbcodes'] = $enabled;

		$this->bbcodes_display->expects($enabled ? $this->once() : self::never())
			->method('bbcode_statuses')
			->with($forum_id)
			->willReturn([]);

		$this->template->expects($enabled ? $this->once() : self::never())
			->method('assign_var')
			->with('S_ABBC3_QUICKREPLY', true);

		$event_data = ['forum_id'];
		$event = new data(compact($event_data));

		$this->listener->set_quick_reply();
		$this->listener->add_to_quickreply($event);
	}
}
