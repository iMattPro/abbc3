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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Тук можете да конфигурирате настройките за Advanced BBCode Box. За информация относно персонализирането на лентата с икони посетете %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Добавете <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> към <samp class="error">[font]</samp> BBCode. Използвайте точен правопис и чувствителност към главни и малки букви. Поставете всяко име на шрифт на отделен ред.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '„Разрешаване на използване на мрежи за доставка на съдържание на трети страни“ трябва да бъде активирано под „Зареждане на настройки“, за да използвате тази функция.',
	'ABBC3_INVALID_FONT'		=> 'Невалидно име на шрифта за „%s“',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Шрифтът на Google „%s“ не може да бъде потвърден. Проверете връзката със сървъра и опитайте отново.',
	'ABBC3_PIPES'				=> 'Активиране на приставката Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Добавката Pipe Table позволява на потребителите да създават таблици в своите публикации и лични съобщения, като използват синтаксис за маркиране.',
	'ABBC3_BBCODE_BAR'			=> 'Активирайте лентата с икони на BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Това ще покаже базираната на икони BBCode лента с инструменти на ABBC3. Деактивирайте това, за да се показват бутоните за BBCode по подразбиране на phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Активирайте BBCodes в Бърз отговор',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Това ще добави бутони BBCode към Бърз отговор.',
	'ABBC3_ICONS_TYPE'			=> 'Формат на изображението на лентата с икони',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Изберете формата на изображението, който да използвате за иконите на ABBC3. Имайте предвид, че можете да изберете само един формат за всички ваши икони.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Лента с икони на BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Добавки',
	'ABBC3_AUTO_VIDEO'			=> 'Активиране на Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Този плъгин преобразува URL адресите на видео файлове с обикновен текст във видеоклипове, които могат да се възпроизвеждат. Преобразуват се само URL адреси, започващи с <samp class="error">http://</samp> или <samp class="error">https://</samp> и завършващи с <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> или <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Инсталирайте незадължителното разширение phpBB Media Embed за достъп до настройките и опциите за управление на вграденото мултимедийно съдържание.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'Разширението phpBB Media Embed не е инсталирано. %2$s.',
		1	=> 'Разширението phpBB Media Embed е инсталирано. Настройките са достъпни в раздела Публикуване.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
