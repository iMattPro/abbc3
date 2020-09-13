<?php
/**
 *
 * Advanced BBCode Box [Spanish - Casual Honorifics]
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
]);
