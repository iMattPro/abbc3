<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use phpbb\cache\driver\file;
use phpbb\config\db_text;
use phpbb\filesystem\filesystem;
use vse\abbc3\core\bbcode_catalog;
use vse\abbc3\core\uninstall_manager;

class uninstall_manager_test extends acp_base
{

	private $cache_dir;
	private $cache;
	private $catalog;
	private $config_text;
	private $manager;

	protected function setUp(): void
	{
		parent::setUp();
		global $phpbb_root_path, $phpEx, $phpbb_filesystem;

		$phpbb_filesystem = new filesystem();
		$this->cache_dir = tempnam(sys_get_temp_dir(), 'abbc3-');
		unlink($this->cache_dir);
		mkdir($this->cache_dir);
		$this->cache = new file($this->cache_dir . '/');
		$this->catalog = new bbcode_catalog();
		$this->config_text = new db_text($this->db, CONFIG_TEXT_TABLE);
		$this->manager = new uninstall_manager($this->db, $this->config_text, $this->cache, $this->catalog, '_parser', '_renderer', $phpbb_root_path, $phpEx);
	}

	protected function tearDown(): void
	{
		(new filesystem())->remove($this->cache_dir);
		parent::tearDown();
	}

	public function test_disable_installs_standalone_fallback_and_enable_restores_definition()
	{
		$entry = $this->catalog->get('font');
		$this->set_definition(13, $entry['match'], $entry['enhanced']);
		$this->cache->put('_parser', 'enhanced parser');
		$this->cache->put('_renderer', 'enhanced renderer');

		$this->manager->prepare_disable();
		$row = $this->get_definition(13);
		self::assertSame($entry['fallback'], $row['bbcode_tpl']);
		self::assertSame(0, (int) $row['display_on_posting']);
		$state = $this->config_text->get('abbc3_disable_state');
		self::assertNotNull($state);
		self::assertFalse($this->cache->get('_parser'));
		self::assertFalse($this->cache->get('_renderer'));

		$this->manager->prepare_disable();
		self::assertSame($state, $this->config_text->get('abbc3_disable_state'));
		$this->cache->put('_parser', 'fallback parser');
		$this->cache->put('_renderer', 'fallback renderer');
		$this->manager->restore_enable();
		$row = $this->get_definition(13);
		self::assertSame($entry['enhanced'], $row['bbcode_tpl']);
		self::assertSame(1, (int) $row['display_on_posting']);
		self::assertNull($this->config_text->get('abbc3_disable_state'));
		self::assertFalse($this->cache->get('_parser'));
		self::assertFalse($this->cache->get('_renderer'));
	}

	public function definition_changes()
	{
		return [
			'edited template' => ['[font={INTTEXT}]{TEXT}[/font]', '<span>{TEXT}</span>'],
			'edited usage' => ['[font={IDENTIFIER}]{TEXT}[/font]', 'fallback'],
			'deleted definition' => [null, null],
		];
	}

	/** @dataProvider definition_changes */
	public function test_enable_preserves_changes_made_while_disabled($match, $template)
	{
		$font = $this->catalog->get('font');
		$this->set_definition(13, $font['match'], $font['enhanced']);
		$this->manager->prepare_disable();
		if ($match === null)
		{
			$this->db->sql_query('DELETE FROM ' . BBCODES_TABLE . ' WHERE bbcode_id = 13');
		}
		else
		{
			$template = $template === 'fallback' ? $font['fallback'] : $template;
			$this->set_definition(13, $match, $template);
		}
		$expected = $this->get_definition(13);
		$this->manager->restore_enable();
		self::assertSame($expected, $this->get_definition(13));
		self::assertNull($this->config_text->get('abbc3_disable_state'));
	}

	public function test_failure_to_install_fallback_rolls_back_disable()
	{
		if ($this->db->get_sql_layer() !== 'sqlite3')
		{
			self::markTestSkipped('This test uses a SQLite trigger to reject a fallback update.');
		}

		$font = $this->catalog->get('font');
		$highlight = $this->catalog->get('highlight');
		$this->set_definition(13, $font['match'], $font['enhanced']);
		$this->set_definition(14, $highlight['match'], $highlight['enhanced']);
		$before = [$this->get_definition(13), $this->get_definition(14)];
		$this->cache->put('_parser', 'enhanced parser');
		$this->db->sql_query("CREATE TRIGGER abbc3_reject_fallback BEFORE UPDATE ON " . BBCODES_TABLE . " WHEN OLD.bbcode_id = 14 BEGIN SELECT RAISE(ABORT, 'ABBC3 test rejected fallback'); END");
		try
		{
			set_error_handler(static function ($severity, $message) {
				throw new \ErrorException($message, 0, $severity);
			}, E_USER_ERROR);
			try
			{
				$this->manager->prepare_disable();
				self::fail('The database should reject the fallback update.');
			}
			catch (\ErrorException $error)
			{
				self::assertStringContainsString('ABBC3 test rejected fallback', $error->getMessage());
			}
			finally
			{
				restore_error_handler();
			}

			self::assertSame($before, [$this->get_definition(13), $this->get_definition(14)]);
			self::assertNull((new db_text($this->db, CONFIG_TEXT_TABLE))->get('abbc3_disable_state'));
			self::assertSame('enhanced parser', $this->cache->get('_parser'));
		}
		finally
		{
			$this->db->sql_query('DROP TRIGGER abbc3_reject_fallback');
		}
		$this->manager->prepare_disable();
		self::assertSame($font['fallback'], $this->get_definition(13)['bbcode_tpl']);
		self::assertSame($highlight['fallback'], $this->get_definition(14)['bbcode_tpl']);
	}

	/**
	 * Install a compiled definition in the test BBCode table.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @param string $match BBCode usage pattern
	 * @param string $template Replacement template
	 * @return void
	 */
	protected function set_definition($bbcode_id, $match, $template)
	{
		global $phpbb_root_path, $phpEx;
		if (!class_exists('acp_bbcodes'))
		{
			include $phpbb_root_path . 'includes/acp/acp_bbcodes.' . $phpEx;
		}
		$compiled = (new \acp_bbcodes())->build_regexp($match, $template);
		$data = array_replace($compiled, [
			'bbcode_match' => $match,
			'bbcode_tpl' => $template,
			'display_on_posting' => 1,
		]);
		$this->db->sql_query('UPDATE phpbb_bbcodes SET ' . $this->db->sql_build_array('UPDATE', $data) . ' WHERE bbcode_id = ' . (int) $bbcode_id);
	}

	/**
	 * Read the current template and display flag for a test BBCode.
	 *
	 * @param int $bbcode_id Custom BBCode ID
	 * @return array|false Stored definition or false if the row is missing
	 */
	protected function get_definition($bbcode_id)
	{
		$result = $this->db->sql_query('SELECT bbcode_tpl, display_on_posting FROM phpbb_bbcodes WHERE bbcode_id = ' . (int) $bbcode_id);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		return $row;
	}
}
