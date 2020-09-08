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
	'ABBC3_FONT_BBCODE'			=> 'Menu carattere',
	'ABBC3_FONT_FANCY'			=> 'Caratteri di fantasia',
	'ABBC3_FONT_SAFE'			=> 'Caratteri sicuri',
	'ABBC3_FONT_WIN'			=> 'Caratteri di Windows',

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
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/titolo-canzone[/soundcloud]',
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

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Siti abilitati per i video',
	'ABBC3_BBVIDEO_LINK'		=> 'URL video',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Aggiungi un URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Descrizione opzionale',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Create tables',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Create tables using any of these ASCII-style formats.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'User Guide',
	'ABBC3_PIPE_SIMPLE'			=> 'Simple table',
	'ABBC3_PIPE_COMPACT'		=> 'Compact table',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'The outer pipes and spaces around pipes are optional.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Text alignment',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Ordine dei BBCode aggiornato.',
	'ABBC3_BBCODE_GROUP'		=> 'Gestisci i gruppi che possono usare questo BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Se nessun gruppo è selezionato, allora tutti gli utenti potranno usare questo BBCode. Usa CTRL+CLICK (o CMD+CLICK su Mac) per selezionare/deselezionare più di un gruppo.',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for Advanced BBCode Box 3. For information about customizing the icon bar, visit the <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_PIPES'				=> 'Enable the Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'The Pipes Table PlugIn allows users to create tables in their posts and private messages using markdown syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Enable BBCode icon bar',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display ABBC3’s icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Enable BBCodes in Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'This will add BBCode buttons to Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Icon bar image format',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for ABBC3’s icons. Note that you can only choose one format for all your icons.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Icon Bar',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add Ons',
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Example:</strong><br />%2$s<br /><br /><strong>Result:</strong><br />%3$s<hr />',
));
