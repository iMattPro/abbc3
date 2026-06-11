<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

use vse\abbc3\core\acp_manager;

class acp_bbcode_drag_drop_test extends acp_base
{
	protected function setUp(): void
	{
		parent::setUp();

		$this->lang->add_lang('abbc3', 'vse/abbc3');
	}

	public function bbcode_drag_drop_data()
	{
		return [
			[
				[1 => 17, 20 => 16, 30 => 15, 40 => 14, 50 => 13],
				[1 => 17, 2 => 16, 3 => 15, 4 => 14, 5 => 13],
				true,
				'ABBC3_BBCODE_ORDERED',
			],
			[
				[1 => 999],
				[1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17],
				false,
				'ABBC3_BBCODE_ORDER_NO_ORDER',
			],
		];
	}

	/**
	 * @dataProvider bbcode_drag_drop_data
	 */
	public function test_bbcode_drag_drop($bbcodes, $expected, $success, $message)
	{
		$this->request->expects(self::once())
			->method('is_ajax')
			->willReturn(true)
		;

		$this->request->expects(self::exactly(2))
			->method('variable')
			->with(self::anything())
			->willReturnMap([
				['table_name', '', false, \phpbb\request\request_interface::REQUEST, 'drag_drop'],
				['drag_drop', [0 => ''], false, \phpbb\request\request_interface::REQUEST, $bbcodes],
			])
		;

		$acp_manager = $this->get_acp_manager_with_response_capture();

		self::assertNull($acp_manager->move_drag());
		self::assertSame([
			'success'	=> $success,
			'message'	=> $message,
		], $acp_manager->json_response);

		self::assertSame($expected, $this->get_bbcode_order());
	}

	public function bbcode_drag_drop_guard_data()
	{
		return [
			[
				[
					['table_name', '', false, \phpbb\request\request_interface::REQUEST, ''],
				],
				'ABBC3_BBCODE_ORDER_NO_TABLE',
			],
			[
				[
					['table_name', '', false, \phpbb\request\request_interface::REQUEST, 'drag_drop'],
					['drag_drop', [0 => ''], false, \phpbb\request\request_interface::REQUEST, [0 => '']],
				],
				'ABBC3_BBCODE_ORDER_NO_DATA',
			],
		];
	}

	/**
	 * @dataProvider bbcode_drag_drop_guard_data
	 */
	public function test_bbcode_drag_drop_guards($return_map, $message)
	{
		$this->request->expects(self::once())
			->method('is_ajax')
			->willReturn(true)
		;

		$this->request->expects(self::exactly(count($return_map)))
			->method('variable')
			->with(self::anything())
			->willReturnMap($return_map)
		;

		$acp_manager = $this->get_acp_manager_with_response_capture();

		self::assertNull($acp_manager->move_drag());
		self::assertSame([
			'success'	=> false,
			'message'	=> $message,
		], $acp_manager->json_response);
		self::assertSame([1 => 13, 2 => 14, 3 => 15, 4 => 16, 5 => 17], $this->get_bbcode_order());
	}

	public function test_bbcode_drag_drop_fails()
	{
		$this->request->expects(self::once())
			->method('is_ajax')
			->willReturn(false);

		// Check request->variable is not called
		$this->request->expects(self::never())
			->method('variable');

		$acp_manager = $this->get_acp_manager_with_response_capture();

		self::assertNull($acp_manager->move_drag());
		self::assertNull($acp_manager->json_response);
	}

	protected function get_acp_manager_with_response_capture()
	{
		return new class($this->db, $this->group_helper, $this->lang, $this->request) extends acp_manager {
			public $json_response;

			protected function send_json_response($content, $message = '')
			{
				$this->json_response = [
					'success'	=> (bool) $content,
					'message'	=> $message,
				];
			}
		};
	}

	protected function get_bbcode_order()
	{
		$sql = 'SELECT bbcode_id, bbcode_order
			FROM phpbb_bbcodes
			ORDER BY bbcode_order';
		$result = $this->db->sql_query($sql);

		$bbcode_order = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bbcode_order[(int) $row['bbcode_order']] = (int) $row['bbcode_id'];
		}
		$this->db->sql_freeresult($result);

		return $bbcode_order;
	}
}
