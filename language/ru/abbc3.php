<?php
/**
*
* Advanced BBCode Box 3.1 [Russian]
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
	'ABBC3_HIDDEN_ON'			=> 'Скрытие включено',
	'ABBC3_HIDDEN_OFF'			=> 'Скрытие включено (только для юзеров)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Что бы увидеть скрытое сообщение Вам необходимо зарегистрироваться или войти на форум.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '&#9658; Показать спойлер',
	'ABBC3_SPOILER_HIDE'		=> '&#9660; Скрыть спойлер',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Оффтопик',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Меню шрифта',
	'ABBC3_FONT_FANCY'			=> 'Fancy fonts',
	'ABBC3_FONT_SAFE'			=> 'Safe fonts',
	'ABBC3_FONT_WIN'			=> 'Windows fonts',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Выравнивание текста: [align=center|left|right|justify]текст[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Вставить url любого видео: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Размытие текста: [blur=color]текст[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Направление текста: [dir=ltr|rtl]текст[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Текст с жесткой тенью: [dropshadow=color]текст[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Текст мигает / fadeout: [fade]текст[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Плавающий текст: [float=left|right]текст[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Имя шрифта: [font=Comic Sans MS]текст[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Светящиеся текст: [glow=color]текст[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Скрыть текст для гостей: [hidden]текст[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Выделиный текст: [highlight=yellow]текст[/highlight]  Вы можете выбрать цвет=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Плавающий текст: [marq=up|down|left|right]текст[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Предупреждение: [mod=username]текст[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Информация NFO: [nfo]текст[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Оффтоп: [offtopic]текст[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Предварительно отформатированный текст: [pre]текст[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Текст с мягкой тенью: [shadow=color]текст[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Спойлер: [spoil]текст[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Зачеркнутый текст: [s]текст[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Подстрочный: [sub]текст[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Надстрочный: [sup]текст[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube видео: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> ' Копировать выделенный текст',
	'ABBC3_PASTE_BBCODE'		=> ' Вставить скопированный текст ',
	'ABBC3_PASTE_ERROR'			=> ' Вы должны сначала скопировать фрагмент текста, а затем вставить его',
	'ABBC3_PLAIN_BBCODE'		=> ' Удалить все BBCode теги из выделенного текста',
	'ABBC3_NOSELECT_ERROR'		=> 'Текст не был выбран.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Вставить в сообщение',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Пример',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Список видеохостингов',
	'ABBC3_BBVIDEO_LINK'		=> 'Ссылка на видео',
	'ABBC3_BBVIDEO_SIZE'		=> ' Ширина х Высота Видео',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Размер пресетов',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Порядок BBCode был обновлен',
	'ABBC3_BBCODE_GROUP'		=> 'Manage groups that can use this BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Если не выбрано ни одной группы, то все пользователи могут использовать ББкоды.',
));
