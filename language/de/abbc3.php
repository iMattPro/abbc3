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
	'ABBC3_HIDDEN_OFF'			=> 'Verstecken ist deaktiviert (nur für Mitglieder)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Um diesen versteckten Text lesen zu können, mußt du registriert und angemeldet sein.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Text zeigen',
	'ABBC3_SPOILER_HIDE'		=> '▼ Text verstecken',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Schriftarten',
	'ABBC3_FONT_FANCY'			=> 'Fantasievolle Schriftarten',
	'ABBC3_FONT_SAFE'			=> 'Sichere Schriftarten',
	'ABBC3_FONT_WIN'			=> 'Windows Schriftarten',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Ausrichten von Text: [align=Zentrierter|Linksbündiger|Rechtsbündiger|Block]Text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Füge ein Web Video hinzu: [BBvideo Breite,Höhe]http://Video URL[/BBvideo]',
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
	'ABBC3_NFO_HELPLINE'		=> 'NFO ASCII-Art Text: [nfo]Text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off Topic Nachricht: [offtopic]Text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Vorformatierter Text: [pre]Text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Text mit Schatten: [shadow=color]Text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud Link: [soundcloud]http://soundcloud.com/Benutzername/Lied-Titel[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler Nachricht: [spoil]Text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Text durchgestrichen: [s]Text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Tiefgestellter Text: [sub]Text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Hochgestellter Text: [sup]Text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://Youtube Url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Den markierten Text kopieren',
	'ABBC3_PASTE_BBCODE'		=> 'Den kopierten Text einfügen',
	'ABBC3_PASTE_ERROR'			=> 'Du mußt erst einen Text kopieren, bevor du ihn einfügen kannst',
	'ABBC3_PLAIN_BBCODE'		=> 'Entferne alle BBCodes aus dem markierten Text',
	'ABBC3_NOSELECT_ERROR'		=> 'Du mußt erst einen Text markieren',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'In die Nachricht einfügen',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Beispiel',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideo Zugelassene Sites',
	'ABBC3_BBVIDEO_LINK'		=> 'Video URL',
	'ABBC3_BBVIDEO_SIZE'		=> 'Video Breite x Höhe',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Größe Vorgaben',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Fügen Sie eine URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Optionale Beschreibung',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Der BBCode Auftrag wurde neu synchronisiert.',
	'ABBC3_BBCODE_GROUP'		=> 'Gruppen verwalten, die diese BBCode verwenden können.',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Wenn keine Gruppen ausgewählt sind, können alle Benutzer diese BBCode verwenden. Verwende CTRL+CLICK (oderr CMD+CLICK auf Mac) mehr als eine Gruppe zu aktivieren/deaktivieren.',
));
