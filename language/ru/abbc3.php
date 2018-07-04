<?php
/**
*
* Advanced BBCode Box [Russian]
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
	'ABBC3_HIDDEN_ON'			=> 'Скрытый текст',
	'ABBC3_HIDDEN_OFF'			=> 'Скрытый текст',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Для просмотра скрытого текста необходимо быть авторизованным пользователем.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Показать',
	'ABBC3_SPOILER_HIDE'		=> '▼ Скрыть',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Не по теме',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Шрифт',
	'ABBC3_FONT_FANCY'			=> 'Дополнительные шрифты',
	'ABBC3_FONT_SAFE'			=> 'Стандартные шрифты',
	'ABBC3_FONT_WIN'			=> 'Шрифты Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Выравнивание: [align=center|left|right|justify]текст[/align]  Подсказка: center — по центру, left — по левому краю, right — по правому краю, justify — по ширине',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Видео с сайта: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Размытый текст: [blur=цвет]текст[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Направление текста: [dir=ltr|rtl]текст[/dir]  Подсказка: ltr — слева направо, rtl — справа налево',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Чёткая тень: [dropshadow=цвет]текст[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Мигающий текст: [fade]текст[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Расположение: [float=left|right]текст[/float]  Подсказка: left — слева с обтеканием, right — справа с обтеканием',
	'ABBC3_FONT_HELPLINE'		=> 'Шрифт: [font=Comic Sans MS]текст[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Светящийся текст: [glow=цвет]текст[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Скрытый от гостей текст: [hidden]текст[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Выделение маркером: [highlight=yellow]текст[/highlight]  Подсказка: цвет можно указать в системе RGB — #FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Прокрутка текста: [marq=up|down|left|right]текст[/marq]  Подсказка: up — вверх, down — вниз, left — влево, right — вправо',
	'ABBC3_MOD_HELPLINE'		=> 'Сообщение модератора: [mod=пользователь]текст[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ASCII-арт: [nfo]текст[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Сообщение не по теме: [offtopic]текст[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Предварительно отформатированный текст: [pre]текст[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Размытая тень: [shadow=цвет]текст[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'Музыка с SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Спойлер: [spoil]текст[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Зачёркнутый текст: [s]текст[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Подстрочный текст: [sub]текст[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Надстрочный текст: [sup]текст[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Видео с YouTube: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Копировать выделенный текст',
	'ABBC3_PASTE_BBCODE'		=> 'Вставить скопированный текст',
	'ABBC3_PASTE_ERROR'			=> 'Пожалуйста, сначала скопируйте текст, а потом вставляйте',
	'ABBC3_PLAIN_BBCODE'		=> 'Очистить выделенный текст от BBCode',
	'ABBC3_NOSELECT_ERROR'		=> 'Пожалуйста, сначала выделите текст.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Вставить в сообщение',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Пример',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Разрешённые сайты',
	'ABBC3_BBVIDEO_LINK'		=> 'Ссылка на видео',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Введите URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Дополнительное описание',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Создание таблиц',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Создавайте таблицы, используя любой из доступных ASCII-фарматов.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Руководство',
	'ABBC3_PIPE_SIMPLE'			=> 'Простая таблица',
	'ABBC3_PIPE_COMPACT'		=> 'Компактная таблица',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Внешние границы и отсутпы являются необязательными.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Выравнивание текта',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Порядок BBCode изменён.',
	'ABBC3_BBCODE_GROUP'		=> 'Группы, которые могут использовать BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Если группа выбрана, то все её пользователи могут использовать BBCode. Используйте CTRL+CLICK (или CMD+CLICK на Mac) для выбора нескольких групп.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'В чащах юга жил бы цитрус? Да, но фальшивый экземпляр!',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Пример:</strong><br />%2$s<br /><br /><strong>Результат:</strong><br />%3$s<hr />',
));
