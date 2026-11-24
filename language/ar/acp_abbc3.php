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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'هنا يمكنك تكوين الإعدادات لـ Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'أضف <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">خطوط Google</a></strong> إلى <samp class="error">[font]</samp> BBCode. استخدم التدقيق الإملائي وحساسية حالة الأحرف. ضع اسم كل خط على سطر منفصل.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'يجب تمكين "السماح باستخدام شبكات توصيل محتوى الطرف الثالث" ضمن "إعدادات التحميل" لاستخدام هذه الميزة.',
	'ABBC3_FONT_SEARCH'	=> 'البحث في خطوط Google',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'جارٍ تحميل أسماء الخطوط…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'لا توجد خطوط مطابقة.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'كتالوج الخطوط غير متاح. أدخل الأسماء يدويًا.',
	'ABBC3_INVALID_FONT'		=> 'اسم الخط غير صالح لـ "%s"',
	'ABBC3_FONT_CHECK_FAILED'	=> 'تعذر التحقق من خط Google "%s". تحقق من اتصال الخادم وحاول مرة أخرى.',
	'ABBC3_PIPES'				=> 'تمكين البرنامج المساعد لجدول الأنابيب',
	'ABBC3_PIPES_EXPLAIN'		=> 'يسمح Pipe Table PlugIn للمستخدمين بإنشاء جداول في منشوراتهم ورسائلهم الخاصة باستخدام صيغة تخفيض السعر.',
	'ABBC3_BBCODE_BAR'			=> 'تمكين شريط أيقونة BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'يعرض هذا الخيار شريط أدوات BBCode يعتمد على الأيقونات. عطّله لعرض أزرار BBCode الافتراضية في phpBB.',
	'ABBC3_QR_BBCODES'			=> 'تمكين BBCodes في الرد السريع',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'سيؤدي هذا إلى إضافة أزرار BBCode إلى الرد السريع.',
	'ABBC3_ICONS_TYPE'			=> 'تنسيق صورة شريط الأيقونة',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'اختر تنسيق الصور لأيقونات BBCode. يمكنك رفع أيقونات SVG أو PNG إضافية إلى مجلد <samp class="error">/images/abbc3/icons/</samp> في منتداك.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'شريط أيقونة بي بي كود',
	'ABBC3_LEGEND_ADD_ONS'		=> 'إضافات',
	'ABBC3_AUTO_VIDEO'			=> 'تمكين البرنامج الإضافي للفيديو التلقائي',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'يقوم هذا البرنامج المساعد بتحويل عناوين URL لملفات الفيديو ذات النص العادي إلى مقاطع فيديو قابلة للتشغيل. يتم فقط تحويل عناوين URL التي تبدأ بـ <samp class="error">http://</samp> أو <samp class="error">https://</samp> وتنتهي بـ <samp class="error">.mp4</samp>، أو <samp class="error">.ogg</samp> أو <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'قم بتثبيت ملحق phpBB Media Embed الاختياري للوصول إلى الإعدادات وخيارات الإدارة لمحتوى الوسائط الغنية المضمن.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'لم يتم تثبيت ملحق phpBB Media Embed. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'تم تثبيت ملحق phpBB Media Embed. يمكن الوصول إلى الإعدادات ضمن علامة التبويب النشر.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
