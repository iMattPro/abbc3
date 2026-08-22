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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Qui puoi configurare le impostazioni per l’Advanced BBCode Box. Per informazioni su come personalizzare la barra delle icone, visita le %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Aggiungi <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> al <samp class="error">[font]</samp> BBCode. Usa lo spelling esatto e contano maiuscole/minuscole. Piazza il nome di ogni font su una riga separata. Esempio: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Consenti l’utilizzo delle reti di distribuzione per contenuti di terze parti:” deve essere abilitato in “Processi” per utilizzare questa caratteristica.',
	'ABBC3_INVALID_FONT'		=> 'Nome del carattere non valido per “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Impossibile verificare il carattere Google “%s”. Controlla la connessione al server e riprova.',
	'ABBC3_PIPES'				=> 'Abilita il PlugIn Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Il PlugIn Pipes Table permette agli utenti di creare tabelle nei propri post e messaggi privati utilizzando la sintassi markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Abilita la barra delle icone BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Questo mostrera’ la barra degli strumenti a icone di ABBC3. Disabilitalo per mostrare i pulsanti BBCode predefiniti.',
	'ABBC3_QR_BBCODES'			=> 'Abilita i BBCode nel Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Questo aggiungera’ i pulsanti BBCode al Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Formato immagini della barra delle icone',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Scegli il formato immagini da usare per le icone ABBC3. Nota che puoi scegliere solo un formato per tutte le tue icone.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra delle icone BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add On',
	'ABBC3_AUTO_VIDEO'			=> 'Abilita il plug-in video automatico',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Questo plugin converte gli URL di file video di testo semplice in video riproducibili. Vengono convertiti solo gli URL che iniziano con <samp class="error">http://</samp> o <samp class="error">https://</samp> e terminano con <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> o <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installa l’estensione opzionale phpBB Media Embed per accedere alle impostazioni e alle opzioni di gestione per i contenuti multimediali incorporati.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'L’estensione phpBB Media Embed non è installata. %2$s.',
		1	=> 'L’estensione phpBB Media Embed è installata. Le impostazioni sono accessibili nella scheda Pubblicazione.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
