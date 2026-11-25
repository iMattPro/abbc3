<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2016 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\system;

use phpbb\cache\driver\file;
use phpbb\config\db_text;
use phpbb\db\migration\helper;
use phpbb\db\migration\tool\config as config_tool;
use phpbb\db\migrator;
use phpbb\db\tools\factory;
use phpbb\extension\manager;
use phpbb\filesystem\filesystem;
use Symfony\Component\DependencyInjection\Container;
use vse\abbc3\core\bbcode_catalog;
use vse\abbc3\core\toolbar_repository;
use vse\abbc3\core\uninstall_manager;

class ext_test extends \phpbb_database_test_case
{
	private const EXTENSION = 'vse/abbc3';
	private const LEGACY = '\vse\abbc3\migrations\v3310_m20_update_bbcodes';
	private const TOOLBAR = '\vse\abbc3\migrations\v340_m21_toolbar';
	private const INTEGRITY = '\vse\abbc3\migrations\v340_m23_toolbar_integrity';

	private $db;
	private $filesystem;
	private $root;
	private $container;
	private $config;
	private $config_text;
	private $cache;
	private $manager;
	private $migrator;
	private $tools;
	private $catalog;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/lifecycle.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();
		global $phpbb_root_path, $phpEx;

		$this->db = $this->new_dbal();
		$this->filesystem = new filesystem();
		$temporary_path = tempnam(sys_get_temp_dir(), 'abbc3-');
		$this->filesystem->remove($temporary_path);
		$this->root = $temporary_path . '/';
		$this->filesystem->mkdir($this->root . 'cache');
		$this->filesystem->mkdir($this->root . 'images/abbc3');
		$this->tools = (new factory())->get($this->db);
		$this->cache = new file($this->root . 'cache/');
		$this->config = new \phpbb\config\db($this->db, $this->cache, CONFIG_TABLE);
		$this->config_text = new db_text($this->db, CONFIG_TEXT_TABLE);
		$this->catalog = new bbcode_catalog();
		$this->container = new Container();
		foreach ([
			'dbal.conn' => $this->db,
			'config' => $this->config,
			'config_text' => $this->config_text,
			'cache.driver' => $this->cache,
			'filesystem' => $this->filesystem,
			'dispatcher' => new \phpbb\event\dispatcher(),
		] as $name => $service)
		{
			$this->container->set($name, $service);
		}
		foreach ([
			'core.root_path' => $phpbb_root_path,
			'core.table_prefix' => 'phpbb_',
			'core.php_ext' => $phpEx,
			'text_formatter.cache.parser.key' => '_abbc3_parser',
			'text_formatter.cache.renderer.key' => '_abbc3_renderer',
		] as $name => $value)
		{
			$this->container->setParameter($name, $value);
		}

		$this->migrator = new migrator($this->container, $this->config, $this->db, $this->tools, MIGRATIONS_TABLE, $phpbb_root_path, $phpEx, 'phpbb_', [new config_tool($this->config)], new helper());
		$this->container->set('migrator', $this->migrator);
		$this->manager = new manager($this->container, $this->db, $this->config, $this->filesystem, EXT_TABLE, $this->root, $phpEx);
	}

	protected function tearDown(): void
	{
		if ($this->root)
		{
			$this->filesystem->remove($this->root);
		}
		parent::tearDown();
	}

	public function supported_versions()
	{
		return [
			'minimum version' => ['3.3.5', true],
			'below minimum' => ['3.3.4', false],
			'future version' => ['4.0.0', false],
			'legacy version' => ['3.1.0', false],
		];
	}

	/** @dataProvider supported_versions */
	public function test_enable_checks_board_version($version, $expected)
	{
		$this->config->set('version', $version);
		self::assertSame($expected, $this->manager->get_extension(self::EXTENSION)->is_enableable());
	}

	public function install_contexts()
	{
		return [
			'fresh installation' => [[], 1],
			'legacy upgrade' => [[self::LEGACY], 0],
			'already migrated' => [[self::LEGACY, self::TOOLBAR], null],
		];
	}

	/** @dataProvider install_contexts */
	public function test_initial_enable_records_install_context_and_creates_icon_directory(array $installed, $fresh)
	{
		$this->record_migrations($installed);
		$this->container->setParameter('core.root_path', $this->root);
		$this->container->set('vse.abbc3.uninstall_manager', $this->uninstall_manager());
		$extension = $this->manager->get_extension(self::EXTENSION);
		self::assertSame('abbc3-step', $extension->enable_step(false));
		self::assertDirectoryExists($this->root . 'images/abbc3/icons');
		$config = new \phpbb\config\db($this->db, new file($this->root . 'cache/'), CONFIG_TABLE);
		if ($fresh === null)
		{
			self::assertFalse(isset($config['abbc3_fresh_install']));
		}
		else
		{
			self::assertSame((string) $fresh, $config['abbc3_fresh_install']);
		}

		file_put_contents($this->root . 'images/abbc3/icons/custom.svg', '<svg/>');
		self::assertSame('abbc3-step', $extension->enable_step(false));
		self::assertSame('<svg/>', file_get_contents($this->root . 'images/abbc3/icons/custom.svg'));
	}

	public function test_initial_enable_and_disable_are_safe_without_board_storage_services()
	{
		$extension = $this->manager->get_extension(self::EXTENSION);
		$this->container->set('dbal.conn', null);
		$this->container->setParameter('core.root_path', $this->root);

		self::assertSame('abbc3-step', $extension->enable_step(false));
		self::assertFalse(isset($this->config['abbc3_fresh_install']));
		self::assertDirectoryExists($this->root . 'images/abbc3/icons');
		self::assertSame('abbc3-disable-prepared', $extension->disable_step(false));
		self::assertNull($this->config_text->get('abbc3_disable_state'));
	}

	public function test_icon_directory_error_is_logged()
	{
		global $phpbb_root_path, $phpEx;
		$this->filesystem->remove($this->root . 'images/abbc3');
		file_put_contents($this->root . 'images/abbc3', 'existing file');
		$user = new \phpbb\user(new \phpbb\language\language(new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx)), '\phpbb\datetime');
		$user->data['user_id'] = 2;
		$user->ip = '127.0.0.1';
		$this->container->set('user', $user);
		$this->container->set('log', new \phpbb\log\log($this->db, $user, new \phpbb\auth\auth(), new \phpbb\event\dispatcher(), $phpbb_root_path, 'adm/', $phpEx, LOG_TABLE));
		$this->container->set('vse.abbc3.uninstall_manager', $this->uninstall_manager());
		$this->container->setParameter('core.root_path', $this->root);

		self::assertSame('abbc3-step', $this->manager->get_extension(self::EXTENSION)->enable_step(false));
		$result = $this->db->sql_query('SELECT log_type, user_id FROM ' . LOG_TABLE . " WHERE log_operation = 'LOG_ABBC3_ENABLE_FAIL'");
		$entry = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		self::assertSame(LOG_CRITICAL, (int) $entry['log_type']);
		self::assertSame(2, (int) $entry['user_id']);
		self::assertSame('existing file', file_get_contents($this->root . 'images/abbc3'));
	}

	public function test_upgrade_disable_reenable_and_purge_preserve_post_definitions()
	{
		global $phpbb_root_path, $phpEx;
		$state = $this->root . 'ext/vse/abbc3/migrations/';
		$this->filesystem->mkdir($state);
		// The oldest supported board state already has the legacy migrations installed.
		foreach (glob($phpbb_root_path . 'ext/vse/abbc3/migrations/v340_*.php') as $migration)
		{
			$this->filesystem->copy($migration, $state . basename($migration));
		}
		$this->record_migrations([self::LEGACY]);
		$this->tools->sql_column_add(BBCODES_TABLE, 'bbcode_order', ['USINT', 0]);
		$this->tools->sql_column_add(BBCODES_TABLE, 'bbcode_group', ['VCHAR:255', '']);
		$this->container->setParameter('core.root_path', $this->root);
		// Definitions still compile using phpBB's actual ACP compiler.
		$this->container->set('vse.abbc3.uninstall_manager', $this->uninstall_manager());

		$font = $this->catalog->get('font');
		$this->update_definition(13, $font['match'], $font['enhanced']);
		$this->update_definition(14, '[highlight={COLOR}]{TEXT}[/highlight]', '<mark>{TEXT}</mark>');
		try
		{
			$this->manager->enable(self::EXTENSION);
			self::assertTrue($this->manager->is_enabled(self::EXTENSION));
			self::assertNotFalse($this->migrator->migration_state(self::INTEGRITY));
			self::assertFalse($this->tools->sql_column_exists(BBCODES_TABLE, 'bbcode_group'));
			self::assertArrayHasKey('bbcode:font', (new toolbar_repository($this->db, 'phpbb_'))->get_layout());

			$this->manager->disable(self::EXTENSION);
			self::assertFalse($this->manager->is_enabled(self::EXTENSION));
			self::assertSame($font['fallback'], $this->definition(13)['bbcode_tpl']);
			self::assertSame('<mark>{TEXT}</mark>', $this->definition(14)['bbcode_tpl']);
			self::assertFalse($this->manager->disable_step(self::EXTENSION));

			// Re-enable with the core container used when extension services are unavailable.
			$this->container->set('vse.abbc3.uninstall_manager', null);
			$this->db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET display_on_posting = 0 WHERE bbcode_id = 14');
			$this->manager->enable(self::EXTENSION);
			self::assertSame($font['enhanced'], $this->definition(13)['bbcode_tpl']);
			$layout = (new toolbar_repository($this->db, 'phpbb_'))->get_layout();
			self::assertSame('hidden', $layout['bbcode:highlight']['placement']);
			self::assertNull($this->config_text->get('abbc3_disable_state'));

			$this->manager->disable(self::EXTENSION);
			$this->db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET display_on_posting = 1 WHERE bbcode_id = 14');
			$this->manager->purge(self::EXTENSION);
			self::assertFalse($this->manager->is_configured(self::EXTENSION));
			self::assertFalse($this->migrator->migration_state(self::INTEGRITY));
			self::assertFalse($this->tools->sql_table_exists('phpbb_abbc3_toolbar'));
			self::assertSame($font['fallback'], $this->definition(13)['bbcode_tpl']);
			self::assertSame('<mark>{TEXT}</mark>', $this->definition(14)['bbcode_tpl']);
			self::assertSame(0, (int) $this->definition(14)['display_on_posting']);
			self::assertNull($this->config_text->get('abbc3_disable_state'));
		}
		finally
		{
			// Restore the base schema even if an assertion or a migration fails.
			foreach (['phpbb_abbc3_toolbar', 'phpbb_abbc3_bbcode_groups'] as $table)
			{
				if ($this->tools->sql_table_exists($table))
				{
					$this->tools->sql_table_drop($table);
				}
			}
			foreach (['bbcode_order', 'bbcode_group'] as $column)
			{
				if ($this->tools->sql_column_exists(BBCODES_TABLE, $column))
				{
					$this->tools->sql_column_remove(BBCODES_TABLE, $column);
				}
			}
		}
	}

	private function record_migrations(array $names)
	{
		foreach ($names as $name)
		{
			$row = [
				'migration_name' => $name,
				'migration_depends_on' => serialize([]),
				'migration_schema_done' => 1,
				'migration_data_done' => 1,
				'migration_data_state' => '',
			];
			$this->db->sql_query('INSERT INTO ' . MIGRATIONS_TABLE . ' ' . $this->db->sql_build_array('INSERT', $row));
		}
		$this->migrator->load_migration_state();
	}

	private function uninstall_manager()
	{
		global $phpbb_root_path, $phpEx;
		return new uninstall_manager($this->db, $this->config_text, $this->cache, $this->catalog, '_abbc3_parser', '_abbc3_renderer', $phpbb_root_path, $phpEx);
	}

	private function update_definition($id, $match, $template)
	{
		$this->db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', [
			'bbcode_match' => $match,
			'bbcode_tpl' => $template,
		]) . ' WHERE bbcode_id = ' . (int) $id);
	}

	private function definition($id)
	{
		$result = $this->db->sql_query('SELECT bbcode_tpl, display_on_posting FROM ' . BBCODES_TABLE . ' WHERE bbcode_id = ' . (int) $id);
		$row = $this->db->sql_fetchrow($result);
		$this->db->sql_freeresult($result);
		return $row;
	}
}
