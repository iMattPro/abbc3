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
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Umetanje URL-a stranice videa: [BBvideo=width,height]http://video_url[/BBvideo]',
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
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideo dopuštene stranice',
	'ABBC3_BBVIDEO_LINK'		=> 'URL videa',
	'ABBC3_BBVIDEO_SIZE'		=> 'Širina x visina videa',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Podešavanje veličine videa',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Unesite URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Izborni opis',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBKod poredak je ažuriran.',
	'ABBC3_BBCODE_GROUP'		=> 'Upravljanje grupama koje mogu koristiti ovaj BBKod',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Ukoliko niti jedna grupa nije odabrana, svi/e korisnici/e mogu koristiti ovaj BBKod.<br />Za o(do)značavanje više od jedne grupe, koristi CTRL+KLIK (CMD+KLIK na Macu).',
));
