<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
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
	'ACP_ABBC3_MODULE'		=> \vse\abbc3\ext::ABBC3_EXT_NAME,
	'ACP_ABBC3_SETTINGS'	=> 'Instellingen',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Geavanceerde ' . \vse\abbc3\ext::ABBC3_EXT_NAME . ' kon de map niet aanmaken:</strong><br>%s',
]);
