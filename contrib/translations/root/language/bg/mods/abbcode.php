<?php
/** 
*
* abbcode [Bulgarian]
* @package language
* @version $Id: abbcode.php, v 1.0.6 2008/01/10 15:25:07 leviatan21 Exp $
* @English version $Id: $ phpBB 3.0.0 - 1.0.2
* @copyright leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb2/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* @translator: alfa - http://www.boinc-bulgaria.net
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php

/**
* NOTE: Most of the language items are used in javascript
* If you want to use quotes or other chars that need escaped, be sure you escape them double 
* (Especially for ', you must use \\\' instead of \'. For " you only need to use \".
*/

/**
* ******************************************************************
* Some characters you may want to copy&paste:
* ******************************************************************
* й - Г©
* и - ГЁ
* к - ГЄ
* л - Г«
* а - Г
* в - Гў
* д - Г¤
* о - Г®
* п - ГЇ
* т - ГІ
* ф - Гґ
* щ - Г№
* ы - Г»
* з - Г§
* б = ГЎ
* Б = Г  XX
* й = Г©
* Й = Г‰ XX
* н = Г­
* Н = Г?
* у = Гі
* У = Г“
* ъ = Гє
* Ъ = Гљ
* с = Г±
* С = Г‘
* ? = Вї
********************************************************************/

$lang = array_merge($lang, array(
	'BBCODE_STYLES_TIP'			=> 'Съвет: Стиловете може да бъдат приложени към текста бързо.',
	
	// Dropdown titles options
	'ABBCODE_FONT_TYPE'			=> 'Вид шрифт ',
	'ABBCODE_FONT_SIZE'			=> 'Размер на шрифта',
	'ABBCODE_FONT_HILI'			=> 'Маркиран',
	'ABBCODE_FONT_GIANT'		=> 'Огромен',
	
	// Text to be applied to the helpline & mouseover 
	'ABBCODE_JUSTIFY_MOVER'		=> 'Равностранно',
	'ABBCODE_JUSTIFY_HELP'		=> ' [align=justify]текст[/align]',

	'ABBCODE_RIGHT_MOVER'		=> 'Подравни надясно',
	'ABBCODE_RIGHT_HELP'		=> ' [align=right]текст[/align]',
	
	'ABBCODE_CENTER_MOVER'		=> 'Центрирай',
	'ABBCODE_CENTER_HELP'		=> ' [align=center]текст[/align]',
	
	'ABBCODE_LEFT_MOVER'		=> 'Подравни наляво',
	'ABBCODE_LEFT_HELP'			=> ' [align=left]текст[/align]',
	
	'ABBCODE_PRE_MOVER'			=> 'Преформатиран текст',
	'ABBCODE_PRE_HELP'			=> ' [pre]текст[/pre]',
	
	'ABBCODE_SUP_MOVER'			=> 'Нагласи текста като горен индекс',
	'ABBCODE_SUP_HELP'			=> ' [sup]text[/sup]',
	
	'ABBCODE_SUB_MOVER'			=> 'Нагласи текста като долен индекс',
	'ABBCODE_SUB_HELP'			=> ' [sub]text[/sub]',
	
	'ABBCODE_BOLD_MOVER'		=> 'Удебелен',
	'ABBCODE_BOLD_HELP'			=> ' [b]текст[/b]',
	
	'ABBCODE_ITA_MOVER'			=> 'Наклонен',
	'ABBCODE_ITA_HELP'			=> ' [i]текст[/i]',
	
	'ABBCODE_UNDER_MOVER'		=> 'Подчертан',
	'ABBCODE_UNDER_HELP'		=> ' [u]текст[/u]',
	
	'ABBCODE_STRIKE_MOVER'		=> 'Задраскан',
	'ABBCODE_STRIKE_HELP'		=> ' [s]текст[/s]',
	
	'ABBCODE_FADE_MOVER'		=> 'Обезцветен текст',
	'ABBCODE_FADE_HELP'			=> ' [fade]текст[/fade]',
	
	'ABBCODE_GRAD_MOVER'		=> 'Градиент',
	'ABBCODE_GRAD_HELP'			=> ' [grad]текст[/grad]',
	
	'ABBCODE_RTL_MOVER'			=> 'Текст с разчитане от дясно на ляво',
	'ABBCODE_RTL_HELP'			=> ' [dir=rtl]текст[/dir]',
	
	'ABBCODE_LTR_MOVER'			=> 'Текст с разчитане от ляво на дясно',
	'ABBCODE_LTR_HELP'			=> ' [dir=LTR]text[/dir]',
	
	'ABBCODE_MARQD_MOVER'		=> 'Измести надолу',
	'ABBCODE_MARQD_HELP'		=> ' [marq=down]текст[/marq]',
	
	'ABBCODE_MARQU_MOVER'		=> 'Измести нагоре',
	'ABBCODE_MARQU_HELP'		=> ' [marq=up]текст[/marq]',
	
	'ABBCODE_MARQR_MOVER'		=> 'Измести надясно',
	'ABBCODE_MARQR_HELP'		=> ' [marq=right]текст[/marq]',
	
	'ABBCODE_MARQL_MOVER'		=> 'Измести наляво',
	'ABBCODE_MARQL_HELP'		=> ' [marq=left]текст[/marq]',
	
	'ABBCODE_TABLE_MOVER'		=> 'Създай таблица',
	'ABBCODE_TABLE_HELP'		=> ' [table=(ccs стил)][tr=(ccs стил)][td=(ccs стил)]текст[/td][/tr][/table]',
	
	'ABBCODE_QUOTE_MOVER'		=> 'Цитат',
	'ABBCODE_QUOTE_HELP'		=> ' [quote]текст[/quote] или [quote=\"member\"]текст[/quote]',
	
	'ABBCODE_CODE_MOVER'		=> 'Код',
	'ABBCODE_CODE_HELP'			=> ' [code]код[/code]',
	
	'ABBCODE_SPOIL_MOVER'		=> 'Скрит текст',
	'ABBCODE_SPOIL_HELP'		=> ' [spoil]текст[/spoil]',
	
	'ABBCODE_ED2K_MOVER'		=> 'eD2K адрес',
	'ABBCODE_ED2K_HELP'			=> ' [url]ed2k адрес[/url] или [url=ed2k адрес]ed2k име[/url]',
	
	'ABBCODE_URL_MOVER'			=> 'Интернет адрес',	
	'ABBCODE_URL_HELP'			=> ' [url]http://...[/url] или [url=http://...]Име на сайт[/url]',
	
	'ABBCODE_EMAIL_MOVER'		=> 'Email',
	'ABBCODE_EMAIL_HELP'		=> ' [email]потребител@server.com[/email] или [email=потребител@server.com][/email]',
	
	'ABBCODE_WEB_MOVER'			=> 'Въведете сайт в мнението',
	'ABBCODE_WEB_HELP'			=> ' [web]Сайт адрес[/web]',

	'ABBCODE_IMG_MOVER'			=> 'Въведете снимка',
	'ABBCODE_IMG_HELP'			=> ' [img]http://...[/img]',

	'ABBCODE_THUMB_MOVER'		=> 'Въведи миниатюра',
	'ABBCODE_THUMB_HELP'		=> ' [thumbnail(=left|right)]http://...[/thumbnail]',
	
	'ABBCODE_IMGSHARK_MOVER'	=> 'Въведете снимка от imageshack',
	'ABBCODE_IMGSHARK_HELP'		=> ' [url=http://imageshack.us][img=http://...][/img][/url]',
	
	'ABBCODE_FLASH_MOVER'		=> 'Въведете flash файл',
	'ABBCODE_FLASH_HELP'		=> ' [flash width=# height=#]Flash адрес[/flash]',
	
	'ABBCODE_VIDEO_MOVER'		=> 'Въведете виео',
	'ABBCODE_VIDEO_HELP'		=> ' [video width=# height=#]Видео адрес[/video]',
	
	'ABBCODE_STREAM_MOVER'		=> 'Въведете звук',
	'ABBCODE_STREAM_HELP'		=> ' [stream]Stream адрес[/stream]',
	
	'ABBCODE_RAM_MOVER'			=> 'Въведете Real Media',
	'ABBCODE_RAM_HELP'			=> ' [ram]Real Media адрес[/ram]',
	
	'ABBCODE_QUICKTIME_MOVER'	=> 'Въведи Quick time',
	'ABBCODE_QUICKTIME_HELP'	=> ' [quicktime width=# height=#]Quick time адрес[/quicktime]',

	'ABBCODE_STAGE6_MOVER'		=> 'Въведете видео от Stage6', // от http://www.stage6.com/
	'ABBCODE_STAGE6_HELP'		=> ' [stage6]Stage6 ID[/stage6]',
	
	'ABBCODE_GVIDEO_MOVER'		=> 'Въведете видео от Google',
	'ABBCODE_GVIDEO_HELP'		=> ' [GVideo]Видео адрес[/GVideo]',
	
	'ABBCODE_YOUTUBE_MOVER'		=> 'Въведете видео от Youtube',
	'ABBCODE_YOUTUBE_HELP'		=> ' [youtube]Видео адрес[/youtube]',
	
	'ABBCODE_LISTB_MOVER'		=> 'Подредете по точки',
	'ABBCODE_LISTB_HELP'		=> ' [list]текст[/list] Забележка: Използвайте [*] за да създадете точка',
	
	'ABBCODE_LISTM_MOVER'		=> 'Нумериран списък',
	'ABBCODE_LISTM_HELP'		=> ' [list=1|a]текст[/list] Забележка: Използвайте [*] за да създадете точка',
	
	'ABBCODE_HR_MOVER'			=> 'Заглавие',
	'ABBCODE_HR_HELP'			=> ' [hr] Забележка: Създава заглавие от определен текст',
	
	'ABBCODE_TEXTC_MOVER'		=> 'Цветове',
	'ABBCODE_TEXTC_HELP'		=> ' [color=red]текст[/color] Забележка: Може да използвате html цветове color=#FF0000 или color=red',
	
	'ABBCODE_TEXTS_MOVER'		=> 'Размер',
	'ABBCODE_TEXTS_HELP'		=> ' [size=300]огромен текст[/size] Забележка: Въведеното число ще бъде интерпретирано като процент',
	
	'ABBCODE_TEXTF_MOVER'		=> 'Вид шрифт',
	'ABBCODE_TEXTF_HELP'		=> ' [font=Tahoma]текст[/font]',
	
	'ABBCODE_TEXTH_MOVER'		=> 'Маркиран текст',
	'ABBCODE_TEXTH_HELP'		=> ' [highlight=red]текст[/highlight] Забележка: Може да използвате html цветове color=#FF0000 или color=red',
	
	'ABBCODE_CUT_MOVER'			=> 'Премахва избрания текст',
	'ABBCODE_COPY_MOVER'		=> 'Копирва избрания текст',
	'ABBCODE_PASTE_MOVER'		=> 'Залепва избрания текст',
	'ABBCODE_PLAIN_MOVER'		=> 'Премахва BBCode етикетите от избрания текст',
	'ABBCODE_PASTE_ERROR'		=> 'Моля, първо копирайте текст и после го залепете ',
	'ABBCODE_NOSELECT_ERROR'	=> 'Моля, първо изберете текст ',

	// Wizard texts
	'ABBCODE_ERROR'				=> 'Грешка : ',
	'ABBCODE_ERROR_TAG'			=> 'Неочаквана грешка използвайки етикет : ',
	
	'ABBCODE_ID'				=> 'Въведете индентификатор :',
	'ABBCODE_NOID'				=> 'Вие не написахте идентификатор',
	'ABBCODE_LINK'				=> 'Въведете адрес за ',
	'ABBCODE_DESC'				=> 'Въведете описание за ',
	'ABBCODE_NAME'				=> 'Описание',
	'ABBCODE_NOLINK'			=> 'Не написахте адрес за ',
	'ABBCODE_NODESC'			=> 'Не написахте описание за ',
	'ABBCODE_WIDTH'				=> 'Въведете широчина',
	'ABBCODE_WIDTH_NOTE'		=> 'Забележка: Числото може да бъде интерпретирано като процент',
	'ABBCODE_NOWIDTH'			=> 'Не написахте широчината',
	'ABBCODE_HEIGHT'			=> 'Въведете дължина',
	'ABBCODE_HEIGHT_NOTE'		=> 'Забележка: Числото може да бъде интерпретирано като процент',
	'ABBCODE_NOHEIGHT'			=> 'Не написахте широчина',
	
	'ABBCODE_ED2K_TAG'			=> 'ed2k',
	'ABBCODE_ED2K_NOTE' 		=> '', //'Пример: ed2k://|file|Robin.Hood.S02E01.Sisterhood.HDTV.XviD-BiA.avi|367335424|6EB031138DE4A80997A13C272760202F|h=CJZXHKH25ZONIMWVUOENVQKJSZDV5JI6|/',

	'ABBCODE_URL_TAG'			=> 'Страница',
	'ABBCODE_URL_NOTE' 			=> 'Пример: http://www.google.com',

	'ABBCODE_WEB_TAG'			=> 'Сайт',
	'ABBCODE_WEB_NOTE'			=> 'Пример: http://www.google.com',

	'ABBCODE_EMAIL_TAG'			=> 'email',
	'ABBCODE_EMAIL_NOTE' 		=> 'Пример: потребител@server.com',
	
	'ABBCODE_IMG_TAG'			=> 'Снимка',
	'ABBCODE_IMG_NOTE'			=> 'Пример: http://www.google.com/intl/en_com/images/logo_plain.png',
	
	'ABBCODE_THUMB_TAG'			=> 'миниатюра',
	'ABBCODE_THUMB_NOTE'		=> 'Пример: http://www.google.com/intl/en_com/images/logo_plain.png',

	'ABBCODE_FLASH_TAG'			=> 'flash',
	'ABBCODE_FLASH_NOTE'		=> 'Пример: http://www.adobe.com/support/flash/ts/documents/test_version/version.swf',
	
	'ABBCODE_VIDEO_TAG'			=> 'Видео',
	'ABBCODE_VIDEO_NOTE'		=> '', //'Пример: ???',
	
	'ABBCODE_STREAM_TAG'		=> 'Звук',
	'ABBCODE_STREAM_NOTE'		=> '', //'Пример: ???',
	
	'ABBCODE_RAM_TAG'			=> 'Real Media',
	'ABBCODE_RAM_NOTE'			=> '', //'Пример: ???',
	
	'ABBCODE_QUICKTIME_TAG'		=> 'Quick time',
	'ABBCODE_QUICKTIME_NOTE'	=> 'Пример: http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt' . '<br/>' .'http://www.carnivalmidways.com/images/Music/thisisatest.mp3',
	
	'ABBCODE_STAGE6_TAG'		=> 'Stage6 Видео',
	'ABBCODE_STAGE6_NOTE'		=> 'Пример: 2068715',
	
	'ABBCODE_GVIDEO_TAG'		=> 'Google Видео',
	'ABBCODE_GVIDEO_NOTE'		=> 'Пример: http://video.google.com/videoplay?docid=-8351924403384451128',
	
	'ABBCODE_YOUTUBE_TAG'		=> 'Youtube Видео',
	'ABBCODE_YOUTUBE_NOTE'		=> 'Пример: http://www.youtube.com/watch?v=aabbcc12',

	'ABBCODE_TABLE_STYLE'		=> 'Въведете стил на таблица',
	'ABBCODE_TABLE_NOTE'		=> 'Пример: width:50%;border:1px solid #ccccc;',
	'ABBCODE_ROW_NUMBER'		=> 'Въведете номер на редици',
	'ABBCODE_ROW_ERROR'			=> 'Не написахте номер за редици',
	'ABBCODE_ROW_STYLE'			=> 'Въведете стил за редиците',
	'ABBCODE_ROW_NOTE'			=> 'Пример: text-align:center;',
	'ABBCODE_CELL_NUMBER'		=> 'Въведете номер на колонки',
	'ABBCODE_CELL_ERROR'		=> 'Не написахте номер на колонки',
	'ABBCODE_CELL_STYLE'		=> 'Въведете стил за колонките',
	'ABBCODE_CELL_NOTE'			=> 'Пример: border:1px solid #ccccc;',

	'ABBCODE_GRAD_MIN_ERROR'	=> 'Моля, първо изберете текста : ',
	'ABBCODE_GRAD_MAX_ERROR'	=> 'Разрешено е само по-малко от 120 знака : ',
	
	'SPOILER_SHOW'				=> 'Покажи текста',
	'SPOILER_HIDE'				=> 'Скрии текст',
	
	// Custom bbcodes
	
));

?>