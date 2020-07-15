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

use phpbb\db\migration\container_aware_migration;

/**
 * Helper for installing/updating bbcodes in migrations.
 */
abstract class bbcodes_migration_base extends container_aware_migration
{
	/**
	 * @var array An array of bbcodes data to install
	 */
	protected static $bbcode_data;

	/**
	 * Get the bbcodes installer object
	 *
	 * @return \vse\abbc3\core\bbcodes_installer
	 */
	public function get_bbcodes_installer()
	{
		/** @var \phpbb\group\helper $group_helper */
		$group_helper = $this->container->get('group_helper');

		/** @var \phpbb\language\language $language */
		$language = $this->container->get('language');

		/** @var \phpbb\request\request $request */
		$request = $this->container->get('request');

		return new \vse\abbc3\core\bbcodes_installer($this->db, $group_helper, $language, $request, $this->phpbb_root_path, $this->php_ext);
	}

	/**
	 * Wrapper for installing bbcodes in migrations
	 */
	public function install_abbc3_bbcodes()
	{
		$this->get_bbcodes_installer()->install_bbcodes(static::$bbcode_data);
	}

	/**
	 * Wrapper for deleting bbcodes in migrations
	 */
	public function delete_abbc3_bbcodes()
	{
		$this->get_bbcodes_installer()->delete_bbcodes(static::$bbcode_data);
	}
}
