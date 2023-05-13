<?php
/**
*
* Advanced BBCode Box [Turkish]
* Turkish translation by ESQARE (https://www.phpbbturkey.com)
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Buradan Advanced BBCode Box için ayarları yapılandırabilirsiniz. Simge çubuğunu özelleştirme hakkında bilgi almak için, <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a> sayfasını ziyaret edin.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_PIPES'				=> 'Borulu Tablo Eklentisini etkinleştir',
	'ABBC3_PIPES_EXPLAIN'		=> 'Borulu Tablo Eklentisi, kullanıcıların markdown sözdizimini kullanarak mesajlarında ve özel mesajlarında tablolar oluşturmasına olanak sağlar.',
	'ABBC3_BBCODE_BAR'			=> 'BBCode simge çubuğunu etkinleştir',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Bu özellik ABBC3’ün simge tabanlı BBCode araç çubuğunu gösterir. phpBB’nin varsayılan BBCode butonlarını göstermek için bu ayarı kapatın.',
	'ABBC3_QR_BBCODES'			=> 'Hızlı Cevap bölümünde BBCode’ları etkinleştir',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Bu özellik Hızlı Cevap paneline BBCode butonları ekleyecektir.',
	'ABBC3_ICONS_TYPE'			=> 'Simge çubuğu görüntü biçimi',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'ABBC3’ün simgeleri için kullanılacak resim formatını seçin. Not: tüm simgeleriniz için sadece bir format seçebilirsiniz.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Simge Çubuüu',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Eklentiler',
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Install the optional phpBB Media Embed extension to access settings and management options for embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extension is not installed. <a href="https://www.phpbb.com/customise/db/extension/mediaembed/" target="_blank">Download <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
		1	=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
