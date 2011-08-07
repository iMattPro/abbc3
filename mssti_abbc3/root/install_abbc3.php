<?php
/**
* @package: phpBB 3.0.9 :: Advanced BBCode box 3 -> root/
* @version: $Id: install_abbc3.php, v 3.0.9.2 8/03/11 9:32 PM VSE Exp $
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

/** Set some default values so the user havn't to run any install - Start **/
$mod_data = array(
	'config'	=> 'ABBC3_VERSION',
	'name'		=> 'INSTALLER_TITLE',
	'language'	=> array('mods/acp_abbcodes', 'mods/abbcode', 'posting', 'install')
);
/** Set some default values so the user havn't to run any install - End **/

// The name of the mod to be displayed during installation.
$mod_name = $mod_data['name'];

// The name of the config variable which will hold the currently installed version
$version_config_name = $mod_data['config'];

// Add the language file if one was specified
if (isset($mod_data['language']))
{
	$user->add_lang($mod_data['language']);
}

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
// phpbb v3.0.0
//	'1.0.0'		=> array(),
//	'1.0.1'		=> array(),
//	'1.0.2'		=> array(),
//	'1.0.3'		=> array(),
//	'1.0.3-VEOH'=> array(),
//	'1.0.4'		=> array(),
//	'1.0.5'		=> array(),
//	'1.0.6'		=> array(),
//	'1.0.6-b'	=> array(),
//	'1.0.6-bFIX'=> array(),
//	'1.0.7'		=> array(),
//	'1.0.7-b'	=> array(),
//	'1.0.8'		=> array(),
// phpbb v3.0.1
//	'1.0.9'		=> array(),
//	'1.0.9-b'	=> array(),
// phpbb v3.0.2
//	'1.0.10'	=> array(),
// phpbb v3.0.3 and v3.0.4
//	'1.0.11'	=> array(),
// pbpBB v3.0.5 
//	'1.0.12'	=> array(),
//	'3.0.6'		=> array(),	// Never released
// phpbb v3.0.7 & v3.0.7-PL1
//	'3.0.7-PL1'	=> array(),	// Never released
	'3.0.8'		=> array(
		'custom' => 'abbc3_308',
	),
	'3.0.8-pl1'		=> array(
		// Lets remove deprecated configs
		'config_remove' => array(
			array('ABBC3_PATH'),
		),
		// We have some BBcodes to update
		'custom' => 'abbc3_bbcode_handler',
	),
	'3.0.8-pl2'		=> array(
		// No new database changes (so far)
	),
	'3.0.9.2'		=> array(
		'custom' => 'abbc3_3092',
	),
);
$cache->destroy('config');
$cache->destroy('_modules_acp');
$cache->destroy('sql', BBCODES_TABLE);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

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
* clear cache
**/
function cache_purge()
{
	global $cache, $umil;

	$cache->destroy('config');
	$cache->destroy('_modules_acp');
	$cache->destroy('sql', BBCODES_TABLE);
	$umil->cache_purge('template', 0);
}

/**
* Here is our custom function that will be called for version 3.0.8
* Because this is our first time installing through UMIL,
* we need to do this in a non-standard way
*
* @param string $action The action (install|update|uninstall) will be sent through this.
* @param string $version The version this is being run for will be sent through this.
**/
function abbc3_308($action, $version)
{
	global $db, $cache, $user, $umil, $config;;

	$message = '';

	/* All related to the phpbb_config table - Start */
	// Config entries
	$abbc3_config_data = array(
		'ABBC3_MOD'				=> (isset($config['ABBC3_MOD']))				? $config['ABBC3_MOD']				: 1,
		'ABBC3_PATH'			=> (isset($config['ABBC3_PATH']))				? $config['ABBC3_PATH']				: 'styles/abbcode',
		'ABBC3_BG'				=> (isset($config['ABBC3_BG']))					? $config['ABBC3_BG']				: 'bg_abbc3.gif',
		'ABBC3_TAB'				=> (isset($config['ABBC3_TAB']))				? $config['ABBC3_TAB']				: 1,

		'ABBC3_BOXRESIZE'		=> (isset($config['ABBC3_BOXRESIZE']))			? $config['ABBC3_BOXRESIZE']		: 1,
		'ABBC3_RESIZE'			=> (isset($config['ABBC3_RESIZE']))				? $config['ABBC3_RESIZE']			: 1,
		'ABBC3_RESIZE_METHOD'	=> (isset($config['ABBC3_RESIZE_METHOD']))		? $config['ABBC3_RESIZE_METHOD']	: 'AdvancedBox',
		'ABBC3_RESIZE_BAR'		=> (isset($config['ABBC3_RESIZE_BAR']))			? $config['ABBC3_RESIZE_BAR']		: 1,
		'ABBC3_MAX_IMG_WIDTH'	=> (isset($config['ABBC3_MAX_IMG_WIDTH']))		? $config['ABBC3_MAX_IMG_WIDTH']	: ($config['img_max_width'] ? $config['img_max_width'] : 500),
		'ABBC3_MAX_IMG_HEIGHT'	=> (isset($config['ABBC3_MAX_IMG_HEIGHT']))		? $config['ABBC3_MAX_IMG_HEIGHT']	: ($config['img_max_height'] ? $config['img_max_height'] : 0),
		'ABBC3_RESIZE_SIGNATURE'=> (isset($config['ABBC3_RESIZE_SIGNATURE']))	? $config['ABBC3_RESIZE_SIGNATURE']	: 0,
		'ABBC3_MAX_SIG_WIDTH'	=> (isset($config['ABBC3_MAX_SIG_WIDTH']))		? $config['ABBC3_MAX_SIG_WIDTH']	: ($config['max_sig_img_width'] ? $config['max_sig_img_width'] : 200),
		'ABBC3_MAX_SIG_HEIGHT'	=> (isset($config['ABBC3_MAX_SIG_HEIGHT']))		? $config['ABBC3_MAX_SIG_HEIGHT']	: 0,
		'ABBC3_MAX_THUM_WIDTH'	=> (isset($config['ABBC3_MAX_THUM_WIDTH']))		? $config['ABBC3_MAX_THUM_WIDTH']	: ($config['img_max_thumb_width'] ? $config['img_max_thumb_width']/2 : 200),

		'ABBC3_COLOR_MODE'		=> (isset($config['ABBC3_COLOR_MODE']))			? $config['ABBC3_COLOR_MODE']		: 'phpbb',
		'ABBC3_HIGHLIGHT_MODE'	=> (isset($config['ABBC3_HIGHLIGHT_MODE']))		? $config['ABBC3_HIGHLIGHT_MODE']	: 'dropdown',

		'ABBC3_WIZARD_MODE'		=> (isset($config['ABBC3_WIZARD_MODE']))		? $config['ABBC3_WIZARD_MODE']		: 1,
		'ABBC3_WIZARD_width'	=> (isset($config['ABBC3_WIZARD_width']))		? $config['ABBC3_WIZARD_width']		: 700,
		'ABBC3_WIZARD_height'	=> (isset($config['ABBC3_WIZARD_height']))		? $config['ABBC3_WIZARD_height']	: 400,

		'ABBC3_VIDEO_width'		=> (isset($config['ABBC3_VIDEO_width']))		? $config['ABBC3_VIDEO_width']		: 425,
		'ABBC3_VIDEO_height'	=> (isset($config['ABBC3_VIDEO_height']))		? $config['ABBC3_VIDEO_height']		: 350,
		'ABBC3_VIDEO_OPTIONS'	=> (isset($config['ABBC3_VIDEO_OPTIONS']))		? $config['ABBC3_VIDEO_OPTIONS']	: '1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20;21;22;23;24;25;26;27;28;29;30;31;32;33;34;35;36;37;38;39;40;41;42;43;44;45;46;47;48;49;50;201;202;203;204;205;206;207;208;',

		'ABBC3_UCP_MODE'		=> (isset($config['ABBC3_UCP_MODE']))			? $config['ABBC3_UCP_MODE']			: 1,
	);

	// update entries from the config table
	$abbc3_config_update = array(	
		'max_post_font_size'	=> ($config['max_post_font_size'] != 0) ? (($config['max_post_font_size'] < 300) ? 300 : $config['max_post_font_size']) : 0,
	);

	// remove old entries from the config table
	$abbc3_config_deprecated = array(	
	//	config_name                    Created  Deprecated
		'ABBC3_GREYBOX',			// v1.0.9	v1.0.10
		'ABBC3_JAVASCRIPT',			// v1.0.10	v1.0.11
		'ABBC3_UPLOAD_MAX_SIZE',	// v1.0.9	v3.0.7
		'ABBC3_UPLOAD_EXTENSION',	// v1.0.9	v3.0.7
	);
	/* All related to the phpbb_config table - End */

	/* All related to the phpbb_modules table - Start */
	$abbc3_module_data = array(
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
	);
	/* All related to the phpbb_modules table - End */

	/* All related to the new phpbb_clicks tables - Start */
	$abbc3_clicks_table = array(
		'COLUMNS'		=> array(
			'id'		=> array('UINT', NULL, 'auto_increment'),
			'url'		=> array('VCHAR:255', ''),
			'clicks'	=> array('UINT', 0),
		),
		'PRIMARY_KEY'	=> 'id',
		'KEYS'			=> array(
			'md5'		=> array('INDEX', array('url')),
		),
	);
	/* All related to the new phpbb_clicks tables - End */

	/* All related to the phpbb_users table - Start */
	$abbc3_users_column_add = array(
		'user_abbcode_mod' => array('TINT:1', 1),
		'user_abbcode_compact' => array('TINT:1', 0),
	);
	/* All related to the phpbb_users table - End */

	/* All related to the phpbb_bbcodes table - Start */
	// remove old bbcodes from the bbcodes table
	$abbc3_bbcode_deprecated = array(
	//	bbcode_tag     Created  Deprecated
		'upload', 	// v1.0.9	v3.0.7
		'html',		// v1.0.10	v1.0.11
	);
	$abbc3_bbcodes_column_add = array(
		'display_on_pm' => array('TINT:1', 1),
		'display_on_sig' => array('TINT:1', 1),
		'abbcode' => array('TINT:1', 0),
		'bbcode_image' => array('VCHAR', ''),
		'bbcode_order' => array('USINT', 0),
		'bbcode_group' => array('VCHAR:255', '0'),
	);
	/* All related to the phpbb_bbcodes table - End */

	switch ($action)
	{
		// This is not supposed to happen, but just in case we also check for “no action”.
		default:
		// This is not possible, just in case we also check for “update”.
		case 'update':
		case 'install':
		// Run this when updating to ABBC3 v3.0.8
		/* All related to the phpbb_config table - Start */
			$config_added = false;
			$config_updated = false;
			foreach ($abbc3_config_data as $config_name => $config_value)
			{
				if (!$umil->config_exists($config_name))
				{
					$config_added = true;
					$umil->config_add($config_name, $config_value);
				}
			/**
			* Commented out for future refference :
			* We do not need to update config values
				else
				{
					$config_updated = true;
					$umil->config_update($config_name, $config_value);
				}
			**/
			}
			if ($config['max_post_font_size'] != $abbc3_config_update['max_post_font_size'])
			{
				$config_updated = true;
				$umil->config_update('max_post_font_size', $abbc3_config_update['max_post_font_size']);
			}

			$config_deleted = false;
			foreach ($abbc3_config_deprecated as $config_name)
			{
				if ($umil->config_exists($config_name))
				{
					$config_deleted = true;
					$umil->config_remove($config_name);
				}
			}

			if ($config_added || $config_updated || $config_deleted)
			{
				$cache->destroy('config');
			}
		/* All related to the phpbb_config table - End */

		/* All related to the phpbb_modules table - Start */
			if (!$umil->module_exists('acp', 'ACP_CAT_POSTING', 'ACP_ABBCODES'))
			{
				$umil->module_add($abbc3_module_data);
				// Clear the Modules Cache
				$cache->destroy('_modules_acp');
			}
		/* All related to the phpbb_modules table - End */

		/* All related to the new phpbb_clicks tables - Start */
			if (!$umil->table_exists('phpbb_clicks'))
			{
				$umil->table_add('phpbb_clicks', $abbc3_clicks_table);
			}
		/* All related to the new phpbb_clicks tables - End */
		
		/* All related to the phpbb_users table - Start */
			foreach ($abbc3_users_column_add as $abbc3_users_column_name => $abbc3_users_column_data)
			{
				if (!$umil->table_column_exists('phpbb_users', $abbc3_users_column_name))
				{
					$umil->table_column_add('phpbb_users', $abbc3_users_column_name, $abbc3_users_column_data);
				}
			}
		/* All related to the phpbb_users table - Start */

		/* All related to the phpbb_bbcodes table - Start */
			foreach ($abbc3_bbcodes_column_add as $abbc3_bbcode_column_name => $abbc3_bbcode_column_data)
			{
				if (!$umil->table_column_exists('phpbb_bbcodes', $abbc3_bbcode_column_name))
				{
					$umil->table_column_add('phpbb_bbcodes', $abbc3_bbcode_column_name, $abbc3_bbcode_column_data);
				}
			}
		
			// Change the following columns
			$umil->table_column_update('phpbb_bbcodes', 'bbcode_id', array('INT:4', 0));

			// Add indexes ?
			if (!$umil->table_index_exists('phpbb_bbcodes', 'display_order'))
			{
				$umil->table_index_add('phpbb_bbcodes', 'display_order', 'bbcode_order');
			}

			$abbc3_bbcode_deleted = false;
			foreach ($abbc3_bbcode_deprecated as $bbcode_name)
			{
				// Check if exist
				$sql = 'SELECT * 
						FROM ' . BBCODES_TABLE . "
						WHERE LOWER(bbcode_tag) = '" . $db->sql_escape(strtolower($bbcode_name)) . "'";
				$result = $db->sql_query($sql);
				$row_exist = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if ($row_exist)
				{
					$abbc3_bbcode_deleted = true;
					$umil->table_row_remove('phpbb_bbcodes', array('LOWER(bbcode_tag)' => strtolower($bbcode_name)));
				}
			}
			if ($abbc3_bbcode_deleted)
			{
				$cache->destroy('sql', BBCODES_TABLE);
			}

			// After all add/update bbcodes
			$message .= abbc3_bbcode_handler($action, $version);
		/* All related to the phpbb_bbcodes table - End */

		break;

		case 'uninstall':
		// Run this when uninstalling
		/* All related to the phpbb_bbcodes table - Start */

			// Remove the ABBC3 custom BBcodes first, before uninstalling anything else
			$message .= abbc3_bbcode_handler($action, $version);

			// remove the table index
			$umil->table_index_remove('phpbb_bbcodes', 'display_order');

			// Change the following columns back to default
			if (version_compare($config['version'], '3.0.8', '>'))
			{
				// phpBB 3.0.9 switched bbcode_id to UNSIGNED SMALLINT(4)
				$umil->table_column_update('phpbb_bbcodes', 'bbcode_id', array('USINT', 0));
			}
			else
			{
				// phpBB 3.0.8 and older set bbcode_id to TINYINT(3)
				$umil->table_column_update('phpbb_bbcodes', 'bbcode_id', array('TINT:3', 0));
			}

			foreach ($abbc3_bbcodes_column_add as $abbc3_bbcode_column_name => $abbc3_bbcode_column_data)
			{
				$umil->table_column_remove('phpbb_bbcodes', $abbc3_bbcode_column_name);
			}
			$cache->destroy('sql', BBCODES_TABLE);
		/* All related to the phpbb_bbcodes table - End */

		/* All related to the phpbb_users table - Start */
			foreach ($abbc3_users_column_add as $abbc3_users_column_name => $abbc3_users_column_data)
			{
				$umil->table_column_remove('phpbb_users', $abbc3_users_column_name);
			}
		/* All related to the phpbb_users table - Start */

		/* All related to the new phpbb_clicks tables - Start */
			$umil->table_remove('phpbb_clicks');
		/* All related to the new phpbb_clicks tables - End */
			
		/* All related to the phpbb_modules table - Start */
			$umil->module_remove(array_reverse($abbc3_module_data));
			// Clear the Modules Cache
			$cache->destroy('_modules_acp');
		/* All related to the phpbb_modules table - End */

		/* All related to the phpbb_config table - Start */
			foreach ($abbc3_config_data as $config_name => $config_value)
			{
				$umil->config_remove($config_name);
			}

			if ($config['max_post_font_size'] != 0 && $config['max_post_font_size'] <= $abbc3_config_update['max_post_font_size'])
			{
				$umil->config_update('max_post_font_size', 200);
			}

			$cache->destroy('config');
		/* All related to the phpbb_config table - End */

		break;
	}

	cache_purge();

	$message .= $user->lang['INSTALLER_INSTALL_END'];

	// return a message
	return $message;
}

/**
* Install, update or remove ABBC3 custom BBcodes
*
* @param string		$action
* @param string		$version
**/
function abbc3_bbcode_handler($action, $version)
{
	$message = '';

	switch ($action)
	{
		case 'install':
		case 'update':
			// Add/update ABBC3 bbcodes
			$message .= abbc3_add_bbcodes($action, $version);
			// Synchronise bbcode order
			$message .= abbc3_sync_bbcodes();
		break;

		// Remove ALL ABBC3 bbcodes
		case 'uninstall':
			global $umil, $user;
			$umil->table_row_remove('phpbb_bbcodes', array('abbcode' => '1'));
			$message .= $user->lang['INSTALLER_BBCODES_ADD'];
		break;
	}
	// return a message
	return $message;
}

/**
* Add ABBC3 bbcodes to the bbcodes table
**/
function abbc3_add_bbcodes($action, $version)
{
	global $db, $template, $user;

	$first_bbcode_id = 0;

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

	$bbcode_data = get_abbc3_bbcodes($action, $version);

	$ary_bbcode_modified = array();
	$ary_bbcode_added = array();

	foreach ($bbcode_data as $bbcode_name => $bbcode_values)
	{
		if ($bbcode_values['bbcode_id'])
		{
			$next_bbcode_id++;
		}
		else
		{
			$first_bbcode_id--;
		}

		$sql_ary = array(
			'bbcode_tag'			=> $bbcode_values['bbcode_tag'],
			'bbcode_order'			=> $bbcode_values['bbcode_order'],
			'bbcode_helpline'		=> $bbcode_values['bbcode_helpline'],
			'bbcode_match'			=> $bbcode_values['bbcode_match'],
			'bbcode_tpl'			=> $bbcode_values['bbcode_tpl'],
			'first_pass_match'		=> $bbcode_values['first_pass_match'],
			'first_pass_replace'	=> $bbcode_values['first_pass_replace'],
			'second_pass_match'		=> $bbcode_values['second_pass_match'],
			'second_pass_replace'	=> $bbcode_values['second_pass_replace'],
			'display_on_posting'	=> $bbcode_values['display_on_posting'],
			'display_on_pm'			=> $bbcode_values['display_on_pm'],
			'display_on_sig'		=> $bbcode_values['display_on_sig'],
			'abbcode'				=> $bbcode_values['abbcode'],
			'bbcode_image'			=> $bbcode_values['bbcode_image'],
			'bbcode_group'			=> (isset($bbcode_values['bbcode_group']) ? $bbcode_values['bbcode_group'] : 0),
		);

		// Check if exist
		$sql = 'SELECT * 
				FROM ' . BBCODES_TABLE . "
				WHERE LOWER(bbcode_tag) = '" . $db->sql_escape(strtolower($sql_ary['bbcode_tag'])) . "'";
		$result = $db->sql_query($sql);
		$row_exist = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		// if exist, check if it was updated
		if ($row_exist)
		{
			$bbcode_id = (int) $row_exist['bbcode_id'];
			$sql_ary = array(
				'bbcode_helpline'		=> $bbcode_values['bbcode_helpline'],
				'bbcode_match'			=> $bbcode_values['bbcode_match'],
				'bbcode_tpl'			=> $bbcode_values['bbcode_tpl'],
				'first_pass_match'		=> $bbcode_values['first_pass_match'],
				'first_pass_replace'	=> $bbcode_values['first_pass_replace'],
				'second_pass_match'		=> $bbcode_values['second_pass_match'],
				'second_pass_replace'	=> $bbcode_values['second_pass_replace'],
				'abbcode'				=> ($bbcode_values['abbcode']) ? 1 : 0, // Should be always true, except for [center]
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
				($row_exist['bbcode_order'] !== $bbcode_values['bbcode_order'])												? $sql_ary['bbcode_order'] = $bbcode_values['bbcode_order']				: true;
				($row_exist['display_on_posting'] !== $bbcode_values['display_on_posting'])									? $sql_ary['display_on_posting'] = $bbcode_values['display_on_posting']	: true;
				($row_exist['display_on_pm'] !== $bbcode_values['display_on_pm'])											? $sql_ary['display_on_pm'] = $bbcode_values['display_on_pm']			: true;
				($row_exist['display_on_sig'] !== $bbcode_values['display_on_sig'])											? $sql_ary['display_on_sig'] = $bbcode_values['display_on_sig']			: true;
				($row_exist['bbcode_image'] !== $bbcode_values['bbcode_image'])												? $sql_ary['bbcode_image'] = $bbcode_values['bbcode_image']				: true;
				(isset($bbcode_values['bbcode_group']) && $row_exist['bbcode_group'] !== $bbcode_values['bbcode_group'])	? $sql_ary['bbcode_group'] = $bbcode_values['bbcode_group']				: true;

				$result = $db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE bbcode_id = ' . $bbcode_id);

				$ary_bbcode_modified[] = $bbcode_name;
			}
		}
		// else add it
		else
		{
			$sql_ary['bbcode_id'] = ($bbcode_values['bbcode_id']) ? (int) $next_bbcode_id : (int) $first_bbcode_id;

			$result = $db->sql_query('INSERT INTO ' . BBCODES_TABLE . $db->sql_build_array('INSERT', $sql_ary));

			$ary_bbcode_added[] = $bbcode_name;
		}
	}

	$message = '';
	if (sizeof($ary_bbcode_modified))
	{
		$message .= "<p>" . $user->lang['LINE_MODIFIED'] . ' : ' . implode(', ', $ary_bbcode_modified) . "</p>";
	}
	if (sizeof($ary_bbcode_added))
	{
		$message .= "<p>" . $user->lang['LINE_ADDED'] . ' : ' . implode(', ', $ary_bbcode_added) . "</p>";
		
	}

	/**
	* Return a string
	**/
	return $user->lang['INSTALLER_BBCODES_ADD'] . $message;
}

/**
* Synchronise bbcode order
**/
function abbc3_sync_bbcodes()
{
	global $db, $user;

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

	/**
	* Return a string
	**/
	return "<p>" . $user->lang['ABBCODES_RESYNC_SUCCESS'] . "</p>";
}

/**
* Database changes for ABBC3 v3.0.9.2
*
* Ibox was replaced by Shadowbox. Need to update database entries using Ibox to Shadowbox.
**/
function abbc3_3092($action, $version)
{
	global $umil, $user;
	
	switch ($action)
	{
		case 'update':
			// Get the resizer method
			$resizer = $umil->config_exists('ABBC3_RESIZE_METHOD', true);
			// If resizer method is set to Ibox, we need to switch it to Shadowbox
			if ($resizer['config_value'] == 'Ibox')
			{
				$umil->config_update('ABBC3_RESIZE_METHOD', 'Shadowbox');
			}
		break;

		case 'uninstall':
			// Get the resizer method
			$resizer = $umil->config_exists('ABBC3_RESIZE_METHOD', true);
			// If resizer method is set to Shadowbox, we need to switch it to Ibox
			if ($resizer['config_value'] == 'Shadowbox')
			{
				$umil->config_update('ABBC3_RESIZE_METHOD', 'Ibox');
			}
		break;
	}
	
	return $user->lang['INSTALLER_RESIZE_CHECK'];
}

/**
* Define all of ABBC3's custom BBcodes
*
* @return array		$bbcode_data	all bbcodes	to add
**/
function get_abbc3_bbcodes($action = 'install', $version = '3.0.8')
{
	$bbcode_data = array(
		'3.0.8' => array(
			'font'			=> array(
				'bbcode_tag'			=> 'font=',
				'bbcode_order'			=> 1,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_FONT_TIP',
				'bbcode_match'			=> '[font={TEXT1}]{TEXT2}[/font]',
				'bbcode_tpl'			=> '<span style="font-family: {TEXT1};">{TEXT2}</span>',
				'first_pass_match'		=> '!\[font\=([a-zA-Z0-9-_ ]+)\](.*?)\[/font\]!ies',
				'first_pass_replace'	=> '\'[font=\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \':$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/font:$uid]\'',
				'second_pass_match'		=> '!\[font\=([a-zA-Z0-9-_ ]+):$uid\](.*?)\[/font:$uid\]!s',
				'second_pass_replace'	=> '<span style="font-family: ${1};">${2}</span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> ' ',
				'bbcode_group'			=> '0',
			),
			'size'			=> array(
				'bbcode_tag'			=> 'size',
				'bbcode_order'			=> 2,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_SIZE_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> ' ',
				'bbcode_group'			=> '0',
			),
			'highlight'		=> array(
				'bbcode_tag'			=> 'highlight=',
				'bbcode_order'			=> 3,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_HIGHLIGHT_TIP',
				'bbcode_match'			=> '[highlight={COLOR}]{TEXT}[/highlight]',
				'bbcode_tpl'			=> '<span style="background-color: {COLOR};">{TEXT}</span>',
				'first_pass_match'		=> '!\[highlight\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/highlight\]!ies',
				'first_pass_replace'	=> '\'[highlight=${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/highlight:$uid]\'',
				'second_pass_match'		=> '!\[highlight\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/highlight:$uid\]!s',
				'second_pass_replace'	=> '<span style="background-color: ${1};">${2}</span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> ' ',
				'bbcode_group'			=> '0',
			),
			'color'			=> array(
				'bbcode_tag'			=> 'color',
				'bbcode_order'			=> 4,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_COLOR_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> ' ',
				'bbcode_group'			=> '0',
			),
			'break1'		=> array(
				'bbcode_tag'			=> 'break1',
				'bbcode_order'			=> 5,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_BREAK',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'spacer.gif',
				'bbcode_group'			=> '0',
			),
			'cut'			=> array(
				'bbcode_tag'			=> 'cut',
				'bbcode_order'			=> 6,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_CUT_MOVER',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'cut.gif',
				'bbcode_group'			=> '0',
			),
			'copy'			=> array(
				'bbcode_tag'			=> 'copy',
				'bbcode_order'			=> 7,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_COPY_MOVER',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'copy.gif',
				'bbcode_group'			=> '0',
			),
			'paste'			=> array(
				'bbcode_tag'			=> 'paste',
				'bbcode_order'			=> 8,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_PASTE_MOVER',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'paste.gif',
				'bbcode_group'			=> '0',
			),
			'plain'			=> array(
				'bbcode_tag'			=> 'plain',
				'bbcode_order'			=> 9,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_PLAIN_MOVER',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'plain.gif',
				'bbcode_group'			=> '0',
			),
			'division1'			=> array(
				'bbcode_tag'			=> 'division1',
				'bbcode_order'			=> 10,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_DIVISION',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'dots.gif',
				'bbcode_group'			=> '0',
			),
			'listb'			=> array(
				'bbcode_tag'			=> 'listb',
				'bbcode_order'			=> 11,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_LISTB_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'listb.gif',
				'bbcode_group'			=> '0',
			),
			'listo'			=> array(
				'bbcode_tag'			=> 'listo',
				'bbcode_order'			=> 12,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_LISTO_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'listo.gif',
				'bbcode_group'			=> '0',
			),
			'listitem'			=> array(
				'bbcode_tag'			=> 'listitem',
				'bbcode_order'			=> 13,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_LISTITEM_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'listitem.gif',
				'bbcode_group'			=> '0',
			),
			'tabs'			=> array(
				'bbcode_tag'			=> 'tabs',
				'bbcode_order'			=> 14,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_TABS',
				'bbcode_match'			=> '[tabs]{TEXT}[/tabs]',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '!\[tabs\](.*?)\[/tabs\]!ies',
				'first_pass_replace'	=> '\'[tabs:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/tabs:$uid]\'',
				'second_pass_match'		=> '!\[tabs:$uid\](.*?)\[/tabs:$uid\]!ies',
				'second_pass_replace'	=> '$this->simpleTabs_pass(\'$1\')',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'tabs.gif',
				'bbcode_group'			=> '0',
			),
			'hr'			=> array(
				'bbcode_tag'			=> 'hr',
				'bbcode_order'			=> 15,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_HR_TIP',
				'bbcode_match'			=> '[hr]',
				'bbcode_tpl'			=> '<hr class="hrabbc3" />',
				'first_pass_match'		=> "!\[hr\]!ies",
				'first_pass_replace'	=> '\'[hr:$uid]\'',
				'second_pass_match'		=> '!\[hr:$uid\]!s',
				'second_pass_replace'	=> '<hr class="hrabbc3" />',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'hr.gif',
				'bbcode_group'			=> '0',
			),
			'b'			=> array(
				'bbcode_tag'			=> 'b',
				'bbcode_order'			=> 16,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_B_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'bold.gif',
				'bbcode_group'			=> '0',
			),
			'i'			=> array(
				'bbcode_tag'			=> 'i',
				'bbcode_order'			=> 17,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_I_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'italic.gif',
				'bbcode_group'			=> '0',
			),
			'u'			=> array(
				'bbcode_tag'			=> 'u',
				'bbcode_order'			=> 18,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_U_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'under.gif',
				'bbcode_group'			=> '0',
			),
			's'			=> array(
				'bbcode_tag'			=> 's',
				'bbcode_order'			=> 19,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_STRIKE_TIP',
				'bbcode_match'			=> '[s]{TEXT}[/s]',
				'bbcode_tpl'			=> '<span style="text-decoration: line-through;">{TEXT}</span>',
				'first_pass_match'		=> '!\[s\](.*?)\[/s\]!ies',
				'first_pass_replace'	=> '\'[s:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/s:$uid]\'',
				'second_pass_match'		=> '!\[s:$uid\](.*?)\[/s:$uid\]!s',
				'second_pass_replace'	=> '<span style="text-decoration: line-through;">${1}</span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'strike.gif',
				'bbcode_group'			=> '0',
			),
			'sup'		=> array(
				'bbcode_tag'			=> 'sup',
				'bbcode_order'			=> 20,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_SUP_TIP',
				'bbcode_match'			=> '[sup]{TEXT}[/sup]',
				'bbcode_tpl'			=> '<sup>{TEXT}</sup>',
				'first_pass_match'		=> '!\[sup\](.*?)\[/sup\]!ies',
				'first_pass_replace'	=> '\'[sup:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/sup:$uid]\'',
				'second_pass_match'		=> '!\[sup:$uid\](.*?)\[/sup:$uid\]!s',
				'second_pass_replace'	=> '<sup>${1}</sup>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'sup.gif',
				'bbcode_group'			=> '0',
			),
			'sub'		=> array(
				'bbcode_tag'			=> 'sub',
				'bbcode_order'			=> 21,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_SUB_TIP',
				'bbcode_match'			=> '[sub]{TEXT}[/sub]',
				'bbcode_tpl'			=> '<sub>{TEXT}</sub>',
				'first_pass_match'		=> '!\[sub\](.*?)\[/sub\]!ies',
				'first_pass_replace'	=> '\'[sub:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/sub:$uid]\'',
				'second_pass_match'		=> '!\[sub:$uid\](.*?)\[/sub:$uid\]!s',
				'second_pass_replace'	=> '<sub>${1}</sub>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'sub.gif',
				'bbcode_group'			=> '0',
			),
			'glow'		=> array(
				'bbcode_tag'			=> 'glow=',
				'bbcode_order'			=> 22,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_GLOW_TIP',
				'bbcode_match'			=> '[glow={COLOR}]{TEXT}[/glow]',
				'bbcode_tpl'			=> '<div style="filter:Glow(color={COLOR},strength=4);color:#ffffff;height:110%">{TEXT}</div>',
				'first_pass_match'		=> '!\[glow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/glow\]!ies',
				'first_pass_replace'	=> '\'[glow=${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/glow:$uid]\'',
				'second_pass_match'		=> '!\[glow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/glow:$uid\]!ies',
				'second_pass_replace'	=> "\$this->Text_effect_pass('glow', '$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'glow.gif',
				'bbcode_group'			=> '0',
			),
			'shadow'		=> array(
				'bbcode_tag'			=> 'shadow=',
				'bbcode_order'			=> 23,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_SHADOW_TIP',
				'bbcode_match'			=> '[shadow={COLOR}]{TEXT}[/shadow]',
				'bbcode_tpl'			=> '<div style="filter:shadow(color=black,strength=4);color:{COLOR};height:110%">{TEXT}</div>',
				'first_pass_match'		=> '!\[shadow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/shadow\]!ies',
				'first_pass_replace'	=> '\'[shadow=${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/shadow:$uid]\'',
				'second_pass_match'		=> '!\[shadow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/shadow:$uid\]!ies',
				'second_pass_replace'	=> "\$this->Text_effect_pass('shadow', '$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'shadow.gif',
				'bbcode_group'			=> '0',
			),
			'dropshadow'		=> array(
				'bbcode_tag'			=> 'dropshadow=',
				'bbcode_order'			=> 24,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_DROPSHADOW_TIP',
				'bbcode_match'			=> '[dropshadow={COLOR}]{TEXT}[/dropshadow]',
				'bbcode_tpl'			=> '<div style="filter:dropshadow(color=#999999,strength=4);color:{COLOR};height:110%">{TEXT}</div>',
				'first_pass_match'		=> '!\[dropshadow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/dropshadow\]!ies',
				'first_pass_replace'	=> '\'[dropshadow=${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/dropshadow:$uid]\'',
				'second_pass_match'		=> '!\[dropshadow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/dropshadow:$uid\]!ies',
				'second_pass_replace'	=> "\$this->Text_effect_pass('dropshadow', '$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'dropshadow.gif',
				'bbcode_group'			=> '0',
			),
			'blur'		=> array(
				'bbcode_tag'			=> 'blur=',
				'bbcode_order'			=> 25,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_BLUR_TIP',
				'bbcode_match'			=> '[blur={COLOR}]{TEXT}[/blur]',
				'bbcode_tpl'			=> '<div style="filter:Blur(strength=7);color:{COLOR};height:110%">{TEXT}</div>',
				'first_pass_match'		=> '!\[blur\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/blur\]!ies',
				'first_pass_replace'	=> '\'[blur=${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/blur:$uid]\'',
				'second_pass_match'		=> '!\[blur\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/blur:$uid\]!ies',
				'second_pass_replace'	=> "\$this->Text_effect_pass('blur', '$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'blur.gif',
				'bbcode_group'			=> '0',
			),
			'wave'		=> array(
				'bbcode_tag'			=> 'wave=',
				'bbcode_order'			=> 26,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_WAVE_TIP',
				'bbcode_match'			=> '[wave={COLOR}]{TEXT}[/wave]',
				'bbcode_tpl'			=> '<div style="filter:Wave(strength=2);color:{COLOR};height:110%">{TEXT}</div>',
				'first_pass_match'		=> '!\[wave\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/wave\]!ies',
				'first_pass_replace'	=> '\'[wave=${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/wave:$uid]\'',
				'second_pass_match'		=> '!\[wave\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/wave:$uid\]!ies',
				'second_pass_replace'	=> "\$this->Text_effect_pass('wave', '$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'wave.gif',
				'bbcode_group'			=> '0',
			),
			'fade'		=> array(
				'bbcode_tag'			=> 'fade',
				'bbcode_order'			=> 27,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_FADE_TIP',
				'bbcode_match'			=> '[fade]{TEXT}[/fade]',
				'bbcode_tpl'			=> '<div class="fade_link">{TEXT}</div> <script type="text/javascript">fade_ontimer();</script>',
				'first_pass_match'		=> '!\[fade\](.*?)\[/fade\]!ies',
				'first_pass_replace'	=> '\'[fade:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/fade:$uid]\'',
				'second_pass_match'		=> '!\[fade:$uid\](.*?)\[/fade:$uid\]!s',
				'second_pass_replace'	=> '<div class="fade_link">${1}</div> <script type="text/javascript">fade_ontimer();</script>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'fade.gif',
				'bbcode_group'			=> '0',
			),
			'grad'		=> array(
				'bbcode_tag'			=> 'grad',
				'bbcode_order'			=> 28,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_GRAD_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'grad.gif',
				'bbcode_group'			=> '0',
			),
			'division2'		=> array(
				'bbcode_tag'			=> 'division2',
				'bbcode_order'			=> 29,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_DIVISION',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'dots.gif',
				'bbcode_group'			=> '0',
			),
			'align justify'		=> array(
				'bbcode_tag'			=> 'align=justify',
				'bbcode_order'			=> 30,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_JUSTIFY_TIP',
				'bbcode_match'			=> '[align=justify]{TEXT}[/align]',
				'bbcode_tpl'			=> '<span style="text-align: justify; display: block;">{TEXT}</span>',
				'first_pass_match'		=> '!\[align\=justify\](.*?)\[/align\]!ies',
				'first_pass_replace'	=> '\'[align=justify:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/align:$uid]\'',
				'second_pass_match'		=> '!\[align\=justify:$uid\](.*?)\[/align:$uid\]!s',
				'second_pass_replace'	=> '<span style="text-align: justify; display: block;">${1}</span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'justify.gif',
				'bbcode_group'			=> '0',
			),
			'align left'		=> array(
				'bbcode_tag'			=> 'align=left',
				'bbcode_order'			=> 31,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_LEFT_TIP',
				'bbcode_match'			=> '[align=left]{TEXT}[/align]',
				'bbcode_tpl'			=> '<span style="text-align: left; display: block;">{TEXT}</span>',
				'first_pass_match'		=> '!\[align\=left\](.*?)\[/align\]!ies',
				'first_pass_replace'	=> '\'[align=left:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/align:$uid]\'',
				'second_pass_match'		=> '!\[align\=left:$uid\](.*?)\[/align:$uid\]!s',
				'second_pass_replace'	=> '<span style="text-align: left; display: block;">${1}</span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'left.gif',
				'bbcode_group'			=> '0',
			),
			'align center'		=> array(
				'bbcode_tag'			=> 'align=center',
				'bbcode_order'			=> 32,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_CENTER_TIP',
				'bbcode_match'			=> '[align=center]{TEXT}[/align]',
				'bbcode_tpl'			=> '<span style="text-align: center; display: block;">{TEXT}</span>',
				'first_pass_match'		=> '!\[align\=center\](.*?)\[/align\]!ies',
				'first_pass_replace'	=> '\'[align=center:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/align:$uid]\'',
				'second_pass_match'		=> '!\[align\=center:$uid\](.*?)\[/align:$uid\]!s',
				'second_pass_replace'	=> '<span style="text-align: center; display: block;">${1}</span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'center.gif',
				'bbcode_group'			=> '0',
			),
			'center'		=> array(
				'bbcode_tag'			=> 'center',
				'bbcode_order'			=> 33,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> '[center]your text here[/center]',
				'bbcode_match'			=> '[center]{TEXT}[/center]',
				'bbcode_tpl'			=> '<center>{TEXT}</center>',
				'first_pass_match'		=> '!\[center\](.*?)\[/center\]!ies',
				'first_pass_replace'	=> '\'[center:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/center:$uid]\'',
				'second_pass_match'		=> '!\[center:$uid\](.*?)\[/center:$uid\]!s',
				'second_pass_replace'	=> '<center>${1}</center>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 0,
				'bbcode_image'			=> '',
				'bbcode_group'			=> '0',
			),
			'align right'		=> array(
				'bbcode_tag'			=> 'align=right',
				'bbcode_order'			=> 34,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_RIGHT_TIP',
				'bbcode_match'			=> '[align=right]{TEXT}[/align]',
				'bbcode_tpl'			=> '<span style="text-align: right; display: block;">{TEXT}</span>',
				'first_pass_match'		=> '!\[align\=right\](.*?)\[/align\]!ies',
				'first_pass_replace'	=> '\'[align=right:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/align:$uid]\'',
				'second_pass_match'		=> '!\[align\=right:$uid\](.*?)\[/align:$uid\]!s',
				'second_pass_replace'	=> '<span style="text-align: right; display: block;">${1}</span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'right.gif',
				'bbcode_group'			=> '0',
			),
			'pre'		=> array(
				'bbcode_tag'			=> 'pre',
				'bbcode_order'			=> 35,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_PRE_TIP',
				'bbcode_match'			=> '[pre]{TEXT}[/pre]',
				'bbcode_tpl'			=> '<pre>{TEXT}</pre>',
				'first_pass_match'		=> '!\[pre\](.*?)\[/pre\]!ies',
				'first_pass_replace'	=> '\'[pre:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/pre:$uid]\'',
				'second_pass_match'		=> '!\[pre:$uid\](.*?)\[/pre:$uid\]!s',
				'second_pass_replace'	=> '<pre>${1}</pre>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'preformat.gif',
				'bbcode_group'			=> '0',
			),
			'break2'		=> array(
				'bbcode_tag'			=> 'break2',
				'bbcode_order'			=> 36,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_BREAK',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'spacer.gif',
				'bbcode_group'			=> '0',
			),
			'tab'		=> array(
				'bbcode_tag'			=> 'tab=',
				'bbcode_order'			=> 37,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_TAB_TIP',
				'bbcode_match'			=> '[tab={NUMBER}]',
				'bbcode_tpl'			=> '<span style="margin-left:{NUMBER}px;"></span>',
				'first_pass_match'		=> '!\[tab\=([0-9]?[0-9]?[0-9])\]!ies',
				'first_pass_replace'	=> '\'[tab=${1}:$uid]\'',
				'second_pass_match'		=> '!\[tab\=([0-9]?[0-9]?[0-9]):$uid\]!s',
				'second_pass_replace'	=> '<span style="margin-left: ${1}px;"></span>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'tab.gif',
				'bbcode_group'			=> '0',
			),
			'dir ltr'		=> array(
				'bbcode_tag'			=> 'dir=ltr',
				'bbcode_order'			=> 38,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_LTR_TIP',
				'bbcode_match'			=> '[dir=ltr]{TEXT}[/dir]',
				'bbcode_tpl'			=> '<bdo dir="ltr">{TEXT}</bdo>',
				'first_pass_match'		=> '!\[dir\=ltr\](.*?)\[/dir\]!ies',
				'first_pass_replace'	=> '\'[dir=ltr:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/dir:$uid]\'',
				'second_pass_match'		=> '!\[dir\=ltr:$uid\](.*?)\[/dir:$uid\]!s',
				'second_pass_replace'	=> '<bdo dir="ltr">${1}</bdo>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'ltr.gif',
				'bbcode_group'			=> '0',
			),
			'dir rtl'		=> array(
				'bbcode_tag'			=> 'dir=rtl',
				'bbcode_order'			=> 39,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_RTL_TIP',
				'bbcode_match'			=> '[dir=rtl]{TEXT}[/dir]',
				'bbcode_tpl'			=> '<bdo dir="rtl">{TEXT}</bdo>',
				'first_pass_match'		=> '!\[dir\=rtl\](.*?)\[/dir\]!ies',
				'first_pass_replace'	=> '\'[dir=rtl:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/dir:$uid]\'',
				'second_pass_match'		=> '!\[dir\=rtl:$uid\](.*?)\[/dir:$uid\]!s',
				'second_pass_replace'	=> '<bdo dir="rtl">${1}</bdo>',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'rtl.gif',
				'bbcode_group'			=> '0',
			),
			'marq up'		=> array(
				'bbcode_tag'			=> 'marq=up',
				'bbcode_order'			=> 40,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQU_TIP',
				'bbcode_match'			=> '[marq=up]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee direction="up" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=up\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=up:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=up:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee direction="up" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marqu.gif',
				'bbcode_group'			=> '0',
			),
			'marq down'		=> array(
				'bbcode_tag'			=> 'marq=down',
				'bbcode_order'			=> 41,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQD_TIP',
				'bbcode_match'			=> '[marq=down]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee direction="down" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=down\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=down:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=down:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee direction="down" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marqd.gif',
				'bbcode_group'			=> '0',
			),
			'marq left'		=> array(
				'bbcode_tag'			=> 'marq=left',
				'bbcode_order'			=> 42,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQL_TIP',
				'bbcode_match'			=> '[marq=left]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee direction="left" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=left\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=left:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=left:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee direction="left" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marql.gif',
				'bbcode_group'			=> '0',
			),
			'marq right'		=> array(
				'bbcode_tag'			=> 'marq=right',
				'bbcode_order'			=> 43,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQR_TIP',
				'bbcode_match'			=> '[marq=right]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee direction="right" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=right\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=right:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=right:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee direction="right" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marqr.gif',
				'bbcode_group'			=> '0',
			),
			'code'		=> array(
				'bbcode_tag'			=> 'code',
				'bbcode_order'			=> 44,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_CODE_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'code.gif',
				'bbcode_group'			=> '0',
			),
			'quote'		=> array(
				'bbcode_tag'			=> 'quote',
				'bbcode_order'			=> 45,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_QUOTE_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'quote.gif',
				'bbcode_group'			=> '0',
			),
			'spoil'		=> array(
				'bbcode_tag'			=> 'spoil',
				'bbcode_order'			=> 46,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_SPOIL_TIP',
				'bbcode_match'			=> '[spoil]{TEXT}[/spoil]',
				'bbcode_tpl'			=> '<div class="spoilwrapper"><div class="spoiltitle"><input id="0" class="btnspoil button2" type="button" value="{L_SPOILER_SHOW}"></div><div class="spoilcontent"><div id="1" style="display: none;">{TEXT}</div></div></div>',
				'first_pass_match'		=> '!\[spoil\](.*?)\[/spoil\]!ies',
				'first_pass_replace'	=> '\'[spoil:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/spoil:$uid]\'',
				'second_pass_match'		=> '!\[spoil:$uid\](.*?)\[/spoil:$uid\]!ies',
				'second_pass_replace'	=> "\$this->spoil_pass('$1')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'spoil.gif',
				'bbcode_group'			=> '0',
			),
			'hidden'		=> array(
				'bbcode_tag'			=> 'hidden',
				'bbcode_order'			=> 47,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_HIDDEN_TIP',
				'bbcode_match'			=> '[hidden]{TEXT}[/hidden]',
				'bbcode_tpl'			=> '<div class="hiddenbox"><span class="hidden">{L_MESSAGE_HIDDEN}:</span><div class="hiddentext">{TEXT}</div></div>',
				'first_pass_match'		=> '!\[hidden\](.*?)\[/hidden\]!ies',
				'first_pass_replace'	=> '\'[hidden:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/hidden:$uid]\'',
				'second_pass_match'		=> '!\[hidden:$uid\](.*?)\[/hidden:$uid\]!ies',
				'second_pass_replace'	=> "\$this->hidden_pass('$1')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'hidden.gif',
				'bbcode_group'			=> '0',
			),
			'mod'		=> array(
				'bbcode_tag'			=> 'mod=',
				'bbcode_order'			=> 48,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MODERATOR_TIP',
				'bbcode_match'			=> '[mod={TEXT1}]{TEXT2}[/mod]',
				'bbcode_tpl'			=> '<table class="ModTable" width="100%" cellspacing="5" cellpadding="0" border="0"><tr><td class="exclamation" rowspan="2">&nbsp;!&nbsp;</td><td class="rowuser">{TEXT1}:</td></tr><tr><td class="rowtext">{TEXT2}</td></tr></table>',
				'first_pass_match'		=> '!\[mod\=(.*?)\](.*?)\[/mod\]!ies',
				'first_pass_replace'	=> '\'[mod=${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/mod:$uid]\'',
				'second_pass_match'		=> '!\[mod\=(.*?):$uid\](.*?)\[/mod:$uid\]!ies',
				'second_pass_replace'	=> "\$this->moderator_pass('$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'moderator.gif',
				'bbcode_group'			=> '5, 4',
			),
			'offtopic'		=> array(
				'bbcode_tag'			=> 'offtopic',
				'bbcode_order'			=> 49,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_OFFTOPIC',
				'bbcode_match'			=> '[offtopic]{TEXT}[/offtopic]',
				'bbcode_tpl'			=> '<div class="OffTopic"><div class="OffTopicTitle">{L_OFFTOPIC} :</div><div class="OffTopicText">{TEXT}</div></div>',
				'first_pass_match'		=> '!\[offtopic\](.*?)\[/offtopic\]!ies',
				'first_pass_replace'	=> '\'[offtopic:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/offtopic:$uid]\'',
				'second_pass_match'		=> '!\[offtopic:$uid\](.*?)\[/offtopic:$uid\]!ies',
				'second_pass_replace'	=> "\$this->offtopic_pass('$1')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'offtopic.gif',
				'bbcode_group'			=> '0',
			),
			'nfo'		=> array(
				'bbcode_tag'			=> 'nfo',
				'bbcode_order'			=> 50,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_NFO_TIP',
				'bbcode_match'			=> '[nfo]{TEXT}[/nfo]',
				'bbcode_tpl'			=> '<table cellspacing="0" cellpadding="0" border="0"><tr><td><span class="genmed"><b>NFO:</b></span></td></tr><tr><td class="nfo">{TEXT}</td></tr></table>',
				'first_pass_match'		=> '!\[nfo\](.*?)\[/nfo\]!ies',
				'first_pass_replace'	=> '\'[nfo:$uid]${1}[/nfo:$uid]\'',
				'second_pass_match'		=> '!\[nfo:$uid\](.*?)\[/nfo:$uid\]!ies',
				'second_pass_replace'	=> "\$this->nfo_pass('$1')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'nfo.gif',
				'bbcode_group'			=> '0',
			),
			'table'		=> array(
				'bbcode_tag'			=> 'table=',
				'bbcode_order'			=> 51,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_TABLE_TIP',
				'bbcode_match'			=> '[table={TEXT1}]{TEXT2}[/table]',
				'bbcode_tpl'			=> '<table style="{TEXT1}" cellspacing="0" cellpadding="0">{TEXT2}</table>',
				'first_pass_match'		=> '!\[table\=(.*?)\](.*?)\[/table\]!ies',
				'first_pass_replace'	=> '\'[table=\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \':$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')) . \'[/table:$uid]\'',
				'second_pass_match'		=> '!\[table\=(.*?):$uid\](.*?)\[/table:$uid\]!ies',
				'second_pass_replace'	=> "\$this->table_pass('$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'table.gif',
				'bbcode_group'			=> '0',
			),
			'division3'		=> array(
				'bbcode_tag'			=> 'division3',
				'bbcode_order'			=> 52,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_DIVISION',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'dots.gif',
				'bbcode_group'			=> '0',
			),
			'anchor'		=> array(
				'bbcode_tag'			=> 'anchor=',
				'bbcode_order'			=> 53,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_ANCHOR',
				'bbcode_match'			=> '[anchor{TEXT1}]{TEXT2}[/anchor]',
				'bbcode_tpl'			=> '<a id="{TEXT1}">{TEXT2}</a>',
				'first_pass_match'		=> '!\[anchor\=(.*?)(\s+|)?(.*?)\](.*?)\[/anchor\]!ies',
				'first_pass_replace'	=> '\'[anchor=${1}${2}${3}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${4}\')) . \'[/anchor:$uid]\'',
				'second_pass_match'		=> '!\[anchor\=(.*?)((\s+)(goto\=|)?(.*?))?:$uid\](.*?)\[/anchor:$uid\]!ies',
				'second_pass_replace'	=> "\$this->anchor_pass('$1', '$5', '$6')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'anchor.gif',
				'bbcode_group'			=> '0',
			),
			'url'		=> array(
				'bbcode_tag'			=> 'url',
				'bbcode_order'			=> 54,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_URL_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'url.gif',
				'bbcode_group'			=> '0',
			),
			'email'		=> array(
				'bbcode_tag'			=> 'email',
				'bbcode_order'			=> 55,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_EMAIL_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'email.gif',
				'bbcode_group'			=> '0',
			),
			'web'		=> array(
				'bbcode_tag'			=> 'web',
				'bbcode_order'			=> 56,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_WEB_TIP',
				'bbcode_match'			=> '[web{TEXT}]{URL}[/web]',
				'bbcode_tpl'			=> '<a src="{URL}">{TEXT}</a>',
				'first_pass_match'		=> '!\[web(\=| )?(.*?)\](.*?)\[/web\]!ies',
				'first_pass_replace'	=> '\'[web${1}${2}:$uid]\' . (!preg_match(\'#^[a-z][a-z\d+\-.]*:/{2}#i\', trim(\'${3}\')) ? \'http://${3}\' : \'${3}\') . \'[/web:$uid]\'',
				'second_pass_match'		=> '!\[web((\=| )?(width\=)?([0-9]?[0-9]?[0-9][(%|\w+)?])(,| )(height\=)?([0-9]?[0-9]?[0-9][(%|\w+)?]))?:$uid\](.*?)\[/web:$uid\]!s',
				'second_pass_replace'	=> '<iframe width="${4}" height="${7}" src="${8}" security="restricted" style="font-size: 2px;"></iframe>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'web.gif',
				'bbcode_group'			=> '0',
			),
			'ed2k'		=> array(
				'bbcode_tag'			=> 'url=',
				'bbcode_order'			=> 57,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_ED2K_TIP',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'emule.gif',
				'bbcode_group'			=> '0',
			),
			'img'		=> array(
				'bbcode_tag'			=> 'img=',
				'bbcode_order'			=> 58,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_IMG_TIP',
				'bbcode_match'			=> '[img{TEXT}]{URL}[/img]',
				'bbcode_tpl'			=> '<img src="{URL}" alt="{L_IMAGE}" />',
				'first_pass_match'		=> '!\[img\=(left|center|right|float-left|float-center|float-right)?\](.*?)\[/img\]!ies',
				'first_pass_replace'	=> '\'[img=${1}:$uid]${2}[/img:$uid]\'',
				'second_pass_match'		=> '!\[img\=(left|center|right|float-left|float-center|float-right)?:$uid\](.*?)\[/img:$uid\]!ies',
				'second_pass_replace'	=> "\$this->img_pass('$1', '$2')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'img.gif',
				'bbcode_group'			=> '0',
			),
			'thumbnail'		=> array(
				'bbcode_tag'			=> 'thumbnail',
				'bbcode_order'			=> 59,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_THUMBNAIL_TIP',
				'bbcode_match'			=> '[thumbnail{TEXT}]{URL}[/thumbnail]',
				'bbcode_tpl'			=> '<img src="{URL}" border="0" align="{TEXT}"/>',
				'first_pass_match'		=> '!\[thumbnail(\=| )?(left|center|right|float-left|float-center|float-right)?\](.*?)\[/thumbnail\]!ies',
				'first_pass_replace'	=> '\'[thumbnail${1}${2}:$uid]${3}[/thumbnail:$uid]\'',
				'second_pass_match'		=> '!\[thumbnail(\=| )?(left|center|right|float-left|float-center|float-right)?:$uid\](.*?)\[/thumbnail:$uid\]!ies',
				'second_pass_replace'	=> "\$this->thumb_pass('$2', '$3')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'thumb.gif',
				'bbcode_group'			=> '0',
			),
			'imgshack'		=> array(
				'bbcode_tag'			=> 'imgshack',
				'bbcode_order'			=> 60,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_IMGSHACK_MOVER',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'imgshack.gif',
				'bbcode_group'			=> '0',
			),
			'rapidshare'		=> array(
				'bbcode_tag'			=> 'rapidshare',
				'bbcode_order'			=> 61,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_RAPIDSHARE_TIP',
				'bbcode_match'			=> '[rapidshare]{URL}[/rapidshare]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[rapidshare\](.*?)\[/rapidshare\]!ies',
				'first_pass_replace'	=> '\'[rapidshare:$uid]${1}[/rapidshare:$uid]\'',
				'second_pass_match'		=> '!\[rapidshare:$uid\](.*?)\[/rapidshare:$uid\]!ies',
				'second_pass_replace'	=> "\$this->rapidshare_pass('$1')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'rapidshare.gif',
				'bbcode_group'			=> '0',
			),
			'testlink'		=> array(
				'bbcode_tag'			=> 'testlink',
				'bbcode_order'			=> 62,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_TESTLINK_TIP',
				'bbcode_match'			=> '[testlink]{TEXT}[/testlink]',
				'bbcode_tpl'			=> '<a src="{TEXT}">{TEXT}</a>',
				'first_pass_match'		=> '!\[testlink\](.*?)\[/testlink\]!ies',
				'first_pass_replace'	=> '\'[testlink:$uid]${1}[/testlink:$uid]\'',
				'second_pass_match'		=> '!\[testlink:$uid\](.*?)\[/testlink:$uid\]!ies',
				'second_pass_replace'	=> "\$this->testlink_pass('$1')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'testlink.gif',
				'bbcode_group'			=> '0',
			),
			'click'		=> array(
				'bbcode_tag'			=> 'click',
				'bbcode_order'			=> 63,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_CLICK_TIP',
				'bbcode_match'			=> '[click{URL}]{URL}[/click]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[click(\=(.*?))?\](.*?)\[/click\]!ies',
				'first_pass_replace'	=> '\'[click${1}:$uid]${3}[/click:$uid]\'',
				'second_pass_match'		=> '!\[click(\=(.*?))?:$uid\](.*?)\[/click:$uid\]!ies',
				'second_pass_replace'	=> "\$this->click_pass('$2', '$3')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'click.gif',
				'bbcode_group'			=> '0',
			),
			'search'		=> array(
				'bbcode_tag'			=> 'search',
				'bbcode_order'			=> 64,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_SEARCH_TIP',
				'bbcode_match'			=> '[search{TEXT1}]{TEXT2}[/search]',
				'bbcode_tpl'			=> '<a src="{TEXT1}">{TEXT2}</a>',
				'first_pass_match'		=> '!\[search(\=(msn|msnlive|yahoo|google|altavista|lycos|wikipedia))?\](.*?)\[/search\]!ies',
				'first_pass_replace'	=> '\'[search${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${3}\')) . \'[/search:$uid]\'',
				'second_pass_match'		=> '!\[search(\=(.*?))?:$uid\](.*?)\[/search:$uid\]!ies',
				'second_pass_replace'	=> "\$this->search_pass('$1', '$2', '$3')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'search.gif',
				'bbcode_group'			=> '0',
			),
			'division4'		=> array(
				'bbcode_tag'			=> 'division4',
				'bbcode_order'			=> 65,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_DIVISION',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'dots.gif',
				'bbcode_group'			=> '0',
			),
			'BBvideo'		=> array(
				'bbcode_tag'			=> 'BBvideo',
				'bbcode_order'			=> 66,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_BBVIDEO_TIP',
				'bbcode_match'			=> '[BBvideo{TEXT1}]{TEXT2}[/BBvideo]',
				'bbcode_tpl'			=> '<a src="{TEXT1}">{TEXT2}</a>',
				'first_pass_match'		=> '!\[BBvideo(\=| )?(.*?)\](.*?)\[/BBvideo\]!ies',
				'first_pass_replace'	=> '\'[BBvideo${1}${2}:$uid]\' . trim(\'${3}\') . \'[/BBvideo:$uid]\'',
				'second_pass_match'		=> '!\[BBvideo((\=| )?(width\=)?([0-9]?[0-9]?[0-9])(,| )(height\=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/BBvideo:$uid\]!ies',
				'second_pass_replace'	=> "\$this->BBvideo_pass('$8', '$4', '$7')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'bbvideo.gif',
				'bbcode_group'			=> '0',
			),
			'scrippet'		=> array(
				'bbcode_tag'			=> 'scrippet',
				'bbcode_order'			=> 67,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_SCRIPPET',
				'bbcode_match'			=> '[scrippet]{TEXT}[/scrippet]',
				'bbcode_tpl'			=> '<div id="scrippet"><div class="scrippet-shadow"><div class="inner-shadow">{SCRIPPET_TEXT}<br /></div></div></div>',
				'first_pass_match'		=> '!\[scrippet\](.*?)\[/scrippet\]!ies',
				'first_pass_replace'	=> '\'[scrippet:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/scrippet:$uid]\'',
				'second_pass_match'		=> '!\[scrippet:$uid\](.*?)\[/scrippet:$uid\]!ies',
				'second_pass_replace'	=> "\$this->scrippets_pass('$1')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'scrippet.gif',
				'bbcode_group'			=> '0',
			),

			'flash'		=> array(
				'bbcode_tag'			=> 'flash',
				'bbcode_order'			=> 68,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_FLASH_TIP',
				'bbcode_match'			=> '[flash{TEXT}]{URL}[/flash]',
				'bbcode_tpl'			=> '<a src="{URL}">{TEXT}</a>',
				'first_pass_match'		=> '!\[flash(\=| )?(.*?)\](.*?)\[/flash\]!ies',
				'first_pass_replace'	=> '\'[flash${1}${2}:$uid]\' . trim(\'${3}\') . \'[/flash:$uid]\'',
				'second_pass_match'		=> '!\[flash((\=| )?(width\=)?([0-9]?[0-9]?[0-9])(,| )(height\=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/flash:$uid\]!ies',
				'second_pass_replace'	=> "\$this->flash_pass('$4', '$7', '$8')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'flash.gif',
				'bbcode_group'			=> '0',
			),
			'flv'		=> array(
				'bbcode_tag'			=> 'flv',
				'bbcode_order'			=> 69,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_FLV_TIP',
				'bbcode_match'			=> '[flv{TEXT}]{URL}[/flv]',
				'bbcode_tpl'			=> '<a src="{URL}">{TEXT}</a>',
				'first_pass_match'		=> '!\[flv(\=| )?(.*?)\](.*?)\[/flv\]!ies',
				'first_pass_replace'	=> '\'[flv${1}${2}:$uid]\' . trim(\'${3}\') . \'[/flv:$uid]\'',
				'second_pass_match'		=> '!\[flv((\=| )?(width\=)?([0-9]?[0-9]?[0-9])(,| )(height\=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/flv:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('./images/player.swf', '\${4}', '\${7}', 'movie=\${8}&fgcolor=0xff0000&autoload=off&volume=70')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'flashflv.gif',
				'bbcode_group'			=> '0',
			),
			'video'		=> array(
				'bbcode_tag'			=> 'video',
				'bbcode_order'			=> 70,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_VIDEO_TIP',
				'bbcode_match'			=> '[video{TEXT}]{URL}[/video]',
				'bbcode_tpl'			=> '<a src="{URL}">{TEXT}</a>',
				'first_pass_match'		=> '!\[video(\=| )?(.*?)\](.*?)\[/video\]!ies',
				'first_pass_replace'	=> '\'[video${1}${2}:$uid]\' . trim(\'${3}\') . \'[/video:$uid]\'',
				'second_pass_match'		=> '!\[video((\=| )?(width\=)?([0-9]?[0-9]?[0-9])(,| )(height\=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/video:$uid\]!s',
				'second_pass_replace'	=> '<object width="${4}" height="${7}" type="video/x-ms-wmv"><param name="filename" value="${8}"><param name="Showcontrols" value="true"><param name="autoStart" value="false"><param name="autostart" value="false" /><param name="showcontrols" value="true" /><param name="showdisplay" value="false" /><param name="showstatusbar" value="false" /><param name="autosize" value="true" /><param name="visible" value="true" /><param name="animationstart" value="false" /><param name="loop" value="false" /><embed type="application/x-mplayer2" src="${8}" width="${4}" height="${7}" controller="true" showcontrols="true" showdisplay="false" showstatusbar="true" autosize="true" autostart="false" visible="true" animationstart="false" loop="false"></embed></object><br />',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'video.gif',
				'bbcode_group'			=> '0',
			),
			'stream'		=> array(
				'bbcode_tag'			=> 'stream',
				'bbcode_order'			=> 71,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_STREAM_TIP',
				'bbcode_match'			=> '[stream]{URL}[/stream]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[stream\](.*?)\[/stream\]!ies',
				'first_pass_replace'	=> '\'[stream:$uid]\' . trim(\'${1}\') . \'[/stream:$uid]\'',
				'second_pass_match'		=> '!\[stream:$uid\](.*?)\[/stream:$uid\]!s',
				'second_pass_replace'	=> '<object width="320" height="45" type="video/x-ms-wmv"><param name="filename" value="${1}"><param name="Showcontrols" value="true"><param name="autoStart" value="false"><param name="autostart" value="false" /><param name="showcontrols" value="true" /><param name="showdisplay" value="false" /><param name="showstatusbar" value="false" /><param name="autosize" value="true" /><param name="visible" value="true" /><param name="animationstart" value="false" /><param name="loop" value="false" /><embed type="application/x-mplayer2" src="${1}" width="320" height="45" controller="true" showcontrols="true" showdisplay="false" showstatusbar="true" autosize="true" autostart="false" visible="true" animationstart="false" loop="false"></embed></object><br />',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'sound.gif',
				'bbcode_group'			=> '0',
			),
			'quicktime'		=> array(
				'bbcode_tag'			=> 'quicktime',
				'bbcode_order'			=> 72,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_QUICKTIME_TIP',
				'bbcode_match'			=> '[quicktime{TEXT}]{URL}[/quicktime]',
				'bbcode_tpl'			=> '<a src="{URL}">{TEXT}</a>',
				'first_pass_match'		=> '!\[quicktime(\=| )?(.*?)\](.*?)\[/quicktime\]!ies',
				'first_pass_replace'	=> '\'[quicktime${1}${2}:$uid]\' . trim(\'${3}\') . \'[/quicktime:$uid]\'',
				'second_pass_match'		=> '!\[quicktime((\=| )?(width\=)?([0-9]?[0-9]?[0-9])(,| )(height\=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/quicktime:$uid\]!s',
				'second_pass_replace'	=> '<object width="${4}" height="${7}"><param name="type" value="video/quicktime" /><param name="src" value="${8}" /><param name="controller" value="true" /><param name="autoplay" value="false" /><param name="loop" value="false" /><embed src="${8}" pluginspage="http://www.apple.com/quicktime/download/" enablejavascript="true" controller="true" loop="false" width="${4}" height="${7}" type="video/quicktime" autoplay="false"></embed></object><br />',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'quicktime.gif',
				'bbcode_group'			=> '0',
			),
			'ram'		=> array(
				'bbcode_tag'			=> 'ram',
				'bbcode_order'			=> 73,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_RAM_TIP',
				'bbcode_match'			=> '[ram{TEXT}]{URL}[/ram]',
				'bbcode_tpl'			=> '<a src="{URL}">{TEXT}</a>',
				'first_pass_match'		=> '!\[ram(\=| )?(.*?)\](.*?)\[/ram\]!ies',
				'first_pass_replace'	=> '\'[ram${1}${2}:$uid]\' . trim(\'${3}\') . \'[/ram:$uid]\'',
				'second_pass_match'		=> '!\[ram((\=| )?(width\=)?([0-9]?[0-9]?[0-9])(,| )(height\=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/ram:$uid\]!s',
				'second_pass_replace'	=> '<object width="${4}" height="${7}" type="audio/x-pn-realaudio-plugin" data="${8}"><param name="src" value="${8}" /><param name="autostart_step" value="false" /><param name="autostart" value="false" /><param name="controls" value="ImageWindow" /><param name="console" value="ctrls_${8}" /><param name="prefetch" value="false" /></object><br /><object type="audio/x-pn-realaudio-plugin" width="${4}" height="36"><param name="controls" value="ControlPanel" /><param name="console" value="ctrls_${8}" /></object><br />',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'ram.gif',
				'bbcode_group'			=> '0',
			),
			'gvideo'		=> array(
				'bbcode_tag'			=> 'gvideo',
				'bbcode_order'			=> 74,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_GVIDEO_TIP',
				'bbcode_match'			=> '[GVideo]{URL}[/GVideo]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[Gvideo\]http://video.google.(.*?)/videoplay\?docid\=(.*?)\[/Gvideo\]!ies',
				'first_pass_replace'	=> '\'[Gvideo:$uid]http://video.google.${1}/videoplay?docid=${2}[/Gvideo:$uid]\'',
				'second_pass_match'		=> '!\[Gvideo:$uid\]http://video.google.(.*?)/videoplay\?docid\=(.*?)\[/Gvideo:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://video.google.\${1}/googleplayer.swf?docid=\${2}', '425', '350')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'googlevid.gif',
				'bbcode_group'			=> '0',
			),
			'youtube'		=> array(
				'bbcode_tag'			=> 'youtube',
				'bbcode_order'			=> 75,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_YOUTUBE_TIP',
				'bbcode_match'			=> '[youtube]{URL}[/youtube]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[youtube\]http://((.*?)?)youtube.com/watch\?v\=([0-9A-Za-z-_]{11})[^[]*\[/youtube\]!ies',
				'first_pass_replace'	=> '\'[youtube:$uid]http://${1}youtube.com/watch?v=${3}[/youtube:$uid]\'',
				'second_pass_match'		=> '!\[youtube:$uid\]http://((.*?)?)youtube.com/watch\?v\=([0-9A-Za-z-_]{11})[^[]*\[/youtube:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://\${2}youtube.com/v/\${3}', '425', '350')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'youtube.gif',
				'bbcode_group'			=> '0',
			),
			'veoh'		=> array(
				'bbcode_tag'			=> 'veoh',
				'bbcode_order'			=> 76,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_VEOH_TIP',
				'bbcode_match'			=> '[veoh]{URL}[/veoh]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[veoh\]http://(.*?).veoh.com/([A-Za-z-_\-/]+)?/([0-9A-Za-z-_]+)\[/veoh\]!ies',
				'first_pass_replace'	=> '\'[veoh:$uid]http://${1}.veoh.com/${2}/${3}[/veoh:$uid]\'',
				'second_pass_match'		=> '!\[veoh:$uid\]http://(.*?).veoh.com/([A-Za-z-_\-/]+)?/([0-9A-Za-z-_]+)\[/veoh:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://www.veoh.com/static/swf/webplayer/WebPlayer.swf?version=AFrontend.5.5.2.1030&permalinkId=\${3}&player=videodetailsembedded&videoAutoPlay=0&id=anonymous', '540', '438')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'veoh.gif',
				'bbcode_group'			=> '0',
			),
			'collegehumor'		=> array(
				'bbcode_tag'			=> 'collegehumor',
				'bbcode_order'			=> 77,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_COLLEGE_TIP',
				'bbcode_match'			=> '[collegehumor]{URL}[/collegehumor]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[collegehumor\]http://www.collegehumor.com/video:(.*?)\[/collegehumor\]!ies',
				'first_pass_replace'	=> '\'[collegehumor:$uid]http://www.collegehumor.com/video:${1}[/collegehumor:$uid]\'',
				'second_pass_match'		=> '!\[collegehumor:$uid\]http://www.collegehumor.com/video:(.*?)\[/collegehumor:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://www.collegehumor.com/moogaloop/moogaloop.swf?clip_id=\${1}&fullscreen=1', '480', '360')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'collegehumor.gif',
				'bbcode_group'			=> '0',
			),
			'dm'		=> array(
				'bbcode_tag'			=> 'dm',
				'bbcode_order'			=> 78,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_DMOTION_TIP',
				'bbcode_match'			=> '[dm]{URL}[/dm]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[dm\](.*?)\[/dm\]!ies',
				'first_pass_replace'	=> '\'[dm:$uid]\' . trim(\'${1}\') . \'[/dm:$uid]\'',
				'second_pass_match'		=> '!\[dm:$uid\]http://www.dailymotion.com/(.*?)/(.*?)\[/dm:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://www.dailymotion.com/swf/video/\${2}', '420', '352')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'dailymotion.gif',
				'bbcode_group'			=> '0',
			),
			'gamespot'		=> array(
				'bbcode_tag'			=> 'gamespot',
				'bbcode_order'			=> 79,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_GAMESPOT_TIP',
				'bbcode_match'			=> '[gamespot]{URL}[/gamespot]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[gamespot\]http://www.gamespot.com/video/(.*?)/(.*?)\[/gamespot\]!ies',
				'first_pass_replace'	=> '\'[gamespot:$uid]http://www.gamespot.com/video/${1}/${2}[/gamespot:$uid]\'',
				'second_pass_match'		=> '!\[gamespot:$uid\]http://www.gamespot.com/video/(.*?)/(.*?)\[/gamespot:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/proteus2.swf', '432', '355', 'skin=http://image.com.com/gamespot/images/cne_flash/production/media_player/proteus/one/skins/gamespot.png&paramsURI=http%3A%2F%2Fwww.gamespot.com%2Fpages%2Fvideo_player%2Fxml.php%3Fid%3D\${2}%26mode%3Dembedded%26width%3D{WIDTH}%26height%3D{HEIGHT}%2F')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'gamespot.gif',
				'bbcode_group'			=> '0',
			),
			'gametrailers'		=> array(
				'bbcode_tag'			=> 'gametrailers',
				'bbcode_order'			=> 80,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_GAMETRAILERS_TIP',
				'bbcode_match'			=> '[gametrailers]{URL}[/gametrailers]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[gametrailers\]http://www.gametrailers.com/player/(.*?).html\[/gametrailers\]!ies',
				'first_pass_replace'	=> '\'[gametrailers:$uid]http://www.gametrailers.com/player/${1}.html[/gametrailers:$uid]\'',
				'second_pass_match'		=> '!\[gametrailers:$uid\]http://www.gametrailers.com/player/(.*?).html\[/gametrailers:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://www.gametrailers.com/remote_wrap.php?mid=\${1}', '480', '392')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'gametrailers.gif',
				'bbcode_group'			=> '0',
			),
			'ignvideo'		=> array(
				'bbcode_tag'			=> 'ignvideo',
				'bbcode_order'			=> 81,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_IGNVIDEO_TIP',
				'bbcode_match'			=> '[ignvideo]{URL}[/ignvideo]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[ignvideo\](.*?)\[/ignvideo\]!ies',
				'first_pass_replace'	=> '\'[ignvideo:$uid]${1}[/ignvideo:$uid]\'',
				'second_pass_match'		=> '!\[ignvideo:$uid\](.*?)\[/ignvideo:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://videomedia.ign.com/ev/ev.swf', '433', '360', '\${1}')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'ign.gif',
				'bbcode_group'			=> '0',
			),
			'liveleak'		=> array(
				'bbcode_tag'			=> 'liveleak',
				'bbcode_order'			=> 82,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_LIVELEAK_TIP',
				'bbcode_match'			=> '[liveleak]{URL}[/liveleak]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[liveleak\]http://www.liveleak.com/view\?i\=(.*?)\[/liveleak\]!ies',
				'first_pass_replace'	=> '\'[liveleak:$uid]http://www.liveleak.com/view?i=${1}[/liveleak:$uid]\'',
				'second_pass_match'		=> '!\[liveleak:$uid\]http://www.liveleak.com/view\?i\=(.*?)\[/liveleak:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://www.liveleak.com/e/\${1}', '450', '370')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'liveleak.gif',
				'bbcode_group'			=> '0',
			),
		/**	Deprecated in v3.0.7
			'upload'		=> array(
				'bbcode_tag'			=> 'upload',
				'bbcode_order'			=> 83,
				'bbcode_id'				=> 0,
				'bbcode_helpline'		=> 'ABBC3_UPLOAD_MOVER',
				'bbcode_match'			=> '.',
				'bbcode_tpl'			=> '.',
				'first_pass_match'		=> '.',
				'first_pass_replace'	=> '.',
				'second_pass_match'		=> '.',
				'second_pass_replace'	=> '.',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'upload.gif',
				'bbcode_group'			=> '5,4',
			),
		**/
		/**	Deprecated in v1.0.11
			'html'		=> array(
				'bbcode_tag'			=> 'html',
				'bbcode_order'			=> 84,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_HTML_TIP',
				'bbcode_match'			=> '[html]{TEXT}[/html]',
				'bbcode_tpl'			=> '<code>{TEXT}</code>',
				'first_pass_match'		=> '!\[html\](.*?)\[/html\]!ies',
				'first_pass_replace'	=> '\'[html:$uid]${1}[/html:$uid]\'',
				'second_pass_match'		=> '!\[html:$uid\](.*?)\[/html:$uid\]!ies',
				'second_pass_replace'	=> 'str_replace(array("\r\n", "\n", "<br />", "<br />"), "\r", htmlspecialchars_decode(\'$1\'))',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'html.gif',
				'bbcode_group'			=> '5',
			),
		**/
		),
		'3.0.8-pl1' => array(
			'search'		=> array(
				'bbcode_tag'			=> 'search',
				'bbcode_order'			=> 64,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_SEARCH_TIP',
				'bbcode_match'			=> '[search{TEXT1}]{TEXT2}[/search]',
				'bbcode_tpl'			=> '<a src="{TEXT1}">{TEXT2}</a>',
				'first_pass_match'		=> '!\[search(\=(bing|yahoo|google|altavista|lycos|wikipedia))?\](.*?)\[/search\]!ies',
				'first_pass_replace'	=> '\'[search${1}:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${3}\')) . \'[/search:$uid]\'',
				'second_pass_match'		=> '!\[search(\=(.*?))?:$uid\](.*?)\[/search:$uid\]!ies',
				'second_pass_replace'	=> "\$this->search_pass('$1', '$2', '$3')",
				'display_on_posting'	=> 1,
				'display_on_pm'			=> 1,
				'display_on_sig'		=> 1,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'search.gif',
				'bbcode_group'			=> '0',
			),
			'flv'		=> array(
				'bbcode_tag'			=> 'flv',
				'bbcode_order'			=> 69,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_FLV_TIP',
				'bbcode_match'			=> '[flv{TEXT}]{URL}[/flv]',
				'bbcode_tpl'			=> '<a src="{URL}">{TEXT}</a>',
				'first_pass_match'		=> '!\[flv(\=| )?(.*?)\](.*?)\[/flv\]!ies',
				'first_pass_replace'	=> '\'[flv${1}${2}:$uid]\' . trim(\'${3}\') . \'[/flv:$uid]\'',
				'second_pass_match'		=> '!\[flv((\=| )?(width\=)?([0-9]?[0-9]?[0-9])(,| )(height\=)?([0-9]?[0-9]?[0-9]))?:$uid\](.*?)\[/flv:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('./images/player.swf', '\${4}', '\${7}', 'movie=\${8}&bgcolor=0x666666&fgcolor=0x000000&autoload=off&volume=70')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'flashflv.gif',
				'bbcode_group'			=> '0',
			),
			'ignvideo'		=> array(
				'bbcode_tag'			=> 'ignvideo',
				'bbcode_order'			=> 81,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_IGNVIDEO_TIP',
				'bbcode_match'			=> '[ignvideo]{URL}[/ignvideo]',
				'bbcode_tpl'			=> '<a src="{URL}">{URL}</a>',
				'first_pass_match'		=> '!\[ignvideo\](.*?)objects/(.*?)/(.*?)\[/ignvideo\]!ies',
				'first_pass_replace'	=> '\'[ignvideo:$uid]${1}objects/${2}/${3}[/ignvideo:$uid]\'',
				'second_pass_match'		=> '!\[ignvideo:$uid\](.*?)objects/(.*?)/(.*?)\[/ignvideo:$uid\]!sie',
				'second_pass_replace'	=> "\$this->auto_embed_video('http://videomedia.ign.com/ev/ev.swf?object_ID=\${2}', '433', '360')",
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'ign.gif',
				'bbcode_group'			=> '0',
			),
			'marq up'		=> array(
				'bbcode_tag'			=> 'marq=up',
				'bbcode_order'			=> 40,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQU_TIP',
				'bbcode_match'			=> '[marq=up]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee class="abbc3-marquee" direction="up" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=up\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=up:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=up:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee class="abbc3-marquee" direction="up" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marqu.gif',
				'bbcode_group'			=> '0',
			),
			'marq down'		=> array(
				'bbcode_tag'			=> 'marq=down',
				'bbcode_order'			=> 41,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQD_TIP',
				'bbcode_match'			=> '[marq=down]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee class="abbc3-marquee" direction="down" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=down\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=down:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=down:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee class="abbc3-marquee" direction="down" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marqd.gif',
				'bbcode_group'			=> '0',
			),
			'marq left'		=> array(
				'bbcode_tag'			=> 'marq=left',
				'bbcode_order'			=> 42,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQL_TIP',
				'bbcode_match'			=> '[marq=left]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee class="abbc3-marquee" direction="left" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=left\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=left:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=left:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee class="abbc3-marquee" direction="left" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marql.gif',
				'bbcode_group'			=> '0',
			),
			'marq right'		=> array(
				'bbcode_tag'			=> 'marq=right',
				'bbcode_order'			=> 43,
				'bbcode_id'				=> 1,
				'bbcode_helpline'		=> 'ABBC3_MARQR_TIP',
				'bbcode_match'			=> '[marq=right]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee class="abbc3-marquee" direction="right" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=right\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=right:$uid]\' . str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')) . \'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=right:$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee class="abbc3-marquee" direction="right" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${1}</marquee>',
				'display_on_posting'	=> 0,
				'display_on_pm'			=> 0,
				'display_on_sig'		=> 0,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'marqr.gif',
				'bbcode_group'			=> '0',
			),
		),
		/**
		'3.0.9' => array(
			'bbcode_name' => array(
				'bbcode_tag'			=> '',
				'bbcode_order'			=> nn,
				'bbcode_id'				=> true/false,
				'bbcode_helpline'		=> 'ABBC3_XXX_TIP',
				'bbcode_match'			=> '[xxx]{XXX}[/xxx]',
				'bbcode_tpl'			=> '<xxx>{XXX}</xxx>',
				'first_pass_match'		=> '!\[xxx\](.*?)\[/xxx\]!ies',
				'first_pass_replace'	=> '\'[xxx:$uid]${1}[/xxx:$uid]\'',
				'second_pass_match'		=> '!\[xxx:$uid\](.*?)\[/xxx:$uid\]!ies',
				'second_pass_replace'	=> 'str_replace(array("\r\n", "\n", "<br />", "<br />"), "\r", htmlspecialchars_decode(\'$1\'))',
				'display_on_posting'	=> true/false,
				'display_on_pm'			=> true/false,
				'display_on_sig'		=> true/false,
				'abbcode'				=> 1,
				'bbcode_image'			=> 'xxxx.gif',
				'bbcode_group'			=> '0',
			),
		),
		**/
	);

	return $bbcode_data[$version];

}

?>