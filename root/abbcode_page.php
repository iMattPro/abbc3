<?php
/**
* @package: phpBB 3.0.6 :: Advanced BBCode box 3 -> root
* @version: $Id: abbcode_functions.php, v 3.0.6 2010/01/10 10:01:10 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
*
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

$mode           = request_var('mode', '');
$abbcode_bbcode = request_var('abbc3', '');
$form_name	    = request_var('form_name', '');
$text_name	    = request_var('text_name', '');

// Load the appropriate file
switch ($mode)
{
	case 'wizards':
		switch ($abbcode_bbcode)
		{
			case 'abbc3_upload':
				abbcode_upload_file($form_name, $text_name);
				break;
			default:
				abbcode_wizards($abbcode_bbcode, $form_name, $text_name);
				break;
		}

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
* @version 1.0.12
**/
function abbcode_show_help()
{
	global $template, $db, $user, $phpbb_root_path, $phpEx;

	if (!class_exists('abbcode'))
	{
		include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
	}

	$abbcode = new abbcode();

	$abbcode->abbcode_init();

	$user->add_lang(array('viewtopic', 'mods/abbcode', 'posting'));

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

		$abbode_auth	= true;
		// Check phpbb permissions status
		if (in_array($abbcode_name, $abbcode->need_permissions))
		{
		//	$abbode_auth = $abbcode->abbode_auth($abbcode_name, $mode);
			if (!$abbode_auth = $abbcode->abbode_auth($abbcode_name, 'helpage'))
			{
				continue;
			}

		}

		// Check ABBC3 groups permission
		if ($row['bbcode_group'])
		{
		//	$abbode_auth = $abbcode->abbode_phpbb_auth($row['bbcode_group']);
			if (!$abbode_auth = $abbcode->abbode_phpbb_auth($row['bbcode_group']))
			{
				continue;
			}
		}

		if (substr($abbcode_name,0,11) != 'ABBC3_BREAK' && substr($abbcode_name,0,14) != 'ABBC3_DIVISION') // is a breck line or division ?
		{
			$count++;
			$template->assign_block_vars('bbc_row', array(
				'ABBC3_HELP_TAG'	=> '[' . str_replace('=', '', trim($row['bbcode_tag'])) . ']',
				'ABBC3_HELP_DESC'	=> (isset($user->lang[$abbcode_name . '_MOVER']	)) ? $user->lang[$abbcode_name . '_MOVER'] : '',
				'ABBC3_HELP_WRITE'	=> (isset($user->lang[$abbcode_name . '_TIP']	)) ? str_replace('\"','"', $user->lang[$abbcode_name . '_TIP']) : '',
				'ABBC3_HELP_NOTE'	=> (isset($user->lang[$abbcode_name . '_NOTE']	)) ? $user->lang[$abbcode_name . '_NOTE'] : '' ,
				'ABBC3_HELP_EXAMPLE'=> (isset($user->lang[$abbcode_name . '_VIEW']	)) ? $user->lang[$abbcode_name . '_VIEW'] : '',
				'ABBC3_HELP_VIEW'	=> (isset($user->lang[$abbcode_name . '_VIEW']	)) ? force_parse($user->lang[$abbcode_name . '_VIEW'], $tag_name) : '',
			));
		}
	}
	$db->sql_freeresult($result);

	// Output page
	page_header($user->lang['ABBC3_HELP_TITLE']);

	$template->assign_vars(array(
		'S_BBCODE_ROW_COUNT'	 => round(($count/2) + 1) ,
		'S_BBCODE_ALLOWED'		 => true,
	));

	$template->set_filenames(array(
		'body' => 'posting_abbcode_help.html')
	);

	page_footer();
}

function force_parse($text, $bbcode_name)
{
	$message = utf8_normalize_nfc($text);
	$uid = $bitfield = $options = '';
	$allow_bbcode = $allow_urls = $allow_smilies = true;
	generate_text_for_storage($message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);
	$text = generate_text_for_display($message, $uid, $bitfield, $options);

	// This should not happens, but just in case
	// Means the user is not allowed to use this bbcode ;)
	if ($message == $text && $bbcode_name != 'nfo')
	{
		global $user;
		return '<p class="error">' . sprintf($user->lang['UNAUTHORISED_BBCODE'] , '[' . $bbcode_name . ']') . '</p>';
	}
	return $text;
}

/**
* Upload files - Simple way
* 
* @return bbcode tag with link
* @version 3.0.6
**/
function abbcode_upload_file($form_name, $text_name)
{
	global $cache, $template, $user, $config, $phpbb_root_path, $phpEx;

	if (!class_exists('abbcode'))
	{
		include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
	}
	$abbcode = new abbcode();
	$abbcode->abbcode_init();

	$user->add_lang(array('posting', 'mods/abbcode', 'acp/attachments'));

	// Check permission - Start
	static $rowset;
	if (!is_array($rowset))
	{
		global $db;
		$rowset = array();

		$sql = 'SELECT *
			FROM ' . BBCODES_TABLE . ' 
			WHERE bbcode_tag = "upload" ';
		$result = $db->sql_query($sql);
		$rowset = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
	}

	if (sizeof($rowset))
	{
		if (isset($rowset['bbcode_group']) && $rowset['bbcode_group'] && !$abbcode->abbode_phpbb_auth($rowset['bbcode_group']))
		{
			trigger_error('ABBC3_UPLOAD_DISALLOWED');
		}
	}
	// Check permission - End

	$upload_dir = $config['upload_path'] . '/';
	$max_size   = (int) $config['ABBC3_UPLOAD_MAX_SIZE'];
	$size_format = ($max_size >= 1048576) ? 'mb' : (($max_size >= 1024) ? 'kb' : 'b');

	// Available extensions - Start
	$available_types	= preg_split("/[\s,]+/", $config['ABBC3_UPLOAD_EXTENSION']);

	$extensions			= $cache->obtain_attach_extensions(true);
	// Posting page
	$is_message			= false;
	$extensions			= ($is_message) ? array_keys($extensions['_allowed_post']) : array_keys($extensions['_allowed_pm']);

	$types_ary			= array_merge($available_types, $extensions);
	$types_ary			= array_unique($types_ary);
	asort($types_ary);
	// Available extensions - End

	$error = array();

	$add_file   = (isset($_POST['add_file'])) ? true : false;

	//	Check if a file was specified
	if ($add_file)
	{
		if (!class_exists('fileupload'))
		{
			require($phpbb_root_path . 'includes/functions_upload.' . $phpEx);
		}

		$fieldata = 'promptbox1';
		$upload = new fileupload();
		$upload->set_allowed_extensions($types_ary);
		$file	= $upload->form_upload($fieldata);

		$filedata['name']		= basename($file->realname);
		$filedata['tmp_name']	= $file->filename;
		$filedata['extension']	= strtolower($file->get_extension($file->realname));
		$filedata['size']		= $file->filesize;
		$filedata['mimetype']	= $file->mimetype;
		$filedata['image']		= $file->is_image();
		$file_uploaded			= false;

		// Check the first 256 bytes for forbidden content
		if ($config['check_attachment_content'])
		{
			$upload->set_disallowed_content(explode('|', $config['mime_triggers']));

			if (!$file->check_content($upload->disallowed_content))
			{
				$error[] = $user->lang['AVATAR_DISALLOWED_CONTENT'];
			}
		}

		if (trim($filedata['name'] == ''))
		{
			$error[] = $user->lang['ABBC3_UPLOAD_EMPTY'];
		}
		else
		{
			$file->clean_filename('real', $user->data['user_id'] . '_');
			if (file_exists($phpbb_root_path . $upload_dir . $file->filename))
			{
				$error[] = sprintf($user->lang['ABBC3_UPLOAD_ALREADY'], $file->filename);
			}
		}

		// First fallback if incorrect error
		if (isset($filedata['error']) && $filedata['error'] == UPLOAD_ERR_INI_SIZE)
		{	// Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.
			$error[] = $user->lang['ABBC3_UPLOAD_NOSIZE'];
		}
		else if (isset($filedata['error']) && $filedata['error'] == UPLOAD_ERR_FORM_SIZE)
		{	// Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.
			$error[] = sprintf($user->lang['ABBC3_UPLOAD_NOSIZE'], $file->get('filesize'), $max_filesize);
		}
		else if (isset($filedata['error']) && $filedata['error'] == UPLOAD_ERR_PARTIAL)
		{	// Value: 3; The uploaded file was only partially uploaded.
			$error[] = $user->lang['ABBC3_UPLOAD_ERR_PARTIAL'];
		}
		else if (isset($filedata['error']) && $filedata['error'] == UPLOAD_ERR_NO_FILE)
		{	// Value: 4; No file was uploaded.
			$error[] = $user->lang['ABBC3_UPLOAD_EMPTY'];
		}
		else if (isset($filedata['error']) && $filedata['error'] == UPLOAD_ERR_NO_TMP_DIR)
		{	// Value: 6; Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.
			$error[] = $user->lang['ABBC3_UPLOAD_ERR_NO_TMPDIR'];
		}
		else if (isset($filedata['error']) && $filedata['error'] == UPLOAD_ERR_CANT_WRITE)
		{	// Value: 7; Failed to write file to disk. Introduced in PHP 5.1.0.
			$error[] = $user->lang['ABBC3_UPLOAD_ERR_CANTWRITE'];
		}
		else if (isset($filedata['error']) && $filedata['error'] == UPLOAD_ERR_EXTENSION)
		{	// Value: 8; File upload stopped by extension. Introduced in PHP 5.2.0.
			$error[] = $user->lang['ABBC3_UPLOAD_ERR_EXTENSION'];
		}
		else if (isset($filedata['error']) && $filedata['error'] != 0)
		{
			$error[] = sprintf($user->lang['ABBC3_UPLOAD_UPLOAD_ERROR'], $filedata['error']);
		}
		else if (isset($filedata['error']) && $filedata['error'] = 0)
		{
			// Check if empty file got uploaded (not catched by is_uploaded_file)
			if (isset($filedata['size']) && $filedata['size'] == 0)
			{
				$error[] = $user->lang['ABBC3_UPLOAD_NO_FILE_SIZE'];
			}
			else if ($file->get('filesize') > $max_filesize)
			{
				$error[] = sprintf($user->lang['ABBC3_UPLOAD_NOSIZE'], $file->get('filesize'), $max_filesize);
			}
			else if (in_array($filedata['extension'], $types_ary) == false)
			{
				$error[] = $user->lang['ABBC3_UPLOAD_DISABLED'];
			}

			// Check our complete quota
			if ($max_size)
			{
				if ($config['upload_dir_size'] + $file->get('filesize') > $max_size)
				{
					$error[] = $user->lang['ATTACH_QUOTA_REACHED'];
				}
			}

			// Check free disk space
			if ($free_space = @disk_free_space($phpbb_root_path . $upload_dir))
			{
				if ($free_space <= $file->get('filesize'))
				{
					$file->error[] = $user->lang['ATTACH_QUOTA_REACHED'];
				}
			}
		}

		if (sizeof($file->error))
		{
			$error = array_merge($error, $file->error);
		}
		else
		{
			$file->move_file($phpbb_root_path . $upload_dir, false, false, false);

			// Not correctly uploaded
			if (!$file->is_uploaded())
			{
				$error[] = $user->lang['ABBC3_UPLOAD_NOT_UPLOADED'];
			}

			if (sizeof($file->error))
			{
				$error = array_merge($error, $file->error);
			}
			else
			{
				$error[] = sprintf($user->lang['ABBC3_UPLOAD_UPLOADED'], $file->realname);
				$file_uploaded = true;

				$open_tag  = ($filedata['extension'] == 'swf') ? '[flash]'  : '' ;
				$close_tag = ($filedata['extension'] == 'swf') ? '[/flash]' : '';
				$open_tag  = ($filedata['image']) ? '[img]'  : $open_tag ;
				$close_tag = ($filedata['image']) ? '[/img]' : $close_tag;

				$template->assign_vars(array(
					'ADDED_FILE'		=> $file_uploaded,
					'OPEN_TAG'			=> $open_tag,
					'CLOSE_TAG'			=> $close_tag,
					'ADDED_FILE_NAME'	=> ($file_uploaded) ? append_sid(generate_board_url() . '/' . $upload_dir . $file->realname) : '',
				));
			}
		}
	}

	$template->assign_vars(array(
		'S_UPLOAD'					=> true,
		'FORM_NAME'					=> $form_name,
		'TEXT_NAME'					=> $text_name,

		'ERROR'						=> implode('<br />', $error),

		'ABBC3_UPLOAD_FILESIZE'		=> ($max_size) ? $max_size : $user->lang['ATTACH_MAX_FILESIZE_EXPLAIN'],
		'ABBC3_UPLOAD_SIZEFORMAT'	=> ($max_size) ? $size_format : '',
		'ABBC3_UPLOAD_EXTENSION'	=> implode(", ", $types_ary),
	));

	// Output page ...
	page_header($user->lang['ABBC3_UPLOAD_TITLE']);

	$template->set_filenames(array(
		'body' => 'posting_abbcode_wizards.html')
	);

	unset($filedata);

	page_footer();
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
* Some bbcodes have help wizards :)
* 
* @return bbcode tag with link
* @version 1.0.12
**/
function abbcode_wizards($abbcode_bbcode, $form_name, $text_name)
{
	global $template, $phpbb_root_path, $phpEx, $user;

	if (!class_exists('abbcode'))
	{
		include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
	}
	$abbcode = new abbcode();
	$abbcode->abbcode_init();

	$user->add_lang(array('posting', 'mods/abbcode'));

	$abbcode_name = strtoupper($abbcode_bbcode);

	if ($abbcode_bbcode == 'abbc3_bbvideo')
	{
		$abbcode->video_init();
		if (sizeof($abbcode->abbcode_video_ary))
		{
			$video_options = '';
			foreach ($abbcode->abbcode_video_ary as $video_name => $video_data)
			{
				if ($video_data['display'])
				{
					$video_name = stripslashes($video_name);

					$example = (isset($video_data['example']) ? $video_data['example'] : $user->lang['ABBC3_NO_EXAMPLE']);
					$selected = ($video_name == 'youtube.com') ? ' selected="selected"' : '';
					$video_options .= '<option value="' . $example . '"' . $selected . '>' . $video_name . '</option>';
				}
			}
		}
	}

	if (strpos($abbcode_bbcode, '_'))
	{
		list($garbage, $tag)	= explode('_', ($abbcode_bbcode == 'abbc3_ed2k') ? 'abbc3_url' : $abbcode_bbcode);
	}
	else
	{
		$tag = $abbcode_bbcode;
	}

	$need_description		= array('url', 'email', 'click');
	$need_width_height		= array('web', 'flash', 'flv', 'video', 'quicktime', 'ram', 'bbvideo');
	$abbc3_width			= ($abbcode_bbcode == 'abbc3_web') ? '100%' : $abbcode->abbcode_config['ABBC3_VIDEO_WIDTH'];
	$abbc3_height			= ($abbcode_bbcode == 'abbc3_web') ? '100'  : $abbcode->abbcode_config['ABBC3_VIDEO_HEIGHT'];

	// General setings
	$template->assign_vars(array(
		'S_ABBC3_PATH'		=> $phpbb_root_path . $abbcode->abbcode_config['ABBC3_PATH'],
		'S_WIZARD_GENERAL'	=> ($abbcode_bbcode == 'abbc3_table') ? false : ($abbcode_bbcode == 'abbc3_grad') ? false : true ,
		'S_WIZARD_TABLE'	=> ($abbcode_bbcode == 'abbc3_table') ? true  : false,
		'S_WIZARD_GRAD'		=> ($abbcode_bbcode == 'abbc3_grad') ? true  : false,
		'L_GRAD_ERROR'		=> $user->lang['ABBC3_GRAD_ERROR'],
		'S_BBVIDEO_OPTIONS'	=> ($abbcode_bbcode == 'abbc3_bbvideo') ? $video_options : '',

		'FORM_NAME'			=> $form_name,
		'TEXT_NAME'			=> $text_name,

		'ABBC3_OPEN'		=> $tag,
		'ABBC3_CLOSE'		=> '/' . $tag,

		'ABBC3_TAG'			=> (isset($user->lang[$abbcode_name . '_TAG']   )) ? $user->lang[$abbcode_name . '_TAG'] : '',
		'ABBC3_MOVER'		=> (isset($user->lang[$abbcode_name . '_MOVER'] )) ? $user->lang[$abbcode_name . '_MOVER'] : '',
		'ABBC3_NOTE'		=> (isset($user->lang[$abbcode_name . '_NOTE']  )) ? $user->lang[$abbcode_name . '_NOTE'] : '',
		'ABBC3_EXAMPLE'		=> (isset($user->lang[$abbcode_name . '_EXAMPLE'])) ? $user->lang[$abbcode_name . '_EXAMPLE'] : '',
		'ABBC3_DESC'		=> (in_array($tag, $need_description )) ? true : false,
		'ABBC3_W_H'			=> (in_array($tag, $need_width_height)) ? true : false,
		'ABBC3_WIDTH'		=> $abbc3_width,
		'ABBC3_HEIGHT'		=> $abbc3_height,
	));

	// Output page ...
	page_header($user->lang[$abbcode_name . '_MOVER']);

	$template->set_filenames(array(
		'body' => 'posting_abbcode_wizards.html')
	);

	page_footer();
}

?>