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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Siin saate konfigureerida täpsema BBCode Boxi sätteid.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Lisage <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google’i fondid</a></strong> <samp class="error">[font]</samp> BBC-koodi. Kasutage täpset õigekirja ja tõstutundlikkust. Asetage iga fondi nimi eraldi reale.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Selle funktsiooni kasutamiseks peab jaotises „Laadi seaded” olema lubatud valik „Luba kasutada kolmanda osapoole sisuedastusvõrke”.',
	'ABBC3_FONT_SEARCH'	=> 'Otsi Google Fontsist',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Fondinimede laadimine…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Sobivaid fonte ei leitud.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Fondikataloog pole saadaval. Sisestage nimed käsitsi.',
	'ABBC3_SAVE_FONTS'	=> 'Salvesta fondid',
	'ABBC3_FONTS_CHECKING'	=> 'Fontide kontrollimine ja salvestamine…',
	'ABBC3_FONTS_SAVED'	=> 'Fondid salvestatud.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Tööriistariba redaktor',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Lohista nuppe rühmade „Põhinupud“, „Veel“ ja „Peidetud“ vahel. Nupu kohandamiseks vali see. Font Awesome’i ikoon asendab pildi. Ilma pildita kuvatakse BBCode’i nimi.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Põhinupud',
	'ABBC3_TOOLBAR_MORE'	=> 'Veel',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Peidetud',
	'ABBC3_FONT_ICON'	=> 'Font Awesome’i ikoon',
	'ABBC3_IMAGE_ICON'	=> 'Pildikoon',
	'ABBC3_ICON_NONE'	=> 'Puudub (kasuta teksti)',
	'ABBC3_PLACEMENT'	=> 'Paigutus',
	'ABBC3_TOOLBAR_DISABLED'	=> 'BBCode’i ikooniriba on välja lülitatud. Paigutust saab edasi muuta ja see rakendub riba uuesti sisselülitamisel.',
	'ABBC3_LIVE_PREVIEW'	=> 'Reaalajas eelvaade',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Salvestamine…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Salvestatud',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Muudatusi ei saanud salvestada.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Proovi uuesti',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Advanced [BBCode] Boxi seadete muutmiseks on vaja JavaScripti.',
	'ABBC3_DRAG_BUTTON'	=> 'Lohista %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo ja Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Kehtetu fondi nimi „%s” jaoks',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Google’i fondi "%s" ei saanud kinnitada. Kontrollige serveri ühendust ja proovige uuesti.',
	'ABBC3_PIPES'				=> 'Luba Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn võimaldab kasutajatel luua oma postitustes ja privaatsõnumites tabeleid, kasutades märgistuse süntaksit.',
	'ABBC3_BBCODE_BAR'			=> 'Luba BBCode ikooniriba',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'See valik kuvab ikoonidega BBCode’i tööriistariba. phpBB BBCode’i vaikenuppude kuvamiseks lülitage see valik välja.',
	'ABBC3_QR_BBCODES'			=> 'Luba BBCodes kiirvastuses',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'See lisab kiirvastusest BBCode’i nupud.',
	'ABBC3_ICONS_TYPE'			=> 'Ikooniriba pildivorming',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Valige BBCode’i ikoonide pildivorming. Täiendavaid SVG- või PNG-ikoone saab üles laadida foorumi kataloogi <samp class="error">/images/abbc3/icons/</samp>.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode ikooniriba',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Lisad',
	'ABBC3_AUTO_VIDEO'			=> 'Luba automaatne video pistikprogramm',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'See pistikprogramm teisendab lihtteksti videofailide URL-id esitatavateks videoteks. Teisendatakse ainult URL-id, mis algavad tähega <samp class="error">http://</samp> või <samp class="error">https://</samp> ja lõpevad numbritega <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> või <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Manustatud rikasmeedia sisu seadetele ja haldussuvanditele juurdepääsuks installige valikuline laiendus phpBB Media Embed.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed laiendust pole installitud. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed laiendus on installitud. Seaded on saadaval vahekaardil Postitamine.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
