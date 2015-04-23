<?php
/**
*
* Advanced BBCode Box [Persian]
* Translated by Meisam Noubari from IRAN in php-bb.ir
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
	'ABBC3_HIDDEN_ON'			=> 'مخفی کردن محتوی',
	'ABBC3_HIDDEN_OFF'			=> 'مخفی کردن محتوی ( برای اعضا )',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'برای مشاهده متن باید در انجمن عضو باشید',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> 'نمایش متن ►',
	'ABBC3_SPOILER_HIDE'		=> 'مخفی کردن متن ▼',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'پیام بسته شدن موضوع',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'منو فونت',
	'ABBC3_FONT_FANCY'			=> 'فونت های فانتزی',
	'ABBC3_FONT_SAFE'			=> 'فونت های عمومی',
	'ABBC3_FONT_WIN'			=> 'فونت های ویندوز',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'تراز متن: [align=center|left|right|justify]متن[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'قرار دادن آدرس ویدیو: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'متن بلور: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'جهت متن: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'متن سایه: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'متن محو / غیر محو: [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'متن شناور: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'نوع فونت: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'متن درخشان: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'مخفی کردن از مهمان: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'متن هایلایت: [highlight=yellow]text[/highlight]  Tip: you can also use color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'متن متحرک: [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'پیام خطا: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'حالت NFO ascii: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'پیام بسته شدن موضوع: [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'متن تنظیم شده: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'سایه متن: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'متن مخفی: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'متن خط خورده: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'متن زیرنویس شده: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'متن بالانویس شده: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'ویدیو یوتیوب: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'کپی متن انتخاب شده',
	'ABBC3_PASTE_BBCODE'		=> 'چسباندن متن انتخاب شده',
	'ABBC3_PASTE_ERROR'			=> 'شما باید ابتدا متنی را کپی کنید و بعد از ان بچسبانید',
	'ABBC3_PLAIN_BBCODE'		=> 'همه بی بی کد ها را از متن حذف کنید',
	'ABBC3_NOSELECT_ERROR'		=> 'متنی انتخاب نشد',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'داخل متن وارد کنید',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'مثال',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'فرمت های ویدیویی مجاز',
	'ABBC3_BBVIDEO_LINK'		=> 'لینک های ویدیو',
	'ABBC3_BBVIDEO_SIZE'		=> 'طول و عرض ویدیو',
	'ABBC3_BBVIDEO_PRESETS'		=> 'اندازه',
	'ABBC3_BBVIDEO_SEPARATOR'	=> '*',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'اضافه کردن URL',
	'ABBC3_URL_DESCRIPTION'		=> 'توضیحات اختیاری',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'بی بی کد دستور داده شده به روز رسانی شد',
	'ABBC3_BBCODE_GROUP'		=> 'مدیریت گروه های مجاز برای دسترسی به بی بی کدها',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'اگر گروهی انتخاب نشده باشد ، تمام اعضا به بی بی کدها دسترسی دارند و برای انتخاب گروه های بیشتر کلید کنترل و کلیک را فشار دهید',
));
