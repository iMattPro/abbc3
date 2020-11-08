<?php
/**
 *
 * Advanced BBCode Box [Simplified Chinese]
 * @简体中文语言　David Yin <https://www.phpbbchinese.com/>
 *
 * @copyright (c) 2013 Matt Friedman
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
	'ACP_ABBC3_SETTINGS'	=> '设置',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Advanced BBCode Box 无法创建以下目录：</strong><br>%s',
]);
