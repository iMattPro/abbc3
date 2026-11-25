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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'כאן תוכל להגדיר הגדרות עבור תיבת BBCode מתקדמת.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'הוסף <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">גוגל גופנים</a></strong> ל<samp class="error">[font]</samp> BBCode. השתמש באיות מדויק וברגישות רישיות. הצב כל שם גופן בשורה נפרדת.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '"אפשר שימוש ברשתות אספקת תוכן של צד שלישי" חייב להיות מופעל תחת "טעינת הגדרות" כדי להשתמש בתכונה זו.',
	'ABBC3_FONT_SEARCH'	=> 'חיפוש ב־Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'שמות הגופנים נטענים…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'לא נמצאו גופנים תואמים.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'קטלוג הגופנים אינו זמין. אפשר להזין את שמות הגופנים ידנית.',
	'ABBC3_SAVE_FONTS'	=> 'שמירת גופנים',
	'ABBC3_FONTS_CHECKING'	=> 'בודק ושומר גופנים…',
	'ABBC3_FONTS_SAVED'	=> 'הגופנים נשמרו.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'עורך סרגל הכלים',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'גרור כפתורים בין הקבוצות ראשיים, עוד ומוסתרים. בחר כפתור כדי להתאים אותו. סמל Font Awesome מחליף את התמונה. כדי להציג את שם ה־BBCode, אל תבחר תמונה.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'ראשיים',
	'ABBC3_TOOLBAR_MORE'	=> 'עוד',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'מוסתרים',
	'ABBC3_FONT_ICON'	=> 'סמל Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'סמל תמונה',
	'ABBC3_ICON_NONE'	=> 'ללא (הצגת טקסט)',
	'ABBC3_PLACEMENT'	=> 'מיקום',
	'ABBC3_TOOLBAR_DISABLED'	=> 'סרגל סמלי BBCode מושבת. עדיין אפשר לערוך את הסידור שלו, והוא יחול כשתפעיל אותו מחדש.',
	'ABBC3_LIVE_PREVIEW'	=> 'תצוגה מקדימה בזמן אמת',
	'ABBC3_AUTOSAVE_SAVING'	=> 'שומר…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'נשמר',
	'ABBC3_AUTOSAVE_ERROR'	=> 'לא ניתן לשמור את השינויים.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'נסה שוב',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'נדרש JavaScript כדי לשנות את הגדרות Advanced [BBCode] Box.',
	'ABBC3_DRAG_BUTTON'	=> 'גרירת %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo ו־Media Embed',
	'ABBC3_INVALID_FONT'		=> 'שם גופן לא חוקי עבור "%s"',
	'ABBC3_FONT_CHECK_FAILED'	=> 'לא ניתן היה לאמת את גופן Google "%s". בדוק את חיבור השרת ונסה שוב.',
	'ABBC3_PIPES'				=> 'הפעל Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'ה-Pipe Table Plug-In מאפשר למשתמשים ליצור טבלאות בפוסטים ובהודעות הפרטיות שלהם באמצעות תחביר סימון.',
	'ABBC3_BBCODE_BAR'			=> 'הפעל את שורת הסמלים של BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'אפשרות זו מציגה סרגל כלים של BBCode עם סמלים. כבה אותה כדי להציג את כפתורי ברירת המחדל של BBCode ב־phpBB.',
	'ABBC3_QR_BBCODES'			=> 'אפשר BBCodes בתשובה מהירה',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'זה יוסיף לחצני BBCode לתשובה מהירה.',
	'ABBC3_ICONS_TYPE'			=> 'פורמט תמונה של סרגל אייקונים',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'בחר את פורמט התמונה של סמלי ה־BBCode. אפשר להעלות סמלי SVG או PNG נוספים לתיקייה <samp class="error">/images/abbc3/icons/</samp> של הפורום שלך.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'בר אייקונים של BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'תוספות',
	'ABBC3_AUTO_VIDEO'			=> 'הפעל תוסף וידאו אוטומטי',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'תוסף זה ממיר כתובות URL של קבצי וידאו בטקסט רגיל לסרטונים שניתנים להפעלה. רק כתובות URL שמתחילות ב-<samp class="error">http://</samp> או <samp class="error">https://</samp> ומסתיימות ב-<samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> או <samp class="error">.webm</samp> מומרות.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'התקן את התוסף האופציונלי של phpBB Media Embed כדי לגשת להגדרות ואפשרויות ניהול עבור תוכן מדיה עשירה מוטבע.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed לא מותקן. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed מותקן. ההגדרות נגישות בכרטיסייה פרסום.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
