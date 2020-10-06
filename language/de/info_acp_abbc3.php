<?php
/**
 *
 * Advanced BBCode Box [German]
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
	'ACP_ABBC3_SETTINGS'	=> 'Einstellungen',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Advanced BBCode Box konnte das folgende Verzeichnis nicht erstellen:</strong><br>%s',
]);
