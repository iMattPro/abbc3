<?php
/**
*
* Advanced BBCode Box [Finnish]
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Täällä voit määrittää Advanced BBCode Boxin asetukset. Lisätietoja kuvakepalkin mukauttamisesta on osoitteessa %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Lisää <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> <samp class="error">[font]</samp> BBCodeen. Käytä tarkkaa oikeinkirjoitusta ja kirjainerottelua. Aseta kunkin fontin nimi omalle riville.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '"Salli kolmansien osapuolien sisällönjakeluverkkojen käyttö" on otettava käyttöön "Lataa asetukset" -kohdassa, jotta voit käyttää tätä ominaisuutta.',
	'ABBC3_INVALID_FONT'		=> 'Virheellinen fontin nimi "%s"',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Google-kirjasinta "%s" ei voitu vahvistaa. Tarkista palvelinyhteys ja yritä uudelleen.',
	'ABBC3_PIPES'				=> 'Ota Pipe Table PlugIn käyttöön',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugInin avulla käyttäjät voivat luoda taulukoita viesteihinsä ja yksityisviesteihinsä käyttämällä markdown-syntaksia.',
	'ABBC3_BBCODE_BAR'			=> 'Ota BBCode-kuvakepalkki käyttöön',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Tämä näyttää ABBC3:n kuvakepohjaisen BBCode-työkalupalkin. Poista tämä käytöstä näyttääksesi phpBB:n oletusarvoiset BBCode-painikkeet.',
	'ABBC3_QR_BBCODES'			=> 'Ota BBCodes käyttöön Pikavastauksessa',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Tämä lisää BBCode-painikkeet pikavastaukseen.',
	'ABBC3_ICONS_TYPE'			=> 'Kuvakepalkin kuvamuoto',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Valitse ABBC3:n kuvakkeille käytettävä kuvamuoto. Huomaa, että voit valita vain yhden muodon kaikille kuvakkeillesi.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode-kuvakepalkki',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Lisäosat',
	'ABBC3_AUTO_VIDEO'			=> 'Ota Auto Video PlugIn käyttöön',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Tämä laajennus muuntaa pelkkätekstivideotiedostojen URL-osoitteet toistettaviksi videoiksi. Vain URL-osoitteet, jotka alkavat <samp class="error">http://</samp> tai <samp class="error">https://</samp> ja päättyvät <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> tai <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Asenna valinnainen phpBB Media Embed -laajennus, jotta voit käyttää upotetun multimediasisällön asetuksia ja hallintavaihtoehtoja.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed -laajennusta ei ole asennettu. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed -laajennus on asennettu. Asetukset ovat käytettävissä Lähetys-välilehdellä.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
