<?php
/**
*
* Advanced BBCode Box [Slovak]
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tu môžete nakonfigurovať nastavenia pre Advanced BBCode Box. Informácie o prispôsobení panela s ikonami nájdete na %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Pridajte <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> do <samp class="error">[font]</samp> BBCode. Používajte presný pravopis a rozlišujte malé a veľké písmená. Každý názov písma umiestnite na samostatný riadok.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Ak chcete používať túto funkciu, v časti Načítať nastavenia musí byť povolená možnosť „Povoliť používanie sietí na doručovanie obsahu tretích strán“.',
	'ABBC3_INVALID_FONT'		=> 'Neplatný názov písma pre „%s“',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Nepodarilo sa overiť písmo Google „%s“. Skontrolujte pripojenie k serveru a skúste to znova.',
	'ABBC3_PIPES'				=> 'Povoliť doplnok Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn umožňuje používateľom vytvárať tabuľky vo svojich príspevkoch a súkromných správach pomocou syntaxe markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Povoliť panel s ikonami BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Tým sa zobrazí panel s nástrojmi BBCode založený na ikonách ABBC3. Ak chcete zobraziť predvolené tlačidlá BBCode phpBB, vypnite toto.',
	'ABBC3_QR_BBCODES'			=> 'Povoľte kódy BBC v rýchlej odpovedi',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Tým sa do Rýchlej odpovede pridajú tlačidlá BBCode.',
	'ABBC3_ICONS_TYPE'			=> 'Formát obrázka panela s ikonami',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Vyberte formát obrázka, ktorý chcete použiť pre ikony ABBC3. Upozorňujeme, že pre všetky ikony si môžete vybrať iba jeden formát.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Panel ikon BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Pridať Ons',
	'ABBC3_AUTO_VIDEO'			=> 'Povoliť Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Tento doplnok konvertuje adresy URL video súborov s obyčajným textom na prehrávateľné videá. Konvertujú sa iba adresy URL začínajúce na <samp class="error">http://</samp> alebo <samp class="error">https://</samp> a končiace na <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> alebo <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Nainštalujte si voliteľné rozšírenie phpBB Media Embed, aby ste získali prístup k nastaveniam a možnostiam správy pre vložený multimediálny obsah.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'Rozšírenie phpBB Media Embed nie je nainštalované. %2$s.',
		1	=> 'Rozšírenie phpBB Media Embed je nainštalované. Nastavenia sú dostupné na karte Uverejnenie.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
