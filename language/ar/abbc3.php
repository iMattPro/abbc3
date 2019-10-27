<?php
/**
*
* Advanced BBCode Box [Arabic]
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
* Translated By : Bassel Taha Alhitary - www.alhitary.net
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
	'ABBC3_HIDDEN_ON'			=> 'محتوى مخفي',
	'ABBC3_HIDDEN_OFF'			=> 'محتوى مخفي ( للأعضاء فقط )',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'يجب أن تكون عضو في هذا المنتدى أو تسجل دخولك لمُشاهدة هذا المحتوى المخفي.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► إظهار المحتوى',
	'ABBC3_SPOILER_HIDE'		=> '▼ إخفاء المحتوى',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'خارج عن الموضوع',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'قائمة الخطوط',
	'ABBC3_FONT_FANCY'			=> 'خطوط مُزخرفة',
	'ABBC3_FONT_SAFE'			=> 'خطوط آمنة',
	'ABBC3_FONT_WIN'			=> 'خطوط الويندوز',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'محاذاة النص: [align=center|left|right|justify]النص[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'إضافة أي رابط فيديو: [bbvideo]رابط الفيديو[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'نص غير واضح: [blur=color]النص[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'اتجاة النص: [dir=ltr|rtl]النص[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'نص مع ظل خفيف: [dropshadow=color]النص[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'نص يتلاشي / يظهر بالتدريج: [fade]النص[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'مكان النص: [float=left|right]النص[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'نوع الخط: [font=Comic Sans MS]النص[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'نص متوهج: [glow=color]النص[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'إخفاء من الزائرين: [hidden]النص[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'نص بخلفية ملونة: [highlight=yellow]النص[/highlight]  تلميح: تستطيع استخدام صيغة الألوان #FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'نص متحرك: [marq=up|down|left|right]النص[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'رسالة تنبيه: [mod=username]النص[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'نص بخلفية بيضاء: [nfo]النص[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'رسالة خارج عن الموضوع: [offtopic]النص[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'نص مُنسق: [pre]النص[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'نص مع ظل: [shadow=color]النص[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'موسيقى موقع SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'رسالة مُنسدلة: [spoil]النص[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'نص مع خط بالوسط: [s]النص[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'نص منخفض: [sub]النص[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'نص مرتفع: [sup]النص[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'فيديو يوتيوب: [youtube]رابط الفيديو[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'نسخ النص المُحدد',
	'ABBC3_PASTE_BBCODE'		=> 'لصق النص المنسوخ',
	'ABBC3_PASTE_ERROR'			=> 'يجب عليك أولاً نسخ نص مُحدد , ثم الصقه',
	'ABBC3_PLAIN_BBCODE'		=> 'حذف جميع الوسوم لـ BBCode من النص المُحدد',
	'ABBC3_NOSELECT_ERROR'		=> 'لم يتم تحديد النص.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'إدخال إلى الرسالة',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'مثال',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'مواقع الفيديوهات المُتاحة',
	'ABBC3_BBVIDEO_LINK'		=> 'رابط الفيديو',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'إدخال رابط الموقع',
	'ABBC3_URL_DESCRIPTION'		=> 'وصف إختياري',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.alhitary.net',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'إنشاء الجداول',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'إنشاء الجداول باستخدام أي شكل من أشكال ASCII التالية.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'دليل العضو',
	'ABBC3_PIPE_SIMPLE'			=> 'جدول مبسط',
	'ABBC3_PIPE_COMPACT'		=> 'جدول مركب',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'الخطوط العمودية السطحية | والمسافات حول الخطوط العمودية الداخلية | تعتبر اختيارية ويمكن الاستغناء عنها.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'إتجاة النص',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| ترويسة 1 | ترويسة 2 |\n|----------|----------|\n| خلية 1   | خلية 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "ترويسة 1|ترويسة 2\n-|-\nخلية 1|خلية 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| يسار | وسط | يمين |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'تم تحديث ترتيب الـBBCode.',
	'ABBC3_BBCODE_GROUP'		=> 'إدارة المجموعات التي تستطيع استخدام هذا الـBBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'إذا لم يتم تحديد أي مجموعة, فسوف يستطيع جميع الأعضاء استخدام هذا الـBBCode. تستطيع تحديد أكثر من مجموعة أو إزالة التحديد بالنقر مطولاً على زر الكنترول والنقر بالماوس على إسم المجموعة (أو CMD+CLICK في نظام الماك).',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'محرر الكتابة المتقدم',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'شبكة الهتاري لدعم منتديات phpBB وترجمة الإضافات',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>مثال:</strong><br />%2$s<br /><br /><strong>النتيجة:</strong><br />%3$s<hr />',
));
