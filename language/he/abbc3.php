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
	'ABBC3_BBVIDEO_HELPLINE'	=> 'הטמע כל קישור מאתר סרטונים כאן: [bbvideo]http://video_url[/bbvideo]',
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
	'ABBC3_BBVIDEO_SITES'		=> 'אתרים מורשים ב',
	'ABBC3_BBVIDEO_LINK'		=> 'קישור סרטון',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'הזן כתובת אתר',
	'ABBC3_URL_DESCRIPTION'		=> 'תיאור אופציונאלי',
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
	'ABBC3_BBCODE_ORDERED'		=> 'סדר ה BBCodes עודכן.',
	'ABBC3_BBCODE_GROUP'		=> 'נהל קבוצות שיכולות להתשמש ב BBCode זה',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'אם לא נבחרו שום קבוצות, כל המשתמשים יכולים להשתמש ב BBCode זה. השתמש במקש ה CTRL כדי לסמן יותר מקבוצה אחת.',
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
