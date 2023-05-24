<?php
/**
*
* Advanced BBCode Box [Arabic]
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
* Translated By : Bassel Taha Alhitary - www.alhitary.net
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for Advanced BBCode Box. For information about customizing the icon bar, visit the <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_PIPES'				=> 'Enable Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'The Pipe Table PlugIn allows users to create tables in their posts and private messages using markdown syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Enable BBCode icon bar',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display ABBC3’s icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Enable BBCodes in Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'This will add BBCode buttons to Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Icon bar image format',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for ABBC3’s icons. Note that you can only choose one format for all your icons.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Icon Bar',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add Ons',
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
