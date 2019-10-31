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

	/** string Require 3.2.2 due to TextFormatter and BBCode changes. */
	const PHPBB_MIN_VERSION = '3.2.2';

	/** string Hardcoded language used here because extension can not been installed */
	const ABBC3_CANNOT_BE_INSTALLED = 'phpBB 3.2.2 or newer is required to install this version of Advanced BBCode Box.';

	/**
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');

		$enableable = phpbb_version_compare($config['version'], self::PHPBB_MIN_VERSION, '>=') &&
			phpbb_version_compare(PHPBB_VERSION, self::PHPBB_MIN_VERSION, '>=');

		if (!$enableable && phpbb_version_compare(PHPBB_VERSION, '3.3.0-dev', '>='))
		{
			return [self::ABBC3_CANNOT_BE_INSTALLED];
		}

		return $enableable;
	}
}
