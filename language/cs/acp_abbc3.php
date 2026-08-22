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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Zde můžete nakonfigurovat nastavení pro Advanced BBCode Box. Informace o přizpůsobení lišty ikon naleznete na %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Přidejte <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> do <samp class="error">[font]</samp> BBCode. Používejte přesný pravopis a rozlišujte malá a velká písmena. Umístěte každý název písma na samostatný řádek.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Chcete-li používat tuto funkci, musí být v části Načíst nastavení povoleno „Povolit použití sítí pro doručování obsahu třetích stran“.',
	'ABBC3_INVALID_FONT'		=> 'Neplatný název písma pro „%s“',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Nelze ověřit písmo Google „%s“. Zkontrolujte připojení k serveru a zkuste to znovu.',
	'ABBC3_PIPES'				=> 'Povolit plugin Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn umožňuje uživatelům vytvářet tabulky ve svých příspěvcích a soukromých zprávách pomocí markdown syntaxe.',
	'ABBC3_BBCODE_BAR'			=> 'Povolit lištu ikon BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Tím se zobrazí panel nástrojů BBCode založený na ikonách ABBC3. Vypněte toto, chcete-li zobrazit výchozí tlačítka BBCode phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Povolte BBCodes v Rychlé odpovědi',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Tím přidáte tlačítka BBCode do Rychlé odpovědi.',
	'ABBC3_ICONS_TYPE'			=> 'Formát obrázku lišty ikon',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Vyberte formát obrázku, který chcete použít pro ikony ABBC3. Pamatujte, že pro všechny ikony můžete vybrat pouze jeden formát.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Lišta ikon BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Přidat Ons',
	'ABBC3_AUTO_VIDEO'			=> 'Povolit Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Tento plugin převádí adresy URL souborů videa ve formátu prostého textu na videa, která lze přehrát. Převedou se pouze adresy URL začínající <samp class="error">http://</samp> nebo <samp class="error">https://</samp> a končící <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> nebo <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Nainstalujte si volitelné rozšíření phpBB Media Embed pro přístup k nastavení a možnostem správy pro vložený multimediální obsah.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'Rozšíření phpBB Media Embed není nainstalováno. %2$s.',
		1	=> 'Je nainstalováno rozšíření phpBB Media Embed. Nastavení jsou dostupná na kartě Odesílání.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
