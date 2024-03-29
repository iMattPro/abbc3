<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'ACP_ABBC3_MODULE'		=> 'Advanced BBCode Box',
	'ACP_ABBC3_SETTINGS'	=> 'Impostazioni',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Advanced BBCode Box non ha potuto creare la cartella:</strong><br>%s',
]);
