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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Contenuto nascosto',
	'ABBC3_HIDDEN_OFF'			=> 'Contenuto nascosto (per soli membri)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Registrati ed effettua l\'accesso per visualizzare questo contenuto.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Mostra testo',
	'ABBC3_SPOILER_HIDE'		=> '▼ Nascondi testo',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Caratteri',
	'ABBC3_FONT_SAFE'			=> 'Caratteri sicuri',
	'ABBC3_GOOGLE_FONTS'		=> 'Caratteri di Google',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Allineamento testo: [align=center|left|right|justify]testo[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Inserimento video: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Testo con sfocatura: [blur=color]testo[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Direzione testo: [dir=ltr|rtl]testo[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Colore testo con ombreggiatura: [dropshadow=color]testo[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Testo con assolvenza/dissolvenza: [fade]testo[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Float: [float=left|right]testo[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Tipo di carattere: [font=Comic Sans MS]testo[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Testo con bagliore: [glow=color]testo[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Testo nascosto agli ospiti: [hidden]testo[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Testo evidenziato: [highlight=yellow]testo[/highlight]  Suggerimento: puoi anche usare color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Testo a scorrimento: [marq=up|down|left|right]testo[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Messaggio d\'allerta: [mod=username]testo[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ASCII Art: [nfo]testo[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Messaggio Off Topic: [offtopic]testo[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Testo preformattato: [pre]testo[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Shadow text: [shadow=color]testo[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]https://soundcloud.com/user-name/titolo-canzone[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler: [spoil]testo[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Testo barrato: [s]testo[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Pedice: [sub]testo[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Apice: [sup]testo[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Video di YouTube: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Copia il testo selezionato',
	'ABBC3_PASTE_BBCODE'		=> 'Incolla il testo copiato',
	'ABBC3_PASTE_ERROR'			=> 'Devi copiare una parte di testo prima di poterla incollare',
	'ABBC3_PLAIN_BBCODE'		=> 'Rimuovi tutti i tag BBCode dal testo selezionato',
	'ABBC3_NOSELECT_ERROR'		=> 'Nessuna parte di testo selezionata.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Inserire nel messaggio',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Esempio',
	'ABBC3_BBVIDEO_SITES'		=> 'Siti abilitati per i video',
	'ABBC3_URL_LINK'			=> 'Aggiungi un URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Descrizione opzionale',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Crea tabelle',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Crea tabelle utilizzando uno qualsiasi di questi formati di stile ASCII.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Guida Utente',
	'ABBC3_PIPE_SIMPLE'			=> 'Tabella semplice',
	'ABBC3_PIPE_COMPACT'		=> 'Tabella compatta',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'I pipes esterni e gli spazi attorno ai pipes sono opzionali.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Allineamento del testo',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Ordine dei BBCode aggiornato.',
	'ABBC3_BBCODE_GROUP'		=> 'Gestisci i gruppi che possono usare questo BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Se nessun gruppo è selezionato, allora tutti gli utenti potranno usare questo BBCode. Usa CTRL+CLICK (o CMD+CLICK su Mac) per selezionare/deselezionare più di un gruppo.',
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

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'BBCode dell\'Advanced BBCode Box',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Qualche vago ione tipo zolfo, bromo, sodio',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Esempio:</strong><br>%2$s<br><br><strong>Risultato:</strong><br>%3$s<hr />',
));
