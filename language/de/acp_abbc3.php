<?php
/**
*
* Advanced BBCode Box [German]
* Translated by wintstar - http://www.wintstar.de and Scanialady (https://ladyscommunity.de)
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Hier kannst du die Einstellungen für die Advanced BBCode Box verändern. Für weitere Informationen, wie du die Menüleiste verändern kannst, rufe bitte die %s auf.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Füge <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> zum <samp class="error">[font]</samp> BBCode hinzu. Achte auf genaue Schreibweise und Groß-/Kleinschreibung. Setze jeden Schriftartnamen in eine eigene Zeile.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '„Nutzung von Drittanbieter-Servern zulassen“ muss aktiviert sein unter den “Serverlast”-Einstellungen, um diese Funktion zu nutzen.',
	'ABBC3_INVALID_FONT'		=> 'Ungültiger Schriftname „%s“',
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
	'ABBC3_AUTO_VIDEO'			=> 'Aktiviere Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Dieses PlugIn konvertiert plain-text Videodatei-URLs in abspielbare Videos. Nur URLs, welche mit <samp class="error">http://</samp> or <samp class="error">https://</samp> beginnen, und mit <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> oder <samp class="error">.webm</samp> enden, werden konvertiert.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installiere die optionale Erweiterung „phpBB Media Embed“, um auf Einstellungen und Verwaltungsoptionen für eingebettete Rich Media-Inhalte zuzugreifen.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed-Erweiterung ist nicht installiert. %2$s.',
		1	=> 'phpBB Media Embed-Erweiterung ist installiert. Auf die Einstellungen kann über den Tab „Beiträge“ zugegriffen werden.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
