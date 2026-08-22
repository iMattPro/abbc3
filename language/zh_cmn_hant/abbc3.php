<?php
/**
*
* Advanced BBCode Box [Traditional Chinese]
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
	'ABBC3_HIDDEN_ON'			=> '隱藏內容',
	'ABBC3_HIDDEN_OFF'			=> '隱藏內容（僅限會員）',
	'ABBC3_HIDDEN_EXPLAIN'		=> '你必須登入/註冊才可觀看隱藏內容',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '顯示劇情透露',
	'ABBC3_SPOILER_HIDE'		=> '隱藏劇情透露',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> '離題',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> '字體',
	'ABBC3_FONT_SAFE'			=> '網路字體',
	'ABBC3_GOOGLE_FONTS'		=> 'Google字體',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> '對齊: [align=center|left|right|justify]文字[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> '插入影片: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> '模糊: [blur=color]文字[/blur]',
	'ABBC3_DIR_HELPLINE'		=> '文字方向: [dir=ltr|rtl]文字[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> '立體影子: [dropshadow=color]文字[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> '文字漸入/漸出: [fade]文字[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> '飄移文字: [float=left|right]文字[/float]',
	'ABBC3_FONT_HELPLINE'		=> '字體: [font=Comic Sans MS]文字[/font]',
	'ABBC3_GLOW_HELPLINE'		=> '發光: [glow=color]文字[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> '對訪客隱藏: [hidden]文字[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> '螢光筆: [highlight=yellow]文字[/highlight]  提示：你也可以使用 color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> '跑馬燈: [marq=up|down|left|right]文字[/marq]',
	'ABBC3_MOD_HELPLINE'		=> '警告: [mod=username]文字[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'ASCII文字藝術: [nfo]文字[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> '離題: [offtopic]文字[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> '保存格式: [pre]文字[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> '影子: [shadow=color]文字[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud：[soundcloud]https://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> '劇情透露: [spoil]文字[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> '劃掉: [s]文字[/s]',
	'ABBC3_SUB_HELPLINE'		=> '上標: [sub]文字[/sub]',
	'ABBC3_SUP_HELPLINE'		=> '下標: [sup]文字[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube影片: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> '嵌入 MP4/OGG/WEBM 視訊檔案：網址必須以 <samp class="error">https</samp> 或 <samp class="error">http</samp> 開頭，並以 <samp class="error">.mp4</samp>、<samp class="error">.ogg</samp> 或 <samp class="error">.webm</samp> 結尾（無需 BBCode）。瀏覽器支援與介面實作可能有所不同。',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> '複製',
	'ABBC3_PASTE_BBCODE'		=> '貼上',
	'ABBC3_PASTE_ERROR'			=> '你必須先複製文字才能貼上',
	'ABBC3_PLAIN_BBCODE'		=> '移除BBCode碼',
	'ABBC3_NOSELECT_ERROR'		=> '未選擇文字',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> '輸入至訊息',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> '範例',
	'ABBC3_BBVIDEO_SITES'		=> '可連結之網站',
	'ABBC3_URL_LINK'			=> '添加URL',
	'ABBC3_URL_DESCRIPTION'		=> '可選說明',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> '建立表',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> '使用任何這些 ASCII 樣式格式建立表格。',
	'ABBC3_PIPE_DOCUMENTATION'	=> '使用者指南',
	'ABBC3_PIPE_SIMPLE'			=> '簡單的桌子',
	'ABBC3_PIPE_COMPACT'		=> '緊湊型桌子',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> '外部管道和管道周圍的空間是可選的。',
	'ABBC3_PIPE_ALIGNMENT'		=> '文字對齊',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode順序已變更',
	'ABBC3_BBCODE_ORDERED_FAIL'	=> 'BBCode 訂單無法更新。',
	'ABBC3_BBCODE_ORDER_NO_TABLE'	=> '未收到 BBCode 表名。',
	'ABBC3_BBCODE_ORDER_NO_DATA'	=> '未收到 BBCode 訂單資料。',
	'ABBC3_BBCODE_ORDER_NO_ORDER'	=> '沒有更新 BBCode 行。',
	'ABBC3_BBCODE_GROUP'		=> '變更可使用此BBCode的使用者群組',
	'ABBC3_BBCODE_GROUP_INFO'	=> '如果未選擇任何群組，則所有人皆可使用此BBCode。若要選擇多個群組，請按下CTRL鍵。蘋果電腦請用CMD鍵',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> '高級 BBCode 框 BBCode',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> '敏捷的棕色狐狸跳過了懶狗',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>範例：</strong><br>%2$s<br><br><strong>結果：</strong><br>%3$s<hr>',
));
