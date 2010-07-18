<?php
/**
* @package: phpBB 3.0.8 :: Advanced BBCode box 3 -> root/
* @version: $Id: install_abbc3.php, v 3.0.8 2010/07/12 10:07:12 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @co-author: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
*
* @todo: made a bbcode add function to works like acp_bbcode.php
**/

/**
* @ignore
**/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
if (!defined('DEBUG'))
{
	@define('DEBUG', true);
}

$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/" onclick="window.open(this.href);return false;">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

$mod_data = array(
	'config'				=> 'ABBC3_VERSION',
	'name'					=> 'INSTALLER_TITLE',
	'version'				=> '3.0.8',
	'language'				=> array('mods/acp_abbcodes', 'mods/abbcode', 'install', 'acp/common', 'acp/modules', 'posting'),
	/** Set some default values so the user havn't to run any install - Start **/
	'img_max_width'			=> ($config['img_max_width']		) ? $config['img_max_width']		: 500,
	'sig_img_max_width'		=> ($config['max_sig_img_width']	) ? $config['max_sig_img_width']	: 200,
	'img_max_thumb_width'	=> ($config['img_max_thumb_width']	) ? $config['img_max_thumb_width']	: 300,
);

// The name of the mod to be displayed during installation.
$mod_name = $mod_data['name'];

// The name of the config variable which will hold the currently installed version
$version_config_name = $mod_data['config'];

// Add the language file if one was specified
if (isset($mod_data['language']))
{
	$user->add_lang($mod_data['language']);
}

$user->lang['TRANSLATION_INFO'] = (!empty($user->lang['TRANSLATION_INFO'])) ? $user->lang['TRANSLATION_INFO'] . '<br />' . $user->lang['ABBC3_HELP_ABOUT'] : $user->lang['ABBC3_HELP_ABOUT'];

// Logo Image
$logo_img = $phpbb_root_path . 'styles/abbcode/abbc3_logo.png';

// Options to display to the user
$user->lang['INSTALLER_INSTALL_WELCOME_NOTE'] = $user->lang['INSTALLER_INSTALL_WELCOME_NOTE'] . '<br /><br /><br />' . $user->lang['ABBC3_HELP_ABOUT'];
$options = array(
	'legend2'	=> 'WARNING',
	'welcome'	=> array('lang' => 'INSTALLER_INSTALL_WELCOME', 'type' => 'custom', 'function' => 'display_message', 'params' => array('INSTALLER_INSTALL_WELCOME_NOTE', 'error'), 'explain' => false),
	'legend3'	=> 'ACP_SUBMIT_CHANGES',
);

// The array of versions and actions within each.
$versions = array(
//	'1.0.0'		=> array(),
//	'1.0.1'		=> array(),
//	'1.0.2'		=> array(),
//	'1.0.3'		=> array(),
//	'1.0.4'		=> array(),
//	'1.0.5'		=> array(),
//	'1.0.6'		=> array(),
//	'1.0.6-b'	=> array(),
//	'1.0.7'		=> array(),
//	'1.0.7-b'	=> array(),
//	'1.0.8'		=> array(),
//	'1.0.9'		=> array(),
//	'1.0.9-b'	=> array(),
//	'1.0.10'	=> array(),
//	'1.0.11'	=> array(),
//	'1.0.12'	=> array(),
//	'3.0.7'		=> array(),
//	'3.0.7-PL1'	=> array(),
	'3.0.8'		=> array(
		// Modules
		'module_add'	=> array(
			// First, lets add a new category named ACP_ABBCODES to ACP_CAT_POSTING
			array('acp', 'ACP_CAT_POSTING', 'ACP_ABBCODES'),
			// Frontend Module
			array('acp', 'ACP_ABBCODES', array(
					'module_basename'	=> 'abbcodes',
					'module_langname'	=> 'ACP_ABBC3_SETTINGS',
					'module_mode'		=> 'settings',
					'module_auth'		=> 'acl_a_bbcode',
				),
			),
			// Config Module
			array('acp', 'ACP_ABBCODES', array(
					'module_basename'	=> 'abbcodes',
					'module_langname'	=> 'ACP_ABBC3_BBCODES',
					'module_mode'		=> 'bbcodes',
					'module_auth'		=> 'acl_a_bbcode',
				),
			),
		),

		// Config
		'config_add'	=> array(
			array('ABBC3_MOD',				(isset($config['ABBC3_MOD']))				? $config['ABBC3_MOD']				: true),
			array('ABBC3_PATH',				(isset($config['ABBC3_PATH']))				? $config['ABBC3_PATH']				: 'styles/abbcode'),
			array('ABBC3_RESIZE',			(isset($config['ABBC3_RESIZE']))			? $config['ABBC3_RESIZE']			: 1),
			array('ABBC3_RESIZE_METHOD',	(isset($config['ABBC3_RESIZE_METHOD']))		? $config['ABBC3_RESIZE_METHOD']	: 'AdvancedBox'),
			array('ABBC3_RESIZE_BAR',		(isset($config['ABBC3_RESIZE_BAR']))		? $config['ABBC3_RESIZE_BAR']		: 1),
			array('ABBC3_MAX_IMG_WIDTH',	(isset($config['ABBC3_MAX_IMG_WIDTH']))		? $config['ABBC3_MAX_IMG_WIDTH']	: $mod_data['img_max_width']),
			array('ABBC3_MAX_IMG_HEIGHT',	(isset($config['ABBC3_MAX_IMG_HEIGHT']))	? $config['ABBC3_MAX_IMG_HEIGHT']	: 0),
			array('ABBC3_RESIZE_SIGNATURE',	(isset($config['ABBC3_RESIZE_SIGNATURE']))	? $config['ABBC3_RESIZE_SIGNATURE']	: 0),
			array('ABBC3_MAX_SIG_WIDTH',	(isset($config['ABBC3_MAX_SIG_WIDTH']))		? $config['ABBC3_MAX_SIG_WIDTH']	: $mod_data['sig_img_max_width']),
			array('ABBC3_MAX_SIG_HEIGHT',	(isset($config['ABBC3_MAX_SIG_HEIGHT']))	? $config['ABBC3_MAX_SIG_HEIGHT']	: 0),
			array('ABBC3_MAX_THUM_WIDTH',	(isset($config['ABBC3_MAX_THUM_WIDTH']))	? $config['ABBC3_MAX_THUM_WIDTH']	: $mod_data['img_max_thumb_width']),
			array('ABBC3_BG',				(isset($config['ABBC3_BG']))				? $config['ABBC3_BG']				: 'bg_abbc3.gif'),
			array('ABBC3_TAB',				(isset($config['ABBC3_TAB']))				? $config['ABBC3_TAB']				: 1),
			array('ABBC3_BOXRESIZE',		(isset($config['ABBC3_BOXRESIZE']))			? $config['ABBC3_BOXRESIZE']		: 1),
			array('ABBC3_VIDEO_width',		(isset($config['ABBC3_VIDEO_width']))		? $config['ABBC3_VIDEO_width']		: 425),
			array('ABBC3_VIDEO_height',		(isset($config['ABBC3_VIDEO_height']))		? $config['ABBC3_VIDEO_height']		: 350),
			array('ABBC3_COLOR_MODE',		(isset($config['ABBC3_COLOR_MODE']))		? $config['ABBC3_COLOR_MODE']		: 'phpbb'),
			array('ABBC3_HIGHLIGHT_MODE',	(isset($config['ABBC3_HIGHLIGHT_MODE']))	? $config['ABBC3_HIGHLIGHT_MODE']	: 'dropdown'),
			array('ABBC3_WIZARD_MODE',		(isset($config['ABBC3_WIZARD_MODE']))		? $config['ABBC3_WIZARD_MODE']		: 1),
			array('ABBC3_WIZARD_width',		(isset($config['ABBC3_WIZARD_width']))		? $config['ABBC3_WIZARD_width']		: 700),
			array('ABBC3_WIZARD_height',	(isset($config['ABBC3_WIZARD_height']))		? $config['ABBC3_WIZARD_height']	: 400),
			array('ABBC3_UCP_MODE',			(isset($config['ABBC3_UCP_MODE']))			? $config['ABBC3_UCP_MODE']			: 1),
			array('ABBC3_VIDEO_OPTIONS',	(isset($config['ABBC3_VIDEO_OPTIONS']))		? $config['ABBC3_VIDEO_OPTIONS']	: '1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20;21;22;23;24;25;26;27;28;29;30;31;32;33;34;35;36;37;38;39;40;41;42;43;44;45;201;202;203;204;205;206;207;208;'),
		),

		// Lets change the max font size
		'config_update'	=> array(
			array('max_post_font_size', 	300),
		),

		// Change the following columns
		'table_column_update' => array(
			array('phpbb_bbcodes', 'bbcode_id',			array('INT:4', 0)),
		),

		// Add the following columns
		'table_column_add' => array(
			array('phpbb_bbcodes', 'display_on_pm',		array('TINT:1',	1)),
			array('phpbb_bbcodes', 'display_on_sig',	array('TINT:1',	1)),
			array('phpbb_bbcodes', 'abbcode',			array('TINT:1',	0)),
			array('phpbb_bbcodes', 'bbcode_image',		array('VCHAR',	'')),
			array('phpbb_bbcodes', 'bbcode_order',		array('USINT',	0)),
			array('phpbb_bbcodes', 'bbcode_group',		array('VCHAR',	'0')),
			array('phpbb_users', 'user_abbcode_mod',	 array('TINT:1', 1)),
			array('phpbb_users', 'user_abbcode_compact', array('TINT:1', 0)),
		),

		// Add indexes
		'table_index_add' => array(
			array('phpbb_bbcodes', 'display_order',		'bbcode_order'),
		),

		/**
		* If we are uninstalling, need to delete bbcodes after the table_column_remove remove the 'abbcode' column
		* during uninstall this list is reversed
		**/
		'custom' => 'abbc3_bbcodes_uninstall',

		// Add table
		'table_add'	=> array(
			array('phpbb_clicks', array(
				'COLUMNS'		=> array(
					'id'		=> array('UINT',		NULL,	'auto_increment'),
					'url'		=> array('VCHAR:255',	''),
					'clicks'	=> array('UINT',		0),
				),
				'PRIMARY_KEY'	=> 'id',
				'KEYS'			=> array(
					'md5'		=> array('INDEX',		array('url')),
					),
				),
			),
		),

		/**
		* After all add/update bbcodes 
		**/
		'custom' => 'abbc3_end',
	),

);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

// clear cache
$cache->destroy('sql', BBCODES_TABLE);
$cache->destroy('config');
$umil->cache_purge(array(
	'', 0,
	array('template', 0),
));

/**
* Display a message with a specified css class
*
* @param string		$lang_string	The language string to display
* @param string		$class			The css class to apply
* @return string					Formated html code
**/
function display_message($lang_string, $class)
{
	global $user;
	return '<span class="' . $class . '">' . $user->lang[$lang_string] . '</span>';
}

/**
* Remove ABBC3 bbcodes when uninstall
*
* @param string		$action
* @param string		$version
**/
function abbc3_bbcodes_uninstall($action, $version)
{
	if ($action == 'uninstall')
	{
		abbc3_remove_bbcodes();
	}
	/**
	* Return a string
	* 	The string will be shown as the action performed (command).  It will show any SQL errors as a failure, otherwise success
	**/
	return 'INSTALLER_BBCODES_ADD';
}

/**
* Remove some deprecated config variables
*
*/
function abbc3_clear_config()
{
	global $umil;

	// tracking different version 
	$config_data = array(			//Create	Deprecated
		'ABBC3_GREYBOX',			// v1.0.9	v1.0.10
		'ABBC3_JAVASCRIPT',			// v1.0.10	v1.0.11
	//	'ABBC3_RESIZE_SIGNATURE',	// v1.0.11
	//	'ABBC3_RESIZE_BAR',			// v1.0.12
	//	'ABBC3_MAX_SIG_WIDTH',		// v1.0.12
	//	'ABBC3_MAX_SIG_HEIGHT',		// v1.0.12
	//	'ABBC3_VERSION'				// v3.0.6
		'ABBC3_UPLOAD_MAX_SIZE',	// v1.0.9	v3.0.7
		'ABBC3_UPLOAD_EXTENSION',	// v1.0.9	v3.0.7
	);

	foreach ($config_data as $config_name)
	{
		if ($umil->config_exists($config_name))
		{
			$umil->config_remove($config_name);
		}
	}
}

/**
* Check some deprecated bbcodes
*
* @return int		$num_updates	amount of changes
*/
function abbc3_clear_bbcodes()
{
	global $db, $config;

	// tracking different version 
	$bbcodes_data = array(			//Create	Deprecated
		'upload', 					// v1.0.9	v3.0.7
		'html',						// v1.0.10	v1.0.11
	);

	$num_updates = 0;
	foreach ($bbcodes_data as $bbcode_name)
	{
		// Check if exist
		$sql = 'SELECT * 
				FROM ' . BBCODES_TABLE . "
				WHERE LOWER(bbcode_tag) = '" . $db->sql_escape(strtolower($bbcode_name)) . "'";
		$result = $db->sql_query($sql);
		$row_exist = $db->sql_fetchrow($result);

		if ($row_exist)
		{
			$result = $sql = 'DELETE FROM ' . BBCODES_TABLE . " WHERE LOWER(bbcode_tag) = '" . $db->sql_escape(strtolower($bbcode_name)) . "'";
			$db->sql_query($sql);

			if ($result)
			{
				$num_updates++;
			}
		}
		$db->sql_freeresult($result);
	}
	return $num_updates;
}

/**
* If we are installing or updating, do some bbcodes tasks
*
* @param string		$action
* @param string		$version
**/
function abbc3_end($action, $version)
{
	if ($action == 'install' || $action == 'update')
	{
		abbc3_clear_config(); //Remove deprecated configs from previous ABBC3 installations
		abbc3_clear_bbcodes(); // remove deprecated bbcodes from previous ABBC3 installations
		abbc3_add_bbcodes();
		abbc3_sync_bbcodes();
	}
	/**
	* Return a string
	* 	The string will be shown as the action performed (command).  It will show any SQL errors as a failure, otherwise success
	**/
	return 'INSTALLER_INSTALL_END';
}

/**
* Remove ABBC3 bbcodes from the bbcodes table
*
**/
function abbc3_remove_bbcodes()
{
	global $db, $template, $user;

	$sql = 'DELETE FROM ' . BBCODES_TABLE . '
		WHERE abbcode = 1';
	$result = $db->sql_query($sql);

	$template->assign_block_vars('results', array(
		'COMMAND'	=> $user->lang['INSTALLER_BBCODES_ADD'],
		'RESULT'	=> $user->lang['LINE_ADDED'],
		'S_SUCCESS'	=> ($result) ? true : false,
	));
}

/**
* Add ABBC3 bbcodes to the bbcodes table
*
**/
function abbc3_add_bbcodes()
{
	global $db, $template, $user;

	$first_bbode_id = 0;
	// Get last bbcode id - Start
	$sql = 'SELECT MAX(bbcode_id) as max_bbcode_id
		FROM ' . BBCODES_TABLE;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	if ($row)
	{
		$next_bbcode_id = $row['max_bbcode_id'];

		// Make sure it is greater than the core bbcode ids...
		if ($next_bbcode_id <= NUM_CORE_BBCODES)
		{
			$next_bbcode_id = NUM_CORE_BBCODES;
		}
	}
	else
	{
		$next_bbcode_id = NUM_CORE_BBCODES;
	}

	if ($next_bbcode_id > 1511)
	{
		trigger_error($user->lang['TOO_MANY_BBCODES']);
	}
	// Get last bbcode id - End

	$bbcode_data	= get_abbc3_bbcodes();
	$num_updates	= 1;
	foreach ($bbcode_data as $bbcode_name => $bbcode_values)
	{
		if ($bbcode_values[2])
		{
			$next_bbcode_id++;
		}
		else
		{
			$first_bbode_id--;
		}

		$sql_ary = array(
			'bbcode_tag'			=> $bbcode_values[0],
			'bbcode_order'			=> $bbcode_values[1],
			'bbcode_helpline'		=> $bbcode_values[3],
			'bbcode_match'			=> $bbcode_values[4],
			'bbcode_tpl'			=> $bbcode_values[5],
			'first_pass_match'		=> $bbcode_values[6],
			'first_pass_replace'	=> $bbcode_values[7],
			'second_pass_match'		=> $bbcode_values[8],
			'second_pass_replace'	=> $bbcode_values[9],
			'display_on_posting'	=> $bbcode_values[10],
			'display_on_pm'			=> $bbcode_values[11],
			'display_on_sig'		=> $bbcode_values[12],
			'abbcode'				=> $bbcode_values[13],
			'bbcode_image'			=> $bbcode_values[14],
			'bbcode_group'			=> (isset($bbcode_values[15]) ? $bbcode_values[15] : 0),
		);
		$msg = sprintf($user->lang['STEP_PERCENT_COMPLETED'], $num_updates, sizeof($bbcode_data)) . ' ::  &raquo; [' . $bbcode_name . '] ';

		// Check if exist
		$sql = 'SELECT * 
				FROM ' . BBCODES_TABLE . "
				WHERE LOWER(bbcode_tag) = '" . $db->sql_escape(strtolower($sql_ary['bbcode_tag'])) . "'";
		$result = $db->sql_query($sql);
		$row_exist = $db->sql_fetchrow($result);

		// if exist, check if it was updated
		if ($row_exist)
		{
			$result = $bbcode_id = $row_exist['bbcode_id'];
			$sql_ary = array(
				'bbcode_helpline'		=> $bbcode_values[3],
				'bbcode_match'			=> $bbcode_values[4],
				'bbcode_tpl'			=> $bbcode_values[5],
				'first_pass_match'		=> $bbcode_values[6],
				'first_pass_replace'	=> $bbcode_values[7],
				'second_pass_match'		=> $bbcode_values[8],
				'second_pass_replace'	=> $bbcode_values[9],
				'abbcode'				=> ($bbcode_values[13]) ? 1 : 0, // Should be allways true, except for [center]
			);

			// Check for any column if it was updated
			$update = false;
			foreach ($sql_ary as $bbcode_tag => $bbcode_data)
			{
				if ((string) $bbcode_data !== (string) $row_exist[$bbcode_tag])
				{
					$update = true;
					break;
				}
			}

			// if any bbcode data is different, overwrite it, but preserve some bbcode data
			if ($update)
			{
				($row_exist['bbcode_order'] !== $bbcode_values[1]) ? $sql_ary['bbcode_order'] = $bbcode_values[1] : true;
				($row_exist['display_on_posting'] !== $bbcode_values[10]) ? $sql_ary['display_on_posting'] = $bbcode_values[10] : true;
				($row_exist['display_on_pm'] !== $bbcode_values[11]) ? $sql_ary['display_on_pm'] = $bbcode_values[11] : true;
				($row_exist['display_on_sig'] !== $bbcode_values[12]) ? $sql_ary['display_on_sig'] = $bbcode_values[12] : true;
				($row_exist['bbcode_image'] !== $bbcode_values[14]) ? $sql_ary['bbcode_image'] = $bbcode_values[14] : true;
				(isset($bbcode_values[15]) && $row_exist['bbcode_group'] !== $bbcode_values[15]) ? $sql_ary['bbcode_group'] = $bbcode_values[15] : true;

				$db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE bbcode_id = ' . $bbcode_id);

				$template->assign_block_vars('results', array(
					'COMMAND'	=> $user->lang['INSTALLER_BBCODES_ADD'],
					'RESULT'	=> $msg . $user->lang['LINE_MODIFIED'],
					'S_SUCCESS'	=> ($result) ? true : false,
				));
			}
		}
		// else add it
		else
		{
			$sql_ary['bbcode_id'] = ($bbcode_values[2]) ? $next_bbcode_id : $first_bbode_id;

			$result = $db->sql_query('INSERT INTO ' . BBCODES_TABLE . $db->sql_build_array('INSERT', $sql_ary));

			$template->assign_block_vars('results', array(
				'COMMAND'	=> $user->lang['INSTALLER_BBCODES_ADD'],
				'RESULT'	=> $msg . $user->lang['LINE_ADDED'],
				'S_SUCCESS'	=> ($result) ? true : false,
			));
		}
		$db->sql_freeresult($result);
	}
}

/**
* Synchronise bbcode order
*
**/
function abbc3_sync_bbcodes()
{
	global $db, $template, $user;

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

	$template->assign_block_vars('results', array(
		'COMMAND'	=> $user->lang['INSTALLER_BBCODES_ADD'],
		'RESULT'	=> $user->lang['ABBCODES_RESYNC_SUCCESS'],
		'S_SUCCESS'	=> true,
	));
}

/**
* Enter description here...
*
* @return array		$bbcode_data	all bbcodes	to add
**/
function get_abbc3_bbcodes()
{
	return $bbcode_data = array(
//	                             'bbcode_tag', 'bbcode_order', 'bbcode_id', 'bbcode_helpline', 'bbcode_match', 'bbcode_tpl', 'first_pass_match', 'first_pass_replace', 'second_pass_match', 'second_pass_replace', 'display_on_posting', 'display_on_pm', 'display_on_sig', 'abbcode', 'bbcode_image', 'bbcode_group'; 
		'font'			=> array("font=",			 1,	1,	"ABBC3_FONT_TIP",		 "[font={TEXT1}]{TEXT2}[/font]", "<span style=\"font-family: {TEXT1};\">{TEXT2}</span>", "!\[font\=([a-zA-Z0-9-_ ]+)\](.*?)\[/font\]!ies", '\'[font=\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\':$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/font:$uid]\'', '!\[font\=([a-zA-Z0-9-_ ]+):$uid\](.*?)\[/font:$uid\]!s', '<span style="font-family: ${1};">${2}</span>', 1, 1, 1, 1, " ") ,
		'size'			=> array("size",			 2,	0,	"ABBC3_SIZE_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, " ") ,
		'highlight'		=> array("highlight=",		 3, 1,	"ABBC3_HIGHLIGHT_TIP",	 "[highlight={COLOR}]{TEXT}[/highlight]", "<span style=\"background-color: {COLOR};\">{TEXT}</span>", "!\[highlight=([a-z]+|#[0-9abcdef]+)\](.*?)\[/highlight\]!ies", '\'[highlight=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/highlight:$uid]\'', '!\[highlight\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/highlight:$uid\]!s', '<span style="background-color: ${1};">${2}</span>', 1, 1, 1, 1, " "),
		'color'			=> array("color",			 4,	0,	"ABBC3_COLOR_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, " "),
		'break1'		=> array("break1",			 5,	0,	"ABBC3_BREAK",			 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "spacer.gif"),
		'cut'			=> array("cut",				 6, 0,	"ABBC3_CUT_MOVER",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "cut.gif"),
		'copy'			=> array("copy",			 7,	0,	"ABBC3_COPY_MOVER",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "copy.gif"),
		'paste'			=> array("paste",			 8,	0,	"ABBC3_PASTE_MOVER",	 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "paste.gif"),
		'plain'			=> array("plain",			 9,	0,	"ABBC3_PLAIN_MOVER",	 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "plain.gif"),
		'division1'		=> array("division1",		10,	0,	"ABBC3_DIVISION",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "dots.gif"),
		'listb'			=> array("listb",			11,	0,	"ABBC3_LISTB_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "listb.gif"),
		'listo'			=> array("listo",			12,	0,	"ABBC3_LISTO_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "listo.gif"),
		'listitem'		=> array("listitem",		13,	0,	"ABBC3_LISTITEM_TIP",	 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "listitem.gif"),
		'tabs'			=> array("tabs",			14, 1,	"ABBC3_TABS",			 "[tabs]{TEXT}[/tabs]", "", "!\[tabs\](.*?)\[/tabs\]!ies", '\'[tabs:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/tabs:$uid]\'', '!\[tabs:$uid\](.*?)\[/tabs:$uid\]!ies', '$this->simpleTabs_pass(\'$1\')', 1, 1, 0, 1, "tabs.gif"),
		'hr'			=> array("hr",				15, 1,	"ABBC3_HR_TIP",			 "[hr]", "<hr class=\"hrabbc3\" />", "!\[hr\]!ies", '\'[hr:$uid]\'', '!\[hr:$uid\]!s', '<hr class="hrabbc3" />', 1, 1, 1, 1, "hr.gif"),
		'b'				=> array("b",				16,	0,	"ABBC3_B_TIP",			 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "bold.gif"),
		'i'				=> array("i",				17,	0,	"ABBC3_I_TIP",			 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "italic.gif"),
		'u'				=> array("u",				18,	0,	"ABBC3_U_TIP",			 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "under.gif"),
		's'				=> array("s",				19, 1,	"ABBC3_STRIKE_TIP",		 "[s]{TEXT}[/s]", "<span style=\"text-decoration: line-through;\">{TEXT}</span>", "!\[s\](.*?)\[/s\]!ies", '\'[s:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/s:$uid]\'', '!\[s:$uid\](.*?)\[/s:$uid\]!s', '<span style="text-decoration: line-through;">${1}</span>', 1, 1, 1, 1, "strike.gif"),
		'sup'			=> array("sup",				20, 1,	"ABBC3_SUP_TIP",		 "[sup]{TEXT}[/sup]", "<sup>{TEXT}</sup>", "!\[sup\](.*?)\[/sup\]!ies", '\'[sup:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/sup:$uid]\'', '!\[sup:$uid\](.*?)\[/sup:$uid\]!s', '<sup>${1}</sup>', 1, 1, 1, 1, "sup.gif"),
		'sub'			=> array("sub",				21, 1,	"ABBC3_SUB_TIP",		 "[sub]{TEXT}[/sub]", "<sub>{TEXT}</sub>", "!\[sub\](.*?)\[/sub\]!ies", '\'[sub:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/sub:$uid]\'', '!\[sub:$uid\](.*?)\[/sub:$uid\]!s', '<sub>${1}</sub>', 1, 1, 1, 1, "sub.gif"),
		'glow'			=> array("glow=",			22, 1,	"ABBC3_GLOW_TIP",		 "[glow={COLOR}]{TEXT}[/glow]", "<div style=\"filter:Glow(color={COLOR},strength=4);color:#ffffff;height:110%\">{TEXT}</div>", "!\[glow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/glow\]!ies", '\'[glow=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/glow:$uid]\'', '!\[glow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/glow:$uid\]!ies', '$this->Text_effect_pass(\'glow\', \'$1\', \'$2\')', 0, 0, 0, 1, "glow.gif"),
		'shadow'		=> array("shadow=",			23, 1,	"ABBC3_SHADOW_TIP",		 "[shadow={COLOR}]{TEXT}[/shadow]", "<div style=\"filter:shadow(color=black,strength=4);color:{COLOR};height:110%\">{TEXT}</div>", "!\[shadow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/shadow\]!ies", '\'[shadow=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/shadow:$uid]\'', '!\[shadow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/shadow:$uid\]!ies', '$this->Text_effect_pass(\'shadow\', \'$1\', \'$2\')', 0, 0, 0, 1, "shadow.gif"),
		'dropshadow'	=> array("dropshadow=",		24, 1,	"ABBC3_DROPSHADOW_TIP",	 "[dropshadow={COLOR}]{TEXT}[/dropshadow]", "<div style=\"filter:dropshadow(color=#999999,strength=4);color:{COLOR};height:110%\">{TEXT}</div>", "!\[dropshadow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/dropshadow\]!ies", '\'[dropshadow=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/dropshadow:$uid]\'', '!\[dropshadow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/dropshadow:$uid\]!ies', '$this->Text_effect_pass(\'dropshadow\', \'$1\', \'$2\')', 0, 0, 0, 1, "dropshadow.gif"),
		'blur'			=> array("blur=",			25, 1,	"ABBC3_BLUR_TIP",		 "[blur={COLOR}]{TEXT}[/blur]", "<div style=\"filter:Blur(strength=7);color:{COLOR};height:110%\">{TEXT}</div>", "!\[blur\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/blur\]!ies", '\'[blur=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/blur:$uid]\'', '!\[blur\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/blur:$uid\]!ies', '$this->Text_effect_pass(\'blur\', \'$1\', \'$2\')', 0, 0, 0, 1, "blur.gif"),
		'wave'			=> array("wave=",			26, 1,	"ABBC3_WAVE_TIP",		 "[wave={COLOR}]{TEXT}[/wave]", "<div style=\"filter:Wave(strength=2);color:{COLOR};height:110%\">{TEXT}</div>", "!\[wave\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/wave\]!ies", '\'[wave=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/wave:$uid]\'', '!\[wave\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/wave:$uid\]!ies', '$this->Text_effect_pass(\'wave\', \'$1\', \'$2\')', 0, 0, 0, 1, "wave.gif"),
		'fade'			=> array("fade",			27, 1,	"ABBC3_FADE_TIP",		 "[fade]{TEXT}[/fade]", "<div class=\"fade_link\">{TEXT}</div> <script type=\"text/javascript\">fade_ontimer();</script>", "!\[fade\](.*?)\[/fade\]!ies", '\'[fade:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/fade:$uid]\'', '!\[fade:$uid\](.*?)\[/fade:$uid\]!s', '<div class="fade_link">${1}</div> <script type="text/javascript">fade_ontimer();</script>', 1, 1, 1, 1, "fade.gif"),
		'grad'			=> array("grad",			28,	0,	"ABBC3_GRAD_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "grad.gif"),
		'division2'		=> array("division2",		29,	0,	"ABBC3_DIVISION",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "dots.gif"),
		'align justify'	=> array("align=justify",	30, 1,	"ABBC3_JUSTIFY_TIP",	 "[align=justify]{TEXT}[/align]", "<span style=\"text-align: justify; display: block;\">{TEXT}</span>", "!\[align\=justify\](.*?)\[/align\]!ies", '\'[align=justify:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/align:$uid]\'', '!\[align\=justify:$uid\](.*?)\[/align:$uid\]!s', '<span style="text-align: justify; display: block;">${1}</span>', 1, 1, 1, 1, "justify.gif"),
		'align left'	=> array("align=left"	,	31, 1,	"ABBC3_LEFT_TIP",		 "[align=left]{TEXT}[/align]", "<span style=\"text-align: left; display: block;\">{TEXT}</span>", "!\[align\=left\](.*?)\[/align\]!ies", '\'[align=left:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/align:$uid]\'', '!\[align\=left:$uid\](.*?)\[/align:$uid\]!s', '<span style="text-align: left; display: block;">${1}</span>', 1, 1, 1, 1, "left.gif"),
		'align center'	=> array("align=center",	32, 1,	"ABBC3_CENTER_TIP",		 "[align=center]{TEXT}[/align]", "<span style=\"text-align: center; display: block;\">{TEXT}</span>", "!\[align\=center\](.*?)\[/align\]!ies", '\'[align=center:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/align:$uid]\'', '!\[align\=center:$uid\](.*?)\[/align:$uid\]!s', '<span style="text-align: center; display: block;">${1}</span>', 1, 1, 1, 1, "center.gif"),
		'center'		=> array("center",			33, 1,	"[center]your text here[/center]", "[center]{TEXT}[/center]", "<center>{TEXT}</center>", "!\[center\](.*?)\[/center\]!ies", '\'[center:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/center:$uid]\'', '!\[center:$uid\](.*?)\[/center:$uid\]!s', '<center>${1}</center>', 0, 0, 0, 0, " "),
		'align right'	=> array("align=right",		34, 1,	"ABBC3_RIGHT_TIP",		 "[align=right]{TEXT}[/align]", "<span style=\"text-align: right; display: block;\">{TEXT}</span>", "!\[align\=right\](.*?)\[/align\]!ies", '\'[align=right:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/align:$uid]\'', '!\[align\=right:$uid\](.*?)\[/align:$uid\]!s', '<span style="text-align: right; display: block;">${1}</span>', 1, 1, 1, 1, "right.gif"),
		'pre'			=> array("pre",				35, 1,	"ABBC3_PRE_TIP",		 "[pre]{TEXT}[/pre]", "<pre>{TEXT}</pre>", "!\[pre\](.*?)\[/pre\]!ies", '\'[pre:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/pre:$uid]\'', '!\[pre:$uid\](.*?)\[/pre:$uid\]!s', '<pre>${1}</pre>', 1, 1, 1, 1, "preformat.gif"),
		'break2'		=> array("break2",			36,	0,	"ABBC3_BREAK",			 ".", ".", ".", ".", ".", ".", 0, 0, 0, 1, "spacer.gif"),
		'tab'			=> array("tab=",			37, 1,	"ABBC3_TAB_TIP",		 "[tab={NUMBER}]", "<span style=\"margin-left:{NUMBER}px;\"></span>", "!\[tab=([0-9]?[0-9]?[0-9])\]!ies", '\'[tab=${1}:$uid]\'', '!\[tab\\=([0-9]?[0-9]?[0-9]):$uid\]!s', '<span style="margin-left: ${1}px;"></span>', 1, 1, 1, 1, "tab.gif"),
		'dir ltr'		=> array("dir=ltr",			38, 1,	"ABBC3_LTR_TIP",		 "[dir=ltr]{TEXT}[/dir]", "<BDO dir=\"ltr\">{TEXT}</BDO>", "!\[dir\=ltr\](.*?)\[/dir\]!ies", '\'[dir=ltr:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/dir:$uid]\'', '!\[dir\=ltr:$uid\](.*?)\[/dir:$uid\]!s', '<bdo dir="ltr">${1}</bdo>', 1, 1, 1, 1, "ltr.gif"),
		'dir rtl'		=> array("dir=rtl",			39, 1,	"ABBC3_RTL_TIP",		 "[dir=rtl]{TEXT}[/dir]", "<BDO dir=\"rtl\">{TEXT}</BDO>", "!\[dir\=rtl\](.*?)\[/dir\]!ies", '\'[dir=rtl:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/dir:$uid]\'', '!\[dir\=rtl:$uid\](.*?)\[/dir:$uid\]!s', '<bdo dir="rtl">${1}</bdo>', 1, 1, 1, 1, "rtl.gif"),
		'marq up'		=> array("marq=up",			40, 1,	"ABBC3_MARQU_TIP",		 "[marq=up]{TEXT}[/marq]", "<marquee direction=\"up\" scrolldelay=\"100\" onmouseover=\"this.scrollDelay=10000000\" onmouseout=\"this.scrollDelay=100\">{TEXT}</marquee>", "!\[marq\=up\](.*?)\[/marq\]!ies", '\'[marq=up:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/marq:$uid]\'', '!\[marq\=up:$uid\](.*?)\[/marq:$uid\]!s', '<marquee direction="up" scrolldelay="100" onmouseover="this.scrollDelay=10000000" onmouseout="this.scrollDelay=100">${1}</marquee>', 1, 1, 1, 1, "marqu.gif"),
		'marq down'		=> array("marq=down",		41, 1,	"ABBC3_MARQD_TIP",		 "[marq=down]{TEXT}[/marq]", "<marquee direction=\"down\" scrolldelay=\"100\" onmouseover=\"this.scrollDelay=10000000\" onmouseout=\"this.scrollDelay=100\">{TEXT}</marquee>", "!\[marq\=down\](.*?)\[/marq\]!ies", '\'[marq=down:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/marq:$uid]\'', '!\[marq\=down:$uid\](.*?)\[/marq:$uid\]!s', '<marquee direction="down" scrolldelay="100" onmouseover="this.scrollDelay=10000000" onmouseout="this.scrollDelay=100">${1}</marquee>', 1, 1, 1, 1, "marqd.gif"),
		'marq left'		=> array("marq=left",		42, 1,	"ABBC3_MARQL_TIP",		 "[marq=left]{TEXT}[/marq]", "<marquee direction=\"left\" scrolldelay=\"100\" onmouseover=\"this.scrollDelay=10000000\" onmouseout=\"this.scrollDelay=100\">{TEXT}</marquee>", "!\[marq\=left\](.*?)\[/marq\]!ies", '\'[marq=left:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/marq:$uid]\'', '!\[marq\=left:$uid\](.*?)\[/marq:$uid\]!s', '<marquee direction="left" scrolldelay="100" onmouseover="this.scrollDelay=10000000" onmouseout="this.scrollDelay=100">${1}</marquee>', 1, 1, 1, 1, "marql.gif"),
		'marq right'	=> array("marq=right",		43, 1,	"ABBC3_MARQR_TIP",		 "[marq=right]{TEXT}[/marq]", "<marquee direction=\"right\" scrolldelay=\"100\" onmouseover=\"this.scrollDelay=10000000\" onmouseout=\"this.scrollDelay=100\">{TEXT}</marquee>", "!\[marq\=right\](.*?)\[/marq\]!ies", '\'[marq=right:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/marq:$uid]\'', '!\[marq\=right:$uid\](.*?)\[/marq:$uid\]!s', '<marquee direction="right" scrolldelay="100" onmouseover="this.scrollDelay=10000000" onmouseout="this.scrollDelay=100">${1}</marquee>', 1, 1, 1, 1, "marqr.gif"),
		'code'			=> array("code",			44,	0,	"ABBC3_CODE_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "code.gif"),
		'quote'			=> array("quote",			45,	0,	"ABBC3_QUOTE_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "quote.gif"),
		'spoil'			=> array("spoil",			46, 1,	"ABBC3_SPOIL_TIP",		 "[spoil]{TEXT}[/spoil]", '<div class=\"spoilwrapper\"><div class=\"spoiltitle\"><input id=\"0"\class=\"btnspoil button2\" type=\"button\" value=\"{L_SPOILER_SHOW}\"></div><div class="spoilcontent"><div id=\"1\" style=\"display: none;\">{TEXT}</div></div></div>', "!\[spoil\](.*?)\[/spoil\]!ies", '\'[spoil:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/spoil:$uid]\'', '!\[spoil:$uid\](.*?)\[/spoil:$uid\]!ies', '$this->spoil_pass(\'$1\')', 1, 1, 1, 1, "spoil.gif"),
		'hidden'		=> array("hidden",			47, 1,  "ABBC3_HIDDEN_TIP", 	 "[hidden]{TEXT}[/hidden]", '<div class=\"hiddenbox\"><span class=\"hidden\">{L_MESSAGE_HIDDEN}:</span><div class=\"hiddentext\">{TEXT}</div></div>', "!\[hidden\](.*?)\[/hidden\]!ies", '\'[hidden:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/hidden:$uid]\'', '!\[hidden:$uid\](.*?)\[/hidden:$uid\]!ies', '$this->hidden_pass(\'$1\')', 1, 1, 1, 1, "hidden.gif"),
		'mod'			=> array("mod=",			48, 1,	"ABBC3_MODERATOR_TIP",	 "[mod={TEXT1}]{TEXT2}[/mod]", "<table class=\"ModTable\" width=\"100%\" cellspacing=\"5\" cellpadding=\"0\" border=\"0\"><tr><td class=\"exclamation\" rowspan=\"2\">&nbsp;!&nbsp;</td><td class=\"rowuser\">{TEXT1}:</td></tr><tr><td class=\"rowtext\">{TEXT2}</td></tr></table>", "!\[mod\=(.*?)\](.*?)\[/mod\]!ies", '\'[mod=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/mod:$uid]\'', '!\[mod\=(.*?):$uid\](.*?)\[/mod:$uid\]!ies', '$this->moderator_pass(\'$1\', \'$2\')', 1, 1, 1, 1, "moderator.gif", "5, 4"),
		'offtopic'		=> array("offtopic",		49, 1,	"ABBC3_OFFTOPIC",		 "[offtopic]{TEXT}[/offtopic]", "<div class=\"OffTopic\"><div class=\"OffTopicTitle\">{L_OFFTOPIC} :</div><div class=\"OffTopicText\">{TEXT}</div></div>", "!\[offtopic\](.*?)\[/offtopic\]!ies", '\'[offtopic:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/offtopic:$uid]\'', '!\[offtopic:$uid\](.*?)\[/offtopic:$uid\]!ies', '$this->offtopic_pass(\'$1\')', 1, 1, 1, 1, "offtopic.gif"),
		'nfo'			=> array("nfo",				50, 1,	"ABBC3_NFO_TIP",		 "[nfo]{TEXT}[/nfo]", "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" ><tr><td><span class=\"genmed\"><b>NFO:</b></span></td></tr><tr><td class=\"nfo\">{TEXT}</td></tr></table>", "!\[nfo\](.*?)\[/nfo\]!ies", '\'[nfo:$uid]${1}[/nfo:$uid]\'', '!\[nfo:$uid\](.*?)\[/nfo:$uid\]!ies', '$this->nfo_pass(\'$1\')', 1, 1, 1, 1, "nfo.gif"),
		'table'			=> array("table=",			51, 1,	"ABBC3_TABLE_TIP",		 "[table={TEXT1}]{TEXT2}[/table]", "<table style=\"{TEXT1}\" cellspacing=\"0\" cellpadding=\"0\">{TEXT2}</table>", "!\[table\=(.*?)\](.*?)\[/table\]!ies", '\'[table=\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \':$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/table:$uid]\'', '!\[table\=(.*?):$uid\](.*?)\[/table:$uid\]!ies', '$this->table_pass(\'$1\', \'$2\')', 1, 1, 1, 1, "table.gif"),
		'division3'		=> array("division3",		52,	0,	"ABBC3_DIVISION",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "dots.gif"),
		'anchor'		=> array("anchor=",			53,	1,	"ABBC3_ANCHOR",			 "[anchor{TEXT1}]{TEXT2}[/anchor]", "<a id=\"{TEXT1}\">{TEXT2}</a>", "!\[anchor\=(.*?)(\s+|)?(.*?)\](.*?)\[/anchor\]!ies", '\'[anchor=${1}${2}${3}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${4}\')).\'[/anchor:$uid]\'', '!\[anchor\=(.*?)((\s+)(goto\=|)?(.*?))?:$uid\](.*?)\[/anchor:$uid\]!ies', '$this->anchor_pass(\'$1\',\'$5\', \'$6\')', 1, 1, 1, 1, "anchor.gif"),
		'url'			=> array("url",				54,	0,	"ABBC3_URL_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "url.gif"),
		'email'			=> array("email",			55,	0,	"ABBC3_EMAIL_TIP",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "email.gif"),
		'web'			=> array("web",				56, 1,	"ABBC3_WEB_TIP",		 "[web{TEXT}]{URL}[/web]", "<a src=\"{URL}\">{TEXT}</a>", "!\[web(=| )?(.*?)\](.*?)\[/web\]!ies", '\'[web${1}${2}:$uid]\'.(!preg_match(\'#^[a-z][a-z\d+\-.]*:/{2}#i\', trim(\'${3}\')) ? \'http://${3}\' : \'${3}\').\'[/web:$uid]\'', '!\[web((=| )?(width=)?([0-9]?[0-9]?[0-9][(%|\w+)?])(,| )(height=)?([0-9]?[0-9]?[0-9][(%|\w+)?]))?:$uid\](.*?)\[/web:$uid\]!s', '<iframe width="${4}" height="${7}" src="${8}" security="restricted" style="font-size: 2px;"></iframe>', 0, 0, 0, 1, "web.gif"),
		'ed2k'			=> array("url=",			57,	0,	"ABBC3_ED2K_TIP",		 ".", ".", ".", ".",".", ".", 1, 1, 0, 1, "emule.gif"),
		'img'			=> array("img=",			58, 1,	"ABBC3_IMG_TIP",		 "[img{TEXT}]{URL}[/img]", "<img src=\"{URL}\" alt=\"{L_IMAGE}\" />", "!\[img\\=(left|center|right|float-left|float-center|float-right)?\](.*?)\[/img\]!ies", '\'[img=${1}:$uid]${2}[/img:$uid]\'', '!\[img\\=(left|center|right|float-left|float-center|float-right)?:$uid\](.*?)\[/img:$uid\]!ies', '$this->img_pass(\'$1\',\'$2\')', 1, 1, 1, 1, "img.gif"),
		'thumbnail'		=> array("thumbnail",		59, 1,	"ABBC3_THUMBNAIL_TIP",	 "[thumbnail{TEXT}]{URL}[/thumbnail]", "<img src=\"{URL}\" border=\"0\" align=\"{TEXT}\"/>", "!\[thumbnail(\\=| )?(left|center|right|float-left|float-center|float-right)?\](.*?)\[/thumbnail\]!ies", '\'[thumbnail${1}${2}:$uid]${3}[/thumbnail:$uid]\'', '!\[thumbnail(\\=| )?(left|center|right|float-left|float-center|float-right)?:$uid\](.*?)\[/thumbnail:$uid\]!ies', '$this->thumb_pass(\'$2\',\'$3\')', 1, 1, 1, 1, "thumb.gif"),
		'imgshack'		=> array("imgshack",		60,	0,	"ABBC3_IMGSHACK_MOVER",	 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "imgshack.gif"),
		'rapidshare'	=> array("rapidshare",		61, 1,	"ABBC3_RAPIDSHARE_TIP",	 "[rapidshare]{URL}[/rapidshare]", "<a src=\"{URL}\">{URL}</a>", "!\[rapidshare\](.*?)\[/rapidshare\]!ies", '\'[rapidshare:$uid]${1}[/rapidshare:$uid]\'', '!\[rapidshare:$uid\](.*?)\[/rapidshare:$uid\]!ies', '$this->rapidshare_pass(\'$1\')', 0, 0, 0, 1, "rapidshare.gif"),
		'testlink'		=> array("testlink",		62, 1,	"ABBC3_TESTLINK_TIP",	 "[testlink]{TEXT}[/testlink]", "<a src=\"{TEXT}\">{TEXT}</a>", "!\[testlink\](.*?)\[/testlink\]!ies", '\'[testlink:$uid]${1}[/testlink:$uid]\'', '!\[testlink:$uid\](.*?)\[/testlink:$uid\]!ies', '$this->testlink_pass(\'$1\')', 0, 0, 0, 1, "testlink.gif"),
		'click'			=> array("click",			63, 1,	"ABBC3_CLICK_TIP",		 "[click{URL}]{URL}[/click]", "<a src=\"{URL}\">{URL}</a>", "!\[click(\\=(.*?))?\](.*?)\[/click\]!ies", '\'[click${1}:$uid]${3}[/click:$uid]\'', '!\[click(\\=(.*?))?:$uid\](.*?)\[/click:$uid\]!ies', '$this->click_pass(\'$2\', \'$3\')', 0, 0, 0, 1, "click.gif"),
		'search'		=> array("search",			64, 1,	"ABBC3_SEARCH_TIP",		 "[search{TEXT1}]{TEXT2}[/search]", "<a src=\"{TEXT1}\">{TEXT2}</a>", "!\[search(\\=(msn|msnlive|yahoo|google|altavista|lycos|wikipedia))?\](.*?)\[/search\]!ies", '\'[search${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${3}\')).\'[/search:$uid]\'', '!\[search(\\=(.*?))?:$uid\](.*?)\[/search:$uid\]!ies', '$this->search_pass(\'$1\', \'$2\', \'$3\')', 1, 1, 1, 1, "search.gif"),
		'division4'		=> array("division4",		65,	0,	"ABBC3_DIVISION",		 ".", ".", ".", ".", ".", ".", 1, 1, 1, 1, "dots.gif"),
		'BBvideo'		=> array("BBvideo",			66, 1,	"ABBC3_BBVIDEO_TIP",	 "[BBvideo{TEXT1}]{TEXT2}[/BBvideo]", "<a src=\"{TEXT1}\">{TEXT2}</a>", "!\[BBvideo(\\=| )?(.*?)\](.*?)\[/BBvideo\]!ies", '\'[BBvideo${1}${2}:$uid]\'.trim(\'${3}\').\'[/BBvideo:$uid]\'', '!\[BBvideo((=| )?(width=)?([0-9]?[0-9]?[0-9])(,| )(height=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/BBvideo:$uid\]!ies', '$this->BBvideo_pass(\'$8\', \'$4\', \'$7\')', 1, 0, 0, 1, "bbvideo.gif"),
		'scrippet'		=> array("scrippet",		67, 1,	"ABBC3_SCRIPPET",		 "[scrippet]{TEXT}[/scrippet]", "<div id=\"scrippet\"><div class=\"scrippet-shadow\"><div class=\"inner-shadow\">{SCRIPPET_TEXT}<br /></div></div></div>", "!\[scrippet\](.*?)\[/scrippet\]!ies", '\'[scrippet:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/scrippet:$uid]\'', '!\[scrippet:$uid\](.*?)\[/scrippet:$uid\]!ies', '$this->scrippets_pass(\'$1\')', 0, 0, 0, 1, "scrippet.gif"),

		'flash'			=> array("flash",			68, 1,	"ABBC3_FLASH_TIP",		 "[flash{TEXT}]{URL}[/flash]", "<a src=\"{URL}\">{TEXT}</a>", "!\[flash(=| )?(.*?)\](.*?)\[/flash\]!ies", '\'[flash${1}${2}:$uid]\'.trim(\'${3}\').\'[/flash:$uid]\'', '!\[flash((=| )?(width=)?([0-9]?[0-9]?[0-9])(,| )(height=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/flash:$uid\]!ies', '$this->flash_pass(\'$4\', \'$7\', \'$8\')', 0, 0, 0, 1, "flash.gif"),
		'flv'			=> array("flv",				69, 1,	"ABBC3_FLV_TIP",		 "[flv{TEXT}]{URL}[/flv]", "<a src=\"{URL}\">{TEXT}</a>", "!\[flv(\\=| )?(.*?)\](.*?)\[/flv\]!ies", '\'[flv${1}${2}:$uid]\'.trim(\'${3}\').\'[/flv:$uid]\'', '!\[flv((=| )?(width=)?([0-9]?[0-9]?[0-9])(,| )(height=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/flv:$uid\]!sie', '$this->auto_embed_video(\'./images/player.swf\', \'${4}\', \'${7}\', \'movie=${8}&fgcolor=0xff0000&autoload=off&volume=70\')', 0, 0, 0, 1, "flashflv.gif"),
		'video'			=> array("video",			70, 1,	"ABBC3_VIDEO_TIP",		 "[video{TEXT}]{URL}[/video]", "<a src=\"{URL}\">{TEXT}</a>", "!\[video(\\=| )?(.*?)\](.*?)\[/video\]!ies", '\'[video${1}${2}:$uid]\'.trim(\'${3}\').\'[/video:$uid]\'', '!\[video((=| )?(width=)?([0-9]?[0-9]?[0-9])(,| )(height=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/video:$uid\]!s', '<object width="${4}" height="${7}" type="video/x-ms-wmv"><param name="filename" value="${8}"><param name="Showcontrols" value="true"><param name="autoStart" value="false"><param name="autostart" value="false" /><param name="showcontrols" value="true" /><param name="showdisplay" value="false" /><param name="showstatusbar" value="false" /><param name="autosize" value="true" /><param name="visible" value="true" /><param name="animationstart" value="false" /><param name="loop" value="false" /><embed type="application/x-mplayer2" src="${8}" width="${4}" height="${7}" controller="true" showcontrols="true" showdisplay="false" showstatusbar="true" autosize="true" autostart="false" visible="true" animationstart="false" loop="false"></embed></object><br />', 0, 0, 0, 1, "video.gif"),
		'stream'		=> array("stream",			71, 1,	"ABBC3_STREAM_TIP",		 "[stream]{URL}[/stream]", "<a src=\"{URL}\">{URL}</a>", "!\[stream\](.*?)\[/stream\]!ies", '\'[stream:$uid]\'.trim(\'${1}\').\'[/stream:$uid]\'', '!\[stream:$uid\](.*?)\[/stream:$uid\]!s', '<object width="320" height="45" type="video/x-ms-wmv"><param name="filename" value="${1}"><param name="Showcontrols" value="true"><param name="autoStart" value="false"><param name="autostart" value="false" /><param name="showcontrols" value="true" /><param name="showdisplay" value="false" /><param name="showstatusbar" value="false" /><param name="autosize" value="true" /><param name="visible" value="true" /><param name="animationstart" value="false" /><param name="loop" value="false" /><embed type="application/x-mplayer2" src="${1}" width="320" height="45" controller="true" showcontrols="true" showdisplay="false" showstatusbar="true" autosize="true" autostart="false" visible="true" animationstart="false" loop="false"></embed></object><br />', 0, 0, 0, 1, "sound.gif"),
		'quicktime'		=> array("quicktime",		72, 1,	"ABBC3_QUICKTIME_TIP",	 "[quicktime{TEXT}]{URL}[/quicktime]", "<a src=\"{URL}\">{TEXT}</a>", "!\[quicktime(\\=| )?(.*?)\](.*?)\[/quicktime\]!ies", '\'[quicktime${1}${2}:$uid]\'.trim(\'${3}\').\'[/quicktime:$uid]\'', '!\[quicktime((=| )?(width=)?([0-9]?[0-9]?[0-9])(,| )(height=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/quicktime:$uid\]!s', '<object width="${4}" height="${7}"><param name="type" value="video/quicktime" /><param name="src" value="${8}" /><param name="controller" value="true" /><param name="autoplay" value="false" /><param name="loop" value="false" /><embed src="${8}" pluginspage="http://www.apple.com/quicktime/download/" enablejavascript="true" controller="true" loop="false" width="${4}" height="${7}" type="video/quicktime" autoplay="false"></embed></object><br />', 0, 0, 0, 1, "quicktime.gif"),
		'ram'			=> array("ram",				73, 1,	"ABBC3_RAM_TIP",		 "[ram{TEXT}]{URL}[/ram]", "<a src=\"{URL}\">{TEXT}</a>", "!\[ram(\\=| )?(.*?)\](.*?)\[/ram\]!ies", '\'[ram${1}${2}:$uid]\'.trim(\'${3}\').\'[/ram:$uid]\'', '!\[ram((=| )?(width=)?([0-9]?[0-9]?[0-9])(,| )(height=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/ram:$uid\]!s', '<object width="${4}" height="${7}" type="audio/x-pn-realaudio-plugin" data="${8}"><param name="src" value="${8}" /><param name="autostart_step" value="false" /><param name="autostart" value="false" /><param name="controls" value="ImageWindow" /><param name="console" value="ctrls_${8}" /><param name="prefetch" value="false" /></object><br /><object type="audio/x-pn-realaudio-plugin" width="${4}" height="36"><param name="controls" value="ControlPanel" /><param name="console" value="ctrls_${8}" /></object><br />', 0, 0, 0, 1, "ram.gif"),
		'gvideo'		=> array("gvideo",			74, 1,	"ABBC3_GVIDEO_TIP",		 "[GVideo]{URL}[/GVideo]", "<a src=\"{URL}\">{URL}</a>", "!\[Gvideo\]http://video.google.(.*?)/videoplay\?docid\=(.*?)\[/Gvideo\]!ies", '\'[Gvideo:$uid]http://video.google.${1}/videoplay?docid=${2}[/Gvideo:$uid]\'', '!\[Gvideo:$uid\]http://video.google.(.*?)/videoplay\?docid\=(.*?)\[/Gvideo:$uid\]!sie', '$this->auto_embed_video(\'http://video.google.$1/googleplayer.swf?docid=$2\', \'425\', \'350\')', 0, 0, 0, 1, "googlevid.gif"),
		'youtube'		=> array("youtube",			75, 1,	"ABBC3_YOUTUBE_TIP",	 "[youtube]{URL}[/youtube]", "<a src=\"{URL}\">{URL}</a>", "!\[youtube\]http://((.*?)?)youtube.com/watch\?v\=([0-9A-Za-z-_]{11})[^[]*\[/youtube\]!ies", '\'[youtube:$uid]http://${1}youtube.com/watch?v=${3}[/youtube:$uid]\'', '!\[youtube:$uid\]http://((.*?)?)youtube.com/watch\?v\=([0-9A-Za-z-_]{11})[^[]*\[/youtube:$uid\]!sie', '$this->auto_embed_video(\'http://${2}youtube.com/v/${3}\', \'425\', \'350\')', 0, 0, 0, 1, "youtube.gif"),
		'veoh'			=> array("veoh", 			76, 1,	"ABBC3_VEOH_TIP",		 "[veoh]{URL}[/veoh]", "<a src=\"{URL}\">{URL}</a>", "!\[veoh\]http://(.*?).veoh.com/([A-Za-z-_\-/]+)?/([0-9A-Za-z-_]+)\[/veoh\]!ies", '\'[veoh:$uid]http://${1}.veoh.com/${2}/${3}[/veoh:$uid]\'', '!\[veoh:$uid\]http://(.*?).veoh.com/([A-Za-z-_\-/]+)?/([0-9A-Za-z-_]+)\[/veoh:$uid\]!sie', '$this->auto_embed_video(\'http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.5.2.1030&permalinkId=${3}&player=videodetailsembedded&videoAutoPlay=0&id=anonymous\', \'540\', \'438\')', 0, 0, 0, 1, "veoh.gif"),
		'collegehumor'	=> array("collegehumor", 	77, 1,	"ABBC3_COLLEGE_TIP",	 "[collegehumor]{URL}[/collegehumor]", "<a src=\"{URL}\">{URL}</a>", "!\[collegehumor\]http://www.collegehumor.com/video:(.*?)\[/collegehumor\]!ies", '\'[collegehumor:$uid]http://www.collegehumor.com/video:${1}[/collegehumor:$uid]\'', '!\[collegehumor:$uid\]http://www.collegehumor.com/video:(.*?)\[/collegehumor:$uid\]!sie', '$this->auto_embed_video(\'http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=${1}&fullscreen=1\', \'480\', \'360\')', 0, 0, 0, 1, "collegehumor.gif"),
		'dm'			=> array("dm", 				78, 1,	"ABBC3_DMOTION_TIP",	 "[dm]{URL}[/dm]", "<a src=\"{URL}\">{URL}</a>", "!\[dm\](.*?)\[/dm\]!ies", '\'[dm:$uid]\'.trim(\'${1}\').\'[/dm:$uid]\'', '!\[dm:$uid\]http://www.dailymotion.com/(.*?)/(.*?)\[/dm:$uid\]!sie', '$this->auto_embed_video(\'http://www.dailymotion.com/swf/video/${2}\', \'420\', \'352\')', 0, 0, 0, 1, "dailymotion.gif"),
		'gamespot'		=> array("gamespot",		79, 1,	"ABBC3_GAMESPOT_TIP",	 "[gamespot]{URL}[/gamespot]", "<a src=\"{URL}\">{URL}</a>", "!\[gamespot\]http://www.gamespot.com/video/(.*?)/(.*?)\[/gamespot\]!ies", '\'[gamespot:$uid]http://www.gamespot.com/video/${1}/${2}[/gamespot:$uid]\'', '!\[gamespot:$uid\]http://www.gamespot.com/video/(.*?)/(.*?)\[/gamespot:$uid\]!sie', '$this->auto_embed_video(\'http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/proteus2.swf\', \'432\', \'355\', \'skin=http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/skins/gamespot.png&paramsURI=http%3A%2F%2Fwww.gamespot.com%2Fpages%2Fvideo_player%2Fxml.php%3Fid%3D${2}%26mode%3Dembedded%26width%3D{WIDTH}%26height%3D{HEIGHT}%2F\')', 0, 0, 0, 1, "gamespot.gif"),
		'gametrailers'	=> array("gametrailers",	80, 1,	"ABBC3_GAMETRAILERS_TIP","[gametrailers]{URL}[/gametrailers]", "<a src=\"{URL}\">{URL}</a>", "!\[gametrailers\]http://www.gametrailers.com/player/(.*?).html\[/gametrailers\]!ies", '\'[gametrailers:$uid]http://www.gametrailers.com/player/${1}.html[/gametrailers:$uid]\'', '!\[gametrailers:$uid\]http://www.gametrailers.com/player/(.*?).html\[/gametrailers:$uid\]!sie', '$this->auto_embed_video(\'http://www.gametrailers.com/remote_wrap.php?mid=${1}\', \'480\', \'392\')', 0, 0, 0, 1, "gametrailers.gif"),
		'ignvideo'		=> array("ignvideo",		81, 1,	"ABBC3_IGNVIDEO_TIP",	 "[ignvideo]{URL}[/ignvideo]", "<a src=\"{URL}\">{URL}</a>", "!\[ignvideo\](.*?)\[/ignvideo\]!ies", '\'[ignvideo:$uid]${1}[/ignvideo:$uid]\'', '!\[ignvideo:$uid\](.*?)\[/ignvideo:$uid\]!sie', '$this->auto_embed_video(\'http://videomedia.ign.com/ev/ev.swf\', \'433\', \'360\', \'${1}\')', 0, 0, 0, 1, "ign.gif"),
		'liveleak'		=> array("liveleak",		82, 1,	"ABBC3_LIVELEAK_TIP",	 "[liveleak]{URL}[/liveleak]", "<a src=\"{URL}\">{URL}</a>", "!\[liveleak\]http://www.liveleak.com/view\?i\=(.*?)\[/liveleak\]!ies", '\'[liveleak:$uid]http://www.liveleak.com/view?i=${1}[/liveleak:$uid]\'', '!\[liveleak:$uid\]http://www.liveleak.com/view\?i\=(.*?)\[/liveleak:$uid\]!sie', '$this->auto_embed_video(\'http://www.liveleak.com/e/${1}\', \'450\', \'370\')', 0, 0, 0, 1, "liveleak.gif"),

//	Deprecated in v3.0.7
//		'upload'		=> array("upload",			83,	0,	"ABBC3_UPLOAD_MOVER",	 ".", ".", ".", ".", ".", ".", 1, 0, 0, 1, "upload.gif", "5, 4"),
// Deprecated in v3.0.11
//		'html'			=> array("html",			84, 1,	"ABBC3_HTML_TIP",		 "[html]{TEXT}[/html]", "<code>{TEXT}</code>", "!\[html\](.*?)\[/html\]!ies", '\'[html:$uid]${1}[/html:$uid]\'', '!\[html:$uid\](.*?)\[/html:$uid\]!ies', 'str_replace(array("\r\n", "\n", "<br />", "<br />"), "\r", htmlspecialchars_decode(\'$1\'))', 0, 0, 0, 1, "html.gif", "5"),
	);
}

?>