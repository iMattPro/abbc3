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
	'ABBC3_FONT_BBCODE'			=> 'Fonttivalikko',
	'ABBC3_FONT_FANCY'			=> 'Erikoiset fontit',
	'ABBC3_FONT_SAFE'			=> 'Turvalliset fontit',
	'ABBC3_FONT_WIN'			=> 'Windowsin fontit',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Tasaa teksti: [align=center|left|right|justify]teksti[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Upotetun videon URL: [BBvideo=width,height]http://video_url[/BBvideo]',
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
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/tunnus/kappaleen-nimi[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoilausviesti: [spoil]teksti[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Tekstin yliviivaus: [s]teksti[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Alaindeksi: [sub]teksti[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Yläindeksi: [sup]teksti[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube-video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopioi valittu teksti',
	'ABBC3_PASTE_BBCODE'		=> 'Liitä valittu teksti',
	'ABBC3_PASTE_ERROR'			=> 'Sinun pitää ensin kopioida tekstiä ennen sen liittämistä',
	'ABBC3_PLAIN_BBCODE'		=> 'Poista kaikki BBCodet valitusta tekstistä',
	'ABBC3_NOSELECT_ERROR'		=> 'Tekstiä ei ollut valittuna.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Lisää viestiin',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Esimerkki',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideon sallitut sivut',
	'ABBC3_BBVIDEO_LINK'		=> 'Videon URL',
	'ABBC3_BBVIDEO_SIZE'		=> 'Videon Leveys x Korkeus',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Valmiskoot',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Syötä sivun URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Linkin kuvaus, vaihtoehtoinen',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCoden järjestys on päivitetty.',
	'ABBC3_BBCODE_GROUP'		=> 'Hallitse ryhmiä jotka voivat käyttää tätä BBCodea',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Jos ryhmiä ei valittu, kaikki voivat käyttää tätä BBCodea. Voit valita useamman ryhmän kerralla painamalla CTRL (tai CMD Macilla).',
));
