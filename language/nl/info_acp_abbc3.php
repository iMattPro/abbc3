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
	'ACP_ABBC3_MODULE'		=> 'Geavanceerde BBCode Box',
	'ACP_ABBC3_SETTINGS'	=> 'Instellingen',
	'LOG_ABBC3_ENABLE_FAIL'	=> '<strong>Geavanceerde BBCode Box kon de map niet aanmaken:</strong><br>%s',
]);
