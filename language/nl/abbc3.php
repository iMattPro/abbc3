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
	'ABBC3_HIDDEN_OFF'			=> 'Verborgen inhoud (Alleen voor leden)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Je moet geregistreerd en aangemeld zijn om de verborgen inhoud te kunnen zien.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Laat Spoiler zien',
	'ABBC3_SPOILER_HIDE'		=> '▼ Verberg Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Lettertype',
	'ABBC3_FONT_SAFE'			=> 'Safe lettertype',
	'ABBC3_GOOGLE_FONTS'		=> 'Google lettertype',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Tekst uitlijnen: [align=center|left|right|justify]tekst[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Video website link insluiten: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Wazige tekst: [blur=color]tekst[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Tekst volgorde (draait tekst om rechts naar links): [dir=ltr|rtl]tekst[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Drop shadow tekst: [dropshadow=color]text[/dropshadow]',
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
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler (in- en uitklapbaar gedeelte): [spoil]tekst[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Doorstreepte tekst: [s]tekst[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Subscript (kleine letters maken boven de basis regel van de tekst): [sub]tekst[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Superscript (Kleine letters maken boven de tekst regel): [sup]tekst[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Embed MP4/OGG/WEBM video files: URL must start with <samp class="error">https</samp> or <samp class="error">http</samp> and end with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> (no BBCode needed). Note that browser support and GUI implementation varies.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopieer geselecteerde tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Plak geselecteerde tekst',
	'ABBC3_PASTE_ERROR'			=> 'Je moet eerst een tekst selecteren, voordat je het kan plakken',
	'ABBC3_PLAIN_BBCODE'		=> 'Verwijder alle BBcode-tags van de geselecteerde tekst',
	'ABBC3_NOSELECT_ERROR'		=> 'Er is geen tekst geselecteerd.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Invoegen in bericht',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Voorbeeld',
	'ABBC3_BBVIDEO_SITES'		=> 'Toegestane websites',
	'ABBC3_URL_LINK'			=> 'Voeg een URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Optionele beschrijving',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Create tables',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Create tables using any of these ASCII-style formats.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'User Guide',
	'ABBC3_PIPE_SIMPLE'			=> 'Simple table',
	'ABBC3_PIPE_COMPACT'		=> 'Compact table',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'The outer pipes and spaces around pipes are optional.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Text alignment',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'De volgorde van de BBcodes is bijgewerkt.',
	'ABBC3_BBCODE_GROUP'		=> 'Beheer groepen die deze BBcode kunnen gebruiken',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Als je geen groep hebt geselecteerd, kunnen alle groepen deze BBcode gebruiken. Gebruik CTRL+KLIK (of CMD+KLIK bij Mac) om meer dan één groep te selecteren/deselecteren.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Example:</strong><br>%2$s<br><br><strong>Result:</strong><br>%3$s<hr />',
));
