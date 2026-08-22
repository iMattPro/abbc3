<?php
/**
*
* Advanced BBCode Box [Czech]
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
	'ABBC3_HIDDEN_ON'			=> 'Skrytý obsah',
	'ABBC3_HIDDEN_OFF'			=> 'Skrytý obsah (pouze pro členy)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Toto fórum vyžaduje, abyste se pro zobrazení skrytého obsahu přihlásili.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> 'Ukázat spoiler',
	'ABBC3_SPOILER_HIDE'		=> 'Skrýt spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Mimo téma (offtopic)',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Písma',
	'ABBC3_FONT_SAFE'			=> 'Bezpečná písma',
	'ABBC3_GOOGLE_FONTS'		=> 'Google písma',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Ukotvit text: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Vložit libovolnou webovou adresu videa: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Rozmazat text: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Směr textu: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Text vrhající stíny: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Zesílení a zeslabení textu [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Vznášející se text: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Druh písma: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Zářící text: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Skrýt před hosty: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Zvýraznit text: [highlight=yellow]text[/highlight]  Tip: můžete použít také color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Markýza (pohyblivý text): [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Výstražná zpráva: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii umění textu: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Zpráva mimo téma (offtopic): [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Předformátovaný text: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Stínový text: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]https://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Škrtnutý text: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Dolní index: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Horní index: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Video na YouTube: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Vkládejte video soubory MP4/OGG/WEBM: URL musí začínat <samp class="error">https</samp> nebo <samp class="error">http</samp> a končit <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> nebo <samp class="error">.webm</samp> (není potřeba BBCode). Všimněte si, že podpora prohlížeče a implementace GUI se liší.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Zkopírovat vybraný text',
	'ABBC3_PASTE_BBCODE'		=> 'Vložit vybraný text',
	'ABBC3_PASTE_ERROR'			=> 'Nejprve musíte zkopírovat vybraný text, až poté ho můžete vložit',
	'ABBC3_PLAIN_BBCODE'		=> 'Odstraní všechny BBCode značky z vybraného textu',
	'ABBC3_NOSELECT_ERROR'		=> 'Není vybrán žádný text.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Vložit do zprávy',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Například',
	'ABBC3_BBVIDEO_SITES'		=> 'Povolené stránky',
	'ABBC3_URL_LINK'			=> 'Zadat URl adresu',
	'ABBC3_URL_DESCRIPTION'		=> 'Volitelný popis',
	'ABBC3_URL_EXAMPLE'			=> 'https://forums.volgeop.eu/',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Vytvářejte tabulky',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Vytvářejte tabulky pomocí libovolného z těchto formátů ve stylu ASCII.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Uživatelská příručka',
	'ABBC3_PIPE_SIMPLE'			=> 'Jednoduchý stůl',
	'ABBC3_PIPE_COMPACT'		=> 'Kompaktní stůl',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Vnější potrubí a prostory kolem potrubí jsou volitelné.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Zarovnání textu',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Pořadí BBCode bylo aktualizováno',
	'ABBC3_BBCODE_ORDERED_FAIL'	=> 'Objednávku BBCode nelze aktualizovat.',
	'ABBC3_BBCODE_ORDER_NO_TABLE'	=> 'Nebyl přijat žádný název tabulky BBCode.',
	'ABBC3_BBCODE_ORDER_NO_DATA'	=> 'Nebyla přijata žádná data objednávky BBCode.',
	'ABBC3_BBCODE_ORDER_NO_ORDER'	=> 'Nebyly aktualizovány žádné řádky BBCode.',
	'ABBC3_BBCODE_GROUP'		=> 'Spravovat skupiny, které mohou používat tento BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Pokud nebudou vybrány žádné skupiny, tak tento BBCode budou moci používat všichni uživatelé. Použijte CTRL+KLIK (nebo CMD+KLIK na Mac) k vybrání / zrušení výběru jedné nebo více skupin',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Pokročilé BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Rychlá hnědá liška přeskakuje líného psa',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Příklad:</strong><br>%2$s<br><br><strong>Výsledek:</strong><br>%3$s<hr>',
));
