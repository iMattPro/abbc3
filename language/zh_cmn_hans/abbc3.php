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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> '隐藏内容',
	'ABBC3_HIDDEN_OFF'			=> '隐藏内容（仅限会员）',
	'ABBC3_HIDDEN_EXPLAIN'		=> '你必须登入/注册才可观看隐藏内容',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► 显示剧情透露',
	'ABBC3_SPOILER_HIDE'		=> '▼ 隐藏剧情透露',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> '离题',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> '字体',
	'ABBC3_FONT_SAFE'			=> '安全字体',
	'ABBC3_GOOGLE_FONTS'		=> 'Google 字体',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> '文字对齐: [align=center|left|right|justify]文字[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> '插入视频: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> '文字模糊: [blur=color]文字[/blur]',
	'ABBC3_DIR_HELPLINE'		=> '文字方向: [dir=ltr|rtl]文字[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> '3D 阴影: [dropshadow=color]文字[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> '文字渐入/渐出: [fade]文字[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> '飘移文字: [float=left|right]文字[/float]',
	'ABBC3_FONT_HELPLINE'		=> '字体: [font=Comic Sans MS]文字[/font]',
	'ABBC3_GLOW_HELPLINE'		=> '发光: [glow=color]文字[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> '对访客隐藏: [hidden]文字[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> '文字高亮: [highlight=yellow]文字[/highlight]  提示：您也可以使用 color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> '跑马灯: [marq=up|down|left|right]文字[/marq]',
	'ABBC3_MOD_HELPLINE'		=> '警告: [mod=username]文字[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'ASCII 文字艺术: [nfo]文字[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> '离题: [offtopic]文字[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> '保留格式: [pre]文字[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> '阴影: [shadow=color]文字[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> '剧情透露: [spoil]文字[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> '删除: [s]文字[/s]',
	'ABBC3_SUB_HELPLINE'		=> '上标: [sub]文字[/sub]',
	'ABBC3_SUP_HELPLINE'		=> '下标: [sup]文字[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube 视频: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> '复制',
	'ABBC3_PASTE_BBCODE'		=> '粘帖',
	'ABBC3_PASTE_ERROR'			=> '你必须先复制文字才能粘帖',
	'ABBC3_PLAIN_BBCODE'		=> '移除 BBCode 代码',
	'ABBC3_NOSELECT_ERROR'		=> '未选择文字',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> '输入至消息',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> '范例',
	'ABBC3_BBVIDEO_SITES'		=> '允许的网站',
	'ABBC3_URL_LINK'			=> '添加 URL',
	'ABBC3_URL_DESCRIPTION'		=> '可选说明',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> '添加表格',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> '使用任意 ASCII 样式的格式添加表格。',
	'ABBC3_PIPE_DOCUMENTATION'	=> '用户指南',
	'ABBC3_PIPE_SIMPLE'			=> '简单表格',
	'ABBC3_PIPE_COMPACT'		=> '紧凑表格',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> '外部的制表符和制表符两侧的空格是可选的。',
	'ABBC3_PIPE_ALIGNMENT'		=> '文字对齐',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| 表头 1 | 表头 2 |\n|----------|----------|\n| 单元 1   | 单元 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "表头 1|表头 2\n-|-\n单元 1|单元 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode 顺序已变更',
	'ABBC3_BBCODE_GROUP'		=> '变更可使用此BBCode的使用者群组',
	'ABBC3_BBCODE_GROUP_INFO'	=> '如果未选择任何群，则所有人皆可使用此 BBCode。若要选择多个群组，请按下 CTRL 键。Mac 电脑请用 CMD 键',
	'ABBC3_GOOGLE_FONTS_INFO'	=> '添加 <a href="https://fonts.google.com" target="_blank">Google Fonts</a> 到 <samp>font</samp> BBCode 中。使用完全一致的大小写和拼写。每行写一个字体名称。 例如： <samp>Droid Sans</samp>',
	'ABBC3_SETTINGS_EXPLAIN'	=> '在此您可以修改 Advanced BBCode Box 的设置。 要了解有关定制图标栏的信息，请访问 <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>。',
	'ABBC3_PIPES'				=> '启用管道表格插件',
	'ABBC3_PIPES_EXPLAIN'		=> '管道表格插件，会允许用户在帖子和私信中使用 markdown 语法来创建表格。',
	'ABBC3_BBCODE_BAR'			=> '启用 BBCode 图标栏',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> '启用它来显示 ABBC3 的基于图标的 BBCode 工具栏。禁用它则会用 phpBB 自带的默认 BBCode 按钮。 ',
	'ABBC3_QR_BBCODES'			=> '在快速回复中启用 BBCode',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> '这回在快速回复编辑器中启用 BBCode 的按钮。',
	'ABBC3_ICONS_TYPE'			=> '图标栏的图片格式',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> '选择用于 ABBC3 图标的图片格式。注意您只能选择一种并用于所有的图标。 ',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode 图标栏',
	'ABBC3_LEGEND_ADD_ONS'		=> '附加设置',
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Example:</strong><br />%2$s<br /><br /><strong>Result:</strong><br />%3$s<hr />',
));
