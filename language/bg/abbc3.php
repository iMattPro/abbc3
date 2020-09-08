<?php
/**
*
* Advanced BBCode Box [Bulgarian]
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
	'ABBC3_HIDDEN_ON'			=> 'Скрито съдържание',
	'ABBC3_HIDDEN_OFF'			=> 'Скрито съдържание (само за потребители)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Изисква се да бъдете регистрирани за да видите това съдържание.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Виж съдържание',
	'ABBC3_SPOILER_HIDE'		=> '▼ Скрий съдържание',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Офтопик',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Шрифт',
	'ABBC3_FONT_FANCY'			=> 'Артистични шрифтове',
	'ABBC3_FONT_SAFE'			=> 'Безопасни шрифтове',
	'ABBC3_FONT_WIN'			=> 'Шрифтове на Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Аранжиране на текст: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Вмъкни URL на видео: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Замъглен текст: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Направление на текста: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Текст със сянка: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Плавно затъмняване в началото/края: [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Плаващ текст: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Шрифт: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Светещ текст: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Скрий от гости: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Изпъкнал текст (Highlight): [highlight=yellow]text[/highlight]  Tip: you can also use color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Marquee text: [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Предупреждение: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii художествен текст: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Офтопик: [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Преформатиран текст: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Сянка: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Спойлер: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Задраскан текст: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Понижен текст: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Покачен текст: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Копирай текста',
	'ABBC3_PASTE_BBCODE'		=> 'Постави текста',
	'ABBC3_PASTE_ERROR'			=> 'Трябва първо да копирате текста и след това да го поставите',
	'ABBC3_PLAIN_BBCODE'		=> 'Премахни всички тагове BBCode от избрания текст',
	'ABBC3_NOSELECT_ERROR'		=> 'Не е избран текст.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Вмъкни в съобщението',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Пример',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Сайтове с позволено',
	'ABBC3_BBVIDEO_LINK'		=> 'Видео URL',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Вмъкни URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Допълнително обяснение',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Създаване на таблица',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Създаване на таблица, използвайки всеки от тези ASCII-style формати.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Инструкция за потребителя',
	'ABBC3_PIPE_SIMPLE'			=> 'Проста таблица',
	'ABBC3_PIPE_COMPACT'		=> 'Компактна таблица',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'The outer pipes and spaces around pipes are optional.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Подравняване на таблица',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode редът бе обновен.',
	'ABBC3_BBCODE_GROUP'		=> 'Управление на групите, които могат да използват този BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Ако не е избрана група, всички потребители могат да ползват този BBCode. Натисни CTRL+CLICK (или CMD+CLICK на Mac) за да избереш/откажеш повече от една група.',
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
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Пример:</strong><br />%2$s<br /><br /><strong>Резултат:</strong><br />%3$s<hr />',
));
