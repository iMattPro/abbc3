<?php
/**
*
* Advanced BBCode Box [Polish]
* Translated by Pico88
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
	'ABBC3_HIDDEN_ON'			=> 'Ukryta zawartość',
	'ABBC3_HIDDEN_OFF'			=> 'Ukryta zawartość (tylko dla użytkowników)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'To forum wymaga zarejestrowania i zalogowania się, aby zobaczyć ukrytą zawartość.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Pokaż Spoiler',
	'ABBC3_SPOILER_HIDE'		=> '▼ Ukryj Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Menu czcionek',
	'ABBC3_FONT_FANCY'			=> 'Czcionki ozdobne',
	'ABBC3_FONT_SAFE'			=> 'Bezpieczne Czcionki',
	'ABBC3_FONT_WIN'			=> 'Czcionki systemu Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Wyrównaj tekst: [align=center|left|right|justify]tekst[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Osadź dowolny plik wideo: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Rozmycie tekstu: [blur=color]tekst[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Kierunek tekstu: [dir=ltr|rtl]tekst[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Tekst z twardym cieniem: [dropshadow=color]tekst[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Pulsujący tekst: [fade]tekst[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Float tekst: [float=left|right]tekst[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Rodzaj czcionki: [font=Comic Sans MS]tekst[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Poświata tekstu: [glow=color]tekst[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ukryj tekst dla gośći: [hidden]tekst[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Wyróżnij tekst: [highlight=yellow]tekst[/highlight]  Podpowiedź: możesz również opisać kolor HEXami',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Pływający tekst: [marq=up|down|left|right]tekst[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Wiadomość moderatora: [mod=username]tekst[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Informacja NFO: [nfo]NFO tekst[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off Topic: [offtopic]tekst[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Tekst preformatowany: [pre]tekst[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Tekst z miękkim cieniem: [shadow=kolor]tekst[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler: [spoil]tekst[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Przekreślenie tekstu: [s]tekst[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Indeks dolny: [sub]tekst[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Indeks górny: [sup]tekst[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Film z YouTube: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopiuj zaznaczony tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Wklej skopiowany tekst',
	'ABBC3_PASTE_ERROR'			=> 'Najpierw należy skopiować fragment tekstu, a następnie wkleić go',
	'ABBC3_PLAIN_BBCODE'		=> 'Usuń wszystkie znacznki BBCode z zaznaczonego tekstu',
	'ABBC3_NOSELECT_ERROR'		=> 'Tekst nie został wybrany.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Wstawić do wiadomość',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Przykład',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Dozwolone witryny',
	'ABBC3_BBVIDEO_LINK'		=> 'URL wideo',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Dodaj URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Opcjonalny opis',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

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
	'ABBC3_BBCODE_ORDERED'		=> 'Kolejność BBCode została zsynchronizowana.',
	'ABBC3_BBCODE_GROUP'		=> 'Zarządzaj grupami, które mogą używać tego BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Jeżeli nie wybrano żadnych grup, wszyscy użytkownicy mogą używać tego BBCode. Użyj CTRL + kliknięcie (lub CMD + kliknięcie na Mac), aby wybrać/odznaczyć więcej niż jedną grupę.',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for Advanced BBCode Box 3. For information about customizing the icon bar, visit the <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_PIPES'				=> 'Enable the Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'The Pipes Table PlugIn allows users to create tables in their posts and private messages using markdown syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Enable BBCode icon bar',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display ABBC3’s icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Enable BBCodes in Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'This will add BBCode buttons to Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Icon bar image format',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for ABBC3’s icons. Note that you can only choose one format for all your icons.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Icon Bar',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add Ons',
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Example:</strong><br />%2$s<br /><br /><strong>Result:</strong><br />%3$s<hr />',
));
