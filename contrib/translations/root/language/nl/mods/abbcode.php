<?php
/**
*
* abbcode [Dutch]
* @package language
* @version $Id: abbcode.php, v 1.0.6 2008/01/10 15:25:07 leviatan21 Exp $
* @Dutch version version $Id: $ phpBB 3.0.0 - 1.0.0
* @copyright leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb2/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @translator: pavabe - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=158257
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
* Ã³ = Ã³
* Ã³ = Ã“
* ú = Ãº
* Ú = Ãš
* ñ = Ã±
* Ñ = Ã‘
* ? = Â¿
********************************************************************/

$lang = array_merge($lang, array(
	'BBCODE_STYLES_TIP'			=> 'Tip: Op de geselecteerde tekst kun je de stijl snel veranderen',
	
	// Dropdown titles options
	'ABBCODE_FONT_TYPE'			=> 'Letter type ',
	'ABBCODE_FONT_SIZE'			=> 'Letter grote',
	'ABBCODE_FONT_HILI'			=> 'Gemarkeerd',
	'ABBCODE_FONT_GIANT'		=> 'Heel groot',
	
	// Text to be applied to the helpline & mouseover
	'ABBCODE_JUSTIFY_MOVER'		=> 'Tekst uitgelijnd',
	'ABBCODE_JUSTIFY_HELP'		=> ' [align=justify]Tekst[/align]',

	'ABBCODE_RIGHT_MOVER'		=> 'Tekst rechts uitgelijnd',
	'ABBCODE_RIGHT_HELP'		=> ' [align=right]Tekst[/align]',

	'ABBCODE_CENTER_MOVER'		=> 'Tekst in het midden uitgelijnd',
	'ABBCODE_CENTER_HELP'		=> ' [align=center]Tekst[/align]',

	'ABBCODE_LEFT_MOVER'		=> 'Tekst links uitgelijnd',
	'ABBCODE_LEFT_HELP'			=> ' [align=left]Tekst[/align]',

	'ABBCODE_PRE_MOVER'			=> 'Tekst vooraf opgemaakt',
	'ABBCODE_PRE_HELP'			=> ' [pre]Tekst[/pre]',

	'ABBCODE_SUP_MOVER'			=> 'Zet de tekst als superscripts',
	'ABBCODE_SUP_HELP'			=> ' [sup]Tekst[/sup]',

	'ABBCODE_SUB_MOVER'			=> 'Zet de tekst als subscripts',
	'ABBCODE_SUB_HELP'			=> ' [sub]Tekst[/sub]',

	'ABBCODE_BOLD_MOVER'		=> 'Vette tekst',
	'ABBCODE_BOLD_HELP'			=> ' [b]Tekst[/b]',

	'ABBCODE_ITA_MOVER'			=> 'Cursieve tekst',
	'ABBCODE_ITA_HELP'			=> ' [i]Tekst[/i]',

	'ABBCODE_UNDER_MOVER'		=> 'Onderstreepte tekst',
	'ABBCODE_UNDER_HELP'		=> ' [u]Tekst[/u]',

	'ABBCODE_STRIKE_MOVER'		=> 'Doorstreepte tekst',
	'ABBCODE_STRIKE_HELP'		=> ' [s]Tekst[/s]',

	'ABBCODE_FADE_MOVER'		=> 'Tekst fadein fadeout',
	'ABBCODE_FADE_HELP'			=> ' [fade]Tekst[/fade]',

	'ABBCODE_GRAD_MOVER'		=> 'Tekst gradiÃ«nt',
	'ABBCODE_GRAD_HELP'			=> ' [grad]Tekst[/grad]',

	'ABBCODE_RTL_MOVER'			=> 'Tekst letters van rechts naar links',
	'ABBCODE_RTL_HELP'			=> ' [dir=rtl]Tekst[/dir]',

	'ABBCODE_LTR_MOVER'			=> 'Tekst letters van links naar rechts',
	'ABBCODE_LTR_HELP'			=> ' [dir=LTR]Tekst[/dir]',

	'ABBCODE_MARQD_MOVER'		=> 'Tekst beweegt van boven naar beneden',
	'ABBCODE_MARQD_HELP'		=> ' [marq=down]Tekst[/marq]',

	'ABBCODE_MARQU_MOVER'		=> 'Tekst beweegt van onder naar boven',
	'ABBCODE_MARQU_HELP'		=> ' [marq=up]Tekst[/marq]',

	'ABBCODE_MARQR_MOVER'		=> 'Tekst beweegt van links naar rechts',
	'ABBCODE_MARQR_HELP'		=> ' [marq=right]Tekst[/marq]',

	'ABBCODE_MARQL_MOVER'		=> 'Tekst beweegt van rechts naar links',
	'ABBCODE_MARQL_HELP'		=> ' [marq=left]Tekst[/marq]',

	'ABBCODE_TABLE_MOVER'		=> 'Voeg een tabel in',
	'ABBCODE_TABLE_HELP'		=> ' [table=(ccs style)][tr=(ccs style)][td=(ccs style)]Tekst[/td][/tr][/table]',

	'ABBCODE_QUOTE_MOVER'		=> 'Citeer tekst',
	'ABBCODE_QUOTE_HELP'		=> ' [quote]Tekst[/quote] of [quote=\"member\"]Tekst[/quote]',

	'ABBCODE_CODE_MOVER'		=> 'Code weergave',
	'ABBCODE_CODE_HELP'			=> ' [code]Tekst[/code]',

	'ABBCODE_SPOIL_MOVER'		=> 'Spoiler tekst',
	'ABBCODE_SPOIL_HELP'		=> ' [spoil]Tekst[/spoil]',

	'ABBCODE_ED2K_MOVER'		=> 'Link eD2K',
	'ABBCODE_ED2K_HELP'			=> ' [url]link ed2k[/url] of [url=link ed2k]Name ed2k[/url]',

	'ABBCODE_URL_MOVER'			=> 'Web adres',
	'ABBCODE_URL_HELP'			=> ' [url]http://...[/url] of [url=http://...]Name Web[/url]',

	'ABBCODE_EMAIL_MOVER'		=> 'Email',
	'ABBCODE_EMAIL_HELP'		=> ' [email]user@server.ext[/email] of [email=user@server.ext]Mijn email[/email]',

	'ABBCODE_WEB_MOVER'			=> 'Voeg een website toe in het bericht',
	'ABBCODE_WEB_HELP'			=> ' [web]URL web[/web]',

	'ABBCODE_IMG_MOVER'			=> 'Voeg een afbeelding toe',
	'ABBCODE_IMG_HELP'			=> ' [img]http://...[/img]',

	'ABBCODE_THUMB_MOVER'		=> 'Voeg een miniatuur toe',
	'ABBCODE_THUMB_HELP'		=> ' [thumbnail(=left|right)]http://...[/thumbnail]',
	
	'ABBCODE_IMGSHARK_MOVER'	=> 'Voeg een afbeelding toe via imageshack',
	'ABBCODE_IMGSHARK_HELP'		=> ' [url=http://imageshack.us][img=http://...][/img][/url]',

	'ABBCODE_FLASH_MOVER'		=> 'Voeg een flash bestand toe',
	'ABBCODE_FLASH_HELP'		=> ' [flash width=# height=#]URL flash[/flash]',

	'ABBCODE_VIDEO_MOVER'		=> 'Voeg een video toe',
	'ABBCODE_VIDEO_HELP'		=> ' [video width=# height=#]URL video[/video]',

	'ABBCODE_STREAM_MOVER'		=> 'Voeg geluid toe',
	'ABBCODE_STREAM_HELP'		=> ' [stream]URL stream[/stream]',

	'ABBCODE_RAM_MOVER'			=> 'Voeg een Real Media toe',
	'ABBCODE_RAM_HELP'			=> ' [ram]URL Real Media[/ram]',

	'ABBCODE_QUICKTIME_MOVER'	=> 'Voeg een Quick time toe',
	'ABBCODE_QUICKTIME_HELP'	=> ' [quicktime width=# height=#]URL Quick time[/quicktime]',
	
	'ABBCODE_STAGE6_MOVER'		=> 'Voeg een video van Stage6 toe', // from http://www.stage6.com/
	'ABBCODE_STAGE6_HELP'		=> ' [stage6]Stage6 ID[/stage6]',

	'ABBCODE_GVIDEO_MOVER'		=> 'Voeg een video van Google toe',
	'ABBCODE_GVIDEO_HELP'		=> ' [GVideo]URL video[/GVideo]',

	'ABBCODE_YOUTUBE_MOVER'		=> 'Voeg een video van Youtube toe',
	'ABBCODE_YOUTUBE_HELP'		=> ' [youtube]URL video[/youtube]',

	'ABBCODE_LISTB_MOVER'		=> 'Lijst punt',
	'ABBCODE_LISTB_HELP'		=> ' [list]Tekst[/list] Tip: Gebruik [*] om dots te creÃ«ren',

	'ABBCODE_LISTM_MOVER'		=> 'Geordende lijst',
	'ABBCODE_LISTM_HELP'		=> ' [list=1]Tekst[/list] Tip: Gebruik [*] om dots te creÃ«ren',

	'ABBCODE_HR_MOVER'			=> 'Lijn',
	'ABBCODE_HR_HELP'			=> ' [hr] Tip: CreÃ«ert een lijn over de breedte',

	'ABBCODE_TEXTC_MOVER'		=> 'Tekst kleur',
	'ABBCODE_TEXTC_HELP'		=> ' [color=red]Tekst[/color] Tip: Je kan ook de html kleur code gebruiken (color=#FF0000 of color=red)',

	'ABBCODE_TEXTS_MOVER'		=> 'Grote van de tekst',
	'ABBCODE_TEXTS_HELP'		=> ' [size=300]Grote tekst[/size] Tip: De invoer is in percentage',

	'ABBCODE_TEXTF_MOVER'		=> 'Letter type',
	'ABBCODE_TEXTF_HELP'		=> ' [font=Tahoma]Tekst[/font]',

	'ABBCODE_TEXTH_MOVER'		=> 'Tekst gemarkeerd',
	'ABBCODE_TEXTH_HELP'		=> ' [highlight=red]Tekst[/highlight] Tip: Je kan ook de html kleur code gebruiken color=#FF0000 of color=red',

	'ABBCODE_CUT_MOVER'			=> 'Verwijderd de geselecteerde tekst',
	'ABBCODE_COPY_MOVER'		=> 'Kopieert de geselecteerde tekst',
	'ABBCODE_PASTE_MOVER'		=> 'Plak de gekopieerde tekst',
	'ABBCODE_PLAIN_MOVER'		=> 'Verwijder de BBCodes van de geselecteerde tekst',
	'ABBCODE_PASTE_ERROR'		=> 'Please, first copy a text, them paste it ',
	'ABBCODE_NOSELECT_ERROR'	=> 'Eerst de tekst selecteren',

	// Wizard Teksts
	'ABBCODE_ERROR'				=> 'Fout : ',
	'ABBCODE_ERROR_TAG'			=> 'Onverwachte fout bij het gebruik van de markering : ',

	'ABBCODE_ID'				=> 'Voer een herkenningsteken in :',
	'ABBCODE_NOID'				=> 'Je hebt geen herkenningsteken ingevoerd',
	'ABBCODE_LINK'				=> 'Voer een link in ',
	'ABBCODE_DESC'				=> 'Voer een omschrijving in van de link in ',
	'ABBCODE_NAME'				=> 'Omschrijving',
	'ABBCODE_NOLINK'			=> 'Je hebt geen link ingevoerd in ',
	'ABBCODE_NODESC'			=> 'Je hebt geen omschrijving ingevoerd in ',
	'ABBCODE_WIDTH'				=> 'Voer de breedte in',
	'ABBCODE_WIDTH_NOTE'		=> 'Tip: De invoer kan als percentage worden ingevoerd',
	'ABBCODE_NOWIDTH'			=> 'Je hebt geen breedte ingevoerd',
	'ABBCODE_HEIGHT'			=> 'Voer de hoogte in',
	'ABBCODE_HEIGHT_NOTE'		=> 'Tip: De invoer kan als percentage worden ingevoerd',
	'ABBCODE_NOHEIGHT'			=> 'Je hebt geen hoogte ingevoerd',

	'ABBCODE_ED2K_TAG'			=> 'ed2k',
	'ABBCODE_ED2K_NOTE' 		=> '', //'Voorbeeld: ed2k://|file|Robin.Hood.S02E01.Sisterhood.HDTV.XviD-BiA.avi|367335424|6EB031138DE4A80997A13C272760202F|h=CJZXHKH25ZONIMWVUOENVQKJSZDV5JI6|/',

	'ABBCODE_URL_TAG'			=> 'pagina',
	'ABBCODE_URL_NOTE' 			=> 'Voorbeeld: http://www.google.com',

	'ABBCODE_WEB_TAG'			=> 'web',
	'ABBCODE_WEB_NOTE'			=> 'Voorbeeld: http://www.google.com',

	'ABBCODE_EMAIL_TAG'			=> 'email',
	'ABBCODE_EMAIL_NOTE' 		=> 'Voorbeeld: user@server.ext',

	'ABBCODE_IMG_TAG'			=> 'afbeelding',
	'ABBCODE_IMG_NOTE'			=> 'Voorbeeld: http://www.google.com/intl/en_com/images/logo_plain.png',

	'ABBCODE_THUMB_TAG'			=> 'miniatuur',
	'ABBCODE_THUMB_NOTE'		=> 'Voorbeeld: http://www.google.com/intl/en_com/images/logo_plain.png',
	
	'ABBCODE_FLASH_TAG'			=> 'flash',
	'ABBCODE_FLASH_NOTE'		=> 'Voorbeeld: http://www.adobe.com/support/flash/ts/documents/test_version/version.swf',

	'ABBCODE_VIDEO_TAG'			=> 'video',
	'ABBCODE_VIDEO_NOTE'		=> '', //'Voorbeeld: ???',

	'ABBCODE_STREAM_TAG'		=> 'geluid',
	'ABBCODE_STREAM_NOTE'		=> '', //'Voorbeeld: ???',

	'ABBCODE_RAM_TAG'			=> 'Real Media',
	'ABBCODE_RAM_NOTE'			=> '', //'Voorbeeld: ???',

	'ABBCODE_QUICKTIME_TAG'		=> 'Quick time',
	'ABBCODE_QUICKTIME_NOTE'	=> 'Voorbeeld: http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt' . '<br/>' .'http://www.carnivalmidways.com/images/Music/thisisatest.mp3',
	
	'ABBCODE_STAGE6_TAG'		=> 'Stage6 Video',
	'ABBCODE_STAGE6_NOTE'		=> 'Voorbeeld: 2068715',

	'ABBCODE_GVIDEO_TAG'		=> 'Google Video',
	'ABBCODE_GVIDEO_NOTE'		=> 'Voorbeeld: http://video.google.com/videoplay?docid=-8351924403384451128',

	'ABBCODE_YOUTUBE_TAG'		=> 'Youtube',
	'ABBCODE_YOUTUBE_NOTE'		=> 'Voorbeeld: http://www.youtube.com/watch?v=aabbcc12',

	'ABBCODE_TABLE_STYLE'		=> 'Voer de stijl in van de tabel',
	'ABBCODE_TABLE_NOTE'		=> 'Voorbeeld: width:50%;border:1px solid #cccccc;',
	'ABBCODE_ROW_NUMBER'		=> 'Voer het aantal rijen in',
	'ABBCODE_ROW_ERROR'			=> 'Je hebt geen aantal rijen ingevoerd',
	'ABBCODE_ROW_STYLE'			=> 'Voer de stijl in van de rijen',
	'ABBCODE_ROW_NOTE'			=> 'Voorbeeld: text-align:center;',
	'ABBCODE_CELL_NUMBER'		=> 'Voer het aantal cellen in',
	'ABBCODE_CELL_ERROR'		=> 'Je hebt geen aantal cellen ingevoerd',
	'ABBCODE_CELL_STYLE'		=> 'Voer de stijl in van de cellen',
	'ABBCODE_CELL_NOTE'			=> 'Voorbeeld: border:1px solid #cccccc;',

	'ABBCODE_GRAD_MIN_ERROR'	=> 'Eerst de tekst selecteren : ',
	'ABBCODE_GRAD_MAX_ERROR'	=> 'Maximaal 120 of minder karakters toegestaan : ',

	'SPOILER_SHOW'				=> 'Toon Spoiler',
	'SPOILER_HIDE'				=> 'Verberg Spoiler',
	
	// Custom bbcodes

));

?>