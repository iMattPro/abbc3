<?php
/**
*
* Advanced BBCode Box [Dutch]
* Translated by Dutch Translators (https://github.com/dutch-translators)
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
	'ABBC3_HIDDEN_ON'			=> 'Verborgen inhoud',
	'ABBC3_HIDDEN_OFF'			=> 'Verborgen inhoud (enkel voor leden)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Je moet geregistreerd en ingelogd zijn om de verborgen inhoud te kunnen bekijken.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Toon Spoiler',
	'ABBC3_SPOILER_HIDE'		=> '▼ Verberg Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Fonts',
	'ABBC3_FONT_SAFE'			=> 'Systeem Fonts',
	'ABBC3_GOOGLE_FONTS'		=> 'Google Fonts',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Tekst uitlijnen: [align=center|left|right|justify]tekst[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Video website link insluiten: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Wazige tekst: [blur=color]tekst[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Tekst richting (links naar rechts vs rechts naar links): [dir=ltr|rtl]tekst[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Slagschaduw tekst: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Vervagende tekst: [fade]tekst[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Tekst uitlijnen: [float=left|right]tekst[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Lettertype: [font=Comic Sans MS]tekst[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Gloeiende tekst: [glow=color]tekst[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Verberg voor gasten: [hidden]tekst[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Markeer tekst: [highlight=yellow]tekst[/highlight]  Tip: Je kan ook een kleur code gebruiken bijv: #FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Marquee tekst: [marq=up|down|left|right]tekst[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Waarschuwingsbericht: [mod=username]tekst[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art tekst: [nfo]tekst[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off Topic bericht: [offtopic]tekst[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Vooraf opgemaakte tekst: [pre]tekst[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Schaduw tekst: [shadow=color]tekst[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]https://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler bericht (in- en uitklapbaar gedeelte): [spoil]tekst[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Doorstreepte tekst: [s]tekst[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Subscript tekst: [sub]tekst[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Superscript tekst: [sup]tekst[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Embed MP4/OGG/WEBM video bestanden: URL moet beginnen met <samp class="error">https</samp> of <samp class="error">http</samp> en eindigen met <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> of <samp class="error">.webm</samp> (geen BBCode nodig). Merk op dat browser ondersteuning and GUI implementatie kan variëren.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopieer geselecteerde tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Plak gekopieerde tekst',
	'ABBC3_PASTE_ERROR'			=> 'Je moet eerst een tekst selecteren en kopiëren, voordat je het kan plakken',
	'ABBC3_PLAIN_BBCODE'		=> 'Verwijder alle BBcode-tags van de geselecteerde tekst',
	'ABBC3_NOSELECT_ERROR'		=> 'Er is geen tekst geselecteerd.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Invoegen in bericht',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Voorbeeld',
	'ABBC3_BBVIDEO_SITES'		=> 'Toegestane websites',
	'ABBC3_URL_LINK'			=> 'Voeg een URL toe',
	'ABBC3_URL_DESCRIPTION'		=> 'Optionele beschrijving',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Maak tabellen',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Maak tabellen met eender welke van deze ASCII-style formats.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Gebruikers Handleiding',
	'ABBC3_PIPE_SIMPLE'			=> 'Eenvoudige tabel',
	'ABBC3_PIPE_COMPACT'		=> 'Compacte tabel',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'De buitenste sluistekens en spaties rond de sluistekens zijn optioneel.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Uitlijning van de tekst',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP Common
	'ABBC3_BBCODE_ORDERED'		=> 'De volgorde van de BBcodes is bijgewerkt.',
	'ABBC3_BBCODE_GROUP'		=> 'Beheer groepen die deze BBcode kunnen gebruiken',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Indien geen groepen geselecteerd zijn, dan kunnen alle groepen deze BBcode gebruiken. Gebruik CTRL+KLIK (of CMD+KLIK bij Mac) om meer dan één groep te selecteren/deselecteren.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Voorbeeld:</strong><br>%2$s<br><br><strong>Resultaat:</strong><br>%3$s<hr />',
));
