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

use \phpbb\db\migration\container_aware_migration;

/**
 * Class wrapper for installing/updating bbcodes in migrations.
 * This class must be kept outside of the migrations directory
 * since this is not a migration file. It's just a wrapper that
 * can be extended by multiple migration files.
 */
abstract class migrations_bbcode_base extends container_aware_migration
{
	/** @var array An array of bbcodes data to install */
	protected $bbcode_data;

	/**
	 * Wrapper for installing bbcodes in migrations
	 */
	public function install_abbc3_bbcodes()
	{
		/** @var \phpbb\request\request $request */
		$request = $this->container->get('request');

		/** @var \phpbb\user $user */
		$user = $this->container->get('user');

		$acp_manager = new \vse\abbc3\core\acp_manager($this->db, $request, $user, $this->phpbb_root_path, $this->php_ext);
		$acp_manager->install_bbcodes($this->bbcode_data);
	}
}
