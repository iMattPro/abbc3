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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Gizli İçerik',
	'ABBC3_HIDDEN_OFF'			=> 'Gizli İçerik (sadece üyeler için)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Bu mesaj panosunda gizli içeriği görüntülemek için kayıt olmanız ve giriş yapmanız gerekmektedir.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Spoiler’ı Göster',
	'ABBC3_SPOILER_HIDE'		=> '▼ Spoiler’ı Gizle',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Konu Dışı',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Yazı tipleri',
	'ABBC3_FONT_SAFE'			=> 'Güvenli yazı tipleri',
	'ABBC3_GOOGLE_FONTS'		=> 'Google yazı tipleri',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Metni hizala: [align=center|left|right|justify]metin[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Herhangi bir video sitesinden video url’si yerleştirin: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Bulanık metin: [blur=color]metin[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Metin yönü: [dir=ltr|rtl]metin[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Alt gölgeli metin: [dropshadow=color]metin[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Parlayan / solan metin: [fade]metin[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Sağa ya da sola sabitlenmiş metin: [float=left|right]metin[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Yazı tipi: [font=Comic Sans MS]metin[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Parlak metin: [glow=color]metin[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Misafirlerden gizle: [hidden]metin[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Vurgulu metin: [highlight=yellow]metin[/highlight]  İpucu: ayrıca color=#FF0000 renk kodu kullanabilirsiniz',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Kayan metin: [marq=up|down|left|right]metin[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Uyarı mesajı: [mod=username]metin[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii sanat metni: [nfo]metin[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Konu Dışı mesajı: [offtopic]metin[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Ön biçimlendirilmeli metin: [pre]metin[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Gölgeli metin: [shadow=color]metin[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]https://soundcloud.com/kullanici-adi/sarki-basligi[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler mesajı: [spoil]metin[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Üstü çizili metin: [s]metin[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Alt simge metni: [sub]metin[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Üst simge metni: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Embed MP4/OGG/WEBM video files: URL must start with <samp class="error">https</samp> or <samp class="error">http</samp> and end with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> (no BBCode needed). Note that browser support and GUI implementation varies.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Seçilen metni kopyala',
	'ABBC3_PASTE_BBCODE'		=> 'Kopyalanan metni yapıştır',
	'ABBC3_PASTE_ERROR'			=> 'Önce bir metin seçimini kopyalamanız, ardından yapıştırmanız gerekir',
	'ABBC3_PLAIN_BBCODE'		=> 'Seçilen metinden tüm BBCode etiketlerini kaldır',
	'ABBC3_NOSELECT_ERROR'		=> 'Hiç bir metin seçilmedi.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Mesaja ekle',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Örnek',
	'ABBC3_BBVIDEO_SITES'		=> 'İzin verilen siteler',
	'ABBC3_URL_LINK'			=> 'Bir site URL adresi girin',
	'ABBC3_URL_DESCRIPTION'		=> 'İsteğe bağlı açıklama',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Tablolar oluştur',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Bu ASCII tarzı formatlardan herhangi birini kullanarak tablolar oluşturun.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Kullanıcı Rehberi',
	'ABBC3_PIPE_SIMPLE'			=> 'Basit tablo',
	'ABBC3_PIPE_COMPACT'		=> 'Kompakt tablo',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Dış borular ve boruların etrafındaki boşluklar isteğe bağlıdır.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Metni hizala',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode sırası güncellendi.',
	'ABBC3_BBCODE_GROUP'		=> 'Bu BBCode’u kullanabilen grupları yönetin',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Eğer hiç bir grup seçilmezse, tüm kullanıcılar bu BBCode’u kullanabilirler. Birden fazla grup seçmek ya da seçimi bırakmak için CTRL+SAĞ TIK (ya da Mac bilgisayarlarda CMD+SAĞ TIK) klavye ile mouse kombinasyonunu kullanın.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCode’ları',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Hızlı kahverengi tilki tembel köpeğin üzerinden atlar',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Örnek:</strong><br>%2$s<br><br><strong>Sonuç:</strong><br>%3$s<hr />',
));
