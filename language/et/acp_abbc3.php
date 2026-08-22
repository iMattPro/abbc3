<?php
/**
*
* Advanced BBCode Box [Estonian]
* Translated by phpBBeesti.com (http://www.phpbbeesti.com) 05/2015
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Siin saate konfigureerida täpsema BBCode Boxi sätteid. Ikooniriba kohandamise kohta teabe saamiseks külastage aadressi %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Lisage <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google’i fondid</a></strong> <samp class="error">[font]</samp> BBC-koodi. Kasutage täpset õigekirja ja tõstutundlikkust. Asetage iga fondi nimi eraldi reale.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Selle funktsiooni kasutamiseks peab jaotises „Laadi seaded” olema lubatud valik „Luba kasutada kolmanda osapoole sisuedastusvõrke”.',
	'ABBC3_INVALID_FONT'		=> 'Kehtetu fondi nimi „%s” jaoks',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Google’i fondi "%s" ei saanud kinnitada. Kontrollige serveri ühendust ja proovige uuesti.',
	'ABBC3_PIPES'				=> 'Luba Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn võimaldab kasutajatel luua oma postitustes ja privaatsõnumites tabeleid, kasutades märgistuse süntaksit.',
	'ABBC3_BBCODE_BAR'			=> 'Luba BBCode ikooniriba',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'See kuvab ABBC3 ikoonipõhise BBCode tööriistariba. Keela see, et kuvada phpBB BBCode’i vaikenuppe.',
	'ABBC3_QR_BBCODES'			=> 'Luba BBCodes kiirvastuses',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'See lisab kiirvastusest BBCode’i nupud.',
	'ABBC3_ICONS_TYPE'			=> 'Ikooniriba pildivorming',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Valige ABBC3 ikoonide jaoks kasutatav pildivorming. Pange tähele, et saate valida kõigi ikoonide jaoks ainult ühe vormingu.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode ikooniriba',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Lisad',
	'ABBC3_AUTO_VIDEO'			=> 'Luba automaatne video pistikprogramm',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'See pistikprogramm teisendab lihtteksti videofailide URL-id esitatavateks videoteks. Teisendatakse ainult URL-id, mis algavad tähega <samp class="error">http://</samp> või <samp class="error">https://</samp> ja lõpevad numbritega <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> või <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Manustatud rikasmeedia sisu seadetele ja haldussuvanditele juurdepääsuks installige valikuline laiendus phpBB Media Embed.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed laiendust pole installitud. %2$s.',
		1	=> 'phpBB Media Embed laiendus on installitud. Seaded on saadaval vahekaardil Postitamine.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
