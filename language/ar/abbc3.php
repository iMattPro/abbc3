<?php
/**
*
* Advanced BBCode Box [Arabic]
* Arabic traslation by dzyasseron tajribaty.com/phpbb for phpbbarabia.com
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
	'ABBC3_HIDDEN_ON'			=> 'محتوى مخفي',
	'ABBC3_HIDDEN_OFF'			=> 'محتوى مخفي (للأعضاء فقط)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'هذا المنتدى يطلب التسجيل أو الدخول لمشاهدة المحتوى المخفي.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Show Spoiler',
	'ABBC3_SPOILER_HIDE'		=> '▼ Hide Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'موضوع مغلق',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'قائمة الخطوط',
	'ABBC3_FONT_FANCY'			=> 'Fancy fonts',
	'ABBC3_FONT_SAFE'			=> 'Safe fonts',
	'ABBC3_FONT_WIN'			=> 'Windows fonts',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'محاذات النص: [align=center|left|right|justify]نص[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'فيديو: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'طمس النص: [blur=color]نص[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'اتجاه الكتابة: [dir=ltr|rtl]نص[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'تظليل النص: [dropshadow=color]نص[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'تلاشى النص / اختفاء تدرييجى: [fade]نص[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Float text: [float=left|right]نص[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'نوع الخط: [font=Comic Sans MS]نص[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'نص متوهج: [glow=color]نص[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'إخفاء عن الزوار: [hidden]نص[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'ضوء مسلط: [highlight=yellow]نص[/highlight]  Tip: you can also use color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Marquee text: [marq=up|down|left|right]نص[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'رسالة تنبيه: [mod=username]نص[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art text: [nfo]نص[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off Topic message: [offtopic]نص[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'محازاة الى اليمين: [pre]نص[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'نص مظلل: [shadow=color]نص[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler message: [spoil]نص[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'نص يتوسطه خط: [s]نص[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'نص منخفض: [sub]نص[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'نص مرتفع: [sup]نص[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'يوتوب فيديو: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'نسخ النص المحدد',
	'ABBC3_PASTE_BBCODE'		=> 'لصق النص من الحافظة',
	'ABBC3_PASTE_ERROR'			=> 'يجب عليك نسخ جزء من النص، بعدها الصقه',
	'ABBC3_PLAIN_BBCODE'		=> 'حذف تنسيق النص المحدد (حذف الBBcode(',
	'ABBC3_NOSELECT_ERROR'		=> 'لا يوجد نص محدد.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'اضافة الى الرسالة',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'مثال',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'المواقع المتاحة',
	'ABBC3_BBVIDEO_LINK'		=> 'رابط الفيديو',
	'ABBC3_BBVIDEO_SIZE'		=> 'فيديو عرض x طول',
	'ABBC3_BBVIDEO_PRESETS'		=> 'حجم العرض',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'إضافة URL',
	'ABBC3_URL_DESCRIPTION'		=> 'وصف اختياري',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'تم تحديث BBCode المطلوب.',
	'ABBC3_BBCODE_GROUP'		=> 'إدارة المجموعات التي يمكنها استعمال هذا الـ BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'إذا لم تحدد أي مجموعة، كل المستخدمين سيمكنهم استخدام هذا الـBBCode. استعمل CTRL+CLICK (أو CMD+CLICK في ماك) لتحديد/إلغاء تحديد أكثر من مجموعة واحدة.',
));
