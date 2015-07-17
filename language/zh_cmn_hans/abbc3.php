<?php
/**
*
* Advanced BBCode Box [Simplified Chinese]
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
	'ABBC3_FONT_FANCY'			=> '炫字体',
	'ABBC3_FONT_SAFE'			=> '网路字体',
	'ABBC3_FONT_WIN'			=> 'Windows字体',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> '对齐: [align=center|left|right|justify]文字[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> '插入影片: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> '模糊: [blur=color]文字[/blur]',
	'ABBC3_DIR_HELPLINE'		=> '文字方向: [dir=ltr|rtl]文字[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> '立体影子: [dropshadow=color]文字[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> '文字渐入/渐出: [fade]文字[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> '飘移文字: [float=left|right]文字[/float]',
	'ABBC3_FONT_HELPLINE'		=> '字体: [font=Comic Sans MS]文字[/font]',
	'ABBC3_GLOW_HELPLINE'		=> '发光: [glow=color]文字[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> '对访客隐藏: [hidden]文字[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> '萤光笔: [highlight=yellow]文字[/highlight]  提示：您也可以使用 color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> '跑马灯: [marq=up|down|left|right]文字[/marq]',
	'ABBC3_MOD_HELPLINE'		=> '警告: [mod=username]文字[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'ASCII文字艺术: [nfo]文字[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> '离题: [offtopic]文字[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> '保存格式: [pre]文字[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> '影子: [shadow=color]文字[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> '剧情透露: [spoil]文字[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> '划掉: [s]文字[/s]',
	'ABBC3_SUB_HELPLINE'		=> '上标: [sub]文字[/sub]',
	'ABBC3_SUP_HELPLINE'		=> '下标: [sup]文字[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube影片: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> '复制',
	'ABBC3_PASTE_BBCODE'		=> '贴上',
	'ABBC3_PASTE_ERROR'			=> '你必须先复制文字才能贴上',
	'ABBC3_PLAIN_BBCODE'		=> '移除BBCode码',
	'ABBC3_NOSELECT_ERROR'		=> '未选择文字',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> '输入至讯息',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> '范例',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideo可连结之网站',
	'ABBC3_BBVIDEO_LINK'		=> '影片网址',
	'ABBC3_BBVIDEO_SIZE'		=> '影片宽度 x 高度',
	'ABBC3_BBVIDEO_PRESETS'		=> '预设大小',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> '添加URL',
	'ABBC3_URL_DESCRIPTION'		=> '可选说明',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode顺序已变更',
	'ABBC3_BBCODE_GROUP'		=> '变更可使用此BBCode的使用者群组',
	'ABBC3_BBCODE_GROUP_INFO'	=> '如果未选择任何群组，则所有人皆可使用此BBCode。若要选择多个群组，请按下CTRL键。苹果电脑请用CMD键',
));
