<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license       GNU General Public License, version 2 (GPL-2.0)
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
		static $images = [];

		if (empty($images))
		{
			$images = $this->get_images();
		}

		$img_key = strtolower(rtrim($row['bbcode_tag'], '=')) . ".{$this->config['abbc3_icons_type']}";

		$custom_tags['BBCODE_IMG'] = isset($images[$img_key]) ? $images[$img_key] : '';
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
	 * Get image paths/names to ABBC3's BBCode icons
	 *
	 * @return array Array of icon paths: ['img.svg' => 'images/abbc3/icons/img.svg']
	 * @access protected
	 */
	protected function get_images()
	{
		// First try to load icons from phpBB image folder
		$images = $this->find_core_icons();

		// If nothing found try ABBC3 extension's image folder
		if (empty($images))
		{
			$images = $this->find_abbc3_icons();
		}

		// Rewrite the image array with img names as keys and paths as values
		foreach ($images as $path => $ext)
		{
			$images[basename($path)] = $path;
			unset($images[$path]);
		}

		return $images;
	}

	/**
	 * Find ABBC3 icons in the core images folder
	 *
	 * @return array An array of paths to found items
	 * @access protected
	 */
	protected function find_core_icons()
	{
		$this->set_icon_path('images/abbc3/icons');
		$finder = $this->extension_manager->get_finder();
		return $finder
			->set_extensions([])
			->suffix(".{$this->config['abbc3_icons_type']}")
			->core_path('images/abbc3/icons/')
			->find();
	}

	/**
	 * Find ABBC3 icons in the ABBC3 extension's images folder
	 *
	 * @return array An array of paths to found items
	 * @access protected
	 */
	protected function find_abbc3_icons()
	{
		$this->set_icon_path('ext/vse/abbc3/images/icons');
		$finder = $this->extension_manager->get_finder();
		return $finder
			->extension_suffix(".{$this->config['abbc3_icons_type']}")
			->extension_directory('/images/icons')
			->find_from_extension('vse/abbc3', "{$this->root_path}ext/vse/abbc3/");
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

	/**
	 * Set the $icon_path property
	 *
	 * @param string $path A path to ABBC3 icons
	 * @access public
	 */
	public function set_icon_path($path)
	{
		$this->icon_path = $this->root_path . $path;
	}

	/**
	 * Get the $icon_path property
	 *
	 * @return string A full relative path to ABBC3 icons
	 * @access public
	 */
	public function get_icon_path()
	{
		return $this->icon_path ?: "{$this->root_path}ext/vse/abbc3/images/icons";
	}
}
