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
	const ABBC3_ROOT_PATH = 'ext/vse/abbc3/';
	const BBVIDEO_WIDTH = 560;
	const BBVIDEO_HEIGHT = 315;

	/**
	 * Require 3.1.3 due to throwing new exceptions
	 * and using containerAware migration files.
	 *
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], '3.1.3', '>=');
	}
}
