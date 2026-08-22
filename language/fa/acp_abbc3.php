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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'در اینجا می توانید تنظیمات Advanced BBCode Box را پیکربندی کنید. برای اطلاعات در مورد سفارشی کردن نوار نماد، از %s دیدن کنید.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> '<strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">فونت‌های Google</a></strong> را به <samp class="error">[font]</samp> BBCode اضافه کنید. از املای دقیق و حساسیت به حروف کوچک و بزرگ استفاده کنید. نام هر فونت را در یک خط جداگانه قرار دهید.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'برای استفاده از این ویژگی، «اجازه استفاده از شبکه‌های تحویل محتوای شخص ثالث» را باید در «تنظیمات بارگیری» فعال کنید.',
	'ABBC3_INVALID_FONT'		=> 'نام قلم نامعتبر برای "%s"',
	'ABBC3_FONT_CHECK_FAILED'	=> 'نمی‌توان فونت Google "%s" را تأیید کرد. اتصال سرور را بررسی کنید و دوباره امتحان کنید.',
	'ABBC3_PIPES'				=> 'PlugIn Pipe Table را فعال کنید',
	'ABBC3_PIPES_EXPLAIN'		=> 'PlugIn Pipe Table به کاربران اجازه می دهد تا جداول را در پست ها و پیام های خصوصی خود با استفاده از نحو علامت گذاری ایجاد کنند.',
	'ABBC3_BBCODE_BAR'			=> 'نوار نماد BBCode را فعال کنید',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'این نوار ابزار BBCode مبتنی بر نماد ABBC3 را نمایش می دهد. برای نمایش دکمه های پیش فرض BBCode phpBB، این را غیرفعال کنید.',
	'ABBC3_QR_BBCODES'			=> 'BBCodes را در پاسخ سریع فعال کنید',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'این دکمه‌های BBCode را به پاسخ سریع اضافه می‌کند.',
	'ABBC3_ICONS_TYPE'			=> 'فرمت تصویر نوار نماد',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'فرمت تصویر را برای استفاده برای نمادهای ABBC3 انتخاب کنید. توجه داشته باشید که شما فقط می توانید یک قالب را برای تمام آیکون های خود انتخاب کنید.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'نوار نماد BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'موارد اضافه کنید',
	'ABBC3_AUTO_VIDEO'			=> 'افزونه ویدیوی خودکار را فعال کنید',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'این افزونه آدرس فایل های ویدئویی متن ساده را به ویدئوهای قابل پخش تبدیل می کند. فقط URL هایی که با <samp class="error">http://</samp> یا <samp class="error">https://</samp> شروع می شوند و به <samp class="error">.mp4</samp>، <samp class="error">.ogg</samp> یا <samp class="error">.webm</samp> ختم می شوند، تبدیل می شوند.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'پسوند اختیاری phpBB Media Embed را برای دسترسی به تنظیمات و گزینه های مدیریت محتوای رسانه غنی جاسازی شده نصب کنید.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'پسوند phpBB Media Embed نصب نشده است. %2$s.',
		1	=> 'پسوند phpBB Media Embed نصب شده است. تنظیمات در زیر تب Posting قابل دسترسی هستند.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
