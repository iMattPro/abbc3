<?php
/**
*
* Advanced BBCodes [Vietnamese]
*
* Vietnamese translation by Bien Thuy (https://bienthuy.com)
*
* @copyright (c) 2013-2025 Matt Friedman
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for ' . \vse\abbc3\ext::ABBC3_EXT_NAME . '. For information about customizing the icon bar, visit the %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Thêm <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> vào <samp class="error">[font]</samp> BBCode. Sử dụng chính tả chính tả và phân biệt chữ hoa chữ thường. Đặt mỗi tên phông chữ trên một dòng riêng biệt.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Cho phép sử dụng mạng phân phối nội dung của bên thứ ba” phải được bật trong “Tải cài đặt” để sử dụng tính năng này.',
	'ABBC3_INVALID_FONT'		=> 'Tên phông chữ không hợp lệ cho “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Không thể xác minh Phông chữ Google “%s”. Hãy kiểm tra kết nối máy chủ và thử lại.',
	'ABBC3_PIPES'				=> 'Kích hoạt PlugIn bảng ống',
	'ABBC3_PIPES_EXPLAIN'		=> 'PlugIn Pipe Table cho phép người dùng tạo bảng trong bài đăng và tin nhắn riêng tư của họ bằng cú pháp đánh dấu.',
	'ABBC3_BBCODE_BAR'			=> 'Bật thanh biểu tượng BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display an icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Kích hoạt BBCodes trong Trả lời nhanh',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Điều này sẽ thêm các nút BBCode vào Trả lời nhanh.',
	'ABBC3_ICONS_TYPE'			=> 'Định dạng hình ảnh thanh biểu tượng',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for Advanced BBCode icons. Note that you can only choose one format for all your icons.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Thanh biểu tượng BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Tiện ích bổ sung',
	'ABBC3_AUTO_VIDEO'			=> 'Bật PlugIn video tự động',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Plugin này chuyển đổi URL tệp video văn bản thuần túy thành video có thể phát được. Chỉ các URL bắt đầu bằng <samp class="error">http://</samp> hoặc <samp class="error">https://</samp> và kết thúc bằng <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> hoặc <samp class="error">.webm</samp> mới được chuyển đổi.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Cài đặt tiện ích mở rộng phpBB Media Embed tùy chọn để truy cập các cài đặt và tùy chọn quản lý cho nội dung đa phương tiện được nhúng.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Tiện ích mở rộng phpBB Media Embed chưa được cài đặt. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Tiện ích mở rộng phpBB Media Embed đã được cài đặt. Cài đặt có thể truy cập được trong tab Đăng bài.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
