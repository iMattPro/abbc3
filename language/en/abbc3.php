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
));
