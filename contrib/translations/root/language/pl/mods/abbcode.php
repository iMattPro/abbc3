<?php
/**
*
* abbcode [Polish]
* @package language
* @version $Id: abbcode.php, v 1.0.1 2008/01/10 14:55:07 leviatan21 Exp $
* @polish version $Id: $ phpBB 3.0.0 - 1.0.0
* @copyright leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb2/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @translator Ickam http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=315863
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
* é - Ã©
* è - Ã¨
* ê - Ãª
* ë - Ã«
* à - Ã
* â - Ã¢
* ä - Ã¤
* î - Ã®
* ï - Ã¯
* ò - Ã²
* ô - Ã´
* ù - Ã¹
* û - Ã»
* ç - Ã§
* á = Ã¡
* Á = Ã  XX
* é = Ã©
* É = Ã‰ XX
* í = Ã­
* Í = Ã?
* ó = Ã³
* Ó = Ã“
* ú = Ãº
* Ú = Ãš
* ñ = Ã±
* Ñ = Ã‘
* ? = Â¿
********************************************************************/

$lang = array_merge($lang, array(
	'BBCODE_STYLES_TIP'				=> 'Rada: Style mog? by? szybko stosowane do zaznaczonego tekstu.',
	
	// Dorpdown titles options
	'ABBCODE_FONT_TYPE'				=> 'Czcionka',
	'ABBCODE_FONT_SIZE'				=> 'Rozmiar czcionki',
	'ABBCODE_FONT_HILI'				=> 'Wyró?nienie',
	'ABBCODE_FONT_GIANT'			=> 'Gigantyczna',
	
	// Text to be applied to the helpline & mouseover
	'ABBCODE_JUSTIFY_MOVER'			=> 'Justowanie',
	'ABBCODE_JUSTIFY_HELP'			=> ' [align=justify]tekst[/align]',
	'ABBCODE_RIGHT_MOVER'			=> 'Wyrównanie do prawej',
	'ABBCODE_RIGHT_HELP'			=> ' [align=right]tekst[/align]',
	'ABBCODE_CENTER_MOVER'			=> 'Wyrównanie do ?rodka',
	'ABBCODE_CENTER_HELP'			=> ' [align=center]text[/align]',
	'ABBCODE_LEFT_MOVER'			=> 'Wyrównanie do lewej',
	'ABBCODE_LEFT_HELP'				=> ' [align=left]tekst[/align]',
	'ABBCODE_PRE_MOVER'				=> 'Tekst preformatowany',
	'ABBCODE_PRE_HELP'				=> ' [pre]tekst/pre]',
	'ABBCODE_SUP_MOVER'				=> 'Indeks górny',
	'ABBCODE_SUP_HELP'				=> ' [sup]tekst/sup]',
	'ABBCODE_SUB_MOVER'				=> 'Indeks dolny',
	'ABBCODE_SUB_HELP'				=> ' [sub]tekst/sub]',
	'ABBCODE_BOLD_MOVER'			=> 'Pogrubienie',
	'ABBCODE_BOLD_HELP'				=> ' [b]tekst[/b]',
	'ABBCODE_ITA_MOVER'				=> 'Kursywa',
	'ABBCODE_ITA_HELP'				=> ' [i]tekst/i]',
	'ABBCODE_UNDER_MOVER'			=> 'Podkre?lenie',
	'ABBCODE_UNDER_HELP'			=> ' [u]tekst/u]',
	'ABBCODE_STRIKE_MOVER'			=> 'Przekre?lenie',
	'ABBCODE_STRIKE_HELP'			=> ' [s]tekst[/s]',
	'ABBCODE_FADE_MOVER'			=> 'Znikaj?cy tekst',
	'ABBCODE_FADE_HELP'				=> ' [fade]tekst[/fade]',
	'ABBCODE_GRAD_MOVER'			=> 'Gradient',
	'ABBCODE_GRAD_HELP'				=> ' [grad]tekst[/grad]',
	'ABBCODE_RTL_MOVER'				=> 'Tekst czytany od prawej do lewej',
	'ABBCODE_RTL_HELP'				=> ' [dir=rtl]tekst[/dir]',
	'ABBCODE_LTR_MOVER'				=> 'Tekst czytany od lewej do prawej',
	'ABBCODE_LTR_HELP'				=> ' [dir=LTR]tekst[/dir]',
	'ABBCODE_MARQD_MOVER'			=> 'Tekst przewijaj?cy si? do do?u',
	'ABBCODE_MARQD_HELP'			=> ' [marq=down]tekst[/marq]',
	'ABBCODE_MARQU_MOVER'			=> 'Tekst przewijaj?cy si? do góry',
	'ABBCODE_MARQU_HELP'			=> ' [marq=up]tekst[/marq]',
	'ABBCODE_MARQR_MOVER'			=> 'Tekst "p?yn?cy" do prawej',
	'ABBCODE_MARQR_HELP'			=> ' [marq=right]text[/marq]',
	'ABBCODE_MARQL_MOVER'			=> 'Tekst "p?yn?cy" do lewej',
	'ABBCODE_MARQL_HELP'			=> ' [marq=left]text[/marq]',
	'ABBCODE_TABLE_MOVER'			=> 'Utwórz tabel?',
	'ABBCODE_TABLE_HELP'			=> ' [table=(ccs style)][tr=(ccs style)][td=(ccs style)]text[/td][/tr][/table]',
	'ABBCODE_QUOTE_MOVER'			=> 'Cytat',
	'ABBCODE_QUOTE_HELP'			=> ' [quote]tekst[/quote]',
	'ABBCODE_CODE_MOVER'			=> 'Kod',
	'ABBCODE_CODE_HELP'				=> ' [code]tekst[/code]',
	'ABBCODE_SPOIL_MOVER'			=> 'Tekst ukryty pod przyciskiem',
	'ABBCODE_SPOIL_HELP'			=> ' [spoil]tekst[/spoil]',
	'ABBCODE_ED2K_MOVER'			=> 'Link eD2K',
	'ABBCODE_ED2K_HELP'				=> ' [url]link ed2k[/url] lub [url=link ed2k]tekst adresu[/url]',
	'ABBCODE_URL_MOVER'				=> 'Adres WWW',
	'ABBCODE_URL_HELP'				=> ' [url]http://...[/url] lub [url=http://...]tekst adresu[/url]',
	'ABBCODE_EMAIL_MOVER'			=> 'Email',
	'ABBCODE_EMAIL_HELP'			=> ' [email]user@server.ext[/email]',
	'ABBCODE_WEB_MOVER'				=> 'Wstaw stron? do postu',
	'ABBCODE_WEB_HELP'				=> ' [web]URL web[/web]',
	'ABBCODE_IMG_MOVER'				=> 'Wstaw obraz',
	'ABBCODE_IMG_HELP'				=> ' [img]http://...[/img]',
	'ABBCODE_IMGSHARK_MOVER'		=> 'Wstaw obraz z imageshack',
	'ABBCODE_IMGSHARK_HELP'			=> ' [url=http://imageshack.us][img=http://...][/img][/url]',
	'ABBCODE_FLASH_MOVER'			=> 'Wstaw plik flash',
	'ABBCODE_FLASH_HELP'			=> ' [flash width=# height=#]URL flash[/flash]',
	'ABBCODE_VIDEO_MOVER'			=> 'Wstaw plik video',
	'ABBCODE_VIDEO_HELP'			=> ' [video width=# height=#]URL video[/video]',
	'ABBCODE_STREAM_MOVER'			=> 'Wstaw d?wi?k',
	'ABBCODE_STREAM_HELP'			=> ' [stream]URL stream[/stream]',
	'ABBCODE_RAM_MOVER'				=> 'Wstaw Real Media',
	'ABBCODE_RAM_HELP'				=> ' [ram]URL Real Media[/ram]',
	'ABBCODE_STAGE_MOVER'			=> 'Wstaw plik wideo z Stage6', // from http://www.stage6.com/
	'ABBCODE_STAGE_HELP'			=> ' [stage6]Stage6 ID[/stage6]',
	'ABBCODE_GVIDEO_MOVER'			=> 'Wstaw plik wideo z Google',
	'ABBCODE_GVIDEO_HELP'			=> ' [GVideo]URL video[/GVideo]',
	'ABBCODE_YOUTUBE_MOVER'			=> 'Wstaw plik wideo z Youtube',
	'ABBCODE_YOUTUBE_HELP'			=> ' [youtube]URL video[/youtube]',
	'ABBCODE_LISTB_MOVER'			=> 'Lista punktowana',
	'ABBCODE_LISTB_HELP'			=> ' [list]tekst[/list] Wskazówka: U?yj [*], aby tworzy? punkty.',
	'ABBCODE_LISTM_MOVER'			=> 'Lista numerowana',
	'ABBCODE_LISTM_HELP'			=> ' [list=1|a]tekst[/list] Wskazówka: U?yj [*], aby tworzy? punkty.',
	'ABBCODE_HR_MOVER'				=> 'Linia pozioma',
	'ABBCODE_HR_HELP'				=> ' [hr] Tworzy lini? poziom? dla oddzielenia tekstu.',
	'ABBCODE_TEXTC_MOVER'			=> 'Kolor tekstu',
	'ABBCODE_TEXTC_HELP'			=> ' [color=red]tekst[/color] Wskazówka: mo?esz u?ywa? kolorów w formacie HTML (color=#FF0000) lub color=red.',
	'ABBCODE_TEXTS_MOVER'			=> 'Rozmiar tekstu',
	'ABBCODE_TEXTS_HELP'			=> ' [size=300]Gigantyczny tekst[/size] Wskazówka: Warto?? podana w nawiasie jest interpretowana jako procenty.',
	'ABBCODE_TEXTF_MOVER'			=> 'Nazwa czcionki',
	'ABBCODE_TEXTF_HELP'			=> ' [font=Tahoma]tekst[/font]',
	'ABBCODE_TEXTH_MOVER'			=> 'Wyró?nij',
	'ABBCODE_TEXTH_HELP'			=> ' [highlight=red]text[/highlight] Wskazówka: mo?esz u?ywa? kolorów w formacie HTML (color=#FF0000) lub color=red',
	'ABBCODE_CUT_MOVER'				=> 'Wytnij.',
	'ABBCODE_COPY_MOVER'			=> 'Kopiuj.',
	'ABBCODE_PASTE_MOVER'			=> 'Wklej.',
	'ABBCODE_PLAIN_MOVER'			=> 'Usu? tagi BBCode dla zaznaczonego tekstu.',
	
	// Wizard texts
	'ABBCODE_ERROR'					=> 'B??d : ',
	'ABBCODE_ERROR_TAG'				=> 'Nieoczekiwany b??d przy u?yciu taga : ',

	'ABBCODE_GRAD_MIN_ERROR'		=> 'Prosz? najpierw wybra? tekst : ',
	'ABBCODE_GRAD_MAX_ERROR'		=> 'Dozwolony jest tekst poni?ej 120 znaków : ',
	
	'ABBCODE_TABLE_STYLE'			=> 'Wprowad? dane stylu tabeli',
	'ABBCODE_TABLE_NOTE'			=> '\n\n' . 'Np.:width:50%;border:1px solid #CCCCCC;',
	'ABBCODE_ROW_NUMBER'			=> 'Wprowad? liczb? kolumn',
	'ABBCODE_ROW_ERROR'				=> 'Nie wprowadzi?e? liczby kolumn',
	'ABBCODE_ROW_STYLE'				=> 'Wprowad? dane stylu kolumn',
	'ABBCODE_ROW_NOTE'				=> '\n\n' . 'Np.:border:1px solid #CCCCCC;',
	'ABBCODE_CELL_NUMBER'			=> 'Wprowad? liczb? wierszy',
	'ABBCODE_CELL_ERROR'			=> 'Nie wprowadzi?e? liczby wierszy',
	'ABBCODE_CELL_STYLE'			=> 'Wprowad? styl wierszy',
	'ABBCODE_CELL_NOTE'				=> '\n\n' . 'Np.:text-align:center;',
	
	'ABBCODE_ID'					=> 'Wprowad? identyfikator :',
	'ABBCODE_NOID'					=> '\n' . 'Nie wprowadzi?e? identyfikatora',
	'ABBCODE_LINK'					=> 'Wprowad? link :',
	'ABBCODE_DESC'					=> 'Wprowad? opis linku',
	'ABBCODE_NAME'					=> 'Opis',
	'ABBCODE_NOLINK'				=> '\n' . 'Nie wprowadzi?e? linku.',
	'ABBCODE_NODESC'				=> '\n' . 'Nie wprowadzi?e? opisu.',
	'ABBCODE_WIDTH'					=> 'Wprowad? szeroko?? :',
	'ABBCODE_WIDTH_NOTE'			=> '\n\n' . 'Wskazówka: Warto?? mo?e by? wyra?ona procentowo.',
	'ABBCODE_NOWIDTH'				=> '\n' . 'Nie wprowadzi?e? szeroko?ci.',
	'ABBCODE_HEIGHT'				=> 'Wprowad? wysoko?? :',
	'ABBCODE_HEIGHT_NOTE'			=> '\n\n' . 'Wskazówka: Warto?? mo?e by? wyra?ona procentowo..',
	'ABBCODE_NOHEIGHT'				=> '\n' . 'Nie wprowadzi?e? wysoko?ci',
	
	'ABBCODE_ED2K_TAG'				=> ' ed2k links.',
	'ABBCODE_URL_TAG'				=> ' page.',
	'ABBCODE_WEB_TAG'				=> ' web.',
	'ABBCODE_EMAIL_TAG'				=> ' email.',
	'ABBCODE_IMG_TAG'				=> ' image.',
	'ABBCODE_FLASH_TAG'				=> ' flash.',
	'ABBCODE_VIDEO_TAG'				=> ' video.',
	'ABBCODE_STREAM_TAG'			=> ' sound.',
	'ABBCODE_RAM_TAG'				=> ' Real Media.',
	'ABBCODE_STAGE_TAG'				=> ' Stage6.',
	'ABBCODE_GVIDEO_TAG'			=> ' Google Video.',
	'ABBCODE_GVIDEO_NOTE'			=> '\n\n' . 'Np.: http://video.google.com/videoplay?docid=-8351924403384451128.',
	'ABBCODE_YOUTUBE_TAG'			=> ' Youtube.',
	'ABBCODE_YOUTUBE_NOTE'			=> '\n\n' . 'Np.: http://www.youtube.com/watch?v=aabbcc12.',
	
	'SPOILER_SHOW'					=> 'Poka?',
	'SPOILER_HIDE'					=> 'Ukryj',
	
));
	
?>