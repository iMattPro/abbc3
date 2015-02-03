<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3;

use \phpbb\db\migration\container_aware_migration;

abstract class migrations_bbcode_base extends container_aware_migration
{
	protected $bbcode_data;

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
