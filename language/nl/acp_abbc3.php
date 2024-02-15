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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Hier kan je de instellingen voor Advanced BBCode Box aanpassen. Voor informatie over het aanpassen van de balk met de ikoontjes, zie %1$s ABBC3 FAQ %2$s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Voeg <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> toe aan <samp class="error">[font]</samp> de BBCodes. Gebruik de exacte spelling en let op de hoofdletters. Plaats elke fontnaam op een nieuwe regel.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Gebruik van derde partij inhoud leveringsnetwerken toestaan” moet ingeschakeld zijn in “Laadinstellingen” om dit te kunnen gebruiken.',
	'ABBC3_INVALID_FONT'		=> 'Ongeldige naam van de font voor “%s”',
	'ABBC3_PIPES'				=> 'Pipe Table PlugIn inschakelen',
	'ABBC3_PIPES_EXPLAIN'		=> 'De Pipe Table PlugIn laat gebruikers toe tabellen aan te maken in het forum en in privé-berichten, gebruik makend van markdown syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Schakel de BBCode ikoonbalk in',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Hierdoor wordt ABBC3’s ikoon gebaseerde BBCode werkbalk getoond. Schakel dit uit om phpBB’s eigen BBCode ikoonknoppen te gebruiken.',
	'ABBC3_QR_BBCODES'			=> 'Laat BBCodes toe in Snelle reactie',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Dit voegt BBCode knoppen toe aan Snelle reactie.',
	'ABBC3_ICONS_TYPE'			=> 'Ikoonbalk afbeeldingstype',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Selecteer het te gebruiken afbeeldingstype voor ABBC ikonen. Merk op dat in de ikoonbalk slechts 1 type gebruikt kan worden',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Ikoon balk',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add Ons',
	'ABBC3_AUTO_VIDEO'			=> 'Schakel Auto Video PlugIn in',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Deze plugin converteert video bestand URLs (tekst) naar afspeelbare videos. Enkel URLs beginnend met <samp class="error">http://</samp> or <samp class="error">https://</samp> en eindigend op <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> of <samp class="error">.webm</samp> worden geconverteerd.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installeer de optionele phpBB Media Embed extensie om toegang te krijgen tot de instellings-en beheeropties voor embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extensie is niet geïnstalleerd. %2$s Download %3$s.',
		1	=> 'phpBB Media Embed extensie is geïnstalleerd. Instellingen zijn beschikbaar in de tab Berichten (ACP).'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
