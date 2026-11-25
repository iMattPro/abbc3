<?php
/**
*
* Advanced BBCode Box [Simplified Chinese]
* @简体中文语言　David Yin <https://www.phpbbchinese.com/>
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
	'ABBC3_SETTINGS_EXPLAIN'	=> '在此您可以修改 Advanced [BBCode] Box 的设置。',
	'ABBC3_GOOGLE_FONTS_INFO'	=> '添加 <a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a> 到 <samp>font</samp> BBCode 中。使用完全一致的大小写和拼写。每行写一个字体名称。 例如： <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '要使用此特性，请在‘负载设置’页面，设置“允许使用第三方内容分发网络”。',
	'ABBC3_FONT_SEARCH'	=> '搜索 Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> '正在加载字体名称…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> '没有匹配的字体。',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> '字体目录暂不可用。请手动输入字体名称。',
	'ABBC3_SAVE_FONTS'	=> '保存字体',
	'ABBC3_FONTS_CHECKING'	=> '正在检查并保存字体…',
	'ABBC3_FONTS_SAVED'	=> '字体已保存。',
	'ABBC3_TOOLBAR_COMPOSER'	=> '工具栏编辑器',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> '在“主要”“更多”和“隐藏”之间拖动按钮。选择按钮进行自定义。Font Awesome 图标优先于图片。不选图片时将显示 BBCode 名称。',
	'ABBC3_TOOLBAR_PRIMARY'	=> '主要',
	'ABBC3_TOOLBAR_MORE'	=> '更多',
	'ABBC3_TOOLBAR_HIDDEN'	=> '隐藏',
	'ABBC3_FONT_ICON'	=> 'Font Awesome 图标',
	'ABBC3_IMAGE_ICON'	=> '图片图标',
	'ABBC3_ICON_NONE'	=> '无（使用文字）',
	'ABBC3_PLACEMENT'	=> '位置',
	'ABBC3_TOOLBAR_DISABLED'	=> 'BBCode 图标栏已停用。您仍可编辑布局，重新启用后会应用该布局。',
	'ABBC3_LIVE_PREVIEW'	=> '实时预览',
	'ABBC3_AUTOSAVE_SAVING'	=> '正在保存…',
	'ABBC3_AUTOSAVE_SAVED'	=> '已保存',
	'ABBC3_AUTOSAVE_ERROR'	=> '无法保存更改。',
	'ABBC3_AUTOSAVE_RETRY'	=> '重试',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> '更改 Advanced [BBCode] Box 设置需要 JavaScript。',
	'ABBC3_DRAG_BUTTON'	=> '拖动 %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo 和 Media Embed',
	'ABBC3_INVALID_FONT'		=> '无效的字体名称 “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> '无法验证 Google 字体“%s”。检查服务器连接并重试。',
	'ABBC3_PIPES'				=> '启用管道表格插件',
	'ABBC3_PIPES_EXPLAIN'		=> '管道表格插件，会允许用户在帖子和私信中使用 markdown 语法来创建表格。',
	'ABBC3_BBCODE_BAR'			=> '启用 BBCode 图标栏',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> '启用此选项可显示带图标的 BBCode 工具栏。停用此选项可显示 phpBB 默认的 BBCode 按钮。',
	'ABBC3_QR_BBCODES'			=> '在快速回复中启用 BBCode',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> '这回在快速回复编辑器中启用 BBCode 的按钮。',
	'ABBC3_ICONS_TYPE'			=> '图标栏的图片格式',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> '选择 BBCode 图标的图片格式。您可以将其他 SVG 或 PNG 图标上传到论坛的 <samp class="error">/images/abbc3/icons/</samp> 目录。',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode 图标栏',
	'ABBC3_LEGEND_ADD_ONS'		=> '附加设置',
	'ABBC3_AUTO_VIDEO'			=> '启用自动视频插件',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> '此插件可将纯文本视频文件 URL 转换为可播放的视频。只有 URLs 网址以 <samp class="error">http://</samp> 或 <samp class="error">https://</samp> 开头，并且以 <samp class="error">.mp4</samp>， <samp class="error">.ogg</samp> 或 <samp class="error">.webm</samp> 结尾的才能转换。',
	'ABBC3_BBVIDEO_EXPLAIN'		=> '安装可选的  phpBB Media Embed 扩展，以访问内嵌富媒体内容的设置和管理选项。',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed 扩展没有安装。 %s。',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed 扩展已安装。 在帖子选项卡下设置。',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
