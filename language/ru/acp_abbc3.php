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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Здесь можно изменить настройки расширения «Advanced [BBCode] Box».',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Добавьте <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> в BBCode <samp class="error">[font]</samp>. Используйте точное написание и учитывайте регистр. Поместите каждое имя шрифта на отдельной строке.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Чтобы использовать эту функцию, в разделе «Загрузить настройки» необходимо включить «Разрешить использование сторонних сетей доставки контента».',
	'ABBC3_FONT_SEARCH'	=> 'Поиск в Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Загрузка названий шрифтов…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Подходящие шрифты не найдены.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Каталог шрифтов недоступен. Введите названия вручную.',
	'ABBC3_SAVE_FONTS'	=> 'Сохранить шрифты',
	'ABBC3_FONTS_CHECKING'	=> 'Проверка и сохранение шрифтов…',
	'ABBC3_FONTS_SAVED'	=> 'Шрифты сохранены.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Редактор панели инструментов',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Перетаскивайте кнопки между группами «Основные», «Ещё» и «Скрытые». Выберите кнопку, чтобы настроить её. Значок Font Awesome заменяет изображение. Чтобы показать имя ББ-кода, оставьте кнопку без изображения.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Основные',
	'ABBC3_TOOLBAR_MORE'	=> 'Ещё',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Скрытые',
	'ABBC3_FONT_ICON'	=> 'Значок Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Значок-изображение',
	'ABBC3_ICON_NONE'	=> 'Без значка (показывать текст)',
	'ABBC3_PLACEMENT'	=> 'Расположение',
	'ABBC3_TOOLBAR_DISABLED'	=> 'Панель значков ББ-кодов отключена. Вы можете менять её раскладку, и она будет применена при повторном включении панели.',
	'ABBC3_LIVE_PREVIEW'	=> 'Предпросмотр в реальном времени',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Сохранение…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Сохранено',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Не удалось сохранить изменения.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Повторить',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Для изменения настроек Advanced [BBCode] Box требуется JavaScript.',
	'ABBC3_DRAG_BUTTON'	=> 'Перетащить %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo и Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Недопустимое имя шрифта для «%s»',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Не удалось проверить шрифт Google «%s». Проверьте соединение с сервером и повторите попытку.',
	'ABBC3_PIPES'				=> 'Включить плагин таблиц',
	'ABBC3_PIPES_EXPLAIN'		=> 'Плагин таблиц позволяет пользователям добавлять в свои сообщения на форуме, а так же в личные сообщения таблицы, используя соответствующий синтаксис.',
	'ABBC3_BBCODE_BAR'			=> 'Включить панель с иконками ББ-кодами',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Эта настройка включает панель ББ-кодов со значками. Отключите её, чтобы отображались стандартные кнопки ББ-кодов phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Включить ББ-коды в «Быстром ответе»',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Эта опция добавить панель с иконками ББ-кодов в форму «Быстрый ответ».',
	'ABBC3_ICONS_TYPE'			=> 'Формат иконок на панели с иконками',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Выберите формат изображений для значков ББ-кодов. Дополнительные значки в формате SVG или PNG можно загрузить в каталог <samp class="error">/images/abbc3/icons/</samp> вашего форума.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Панель ББ-кодов',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Дополнения',
	'ABBC3_AUTO_VIDEO'			=> 'Включить плагин автоматического видео',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Этот плагин преобразует URL-адреса видеофайлов в виде простого текста в воспроизводимые видео. Преобразовываются только URL-адреса, начинающиеся с <samp class="error">http://</samp> или <samp class="error">https://</samp> и заканчивающиеся на <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> или <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Установите дополнительное расширение phpBB Media Embed, чтобы получить доступ к настройкам и параметрам управления встроенным мультимедийным контентом.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Расширение phpBB Media Embed не установлено. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Расширение phpBB Media Embed установлено. Настройки доступны на вкладке Публикация.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
