<?php
/**
*
* Advanced BBCode Box [Italian]
* Translated by Loll.
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
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Aggiungi <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> al <samp class="error">[font]</samp> BBCode. Usa lo spelling esatto e contano maiuscole/minuscole. Piazza il nome di ogni font su una riga separata. Esempio: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Consenti l’utilizzo delle reti di distribuzione per contenuti di terze parti:” deve essere abilitato in “Processi” per utilizzare questa caratteristica.',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Qui puoi configurare le impostazioni per l\'Advanced BBCode Box. Per informazioni su come personalizzare la barra delle icone, visita le <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_PIPES'				=> 'Abilita il PlugIn Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Il PlugIn Pipes Table permette agli utenti di creare tabelle nei propri post e messaggi privati utilizzando la sintassi markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Abilita la barra delle icone BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Questo mostrera\' la barra degli strumenti a icone di ABBC3. Disabilitalo per mostrare i pulsanti BBCode predefiniti.',
	'ABBC3_QR_BBCODES'			=> 'Abilita i BBCode nel Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Questo aggiungera\' i pulsanti BBCode al Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Formato immagini della barra delle icone',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Scegli il formato immagini da usare per le icone ABBC3. Nota che puoi scegliere solo un formato per tutte le tue icone.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra delle icone BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add On',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
