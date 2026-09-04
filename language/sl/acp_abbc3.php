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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tukaj lahko konfigurirate nastavitve za napredno polje BBKode. Za informacije o prilagajanju vrstice z ikonami obiščite %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Dodajte <a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Googlove pisave</a> v <samp>font</samp> BBKode. Uporabite natančno črkovanje in razlikovanje med velikimi in malimi črkami. Vsako ime pisave postavite v ločeno vrstico. Primer: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Upoštevajte, da mora biti za uporabo te funkcije v razdelku Nastavitve nalaganja omogočeno Dovoli uporabo tretjeosebnih omrežij.',
	'ABBC3_INVALID_FONT'		=> 'Neveljavno ime pisave za »%s«',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Ni bilo mogoče preveriti Googlove pisave »%s«. Preverite povezavo s strežnikom in poskusite znova.',
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
	'ABBC3_AUTO_VIDEO'			=> 'Omogoči samodejni video vtičnik',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Ta vtičnik pretvori URL-je video datotek z navadnim besedilom v videoposnetke, ki jih je mogoče predvajati. Pretvorjeni so samo URL-ji, ki se začnejo z <samp class="error">http://</samp> ali <samp class="error">https://</samp> in končajo z <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> ali <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Namestite izbirno razširitev phpBB Media Embed za dostop do nastavitev in možnosti upravljanja za vdelano bogato predstavnostno vsebino.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Razširitev phpBB Media Embed ni nameščena. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Razširitev phpBB Media Embed je nameščena. Nastavitve so dostopne pod zavihkom Objavljanje.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
