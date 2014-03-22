<?php
/**
*
* @package Advanced BBCode Box 3.1
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\core;

/**
* ABBC3 core BBCodes class
*/
class bbcodes
{
	/** @var \phpbb\db\driver\driver */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver $db
	* @param \phpbb\user $user
	* @param $root_path
	* @return \vse\abbc3\core\bbcodes
	* @access public
	*/
	public function __construct(\phpbb\db\driver\driver $db, \phpbb\user $user, $root_path)
	{
		$this->db = $db;
		$this->user = $user;
		$this->root_path = $root_path;
	}

	/**
	* Display allowed custom BBCodes with icons
	*
	* Uses GIF images named exactly the same as the bbcode_tag
	*
	* @param object $event The event object
	* @return array The custom_tags data array
	* @access public
	*/
	public function display_custom_bbcodes($event)
	{
		$row = $event['row'];
		$custom_tags = $event['custom_tags'];

		$bbcode_img = 'abbc3/images/icons/' . strtolower(rtrim($row['bbcode_tag'], '=')) . '.gif';

		static $images = array();

		if (empty($images))
		{
			$images = $this->get_images();
		}

		$custom_tags['BBCODE_IMG'] = (isset($images['ext/' . $bbcode_img])) ? $this->root_path . 'ext/vse/' . $bbcode_img : '';
		$custom_tags['S_CUSTOM_BBCODE_ALLOWED'] = (!empty($row['bbcode_group'])) ? $this->bbcode_group_permissions($row['bbcode_group']) : true;

		return $custom_tags;
	}

	/**
	* Set custom BBCodes to 'disabled' if they are not allowed to be used
	*
	* @param object $event The event object
	* @return array The bbcodes data array
	* @access public
	*/
	public function allow_custom_bbcodes($event)
	{
		$bbcodes = $event['bbcodes'];

		foreach ($event['rowset'] as $row)
		{
			if (!$this->bbcode_group_permissions($row['bbcode_group']))
			{
				$bbcodes[$row['bbcode_tag']]['disabled'] = true;
			}
		}

		return $bbcodes;
	}

	/**
	* Get image paths/names from ABBC3's icons folder
	*
	* @return Array of file data from ext/vse/abbc3/styles/all/theme/images/icons
	* @access protected
	*/
	protected function get_images()
	{
		global $phpbb_extension_manager;

		$finder = $phpbb_extension_manager->get_finder();

		return $finder
			->extension_suffix('.gif')
			->extension_directory('/images/icons')
			->find_from_extension('abbc3', $this->root_path . 'ext/vse/abbc3');
	}

	/**
	* Determine if a usergroup is allowed to use a custom BBCode
	*
	* @param mixed $group_ids Allowed group IDs
	* @return bool Return true if allowed to use BBCode
	* @access protected
	*/
	protected function bbcode_group_permissions($group_ids = 0)
	{
		if ($group_ids)
		{
			// Convert string to an array
			if (!is_array($group_ids))
			{
				$group_ids = explode(',', $group_ids);
			}

			// Get the user's group IDs (only run this once)
			if (!isset($this->user->data['group_id_set']))
			{
				$this->user->data['group_id_set'] = array();

				$sql = 'SELECT *
					FROM ' . USER_GROUP_TABLE . '
					WHERE user_id = ' . (int) $this->user->data['user_id'] . '
					AND user_pending = 0';
				$result = $this->db->sql_query($sql);

				while ($row = $this->db->sql_fetchrow($result))
				{
					$this->user->data['group_id_set'][] = $row['group_id'];
				}
				$this->db->sql_freeresult($result);
			}

			// Is the user in a group that is allowed to use this BBCode?
			if (!empty($group_ids) && !empty($this->user->data['group_id_set']))
			{
				foreach ($this->user->data['group_id_set'] as $group_id)
				{
					if (in_array($group_id, $group_ids))
					{
						return true;
					}
				}

				return false;
			}
		}

		// If we get here, there were no group restrictions so everyone can use this BBCode
		return true;
	}
}
