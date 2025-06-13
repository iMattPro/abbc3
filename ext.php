<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3;

use phpbb\extension\base;
use phpbb\filesystem\exception\filesystem_exception;
use phpbb\log\log;
use phpbb\user;

class ext extends base
{
	public const MOVE_UP = 'move_up';
	public const MOVE_DOWN = 'move_down';
	public const MOVE_DRAG = 'move_drag';
	public const PHPBB_MIN_VERSION = '4.0.0-dev';
	public const ABBC3_BBCODE_FONTS = ['ABBC3_FONT_SAFE' => ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia', 'Impact', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana']];
	public const ABBC3_EXT_NAME = 'Advanced BBCodes 3.4';
	private const ICONS_PATH = 'images/abbc3/icons';

	/**
	 * {@inheritdoc}
	 */
	public function is_enableable(): array|bool
	{
		$config = $this->container->get('config');
		return $this->version_check($config['version']) && $this->version_check(PHPBB_VERSION);
	}

	/**
	 * {@inheritdoc}
	 */
	public function enable_step($old_state): bool|string
	{
		if ($old_state === false)
		{
			$this->create_icons_directory();
			return 'abbc3-step';
		}

		return parent::enable_step($old_state);
	}

	/**
	 * Create the ABBC3 icons directory
	 */
	protected function create_icons_directory(): void
	{
		$filesystem = $this->container->get('filesystem');
		$root_path = $this->container->getParameter('core.root_path');
		$icons_path = $root_path . self::ICONS_PATH;

		try
		{
			if (!$filesystem->exists($icons_path))
			{
				$filesystem->mkdir($icons_path);
			}
		}
		catch (filesystem_exception $e)
		{
			$this->log_error($e);
		}
	}

	/**
	 * Log filesystem errors
	 *
	 * @param filesystem_exception $e The exception to log
	 */
	protected function log_error(filesystem_exception $e): void
	{
		/** @var user $user */
		$user = $this->container->get('user');

		/** @var log $log */
		$log = $this->container->get('log');

		$log->add(
			'critical',
			$user->data['user_id'],
			$user->ip,
			'LOG_ABBC3_ENABLE_FAIL',
			false,
			[$e->get_filename()]
		);
	}

	/**
	 * Enable version check
	 *
	 * @param int|string $version The version to check
	 * @return bool
	 */
	protected function version_check(int|string $version): bool
	{
		return phpbb_version_compare($version, self::PHPBB_MIN_VERSION, '>=');
	}
}
