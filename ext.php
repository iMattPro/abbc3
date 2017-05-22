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
	const BBVIDEO_WIDTH = 560;
	const BBVIDEO_HEIGHT = 315;

	/** string Require 3.2.0 due to INCLUDECSS, migration helper updates and Pipe Tables. */
	const PHPBB_MIN_VERSION = '3.2.1-dev';

	/**
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], self::PHPBB_MIN_VERSION, '>=');
	}
}
