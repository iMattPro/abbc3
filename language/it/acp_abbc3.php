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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Qui puoi configurare le impostazioni per l’Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Aggiungi <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> al <samp class="error">[font]</samp> BBCode. Usa lo spelling esatto e contano maiuscole/minuscole. Piazza il nome di ogni font su una riga separata. Esempio: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Consenti l’utilizzo delle reti di distribuzione per contenuti di terze parti:” deve essere abilitato in “Processi” per utilizzare questa caratteristica.',
	'ABBC3_FONT_SEARCH'	=> 'Cerca in Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Caricamento dei nomi dei font…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Nessun font corrispondente.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Il catalogo dei font non è disponibile. Inserisci i nomi manualmente.',
	'ABBC3_SAVE_FONTS'	=> 'Salva i font',
	'ABBC3_FONTS_CHECKING'	=> 'Verifica e salvataggio dei font…',
	'ABBC3_FONTS_SAVED'	=> 'Font salvati.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Editor della barra degli strumenti',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Trascina i pulsanti tra Principali, Altro e Nascosti. Seleziona un pulsante per personalizzarlo. L’icona Font Awesome ha la precedenza sull’immagine. Per mostrare il nome del BBCode, non selezionare un’immagine.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Principali',
	'ABBC3_TOOLBAR_MORE'	=> 'Altro',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Nascosti',
	'ABBC3_FONT_ICON'	=> 'Icona Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Icona immagine',
	'ABBC3_ICON_NONE'	=> 'Nessuna (usa il testo)',
	'ABBC3_PLACEMENT'	=> 'Posizione',
	'ABBC3_TOOLBAR_DISABLED'	=> 'La barra delle icone BBCode è disattivata. Puoi comunque modificarne la disposizione, che sarà applicata quando la riattiverai.',
	'ABBC3_LIVE_PREVIEW'	=> 'Anteprima in tempo reale',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Salvataggio…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Salvato',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Impossibile salvare le modifiche.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Riprova',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Per modificare le impostazioni di Advanced [BBCode] Box è necessario JavaScript.',
	'ABBC3_DRAG_BUTTON'	=> 'Trascina %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo e Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Nome del carattere non valido per “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Impossibile verificare il carattere Google “%s”. Controlla la connessione al server e riprova.',
	'ABBC3_PIPES'				=> 'Abilita il PlugIn Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Il PlugIn Pipes Table permette agli utenti di creare tabelle nei propri post e messaggi privati utilizzando la sintassi markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Abilita la barra delle icone BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Questa opzione mostra una barra degli strumenti BBCode con icone. Disattivala per mostrare i pulsanti BBCode predefiniti di phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Abilita i BBCode nel Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Questo aggiungera’ i pulsanti BBCode al Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Formato immagini della barra delle icone',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Scegli il formato delle immagini per le icone BBCode. Puoi caricare altre icone SVG o PNG nella cartella <samp class="error">/images/abbc3/icons/</samp> del tuo forum.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra delle icone BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add On',
	'ABBC3_AUTO_VIDEO'			=> 'Abilita il plug-in video automatico',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Questo plugin converte gli URL di file video di testo semplice in video riproducibili. Vengono convertiti solo gli URL che iniziano con <samp class="error">http://</samp> o <samp class="error">https://</samp> e terminano con <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> o <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installa l’estensione opzionale phpBB Media Embed per accedere alle impostazioni e alle opzioni di gestione per i contenuti multimediali incorporati.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'L’estensione phpBB Media Embed non è installata. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'L’estensione phpBB Media Embed è installata. Le impostazioni sono accessibili nella scheda Pubblicazione.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
