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
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Herhangi bir siteden video ekler: [bbvideo]http://video_url[/bbvideo]',
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
	'ABBC3_BBVIDEO_SITES'		=> 'İzin verilen siteleri',
	'ABBC3_BBVIDEO_LINK'		=> 'Video URL',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Bir site URL\'si girin',
	'ABBC3_URL_DESCRIPTION'		=> 'İsteğe bağlı açıklama',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Create tables',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Create tables using any of these ASCII-style formats.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'User Guide',
	'ABBC3_PIPE_SIMPLE'			=> 'Simple table',
	'ABBC3_PIPE_COMPACT'		=> 'Compact table',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'The outer pipes and spaces around pipes are optional.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Text alignment',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode sıralaması güncellendi.',
	'ABBC3_BBCODE_GROUP'		=> 'BBCode\'ları kullanabilecek grupları yönetin',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Eğer bir grup seçilmemişse, bütün gruplar BBCode\'ları kullanabilir. Birden fazla grup seçmek/seçmemek için CTRL+KLİK (veya Mac\'te CMD+KLİK) kullanınız.',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for Advanced BBCode Box 3. For information about customizing the icon bar, visit the <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_PIPES'				=> 'Enable the Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'The Pipes Table PlugIn allows users to create tables in their posts and private messages using markdown syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Enable BBCode icon bar',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display ABBC3’s icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Enable BBCodes in Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'This will add BBCode buttons to Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Icon bar image format',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for ABBC3’s icons. Note that you can only choose one format for all your icons.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Icon Bar',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add Ons',
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Example:</strong><br />%2$s<br /><br /><strong>Result:</strong><br />%3$s<hr />',
));
