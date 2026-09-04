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
	'ABBC3_SETTINGS_EXPLAIN'	=> '您可以在此處配置高級 BBCode Box 的設定。有關自訂圖示欄的信息，請訪問 %s。',
	'ABBC3_GOOGLE_FONTS_INFO'	=> '將 <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google 字型</a></strong> 加入 <samp class="error">[font]</samp> BBCode。使用準確的拼字和區分大小寫。將每個字體名稱放在單獨的行上。',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '必須在「載入設定」下啟用「允許使用第三方內容交付網路」才能使用此功能。',
	'ABBC3_INVALID_FONT'		=> '“%s”的字體名稱無效',
	'ABBC3_FONT_CHECK_FAILED'	=> '無法驗證 Google 字型「%s」。檢查伺服器連線並重試。',
	'ABBC3_PIPES'				=> '啟用管表插件',
	'ABBC3_PIPES_EXPLAIN'		=> 'Pipe Table PlugIn 允許使用者使用 Markdown 語法在他們的貼文和私人訊息中建立表格。',
	'ABBC3_BBCODE_BAR'			=> '啟用 BBCode 圖示欄',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> '這將顯示 ABBC3 基於圖示的 BBCode 工具列。停用此選項可顯示 phpBB 的預設 BBCode 按鈕。',
	'ABBC3_QR_BBCODES'			=> '啟用快速回覆中的 BBCode',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> '這會將 BBCode 按鈕加入快速回覆。',
	'ABBC3_ICONS_TYPE'			=> '圖示列圖像格式',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> '選擇用於 ABBC3 圖示的影像格式。請注意，您只能為所有圖示選擇一種格式。',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode 圖示欄',
	'ABBC3_LEGEND_ADD_ONS'		=> '附加元件',
	'ABBC3_AUTO_VIDEO'			=> '啟用自動視訊插件',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> '該插件將純文字視訊檔案 URL 轉換為可播放的影片。僅轉換以 <samp class="error">http://</samp> 或 <samp class="error">https://</samp> 開頭並以 <samp class="error">.mp4</samp>、<samp class="error">.ogg</samp> 或 <samp class="error">.webm</samp> 結尾的 URL。',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> '安裝選購的 phpBB Media Embed 擴充功能以存取嵌入式富媒體內容的設定和管理選項。',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> '未安裝 phpBB 媒體嵌入擴充。 %s。',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB 媒體嵌入擴充功能已安裝。可在「發布」標籤下存取設定。',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
