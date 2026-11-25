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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Aquí puedes configurar los ajustes para Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Añade fuentes de <a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a> al BBCode <samp>font</samp>. Utiliza la ortografía exacta y la distinción entre mayúsculas y minúsculas. Coloca cada nombre de fuente en una línea separada. Por ejemplo: <samp>Droid Sans</samp>',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Tenga en cuenta que “Permitir el uso de las redes de distribución de contenidos de terceros” debe estar habilitado en "Configuración de carga" para usar esta función.',
	'ABBC3_FONT_SEARCH'	=> 'Buscar en Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Cargando nombres de fuentes…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'No hay fuentes que coincidan.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'El catálogo de fuentes no está disponible. Introduce los nombres manualmente.',
	'ABBC3_SAVE_FONTS'	=> 'Guardar fuentes',
	'ABBC3_FONTS_CHECKING'	=> 'Comprobando y guardando fuentes…',
	'ABBC3_FONTS_SAVED'	=> 'Fuentes guardadas.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Editor de la barra de herramientas',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Arrastra los botones entre Principal, Más y Ocultos. Selecciona un botón para personalizarlo. El icono de Font Awesome tiene prioridad sobre la imagen. Si no eliges una imagen, se mostrará el nombre del BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Principal',
	'ABBC3_TOOLBAR_MORE'	=> 'Más',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Ocultos',
	'ABBC3_FONT_ICON'	=> 'Icono de Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Icono de imagen',
	'ABBC3_ICON_NONE'	=> 'Ninguno (usar texto)',
	'ABBC3_PLACEMENT'	=> 'Ubicación',
	'ABBC3_TOOLBAR_DISABLED'	=> 'La barra de iconos BBCode está desactivada. Puedes seguir modificando su diseño y se aplicará al volver a activarla.',
	'ABBC3_LIVE_PREVIEW'	=> 'Vista previa en directo',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Guardando…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Guardado',
	'ABBC3_AUTOSAVE_ERROR'	=> 'No se pudieron guardar los cambios.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Reintentar',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Necesitas JavaScript para cambiar los ajustes de Advanced [BBCode] Box.',
	'ABBC3_DRAG_BUTTON'	=> 'Arrastrar %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo y Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Nombre de fuente no válido “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'No se pudo verificar la fuente de Google "%s". Verifique la conexión del servidor e inténtelo nuevamente.',
	'ABBC3_PIPES'				=> 'Habilitar el complemento de tablas de Pipe (tubo)',
	'ABBC3_PIPES_EXPLAIN'		=> 'El complemento de tabla de tubo permite a los usuarios crear tablas en sus mensajes y mensajes privados utilizando la sintaxis markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Habilitar la barra de iconos de BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Esta opción muestra una barra de herramientas BBCode con iconos. Desactívala para mostrar los botones BBCode predeterminados de phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Habilitar BBCodes en Respuesta rápida',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Esto añade los botones BBCode a Respuesta rápida.',
	'ABBC3_ICONS_TYPE'			=> 'Formato de imagen de la barra de iconos',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Selecciona el formato de imagen para los iconos BBCode. Puedes subir iconos SVG o PNG adicionales al directorio <samp class="error">/images/abbc3/icons/</samp> de tu foro.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra de iconos de BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Añadidos',
	'ABBC3_AUTO_VIDEO'			=> 'Activar el complemento Auto Video',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Este complemento convierte las URL de archivos de vídeo en texto sin formato en vídeos que se pueden reproducir. Solo se convierten las URL que empiezan por <samp class="error">http://</samp> o <samp class="error">https://</samp> y terminan en <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> o <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Instala la extensión opcional phpBB Media Embed para acceder a la configuración y a las opciones de gestión del contenido multimedia incrustado.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'La extensión phpBB Media Embed no está instalada. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'La extensión phpBB Media Embed está instalada. Puedes acceder a la configuración en la pestaña Mensajes.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
