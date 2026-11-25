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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Buradan Advanced [BBCode] Box için ayarları yapılandırabilirsiniz.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> '<strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong>’u <samp class="error">[font]</samp> BBCode’a ekleyin. Tam yazım ve büyük/küçük harf duyarlılığını kullanın. Her yazı tipi adını ayrı bir satıra yerleştirin.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Bu özelliği kullanmak için "Ayarları yükle" altında "Üçüncü taraf içerik dağıtım ağlarının kullanımına izin ver" seçeneğinin etkinleştirilmesi gerekir.',
	'ABBC3_FONT_SEARCH'	=> 'Google Fonts’ta ara',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Yazı tipi adları yükleniyor…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Eşleşen yazı tipi bulunamadı.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Yazı tipi kataloğuna erişilemiyor. Adları elle girin.',
	'ABBC3_SAVE_FONTS'	=> 'Yazı tiplerini kaydet',
	'ABBC3_FONTS_CHECKING'	=> 'Yazı tipleri kontrol ediliyor ve kaydediliyor…',
	'ABBC3_FONTS_SAVED'	=> 'Yazı tipleri kaydedildi.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Araç çubuğu düzenleyicisi',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Düğmeleri Birincil, Daha fazla ve Gizli grupları arasında sürükleyin. Özelleştirmek için bir düğme seçin. Font Awesome simgesi görselin yerine geçer. BBCode adını göstermek için görsel seçmeyin.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Birincil',
	'ABBC3_TOOLBAR_MORE'	=> 'Daha fazla',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Gizli',
	'ABBC3_FONT_ICON'	=> 'Font Awesome simgesi',
	'ABBC3_IMAGE_ICON'	=> 'Görsel simge',
	'ABBC3_ICON_NONE'	=> 'Yok (metin kullan)',
	'ABBC3_PLACEMENT'	=> 'Konum',
	'ABBC3_TOOLBAR_DISABLED'	=> 'BBCode simge çubuğu kapalı. Düzeni düzenlemeye devam edebilirsiniz. Çubuğu yeniden açtığınızda bu düzen kullanılır.',
	'ABBC3_LIVE_PREVIEW'	=> 'Canlı ön izleme',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Kaydediliyor…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Kaydedildi',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Değişiklikler kaydedilemedi.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Yeniden dene',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Advanced [BBCode] Box ayarlarını değiştirmek için JavaScript gereklidir.',
	'ABBC3_DRAG_BUTTON'	=> '%s düğmesini sürükle',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo ve Media Embed',
	'ABBC3_INVALID_FONT'		=> '“%s” için geçersiz yazı tipi adı',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Google Yazı Tipi “%s” doğrulanamadı. Sunucu bağlantısını kontrol edip tekrar deneyin.',
	'ABBC3_PIPES'				=> 'Borulu Tablo Eklentisini etkinleştir',
	'ABBC3_PIPES_EXPLAIN'		=> 'Borulu Tablo Eklentisi, kullanıcıların markdown sözdizimini kullanarak mesajlarında ve özel mesajlarında tablolar oluşturmasına olanak sağlar.',
	'ABBC3_BBCODE_BAR'			=> 'BBCode simge çubuğunu etkinleştir',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Bu ayar simge tabanlı bir BBCode araç çubuğu gösterir. phpBB’nin varsayılan BBCode düğmelerini göstermek için bu ayarı kapatın.',
	'ABBC3_QR_BBCODES'			=> 'Hızlı Cevap bölümünde BBCode’ları etkinleştir',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Bu özellik Hızlı Cevap paneline BBCode butonları ekleyecektir.',
	'ABBC3_ICONS_TYPE'			=> 'Simge çubuğu görüntü biçimi',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'BBCode simgeleri için kullanılacak resim biçimini seçin. Ek SVG veya PNG simgelerini forumunuzdaki <samp class="error">/images/abbc3/icons/</samp> dizinine yükleyebilirsiniz.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Simge Çubuüu',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Eklentiler',
	'ABBC3_AUTO_VIDEO'			=> 'Otomatik Video Eklentisini Etkinleştir',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Bu eklenti, düz metinli video dosyası URL’lerini oynatılabilir videolara dönüştürür. Yalnızca <samp class="error">http://</samp> veya <samp class="error">https://</samp> ile başlayan ve <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> veya <samp class="error">.webm</samp> ile biten URL’ler dönüştürülür.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Gömülü zengin medya içeriğinin ayarlarına ve yönetim seçeneklerine erişmek için isteğe bağlı phpBB Media Embed uzantısını yükleyin.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed uzantısı yüklü değil. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed uzantısı kuruldu. Ayarlara Gönderim sekmesinden erişilebilir.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
