<?php
/**
*
* Advanced BBCode Box [Croatian]
* Croatian translation by Ančica Sečan (http://ancica.sunceko.net)
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
	'ABBC3_HIDDEN_ON'			=> 'Skriveni sadržaj',
	'ABBC3_HIDDEN_OFF'			=> 'Skriveni sadržaj',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Za pregledavanje skrivenog sadržaja na forumu, trebaš se prijaviti.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Prikaži “Spoiler”',
	'ABBC3_SPOILER_HIDE'		=> '▼ Sakrij “Spoiler”',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> '“Off Topic”',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Izbornik fontova',
	'ABBC3_FONT_FANCY'			=> 'Fancy fontovi',
	'ABBC3_FONT_SAFE'			=> 'Sigurni fontovi',
	'ABBC3_FONT_WIN'			=> 'Windows fontovi',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Poravnanje teksta: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Umetanje URL-a stranice videa: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Bluranje teksta: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Smjer teksta: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Sjenčanje teksta: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Pojavljivanje/Nestajanje teksta: [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Plutanje teksta: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Vrsta fonta: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Sjajenje teksta: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Skrivanje od gostiju: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Osvjetljanje teksta: [highlight=yellow]text[/highlight]',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Kretanje teksta: [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Poruka upozorenja: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii umjetnički tekst: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> '“Off Topic” poruka: [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Formatiranje teksta: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Sjenčanje teksta: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> '“Spoiler” poruka: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Precrtanje teksta: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Indeksiranje teksta: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Eksponentiranje teksta: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopiraj označeni tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Umetni kopirani tekst',
	'ABBC3_PASTE_ERROR'			=> 'Da bi umetnuo/la tekst, prvo ga moraš označiti i kopirati.',
	'ABBC3_PLAIN_BBCODE'		=> 'Izbriši sve BBKod tagove iz označenog teksta.',
	'ABBC3_NOSELECT_ERROR'		=> 'Tekst nije označen.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Umetni u poruku',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Primjer',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Dopuštene stranice',
	'ABBC3_BBVIDEO_LINK'		=> 'URL videa',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Unesite URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Izborni opis',
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
	'ABBC3_BBCODE_ORDERED'		=> 'BBKod poredak je ažuriran.',
	'ABBC3_BBCODE_GROUP'		=> 'Upravljanje grupama koje mogu koristiti ovaj BBKod',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Ukoliko niti jedna grupa nije odabrana, svi/e korisnici/e mogu koristiti ovaj BBKod.<br />Za o(do)značavanje više od jedne grupe, koristi CTRL+KLIK (CMD+KLIK na Macu).',
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
