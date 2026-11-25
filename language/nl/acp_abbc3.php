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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Hier kunt u de instellingen voor Advanced [BBCode] Box configureren.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Voeg <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> toe aan de <samp class="error">[font]</samp> BBCode. Gebruik exacte spelling en hoofdlettergevoeligheid. Plaats elke lettertype naam op een aparte regel.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Gebruik van externe content delivery networks toestaan” moet ingeschakeld zijn onder “Laadinstellingen” om deze functie te gebruiken.',
	'ABBC3_FONT_SEARCH'	=> 'Zoeken in Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Lettertypenamen laden…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Geen overeenkomende lettertypen.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'De lettertypecatalogus is niet beschikbaar. Voer de namen handmatig in.',
	'ABBC3_SAVE_FONTS'	=> 'Lettertypen opslaan',
	'ABBC3_FONTS_CHECKING'	=> 'Lettertypen controleren en opslaan…',
	'ABBC3_FONTS_SAVED'	=> 'Lettertypen opgeslagen.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Werkbalkeditor',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Sleep knoppen tussen Primair, Meer en Verborgen. Selecteer een knop om deze aan te passen. Een Font Awesome-pictogram heeft voorrang op de afbeelding. Kies geen afbeelding om de BBCode-naam weer te geven.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Primair',
	'ABBC3_TOOLBAR_MORE'	=> 'Meer',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Verborgen',
	'ABBC3_FONT_ICON'	=> 'Font Awesome-pictogram',
	'ABBC3_IMAGE_ICON'	=> 'Afbeeldingspictogram',
	'ABBC3_ICON_NONE'	=> 'Geen (tekst gebruiken)',
	'ABBC3_PLACEMENT'	=> 'Plaatsing',
	'ABBC3_TOOLBAR_DISABLED'	=> 'De BBCode-pictogrambalk is uitgeschakeld. U kunt de indeling blijven bewerken. Deze wordt toegepast wanneer u de balk weer inschakelt.',
	'ABBC3_LIVE_PREVIEW'	=> 'Livevoorbeeld',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Opslaan…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Opgeslagen',
	'ABBC3_AUTOSAVE_ERROR'	=> 'De wijzigingen konden niet worden opgeslagen.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Opnieuw proberen',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'JavaScript is vereist om de instellingen van Advanced [BBCode] Box te wijzigen.',
	'ABBC3_DRAG_BUTTON'	=> '%s slepen',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo en Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Ongeldige lettertype naam voor “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Kan Google-lettertype ‘%s’ niet verifiëren. Controleer de serververbinding en probeer het opnieuw.',
	'ABBC3_PIPES'				=> 'Schakel Pipe Table PlugIn in',
	'ABBC3_PIPES_EXPLAIN'		=> 'De Pipe Table PlugIn stelt gebruikers in staat om tabellen te maken in hun berichten en privéberichten met behulp van markdown-syntaxis.',
	'ABBC3_BBCODE_BAR'			=> 'Schakel BBCode werkbalk in',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Deze optie toont een BBCode-werkbalk met pictogrammen. Schakel deze optie uit om de standaard BBCode-knoppen van phpBB weer te geven.',
	'ABBC3_QR_BBCODES'			=> 'Schakel BBCodes in Snelle Reactie in',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Dit voegt BBCode-knoppen toe aan Snelle Reactie.',
	'ABBC3_ICONS_TYPE'			=> 'Beeldformaat van werkbalkpictogrammen',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Kies het afbeeldingsformaat voor de BBCode-pictogrammen. U kunt extra SVG- of PNG-pictogrammen uploaden naar de map <samp class="error">/images/abbc3/icons/</samp> van uw forum.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Werkbalk',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add-ons',
	'ABBC3_AUTO_VIDEO'			=> 'Schakel Auto Video PlugIn in',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Deze plugin converteert platte tekst videobestands-URL’s naar afspeelbare video’s. Alleen URL’s die beginnen met <samp class="error">http://</samp> of <samp class="error">https://</samp> en eindigen met <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> of <samp class="error">.webm</samp> worden geconverteerd.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installeer de optionele phpBB Media Embed extensie om toegang te krijgen tot de instellings-en beheeropties voor embedded rich media content.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed-extensie is niet geïnstalleerd. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed-extensie is geïnstalleerd. Instellingen zijn toegankelijk onder het tabblad Plaatsen.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
