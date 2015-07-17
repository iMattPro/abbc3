<?php
/**
*
* Advanced BBCode Box [Spanish]
*
* @copyright (c) 2013 Matt Friedman
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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Contenido Oculto',
	'ABBC3_HIDDEN_OFF'			=> 'Contenido oculto (para miembros solamente)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Este foro requiere que este registrado e identificado para ver el contenido oculto.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Mostrar Spoiler',
	'ABBC3_SPOILER_HIDE'		=> '▼ Ocultar Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Menú de fuentes',
	'ABBC3_FONT_FANCY'			=> 'Fuentes Fantasía',
	'ABBC3_FONT_SAFE'			=> 'Fuentes Seguras',
	'ABBC3_FONT_WIN'			=> 'Fuentes Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Alinear texto: [align=center|left|right|justify]texto[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Incrustar cualquier URL de sitios web de videos: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Texto esfumado: [blur=color]texto[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Dirección del texto: [dir=ltr|rtl]texto[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Texto con sombra: [dropshadow=color]texto[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Texto descolorido: [fade]texto[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Flotador texto: [float=left|right]texto[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Tipo de fuente: [font=Comic Sans MS]texto[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Texto con resplandor: [glow=color]texto[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ocultar texto para invitados: [hidden]texto[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Texto resaltado: [highlight=yellow]texto[/highlight]  Tip: puede usar código de color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Texto marquesina: [marq=up|down|left|right]texto[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Texto de alerta: [mod=username]texto[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Texto NFO ASCII: [nfo]NFO texto[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Texto Off Topic: [offtopic]texto[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Texto preformateado: [pre]texto[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Texto sombreado: [shadow=color]texto[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Ocultar texto: [spoil]texto[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Texto tachado: [s]texto[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Texto subíndice: [sub]texto[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Texto superíndice: [sup]texto[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Vídeo de YouTube: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Copiar el texto seleccionado',
	'ABBC3_PASTE_BBCODE'		=> 'Pegar el texto seleccionado',
	'ABBC3_PASTE_ERROR'			=> 'Primero debe copiar un texto seleccionado, a continuación, péguelo',
	'ABBC3_PLAIN_BBCODE'		=> 'Quitar todas las etiquetas BBCode del texto seleccionado',
	'ABBC3_NOSELECT_ERROR'		=> 'No hay texto seleccionado.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Insertar en el mensaje',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Ejemplo',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideo sitios permitidos',
	'ABBC3_BBVIDEO_LINK'		=> 'URL del video',
	'ABBC3_BBVIDEO_SIZE'		=> 'Ancho x Altura Vídeo',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Presets Tamaño',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Añadir una URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Descripción opcional',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'El orden de los BBCodes ha sido resincronizado.',
	'ABBC3_BBCODE_GROUP'		=> 'Gestionar grupos que pueden utilizar este BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Si ningún grupo es selecionado todos los usuarios podrán utilizar este BBCode.<br />Para selecionar (o eliminar la seleción) de multiples grupos simultaneamente, pulse CTRL+CLICK (o CMD-CLICK en Mac) sobre los grupos deseados. Si usted olvida mantener pulsada la tecla CTRL/CMD cuando hace clic en un grupo de usuarios, toda seleción previa sera eliminada.',
));
