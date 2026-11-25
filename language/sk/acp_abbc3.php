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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tu môžete nakonfigurovať nastavenia pre Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Pridajte <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> do <samp class="error">[font]</samp> BBCode. Používajte presný pravopis a rozlišujte malé a veľké písmená. Každý názov písma umiestnite na samostatný riadok.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Ak chcete používať túto funkciu, v časti Načítať nastavenia musí byť povolená možnosť „Povoliť používanie sietí na doručovanie obsahu tretích strán“.',
	'ABBC3_FONT_SEARCH'	=> 'Hľadať v Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Načítavajú sa názvy písiem…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Nenašli sa žiadne zodpovedajúce písma.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Katalóg písiem nie je dostupný. Zadajte názvy ručne.',
	'ABBC3_SAVE_FONTS'	=> 'Uložiť písma',
	'ABBC3_FONTS_CHECKING'	=> 'Kontrola a ukladanie písiem…',
	'ABBC3_FONTS_SAVED'	=> 'Písma boli uložené.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Editor panela nástrojov',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Presúvajte tlačidlá medzi skupinami Hlavné, Ďalšie a Skryté. Výberom tlačidla ho môžete prispôsobiť. Ikona Font Awesome má prednosť pred obrázkom. Bez obrázka sa zobrazí názov BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Hlavné',
	'ABBC3_TOOLBAR_MORE'	=> 'Ďalšie',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Skryté',
	'ABBC3_FONT_ICON'	=> 'Ikona Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Obrázková ikona',
	'ABBC3_ICON_NONE'	=> 'Bez ikony (použiť text)',
	'ABBC3_PLACEMENT'	=> 'Umiestnenie',
	'ABBC3_TOOLBAR_DISABLED'	=> 'Panel ikon BBCode je vypnutý. Rozloženie môžete ďalej upravovať a použije sa pri opätovnom zapnutí.',
	'ABBC3_LIVE_PREVIEW'	=> 'Živý náhľad',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Ukladá sa…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Uložené',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Zmeny sa nepodarilo uložiť.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Skúsiť znova',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Na zmenu nastavení Advanced [BBCode] Box je potrebný JavaScript.',
	'ABBC3_DRAG_BUTTON'	=> 'Presunúť %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo a Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Neplatný názov písma pre „%s“',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Nepodarilo sa overiť písmo Google „%s“. Skontrolujte pripojenie k serveru a skúste to znova.',
	'ABBC3_PIPES'				=> 'Povoliť doplnok Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn umožňuje používateľom vytvárať tabuľky vo svojich príspevkoch a súkromných správach pomocou syntaxe markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Povoliť panel s ikonami BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Táto možnosť zobrazí panel nástrojov BBCode s ikonami. Vypnite ju, ak chcete zobraziť predvolené tlačidlá BBCode v phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Povoľte kódy BBC v rýchlej odpovedi',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Tým sa do Rýchlej odpovede pridajú tlačidlá BBCode.',
	'ABBC3_ICONS_TYPE'			=> 'Formát obrázka panela s ikonami',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Vyberte formát obrázkov pre ikony BBCode. Ďalšie ikony vo formáte SVG alebo PNG môžete nahrať do adresára <samp class="error">/images/abbc3/icons/</samp> svojho fóra.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Panel ikon BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Pridať Ons',
	'ABBC3_AUTO_VIDEO'			=> 'Povoliť Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Tento doplnok konvertuje adresy URL video súborov s obyčajným textom na prehrávateľné videá. Konvertujú sa iba adresy URL začínajúce na <samp class="error">http://</samp> alebo <samp class="error">https://</samp> a končiace na <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> alebo <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Nainštalujte si voliteľné rozšírenie phpBB Media Embed, aby ste získali prístup k nastaveniam a možnostiam správy pre vložený multimediálny obsah.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Rozšírenie phpBB Media Embed nie je nainštalované. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Rozšírenie phpBB Media Embed je nainštalované. Nastavenia sú dostupné na karte Uverejnenie.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
