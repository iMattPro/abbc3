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
	/** @var string Require 3.1.3 due to throwing new exceptions
	 *              and using containerAware migration files.
	 */
	const PHPBB_VERSION = '3.1.3';

	/**
	 * {@inheritdoc}
	 */
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return phpbb_version_compare($config['version'], self::PHPBB_VERSION, '>=');
	}
}
