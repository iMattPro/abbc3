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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tukaj lahko konfigurirate nastavitve za napredno polje BBKode. Za informacije o prilagajanju vrstice z ikonami obiščite <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Dodajte <a href="https://fonts.google.com" target="_blank">Googlove pisave</a> v <samp>font</samp> BBKode. Uporabite natančno črkovanje in razlikovanje med velikimi in malimi črkami. Vsako ime pisave postavite v ločeno vrstico. Primer: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Upoštevajte, da mora biti za uporabo te funkcije v razdelku Nastavitve nalaganja omogočeno Dovoli uporabo tretjeosebnih omrežij.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
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
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Install the optional phpBB Media Embed extension to access settings and management options for embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extension is not installed. <a href="https://www.phpbb.com/customise/db/extension/mediaembed/" target="_blank">Download <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
		1	=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
