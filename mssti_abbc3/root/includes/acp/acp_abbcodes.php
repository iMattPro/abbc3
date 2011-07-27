<?php
/**
* @package: phpBB 3.0.9 :: Advanced BBCode box 3 -> root/includes/acp
* @version: $Id: acp_abbcode.php, v 3.0.9 2010/09/27 03:33:24 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @co-author: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
**/

/**
* @ignore
**/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
**/
class acp_abbcodes
{
	var $u_action;
	var $u_back;
	var $new_config;
	var $submit;
	var $dir;
	
	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		
		$user->add_lang(array('acp/styles', 'mods/acp_abbcodes', 'mods/abbcode'));

		// Include files
		require($phpbb_root_path . 'includes/abbcode.' . $phpEx);

		$radio_ary = array(1 => 'ORDER_ALLOW_DENY', 0 => 'ORDER_DENY_ALLOW');

		/** Set some default values so the user havn't to run any install - Start **/
		// Same default values as root/install_abbc3.php -> abbc3_308()
		$config['ABBC3_VERSION']			= (isset($config['ABBC3_VERSION']))			? $config['ABBC3_VERSION']			: '3.0.9';
		$config['ABBC3_MOD']				= (isset($config['ABBC3_MOD']))				? $config['ABBC3_MOD']				: true;
//		$config['ABBC3_PATH']				= (isset($config['ABBC3_PATH']))			? $config['ABBC3_PATH']				: 'styles/abbcode';
		$config['ABBC3_BG']					= (isset($config['ABBC3_BG']))				? $config['ABBC3_BG']				: 'bg_abbc3.gif';
		$config['ABBC3_TAB']				= (isset($config['ABBC3_TAB']))				? $config['ABBC3_TAB']				: 1;

		$config['ABBC3_BOXRESIZE']			= (isset($config['ABBC3_BOXRESIZE']))		? $config['ABBC3_BOXRESIZE']		: 1;
		$config['ABBC3_RESIZE']				= (isset($config['ABBC3_RESIZE']))			? $config['ABBC3_RESIZE']			: 1;
		$config['ABBC3_RESIZE_METHOD']		= (isset($config['ABBC3_RESIZE_METHOD']))	? $config['ABBC3_RESIZE_METHOD']	: 'AdvancedBox';
		$config['ABBC3_RESIZE_BAR']			= (isset($config['ABBC3_RESIZE_BAR']))		? $config['ABBC3_RESIZE_BAR']		: 1;
		$config['ABBC3_MAX_IMG_WIDTH']		= (isset($config['ABBC3_MAX_IMG_WIDTH']))	? $config['ABBC3_MAX_IMG_WIDTH']	: ($config['img_max_width']	? $config['img_max_width'] : 500);
		$config['ABBC3_MAX_IMG_HEIGHT']		= (isset($config['ABBC3_MAX_IMG_HEIGHT']))	? $config['ABBC3_MAX_IMG_HEIGHT']	: ($config['img_max_height'] ? $config['img_max_height'] : 0);
		$config['ABBC3_RESIZE_SIGNATURE']	= (isset($config['ABBC3_RESIZE_SIGNATURE']))? $config['ABBC3_RESIZE_SIGNATURE']	: 0;
		$config['ABBC3_MAX_SIG_WIDTH']		= (isset($config['ABBC3_MAX_SIG_WIDTH']))	? $config['ABBC3_MAX_SIG_WIDTH']	: ($config['max_sig_img_width'] ? $config['max_sig_img_width'] : 200);
		$config['ABBC3_MAX_SIG_HEIGHT']		= (isset($config['ABBC3_MAX_SIG_HEIGHT']))	? $config['ABBC3_MAX_SIG_HEIGHT']	: 0;
		$config['ABBC3_MAX_THUM_WIDTH']		= (isset($config['ABBC3_MAX_THUM_WIDTH']))	? $config['ABBC3_MAX_THUM_WIDTH']	: ($config['img_max_thumb_width'] ? $config['img_max_thumb_width']/2 : 200);

		$config['ABBC3_COLOR_MODE']			= (isset($config['ABBC3_COLOR_MODE']))		? $config['ABBC3_COLOR_MODE']		: 'phpbb';
		$config['ABBC3_HIGHLIGHT_MODE']		= (isset($config['ABBC3_HIGHLIGHT_MODE']))	? $config['ABBC3_HIGHLIGHT_MODE']	: 'dropdown';

		$config['ABBC3_WIZARD_MODE']		= (isset($config['ABBC3_WIZARD_MODE']))		? $config['ABBC3_WIZARD_MODE']		: 1;
		$config['ABBC3_WIZARD_width']		= (isset($config['ABBC3_WIZARD_width']))	? $config['ABBC3_WIZARD_width']		: 700;
		$config['ABBC3_WIZARD_height']		= (isset($config['ABBC3_WIZARD_height']))	? $config['ABBC3_WIZARD_height']	: 400;

		$config['ABBC3_VIDEO_width']		= (isset($config['ABBC3_VIDEO_width']))		? $config['ABBC3_VIDEO_width']		: 425;
		$config['ABBC3_VIDEO_height']		= (isset($config['ABBC3_VIDEO_height']))	? $config['ABBC3_VIDEO_height']		: 350;
		$config['ABBC3_VIDEO_OPTIONS']		= (isset($config['ABBC3_VIDEO_OPTIONS']))	? $config['ABBC3_VIDEO_OPTIONS']	: '1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20;21;22;23;24;25;26;27;28;29;30;31;32;33;34;35;36;37;38;39;40;41;42;43;44;45;201;202;203;204;205;206;207;208;';

		$config['ABBC3_UCP_MODE']			= (isset($config['ABBC3_UCP_MODE']))		? $config['ABBC3_UCP_MODE']			: 1;
		/** Set some default values so the user havn't to run any install - End **/

		// Set up general vars
		$action				= request_var('action', '');
		$bbcode_id			= request_var('bbcode_id', 0);

		$this->tpl_name		= 'acp_abbcodes';
		$this->page_title	= 'ACP_ABBCODES';
		$form_key			= 'acp_abbcodes';

		add_form_key($form_key);

		$this->u_back 		= $this->u_action;
		$this->submit		= (isset($_POST['submit'])) ? true : false;
		$abbc3_root_path	= ($phpbb_admin_path) ? $phpbb_admin_path : $phpbb_root_path ;
		$this->dir 			= $phpbb_root_path . 'styles/abbcode' ;

		// Execute overall actions
		switch ($mode)
		{
			case 'settings':
				$this->abbc3_details();
				break;

			case 'bbcodes'	:
				switch ($action)
				{
					case 'sync':
						$this->resync_abbcodes();

					// no break;
					case 'newdlb':
						$this->add_division	= (isset($_POST['add_division'])) ? true : false;
						$this->add_linebreak= (isset($_POST['add_linebreak'])) ? true : false;
						$this->add_new_division_or_linebreak($this->add_division, $this->add_linebreak);

					// no break;
					case 'move_up':
					case 'move_down':
						// Get current order id...
						$sql = "SELECT bbcode_order as current_order
							FROM " . BBCODES_TABLE . "
							WHERE bbcode_id = $bbcode_id";
						$result = $db->sql_query($sql);

						$current_order = (int) $db->sql_fetchfield('current_order');
						$db->sql_freeresult($result);

						if (($current_order == 0 && $action == 'move_up') || ($current_order <= 5 && $action == 'move_up'))
						{
							$bbcode_id = null;
							break;
						}

						// on move_down, switch position with next order_id...
						// on move_up, switch position with previous order_id...
						$switch_order_id = ($action == 'move_down') ? $current_order + 1 : $current_order - 1;

						$sql = "UPDATE " . BBCODES_TABLE . "
							SET bbcode_order = $current_order
							WHERE bbcode_order = $switch_order_id
								AND bbcode_id <> $bbcode_id";
						$db->sql_query($sql);

						// Only update the other entry too if the previous entry got updated
						if ($db->sql_affectedrows())
						{
							$sql = "UPDATE " . BBCODES_TABLE . "
								SET bbcode_order = $switch_order_id
								WHERE bbcode_order = $current_order
									AND bbcode_id = $bbcode_id";
							$db->sql_query($sql);
						}
						$bbcode_id = null;
					// no break;

				}
				$this->bbcodes_edit($id, $mode, $action, $bbcode_id);
				break;
		}
	}

	/**
	* Build Frontend with supplied options
	* @version 3.0.7
	**/
	function abbc3_details()
	{
		global $user, $template, $cache, $config, $phpbb_root_path;

		$this->page_title = 'ABBCODES_SETINGS';

	//	$isfounder = ($user->data['user_type'] == USER_FOUNDER) ? true : false;

		$display_vars = array(
			'title'	=> 'ABBCODES_SETINGS',
			'lang'	=> array('mods/abbcode', 'mods/acp_abbcodes'),
			'vars'	=> array(
				'legend1'				=> 'GENERAL_OPTIONS',
				'ABBC3_MOD'				=> array('lang' => 'ABBCODES_DISABLE',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain'	=> true),
		//		'ABBC3_PATH'			=> array('lang'	=> 'ABBCODES_PATH',				'validate' => 'path',	'type' => 'text::255',		'explain'	=> true),
				'ABBC3_BG'				=> array('lang' => 'ABBCODES_BG',				'validate' => 'string',	'type' => 'custom',			'function'	=> 'image_select', 'params' => array($this->dir . '/images/bg', '{CONFIG_VALUE}', 'config[ABBC3_BG]', true, $this->u_action, 'ABBC3_BG'), 'explain' => true),
				'ABBC3_TAB'				=> array('lang' => 'ABBCODES_TAB',				'validate' => 'bool',	'type' => 'radio:yes_no',	'explain'	=> true, 'append' => '&nbsp;&nbsp;<span>[ <img src="' . $this->dir . '/images/dots.gif" alt="" /> ]</span>'),
				'ABBC3_BOXRESIZE'		=> array('lang' => 'ABBCODES_BOXRESIZE',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain'	=> true),
				'ABBC3_UCP_MODE'		=> array('lang' => 'ABBCODES_UCP_MODE',			'validate' => 'bool',	'type' => 'radio:yes_no',	'explain'	=> true),

				'legend2'				=> 'ABBCODES_WIZARD',
				'ABBC3_WIZARD_width'	=> false,
				'ABBC3_WIZARD_height'	=> false,
				'ABBC3_WIZARD'			=> array('lang' => 'ABBCODES_WIZARD_SIZE',		'validate' => 'int',	'type' => 'dimension:3:4',	'explain'	=> true,  'append'  => ' ' . $user->lang['PIXEL']),
				'ABBC3_WIZARD_MODE'		=> array('lang'	=> 'ABBCODES_WIZARD_MODE',		'validate' => 'int',	'type' => 'custom',			'function'	=> 'get_radio', 'params' => array('config[ABBC3_WIZARD_MODE]', $user->lang['ABBCODES_WIZARD_SELECTOR'], $config['ABBC3_WIZARD_MODE'], 'ABBC3_WIZARD_MODE'), 'explain' => false),

				'legend3'				=> 'ABBCODES_RESIZER',
				'ABBC3_RESIZE'			=> array('lang' => 'ABBCODES_RESIZE',									'type' => 'string',			'explain'	=> true, 'append' => ' <span id="ABBC3_RESIZE">' . $user->lang['ABBCODES_JAVASCRIPT_EXPLAIN'] . '</span>'),
				'ABBC3_RESIZE_METHOD'	=> array('lang' => 'ABBCODES_RESIZE_METHOD',	'validate' => 'string',	'type' => 'custom',			'function'	=> 'method_select', 'params' => array('{CONFIG_VALUE}', 'config[ABBC3_RESIZE_METHOD]', 'ABBC3_RESIZE_METHOD'), 'explain' => true),
				'ABBC3_RESIZE_BAR'		=> array('lang' => 'ABBCODES_RESIZE_BAR',		'validate' => 'bool',	'type' => 'radio:yes_no',	'explain'	=> true),
				'ABBC3_MAX_IMG_WIDTH'	=> array('lang' => 'ABBCODES_MAX_IMAGE_WIDTH',	'validate' => 'int',	'type' => 'text:7:15',		'explain'	=> true, 'append' => ' ' . $user->lang['PIXEL']),
				'ABBC3_MAX_IMG_HEIGHT'	=> array('lang' => 'ABBCODES_MAX_IMAGE_HEIGHT',	'validate' => 'int',	'type' => 'text:7:15',		'explain'	=> true, 'append' => ' ' . $user->lang['PIXEL']),
				'ABBC3_MAX_THUM_WIDTH'	=> array('lang' => 'ABBCODES_MAX_THUMB_WIDTH',	'validate' => 'int',	'type' => 'text:7:15',		'explain'	=> true, 'append' => ' ' . $user->lang['PIXEL']),
				'ABBC3_RESIZE_SIGNATURE'=> array('lang' => 'ABBCODES_RESIZE_SIGNATURE',	'validate' => 'bool',	'type' => 'radio:yes_no',	'explain'	=> true),
				'ABBC3_MAX_SIG_WIDTH'	=> array('lang' => 'ABBCODES_SIG_IMAGE_WIDTH',	'validate' => 'int',	'type' => 'text:7:15',		'explain'	=> true, 'append' => ' ' . $user->lang['PIXEL']),
				'ABBC3_MAX_SIG_HEIGHT'	=> array('lang' => 'ABBCODES_SIG_IMAGE_HEIGHT',	'validate' => 'int',	'type' => 'text:7:15',		'explain'	=> true, 'append' => ' ' . $user->lang['PIXEL']),

				'legend4'				=> 'ABBC3_BBVIDEO_TAG',
				'ABBC3_VIDEO'			=> array('lang' => 'ABBCODES_VIDEO_SIZE',		'validate' => 'int',	'type' => 'dimension:3:4',	'explain'	=> true, 'append' => ' ' . $user->lang['PIXEL']),
				'ABBC3_VIDEO_width'		=> false,
				'ABBC3_VIDEO_height'	=> false,
				'ABBC3_VIDEO_OPTIONS'	=> array('lang' => 'ABBCODES_VIDEO_ALLOWED',	'validate' => 'string',	'type' => 'custom',			'function'	=> 'video_select', 'params' => array('{CONFIG_VALUE}', 'allowed_videos[]', $this->u_action, 'ABBC3_VIDEO_OPTIONS'), 'explain' => true),
			)
		);

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}

		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? request_var('config', array('' => '')) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		// Do not write values if there is an error
		if (sizeof($error))
		{
			$this->submit = false;
		}

		// Grab global variables, re-cache if necessary
		if ($this->submit)
		{
			$config = $cache->obtain_config();
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}
			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($this->submit)
			{
				set_config($config_name, $config_value);
			}
		}

		if ($this->submit)
		{
			$allowed_videos	= request_var('allowed_videos', array(0));
			set_config('ABBC3_VIDEO_OPTIONS', video_serialize($allowed_videos, true));

			add_log('admin', 'LOG_CONFIG_ABBCODES');

			if (!sizeof($error))
			{
				trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
			}
			else
			{
				trigger_error($user->lang['LOG_CONFIG_ABBCODES_ERROR'] . adm_back_link($this->u_action), E_USER_WARNING);
			}
		}

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}

			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars),
				)
			);
			unset($display_vars['vars'][$config_key]);
		}

		$board_path = generate_board_url() . '/' . str_replace($phpbb_root_path, '', $this->dir) . '/';
	
		$template->assign_vars(array(
			'S_EDIT'			=> true,

			'L_TITLE_EDIT'		=> $user->lang['ABBCODES_SETINGS'],
			'L_TITLE_EXPLAIN'	=> $user->lang['ABBCODES_SETINGS_EXPLAIN'],
			'ICON_BASEDIR'		=> $this->dir . '/images/bg/',

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'S_FOUNDER'			=> ($user->data['user_type'] == USER_FOUNDER) ? true : false,
			'NO_FOUNDER'		=> $user->lang['NO_AUTH_OPERATION'],

			'U_ABBC3'			=> $user->lang['ABBC3_HELP_ABOUT'],
			'U_ACTION'			=> $this->u_action,

			'ABBC3_VERSION'				=> $config['ABBC3_VERSION'],
			'S_VERSION_UP_TO_DATE'		=> $this->abbc3_version_compare($config['ABBC3_VERSION']),

			// Check which options can be used for the resize method
			'ADVANCEDBOX_EXIST'					=> (@file_exists("$this->dir/AdvancedBox.js")) ? 1 : 0,
			'L_NO_EXIST_EXPLAIN_ADVANCEDBOX'	=> sprintf($user->lang['NO_EXIST_EXPLAIN_ADVANCEDBOX'], $board_path),

			'HIGHSLIDE_EXIST'					=> (@file_exists("$this->dir/highslide/highslide-full.js")) ? 1 : 0,
			'L_NO_EXIST_EXPLAIN_HIGHSLIDE'		=> sprintf($user->lang['NO_EXIST_EXPLAIN_OTHERS'], "highslide-full.js", "4.0.1", "{$board_path}highslide/", "Highslide JS", "http://highslide.com/download.php"),

			'LITEBOX_EXIST'						=> (@file_exists("$this->dir/lightbox/lightbox.js")) ? 1 : 0,
			'L_NO_EXIST_EXPLAIN_LITEBOX'		=> sprintf($user->lang['NO_EXIST_EXPLAIN_OTHERS'], "lightbox.js", "2.04", "{$board_path}lightbox/", "Lightbox JS", "http://www.huddletogether.com/projects/lightbox/"),

			'GREYBOX_EXIST'						=> (@file_exists("$this->dir/greybox/gb_scripts.js")) ? 1 : 0,
			'L_NO_EXIST_EXPLAIN_GREYBOX'		=> sprintf($user->lang['NO_EXIST_EXPLAIN_OTHERS'], "gb_scripts.js", "5.53", "{$board_path}greybox/", "GreyBox", "http://orangoo.com/labs/GreyBox/Download/"),

			'LIGHTVIEW_EXIST'					=> (@file_exists("$this->dir/lightview/js/lightview.js")) ? 1 : 0,
			'L_NO_EXIST_EXPLAIN_LIHTVIEW'		=> sprintf($user->lang['NO_EXIST_EXPLAIN_OTHERS'], "lightview.js", "2.5", "{$board_path}lightview/js/", "Lightview", "http://www.nickstakenburg.com/projects/lightview/"),

			'IBOX_EXIST'						=> (@file_exists("$this->dir/ibox/ibox.js")) ? 1 : 0,
			'L_NO_EXIST_EXPLAIN_IBOX'			=> sprintf($user->lang['NO_EXIST_EXPLAIN_OTHERS'], "ibox.js", "2.18", "{$board_path}ibox/", "iBox", "http://www.ibegin.com/labs/ibox/"),

			'POPBOX_EXIST'						=> (@file_exists("$this->dir/PopBox/PopBox.js")) ? 1 : 0,
			'L_NO_EXIST_EXPLAIN_POPBOX'			=> sprintf($user->lang['NO_EXIST_EXPLAIN_OTHERS'], "PopBox.js", "2.6b", "{$board_path}PopBox/", "PopBox", "http://www.c6software.com/Products/PopBox/"),
		));

	}

	/**
	* Add a new division or breack line
	**/
	function add_new_division_or_linebreak($add_division, $add_linebreak)
	{
		global $user, $db, $template, $config, $cache;

		// get last bbcode id - Start
		$sql = 'SELECT MIN(bbcode_id) as min_bbcode_id
			FROM ' . BBCODES_TABLE;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		if ($row)
		{
			$next_bbcode_id = $row['min_bbcode_id'];
		}
		else
		{
			$next_bbcode_id = 0;
		}
		$next_bbcode_id = $next_bbcode_id-1;
		// get last bbcode id - End

		// get last order - Start
		$sql = 'SELECT MAX(bbcode_order) as max_bbcode_order
			FROM ' . BBCODES_TABLE;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);
		$next_bbcode_order = (int) $row['max_bbcode_order'] + 1;
		// get last order - End

		$sql = "SELECT *
				FROM " . BBCODES_TABLE . "
				WHERE bbcode_helpline = '" . ($add_linebreak ? 'ABBC3_BREAK' : 'ABBC3_DIVISION') . "'
				ORDER BY bbcode_order DESC";
		$result = $db->sql_query_limit($sql, 1);
		while ($row = $db->sql_fetchrow($result))
		{
			$bbcode = $row['bbcode_tag'];
		}
		$db->sql_freeresult($result);

		// get the value of current tag
		$number = preg_replace('#(break|division)(\d+)#s', '$2', $bbcode);
		$next_bbcode_number = (int) $number + 1;

		$sql_ary = array(
			'bbcode_id'					=> $next_bbcode_id,
			'bbcode_tag'				=> (($add_linebreak) ? 'break' : 'division') . $next_bbcode_number,
			'bbcode_helpline'			=> ($add_linebreak) ? 'ABBC3_BREAK' : 'ABBC3_DIVISION',
			'display_on_posting'		=> true,
			'display_on_pm'				=> false,
			'display_on_sig'			=> false,
			'bbcode_match'				=> '.',
			'bbcode_tpl'				=> '.',
			'first_pass_match'			=> '.',
			'first_pass_replace'		=> '.',
			'second_pass_match'			=> '.',
			'second_pass_replace'		=> '.',
			'abbcode'					=> true,
			'bbcode_image'				=> ($add_linebreak) ? 'spacer.gif' : 'dots.gif',
			'bbcode_order'				=> $next_bbcode_order,
		);
		$db->sql_query('INSERT INTO ' . BBCODES_TABLE . $db->sql_build_array('INSERT', $sql_ary));

		$cache->destroy('sql', BBCODES_TABLE);

		$user->add_lang('acp/posting');
		add_log('admin', 'LOG_BBCODE_ADD', $sql_ary['bbcode_tag']);

		trigger_error($user->lang['BBCODE_ADDED'] . adm_back_link($this->u_action));
	}

	/**
	* Synchronise order
	**/
	function resync_abbcodes()
	{
		global $user, $db;

		$user->add_lang('mods/acp_abbcodes');

		// This pseodo-bbcode should not change the position order
		$bbcode_tag_ary =  array('font=', 'size', 'highlight=', 'color');
		$next_bbcode_order = sizeof($bbcode_tag_ary)+1;

		$sql = 'SELECT bbcode_id, bbcode_tag, bbcode_order 
				FROM ' . BBCODES_TABLE . ' 
				WHERE ' . $db->sql_in_set('bbcode_tag', $bbcode_tag_ary, true) . ' 
				ORDER BY bbcode_order';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$sql = 'UPDATE ' . BBCODES_TABLE . " 
					SET bbcode_order = $next_bbcode_order 
					WHERE bbcode_id = {$row['bbcode_id']}";
			$db->sql_query($sql);

			$next_bbcode_order++;
		}
		$db->sql_freeresult($result);

		trigger_error($user->lang['ABBCODES_RESYNC_SUCCESS'] . adm_back_link($this->u_action));
	}

	/**
	* Show/edit bbcodes
	* @version 1.0.12
	**/
	function bbcodes_edit($id, $mode, $action, $bbcode = '')
	{
		global $user, $db, $cache, $template, $config;

		$user->add_lang(array('acp/posting', 'mods/acp_abbcodes', 'mods/abbcode'));

		// Is this ABBC3 is disabled
		if (!isset($config['ABBC3_MOD']))
		{
			trigger_error($user->lang['ABBCODES_MOD_DISABLE'] . adm_back_link($this->u_action), E_USER_WARNING);
		}

		$img_spacer = 'spacer.gif';
		$img_noimg  = 'no_image.png';

		if ($this->submit && $bbcode)
		{
			// Get items to create/modify
			$abbcode_name		= (isset($_POST['name'])) ? request_var('name', array('' => '')) : array();
			$display_on_posting = (isset($_POST['display_on_posting'])) ? request_var('display_on_posting', array('' => 0)) : array();
			$display_on_pm		= (isset($_POST['display_on_pm'])) ? request_var('display_on_pm', array('' => 0)) : array();
			$display_on_sig		= (isset($_POST['display_on_sig'])) ? request_var('display_on_sig', array('' => 0)) : array();
			$bbcode_image		= utf8_normalize_nfc(request_var('image', array('' => ''), true));
			$group_ids			= implode(',', request_var('group_id', array(0)));

			$bbcode_sql = array(
				'display_on_posting'	=> (isset($display_on_posting[$bbcode])) ? 1 : 0,
				'display_on_pm'			=> (isset($display_on_pm[$bbcode])) ? 1 : 0,
				'display_on_sig'		=> (isset($display_on_sig[$bbcode])) ? 1 : 0,
				'bbcode_image'			=> (isset($bbcode_image[$bbcode])) ? $bbcode_image[$bbcode] : '',
				'bbcode_group'			=> (isset($group_ids) && trim($group_ids) != '') ? $group_ids : 0,
			);

			// Fix for breack line?
			if (substr($abbcode_name[$bbcode],0,14) == 'ABBCODES_BREAK')
			{
				$bbcode_sql['bbcode_image'] = $img_spacer;
			}

			if ($abbcode_name[$bbcode] == 'ABBC3_COLOR' || $abbcode_name[$bbcode] == 'ABBC3_HIGHLIGHT')
			{
				if ($abbc3_color_mode = request_var('abbc3_color', ''))
				{
					set_config('ABBC3_COLOR_MODE', $abbc3_color_mode);
				}

				if ($abbc3_highlight_mode = request_var('abbc3_highlight', ''))
				{
					set_config('ABBC3_HIGHLIGHT_MODE', $abbc3_highlight_mode);
				}
			}

			$sql = "UPDATE " . BBCODES_TABLE . "
				SET " . $db->sql_build_array('UPDATE', $bbcode_sql) . "
				WHERE bbcode_id = " . $bbcode;
			$result = $db->sql_query($sql);

			if ($result)
			{
				trigger_error($user->lang['LOG_CONFIG_ABBCODES'] . adm_back_link($this->u_action . "&amp;last_id=$bbcode"));
			}
			else
			{
				trigger_error($user->lang['LOG_CONFIG_ABBCODES_ERROR'] . adm_back_link($this->u_action), E_USER_WARNING);
			}
			$bbcode = '';
		}

		$error = array();

		// Exclude bots
		$sql = 'SELECT group_id
			FROM ' . GROUPS_TABLE . "
			WHERE group_name IN ('BOTS')";
		$result = $db->sql_query($sql);

		$exclude = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$exclude[] = $row['group_id'];
		}
		$db->sql_freeresult($result);

		$sql = "SELECT abbcode, bbcode_order, bbcode_id, bbcode_group, bbcode_tag, bbcode_helpline, bbcode_image, display_on_posting, display_on_pm, display_on_sig 
				FROM " . BBCODES_TABLE . " 
				ORDER BY bbcode_order";
		$result = $db->sql_query($sql);

		$bbcode_id	= request_var('bbcode_id', 0);

		$template->assign_vars(array(
			'S_BBCODES'			=> true,
			'LAST_ID'			=> request_var('last_id', $bbcode_id),

			'L_TITLE_BBCODES'	=> $user->lang['ABBCODES_CONFIG'],
			'L_EXPLAIN_BBCODES'	=> $user->lang['ABBCODES_CONFIG_EXPLAIN'],

			'S_BBCODE_EDIT'		=> ($bbcode) ? true :false,

			'ICON_BASEDIR'		=> $this->dir . '/images/',

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'U_ABBC3'			=> $user->lang['ABBC3_HELP_ABOUT'],
			'U_ACTION'			=> $this->u_action,
			'F_ACTION'			=> ($bbcode) ? $this->u_action . '&amp;mode=bbcodes&amp;action=edit&amp;bbcode_id=' . $bbcode : null,
			'A_ACTION'			=> (!$bbcode) ? $this->u_action . '&amp;mode=bbcodes&amp;action=newdlb' : null,
			'U_SYNC'			=> (!$bbcode) ? $this->u_action . '&amp;mode=bbcodes&amp;action=sync' : null,
			'U_BACK'			=> ($bbcode) ? $this->u_back : null,
		));

		$no_move = array('ABBC3_FONT', 'ABBC3_SIZE', 'ABBC3_HIGHLIGHT', 'ABBC3_COLOR');
		$first_row_to_move = 0;
		while ($row = $db->sql_fetchrow($result))
		{
			/** Some fixes **/
			$bbcode_id		= $row['bbcode_id'];
			$abbcode		= $row['abbcode'];
			$abbcode_name	= (($row['abbcode']) ? 'ABBC3_' : '') . strtoupper(str_replace('=', '', trim($row['bbcode_tag'])));
			$abbcode_name	= ($row['bbcode_helpline'] == 'ABBC3_ED2K_TIP') ? 'ABBC3_ED2K' : $abbcode_name;
			$abbcode_image	= trim($row['bbcode_image']);
			$abbcode_tag	= str_replace('=', '', trim($row['bbcode_tag']));

			$is_a_bbcode	= true;
			// is a breack line or division ?
			if ((strpos($abbcode_name, 'ABBC3_DIVISION') !== false) || (strpos($abbcode_name, 'ABBC3_BREAK') !== false) || in_array($row['bbcode_tag'], array('imgshack', 'cut', 'copy', 'paste', 'plain')))
			{
				$is_a_bbcode	= false;
				if (strpos($abbcode_name, 'ABBC3_DIVISION') !== false)
				{
					if ($config['ABBC3_TAB'])
					{
						$abbcode_name = 'ABBCODES_DIVISION';
					}
					else
					{
						continue;
					}
				}
				else if (strpos($abbcode_name, 'ABBC3_BREAK') !== false)
				{
						$abbcode_name = 'ABBCODES_BREAK';
				}
			}

			if ($abbcode_name == 'ABBC3_COLOR')
			{
				$first_row_to_move = $row['bbcode_order'] + 1;
			}

			$abbcode_explain = '';
			$bbcode_tagname = '';
			if (!$abbcode)
			{
				$bbcode_tagname = '[' . $abbcode_tag . ']';
				$abbcode_explain = $user->lang['ABBCODES_CUSTOM'] . '&nbsp;<strong>' . $bbcode_tagname . '</strong>'; //$row['bbcode_helpline'];
			}
			else
			{
				$bbcode_tagname  = (!$is_a_bbcode) ? '' : '[' . str_replace(array('listo', 'listb', 'listitem'), array('list=', 'list', '*'), $abbcode_tag) .']';
				$abbcode_explain = (isset($user->lang[$abbcode_name . '_MOVER'])) ? $user->lang[$abbcode_name . '_MOVER'] : '';
				$abbcode_explain.= (isset($user->lang[$abbcode_name . '_EXPLAIN'])) ? '<br />' . $user->lang[$abbcode_name . '_EXPLAIN'] : '';
			}

			if ($action != 'edit')
			{
				$template->assign_block_vars('items', array(
					'ID'				=> $bbcode_id,
					'ORDER'				=> $row['bbcode_order'],
					'NAME'				=> str_replace('=', '', trim($row['bbcode_tag'])),
					'TAG_NAME'			=> $bbcode_tagname,
					'TAG_EXPLAIN'		=> $abbcode_explain,
					'IMG_SRC'			=> ($abbcode_image && $abbcode_image != $img_spacer) ? $this->dir . '/images/' . $abbcode_image : '',

					'ON_POST'			=> ($row['display_on_posting'])	? $user->lang['ENABLED'] : $user->lang['DISABLED'],
					'ON_PM'				=> ($row['display_on_pm'])		? $user->lang['ENABLED'] : $user->lang['DISABLED'],
					'ON_SIG'			=> ($row['display_on_sig'])		? $user->lang['ENABLED'] : $user->lang['DISABLED'],

					'S_NOMOVE'			=> (in_array($abbcode_name, $no_move)) ? true : false,
					'S_FIRST_ROW'		=> ($row['bbcode_order'] == $first_row_to_move) ? true : false,

					'U_EDIT'			=> $this->u_action . '&amp;mode=bbcodes&amp;action=edit&amp;bbcode_id=' . $row['bbcode_id'],
					'U_MOVE_UP'			=> $this->u_action . '&amp;mode=bbcodes&amp;action=move_up&amp;bbcode_id=' . $row['bbcode_id'],
					'U_MOVE_DOWN'		=> $this->u_action . '&amp;mode=bbcodes&amp;action=move_down&amp;bbcode_id=' . $row['bbcode_id'],
				));
			}
			else if ($action == 'edit' && $row['bbcode_id'] == $bbcode)
			{
				$radio = '';
				if ($abbcode_name == 'ABBC3_COLOR' || $abbcode_name == 'ABBC3_HIGHLIGHT')
				{
					$radio = get_radio(strtolower($abbcode_name), $user->lang['ABBCODES_COLOUR_SELECTOR'], $config[$abbcode_name . '_MODE'], $abbcode_name);
				}

				$template->assign_block_vars('items', array(
					'ID'				=> $bbcode_id,
					'NAME'				=> $abbcode_name,
					'TAG_NAME'			=> $bbcode_tagname,
					'TAG_EXPLAIN'		=> ($abbcode) ? $abbcode_explain : $row['bbcode_helpline'],
					'IMG_SRC'			=> ($abbcode_image) ? ($abbcode_image != $img_spacer) ? $this->dir . '/images/' . $abbcode_image : '' : $this->dir . '/images/' . $img_noimg,

 					'S_NOMOVE'			=> (in_array($abbcode_name, $no_move)) ? true : null,
					'S_NEW_IMG'			=> image_select($this->dir . '/images', $abbcode_image, 'image[' . $bbcode_id . ']', false, $this->u_action),
					'POSTING_CHECKED'	=> ($row['display_on_posting']) ? ' checked="checked"' : '',
					'PM_CHECKED'		=> ($row['display_on_pm'])		? ' checked="checked"' : '',
					'SIG_CHECKED'		=> ($row['display_on_sig'])		? ' checked="checked"' : '',

					'S_GROUP_OPTIONS'	=> groups_select_options(explode(',', $row['bbcode_group']), $exclude),
					'S_RADIO_BUTTONS'	=> ($radio) ? $radio : '',
				));
			}
		}
	}

	/**
	* Obtains the latest version information
	* @param string 	$current_version 	version information
	* @param int 		$ttl 				Cache version information for $ttl seconds. Defaults to 86400 (24 hours).
	* 
	* @return bool 		false on failure.
	**/
	function abbc3_version_compare($current_version = '', $version_up_to_date = true, $ttl = 86400)
	{
		global $cache, $template;
		
		$info = $cache->get('abbc3_versioncheck');

		if ($info === false)
		{
			$errstr = '';
			$errno = 0;

			$info = get_remote_file('www.mssti.com', '/phpbb3/store/updatecheck', 'abbc3.txt', $errstr, $errno);
			if ($info === false)
			{
				$template->assign_var('S_VERSIONCHECK_FAIL', true);
				$cache->destroy('abbc3_versioncheck');
			}
		}

		if ($info !== false)
		{
			$cache->put('abbc3_versioncheck', $info, $ttl);
			$latest_version_info = explode("\n", $info);

			$latest_version = strtolower(trim($latest_version_info[0]));
			$current_version = strtolower(trim($current_version));
			$version_up_to_date = version_compare($current_version, $latest_version, '<') ? false : true;

			$template->assign_vars(array(
				'U_VERSIONCHECK'	=> ($version_up_to_date) ? false : $latest_version_info[1],
			));
		}

		return $version_up_to_date;
	}
}

	/**
	* Select list of images in current style folder
	**/
	function image_select($dir, $current, $name, $show = false, $u_action, $ide = 'ABBC3_BG')
	{
		global $user, $config, $phpbb_admin_path, $phpbb_root_path, $phpEx;

		// Read the folder and get images
		$dp = @opendir($dir);
		$count = 0;

		if ($dp)
		{
			while (($file = readdir($dp)) !== false)
			{
				if (preg_match('#\.(?:gif|jpg|png)$#', $file))
				{
					$imagesetlist[$count] = $file;
					$count++;
				}
			}
			closedir($dp);
		}
		else
		{
			trigger_error($user->lang['NO_IMAGESET'] . adm_back_link($u_action), E_USER_WARNING);
		}

		if (sizeof($imagesetlist))
		{
			// Make sure the list of possible images is sorted alphabetically
			sort($imagesetlist);

			$icons_list = '<select id="' .$ide .'" name="' . $name . '" onchange="update_image(this.options[selectedIndex].value);">' . "\n";
			$icons_list .= '<option value="" ' . (($current == '') ? ' selected="selected"' : ''). '>' . $user->lang['NO_IMAGE'] . '</option>' . "\n";

			for($i = 0; $i < count($imagesetlist); $i++)
			{
				$selected = ($imagesetlist[$i] == $current) ? ' selected="selected"' : '';
				$icons_list .= '<option value="' . $imagesetlist[$i] . '"' . $selected . '>' . $imagesetlist[$i] . '</option>' . "\n";
			}
			$icons_list .= '</select>'. (($show) ? '&nbsp; <label>' . $user->lang['CURRENT_IMAGE'] . '</label><span><img src="' . $dir . '/' . $current .'" id="newimg" alt="" width="80" height="30" /></span>' : '');
		}
		return $icons_list;
	}

	/**
	* Select list of BBvideos
	**/
	function video_select($current, $name, $u_action, $ide = 'ABBC3_VIDEO_OPTIONS')
	{
		global $user, $config, $phpbb_admin_path, $phpbb_root_path, $phpEx;

		$abbcode_video_ary = abbcode::video_init();
		// The video_serialize function is at root/includes/abbcode.php after the abbcode class
		$allowed_videos = (!$current) ? array() : video_serialize($current, false);

		if (sizeof($abbcode_video_ary))
		{
			$video_options = '';
			$video_optgroup = false;

			foreach ($abbcode_video_ary as $video_name => $video_data)
			{
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
					$selected = (in_array($video_data['id'], $allowed_videos)) ? ' selected="selected"' : '';
					$video_options .= '<option value="' . $video_data['id'] . '"' . $selected . '>' . $video_name . '</option>' . "\n";
				}
				else
				{
					continue;
				}
			}
			$video_options .= ($video_optgroup) ? '</optgroup>' . "\n" : '';
		}
		
		return '<select id="' . $ide .'" name="' . $name . '" multiple="multiple" size="10">' . "\n" . $video_options . '</select>
		<br /><a href="#" onclick="selector(true, \'' . $ide . '\'); return false;">' . $user->lang['ABBCODES_SELECT_ALL'] . '</a> :: <a href="#" onclick="selector(false, \'' . $ide . '\'); return false;">' . $user->lang['ABBCODES_DESELECT_ALL'] . '</a>
		<br /><br />' . $user->lang['ABBCODES_VIDEO_ALLOWED_NOTE'];
	}

	/**
	* Select list of display full size image
	**/
	function method_select($selected_method = 'AdvancedBox', $name, $ide)
	{
		global $user;

		$method_options = $user->lang['ABBCODES_RESIZE_METHODS'];

		$s_method_options = '<select id="' . $ide . '" name="' . $name . '">';
		foreach($method_options as $method_name => $method_value)
		{
			$selected = ($selected_method == $method_name) ? ' selected="selected"' : '';
			$s_method_options .= '<option value="' . $method_name . '"' . $selected . ' >' . $method_value . '</option>';
		}
		$s_method_options.= '</select>';

		return $s_method_options;
	}

	/**
	* Select list of display color picker
	**/
	function get_radio($name, $input_ary, $input_default = false, $id = false, $key = false)
	{
		global $user;

		// destroy a single element of an array
		if ($name == "abbc3_highlight")
		{
			unset($input_ary['phpbb']);
		}

		$html = '';
		$id_assigned = false;
		foreach ($input_ary as $value => $title)
		{
			$value = strtolower($value);
			
			$selected = ($input_default !== false && $value == $input_default) ? ' checked="checked"' : '';
			$html .= ' <label><input class="radio" type="radio" name="' . $name . '"' . (($id && !$id_assigned) ? ' id="' . $id . '"' : '') . ' value="' . $value . '"' . $selected . (($key) ? ' accesskey="' . $key . '"' : '') . ' />&nbsp;' . $title . '&nbsp;</label>';
			$id_assigned = true;
		}

		return $html;
	}

	function groups_select_options($select_id = false, $exclude_ids = false)
	{
		global $user, $db;

		$sql = 'SELECT group_id, group_name, group_type
				FROM ' . GROUPS_TABLE . '
				WHERE ' . $db->sql_in_set('group_id', array_map('intval', $exclude_ids), true) .' 
				ORDER BY group_type DESC, group_name ASC';
		$result = $db->sql_query($sql);

		$group_options = '';
		while ($row = $db->sql_fetchrow($result))
		{
			$selected = (is_array($select_id)) ? ((in_array($row['group_id'], $select_id)) ? ' selected="selected"' : '') : (($row['group_id'] == $select_id) ? ' selected="selected"' : '');
			$group_options .= '<option value="' . $row['group_id'] . '"' . $selected . '>' . ucfirst(strtolower((($row['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row['group_name']] : $row['group_name']))) . '</option>';
		}
		$db->sql_freeresult($result);
		return $group_options;
	}

?>