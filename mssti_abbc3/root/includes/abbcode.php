<?php
/**
* @package: phpBB 3.0.9 :: Advanced BBCode Box 3 -> root/includes
* @version: $Id: abbcode.php, v 3.0.10 10/13/11 2:19 PM VSE Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @co-author: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
**/

/**
* @ignore
* 
* Base article :
*	Custom BBCodes
* 		http://www.phpbb.com/community/viewtopic.php?f=46&t=579376
* 	Adding Custom BBCodes in phpBB3
* 		http://www.phpbb.com/kb/article/adding-custom-bbcodes-in-phpbb3/
* 
* Need New Ions ? :
*	http://www.famfamfam.com/lab/icons/silk/ 
* 
**/

if (!defined('IN_PHPBB'))
{
	exit;
}

global $abbcode;
$abbcode = new abbcode();

/**
* Advanced BBCode Box 3 class
* @package phpBB3
**/
class abbcode
{
	var $abbcode_config		= array();

	/* HTML was deprecated in v1.0.11 */
	/* UPLOAD was was deprecated in v3.0.7 */
	var $need_permissions	= array('URL', 'FLASH', 'IMG', 'THUMBNAIL', 'IMGSHACK', 'WEB', 'ED2K', 'RAPIDSHARE', 'TESTLINK', 'FLV' ,'BBVIDEO' /* ,'HTML' */ /* ,'UPLOAD' */ );

	// [testlinks] and [rapidshare] Hide link/s to guest and bots ?	
	var $hide_links			= false;	// Options true=hide / false=display, default false
	// [testlinks] and [rapidshare] Display the OK/WRONG image or use text ?
	var $img_links			= true;		// Options true=use image / false=use text, default true

	/**
	* Constructor
	* @version 3.0.7-PL1
	*/
	function abbcode()
	{
		if (!defined('IN_ABBC3'))
		{
			define('IN_ABBC3', true);
		}
		$this->abbcode_init();
	}

	/**
	* Initializate config vars...
	*
	* @param bool		$need_template
	* @return mixeed
	* @version 3.0.8
	**/
	function abbcode_init($need_template = true)
	{
		global $template, $user, $config, $phpbb_admin_path, $phpbb_root_path, $phpEx;

		/* ABBC3 can be disabed in-line - Start */
		if ($enable = request_var('abbc3disable', 0))
		{
			$config['ABBC3_MOD'] = false; 
			return false;
		}
		/* ABBC3 can be disabed in-line - End */

	//	if (empty($this->abbcode_config) || sizeof($this->abbcode_config) == 0)
	//	{
			// For overall_header.html
			$this->abbcode_config = array(
				'S_ABBC3_VERSION'		=> (isset($config['ABBC3_VERSION'])) ? $config['ABBC3_VERSION'] : '3.0.10',
				// Display ABBC3 ?
				'S_ABBC3_MOD'			=> (isset($config['ABBC3_MOD'])) ? $config['ABBC3_MOD'] : true,
				// Where the files are stored
				'S_ABBC3_PATH'			=> $phpbb_root_path . 'styles/abbcode',
				// Resize larger images ?
				'S_ABBC3_RESIZE'		=> (isset($config['ABBC3_RESIZE_METHOD'])) ? ($config['ABBC3_RESIZE_METHOD'] != 'none' ? true : false) : true,
				// Options are : AdvancedBox | HighslideBox | LiteBox | GreyBox | Lightview | Shadowbox | PopBox | pop-up | enlarge | samewindow | newwindow | none	
				'S_ABBC3_RESIZE_METHOD'	=> (isset($config['ABBC3_RESIZE_METHOD'])) ? $config['ABBC3_RESIZE_METHOD'] : 'AdvancedBox',
				// Display Resizer Info Bar ?
				'S_ABBC3_RESIZE_BAR'	=> (isset($config['ABBC3_RESIZE_BAR'])) ? $config['ABBC3_RESIZE_BAR'] : true,
				// Resize if image is bigger than...
				'S_ABBC3_MAX_IMG_WIDTH'	=> (isset($config['ABBC3_MAX_IMG_WIDTH'])) ? $config['ABBC3_MAX_IMG_WIDTH'] : $config['img_max_width'],
				'S_ABBC3_MAX_IMG_HEIGHT'=> (isset($config['ABBC3_MAX_IMG_HEIGHT'])) ? $config['ABBC3_MAX_IMG_HEIGHT'] : false,
				// Resize larger images in signatures ?
				'S_ABBC3_RESIZE_SIGNATURE'=> (isset($config['ABBC3_RESIZE_SIGNATURE'])) ? $config['ABBC3_RESIZE_SIGNATURE'] : false,
				// Resize if image is bigger than...
				'S_ABBC3_MAX_SIG_WIDTH'	=> (isset($config['ABBC3_MAX_SIG_WIDTH'])) ? $config['ABBC3_MAX_SIG_WIDTH'] : $config['img_max_width'],
				'S_ABBC3_MAX_SIG_HEIGHT'=> (isset($config['ABBC3_MAX_SIG_HEIGHT'])) ? $config['ABBC3_MAX_SIG_HEIGHT'] : false,
			);
/*
			// Styles and admin variables depends on locations
			$this->abbcode_config = array_merge($this->abbcode_config, array(
				// path from the very forum root
				'S_ABBC3_OVERALL_HEADER'	=> ((isset($phpbb_admin_path)) ? './../../' : './../../../') . str_replace($phpbb_root_path, '', $this->abbcode_config['S_ABBC3_PATH']) . '/abbcode_header.html',
				'S_ABBC3_POSTING_JAVASCRIPT'=> ((isset($phpbb_admin_path)) ? './../../' : './../../../') . str_replace($phpbb_root_path, '', $this->abbcode_config['S_ABBC3_PATH']) . '/posting_abbcode_buttons.js',
				'S_ABBC3_WIZARD_JAVASCRIPT'	=> ((isset($phpbb_admin_path)) ? './../../' : './../../../') . str_replace($phpbb_root_path, '', $this->abbcode_config['S_ABBC3_PATH']) . '/posting_abbcode_wizards.js',
			));
*/
			/** Display all _common_ variables that may be used at any point in a template. **/
			if ($need_template)
			{
				$template->assign_vars($this->abbcode_config);
			}

			// For posting_buttons.html -> posting_abbcode_buttons.html
			$this->abbcode_config = array_merge($this->abbcode_config, array(
				// Bakground image
				'ABBC3_BG'				=> (isset($config['ABBC3_BG'])) ? $config['ABBC3_BG'] : 'bg_abbc3.gif',
				// Display icon division for tags ?
				'ABBC3_TAB'				=> (isset($config['ABBC3_TAB'])) ? $config['ABBC3_TAB'] : 1,
				// Resize posting textarea ?
				'ABBC3_BOXRESIZE'		=> (isset($config['ABBC3_BOXRESIZE'])) ? $config['ABBC3_BOXRESIZE'] : true,
				// Usename posting
				'POST_AUTHOR'			=> (isset($user->data['username'])) ? $user->data['username'] : '',
				// Thumbnails width
				'ABBC3_MAX_THUM_WIDTH'	=> (isset($config['ABBC3_MAX_THUM_WIDTH'])) ? $config['ABBC3_MAX_THUM_WIDTH'] : $config['img_max_thumb_width'],
				// Width for posted video ?
				'ABBC3_VIDEO_WIDTH'		=> (isset($config['ABBC3_VIDEO_width'])) ? $config['ABBC3_VIDEO_width'] : 425,
				// Height for posted video ?
				'ABBC3_VIDEO_HEIGHT'	=> (isset($config['ABBC3_VIDEO_height'])) ? $config['ABBC3_VIDEO_height'] : 350,
				// Link to ABBC3 help page
				'ABBC3_HELP_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", 'mode=help'),
				// ABBC3 mode 
				'ABBC3_COMPACT'			=> (isset($config['ABBC3_UCP_MODE'])) ? $config['ABBC3_UCP_MODE'] : false,
				// Color picker
				'ABBC3_COLOR_MODE'		=> (isset($config['ABBC3_COLOR_MODE'])) ? $config['ABBC3_COLOR_MODE'] : 'phpbb',
				// Highlight picker
				'ABBC3_HIGHLIGHT_MODE'	=> (isset($config['ABBC3_HIGHLIGHT_MODE'])) ? $config['ABBC3_HIGHLIGHT_MODE'] : 'phpbb',
				// Link to ABBC3 wizards page
				'ABBC3_WIZARD_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", "mode=wizards"),
				// 0=Disable wizards | 1=Pop Up window | 2=In post (Ajax)
				'ABBC3_WIZARD_MODE'		=> (isset($config['ABBC3_WIZARD_MODE'])) ? (int) $config['ABBC3_WIZARD_MODE'] : 1,
				// Width for pop-up wizard window ?
				'ABBC3_WIZARD_WIDTH'	=> (isset($config['ABBC3_WIZARD_width'])) ? $config['ABBC3_WIZARD_width'] : 700,
				// Height for pop-up wizard window ?
				'ABBC3_WIZARD_HEIGHT'	=> (isset($config['ABBC3_WIZARD_height'])) ? $config['ABBC3_WIZARD_height'] : 400,
				// Link to ABBC3 tigra color picker page
				'ABBC3_TIGRA_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", "mode=tigra"),
				// Cookie
				'ABBC3_COOKIE_NAME'		=> $config['cookie_name'] . '_abbc3',
			));
	//	}
	}

	/**
	* Display posting page
	*
	* @param string $mode
	* @version 3.0.8
	**/
	function abbcode_display($mode)
	{
		global $db, $template, $user, $phpbb_admin_path, $phpbb_root_path, $post_id;

		$user->add_lang('mods/abbcode');

		/**
		* Get proper auth
		*	UCP page mode = signature
		* 	ACP page mode = sig
		* 	Posting page mode = post, edit, quote, reply
		* 	else should be PM
		**/
		$display = ($mode == 'signature' || $mode == 'sig') ? 'display_on_sig' : (($mode == 'post' || $mode == 'edit' || $mode == 'quote' || $mode == 'reply') ? 'display_on_posting' : 'display_on_pm');

		$sql = "SELECT abbcode, bbcode_tag, bbcode_order, bbcode_id, bbcode_group, bbcode_tag, bbcode_helpline, bbcode_image, display_on_posting 
				FROM " . BBCODES_TABLE . " 
				WHERE $display = 1 
				ORDER BY bbcode_order";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			/** Some fixes **/
			$is_abbcode		= ($row['abbcode']) ? true : false;
			$abbcode_name	= (($is_abbcode) ? 'ABBC3_' : '') . strtoupper(str_replace('=', '', trim($row['bbcode_tag'])));
			$abbcode_name	= ($row['bbcode_helpline'] == 'ABBC3_ED2K_TIP') ? 'ABBC3_ED2K' : $abbcode_name;

			$abbcode_image	= trim($row['bbcode_image']);
			$abbcode_mover	= (isset($user->lang[$abbcode_name . '_MOVER']	)) ? $user->lang[$abbcode_name . '_MOVER']   : $abbcode_name;
			$abbcode_tip	= (isset($user->lang[$abbcode_name . '_TIP']	)) ? $user->lang[$abbcode_name . '_TIP']     : (($is_abbcode) ? '' : $row['bbcode_helpline']);
			$abbcode_note	= (isset($user->lang[$abbcode_name . '_NOTE']	)) ? $user->lang[$abbcode_name . '_NOTE']    : '';
			$abbcode_example= (isset($user->lang[$abbcode_name . '_EXAMPLE'])) ? $user->lang[$abbcode_name . '_EXAMPLE'] : '';

			// Check phpbb permissions status
			// Check ABBC3 groups permission
			// try to make it as quicky as it can be 
			$auth_tag = preg_replace('#\=(.*)?#', '', strtoupper(trim($row['bbcode_tag'])));
			if ((isset($row['bbcode_group']) && $row['bbcode_group']) || in_array($auth_tag, $this->need_permissions))
			{
				if (!$this->abbcode_permissions($auth_tag, (isset($row['bbcode_group']) ? $row['bbcode_group'] : 0)))
				{
					continue;
				}
			}

			switch ($abbcode_name)
			{
				case 'ABBC3_FONT':
				case 'ABBC3_SIZE':
				case 'ABBC3_HIGHLIGHT':
				case 'ABBC3_COLOR':
					$template->assign_vars(array(
						'S_' . $abbcode_name	=> true,
						$abbcode_name . '_NAME'	=> strtolower($abbcode_name),
						$abbcode_name . '_MOVER'=> $abbcode_mover,
						$abbcode_name . '_TIP'	=> $abbcode_tip,
						$abbcode_name . '_NOTE'	=> $abbcode_note,
					));

				break;

				// Is a Line break ? -> abbc3_break(n)
				case (strpos($abbcode_name, 'ABBC3_BREAK') !== false) :
					$template->assign_block_vars('abbc3_tags', array('S_ABBC3_BREAK' => true));
				break;

				// Is a Division line ? -> abbc3_division(n)
				case (strpos($abbcode_name, 'ABBC3_DIVISION') !== false) :
					$template->assign_block_vars('abbc3_tags', array('S_ABBC3_DIVISION' => true));
				break;

				default:
					// Haven't image ? should be a phpbb3 custom bbcode from ACP, so let's phpbb3 take care of it
					if (!$abbcode_image)
					{
						break;
					}
					$template->assign_block_vars('abbc3_tags', array(
						'BBCODE_ABBC3'		=> ($is_abbcode) ? '1' : '0',
						'BBCODE_ID'			=> $row['bbcode_id'],
						'BBCODE_IMG'		=> $abbcode_image,
						'BBCODE_NAME'		=> strtolower($abbcode_name),
						'BBCODE_TAG'		=> "'[{$row['bbcode_tag']}]', '[/" . preg_replace('/(=.*)/i', '', $row['bbcode_tag']) . "]'",
						'BBCODE_MOVER'		=> $abbcode_mover,
						'BBCODE_TIP'		=> $abbcode_tip,
						'BBCODE_NOTE'		=> $abbcode_note,
						'BBCODE_EXAMPLE'	=> $abbcode_example,
					));
				break;
			}
		}
		$db->sql_freeresult($result);

		$template->assign_vars(array(
			'S_POST_ID'					=> ($post_id) ? $post_id : 0, //request_var('p', 0),
			'S_ABBC3_IN_WIZARD'			=> false,
			'S_ABBC3_IN_ADMIN'			=> (isset($phpbb_admin_path)) ? true : false,
			'S_ABBC3_BG'				=> $this->abbcode_config['ABBC3_BG'],
			// Display icon division for tags ?
			'S_ABBC3_TAB'				=> $this->abbcode_config['ABBC3_TAB'],
			// Resize posting textarea ?
			'S_ABBC3_BOXRESIZE'			=> $this->abbcode_config['ABBC3_BOXRESIZE'],
			// Usename posting 
			'S_POST_AUTHOR'				=> (isset($user->data['username'])) ? $user->data['username'] : '',
			// Width for posted video ?
			'S_ABBC3_VIDEO_WIDTH'		=> $this->abbcode_config['ABBC3_VIDEO_WIDTH'],
			// Height for posted video ?
			'S_ABBC3_VIDEO_HEIGHT'		=> $this->abbcode_config['ABBC3_VIDEO_HEIGHT'],
			// Link to ABBC3 tigra color picker page
			'S_ABBC3_TIGRA_PAGE'		=> $this->abbcode_config['ABBC3_TIGRA_PAGE'],
			// Link to ABBC3 help page
			'S_ABBC3_HELP_PAGE'			=> $this->abbcode_config['ABBC3_HELP_PAGE'],
			// Link to ABBC3 wizards page
			'S_ABBC3_WIZARD_PAGE'		=> $this->abbcode_config['ABBC3_WIZARD_PAGE'],
			// 0=Disable wizards | 1=Pop Up window | 2=In post (Ajax)
			'S_ABBC3_WIZARD_MODE'		=> $this->abbcode_config['ABBC3_WIZARD_MODE'],
			// Width for pop-up wizard window ?
			'S_ABBC3_WIZARD_WIDTH'		=> $this->abbcode_config['ABBC3_WIZARD_WIDTH'],
			// Height for pop-up wizard window ?
			'S_ABBC3_WIZARD_HEIGHT'		=> $this->abbcode_config['ABBC3_WIZARD_HEIGHT'],
			// Color picker
			'S_ABBC3_COLOR_MODE'		=> $this->abbcode_config['ABBC3_COLOR_MODE'],
			// Highlight picker
			'S_ABBC3_HIGHLIGHT_MODE'	=> $this->abbcode_config['ABBC3_HIGHLIGHT_MODE'],
			// Cookie
			'S_ABBC3_COOKIE_NAME'		=> $this->abbcode_config['ABBC3_COOKIE_NAME'],
			// Define the ABBC3 view, according this user preferences
			'S_ABBC3_COMPACT'			=> ($this->abbcode_config['ABBC3_COMPACT'] && isset($user->data['user_abbcode_compact'])) ? $user->data['user_abbcode_compact'] : false,
		));
	}

	/**
	* Check group bbcodes permissions
	* Check some bbcodes status permissions
	* @param string		$abbcode_name
	* @param mix		$bbcode_group
	* @return boolean	true / false
	* @version 3.0.8-PL1
	**/
	function abbcode_permissions($auth_tag = '', $bbcode_group = '')
	{
		global $user, $db, $auth;
		global $config, $forum_id, $mode;

		$return_value = true;

		/* Check group bbcodes permissions - Start */
		if ($bbcode_group)
		{
			// Always use arrays here ;)
			if (!is_array($bbcode_group))
			{
				$bbcode_group = explode(',', $bbcode_group);
			}

			// Do not run twice if it has already been executed earlier.
			if (!isset($user->data['agroup_id']))
			{
				$user->data['agroup_id'] = array();

				$sql = 'SELECT * 
						FROM ' . USER_GROUP_TABLE . ' 
						WHERE user_id = ' . $user->data['user_id'] . ' 
						AND user_pending = 0 ';
				$result = $db->sql_query($sql);

				while ($row = $db->sql_fetchrow($result))
				{
					$user->data['agroup_id'][] = $row['group_id'];
				}
				$db->sql_freeresult($result);
			}

			if (!empty($bbcode_group) && !empty($user->data['agroup_id']))
			{
				$return_value = false;

				foreach ($user->data['agroup_id'] as $agroup_data)
				{
					if (in_array($agroup_data, $bbcode_group))
					{
						// If this group can use it, take me out of here quickly !
						$return_value = true;
						break;
					}
				}
			}

			// If this bbcode is not allowed, do not continue checking
			if (!$return_value)
			{
				return $return_value;
			}
		}
		/* Check group bbcodes permissions - End */

		/* Check some bbcodes status permissions - Start */
		if ($auth_tag)
		{
			// if no mode is specified, use post settings
			$mode = (!$mode) ? request_var('mode', 'post') : $mode;

			switch ($auth_tag)
			{
				case 'THUMBNAIL':
				case 'IMGSHACK' :
					$auth_tag = 'IMG';
				break;

				case 'WEB' :
				case 'ED2K' :
				case 'RAPIDSHARE' :
				case 'TESTLINK' :
					$auth_tag = 'URL';
				break;

				case 'FLV' :
			//	Commented out, because we think bbvideo should not follow flash restrictions ;)
			//	case 'BBVIDEO' :
					$auth_tag = 'FLASH';
				break;

				default:
				break;
			}

			// Get phpbb bbcodes status
			switch ($mode)
			{
				// POSTING
				case 'post' :
				case 'edit' :
				case 'quote':
				case 'reply':
					$bbcode_status	= ($config['allow_bbcode'] && (($forum_id) ? $auth->acl_get('f_bbcode', $forum_id) : true)) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($bbcode_status && (($forum_id) ? $auth->acl_get('f_img', $forum_id) : true)) ? true : false,
						'URL'		=> ($config['allow_post_links']) ? true : false,
						'FLASH'		=> ($bbcode_status && (($forum_id) ? $auth->acl_get('f_flash', $forum_id) : true) && $config['allow_post_flash']) ? true : false,
					//	'QUOTE'		=> ($auth->acl_get('f_reply', $forum_id)) ? true : false,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
					);
				break;

				// ABBC3 HELP PAGE
				default :
				case 'help' :
					$bbcode_status = ($config['allow_bbcode']) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($bbcode_status) ? true : false,
						'URL'		=> ($bbcode_status && $config['allow_post_links']) ? true : false,
						'FLASH'		=> ($bbcode_status && $config['allow_post_flash']) ? true : false,
					//	'QUOTE'		=> $bbcode_status,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
					);
				break;

				// SIG
				case 'signature' :
				case 'sig' :
					$bbcode_status = ($config['allow_sig_bbcode']) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($bbcode_status && $config['allow_sig_img']) ? true : false,
						'URL'		=> ($bbcode_status && $config['allow_sig_links']) ? true : false,
						'FLASH'		=> ($bbcode_status && $config['allow_sig_flash']) ? true : false,
					//	'QUOTE'		=> $bbcode_status,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
					);
				break;

				// PM
				case 'compose' :
					$bbcode_status	= ($config['allow_bbcode'] && $config['auth_bbcode_pm'] && $auth->acl_get('u_pm_bbcode')) ? true : false;
					$status_ary  = array(
						'IMG'		=> ($config['auth_img_pm'] && $auth->acl_get('u_pm_img')) ? true : false,
						'URL'		=> ($config['allow_post_links']) ? true : false,
						'FLASH'		=> ($config['auth_flash_pm'] && $auth->acl_get('u_pm_flash')) ? true : false,
					//	'QUOTE'		=> $bbcode_status,
						'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false ,
					);
				break;
			}

			foreach ($status_ary as $phpbb3_bbcode => $value)
			{
				if (strtoupper($auth_tag) == $phpbb3_bbcode)
				{
					// if I can not use it, take me out of here quickly !
					$return_value = $value;
					break;
				}
			}

			// If this bbcode was rejected, do not continue 
			if (!$return_value)
			{
				return $return_value;
			}
		}
		/* Check some bbcodes status permissions - End */

		return $return_value;
	}

	/**
	* Parsing the tables  - Second pass.
	*
	* @param string		$stx	table style
	* @param string		$in 	post text between [table] & [/table]
	* @return string	table
	* @version 3.0.8
	* @todo: 
	* 	root/includes/funtions_content.php -> strip_bbcode()
	* 	$table_ary = array(
	*		"#\[tr=(.*?)\](.*?)\[/tr\]#is",
	*		"#\[td=(.*?)\](.*?)\[/td\]#is",
	*	);
	*	$text = preg_replace($table_ary, '\2', $text);
	*
	**/
	function table_pass($stx, $in)
	{
		global $user;

		// Check for unsafe html & css attributes only inside the style string
		$unsafe = array();

		$unsafe = $this->safehtml($stx);

		$matches = preg_match_all('#\[(tr|td)=(.*?)\]#', $in, $match);
		for ($i = 0; $i < $matches; $i++)
		{
			if (empty($match[2][$i]))
			{
				continue;
			}
			$unsafe = array_merge($unsafe, $this->safehtml($match[2][$i]));
		}

		if (sizeof($unsafe))
		{
			return  '[table=' . $stx . ']' . $in . '[/table] <p class="error">' . sprintf($user->lang['ABBC3_UNAUTHORISED'] , implode('<br />', $unsafe)) . '</p>';
		}

		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	= str_replace(array("]\r\n", "]\r", "]\n", "\r\n[", "\r[", "\n[", '\"', '\'', '(', ')'), array("]\n", ']', ']', "\n[", '[', '[', '"', '&#39;', '&#40;', '&#41;'), trim($in));

		$table_ary = array(
			"#\[tr\](.*?)\[/tr\]#ies"			=> "'<tr>' . trim('\$1') . '</tr>'",
			"#\[tr\=(.*?)\](.*?)\[/tr\]#ies"	=> "'<tr style=\"' . trim('\$1') . '\">' . trim('\$2') . '</tr>'",
			"#\[td\](.*?)\[/td\]#ies"			=> "'<td>' . trim('\$1') . '</td>'",
			"#\[td\=(.*?)\](.*?)\[/td\]#ies"	=> "'<td style=\"' . trim('\$1') . '\">' . trim('\$2') . '</td>'",
		);

		foreach ($table_ary as $abbcode_found => $abbcode_replace)
		{
			if (preg_match($abbcode_found, $in))
			{
				// when using the /e modifier, preg_replace slashes double-quotes but does not
				// seem to slash anything else
				$in = str_replace('\"', '"', preg_replace($abbcode_found, $abbcode_replace, $in));
			}
		}

		return '<table ' . (($stx) ? 'style="' . $stx . '" ' : '') . 'cellspacing="0" cellpadding="0">' . $in .'</table>';
	}

	/**
	* Parsing the anchor - Second pass.
	*
	* @param int		$a_id	anchor ID
	* @param string		$a_href	link to go
	* @param string		$string	Some text to display
	* @return 			html string
	* @version 1.0.12
	**/
	function anchor_pass($a_id, $a_href, $string)
	{
		$a_id	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($a_id));
		$a_href	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($a_href));
		$string	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($string));

		// If no id and no href, the bcode is not well formed
		if (!$a_id && !$a_href)
		{
			return '[anchor= ]' . $string . '[/anchor]';
		}

		// Makes a id
		if (!$a_id)
		{
			global $post_id;
			$a_id = $post_id . $a_href;
		}

		// If it's an anchor
		if ($a_href != '')
		{
			/**
			* Fix for SEO MOD : http://www.phpbb-seo.com/en/phpbb-forum/article4493.html#p26303 
			**/
			$extra = (class_exists('phpbb_seo')) ? 'onclick="document.location.hash = \'' .$a_href . '\'; return false;"' : '';

			return str_replace(array('{ANCHOR_ID}','{ANCHOR_HREF}', '{ANCHOR_TEXT}', '{ANCHOR_EXTRA}'), array($a_id, $a_href, $string, $extra), $this->bbcode_tpl('anchor_link'));
		}
		// Isn't an anchor
		else
		{
			return str_replace(array('{ANCHOR_ID}','{ANCHOR_TEXT}'), array($a_id, $string), $this->bbcode_tpl('anchor_element'));
		}
	}

	/**
	* Code based of : SafeHTML Parser 1.3.7
	* http://www.boonex.com/trac/dolphin/browser/tags/6.1/plugins/safehtml/safehtml.php
	* Updated by MSSTI
	* @version 3.0.7-PL1
	**/
	function safehtml($string)
	{
		// Sometimes users can write tags like m\o\z\-\b\i\n\d\i\n\g, this fix it
		$string = strtolower(str_replace(array("\\", '&#40;', '&#41;', '&amp;'), array("", '(', ')', '&'), $string));

		////
		// You can change this option to your liking, can delete or disable. 
		// eg : if you want to disable url use /*'url',*/
		////

		// dangerous protocols
		$blackProtocols = array('url', 'about', 'chrome', 'data', 'disk', 'hcp', 'help', 'javascript', 'livescript', 'lynxcgi', 'lynxexec', 'ms-help', 'ms-its', 'mhtml', 'mocha', 'opera', 'res', 'resource', 'shell', 'vbscript', 'view-source', 'vnd.ms.radio', 'wysiwyg');

		// dangerous CSS keywords
		$cssKeywords = array('absolute', 'behavior', 'behaviour', 'content', 'expression', 'fixed', 'include-source', 'moz-binding', "(", ")", "?", "&");

		$search = array_merge($blackProtocols, $cssKeywords);

		$error = array();
		foreach ($search as $value)
		{
			$tmp_pos = strpos($string, $value);
			if ($tmp_pos !== false)
			{
				$error[] = $value;
				continue;
			}
		}
		return $error;
	}

	/**
	* Parsing the e-links  - Second pass.
	* 
	* Inspired in :	MOD Title: eD2k links processing with availability statistics
	* 				MOD Author: Meithar, then updated by Bill Hicks, C0de_m0nkey and DonGato (current maintainer)
	*
	* @param string		$bbcode_id
	* @param string		$var1		ed2k url
	* @param string		$var2		ed2k name
	* @return bbcode 	template replacement
	* @version 3.0.8
	* 
	* link eD2k basics					: ed2k://|file|>File Name<|>File size<|>File Hash<|/
	* link eD2k with set of hashes		: ed2k://|file|>File Name<|>File size<|>File Hash<|p=>set of hashes<|/
	* link eD2k with sources			: ed2k://|file|>File Name<|>File size<|>File Hash<|/|sources,>IP:PORT<|/
	* link eD2k with host				: ed2k://|file|>File Name<|>File size<|>File Hash<|/|sources,>Host Name:PORT<|/
	* link eD2k in HTML					: <a href= "ed2k://|file|>File Name<|>File size<|>File Hash<|/">File Name to display</a>
	* link eD2k with HTTP sources		: ed2k://|file|>File Name<|>File size<|>File Hash<|s=http://Web Adress/File|/
	* link eD2k with root hashe			: ed2k://|file|>File Name<|>File size<|>File Hash<|h=>Root hash<|/
	**/
	function ed2k_pass($bbcode_id, $var1, $var2)
	{
		global $user;

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		$var1 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($var1));
		$var2 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($var2));
		$link = str_replace(array(' ', '%20'), array('',''), (($var1) ? $var1 : $var2));

		$ed2k_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/emule.gif';
		$ed2k_stat	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/stats.gif';

		$matches = preg_match_all("#(^|(?<=[^\w\"']))(ed2k://\|(file|server|friend)\|([^\\/\|:<>\*\?\"]+?)\|(\d+?)\|([a-f0-9]{32})\|(.*?)/?)(?![\"'])(?=([,\.]*?[\s<\[])|[,\.]*?$)#i", $link, $match);

		if ($matches)
		{
			foreach ($match[0] as $i => $m)
			{
				$ed2k_link	= (isset($match[2][$i])) ? $match[2][$i] : '';
				// Only for testing propose, commented out so I do not loose the code.
			//	$ed2k_type	= (isset($match[3][$i])) ? $match[3][$i] : '';
				$ed2k_size	= (isset($match[5][$i])) ? $match[5][$i] : '';
				$ed2k_hash	= (isset($match[6][$i])) ? $match[6][$i] : '';

				$max_len	= 100;
				$ed2k_name	= (!$var2) ? (isset($match[4][$i])) ? $match[4][$i] : '' : $var2;

				if (!$var2)
				{
					$ed2k_name	= (strlen($ed2k_name) > $max_len) ? substr($ed2k_name, 0, $max_len - 19) . '...' . substr($ed2k_name, -16) : $ed2k_name;
				}
				return str_replace(array('{ED2K_ICON}', '{ED2K_URL}', '{ED2K_NAME}', '{ED2K_SIZE}', '{ED2K_HASH}', '{ED2K_STAT}'), array($ed2k_icon, $ed2k_link, $ed2k_name, abbc3_ed2k_humanize_size($ed2k_size), $ed2k_hash, $ed2k_stat), $this->bbcode_tpl('ed2k_file'));
			}
		}
		else
		{
			if(preg_match("#(^|(?<=[^\w\"']))(ed2k://\|server\|([\d\.]+?)\|(\d+?)\|/?)#i", $link))
			{
				return preg_replace("#(^|(?<=[^\w\"']))(ed2k://\|server\|([\d\.]+?)\|(\d+?)\|/?)#i", $user->lang['ABBC3_ED2K_SERVER'] . ': <a href="$2" class="postLink">$3:$4</a>', $link);
			}
			// ed2k://|serverlist|url
			else if(preg_match("#(^|(?<=[^\w\"']))(ed2k://\|serverlist\|". get_preg_expression('url') ."\|/?)#i", $link))
			{
				return preg_replace("#(^|(?<=[^\w\"']))(ed2k://\|serverlist\|". get_preg_expression('url') ."\|/?)#i", $user->lang['ABBC3_ED2K_SERVERLIST'] . ': <a href="$2" class="postLink">$2</a>', $link);
			}
			// ed2k://|friend|name|clientIP|clientPort
			else if(preg_match("#(^|(?<=[^\w\"']))(ed2k://\|friend\|([^\\/\|:<>\*\?\"]+?)\|([\d\.]+?)\|(\d+?)\|/?)#i", $link))
			{
				return preg_replace("#(^|(?<=[^\w\"']))(ed2k://\|friend\|([^\\/\|:<>\*\?\"]+?)\|([\d\.]+?)\|(\d+?)\|/?)#i", $user->lang['ABBC3_ED2K_FRIEND'] . ': <a href="$2" class="postLink">$3</a>', $link);
			}
			else
			{
				$var2 = ($var1) ? $var1 : $var2;
				return str_replace('$1', $var1, str_replace('$2', $var2, $this->bbcode_tpl('url', $bbcode_id, true)));
			}
		}
	}

	/**
	* Parsing the serch text - Second pass.
	*
	* @param string		$stx	have search name param?
	* @param string		$in		post text between [search] & [/search]
	* @param string		$search (bing|yahoo|google|altavista|wikipedia|lycos)
	* @return string	link
	* @version 1.0.12
	**/
	function search_pass($stx, $in , $search)
	{
		global $user;

		$search = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($search));
		$in	 	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;

		switch ($in)
		{
			case 'bing' :
				$search_link = 'http://www.bing.com/search?q=' . str_replace(' ', '+', $search);
			break;

			case 'yahoo' :
				$search_link = 'http://search.yahoo.com/search?p=' . str_replace(' ', '+', $search);
			break;

			case 'google' :
				$search_link = 'http://www.google.com/search?q=' . str_replace(' ', '+', $search);
			break;

			case 'altavista':
				$search_link = 'http://www.altavista.com/web/results?itag=ody&amp;q=' . str_replace(' ', '+', $search); //&amp;mkt=tr-TR&amp;lf=1
			break;

			case 'wikipedia':
				// by default the search is in English language, but you can customize it,
				// simply replace    ->en<-     with your language prefix for wikipedia :)
				$search_link = 'http://en.wikipedia.org/wiki/Spezial:Search?search=' . str_replace(' ', '%20', $search);
			break;

			case 'lycos':
				$search_link = 'http://search.lycos.com/?query=' . str_replace(' ', '+', $search);
			break;

			default :
				global $config, $phpEx;
				$search_link = 'search.' . $phpEx . '?keywords=' . str_replace(' ', '%20', $search);
				$in = $config['sitename'];
			break;
		}
		return str_replace(array('{SEARCH_SITE}','{SEARCH_TEXT}', '{URL}' ,'{SEARCH_STRING}'), array(strtolower($in), strtolower($user->lang['SEARCH_MINI']), $search_link, $search), $this->bbcode_tpl('search'));
	}

	/**
	* Parsing thumbnail images - Second pass.
	*
	* @param string		$stx	align (left|center|right|float-left|float-right)
	* @param string		$in		URL = post text between [thumbnail=(left|center|right|float-left|float-right)] & [/thumbnail]
	* @return string	image
	* @version 3.0.8
	**/
	function thumb_pass($stx, $in)
	{
		global $user;

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;
		$w	 = $this->abbcode_config['ABBC3_MAX_THUM_WIDTH'];

		// If the user choice do not see images, return a link
		if (!$user->optionget('viewimg'))
		{
			return str_replace(array('$1', '$2'), array($in, '[ img ]'), $this->bbcode_tpl('url', -1, true));
		}

		// Check for url_fopen
		if (@ini_get('allow_url_fopen') == '1' || strtolower(@ini_get('allow_url_fopen')) == 'on')
		{
			// Check if we can reach the image
 			$img_filesize = (file_exists($in)) ? @filesize($in) : false;
			if ($img_filesize)
			{
				// check image with timeout to ensure we don't wait quite long
				$timeout = @ini_get('default_socket_timeout');
				@ini_set('default_socket_timeout', 2);
				$dimension = @getimagesize($in);
				@ini_set('default_socket_timeout', $timeout);
				// If the dimensions could be determined check if we need to adjust the size
				if ($dimension !== false || !empty($dimension[0]))
				{
					if ($dimension[0] < $w)
					{
						$w = $dimension[0];
					}
				}
			}
		}

		switch (strtolower($stx))
		{
			case 'float-left':
			case 'float-right':
				$stx = str_replace('float-', '', $stx);
					return str_replace(array('{FLOAT}', '{URL}' ,'{WIDTH}'), array($stx, $in, $w), $this->bbcode_tpl('thumb_float'));
					break;
			// I know the ccs float:center doesn't exist, but just in case ;)
			case 'float-center':
				$stx = str_replace('float-', '', $stx);
			//	no break;
			case 'left':
			case 'right':
			case 'center':
				return str_replace(array('{ALIGN_TYPE}', '{URL}' ,'{WIDTH}'), array($stx, $in, $w), $this->bbcode_tpl('thumb_aligned'));
			break;

			default:
				return str_replace(array('{URL}' ,'{WIDTH}'), array($in, $w), $this->bbcode_tpl('thumb'));
			break;
		}

		// In case everything fails, return it as it was posted
		return "[thumbnail={$stx}]{$in}[/thumbnail]";
	}

	/**
	* Parsing the images aligned - Second pass.
	*
	* @param string		$stx	align (left|center|right|float-left|float-right)
	* @param string		$in		post text between [img=(left|center|right|float-left|float-right)] & [/img]
	* @return string	image
	* @version 3.0.8
	**/
	function img_pass($stx, $in)
	{
		global $user;

		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));

		// If the user choice do not see images, return a link
		if (!$user->optionget('viewimg'))
		{
			return str_replace(array('$1', '$2'), array($in, '[ img ]'), $this->bbcode_tpl('url', -1, true));
		}

		switch (strtolower($stx))
		{
			case 'float-left':
			case 'float-right':
				$stx = str_replace('float-', '', $stx);

				if (empty($this->abbcode_config))
				{
					$this->abbcode_init(false);
				}

				if ($this->abbcode_config['S_ABBC3_RESIZE'])
				{
					return str_replace(array('{FLOAT}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_float_bar'));
					break;
				}
				else
				{
					return str_replace(array('{FLOAT}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_float'));
					break;
				}

			// I know the ccs float:center doesn't exist, but just in case ;)
			case 'float-center':
				$stx = str_replace('float-', '', $stx);
			//	no break;
			case 'left':
			case 'right':
			case 'center':
				return str_replace(array('{ALIGN_TYPE}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_aligned'));
			break;

			default:
				return str_replace(array('$1'), array($in), $this->bbcode_tpl('img', -1, true));
			break;

		}

		// In case everything fails, return it as it was posted
		return "[img={$stx}]{$in}[/img]";
	}

	/**
	* Parsing the Moderator tag - Second pass.
	*
	* @param string		$stx	have user name param?
	* @param string		$in		post text between [mod] & [/mod]
	* @return string	table with message data
	* @version 3.0.7-PL1
	**/
	function moderator_pass($stx, $in)
	{
		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')', '&quot;'), array("\n", '', '&#39;', '&#40;', '&#41;', ''), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;

		return str_replace(array('{MOD_USER}', '{MOD_TEXT}'), array($stx, $in), $this->bbcode_tpl('moderator'));
	}

	/**
	* Parsing the offtopic tag - Second pass.
	*
	* @param string		$in		post text between [offtopic] & [/offtopic]
	* @return string	table with message data
	* @version 1.0.11
	**/
	function offtopic_pass($in)
	{
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;

		return str_replace('{OFFTOPIC_TEXT}', $in, $this->bbcode_tpl('offtopic'));
	}

	/**
	* Parsing the spoiler tag - Second pass.
	*
	* @param string		$in		post text between [spoil] & [/spoil]
	* @version 3.0.6
	**/
	function spoil_pass($in)
	{
		global $user;

		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;
		return str_replace(array('{SPOILER_SHOW}', '{LA_SPOILER_SHOW}', '{LA_SPOILER_HIDE}', '{SPOILER_TEXT}'), array($user->lang['SPOILER_SHOW'], "'" . addslashes($user->lang['SPOILER_SHOW']) . "'", "'" . addslashes($user->lang['SPOILER_HIDE']) . "'", $in), $this->bbcode_tpl('spoiler'));
	}

	/**
	* Parsing the hidden tag - Second pass.
	* @param string		$in		post text between [hidden] & [/hidden]
	* @version 3.0.6
	**/
	function hidden_pass($in)
	{
		global $user;

		if ($user->data['user_id'] == ANONYMOUS || $user->data['is_bot'])
		{
			return str_replace(array('{HIDDEN_ON}', '{HIDDEN_TEXT}'), array($user->lang['HIDDEN_ON'], $user->lang['HIDDEN_EXPLAIN']), $this->bbcode_tpl('hidden'));
		}
		else
		{
		//	$in	= make_clickable(trim(str_replace('\"', '',preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$3',$in))));
			$in	= make_clickable(trim(preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$3', $in)));
			$in	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;
			return str_replace(array('{HIDDEN_OFF}', '{UNHIDDEN_TEXT}'), array($user->lang['HIDDEN_OFF'], $in), $this->bbcode_tpl('unhidden'));
		}
	}

	/**
	* Parsing the NFO text - Second pass.
	*
	* @param string		$in		post text between [nfo] & [/nfo]
	* @return string	table with nfo data
	* @version 1.0.11
	**/
	function nfo_pass($in)
	{
		global $user;

		$in = htmlentities($in, ENT_NOQUOTES, 'UTF-8');	
		return str_replace(array('{NFO_TITLE}', '{NFO_TEXT}'), array($user->lang['ABBC3_NFO_TITLE'], str_replace(" ", "&nbsp;", $in)), $this->bbcode_tpl('nfo'));
	}

	/**
	* Parsing the (x)HTML - Second pass.
	*
	* @param string		$in		post text between [html] & [/html]
	* @return string	(x)HTML data
	*
	* THIS FUNTION IS DEPRECATED SINCE VERSION 1.0.11 ! suggested by MOD Team 
	* So warn the user about this if he is still using the old database
	**/
	function html_pass($in)
	{
		global $user;

		return sprintf($user->lang['ABBC3_DEPRECATED'], 'html', '1.0.11');
	}

	/**
	* Modifies screenplay format text for inclusion in posts
 	* Code based off :
	*	http://scrippets.org/
	*	http://johnaugust.com/archives/2008/scrippets-php-and-a-call-to-coders
 	* 	Drupal module by Matt Chapman http://drupal.org/user/143172
	* Test :
	* 	http://scrippet.net/wordpress/?p=87#comment-238
	* @version 1.0.12
 	**/
	function scrippets_pass($in)
	{
		$in				= str_replace(array('&#40;', '&#41;'), array('(', ')'), trim($in));
		$theText		= explode("\n", $in);
		$output			= '';
		$dialogueBlock	= false;
		$sceneHeaders	= array('INT', 'EXT', 'EST', 'I/E');
		$transitions	= array('CUT ', 'FADE', 'JUMP');

		foreach($theText as $line)
		{
			$trans = array('<br />' => '', '<p>' => '', '</p>' => '');
			$line = strtr(trim($line), $trans);

			if ($line == '')
			{
				continue;
			}

			/* check for parenthical */
			if($line[0] == '(')
			{
				$output .= '<p class="parenthetical">' . $line . '</p>';
				$dialogueBlock = true;
				continue;
			}

			/* line must be dialogue */
			if($dialogueBlock == true)
			{
				$output .= '<p class="dialogue">' . $line . '</p>';
				$dialogueBlock = false;
				continue;
			}

			/* must be header, transition, or character */
			if($line == strtoupper($line))
			{
				/* check for header (INT or EXT or EST) */
				if(in_array(substr($line, 0, 3), $sceneHeaders))
				{
					$output .= '<p class="sceneheader">' . $line . '</p>';
				}
				/* check for transition (CUT or FADE or JUMP) or any uppercase line ended with a : */
				else if(in_array(substr($line, 0, 4), $transitions) || substr($line, -1) === ':')
				{
					$output .= '<p class="transition">' . $line . '</p>';
				}
				/* must be character */
				else
				{
					$output .= '<p class="character">' . $line . '</p>';
					$dialogueBlock = true;
				}
			}
			/* default to action */
			else
			{
				$output .= '<p class="action">' . $line . '</p>';
			}
		}
		/* Regular Expression Magic! */
		$output = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($output));

		return str_replace('{SCRIPPET_TEXT}', $output, $this->bbcode_tpl('scrippet'));
	}

	/**
	* Enter link checker
	*
	* @param string		$in 	post text between [testlink] &[/testlink]
	* @return string	link with text ok/wrong
	* @version 3.0.8
	**/
	function testlink_pass($in)
	{
		global $user;

		// If hide links is enabled and the user is a guest or a bots, do not display it !
		if ($this->hide_links && ($user->data['user_id'] == ANONYMOUS || $user->data['is_bot']))
		{
			return '<dl class="codebox codecontent" style="display:inline; padding: 0px;"><dd style="display:inline;color:#ff0000">'. $user->lang['LOGIN_EXPLAIN_VIEW'] . '</dd></dl>';
		}

		// Safety Check if CURL is present
		if (!function_exists ('curl_init'))
		{
			// Output an error message
			$linktest_echo = $user->lang['ABBC3_CURL_ERROR'];
		}
		else
		{
			if (empty($this->abbcode_config))
			{
				$this->abbcode_init(false);
			}

			$in	= trim($in);
			$ok_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/ok.gif';
			$error_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/error.gif';


			$linktest		 = new linktest();
			$linktest_links	 = explode("\n", $in);
			$linktest_result = array();
			$linktest_echo	 = '';

			foreach ($linktest_links as $linktest_value)
			{
				if (trim($linktest_value) !== '')
				{
					// undo make_clickable_callback(); and Remove Comments from post content
					$linktest_value		= trim(str_replace('\"', '',preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$3',$linktest_value)));
				//  After made changes in : http://www.phpbb.com/kb/article/links-opening-new-windows/
				//	$linktest_value		= trim(str_replace('\"', '',preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?) onclick=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$3', trim($linktest_value))));

					// if there is no scheme, then add http schema
					if (!preg_match('#^[a-z0-9]+://#i', $linktest_value))
					{
						$linktest_value = 'http://' . $linktest_value;
					}
					$linktest_return	= $linktest->test($linktest_value);

					if (!$linktest_return)
					{
						$linktest_msg	= '<span class="abbc3_wrong">' . $user->lang['ABBC3_TESTLINK_WRONG'] . '</span>';
						$linktest_pic	= '<img src="' . $error_icon . '" class="postimage" alt="' . $user->lang['ABBC3_TESTLINK_WRONG'] . '" title="' . $user->lang['ABBC3_TESTLINK_WRONG'] . '" />';
					}
					else
					{
						$linktest_msg	= '<span class="abbc3_good">' . $user->lang['ABBC3_TESTLINK_GOOD'] . '</span>';
						$linktest_pic	= '<img src="' . $ok_icon . '"    class="postimage" alt="' . $user->lang['ABBC3_TESTLINK_GOOD'] .'" title="' . $user->lang['ABBC3_TESTLINK_GOOD'] .'" />';
					}

					$linktest_value		= '<a href="' .$linktest_value . '" onclick="window.open(this.href);return false;" title="' .$linktest_value . '" >' . $linktest_value . '</a>';
					$linktest_result[]	= array('link' => $linktest_value, 'pic' => $linktest_pic, 'msg' => $linktest_msg);
				}
			}

			if (count($linktest_result) > 0)
			{
				foreach ($linktest_result as $linktest_data)
				{
					// If img_links is enabled use images, else use string
					$linktest_echo .= (($this->img_links) ? $linktest_data['pic'] . '&nbsp;' . $linktest_data['link'] : $linktest_data['link'] . '&nbsp;' . $linktest_data['msg']) . "<br />";
				}
			}
			unset($linktest, $linktest_result);
		}
		return '<dl class="testlink"><dd>'. $linktest_echo . '</dd></dl>';
	}

	/**
	* Enter rapidshare checker
	*
	* @param string		$in 	post text between [rapidshare] &[/rapidshare]
	* @return string	link with text ok/wrong
	* @version 3.0.8
	**/
	function rapidshare_pass($in)
	{
		global $user;

		// If hide links is enabled and the user is a guest or a bots, do not display it !
		if ($this->hide_links && ($user->data['user_id'] == ANONYMOUS || $user->data['is_bot']))
		{
			return '<dl class="codebox codecontent" style="display:inline; padding: 0px;"><dd style="display:inline;color:#ff0000">'. $user->lang['LOGIN_EXPLAIN_VIEW'] . '</dd></dl>';
		}

		if (ini_get('allow_url_fopen') != 1)
		{
			return $user->lang['ABBC3_FOPEN_ERROR'] ;
		}

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		$in = trim($in);
		$ok_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/ok.gif';
		$error_icon	= $this->abbcode_config['S_ABBC3_PATH'] . '/images/error.gif';
		$rapidshare_echo	 = '';

		$rapidshare_links	 = explode("\n", $in);
		if (sizeof($rapidshare_links) > 1)
		{
			// undo make_clickable_callback(); and Remove Comments from post content
			return "[rapidshare]" . str_replace('\"', '',preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$2',$in)) . "[/rapidshare]";
		}

		$rs_checkfiles = @fopen("http://rapidshare.com/cgi-bin/checkfiles.cgi?urls=" . $in, "r");
		if ($rs_checkfiles !== false)
		{
			while (!feof ($rs_checkfiles))
			{
				$buffer = @fgets($rs_checkfiles, 4096);
				if (eregi('File is on server number', $buffer))
				{
					$rapidshare_msg = '<span class="abbc3_good">' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '</span>';
					$rapidshare_pic = '<img src="' . $ok_icon . '" class="postimage" alt="' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '" title="' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '" />';
					break;
				}
				else
				{
					$rapidshare_msg = '<span class="abbc3_wrong">' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '</span>';
					$rapidshare_pic = '<img src="' . $error_icon . '" class="postimage" alt="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" title="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" />';
					break;
				}
			}
			fclose ($rs_checkfiles);
		}
		else
		{
			$rapidshare_msg = '<span class="abbc3_wrong">' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '</span>';
			$rapidshare_pic = '<img src="' . $error_icon . '" class="postimage" alt="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" title="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" />';	
		}

		// If img_links is enabled use images, else use string
		$rapidshare_echo .= '<a href="' . $in . '" title="' . $in . '" onclick="window.open(this.href);return false;">' . $in . '</a>' . (($this->img_links) ? '&nbsp;' . $rapidshare_pic : '&nbsp;' . $rapidshare_msg) . "<br />";

		return '<dl class="testlink"><dd>'. $rapidshare_echo . '</dd></dl>';
	}

	/**
	* Count the number of click on a link or image
	*
	* @param string		$var1	post text after [click(=(.*))]
	* @param string		$var2	post text between [click] &[/click]
	* @return string	link or none
	* @version 1.0.11
	**/
	function click_pass($var1, $var2)
	{
		global $db, $user, $phpbb_root_path, $phpEx;

		$var1 = str_replace("\r\n", "\n", str_replace('\"', '"', trim($var1)));
		$var2 = str_replace("\r\n", "\n", str_replace('\"', '"', trim($var2)));

		$url = ($var1) ? $var1 : $var2;

		if ($var1 && !$var2)
		{
			$var2 = $var1;
		}

		if (!$url)
		{
			return '[click' . (($var1) ? '=' . $var1 : '') . ']' . $var2 . '[/click]';
		}

		$valid = false;

		$url = str_replace(' ', '%20', $url);

		// Checking urls
		if (preg_match('#^' . get_preg_expression('url') . '$#i', $url) ||
			preg_match('#^' . get_preg_expression('www_url') . '$#i', $url) ||
			preg_match('#^' . preg_quote(generate_board_url(), '#') . get_preg_expression('relative_url') . '$#i', $url))
		{
			$valid	= true;
			$data	= array(
				'url' => str_replace(array('&#58;', '&#46;'), array(':', '.'), addslashes($url)),
			);
		}

		// Checking image urls/src
		if (preg_match("#<img((.*?))\/>#si", $url))
		{
			$valid	= true;
			$url	= str_replace('%20 ', ' ', $var2);
			$data	= array(
				'url' => preg_replace('#<img src="(.*?)"((.*?))\/>#si', '$1', $var2),
			);
		}		

		if ($valid)
		{
			$sql = 'SELECT id, clicks FROM ' . CLICKS_TABLE . ' WHERE ' . $db->sql_build_array('SELECT', $data);
			$result = $db->sql_query($sql);

			if($row = $db->sql_fetchrow($result))
			{
				$clicks_id = $row['id'];
				$clicks_val= $row['clicks'];
			}
			else
			{
				$sql = 'INSERT INTO ' . CLICKS_TABLE . ' ' . $db->sql_build_array('INSERT', $data);
				$db->sql_query($sql);

				$clicks_id = $db->sql_nextid();
				$clicks_val= '0';
			}
			$db->sql_freeresult($result);

			$user->add_lang('mods/abbcode');
			// Link to ABBC3 simple redirect page
			$redirect = append_sid("{$phpbb_root_path}abbcode_page.$phpEx", "mode=click&amp;id=$clicks_id");
			return '<a href="' . $redirect . '" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;" >' . (($var1) ? $var2 : $url) . '</a> ' . sprintf((($clicks_val == 1) ? $user->lang['ABBC3_CLICK_TIME'] : $user->lang['ABBC3_CLICK_TIMES']), $clicks_val);
		}
		return '[click' . (($var1) ? '=' . $var1 : '') . ']' . $var2 . '[/click]';
	}

	/**
	* Enter description here...
	* Code based off :
	* 	http://pirex.com.br/wordpress-plugins/post-tabs/
	* 	http://labs.komrade.gr/simpletabs/
	* @param string		$in 	post text between [tabs] &[/tabs]
	* @return string	html code
	* @version 1.0.12
	**/
	function simpleTabs_pass($in)
	{
		static $postTabs_pass;
		/** Only remove the initial new line */
		$posttext	= str_replace(array("]\r\n", "]\r", "]\n", '\"', '\'', '(', ')'), array("]\n", ']', ']', '"', '&#39;', '&#40;', '&#41;'), trim($in));
	//	$posttext	= str_replace(array("\r\n", "\r", "\n", '\"', '\'', '(', ')'), array("\n", '', '', '"', '&#39;', '&#40;', '&#41;'), trim($in));
	//	$posttext	= str_replace(array('\"', '\'', '(', ')'), array('"', '&#39;', '&#40;', '&#41;'), trim($in));
		$tag		= '[tabs:';
		$offset		= 0;

		/** Search for tabs inside the post **/
		if (is_int(strpos($posttext, $tag, $offset)))
		{
			$postTabs_pass++;

			/** Reset some default data **/
			$output_start		= '';
			$output				= '';
			$output_rest		= '';
			$vai				= true;
			$results_i			= array();
			$results_f			= array();
			$results_t			= array();

			/** Find the begining, the end and the title for the tabs **/
			while ($vai)
			{
				$r = strpos($posttext, $tag, $offset);
				if (is_int($r))
				{
					array_push($results_i, $r);
					$offset = $r + 1;
					$f = strpos($posttext, ']', $offset);
					if ($f)
					{
						array_push($results_f, $f);
						// Deleting the $tag fom the title
						array_push($results_t, substr($posttext, $r+6, $f-($r+6)));
					}
				}
				else
				{
					$vai = false;
				}
			};
			$results_t_size = sizeof($results_t);

			/** If there is text before the first tab, print it **/
			If ($results_i[0] > 0)
			{
				$output_start .= substr($posttext, 0, $results_i[0]);
			}

			$output .= '<div class="simpleTabs">';

			/** Print the list of tabs **/
			$output .= '<ul class="simpleTabsNavigation">';
			for ($x = 0; $x < $results_t_size; $x++)
			{
				if(strtoupper($results_t[$x]) != 'END')
				{
					$output .= '<li><a href="#">' . $results_t[$x] .'</a></li>';
				}
			}

			$output .= '</ul>';
			/** Print tabs content **/
			for ($x = 0; $x < $results_t_size; $x++)
			{
				/** If tab title is END, just print the rest of the post **/
				if (strtoupper($results_t[$x]) == 'END')
				{
					/** If there is text after the last tab, print it **/
					$output_rest .= substr($posttext, $results_f[$x] + 1);
					break;
				}
				$output .= '<div class="simpleTabsContent">';

				/** This is the hidden title that only shows up on RSS feed or somewhere outside the context like a print page **/
				$output .= '<span class="simpleTabsTitles"><strong>' . $results_t[$x] .'&nbsp;:</strong>&nbsp;</span>';
				if ($results_t_size - $x == 1)
				{
					$output .= substr($posttext, $results_f[$x] + 1);
				}
				else
				{
					$output .= substr($posttext, $results_f[$x] + 1, $results_i[$x + 1] - $results_f[$x] -1);
				}
				$output .= '</div>';
			}
			$output .= '</div>';

			return $output_start . $output . $output_rest;
		}
		else
		{
			return $posttext;
		}
	}

	/**
	* Parsing the flash - Second pass.
	*
	* @param string		$width	value for video width
	* @param string		$height value for video Height
	* @return string	$link	value for video url
	* @version 3.0.8
	**/
	function flash_pass($width = 0, $height = 0, $link = '')
	{
		if ($link)
		{
			global $user;

			if (!$user->optionget('viewflash'))
			{
				return str_replace(array('$1', '$2'), array($link, '[ flash ]'), $this->bbcode_tpl('url', -1, true));
			}

			if (!$width || !$height)
			{
				if (empty($this->abbcode_config))
				{
					$this->abbcode_init(false);
				}
				$width = ($width) ? $width : $this->abbcode_config['ABBC3_VIDEO_WIDTH'];
				$height = ($height) ? $height : $this->abbcode_config['ABBC3_VIDEO_HEIGHT'];
			}
			return $this->auto_embed_video($link, $width, $height);
		}
		// In case everything fails, bbcode will take care of it ;)
	}

	/**
	* Parse text decoration effect
	*
	* @param string		$effect		(glow|shadow|dropshadow|blur|wave)
	* @param string		$colour		html colors
	* @param string		$in			post text between [glow]&[/glow] | [shadow]&[/shadow] | [dropshadow]&[/dropshadow] | [blur]&[/blur] | [wave]&[/wave]
	* @return string
	* @version 3.0.8
	**/
	function Text_effect_pass($effect, $colour, $in)
	{
		global $user;

		$effect = ucfirst(strtolower(trim($effect)));
		$colour = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($colour));
		$in	 	= str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in));
		// IE manage this at his own way
		$is_ie	= (strpos(strtolower($user->browser), 'msie') !== false);
		$style	= "display: inline-block; padding: " . (($is_ie) ? "0 0.2em; " : "0 0.5em; ");
		$shadow_colour = '#999999'; //  Default text shadow color #999999. You can change to another colour if desired.

		switch (strtoupper($effect))
		{
			case 'GLOW' :
				$style .= ($is_ie) ? "filter: glow(color=$colour, strength=4); color: #ffffff;" : "color: #ffffff; text-shadow: 0 0 1.0em $colour, 0 0 1.0em $colour, 0 0 1.2em $colour;";
			break;

			case 'SHADOW' :
				$style .= ($is_ie) ? "filter: shadow(color=$shadow_colour, strength=4); color:$colour;" : "color : $colour; text-shadow: -0.2em 0.2em 0.2em $shadow_colour;";
			break;

			case 'DROPSHADOW' :
				$style .= ($is_ie) ? "filter: dropshadow(color=$shadow_colour, strength=4); color:$colour;" : "color : $colour; text-shadow: 0.2em 0.2em 0.05em $shadow_colour;";
			break;

			case 'BLUR' :
				$style .= ($is_ie) ? "filter: blur(strength=7); color:$colour;" : "color: $colour; text-shadow: -0.1em 0.0em 0.1em $colour, 0.1em 0.0em 0.1em $colour;";
			break;

			case 'WAVE' :
				$style .= ($is_ie) ? "filter: wave(strength=2); color: $colour;" : "text-shadow: 0.2em 0.5em 0.1em $colour, -0.2em 0.1em 0.1em $colour, 0.2em -0.3em 0.1em $colour; font-weight: bold; font-style: italic;";
			break;

			default:
				return '[' . $effect . '=' . $colour . ']' . $in . '[/' . $effect . ']';
		}
		return str_replace(array('{CLASS}', '{STYLE}', '{TEXT}'), array($effect, $style, $in), $this->bbcode_tpl('decoration'));
	}

	/**
	* Initialize Video array
	* @version 3.0.8
	**/
	function video_init()
	{
		/**
		* @ignore
		* <br />0=($0)<br />1=($1)<br />2=($2)<br />3=($3)<br />4=($4)<br />5=($5)<br />6=($6)<br />7=($7)<br />8=($8)<br />9=($9)<br />10=($10)<br />
		* http://www.osflv.com/ flv player
		* http://autoembed.com/demos/
		**/
		/**
		* Not available, no more
		*	stage6.com, gamevee.com, godtube.com, hdshare.tv, imeem.com, lala.com, uncutvideo.aol.com, starclips.net, clipser.com
		*	vidiac.com ( almost death )
		* Not available yet
		* 	bbc.co, video.msn.com, tm-tube.com
		* Not possible
		* 	youporn.com, dotsub.com, probetv.com, blip.tv, gamevideos.1up.com
		**/

		/** Patterns and replacements for BBVIDEO bbcode processing **/
		return array(
			'video' => array(
			),
			'comedycentral.com' => array(
				'id'		=> 1,
				'image'		=> 'comedycentral.gif',
				'example'	=> "http://www.comedycentral.com/videos/index.jhtml?videoId=185763&title=weekly-evil-six-reasons-alaska",
				'match'		=> "#http://www.comedycentral.com/videos/index.jhtml\?videoId=([0-9]+)([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://media.mtvnservices.com/mgid:cms:item:comedycentral.com:$1', '{WIDTH}', '{HEIGHT}', 'autoPlay=false')",
			),
			'www.clipfish' => array(
				'id'		=> 2,
				'image'		=> 'clipfish.gif',
				'example'	=> "http://www.clipfish.de/video/1856437/ac-dc-tnt/",
				'match'		=> "#http://www.clipfish.(.*?)/video/([0-9]+)([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.clipfish.de/cfng/flash/clipfish_player_3.swf?as=0&vid=$2', '{WIDTH}', '{HEIGHT}')",
			),
			'clipmoon.com' => array(
				'id'		=> 3,
				'image'		=> 'clipmoon.gif',
				'example'	=> "http://www.clipmoon.com/videos/9194d9/animation-versus-animator.html",
				'match'		=> "#http://www.clipmoon.com/(.*?)/(([0-9A-Za-z-_]+)([0-9A-Za-z-_]{2}))/([^[]*)#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.clipmoon.com/flvplayer.swf?config=http://www.clipmoon.com/flvplayer.php?viewkey=$2&external=yes&vimg=http://www.clipmoon.com/thumb/$3.jpg', '{WIDTH}', '{HEIGHT}')",
			),
			'collegehumor.com' => array(
				'id'		=> 4,
				'image'		=> 'collegehumor.gif',
				'example'	=> "http://www.collegehumor.com/video:1802097",
				'match'		=> "#http://www.collegehumor.com/video:([0-9]+)#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=$1&fullscreen=1', '{WIDTH}', '{HEIGHT}')",
			),
			'crackle.com' => array(	
				'id'		=> 5,
				'image'		=> 'crackle.gif',
				'example'	=> "http://crackle.com/c/High_Wire/Fall_Out_Boy_Songs/2185986",
				'match'		=> "#http://((.*?)?)crackle.com/([A-Za-z-_/]+)?([0-9]+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://crackle.com/flash/ReferrerRedirect.ashx', '{WIDTH}', '{HEIGHT}', 'mu=0&ap=0&ml=o%3D12%26fi%3D%26fpl%3D2839&id=$2')",
			),
			'dailymotion.com' => array(
				'id'		=> 6,
				'image'		=> 'dailymotion.gif',
				'example'	=> "http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport",
				'match'		=> "#http://www.dailymotion.com(.*?)/video/(([^[_]*)?([^[]*)?)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.dailymotion.com/swf/video/$3', '{WIDTH}', '{HEIGHT}')",
			),
			'g4tv.com' => array(
				'id'		=> 7,
				'image'		=> 'g4tv.gif',
				'example'	=> "http://g4tv.com/videos/29265/Infamous-All-Access/",
				'match'		=> "#http://(?:www\.)?g4tv.com/(.*?videos)/([0-9]+)/([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.g4tv.com/lv3/$2', '{WIDTH}', '{HEIGHT}')",
			),
			'gamepro.com' => array(
				'id'		=> 8,
				'image'		=> 'gamepro.gif',
				'example'	=> "http://www.gamepro.com/video/trailers/132252/punchout-debut-trailer/",
				'match'		=> "#http://www.gamepro.com/video/trailers/(.*?)/([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.gamepro.com/bin/vid-bin/octPlayer.swf?vId=$1&p=e&ae=d', '{WIDTH}', '{HEIGHT}')",
			),
			'gameprotv.com' => array(
				'id'		=> 9,
				'image'		=> 'gameprotv.gif',
				'example'	=> "http://www.gameprotv.com/socom-4-us-navy-seals-trailer-video-6923.html",
				'match'		=> "#http://www.gameprotv.com/(.*)-video-([0-9]+)?.([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.idg.es/player-viral.swf', '{WIDTH}', '{HEIGHT}', 'image=http%3A%2F%2Fvideos.gameprotv.com%2Fvideos%2F$2.jpg&file=http%3A%2F%2Fvideos.gameprotv.com%2Fvideos%2F$2.flv&plugins=adtonomy,viral-1')",
			),
			'gamespot.com' => array(
				'id'		=> 10,
				'image'		=> 'gamespot.gif',
				'example'	=> "http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8",
				'match'		=> "#http://www.gamespot.com(.*?)/video/(.*?)/(\d{7}?)(/[^/]+)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/proteus2.swf', '{WIDTH}', '{HEIGHT}', 'skin=http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/skins/gamespot.png&paramsURI=http%3A%2F%2Fwww.gamespot.com%2Fpages%2Fvideo_player%2Fxml.php%3Fid%3D$3%26mode%3Dembedded%26width%3D{WIDTH}%26height%3D{HEIGHT}%2F')",
			),
			'gamespot.com/showcases' => array(
				'id'		=> 11,
				'image'		=> 'gamespot.gif',
				'example'	=> "http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8",
				'match'		=> "#http://www.gamespot.com/showcases/(.*?)\?sid=([0-9]+)([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/proteus2.swf', '{WIDTH}', '{HEIGHT}', 'skin=http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/skins/gamespot.png&paramsURI=http%3A%2F%2Fwww.gamespot.com%2Fpages%2Fvideo_player%2Fxml.php%3Fid%3D$2%26mode%3Dembedded%26width%3D{WIDTH}%26height%3D{HEIGHT}%2F')",
			),
			'gametrailers.com/user-movie' => array(
				'id'		=> 12,
				'image'		=> 'gametrailers.gif',
				'example'	=> "http://www.gametrailers.com/user-movie/first-gta-cw-screens/268358",
				'match'		=> "#http://www.gametrailers.com/user-movie/(.*?)/([0-9]+)([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.gametrailers.com/remote_wrap.php?umid=$2', '{WIDTH}', '{HEIGHT}')",
			),
			'gametrailers.com/player/usermovies' => array(
				'id'		=> 13,
				'image'		=> 'gametrailers.gif',
				'example'	=> "http://www.gametrailers.com/player/usermovies/268358.html",
				'match'		=> "#http://www.gametrailers.com/player/usermovies/([0-9]+)([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.gametrailers.com/remote_wrap.php?umid=$1', '{WIDTH}', '{HEIGHT}')",
			),
			'gametrailers.com' => array(
				'id'		=> 14,
				'image'		=> 'gametrailers.gif',
				'example'	=> "http://www.gametrailers.com/video/game-of-best-of-e3/701407", // http://www.gametrailers.com/player/30461.html
				'match'		=> "#http://www.gametrailers.com/(.*?)/([0-9]+)([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.gametrailers.com/remote_wrap.php?mid=$2', '{WIDTH}', '{HEIGHT}')",
			),
			'www.gamevideos' => array(
				'id'		=> 15,
				'image'		=> 'gamevideos.gif',
				'example'	=> "http://www.gamevideos.com/video/id/17766",
				'match'		=> "#http://www.gamevideos(.*?).com/video/id/([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://gamevideos.1up.com/swf/gamevideos12.swf?embedded=1&fullscreen=1&autoplay=0&src=http://www.gamevideos.com/video/videoListXML%3Fid%3D$2%26ordinal%3D%26adPlay%3Dfalse', '{WIDTH}', '{HEIGHT}')",
			),
			'ign.com' => array(
				'id'		=> 16,
				'image'		=> 'ign.gif',
				'example'	=> "http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html",
				'match'		=> "#http://(.*?)ign\.com/(?:.*?)/objects/([0-9]+)/([^/]*)/([^/]*)/([^\.]*)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://media.ign.com/ev/embed.swf', '{WIDTH}', '{HEIGHT}', 'vgroup=$5&object=$2')",
			),
			'kyte.tv' => array(
				'id'		=> 17,
				'image'		=> 'kyte.gif',
				'example'	=> "http://www.kyte.tv/ch/182864",
				'match'		=> "#http://www.kyte.tv/ch/([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.kyte.tv/f/', '{WIDTH}', '{HEIGHT}', 'p=s&c=$1&tbid=1')",
			),
			'liveleak.com' => array(
				'id'		=> 18,
				'image'		=> 'liveleak.gif',
				'example'	=> "http://www.liveleak.com/view?i=166_1194290849",
				'match'		=> "#http://www.liveleak.com/view\?i=([0-9A-Za-z-_]+)?(\&[^/]+)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.liveleak.com/e/$1', '{WIDTH}', '{HEIGHT}')",
			),
			'livevideo.com' => array(
				'id'		=> 19,
				'image'		=> 'livevideo.gif',
				'example'	=> "http://www.livevideo.com/video/UKUFO/D930AEB5460D4707B2F6DC0CD8D3C258/haiti-and-the-dominican-republ.aspx",
				'match'		=> "#http://www.livevideo.com/video/([^[]*)/([^[]*)/([^[]*)#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.livevideo.com/flvplayer/embed/$2', '{WIDTH}', '{HEIGHT}')",
			),
			'machinima.com' => array(
				'id'		=> 20,
				'image'		=> 'machinima.gif',
				'example'	=> "http://www.machinima.com:80/film/view&id=281",
				'match'		=> "#http://www.machinima.com(:80)?/film/view&amp;id=([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.machinima.com/_flash_media_player/mediaplayer.swf?file=http://www.machinima.com/p/$2', '{WIDTH}', '{HEIGHT}', 'file=http://www.machinima.com/p/$2&height={HEIGHT}&width={WIDTH}')",
			),
			'megavideo.com' => array(
				'id'		=> 21,
				'image'		=> 'megavideo.gif',
				'example'	=> "http://www.megavideo.com/?v=0Q8S7E29",
				'match'		=> "#http://(.*?)megavideo.com/\?v=([^[]*)#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.megavideo.com/v/$2', '{WIDTH}', '{HEIGHT}')",
			),
			'metacafe.com' => array(
				'id'		=> 22,
				'image'		=> 'metacafe.gif',
				'example'	=> "http://www.metacafe.com/watch/966360/merry_christmas_with_crazy_frog/",
				'match'		=> "#http://www.metacafe.com/watch/([0-9]+)?((/[^/]+)/?)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.metacafe.com/fplayer/$1/metacafe.swf', '{WIDTH}', '{HEIGHT}')",
			),
			'myspace.com' => array(
				'id'		=> 51,
				'image'		=> 'vidsmyspace.gif',
				'example'	=> "http://www.myspace.com/video/vid/49776296",
				'match'		=> "#http://(www.)?myspace.com/video/vid/([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://mediaservices.myspace.com/services/media/embed.aspx/m=$2', '{WIDTH}', '{HEIGHT}')",
			),
			'myspacetv.com' => array(
				'id'		=> 23,
				'image'		=> 'vidsmyspace.gif',
				'example'	=> "http://myspacetv.com/index.cfm?fuseaction=vids.individual&videoid=25769593",
				'match'		=> "#http://(vids.)?myspace(?:tv)?.com/index.cfm([^[]*)?videoid=([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://mediaservices.myspace.com/services/media/embed.aspx/m=$3', '{WIDTH}', '{HEIGHT}')",
			),
			'vids.myspace.com' => array(
				'id'		=> 24,
				'image'		=> 'vidsmyspace.gif',
				'example'	=> "http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=49776296",
				'match'		=> "#http://(vids.)?myspace(?:tv)?.com/index.cfm([^[]*)?videoid=([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://mediaservices.myspace.com/services/media/embed.aspx/m=$3', '{WIDTH}', '{HEIGHT}')",
			),
			'www.myvideo' => array(
				'id'		=> 25,
				'image'		=> 'myvideo.gif',
				'example'	=> "http://www.myvideo.de/watch/2668372",
				'match'		=> "#http://www.myvideo.(.*?)/(.*?)/([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.myvideo.$1/movie/$3', '{WIDTH}', '{HEIGHT}')",
			),
			'photobucket.com/albums' => array(
				'id'		=> 26,
				'image'		=> 'photobucket.gif',
				'example'	=> "http://s0006.photobucket.com/albums/0006/pbhomepage/Ice%20Age/?action=view&current=TFEIT301100-H264_Oct27.flv",
				'match'		=> "#http://s(.*?).photobucket.com/(albums/[^[]*\/([0-9A-Za-z-_ ]*)?)?([^[]*=)+?([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://static.photobucket.com/player.swf?file=http://vid$1.photobucket.com/$2$5', '{WIDTH}', '{HEIGHT}')",
			),
			'www.porkolt' => array(
				'id'		=> 27,
				'image'		=> 'porkolt.gif',
				'example'	=> "http://www.porkolt.com/Avatar---Trailer-1-274678.html",
				'match'		=> "#http://www.porkolt.(.*)/(.*?)-([0-9]{5,}).(.*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://content3.porkolt.com/player/own/porkoltplayer.swf?parameters=http://datas.porkolt.com/datas/h/$3', '{WIDTH}', '{HEIGHT}', '')",
			),
			'revver.com' => array(
				'id'		=> 28,
				'image'		=> 'revver.gif',
				'example'	=> "http://revver.com/video/1217076/shouting-news-palin-vs-pitbull/",
				'match'		=> "#http://(.*?)revver.com/video/(.*?)/([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://flash.revver.com/player/1.0/player.swf?mediaId=$2', '{WIDTH}', '{HEIGHT}', 'allowFullScreen=true')",
			),
			'rutube.ru' => array(
				'id'		=> 29,
				'image'		=> 'rutube.gif',
				'example'	=> "http://rutube.ru/tracks/1415928.html?v=67eb8c2fcd74fddb722ce4cd820195da",
				'match'		=> "#http://rutube.ru/(.*?)/(.*?).html\?v=([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://video.rutube.ru/$3', '{WIDTH}', '{HEIGHT}')",
			),
			'sapo.pt' => array(
				'id'		=> 30,
				'image'		=> 'sapo.gif',
				'example'	=> "http://videos.sapo.pt/LguPabwSWikK0wzBmU1o",
				'match'		=> "#http://(.*?)sapo.pt/(.*/)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://rd3.videos.sapo.pt/play?file=http://rd3.videos.sapo.pt/$3/mov/1', '{WIDTH}', '{HEIGHT}')",
			),
			'sevenload.com' => array(
				'id'		=> 31,
				'image'		=> 'sevenload.gif',
				'example'	=> "http://en.sevenload.com/shows/Tekzilla/episodes/hMbjjr3-Windows-7-Enhancements-for-Power-Users-Tekzilla-Daily-Tip",
				'match'		=> "#http://(.*?).sevenload.com/(?:.*?)(episodes|videos)/([^/[-]*)?([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://en.sevenload.com/pl/$3/{WIDTH}x{HEIGHT}/swf', '{WIDTH}', '{HEIGHT}')",
			),
			'spike.com' => array(
				'id'		=> 32,
				'image'		=> 'spike.gif',
				'example'	=> "http://www.spike.com/video/winter-passing/2696820",
				'match'		=> "#http://www.spike.com/video/([A-Za-z-_\-/]+)?([0-9]+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.spike.com/efp?flvbaseclip=$2&', '{WIDTH}', '{HEIGHT}')",
			),
			'tangle.com' => array(
				'id'		=> 33,
				'image'		=> 'tangle.gif',
				'example'	=> "http://www.tangle.com/view_video?viewkey=cd77b1f92626e136f9b5",
				'match'		=> "#http://www.tangle.com/view_video\?viewkey=([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.tangle.com/flash/swf/flvplayer.swf', '{WIDTH}', '{HEIGHT}', 'viewkey=$1')",
			),
			'tinypic.com' => array(
				'id'		=> 34,
				'image'		=> 'tinypic.gif',
				'example'	=> "http://tinypic.com/player.php?v=dgqv6u&s=5",
				'match'		=> "#http://((.*?)?)tinypic.com/player.php\?v=([0-9A-Za-z]+)(&|&amp;)s=([0-9]+)#ise",
				'replace'	=> "\$this->auto_embed_video('http://v$5.tinypic.com/player.swf?file=$3', '{WIDTH}', '{HEIGHT}')",
			),
			'vbox7.com' => array(
				'id'		=> 35,
				'image'		=> 'vbox7.gif',
				'example'	=> "http://www.vbox7.com/play:93ab2ba5",
				'match'		=> "#http://www.vbox7.com/play:([^[]+)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://i47.vbox7.com/player/ext.swf?vid=$1', '{WIDTH}', '{HEIGHT}')",
			),
			'veoh.com' => array(
				'id'		=> 36,
				'image'		=> 'veoh.gif',
				'example'	=> "http://www.veoh.com/browse/videos/category/entertainment/watch/v18183513AEp9gT8J",
				'match'		=> "#http://(.*?).veoh.com/([0-9A-Za-z-_\-/]+)?/([0-9A-Za-z-_]+)#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.5.2.1030&permalinkId=$3&player=videodetailsembedded&videoAutoPlay=0&id=anonymous', '{WIDTH}', '{HEIGHT}')",
			),
			'videu.de' => array(
				'id'		=> 37,
				'image'		=> 'videu.gif',
				'example'	=> "http://www.videu.de/video/38",
				'match'		=> "#http://www.videu.de/video/([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://www.videu.de/flv/player2.swf?iid=$1', '{WIDTH}', '{HEIGHT}')",
			),
			'vimeo.com' => array(
				'id'		=> 38,
				'image'		=> 'vimeo.gif',
				'example'	=> "http://vimeo.com/3759030",
				'match'		=> "#http://((.*?))vimeo.com/([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://vimeo.com/moogaloop.swf?clip_id=$3&server=vimeo.com&fullscreen=1&show_title=1&show_byline=1&show_portrait=0&color=', '{WIDTH}', '{HEIGHT}')",
			),
			'video.google' => array(
				'id'		=> 39,
				'image'		=> 'googlevid.gif',
				'example'	=> "http://video.google.com/videoplay?docid=-8351924403384451128",
				'match'		=> "#http://video.google.(.*?)/(videoplay|googleplayer.swf)\?docid=([0-9A-Za-z-_]+)([^[]*)?#sie",
				'replace'	=> "\$this->auto_embed_video('http://video.google.\$1/googleplayer.swf?docId=\$3', '{WIDTH}', '{HEIGHT}')",
			),
			'video.yahoo' => array(
				'id'		=> 40,
				'image'		=> 'yahoovid.gif',
				'example'	=> "http://video.yahoo.com/watch/2057334/6491459?v=2057334",
				'match'		=> "#http://video.yahoo.com/watch/([0-9]+)/([0-9]+)[^[]*#sie",
				'replace'	=> "\$this->auto_embed_video('http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.46', '{WIDTH}', '{HEIGHT}', 'id=$2&vid=$2&lang=en-US&intl=us')",
			),
			'vsocial.com' => array(
				'id'		=> 41,
				'image'		=> 'vsocial.gif',
				'example'	=> "http://www.vsocial.com/video/?d=2893",
				'match'		=> "#http://www.vsocial.com/video/\?d=([^[]*)#ise",
				'replace'	=> "\$this->auto_embed_video('http://static.vsocial.com/flash/ups.swf?d=$1&a=0', '{WIDTH}', '{HEIGHT}')",
			),
			'wegame.com' => array(
				'id'		=> 42,
				'image'		=> 'wegame.gif',
				'example'	=> "http://www.wegame.com/watch/Clarity_Darkspear_VS_Heigan/",
				'match'		=> "#http://www.wegame.com/watch/(.*?)/([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.wegame.com/static/flash/player.swf?xmlrequest=http://www.wegame.com/player/video/$1&embedPlayer=true', '{WIDTH}', '{HEIGHT}', 'xmlrequest=http://www.wegame.com/player/video/$1&embedPlayer=true')",
			),
			'youtube.com' => array(
				'id'		=> 43,
				'image'		=> 'youtube.gif',
				'example'	=> "http://www.youtube.com/watch?v=PDGxfsf-xwQ",
				'match'		=> "#http://((.*?)?)youtube.com/(|watch\?)v(/|=)([0-9A-Za-z-_]+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://$2youtube.com/v/$5&hl=en&fs=1?rel=0', '{WIDTH}', '{HEIGHT}')",
			),
			'youtu.be' => array(
				'id'		=> 49,
				'image'		=> 'youtube.gif',
				'example'	=> "http://youtu.be/PDGxfsf-xwQ",
				'match'		=> "#http://youtu.be/([0-9A-Za-z-_]+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.youtube.com/v/$1&feature=youtu.be&hl=en&fs=1?rel=0', '{WIDTH}', '{HEIGHT}')",
			),
			'xfire.com' => array(
				'id'		=> 44,
				'image'		=> 'xfire.gif',
				'example'	=> "http://www.xfire.com/video/24c86/",
				'match'		=> "#http://www.xfire.com/video/(.*?)/#sie",
				'replace'	=> "\$this->auto_embed_video('http://media.xfire.com/swf/embedplayer.swf', '{WIDTH}', '{HEIGHT}', 'videoid=$1')",
			),
			'scribd' => array(
				'id'		=> 45,
				'image'		=> 'scribd.gif',
				'example'	=> "[scribd id=33988557 key=key-2l5cezbnj6qttpbzb75d mode=list]",
				'match'		=> "#(\[scribd(\s{0,1})id=(\d+)?(\s{0,1})key=([\d\w-]+)?(\s{0,1})mode=([a-z]+)?\])|(\[scribd(\s{0,1})id=(\d+)?(\s{0,1})key=([\d\w-]+)?\])#sie",
				'replace'	=> "\$this->auto_embed_video('http://documents.scribd.com/ScribdViewer.swf?document_id=$3$10&access_key=$5$12&page=1&version=1&viewMode=$7', '{WIDTH}', '{HEIGHT}', '', array('id' => 'doc_$3$10', 'name' => 'doc_$3$10'), array('play' => 'true', 'loop' => 'true', 'scale' => 'showall', 'wmode' => 'opaque', 'devicefont' => 'false', 'bgcolor' =>'#ffffff', 'menu' => 'true'))",
			),
			'allocine.fr' => array(
				'id'		=> 46,
				'image'		=> 'allocine.gif',
				'example'	=> "http://www.allocine.fr/video/player_gen_cmedia=19149857&cfilm=126693.html",
				'match'		=> "#http://www.allocine.fr/video/player_gen_cmedia=(\d+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.allocine.fr/blogvision/$1', '{WIDTH}', '{HEIGHT}')",
			),
			'cnbc.com' => array(
				'id'		=> 47,
				'image'		=> 'nbc.gif',
				'example'	=> "http://www.cnbc.com/id/15840232?video=1548022077&play=1",
				'match'		=> "#http://www.cnbc.com/id/(\d+)(?:|/)\?video=(\d+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://plus.cnbc.com/rssvideosearch/action/player/id/$2/code/cnbcplayershare', '{WIDTH}', '{HEIGHT}')",
			),
			'msnbc.msn.com' => array(
				'id'		=> 48,
				'image'		=> 'nbc.gif',
				'example'	=> "http://www.msnbc.msn.com/id/21134540/vp/41172078#41190910",
				'match'		=> "#http://www.msnbc.msn.com/id/(\d+)?/vp/(\d+)?\#(\d+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.msnbc.msn.com/id/32545640', '{WIDTH}', '{HEIGHT}', 'launch=$3&width={WIDTH}&height={HEIGHT}')",
			),
			'facebook.com' => array(
				'id'		=> 50,
				'image'		=> 'video.gif',
				'example'	=> "http://www.facebook.com/video/video.php?v=1587422536911",
				'match'		=> "#http://www.facebook.com/video/video.php\?v=([0-9A-Za-z-_]+)?([^[]*)?#ise",
				'replace'	=> "\$this->auto_embed_video('http://www.facebook.com/v/$1', '{WIDTH}', '{HEIGHT}')",
			),

			'external' => array(
			),
			'badr.tv' => array(
				'id'		=> 101,
				'image'		=> 'badrtv.gif',
				'example'	=> "http://www.badr.tv/video/8d0cbedc973445af2da",
				'match'		=> "#http://www.badr.tv/video/([^[]*)?#is",
				'replace'	=> 'external',
			),
			'comedians.jokes.com' => array(
				'id'		=> 102,
				'image'		=> 'comedians.gif',
				'example'	=> "http://comedians.jokes.com/bert-kreischer/videos/bert-kreischer---twelve-words",
				'match'		=> "#http://comedians.jokes.com/(.*?)/videos/([^[]*)#sie",
				'replace'	=> 'external',
			),
			'comedians.comedycentral.com' => array(
				'id'		=> 103,
				'image'		=> 'comedians.gif',
				'example'	=> "http://comedians.comedycentral.com/bert-kreischer/videos/bert-kreischer---twelve-words",
				'match'		=> "#http://comedians.comedycentral.com/(.*?)videos/([^[]*)?#sie",
				'replace'	=> 'external',
			),
			'moddb.com' => array(
				'id'		=> 104,
				'image'		=> 'moddb.gif',
				'example'	=> "http://www.moddb.com/groups/tv/videos/noesis-presents-forgotten-hope-2-interview",
				'match'		=> "#http://www.moddb.com/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'revision3.com' => array(
				'id'		=> 105,
				'image'		=> 'revision3.gif',
				'example'	=> "http://revision3.com/scamschool/fortheladies2",
				'match'		=> "#http://revision3.com/(.*?)/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'slideshare.net' => array(
				'id'		=> 106,
				'image'		=> 'slideshare.gif',
				'example'	=> "http://www.slideshare.net/chrisbrogan/social-media-for-publishers-presentation",
				'match'		=> "#http://www.slideshare.net/(.*?)/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'streetfire.net' => array(
				'id'		=> 107,
				'image'		=> 'streetfire.gif',
				'example'	=> "http://videos.streetfire.net/video/Top-Gear-Lorry-truck-12_196610.htm",
				'match'		=> "#http://videos.streetfire.net/video/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'tu.tv' => array(
				'id'		=> 108,
				'image'		=> 'tutv.gif',
				'example'	=> "http://tu.tv/videos/el-gato-boxeador",
				'match'		=> "#http://((.*?)?)tu.tv/videos/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'videogamer.com' => array(
				'id'		=> 109,
				'image'		=> 'videogamer.gif',
				'example'	=> "http://www.videogamer.com/videos/dead_space_developer_diary_zero_gravity.html",
				'match'		=> "#http://www.videogamer.com/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'vidilife.com' => array(
				'id'		=> 110,
				'image'		=> 'vidilife.gif',
				'example'	=> "http://www.vidiLife.com/video_play_1136791_Really_Bad_Driver_Drives_Off_Parking_Garage.htm",
				'match'		=> "#http://www.vidiLife.com/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'gotgame.com' => array(
				'id'		=> 111,
				'image'		=> 'gotgame.gif',
				'example'	=> "http://video.gotgame.com/index.php/video/view/10554",
				'match'		=> "#http://video.gotgame.com/index.php/video/view/([^[]*)?#si",
				'replace'	=> 'external',
			),
			'filefront.com' => array(
				'id'		=> 112,
				'image'		=> 'filefront.gif',
				'example'	=> "http://www.filefront.com/14284133/Batman-Arkham-Asylum-Gadgets-Trailer/",
				'match'		=> "#http://www.filefront.com/(.*?)/([^[]*)?#si",
				'replace'	=> "external",
			),
			'deviantart.com' => array(
				'id'		=> 113,
				'image'		=> 'deviantart.gif',
				'example'	=> "http://bossk.deviantart.com/art/COLLEGE-FRIES-trailer-106469587",
				'match'		=> "#http://(.*?).deviantart.com/([^[]*)?#si",
				'replace'	=> "external",
			),
			'wat.tv' => array(
				'id'		=> 114,
				'image'		=> 'wattv.gif',
				'example'	=> "http://www.wat.tv/video/mords-moi-sans-hesitation-2ykhj_2g5h3_.html",
				'match'		=> "#http://(.*?).wat.tv/video/([^[]*)?#is",
				'replace'	=> 'external',
			),

			'file' => array(
			),
			'(avi|divx|mkv)' => array(
				'id'		=> 201,
				'image'		=> 'divx.gif',
				'example'	=> "http://download.divx.com/divxlabs/Apples_and_Oranges_Trailer_720-12Mbps.divx",
				'match'		=> "#([^[]+)?\.(avi|divx|mkv)#sie",
				'replace'	=> "\$this->auto_embed_video('$0', '{WIDTH}', '{HEIGHT}', '', array('type' => 'video/divx'), array('pluginspage' => 'http://go.divx.com/plugin/download/', 'custommode' => 'none'))",
			),
			'swf' => array(
				'id'		=> 202,
				'image'		=> 'flash.gif',
				'example'	=> "http://www.mssti.com/phpbb3/images/media/relojanalogo.swf",
				'match'		=> "#([^[]+)?\.swf#sie",
				'replace'	=> "\$this->auto_embed_video('$0', '{WIDTH}', '{HEIGHT}')",
			),
			'flv' => array(
				'id'		=> 203,
				'image'		=> 'flashflv.gif',
				'example'	=> "http://www.mssti.com/phpbb3/images/media/Demo.flv",
				'match'		=> "#([^[]+)?\.flv#sie",
				'replace'	=> "\$this->auto_embed_video('./images/player.swf', '{WIDTH}', '{HEIGHT}', 'movie=$0&bgcolor=0x666666&fgcolor=0x000000&autoload=off&volume=70')",
			),
			'(wmv|mpg)' => array(
				'id'		=> 204,
				'image'		=> 'video.gif',
				'example'	=> "http://www.mssti.com/phpbb3/images/media/calmate.wmv",
				'match'		=> "#([^[]+)?\.(wmv|mpg)#si",
				'replace'	=> '<object width="{WIDTH}" height="{HEIGHT}" type="video/x-ms-wmv"><param name="filename" value="$0" /><param name="Showcontrols" value="true" /><param name="autoStart" value="false" /><param name="autostart" value="false" /><param name="showcontrols" value="true" /><param name="showdisplay" value="false" /><param name="showstatusbar" value="false" /><param name="autosize" value="true" /><param name="visible" value="true" /><param name="animationstart" value="false" /><param name="loop" value="false" />
				<embed type="application/x-mplayer2" src="$0" width="{WIDTH}" height="{HEIGHT}" controller="true" showcontrols="true" showdisplay="false" showstatusbar="true" autosize="true" autostart="false" visible="true" animationstart="false" loop="false"></embed></object>',
			),
			'(qt|mov)' => array(
				'id'		=> 205,
				'image'		=> 'quicktime.gif',
				'example'	=> "http://www.mssti.com/phpbb3/images/media/Buenos_Aires.qt",
				'match'		=> "#([^[]+)?\.(qt|mov)#si",
				'replace'	=> '<object id="qtstream_{ID}" width="{WIDTH}" height="{HEIGHT}"><param name="type" value="video/quicktime" /><param name="src" value="$0" /><param name="controller" value="true" /><param name="autoplay" value="false" /><param name="loop" value="false" />
				<embed name="qtstream_{ID}" src="$0" pluginspage="http://www.apple.com/quicktime/download/" enablejavascript="true" controller="true" loop="false" width="{WIDTH}" height="{HEIGHT}" type="video/quicktime" autoplay="false"></embed></object>'
			),
			'(mid|midi)' => array(
				'id'		=> 206,
				'image'		=> 'quicktime.gif',
				'example'	=> "http://www.mssti.com/phpbb3/images/media/Adams_Family_Theme.mid",
				'match'		=> "#([^[]+)?\.(mid|midi)#si",
				'replace'	=> '<object id="qtstream_{ID}" width="{WIDTH}" height="{HEIGHT}"><param name="type" value="audio/x-midi" /><param name="src" value="$0" /><param name="controller" value="true" /><param name="autoplay" value="false" /><param name="loop" value="false" />
				<embed name="qtstream_{ID}" src="$0" pluginspage="http://www.apple.com/quicktime/download/" enablejavascript="true" controller="true" loop="false" width="{WIDTH}" height="{HEIGHT}" type="audio/x-midi" autoplay="false"></embed></object>'
			),
			'mp3' => array(
				'id'		=> 207,
				'image'		=> 'quicktime.gif',
				'example'	=> "http://www.mssti.com/phpbb3/images/media/Cake_I_Will_Survive.mp3",
				'match'		=> "#([^[]+)?\.mp3#si",
				'replace'	=> '<object width="{WIDTH}" height="{HEIGHT}"><param name="src" value="$0" /><param name="autoplay" value="false" /><param name="controller" value="true" />
				<embed src="$0" autostart="false" loop="false" width="{WIDTH}" height="{HEIGHT}" controller="true"></embed></object>',
			),
			'ram' => array(
				'id'		=> 208,
				'image'		=> 'ram.gif',
				'example'	=> "http://www.mssti.com/phpbb3/images/media/Dr_Who.ram",
				'match'		=> "#([^[]+)?\.ram#si",
				'replace'	=> '<object id="rmstream{ID}" width="{WIDTH}" height="{HEIGHT}" type="audio/x-pn-realaudio-plugin" data="$0"><param name="src" value="$0" /><param name="autostart" value="false" /><param name="controls" value="ImageWindow" /><param name="console" value="ctrls_{ID}" /><param name="prefetch" value="false" /></object><br />
				<object id="ctrls" type="audio/x-pn-realaudio-plugin" width="{WIDTH}" height="36"><param name="controls" value="ControlPanel" /><param name="console" value="ctrls_{ID}" /></object>',
			),
		);
	}

	/**
	* Build a XHTML compliant object tag
	*
	* @param string $url
	* @param string $width
	* @param string $height
	* @param string $flashvars
	* @return xhtml object tag
	* @version 3.0.8
	**/
	function auto_embed_video($url, $width, $height, $flashvars = '', $object_attribs_ary = array(), $object_params_ary = array())
	{
		// Try to cope with a common user error...
		if (preg_match('#^[a-z0-9]+://#i', $url))
		{
			$url = trim(str_replace(array(' ', '&'), array('%20', '&amp;'), $url));
		}

		$object_attribs_ary = array_merge(array(
			'id'				=> 'mov' . substr(base_convert(unique_id(), 16, 36), 0, 8),
			'width'				=> $width,
			'height'			=> $height,
			'type'				=> 'application/x-shockwave-flash',
			'data'				=> $url,
		), $object_attribs_ary);

		$object_params_ary = array_merge(array(
			'movie'				=> $url,
			'quality'			=> 'high',
			'allowFullScreen'	=> 'true',
			'allowScriptAccess'	=> 'always',
			'pluginspage'		=> 'http://www.macromedia.com/go/getflashplayer',
			'autoplay'			=> 'false',
			'autostart'			=> 'false',
		), $object_params_ary);

		($flashvars) ? $object_params_ary['flashvars'] = trim(str_replace('&', '&amp;', $flashvars)) : true;

		$object_attribs = '';
		foreach ($object_attribs_ary as $param => $value)
		{
			$object_attribs .= ' ' . $param . '="' . $value . '"';
		}

		$object_params = '';
		foreach ($object_params_ary as $param => $value)
		{
			$object_params .= '<param name="' . $param . '" value="' . $value . '" />';
		}

		return sprintf('<object%1$s>%2$s</object>', $object_attribs, $object_params);
	}

	/**
	* Parsing the web videos - Second pass.
	* '[BBvideo${1}${2}:$uid]'.trim('${3}').'[/BBvideo:$uid]'
	* @param string		$in		post text between [BBvideo] & [/BBvideo]
	* @param string		$w		value for video width
	* @param string		$h		value for video Height
	* @return embed video
	* @version 3.0.8
	**/
	function BBvideo_pass($in, $w, $h)
	{
		global $user, $config, $phpbb_root_path;

		if (empty($this->abbcode_config))
		{
			$this->abbcode_init(false);
		}

		static $abbcode_video_ary = array();
		if (empty($abbcode_video_ary))
		{
			$abbcode_video_ary = abbcode::video_init();
			$allowed_videos = video_serialize($config['ABBC3_VIDEO_OPTIONS'], false);
			foreach ($abbcode_video_ary as $video_name => $video_data)
			{
				if (!isset($video_data['id']))
				{
					$abbcode_video_ary[$video_name]['display'] = false;
					continue;
				}

				$abbcode_video_ary[$video_name]['display'] = (in_array($video_data['id'], $allowed_videos)) ? true : false;
			}
		}

		$video_unique_id	= substr(base_convert(unique_id(), 16, 36), 0, 8);
		$video_width		= (intval($w)) ? $w : $this->abbcode_config['ABBC3_VIDEO_WIDTH'];
		$video_height		= (intval($h)) ? $h : $this->abbcode_config['ABBC3_VIDEO_HEIGHT'];
		$video_image_path	= $this->abbcode_config['S_ABBC3_PATH'];
	//	$match				= get_preg_expression('bbcode_htm');
	//	$replace			= array('\1', '\1', '\2', '\1', '', '');
	//	$in					= preg_replace($match, $replace, $in);
		$in					= trim($in);
		$video_link			= '';
		$video_content		= '';
		$video_image		= '';
		$out				= '';

		foreach ($abbcode_video_ary as $video_name => $video_data)
		{
			// Fisrt check that this video is enabled and have data for search and replace
			if (!isset($video_data['match']) || $video_data['match'] == '' || !isset($video_data['replace']) || $video_data['replace'] == '')
			{
				continue;
			}
			// Second check that video url is one on the list and it's on the post text
			if (preg_match('#' . $video_name . '#si', $in) && preg_match($video_data['match'], $in))
			{
				// if the video is not allowed, return a link 
				if (!$video_data['display'])
				{
					$out = make_clickable($in);
					break;
				}

				if (!$user->optionget('viewflash'))
				{
					$out = str_replace(array('$1', '$2'), array($in, '[ flash ]'), $this->bbcode_tpl('url', -1, true));
					break;
				}

				if (preg_match('#\.#si', $video_name))
				{
					preg_match('@^(?:http://)?([^/]+)@i',$in, $video_name);
					if (file_exists($video_image_path . '/images/' . $video_data['image']))
					{
						$video_image = '<img src="' . $video_image_path . '/images/' . $video_data['image'] . '" class="postimage" alt="' . $video_name[1] . '" title="' . $video_name[1] . '" /> ';
					}
					$video_link = $user->lang['ABBC3_BBVIDEO_VIDEO'] . ' : <a href="' . $in . '" onclick="window.open(this.href);return false;" >' . $video_name[1] . '</a>';
				}
				else
				{
					preg_match_all('#' . $video_name . '#si', $in, $file_name);
					// Some files have more than 1 extension, find out the proper image for this one
					$file_name = (isset($file_name[1])) ? $file_name[1] : $file_name[0];
					if (isset($file_name[1]) && file_exists($video_image_path . '/images/' . $file_name[1] . '.gif'))
					{
						$video_image = '<img src="' . $video_image_path  . '/images/' . $file_name[1] . '.gif' . '" class="postimage" alt="' . $file_name[1] . '" title="' . $file_name[1] . '" /> ';
					}
					else if (file_exists($video_image_path . '/images/' . $video_data['image']))
					{
						$video_image = '<img src="' . $video_image_path  . '/images/' . $video_data['image'] . '" class="postimage" alt="' . $file_name[0] . '" title="' . $file_name[0] . '" /> ';
					}
					$video_link = $user->lang['ABBC3_BBVIDEO_FILE'] . ' : <a href="' . $in . '" onclick="window.open(this.href);return false;" >' . (isset($file_name[1]) ? $file_name[1] : $file_name[0]) . '</a>';
				}

				if ($video_data['replace'] === 'external')
				{
					$out = str_replace(array('{BBVIDEO_WIDTH}', '{BBVIDEO_IMAGE}', '{BBVIDEO_LINK}', '<div class="bbvideocontent">{BBVIDEO_VIDEO}</div>'), array($video_width + 10, $video_image, $video_link, ''), $this->bbcode_tpl('bbvideo'));
					break;
				}

				$video_content = preg_replace($video_data['match'], $video_data['replace'], $in);

				// Resize acording the video settings, and perform some code clearance
				$video_content = str_replace(array ('{WIDTH}', '{HEIGHT}', '{ID}') , array ($video_width, $video_height, $video_unique_id) , $video_content);

				$out = str_replace(array('{BBVIDEO_WIDTH}', '{BBVIDEO_IMAGE}', '{BBVIDEO_LINK}', '{BBVIDEO_VIDEO}'), array($video_width + 10, $video_image, $video_link, $video_content), $this->bbcode_tpl('bbvideo'));
				break;
			}
		}
		// if nothig have being found correctly, return without changes
		$out = ($out) ? $out : '[BBvideo' . (($w && $h) ? " $w,$h" : '') . ']' . $in . '[/BBvideo]';
		return $out;
	}
}
// Advanced BBCode Box 3 class End

// Advanced BBCode Box 3 functions - Start
	/**
	* Transform an array into a serialized format
	* Because serialize a large array ( almost 70 key ) 
	* will return a large string to store into the config value
	* we need another way to manage it.
	*
	* @param mixed	$input	array or string to transform
	* @param bool	$mode	array to string or string to array
	* @version 3.0.8
	**/
	function video_serialize($input, $mode = true)
	{
		$out = '';
		if ($mode)
		{
			foreach ($input as $key => $value)
			{
				$out .= $value . ';';
			}
		}
		else
		{
			$out = explode(";", $input);
		}

		return $out;
	}
// Advanced BBCode Box 3 functions - End

// MOD : eD2k links - START
	/**
	* eD2k Add-on optionally called from viewtopic
	*	display table with ed2k links features
	*
	* @param string		$text		post text
	* @param int		$post_id	post id
	* @return string
	* @version 3.0.8
	**/
	function abbc3_add_all_ed2k_link($text, $post_id)
	{
		// dig through the message for all ed2k links!
		$match = array();
		preg_match_all('/href="(ed2k:(.*?))"[^>]*>(.*?)</i', $text, $match);

		$ed2k_links = $match[1];
		$ed2k_names = $match[3];

		// no need to dig through it if there are not at least 2 links!
		if (sizeof($ed2k_links) > 1)
		{
			foreach ($ed2k_links as $ed2k_link => $item)
			{
				$t_ed2k_parts = explode("|", $ed2k_links[$ed2k_link]);
				$block_array[$post_id][] = array(
					'LINK_VALUE' 	=> $ed2k_links[$ed2k_link],
					'LINK_TEXT'		=> (isset($ed2k_names[$ed2k_link])) ? $ed2k_names[$ed2k_link] : $t_ed2k_parts[2],
				);
			}
		}
		return $block_array;
	}

	/**
	* eD2k Add-on optionally called from viewtopic
	* 	Replace magic urls and display ed2k links format
	*	Cuts down displayed size of link if over 50 chars, turns absolute links
	* 
	* @param string 	$link	post links with ed2k href
	* @return string	display ed2k links format
	* @version 3.0.8
	**/
	function abbc3_ed2k_make_clickable($link)
	{
		global $user, $config, $phpbb_root_path;

		$ed2k_icon = $this->abbcode_config['S_ABBC3_PATH'] . '/images/emule.gif';
		$ed2k_stat = $this->abbcode_config['S_ABBC3_PATH'] . '/images/stats.gif';

		$matches = preg_match_all("#(^|(?<=[^\w\"']))(ed2k://\|(file|server|friend)\|([^\\/\|:<>\*\?\"]+?)\|(\d+?)\|([a-f0-9]{32})\|(.*?)/?)(?![\"'])(?=([,\.]*?[\s<\[])|[,\.]*?$)#i", $link, $match);

		if ($matches)
		{
			foreach ($match[0] as $i => $m)
			{
				$ed2k_link	= (isset($match[2][$i])) ? $match[2][$i] : '';

				// Only for testing propose, commented out so I do not loose the code.
			//	$ed2k_type	= (isset($match[3][$i])) ? $match[3][$i] : '';
				$ed2k_size	= (isset($match[5][$i])) ? $match[5][$i] : '';
				$ed2k_hash	= (isset($match[6][$i])) ? $match[6][$i] : '';

				$max_len	= 100;
				$ed2k_name	= (isset($match[4][$i])) ? $match[4][$i] : '';

				$ed2k_name	= (strlen($ed2k_name) > $max_len) ? substr($ed2k_name, 0, $max_len - 19) . '...' . substr($ed2k_name, -16) : $ed2k_name;
				return ' <img src="' . $ed2k_icon . '" class="ed2k_img" alt="" title="" />&nbsp;<a href="' . $ed2k_link . '" class="postlink">' . $ed2k_name . '</a>&nbsp;[' . abbc3_ed2k_humanize_size($ed2k_size) . ']&nbsp;<a href="http://ed2k.shortypower.org/?hash=' . $ed2k_hash . '" onclick="window.open(this.href);return false;"><img src="' . $ed2k_stat . '"  alt="" title="" /></a>';
			}
		}
	}

	/**
	* Display ed2k size in a human readable way ;)
	*
	**/
	function abbc3_ed2k_humanize_size($size, $rounder = 0)
	{
		$sizes		= array('Bytes', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb');
		$rounders	= array(0, 1, 2, 2, 2, 3, 3, 3, 3);
		$ext		= $sizes[0];
		$rnd		= $rounders[0];

		if ($size < 1024)
		{
			$rounder	= 0;
			$format		= '%.' . $rounder . 'f Bytes';
		}
		else
		{
			for ($i = 1, $cnt = count($sizes); ($i < $cnt && $size >= 1024); $i++)
			{
				$size	= $size / 1024;
				$ext	= $sizes[$i];
				$rnd	= $rounders[$i];
				$format	= '%.' . $rnd . 'f ' . $ext;
			}
		}

		if (!$rounder)
		{
			$rounder = $rnd;
		}
		return sprintf($format, round($size, $rounder));
	}
// MOD : eD2k links - END

/**
 * linktest class
 * 
 * This class is used to check the validity of file host links (also called one-click hosts). 
 * It does so by looking for the file size that the host displays. It requires that you have
 * curl installed and a version of PHP that supports preg_match and preg_replace.
 * 
 * @license 	GPL license
 * @author	 	Max Power
 * @copyright	2008, Max Power
 */
class linktest
{
	// global variables shared by all methods
	var $url, $method, $format, $domain, $adjustment, $filters;

	// class constants
	var $PATTERN 	= "@([\d\.,\s]+)(KB|MB|GB)@i";
	var $CONVERSION = 1024;

	/**
	* The test method is the only public method and the only method necessary for interfacing
	* with this class. The list of supported hosts is in this method. Only six hosts are used
	* as default but many others are available as needed and need to be uncommented for use.
	* 
	* @param string url (required) - must be a full url including http://
	* @param string format (optional) - only accepted strings are 'KB', 'MB', and 'GB'
	* @param boolean supported (optional) - to only allow supported hosts or not
	* @return array result - zero index is either a number or false
	**/ 
	function test($url, $format = 'MB', $supported = false)
	{
		/** check for valid hostname in url **/
		$pattern = '@^https?://?([^/]+)@i';
		
		if (preg_match($pattern, $url, $matches))
		{
			$hostname = $matches[1];
		}
		else
		{
			$result[0] = false;
		//	Only for testing propose, commented out so I do not loose the code.
		//	$result[1] = 'invalid url';
		//	$result[2] = "The link provided is not a valid url";
			return $result;
		}
		
		/** set format to 'MB' if variable is not KB, MB or GB **/
		$format = strtoupper($format);
		
		if ($format !== 'KB' && $format !== 'MB' && $format !== 'GB')
		{
			$format = 'MB';
		}
		
		/** set supported to true if variable is not true or false **/
		if ($supported !== true && $supported !== false)
		{
			$supported = true;
		}
		
		// set global variables
		$this->url = $url;
		$this->format = $format;
		
		/** FILE HOST PROCESSING
		* array of hosts to check against url
		* important: do not change key names
		* the following is the format of the hosts array:
		* $hosts[method name][domain name] = array(domain pattern, url retrieve method, size adjustment, filters array);
		**/
		
		/* most popular hosts */
		$hosts['rapidshare']['rapidshare.com'] 		= array("@rapidshare\.com@i", 'curl', 1000/$this->CONVERSION, array('@<u>100 MB</u>@i'));
		$hosts['rapidshare']['rapidshare.de'] 		= array("@rapidshare\.de@i", 'curl', 1, array('@>300 MB<@i'));
		$hosts['other']['megaupload.com'] 			= array("@megaupload\.com@i", 'curl', 1);
		$hosts['other']['megarotic.com'] 			= array("@megarotic\.com@i", 'curl', 1);
		$hosts['other']['depositfiles.com'] 		= array("@depositfiles\.com@i", 'file', 1);
		$hosts['other']['megashares.com'] 			= array("@megashares\.com@i", 'curl', 1, array('@ 10GB@i'));
		
		/** lesser known hosts these hosts are commented out but can be used as needed **/
		//$hosts['other']['filefactory.com'] 		= array("@filefactory\.com@i", 'curl', 1);
		//$hosts['other']['sendspace.com'] 			= array("@sendspace\.com@i", 'file', 1);
		//$hosts['other']['badongo.com'] 			= array("@badongo\.com@i", 'curl', 1);
		//$hosts['other']['filecloud.com'] 			= array("@filecloud\.com@i", 'curl', 1);
		//$hosts['other']['filefront.com'] 			= array("@filefront\.com@i", 'curl', 1);
		//$hosts['other']['gigasize.com'] 			= array("@gigasize\.com@i", 'curl', 1);
		//$hosts['other']['uploadmb.com'] 			= array("@uploadmb\.com@i", 'curl', pow(1000/self::CONVERSION, 2));
		//$hosts['other']['speedshare.org'] 		= array("@speedshare\.org@i", 'curl', 1);
		//$hosts['other']['uploading.com'] 			= array("@uploading\.com@i", 'curl', 1);
		//$hosts['other']['furk.net'] 				= array("@furk\.net@i", 'curl', 1);
		//$hosts['other']['savefile.info'] 			= array("@savefile\.info@i", 'curl', 1);
		//$hosts['other']['arbup.org'] 				= array("@arbup\.org@i", 'curl', 1, array('@x 120MB p@i'));
		//$hosts['other']['getupload.com']			= array("@getupload\.com@i", 'curl', 1);
		//$hosts['other']['turboupload.com'] 		= array("@turboupload\.com@i", 'curl', 1);
		//$hosts['other']['titanicshare.com'] 		= array("@titanicshare\.com@i", 'curl', 1);
		//$hosts['other']['file2you.net'] 			= array("@file2you\.net@i", 'curl', 1);
		//$hosts['other']['upitus.com'] 			= array("@upitus\.com@i", 'curl', 1, array('@o 80 MB \(@i'));
		//$hosts['other']['egoshare.com'] 			= array("@egoshare\.com@i", 'curl', 1);
		//$hosts['other']['tornadodrive.com'] 		= array("@tornadodrive\.com@i", 'curl', 1);
		//$hosts['other']['uploadpalace.com'] 		= array("@uploadpalace\.com@i", 'curl', 1);
		//$hosts['other']['4filehosting.com'] 		= array("@4filehosting\.com@i", 'curl', 1);
		//$hosts['other']['primeupload.com'] 		= array("@primeupload\.com@i", 'curl', 1);
		//$hosts['other']['yousendit.com'] 			= array("@yousendit\.com@i", 'file', 1);
		//$hosts['other']['transferbigfiles.com']	= array("@transferbigfiles\.com@i", 'file', 1, array('@o 1gb p@i', '@>~300kb<@i'));
		//$hosts['other']['mailbigfile.com'] 		= array("@mailbigfile\.com@i", 'curl', 1);
		//$hosts['other']['friendlyfiles.net'] 		= array("@friendlyfiles\.net@i", 'curl', 1);
		//$hosts['other']['bigupload.com'] 			= array("@bigupload\.com@i", 'file', 1);
		//$hosts['other']['axifile.com'] 			= array("@axifile\.com@i", 'curl', 1, array('@ 200 @i'));
		//$hosts['other']['speedyshare.com'] 		= array("@speedyshare\.com@i", 'curl', 1);
		//$hosts['other']['justupit.com'] 			= array("@justupit\.com@i", 'curl', 1, array('@>170mb!!<@i'));
		//$hosts['other']['momoshare.com'] 			= array("@momoshare\.com@i", 'curl', 1);
		//$hosts['other']['internetfiles.org'] 		= array("@internetfiles\.org@i", 'curl', 1);
		//$hosts['other']['ultrashare.net'] 		= array("@ultrashare\.net@i", 'curl', 1, array('@ 100MB P@i'));
		//$hosts['other']['upload2.net'] 			= array("@upload2\.net@i", 'curl', 1, array('@s 25Mb@i'));
		//$hosts['other']['webfilehost.com'] 		= array("@webfilehost\.com@i", 'curl', 1, array('@500\s?MB@i'));
		//$hosts['other']['rapidfile.net'] 			= array("@rapidfile\.net@i", 'file', 1, array('@o 300 MB U@i'));
		//$hosts['other']['zshare.net'] 			= array("@zshare\.net@i", 'file', 1);*/
		
		/** find out which host to check and set variables from array **/
		$host = false;
		
		foreach ($hosts as $key => $value)
		{
			foreach ($value as $domain => $pattern)
			{
				if (preg_match($pattern[0], $hostname, $matches))
				{
					$host = $key;
					$this->domain		= $domain;
					$this->method		= $pattern[1];
					$this->adjustment	= $pattern[2];
					$this->filters      = (isset($pattern[3])) ? $pattern[3] : '' ;	// (@$pattern[3]) ? $pattern[3] : '' ;
				}
			}
		}
		
		/** return false if no supported hosts were matched or set default variables if supported is false **/
		if (!$host)
		{
			if ($supported == true)
			{
				$result[0] = false;
			//	Only for testing propose, commented out so I do not loose the code.
			//	$result[1] = 'invalid host';
			//	$result[2] = "The domain $hostname is not a supported host";
				return $result;
			}
			else
			{
				$host = 'other';
				$this->domain = $hostname;
				$this->method = 'curl';
				$this->adjustment = 1;
				$this->filters = null;
			}
		}

		// Delete the language folder from megaupload
		if ($hostname == 'www.megaupload.com' && preg_match("#/(.*?)/#i", $this->url) != 0)
		{
			$this->url = preg_replace('#(.*?)megaupload.com/(.*?)/(.*?)#si', '$1megaupload.com/$3', $this->url);
		}

		/** dynamic function call **/
		$result = $this->$host();
		
		return $result;
	}

	/**
	* Rapidshare requires a two step process in order to view the file size. To make it more
	* complicated, the second page can only be reached using POST. This method gathers the 
	* information required to make the POST call and passes it to the other function, which
	* the other domains use. If other hosts require a two step process, this rapidshare method
	* can be used as a template.
	* 
	* @return array result
	**/
	function rapidshare()
	{
		/** get rapidshare submit form url **/
		$pattern	= '@<form.*.action="(.*)".*.method@i';
		$matches	= $this->match($this->url, $pattern);
	//	$url		= $matches[1];
	//	$params		= "dl.start=Free";
		
		/** get rapidshare.de hidden param **/
		if ($this->domain == 'rapidshare.de')
		{
			$pattern	= '@<input.*.hidden.*.value="(.*)">@i';
			$matches	= $this->match($this->url, $pattern);
	//		$param		= $matches[1];
	//		if (!is_null($param))
	//		{
	//			$params = "$params&uri=$param";
	//		}
		}
		
		/** get file size **/
	//	$this->url	= $url;
	//	$result		= $this->other($params);
		
	//	return $result;
		return $matches;
	}

	/**
	* The other method is used to get the file size by all domains other than rapidshare. It
	* contains the standard pattern for finding the file size and also makes the call to the
	* match method and convertSize method.
	* 
	* @param string params (optional) - params is used for passing POST parameters
	* @return array result
	**/
	function other($params = null)
	{
		/** get file size and format **/
		$pattern		= $this->PATTERN;
		$matches		= $this->match($this->url, $pattern, $params);
	//	$size			= $matches[1];
	//	$sourceFormat	= strtoupper($matches[2]);
		
	//	if (is_null($size) || rtrim($size) == '')
	//	{
	//		$result[0] = false;
	//		$result[1] = 'invalid link';
	//		$result[2] = "This link for $this->domain is invalid";
	//		return $result;
	//	}
	//	else
	//	{
	//		$result[0] = true;
	//		$result[1] = 'Valid link';
	//		$result[2] = "This link for $this->domain is valid !";
	//	}
		// convert size to requested format
	//	$result = $this->convertSize($size, $sourceFormat);
		
	//	return $result;
		return $matches;
	}

	/**
	* The match method is used by the other methods to get the HTML and perform the preg_replace
	* and preg_match. First, it gets the HTML using the curl or file_get_contents method accodding
	* to the global method variable. Next, the HTML is filtered for common problems and then for
	* the domain specific filters that are stored in the global fitlers array. Finally, the filtered
	* HTML is matched against the pattern that is passed into the method.
	* 
	* @param string url (required) - this url may not always be the same as the global url so it must be passed
	* @param string params (optional) - params is used for passing POST parameters
	* @return array result
	**/
	function match($url, $pattern, $params = null)
	{
		/** get html from url **/
		if ($this->method == 'curl')
		{
			$curl = curl_init();
			
			if (!is_null($params))
			{
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
			}
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$html = curl_exec($curl);
			curl_close($curl);
		}
		else
		{
			if (!is_null($params))
			{
				$options = array('http' => array('method' => 'POST', 'content' => $params));
				$context = stream_context_create($options);
				$html = file_get_contents($url, null, $context);
			}
			else
			{
				$html = file_get_contents($url);
			}
		}
		
		/** uncomment line below to test unfiltered html **/
		// echo "<xmp>$html</xmp>"; exit;
		
		/** setup patterns for preg_replace to remove common-problem text **/
		$patterns[] = '@<title>.*?</title>@i';
		$patterns[] = '@<meta.*?>@i';
		$patterns[] = '@<noscript>(.|\n)*?</noscript>@i';
		$patterns[] = '@&nbsp;@i';
		$patterns[] = '@</b>@i';
		
		/** add custom patterns from filters array **/
		if (is_array($this->filters))
		{
			foreach ($this->filters as $value)
			{
				$patterns[] = $value;
			}
		}
		
		/** process patterns with preg_replace **/
		foreach ($patterns as $value)
		{
			$test = preg_replace($value, ' ', $html);
			if (!is_null($test))
			{
				$html = $test;
			}
		}
		
		/** uncomment line below to test filtered html **/
		// echo "<xmp>$html</xmp>"; exit;
		
		/** check html against pattern and return result **/
		if (preg_match($pattern, $html, $matches))
		{
			return $matches;
		}
		else
		{
			return false;
		}
	}

	/**
	* The convertSize method is used to change the file size from the format that the host
	* uses (KB, MB, or GB) to the file size format that was requested from the test method.
	* It also uses the adjustment variable, which is used if the host converts their file
	* sizes wrong (the most noteable example is rapidshare.com, which needs adjustment).
	* 
	* @param number size (required) - the file size that was matched from the host
	* @param string sourceFormat (required) - the format that the host uses (not the requested format)
	* @return array result
	**/
	function convertSize($size, $sourceFormat)
	{
		/** set variables for equation **/
		$size				= str_replace(',', '', $size);
		$conversion			= $this->CONVERSION;
		$adjustment			= $this->adjustment;
		$format['source']	= $sourceFormat;
		$format['final']	= $this->format;
		
		/** set multiplier and divsor for equation **/
		foreach ($format as $key => $value)
		{
			switch ($value)
			{
				case 'KB':
					$x[$key] = 1;
				break;
				case 'MB':
					$x[$key] = $conversion;
				break;
				case 'GB':
					$x[$key] = $conversion * $conversion;
				break;
			}
		}
		
		/** convert size to KB then convert to final format **/
		$size = $size * $adjustment;
		$size = ($size * $x['source']) / $x['final'];
		$result[0] = $size;
		
		return $result;
	}
}

?>