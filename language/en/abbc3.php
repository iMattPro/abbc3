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
	'SAMPLE_TEXT'				=> 'The quick brown fox jumps over the lazy dog',
));

$lang = array_merge($lang, array(
	// Hidden
	'ABBC3_HIDDEN_MOVER'		=> 'Hide content from unregistered guests',
	'ABBC3_HIDDEN_TIP'			=> '[hidden]text[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=> 'Hidden Content (for members only)',
	'HIDDEN_ON'					=> 'Hidden Content',
	'HIDDEN_EXPLAIN'			=> 'This board requires you to be registered and logged-in to view hidden content.',
));
