<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use vse\abbc3\core\toolbar_repository;

class toolbar_repository_test extends acp_base
{
	/** @var toolbar_repository */
	protected $repository;

	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = new toolbar_repository($this->db, 'phpbb_');
	}

	public function test_sync_bbcode_renames_row_removes_duplicate_and_preserves_icon()
	{
		$this->insert_button('bbcode:font', 13, 'primary', 1, 'custom-font');
		$this->insert_button('bbcode:legacy-font', 13, 'more', 2, 'legacy-font');

		$this->repository->sync_bbcode(13, 'renamed=', true);

		$rows = $this->get_toolbar_rows(13);
		self::assertCount(1, $rows);
		self::assertSame('bbcode:renamed', $rows[0]['button_key']);
		self::assertSame('primary', $rows[0]['placement']);
		self::assertSame('custom-font', $rows[0]['icon']);
	}

	public function test_sync_bbcode_tracks_disabled_and_reenabled_state()
	{
		$this->insert_button('bbcode:highlight', 14, 'primary', 1, 'highlight');

		$this->repository->sync_bbcode(14, 'highlight=', false);
		self::assertSame('hidden', $this->get_toolbar_rows(14)[0]['placement']);

		$this->repository->sync_bbcode(14, 'highlight=', true);
		self::assertSame('more', $this->get_toolbar_rows(14)[0]['placement']);
	}

	public function test_save_layout_only_changes_registered_bbcodes_and_honors_features()
	{
		$this->insert_button('bbcode:font', 13, 'primary', 1, 'font');
		$this->insert_button('bbcode:highlight', 14, 'more', 1, 'highlight');

		$this->repository->save_layout([
			'primary' => ['bbcode:font'],
			'more' => ['bbcode:highlight'],
			'hidden' => [],
		], [], [], ['highlight' => false]);

		self::assertSame(1, (int) $this->get_display_state(13));
		self::assertSame(0, (int) $this->get_display_state(14));
		self::assertSame(1, (int) $this->get_display_state(15));
		self::assertSame('more', $this->get_toolbar_rows(14)[0]['placement']);

		$this->repository->reconcile_visibility(['highlight' => false]);
		self::assertSame('more', $this->get_toolbar_rows(14)[0]['placement']);

		$this->repository->sync_visibility(['highlight' => true]);
		self::assertSame(1, (int) $this->get_display_state(14));
		self::assertSame('more', $this->get_toolbar_rows(14)[0]['placement']);
	}

	public function test_save_layout_supports_font_image_and_text_icon_fallbacks()
	{
		$this->insert_button('bbcode:highlight', 14, 'more', 1, 'highlight');
		$placements = ['primary' => [], 'more' => ['bbcode:highlight'], 'hidden' => []];

		$this->repository->save_layout($placements, ['bbcode:highlight' => ''], ['bbcode:highlight' => 'fa-star']);
		$row = $this->get_toolbar_rows(14)[0];
		self::assertSame('', $row['icon']);
		self::assertSame('star', $row['font_icon']);

		$this->repository->save_layout($placements, ['bbcode:highlight' => 'highlight'], ['bbcode:highlight' => '']);
		$row = $this->get_toolbar_rows(14)[0];
		self::assertSame('highlight', $row['icon']);
		self::assertSame('', $row['font_icon']);
	}

	public function test_editor_reads_layout_and_groups_once_without_synchronizing()
	{
		$this->insert_button('bbcode:font', 13, 'hidden', 1, 'font');
		$display = $this->getMockBuilder('\vse\abbc3\core\bbcodes_display')
			->setConstructorArgs([
				$this->createMock('\phpbb\auth\auth'),
				new \phpbb\config\config([]),
				$this->db,
				$this->createMock('\phpbb\extension\manager'),
				$this->user,
				'',
				$this->repository,
			])
			->onlyMethods(['get_icons'])
			->getMock();
		$display->method('get_icons')->willReturn([]);

		$before = $this->db->sql_num_queries();
		$display->display_custom_bbcodes([], ['bbcode_id' => 13, 'bbcode_tag' => 'font=']);
		$single = $display->display_custom_bbcodes([], ['bbcode_id' => 14, 'bbcode_tag' => 'line', 'bbcode_match' => '[line]']);
		self::assertSame('', $single['ABBC3_CLOSE']);
		self::assertSame('hidden', $this->repository->get_layout()['bbcode:font']['placement']);
		self::assertSame([1], $this->repository->get_all_group_rules()['align=']);
		self::assertSame([1], $this->repository->get_group_ids(15));
		self::assertCount(1, $this->repository->get_layout());
		self::assertSame($before + 2, $this->db->sql_num_queries());

		$this->repository->set_group_ids(15, [2]);
		self::assertSame([2], $this->repository->get_group_ids(15));
	}

	public function test_toolbar_migration_retries_keep_existing_rows_and_deduplicate_groups()
	{
		global $phpbb_root_path, $phpEx;
		$this->insert_button('bbcode:font', 13, 'hidden', 3, 'admin-icon');
		$tools = (new \phpbb\db\tools\factory())->get($this->db);
		$migration = new \vse\abbc3\migrations\v3312_m21_toolbar(
			new \phpbb\config\config([]),
			$this->db,
			$tools,
			$phpbb_root_path,
			$phpEx,
			'phpbb_'
		);

		$tools->sql_column_add(BBCODES_TABLE, 'bbcode_order', ['UINT', 0]);
		$tools->sql_column_add(BBCODES_TABLE, 'bbcode_group', ['VCHAR:255', '']);
		try
		{
			$this->db->sql_query("UPDATE phpbb_bbcodes SET bbcode_group = '1,1,2,0,-1' WHERE bbcode_id = 15");
			$migration->migrate_toolbar();
			$migration->migrate_groups();
			$migration->migrate_toolbar();
			$migration->migrate_groups();
		}
		finally
		{
			$tools->sql_column_remove(BBCODES_TABLE, 'bbcode_group');
			$tools->sql_column_remove(BBCODES_TABLE, 'bbcode_order');
		}

		self::assertCount(19, $this->repository->get_layout());
		self::assertSame('admin-icon', $this->repository->get_layout()['bbcode:font']['icon']);
		self::assertSame('hidden', $this->repository->get_layout()['bbcode:font']['placement']);
		self::assertSame([1, 2], $this->repository->get_group_ids(15));
	}

	protected function insert_button($key, $bbcode_id, $placement, $order, $icon)
	{
		$row = [
			'button_key' => $key,
			'button_type' => 'bbcode',
			'bbcode_id' => $bbcode_id,
			'placement' => $placement,
			'sort_order' => $order,
			'icon' => $icon,
			'font_icon' => '',
		];
		$this->db->sql_query('INSERT INTO phpbb_abbc3_toolbar ' . $this->db->sql_build_array('INSERT', $row));
	}

	protected function get_toolbar_rows($bbcode_id)
	{
		$result = $this->db->sql_query('SELECT * FROM phpbb_abbc3_toolbar WHERE bbcode_id = ' . (int) $bbcode_id . ' ORDER BY button_key');
		$rows = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$rows[] = $row;
		}
		$this->db->sql_freeresult($result);
		return $rows;
	}

	protected function get_display_state($bbcode_id)
	{
		$result = $this->db->sql_query('SELECT display_on_posting FROM phpbb_bbcodes WHERE bbcode_id = ' . (int) $bbcode_id);
		$state = $this->db->sql_fetchfield('display_on_posting');
		$this->db->sql_freeresult($result);
		return $state;
	}
}
