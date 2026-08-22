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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Здесь можно изменить настройки расширения «Advanced BBCode Box». Для получения дополнительной информации о настройке панели с иконками, откройте %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Добавьте <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> в BBCode <samp class="error">[font]</samp>. Используйте точное написание и учитывайте регистр. Поместите каждое имя шрифта на отдельной строке.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Чтобы использовать эту функцию, в разделе «Загрузить настройки» необходимо включить «Разрешить использование сторонних сетей доставки контента».',
	'ABBC3_INVALID_FONT'		=> 'Недопустимое имя шрифта для «%s»',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Не удалось проверить шрифт Google «%s». Проверьте соединение с сервером и повторите попытку.',
	'ABBC3_PIPES'				=> 'Включить плагин таблиц',
	'ABBC3_PIPES_EXPLAIN'		=> 'Плагин таблиц позволяет пользователям добавлять в свои сообщения на форуме, а так же в личные сообщения таблицы, используя соответствующий синтаксис.',
	'ABBC3_BBCODE_BAR'			=> 'Включить панель с иконками ББ-кодами',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Эта опция позволяет вам включить панель с иконками ББ-кодов расширения ABBC3. Отключите эту панель для использования панели, установленной в phpBB по умолчанию.',
	'ABBC3_QR_BBCODES'			=> 'Включить ББ-коды в «Быстром ответе»',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Эта опция добавить панель с иконками ББ-кодов в форму «Быстрый ответ».',
	'ABBC3_ICONS_TYPE'			=> 'Формат иконок на панели с иконками',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Выберите формат иконок на панели с иконками ABBC3. Вы можете выбрать только один формат сразу для всех иконок на панели.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Панель ББ-кодов',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Дополнения',
	'ABBC3_AUTO_VIDEO'			=> 'Включить плагин автоматического видео',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Этот плагин преобразует URL-адреса видеофайлов в виде простого текста в воспроизводимые видео. Преобразовываются только URL-адреса, начинающиеся с <samp class="error">http://</samp> или <samp class="error">https://</samp> и заканчивающиеся на <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> или <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Установите дополнительное расширение phpBB Media Embed, чтобы получить доступ к настройкам и параметрам управления встроенным мультимедийным контентом.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'Расширение phpBB Media Embed не установлено. %2$s.',
		1	=> 'Расширение phpBB Media Embed установлено. Настройки доступны на вкладке Публикация.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
