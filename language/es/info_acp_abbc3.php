<?php
/**
 *
 * Advanced BBCode Box [Spanish - Formal Honorifics]
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
	'ACP_ABBC3_MODULE'		=> 'Caja de BBCode Avanzado',
	'ACP_ABBC3_SETTINGS'	=> 'Ajustes',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Advanced BBCode Box was unable to create the directory:</strong><br>%s',
]);
