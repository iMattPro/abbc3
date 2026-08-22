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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Aquí puedes configurar los ajustes para Advanced BBCode Box. Para obtener información sobre cómo personalizar la barra de iconos, visita el %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Añade fuentes de <a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a> al BBCode <samp>font</samp>. Utiliza la ortografía exacta y la distinción entre mayúsculas y minúsculas. Coloca cada nombre de fuente en una línea separada. Por ejemplo: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Tenga en cuenta que “Permitir el uso de las redes de distribución de contenidos de terceros” debe estar habilitado en "Configuración de carga" para usar esta función.',
	'ABBC3_INVALID_FONT'		=> 'Nombre de fuente no válido “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'No se pudo verificar la fuente de Google "%s". Verifique la conexión del servidor e inténtelo nuevamente.',
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
	'ABBC3_AUTO_VIDEO'			=> 'Activar el complemento Auto Video',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Este complemento convierte las URL de archivos de vídeo en texto sin formato en vídeos que se pueden reproducir. Solo se convierten las URL que empiezan por <samp class="error">http://</samp> o <samp class="error">https://</samp> y terminan en <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> o <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Instala la extensión opcional phpBB Media Embed para acceder a la configuración y a las opciones de gestión del contenido multimedia incrustado.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'La extensión phpBB Media Embed no está instalada. %2$s.',
		1	=> 'La extensión phpBB Media Embed está instalada. Puedes acceder a la configuración en la pestaña Mensajes.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
