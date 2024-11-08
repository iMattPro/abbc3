<?php
/**
*
* Advanced BBCode Box [Dutch]
* Translated by Dutch Translators (https://github.com/dutch-translators)
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Hier kunt u de instellingen voor Advanced BBCode Box configureren. Voor informatie over het aanpassen van de werkbalk met pictogrammen, bezoek de %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Voeg <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> toe aan de <samp class="error">[font]</samp> BBCode. Gebruik exacte spelling en hoofdlettergevoeligheid. Plaats elke lettertype naam op een aparte regel.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Gebruik van externe content delivery networks toestaan” moet ingeschakeld zijn onder “Laadinstellingen” om deze functie te gebruiken.',
	'ABBC3_INVALID_FONT'		=> 'Ongeldige lettertype naam voor “%s”',
	'ABBC3_PIPES'				=> 'Schakel Pipe Table PlugIn in',
	'ABBC3_PIPES_EXPLAIN'		=> 'De Pipe Table PlugIn stelt gebruikers in staat om tabellen te maken in hun berichten en privéberichten met behulp van markdown-syntaxis.',
	'ABBC3_BBCODE_BAR'			=> 'Schakel BBCode werkbalk in',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Dit toont ABBC3’s werkbalk met BBCode-pictogrammen. Schakel dit uit om de standaard BBCode-knoppen van phpBB weer te geven.',
	'ABBC3_QR_BBCODES'			=> 'Schakel BBCodes in Snelle Reactie in',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Dit voegt BBCode-knoppen toe aan Snelle Reactie.',
	'ABBC3_ICONS_TYPE'			=> 'Beeldformaat van werkbalkpictogrammen',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Kies het beeldformaat voor de ABBC3-pictogrammen. Houd er rekening mee dat u slechts één formaat voor al uw pictogrammen kunt kiezen.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Werkbalk',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add Ons',
	'ABBC3_AUTO_VIDEO'			=> 'Schakel Auto Video PlugIn in',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Deze plugin converteert platte tekst videobestands-URL’s naar afspeelbare video’s. Alleen URL’s die beginnen met <samp class="error">http://</samp> of <samp class="error">https://</samp> en eindigen met <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> of <samp class="error">.webm</samp> worden geconverteerd.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installeer de optionele phpBB Media Embed extensie om toegang te krijgen tot de instellings-en beheeropties voor embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed-extensie is niet geïnstalleerd. %2$s.',
		1	=> 'phpBB Media Embed-extensie is geïnstalleerd. Instellingen zijn toegankelijk onder het tabblad Plaatsen.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
