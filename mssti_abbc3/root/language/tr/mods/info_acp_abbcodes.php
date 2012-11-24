<?php
/**
*
* info_acp_abbcodes [Turkish]
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @turkish translator 2012 ZeNaNLi zenanli@hotmail.com.tr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	// These lines are the same as in root/language/tr/acp/common.php
	'ACP_ABBCODES'				=> 'Gelişmiş yazı editörü',
	'ACP_ABBC3_SETTINGS'		=> 'ABBC3 Ayarları',
	'ACP_ABBC3_BBCODES'			=> 'ABBC3 BB Kodlar',
	'LOG_CONFIG_ABBCODES'		=> '<strong>ABBC3 ayarları değiştirildi</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>ABBC3 ayarları kaydedilirken bir hata oluştu.</strong>',

	// UCP settings
	'UCP_ABBCODES'					=> 'Gelişmiş yazı editörü',
	'UCP_ABBC3_SETTINGS'			=> 'Mesaj editörü kod arayüzleri',
	'UCP_ABBC3_SETTINGS_EXPLAIN'	=> '<i>Klasik</i> araç çubuğunu seçtiğinizde kodları elle gireceğinizi unutmayınız.',
	'UCP_ABBC3_LIMITED'				=> 'Klasik PhpBB araç çubuğu',
	'UCP_ABBC3_COMPACT'				=> 'Açılır-kapanır araç çubuğu',
	'UCP_ABBC3_STANDARD'			=> 'Standart araç çubuğu',

	// ABBC3 settings page
	'ABBCODES_SETINGS'					=> 'ABBC3 Ayarları',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'Burada, gelişmiş yazı editörüne ait temel araçları etkinleştirmek, devre dışı bırakmak, arka plan resmi ayarlamak ve daha bir çok özelliği kullanabilirsiniz.',

	'ABBCODES_VERSION_CHECK'			=> 'Sürüm kontrolü',
	'ABBCODES_CURRENT_VERSION'			=> 'Yüklü sürüm',
	'ABBCODES_LATEST_VERSION'			=> 'Mevcut son sürüm',
	'ABBCODES_DOWNLOAD_LATEST'			=> 'Son sürümü indir',

	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> '<strong>Gelişmiş yazı editörü</strong>nü etkinleştirin veya devre dışı bırakıp standart PhpBB3 butonlarını kullanın.',
	'ABBCODES_BG'						=> 'Arkaplan resmi',
	'ABBCODES_BG_EXPLAIN'				=> 'Simgeler için arkaplan resmi kullanmanızı sağlar.<br />Arkaplan<em> resmi</em> kullanmak istemiyorsanız, varsayılan resim yok seçeneğini kullanabilirsiniz.',
	'ABBCODES_TAB'						=> 'Etiketler arasını yandaki simge ile böl',
	'ABBCODES_BOXRESIZE'				=> 'Mesaj editörünü yeniden boyutlandır',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> '+/- butonlarını kullanarak mesaj editörünü yeniden boyutlandırabilirsiniz.',
	'ABBCODES_UCP_MODE'					=> 'UCP kontrol seçenekleri',
	'ABBCODES_UCP_MODE_EXPLAIN'			=> 'Kullanıcıların Biçim kodu düğmeleri arasında tercih yapmasına izin verir.',

	'ABBCODES_WIZARD'					=> 'Sihirbazlar',
	'ABBCODES_WIZARD_SIZE'				=> 'Sihirbaz boyutları',
	'ABBCODES_WIZARD_SIZE_EXPLAIN'		=> 'Açılır pencerede sihirbazlar için varsayılan genişlik ve yükseklik.',
	'ABBCODES_WIZARD_MODE'				=> 'Sihirbaz modunu seçin',
##	For translators :								Don't			Yes
	'ABBCODES_WIZARD_SELECTOR'			=> array(	'0'			=> 'Sihirbazlar devre dışı',
													'1'			=> 'Açılır pencerede',
													'2'			=> 'AJAX (açılır pencere değil)'),

	'ABBCODES_RESIZER'					=> 'Resim Boyutlandırma',
	'ABBCODES_RESIZE'					=> 'Resimleri yeniden boyutlandırma',
	'ABBCODES_RESIZE_EXPLAIN'			=> '[img] kodu kullanılan ve boyutu forum genişliğini aşan resimler yayınlandığı zaman küçültülecektir.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Not : </strong> <em>AdvancedBox JS</em> tam boy resimleri görüntülemek için kullanılan bir JavaScript uygulamasıdır.<br />Ayrıca diğer script uygulamalarını da kullanabilirsiniz. Bu değişiklikler tamamen isteğe bağlıdır.',
	'ABBCODES_RESIZE_METHOD'			=> 'Boyutlandırma metodu',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Tam boy olarak yeniden boyutlandırılan resimlerin nasıl görüntüleneceğini seçin',
	'ABBCODES_RESIZE_BAR'				=> 'Yeniden boyutlandırma bilgi çubuğu',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Boyutlandırılan görüntülerin üst kısmında bilgi çubuğu kullanın.',
##	For translators :								Don't				Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'Advanced Box JS',
													'HighslideBox'	=> 'Highslide JS',
													'Lightview'		=> 'Lightview JS',
													'prettyPhoto'	=> 'PrettyPhoto JS',
													'Shadowbox'		=> 'Shadowbox JS',
													'pop-up'		=> 'Pop-Up pencerede',
													'enlarge'		=> 'Büyük boyda',
													'samewindow'	=> 'Aynı pencerede',
													'newwindow'		=> 'Yeni pencerede',
													'none'			=> 'Yeniden boyutlandırma yok'),

	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> '<strong>AdvancedBox.js</strong> dosyası <em>%1$s</em> klasöründe mevcut değil.',
	'NO_EXIST_EXPLAIN_OTHERS'			=> '<strong>%1$s version %2$s</strong> dosyası <em>%3$s</em> klasöründe mevcut değil.<br />Eğer %4$s, kullanmak istiyorsanız %4$s dosyalarını <a href="%5$s" onclick="window.open(this.href);return false;">buradan</a> indirip <em>%3$s</em> dizinine gönderin.',

	'ABBCODES_MAX_IMAGE_WIDTH'			=> 'Maksimum görüntü genişliği',
	'ABBCODES_MAX_IMAGE_WIDTH_EXPLAIN'	=> 'Görüntü genişlik ayarlarını aşıyorsa yeniden boyutlandırılır.',
	'ABBCODES_MAX_IMAGE_HEIGHT'			=> 'Maksimum görüntü yüksekliği',
	'ABBCODES_MAX_IMAGE_HEIGHT_EXPLAIN'	=> 'Görüntü yükseklik ayarlarını aşıyorsa yeniden boyutlandırılır.',
	'ABBCODES_MAX_THUMB_WIDTH'			=> 'Maksimum, küçük görüntü genişliği',
	'ABBCODES_MAX_THUMB_WIDTH_EXPLAIN'	=> 'Oluşturulan küçük resimler burada bulunan genişlik ayarını aşmayacaktır.',
	'ABBCODES_RESIZE_SIGNATURE'			=> 'İmzalarda kullanılan görüntüleri yeniden boyutlandır',
	'ABBCODES_RESIZE_SIGNATURE_EXPLAIN'	=> 'Kullanıcı imzalarındaki görüntülerin yeniden boyutlandırılmasını istiyor musunuz?',
	'ABBCODES_SIG_IMAGE_WIDTH'			=> 'Maksimum imza görüntüsü genişliği',
	'ABBCODES_SIG_IMAGE_WIDTH_EXPLAIN'	=> 'İmzada bulunan görüntü, genişlik ayarlarını aşıyorsa yeniden boyutlandırılır.',
	'ABBCODES_SIG_IMAGE_HEIGHT'			=> 'Maksimum imza görüntüsü yüksekliği',
	'ABBCODES_SIG_IMAGE_HEIGHT_EXPLAIN'	=> 'İmzada bulunan görüntü, yükseklik ayarlarını aşıyorsa yeniden boyutlandırılır.',

	'ABBCODES_VIDEO_ERROR'				=> '<strong>Hata:</strong> Seçili çok sayıda BBvideo bulunmaktadır. Lütfen bazı BBvideoları kaldırıp tekrar deneyin.',
	'ABBCODES_VIDEO_SIZE'				=> 'Video boyutları',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'Yayınlanan videolar için varsayılan genişlik ve yükseklik',
	'ABBCODES_VIDEO_ALLOWED'			=> 'Video siteleri',
	'ABBCODES_VIDEO_ALLOWED_EXPLAIN'	=> 'İzin verilen video sitelerini yan kutudan seçebilirsiniz.<em class="error">(*)</em>',
	'ABBCODES_VIDEO_ALLOWED_NOTE'		=> '<em class="error">(*)</em> Birden fazla seçim yapmak için CTRL tuşunu kullanabilirsiniz.',
	'ABBCODES_VIDEO_WMODE'				=> 'Şeffaf pencere modu',
	'ABBCODES_VIDEO_WMODE_EXPLAIN'		=> 'Sets the Flash variable “wmode” to transparent. This is only needed if your forum has a layered static object (such as a footer toolbar) and the embedded videos are being rendered on top of the static object.',

	'ABBCODES_DESELECT_ALL'				=> 'Tüm işaretlileri kaldır',
	'ABBCODES_SELECT_ALL'				=> 'Tümünü işaretle',

	// ABBC3 BBCodes page
	'ABBCODES_CONFIG'					=> 'ABBC3 Biçim Kodları',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'Here you can configure the order of the BBCodes in the toolbar (drag-and-drop the table rows to arrange) and edit the options for each of the BBCodes.',

	'ABBCODES_EDIT'						=> 'ABBC3 BB-kodları düzenle',
	'ABBCODES_EDIT_EXPLAIN'				=> 'Burada kodu düzenleyebilir, nerede ve  kimlerin kullanacağını belirleyebilir ve simge atayabilirsiniz.',

	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>Grup yönetimi : </strong>Seçili grup bulunmaması halinde tüm gruplar kodları kullanabilir.<br />Birden fazla grup seçmek için CTRL tuşunu basılı tutarak dilediğiniz grupları seçebilirsiniz.',

	'ABBCODES_TIP'						=> 'Etiket tipi',
	'ABBCODES_NAME'						=> 'BBcode etiket',
	'ABBCODES_TAG'						=> 'Etiket simgesi',
	'ABBCODES_ORDER'					=> 'Etiket ekle',
	'ABBCODES_CUSTOM'					=> 'Özel BBcode',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Satır sonu</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>Bölüm</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Yeni bölüm ekle',
	'ABBCODES_ADD_BREAK'				=> 'Yeni satır sonu ekle',
	'ABBCODES_SYNC'						=> 'Senkronize et',
	'ABBCODES_RESYNC_SUCCESS'			=> 'BB kodlar yeniden senkronize edildi.',

	'ABBCODES_COLOUR_MODE'				=> 'Renk seçici modu seçin',
##	For translators :								Don't			Yes
	'ABBCODES_COLOUR_SELECTOR'			=> array(	'phpbb'		=> 'Varsayılan phpBB stili',
													'dropdown'	=> 'Açılır Kapanır Menü',
													'fancy'		=> '“Süslü” seçici',
													'tigra'		=> 'Tigra renk seçici'),

	'ABBCODES_MOD_DISABLE'				=> '<strong>AGelişmiş yazı editörü 3</strong> devre dışı.<br />',
	'ABBCODES_STATUS'					=> 'durum',
	'ABBCODES_ACTIVATED'				=> 'devrede',
	'ABBCODES_DEACTIVATED'				=> 'devre dışı',

	// UMIL Installer
	// Main
	'INSTALLER_TITLE'					=> 'Gelişmiş Yazı Editörü 3',
	'INSTALLER_TITLE_EXPLAIN'			=> '<strong>ABBC3</strong> (Gelişmiş yazı editörü) kurulum menüsüne hoşgeldiniz.',
	'INSTALLER_INSTALL_WELCOME'			=> 'ABBC3 kurmadan önce',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Herhangi bir sorun yaşamanız halinde <a href="http://www.phpbb.com/support/stk/" title="" onclick="window.open(this.href);return false;">Support Toolkit <em>(STK)</em></a> <strong>Admin tools » Reparse BBCode</strong> özelliğini kullanabilirsiniz.
											<br /><br />Modu kurmadan önce lütfen dosya ve veritabanı yedeklerinizi almayı unutmayın.',
	// Stages
	'INSTALLER_CONFIGS_ADD'				=> 'ABBC3 yapılandırma',
	'INSTALLER_BBCODES_ADD'				=> 'ABBC3 bb-kodları',
	// Misc
	'INSTALLER_RESIZE_CHECK'			=> 'Resizer Method update check complete',
	'INSTALLER_BBVIDEO_UPDATER'			=> 'BBvideolar güncellendi',
));

?>