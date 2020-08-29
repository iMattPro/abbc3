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
}
