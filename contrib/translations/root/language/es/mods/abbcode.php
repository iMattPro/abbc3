<?php
/** 
*
* abbcode [Spanish]
* @package language
* @version $Id: abbcode.php, v 1.0.1 2008/01/10 14:55:07 leviatan21 Exp $
* @Spanish version $Id: $ phpBB 3.0.0 - 1.0.0
* @copyright leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb2/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
* @translator: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
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
	'BBCODE_STYLES_TIP'				=> 'Consejo: Pueden aplicarse estilos rรกpidamente al texto seleccionado',
	
	// Dropdown titles options
	'ABBCODE_FONT_TYPE'				=> 'Tipo de fuente',
	'ABBCODE_FONT_SIZE'				=> 'Tamaรฑo de fuente',
	'ABBCODE_FONT_HILI'				=> 'Resaltado',
	'ABBCODE_FONT_GIANT'			=> 'Gigante',
	
	// Text to be applied to the helpline & mouseover 
	'ABBCODE_JUSTIFY_MOVER'			=> 'Texto justificado',
	'ABBCODE_JUSTIFY_HELP'			=> ' [align=justify]texto[/align]',
	'ABBCODE_RIGHT_MOVER'			=> 'Texto alineado a la derecha',
	'ABBCODE_RIGHT_HELP'			=> ' [align=right]texto[/align]',
	'ABBCODE_CENTER_MOVER'			=> 'Texto alineado al centro',
	'ABBCODE_CENTER_HELP'			=> ' [align=center]texto[/align]',
	'ABBCODE_LEFT_MOVER'			=> 'Texto alineado a la izquierda',
	'ABBCODE_LEFT_HELP'				=> ' [align=left]texto[/align]',
	'ABBCODE_PRE_MOVER'				=> 'Texto preformateado',
	'ABBCODE_PRE_HELP'				=> ' [pre]texto[/pre]',
	'ABBCODE_SUP_MOVER'				=> 'Texto superรญndice',
	'ABBCODE_SUP_HELP'				=> ' [sup]texto[/sup]',
	'ABBCODE_SUB_MOVER'				=> 'Texto subรญndice',
	'ABBCODE_SUB_HELP'				=> ' [sub]texto[/sub]',
	'ABBCODE_BOLD_MOVER'			=> 'Texto en negrita',
	'ABBCODE_BOLD_HELP'				=> ' [b]texto[/b]',
	'ABBCODE_ITA_MOVER'				=> 'Texto en itรกlica',
	'ABBCODE_ITA_HELP'				=> ' [i]texto[/i]',
	'ABBCODE_UNDER_MOVER'			=> 'Texto subrayado',
	'ABBCODE_UNDER_HELP'			=> ' [u]texto[/u]',
	'ABBCODE_STRIKE_MOVER'			=> 'Texto tachado',
	'ABBCODE_STRIKE_HELP'			=> ' [s]texto[/s]',
	'ABBCODE_FADE_MOVER'			=> 'Texto descoloreado',
	'ABBCODE_FADE_HELP'				=> ' [fade]texto[/fade]',
	'ABBCODE_GRAD_MOVER'			=> 'Texto con gradiente',
	'ABBCODE_GRAD_HELP'				=> ' [grad]texto[/grad]',
	'ABBCODE_RTL_MOVER'				=> 'Texto con lectura derecha a izquierda',
	'ABBCODE_RTL_HELP'				=> ' [dir=rtl]texto[/dir]',
	'ABBCODE_LTR_MOVER'				=> 'Texto con lectura izquierda a derecha',
	'ABBCODE_LTR_HELP'				=> ' [dir=LTR]texto[/dir]',
	'ABBCODE_MARQD_MOVER'			=> 'Desplazamiento de texto hacia abajo',
	'ABBCODE_MARQD_HELP'			=> ' [marq=down]texto[/marq]',
	'ABBCODE_MARQU_MOVER'			=> 'Desplazamiento de texto hacia arriba',
	'ABBCODE_MARQU_HELP'			=> ' [marq=up]texto[/marq]',
	'ABBCODE_MARQR_MOVER'			=> 'Desplazamiento de texto hacia la derecha',
	'ABBCODE_MARQR_HELP'			=> ' [marq=right]texto[/marq]',
	'ABBCODE_MARQL_MOVER'			=> 'Desplazamiento de texto hacia la izquierda',
	'ABBCODE_MARQL_HELP'			=> ' [marq=left]texto[/marq]',
	'ABBCODE_TABLE_MOVER'			=> 'Insertar una tabla',
	'ABBCODE_TABLE_HELP'			=> ' [table=(estilo ccs)][tr=(estilo ccs)][td=(estilo ccs)]texto[/td][/tr][/table]',
	'ABBCODE_QUOTE_MOVER'			=> 'Citar',
	'ABBCODE_QUOTE_HELP'			=> ' [quote]texto[/quote]',
	'ABBCODE_CODE_MOVER'			=> 'Codigo',
	'ABBCODE_CODE_HELP'				=> ' [code]codigo[/code]',
	'ABBCODE_SPOIL_MOVER'			=> 'Ocultar texto',
	'ABBCODE_SPOIL_HELP'			=> ' [spoil]texto[/spoil]',
	'ABBCODE_ED2K_MOVER'			=> 'Enlace eD2K',
	'ABBCODE_ED2K_HELP'				=> ' [url]link ed2k[/url] o [url=link ed2k]Nombre ed2k[/url]',
	'ABBCODE_URL_MOVER'				=> 'Direcciรณn web',	
	'ABBCODE_URL_HELP'				=> ' [url]http://...[/url] o [url=http://...]Nombre Web[/url]',
	'ABBCODE_EMAIL_MOVER'			=> 'Correo electrรณnico',
	'ABBCODE_EMAIL_HELP'			=> ' [email]nombre@servidor.ext[/email]',
	'ABBCODE_WEB_MOVER'				=> 'Instar pรกgina web en el mensaje',
	'ABBCODE_WEB_HELP'				=> ' [web]URL pรกgina[/web]',
	'ABBCODE_IMG_MOVER'				=> 'Insertar imagen',
	'ABBCODE_IMG_HELP'				=> ' [img]http://...[/img]',
	'ABBCODE_IMGSHARK_MOVER'		=> 'Insertar imagen desde imageshack',
	'ABBCODE_IMGSHARK_HELP'			=> ' [url=http://imageshack.us][img=http://...][/img][/url]',
	'ABBCODE_FLASH_MOVER'			=> 'Insertar archivo de flash',
	'ABBCODE_FLASH_HELP'			=> ' [flash width=# height=#]URL Archivo[/flash]',
	'ABBCODE_VIDEO_MOVER'			=> 'Insertar video',
	'ABBCODE_VIDEO_HELP'			=> ' [video width=# height=#]URL Archivo[/video]',
	'ABBCODE_STREAM_MOVER'			=> 'Insertar sonido',
	'ABBCODE_STREAM_HELP'			=> ' [stream]URL Archivo[/stream]',
	'ABBCODE_RAM_MOVER'				=> 'Insertar Real Media',
	'ABBCODE_RAM_HELP'				=> ' [ram]URL Archivo[/ram]',
	'ABBCODE_STAGE_MOVER'			=> 'Insertar video desde Stage6', // from http://www.stage6.com/
	'ABBCODE_STAGE_HELP'			=> ' [stage6]Stage6 ID[/stage6]',
	'ABBCODE_GVIDEO_MOVER'			=> 'Insertar video desde Google',
	'ABBCODE_GVIDEO_HELP'			=> ' [GVideo]URL Archivo[/GVideo]',
	'ABBCODE_YOUTUBE_MOVER'			=> 'Insertar video desde Youtube',
	'ABBCODE_YOUTUBE_HELP'			=> ' [youtube]URL Archivo[/youtube]',
	'ABBCODE_LISTB_MOVER'			=> 'Lista Desordenada',
	'ABBCODE_LISTB_HELP'			=> ' [list]texto[/list] Nota: usted puede usar [*] para insertar puntos.',
	'ABBCODE_LISTM_MOVER'			=> 'Lista Ordenada',
	'ABBCODE_LISTM_HELP'			=> ' [list=1|a]texto[/list] Nota: usted puede usar [*] para insertar puntos.',
	'ABBCODE_HR_MOVER'				=> 'Lรญnea separadora',
	'ABBCODE_HR_HELP'				=> ' [hr]',
	'ABBCODE_TEXTC_MOVER'			=> 'Colorear texto [color=red]texto[/color] Usted puede usar colores HTML color=#FF0000',
	'ABBCODE_TEXTC_HELP'			=> ' [color=red]texto[/color] Usted puede usar colores HTML color=#FF0000.',
	'ABBCODE_TEXTS_MOVER'			=> 'Tamaรฑo de texto',
	'ABBCODE_TEXTS_HELP'			=> ' [size=300]texto gigante[/size] Nota: el valor debe ser expresado en porcentaje.',
	'ABBCODE_TEXTF_MOVER'			=> 'Tipo de letra',
	'ABBCODE_TEXTF_HELP'			=> ' [font=Tahoma]texto[/font]',
	'ABBCODE_TEXTH_MOVER'			=> 'Texto resaltado',
	'ABBCODE_TEXTH_HELP'			=> ' [highlight=red]texto[/highlight] Usted puede usar colores HTML color=#FF0000.',
	'ABBCODE_CUT_MOVER'				=> 'Borrar el texto seleccionado.',
	'ABBCODE_COPY_MOVER'			=> 'Copiar el texto seleccionado.',
	'ABBCODE_PASTE_MOVER'			=> 'Pegar el texto copiado.',
	'ABBCODE_PLAIN_MOVER'			=> 'Quitar las etiquetas BBCodes del texto seleccionado.',

	// Wizard texts
	'ABBCODE_ERROR'					=> 'Error : ',
	'ABBCODE_ERROR_TAG'				=> 'Error inesperado al utilizar etiqueta : ',
	
	'ABBCODE_GRAD_MIN_ERROR'		=> 'Por favor, primero seleccione el texto : ',
	'ABBCODE_GRAD_MAX_ERROR'		=> 'Solo se permite un tamaรฑo inferior a 120 caracteres : ',
	
	'ABBCODE_TABLE_STYLE'			=> 'Introduzca estilo de tabla',
	'ABBCODE_TABLE_NOTE'			=> '\n\n' . 'Ejemplo:width:50%;border:1px solid #CCCCCC;',
	'ABBCODE_ROW_NUMBER'			=> 'Introduzca cantidad de filas',
	'ABBCODE_ROW_ERROR'				=> 'Usted no escribiรณ la cantidad de filas.',
	'ABBCODE_ROW_STYLE'				=> 'Introduzca estilo de filas',
	'ABBCODE_ROW_NOTE'				=> '\n\n' . 'Ejemplo:border:1px solid #CCCCCC;',
	'ABBCODE_CELL_NUMBER'			=> 'Introduzca cantidad de columnas',
	'ABBCODE_CELL_ERROR'			=> 'Usted no escribiรณ la cantidad de columnas.',
	'ABBCODE_CELL_STYLE'			=> 'Introduzca estilo de filas',
	'ABBCODE_CELL_NOTE'				=> '\n\n' . 'Ejemplo:text-align:center;',
	
	'ABBCODE_ID'					=> 'Introduzca identificador :',
	'ABBCODE_NOID'					=> '\n' . 'Usted no escribiรณ el identificador.',
	'ABBCODE_LINK'					=> 'Introduzca enlace :',
	'ABBCODE_DESC'					=> 'Introduzca la descripciรณn del enlace',
	'ABBCODE_NAME'					=> 'Descripciรณn',
	'ABBCODE_NOLINK'				=> '\n' . 'Usted no escribiรณ el enlace.',
	'ABBCODE_NODESC'				=> '\n' . 'Usted no escribiรณ la descripciรณn.',
	'ABBCODE_WIDTH'					=> 'Introduzca la anchura :',
	'ABBCODE_WIDTH_NOTE'			=> '\n\n' . 'Nota: el valor puede ser expresado en porcentaje.',
	'ABBCODE_NOWIDTH'				=> '\n' . 'Usted no escribiรณ la anchura.',
	'ABBCODE_HEIGHT'				=> 'Introduzca la altura :',
	'ABBCODE_HEIGHT_NOTE'			=> '\n\n' . 'Nota: el valor puede ser expresado en porcentaje.',
	'ABBCODE_NOHEIGHT'				=> '\n' . 'Usted no escribiรณ la altura.',
	
	'ABBCODE_ED2K_TAG'				=> ' ed2k links.',
	'ABBCODE_URL_TAG'				=> ' pแgina.',
	'ABBCODE_WEB_TAG'				=> ' web.',
	'ABBCODE_EMAIL_TAG'				=> ' correo electrรณnico.',
	'ABBCODE_IMG_TAG'				=> ' imagen.',
	'ABBCODE_FLASH_TAG'				=> ' flash.',
	'ABBCODE_VIDEO_TAG'				=> ' video.',
	'ABBCODE_STREAM_TAG'			=> ' sonido.',
	'ABBCODE_RAM_TAG'				=> ' Real Media.',
	'ABBCODE_STAGE_TAG'				=> ' Stage6.',
	'ABBCODE_GVIDEO_TAG'			=> ' Google Video.',
	'ABBCODE_GVIDEO_NOTE'			=> '\n\n' . 'Ejemplo: http://video.google.com/videoplay?docid=-8351924403384451128.',
	'ABBCODE_YOUTUBE_TAG'			=> ' Youtube.',
	'ABBCODE_YOUTUBE_NOTE'			=> '\n\n' . 'Ejemplo: Ejemplo: http://www.youtube.com/watch?v=aabbcc12.',
	
	'SPOILER_SHOW'					=> 'Ver el Spoiler',
	'SPOILER_HIDE'					=> 'Ocultar el Spoiler',
	
));

?>