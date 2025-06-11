<?php
/**
 *
 * Advanced BBCodes [European Portuguese]
 *
 * Translation by Gwyneth Llewelyn
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
	'ACP_ABBC3_SETTINGS'	=> 'Configuração',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>' . \vse\abbc3\ext::ABBC3_EXT_NAME . ' não conseguiu criar a directoria:</strong><br>%s',
]);
