<?php
/** 
*
* abbcode [Turkish]
* @package language
* @version $Id: abbcode.php, v 1.0.6 2008/01/10 15:25:07 leviatan21 Exp $
* @turkish version $Id: $ phpBB 3.0.0 - 1.0.0
* @copyright leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb2/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* @translator: muiketi
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
	'BBCODE_STYLES_TIP'			=> 'Kullaným: Stiller kolayca seçili metinlere uygulanýr',
	
	// Dorpdown titles options
	'ABBCODE_FONT_TYPE'			=> 'Yazý tipi',
	'ABBCODE_FONT_SIZE'			=> 'Yazý boyutu',
	'ABBCODE_FONT_HILI'			=> 'Yazý artalaný',
	'ABBCODE_FONT_GIANT'		=> 'Yazý büyüklüðü',
	
	// Text to be applied to the helpline & mouseover 
	'ABBCODE_JUSTIFY_MOVER'		=> 'Ýki yana yasla',
	'ABBCODE_JUSTIFY_HELP'		=> ' [align=justify]metin[/align]',

	'ABBCODE_RIGHT_MOVER'		=> 'Saða dayalý',
	'ABBCODE_RIGHT_HELP'		=> ' [align=right]metin[/align]',

	'ABBCODE_CENTER_MOVER'		=> 'Ortalanmýþ',
	'ABBCODE_CENTER_HELP'		=> ' [align=center]metin[/align]',

	'ABBCODE_LEFT_MOVER'		=> 'Sola dayalý',
	'ABBCODE_LEFT_HELP'			=> ' [align=left]metin[/align]',

	'ABBCODE_PRE_MOVER'			=> 'Biçimlendirilmemiþ metin',
	'ABBCODE_PRE_HELP'			=> ' [pre]metin[/pre]',

	'ABBCODE_SUP_MOVER'			=> 'Yazýyý üst-indis olarak ayarla',
	'ABBCODE_SUP_HELP'			=> ' [sup]metin[/sup]',

	'ABBCODE_SUB_MOVER'			=> 'Yazýyý alt-indis olarak ayarla',
	'ABBCODE_SUB_HELP'			=> ' [sub]metin[/sub]',

	'ABBCODE_BOLD_MOVER'		=> 'Kalýn yazý',
	'ABBCODE_BOLD_HELP'			=> ' [b]metin[/b]',

	'ABBCODE_ITA_MOVER'			=> 'Eðik yazý',
	'ABBCODE_ITA_HELP'			=> ' [i]metin[/i]',

	'ABBCODE_UNDER_MOVER'		=> 'Altý çizili yazý',
	'ABBCODE_UNDER_HELP'		=> ' [u]metin[/u]',

	'ABBCODE_STRIKE_MOVER'		=> 'Üstü çizili yazý',
	'ABBCODE_STRIKE_HELP'		=> ' [s]metin[/s]',

	'ABBCODE_FADE_MOVER'		=> 'Soluklaþan yazý',
	'ABBCODE_FADE_HELP'			=> ' [fade]metin[/fade]',

	'ABBCODE_GRAD_MOVER'		=> 'Rengarenk yazý',
	'ABBCODE_GRAD_HELP'			=> ' [grad]metin[/grad]',

	'ABBCODE_RTL_MOVER'			=> 'Saðdan sola okunan yazý',
	'ABBCODE_RTL_HELP'			=> ' [dir=rtl]metin[/dir]',

	'ABBCODE_LTR_MOVER'			=> 'Soldan saða okunan yazý',
	'ABBCODE_LTR_HELP'			=> ' [dir=LTR]metin[/dir]',

	'ABBCODE_MARQD_MOVER'		=> 'Aþaðý kayan yazý',
	'ABBCODE_MARQD_HELP'		=> ' [marq=down]metin[/marq]',

	'ABBCODE_MARQU_MOVER'		=> 'Yukarý kayan yazý',
	'ABBCODE_MARQU_HELP'		=> ' [marq=up]metin[/marq]',

	'ABBCODE_MARQR_MOVER'		=> 'Saða kayan yazý',
	'ABBCODE_MARQR_HELP'		=> ' [marq=right]metin[/marq]',

	'ABBCODE_MARQL_MOVER'		=> 'Sola kayan yazý',
	'ABBCODE_MARQL_HELP'		=> ' [marq=left]metin[/marq]',

	'ABBCODE_TABLE_MOVER'		=> 'Tablo giriniz',
	'ABBCODE_TABLE_HELP'		=> ' [table=(ccs style)][tr=(ccs style)][td=(ccs style)]metin[/td][/tr][/table]',

	'ABBCODE_QUOTE_MOVER'		=> 'Alýntý',
	'ABBCODE_QUOTE_HELP'		=> ' [quote]metin[/quote] veya [quote=\"member\"]metin[/quote]',

	'ABBCODE_CODE_MOVER'		=> 'Kod',
	'ABBCODE_CODE_HELP'			=> ' [code]kod[/code]',

	'ABBCODE_SPOIL_MOVER'		=> 'Gizli içerik',
	'ABBCODE_SPOIL_HELP'		=> ' [spoil]metin[/spoil]',

	'ABBCODE_ED2K_MOVER'		=> 'eD2K linki',
	'ABBCODE_ED2K_HELP'			=> ' [url]ed2k linki[/url] veya [url=link ed2k]ed2k görüntülenecek isim[/url]',

	'ABBCODE_URL_MOVER'			=> 'Web adresi',	
	'ABBCODE_URL_HELP'			=> ' [url]http://...[/url] veya [url=http://...]Görüntülenecek isim[/url]',

	'ABBCODE_EMAIL_MOVER'		=> 'Email',
	'ABBCODE_EMAIL_HELP'		=> ' [email]user@server.ext[/email] veya [email=user@server.ext]user[/email]',

	'ABBCODE_WEB_MOVER'			=> 'Ýletide gösterilecek site',
	'ABBCODE_WEB_HELP'			=> ' [web]URL web[/web]',

	'ABBCODE_IMG_MOVER'			=> 'Resim ekle',
	'ABBCODE_IMG_HELP'			=> ' [img]http://...[/img]',

	'ABBCODE_THUMB_MOVER'		=> 'Insert thumbnail',
	'ABBCODE_THUMB_HELP'		=> ' [thumbnail(=left|right)]http://...[/thumbnail]',
	
	'ABBCODE_IMGSHARK_MOVER'	=> 'Resim ekle dosyasýnýn imageshack',
	'ABBCODE_IMGSHARK_HELP'		=> ' [url=http://imageshack.us][img=http://...][/img][/url]',

	'ABBCODE_FLASH_MOVER'		=> 'Flash dosyasý ekle',
	'ABBCODE_FLASH_HELP'		=> ' [flash width=# height=#]Flash dosyasýnýn adresi[/flash]',

	'ABBCODE_VIDEO_MOVER'		=> 'Video ekle',
	'ABBCODE_VIDEO_HELP'		=> ' [video width=# height=#]Video dosyasýnýn adresi[/video]',

	'ABBCODE_STREAM_MOVER'		=> 'Ses ekle',
	'ABBCODE_STREAM_HELP'		=> ' [stream]Ses dosyasýnýn adresi[/stream]',

	'ABBCODE_RAM_MOVER'			=> 'Real Media dosyasý ekle',
	'ABBCODE_RAM_HELP'			=> ' [ram]Real Media dosyasýnýn adresi[/ram]',

	'ABBCODE_QUICKTIME_MOVER'	=> 'Insert Quick time',
	'ABBCODE_QUICKTIME_HELP'	=> ' [quicktime width=# height=#]URL Quick time[/quicktime]',

	'ABBCODE_STAGE6_MOVER'		=> 'Stage6 dan video ekle', // from http://www.stage6.com/
	'ABBCODE_STAGE6_HELP'		=> ' [stage6]Stage6 ID[/stage6]',

	'ABBCODE_GVIDEO_MOVER'		=> 'Google videosu ekle',
	'ABBCODE_GVIDEO_HELP'		=> ' [GVideo]Video dosyasýnýn adresi[/GVideo]',

	'ABBCODE_YOUTUBE_MOVER'		=> 'Youtube videosu ekle',
	'ABBCODE_YOUTUBE_HELP'		=> ' [youtube]Video dosyasýnýn adresi[/youtube]',

	'ABBCODE_LISTB_MOVER'		=> 'Sýrasýz liste',
	'ABBCODE_LISTB_HELP'		=> ' [list]metin[/list] Not [*] kullanarak yeni liste öðesi oluþturabilirsiniz',

	'ABBCODE_LISTM_MOVER'		=> 'Sýralý liste',
	'ABBCODE_LISTM_HELP'		=> ' [list=1|a]metin[/list] Not [*] kullanarak yeni liste öðesi oluþturabilirsiniz',

	'ABBCODE_HR_MOVER'			=> 'Yatay çizgi',
	'ABBCODE_HR_HELP'			=> ' [hr] Not: Metni ayýrmak için yatay bir çizgi oluþturur',

	'ABBCODE_TEXTC_MOVER'		=> 'Yazý rengi',
	'ABBCODE_TEXTC_HELP'		=> ' [color=red]metin[/color] Not: Renk deðerini color=#FF0000 veya color=red olrak belirtebilirsiniz',

	'ABBCODE_TEXTS_MOVER'		=> 'Yazý boyutu',
	'ABBCODE_TEXTS_HELP'		=> ' [size=300]Yazý [/size] Not: Deðerleryüzde cinsinden alýnacaktýr',

	'ABBCODE_TEXTF_MOVER'		=> 'Yazý tipi',
	'ABBCODE_TEXTF_HELP'		=> ' [font=Tahoma]metin[/font]',

	'ABBCODE_TEXTH_MOVER'		=> 'Yazý artalaný',
	'ABBCODE_TEXTH_HELP'		=> ' [highlight=red]metin[/highlight] Not: Renk deðerini color=#FF0000 veya color=red olrak belirtebilirsiniz',

	'ABBCODE_CUT_MOVER'			=> 'Seçili metni sil',
	'ABBCODE_COPY_MOVER'		=> 'Seçili metni kopyala',
	'ABBCODE_PASTE_MOVER'		=> 'Kopyalanan metni yapýþtýr',
	'ABBCODE_PLAIN_MOVER'		=> 'Seçili metindeki BBCodelarý kaldýr',
	'ABBCODE_PASTE_ERROR'		=> 'Please, first copy a text, them paste it ',
	'ABBCODE_NOSELECT_ERROR'	=> 'Please, first select the text ',

	// Wizard texts
	'ABBCODE_ERROR'				=> 'Hata : ',
	'ABBCODE_ERROR_TAG'			=> 'Kod kullanýmýnda beklenmeyen hata : ',
	
	'ABBCODE_ID'				=> 'Tanýmlayýcý giriniz :',
	'ABBCODE_NOID'				=> 'Tanýmlayýcýyý belirtmediniz ',
	'ABBCODE_LINK'				=> 'Linki giriniz ',
	'ABBCODE_DESC'				=> 'Link açýklamasýný giriniz ',
	'ABBCODE_NAME'				=> 'Açýklama',
	'ABBCODE_NOLINK'			=> 'Link belirtmediniz ',
	'ABBCODE_NODESC'			=> 'Herhangi bir açýklama belirtmediniz ',
	'ABBCODE_WIDTH'				=> 'Geniþliði giriniz',
	'ABBCODE_WIDTH_NOTE'		=> 'Not: Yüzde cinsinden deðer belirtebilirsiniz',
	'ABBCODE_NOWIDTH'			=> 'Geniþliði belirtmediniz',
	'ABBCODE_HEIGHT'			=> 'Yüksekliði giriniz',
	'ABBCODE_HEIGHT_NOTE'		=> 'Not: Yüzde cinsinden deðer belirtebilirsiniz',
	'ABBCODE_NOHEIGHT'			=> 'Yüksekliði belirtmediniz',
	
	'ABBCODE_ED2K_TAG'			=> 'ed2k',
	'ABBCODE_ED2K_NOTE' 		=> '', //'Örnek: ed2k://|file|Robin.Hood.S02E01.Sisterhood.HDTV.XviD-BiA.avi|367335424|6EB031138DE4A80997A13C272760202F|h=CJZXHKH25ZONIMWVUOENVQKJSZDV5JI6|/',

	'ABBCODE_URL_TAG'			=> 'sayfa',
	'ABBCODE_URL_NOTE' 			=> 'Örnek: http://www.google.com',

	'ABBCODE_WEB_TAG'			=> 'web',
	'ABBCODE_WEB_NOTE'			=> 'Örnek: http://www.google.com',

	'ABBCODE_EMAIL_TAG'			=> 'email',
	'ABBCODE_EMAIL_NOTE' 		=> 'Örnek: user@server.ext',

	'ABBCODE_IMG_TAG'			=> 'resim',
	'ABBCODE_IMG_NOTE'			=> 'Örnek: http://www.google.com/intl/en_com/images/logo_plain.png',

	'ABBCODE_THUMB_TAG'			=> 'thumbnail',
	'ABBCODE_THUMB_NOTE'		=> 'Örnek: http://www.google.com/intl/en_com/images/logo_plain.png',
	
	'ABBCODE_FLASH_TAG'			=> 'flash',
	'ABBCODE_FLASH_NOTE'		=> 'Örnek: http://www.adobe.com/support/flash/ts/documents/test_version/version.swf',

	'ABBCODE_VIDEO_TAG'			=> 'video',
	'ABBCODE_VIDEO_NOTE'		=> '', //'Örnek: ???',

	'ABBCODE_STREAM_TAG'		=> 'ses',
	'ABBCODE_STREAM_NOTE'		=> '', //'Örnek: ???',

	'ABBCODE_RAM_TAG'			=> 'Real Media',
	'ABBCODE_RAM_NOTE'			=> '', //'Örnek: ???',

	'ABBCODE_QUICKTIME_TAG'		=> 'Quick time',
	'ABBCODE_QUICKTIME_NOTE'	=> 'Örnek: http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt' . '<br/>' .'http://www.carnivalmidways.com/images/Music/thisisatest.mp3',

	'ABBCODE_STAGE6_TAG'		=> 'Stage6 Video',
	'ABBCODE_STAGE6_NOTE'		=> 'Örnek: 2068715',

	'ABBCODE_GVIDEO_TAG'		=> 'Google Video',
	'ABBCODE_GVIDEO_NOTE'		=> 'Örnek: http://video.google.com/videoplay?docid=-8351924403384451128',

	'ABBCODE_YOUTUBE_TAG'		=> 'Youtube Video',
	'ABBCODE_YOUTUBE_NOTE'		=> 'Örnek: http://www.youtube.com/watch?v=aabbcc12',

	'ABBCODE_TABLE_STYLE'		=> 'Tablo stili' . '\n\n',
	'ABBCODE_TABLE_NOTE'		=> 'Örnek: width:50%;border:1px solid #cccccc;',
	'ABBCODE_ROW_NUMBER'		=> 'Satýr sayýsý',
	'ABBCODE_ROW_ERROR'			=> 'Satýr sayýsý belirtmediniz',
	'ABBCODE_ROW_STYLE'			=> 'Satýr stili',
	'ABBCODE_ROW_NOTE'			=> 'Örnek: text-align:center;',
	'ABBCODE_CELL_NUMBER'		=> 'Hücre sayýsý',
	'ABBCODE_CELL_ERROR'		=> 'Hücre sayýsý belirtmediniz',
	'ABBCODE_CELL_STYLE'		=> 'Hücre stili',
	'ABBCODE_CELL_NOTE'			=> 'Örnek: border:1px solid #cccccc;',

	'ABBCODE_GRAD_MIN_ERROR'	=> 'Lütfen önce metni seçiniz : ',
	'ABBCODE_GRAD_MAX_ERROR'	=> 'Sadece 120 karakter ve altý : ',
	
	'SPOILER_SHOW'				=> 'Ýçeriði Göster',
	'SPOILER_HIDE'				=> 'Ýçeriði Gizle',
	
	// Custom bbcodes

));

?>