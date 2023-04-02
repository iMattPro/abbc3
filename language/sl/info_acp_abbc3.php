<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 * Slovenian Translation - Marko K.(max, max-ima,...)
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
	'ACP_ABBC3_MODULE'		=> 'Napredno polje BBKode/<br>(Advanced BBCode Box)',
	'ACP_ABBC3_SETTINGS'	=> 'Nastavitve',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Napredno polje BBKode ni mogel ustvariti imenika:</strong><br>%s',
]);
