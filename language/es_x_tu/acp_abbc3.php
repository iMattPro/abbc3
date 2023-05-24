<?php
/**
*
* Advanced BBCode Box [Spanish - Casual Honorifics]
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Aquí puedes configurar los ajustes para Advanced BBCode Box. Para obtener información sobre cómo personalizar la barra de iconos, visita el <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Añade fuentes de <a href="https://fonts.google.com" target="_blank">Google Fonts</a> al BBCode <samp>font</samp>. Utiliza la ortografía exacta y la distinción entre mayúsculas y minúsculas. Coloca cada nombre de fuente en una línea separada. Por ejemplo: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Tenga en cuenta que “Permitir el uso de las redes de distribución de contenidos de terceros” debe estar habilitado en "Configuración de carga" para usar esta función.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_PIPES'				=> 'Habilitar el complemento de tablas de Pipe (tubo)',
	'ABBC3_PIPES_EXPLAIN'		=> 'El complemento de tabla de tubo permite a los usuarios crear tablas en sus mensajes y mensajes privados utilizando la sintaxis markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Habilitar la barra de iconos de BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Esto mostrará la barra de herramientas BBCode basada en iconos de ABBC3. Desactiva esto para mostrar los botones BBCode predeterminados de phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Habilitar BBCodes en Respuesta rápida',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Esto añade los botones BBCode a Respuesta rápida.',
	'ABBC3_ICONS_TYPE'			=> 'Formato de imagen de la barra de iconos',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Selecciona el formato de imagen que se utilizará para los iconos de ABBC3. Ten en cuenta que solo puedes elegir un formato para todos tus iconos.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra de iconos de BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Añadidos',
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Install the optional phpBB Media Embed extension to access settings and management options for embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extension is not installed. <a href="https://www.phpbb.com/customise/db/extension/mediaembed/" target="_blank">Download <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
		1	=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
