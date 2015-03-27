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

/**
* ABBC3 core BBCodes display class
*/
class bbcodes_display
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\extension\manager */
	protected $extension_manager;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $ext_root_path;

	/** @var array */
	protected $memberships;

	/**
	 * Constructor
	 *
	 * @param \phpbb\db\driver\driver_interface $db                Database connection
	 * @param \phpbb\extension\manager          $extension_manager Extension manager object
	 * @param \phpbb\user                       $user              User object
	 * @param string                            $root_path         phpBB root path
	 * @param string                            $ext_root_path     Extension root path
	 * @access public
	 */
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\extension\manager $extension_manager, \phpbb\user $user, $root_path, $ext_root_path)
	{
		$this->db = $db;
		$this->extension_manager = $extension_manager;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->ext_root_path = $ext_root_path;
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
		static $images = array();

		if (empty($images))
		{
			$images = $this->get_images();
		}

		$bbcode_img = 'abbc3/images/icons/' . strtolower(rtrim($row['bbcode_tag'], '=')) . '.gif';

		$custom_tags['BBCODE_IMG'] = (isset($images['ext/' . $bbcode_img])) ? 'ext/vse/' . $bbcode_img : '';
		$custom_tags['S_CUSTOM_BBCODE_ALLOWED'] = (!empty($row['bbcode_group'])) ? $this->user_in_bbcode_group($row['bbcode_group']) : true;

		return $custom_tags;
	}

	/**
	 * Set custom BBCodes to 'disabled' if they are not allowed to be used
	 *
	 * @param array $bbcodes Array of bbcode data for use in parsing
	 * @param array $rowset  Array of bbcode data from the database
	 * @return array The bbcodes data array
	 * @access public
	 */
	public function allow_custom_bbcodes($bbcodes, $rowset)
	{
		foreach ($rowset as $row)
		{
			if (!$this->user_in_bbcode_group($row['bbcode_group']))
			{
				$bbcodes[$row['bbcode_tag']]['disabled'] = true;
			}
		}

		return $bbcodes;
	}

	/**
	 * Determine if a user is in a group allowed to use a custom BBCode
	 *
	 * @param string $group_ids Allowed group IDs, comma separated
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

			return (bool) sizeof(array_intersect($this->memberships, $group_ids));
		}

		// If we get here, there were no group restrictions so everyone can use this BBCode
		return true;
	}

	/**
	 * Get image paths/names from ABBC3's icons folder
	 *
	 * @return Array of file data from ./ext/vse/abbc3/images/icons
	 * @access protected
	 */
	protected function get_images()
	{
		$finder = $this->extension_manager->get_finder();

		return $finder
			->extension_suffix('.gif')
			->extension_directory('/images/icons')
			->find_from_extension('abbc3', $this->root_path . $this->ext_root_path);
	}

	/**
	 * Load this user's group memberships if it's not cached already
	 *
	 * @return null
	 * @access protected
	 */
	protected function load_memberships()
	{
		if (isset($this->memberships))
		{
			return;
		}

		$this->memberships = array();
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
