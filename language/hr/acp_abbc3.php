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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Ovdje možete konfigurirati postavke za Advanced BBCode Box. Za informacije o prilagodbi trake ikona, posjetite %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Dodajte <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fontove</a></strong> <samp class="error">[font]</samp> BBCodu. Koristite točan pravopis i osjetljivost na velika i mala slova. Stavite svaki naziv fonta u zaseban redak.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '"Dopusti korištenje mreža za isporuku sadržaja trećih strana" mora biti omogućeno pod "Učitaj postavke" za korištenje ove značajke.',
	'ABBC3_INVALID_FONT'		=> 'Nevažeći naziv fonta za “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Nije moguće provjeriti Google font "%s". Provjerite vezu s poslužiteljem i pokušajte ponovno.',
	'ABBC3_PIPES'				=> 'Omogući dodatak Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn omogućuje korisnicima stvaranje tablica u svojim postovima i privatnim porukama pomoću sintakse markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Omogući traku ikona BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Ovo će prikazati BBCode alatnu traku temeljenu na ikonama ABBC3. Onemogućite ovo za prikaz phpBB-ovih zadanih BBCode gumba.',
	'ABBC3_QR_BBCODES'			=> 'Omogućite BBCodove u brzom odgovoru',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Ovo će dodati gumbe BBCode brzom odgovoru.',
	'ABBC3_ICONS_TYPE'			=> 'Format slike trake s ikonama',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Odaberite format slike koji će se koristiti za ikone ABBC3. Imajte na umu da možete odabrati samo jedan format za sve svoje ikone.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Traka ikona BBKod',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Dodaci',
	'ABBC3_AUTO_VIDEO'			=> 'Omogući Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Ovaj dodatak pretvara URL-ove video datoteka običnog teksta u videozapise koji se mogu reproducirati. Pretvaraju se samo URL-ovi koji počinju s <samp class="error">http://</samp> ili <samp class="error">https://</samp> i završavaju s <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> ili <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Instalirajte izborno proširenje phpBB Media Embed za pristup postavkama i mogućnostima upravljanja za ugrađeni bogati medijski sadržaj.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed proširenje nije instalirano. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed proširenje je instalirano. Postavke su dostupne pod karticom Objavljivanje.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
