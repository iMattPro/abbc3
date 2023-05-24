<?php
/**
*
* Advanced BBCode Box [Estonian]
* Translated by phpBBeesti.com (http://www.phpbbeesti.com) 05/2015
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
	'ABBC3_HIDDEN_ON'			=> 'Peidetud sisu',
	'ABBC3_HIDDEN_OFF'			=> 'Peidetud sisu (ainult liikmetele)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'See foorum nõuab, et oleksid registreeritud ja sisselogitud vaatamaks peidetud sisu.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Näita Spoilerit',
	'ABBC3_SPOILER_HIDE'		=> '▼ Peida Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Teemaväline',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Fondid',
	'ABBC3_FONT_SAFE'			=> 'Safe fondid',
	'ABBC3_GOOGLE_FONTS'		=> 'Google fondid',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Joondatud tekst: [align=center|left|right|justify]tekst[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Sisesta ükskõik millise video saidi URL: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Hägusta tekst: [blur=color]tekst[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Teksti suund: [dir=ltr|rtl]tekst[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Varjesta tekst: [dropshadow=color]tekst[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Tekst kahaneb sisse / välja: [fade]tekst[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Teksti sisse: [float=left|right]tekst[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Fondi tüüp: [font=Comic Sans MS]tekst[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Kumav tekst: [glow=color]tekst[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Peida külaliste eest: [hidden]tekst[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Esile tõstetud tekst: [highlight=yellow]tekst[/highlight]  Nõuanne: võid ka kasutada värvi, color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Liikuv tekst: [marq=up|down|left|right]tekst[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Häirega tekst: [mod=username]tekst[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO <i>ascii art</i> tekst: [nfo]tekst[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Teemaväline sõnum: [offtopic]tekst[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Eelvormindatud tekst: [pre]tekst[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Varjestusega tekst: [shadow=color]tekst[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]https://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoileriga sõnum: [spoil]tekst[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Joonega läbitõmmatud: [s]tekst[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Alaindeksiga tekst: [sub]tekst[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Ülaindeksiga tekst: [sup]tekst[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Embed MP4/OGG/WEBM video files: URL must start with <samp class="error">https</samp> or <samp class="error">http</samp> and end with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> (no BBCode needed). Note that browser support and GUI implementation varies.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopeeri valitud tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Kleebi kopeeritud tekst',
	'ABBC3_PASTE_ERROR'			=> 'Sa pead esmalt kopeerima valitud teksti ja siis alles kleepima',
	'ABBC3_PLAIN_BBCODE'		=> 'Eemalda kõik BBkoodi märgendid valitud tekstist',
	'ABBC3_NOSELECT_ERROR'		=> 'Teksti ei valitud.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Sisesta otse sõnumisse',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Näide',
	'ABBC3_BBVIDEO_SITES'		=> 'Lubatud veebilehed',
	'ABBC3_URL_LINK'			=> 'Sisesta veebilehe URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Valikuline kirjeldus',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

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
	'ABBC3_BBCODE_ORDERED'		=> 'BBkoodi järjestus on uuendatud.',
	'ABBC3_BBCODE_GROUP'		=> 'Halda gruppe, kes saavad kasutada seda BBkoodi',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Kui ühtegi gruppi ei ole valitud, siis kõik kasutajad saavad kasutada seda BBkoodi. Kasuta CTRL+CLICK (või CMD+CLICK Mac\'is), et valida / või valikud eemaldada rohkem kui ühelt grupilt.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBkoodi',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Kiire pruun rebane hüppab üle laisk koer',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Näide:</strong><br>%2$s<br><br><strong>Tulemus:</strong><br>%3$s<hr />',
));
