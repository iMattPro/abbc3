<?php
/**
*
* abbc3 [Spanish]
*
* @package language
* @copyright (c) 2013 Matt Friedman 
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	// Hidden BBcode
	'ABBC3_HIDDEN_ON'			=> 'Contenido Oculto',
	'ABBC3_HIDDEN_OFF'			=> 'Contenido oculto (para miembros solamente)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Este foro requiere que este registrado e identificado para ver el contenido oculto.',

	// Spoiler BBcode
	'SPOILER_SHOW'				=> '&#9658; Mostrar Spoiler',
	'SPOILER_HIDE'				=> '&#9660; Ocultar Spoiler',

	// Off Topic BBcode
	'OFFTOPIC'					=> 'Off Topic',

	// Font BBcode
	'ABBC3_FONT_BBCODE'			=> 'Menú de fuentes',
	'ABBC3_FONT_FANCY'			=> 'Fuentes Fantasía',
	'ABBC3_FONT_SAFE'			=> 'Fuentes Seguras',
	'ABBC3_FONT_WIN'			=> 'Fuentes Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Alinear texto: [align=center|left|right|justify]texto[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Incrustar cualquier URL de sitios web de videos: [BBvideo=width,height]Video URL[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Texto esfumado: [blur=color]texto[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Dirección del texto: [dir=ltr|rtl]texto[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Texto con sombra: [dropshadow=color]texto[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Texto descolorido: [fade]texto[/fade]',
	'ABBC3_FONT_HELPLINE'		=> 'Tipo de fuente: [font=Comic Sans MS]texto[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Texto con resplandor: [glow=color]texto[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ocultar texto para invitados: [hidden]texto[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Texto resaltado: [highlight=yellow]texto[/highlight]',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Texto marquesina: [marq=up|down|left|right]texto[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Texto de alerta: [mod=username]texto[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Texto NFO ASCII: [nfo]NFO texto[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Texto Off Topic: [offtopic]texto[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Texto preformateado: [pre]texto[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Texto sombreado: [shadow=color]texto[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Ocultar texto: [spoil]texto[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Texto tachado: [s]texto[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Texto subíndice: [sub]texto[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Texto superíndice: [sup]texto[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Vídeo de YouTube: [youtube]URL[/youtube]',

	// Utility BBcodes
	'ABBC3_COPY_BBCODE'			=> 'Copiar el texto seleccionado',
	'ABBC3_PASTE_BBCODE'		=> 'Pegar el texto seleccionado',
	'ABBC3_PASTE_ERROR'			=> 'Primero debe copiar un texto seleccionado, a continuación, péguelo',
	'ABBC3_PLAIN_BBCODE'		=> 'Quitar todas las etiquetas BBCode del texto seleccionado',

	'ABBC3_ERROR'				=> 'Error',
	'ABBC3_NOSELECT_ERROR'		=> 'No hay texto seleccionado.',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'El orden de los BBCodes ha sido resincronizado.',
	'ABBC3_BBCODE_GROUP'		=> 'Gestionar grupos que pueden utilizar este BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Si ningún grupo es selecionado todos los usuarios podrán utilizar este BBCode.<br />Para selecionar (o eliminar la seleción) de multiples grupos simultaneamente, pulse CTRL+CLICK (o CMD-CLICK en Mac) sobre los grupos deseados. Si usted olvida mantener pulsada la tecla CTRL/CMD cuando hace clic en un grupo de usuarios, toda seleción previa sera eliminada.',
));
