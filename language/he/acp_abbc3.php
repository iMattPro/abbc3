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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'כאן תוכל להגדיר הגדרות עבור תיבת BBCode מתקדמת. למידע על התאמה אישית של סרגל הסמלים, בקר ב-%s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'הוסף <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">גוגל גופנים</a></strong> ל<samp class="error">[font]</samp> BBCode. השתמש באיות מדויק וברגישות רישיות. הצב כל שם גופן בשורה נפרדת.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '"אפשר שימוש ברשתות אספקת תוכן של צד שלישי" חייב להיות מופעל תחת "טעינת הגדרות" כדי להשתמש בתכונה זו.',
	'ABBC3_INVALID_FONT'		=> 'שם גופן לא חוקי עבור "%s"',
	'ABBC3_FONT_CHECK_FAILED'	=> 'לא ניתן היה לאמת את גופן Google "%s". בדוק את חיבור השרת ונסה שוב.',
	'ABBC3_PIPES'				=> 'הפעל Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'ה-Pipe Table Plug-In מאפשר למשתמשים ליצור טבלאות בפוסטים ובהודעות הפרטיות שלהם באמצעות תחביר סימון.',
	'ABBC3_BBCODE_BAR'			=> 'הפעל את שורת הסמלים של BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'זה יציג את סרגל הכלים BBCode מבוסס הסמלים של ABBC3. השבת את זה כדי להציג את לחצני BBCode ברירת המחדל של phpBB.',
	'ABBC3_QR_BBCODES'			=> 'אפשר BBCodes בתשובה מהירה',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'זה יוסיף לחצני BBCode לתשובה מהירה.',
	'ABBC3_ICONS_TYPE'			=> 'פורמט תמונה של סרגל אייקונים',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'בחר את פורמט התמונה לשימוש עבור הסמלים של ABBC3. שים לב שאתה יכול לבחור רק פורמט אחד עבור כל הסמלים שלך.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'בר אייקונים של BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'תוספות',
	'ABBC3_AUTO_VIDEO'			=> 'הפעל תוסף וידאו אוטומטי',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'תוסף זה ממיר כתובות URL של קבצי וידאו בטקסט רגיל לסרטונים שניתנים להפעלה. רק כתובות URL שמתחילות ב-<samp class="error">http://</samp> או <samp class="error">https://</samp> ומסתיימות ב-<samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> או <samp class="error">.webm</samp> מומרות.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'התקן את התוסף האופציונלי של phpBB Media Embed כדי לגשת להגדרות ואפשרויות ניהול עבור תוכן מדיה עשירה מוטבע.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed לא מותקן. %2$s.',
		1	=> 'phpBB Media Embed מותקן. ההגדרות נגישות בכרטיסייה פרסום.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
