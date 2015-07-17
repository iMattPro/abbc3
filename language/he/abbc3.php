<?php
/**
*
* Advanced BBCode Box [Hebrew]
*
* @copyright (c) 2014 Matt Friedman
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
	'ABBC3_HIDDEN_ON'			=> 'תוכן חבוי',
	'ABBC3_HIDDEN_OFF'			=> 'תוכן חבוי(למשתמשים בלבד)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'אתר זה מחייב להיות להיות מחובר על מנת לצפות בתוכן חבוי.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► הצג ספוילר',
	'ABBC3_SPOILER_HIDE'		=> '▼ הסתר ספוילר',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'מחוץ לנושא',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'תפריט פונטים',
	'ABBC3_FONT_FANCY'			=> 'פונטים יוקרתיים',
	'ABBC3_FONT_SAFE'			=> 'פונטים בטוחים',
	'ABBC3_FONT_WIN'			=> 'פונטים של Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'ישר טקסט: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'הטמע כל קישור מאתר סרטונים כאן: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'טשטש טקסט: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'כיוון הטקסט: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'צל בטקסט: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Text fadein / fadeout: [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'טקסט צף: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'סוג פונט: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'טקסט זוהר: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'הסתר מאורחים: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'הדגש טקסט: [highlight=yellow]text[/highlight] טיפ: אתה יכול להתשמש גם ב color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'טקסט זז: [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'הודעת התראה: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art text: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'הודעה מחוץ לנושא: [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Preformatted text: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'צל לטקסט: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'הודעת ספוילר: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'טקסט קו-דרכו: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Subscript text: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Superscript text: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'סרטון YouTube: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'העתק טקסט מסומן',
	'ABBC3_PASTE_BBCODE'		=> 'הדבק טקסט מועתק',
	'ABBC3_PASTE_ERROR'			=> 'אתה חייב קודם להעתיק טקסט מסומן, ואז להדביק אותו',
	'ABBC3_PLAIN_BBCODE'		=> 'מחק את כל תגי ה BBCode מהטקסט המסומן',
	'ABBC3_NOSELECT_ERROR'		=> 'לא נבחר טקסט.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'הכנס לתוך ההודעה',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'דוגמא',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'אתרים מורשים ב BBVideo',
	'ABBC3_BBVIDEO_LINK'		=> 'קישור סרטון',
	'ABBC3_BBVIDEO_SIZE'		=> 'גובה X רוחב של סרטון',
	'ABBC3_BBVIDEO_PRESETS'		=> 'גודל Presets',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'X',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'הזן כתובת אתר',
	'ABBC3_URL_DESCRIPTION'		=> 'תיאור אופציונאלי',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'סדר ה BBCodes עודכן.',
	'ABBC3_BBCODE_GROUP'		=> 'נהל קבוצות שיכולות להתשמש ב BBCode זה',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'אם לא נבחרו שום קבוצות, כל המשתמשים יכולים להשתמש ב BBCode זה. השתמש במקש ה CTRL כדי לסמן יותר מקבוצה אחת.',
));
