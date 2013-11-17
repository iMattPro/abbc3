<?php
/**
*
* ie6nomore [English]
*
* @package language
* @copyright (c) 2013 Matt Friedman 
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	// Hidden BBcode
	'HIDDEN_ON'					=> 'Hidden Content',
	'HIDDEN_OFF'				=> 'Hidden Content (for members only)',
	'HIDDEN_EXPLAIN'			=> 'This board requires you to be registered and logged-in to view hidden content.',

	// Font BBcode
	'ABBC3_FONT_BBCODE'			=> 'Font Menu',
	'ABBC3_FONT_FANCY'			=> 'Fancy fonts',
	'ABBC3_FONT_SAFE'			=> 'Safe fonts',
	'ABBC3_FONT_WIN'			=> 'Windows fonts',

	// Utility BBcodes
	'ABBC3_COPY_BBCODE'			=> 'Copy selected text',
	'ABBC3_PASTE_BBCODE'		=> 'Paste copied text',
	'ABBC3_PASTE_ERROR'			=> 'You must first copy a selection of text, then paste it',
	'ABBC3_PLAIN_BBCODE'		=> 'Remove all BBcode tags from the selected text',

	'ABBC3_ERROR'				=> 'Error',
	'ABBC3_NOSELECT_ERROR'		=> 'No text was seleted.',

	'ABBC3_BBCODE_ORDERED'		=> 'The BBCode order has been resynchronised.',
));
