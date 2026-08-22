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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Buradan Advanced BBCode Box için ayarları yapılandırabilirsiniz. Simge çubuğunu özelleştirme hakkında bilgi almak için, %s sayfasını ziyaret edin.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> '<strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong>’u <samp class="error">[font]</samp> BBCode’a ekleyin. Tam yazım ve büyük/küçük harf duyarlılığını kullanın. Her yazı tipi adını ayrı bir satıra yerleştirin.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Bu özelliği kullanmak için "Ayarları yükle" altında "Üçüncü taraf içerik dağıtım ağlarının kullanımına izin ver" seçeneğinin etkinleştirilmesi gerekir.',
	'ABBC3_INVALID_FONT'		=> '“%s” için geçersiz yazı tipi adı',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Google Yazı Tipi “%s” doğrulanamadı. Sunucu bağlantısını kontrol edip tekrar deneyin.',
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
	'ABBC3_AUTO_VIDEO'			=> 'Otomatik Video Eklentisini Etkinleştir',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Bu eklenti, düz metinli video dosyası URL’lerini oynatılabilir videolara dönüştürür. Yalnızca <samp class="error">http://</samp> veya <samp class="error">https://</samp> ile başlayan ve <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> veya <samp class="error">.webm</samp> ile biten URL’ler dönüştürülür.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Gömülü zengin medya içeriğinin ayarlarına ve yönetim seçeneklerine erişmek için isteğe bağlı phpBB Media Embed uzantısını yükleyin.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed uzantısı yüklü değil. %2$s.',
		1	=> 'phpBB Media Embed uzantısı kuruldu. Ayarlara Gönderim sekmesinden erişilebilir.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
