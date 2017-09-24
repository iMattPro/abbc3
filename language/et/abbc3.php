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
	'ABBC3_FONT_BBCODE'			=> 'Fondi menüü',
	'ABBC3_FONT_FANCY'			=> 'Fancy fondid',
	'ABBC3_FONT_SAFE'			=> 'Safe fondid',
	'ABBC3_FONT_WIN'			=> 'Windows fondid',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Joondatud tekst: [align=center|left|right|justify]tekst[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Sisesta ükskõik millise video saidi URL: [BBvideo=width,height]http://video_url[/BBvideo]',
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
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoileriga sõnum: [spoil]tekst[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Joonega läbitõmmatud: [s]tekst[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Alaindeksiga tekst: [sub]tekst[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Ülaindeksiga tekst: [sup]tekst[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopeeri valitud tekst',
	'ABBC3_PASTE_BBCODE'		=> 'Kleebi kopeeritud tekst',
	'ABBC3_PASTE_ERROR'			=> 'Sa pead esmalt kopeerima valitud teksti ja siis alles kleepima',
	'ABBC3_PLAIN_BBCODE'		=> 'Eemalda kõik BBkoodi märgendid valitud tekstist',
	'ABBC3_NOSELECT_ERROR'		=> 'Teksti ei valitud.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Sisesta otse sõnumisse',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Näide',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideo lubatud veebilehed',
	'ABBC3_BBVIDEO_LINK'		=> 'Video URL',
	'ABBC3_BBVIDEO_SIZE'		=> 'Video laius x kõrgus',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Suuruse eelseaded',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Sisesta veebilehe URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Valikuline kirjeldus',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBkoodi järjestus on uuendatud.',
	'ABBC3_BBCODE_GROUP'		=> 'Halda gruppe, kes saavad kasutada seda BBkoodi',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Kui ühtegi gruppi ei ole valitud, siis kõik kasutajad saavad kasutada seda BBkoodi. Kasuta CTRL+CLICK (või CMD+CLICK Mac\'is), et valida / või valikud eemaldada rohkem kui ühelt grupilt.',
));
