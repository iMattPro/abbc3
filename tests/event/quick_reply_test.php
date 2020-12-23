<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2020 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class quick_reply_test extends \vse\abbc3\tests\event\listener_base
{
	public function set_quick_reply_data()
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

		$this->bbcodes_display->expects($enabled ? self::once() : self::never())
			->method('bbcode_statuses')
			->with($forum_id)
			->willReturn([]);

		$this->user->expects($enabled ? self::once() : self::never())
			->method('add_lang')
			->with('posting');

		$this->template->expects($enabled ? self::once() : self::never())
			->method('assign_var')
			->with('S_ABBC3_QUICKREPLY', true);

		$this->listener->set_quick_reply();
		$this->listener->add_to_quickreply(['forum_id' => $forum_id]);
	}
}
