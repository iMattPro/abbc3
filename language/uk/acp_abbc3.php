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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Тут ви можете налаштувати параметри Advanced BBCode Box. Щоб отримати інформацію про налаштування панелі піктограм, відвідайте %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Додайте <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> до BBCode <samp class="error">[font]</samp>. Використовуйте точне написання та чутливість до регістру. Розмістіть назву кожного шрифту в окремому рядку.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Щоб використовувати цю функцію, у розділі «Завантажити налаштування» потрібно ввімкнути «Дозволити використання сторонніх мереж доставки контенту».',
	'ABBC3_INVALID_FONT'		=> 'Недійсна назва шрифту для «%s»',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Не вдалося перевірити шрифт Google «%s». Перевірте підключення до сервера та повторіть спробу.',
	'ABBC3_PIPES'				=> 'Увімкнути плагін Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Плагін Pipe Table дозволяє користувачам створювати таблиці у своїх публікаціях і особистих повідомленнях за допомогою синтаксису markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Увімкнути панель значків BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Це відобразить панель інструментів BBCode ABBC3 на основі значків. Вимкніть це, щоб відображати стандартні кнопки BBCode phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Увімкнути BBCodes у швидкій відповіді',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Це додасть кнопки BBCode до швидкої відповіді.',
	'ABBC3_ICONS_TYPE'			=> 'Формат зображення панелі значків',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Виберіть формат зображення для піктограм ABBC3. Зауважте, що ви можете вибрати лише один формат для всіх ваших значків.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Панель значків BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Додатки',
	'ABBC3_AUTO_VIDEO'			=> 'Увімкнути Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Цей плагін перетворює URL-адреси простих текстових відеофайлів у відео, які можна відтворити. Перетворюються лише URL-адреси, що починаються з <samp class="error">http://</samp> або <samp class="error">https://</samp> і закінчуються на <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> або <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Встановіть додаткове розширення phpBB Media Embed, щоб отримати доступ до налаштувань і параметрів керування для вбудованого мультимедійного вмісту.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Розширення phpBB Media Embed не встановлено. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Розширення phpBB Media Embed встановлено. Налаштування доступні на вкладці Публікація.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
