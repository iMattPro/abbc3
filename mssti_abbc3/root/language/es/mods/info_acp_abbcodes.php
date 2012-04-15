<?php
/**
*
* info_acp_abbcodes [Spanish]
*
* @package language
* @copyright (c) 2012 MSSTI Advanced BBCodes Box 3 by VSE (Matt Friedman) and leviatan21 (Gabriel)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @translator: leviatan21
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
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	// These lines are the same as in root/language/en/acp/common.php
	'ACP_ABBCODES'				=> 'Advanced BBCode Box 3',
	'ACP_ABBC3_SETTINGS'		=> 'Configurar ABBC3',
	'ACP_ABBC3_BBCODES'			=> 'Componentes ABBC3',
	'LOG_CONFIG_ABBCODES'		=> '<strong>Modificado: configuración de ABBC3</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>Error al guardar la configuración de ABBC3</strong>',

	// UCP settings
	'UCP_ABBCODES'					=> 'Advanced BBCode Box 3',
	'UCP_ABBC3_SETTINGS'			=> 'Interfaz del editor BBCode de mensajes',
	'UCP_ABBC3_SETTINGS_EXPLAIN'	=> 'Note que en modo <i>Limitado</i>, no todos los BBCodes estarán disponibles y deberá escribirlos a mano.',
	'UCP_ABBC3_LIMITED'				=> 'Limitado - Solamente BBCodes básicos sin íconos',
	'UCP_ABBC3_COMPACT'				=> 'Compacto - Todos los BBCodes en un compacto menú desplegable',
	'UCP_ABBC3_STANDARD'			=> 'Estándar - Barra de BBCodes completa',

	// ABBC3 settings page
	'ABBCODES_SETINGS'					=> 'ABBC3 Configuración',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'Aquí puede ajustar los parámetros por defecto para <strong>ABBC3</strong>, Habilitar o deshabilitar, y entre otras opciones de ajustar los valores por defecto para el fondo.',

	'ABBCODES_VERSION_CHECK'			=> 'Verificar versión',
	'ABBCODES_CURRENT_VERSION'			=> 'Versión actual',
	'ABBCODES_LATEST_VERSION'			=> 'Última versión',
	'ABBCODES_DOWNLOAD_LATEST'			=> 'Descargar',

	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'Habilitar o deshabilitar <strong>Advanced BBCode Box 3</strong> a usuarios, y/o usar la botonera por defecto de phpbb3.',
	'ABBCODES_BG'						=> 'Imagen de fondo',
	'ABBCODES_BG_EXPLAIN'				=> 'Aquí puede cambiar la imagen de fondo para la barra de iconos.<br />Utilice <em>No hay imágenes</em> para ajustar a su estilo.',
	'ABBCODES_TAB'						=> 'Mostrar la división entre etiquetas',
	'ABBCODES_BOXRESIZE'				=> 'Redimensionar el area de texto',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'Mostrar los botones para cambiar el tamaño de el area de texto.',
	'ABBCODES_UCP_MODE'					=> 'PCU Opciones',
	'ABBCODES_UCP_MODE_EXPLAIN'			=> 'Permitir a los usuarios seleccionar su propio modo del editor, eligiendo entre la botonera de phpBB3, ABBC3 “Vista Completa” o en “Vista Compacta”',

	'ABBCODES_WIZARD'					=> 'Asistente',
	'ABBCODES_WIZARD_SIZE'				=> 'Dimensiones del asistente',
	'ABBCODES_WIZARD_SIZE_EXPLAIN'		=> 'Alto y ancho de la ventana para el sistente emergente.',
	'ABBCODES_WIZARD_MODE'				=> 'Elija el modo del asistentes',
##	For translators :								Don't			Yes
	'ABBCODES_WIZARD_SELECTOR'			=> array(	'0'			=> 'Deshabilitar asistentes',
													'1'			=> 'En ventana emergente',
													'2'			=> 'En página'),

	'ABBCODES_RESIZER'					=> 'Redimensionar Imágenes',
	'ABBCODES_RESIZE'					=> 'Cambiar el tamaño de imágenes grandes',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'Esto corrige el error de la etiqueta [img] cuando alguien publica una imagen que supera el ancho de su foro.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Nota:</strong> <em>AdvancedBox JS</em> es una aplicación JavaScript usada para visualizar imágenes en tamaño completo.<br />También puede utilizar <strong>ABBC3</strong> con cualquiera de los otras aplicaciones incluídas<br />Estas modificaciones son totalmente opcionales. Cada script tiene su propio soporte. Yo no soy responsable de ello. No voy a responder preguntas/problemas/errores o cualquier tipo de cuestiones acerca de ellos.<br />Lamentablemente Internet Explorer no entiende cómo manejar algunas imágenes adjuntas con esas aplicaciones.',
	'ABBCODES_RESIZE_METHOD'			=> 'Método de redimensión',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Seleccione la forma de mostrar las imágenes en tamaño completo, siempre que sea posible.',
	'ABBCODES_RESIZE_BAR'				=> 'Nota sobre redimensión',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Utilizar la barra superior en las imágenes redimensiadas',
##	For translators :								Don't              Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'AdvancedBox JS',
													'HighslideBox'	=> 'Highslide JS',
													'LiteBox'		=> 'Lightbox2 JS',
													'Lightview'		=> 'Lightview JS',
													'Shadowbox'		=> 'Shadowbox JS',
													'pop-up'		=> 'Ventana emergente',
													'enlarge'		=> 'Ampliar',
													'samewindow'	=> 'Misma ventana',
													'newwindow'		=> 'Nueva ventana',
													'none'			=> 'No redimensionar'),

	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> 'El archivo <strong>AdvancedBox.js</strong> no está en la carpeta <em>%1$s</em>',
	'NO_EXIST_EXPLAIN_OTHERS'			=> 'El archivo <strong style="font-size:1.1em;">%1$s versión %2$s</strong>, no está presente en la caprpeta <em>%3$s</em><br />Si desea utilizar %4$s, usted debe descargar primero el/los archivo/s %4$s desde <a href="%5$s" onclick="window.open(this.href);return false;">here</a> y subir <strong style="font-size:1.1em;">%1$s</strong> en el directorio <em>%3$s</em>.',

	'ABBCODES_MAX_IMAGE_WIDTH'			=> 'Ancho máximo de la imagen en píxeles',
	'ABBCODES_MAX_IMAGE_WIDTH_EXPLAIN'	=> 'Cambiar el tamaño de las imágenes si el ancho es superior al establecido aquí.',
	'ABBCODES_MAX_IMAGE_HEIGHT'			=> 'Alto máximo de la imagen en píxeles',
	'ABBCODES_MAX_IMAGE_HEIGHT_EXPLAIN'	=> 'Cambiar el tamaño de las imágenes si el alto es superior al establecido aquí.',
	'ABBCODES_MAX_THUMB_WIDTH'			=> 'Ancho máximo de las miniaruras en píxeles',
	'ABBCODES_MAX_THUMB_WIDTH_EXPLAIN'	=> 'Las miniatura no será superior al ancho establecido aquí.',
	'ABBCODES_RESIZE_SIGNATURE'			=> 'Redimensionar imágenes grandes en firmas',
	'ABBCODES_RESIZE_SIGNATURE_EXPLAIN'	=> 'También ajustar el tamaño de las imágenes grandes en firmas?',
	'ABBCODES_SIG_IMAGE_WIDTH'			=> 'Ancho máximo de imágenes en firmas, de pixel',
	'ABBCODES_SIG_IMAGE_WIDTH_EXPLAIN'	=> 'Las imagenes de las firmas serán redimensionadas si se excede del ancho establecido aquí.',
	'ABBCODES_SIG_IMAGE_HEIGHT'			=> 'Alto máximo de imágenes en firmas, de pixel',
	'ABBCODES_SIG_IMAGE_HEIGHT_EXPLAIN'	=> 'Las imagenes de las firmas serán redimensionadas si se excede del alto establecido aquí.',

	'ABBCODES_VIDEO_ERROR'				=> '<strong>Error:</strong> Hay demasiados BBvideos seleccionados. Anule la selección de algunos BBvideos y vuelva a intentarlo.',
	'ABBCODES_VIDEO_SIZE'				=> 'Dimensiones de videos',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'Por defecto la anchura y la altura de videos.<br />Standard: 425 x 350. Widescreen: 560 x 340.',
	'ABBCODES_VIDEO_ALLOWED'			=> 'Tipos de vídeo permitidos',
	'ABBCODES_VIDEO_ALLOWED_EXPLAIN'	=> 'Seleccione los sitios y/o formatos de vídeo que le gustaría que los usuarios puedan integrar en sus mensajes cuando el BBCode BBvideo está habilitado <em class="error">(*)</em>',
	'ABBCODES_VIDEO_ALLOWED_NOTE'		=> '<em class="error">(*)</em> Para selecionar (o eliminar la seleción) de multiples items, debe hacer CTRL+CLICK (o CMD-CLICK en Mac) sobre cada item para agregar. Si usted olvida mantener pulsada la tecla CTRL/CMD cuando hace clic en un item, toda seleción previa sera eliminada.',
	'ABBCODES_VIDEO_WMODE'				=> 'Modo transparente',
	'ABBCODES_VIDEO_WMODE_EXPLAIN'		=> 'Establece la variable "wmode" a transparente. Esto sólo es necesario si el foro tiene un objeto en capas estático (como una barra de herramientas de pie de página) y los vídeos incrustados se están representando en la parte superior del objeto estático.',

	'ABBCODES_DESELECT_ALL'				=> 'Desmarcar todo',
	'ABBCODES_SELECT_ALL'				=> 'Seleccionar todo',

	// ABBC3 BBCodes page
	'ABBCODES_CONFIG'					=> 'ABBC3 Componentes',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'Aquí puede configurar el orden de los BBCodes (arrastrar y soltar las filas de la tabla para organizar) y editar las opciones de cada uno de los BBCodes.',

	'ABBCODES_EDIT'						=> 'ABBC3 editar bbcode',
	'ABBCODES_EDIT_EXPLAIN'				=> 'Aquí puede determinar dónde se mostrará o quién puede utilizar y la imagen de cada uno de BBCode.',

	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>Administrar grupos:</strong> Si ningún grupo es selecionado todos los usuarios podrán utilizar este BBCode.<br />Para selecionar (o eliminar la seleción) de multiples grupos simultaneamente, pulse CTRL+CLICK (o CMD-CLICK en Mac) sobre los grupos deseados. Si usted olvida mantener pulsada la tecla CTRL/CMD cuando hace clic en un grupo de usuarios, toda seleción previa sera eliminada.',

	'ABBCODES_TIP'						=> 'Ayuda de etiqueta',
	'ABBCODES_NAME'						=> 'Nombre de etiqueta',
	'ABBCODES_TAG'						=> 'Imagen de etiqueta',
	'ABBCODES_ORDER'					=> 'Orden de etiqueta',
	'ABBCODES_CUSTOM'					=> 'BBCode personalizado',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Salto de línea</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>División</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Añadir nueva División',
	'ABBCODES_ADD_BREAK'				=> 'Añadir nuevo Salto de línea',
	'ABBCODES_SYNC'						=> 'Sincronizar orden',
	'ABBCODES_RESYNC_SUCCESS'			=> 'El orden de los bbcodes ha sido resincronizado.',

	'ABBCODES_COLOUR_MODE'				=> 'Elija el modo de seleccionar colores',
##	For translators :								Don't			Yes
	'ABBCODES_COLOUR_SELECTOR'			=> array(	'phpbb'		=> 'El propio del estilo',
													'dropdown'	=> 'Menú desplegable',
													'fancy'		=> 'Selector de “Fancy”',
													'tigra'		=> 'selector de “Tigra”'),

	'ABBCODES_MOD_DISABLE'				=> '<strong>Advanced BBCode Box 3</strong> está desabilitado.<br />',
	'ABBCODES_STATUS'					=> 'Estado',
	'ABBCODES_ACTIVATED'				=> 'activado',
	'ABBCODES_DEACTIVATED'				=> 'desactivado',

	// UMIL Installer
	// Main
	'INSTALLER_TITLE'					=> 'Advanced BBCode Box 3',
	'INSTALLER_TITLE_EXPLAIN'			=> 'Bienvenido a la instalación de <strong>%1$s</strong>',
	'INSTALLER_INSTALL_WELCOME'			=> 'Si usted elige actualizar ABBC3, cualquier versión previa de este MOD en la base de datos será eliminada.',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Por favor, tenga en cuenta que este proceso podría sobrescribir sus BBCodes personalizados y como resultado, esos BBCodes pueden <strong>no</strong> mostrarse correctamente, en consecuencia de los cambios introducidos por los BBCodes del ABBC3.
											<br />Si usted encuentra este tipo de problemas utilice el <a href="http://www.phpbb.com/support/stk/" title="" onclick="window.open(this.href);return false;">Support Toolkit <em>(STK)</em></a> <strong>Admin tools » Reparse BBCode</strong>.
											<br /><br />Antes de añadir este MOD a su foro, debería hacer una copia de seguridad de los archivos y de la base de datos.',
	// Stages
	'INSTALLER_CONFIGS_ADD'				=> 'ABBC3 configuración',
	'INSTALLER_BBCODES_ADD'				=> 'ABBC3 bbcodes',
	// Misc
	'INSTALLER_RESIZE_CHECK'			=> 'Redimensionar actualización de verificación completa',
	'INSTALLER_BBVIDEO_UPDATER'			=> 'BBvideos have been updated',
));

?>