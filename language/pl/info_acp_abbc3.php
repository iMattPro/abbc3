<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 * Tłumaczenie na Polski: Tomasz Hetman - ToTemat YT
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
	'ACP_ABBC3_SETTINGS'	=> 'Ustawienia',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Advanced BBCode Box nie był w stanie utworzyć katalogu:</strong><br>%s',
]);
