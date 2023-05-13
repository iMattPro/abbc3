<?php
/**
*
* Advanced BBCode Box [German]
* Translated by wintstar - http://www.wintstar.de
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Hier kannst du die Einstellungen für die Advanced BBCode Box verändern. Für weitere Informationen, wie du die Menüleiste verändern kannst, rufe bitte die <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a> auf.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_PIPES'				=> 'Aktiviere das „Pipe Table“-Plug-in.',
	'ABBC3_PIPES_EXPLAIN'		=> 'Mit dem „Pipe Table“-Plug-in können Benutzer Tabellen in ihren Beiträgen und Privaten Nachrichten mit Hilfe der Markdown-Syntax erstellen.',
	'ABBC3_BBCODE_BAR'			=> 'Aktiviere die BBCode-Menüleiste',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Falls aktiviert, wird die ABBC3s iconbasierte BBCode-Menüleiste angezeigt. Sofern deaktiviert, wird die Standard phpBB BBCode-Menüleiste verwendet.',
	'ABBC3_QR_BBCODES'			=> 'Aktiviere BBCodes bei der Schnellantwort',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Falls aktiviert, wird bei der Schnellantwort die BBCode-Menüleiste angezeigt.',
	'ABBC3_ICONS_TYPE'			=> 'Iconformat der Menüleiste',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Wähle das Iconformat, das für die ABBC3s Icons verwendet wird. Bitte beachte, dass nur ein Format für alle Icons gewählt werden kann.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode-Menüleiste',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add-Ons',
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
