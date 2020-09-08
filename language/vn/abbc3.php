<?php
/**
*
* Advanced BBCode Box [Vietnamese]
*
* Vietnamese translation by Bien Thuy (https://bienthuy.com)
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
	'ABBC3_HIDDEN_ON'			=> 'Nội dung ẩn',
	'ABBC3_HIDDEN_OFF'			=> 'Nội dung ẩn (chỉ dành cho thành viên)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Diễn đàn yêu cầu bạn phải đăng ký và đăng nhập để có thể xem nội dung ẩn.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Hiển thị mô tả',
	'ABBC3_SPOILER_HIDE'		=> '▼ Ẩn mô tả',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Chủ đề đóng',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Danh sách font chữ',
	'ABBC3_FONT_FANCY'			=> 'Fancy fonts',
	'ABBC3_FONT_SAFE'			=> 'Safe fonts',
	'ABBC3_FONT_WIN'			=> 'Windows fonts',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Căn lề đoạn văn: [align=center|left|right|justify]đoạn văn[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Chèn bất cứ liên kết video nào vào bài viết: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Văn bản nhấp nháy: [blur=color]đoạn văn[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Căn hướng đoạn văn: [dir=ltr|rtl]đoạn văn[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Tạo hiệu ứng bóng đổ cho đoạn văn: [dropshadow=color]đoạn văn[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Hiệu ứng fadein / fadeout: [fade]đoạn văn[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Float: [float=left|right]đoạn văn[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Định dạng Font: [font=Comic Sans MS]đoạn văn[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Glow: [glow=color]đoạn văn[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ẩn với khách: [hidden]đoạn văn[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Làm nổi bật màu nền: [highlight=yellow]đoạn văn[/highlight]  Gợi ý: Bạn cũng có thể sử dụng mã màu: ví dụ color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Chữ chạy: [marq=up|down|left|right]đoạn văn[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Cảnh báo: [mod=username]đoạn văn[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art text: [nfo]đoạn văn[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Chủ đề đóng: [offtopic]đoạn văn[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Preformatted: [pre]đoạn văn[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Tạo hiệu ứng bóng đổ: [shadow=color]đoạn văn[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Ẩn/ hiện nội dung đoạn văn: [spoil]đoạn văn[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Chữ gạch ngang thân: [s]đoạn văn[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Subscript: [sub]đoạn văn[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Superscript: [sup]đoạn văn[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Sao chép đoạn đã bôi đen',
	'ABBC3_PASTE_BBCODE'		=> 'Dán nội dung đã sao chép',
	'ABBC3_PASTE_ERROR'			=> 'Bạn phải sao chép nội dung đoạn đã bôi đen, sau đó dán nội dung đã sao chép',
	'ABBC3_PLAIN_BBCODE'		=> 'Loại bỏ hết các BBCode khỏi đoạn văn đã bôi đen',
	'ABBC3_NOSELECT_ERROR'		=> 'Bạn chưa bôi đen đoạn văn nào.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Chèn vào nội dung',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Ví dụ',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Những trang video cho phép',
	'ABBC3_BBVIDEO_LINK'		=> 'Đường dẫn',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Nhập liên kết',
	'ABBC3_URL_DESCRIPTION'		=> 'Mô tả thêm',
	'ABBC3_URL_EXAMPLE'			=> 'https://bienthuy.com',

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
	'ABBC3_BBCODE_ORDERED'		=> 'Thứ tự BBCode đã được cập nhật.',
	'ABBC3_BBCODE_GROUP'		=> 'Quản lý những nhóm có khả năng sử dụng BBCode này',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Nếu không có nhóm nào được chọn, tất cả mọi thành viên đều được sử dụng BBCode này. Sử dụng CTRL+CLICK (hoặc CMD+CLICK trên các máy Mac) để chọn hoặc bỏ chọn nhiều hơn 1 nhóm.',
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
