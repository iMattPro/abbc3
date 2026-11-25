<?php
/**
*
* Advanced BBCode Box [Czech]
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Zde můžete nakonfigurovat nastavení pro Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Přidejte <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> do <samp class="error">[font]</samp> BBCode. Používejte přesný pravopis a rozlišujte malá a velká písmena. Umístěte každý název písma na samostatný řádek.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Chcete-li používat tuto funkci, musí být v části Načíst nastavení povoleno „Povolit použití sítí pro doručování obsahu třetích stran“.',
	'ABBC3_FONT_SEARCH'	=> 'Hledat v Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Načítají se názvy písem…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Žádná odpovídající písma.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Katalog písem není dostupný. Zadejte názvy ručně.',
	'ABBC3_SAVE_FONTS'	=> 'Uložit písma',
	'ABBC3_FONTS_CHECKING'	=> 'Kontrola a ukládání písem…',
	'ABBC3_FONTS_SAVED'	=> 'Písma byla uložena.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Editor panelu nástrojů',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Přetahujte tlačítka mezi skupinami Hlavní, Další a Skrytá. Výběrem tlačítka je můžete přizpůsobit. Ikona Font Awesome má přednost před obrázkem. Bez obrázku se zobrazí název BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Hlavní',
	'ABBC3_TOOLBAR_MORE'	=> 'Další',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Skrytá',
	'ABBC3_FONT_ICON'	=> 'Ikona Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Obrázková ikona',
	'ABBC3_ICON_NONE'	=> 'Bez ikony (použít text)',
	'ABBC3_PLACEMENT'	=> 'Umístění',
	'ABBC3_TOOLBAR_DISABLED'	=> 'Panel ikon BBCode je vypnutý. Rozložení můžete dál upravovat a použije se po opětovném zapnutí.',
	'ABBC3_LIVE_PREVIEW'	=> 'Živý náhled',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Ukládání…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Uloženo',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Změny se nepodařilo uložit.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Zkusit znovu',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Ke změně nastavení Advanced [BBCode] Box je nutný JavaScript.',
	'ABBC3_DRAG_BUTTON'	=> 'Přetáhnout %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo a Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Neplatný název písma pro „%s“',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Nelze ověřit písmo Google „%s“. Zkontrolujte připojení k serveru a zkuste to znovu.',
	'ABBC3_PIPES'				=> 'Povolit plugin Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn umožňuje uživatelům vytvářet tabulky ve svých příspěvcích a soukromých zprávách pomocí markdown syntaxe.',
	'ABBC3_BBCODE_BAR'			=> 'Povolit lištu ikon BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Zobrazí panel nástrojů BBCode s ikonami. Vypnutím této možnosti zobrazíte výchozí tlačítka BBCode v phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Povolte BBCodes v Rychlé odpovědi',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Tím přidáte tlačítka BBCode do Rychlé odpovědi.',
	'ABBC3_ICONS_TYPE'			=> 'Formát obrázku lišty ikon',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Vyberte formát obrázků pro ikony BBCode. Další ikony ve formátu SVG nebo PNG můžete nahrát do adresáře <samp class="error">/images/abbc3/icons/</samp> svého fóra.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Lišta ikon BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Přidat Ons',
	'ABBC3_AUTO_VIDEO'			=> 'Povolit Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Tento plugin převádí adresy URL souborů videa ve formátu prostého textu na videa, která lze přehrát. Převedou se pouze adresy URL začínající <samp class="error">http://</samp> nebo <samp class="error">https://</samp> a končící <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> nebo <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Nainstalujte si volitelné rozšíření phpBB Media Embed pro přístup k nastavení a možnostem správy pro vložený multimediální obsah.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Rozšíření phpBB Media Embed není nainstalováno. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Je nainstalováno rozšíření phpBB Media Embed. Nastavení jsou dostupná na kartě Odesílání.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
