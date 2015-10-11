<?php
/**
*
* Advanced BBCode Box [Turkish]
*
* @copyright (c) 2015 Edip Dincer
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
	'ABBC3_HIDDEN_ON'			=> 'Gizli İçerik',
	'ABBC3_HIDDEN_OFF'			=> 'Gizli İçerik (sadece üyeler için)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Bu forum gizli içeriği görebilmeniz için üyelik gerektiriyor.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Spoiler Göster',
	'ABBC3_SPOILER_HIDE'		=> '▼ Spoiler Gizle',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Konu Dışı',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Yazı Tipi Menüsü',
	'ABBC3_FONT_FANCY'			=> 'Havalı yazı tipleri',
	'ABBC3_FONT_SAFE'			=> 'Güvenli yazı tipleri',
	'ABBC3_FONT_WIN'			=> 'Windows yazı tipleri',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Yazıyı Hizala: [align=center|left|right|justify]yazı[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Herhangi bir siteden video ekler: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Yazıyı flulaştır: [blur=color]yazı[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Yazı yönü: [dir=ltr|rtl]yazı[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Yazıya gölge ver: [dropshadow=color]yazı[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Yazıyı soldur: [fade]yazı[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Yazıyı yüzdür: [float=left|right]yazı[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Yazı tipi: [font=Comic Sans MS]yazı[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Yazıyı parlat: [glow=color]yazı[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ziyaretçilerden gizle: [hidden]yazı[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Yazıyı işaretle: [highlight=yellow]yazı[/highlight]  Tip: you can also use color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Yazıya kayma efekti ekle: [marq=up|down|left|right]yazı[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Uyarı mesajı: [mod=username]yazı[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art yazısı: [nfo]yazı[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Konu dışı mesaj: [offtopic]yazı[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Önceden ayarlanmış yazı: [pre]yazı[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Gölge yazı: [shadow=color]yazı[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler mesajı: [spoil]yazı[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Üzeri çizili yazı: [s]yazı[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Alt simge yazı: [sub]yazı[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Üst simge yazı: [sup]yazı[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Seçili metni kopyala',
	'ABBC3_PASTE_BBCODE'		=> 'Kopyalanan metni yapıştır',
	'ABBC3_PASTE_ERROR'			=> 'İlk olarak bir metin seçip kopyalamalısınız',
	'ABBC3_PLAIN_BBCODE'		=> 'Seçili metinden bütün BBCode etiketlerini temizle',
	'ABBC3_NOSELECT_ERROR'		=> 'Bir metin seçilmedi.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Mesaja ekle',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Örnek',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'İzin verilen BBvideo siteleri',
	'ABBC3_BBVIDEO_LINK'		=> 'Video URL',
	'ABBC3_BBVIDEO_SIZE'		=> 'Video Genişlik x Yükseklik',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Boyut Ayarları',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Bir site URL\'si girin',
	'ABBC3_URL_DESCRIPTION'		=> 'İsteğe bağlı açıklama',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode sıralaması güncellendi.',
	'ABBC3_BBCODE_GROUP'		=> 'BBCode\'ları kullanabilecek grupları yönetin',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Eğer bir grup seçilmemişse, bütün gruplar BBCode\'ları kullanabilir. Birden fazla grup seçmek/seçmemek için CTRL+KLİK (veya Mac\'te CMD+KLİK) kullanınız.',
));
