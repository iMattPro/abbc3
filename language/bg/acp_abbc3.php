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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Тук можете да конфигурирате настройките за Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Добавете <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> към <samp class="error">[font]</samp> BBCode. Използвайте точен правопис и чувствителност към главни и малки букви. Поставете всяко име на шрифт на отделен ред.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '„Разрешаване на използване на мрежи за доставка на съдържание на трети страни“ трябва да бъде активирано под „Зареждане на настройки“, за да използвате тази функция.',
	'ABBC3_FONT_SEARCH'	=> 'Търсене в Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Имената на шрифтовете се зареждат…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Няма съвпадащи шрифтове.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Каталогът с шрифтове е недостъпен. Въведете имената ръчно.',
	'ABBC3_SAVE_FONTS'	=> 'Запазване на шрифтовете',
	'ABBC3_FONTS_CHECKING'	=> 'Проверка и запазване на шрифтовете…',
	'ABBC3_FONTS_SAVED'	=> 'Шрифтовете са запазени.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Редактор на лентата с инструменти',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Плъзнете бутоните между „Основни“, „Още“ и „Скрити“. Изберете бутон, за да го настроите. Иконата от Font Awesome заменя изображението. Без изображение се показва името на BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Основни',
	'ABBC3_TOOLBAR_MORE'	=> 'Още',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Скрити',
	'ABBC3_FONT_ICON'	=> 'Икона от Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Икона от изображение',
	'ABBC3_ICON_NONE'	=> 'Без икона (текст)',
	'ABBC3_PLACEMENT'	=> 'Позиция',
	'ABBC3_TOOLBAR_DISABLED'	=> 'Лентата с икони за BBCode е изключена. Можете да редактирате подредбата ѝ, която ще се използва при повторно включване.',
	'ABBC3_LIVE_PREVIEW'	=> 'Преглед в реално време',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Запазване…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Запазено',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Промените не можаха да бъдат запазени.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Повторен опит',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'За промяна на настройките на Advanced [BBCode] Box е необходим JavaScript.',
	'ABBC3_DRAG_BUTTON'	=> 'Плъзнете %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo и Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Невалидно име на шрифта за „%s“',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Шрифтът на Google „%s“ не може да бъде потвърден. Проверете връзката със сървъра и опитайте отново.',
	'ABBC3_PIPES'				=> 'Активиране на приставката Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Добавката Pipe Table позволява на потребителите да създават таблици в своите публикации и лични съобщения, като използват синтаксис за маркиране.',
	'ABBC3_BBCODE_BAR'			=> 'Активирайте лентата с икони на BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Тази настройка показва лента с инструменти за BBCode с икони. Изключете я, за да се показват стандартните бутони за BBCode на phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Активирайте BBCodes в Бърз отговор',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Това ще добави бутони BBCode към Бърз отговор.',
	'ABBC3_ICONS_TYPE'			=> 'Формат на изображението на лентата с икони',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Изберете файловия формат за иконите на BBCode. Можете да качите допълнителни икони във формат SVG или PNG в директорията <samp class="error">/images/abbc3/icons/</samp> на форума.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Лента с икони на BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Добавки',
	'ABBC3_AUTO_VIDEO'			=> 'Активиране на Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Този плъгин преобразува URL адресите на видео файлове с обикновен текст във видеоклипове, които могат да се възпроизвеждат. Преобразуват се само URL адреси, започващи с <samp class="error">http://</samp> или <samp class="error">https://</samp> и завършващи с <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> или <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Инсталирайте незадължителното разширение phpBB Media Embed за достъп до настройките и опциите за управление на вграденото мултимедийно съдържание.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Разширението phpBB Media Embed не е инсталирано. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Разширението phpBB Media Embed е инсталирано. Настройките са достъпни в раздела Публикуване.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
