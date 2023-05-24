<?php
/**
*
* Advanced BBCode Box [Finnish]
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
	'ABBC3_HIDDEN_ON'			=> 'Piilotettu sisältö',
	'ABBC3_HIDDEN_OFF'			=> 'Piilotettu sisältö (vain jäsenille)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Sinun tulee olla rekisteröitynyt ja kirjautunut sisään nähdäksesi tämän sisällön.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Näytä spoileri',
	'ABBC3_SPOILER_HIDE'		=> '▼ Piilota spoileri',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Ohi aiheesta',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Fontit',
	'ABBC3_FONT_SAFE'			=> 'Turvalliset fontit',
	'ABBC3_GOOGLE_FONTS'		=> 'Google fontit',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Tasaa teksti: [align=center|left|right|justify]teksti[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Upotetun videon URL: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Sumenna teksti: [blur=color]teksti[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Tekstin suunta: [dir=ltr|rtl]teksti[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Varjotettu teksti: [dropshadow=color]teksti[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Tekstin häivytys: [fade]teksti[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Leijuva teksti: [float=left|right]teksti[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Fontin tyyppi: [font=Comic Sans MS]teksti[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Hehkuva teksti: [glow=color]teksti[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Piilota vierailijoilta: [hidden]teksti[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Tekstin korostus: [highlight=yellow]teksti[/highlight]  Vinkki: voit myös käyttää: color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Marquee-teksti: [marq=up|down|left|right]teksti[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Hälytys: [mod=username]teksti[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'ASCII-taideteksti: [nfo]teksti[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Aiheesta poikkeava viesti: [offtopic]teksti[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Esityylitetty teksti: [pre]teksti[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Varjotettu teksti: [shadow=color]teksti[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]https://soundcloud.com/tunnus/kappaleen-nimi[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoilausviesti: [spoil]teksti[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Tekstin yliviivaus: [s]teksti[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Alaindeksi: [sub]teksti[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Yläindeksi: [sup]teksti[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube-video: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Embed MP4/OGG/WEBM video files: URL must start with <samp class="error">https</samp> or <samp class="error">http</samp> and end with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> (no BBCode needed). Note that browser support and GUI implementation varies.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopioi valittu teksti',
	'ABBC3_PASTE_BBCODE'		=> 'Liitä valittu teksti',
	'ABBC3_PASTE_ERROR'			=> 'Sinun pitää ensin kopioida tekstiä ennen sen liittämistä',
	'ABBC3_PLAIN_BBCODE'		=> 'Poista kaikki BBCodet valitusta tekstistä',
	'ABBC3_NOSELECT_ERROR'		=> 'Tekstiä ei ollut valittuna.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Lisää viestiin',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Esimerkki',
	'ABBC3_BBVIDEO_SITES'		=> 'Videon sallitut sivut',
	'ABBC3_URL_LINK'			=> 'Syötä sivun URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Linkin kuvaus, vaihtoehtoinen',
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
	'ABBC3_BBCODE_ORDERED'		=> 'BBCoden järjestys on päivitetty.',
	'ABBC3_BBCODE_GROUP'		=> 'Hallitse ryhmiä jotka voivat käyttää tätä BBCodea',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Jos ryhmiä ei valittu, kaikki voivat käyttää tätä BBCodea. Voit valita useamman ryhmän kerralla painamalla CTRL (tai CMD Macilla).',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Example:</strong><br>%2$s<br><br><strong>Result:</strong><br>%3$s<hr />',
));
