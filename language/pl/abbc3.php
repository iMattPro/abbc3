<?php
/**
*
* Advanced BBCode Box [Polish]
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
* Tłumaczenie na Polski: Tomasz Hetman - ToTemat YT and Pico88
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
	'ABBC3_HIDDEN_OFF'			=> 'Ukryta zawartość (widoczna dla członków)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Zaloguj się lub zarejestruj, aby zobaczyć ten post.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> 'Pokaż spoiler',
	'ABBC3_SPOILER_HIDE'		=> 'Ukryj spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Czcionki',
	'ABBC3_FONT_SAFE'			=> 'Czcionki systemowe',
	'ABBC3_GOOGLE_FONTS'		=> 'Czcionki Google',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Wyrównanie tekstu: [align=center|left|right|justify]tekst[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Osadź wideo z dowolnej strony: [bbvideo]http://adres_wideo[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Rozmycie tekstu: [blur=color]tekst[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Kierunek tekstu: [dir=ltr|rtl]tekst[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Cień tekstu: [dropshadow=kolor]tekst[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Pojawianie / zanikanie tekstu: [fade]tekst[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Opływanie tekstu: [float=left|right]tekst[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Rodzaj czcionki: [font=Comic Sans MS]tekst[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Poświata tekstu: [glow=kolor]tekst[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ukryj przed gośćmi: [hidden]tekst[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Wyróżnienie tekstu: [highlight=yellow]tekst[/highlight]  Wskazówka: możesz też użyć color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Przesuwający się tekst: [marq=up|down|left|right]tekst[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Komunikat moderatora: [mod=użytkownik]tekst[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Tekst ASCII art NFO: [nfo]tekst[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Wiadomość Off Topic: [offtopic]tekst[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Tekst preformatowany: [pre]tekst[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Cień tekstu: [shadow=kolor]tekst[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]https://soundcloud.com/użytkownik/tytuł-utworu[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Wiadomość spoiler: [spoil]tekst[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Przekreślenie tekstu: [s]tekst[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Indeks dolny: [sub]tekst[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Indeks górny: [sup]tekst[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Wideo YouTube: [youtube]http://adres_youtube[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Osadź pliki wideo MP4/OGG/WEBM: URL musi zaczynać się od <samp class="error">https</samp> lub <samp class="error">http</samp> i kończyć na <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> lub <samp class="error">.webm</samp> (nie wymaga BBCode). Wsparcie przeglądarek i interfejs mogą się różnić.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopiuj zaznaczony tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Wklej skopiowany tekst',
	'ABBC3_PASTE_ERROR'			=> 'Najpierw musisz skopiować zaznaczony tekst, aby go wkleić.',
	'ABBC3_PLAIN_BBCODE'		=> 'Usuń wszystkie tagi BBCode z zaznaczonego tekstu',
	'ABBC3_NOSELECT_ERROR'		=> 'Nie zaznaczono żadnego tekstu.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Wstaw do wiadomości',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Przykład',
	'ABBC3_BBVIDEO_SITES'		=> 'Dozwolone strony',
	'ABBC3_URL_LINK'			=> 'Wprowadź adres URL strony',
	'ABBC3_URL_DESCRIPTION'		=> 'Opcjonalny opis',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Tworzenie tabel',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Twórz tabele używając dowolnego z poniższych formatów w stylu ASCII.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Instrukcja użytkownika',
	'ABBC3_PIPE_SIMPLE'			=> 'Prosta tabela',
	'ABBC3_PIPE_COMPACT'		=> 'Kompaktowa tabela',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Zewnętrzne kreski (pionowe paski) oraz spacje wokół nich są opcjonalne.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Wyrównanie tekstu',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Kolejność BBCode została zaktualizowana.',
	'ABBC3_BBCODE_GROUP'		=> 'Zarządzaj grupami, które mogą używać tego BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Jeśli nie wybrano żadnych grup, wszyscy użytkownicy będą mogli używać tego BBCode. Użyj CTRL+KLIK (lub CMD+KLIK na Macu), aby zaznaczyć/odznaczyć więcej niż jedną grupę.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Zaawansowane tagi BBCode Box',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Pchnąć w tę łódź jeża lub ośm skrzyń fig',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Przykład:</strong><br>%2$s<br><br><strong>Wynik:</strong><br>%3$s<hr>',
));
