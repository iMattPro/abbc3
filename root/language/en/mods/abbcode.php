<?php
/** 
*
* abbcode [English]
* @package language
* @version $Id: abbcode.php, v 1.0.1 2008/01/10 14:55:07 leviatan21 Exp $
* @English version version $Id: $ phpBB 3.0.0 - 1.0.0
* @copyright leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb2/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* @translator: RATT - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=201958
* @translator: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
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
* ้ - รฉ
* ่ - รจ
* ๊ - รช
* ๋ - รซ
* เ - ร
* โ - รข
* ไ - รค
* ๎ - รฎ
* ๏ - รฏ
* ๒ - รฒ
* ๔ - รด
* ๙ - รน
* ๛ - รป
* ็ - รง
* แ = รก
* ม = ร  XX
* ้ = รฉ
* ษ = ร XX
* ํ = รญ
* อ = ร?
* ๓ = รณ
* ำ = ร“
* ๚ = รบ
* ฺ = ร
* ๑ = รฑ
* ั = ร‘
* ? = ยฟ
********************************************************************/

$lang = array_merge($lang, array(
	'BBCODE_STYLES_TIP'			=> 'Tip: Styles can be applied quickly to selected text.',
	
	// Dorpdown titles options
	'ABBCODE_FONT_TYPE'				=> 'Font type ',
	'ABBCODE_FONT_SIZE'				=> 'Font size',
	'ABBCODE_FONT_HILI'				=> 'Highlighted',
	'ABBCODE_FONT_GIANT'			=> 'Giant',
	
	// Text to be applied to the helpline & mouseover 
	'ABBCODE_JUSTIFY_MOVER'			=> 'Text justified',
	'ABBCODE_JUSTIFY_HELP'			=> ' [align=justify]text[/align]',
	'ABBCODE_RIGHT_MOVER'			=> 'Text right aligned',
	'ABBCODE_RIGHT_HELP'			=> ' [align=right]text[/align]',
	'ABBCODE_CENTER_MOVER'			=> 'Text aligned to the centre',
	'ABBCODE_CENTER_HELP'			=> ' [align=center]text[/align]',
	'ABBCODE_LEFT_MOVER'			=> 'Text left aligned',
	'ABBCODE_LEFT_HELP'				=> ' [align=left]text[/align]',
	'ABBCODE_PRE_MOVER'				=> 'Text preformatted',
	'ABBCODE_PRE_HELP'				=> ' [pre]text[/pre]',
	'ABBCODE_SUP_MOVER'				=> 'Sets the text as superscripts',
	'ABBCODE_SUP_HELP'				=> ' [sup]text[/sup]',
	'ABBCODE_SUB_MOVER'				=> 'Sets the text as subscripts',
	'ABBCODE_SUB_HELP'				=> ' [sub]text[/sub]',
	'ABBCODE_BOLD_MOVER'			=> 'Text in bold',
	'ABBCODE_BOLD_HELP'				=> ' [b]text[/b]',
	'ABBCODE_ITA_MOVER'				=> 'Text in italics',
	'ABBCODE_ITA_HELP'				=> ' [i]text[/i]',
	'ABBCODE_UNDER_MOVER'			=> 'Text underlined',
	'ABBCODE_UNDER_HELP'			=> ' [u]text[/u]',
	'ABBCODE_STRIKE_MOVER'			=> 'Text strikethrough',
	'ABBCODE_STRIKE_HELP'			=> ' [s]text[/s]',
	'ABBCODE_FADE_MOVER'			=> 'Text fadein fadeout',
	'ABBCODE_FADE_HELP'				=> ' [fade]text[/fade]',
	'ABBCODE_GRAD_MOVER'			=> 'Text gradient',
	'ABBCODE_GRAD_HELP'				=> ' [grad]text[/grad]',
	'ABBCODE_RTL_MOVER'				=> 'Text with reading right-to-left',
	'ABBCODE_RTL_HELP'				=> ' [dir=rtl]text[/dir]',
	'ABBCODE_LTR_MOVER'				=> 'Text with reading left-to-right',
	'ABBCODE_LTR_HELP'				=> ' [dir=LTR]text[/dir]',
	'ABBCODE_MARQD_MOVER'			=> 'Scrolling text down',
	'ABBCODE_MARQD_HELP'			=> ' [marq=down]text[/marq]',
	'ABBCODE_MARQU_MOVER'			=> 'Scrolling text upwards',
	'ABBCODE_MARQU_HELP'			=> ' [marq=up]text[/marq]',
	'ABBCODE_MARQR_MOVER'			=> 'Displacement text to the right',
	'ABBCODE_MARQR_HELP'			=> ' [marq=right]text[/marq]',
	'ABBCODE_MARQL_MOVER'			=> 'Displacement text to the left',
	'ABBCODE_MARQL_HELP'			=> ' [marq=left]text[/marq]',
	'ABBCODE_TABLE_MOVER'			=> 'Insert a table',
	'ABBCODE_TABLE_HELP'			=> ' [table=(ccs style)][tr=(ccs style)][td=(ccs style)]text[/td][/tr][/table]',
	'ABBCODE_QUOTE_MOVER'			=> 'Quote',
	'ABBCODE_QUOTE_HELP'			=> ' [quote]text[/quote]',
	'ABBCODE_CODE_MOVER'			=> 'Code',
	'ABBCODE_CODE_HELP'				=> ' [code]codigo[/code]',
	'ABBCODE_SPOIL_MOVER'			=> 'Spoiler text',
	'ABBCODE_SPOIL_HELP'			=> ' [spoil]text[/spoil]',
	'ABBCODE_ED2K_MOVER'			=> 'Link eD2K',
	'ABBCODE_ED2K_HELP'				=> ' [url]link ed2k[/url] o [url=link ed2k]Name ed2k[/url]',
	'ABBCODE_URL_MOVER'				=> 'Web address',	
	'ABBCODE_URL_HELP'				=> ' [url]http://...[/url] o [url=http://...]Name Web[/url]',
	'ABBCODE_EMAIL_MOVER'			=> 'Email',
	'ABBCODE_EMAIL_HELP'			=> ' [email]user@server.ext[/email]',
	'ABBCODE_WEB_MOVER'				=> 'Insert site in the post',
	'ABBCODE_WEB_HELP'				=> ' [web]URL web[/web]',
	'ABBCODE_IMG_MOVER'				=> 'Insert image',
	'ABBCODE_IMG_HELP'				=> ' [img]http://...[/img]',
	'ABBCODE_IMGSHARK_MOVER'		=> 'Insert image from imageshack',
	'ABBCODE_IMGSHARK_HELP'			=> ' [url=http://imageshack.us][img=http://...][/img][/url]',
	'ABBCODE_FLASH_MOVER'			=> 'Insert flash file',
	'ABBCODE_FLASH_HELP'			=> ' [flash width=# height=#]URL flash[/flash]',
	'ABBCODE_VIDEO_MOVER'			=> 'Insert video',
	'ABBCODE_VIDEO_HELP'			=> ' [video width=# height=#]URL video[/video]',
	'ABBCODE_STREAM_MOVER'			=> 'Insert sound',
	'ABBCODE_STREAM_HELP'			=> ' [stream]URL stream[/stream]',
	'ABBCODE_RAM_MOVER'				=> 'Insert Real Media',
	'ABBCODE_RAM_HELP'				=> ' [ram]URL Real Media[/ram]',
	'ABBCODE_STAGE_MOVER'			=> 'Insert video from Stage6', // from http://www.stage6.com/
	'ABBCODE_STAGE_HELP'			=> ' [stage6]Stage6 ID[/stage6]',
	'ABBCODE_GVIDEO_MOVER'			=> 'Insert video from Google',
	'ABBCODE_GVIDEO_HELP'			=> ' [GVideo]URL video[/GVideo]',
	'ABBCODE_YOUTUBE_MOVER'			=> 'Insert video from Youtube',
	'ABBCODE_YOUTUBE_HELP'			=> ' [youtube]URL video[/youtube]',
	'ABBCODE_LISTB_MOVER'			=> 'Bullet list',
	'ABBCODE_LISTB_HELP'			=> ' [list]text[/list] Note: Use [*] to create bullets.',
	'ABBCODE_LISTM_MOVER'			=> 'Ordered list',
	'ABBCODE_LISTM_HELP'			=> ' [list=1|a]text[/list] Note: Use [*] to create bullets.',
	'ABBCODE_HR_MOVER'				=> 'Header',
	'ABBCODE_HR_HELP'				=> ' [hr] Note: Creates a header line row to seperate text.',
	'ABBCODE_TEXTC_MOVER'			=> 'Color text',
	'ABBCODE_TEXTC_HELP'			=> ' [color=red]text[/color] Note: You can use html colors color=#FF0000 or color=red.',
	'ABBCODE_TEXTS_MOVER'			=> 'Size text',
	'ABBCODE_TEXTS_HELP'			=> ' [size=300]text giant[/size] Note: The value will be interpreted as a percentage.',
	'ABBCODE_TEXTF_MOVER'			=> 'Font tipe',
	'ABBCODE_TEXTF_HELP'			=> ' [font=Tahoma]text[/font]',
	'ABBCODE_TEXTH_MOVER'			=> 'Text highlighted',
	'ABBCODE_TEXTH_HELP'			=> ' [highlight=red]text[/highlight] Note: You can use html colors color=#FF0000 or color=red.',
	'ABBCODE_CUT_MOVER'				=> 'Removes selected text.',
	'ABBCODE_COPY_MOVER'			=> 'Copy selected text.',
	'ABBCODE_PASTE_MOVER'			=> 'Paste copied text.',
	'ABBCODE_PLAIN_MOVER'			=> 'Remove labels BBCodes the selected text.',

	// Wizard texts
	'ABBCODE_ERROR'					=> 'Error : ',
	'ABBCODE_ERROR_TAG'				=> 'Unexpected Error using tag : ',
	
	'ABBCODE_GRAD_MIN_ERROR'		=> 'Please, first select the text : ',
	'ABBCODE_GRAD_MAX_ERROR'		=> 'Only allows less than 120 characters : ',
	
	'ABBCODE_TABLE_STYLE'			=> 'Enter style table',
	'ABBCODE_TABLE_NOTE'			=> '\n\n' . 'Example:width:50%;border:1px solid #CCCCCC;',
	'ABBCODE_ROW_NUMBER'			=> 'Enter number of rows',
	'ABBCODE_ROW_ERROR'				=> 'You did not write the number of rows',
	'ABBCODE_ROW_STYLE'				=> 'Enter style rows',
	'ABBCODE_ROW_NOTE'				=> '\n\n' . 'Example:border:1px solid #CCCCCC;',
	'ABBCODE_CELL_NUMBER'			=> 'Enter number of cells',
	'ABBCODE_CELL_ERROR'			=> 'You did not write the number of cells.',
	'ABBCODE_CELL_STYLE'			=> 'Enter style cell',
	'ABBCODE_CELL_NOTE'				=> '\n\n' . 'Example:text-align:center;',
	
	'ABBCODE_ID'					=> 'Enter identifier :',
	'ABBCODE_NOID'					=> '\n' . 'You did not write the identifier.',
	'ABBCODE_LINK'					=> 'Enter link :',
	'ABBCODE_DESC'					=> 'Enter a description of the link',
	'ABBCODE_NAME'					=> 'Description',
	'ABBCODE_NOLINK'				=> '\n' . 'You did not write a link.',
	'ABBCODE_NODESC'				=> '\n' . 'You did not write a description.',
	'ABBCODE_WIDTH'					=> 'Enter width :',
	'ABBCODE_WIDTH_NOTE'			=> '\n\n' . 'Note: The value can be expressed as a percentage.',
	'ABBCODE_NOWIDTH'				=> '\n' . 'You did not write the width.',
	'ABBCODE_HEIGHT'				=> 'Enter the height :',
	'ABBCODE_HEIGHT_NOTE'			=> '\n\n' . 'Note: The value can be expressed as a percentage.',
	'ABBCODE_NOHEIGHT'				=> '\n' . 'You did not write the height.',
	
	'ABBCODE_ED2K_TAG'				=> ' ed2k links.',
	'ABBCODE_URL_TAG'				=> ' page.',
	'ABBCODE_WEB_TAG'				=> ' web.',
	'ABBCODE_EMAIL_TAG'				=> ' email.',
	'ABBCODE_IMG_TAG'				=> ' image.',
	'ABBCODE_FLASH_TAG'				=> ' flash.',
	'ABBCODE_VIDEO_TAG'				=> ' video.',
	'ABBCODE_STREAM_TAG'			=> ' sound.',
	'ABBCODE_RAM_TAG'				=> ' Real Media.',
	'ABBCODE_RAM_TAG'				=> ' Stage6.',
	'ABBCODE_GVIDEO_TAG'			=> ' Google Video.',
	'ABBCODE_GVIDEO_NOTE'			=> '\n\n' . 'Example: http://video.google.com/videoplay?docid=-8351924403384451128.',
	'ABBCODE_YOUTUBE_TAG'			=> ' Youtube.',
	'ABBCODE_YOUTUBE_NOTE'			=> '\n\n' . 'Example: http://www.youtube.com/watch?v=aabbcc12.',

	'SPOILER_SHOW'					=> 'Show Spoiler',
	'SPOILER_HIDE'					=> 'Hide Spoiler',

));

?>