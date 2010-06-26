<?php
/**
* @package: phpBB 3.0.6 :: Advanced BBCode box 3 -> root/includes
* @version: $Id: abbcode.php, v 3.0.6 2010/01/10 10:01:10 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
*
**/

/**
* @ignore
* 
* Base article :
*	Custom BBCodes
* 		http://www.phpbb.com/community/viewtopic.php?f=46&t=579376
* 	Adding Custom BBCodes in phpBB3
* 		http://www.phpbb.com/kb/article/adding-custom-bbcodes-in-phpbb3/
* 	When pushing BBCode button, text remains selected (solved)
* 		http://www.phpbb.com/community/viewtopic.php?f=72&t=1190795
*	[BETA] BBCode Retain Selection 0.1.0
* 		http://www.startrekguide.com/community/viewtopic.php?f=82&t=2587
* 
* If you are using phpBB2, you can find compatible BBCode MODs in the BBCode section of the MOD database.
* 	http://www.phpbb.com/mods/db/index.php?i=browse&mode=group:category&sub=bbcode
* 
* Need New Ions ? :
*	http://www.famfamfam.com/lab/icons/silk/ 
* 
**/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Advanced BBCode Box 3 class
* @package phpBB3
* @version 1.0.12
**/
class abbcode
{
	var $abbcode_config		= array();
	var $abbcode_video_ary	= array();
	var $need_permissions	= array();
	var $abbc3_unique_id	= 0;
	// Hide [testlinks] and [rapidshare] link/s to guest and bots ?	
	var $hide_links			= false;	// Options true=yes / false=no, default no
	var $img_links			= true;
	// If you don't like the way to align the thumbnail images you can change
	var $thumb_float		= true;		// Options true=yes / false=no, default yes
	// If you don't like the way to align images you can change
	var $image_float		= false;	// Options true=yes / false=no, default no
	
	/**
	* Initializate config vars...
	*
	* @return unknown
	* @version 1.0.12
	**/
	function abbcode_init()
	{
		global $phpbb_root_path, $phpEx, $template, $config, $user;

		/* ABBC3 can be disabed in-line - Start */
		if (!$enable = request_var('abbc3disable', 1))
		{
			$config['ABBC3_MOD'] = false; 
			return false;
		}
		/* ABBC3 can be disabed in-line - End */

		$user->add_lang('mods/abbcode');

		/* HTML was deprecated sine v1.0.11 */
		$this->need_permissions = array('ABBC3_QUOTE', /*'ABBC3_URL',*/ 'ABBC3_IMG', 'ABBC3_THUMBNAIL', 'ABBC3_FLASH', 'ABBC3_FLV');

		$this->abbcode_config = array(
			'ABBC3_VERSION'			=> (isset($config['ABBC3_VERSION'])) ? $config['ABBC3_VERSION'] : '3.0.6' ,
			// Display ABBC3 ?
			'ABBC3_MOD'				=> (isset($config['ABBC3_MOD'])) ? $config['ABBC3_MOD'] : true,
			// Where the files are stored
			'ABBC3_PATH'			=> $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode'),
			// Resize larger images ?
			'ABBC3_RESIZE'			=> (isset($config['ABBC3_RESIZE_METHOD'])) ? ($config['ABBC3_RESIZE_METHOD'] != 'none' ? true : false) : true,
			// 'AdvancedBox' 'pop-up' 'enlarge' 'samewindow' 'newwindow' 'none'
			'ABBC3_RESIZE_METHOD'	=> (isset($config['ABBC3_RESIZE_METHOD'])) ? $config['ABBC3_RESIZE_METHOD'] : 'AdvancedBox',
			// Resize Display top bar ?
			'ABBC3_RESIZE_BAR'		=> (isset($config['ABBC3_RESIZE_BAR'])) ? $config['ABBC3_RESIZE_BAR'] : true,
			// Resize larger images in signatures ?
			'ABBC3_RESIZE_SIGNATURE'=> (isset($config['ABBC3_RESIZE_SIGNATURE'])) ? $config['ABBC3_RESIZE_SIGNATURE'] : false,
			// Resize if images is bigger than...
			'ABBC3_MAX_IMG_WIDTH'	=> (isset($config['ABBC3_MAX_IMG_WIDTH'])) ? $config['ABBC3_MAX_IMG_WIDTH'] : $config['img_max_width'],
			'ABBC3_MAX_IMG_HEIGHT'	=> (isset($config['ABBC3_MAX_IMG_HEIGHT'])) ? $config['ABBC3_MAX_IMG_HEIGHT'] : false,
			// Resize if images is bigger than...
			'ABBC3_MAX_SIG_WIDTH'	=> (isset($config['ABBC3_MAX_SIG_WIDTH'])) ? $config['ABBC3_MAX_SIG_WIDTH'] : $config['img_max_width'],
			'ABBC3_MAX_SIG_HEIGHT'	=> (isset($config['ABBC3_MAX_SIG_HEIGHT'])) ? $config['ABBC3_MAX_SIG_HEIGHT'] : false,
			// Thumbnails width
			'ABBC3_MAX_THUM_WIDTH'	=> (isset($config['ABBC3_MAX_THUM_WIDTH'])) ? $config['ABBC3_MAX_THUM_WIDTH'] : $config['img_max_thumb_width'],
			// Bakground image
			'ABBC3_BG'				=> (isset($config['ABBC3_BG'])) ? $config['ABBC3_BG'] : 'bg_abbc3.gif',
			// Display icon division for tags ?
			'ABBC3_TAB'				=> (isset($config['ABBC3_TAB'])) ? $config['ABBC3_TAB'] : 1,
			// Resize posting textarea ?
			'ABBC3_BOXRESIZE'		=> (isset($config['ABBC3_BOXRESIZE'])) ? $config['ABBC3_BOXRESIZE'] : true,
			// Usename posting 
			'POST_AUTHOR'			=> (isset($user->data['username'])) ? $user->data['username'] : '',
			// Width for posted video ?
			'ABBC3_VIDEO_WIDTH'		=> (isset($config['ABBC3_VIDEO_width'])) ? $config['ABBC3_VIDEO_width'] : 425,
			// Height for posted video ?
			'ABBC3_VIDEO_HEIGHT'	=> (isset($config['ABBC3_VIDEO_height'])) ? $config['ABBC3_VIDEO_height'] : 350,
			// Link to ABBC3 help page
			'ABBC3_HELP_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", 'mode=help'),
			// Link to ABBC3 upload page
			'ABBC3_UPLOAD_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", 'mode=upload'),
			// Link to ABBC3 wizards page
			'ABBC3_WIZARD_PAGE'		=> append_sid("{$phpbb_root_path}abbcode_page.$phpEx", "mode=wizards"),
			// Cookie
			'ABBC3_COOKIE_NAME'		=> $config['cookie_name'] . '_abbc3',
		);

		/** Display options **/
		foreach ($this->abbcode_config as $abbcode_template => $abbcode_value)
		{
			$template->assign_vars(array(
				 'S_' . $abbcode_template => $abbcode_value
			));
		}
	}

	/**
	* Display posting page
	*
	* @param string $mode
	* @version 1.0.12
	**/
	function abbcode_display($mode)
	{
		global $config, $db, $template, $user ;

		$user->add_lang('mods/abbcode');

		/**
		* Get proper auth
		*	UCP page mode = signature
		* 	ACP page mode = sig
		* 	Posting page mode = post, edit, quote, reply
		* 	else should be PM
		**/
		$display = ($mode == 'signature' || $mode == 'sig') ? 'display_on_sig' : (($mode == 'post' || $mode == 'edit' || $mode == 'quote' || $mode == 'reply') ? 'display_on_posting' : 'display_on_pm');

		/* HTML was deprecated sine v1.0.11 */
		$need_permissions  = array('ABBC3_QUOTE', /*'ABBC3_URL',*/ 'ABBC3_IMG', 'ABBC3_THUMBNAIL', 'ABBC3_FLASH', 'ABBC3_FLV');

		$sql = "SELECT abbcode, bbcode_order, bbcode_id, bbcode_group, bbcode_tag, bbcode_helpline, bbcode_image, display_on_posting 
				FROM " . BBCODES_TABLE . " 
				WHERE $display = 1 
				ORDER BY bbcode_order";
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			/** Some fixes **/
			$abbcode_name	= (($row['abbcode']) ? 'ABBC3_' : '') . strtoupper(str_replace('=', '', trim($row['bbcode_tag'])));
			$abbcode_name	= ($row['bbcode_helpline'] == 'ABBC3_ED2K_TIP') ? 'ABBC3_ED2K' : $abbcode_name;
			$abbcode_image	= trim($row['bbcode_image']);

			$abbcode_mover	= (isset($user->lang[$abbcode_name . '_MOVER'] )) ? $user->lang[$abbcode_name . '_MOVER']	: $abbcode_name;
			$abbcode_tip	= (isset($user->lang[$abbcode_name . '_TIP']   )) ? $user->lang[$abbcode_name . '_TIP']     : (($row['abbcode']) ? '' : $row['bbcode_helpline']);
			$abbcode_note	= (isset($user->lang[$abbcode_name . '_NOTE']  )) ? $user->lang[$abbcode_name . '_NOTE']    : '';
			$abbcode_example= (isset($user->lang[$abbcode_name . '_EXAMPLE'])) ? $user->lang[$abbcode_name . '_EXAMPLE'] : '';
			
			// Check phpbb permissions status
			if (in_array($abbcode_name, $this->need_permissions))
			{
				if (!$abbode_auth = $this->abbode_auth($abbcode_name, $mode))
				{
					continue;
				}
			}

			// Check ABBC3 groups permission
			if ($row['bbcode_group'])
			{
				if (!$abbode_auth = $this->abbode_phpbb_auth($row['bbcode_group']))
				{
					continue;
				}
			}

			// Haven't image ? Should be a dropdown...
			if (!$abbcode_image)
			{
				if ($row['abbcode'])
				{
					$template->assign_vars(array(
						'S_' . $abbcode_name	=> true,
						$abbcode_name . '_NAME'	=> strtolower($abbcode_name),
						$abbcode_name . '_MOVER'=> $abbcode_mover,
						$abbcode_name . '_TIP'	=> $abbcode_tip,
						$abbcode_name . '_NOTE'	=> $abbcode_note,
					));
				}
			}
			else
			{
				switch ($abbcode_name)
				{
					// Is a Line break ?
					case (substr($abbcode_name,0,11) == 'ABBC3_BREAK') :
						$template->assign_block_vars('abbc3_tags', array(
							'S_ABBC3_BREAK'		=> true,
							'TAG_NAME'			=> strtolower($abbcode_name),
						));
						break;

					// Is a Division line ? -> abbc3_division(n)
					case (substr($abbcode_name,0,14) == 'ABBC3_DIVISION') :
						$template->assign_block_vars('abbc3_tags', array(
							'S_ABBC3_DIVISION'	=> true,
							'TAG_NAME'			=> strtolower($abbcode_name),
						));
						break;

					default:
						$template->assign_block_vars('abbc3_help', array(
							'TAG_SRC'		=> $abbcode_image,
							'TAG_NAME'		=> strtolower($abbcode_name),
							'TAG_MOVER'		=> $abbcode_mover,
							'TAG_TIP'		=> $abbcode_tip,
							'TAG_NOTE'		=> $abbcode_note,
							'TAG_EXAMPLE'	=> $abbcode_example,
						));
						$template->assign_block_vars('abbc3_tags', array(
							'TAG_SRC'		=> $abbcode_image,
							'TAG_NAME'		=> strtolower($abbcode_name),
							'TAG_MOVER'		=> $abbcode_mover,
							'TAG_TIP'		=> $abbcode_tip,
							'TAG_NOTE'		=> $abbcode_note,
							'TAG_EXAMPLE'	=> $abbcode_example,
						));
				}
			}
		}
		$db->sql_freeresult($result);

		// Set Cookie and Hidden fields
		$abbc3_cookie_value	= request_var($this->abbcode_config['ABBC3_COOKIE_NAME'], 0, false);
		$abbc3_cookie_value	= ($abbc3_cookie_value) ? $abbc3_cookie_value : request_var($this->abbcode_config['ABBC3_COOKIE_NAME'], 0, false, true);

		$template->assign_vars(array(		
			'S_ABBC3_HIDDEN_FIELDS'	=> build_hidden_fields(array(
				$this->abbcode_config['ABBC3_COOKIE_NAME'] => $abbc3_cookie_value,
			)),
		));

		// Save the value into a cookie
		$user->set_cookie('abbc3', $abbc3_cookie_value, 0);
	}

	/**
	* Check some bbcodes permissions status
	* @param array		$bbcode_groups
	* @return boolean	true / false
	* @version 1.0.12
	**/
	function abbode_phpbb_auth($bbcode_groups)
	{
		global $user, $db ;

		$sql = 'SELECT * 
				FROM ' . USER_GROUP_TABLE . ' 
				WHERE user_id = ' . $user->data['user_id'] . '
				AND user_pending = 0 ';
		$result = $db->sql_query($sql);

		$user->data['agroup_id'] = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$user->data['agroup_id'][] = $row['group_id'];
		}
		$db->sql_freeresult($result);

		$bbcode_group = array();
		$bbcode_group = explode(',', $bbcode_groups);

		$return_value = false;
		foreach ($user->data['agroup_id'] as $agroup_data)
		{
			if (in_array($agroup_data, $bbcode_group))
			{
				$return_value = true;
			}
		}

		return $return_value;
	}

	/**
	* Check some bbcodes permissions status
	* @param string		$abbcode_name
	* @return boolean	true / false
	* @version 1.0.12
	**/
	function abbode_auth($abbcode_name, $mode)
	{
		global $config, $auth, $forum_id;
		/**
		* Get proper auth
		* 	UCP page mode = signature
		* 	ACP page mode = sig
		* 	Posting page mode = post, edit, quote, reply
		* 	else should be PM
		**/
		// Get phpbb bbcodes status
		if ($mode == 'post' || $mode == 'edit' || $mode == 'quote' || $mode == 'reply')
		{	// POSTING
			$bbcode_status	= ($config['allow_bbcode'] && $auth->acl_get('f_bbcode', $forum_id)) ? true : false;
			$status_ary  = array(
				'SMILES'	=> ($config['allow_smilies'] && $auth->acl_get('f_smilies', $forum_id)) ? true : false,
				'IMG'		=> ($bbcode_status && $auth->acl_get('f_img', $forum_id)) ? true : false,
				'URL'		=> ($config['allow_post_links']) ? true : false,
				'FLASH'		=> ($bbcode_status && $auth->acl_get('f_flash', $forum_id) && $config['allow_post_flash']) ? true : false,
				'QUOTE'		=> ($auth->acl_get('f_reply', $forum_id)) ? true : false,
				'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
				'UPLOAD'	=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
			);
		}
		else if ($mode == 'helpage')
		{	// ABBC3 HELP PAGE
			$bbcode_status = ($config['allow_bbcode']) ? true : false;
			$status_ary  = array(
				'SMILES'	=> ($config['allow_smilies']) ? true : false,
				'IMG'		=> ($bbcode_status) ? true : false,
				'URL'		=> ($bbcode_status && $config['allow_post_links']) ? true : false,
				'FLASH'		=> ($bbcode_status && $config['allow_post_flash']) ? true : false,
				'QUOTE'		=> $bbcode_status,
				'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
				'UPLOAD'	=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
			);
		}
		else if ($mode == 'signature' || $mode == 'sig')
		{	// SIG
			$bbcode_status = ($config['allow_sig_bbcode']) ? true : false;
			$status_ary  = array(
			//	'SMILES'	=> ($config['allow_sig_smilies']) ? true : false ,
				'IMG'		=> ($bbcode_status && $config['allow_sig_img']) ? true : false,
				'URL'		=> ($bbcode_status && $config['allow_sig_links']) ? true : false,
				'FLASH'		=> ($bbcode_status && $config['allow_sig_flash']) ? true : false,
				'QUOTE'		=> $bbcode_status,
				'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
				'UPLOAD'	=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false,
			);
		}
		else
		{	// PM
			$bbcode_status	= ($config['allow_bbcode'] && $config['auth_bbcode_pm'] && $auth->acl_get('u_pm_bbcode')) ? true : false;
			$status_ary  = array(
			//	'SMILES'	=> ($config['allow_smilies'] && $config['auth_smilies_pm'] && $auth->acl_get('u_pm_smilies')) ? true : false,
				'IMG'		=> ($config['auth_img_pm'] && $auth->acl_get('u_pm_img')) ? true : false,
				'URL'		=> ($config['allow_post_links']) ? true : false,
				'FLASH'		=> ($config['auth_flash_pm'] && $auth->acl_get('u_pm_flash')) ? true : false,
				'QUOTE'		=> $bbcode_status,
				'MOD'		=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false ,
				'UPLOAD'	=> ($auth->acl_get('a_') || $auth->acl_get('m_') || $auth->acl_getf_global('m_')) ? true : false ,
			);
		}

		list($garbage, $auth_tag) = explode('_', $abbcode_name);
		$auth_tag = ($auth_tag == 'THUMBNAIL') ? 'IMG' : (($auth_tag == 'FLV') ? 'FLASH' : $auth_tag);

		foreach ($status_ary as $phpbb3_bbcode => $value)
		{
			if (strtoupper($auth_tag) == $phpbb3_bbcode)
			{
				return $value;
			}
		}
	}

	/**
	* Parsing the tables  - Second pass.
	*
	* @param string		$stx	table style
	* @param string		$in 	post text between [table] & [/table]
	* @return string	table
	* @version 1.0.11
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
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;

		$in = str_replace(array ('<br />', "\n", "\r", "\t"), array ("", "", "", ""), $in);

		$table_ary = array(
		//	"#\[table=(.*?)\](.*?)\[/table\]#is"	=>	'<table style="$1" cellspacing="0" cellpadding="0">$2</table>',
			"#\[tr=(.*?)\](.*?)\[/tr\]#is"			=>	'<tr style="$1">$2</tr>',
			"#\[td=(.*?)\](.*?)\[/td\]#is"			=>	'<td style="$1">$2</td>',
		);

		foreach ($table_ary as $abbcode_found => $abbcode_replace)
		{
			if (preg_match($abbcode_found, $in))
			{
				$in = preg_replace($abbcode_found, $abbcode_replace, $in);
			}
		}
		return '<table style="' . $stx . '" cellspacing="0" cellpadding="0">' . $in .'</table>';
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
	* Code based of : SafeHTML Parser.
	* http://pixel-apes.com/safehtml
	* Updated by MSSTI
	* @version 1.0.11
	**/
	function safehtml($string)
	{
		// Sometimes users can write tags like m\o\z\-\b\i\n\d\i\n\g, this fix it
		$string = strtolower(str_replace(array("\\", '&#40;', '&#41;', '&amp;'), array("", '(', ')', '&'), $string));

		////
		// You can change this option to your liking, can delete or disable. 
		// eg : if you want to disale url use /*"url",*/
		////

		// dangerous protocols
		$protocols = array("url", "javascript", "vbscript", "about", "wysiwyg", "data", "view-source", "ms-its", "mhtml", "shell", "lynxexec", "lynxcgi", "hcp", "ms-help", "help", "disk", "vnd.ms.radio", "opera", "res", "resource", "chrome", "mocha", "livescript",);

		// dangerous CSS keywords
		$css = array("absolute", "fixed", "expression", "moz-binding", "content", "behavior", "include-source", "(", ")", "?", "&");

		$search = array_merge($protocols, $css);

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
	* @version 1.0.12
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
		global $user, $config, $phpbb_root_path;

		$var1 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($var1));
		$var2 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($var2));
		$link = str_replace(array(' ', '%20'), array('',''), (($var1) ? $var1 : $var2));

		$ed2k_icon = $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode') . '/images/emule.gif';
		$ed2k_stat = $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode') . '/images/stats.gif';

		$matches = preg_match_all("#(^|(?<=[^\w\"']))(ed2k://\|(file|server|friend)\|([^\\/\|:<>\*\?\"]+?)\|(\d+?)\|([a-f0-9]{32})\|(.*?)/?)(?![\"'])(?=([,\.]*?[\s<\[])|[,\.]*?$)#i", $link, $match);

		if ($matches)
		{
			foreach ($match[0] as $i => $m)
			{
				$ed2k_link	= (isset($match[2][$i])) ? $match[2][$i] : '';	// @$match[2][$i];
				// Only for testing propose, commented out so I do not loose the code.
			//	$ed2k_type	= (isset($match[3][$i])) ? $match[3][$i] : '';	// @$match[3][$i];
				$ed2k_size	= (isset($match[5][$i])) ? $match[5][$i] : '';	// @$match[5][$i];
				$ed2k_hash	= (isset($match[6][$i])) ? $match[6][$i] : '';	// @$match[6][$i];

				$max_len	= 100;
			//	$ed2k_name	= (!$var2) ? @$match[4][$i] : $var2;
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
	* @param string		$search (msn|msnlive|yahoo|google|altavista|wikipedia|lycos)
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
			case 'msn' :
			case 'msnlive':
				$search_link = 'http://search.live.com/results.aspx?q=' . str_replace(' ', '+',$search);
				break;
			case 'yahoo' :
				$search_link = 'http://search.yahoo.com/search?p=' . str_replace(' ', '+',$search);
				break;
			case 'google' :
				$search_link = 'http://www.google.com/search?q=' . str_replace(' ', '+',$search);
				break;
			case 'altavista':
				$search_link = 'http://www.altavista.com/web/results?itag=ody&amp;q=' . str_replace(' ', '+',$search); //&amp;mkt=tr-TR&amp;lf=1
				break;
			case 'wikipedia':
				// by default the search is in English language, but you can customize it,
				// simply replace    ->en<-     with your language prefix for wikipedia :)
				$search_link = 'http://en.wikipedia.org/wiki/Spezial:Search?search=' . $search;
				break;
			case 'lycos':
				$search_link = 'http://search.lycos.com/?query=' . str_replace(' ', '+',$search);
				break;
			default :
				global $config, $phpEx;
				$search_link = 'search.' . $phpEx . '?keywords=' . $search;
				$in = $config['sitename'];
				break;
		}
		return str_replace(array('{SEARCH_SITE}','{SEARCH_TEXT}', '{URL}' ,'{SEARCH_STRING}'), array(strtolower($in), strtolower($user->lang['SEARCH_MINI']), $search_link, $search), $this->bbcode_tpl('search'));
	}

	/**
	* Parsing thumbnail images - Second pass.
	*
	* @param string		$stx	align (right|center|left)
	* @param string		$in		URL = post text between [thumbnail=(right|center|left)] & [/thumbnail]
	* @return string	image
	* @version 1.0.12
	**/
	function thumb_pass($stx, $in)
	{
		global $config ;

		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;
		$w	 = (isset($config['ABBC3_MAX_THUM_WIDTH'])) ? $config['ABBC3_MAX_THUM_WIDTH'] : $config['img_max_thumb_width'];

		// check image with timeout to ensure we don't wait quite long
		if (@ini_get('allow_url_fopen') == '1' || strtolower(@ini_get('allow_url_fopen')) == 'on')
		{
			$timeout = @ini_get('default_socket_timeout');
			@ini_set('default_socket_timeout', 5);

			if ($dimension = @getimagesize($in))
			{
				if ($dimension !== false || !empty($dimension[0]))
				{
					if ($dimension[0] < $w)
					{
						$w = $dimension[0];
					}
				}
			}
			@ini_set('default_socket_timeout', $timeout);
		}

		// Wrap text for thumbnail ?
		if (!$this->thumb_float)
		{
			return str_replace(array('{ALIGN_TYPE}', '{URL}' ,'{WIDTH}'), array($stx, $in, $w), $this->bbcode_tpl('thumb_aligned'));
		}

		switch (strtolower($stx))
		{
			case 'left':
			case 'right':
				return str_replace(array('{ALIGN_TYPE}', '{URL}' ,'{WIDTH}'), array($stx, $in, $w), $this->bbcode_tpl('thumb_float'));
				break;
			case 'center':
				return str_replace(array('{ALIGN_TYPE}', '{URL}' ,'{WIDTH}'), array($stx, $in, $w), $this->bbcode_tpl('thumb_aligned'));
				break;
			default:
				return str_replace(array('{URL}' ,'{WIDTH}'), array($in, $w), $this->bbcode_tpl('thumb'));
				break;
		}
	}

	/**
	* Parsing the images aligned - Second pass.
	*
	* @param string		$stx	align (right|center|left)
	* @param string		$in		post text between [img=(right|center|left)] & [/img]
	* @return string	image
	* @version 1.0.12
	**/
	function img_pass($stx, $in)
	{
		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
		$in	 = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($in)) ;

		// Wrap text for images ?
		if (!$this->image_float)
		{
			return str_replace(array('{ALIGN_TYPE}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_aligned'));
		}

		switch (strtolower($stx))
		{
			case 'left':
			case 'right':
				return str_replace(array('{ALIGN_TYPE}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_float'));
				break;
			case 'center':
			default:
				return str_replace(array('{ALIGN_TYPE}', '{URL}'), array($stx, $in), $this->bbcode_tpl('img_aligned'));
				break;
		}
	}

	/**
	* Parsing the Moderator tag - Second pass.
	*
	* @param string		$stx	have user name param?
	* @param string		$in		post text between [mod] & [/mod]
	* @return string	table with message data
	* @version 1.0.11
	**/
	function moderator_pass($stx, $in)
	{
		$stx = str_replace(array("\r\n", '\"', '\'', '(', ')'), array("\n", '"', '&#39;', '&#40;', '&#41;'), trim($stx));
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
			$in	= make_clickable(trim(str_replace('\"', '',preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$3',$in))));
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
	* @version 1.0.12
	**/
	function testlink_pass($in)
	{
		global $user, $config, $phpbb_root_path ;

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
			$in	= trim($in);
			$path = $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode');

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
						$linktest_pic	= '<img src="' . $path . '/images/error.gif" class="postimage" alt="' . $user->lang['ABBC3_TESTLINK_WRONG'] . '" title="' . $user->lang['ABBC3_TESTLINK_WRONG'] . '" />';
					}
					else
					{
						$linktest_msg	= '<span class="abbc3_good">' . $user->lang['ABBC3_TESTLINK_GOOD'] . '</span>';
						$linktest_pic	= '<img src="' . $path . '/images/ok.gif"    class="postimage" alt="' . $user->lang['ABBC3_TESTLINK_GOOD'] .'" title="' . $user->lang['ABBC3_TESTLINK_GOOD'] .'" />';
					}

					$linktest_value		= '<a href="' .$linktest_value . '" onclick="window.open(this.href);return false;" alt="' .$linktest_value . '" title="' .$linktest_value . '" >' . $linktest_value . '</a>';
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
	//	return '<dl class="testlink"><dt>testlink</dt><dd>'. $linktest_echo . '</dd></dl>';
		return '<dl class="testlink"><dd>'. $linktest_echo . '</dd></dl>';
	}

	/**
	* Enter rapidshare checker
	*
	* @param string		$in 	post text between [rapidshare] &[/rapidshare]
	* @return string	link with text ok/wrong
	* @version 1.0.12
	**/
	function rapidshare_pass($in)
	{
		global $user, $config, $phpbb_root_path;

		// If hide links is enabled and the user is a guest or a bots, do not display it !
		if ($this->hide_links && ($user->data['user_id'] == ANONYMOUS || $user->data['is_bot']))
		{
			return '<dl class="codebox codecontent" style="display:inline; padding: 0px;"><dd style="display:inline;color:#ff0000">'. $user->lang['LOGIN_EXPLAIN_VIEW'] . '</dd></dl>';
		}

		if (ini_get('allow_url_fopen') != 1)
		{
			return $user->lang['ABBC3_FOPEN_ERROR'] ;
		}

		$in = trim($in);
		$path = $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode');
		$rapidshare_echo	 = '';

		$rapidshare_links	 = explode("\n", $in);
		if (sizeof($rapidshare_links) > 1)
		{
			// undo make_clickable_callback(); and Remove Comments from post content
			return "[rapidshare]" . str_replace('\"', '',preg_replace('#<!-- ([lmwe]) --><a class=(.*?) href=(.*?)>(.*?)</a><!-- ([lmwe]) -->#si','$2',$in)) . "[/rapidshare]";
		}

		$rs_checkfiles = fopen ("http://rapidshare.com/cgi-bin/checkfiles.cgi?urls=" . $in, "r");	
		while (!feof ($rs_checkfiles))
		{
			$buffer = fgets ($rs_checkfiles, 4096);
			if (eregi('File is on server number', $buffer))
			{
				$rapidshare_msg = '<span class="abbc3_good">' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '</span>';
				$rapidshare_pic = '<img src="' . $path . '/images/ok.gif" class="postimage" alt="' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '" title="' . $user->lang['ABBC3_RAPIDSHARE_GOOD'] . '" />';
				break;
			}
			else
			{
				$rapidshare_msg = '<span class="abbc3_wrong">' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '</span>';
				$rapidshare_pic = '<img src="' . $path . '/images/error.gif" class="postimage" alt="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" title="' . $user->lang['ABBC3_RAPIDSHARE_WRONG'] . '" />';
				break;
			}
		}
		fclose ($rs_checkfiles);

		// If img_links is enabled use images, else use string
		$rapidshare_echo .= '<a href="' . $in . '" title="' . $in . '" alt="' . $in . '" onclick="window.open(this.href);return false;">' . $in . '</a>' . (($this->img_links) ? '&nbsp;' . $rapidshare_pic : '&nbsp;' . $rapidshare_msg) . "<br />";

	//	return '<dl class="testlink"><dt>testlink</dt><dd>'. $linktest_echo . '</dd></dl>';
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

			/**
			* Only run the javascript for the first tabs in this page ;)
			**/
			if ($postTabs_pass == 1)
			{
				$output_rest .= '<script type="text/javascript">kmrSimpleTabs.addLoadEvent();</script>';
			}

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
	* @version 1.0.12
	**/
	function flash_pass($width = 0, $height = 0, $link = '')
	{
		if ($link)
		{
			if (!$width || !$height)
			{
				global $config;
				$width = ($width) ? $width : (isset($config['ABBC3_VIDEO_width'])) ? $config['ABBC3_VIDEO_width'] : 425;
				$height = ($height) ? $height : (isset($config['ABBC3_VIDEO_height'])) ? $config['ABBC3_VIDEO_height'] : 350;
			}

			return str_replace(array('{WIDTH}','{HEIGHT}', '{URL}'), array($width, $height, $link), $this->bbcode_tpl('bbflash'));
		}
	}

	/**
	* Initialize Video array
	* @version 1.0.12
	**/
	function video_init()
	{
		/** 
		* @ignore 
		* <br />0=($0)<br />1=($1)<br />2=($2)<br />3=($3)<br />4=($4)<br />5=($5)<br />6=($6)<br />
		* http://www.osflv.com/ flv player
		* http://autoembed.com/demos/
		* @todo
		* 	youporn.com is not possible
		* 	dotsub.com  is not possible
		*	probetv.com is really very hard !!
		* 	http://www.scribd.com/doc/2568988/Rock-Collection-by-Ken-McConnell
		* 	http://blip.tv/file/1664131?utm_source=featured_ep&utm_medium=featured_ep
		**/

		/** Patterns and replacements for BBVIDEO bbcode processing **/
		$this->abbcode_video_ary = array(
/** http://autoembed.com/demos/ - Start
			'123video'						=> array ('display' => true	,'image' => '123video.gif'		,'example' => "http://www.123video.nl/playvideos.asp?MovieID=438011"																			,'found' => '#http://(?:www\.)?123video\.nl/(?:playvideos\.asp\?(?:[^"]*?)?MovieID=|123video_share\.swf\?mediaSrc=)([0-9]{1,8})#si'		,'regexp' => '<object classid="CLSID:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"> <param name="movie" value="http://www.123video.nl/123video_share.swf?mediaSrc=$1" /><param name="wmode" value="transparent" /><param name="quality" value="high" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="pluginspage" value="http://www.macromedia.com/go/getflashplayer" /><param name="autoplay" value="false" /><param name="autostart" value="false" /> <embed type="application/x-shockwave-flash" src="http://www.123video.nl/123video_share.swf?mediaSrc=$1" width="{WIDTH}" height="{HEIGHT}" wmode="transparent" quality="high" allowFullScreen="true" allowScriptAccess="always" pluginspage="http://www.macromedia.com/go/getflashplayer" autoplay="false" autostart="false" flashvars="" /></object>'),
			'5min.com'						=> array ('display' => true	,'image' => '5min.gif'			,'example' => "http://www.5min.com/Video/How-To-Give-a-Shot-to-a-Cat-80416644"																	,'found' => '#http://(?:www\.)?5min\.com/(?:Embeded/|Video/(?:[0-9a-z_-]*?)?-)([0-9]{8})#si'			,'regexp' => '<object classid="CLSID:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.5min.com/Embeded/$1/" /><param name="wmode" value="transparent" /><param name="quality" value="high" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="pluginspage" value="http://www.macromedia.com/go/getflashplayer" /><param name="autoplay" value="false" /><param name="autostart" value="false" /> <embed type="application/x-shockwave-flash" src="http://www.5min.com/Embeded/$1/" width="{WIDTH}" height="{HEIGHT}" wmode="transparent" quality="high" allowFullScreen="true" allowScriptAccess="always" pluginspage="http://www.macromedia.com/go/getflashplayer" autoplay="false" autostart="false" flashvars="" /></object>'),
			'9You.com'						=> array ('display' => true	,'image' => '9You.gif'			,'example' => "http://v.9you.com/watch/xuzegfifj.html"																							,'found' => '#http://(?:www\.|v\.)?9you\.com/(?:player|watch)/([0-9a-z]{9})([^[]*)#si'					,'regexp' => '<object classid="CLSID:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://v.9you.com/player/$1.swf" /><param name="wmode" value="transparent" /><param name="quality" value="high" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="pluginspage" value="http://www.macromedia.com/go/getflashplayer" /><param name="autoplay" value="false" /><param name="autostart" value="false" /> <embed type="application/x-shockwave-flash" src="http://v.9you.com/player/$1.swf" width="{WIDTH}"  height="{HEIGHT}" wmode="transparent" quality="high" allowFullScreen="true" allowScriptAccess="always" pluginspage="http://www.macromedia.com/go/getflashplayer" autoplay="false" autostart="false" flashvars="" /></object>'),
			'aniboom.com'					=> array ('display' => true	,'image' => 'aniboom.gif'		,'example' => "http://www.aniboom.com/video/302103/Rassa-Park/"																					,'found' => '#http://(?:www\.|api\.)?aniboom\.com/(?:Player.aspx\?(?:[^"]*?)?v=|video/|e/)([0-9]{1,10})([^[]*)#si'						,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://api.aniboom.com/e/$1" /><param name="allowScriptAccess" value="sameDomain" /><param name="quality" value="high" /><embed src="http://api.aniboom.com/e/$1" quality="high"  width="{WIDTH}"  height="{HEIGHT}" allowscriptaccess="sameDomain" type="application/x-shockwave-flash"></embed></object><br />0=($0)<br />1=($1)<br />2=($2)<br />3=($3)<br />4=($4)<br />5=($5)<br />6=($6)<br />'),
/** http://autoembed.com/demos/ - End **/

			'uncutvideo.aol.com'			=> array ('display' => true	,'image' => 'aol.gif'			,'example' => "http://uncutvideo.aol.com/categories/News/month/007c338a423704ba813dadd72fb75408?index=0"										,'found' => "#http://uncutvideo.aol.com/([^[]*\/([0-9A-Za-z-_]*)?)?([^[]*)?#si"							,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="wmode" value="opaque" /><param name="movie" value="http://uncutvideo.aol.com/v7.0017/en-US/uc_videoplayer.swf" /><param name="FlashVars" value="aID=1$2&site=http://uncutvideo.aol.com/"/><embed src="http://uncutvideo.aol.com/v7.0017/en-US/uc_videoplayer.swf" wmode="opaque" FlashVars="aID=1$2&site=http://uncutvideo.aol.com/" width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash"></embed></object>'),
			'badr.tv'						=> array ('display' => true	,'image' => 'badrtv.gif'		,'example' => "http://www.badr.tv/video/8d0cbedc973445af2da"																					,'found' => "#http://www.badr.tv/video/([0-9A-Za-z]+)?([^[]*)?#is"										,'regexp' => '<embed width="{WIDTH}" height="{HEIGHT}" quality="high" bgcolor="#000000" name="main" id="main" src="http://www.badr.tv/modules/vPlayer/vPlayer.swf?f=http://www.badr.tv/modules/vPlayer/vPlayercfg.php?fid=$1" allowscriptaccess="always" allowfullscreen="false" type="application/x-shockwave-flash"/></embed>'),
			'comedycentral.com'				=> array ('display' => true	,'image' => 'comedycentral.gif'	,'example' => "http://www.comedycentral.com/videos/index.jhtml?videoId=185763&title=weekly-evil-six-reasons-alaska"								,'found' =>	"#http://www.comedycentral.com/videos/index.jhtml\?videoId=([0-9]+)([^[]*\w=([^[]*)?)?#si"	,'regexp' => '<embed src="http://media.mtvnservices.com/mgid:cms:item:comedycentral.com:$1" width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" wmode="window" allowFullscreen="true" flashvars="autoPlay=false" allowscriptaccess="always" allownetworking="all" bgcolor="#000000"></embed>'),
			'comedians.comedycentral.com'	=> array ('display' => true	,'image' => 'comedians.gif'		,'example' => "http://comedians.comedycentral.com/bert-kreischer/videos/bert-kreischer---twelve-words"											,'found' =>	"#http://comedians.comedycentral.com/([^[]*)?#sie"											,'regexp' => "\$this->external_video('\$0', 'embed')"),
			'www.clipfish'					=> array ('display' => true	,'image' => 'clipfish.gif'		,'example' => "http://www.clipfish.de/player.php?videoid=NTU2Mzd8MTk5NTM1Nw=="																	,'found' => "#http://www.clipfish.(.*?)/([^[]*)?#sie"													,'regexp' => "\$this->external_video('\$0', 'object')"),
			'clipmoon.com'					=> array ('display' => true	,'image' => 'clipmoon.gif'		,'example' => "http://www.clipmoon.com/videos/9194d9/animation-versus-animator.html"															,'found' => "#http://www.clipmoon.com/(.*?)/(([0-9]+)([\w])(.*))/([^[]*)#si"							,'regexp' => '<embed src="http://www.clipmoon.com/flvplayer.swf" FlashVars="config=http://www.clipmoon.com/flvplayer.php?viewkey=$2&external=no&vimg=http://www.clipmoon.com/thumb/$3.jpg" quality="high" bgcolor="#000000" wmode="transparent" width="{WIDTH}" height="{HEIGHT}" loop="false" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" scale="exactfit" allowFullScreen="true" ></embed>'),
			'clipser.com'					=> array ('display' => true	,'image' => 'clipser.gif'		,'example' => "http://www.clipser.com/watch_video/933155"																						,'found' => "#http://www.clipser.com/watch_video/([^[]*)?#is"											,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.clipser.com/Play?vid=$1"></param><param name="wmode" value="transparent"></param><embed src="http://www.clipser.com/Play?vid=$1" type="application/x-shockwave-flash" wmode="transparent" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'collegehumor.com'				=> array ('display' => true	,'image' => 'collegehumor.gif'	,'example' => "http://www.collegehumor.com/video:1802097"																						,'found' => "#http://www.collegehumor.com/video:([0-9]+)#si"											,'regexp' => '<object type="application/x-shockwave-flash" data="http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=$1&fullscreen=1" width="{WIDTH}" height="{HEIGHT}" ><param name="movie" quality="best" value="http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=$1&fullscreen=1" /><param name="allowfullscreen" value="true" /></object>'),
			'crackle.com'					=> array ('display' => true	,'image' => 'crackle.gif'		,'example' => "http://crackle.com/c/High_Wire/Fall_Out_Boy_Songs/2185986"																		,'found' => "#http://crackle.com/([A-Za-z-_/]+)?([0-9]+)?([^[]*)?#is"									,'regexp' => '<embed src="http://crackle.com/flash/ReferrerRedirect.ashx" quality="high" bgcolor="#869ca7" width="{WIDTH}" height="{HEIGHT}" name="mtgPlayer" align="middle" play="false" loop="false" allowFullScreen="true" flashvars="mu=0&ap=0&ml=o%3D12%26fi%3D%26fpl%3D2839&id=$2" quality="high" allowScriptAccess="never" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer"/>'),
			'dailymotion.com'				=> array ('display' => true	,'image' => 'dailymotion.gif'	,'example' => "http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport"													,'found' => "#http://www.dailymotion.com(.*?)/video/([^[]*)?#si"										,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.dailymotion.com/swf/$2&v3=1&related=1"/><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><embed src="http://www.dailymotion.com/swf/$2&v3=1&related=1" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}" allowFullScreen="true" allowScriptAccess="always"></embed></object>'),
			'deviantart.com'				=> array ('display' => true	,'image' => 'deviantart.gif'	,'example' => "http://bossk.deviantart.com/art/COLLEGE-FRIES-trailer-106469587"																	,'found' => "#http://(.*?).deviantart.com/([^[]*)?#sie"													,'regexp' => "\$this->external_video('\$0', 'object')"),
			'g4tv.com'						=> array ('display' => true	,'image' => 'g4tv.gif'			,'example' => "http://www.g4tv.com/xplay/videos/29265/Infamous_All_Access.html"																	,'found' => "#http://((.*?)?)g4tv.com/(.*?)/(.*?)/(.*?)/([^[]*)?#si"									,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}" id="VideoPlayer"><param name="movie" value="http://www.g4tv.com/lv3/$5" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><embed src="http://www.g4tv.com/lv3/$5" type="application/x-shockwave-flash" name="VideoPlayer" width="{WIDTH}" height="{HEIGHT}" allowScriptAccess="always" allowFullScreen="true" /></object>'),
			'gamepro.com'					=> array ('display' => true	,'image' => 'gamepro.gif'		,'example' => "http://www.gamepro.com/video/trailers/132252/punchout-debut-trailer/"															,'found' => "#http://www.gamepro.com/video/trailers/(.*?)/([^[]*)?#is"									,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}" ><param name="movie" value="http://www.gamepro.com/bin/vid-bin/octPlayer.swf?vId=$1&p=e&ae=d"></param><param name="allowFullScreen" value="false"></param><embed src="http://www.gamepro.com/bin/vid-bin/octPlayer.swf?vId=$1&p=e&ae=d" type="application/x-shockwave-flash" allowfullscreen="false" width="{WIDTH}" height="{HEIGHT}" ></embed></object>'),
			'gameprotv.com'					=> array ('display' => true	,'image' => 'gameprotv.gif'		,'example' => "http://www.gameprotv.com/left-4-dead-anlisis-video-5553.html"																	,'found' => "#http://www.gameprotv.com/(.*)-video-([0-9]+)?.([^[]*)?#is"								,'regexp' => '<object id="WMPlay" width={WIDTH} height={HEIGHT} classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject"><param name="url" value="http://www.gameprotv.com/playlistwmv.php?id=$2"><param name="autoStart" value="0"/><param name="AnimationatStart" value="0" /><param name="showdisplay" value="1" /><param name="TransparentAtStart" value="0" /><param name="ShowControls" value="1" /><param name="ShowStatusBar" value="1" /><param name="ClickToPlay" value="0" /><param name="bgcolor" value="#000000" /><param name="volume" value="100%" /><param name="InvokeURLs" value="0" /><param name="loop" value="0" /><embed width="{WIDTH}" height="400" type="video/x-ms-wmv" pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" src="http://www.gameprotv.com/playlistwmv.php?id=$2" Name="GameproTV" ShowControls="1" AutoStart="0" ShowDisplay="0" ShowStatusBar="1"></embed></object>'),
			'gamespot.com'					=> array ('display' => true	,'image' => 'gamespot.gif'		,'example' => "http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8"													,'found' => "#http://www.gamespot.com(.*?)/video/(.*?)(\d{7}?)(/[^/]+)?#si"								,'regexp' => '<embed id="mymovie" width="{WIDTH}" height="{HEIGHT}" flashvars="playerMode=embedded&movieAspect=4.3&flavor=EmbeddedPlayerVersion&skin=http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/skins/gamespot.png&paramsURI=http%3A%2F%2Fwww.gamespot.com%2Fpages%2Fvideo_player%2Fxml.php%3Fid%3D$3%26mode%3Dembedded%26width%3D432%26height%3D362" wmode="transparent" allowscriptaccess="always" quality="high" name="mymovie" src="http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/proteus2.swf" type="application/x-shockwave-flash"/>'),
			'gametrailers.com'				=> array ('display' => true	,'image' => 'gametrailers.gif'	,'example' => "http://www.gametrailers.com/player/30461.html"																					,'found' => "#http://www.gametrailers.com/player/([0-9]+).html#si"										,'regexp' => '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" id="gtembed" width="{WIDTH}" height="{HEIGHT}"><param name="allowScriptAccess" value="sameDomain" /><param name="allowFullScreen" value="true" /><param name="movie" value="http://www.gametrailers.com/remote_wrap.php?mid=$1"  /><param name="quality" value="high" /><embed src="http://www.gametrailers.com/remote_wrap.php?mid=$1"  swLiveConnect="true" name="gtembed" align="middle" allowScriptAccess="sameDomain" allowFullScreen="true" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'gametrailers.com'				=> array ('display' => true	,'image' => 'gametrailers.gif'	,'example' => "http://www.gametrailers.com/player/usermovies/268358.html"																		,'found' => "#http://www.gametrailers.com/player/usermovies/([0-9]+).html#si"							,'regexp' => '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" id="gtembed" width="{WIDTH}" height="{HEIGHT}"><param name="allowScriptAccess" value="sameDomain" /><param name="allowFullScreen" value="true" /><param name="movie" value="http://www.gametrailers.com/remote_wrap.php?umid=$1" /><param name="quality" value="high" /><embed src="http://www.gametrailers.com/remote_wrap.php?umid=$1" swLiveConnect="true" name="gtembed" align="middle" allowScriptAccess="sameDomain" allowFullScreen="true" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'www.gamevideos'				=> array ('display' => true	,'image' => 'gamevideos.gif'	,'example' => "http://www.gamevideos.com/video/id/17766"																						,'found' => "#http://(.*?)gamevideos(.*?).com/video/id/([^[]*)?#si"										,'regexp' => '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="{WIDTH}" height="{HEIGHT}" id="gamevideos" align="middle"><param name="quality" value="high" /><param name="play" value="true" /><param name="loop" value="true" /><param name="scale" value="showall" /><param name="wmode" value="window" /><param name="devicefont" value="false" /><param name="bgcolor" value="#000000" /><param name="menu" value="true" /><param name="allowScriptAccess" value="sameDomain" /><param name="allowFullScreen" value="true" /><param name="salign" value="" /><param name="movie" value="http://gamevideos.1up.com/swf/gamevideos12.swf?embedded=1&fullscreen=1&autoplay=0&src=http://$1gamevideos$2.com/video/videoListXML%3Fid%3D$3%26ordinal%3D%26adPlay%3Dfalse" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><embed src="http://gamevideos.1up.com/swf/gamevideos12.swf?embedded=1&fullscreen=1&autoplay=0&src=http://$1gamevideos$2.com/video/videoListXML%3Fid%3D$3%26ordinal%3D%26adPlay%3Dfalse" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" play="true" loop="true" scale="showall" wmode="window" devicefont="false" id="gamevideos" bgcolor="#000000" name="gamevideos6" menu="true" allowscriptaccess="sameDomain" allowFullScreen="true" type="application/x-shockwave-flash" align="middle" height="{HEIGHT}" width="{WIDTH}" /></object>'),
			'ign.com'						=> array ('display' => true	,'image' => 'ign.gif'			,'example' => "object_ID=967025&downloadURL=http://tvmovies.ign.com/tv/video/article/850/850894/knightrider_trailer_020808_flvlow.flv"			,'found' => "#object_ID=([0-9]+)?([^/]+[^[]*)?#si"														,'regexp' => '<embed src="http://videomedia.ign.com/ev/ev.swf" flashvars="object_ID=$1$2 type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}" ></embed>'),
			'imeem.com'						=> array ('display' => true	,'image' => 'imeem.gif'			,'example' => "http://www.imeem.com/yurakazi/music/JBj7qeCH/globus_preliator/"																	,'found' => "#http://www.imeem.com/([^[]*)?#sie"														,'regexp' => "\$this->external_video('\$0', 'object')"),
			'kyte.tv'						=> array ('display' => true	,'image' => 'kyte.gif'			,'example' => "http://www.kyte.tv/ch/182864"																									,'found' => "#http://www.kyte.tv/ch/([^[]*)?#si"														,'regexp' => '<embed type="application/x-shockwave-flash" allowScriptAccess="always" allowFullScreen="true" style="display:block;margin:0" width="{WIDTH}" height="{HEIGHT}" src="http://www.kyte.tv/flash.swf?appKey=MarbachViewerEmbedded&uri=channels/57114/$1" bgcolor="#333333"></embed><embed type="application/x-shockwave-flash" allowScriptAccess="always" style="display:block;margin:0" width="{WIDTH}" height="20" src="http://media01.kyte.tv/images/updatenotice.swf" flashvars="requiredversion=9.0.28" wmode="transparent"></embed>'),
			// Simple song
			'lala.com'						=> array ('display' => true	,'image' => 'lala.gif'			,'example' => "http://www.lala.com/song/360569449463383108"																						,'found' => "#http://www.lala.com/song/([^[]*)?#si"														,'regexp' => '<object type="application/x-shockwave-flash" data="http://www.lala.com/external/flash/SingleSongWidget.swf" id="lalaSongEmbed" width="{WIDTH}" height="70"><param name="movie" value="http://www.lala.com/external/flash/SingleSongWidget.swf"/><param name="wmode" value="transparent"/><param name="allowNetworking" value="all"/><param name="allowScriptAccess" value="always"/><param name="flashvars" value="songLalaId=$1&host=www.lala.com&partnerId=membersong"/><embed id="lalaSongEmbed" name="lalaSongEmbed" src="http://www.lala.com/external/flash/SingleSongWidget.swf" width="{WIDTH}" height="70" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" allowNetworking="all" allowScriptAccess="always" flashvars="songLalaId=$1&host=www.lala.com&partnerId=membersong"></embed></object>'),
			// album
			'lala.com/\#album'				=> array ('display' => true	,'image' => 'lala.gif'			,'example' => "http://www.lala.com/#album/360569445168415812"																					,'found' => "#http://www.lala.com/\#album/([^[]*)?#si"													,'regexp' => '<object type="application/x-shockwave-flash" data="http://www.lala.com/external/flash/PlaylistWidget.swf" id="lalaAlbumEmbed" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.lala.com/external/flash/PlaylistWidget.swf"/><param name="wmode" value="transparent"/><param name="allowNetworking" value="all"/><param name="allowScriptAccess" value="always"/><param name="flashvars" value="albumId=$1&host=www.lala.com&partnerId=memberalbum"/><embed id="lalaAlbumEmbed" name="lalaAlbumEmbed" src="http://www.lala.com/external/flash/PlaylistWidget.swf" width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" allowNetworking="all" allowScriptAccess="always" flashvars="albumId=$1&host=www.lala.com&partnerId=memberalbum"></embed></object>'),
			// playlist
			'lala.com/\#memberplaylis'		=> array ('display' => true	,'image' => 'lala.gif'			,'example' => "http://www.lala.com/#memberplaylist/2458P24912"																					,'found' => "#http://www.lala.com/\#memberplaylist/([^[]*)?#si"											,'regexp' => '<object type="application/x-shockwave-flash" data="http://www.lala.com/external/flash/PlaylistWidget.swf" id="lalaPlaylistEmbed" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.lala.com/external/flash/PlaylistWidget.swf"/><param name="wmode" value="transparent"/><param name="allowNetworking" value="all"/><param name="allowScriptAccess" value="always"/><param name="flashvars" value="playlistId=$1&host=www.lala.com&partnerId=memberplaylist"/><embed id="lalaPlaylistEmbed" name="lalaPlaylistEmbed" src="http://www.lala.com/external/flash/PlaylistWidget.swf" width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" allowNetworking="all" allowScriptAccess="always" flashvars="playlistId=$1&host=www.lala.com&partnerId=memberplaylist"></embed></object>'),
			'liveleak.com'					=> array ('display' => true	,'image' => 'liveleak.gif'		,'example' => "http://www.liveleak.com/view?i=2ac_1203907789&p=1"																				,'found' => "#http://www.liveleak.com/view\?i=([0-9A-Za-z-_]+)?(\&[^/]+)?#si"							,'regexp' => '<object width="{WIDTH}" height="{HEIGHT"><param name="movie" value="http://www.liveleak.com/e/$1"></param><param name="wmode" value="transparent"></param><embed src="http://www.liveleak.com/e/$1" type="application/x-shockwave-flash" wmode="transparent" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'livevideo.com'					=> array ('display' => true	,'image' => 'livevideo.gif'		,'example' => "http://www.livevideo.com/video/UKUFO/D930AEB5460D4707B2F6DC0CD8D3C258/haiti-and-the-dominican-republ.aspx"						,'found' => "#http://www.livevideo.com/video/([^[]*)/([^[]*)/([^[]*)#is"								,'regexp' => '<embed src="http://www.livevideo.com/flvplayer/embed/$2&autoStart=0" type="application/x-shockwave-flash" quality="high" width="{WIDTH}" height="{HEIGHT}" wmode="transparent"></embed>'),
			'machinima.com'					=> array ('display' => true	,'image' => 'machinima.gif'		,'example' => "http://www.machinima.com:80/film/view&id=281"																					,'found' => "#http://www.machinima.com(:80)?/film/view&amp;id=([^[]*)?#si"								,'regexp' => '<embed src="http://www.machinima.com$1/_flash_media_player/mediaplayer.swf" width="{WIDTH}" height="{HEIGHT}" flashvars="&file=http://www.machinima.com$1/p/$2&height={HEIGHT}&width={WIDTH}" />'),
			'megavideo.com'					=> array ('display' => true	,'image' => 'megavideo.gif'		,'example' => "http://www.megavideo.com/?v=0Q8S7E29"																							,'found' => "#http://(.*?)megavideo.com/\?v=([^[]*)#ise"												,'regexp' => "\$this->external_video('\$0', 'object')"),
			'metacafe.com'					=> array ('display' => true	,'image' => 'metacafe.gif'		,'example' => "http://www.metacafe.com/watch/966360/merry_christmas_with_crazy_frog/"															,'found' => "#http://www.metacafe.com/watch/([0-9]+)?((/[^/]+)/?)?#si"									,'regexp' => '<embed src="http://www.metacafe.com/fplayer/$1/.swf" width="{WIDTH}" height="{HEIGHT}" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>'),
			'moddb.com'						=> array ('display' => true	,'image' => 'moddb.gif'			,'example' => "http://www.moddb.com/groups/tv/videos/noesis-presents-forgotten-hope-2-interview"												,'found' => "#http://www.moddb.com/([^[]*)?#sie"														,'regexp' => "\$this->external_video('\$0', 'object')"),
			'myspacetv.com'					=> array ('display' => true	,'image' => 'myspacetv.gif'		,'example' => "http://myspacetv.com/index.cfm?fuseaction=vids.individual&videoid=25769593"														,'found' => "#http://myspacetv.com/index.cfm([^[]*)?videoid=([^[]*)?#si"								,'regexp' => '<embed src="http://lads.myspace.com/videos/vplayer.swf" flashvars="m=$2&v=2&type=video" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"></embed>'),
			'vids.myspace.com'				=> array ('display' => true	,'image' => 'vidsmyspace.gif'	,'example' => "http://vids.myspace.com/index.cfm?fuseaction=vids.individual&VideoID=28799328"													,'found' => "#http://vids.myspace.com/index.cfm([^[]*)?videoid=([^[]*)?#si"								,'regexp' => '<embed src="http://lads.myspace.com/videos/vplayer.swf" flashvars="m=$2&v=2&type=video" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"></embed>'),
			'www.myvideo'					=> array ('display' => true	,'image' => 'myvideo.gif'		,'example' => "http://www.myvideo.de/watch/2668372"																								,'found' => "#http://www.myvideo.(.*?)/(.*?)/([^[]*)?#si"												,'regexp' => '<object style="width:{WIDTH}px;height:{HEIGHT}px;" type="application/x-shockwave-flash" data="http://www.myvideo.$1/movie/$3"> <param name="movie" value="http://www.myvideo.$1/movie/$3" /><param name="AllowFullscreen" value="true" /></object>'),
		//	'photobucket.com'				=> array ('display' => true	,'image' => 'photobucket.gif'	,'example' => "http://s0006.photobucket.com/albums/0006/pbhomepage/video2/?action=view&current=dedc9ad8.flv"									,'found' => "#http://(.*?).photobucket.com/albums/(.*?)([^[]+)?\?([^[]*\w=([^[]*)?)?#si"				,'regexp' => '<embed width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" wmode="transparent" src="http://i$2.photobucket.com/player.swf?file=http://vid$2.photobucket.com/albums/$2$3$5&amp;sr=1">'),
			'photobucket.com'				=> array ('display' => true	,'image' => 'photobucket.gif'	,'example' => "http://s0006.photobucket.com/albums/0006/pbhomepage/video2/?action=view&current=dedc9ad8.flv"									,'found' => "#http://(.*?).photobucket.com/([^[]+)?\?([^[]*\w=([^[]*)?)?#si"							,'regexp' => '<embed width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" wmode="transparent" allowfullscreen="true" allowNetworking="all" src="http://static.photobucket.com/player.swf?file=http://vid$1.photobucket.com/$2$4" />'),
			'www.porkolt'					=> array ('display' => true	,'image' => 'porkolt.gif'		,'example' => "http://www.porkolt.com/other/Funny-dogs-44410.html"																				,'found' => "#http://www.porkolt.(.*)/([A-Za-z-_\-\/]*+([0-9]+).(.*))?#si"								,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://content3.porkolt.com/miniplayer/player-porkolt.swf?parameters=http://datas3.porkolt.com/datas/$3"></param><param name="bgcolor" value="#000000" /><embed src="http://content3.porkolt.com/miniplayer/player-porkolt.swf?parameters=http://datas3.porkolt.com/datas/$3" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'revision3.com'					=> array ('display' => true	,'image' => 'revision3.gif'		,'example' => "http://revision3.com/scamschool/fortheladies2"																					,'found' => "#http://revision3.com/(.*?)/([^[]*)?#sie"													,'regexp' => "\$this->external_video('\$0', 'embed')"),
			'revver.com'					=> array ('display' => true	,'image' => 'revver.gif'		,'example' => "http://revver.com/video/1217076/shouting-news-palin-vs-pitbull/"																	,'found' => "#http://(.*?)revver.com/video/(.*?)/([^[]*)?#is"											,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}" data="http://flash.revver.com/player/1.0/player.swf?mediaId=$2" type="application/x-shockwave-flash" id="revvervideoa"><param name="Movie" value="http://flash.revver.com/player/1.0/player.swf?mediaId=$2"></param><param name="FlashVars" value="allowFullScreen=true"></param><param name="AllowFullScreen" value="true"></param><param name="AllowScriptAccess" value="always"></param><embed type="application/x-shockwave-flash" src="http://flash.revver.com/player/1.0/player.swf?mediaId=$2" pluginspage="http://www.macromedia.com/go/getflashplayer" allowScriptAccess="always" flashvars="allowFullScreen=true" allowfullscreen="true" width="{WIDTH}" height="{HEIGHT}" ></embed></object>'),
			'rutube.ru'						=> array ('display' => true	,'image' => 'rutube.gif'		,'example' => "http://rutube.ru/tracks/1415928.html?v=67eb8c2fcd74fddb722ce4cd820195da"															,'found' => "#http://rutube.ru/([^[]*)?#sie"															,'regexp' => "\$this->external_video('\$0', 'lj-embed')"),
			'sapo.pt'						=> array ('display' => true	,'image' => 'sapo.gif'			,'example' => "http://videos.sapo.pt/LguPabwSWikK0wzBmU1o"																						,'found' => "#http://(.*?)sapo.pt/(\?v\=)?([^[]*)?#is"													,'regexp' => '<embed src="http://rd3.videos.sapo.pt/play?file=http://rd3.videos.sapo.pt/$3/mov/1" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"></embed>'),
			'scribd.com'					=> array ('display' => true	,'image' => 'scribd.gif'		,'example' => "http://www.scribd.com/docinfo/2568988?access_key=key-8j0yfc1gkwpjwdwkhde"														,'found' => "#http://www.scribd.com/docinfo/(.*?)\?access_key=([^[]*)?#is"								,'regexp' => '<object codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" id="doc_899296978639571" name="doc_899296978639571$1" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" align="middle" width="{WIDTH}" height="{HEIGHT}" ><param name="movie" value="http://documents.scribd.com/ScribdViewer.swf?document_id=$1&access_key=$2&page=&version=1&auto_size=false&viewMode="><param name="quality" value="high"><param name="play" value="true"><param name="loop" value="true"><param name="scale" value="showall"><param name="wmode" value="opaque"><param name="devicefont" value="false"><param name="bgcolor" value="#ffffff"><param name="menu" value="true"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><param name="salign" value=""><embed src="http://documents.scribd.com/ScribdViewer.swf?document_id=$1&access_key=$2&page=&version=1&auto_size=false&viewMode=" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" play="true" loop="true" scale="showall" wmode="opaque" devicefont="false" bgcolor="#ffffff" name="doc_899296978639571$1_object" menu="true" allowfullscreen="true" allowscriptaccess="always" salign="" type="application/x-shockwave-flash" align="middle" width="{WIDTH}" height="{HEIGHT}" ></embed></object>'),
			'sevenload.com'					=> array ('display' => true	,'image' => 'sevenload.gif'		,'example' => "http://en.sevenload.com/videos/Cf6wyZr/Zoom"																						,'found' => "#http://(.*?).sevenload.com/(.*?)/([0-9A-Za-z]+)?([^[]*)?#is"								,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="FlashVars" value="apiHost=api.sevenload.com"/><param name="AllowScriptAccess" value="always"/><param name="movie" value="http://en.sevenload.com/pl/$3/425x350/swf" /><embed src="http://en.sevenload.com/pl/$3/425x350/swf" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}" allowfullscreen="true" AllowScriptAccess="always" FlashVars="apiHost=api.sevenload.com"></embed></object>'),
			'slideshare.net'				=> array ('display' => true	,'image' => 'slideshare.gif'	,'example' => "http://www.slideshare.net/chrisbrogan/social-media-for-publishers-presentation"													,'found' => "#http://www.slideshare.net/(.*?)/([^[]*)?#sie"												,'regexp' => "\$this->external_video('\$0', 'object')"),
			'spike.com'						=> array ('display' => true	,'image' => 'spike.gif'			,'example' => "http://www.spike.com/video/2946505"																								,'found' => "#http://www.spike.com/video/([0-9]+)[^[]*#si"												,'regexp' => '<embed width="{WIDTH}" height="{HEIGHT}" src="http://www.spike.com/efp" quality="high" bgcolor="000000" name="efp" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="flvbaseclip=$1&"></embed>'),
			'spike.com'						=> array ('display' => true	,'image' => 'spike.gif'			,'example' => "http://www.spike.com/video/2946505"																								,'found' => "#http://www.spike.com/video/([A-Za-z-_\-/]+)?([0-9]+)?([^[]*)?#is"							,'regexp' => '<embed width="{WIDTH}" height="{HEIGHT}" src="http://www.spike.com/efp" quality="high" bgcolor="000000" name="efp" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="flvbaseclip=$2&"></embed>'),
			'tangle.com'					=> array ('display' => true	,'image' => 'tangle.gif'		,'example' => "http://www.tangle.com/view_video?viewkey=25ec0b736884cda85a16"																	,'found' => "#http://www.tangle.com/view_video\?viewkey=([^[]*)?#si"									,'regexp' => '<embed src="http://www.tangle.com/flash/swf/flvplayer.swf" FlashVars="viewkey=$1" wmode="transparent" quality="high" width="{WIDTH}" height="{HEIGHT}" name="tangle" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>'),
			'starsclips.net'				=> array ('display' => true	,'image' => 'starsclips.gif'	,'example' => "http://www.starsclips.net/videos.aspx/video~incredible_aerobatic_fly_formation/Incredible_aerobatic_fly_formation"				,'found' => "#http://www.starsclips.net/videos.aspx/video~([0-9A-Za-z-_]+)(/[0-9A-Za-z-_]+)?(/[^[]*)?#si",'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.starsclips.net/emb.aspx/video~$1"></param><param name="wmode" value="transparent"></param><embed src="http://www.starsclips.net/emb.aspx/video~$1" type="application/x-shockwave-flash" wmode="transparent" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'streetfire.net'				=> array ('display' => true	,'image' => 'streetfire.gif'	,'example' => "http://videos.streetfire.net/video/Top-Gear-Lorry-truck-12_196610.htm"															,'found' => "#http://videos.streetfire.net/video/([^[]*)?#sie"											,'regexp' => "\$this->external_video('\$0', 'object')"),
			'tinypic.com'					=> array ('display' => true	,'image' => 'tinypic.gif'		,'example' => "http://tinypic.com/player.php?v=t8pyjo&s=4"																						,'found' => "#http://((.*?)?)tinypic.com/player.php\?v=([^[]*)#is"										,'regexp' => '<embed width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" src="http://v4.tinypic.com/player.swf?file=$3"></embed>'),
			'tu.tv'							=> array ('display' => true	,'image' => 'tutv.gif'			,'example' => "http://tu.tv/videos/el-gato-boxeador"																							,'found' => "#http://((.*?)?)tu.tv/videos/([^[]*)?#sie"													,'regexp' => "\$this->external_video('\$0', 'object')"),
			'vbox7.com'						=> array ('display' => true	,'image' => 'vbox7.gif'			,'example' => "http://www.vbox7.com/play:93ab2ba5"																								,'found' => "#http://www.vbox7.com/play:([^[]+)?#si"													,'regexp' => '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://i47.vbox7.com/player/ext.swf?vid=$1"><param name="quality" value="high"><embed src="http://i47.vbox7.com/player/ext.swf?vid=$1" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'veoh.com'						=> array ('display' => true ,'image' => 'veoh.gif'			,'example' => "http://www.veoh.com/browse/videos/category/entertainment/watch/v18183513AEp9gT8J"												,'found' => "#http://(.*?).veoh.com(/.*?)+/([0-9A-Za-z-_]+)#si" 										,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}" id="veohFlashPlayer_$3" name="veohFlashPlayer_$3"><param name="movie" value="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.23.1011&permalinkId=$3&player=videodetailsembedded&videoAutoPlay=0&id=anonymous"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.4.2.23.1011&permalinkId=$3&player=videodetailsembedded&videoAutoPlay=0&id=anonymous" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="{WIDTH}" height="{HEIGHT}" id="veohFlashPlayerEmbed_$3" name="veohFlashPlayerEmbed_$3"></embed></object>'),
			'videogamer.com'				=> array ('display' => true	,'image' => 'videogamer.gif'	,'example' => "http://www.videogamer.com/videos/dead_space_developer_diary_zero_gravity.html"													,'found' => "#http://www.videogamer.com/([^[]*)?#sie"													,'regexp' => "\$this->external_video('\$0', 'SWFObject')"),
			'videu.de'						=> array ('display' => true	,'image' => 'videu.gif'			,'example' => "http://www.videu.de/video/38"																									,'found' => "#http://www.videu.de/video/([^[]*)?#si"													,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.videu.de/flv/player2.swf?iid=$1"></param><param name="wmode" value="transparent"></param><embed src="http://www.videu.de/flv/player2.swf?iid=$1" type="application/x-shockwave-flash" wmode="transparent" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'vidiac.com'					=> array ('display' => true	,'image' => 'vidiac.gif'		,'example' => "http://www.vidiac.com/video/d9ec881e-8a1c-41a7-8e4a-919180b0f538.htm"															,'found' => "#http://www.vidiac.com/video/([^[]*).htm#si"												,'regexp' => '<embed src="http://www.vidiac.com/vidiac.swf" FlashVars="video=$1" quality="high" bgcolor="#ffffff" width="{WIDTH}" height="{HEIGHT}" name="ePlayer" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>'),
			'vidilife.com'					=> array ('display' => true	,'image' => 'vidilife.gif'		,'example' => "http://www.vidiLife.com/video_play_1136791_Really_Bad_Driver_Drives_Off_Parking_Garage.htm"										,'found' => "#http://www.vidiLife.com/([^[]*)?#sie"														,'regexp' => "\$this->external_video('\$0', 'embed')"),
			'vimeo.com'						=> array ('display' => true	,'image' => 'vimeo.gif'			,'example' => "http://vimeo.com/725441"																											,'found' => "#http://((.*?))vimeo.com/([^[]*)?#si"														,'regexp' => '<object type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}" data="http://www.vimeo.com/moogaloop.swf?clip_id=$3&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color="><param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id=$3&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=" /><param name="quality" value="best" /><param name="allowfullscreen" value="true" /><param name="scale" value="showAll" /></object>'),
			'video.google'					=> array ('display' => true	,'image' => 'googlevid.gif'		,'example' => "http://video.google.com/videoplay?docid=-8351924403384451128"																	,'found' => "#http://video.google.(.*?)/(videoplay|googleplayer.swf)\?docid=([0-9A-Za-z-_]+)#si"		,'regexp' => '<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=5,0,0,0" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://video.google.$1/googleplayer.swf?docid=$3" /><param name="play" value="false" /><param name="loop" value="false" /><param name="quality" value="high" /><param name="allowScriptAccess" value="never" /><param name="allowNetworking" value="internal" /><embed src="http://video.google.$1/googleplayer.swf?docid=$3" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="{WIDTH}" height="{HEIGHT}" play="false" loop="false" quality="high" allowscriptaccess="never" allownetworking="internal"></embed></object>'),
			'video.yahoo'					=> array ('display' => true	,'image' => 'yahoovid.gif'		,'example' => "http://video.yahoo.com/watch/2057334/6491459?v=2057334"																			,'found' => "#http://video.yahoo.com/watch/([0-9]+)/([0-9]+)[^[]*#si"									,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.0.44" /><param name="allowFullScreen" value="true" /><param name="flashVars" value="id=$2&vid=$2&lang=en-US&intl=us&thumbUrl=http://us.i1.yimg.com/us.yimg.com/i/us/sch/cn/video04/$1_rnd618da3dd_19.jpg" /><embed src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.0.44" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}" allowFullScreen="true" flashVars="id=$2&vid=$1&lang=en-US&intl=us&thumbUrl=http://us.i1.yimg.com/us.yimg.com/i/us/sch/cn/video04/$1_rnd618da3dd_19.jpg" ></embed></object>'),
			'vsocial.com'					=> array ('display' => true	,'image' => 'vsocial.gif'		,'example' => "http://www.vsocial.com/video/?d=2893"																							,'found' => "#http://www.vsocial.com/video/\?d=([^[]*)#is"												,'regexp' => '<embed allowScriptAccess="always" id="flash_player" name="flash_player" width="{WIDTH}" height="{HEIGHT}" src="http://static.vsocial.com/flash/upsl3.0.2/ups3.0.2.swf?d=$1&a=1&s=false&url=http://www.vsocial.com/xml/upsl/vsocial/template.php"></embed>'),
			'wat.tv'						=> array ('display' => true	,'image' => 'wattv.gif'			,'example' => "http://www.wat.tv/playlist/564333"																								,'found' => "#http://(.*?).wat.tv/playlist/([^[]*)?#is"													,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.wat.tv/images/v2.5/flash/loaderexport.swf?revision=2.5.108&mediaID=$2&baseUrl=www.wat.tv&referer=www.wat.tv&request=/playlist/$2" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><embed src="http://www.wat.tv/images/v2.5/flash/loaderexport.swf?revision=2.5.108&mediaID=$2&baseUrl=www.wat.tv&referer=www.wat.tv&request=/playlist/$2" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}" allowScriptAccess="always" allowFullScreen="true"></embed></object>'),
			'wegame.com'					=> array ('display' => true	,'image' => 'wegame.gif'		,'example' => "http://www.wegame.com/watch/jRi_Clan_Rolling_in_Action/"																			,'found' => "#http://www.wegame.com/watch/(.*?)/([^[]*)?#is"											,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}" ><param name="movie" value="http://www.wegame.com/static/flash/player2.swf?tag=$1"></param><param name="wmode" value="transparent"></param><embed src="http://www.wegame.com/static/flash/player2.swf?tag=$1" type="application/x-shockwave-flash" wmode="transparent" width="{WIDTH}" height="{HEIGHT}" ></embed></object>'),
			'youtube.com'					=> array ('display' => true	,'image' => 'youtube.gif'		,'example' => "http://www.youtube.com/watch?v=PDGxfsf-xwQ"																						,'found' => "#http://((.*?)?)youtube.com/(|watch\?)v(/|=)([0-9A-Za-z-_]+)?([^[]*)?#is"					,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://$2youtube.com/v/$5&hl=en&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999" /><param name="allowFullScreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="allowFullScreen" value="true" /><param name="wmode" value="transparent"/><embed src="http://$2youtube.com/v/$5&hl=en&fs=1&rel=0&color1=0x3a3a3a&color2=0x999999" type="application/x-shockwave-flash" wmode="transparent" width="{WIDTH}" height="{HEIGHT}" allowFullScreen="true"></embed></object>'),
			'xfire.com'						=> array ('display' => true	,'image' => 'xfire.gif'			,'example' => "http://www.xfire.com/video/24c86/"																								,'found' => "#http://www.xfire.com/video/(.*?)/#si"														,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}"><param name="movie" value=http://media.xfire.com/swf/vplayer><embed src="http://media.xfire.com/swf/vplayer.swf" quality="high" flashvars="videoid=$1" type="application/x-shockwave-flash" wmode="transparent" width="{WIDTH}" height="{HEIGHT}" allowfullscreen="true"></object>'),

			'scribd'						=> array ('display' => true	,'image' => 'scribd.gif'		,'example' => "[scribd id=2568988 key=key-8j0yfc1gkwpjwdwkhde]"																					,'found' => "#(|\[)scribd(.*)id=(.*?)(.*)key=([0-9A-Za-z-_]+)?([^[]*)?#si"								,'regexp' => '<object codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" id="doc_$4" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" align="middle" width="{WIDTH}" height="{HEIGHT}" ><param name="movie" value="http://documents.scribd.com/ScribdViewer.swf?document_id=$4&access_key=$5&page=1&version=1&viewMode="><param name="quality" value="high"><param name="play" value="true"><param name="loop" value="true"><param name="scale" value="showall"><param name="wmode" value="opaque"><param name="devicefont" value="false"><param name="bgcolor" value="#ffffff"><param name="menu" value="true"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><param name="salign" value=""><embed src="http://documents.scribd.com/ScribdViewer.swf?document_id=$4&access_key=$5&page=1&version=1&viewMode=" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" play="true" loop="true" scale="showall" wmode="opaque" devicefont="false" bgcolor="#ffffff" name="doc_$4_object" menu="true" allowfullscreen="true" allowscriptaccess="always" salign="" type="application/x-shockwave-flash" align="middle" width="{WIDTH}" height="{HEIGHT}"></embed></object>'),
			'swf'							=> array ('display' => true	,'image' => 'flash.gif'			,'example' => "http://www.adobe.com/support/flash/ts/documents/test_version/version.swf"														,'found' => "#([^[]+)?.swf#si"																			,'regexp' => '<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=5,0,0,0" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="$0" /><param name="play" value="true" /><param name="loop" value="true" /><param name="quality" value="high" /><param name="allowScriptAccess" value="never" /><param name="allowNetworking" value="internal" /><embed src="$0" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="{WIDTH}" height="{HEIGHT}" play="true" loop="true" quality="high" allowscriptaccess="never" allownetworking="internal"></embed></object>'),
		//	'flv'							=> array ('display' => true	,'image' => 'flashflv.gif'		,'example' => "http://www.channel-ai.com/video/eyn/demo1.flv"																					,'found' => "#([^[]+)?.flv#si"																			,'regexp' => '<object codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="{WIDTH}" height="{HEIGHT}" id="flvPlayer" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ><param name="movie" value="./images/player.swf" /><param name="allowFullScreen" value="true" /><param name="FlashVars" value="movie=$0&fgcolor=autoload=off&fgcolor=0xff0000&autoload=off&volume=70" /><embed width="{WIDTH}" height="{HEIGHT}" src="./images/player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" allowFullScreen="true" FlashVars="movie=$0&fgcolor=autoload=off&fgcolor=0xff0000&autoload=off&volume=70" type="application/x-shockwave-flash" ></embed></object>'),
			'flv'							=> array ('display' => true	,'image' => 'flashflv.gif'		,'example' => "http://www.channel-ai.com/video/eyn/demo1.flv"																					,'found' => "#([^[]+)?.flv#si"																			,'regexp' => '<object codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="{WIDTH}" height="{HEIGHT}" id="flvPlayer" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"><param name="movie" value="./images/player.swf" /><param name="allowFullScreen" value="true" /><param name="FlashVars" value="movie=$0&fgcolor=0xff0000&autoload=off&volume=70" /><embed width="{WIDTH}" height="{HEIGHT}" src="./images/player.swf" pluginspage="http://www.macromedia.com/go/getflashplayer" allowFullScreen="true" FlashVars="movie=$0&fgcolor=0xff0000&autoload=off&volume=70" type="application/x-shockwave-flash"></embed></object>'),		
			'(wmv|mpg)'						=> array ('display' => true	,'image' => 'video.gif'			,'example' => "http://www.sarahsnotecards.com/catalunyalive/fishstore.wmv"																		,'found' => "#([^[]+)?.(wmv|mpg)#si"																	,'regexp' => '<object width="{WIDTH}" height="{HEIGHT}" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" id="wmstream"><param name="url" value="$0" /><param name="showcontrols" value="1" /><param name="showdisplay" value="0" /><param name="showstatusbar" value="0" /><param name="autosize" value="1" /><param name="autostart" value="false" /><param name="visible" value="1" /><param name="animationstart" value="0" /><param name="loop" value="0" /><param name="src" value="$0" /><!--[if !IE]>--><object width="{WIDTH}" height="{HEIGHT}" type="video/x-ms-wmv" data="$0"><param name="src" value="$0" /><param name="controller" value="1" /><param name="showcontrols" value="1" /><param name="showdisplay" value="0" /><param name="showstatusbar" value="0" /><param name="autosize" value="false" /><param name="autostart" value="0" /><param name="visible" value="1" /><param name="animationstart" value="0" /><param name="loop" value="0" /></object><!--<![endif]--></object>'),
			'(mp3|qt)'						=> array ('display' => true	,'image' => 'quicktime.gif'		,'example' => "http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt | http://www.carnivalmidways.com/images/Music/thisisatest.mp3",'found' => "#([^[]+)?.(mp3|qt)#si"																		,'regexp' => '<object id="qtstream" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0" width="{WIDTH}" height="{HEIGHT}"><param name="src" value="$0" /><param name="controller" value="true" /><param name="autoplay" value="false" /><param name="type" value="video/quicktime" /><embed name="qtstream_' . $this->abbc3_unique_id . '" src="$0" pluginspage="http://www.apple.com/quicktime/download/" enablejavascript="true" controller="true" width="{WIDTH}" height="{HEIGHT}" type="video/quicktime" autoplay="false"></embed></object>'),
			'ram'							=> array ('display' => true	,'image' => 'ram.gif'			,'example' => "http://www.bbc.co.uk/scotland/radioscotland/media/radioscotland.ram"																,'found' => "#([^[]+)?.ram#si"																			,'regexp' => '<object id="rmstream" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" width="{WIDTH}" height="{HEIGHT}"><param name="src" value="$0" /><param name="autostart" value="false" /><param name="controls" value="ImageWindow" /><param name="console" value="ctrls_' . $this->abbc3_unique_id . '" /><param name="prefetch" value="false" /><embed name="rmstream_' . $this->abbc3_unique_id . '" type="audio/x-pn-realaudio-plugin" src="$0" width="{WIDTH}" height="{HEIGHT}" autostart="false" controls="ImageWindow" console="ctrls_' . $this->abbc3_unique_id . '" prefetch="false"></embed></object><br /><object id="ctrls" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" width="{WIDTH}" height="36"><param name="controls" value="ControlPanel" /><param name="console" value="ctrls_' . $this->abbc3_unique_id . '" /><embed name="ctrls_' . $this->abbc3_unique_id . '" type="audio/x-pn-realaudio-plugin" width="{WIDTH}" height="36" controls="ControlPanel" console="ctrls_' . $this->abbc3_unique_id . '"></embed></object>'),

// Not available, no more
//			'stage6.com'					=> array ('display' => false,'image' => 'stage6.gif'		,'example' => "http://www.stage6.com/user/TheNelAware/video/2217443/Indiana-Jones-4-Trailer.."													,'found' => "#http://www.stage6.com/user/TheNelAware/video/([0-9]+)/([0-9]+)?(/[^/]+)?#si"				,'regexp' => '<object codebase="http://go.divx.com/plugin/DivXBrowserPlugin.cab" height="{HEIGHT}" width="{WIDTH}" classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616"><param name="autoplay" value="false"/><param name="src" value="http://video.stage6.com/$1/.divx" /><param name="custommode" value="Stage6" /><param name="showpostplaybackad" value="false" /><embed type="video/divx" src="http://video.stage6.com/$1/.divx" pluginspage="http://go.divx.com/plugin/download/" showpostplaybackad="false" custommode="Stage6" autoplay="false" height="{HEIGHT}" width="{WIDTH}" /></object>'),
//			'gamevee.com'					=> array ('display' => false,'image' => 'gamevee.gif'		,'example' => "http://www.gamevee.com/viewVideo/_HALO3/XBox_360/what_is_going_on/1225806"														,'found' => "#http://www.gamevee.com/(.*?)/(.*?)/(.*?)/(.*?)/([^[]*)?#si"								,'regexp' => '<object type="application/x-shockwave-flash" data="http://www.gamevee.com/public/gameveeplayer.swf?video_id=$5&embed=on&vidview=on" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://www.gamevee.com/public/gameveeplayer.swf?video_id=$5&embed=on&vidview=on" /><param name="allowfullscreen" value="true"/><param name="bgcolor" value="#FFFFFF"/></object>'),
//			'godtube.com'					=> array ('display' => false,'image' => 'godtube.gif'		,'example' => "http://www.godtube.com/view_video.php?viewkey=25ec0b736884cda85a16"																,'found' => "#http://www.godtube.com/view_video.php\?viewkey=([^[]*)?#si"								,'regexp' => '<embed src="http://godtube.com/flvplayer.swf" FlashVars="viewkey=$1" wmode="transparent" quality="high" width="{WIDTH}" height="{HEIGHT}" name="godtube" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>'),
//			'gotgame.com'					=> array ('display' => false,'image' => 'gotgame.gif'		,'example' => "http://video.gotgame.com/index.php/video/view/4516"																				,'found' => "#http://video.gotgame.com/index.php/video/view/([^[]*)?#si"								,'regexp' => '<embed src="http://video.gotgame.com/public/flash/flash_gordon.swf?vid=$1" width="{WIDTH}" height="{HEIGHT}" allowscriptaccess="always" allowfullscreen="true"/>'),
//			'gotgame.com'					=> array ('display' => true ,'image' => 'gotgame.gif'		,'example' => "http://video.gotgame.com/index.php/video/view/4516"																				,'found' => "#http://video.gotgame.com/index.php/video/view/([^[]*)?#si"								,'regexp' => '<object classid="CLSID:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" type="application/x-shockwave-flash" width="{WIDTH}" height="{HEIGHT}"><param name="movie" value="http://video.gotgame.com/public/flash/flash_gordon.swf?vid=$1" /><param name="wmode" value="transparent" /><param name="quality" value="high" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="pluginspage" value="http://www.macromedia.com/go/getflashplayer" /><param name="autoplay" value="false" /><param name="autostart" value="false" /> <embed type="application/x-shockwave-flash" src="http://video.gotgame.com/public/flash/flash_gordon.swf?vid=$1" width="{WIDTH}" height="{HEIGHT}" wmode="transparent" quality="high" allowFullScreen="true" allowScriptAccess="always" pluginspage="http://www.macromedia.com/go/getflashplayer" autoplay="false" autostart="false" flashvars="" /> <!-- Generated by AutoEmbed (http://autoembed.com) --> </object>'),
//			'hdshare.tv'					=> array ('display' => false,'image' => 'hdshare.gif'		,'example' => "http://www.hdshare.tv/video/90/Air-Glaciers-entre-passe-et-present"																,'found' => "#http://www.hdshare.tv/video/(.*?)(/([^[]*)?)#si"											,'regexp' => '<embed src="http://www.hdshare.tv/jwembed/player.swf" width="{WIDTH}" height="{HEIGHT}" allowscriptaccess="always" allowfullscreen="true" flashvars="width={WIDTH}&height={HEIGHT}&file=http://www.hdshare.tv/videofiles/$1.flv" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" />'),
//			'filefront.com'					=> array ('display' => false,'image' => 'filefront.gif'		,'example' => "http://www.filefront.com/14284133/Batman-Arkham-Asylum-Gadgets-Trailer/"															,'found' => "#http://www.filefront.com/(.*?)/([^[]*)?#sie"												,'regexp' => "\$this->external_video('\$0', 'SWFObject')"),
// Not available yet
//			'bbc.co'						=> array ('display' => false,'image' => 'bcc.gif'			,'example' => "http://news.bbc.co.uk/1/hi/business/7847055.stm"																					,'found' => "#http://news.bbc.co.uk/(.*?)/hi/(.*?)/([^[]*)?#sie"										,'regexp' => "\$this->external_video('\$0', 'object')"),
//			'video.msn.com'					=> array ('display' => false,'image' => 'videomsn.gif'		,'example' => "http://video.msn.com/video.aspx?vid=28f35358-4d48-4045-bbe7-8f5551b8f512"														,'found' => "#http://video.msn.com/video.aspx\?((.*)vid=([0-9A-Za-z-_]+)(.*))?#si"						,'regexp' => '<embed src="http://images.video.msn.com/flash/soapbox1_1.swf" width="432" height="364" id="jnq100aq" type="application/x-shockwave-flash" allowFullScreen="true" allowScriptAccess="always" pluginspage="http://macromedia.com/go/getflashplayer" flashvars="c=v&v=$3"></embed>'),
// Not available yet, may be impossible
//			'tm-tube.com'					=> array ('display' => false,'image' => 'tm-tube.gif'		,'example' => "http://www.tm-tube.com/video/7247"																								,'found' => "#http://www.tm-tube.com/video/([^[/]*)?(\/[^[]*)?#si"										,'regexp' => '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="{WIDTH}" height="{HEIGHT}" id="player" align="middle"><param name="allowScriptAccess" value="always" /><param name="movie" value="http://www.tm-tube.com/flvplayer.swf?mediaid=4459&hosturl=http://www.tm-tube.com/&themecolor=0x000000&symbolcolor=0xffa500&backgroundcolor=0x000000&autostart=false&loop=false&overlay=http://www.tm-tube.com//media/custom/player_emb.png&&" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><param name="width" value="{WIDTH}" /><param name="height" value="{HEIGHT}" /><param name="scale" value="noscale" /><param name="allowFullScreen" value="true" /><embed src="http://www.tm-tube.com/flvplayer.swf?mediaid=4459&hosturl=http://www.tm-tube.com/&themecolor=0x000000&symbolcolor=0xffa500&backgroundcolor=0x000000&autostart=false&loop=false&overlay=http://www.tm-tube.com//media/custom/player_emb.png&&" quality="high" bgcolor="#000000" height="{HEIGHT}" width="{WIDTH}" name="player" align="middle" allowFullScreen="true" allowScriptAccess="always" scale="noscale" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>'),
		);
	}

	/**
	* Parsing the web videos - Second pass.
	*
	* @param string		$in		post text between [BBvideo] & [/BBvideo]
	* @param string		$w		value for video width
	* @param string		$h		value for video Height
	* @return embed video
	* @version 1.0.12
	**/
	function BBvideo_pass($in, $w, $h)
	{
		global $user, $config, $phpbb_root_path;

		$this->video_init();

		$video_unique_id	= substr(base_convert(unique_id(), 16, 36), 0, 8);
		$this->video_width  = (intval($w)) ? $w : ((isset($config['ABBC3_VIDEO_height'])) ? $config['ABBC3_VIDEO_width'] : 425) ;
		$this->video_height = (intval($h)) ? $h : ((isset($config['ABBC3_VIDEO_height'])) ? $config['ABBC3_VIDEO_height'] : 350) ;
		$in					= trim($in);
		$video_link			= '';
		$video_content		= '';
		$video_image		= '';
		$video_image_path	= $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode');

		foreach ($this->abbcode_video_ary as $video_name => $video_data)
		{
			// Fisrt check that video url is one of the list and if it's enabled to parse.
			if ((preg_match('#' . $video_name . '#si', $in)) && ($video_data['display']))
			{
				// Second check if video have data to search and parse
				if ($video_data['found'] != '' && $video_data['regexp'] != '')
				{
					if (preg_match($video_data['found'], $in))
					{
						if (preg_match('#\.#si', $video_name))
						{
							preg_match('@^(?:http://)?([^/]+)@i',$in, $video_name);
							if (file_exists($video_image_path . '/images/' . $video_data['image']))
							{
								$video_image = '<img src="' . $video_image_path . '/images/' . $video_data['image'] .'" class="postimage" alt="' . $video_name[1] . '" title="' . $video_name[1] . '" /> ';
							}
							$video_link = $user->lang['ABBC3_BBVIDEO_VIDEO'] .' : <a href="' . $in . '" onclick="window.open(this.href);return false;" >' . $video_name[1] . '</a>';
						}
						else
						{
							if (file_exists($video_image_path . '/images/' . $video_data['image']))
							{
								$video_image = '<img src="' . $video_image_path  . '/images/' . $video_data['image'] .'" class="postimage" alt="' . $video_name . '" title="' . $video_name . '" /> ';
							}
							$video_link = $user->lang['ABBC3_BBVIDEO_FILE'] . ' : ' . $video_name;
						}

						$video_content = preg_replace($video_data['found'], $video_data['regexp'], str_replace(' ', '', trim($in)));
						
						// Resize acording the video settings, and perform some code clearance
						$video_content = str_replace(array ('{WIDTH}', '{HEIGHT}', '&', '\"', '\/') , array ($this->video_width, $this->video_height, '&amp;', '"', '/') , $video_content);

						// Make all id as unique id, just in case
					//	$video_content = preg_replace('# id\=\"(.*?)\"#', ' id="$1_' . $video_unique_id .'"', $video_content);

						return str_replace(array('{BBVIDEO_WIDTH}', '{BBVIDEO_IMAGE}', '{BBVIDEO_LINK}', '{BBVIDEO_VIDEO}'), array($this->video_width+10, $video_image, $video_link, $video_content), $this->bbcode_tpl('bbvideo'));
					}
				}
			}
		}
		return '[BBvideo]' . $in . '[/BBvideo]' ;
	}

	/**
	* Parsing the web videos without a clear link.
	*
	* @param string		$in		post text between [BBvideo] & [/BBvideo]
	* @param string		object or embed
	* @return embed video
	**/
	function external_video($link, $search)
	{
		$file_contents = '';
		$this->abbc3_unique_id = substr(base_convert(unique_id(), 16, 36), 0, 8);

		// Safety Check if allow_url_fopen is enabled
		if (ini_get('allow_url_fopen') == 1)
		{
			 $file_contents = file_get_contents(str_replace(' ', '+', $link));
		}
		else
		{
			// Safety Check if CURL is present
			if (function_exists ('curl_init'))
			{
				$ch = curl_init();
				$timeout = 5; // set to zero for no timeout
				curl_setopt ($ch, CURLOPT_URL, $link);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				curl_close($ch);
			}
		}

		if ($file_contents)
		{
			// clear content
			$file_contents = htmlspecialchars_decode($file_contents);

			/**
			* Code from : http://blog.deconcept.com/swfobject/
			* Examples from : www.videogamer.com 
			**/
			if ($search == 'SWFObject')
			{
				$video_SWFObject = preg_match('#SWFObject\((.*?)\)#i', $file_contents, $SWFObject);

				if ($video_SWFObject)
				{
					$SWFObject			= str_replace(array("'", ' '), '', explode(",", $SWFObject[1]));
					$SWFObject_swf		= (isset($SWFObject[0])) ? $SWFObject[0] : '';
					/** fix "local" url
					if ($SWFObject_swf)
					{
						$video_parts = parse_url($SWFObject_swf);
						if (empty($video_parts['scheme']) && empty($video_parts['host']))
						{
							$link_parts = parse_url($link);
							$SWFObject_swf = $link_parts['scheme'] . '://' . $link_parts['host'] . $SWFObject_swf;
						}
					}
					**/					

					$SWFObject_id		=((isset($SWFObject[1])) ? $SWFObject[1] : '');
					$SWFObject_width	= (isset($SWFObject[2])) ? $SWFObject[2] : '{WIDTH}}';
					$SWFObject_height	= (isset($SWFObject[3])) ? $SWFObject[3] : '{HEIGHT}';
					$SWFObject_version	= (isset($SWFObject[4])) ? $SWFObject[4] : '6.0.65';
					$SWFObject_style	= (isset($SWFObject[5])) ? $SWFObject[5] : '#000000';

					$addVariable = '';
					$matches	 = preg_match_all('#addVariable\((.*?)\)#', $file_contents, $match);
					for ($i = 0; $i < $matches; $i++)
					{
						$addVariable_ary = str_replace(array("'", ' '), '', explode(",", $match[1][$i]));
						if (isset($addVariable_ary[0]) && isset($addVariable_ary[1]))
						{
							$addVariable .= $addVariable_ary[0] . "=" . $addVariable_ary[1] . '&';
						}
					}
					$SWFObject_var	= substr($addVariable, 0 , strlen($addVariable)-1);
					unset($file_contents, $video_SWFObject, $SWFObject, $matches, $match);
				//			<embed type="application/x-shockwave-flash" src="http://static.videogamer.com/videogamer/flash/source/player.swf?191008" width="656" height="368" style="undefined" id="vgtv" name="vgtv" bgcolor="#000000" quality="high" allowScriptAccess="always" allowFullScreen="true" loop="false" flashvars="xmlurl=http://feeds.videogamer.com/siteflash/&vid=2368&type=hi"/>
				//			<object id="vgtv" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="656" height="368" style="undefined"><param name="movie" value="http://static.videogamer.com/videogamer/flash/source/player.swf?191008" /><param name="bgcolor" value="#000000" /><param name="quality" value="high" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><param name="loop" value="false" /><param name="flashvars" value="xmlurl=http://feeds.videogamer.com/siteflash/&vid=2368&type=hi" /></object>
					$this->video_width  = $SWFObject_width;
					$this->video_height = $SWFObject_height;
					return '<object id="' . $SWFObject_id . '" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=' . $SWFObject_version . '" width="' . $SWFObject_width . '" height="' . $SWFObject_height . '" ><param name="movie" value="' . $SWFObject_swf . '" /><param name="bgcolor" value="' . $SWFObject_style . '" /><param name="quality" value="high" /><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="true" /><param name="loop" value="false" /><param name="flashvars" value="' . $SWFObject_var . '" /><embed type="application/x-shockwave-flash" src="' . $SWFObject_swf . '" width="' . $SWFObject_width . '" height="' . $SWFObject_height . '" id="' . $SWFObject_id . '" name="' . $SWFObject_id . '" bgcolor="' . $SWFObject_style . '" quality="high" allowScriptAccess="always" allowFullScreen="true" loop="false" flashvars="' . $SWFObject_var . '" /></object>';
				}
			}

			$padr = 6;
			$ini  = strpos($file_contents, "<$search");
			$last = strpos($file_contents, "$search>");

			if ($search == 'lj-embed')
			{
				$padr = 9 ;
				$ini  = strpos($file_contents, "<lj-embed>");
				$last = strpos($file_contents, "</lj-embed>");
			}

			// some server use <embed>...data...</embed> and other use <embed ...data... />
			if ($search == 'embed' && (!$last || $last < $ini))
			{
				$padr = 2;
				$last = strpos($file_contents, "/>", $ini);
			}

			if ($search == 'object')
			{
				$padr = 7 ;
			}
			
			if ($search == 'lj-embed')
			{
				$padr = 9 ;
			}

			if (!$ini && !$last)
			{
				return $link;
			}

			$video_data = substr($file_contents, $ini, (($last+$padr)-$ini));
		//	$video_data = str_replace("'", '"', substr($file_contents, $ini, (($last+$padr)-$ini)));

			/** fix "local" url
			if (preg_match('#\<param name\=\"movie\" value=\"(.*?)\"#i', $video_data, $video_movie))
			{
				$video_parts = parse_url($video_movie[1]);
				if (empty($video_parts['scheme']) && empty($video_parts['host']))
				{
					$link_parts = parse_url($link);
					$video_data = preg_replace('#(\<param name\=\"movie\" value\=|src\=)\"(.*?)\"#i', '$1"'. $link_parts['scheme'] . '://' . $link_parts['host'] . '/$2"', $video_data);
					$video_data = preg_replace('#(\<param name\=\"FlashVars\" value\=\"(videoURL|xmlURL)=|FlashVars\=\"(videoURL|xmlURL)\=)(.*?)\"#i', '$1' . $link_parts['scheme'] . '://' . $link_parts['host'] . '/$4"', $video_data);
				//	return preg_replace("/(\r\n)+|(\n|\r)+/", "", $video_data); //	return str_replace(array("\r\n", '\n', '\r', '<br />'), array('', '', ''), trim($video_data));
				}
			}
			**/

			// try to resize acording the video settings and delete all possible style
			$video_data = preg_replace(array ('#style="(.*?)"#', "#style='(.*?)'#", '#width="(.*?)"#', "#width='(.*?)'#", '#height="(.*?)"#', "#height='(.*?)'#") , array ('', '', 'width="{WIDTH}"', "width='{WIDTH}'", 'height="{HEIGHT}"', "height='{HEIGHT}'") , $video_data);

			unset($file_contents);
			return preg_replace("/(\r\n)+|(\n|\r)+/", "", trim($video_data)); // return str_replace(array("\r\n", '\n', '\r'), array('', '', ''), trim($video_data));
		}
		else
		{
			return $link;
		}
	}
}
// End of abbcode3 class

// MOD : eD2k links - START
// Code based off MOD Title: eD2k links processing with availability statistics by DonGato
	/**
	* eD2k Add-on optionally called from viewtopic
	*	display table with ed2k links features
	*
	* @param string		$text		post text
	* @param int		$post_id	post id
	* @return string
	* @version 1.0.11B
	**/
	function abbc3_ed2k_add_all_ed2k_link($text, $post_id)
	{
		$t_ed2k_raw = $t_ed2k_reallinks = array();

		// dig through the message for all ed2k links! split up by "ed2k:"
		$t_ed2k_raw = explode('href="ed2k:', $text);

		// The first item is garbage
		unset($t_ed2k_raw[0]);

		// no need to dig through it if there are not at least 2 links!
		if (count($t_ed2k_raw) > 1)
		{
			foreach ($t_ed2k_raw as $t_ed2k_raw_line)
			{
				$t_ed2k_parts = explode("|", $t_ed2k_raw_line);

				// This looks now like this (only important parts included
				/**
				[1] => string(4) "file"
				[2] => string(46) "filename.extension"
				[3] => string(9) "321456789"
				[4] => string(32) "112233445566778899AABBCCDDEEFF11"
				[5] => string(?) "source or AICH hash"
				**/

				// Check the obvious things
				if (strlen($t_ed2k_parts[1]) == 4 AND $t_ed2k_parts[1] == "file" AND strlen($t_ed2k_parts[2]) > 0 AND floatval($t_ed2k_parts[3]) > 0 AND strlen($t_ed2k_parts[4]) == 32)
				{
					// This is a true link, lets paste it together and put it in an array
					if (substr($t_ed2k_parts[5], 0, 2) == "h=" || substr($t_ed2k_parts[5], 0, 7) == "sources")
					{
						$t_ed2k_reallinks[] = "ed2k://|file|" . str_replace("'", "\'", $t_ed2k_parts[2]) . "|" . $t_ed2k_parts[3] . "|" . $t_ed2k_parts[4] . "|" . $t_ed2k_parts[5] . "|/";
					}
					else
					{
						$t_ed2k_reallinks[] = "ed2k://|file|" . str_replace("'", "\'", $t_ed2k_parts[2]) . "|" . $t_ed2k_parts[3] . "|" . $t_ed2k_parts[4] . "|/";
					}
				}
			}

			if (!empty($t_ed2k_reallinks) && sizeof($t_ed2k_reallinks) > 1)
			{
				global $user, $template;

				$user->add_lang('mods/abbcode');

				$template->assign_vars(array(
					'ALL_ED2K_LINK'	=> true,
				));

				$template->assign_block_vars('postrow.ed2k', array(
					'ED2K_ID'		=> $post_id,
					'ED2K_TEXT1'	=> $user->lang['ABBC3_ED2K_TAG'],
					'ED2K_TEXT2'	=> $user->lang['SELECT_ALL_CODE'],
					'ED2K_TEXT3'	=> $user->lang['ABBC3_ED2K_ADD'],
				));

				foreach($t_ed2k_reallinks as $t_ed2klink)
				{
					$t_ed2k_parts = explode("|", $t_ed2klink);

					$template->assign_block_vars('postrow.ed2k.row', array(
						'LINK_VALUE' 	=> $t_ed2klink,
						'LINK_TEXT'		=> $t_ed2k_parts[2],
					));
				}
			}
			unset($t_ed2k_reallinks);
		}
	}

	/**
	* eD2k Add-on optionally called from viewtopic
	* 	Replace magic urls and display ed2k links format
	*	Cuts down displayed size of link if over 50 chars, turns absolute links
	* 
	* @param string 	$link	post links with ed2k href
	* @return string	display ed2k links format
	* @version 1.0.11B
	**/
	function abbc3_ed2k_make_clickable($link)
	{
		global $user, $config, $phpbb_root_path;

		$ed2k_icon = $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode') . '/images/emule.gif';
		$ed2k_stat = $phpbb_root_path . ((isset($config['ABBC3_MOD'])) ? $config['ABBC3_PATH'] : 'styles/abbcode') . '/images/stats.gif';

		$matches = preg_match_all("#(^|(?<=[^\w\"']))(ed2k://\|(file|server|friend)\|([^\\/\|:<>\*\?\"]+?)\|(\d+?)\|([a-f0-9]{32})\|(.*?)/?)(?![\"'])(?=([,\.]*?[\s<\[])|[,\.]*?$)#i", $link, $match);

		if ($matches)
		{
			foreach ($match[0] as $i => $m)
			{
				$ed2k_link	= (isset($match[2][$i])) ? $match[2][$i] : '';	// @$match[2][$i];

				// Only for testing propose, commented out so I do not loose the code.
			//	$ed2k_type	= (isset($match[3][$i])) ? $match[3][$i] : '';	// @$match[3][$i];
				$ed2k_size	= (isset($match[5][$i])) ? $match[5][$i] : '';	// @$match[5][$i];
				$ed2k_hash	= (isset($match[6][$i])) ? $match[6][$i] : '';	// @$match[6][$i];

				$max_len	= 100;
				$ed2k_name	= (isset($match[4][$i])) ? $match[4][$i] : '';	// @$match[4][$i];

				$ed2k_name	= (strlen($ed2k_name) > $max_len) ? substr($ed2k_name, 0, $max_len - 19) . '...' . substr($ed2k_name, -16) : $ed2k_name;
				return ' <!-- m --><img src="' . $ed2k_icon . '" border="0" title="" style="vertical-align: text-bottom;" />&nbsp;<a href="' . $ed2k_link . '" class="postlink">' . $ed2k_name . '</a>&nbsp;[' . abbc3_ed2k_humanize_size($ed2k_size) . ']&nbsp;<a href="http://ed2k.shortypower.dyndns.org/?hash=' . $ed2k_hash . '" onclick="window.open(this.href);return false;"><img src="' . $ed2k_stat . '" border="0" title="" style="vertical-align: text-bottom;" /></a><!-- m -->';
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