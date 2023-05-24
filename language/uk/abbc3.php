<?php
/**
*
* Advanced BBCode Box [Ukrainian]
*
* @copyright (c) 2015 Matt Friedman
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
	'ABBC3_HIDDEN_ON'			=> 'Прихований вміст',
	'ABBC3_HIDDEN_OFF'			=> 'Прихований вміст (тільки для учасників)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Для перегляду прихованого вмісту необхідно зареєструватися та авторизуватися',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Показати',
	'ABBC3_SPOILER_HIDE'		=> '▼ Приховати',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Не по темі',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Шрифт',
	'ABBC3_FONT_SAFE'			=> 'Стандартні шрифти',
	'ABBC3_GOOGLE_FONTS'		=> 'Шрифти Google',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Вирівнювання: [align=center|left|right|justify]текст[/align]  Підказка: center - по центру, left - по лівому краю, right - по правому краю, justify - по ширині',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Відео з сайта: [bbvideo]http://video_url[/bbvideo]  Підказка: width - ширина, height - висота',
	'ABBC3_BLUR_HELPLINE'		=> 'Розмитий текст: [blur=колір]текст[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Напрямок тексту: [dir=ltr|rtl]текст[/dir]  Підказка: ltr - зліва направо, rtl - справа наліво',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Чітка тінь: [dropshadow=колір]текст[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Мигаючий текст: [fade]текст[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Розташування: [float=left|right]текст[/float]  Підказка: left - зліва з обтіканням, right - справа з обтіканням',
	'ABBC3_FONT_HELPLINE'		=> 'Шрифт: [font=Comic Sans MS]текст[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Сяючий текст: [glow=колір]текст[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Прихований від гостей вміст: [hidden]текст[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Виділення маркером: [highlight=yellow]текст[/highlight]  Підказка: колір можна вказати в RGB, до прикладу - #FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Прокрутка текста: [marq=up|down|left|right]текст[/marq]  Підказка: up - вгору, down - вниз, left - наліво, right - направо',
	'ABBC3_MOD_HELPLINE'		=> 'Повідомлення модератора: [mod=пользователь]текст[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ASCII-арт: [nfo]текст[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Повідомлення не по темі: [offtopic]текст[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Попередньо відформатований текст: [pre]текст[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Розмита тінь: [shadow=колір]текст[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'Музика з SoundCloud: [soundcloud]https://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Спойлер: [spoil]текст[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Закреслений текст: [s]текст[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Підстрочний текст: [sub]текст[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Надстрочний текст: [sup]текст[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Відео з YouTube: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Embed MP4/OGG/WEBM video files: URL must start with <samp class="error">https</samp> or <samp class="error">http</samp> and end with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> (no BBCode needed). Note that browser support and GUI implementation varies.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Копіювати виділений текст',
	'ABBC3_PASTE_BBCODE'		=> 'Вставити скопійований текст',
	'ABBC3_PASTE_ERROR'			=> 'Будь ласка, спочатку скопіюйте текст, а потім вставляйте',
	'ABBC3_PLAIN_BBCODE'		=> 'Очистити виділений текст від BB-коду',
	'ABBC3_NOSELECT_ERROR'		=> 'Будь ласка, спочатку виділіть текст.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Вставити повідомлення',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Приклад',
	'ABBC3_BBVIDEO_SITES'		=> 'Дозволені сайти',
	'ABBC3_URL_LINK'			=> 'Додати URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Додатковий опис',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

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
	'ABBC3_BBCODE_ORDERED'		=> 'Порядок BB-кодів змінено.',
	'ABBC3_BBCODE_GROUP'		=> 'Групи, котрі можуть використовувати BB-код',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Якщо група вибрана, то всі її користувачі можуть використовувати BB-код. Використовуйте CTRL+CLICK (або CMD+CLICK на Mac) для того, щоб вибрати кілька груп.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Example:</strong><br>%2$s<br><br><strong>Result:</strong><br>%3$s<hr />',
));
