<?php
/**
*
* @package phpBB3
* @copyright (c) 2012 MSSTI Advanced BBCodes Box 3 by leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

// Permission check
if (!isset($user->data['session_admin']) || !$user->data['session_admin'] || !$auth->acl_get('a_bbcode'))
{
	trigger_error('NO_AUTH_ADMIN');
}

// Set some common vars
$action	= request_var('action', '');

// Based on code from Subject Prefix >> copyright (c) 2010 Erik Frèrejean ( erikfrerejean@phpbb.com ) http://www.erikfrerejean.nl
if ($action == 'move')
{
	// Get the table
	$tablename = request_var('tablename', '');

	// Fetch the posted list
	$bbcodeslist = request_var($tablename, array(0 => ''));

	// Run through the list
	foreach ($bbcodeslist as $order => $bbcode_id)
	{
		// First one is the header, skip it
		if ($order == 0)
		{
			continue;
		}

		// Update in the db
		$db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET bbcode_order = ' . $order . ' WHERE bbcode_id = ' . (int) $bbcode_id);
	}

	// echo success result
	echo 'success';
}

garbage_collection();
exit_handler();

?>