<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2015 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3;

use phpbb\filesystem\exception\filesystem_exception;

class ext extends \phpbb\extension\base
{
	const PHPBB_MIN_VERSION = '3.3.5';
	const PHPBB_MAX_VERSION = '4.0.0@dev';
	const PHP_MIN_VERSION_ID = 70200;
	const PHPBB_LEGACY_MAX = '3.3.10'; // Max version of phpBB to use legacy settings
	const ABBC3_BBCODE_FONTS = ['ABBC3_FONT_SAFE' => ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia', 'Impact', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana']];

	/**
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');

		return $this->version_check($config['version'])
			&& $this->version_check(PHPBB_VERSION)
			&& PHP_VERSION_ID >= self::PHP_MIN_VERSION_ID;
	}

	/**
	 * {@inheritdoc}
	 */
	public function enable_step($old_state)
	{
		if ($old_state === false)
		{
			$this->record_install_context();
			if ($uninstall_manager = $this->get_uninstall_manager())
			{
				$uninstall_manager->restore_enable();
			}
			$filesystem = $this->container->get('filesystem');
			$icon_path = $this->container->getParameter('core.root_path') . 'images/abbc3/icons';

			try // Make an ABBC3 icon dir in phpBB's images dir
			{
				if (!$filesystem->exists($icon_path))
				{
					$filesystem->mkdir($icon_path);
				}
			}
			catch (filesystem_exception $e)
			{
				$user = $this->container->get('user');
				$this->container->get('log')->add('critical', $user->data['user_id'], $user->ip, 'LOG_ABBC3_ENABLE_FAIL', false, [$e->get_filename()]);
			}

			return 'abbc3-step';
		}

		if (parent::enable_step($old_state))
		{
			return true;
		}

		$repository = new core\toolbar_repository(
			$this->container->get('dbal.conn'),
			$this->container->getParameter('core.table_prefix')
		);
		$config = $this->container->get('config');
		$repository->reconcile_visibility(['pipes' => !empty($config['abbc3_pipes'])]);

		return false;
	}

	/**
	 * Record fresh install vs upgrade before any extension migrations run.
	 */
	protected function record_install_context()
	{
		if (!$this->container->has('dbal.conn') || !$this->container->has('config'))
		{
			return;
		}

		$db = $this->container->get('dbal.conn');
		$migrations = [
			'old' => '\\vse\\abbc3\\migrations\\v3310_m20_update_bbcodes',
			'new' => '\\vse\\abbc3\\migrations\\v3312_m21_toolbar',
		];
		$sql = 'SELECT migration_name FROM ' . MIGRATIONS_TABLE . '
			WHERE ' . $db->sql_in_set('migration_name', array_values($migrations));
		$result = $db->sql_query($sql);
		$installed = [];
		while ($row = $db->sql_fetchrow($result))
		{
			$installed[$row['migration_name']] = true;
		}
		$db->sql_freeresult($result);

		if (!isset($installed[$migrations['new']]))
		{
			$this->container->get('config')->set('abbc3_fresh_install', (int) !isset($installed[$migrations['old']]));
		}
	}

	public function disable_step($old_state)
	{
		if ($old_state === false)
		{
			if ($uninstall_manager = $this->get_uninstall_manager())
			{
				$uninstall_manager->prepare_disable();
			}
			return 'abbc3-disable-prepared';
		}

		return false;
	}

	public function purge_step($old_state)
	{
		$state = parent::purge_step($old_state);
		if ($state === false)
		{
			if ($uninstall_manager = $this->get_uninstall_manager())
			{
				$uninstall_manager->finish_purge();
			}
		}

		return $state;
	}

	/**
	 * Extension services are unavailable while disabled, so build this lifecycle
	 * service from phpBB core services when necessary.
	 *
	 * @return core\uninstall_manager|null
	 */
	protected function get_uninstall_manager()
	{
		if ($this->container->has('vse.abbc3.uninstall_manager'))
		{
			return $this->container->get('vse.abbc3.uninstall_manager');
		}

		foreach (['dbal.conn', 'config_text', 'cache.driver'] as $service)
		{
			if (!$this->container->has($service))
			{
				return null;
			}
		}

		return new core\uninstall_manager(
			$this->container->get('dbal.conn'),
			$this->container->get('config_text'),
			$this->container->get('cache.driver'),
			new core\bbcode_catalog(),
			$this->container->getParameter('text_formatter.cache.parser.key'),
			$this->container->getParameter('text_formatter.cache.renderer.key'),
			$this->container->getParameter('core.root_path'),
			$this->container->getParameter('core.php_ext')
		);
	}

	/**
	 * Enable version check
	 *
	 * @param string|int $version The version to check
	 * @return bool
	 */
	protected function version_check($version)
	{
		return phpbb_version_compare($version, self::PHPBB_MIN_VERSION, '>=')
			&& phpbb_version_compare($version, self::PHPBB_MAX_VERSION, '<');
	}
}
