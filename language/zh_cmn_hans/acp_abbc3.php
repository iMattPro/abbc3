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
	'ABBC3_SETTINGS_EXPLAIN'	=> '在此您可以修改 Advanced BBCode Box 的设置。 要了解有关定制图标栏的信息，请访问 <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>。',
	'ABBC3_GOOGLE_FONTS_INFO'	=> '添加 <a href="https://fonts.google.com" target="_blank">Google Fonts</a> 到 <samp>font</samp> BBCode 中。使用完全一致的大小写和拼写。每行写一个字体名称。 例如： <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_PIPES'				=> '启用管道表格插件',
	'ABBC3_PIPES_EXPLAIN'		=> '管道表格插件，会允许用户在帖子和私信中使用 markdown 语法来创建表格。',
	'ABBC3_BBCODE_BAR'			=> '启用 BBCode 图标栏',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> '启用它来显示 ABBC3 的基于图标的 BBCode 工具栏。禁用它则会用 phpBB 自带的默认 BBCode 按钮。 ',
	'ABBC3_QR_BBCODES'			=> '在快速回复中启用 BBCode',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> '这回在快速回复编辑器中启用 BBCode 的按钮。',
	'ABBC3_ICONS_TYPE'			=> '图标栏的图片格式',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> '选择用于 ABBC3 图标的图片格式。注意您只能选择一种并用于所有的图标。 ',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode 图标栏',
	'ABBC3_LEGEND_ADD_ONS'		=> '附加设置',
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Install the optional phpBB Media Embed extension to access settings and management options for embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extension is not installed. <a href="https://www.phpbb.com/customise/db/extension/mediaembed/" target="_blank">Download <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
		1	=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
