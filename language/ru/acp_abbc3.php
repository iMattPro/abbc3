<?php
/**
*
* Advanced BBCode Box [Russian]
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Здесь можно изменить настройки расширения «Advanced BBCode Box». Для получения дополнительной информации о настройке панели с иконками, откройте %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_PIPES'				=> 'Включить плагин таблиц',
	'ABBC3_PIPES_EXPLAIN'		=> 'Плагин таблиц позволяет пользователям добавлять в свои сообщения на форуме, а так же в личные сообщения таблицы, используя соответствующий синтаксис.',
	'ABBC3_BBCODE_BAR'			=> 'Включить панель с иконками ББ-кодами',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Эта опция позволяет вам включить панель с иконками ББ-кодов расширения ABBC3. Отключите эту панель для использования панели, установленной в phpBB по умолчанию.',
	'ABBC3_QR_BBCODES'			=> 'Включить ББ-коды в «Быстром ответе»',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Эта опция добавить панель с иконками ББ-кодов в форму «Быстрый ответ».',
	'ABBC3_ICONS_TYPE'			=> 'Формат иконок на панели с иконками',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Выберите формат иконок на панели с иконками ABBC3. Вы можете выбрать только один формат сразу для всех иконок на панели.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Панель ББ-кодов',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Дополнения',
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Install the optional phpBB Media Embed extension to access settings and management options for embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extension is not installed. %2$s.',
		1	=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
