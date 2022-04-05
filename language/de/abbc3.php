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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Verstecken ist aktiviert',
	'ABBC3_HIDDEN_OFF'			=> 'Verstecken ist deaktiviert (nur für Mitglieder sichtbar)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Um diesen versteckten Text lesen zu können, musst du registriert und angemeldet sein.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Text anzeigen',
	'ABBC3_SPOILER_HIDE'		=> '▼ Text verstecken',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off-topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Schriftarten',
	'ABBC3_FONT_SAFE'			=> 'Sichere Schriftarten',
	'ABBC3_GOOGLE_FONTS'		=> 'Google Schriftarten',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Ausrichten von Text: [align=center|left|right|justify]Text[/align] (zentriert, linksbündig, rechtsbündig und blocksatz)',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Webvideo hinzufügen: [bbvideo]http://Video URL[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Unscharfer Text: [blur=color]Text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Text Richtung (links nach rechts/rechts nach links): [dir=ltr|rtl]Text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Text mit Schattenfall: [dropshadow=color]Text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Text ein-/ausblenden: [fade]Text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Umfließender Text (Links/Rechts): [float=left|right]Text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Schriftart: [font=Comic Sans MS]Text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Glühender Text: [glow=color]Text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Inhalt für Gäste verstecken: [hidden]Text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Text hervorheben (Gelb): [highlight=yellow]text[/highlight]  Tipp: Du kannst auch color=#FF0000 benutzen',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Lauftext (nach unten|oben|links|rechts): [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Moderator Nachricht: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO-ASCII-Art-Text: [nfo]Text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off-topic Nachricht: [offtopic]Text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Vorformatierter Text: [pre]Text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Text mit Schatten: [shadow=color]Text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud-Link: [soundcloud]http://soundcloud.com/Benutzername/Lied-Titel[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler Nachricht: [spoil]Text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Durchgestrichen: [s]Text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Tiefgestellt: [sub]Text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Hochgestellt: [sup]Text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube-Video: [youtube]http://Youtube Url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Markierten Text kopieren',
	'ABBC3_PASTE_BBCODE'		=> 'Kopierten Text einfügen',
	'ABBC3_PASTE_ERROR'			=> 'Du musst erst einen Text kopieren, bevor du ihn einfügen kannst',
	'ABBC3_PLAIN_BBCODE'		=> 'Alle BBCodes aus dem markierten Text entfernen',
	'ABBC3_NOSELECT_ERROR'		=> 'Es wurde kein Text markiert',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'In die Nachricht einfügen',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Beispiel',
	'ABBC3_BBVIDEO_SITES'		=> 'Zugelassene Websites',
	'ABBC3_URL_LINK'			=> 'Website-URL einfügen',
	'ABBC3_URL_DESCRIPTION'		=> 'Optionale Beschreibung',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Tabellen erstellen',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Erstelle Tabellen indem du die folgenden ASCII-Formate verwendest.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Benutzerhandbuch',
	'ABBC3_PIPE_SIMPLE'			=> 'Einfache Tabelle',
	'ABBC3_PIPE_COMPACT'		=> 'Kompakte Tabelle',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Die äußeren senkrechten Striche und die Leerzeichen um die senkrechten Striche sind optional.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Textausrichtung',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Der BBCode Auftrag wurde neu synchronisiert.',
	'ABBC3_BBCODE_GROUP'		=> 'Gruppen verwalten, die diesen BBCode verwenden können.',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Wenn keine Gruppen ausgewählt sind, können alle Benutzer diesen BBCode verwenden. Verwende STRG+CLICK (oder CMD+CLICK auf Mac) mehr als eine Gruppe zu aktivieren/deaktivieren.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <a href="https://fonts.google.com" target="_blank">Google Fonts</a> to the <samp>font</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line. Example: <samp>Droid Sans</samp>',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Hier kannst du die Einstellungen für die Advanced BBCode Box verändern. Für weitere Informationen, wie du die Menüleiste verändern kannst, rufe bitte die <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a> auf.',
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
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Der schnelle braune Fuchs springt über den faulen Hund',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Beispiel:</strong><br />%2$s<br /><br /><strong>Ergebnis:</strong><br />%3$s<hr />',
));
