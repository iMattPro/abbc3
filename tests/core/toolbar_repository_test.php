<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use vse\abbc3\core\toolbar_repository;
use vse\abbc3\core\toolbar_registry;

class toolbar_repository_test extends acp_base
{
	/** @var toolbar_repository */
	protected $repository;

	/**
	 * {@inheritdoc}
	 */
	protected function setUp(): void
	{
		parent::setUp();
		$this->repository = new toolbar_repository($this->db, 'phpbb_');
	}

	/**
	 * Verify that a BBCode rename consolidates its entries and retains its icon.
	 */
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

	/**
	 * Verify that posting visibility moves a button between Hidden and More.
	 */
	public function test_sync_bbcode_tracks_disabled_and_reenabled_state()
	{
		$this->insert_button('bbcode:highlight', 14, 'primary', 1, 'highlight');

		$this->repository->sync_bbcode(14, 'highlight=', false);
		self::assertSame('hidden', $this->get_toolbar_rows(14)[0]['placement']);

		$this->repository->sync_bbcode(14, 'highlight=', true);
		self::assertSame('more', $this->get_toolbar_rows(14)[0]['placement']);
	}

	/**
	 * Verify that toolbar visibility honors feature settings and leaves unregistered BBCodes alone.
	 */
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

	/**
	 * Verify that the layout stores font, image, and text icon choices.
	 */
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

	public function test_save_layout_replaces_ordered_dividers_in_visible_placements()
	{
		$this->insert_button('bbcode:font', 13, 'primary', 1, 'font');
		$this->insert_button('bbcode:highlight', 14, 'primary', 2, 'highlight');
		$placements = [
			'primary' => ['bbcode:font', 'separator', 'separator', 'bbcode:highlight'],
			'more' => ['separator'],
			'hidden' => ['separator'],
		];

		$this->repository->save_layout($placements, ['separator' => 'star'], []);
		$this->repository->save_layout($placements, [], []);
		$repository = new toolbar_repository($this->db, 'phpbb_');
		$registry = new toolbar_registry($repository);
		$layout = $registry->get_admin_buttons();
		self::assertSame(['bbcode', 'separator', 'separator', 'bbcode'], array_column($layout['primary'], 'type'));
		self::assertSame(['separator'], array_column($layout['more'], 'type'));
		self::assertSame([], $layout['hidden']);
		self::assertSame('', $layout['primary'][1]['icon']);
		self::assertSame(['separator', 'separator'], array_column($registry->get_editor_buttons()['primary'], 'type'));
		self::assertSame(1, (int) $this->get_display_state(13));
		self::assertSame(1, (int) $this->get_display_state(14));

		$repository->save_layout([
			'primary' => ['bbcode:font'],
			'more' => ['bbcode:highlight', 'separator'],
		], [], []);
		$layout = $registry->get_admin_buttons();
		self::assertSame(['bbcode'], array_column($layout['primary'], 'type'));
		self::assertSame(['bbcode', 'separator'], array_column($layout['more'], 'type'));

		$repository->save_layout(['primary' => ['bbcode:font', 'bbcode:highlight']], [], []);
		self::assertSame(['bbcode', 'bbcode'], array_column($registry->get_admin_buttons()['primary'], 'type'));
		self::assertSame([], $registry->get_admin_buttons()['more']);
	}

	/**
	 * Verify that editor rendering reuses layout and group reads without writing toolbar entries.
	 */
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
			->setMethods(['get_icons'])
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

	/**
	 * Verify that migration retries retain existing toolbar entries and avoid duplicate group assignments.
	 */
	public function test_toolbar_migration_retries_keep_existing_rows_and_deduplicate_groups()
	{
		global $phpbb_root_path, $phpEx;
		$this->insert_button('bbcode:font', 13, 'hidden', 3, 'admin-icon');
		$tools = (new \phpbb\db\tools\factory())->get($this->db);
		$migration = new \vse\abbc3\migrations\v340_m21_toolbar(
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

	public function layout_inputs()
	{
		return [
			'duplicates and unknown entries' => [['bbcode:font', 'unknown', 'bbcode:font'], ['bbcode:font', 'bbcode:highlight'], 'new_icon', ' FA-Star ', 'new_icon', 'star', 'more'],
			'invalid icons and omitted button' => [['bbcode:font'], [], '../font', 'fa-<star>', 'font', '', 'hidden'],
			'clear icons explicitly' => [['bbcode:font'], [], '', '', '', '', 'hidden'],
		];
	}

	/**
	 * @dataProvider layout_inputs
	 */
	public function test_layout_normalizes_submitted_entries($primary, $more, $icon, $font_icon, $expected_icon, $expected_font, $highlight_placement)
	{
		$this->insert_button('bbcode:font', 13, 'hidden', 4, 'font');
		$this->insert_button('bbcode:highlight', 14, 'primary', 2, 'highlight');
		$this->repository->save_layout(['primary' => $primary, 'more' => $more], ['bbcode:font' => $icon], ['bbcode:font' => $font_icon]);

		$font = $this->get_toolbar_rows(13)[0];
		self::assertSame('primary', $font['placement']);
		self::assertSame(1, (int) $font['sort_order']);
		self::assertSame($expected_icon, $font['icon']);
		self::assertSame($expected_font, $font['font_icon']);
		self::assertSame($highlight_placement, $this->get_toolbar_rows(14)[0]['placement']);
		self::assertCount(2, $this->repository->get_layout());
	}

	public function test_reconciliation_preserves_key_owner_and_adds_missing_button()
	{
		$this->insert_button('bbcode:font', 14, 'more', 1, 'existing');
		$this->db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET display_on_posting = 1 WHERE bbcode_id IN (13, 14, 15)');
		$this->repository->reconcile_visibility([]);
		self::assertSame([], $this->get_toolbar_rows(13));
		self::assertSame('existing', $this->get_toolbar_rows(14)[0]['icon']);
		self::assertSame('bbcode:align', $this->get_toolbar_rows(15)[0]['button_key']);
		self::assertSame('more', $this->get_toolbar_rows(15)[0]['placement']);

		$this->repository->sync_bbcode(15, 'ALIGN=', true);
		self::assertCount(1, $this->get_toolbar_rows(15));
	}

	public function test_group_replacement_and_removal_refresh_cached_rules()
	{
		$this->insert_button('bbcode:align', 15, 'more', 1, 'align');
		self::assertSame([1], $this->repository->get_group_ids(15));
		$this->repository->set_group_ids(15, [2, '2', 0, 'invalid', 3]);
		self::assertSame([2, 3], $this->repository->get_group_ids(15));
		self::assertSame([2, 3], $this->repository->get_all_group_rules()['align=']);
		$this->repository->remove_bbcode(15);
		self::assertSame([], $this->get_toolbar_rows(15));
		self::assertSame([], $this->repository->get_group_ids(15));
		self::assertArrayNotHasKey('align=', $this->repository->get_all_group_rules());
		self::assertSame(1, (int) $this->get_display_state(15));
	}

	public function transactional_updates()
	{
		return [
			'layout write' => ['save_layout', [['primary' => ['bbcode:font', 'bbcode:highlight']], [], []], 'UPDATE ON phpbb_abbc3_toolbar WHEN OLD.bbcode_id = 14', ['hidden', 'primary'], 1, [1]],
			'posting visibility' => ['sync_visibility', [], 'UPDATE ON phpbb_bbcodes WHEN NEW.display_on_posting = 1', ['more', 'more'], 1, [1]],
			'BBCode registration' => ['sync_bbcode', [13, 'renamed=', true], 'UPDATE ON phpbb_abbc3_toolbar WHEN NEW.button_key = \'bbcode:renamed\'', ['more'], 0, [1]],
			'group replacement' => ['set_group_ids', [15, [2, 3]], 'INSERT ON phpbb_abbc3_bbcode_groups WHEN NEW.group_id = 3', ['more', 'more'], 0, [2, 3]],
		];
	}

	/**
	 * @dataProvider transactional_updates
	 */
	public function test_failed_write_rolls_back_and_can_be_retried($method, array $arguments, $trigger, array $placements, $display, array $groups)
	{
		if ($this->db->get_sql_layer() !== 'sqlite3')
		{
			self::markTestSkipped('This test uses a SQLite trigger to reject one write inside the transaction.');
		}

		$this->insert_button('bbcode:font', 13, 'more', 1, 'font');
		$this->insert_button('bbcode:duplicate', 13, 'more', 2, 'font');
		$this->insert_button('bbcode:highlight', 14, 'hidden', 1, 'highlight');
		$this->db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET display_on_posting = 0 WHERE bbcode_id = 13');
		$before = $this->repository_state();
		$this->db->sql_query("CREATE TRIGGER abbc3_reject_write BEFORE $trigger BEGIN SELECT RAISE(ABORT, 'ABBC3 test rejected write'); END");
		try
		{
			// Convert phpBB's database error into a throwable as the application does.
			set_error_handler(static function ($severity, $message) {
				throw new \ErrorException($message, 0, $severity);
			}, E_USER_ERROR);
			try
			{
				$this->repository->{$method}(...$arguments);
				self::fail('The database should reject the write.');
			}
			catch (\ErrorException $error)
			{
				self::assertStringContainsString('ABBC3 test rejected write', $error->getMessage());
			}
			finally
			{
				restore_error_handler();
			}
			self::assertSame($before, $this->repository_state());
		}
		finally
		{
			$this->db->sql_query('DROP TRIGGER abbc3_reject_write');
		}

		$this->repository->{$method}(...$arguments);
		self::assertSame($placements, array_column($this->get_toolbar_rows(13), 'placement'));
		self::assertSame($display, (int) $this->get_display_state(13));
		self::assertSame($groups, $this->repository->get_group_ids(15));
		if ($method === 'sync_bbcode')
		{
			self::assertSame('bbcode:renamed', $this->get_toolbar_rows(13)[0]['button_key']);
		}
	}

	private function repository_state()
	{
		return [
			$this->get_toolbar_rows(13),
			$this->get_toolbar_rows(14),
			(int) $this->get_display_state(13),
			(int) $this->get_display_state(14),
			(new toolbar_repository($this->db, 'phpbb_'))->get_group_ids(15),
		];
	}

	/**
	 * Insert a custom toolbar button into the test database.
	 *
	 * @param string $key Toolbar button key
	 * @param int $bbcode_id Custom BBCode ID
	 * @param string $placement Toolbar placement
	 * @param int $order Sort position
	 * @param string $icon Image icon name
	 * @return void
	 */
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

	/**
	 * Read saved toolbar entries for a custom BBCode.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @return array Saved toolbar entries
	 */
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

	/**
	 * Read the stored posting visibility flag.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @return mixed Stored display flag, or false if the row is missing
	 */
	protected function get_display_state($bbcode_id)
	{
		$result = $this->db->sql_query('SELECT display_on_posting FROM phpbb_bbcodes WHERE bbcode_id = ' . (int) $bbcode_id);
		$state = $this->db->sql_fetchfield('display_on_posting');
		$this->db->sql_freeresult($result);
		return $state;
	}
}
