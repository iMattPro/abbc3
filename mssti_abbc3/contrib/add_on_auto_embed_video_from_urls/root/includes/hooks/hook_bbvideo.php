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
if (!defined('IN_PHPBB'))
{
	exit;
}

//Don't load hook if not installed.
if (!isset($config['ABBC3_MOD']))
{
	return;
}

/**
 * A hook that is used to change the behavior of phpBB just before the templates
 * are displayed. - This code block derived from ReIMG (c) 2011 DavidIQ.com
 * @param	phpbb_hook	$hook	the phpBB hook object
 * @return	void
 */
function url_to_bbvideo_hook(&$hook)
{
	global $template, $phpEx, $phpbb_root_path, $user;

	$page_name = substr($user->page['page_name'], 0, strpos($user->page['page_name'], '.'));

	if (!defined('URL_TO_BBVIDEO') && in_array($page_name, array('memberlist', 'posting', 'ucp', 'mcp', 'viewtopic')))
	{
		define('URL_TO_BBVIDEO', true);
	}

	//This will prevent further loading of this hook. If you need this hook loaded on a page other than
	//the ones in the above array then add a define('URL_TO_BBVIDEO', true) to the top of your page.
	if (!defined('URL_TO_BBVIDEO') || URL_TO_BBVIDEO == false)
	{
		return;
	}

	if (!function_exists('url_to_bbvideo'))
	{
		if (!class_exists('bbcode'))
		{
			include($phpbb_root_path . 'includes/bbcode.' . $phpEx);		
		}
		else
		{	
			include($phpbb_root_path . 'includes/abbcode.' . $phpEx);
		}
	}

	$user->add_lang('mods/abbcode');

	//Message preview
	process_template_block_bbvideo('', 'PREVIEW_MESSAGE');

	//Post preview in MCP
	process_template_block_bbvideo('', 'POST_PREVIEW');

	//The actual message
	process_template_block_bbvideo('', 'MESSAGE');

	//Topic review area shown when posting a reply
	process_template_block_bbvideo('topic_review_row', 'MESSAGE');

	//Message history section
	process_template_block_bbvideo('history_row', 'MESSAGE');

	//postrow needs some special handling
	if (!empty($template->_tpldata['postrow']))
	{
		foreach ($template->_tpldata['postrow'] as $row => $data)
		{
			if (isset($data['MESSAGE']))
			{
				// Alter the array
				$template->alter_block_array('postrow', array(
					'MESSAGE' => url_to_bbvideo($data['MESSAGE']),
				), $row, 'change');
			}
		}
	}
}

// Register
if (isset($config['ABBC3_MOD']) && $config['ABBC3_MOD'])
{
	$phpbb_hook->register(array('template', 'display'), 'url_to_bbvideo_hook');
}