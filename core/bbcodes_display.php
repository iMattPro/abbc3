<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\core;

use phpbb\config\config;
use phpbb\db\driver\driver_interface;
use phpbb\extension\manager;
use phpbb\textformatter\s9e\parser;
use phpbb\user;

/**
 * ABBC3 core BBCodes display class
 */
class bbcodes_display
{
	/** @var config */
	protected $config;

	/** @var driver_interface */
	protected $db;

	/** @var manager */
	protected $extension_manager;

	/** @var user */
	protected $user;

	/** @var string */
	protected $root_path;

	/** @var array */
	protected $memberships;

	/** @var string */
	protected $icon_path;

	/**
	 * Constructor
	 *
	 * @param config           $config            Config object
	 * @param driver_interface $db                Database connection
	 * @param manager          $extension_manager Extension manager object
	 * @param user             $user              User object
	 * @param string           $root_path         Path to phpBB root
	 * @access public
	 */
	public function __construct(config $config, driver_interface $db, manager $extension_manager, user $user, $root_path)
	{
		$this->config = $config;
		$this->db = $db;
		$this->extension_manager = $extension_manager;
		$this->user = $user;
		$this->root_path = $root_path;
	}

	/**
	 * Display allowed custom BBCodes with icons
	 *
	 * Uses GIF images named exactly the same as the bbcode_tag
	 *
	 * @param array $custom_tags Template data of the bbcode
	 * @param array $row         The data of the bbcode
	 * @return array Update template data of the bbcode
	 * @access public
	 */
	public function display_custom_bbcodes($custom_tags, $row)
	{
		$icons = $this->get_icons();

		$icon_tag = strtolower(rtrim($row['bbcode_tag'], '='));

		$custom_tags['BBCODE_IMG'] = isset($icons[$icon_tag]) ? $icons[$icon_tag] : '';
		$custom_tags['S_CUSTOM_BBCODE_ALLOWED'] = !empty($row['bbcode_group']) ? $this->user_in_bbcode_group($row['bbcode_group']) : true;

		return $custom_tags;
	}

	/**
	 * Disable BBCodes not allowed by a user's group(s).
	 *
	 * @param parser $service Object from the text_formatter.parser service
	 * @return void
	 * @access public
	 */
	public function allow_custom_bbcodes(parser $service)
	{
		$parser = $service->get_parser();
		foreach ($parser->registeredVars['abbc3.bbcode_groups'] as $bbcode_name => $groups)
		{
			if (!$this->user_in_bbcode_group($groups))
			{
				$bbcode_name = rtrim($bbcode_name, '=');
				$service->disable_bbcode($bbcode_name);
			}
		}
	}

	/**
	 * Determine if a user is in a group allowed to use a custom BBCode
	 *
	 * @param string|array $group_ids Allowed group IDs, comma separated string or array
	 * @return bool Return true if allowed to use BBCode
	 * @access public
	 */
	public function user_in_bbcode_group($group_ids = '')
	{
		if ($group_ids)
		{
			// Convert string to an array
			if (!is_array($group_ids))
			{
				$group_ids = explode(',', $group_ids);
			}

			// Load the user's group memberships
			$this->load_memberships();

			return (bool) count(array_intersect($this->memberships, $group_ids));
		}

		// If we get here, there were no group restrictions so everyone can use this BBCode
		return true;
	}

	/**
	 * Get paths/names to ABBC3's BBCode icons.
	 * Search in ABBC3's icons dir and also the core's images dir.
	 *
	 * @return array Array of icon paths: ['foo' => './ext/vse/abbc3/images/icons/foo.png']
	 * @access public
	 */
	public function get_icons()
	{
		static $icons = [];

		if (empty($icons))
		{
			$finder = $this->extension_manager->get_finder();
			$icons = $finder
				->set_extensions(['vse/abbc3'])
				->suffix(".{$this->config['abbc3_icons_type']}")
				->extension_directory('/images/icons')
				->core_path('images/abbc3/icons/')
				->get_files();

			// Rewrite the image array with img names as keys and paths as values
			foreach ($icons as $key => $path)
			{
				$icons[basename($path, ".{$this->config['abbc3_icons_type']}")] = $path;
				unset($icons[$key]);
			}
		}

		return $icons;
	}

	/**
	 * Load this user's group memberships if it's not cached already
	 *
	 * @access protected
	 */
	protected function load_memberships()
	{
		if ($this->memberships !== null)
		{
			return;
		}

		$this->memberships = [];
		$sql = 'SELECT group_id
			FROM ' . USER_GROUP_TABLE . '
			WHERE user_id = ' . (int) $this->user->data['user_id'] . '
			AND user_pending = 0';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$this->memberships[] = $row['group_id'];
		}
		$this->db->sql_freeresult($result);
	}
}
