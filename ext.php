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
	const MOVE_UP = 'move_up';
	const MOVE_DOWN = 'move_down';
	const MOVE_DRAG = 'move_drag';
	const PHPBB_MIN_VERSION = '3.2.2'; // Require 3.2.2 due to TextFormatter and BBCode changes
	const PHPBB_LEGACY_MAX = '3.3.10'; // Max version of phpBB to use legacy settings
	const ABBC3_BBCODE_FONTS = ['ABBC3_FONT_SAFE' => ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia', 'Impact', 'Tahoma', 'Times New Roman', 'Trebuchet MS', 'Verdana']];

	/**
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return $this->version_check($config['version']) && $this->version_check(PHPBB_VERSION);
	}

	/**
	 * {@inheritdoc}
	 */
	public function enable_step($old_state)
	{
		if ($old_state === false)
		{
			$filesystem = $this->container->get('filesystem');
			$root_path = $this->container->getParameter('core.root_path');

			try // Make an ABBC3 icon dir in phpBB's images dir
			{
				if (!$filesystem->exists($root_path . 'images/abbc3/icons'))
				{
					$filesystem->mkdir($root_path . 'images/abbc3/icons');
				}
			}
			catch (filesystem_exception $e)
			{
				$user = $this->container->get('user');
				$this->container->get('log')->add('critical', $user->data['user_id'], $user->ip, 'LOG_ABBC3_ENABLE_FAIL', false, [$e->get_filename()]);
			}

			return 'abbc3-step';
		}

		return parent::enable_step($old_state);
	}

	/**
	 * Enable version check
	 *
	 * @param string|int $version The version to check
	 * @return bool
	 */
	protected function version_check($version)
	{
		return phpbb_version_compare($version, self::PHPBB_MIN_VERSION, '>=');
	}
}
