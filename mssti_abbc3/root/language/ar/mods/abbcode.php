<?php
/**
*
* abbcode [Arabic]
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @translator: hubaishan http://msofficeword.net-http://phpbbarabia.com
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. "Message %d" is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., "Click %sHERE%s" is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
// Help page
	'ABBC3_HELP_TITLE'			=> 'صندوق الـ BBcodes المتقدم 3 :: صفحة المساعدة',
	'ABBC3_HELP_DESC'			=> 'الوصف',
	'ABBC3_HELP_WRITE'			=> 'BBcode صيغة الاستعمال',
	'ABBC3_HELP_VIEW'			=> 'النتيجة',
	'ABBC3_HELP_ABOUT'			=> 'Advanced BBCode Box 3 by <a href="http://www.phpbb.com/customise/db/mod/advanced_bbcode_box_3/" onclick="window.open(this.href);return false;">mssti</a>',
//	'ABBC3_HELP_ALT'			=> 'صندوق BBCode المتقدم 3 (aka ABBC3)',

// Image Resizer JS
	'ABBC3_RESIZE_SMALL'		=> 'اضغط على هذا الشريط لعرض الصورة بحجمها الطبيعي',
	'ABBC3_RESIZE_ZOOM_IN'		=> 'تكبير (الأبعاد الحقيقية هي %1$s x %2$s)',
	'ABBC3_RESIZE_CLOSE'		=> 'إغلاق',
	'ABBC3_RESIZE_ZOOM_OUT'		=> 'تصغير',
	'ABBC3_RESIZE_FILESIZE'		=> 'هذه الصورة محجمة. الأبعاد الحقيقة للصورة هو %1$s x %2$s والحجم الحقيقي هو %3$sKB.',
	'ABBC3_RESIZE_NOFILESIZE'	=> 'هذه الصورة محجمة. الأبعاد الحقيقية للصورة هو %1$s x %2$s.',
	'ABBC3_RESIZE_FULLSIZE'		=> 'تم تحجيم الصورة إلى : %1$s % من الحجم الطبيعي لها [ %2$s x %3$s ]',
	'ABBC3_RESIZE_NUMBER'		=> 'الصورة %1$s من %2$s',
	'ABBC3_RESIZE_PLAY'			=> 'تشغيل عرض الصور (الشرائح)',
	'ABBC3_RESIZE_PAUSE'		=> 'إيقاف مؤقت لعرض الصور',
	'ABBC3_RESIZE_IMAGE'		=> 'صورة',
	'ABBC3_RESIZE_OF'			=> 'من',

// Highslide JS - http://vikjavev.no/highslide/forum/viewtopic.php?t=2119
	'ABBC3_HIGHSLIDE_LOADINGTEXT'		=> 'يجري التحميل...',
	'ABBC3_HIGHSLIDE_LOADINGTITLE'		=> 'اضغط للإلغاء',
	'ABBC3_HIGHSLIDE_FOCUSTITLE'		=> 'اضغط للجلب إلى المقدمة',
	'ABBC3_HIGHSLIDE_FULLEXPANDTITLE'	=> 'التوسيع إلى الحجم الحقيقي',
	'ABBC3_HIGHSLIDE_FULLEXPANDTEXT'	=> 'الحجم الكامل',
	'ABBC3_HIGHSLIDE_CREDITSTEXT'		=> 'Powered by <i>Highslide JS</i>',
	'ABBC3_HIGHSLIDE_CREDITSTITLE'		=> 'إذهب إلى صفحة Highslide JS  الرئيسية',
	'ABBC3_HIGHSLIDE_PREVIOUSTEXT'		=> 'السابق',
	'ABBC3_HIGHSLIDE_PREVIOUSTITLE'		=> 'السابق (السهم الأيسر)',
	'ABBC3_HIGHSLIDE_NEXTTEXT'			=> 'التالي',
	'ABBC3_HIGHSLIDE_NEXTTITLE'			=> 'التالي (السهم الأيمن)',
	'ABBC3_HIGHSLIDE_MOVETITLE'			=> 'حرّك',
	'ABBC3_HIGHSLIDE_MOVETEXT'			=> 'حرّك',
	'ABBC3_HIGHSLIDE_CLOSETEXT'			=> 'إغلاق',
	'ABBC3_HIGHSLIDE_CLOSETITLE'		=> 'إغلاق(esc)',
	'ABBC3_HIGHSLIDE_RESIZETITLE'		=> 'تحجيم',
	'ABBC3_HIGHSLIDE_PLAYTEXT'			=> 'تشغيل',
	'ABBC3_HIGHSLIDE_PLAYTITLE'			=> 'تشغيل عرض الصور (الشرائح) (Spacebar)',
	'ABBC3_HIGHSLIDE_PAUSETEXT'			=> 'إيقاف مؤقت',
	'ABBC3_HIGHSLIDE_PAUSETITLE'		=> 'إيقاف عرض الشرائح (spacebar)',
	'ABBC3_HIGHSLIDE_NUMBER'			=> 'الصورة %1 من %2',
	'ABBC3_HIGHSLIDE_RESTORETITLE'		=> 'اضغط لإغلاق الصورة. اضغط ثم حرّك. بإمكانك استخدم أزرار الأسهم لمشاهدة السابق والتالي.',

// Text to be applied to the helpline & mouseover & help page & Wizard texts
	'BBCODE_STYLES_TIP'			=> 'تلميح: الأنماط تطبق بسرعة على النص المحدد.',

	'ABBC3_ERROR'				=> 'خطأ : ',
	'ABBC3_ERROR_TAG'			=> 'خطأ مُفاجئ باستخدام العلامة :',
	'ABBC3_NO_EXAMPLE'			=> 'لا يوجد مثال',

	'ABBC3_ID'					=> 'أدخل معرفًا',
	'ABBC3_NOID'				=> 'يجب أن تدخل المعرف',
	'ABBC3_LINK'				=> 'أدخل رابطًا لـ ',
	'ABBC3_DESC'				=> 'أدخل وصفًا لـ ',
	'ABBC3_NAME'				=> 'وصف',
	'ABBC3_NOLINK'				=> 'يجب عليك إدخال الرابط إلى ',
	'ABBC3_NODESC'				=> 'يجب عليك إدخال الوصف إلى ',
	'ABBC3_WIDTH'				=> 'أدخل العرض',
	'ABBC3_WIDTH_NOTE'			=> 'ملاحظة: يمكن التعبير عن القيمة كنسبة مؤية',
	'ABBC3_NOWIDTH'				=> 'يجب عليك إدخال العرض',
	'ABBC3_HEIGHT'				=> 'أدخل الارتفاع',
	'ABBC3_HEIGHT_NOTE'			=> 'ملاحظة: يمكن التعبير عن القيمة كنسبة مؤية',
	'ABBC3_NOHEIGHT'			=> 'يجب عليك إدخال الارتفاع',

	'ABBC3_NOTE'				=> 'ملاحظة',
	'ABBC3_EXAMPLE'				=> 'مثال',
	'ABBC3_EXAMPLES'			=> 'أمثلة',
	'ABBC3_SHORT'				=> 'اختر الـ BBcode',
	'ABBC3_DEPRECATED'			=> '<div class="error">لقد تم إزالة الكود <em>%1$s</em> اعتبارًا من إصدار ABBC3 رقم <em>%2$s</em></div>',
	'ABBC3_UNAUTHORISED'		=> 'لا يمكنك استعمال كلمات معيّنة : <br /><strong> %s </strong>',
	'ABBC3_NOSCRIPT'			=> 'يبدو أن متصفحك لا يدعم الـ <em> جافا سكريبت !/em> أو أن الميّزة مُعطّلة من المتصفح.',
	'ABBC3_NOSCRIPT_EXPLAIN'	=> 'الصفحة التي تعرضها تتطلب أداء عالي لتطبيق الجافا سكريبت. <br />يجب عليك تفعيلها لعرض الصفحة بشكل سليم.',
	'ABBC3_FUNCTION_DISABLED'	=> 'هذا الدوال غير متوفر في المنتدى',
	'ABBC3_AJAX_DISABLED'		=> 'يبدو أن متصفحك لا يدعم الـ AJAX (XMLHttpRequest) وهو غير قادر على المتابعة.',
	'ABBC3_SUBMIT'				=> 'إدراج رسالة',
	'ABBC3_SUBMIT_SIG'			=> 'إدراج توقيع',
	'SAMPLE_TEXT'				=> 'بسم الله الرحمن الرحيم',
	'DEPRECATED_BBCODE'			=> '<strong class="error">تنبيه:</strong> هذا الكود قديم استخدم بدلاً منه BBvideo.',
));

/**
* TRANSLATORS PLEASE NOTE 
*	Several lines have an special note like "##	For translator: " followed by "yes" and "no"
*	These are lines with mixed code and language. For these lines you can translate anything 
*	under a "yes" but do not change any text under a "no"
**/
$lang = array_merge($lang, array(
// bbcodes texts
	// Font Type Dropdown
	'ABBC3_FONT_MOVER'			=> 'نوع الخط',
	'ABBC3_FONT_TIP'			=> '[font=Comic Sans MS]النص[/font]',
	'ABBC3_FONT_NOTE'			=> 'Note: You can define additional font-families',
	'ABBC3_FONT_VIEW'			=> '[font=Comic Sans MS]' . $lang['SAMPLE_TEXT'] . '[/font]',

	// Font family Groups
	'ABBC3_FONT_ABBC3'			=> 'ABBC Box 3',
	'ABBC3_FONT_SAFE'			=> 'القائمة الآمنة',
	'ABBC3_FONT_WIN'			=> 'افتراضيات ويندوز',

	// Font Size Dropdown
	'ABBC3_FONT_GIANT'			=> 'ضخم',
	'ABBC3_SIZE_MOVER'			=> 'حجم الخط',
	'ABBC3_SIZE_TIP'			=> '[size=150]نص كبير[/size]',
	'ABBC3_SIZE_NOTE'			=> 'ملاحظة: يمكن أن تكون القيمة بالنسبة المؤية.',
	'ABBC3_SIZE_VIEW'			=> '[size=150]' . $lang['SAMPLE_TEXT'] . '[/size]',

	// Highlight Font Color Dropdown
	'ABBC3_HIGHLIGHT_MOVER'		=> 'تمييز النص',
	'ABBC3_HIGHLIGHT_TIP'		=> '[highlight=yellow]النص[/highlight]',
	'ABBC3_HIGHLIGHT_NOTE'		=> 'تلميح: بإمكانك أيضًا استخدام highlight=#FFFF00',
	'ABBC3_HIGHLIGHT_VIEW'		=> '[highlight=yellow]' . $lang['SAMPLE_TEXT'] . '[/highlight]',

	// Font Color Dropdown
	'ABBC3_COLOR_MOVER'			=> 'لون الخط',
	'ABBC3_COLOR_TIP'			=> '[color=red]النص[/color]',
	'ABBC3_COLOR_NOTE'			=> 'تلميح: بإمكانك أيضًا استخدام color=#FF0000',
	'ABBC3_COLOR_VIEW'			=> '[color=red]' . $lang['SAMPLE_TEXT'] . '[/color]',

	// Tigra Color & Highlight family Groups
	'ABBC3_COLOUR_SAFE'			=> 'لوح ألوان الويب الآمن',
	'ABBC3_COLOUR_WIN'			=> 'نظام لوح ألوان الويندوز',
	'ABBC3_COLOUR_GREY'			=> 'لوح الألوان الرمادي',
	'ABBC3_COLOUR_MAC'			=> 'نظام لوح ألوان ماك',
	'ABBC3_SAMPLE'				=> 'عيّنة',

	// Cut selected text
	'ABBC3_CUT_MOVER'			=> 'لإزالة النص المُحدد',
	// Copy selected text
	'ABBC3_COPY_MOVER'			=> 'لنسخ النص المُحدد',
	// Paste previously copy text
	'ABBC3_PASTE_MOVER'			=> 'للصق النص المُحدد',
	'ABBC3_PASTE_ERROR'			=> 'يجب عليك أولاً نسخ نص مُحدد ثم لصقه.',
	// Remove BBCode (Removes all BBCode tags from selected text)
	'ABBC3_PLAIN_MOVER'			=> 'إزالة جميع أكواد BBcodes من النص',
	'ABBC3_NOSELECT_ERROR'		=> 'لا يوجد نص مُحدد',

	// Code
	'ABBC3_CODE_MOVER'			=> 'عرض الكود',
	'ABBC3_CODE_TIP'			=> '[code]الكود[/code]',
	'ABBC3_CODE_VIEW'			=> '[code]' . $lang['SAMPLE_TEXT'] . '[/code] أو [code=php]' . $lang['SAMPLE_TEXT'] . '[/code]',

	// Quote
	'ABBC3_QUOTE_MOVER'			=> 'نص مقتبس',
	'ABBC3_QUOTE_TIP'			=> '[quote]النص[/quote] أو [quote=“المستخدم”]النص[/quote]',
##	For translator:                                                            yes              yes
	'ABBC3_QUOTE_VIEW'			=> '[quote]' . $lang['SAMPLE_TEXT'] . '[/quote] أو [quote=&quot;المستخدم&quot;]' . $lang['SAMPLE_TEXT'] . '[/quote]',

	// Spoiler
	'ABBC3_SPOIL_MOVER'			=> 'إخفاء/إظهار النص',
	'ABBC3_SPOIL_TIP'			=> '[spoil]النص[/spoil]',
	'ABBC3_SPOIL_VIEW'			=> '[spoil]' . $lang['SAMPLE_TEXT'] . '[/spoil]',
	'SPOILER_SHOW'				=> 'إظهار النص',
	'SPOILER_HIDE'				=> 'إخفاء النص',

	// Hidden
	'ABBC3_HIDDEN_MOVER'		=> 'إخفاء المحتوى من الزوّار',
	'ABBC3_HIDDEN_TIP'			=> '[hidden]النص[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=> 'الإخفاء مُفعل (للأعضاء المسجلين فقط)',
	'HIDDEN_ON'					=> 'الإخفاء مُفعّل',
	'HIDDEN_EXPLAIN'			=> 'يجب عليك عليك التسجيل أو تسجيل الدخول إلى المنتدى لعرض المحتوى المخفي',

	// Moderator
	'ABBC3_MOD_MOVER'			=> 'رسالة المشرف',
	'ABBC3_MOD_TIP'				=> '[mod=name]النص[/mod]',
##	For translator:                      yes
	'ABBC3_MOD_VIEW'			=> '[mod=Moderator_name]' . $lang['SAMPLE_TEXT'] . '[/mod]',

	// Off Topic
	'OFFTOPIC'					=> 'خارج عن الموضوع',
	'ABBC3_OFFTOPIC_MOVER'		=> 'أدخل نص خارج عن الموضوع',
	'ABBC3_OFFTOPIC_TIP'		=> '[offtopic]نص[/offtopic]',
	'ABBC3_OFFTOPIC_VIEW'		=> '[offtopic]' . $lang['SAMPLE_TEXT'] . '[/offtopic]',

	// SCRIPPET
	'ABBC3_SCRIPPET_MOVER'		=> 'كلام متقابل',
	'ABBC3_SCRIPPET_TIP'		=> '[scrippet]نص نافذة العرض[/scrippet]',
##	For translator:                 don't change the "<br />" and don't join the lines into one!
	'ABBC3_SCRIPPET_VIEW'		=> '[scrippet]EXT. ANCIENT ROME - DAY<br />' . "\n" . 'ANTONIUS and IPSUM are walking down a tiny, crowded street.<br />' . "\n" . 'ANTONIUS<br />' . "\n" . 'Do you think in a thousand years, anyone will remember our names?<br />' . "\n" . 'IPSUM<br />' . "\n" . 'Not yours. But they’ll know mine. Because I intend to write something so profound that it will be remembered for the ages. Designers in the 20th Century call for Lorem Ipsum whenever they need to fill text blocks.[/scrippet]',

	// Tabs
	'ABBC3_TABS_MOVER'			=> 'تبويبات',
	'ABBC3_TABS_TIP'			=> '[tabs] [tabs:العنوان]هنا نص التبويب[tabs:آخر]هنا نص التبويب[/tabs]',
##	For translator:                              yes             yes                                                                                                                              yes               Yes
	'ABBC3_TABS_VIEW'			=> '[tabs] [tabs:عنوان التبويب]&nbsp;كل المحتوى تحت هذا التبويب سيتم عرضه بدخله، حتى يتم تعريف تبويب آخر بـ : &#91;tabs:XXX&#93;.[tabs:تبويب آخر]&nbsp;,وهلم جرًًّ...إلى نهاية الصفحة أو تستطيع اختياريا استعمال  &#91;/tabs&#93; لإنهاء التبويب وعرض النص العادي خارج التبويب.[/tabs]',

	// NFO
	'ABBC3_NFO_TITLE'			=> 'نص نفو',
	'ABBC3_NFO_MOVER'			=> 'نص نفو',
	'ABBC3_NFO_TIP'				=> '[nfo]نص نفو[/nfo]',
	'ABBC3_NFO_VIEW'			=> '[nfo]         /\_/\
    ____/ o o \
  /~____  =ø= /
 (______)__m_m)
[/nfo]',

	// Justify Align
	'ABBC3_ALIGNJUSTIFY_MOVER'	=> 'ضبط النص',
	'ABBC3_ALIGNJUSTIFY_TIP'	=> '[align=justify]النص[/align]',
	'ABBC3_ALIGNJUSTIFY_VIEW'	=> '[align=justify]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Right Align
	'ABBC3_ALIGNRIGHT_MOVER'	=> 'محاذاة فقرة إلى اليمين',
	'ABBC3_ALIGNRIGHT_TIP'		=> '[align=right]النص[/align]',
	'ABBC3_ALIGNRIGHT_VIEW'		=> '[align=right]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Center Align
	'ABBC3_ALIGNCENTER_MOVER'	=> 'محاذاة فقرة إلى الوسط',
	'ABBC3_ALIGNCENTER_TIP'		=> '[align=center]النص[/align]',
	'ABBC3_ALIGNCENTER_VIEW'	=> '[align=center]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Left Align
	'ABBC3_ALIGNLEFT_MOVER'		=> 'محاذاة فقرة إى اليسار',
	'ABBC3_ALIGNLEFT_TIP'		=> '[align=left]النص[/align]',
	'ABBC3_ALIGNLEFT_VIEW'		=> '[align=left]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Preformat
	'ABBC3_PRE_MOVER'			=> 'نص منسق مسبقًا',
	'ABBC3_PRE_TIP'				=> '[pre]النص[/pre]',
	'ABBC3_PRE_VIEW'			=> '[pre]' . $lang['SAMPLE_TEXT'] . '<br />		' . $lang['SAMPLE_TEXT'] . '[/pre]',

	// Tab
	'ABBC3_TAB_MOVER'			=> 'إضافة مسافة بادئة',
	'ABBC3_TAB_TIP'				=> '[tab=nn]',
	'ABBC3_TAB_NOTE'			=> 'أدخل مقدار الهامش المطلوب بالبكسل.',
	'ABBC3_TAB_VIEW'			=> '[tab=30]' . $lang['SAMPLE_TEXT'],

	// Superscript
	'ABBC3_SUP_MOVER'			=> 'نص مرتفع',
	'ABBC3_SUP_TIP'				=> '[sup]النص[/sup]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUP_VIEW'			=> 'هذا نص عادي [sup]' . $lang['SAMPLE_TEXT'] . '[/sup] هذا نص عادي',

	// Subscript
	'ABBC3_SUB_MOVER'			=> 'نص منخفض',
	'ABBC3_SUB_TIP'				=> '[sub]النص[/sub]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUB_VIEW'			=> 'هذا نص عادي [sub]' . $lang['SAMPLE_TEXT'] . '[/sub] هذا نص عادي',

	// Bold
	'ABBC3_B_MOVER'				=> 'غامق',
	'ABBC3_B_TIP'				=> '[b]النص[/b]',
	'ABBC3_B_VIEW'				=> '[b]' . $lang['SAMPLE_TEXT'] . '[/b]',

	// Italic
	'ABBC3_I_MOVER'				=> 'مائل',
	'ABBC3_I_TIP'				=> '[i]النص[/i]',
	'ABBC3_I_VIEW'				=> '[i]' . $lang['SAMPLE_TEXT'] . '[/i]',

	// Underline
	'ABBC3_U_MOVER'				=> 'مسطَّر',
	'ABBC3_U_TIP'				=> '[u]النص[/u]',
	'ABBC3_U_VIEW'				=> '[u]' . $lang['SAMPLE_TEXT'] . '[/u]',

	// Strikethrough
	'ABBC3_S_MOVER'				=> 'نص مشطوب',
	'ABBC3_S_TIP'				=> '[s]النص[/s]',
	'ABBC3_S_VIEW'				=> '[s]' . $lang['SAMPLE_TEXT'] . '[/s]',

	// Text Fade
	'ABBC3_FADE_MOVER'			=> 'نص متلاشٍ',
	'ABBC3_FADE_TIP'			=> '[fade]النص[/fade]',
	'ABBC3_FADE_VIEW'			=> '[fade]' . $lang['SAMPLE_TEXT'] . '[/fade]',

	// Text Gradient
	'ABBC3_GRAD_MOVER'			=> 'نص مُتدرج اللون',
	'ABBC3_GRAD_TIP'			=> 'حدد النص أولاً,',
	'ABBC3_GRAD_VIEW'			=> '[color=#FF0000]ه[/color][color=#F2000D]ذ[/color][color=#E6001A]ا[/color][color=#D90026] ا[/color] [color=#BF0040]ل[/color][color=#B3004D]ن[/color]ص[color=#990066] م[/color] [color=#800080]ث[/color][color=#73008C]ا[/color][color=#660099]ل[/color][color=#5900A6] ل[/color][color=#4D00B3]ل[/color][color=#4000BF]م[/color] [color=#2600D9]ع[/color][color=#1A00E6]ا[/color][color=#0D00F2]ي[/color][color=#0000FF]نة[/color]',
	'ABBC3_GRAD_MIN_ERROR'		=> 'لا يوجد نص مُختار',
	'ABBC3_GRAD_MAX_ERROR'		=> 'من غير المسموح لك اختيار النص بأكثر من 120 حرف.',
	'ABBC3_GRAD_COLORS'			=> 'Pre Selected Colors',
	'ABBC3_GRAD_ERROR'			=> 'خطأ: بنية الكود للون خاطئة!',

	// Glow text
	'ABBC3_GLOW_MOVER'			=> 'نص متوهج',
	'ABBC3_GLOW_TIP'			=> '[glow=color]النص[/glow]',
	'ABBC3_GLOW_VIEW'			=> '[glow=red]' . $lang['SAMPLE_TEXT'] . '[/glow]',

	// Shadow text
	'ABBC3_SHADOW_MOVER'		=> 'نص مظلل',
	'ABBC3_SHADOW_TIP'			=> '[shadow=color]النص[/shadow]',
	'ABBC3_SHADOW_VIEW'			=> '[shadow=blue]' . $lang['SAMPLE_TEXT'] . '[/shadow]',

	// Dropshadow text
	'ABBC3_DROPSHADOW_MOVER'	=> 'نص بظل ساقط',
	'ABBC3_DROPSHADOW_TIP'		=> '[dropshadow=color]النص[/dropshadow]',
	'ABBC3_DROPSHADOW_VIEW'		=> '[dropshadow=blue]' . $lang['SAMPLE_TEXT'] . '[/dropshadow]',

	// Blur text
	'ABBC3_BLUR_MOVER'			=> 'نص ضبابي',
	'ABBC3_BLUR_TIP'			=> '[blur=color]النص[/blur]',
	'ABBC3_BLUR_VIEW'			=> '[blur=blue]' . $lang['SAMPLE_TEXT'] . '[/blur]',

	// Wave text
	'ABBC3_WAVE_MOVER'			=> 'نص مموَّج ( فقط على Internet Explorer)',
	'ABBC3_WAVE_TIP'			=> '[wave=color]النص[/wave]',
	'ABBC3_WAVE_VIEW'			=> '[wave=blue]' . $lang['SAMPLE_TEXT'] . '[/wave]',

	// Unordered List
	'ABBC3_LISTB_MOVER'			=> 'قائمة',
	'ABBC3_LISTB_TIP'			=> '[list]النص[/list]',
	'ABBC3_LISTB_NOTE'			=> 'ملاحظة: استعمل [*] لإنشاء عنصر قائمة',
##	For translator:                          yes      yes      yes           yes         yes            yes                yes
	'ABBC3_LISTB_VIEW'			=> '[list][*]العنصر 1[*]العنصر 2[*]العنصر 3[/list] أو [list][*]العنصر 1[list][*]العنصر الفرعي 1[list][*]العنصر الفرع فرعي1[/list][/list][/list]',

	// Ordered List
	'ABBC3_LISTO_MOVER'			=> 'قائمة رقمية',
	'ABBC3_LISTO_TIP'			=> '[list=1|a|A|i|I]النص[/list]',
	'ABBC3_LISTO_NOTE'			=> 'ملاحظة: استعمل [*] لإنشاء عنصر قائمة',
##	For translator:                            yes      yes     yes          yes           yes      yes      yes           yes           yes      yes      yes           yes           yes      yes       yes             yes           yes      yes       yes
	'ABBC3_LISTO_VIEW'			=> '[list=1][*]العنصر1[*]العنصر2[*]العنصر3[/list] or [list=a][*]العنصر أ[*]العنصر ب[*]العنصر ج[/list] or [list=A][*]العنصر A[*]العنصر B[*]العنصر C[/list] أو [list=i][*]العنصر و[*]العنصر وو[*]العنصر ووو[/list] أو [list=I][*]العنصر س[*]العنصر س س[*]العنصر س س س[/list]',

	// List item
	'ABBC3_LISTITEM_MOVER'		=> 'عنصر قائمة',
	'ABBC3_LISTITEM_TIP'		=> '[*]النص',
	//'ABBC3_LISTITEM_NOTE'		=> 'ملاحظة: تقوم بإنشاء عناصر رقمية أو نقطية داخل قائمة',

	// Line Break
	'ABBC3_HR_MOVER'			=> 'خط أفقي',
	'ABBC3_HR_TIP'				=> '[hr]',
	'ABBC3_HR_NOTE'				=> 'ملاحظة : إنشاء خط أفقي لفصل النص',
	'ABBC3_HR_VIEW'				=> $lang['SAMPLE_TEXT'] . '[hr]' . $lang['SAMPLE_TEXT'],

	// Message Box text direction right to Left
	'ABBC3_DIRRTL_MOVER'		=> 'اتجاه النص من اليمين إلى اليسار',
	'ABBC3_DIRRTL_TIP'			=> '[dir=rtl]النص[/dir]',
	'ABBC3_DIRRTL_VIEW'			=> '[dir=rtl]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Message Box text direction Left to right
	'ABBC3_DIRLTR_MOVER'		=> 'اتجاه النص من اليسار إلى اليمين',
	'ABBC3_DIRLTR_TIP'			=> '[dir=ltr]النص[/dir]',
	'ABBC3_DIRLTR_VIEW'			=> '[dir=ltr]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Marquee Down
	'ABBC3_MARQDOWN_MOVER'		=> 'نص متحرك للأسفل',
	'ABBC3_MARQDOWN_TIP'		=> '[marq=down]النص[/marq]',
	'ABBC3_MARQDOWN_VIEW'		=> '[marq=down]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Up
	'ABBC3_MARQUP_MOVER'		=> 'نص متحرك للأعلى',
	'ABBC3_MARQUP_TIP'			=> '[marq=up]النص[/marq]',
	'ABBC3_MARQUP_VIEW'			=> '[marq=up]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Right
	'ABBC3_MARQRIGHT_MOVER'		=> 'نص محرك للجهة اليُمنى',
	'ABBC3_MARQRIGHT_TIP'		=> '[marq=right]النص[/marq]',
	'ABBC3_MARQRIGHT_VIEW'		=> '[marq=right]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Left
	'ABBC3_MARQLEFT_MOVER'		=> 'نص مُتحرك للجهة اليُسرى',
	'ABBC3_MARQLEFT_TIP'		=> '[marq=left]النص[/marq]',
	'ABBC3_MARQLEFT_VIEW'		=> '[marq=left]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Table row cell wizard
	'ABBC3_TABLE_MOVER'			=> 'إدارج جدول',
	'ABBC3_TABLE_TIP'			=> '[table=(CSS style)][tr=(CSS style)][td=(CSS style)]النص[/td][/tr][/table]',
	'ABBC3_TABLE_VIEW'			=> '[table=width:50%;border:1px solid #cccccc][tr=text-align:center][td=border:1px solid #cccccc]' . $lang['SAMPLE_TEXT'] . '[/td][/tr][/table]',

	'ABBC3_TABLE_STYLE'			=> 'اختر شكل تنسيق الجدول',
	'ABBC3_TABLE_EXAMPLE'		=> 'width:50%;border:1px solid #cccccc;',

	'ABBC3_ROW_NUMBER'			=> 'أدخل عدد أعمدة الجدول',
	'ABBC3_ROW_ERROR'			=> 'يجب عليك إدخال عدد الأعمدة للجدول',
	'ABBC3_ROW_STYLE'			=> 'أدخل شكل تنسيق أعمدة الجدول',
	'ABBC3_ROW_EXAMPLE'			=> 'text-align:center;',

	'ABBC3_CELL_NUMBER'			=> 'أدخل عدد صفوف الجدول',
	'ABBC3_CELL_ERROR'			=> 'يجب عليك إدخال عدد صفوف الجدول',
	'ABBC3_CELL_STYLE'			=> 'أدخل شكل تنسيق صفوف الجدول',
	'ABBC3_CELL_EXAMPLE'		=> 'border:1px solid #cccccc;',

	// Anchor
	'ABBC3_ANCHOR_MOVER'		=> 'علامة مرجعية',
	'ABBC3_ANCHOR_TIP'			=> '[anchor=(هذه العلامة المرجعية) goto=(العلامة المرجعية الهدف)]النص[/anchor]',
	'ABBC3_ANCHOR_EXAMPLE'		=> '[anchor=a1 goto=a2]اذهب إلى a2[/anchor]',
##	For translator:                                            yes                         Yes               Yes
	'ABBC3_ANCHOR_VIEW'			=> '[anchor=help_0 goto=help_1]Go to link 1[/anchor]<br /> or  [anchor=help_1]this is link 1[/anchor]',

	// Hyperlink Wizard
	'ABBC3_URL_TAG'				=> 'رابط تشعبي',
	'ABBC3_URL_MOVER'			=> 'أدرج الرابط',	
	'ABBC3_URL_TIP'				=> '[url]http://url[/url] أو [url=http://url]نص الرابط[/url]',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbbarabia.com',
	'ABBC3_URL_VIEW'			=> '[url=http://www.phpbbarabia.com]phpBB Arabia![/url]',

	// Email Wizard
	'ABBC3_EMAIL_TAG'			=> 'بريد إلكتروني',
	'ABBC3_EMAIL_MOVER'			=> 'إدراج بريد إلكتروني',
	'ABBC3_EMAIL_TIP'			=> '[email]user@server.ext[/email] or [email=user@server.ext]My email[/email]',
	'ABBC3_EMAIL_EXAMPLE'		=> 'user@server.ext',
	'ABBC3_EMAIL_VIEW'			=> '[email=user@server.ext]user@server.ext[/email]',

	// Ed2k link Wizard
	'ABBC3_ED2K_TAG'			=> 'ed2k',
	'ABBC3_ED2K_MOVER'			=> 'إدراج رابط eD2K',
	'ABBC3_ED2K_TIP'			=> '[url]رابط ed2k[/url] أو [url=رابط ed2k]اسم ed2k[/url]',
	'ABBC3_ED2K_EXAMPLE'		=> 'ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/',
	'ABBC3_ED2K_VIEW'			=> '[url=ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/]The_Two_Towers-The_Purist_Edit-Trailer.avi[/url]',
	'ABBC3_ED2K_ADD'			=> 'إضافة الروابط المختارة إلى طرفية ed2k',
	'ABBC3_ED2K_FRIEND'			=> 'صديق ed2k',
	'ABBC3_ED2K_SERVER'			=> 'خادم ed2k',
	'ABBC3_ED2K_SERVERLIST'		=> 'قائمة خوادم ed2k',

	// Web included by iframe
	'ABBC3_WEB_TAG'				=> 'صفحة ويب',
	'ABBC3_WEB_MOVER'			=> 'إدراج صفحة ويب في المشاركة',
	'ABBC3_WEB_TIP'				=> '[web width=99% height=400]http://url[/web]',
	'ABBC3_WEB_EXAMPLE'			=> 'http://www.phpbbarabia.com',
	'ABBC3_WEB_VIEW'			=> '[web width=99% height=400]http://www.phpbbarabia.com[/web]',
	'ABBC3_WEB_EXPLAIN'			=> '<strong class="error">ملاحظة:</strong> تمكين إدارج صفحات ويب خارجية في المشاركات يمكن أن يسبب خطر أمني، استخدمه تحت مسئوليتك الشخصية أو أسنده إلى مجموعة موثوقة.',

	// Image & Thumbnail Wizard
	'ABBC3_ALIGN_MODE'			=> 'اتجاه الصورة',
##	For translator:							 Don't				Yes
	'ABBC3_ALIGN_SELECTOR'		=> array(	'none'			=> 'الافتراضي',
											'left'			=> 'يسار',
											'center'		=> 'وسط',
											'right'			=> 'يمين',
											'float-left'	=> 'عائمة-لليسار',
											'float-right'	=> 'عائمة-لليمين'),

	// Image
	'ABBC3_IMG_TAG'				=> 'صورة',
	'ABBC3_IMG_MOVER'			=> 'إدراج صورة',
	'ABBC3_IMG_TIP'				=> '[img]http://رابط_الصورة[/img] أو [img=left|center|right|float-left|float-right]http://رابط_الصورة[/img]',
	'ABBC3_IMG_EXAMPLE'			=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_IMG_VIEW'			=> '[img]http://www.google.com/intl/en_com/images/logo_plain.png[/img]',

	// Thumbnail
	'ABBC3_THUMBNAIL_TAG'		=> 'صورة مُصغّرة',
	'ABBC3_THUMBNAIL_MOVER'		=> 'إدراج صورة مُصغّرة',
	'ABBC3_THUMBNAIL_TIP'		=> '[thumbnail]http://رابط_الصورة[/thumbnail] or [thumbnail=left|center|right|float-left|float-right]http://image_url[/thumbnail]',
	'ABBC3_THUMBNAIL_EXAMPLE'	=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_THUMBNAIL_VIEW'		=> '[thumbnail]http://www.google.com/intl/en_com/images/logo_plain.png[/thumbnail]',

	// Imgshack
	'ABBC3_IMGSHACK_MOVER'		=> 'إدراج صورة من imageshack',
	'ABBC3_IMGSHACK_TIP'		=> '[url=http://imageshack.us][img]http://رابط_الصورة[/img][/url]',
	'ABBC3_IMGSHACK_VIEW'		=> '[url=http://img22.imageshack.us/my.php?image=abbc3v1012newscreen.gif][img]http://img22.imageshack.us/img22/6241/abbc3v1012newscreen.th.gif[/img][/url]',

	// Rapid share checker
	'ABBC3_RAPIDSHARE_TAG'		=> 'rapidshare',
	'ABBC3_RAPIDSHARE_MOVER'	=> 'إدراج ملف من rapidshare',
	'ABBC3_RAPIDSHARE_TIP'		=> '[rapidshare]http://rapidshare.com/files/...[/rapidshare]',
	'ABBC3_RAPIDSHARE_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_RAPIDSHARE_VIEW'		=> '[rapidshare]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/rapidshare]',
	'ABBC3_RAPIDSHARE_GOOD'		=> 'الملف غير موجود في الخادم (السرفر)!!',
	'ABBC3_RAPIDSHARE_WRONG'	=> 'الملف غير موجود',

	// testlink
	'ABBC3_CURL_ERROR'			=> '<strong>خطأ : </strong> عُذراً ولكن يبدو أن الرابط غير مُحمّل. الرجاء تحميله لاستعمال هذا الدوال.',
	'ABBC3_LOGIN_EXPLAIN_VIEW'	=> 'يجب عليك التسجيل أو تسجيل الدخول لعرض الروابط.',
	'ABBC3_TESTLINK_TAG'		=> 'التحقق من الروابط',
	'ABBC3_TESTLINK_MOVER'		=> 'إدراج ملف مُخزّن إلى الخادم (السيرفر)',
	'ABBC3_TESTLINK_TIP'		=> '[testlink]http://rapidshare.com/files/...[/testlink]',
	'ABBC3_TESTLINK_NOTE'		=> 'الخوادم المتاحة: rapidshare, depositfiles, megashares',
	'ABBC3_TESTLINK_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_TESTLINK_VIEW'		=> '[testlink]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/testlink]',
	'ABBC3_TESTLINK_GOOD'		=> 'الملف غير موجود في الخادم (السيرفر)',
	'ABBC3_TESTLINK_WRONG'		=> 'الملف غير موجود !',

	// Click counter
	'ABBC3_CLICK_TAG'			=> 'نقر',
	'ABBC3_CLICK_MOVER'			=> 'إدراج رابط مع عداد النقرات',
	'ABBC3_CLICK_TIP'			=> '[click]http://url[/click] أو [click=http://url]اسم الصفحة[/click] أو [click][img]http://url[/img][/click]',
	'ABBC3_CLICK_EXAMPLE' 		=> 'http://www.google.com' . ' | ' . 'http://www.google.com/intl/en_com/images/logo_plain.png',
##	For translator:                                                               yes
	'ABBC3_CLICK_VIEW'			=> '[click=http://www.google.com] Google [/click] أو [click][img]http://www.google.com/intl/en_com/images/logo_plain.png[/img][/click]',
	'ABBC3_CLICK_TIME'			=> '( طُلبت %d مرة )',
	'ABBC3_CLICK_TIMES'			=> '( طُلبت %d مرة )',
	'ABBC3_CLICK_ERROR'			=> '<strong>خطأ:</strong> رجاءً أردج معرف صحيح للرابط',

	// Search tag
	'ABBC3_SEARCH_MOVER'		=> 'إدراج كلمة بحث',
	'ABBC3_SEARCH_TIP'			=> '[search]الكلمة[/search] أو [search=bing|yahoo|google|altavista|lycos|wikipedia]النص[/search]',
##	For translator:                                                              yes                                                 yes                                                   yes                                                    yes                                                       yes                                                   yes
	'ABBC3_SEARCH_VIEW'			=> '[search]Advanced BBCode Box 3[/search]<br /> أو [search=bing]Advanced BBCode Box 3[/search]<br /> أو [search=yahoo]Advanced BBCode Box 3[/search]<br /> أو [search=google]Advanced BBCode Box 3[/search]<br /> أو [search=altavista]Advanced BBCode Box 3[/search]<br /> أو [search=lycos]Advanced BBCode Box 3[/search]<br /> أو [search=wikipedia]Advanced BBCode Box 3[/search]',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_TAG'			=> 'BBvideo',
	'ABBC3_BBVIDEO_MOVER'		=> 'إدراج فيديو من الويب',
	'ABBC3_BBVIDEO_TIP'			=> '[BBvideo width,height]رابط الفيديو[/BBvideo]',
	'ABBC3_BBVIDEO_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_BBVIDEO_VIEW'		=> '[BBvideo 560,340]http://www.youtube.com/watch?v=sP4NMoJcFd4[/BBvideo]',
	'ABBC3_BBVIDEO_SELECT'		=> 'مواقع وملفات BBvideo',
	'ABBC3_BBVIDEO_SELECT_ERROR'=> 'ليس هناك روابط فيديو مدمج متاحة حاليًا. ، رجاء أعلم مدير منتدى %s عن هذا الخطأ.<br />في الوقت الحالي بإمكانك إرسال روابط الفيديو باستعمال URL BBcode .',
	'ABBC3_BBVIDEO_FILE'		=> 'امتداد الملف',
	'ABBC3_BBVIDEO_VIDEO'		=> 'المواقع المتاحة',
	'ABBC3_BBVIDEO_WATCH'		=> 'المشاهدة في',

	// Flash (swf) Wizard
	'ABBC3_FLASH_TAG'			=> 'فلاش',
	'ABBC3_FLASH_MOVER'			=> 'إدراج ملف فلاش (swf)',
	'ABBC3_FLASH_TIP'			=> '[flash width=# height=#]رابط الفلاش[/flash] or [flash width,height]URL flash[/flash]',
	'ABBC3_FLASH_EXAMPLE'		=> 'http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf',
	'ABBC3_FLASH_VIEW'			=> '[flash 250,200]http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf[/flash]',

	// Flash (flv) Wizard
	'ABBC3_FLV_TAG'				=> 'فلاش فيديو',
	'ABBC3_FLV_MOVER'			=> 'إداراج فيديو فلاشي (flv)',
	'ABBC3_FLV_TIP'				=> '[flv width=# height=#]رابط فيديو فلاش[/flv] أو [flv width,height]رابط فيديو فلاش[/flv]',
	'ABBC3_FLV_EXAMPLE'			=> 'http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv',
	'ABBC3_FLV_VIEW'			=> '[flv 250,200]http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv[/flv]',
	'ABBC3_FLV_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Streaming Video Wizard
	'ABBC3_VIDEO_TAG'			=> 'فيديو',
	'ABBC3_VIDEO_MOVER'			=> 'إدارج فيديو',
	'ABBC3_VIDEO_TIP'			=> '[video width=# height=#]URL video[/video]',
	'ABBC3_VIDEO_EXAMPLE'		=> 'http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv',
	'ABBC3_VIDEO_VIEW'			=> '[video 250,200]http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv[/video]',
	'ABBC3_VIDEO_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Streaming Audio Wizard
	'ABBC3_STREAM_TAG'			=> 'صوت',
	'ABBC3_STREAM_MOVER'		=> 'إدارج مقطع صوتي',
	'ABBC3_STREAM_TIP'			=> '[stream]URL stream[/stream]',
	'ABBC3_STREAM_EXAMPLE'		=> 'http://www.robtowns.com/music/first_noel.mp3',
	'ABBC3_STREAM_VIEW'			=> '[stream]http://www.robtowns.com/music/first_noel.mp3[/stream]',
	'ABBC3_STREAM_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Quicktime
	'ABBC3_QUICKTIME_TAG'		=> 'Quicktime',
	'ABBC3_QUICKTIME_MOVER'		=> 'إدارج فيديو من Quicktime',
	'ABBC3_QUICKTIME_TIP'		=> '[quicktime width=# height=#]URL Quicktime[/quicktime]',
	'ABBC3_QUICKTIME_EXAMPLE'	=> 'http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt',
	'ABBC3_QUICKTIME_VIEW'		=> '[quicktime width=250 height=200]http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt[/quicktime]',
	'ABBC3_QUICKTIME_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// Real Media Wizard
	'ABBC3_RAM_TAG'				=> 'Real Media',
	'ABBC3_RAM_MOVER'			=> 'إدراج فيديو من Real Media',
	'ABBC3_RAM_TIP'				=> '[ram]URL Real Media[/ram]',
	'ABBC3_RAM_EXAMPLE'			=> 'http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram',
	'ABBC3_RAM_VIEW'			=> '[ram width=250 height=200]http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram[/ram]',
	'ABBC3_RAM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Youtube video Wizard
	'ABBC3_YOUTUBE_TAG'			=> 'فيديو Youtube',
	'ABBC3_YOUTUBE_MOVER'		=> 'إداراج فيديو من Youtube',
	'ABBC3_YOUTUBE_TIP'			=> '[youtube]URL video[/youtube]',
	'ABBC3_YOUTUBE_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_YOUTUBE_VIEW'		=> '[youtube]http://www.youtube.com/watch?v=sP4NMoJcFd4[/youtube]',
	'ABBC3_YOUTUBE_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Veoh video
	'ABBC3_VEOH_TAG'			=> 'Veoh',
	'ABBC3_VEOH_MOVER'			=> 'إداراج فيديو من Veoh',
	'ABBC3_VEOH_TIP'			=> '[veoh]URL video[/veoh]',
	'ABBC3_VEOH_EXAMPLE'		=> 'http://www.veoh.com/watch/v27458670er62wkCt',
	'ABBC3_VEOH_VIEW'			=> '[veoh]http://www.veoh.com/watch/v27458670er62wkCt[/veoh]',
	'ABBC3_VEOH_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Collegehumor video
	'ABBC3_COLLEGEHOMOR_TAG'	=> 'collegehumor',
	'ABBC3_COLLEGEHUMOR_MOVER'	=> 'إدراج فيديو من collegehumor',
	'ABBC3_COLLEGEHUMOR_TIP'	=> '[collegehumor]collegehumor video URL[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXAMPLE'=> 'http://www.collegehumor.com/video:1802097',
	'ABBC3_COLLEGEHUMOR_VIEW'	=> '[collegehumor]http://www.collegehumor.com/video:1802097[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXPLAIN'=> $lang['DEPRECATED_BBCODE'],

	// Dailymotion video
	'ABBC3_DM_MOVER'			=> 'إدراج فيديو من dailymotion', // from http://www.dailymotion.com/
	'ABBC3_DM_TIP'				=> '[dm]Dailymotion ID[/dm]',
	'ABBC3_DM_EXAMPLE'			=> 'http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
	'ABBC3_DM_VIEW'				=> '[dm]http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport[/dm]',
	'ABBC3_DM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Gamespot video
	'ABBC3_GAMESPOT_MOVER'		=> 'إدارج فيديو من Gamespot',
	'ABBC3_GAMESPOT_TIP'		=> '[gamespot]Gamespot video URL[gamespot]',
	'ABBC3_GAMESPOT_EXAMPLE'	=> 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
	'ABBC3_GAMESPOT_VIEW'		=> '[gamespot]http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8[/gamespot]',
	'ABBC3_GAMESPOT_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// IGN video
	'ABBC3_IGNVIDEO_MOVER'		=> 'إدراج فيديو من IGN',
	'ABBC3_IGNVIDEO_TIP'		=> '[ignvideo]IGN video URL[/ignvideo]',
	'ABBC3_IGNVIDEO_EXAMPLE'	=> 'http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html',
	'ABBC3_IGNVIDEO_VIEW'		=> '[ignvideo]http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html[/ignvideo]',
	'ABBC3_IGNVIDEO_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// LiveLeak video
	'ABBC3_LIVELEAK_MOVER'		=> 'إدراج فيديو من Liveleak',
	'ABBC3_LIVELEAK_TIP'		=> '[liveleak]Liveleak video URL[/liveleak]',
	'ABBC3_LIVELEAK_EXAMPLE'	=> 'http://www.liveleak.com/view?i=166_1194290849',
	'ABBC3_LIVELEAK_VIEW'		=> '[liveleak]http://www.liveleak.com/view?i=166_1194290849[/liveleak]',
	'ABBC3_LIVELEAK_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

// Custom BBCodes

));

?>