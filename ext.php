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

class ext extends \phpbb\extension\base
{
	const MOVE_UP = 'move_up';
	const MOVE_DOWN = 'move_down';
	const MOVE_DRAG = 'move_drag';
	const PHPBB_MIN_VERSION = '3.2.2'; // Require 3.2.2 due to TextFormatter and BBCode changes

	/**
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');

		return phpbb_version_compare($config['version'], self::PHPBB_MIN_VERSION, '>=') &&
			phpbb_version_compare(PHPBB_VERSION, self::PHPBB_MIN_VERSION, '>=');
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

			// Make an ABBC3 icon dir in phpBB's images dir
			if (!$filesystem->exists($root_path . 'images/abbc3/icons'))
			{
				$filesystem->mkdir($root_path . 'images/abbc3/icons');
			}

			return 'abbc3-step';
		}

		return parent::enable_step($old_state);
	}
}
