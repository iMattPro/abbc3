<?php
/**
*
* abbc3 [Polish]
*
* @package language
* @copyright (c) 2013 Matt Friedman
* @translation Pico88
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	// Hidden BBcode
	'ABBC3_HIDDEN_ON'			=> 'Ukryta zawartość',
	'ABBC3_HIDDEN_OFF'			=> 'Ukryta zawartość (tylko dla użytkowników)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'To forum wymaga zarejestrowania i zalogowania się, aby zobaczyć ukrytą zawartość.',

	// Spoiler BBcode
	'ABBC3_SPOILER_SHOW'		=> 'Pokaż Spoiler',
	'ABBC3_SPOILER_HIDE'		=> 'Ukryj Spoiler',

	// Off Topic BBcode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBcode
	'ABBC3_FONT_BBCODE'			=> 'Menu czcionek',
	'ABBC3_FONT_FANCY'			=> 'Czcionki ozdobne',
	'ABBC3_FONT_SAFE'			=> 'Bezpieczne Czcionki',
	'ABBC3_FONT_WIN'			=> 'Czcionki systemu Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Wyrównaj tekst: [align=center|left|right|justify]tekst[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Osadź dowolny plik wideo: [BBvideo=szerokość,wysokość]Adres URL[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Rozmycie tekstu: [blur=color]tekst[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Kierunek tekstu: [dir=ltr|rtl]tekst[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Tekst z twardym cieniem: [dropshadow=color]tekst[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Pulsujący tekst: [fade]tekst[/fade]',
	'ABBC3_FONT_HELPLINE'		=> 'Rodzaj czcionki: [font=Comic Sans MS]tekst[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Poświata tekstu: [glow=color]tekst[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ukryj tekst dla gośći: [hidden]tekst[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Wyróżnij tekst: [highlight=yellow]tekst[/highlight]',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Pływający tekst: [marq=up|down|left|right]tekst[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Wiadomość moderatora: [mod=username]tekst[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Informacja NFO: [nfo]NFO tekst[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off Topic: [offtopic]tekst[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Tekst preformatowany: [pre]tekst[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Tekst z miękkim cieniem: [shadow=kolor]tekst[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler: [spoil]tekst[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Przekreślenie tekstu: [s]tekst[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Indeks dolny: [sub]tekst[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Indeks górny: [sup]tekst[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Film z YouTube: [youtube]URL[/youtube]',

	// Utility BBcodes
	'ABBC3_COPY_BBCODE'			=> 'Kopiuj zaznaczony tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Wklej skopiowany tekst',
	'ABBC3_PASTE_ERROR'			=> 'Najpierw należy skopiować fragment tekstu, a następnie wkleić go',
	'ABBC3_PLAIN_BBCODE'		=> 'Usuń wszystkie znacznki BBCode z zaznaczonego tekstu',

	'ABBC3_ERROR'				=> 'Błąd',
	'ABBC3_NOSELECT_ERROR'		=> 'Tekst nie został wybrany.',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Kolejność BBCode została zsynchronizowana.',
	'ABBC3_BBCODE_GROUP'		=> 'Zarządzaj grupami, które mogą używać tego BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Jeżeli nie wybrano żadnych grup, wszyscy użytkownicy mogą używać tego BBCode. Użyj CTRL + kliknięcie (lub CMD + kliknięcie na Mac), aby wybrać/odznaczyć więcej niż jedną grupę.',
));
