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
	'ABBC3_SPOILER_SHOW'		=> '► 顯示劇情透露',
	'ABBC3_SPOILER_HIDE'		=> '▼ 隱藏劇情透露',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> '離題',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> '字體',
	'ABBC3_FONT_FANCY'			=> '炫字體',
	'ABBC3_FONT_SAFE'			=> '網路字體',
	'ABBC3_FONT_WIN'			=> 'Windows字體',

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
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> '劇情透露: [spoil]文字[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> '劃掉: [s]文字[/s]',
	'ABBC3_SUB_HELPLINE'		=> '上標: [sub]文字[/sub]',
	'ABBC3_SUP_HELPLINE'		=> '下標: [sup]文字[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube影片: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> '複製',
	'ABBC3_PASTE_BBCODE'		=> '貼上',
	'ABBC3_PASTE_ERROR'			=> '你必須先複製文字才能貼上',
	'ABBC3_PLAIN_BBCODE'		=> '移除BBCode碼',
	'ABBC3_NOSELECT_ERROR'		=> '未選擇文字',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> '輸入至訊息',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> '範例',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> '可連結之網站',
	'ABBC3_BBVIDEO_LINK'		=> '影片網址',

	// URL Wizard
	'ABBC3_URL_LINK'			=> '添加URL',
	'ABBC3_URL_DESCRIPTION'		=> '可選說明',
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
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode順序已變更',
	'ABBC3_BBCODE_GROUP'		=> '變更可使用此BBCode的使用者群組',
	'ABBC3_BBCODE_GROUP_INFO'	=> '如果未選擇任何群組，則所有人皆可使用此BBCode。若要選擇多個群組，請按下CTRL鍵。蘋果電腦請用CMD鍵',
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
