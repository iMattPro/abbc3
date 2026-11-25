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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tại đây bạn có thể định cấu hình cài đặt cho Hộp BBCode nâng cao.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Thêm <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> vào <samp class="error">[font]</samp> BBCode. Sử dụng chính tả chính tả và phân biệt chữ hoa chữ thường. Đặt mỗi tên phông chữ trên một dòng riêng biệt.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Cho phép sử dụng mạng phân phối nội dung của bên thứ ba” phải được bật trong “Tải cài đặt” để sử dụng tính năng này.',
	'ABBC3_FONT_SEARCH'	=> 'Tìm kiếm trong Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Đang tải tên phông chữ…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Không tìm thấy phông chữ phù hợp.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Danh mục phông chữ không khả dụng. Hãy nhập tên phông chữ theo cách thủ công.',
	'ABBC3_SAVE_FONTS'	=> 'Lưu phông chữ',
	'ABBC3_FONTS_CHECKING'	=> 'Đang kiểm tra và lưu phông chữ…',
	'ABBC3_FONTS_SAVED'	=> 'Đã lưu phông chữ.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Trình chỉnh sửa thanh công cụ',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Kéo các nút giữa ba nhóm Chính, Thêm và Ẩn. Chọn một nút để tùy chỉnh. Biểu tượng Font Awesome thay thế ảnh. Nếu không chọn ảnh, tên BBCode sẽ được hiển thị.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Chính',
	'ABBC3_TOOLBAR_MORE'	=> 'Thêm',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Ẩn',
	'ABBC3_FONT_ICON'	=> 'Biểu tượng Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Biểu tượng hình ảnh',
	'ABBC3_ICON_NONE'	=> 'Không có (dùng văn bản)',
	'ABBC3_PLACEMENT'	=> 'Vị trí',
	'ABBC3_TOOLBAR_DISABLED'	=> 'Thanh biểu tượng BBCode đang tắt. Bạn vẫn có thể chỉnh sửa bố cục và bố cục sẽ được áp dụng khi bật lại thanh này.',
	'ABBC3_LIVE_PREVIEW'	=> 'Xem trước trực tiếp',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Đang lưu…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Đã lưu',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Không thể lưu thay đổi.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Thử lại',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Cần có JavaScript để thay đổi cài đặt Advanced [BBCode] Box.',
	'ABBC3_DRAG_BUTTON'	=> 'Kéo %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo và Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Tên phông chữ không hợp lệ cho “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Không thể xác minh Phông chữ Google “%s”. Hãy kiểm tra kết nối máy chủ và thử lại.',
	'ABBC3_PIPES'				=> 'Kích hoạt PlugIn bảng ống',
	'ABBC3_PIPES_EXPLAIN'		=> 'PlugIn Pipe Table cho phép người dùng tạo bảng trong bài đăng và tin nhắn riêng tư của họ bằng cú pháp đánh dấu.',
	'ABBC3_BBCODE_BAR'			=> 'Bật thanh biểu tượng BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Tùy chọn này hiển thị thanh công cụ BBCode dùng biểu tượng. Tắt tùy chọn này để hiển thị các nút BBCode mặc định của phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Kích hoạt BBCodes trong Trả lời nhanh',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Điều này sẽ thêm các nút BBCode vào Trả lời nhanh.',
	'ABBC3_ICONS_TYPE'			=> 'Định dạng hình ảnh thanh biểu tượng',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Chọn định dạng ảnh cho các biểu tượng BBCode. Bạn có thể tải thêm biểu tượng SVG hoặc PNG lên thư mục <samp class="error">/images/abbc3/icons/</samp> của diễn đàn.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Thanh biểu tượng BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Tiện ích bổ sung',
	'ABBC3_AUTO_VIDEO'			=> 'Bật PlugIn video tự động',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Plugin này chuyển đổi URL tệp video văn bản thuần túy thành video có thể phát được. Chỉ các URL bắt đầu bằng <samp class="error">http://</samp> hoặc <samp class="error">https://</samp> và kết thúc bằng <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> hoặc <samp class="error">.webm</samp> mới được chuyển đổi.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Cài đặt tiện ích mở rộng phpBB Media Embed tùy chọn để truy cập các cài đặt và tùy chọn quản lý cho nội dung đa phương tiện được nhúng.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Tiện ích mở rộng phpBB Media Embed chưa được cài đặt. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Tiện ích mở rộng phpBB Media Embed đã được cài đặt. Cài đặt có thể truy cập được trong tab Đăng bài.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
