<?php
/**
*
* Advanced BBCode Box [English]
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
* Slovenian Translation - Marko K.(max, max-ima,...)
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
	'ABBC3_HIDDEN_ON'			=> 'Skrita vsebina',
	'ABBC3_HIDDEN_OFF'			=> 'Skrita vsebina (samo za člane)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Ta tabla zahteva, da ste registrirani in prijavljeni za ogled skrite vsebine.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Prikaži “Spoiler”',
	'ABBC3_SPOILER_HIDE'		=> '▼ Skrij “Spoiler”',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Izven teme',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Pisave',
	'ABBC3_FONT_SAFE'			=> 'Varne pisave',
	'ABBC3_GOOGLE_FONTS'		=> 'Googlove pisave',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Poravnaj besedilo: [align=center|left|right|justify]besedilo[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Vdelajte URL katerega koli video spletnega mesta: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Zameglitev besedila: [blur=color]besedilo[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Smer besedila: [dir=ltr|rtl]besedilo[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Besedilo v senci: [dropshadow=color]besedilo[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Besedilo bledi / ugaša: [fade]besedilo[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Plavajoče besedilo: [float=left|right]besedilo[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Vrsta pisave: [font=Comic Sans MS]besedilo[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Svetleče besedilo: [glow=color]besedilo[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Skrij pred gosti: [hidden]besedilo[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Označite besedilo: [highlight=yellow]besedilo[/highlight]  Nasvet: uporabite lahko tudi color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Besedilo v oznaki: [marq=up|down|left|right]besedilo[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Opozorilno sporočilo: [mod=username]besedilo[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art besedilo: [nfo]besedilo[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Sporočilo izven teme: [offtopic]besedilo[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Vnaprej oblikovano besedilo: [pre]besedilo[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Senčno besedilo: [shadow=color]besedilo[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> '“Spoiler” sporočilo: [spoil]besedilo[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Prečrtano besedilo: [s]besedilo[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Podpisno besedilo: [sub]besedilo[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Nadpodpisno besedilo: [sup]besedilo[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopiraj izbrano besedilo',
	'ABBC3_PASTE_BBCODE'		=> 'Prilepite kopirano besedilo',
	'ABBC3_PASTE_ERROR'			=> 'Najprej morate kopirati izbor besedila in ga nato prilepiti',
	'ABBC3_PLAIN_BBCODE'		=> 'Odstranite vse oznake BBKode iz izbranega besedila',
	'ABBC3_NOSELECT_ERROR'		=> 'Izbrano ni bilo nobeno besedilo.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Vstavi v sporočilo',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Primer',
	'ABBC3_BBVIDEO_SITES'		=> 'Dovoljena spletna mesta',
	'ABBC3_URL_LINK'			=> 'Vnesite URL spletnega mesta',
	'ABBC3_URL_DESCRIPTION'		=> 'Neobvezen opis',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Ustvari tabele',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Ustvarite tabele s katerim koli od teh formatov v slogu ASCII.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Uporabniški priročnik',
	'ABBC3_PIPE_SIMPLE'			=> 'Enostavna tabela',
	'ABBC3_PIPE_COMPACT'		=> 'Kompaktna tabela',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Zunanje obrobe in prostori okoli obrobe so neobvezni.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Poravnava besedila',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Vrstni red BBKode je bil posodobljen.',
	'ABBC3_BBCODE_GROUP'		=> 'Upravljajte skupine, ki lahko uporabljajo to BBKodo',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Če ni izbrana nobena skupina, lahko vsi uporabniki uporabljajo to BBKodo. Uporabite CTRL+CLIK (ali CMD+CLIK na Macu), da izberete/prekličete izbiro več kot ene skupine.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Dodajte <a href="https://fonts.google.com" target="_blank">Googlove pisave</a> v <samp>font</samp> BBKode. Uporabite natančno črkovanje in razlikovanje med velikimi in malimi črkami. Vsako ime pisave postavite v ločeno vrstico. Primer: <samp>Droid Sans</samp>',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tukaj lahko konfigurirate nastavitve za napredno polje BBKode. Za informacije o prilagajanju vrstice z ikonami obiščite <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_PIPES'				=> 'Omogočite vtičnik Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipes Table vtičnik uporabnikom omogoča ustvarjanje tabel v svojih objavah in zasebnih sporočilih z uporabo sintakse markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Omogoči vrstico z ikonami BBKode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'To bo prikazalo orodno vrstico BBCode, ki temelji na ikonah ABBC3. Onemogočite to za prikaz privzetih gumbov phpBB BBCode.',
	'ABBC3_QR_BBCODES'			=> 'Omogočite BBKode v hitrem odgovoru',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'To bo dodalo gumbe BBKode v hitri odgovor.',
	'ABBC3_ICONS_TYPE'			=> 'Format slike vrstice ikon',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Izberite obliko slike, ki jo želite uporabiti za ikone ABBC3. Upoštevajte, da lahko izberete samo eno obliko za vse svoje ikone.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Vrstica z ikonami BBKode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Dodatki',
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Example:</strong><br />%2$s<br /><br /><strong>Result:</strong><br />%3$s<hr />',
));
