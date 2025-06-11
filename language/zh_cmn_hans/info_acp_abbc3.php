<?php
/**
 *
 * Advanced BBCodes [Simplified Chinese]
 * @简体中文语言　David Yin <https://www.phpbbchinese.com/>
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
	'ACP_ABBC3_SETTINGS'	=> '设置',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>' . \vse\abbc3\ext::ABBC3_EXT_NAME . ' 无法创建以下目录：</strong><br>%s',
]);
