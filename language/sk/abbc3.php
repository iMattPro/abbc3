<?php
/**
*
* Advanced BBCode Box [Slovak]
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
	'ABBC3_HIDDEN_OFF'			=> 'Skrytý obsah (iba pre členov)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Toto fórum vyžaduje, aby ste se pre zobrazenie skrytého obsahu prihlásili.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Ukázať spoiler',
	'ABBC3_SPOILER_HIDE'		=> '▼ Skryť spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Mimo tému (offtopic)',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Ponuka písma',
	'ABBC3_FONT_FANCY'			=> 'Ozdobné písmo',
	'ABBC3_FONT_SAFE'			=> 'Bezpečné písmo',
	'ABBC3_FONT_WIN'			=> 'Windows písmo',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Ukotviť text: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Vložiť ľubovolnú weboú adresu videa: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Rozmazať text: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Smer textu: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Text vrhajúci tiene: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Zosilnenie a zoslabenie textu [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Vznášajúci sa text: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Druh písma: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Žiariaci text: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Skryť pred hosťami: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Zvýrazniť text: [highlight=yellow]text[/highlight]  Tip: you can also use color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Markýza (pohyblivý text): [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Výstražná správa: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii umenie textu: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Správa mimo tému (offtopic): [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Predformátovaný text: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Tieňový text: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Škrtnutý text: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Dolný index: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Horný index: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Skopírovať vybraný text',
	'ABBC3_PASTE_BBCODE'		=> 'Vložiť vybraný text',
	'ABBC3_PASTE_ERROR'			=> 'Najprv musíte skopírovat vybraný text, až potom ho môžete vložit',
	'ABBC3_PLAIN_BBCODE'		=> 'Odstráni všetky BBCode značky z vybraného textu',
	'ABBC3_NOSELECT_ERROR'		=> 'Nie je vybraný žiadny text.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Vložiť do správy',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Napríklad',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideo povolené stránky',
	'ABBC3_BBVIDEO_LINK'		=> 'URL videa',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Zadať URL adresu',
	'ABBC3_URL_DESCRIPTION'		=> 'Volitelný popis',
	'ABBC3_URL_EXAMPLE'			=> 'https://forums.volgeop.eu/',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Vytvorte tabuľky',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Vytvorte tabuľky pomocou ktorejkoľvek z nich ASCII-style formát.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Užívateľská príručka',
	'ABBC3_PIPE_SIMPLE'			=> 'Jednoduchá tabuľka',
	'ABBC3_PIPE_COMPACT'		=> 'Kompaktná tabuľka',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Vonkajšie orámovanie a orámovanie okolo je voliteľné',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Zarovnanie textu',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Poradie BBCode bolo aktualizované',
	'ABBC3_BBCODE_GROUP'		=> 'Spravovať skupiny, ktoré môžu používať tento BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Pokiaľ nebudú vybrané žiadne skupiny, tak tento BBCode budú môcť používať všetci uživatelia. Použite CTRL+KLIK (alebo CMD+KLIK na Mac) k vybraniu / zrušeniu výberu jednej alebo viac skupín',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Rýchla hnedá liška skočí cez lenivého psa',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Príklad:</strong><br />%2$s<br /><br /><strong>Výsledok:</strong><br />%3$s<hr />',
));
