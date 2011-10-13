<?php
/**
* @package: phpBB 3.0.9 :: Advanced BBCode Box 3 -> root
* @version: $Id: abbcode_page.php, v 3.0.9.3 2010/09/23 00:27:15 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @co-author: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
**/

/**
* @ignore
**/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$mode           = request_var('mode', 'help');
$abbcode_bbcode = request_var('abbc3', '');
$form_name	    = request_var('form_name', '');
$text_name	    = request_var('text_name', '');
$in_admin		= request_var('admin', '');

// Load the appropriate function
switch ($mode)
{
	case 'wizards':
		switch ($abbcode_bbcode)
		{
			case 'abbc3_upload':
				abbcode_upload_file($form_name, $text_name);
			break;

			default:
				abbcode_wizards($abbcode_bbcode, $form_name, $text_name, $in_admin);
			break;
		}

	case 'tigra':
		abbcode_tigra_color_picker();
	break;

	case 'click':
		abbcode_click_file();
	break;

	default:
	case 'help':
		abbcode_show_help();
	break;
}

/**
* ABBC3 help page...
* @version 3.0.7-PL1
**/
function abbcode_show_help()
{
	global $template, $db, $user, $phpbb_root_path, $phpEx, $abbcode;

	if (!class_exists('abbcode'))
	{
		include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
	}
	$abbcode->abbcode_init();

	$user->add_lang(array('viewtopic', 'posting', 'mods/abbcode'));

	$sql = "SELECT abbcode, bbcode_order, bbcode_id, bbcode_group, bbcode_tag, bbcode_helpline, bbcode_image, display_on_posting 
			FROM " . BBCODES_TABLE . "
			WHERE display_on_posting = 1 
			ORDER BY bbcode_order";
	$result = $db->sql_query($sql);

	$count = 0;
	while ($row = $db->sql_fetchrow($result))
	{		
		/** Some fixes **/
		$tag_name		= str_replace('=', '', trim($row['bbcode_tag']));
		$abbcode_name	= (($row['abbcode']) ? 'ABBC3_' : '') . strtoupper(str_replace('=', '', trim($row['bbcode_tag'])));
		$abbcode_name	= ($row['bbcode_helpline'] == 'ABBC3_ED2K_TIP') ? 'ABBC3_ED2K' : $abbcode_name;

		// is a break line or division ?
		if (substr($abbcode_name, 0, 11) == 'ABBC3_BREAK' || substr($abbcode_name, 0, 14) == 'ABBC3_DIVISION' || !isset($user->lang[$abbcode_name . '_VIEW']))
		{
			continue;
		}

		// Parse text 
		// Check phpbb permissions status
		// Check ABBC3 groups permission
		// try to make it as quicky as it can be 
		if ($text = force_parse($user->lang[$abbcode_name . '_VIEW']))
		{
			$count++;
			$template->assign_block_vars('bbc_row', array(
				'ABBC3_HELP_TAG'	=> '[' . str_replace('=', '', trim($row['bbcode_tag'])) . ']',
				'ABBC3_HELP_SRC'	=> (isset($row['bbcode_image']) && trim($row['bbcode_image']) != '') ? $row['bbcode_image'] : false,
				'ABBC3_HELP_DESC'	=> (isset($user->lang[$abbcode_name . '_MOVER']	)) ? $user->lang[$abbcode_name . '_MOVER'] : '',
				'ABBC3_HELP_WRITE'	=> (isset($user->lang[$abbcode_name . '_TIP']	)) ? str_replace('\"','"', $user->lang[$abbcode_name . '_TIP']) : '',
				'ABBC3_HELP_NOTE'	=> (isset($user->lang[$abbcode_name . '_NOTE']	)) ? $user->lang[$abbcode_name . '_NOTE'] : '' ,
				'ABBC3_HELP_EXAMPLE'=> (isset($user->lang[$abbcode_name . '_VIEW']	)) ? $user->lang[$abbcode_name . '_VIEW'] : '',
				'ABBC3_HELP_VIEW'	=> (isset($user->lang[$abbcode_name . '_VIEW']	)) ? $text : '',
			));
		}
	}
	$db->sql_freeresult($result);

	// Output page
	page_header($user->lang['ABBC3_HELP_TITLE']);

	$template->assign_vars(array(
		'S_BBCODE_ROW_COUNT'=> round(($count/2)) ,
		'S_VIEWTOPIC'		=> true,
	));

	$template->set_filenames(array(
		'body' => 'posting_abbcode_help.html')
	);

	page_footer();
}

/**
 * For display of custom parsed text on user-facing pages
 *
 * @param string	$text
 * @return mix		$text or false if the user can't use this bbcode
 */
function force_parse($text)
{
	$message = utf8_normalize_nfc($text);
	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
	$text = generate_text_for_display($message, $uid, $bitfield, $options);

	// Check for message parsing errors : if the returned text is equal than the original, it means this user can not use this bbcode
	return ($message == $text) ? false : $text;
}

/**
* Upload files - Simple way
* 
* @return bbcode tag with link
* 
* THIS FUNTION IS DEPRECATED SINCE VERSION 3.0.7 ! suggested by MOD Team 
* So warn the user about this if he is still using the old database
**/
function abbcode_upload_file($form_name, $text_name)
{
	global $user;

	$user->add_lang('mods/abbcode');
	$error = sprintf($user->lang['ABBC3_DEPRECATED'], 'upload', '3.0.7');
	trigger_error($error);
}

/**
* ABBC3 simple redirect page
* @version 1.0.11
**/
function abbcode_click_file()
{
	global $db, $user;

	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

	// Initial var setup
	$id	= request_var('id', 0);

	if(!$id)
	{
		$user->add_lang('mods/abbcode');
		echo $user->lang['ABBC3_CLICK_ERROR'];
		exit;
	}

	$data_select = array(
		'id' 	=> $id,
	);

	$sql = 'SELECT url, clicks 
			FROM ' . CLICKS_TABLE . ' 
			WHERE ' . $db->sql_build_array('SELECT', $data_select);
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$data_update = array(
		'clicks' 	=> $row['clicks'] + 1,
	);

	$sql = 'UPDATE ' . CLICKS_TABLE . ' 
			SET ' . $db->sql_build_array('UPDATE', $data_update) . '
			WHERE id = ' . $id;
	$db->sql_query($sql);

	$row['url'] = ($row['url']) ? stripslashes($row['url']) : 'http://www.google.com/';

	// if there is no scheme, then add http schema
	if (!preg_match('#^[a-z][a-z\d+\-.]*:/{2}#i', $row['url']))
	{
		$row['url'] = 'http://' . $row['url'];
	}

	header("Status: 301 Moved Permanently", false, 301);
	header("Location: " . trim($row['url']));
	exit;
}

/**
* Display the Tigra Colour picker popup window
* @version 3.0.8
**/
function abbcode_tigra_color_picker()
{
	global $template, $user, $abbcode, $phpbb_root_path, $phpEx;

	if (!class_exists('abbcode'))
	{
		include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
	}
	$abbcode->abbcode_init();

	$user->add_lang(array('posting', 'mods/abbcode'));

	$tigra_mode = request_var('field', '');

	if (!$tigra_mode && ($abbcode->abbcode_config['ABBC3_COLOR_MODE'] != 'tigra' || $abbcode->abbcode_config['ABBC3_HIGHLIGHT_MODE'] != 'tigra'))
	{
		trigger_error('ABBC3_FUNCTION_DISABLED');
	}

	// Output page ...
	page_header('Tigra Color Picker');

	$template->set_custom_template($abbcode->abbcode_config['S_ABBC3_PATH'], 'abbcode_picker');

	$template->set_filenames(array(
		'body' => 'posting_abbcode_picker.html')
	);

	page_footer();
}

/**
* Some bbcodes have help wizards :)
* 
* @return bbcode tag with link
* @version 3.0.8
**/
function abbcode_wizards($abbcode_bbcode, $form_name, $text_name, $in_admin)
{
	global $template, $user, $config, $abbcode, $phpbb_admin_path, $phpbb_root_path, $phpEx;

	if (!class_exists('abbcode'))
	{
		include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
	}

	// $phpbb_admin_path need to be defined previously initialize abbcode
	if ($in_admin)
	{
		$phpbb_admin_path = "{$phpbb_root_path}adm/";
		$template->set_custom_template($phpbb_admin_path . 'style', 'admin');
	}

	$abbcode->abbcode_init();

	$user->add_lang(array('posting', 'mods/abbcode'));

	// We only allow to the grdient bbcodes use pop-up wizard ;)
	if ($abbcode_bbcode == 'abbc3_grad' && $abbcode->abbcode_config['ABBC3_WIZARD_MODE'] == 0)
	{
		$abbcode->abbcode_config['ABBC3_WIZARD_MODE'] = 1;
	}
	if (!$abbcode->abbcode_config['ABBC3_WIZARD_MODE'])
	{
		trigger_error('ABBC3_FUNCTION_DISABLED');
	}

	$abbcode_name = strtoupper($abbcode_bbcode);

	if ($abbcode_bbcode == 'abbc3_bbvideo')
	{
		static $abbcode_video_ary = array();
		if (empty($abbcode_video_ary))
		{
			$abbcode_video_ary = abbcode::video_init();
			// The video_serialize function is at root/includes/abbcode.php after the abbcode class
			$allowed_videos = video_serialize($config['ABBC3_VIDEO_OPTIONS'], false);

			foreach ($abbcode_video_ary as $video_name => $video_data)
			{
				if (!isset($video_data['id']))
				{
					$abbcode_video_ary[$video_name]['display'] = false;
					continue;
				}

				$abbcode_video_ary[$video_name]['display'] = (in_array($video_data['id'], $allowed_videos)) ? true : false;

				// Now clear video optgroup
				if (($video_data['id'] >= 1 && $video_data['id'] <= 100) && $abbcode_video_ary[$video_name]['display'])
				{
					$abbcode_video_ary['video']['display'] = true;
				}
				else if (($video_data['id'] >= 101 && $video_data['id'] <= 200) && $abbcode_video_ary[$video_name]['display'])
				{
					$abbcode_video_ary['external']['display'] = true;
				}
				else if (($video_data['id'] >= 201 && $video_data['id'] <= 300) && $abbcode_video_ary[$video_name]['display'])
				{
					$abbcode_video_ary['file']['display'] = true;
				}
			}
		}

		if (sizeof($abbcode_video_ary))
		{
			$video_options = '<option value="-1" class="disabled-options">-- ' . $user->lang['ABBC3_BBVIDEO_SELECT'] . ' --</option>' . "\n";
			$video_optgroup = false;
			$video_selected = false;
			foreach ($abbcode_video_ary as $video_name => $video_data)
			{
				// First check that this video is enabled
				if (!$video_data['display'])
				{
					continue;
				}
				$video_name = stripslashes($video_name);

				if ($video_name == 'video' || $video_name == 'external' || $video_name == 'file')
				{
					$video_options .= ($video_optgroup) ? '</optgroup>' . "\n" : '';
					$video_options .= '<optgroup label="-- ' . $user->lang['ABBC3_BBVIDEO_' . strtoupper($video_name)] . ' --">' . "\n";
					$video_optgroup = true;
				}
				// Now check that this video is has data for search and replace
				else if ((isset($video_data['match']) && $video_data['match'] != '') && (isset($video_data['replace']) && $video_data['replace'] != ''))
				{
					$example = (isset($video_data['example']) ? str_replace('&', '&amp;', $video_data['example']) : $user->lang['ABBC3_NO_EXAMPLE']);
					if ($video_name == 'youtube.com')
					{
						$selected = ' selected="selected"';
						$video_selected = true;
					}
					else
					{
						$selected = '';
					}
					$video_options .= '<option value="' . $example . '"' . $selected . '>' . $video_name . '</option>' . "\n";
				}
				else
				{
					continue;
				}
			}
			$video_options .= ($video_optgroup) ? '</optgroup>' . "\n" : '';

			if (!$video_optgroup)
			{
				$template->assign_var('L_BBVIDEO_ERROR', sprintf($user->lang['ABBC3_BBVIDEO_SELECT_ERROR'], '<a href="mailto:' . $config['board_contact'] . '">', '</a>'));
			}
			$user->lang['ABBC3_BBVIDEO_EXAMPLE'] = ($video_selected) ? $user->lang['ABBC3_BBVIDEO_EXAMPLE'] : '&nbsp;';
		}
	}

	if (strpos($abbcode_bbcode, '_'))
	{
		list($garbage, $tag) = explode('_', ($abbcode_bbcode == 'abbc3_ed2k') ? 'abbc3_url' : $abbcode_bbcode);
	}
	else
	{
		$tag = $abbcode_bbcode;
	}

	$need_description		= array('url', 'email', 'click');
	$need_width_height		= array('web', 'flash', 'flv', 'video', 'quicktime', 'ram', 'bbvideo');

	// General setings
	$template->assign_vars(array(
		'S_ABBC3_IN_WIZARD'			=> true,
		// path from the very forum root
//		'S_ABBC3_POSTING_JAVASCRIPT'=> $abbcode->abbcode_config['S_ABBC3_POSTING_JAVASCRIPT'],
//		'S_ABBC3_WIZARD_JAVASCRIPT'	=> $abbcode->abbcode_config['S_ABBC3_WIZARD_JAVASCRIPT'],
		// 0=Disable wizards | 1=Pop Up window | 2=In post (Ajax)
		'S_ABBC3_WIZARD_MODE'		=> $abbcode->abbcode_config['ABBC3_WIZARD_MODE'],

		'FORM_NAME'			=> $form_name,
		'TEXT_NAME'			=> $text_name,
		'ABBC3_OPEN'		=> $tag,
		'ABBC3_CLOSE'		=> "/$tag",
		'ABBC3_TAG'			=> (isset($user->lang[$abbcode_name . '_TAG']   )) ? $user->lang[$abbcode_name . '_TAG'] : '',
		'ABBC3_MOVER'		=> (isset($user->lang[$abbcode_name . '_MOVER'] )) ? $user->lang[$abbcode_name . '_MOVER'] : '',
		'ABBC3_NOTE'		=> (isset($user->lang[$abbcode_name . '_NOTE']  )) ? $user->lang[$abbcode_name . '_NOTE'] : '',
		'ABBC3_EXAMPLE'		=> (isset($user->lang[$abbcode_name . '_EXAMPLE'])) ? $user->lang[$abbcode_name . '_EXAMPLE'] : '',
		'ABBC3_DESC'		=> (in_array($tag, $need_description )) ? true : false,
		'ABBC3_W_H'			=> (in_array($tag, $need_width_height)) ? true : false,
		'ABBC3_WIDTH'		=> ($abbcode_bbcode == 'abbc3_web') ? '100%' : $abbcode->abbcode_config['ABBC3_VIDEO_WIDTH'],
		'ABBC3_HEIGHT'		=> ($abbcode_bbcode == 'abbc3_web') ? '100'  : $abbcode->abbcode_config['ABBC3_VIDEO_HEIGHT'],
		'S_WIZARD_GENERAL'	=> ($abbcode_bbcode == 'abbc3_table') ? false : ($abbcode_bbcode == 'abbc3_grad') ? false : true,
		'S_WIZARD_TABLE'	=> ($abbcode_bbcode == 'abbc3_table') ? true  : false,
		'S_WIZARD_GRAD'		=> ($abbcode_bbcode == 'abbc3_grad') ? true  : false,
		'S_BBVIDEO_OPTIONS'	=> ($abbcode_bbcode == 'abbc3_bbvideo') ? $video_options : '',
		'S_ABBC3_ALIGN'		=> ($abbcode_bbcode == 'abbc3_img' || $abbcode_bbcode == 'abbc3_thumbnail') ? radio_select('image_align', $user->lang['ABBC3_ALIGN_SELECTOR'], 'none', 'image_align') : '',
	));

	// $phpbb_admin_path need to be defined previously initialize abbcode
	if ($in_admin)
	{
		$phpbb_admin_path = "{$phpbb_root_path}adm/";
		$template->set_custom_template($phpbb_admin_path . 'style', 'admin');
	}

	// Output page ...
	page_header($user->lang[$abbcode_name . '_MOVER']);

	if ($in_admin)
	{
		$template->assign_var('T_TEMPLATE_PATH', $phpbb_admin_path . 'style');
	}

	$template->set_filenames(array(
		'body' => 'posting_abbcode_wizards.html')
	);

	page_footer();
}

/**
* Build radio fields
* @version 3.0.7-PL1
*/
function radio_select($name, $input_ary, $input_default = false, $id = false, $key = false)
{
	global $user;

	$html = '';
	$id_assigned = false;
	foreach ($input_ary as $value => $title)
	{
		$selected = ($input_default !== false && $value == $input_default) ? ' checked="checked"' : '';
		$html .= ' <label><input type="radio" name="' . $name . '"' . (($id && !$id_assigned) ? ' id="' . $id . '"' : '') . ' value="' . $value . '"' . $selected . (($key) ? ' accesskey="' . $key . '"' : '') . ' class="radio" />&nbsp;' . $title . '&nbsp;</label>';
		$id_assigned = true;
	}

	return $html;
}

?>