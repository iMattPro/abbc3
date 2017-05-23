<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2015 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\migrations;

use \phpbb\db\migration\container_aware_migration;

/**
 * Class wrapper for installing/updating bbcodes in migrations.
 * This class must be kept outside of the migrations directory
 * since this is not a migration file. It's just a wrapper that
 * can be extended by multiple migration files.
 */
abstract class bbcodes_migration_base extends container_aware_migration
{
	/**
	 * @var array An array of bbcodes data to install
	 */
	protected static $bbcode_data;

	/**
	 * Wrapper for installing bbcodes in migrations
	 */
	public function install_abbc3_bbcodes()
	{
		/** @var \phpbb\group\helper $group_helper */
		$group_helper = $this->container->get('group_helper');

		/** @var \phpbb\language\language $language */
		$language = $this->container->get('language');

		/** @var \phpbb\request\request $request */
		$request = $this->container->get('request');

		$bbcodes_installer = new \vse\abbc3\core\bbcodes_installer($this->db, $group_helper, $language, $request, $this->phpbb_root_path, $this->php_ext);
		$bbcodes_installer->install_bbcodes(static::$bbcode_data);
	}
}