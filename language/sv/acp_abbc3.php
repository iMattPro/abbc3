<?php
/**
*
* Advanced BBCode Box [Swedish]
* Swedish translation by Kimmy (http://www.dreadheads.se)
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Här kan du konfigurera inställningar för Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Lägg till <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> till <samp class="error">[font]</samp> BBC-koden. Använd exakt stavning och skiftlägeskänslighet. Placera varje teckensnittsnamn på en separat rad.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '"Tillåt användning av tredjepartsnätverk för innehållsleverans" måste vara aktiverat under "Ladda inställningar" för att använda den här funktionen.',
	'ABBC3_INVALID_FONT'		=> 'Ogiltigt teckensnittsnamn för "%s"',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Kunde inte verifiera Google Font "%s". Kontrollera serveranslutningen och försök igen.',
	'ABBC3_PIPES'				=> 'Aktivera Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn låter användare skapa tabeller i sina inlägg och privata meddelanden med hjälp av markdown-syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Aktivera BBCode-ikonfältet',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Det här alternativet visar ett BBCode-verktygsfält med ikoner. Inaktivera det för att visa phpBB:s vanliga BBCode-knappar.',
	'ABBC3_QR_BBCODES'			=> 'Aktivera BBCoder i Snabbsvar',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Detta kommer att lägga till BBCode-knappar till Snabbsvar.',
	'ABBC3_ICONS_TYPE'			=> 'Ikonfältets bildformat',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Välj bildformat för BBCode-ikonerna. Du kan ladda upp fler SVG- eller PNG-ikoner till katalogen <samp class="error">/images/abbc3/icons/</samp> på ditt forum.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Ikonrad för BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Tillägg',
	'ABBC3_AUTO_VIDEO'			=> 'Aktivera Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Detta plugin konverterar webbadresser till videofiler i vanlig text till spelbara videor. Endast webbadresser som börjar med <samp class="error">http://</samp> eller <samp class="error">https://</samp> och slutar med <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> eller <samp class="error">.webm</samp> konverteras.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installera det valfria tillägget phpBB Media Embed för att komma åt inställningar och hanteringsalternativ för inbäddat multimedieinnehåll.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed-tillägget är inte installerat. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed-tillägget är installerat. Inställningarna är tillgängliga under fliken Inlägg.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
