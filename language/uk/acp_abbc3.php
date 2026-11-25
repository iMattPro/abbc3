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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Тут ви можете налаштувати параметри Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Додайте <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> до BBCode <samp class="error">[font]</samp>. Використовуйте точне написання та чутливість до регістру. Розмістіть назву кожного шрифту в окремому рядку.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Щоб використовувати цю функцію, у розділі «Завантажити налаштування» потрібно ввімкнути «Дозволити використання сторонніх мереж доставки контенту».',
	'ABBC3_FONT_SEARCH'	=> 'Пошук у Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Завантаження назв шрифтів…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Відповідних шрифтів не знайдено.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Каталог шрифтів недоступний. Введіть назви вручну.',
	'ABBC3_SAVE_FONTS'	=> 'Зберегти шрифти',
	'ABBC3_FONTS_CHECKING'	=> 'Перевірка та збереження шрифтів…',
	'ABBC3_FONTS_SAVED'	=> 'Шрифти збережено.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Редактор панелі інструментів',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Перетягуйте кнопки між групами «Основні», «Більше» та «Приховані». Виберіть кнопку, щоб налаштувати її. Піктограма Font Awesome замінює зображення. Без зображення відображається назва BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Основні',
	'ABBC3_TOOLBAR_MORE'	=> 'Більше',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Приховані',
	'ABBC3_FONT_ICON'	=> 'Піктограма Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Піктограма-зображення',
	'ABBC3_ICON_NONE'	=> 'Немає (використовувати текст)',
	'ABBC3_PLACEMENT'	=> 'Розташування',
	'ABBC3_TOOLBAR_DISABLED'	=> 'Панель піктограм BBCode вимкнено. Ви можете редагувати її компонування, яке буде застосовано після повторного ввімкнення панелі.',
	'ABBC3_LIVE_PREVIEW'	=> 'Попередній перегляд у реальному часі',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Збереження…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Збережено',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Не вдалося зберегти зміни.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Спробувати ще раз',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Для зміни налаштувань Advanced [BBCode] Box потрібен JavaScript.',
	'ABBC3_DRAG_BUTTON'	=> 'Перетягнути %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo та Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Недійсна назва шрифту для «%s»',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Не вдалося перевірити шрифт Google «%s». Перевірте підключення до сервера та повторіть спробу.',
	'ABBC3_PIPES'				=> 'Увімкнути плагін Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Плагін Pipe Table дозволяє користувачам створювати таблиці у своїх публікаціях і особистих повідомленнях за допомогою синтаксису markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Увімкнути панель значків BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Цей параметр показує панель інструментів BBCode з піктограмами. Вимкніть його, щоб показувати стандартні кнопки BBCode у phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Увімкнути BBCodes у швидкій відповіді',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Це додасть кнопки BBCode до швидкої відповіді.',
	'ABBC3_ICONS_TYPE'			=> 'Формат зображення панелі значків',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Виберіть формат зображень для піктограм BBCode. Додаткові піктограми у форматі SVG або PNG можна завантажити до каталогу <samp class="error">/images/abbc3/icons/</samp> вашого форуму.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Панель значків BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Додатки',
	'ABBC3_AUTO_VIDEO'			=> 'Увімкнути Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Цей плагін перетворює URL-адреси простих текстових відеофайлів у відео, які можна відтворити. Перетворюються лише URL-адреси, що починаються з <samp class="error">http://</samp> або <samp class="error">https://</samp> і закінчуються на <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> або <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Встановіть додаткове розширення phpBB Media Embed, щоб отримати доступ до налаштувань і параметрів керування для вбудованого мультимедійного вмісту.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Розширення phpBB Media Embed не встановлено. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Розширення phpBB Media Embed встановлено. Налаштування доступні на вкладці Публікація.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
