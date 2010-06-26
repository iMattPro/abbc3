<?php
/**
* @package: phpBB 3.0.7 :: Advanced BBCode box 3 -> root/language/es/mods :: [es][Spanish]
* @version: $Id: acp_abbcode.php, v 3.0.7 2010/03/18 10:03:18 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @translator: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
**/

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

// This lines are the same as root/language/en/acp/common.php
$lang = array_merge($lang, array(
	'ACP_ABBCODES'				=> 'Advanced BBcodes Box 3',
	'ACP_ABBC3_SETTINGS'		=> 'Configurar ABBC3',
	'ACP_ABBC3_BBCODES'			=> 'Componentes ABBC3',
	'LOG_CONFIG_ABBCODES'		=> '<strong>Modificado: configuración de ABBC3</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>Error mientras se guardaba la configuración de ABBC3</strong>',
	'LOG_CONFIG_ADD'			=> '<strong>Añadido: configuración al foro</strong><br />» %s',
	'LOG_DATABASE_SCHEMA'		=> '<strong>Actualizando la estructura de la base de datos</strong><br />» %s',
	'LOG_DELETE_ABBCODES'		=> '<strong>Borrado: MOD ABBC3 de la base de datos</strong>',
));

// abbc3_details
$lang = array_merge($lang, array(
	'ACP_ABBCODES'						=> 'Advanced BBcodes Box 3',

	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'Habilitar o deshabilitar <strong>Advanced BBodes Box 3</strong> a usuarios, y/o usar la botonera por defecto de phpbb3.',
	'ABBCODES_PATH'						=> 'Ruta del script',
	'ABBCODES_PATH_EXPLAIN'				=> 'La ruta dónde está ubicado ABBC3 relativa al nombre de dominio, ej. <samp>styles/abbcode</samp>',
	'ABBCODES_BG'						=> 'Imagen de fondo',
	'ABBCODES_BG_EXPLAIN'				=> 'Aquí puede cambiar la imagen de fondo para la barra de iconos.<br />Utilice <em>No hay imágenes</em> para ajustar a su estilo.',
	'ABBCODES_TAB'						=> 'Mostrar la división entre etiquetas',
	'ABBCODES_BOXRESIZE'				=> 'Redimensionar el area de texto',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'Mostrar los botones para cambiar el tamaño de el area de texto.',

	'ABBCODES_RESIZE'					=> 'Redimensionar imágenes grandes',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'Esto corrige el error de la etiqueta [img] cuando alguien publica una imagen que supera el ancho de su foro.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Nota : </strong> <em>AdvancedBox JS</em> es una aplicación JavaScript usado para visualizar imágenes en tamaño completo.<br />En la carpeta <em>contrib</em> encontrará la manera de utilizar ABBC3 con Highslide JS | LiteBox | GreyBox.<br />Estas modificaciones son totalmente opcionales. Cada script tiene su propio apoyo. Yo no soy responsable de ello. No voy a responder preguntas/problemas/bug o cualquier tipo de cuestiones acerca de ellos.<br />Lamentablemente Internet Explorer no entiende cómo manejar algunas imágenes adjuntas con esas aplicaciones.',
	'ABBCODES_RESIZE_METHOD'			=> 'Método de redimensión',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Seleccione la forma de mostrar las imágenes en tamaño completo, siempre que sea posible.',
	'ABBCODES_RESIZE_BAR'				=> 'Nota sobre redimensión',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Utilizar la barra superior en las imágenes redimensiadas',
##	For translate :                                  Don't              Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'AdvancedBox JS',
													'HighslideBox'	=> 'Highslide Box JS', 
													'LiteBox'		=> 'Lite Box JS', 
													'GreyBox'		=> 'Grey Box JS', 
													'Lightview'		=> 'Light view JS', 
													'Ibox'			=> 'Shadow box with Ibox JS', 
													'PopBox'		=> 'Pop Box JS', 
													'pop-up'		=> 'Ventana emergente', 
													'enlarge'		=> 'Ampliar',
													'samewindow'	=> 'Misma ventana',
													'newwindow'		=> 'Nueva ventana',
													'none'			=> 'No redimensionar'),
	
	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> 'El archivo <strong>AdvancedBox.js</strong> no está en la carpeta <em>%1$s</em>',
	'NO_EXIST_EXPLAIN_OTHERS'			=> 'El archivo <strong>%1$s versión %2$s</strong>, no está presente en la caprpeta <em>%3$s</em><br />Si desea utilizar %4$s, usted debe descargar primero el/los archivo/s %4$s desde <a href="%5$s" onclick="window.open(this.href);return false;">here</a> y subir el/los archivos descargados en el directorio <em>%3$s</em>.',

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

	'ABBCODES_VIDEO_SIZE'				=> 'Dimensiones de videos',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'Por defecto la anchura y la altura de videos.',

	'ABBCODES_UPLOAD_EXTENSION'			=> 'Extensiones disponibles',
	'ABBCODES_UPLOAD_EXTENSION_EXPLAIN'	=> 'Puede añadir/modificar/eliminar formatos permitidos. Separe las extensiones con una coma(,)<br /><strong>Nota : </strong> Estos valores sobreescribirán la configuración de los Adjuntos.',
));

// bbcodes_edit
$lang = array_merge($lang, array(
	'ABBCODES_SETINGS'					=> 'ABBC3 Configuración',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'Aquí puede ajustar los parámetros por defecto para <strong>ABBC3</strong>, Habilitar o deshabilitar, y entre otras opciones de ajustar los valores por defecto para el fondo.',
	
	'ABBCODES_EDIT'						=> 'ABBC3 editar bbcode',
	'ABBCODES_EDIT_EXPLAIN'				=> 'Aquí puede determinar dónde se mostrará o quién puede utilizar y la imagen de cada uno de BBCode.',

	'ABBCODES_CONFIG'					=> 'ABBC3 Componentes',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'En esta esta página puede alterar el orden de las etiquetas o editar los iconos,',
	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>Administrar grupos : </strong>Si ningún grupo es selecionado todos los usuarios podrán utilizar este BBCode.<br />Para selecionar (o eliminar la seleción) de multiples grupos simultaneamente, pulse <em>Ctrl</em> y mientras mantiene pulsada esta tecla haga <em>Clic</em> (o mantenga pulsada <em>Cmd</em> y haga <em>Clic</em> en un Mac) sobre los grupos deseados. Si usted olvida mantener pulsada la tecla <em>Ctrl</em> (<em>Cmd</em> en un Mac) cuando hace clic en un grupo de usuarios, toda seleción previa sera eliminada.',
	
	'ABBCODES_TIP'						=> 'Ayuda de etiqueta',
	'ABBCODES_NAME'						=> 'Nombre de etiqueta',
	'ABBCODES_TAG'						=> 'Imagen de etiqueta',
	'ABBCODES_ORDER'					=> 'Orden de etiqueta',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Salto de línea</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>División</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Añadir nueva División',
	'ABBCODES_ADD_BREAK'				=> 'Añadir nuevo Salto de línea',
	'ABBCODES_SYNC'						=> 'Sincronizar orden',
	'ABBCODES_RESYNC_SUCCESS'			=> 'El orden de los bbcodes ha sido resincronizado.',
	
	'ABBCODES_MOD_DISABLE'				=> '<strong>Advanced BBcodes Box 3</strong> está desabilitado.<br />',
	'ABBCODES_STATUS'					=> 'Estado',
	'ABBCODES_ACTIVATED'				=> 'activado',
	'ABBCODES_DEACTIVATED'				=> 'deactivado',
));

// Installer 
$lang = array_merge($lang, array(
	// Main
	'INSTALLER_TITLE'					=> 'Advanced BBcodes Box 3',
	'INSTALLER_VERSION'					=> ' version : %1$s',

	'INSTALLER_INTRO'					=> 'Página inicial',
	'INSTALLER_INTRO_WELCOME'			=> 'Bienvenido a la instalación de <strong>%1$s</strong>',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Por favor, eliga cual acción quiere realizar.',
	'INSTALLER_INSTALL_MENU'			=> 'Menú',
	'INSTALLER_EXTRA_MENU'				=> 'Extras',

	// Install
	'INSTALLER_INSTALL'					=> 'Instalar',
	'INSTALLER_INSTALL_WELCOME'			=> 'Bienvenido al menú de instalacición de <strong>ABBC3</strong>',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Si usted elige instalar ABBC3, cualquier versión previa de este MOD en la base de datos será eliminada.',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'La instalacición de ABBC3 ha concluido exitosamente.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'La instalacición de ABBC3 <strong>no</strong> ha concluido exitosamente.',
	'INSTALLER_INSTALL_VERSION'			=> 'Instalar la versión: %1$s',
	'INSTALLER_INSTALL_END'				=> 'La instalacición de <strong>%1$s versión : %2$s</strong> ha concluido con éxito. <br /> <p>Ahora usted debería <a href="../index.php">entrar en su foro</a> y verificar que todo trabaja correctamente. <br />¡ No olvide borrar, renombrar o mover el archivo <strong>install_abbc3</strong> !</p>',

	// Update
	'INSTALLER_UPDATE'					=> 'Actualizar',
	'INSTALLER_UPDATE_WELCOME'			=> 'Bienvenido al menú de actualización de <strong>ABBC3</strong>',
	'INSTALLER_UPDATE_WELCOME_NOTE'		=> 'Si usted elige actualizar ABBC3, cualquier versión previa de este MOD en la base de datos será eliminada.',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'La actualización de ABBC3 ha concluido con éxito.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'La actualización de ABBC3 <strong>no</strong> ha concluido con éxito.',
	'INSTALLER_UPDATE_VERSION'			=> 'Actualizar a versión: %1$s',
	'INSTALLER_UPDATE_END'				=> 'Por favor, tenga en cuenta que algunos BBCodes pueden <strong>no</strong> mostrarse como en la versión anterior. Eso es consecuencia de algunos cambios introducidos en la definicion de los mismos. Si usted encuentra este tipo de problemasas ejecute los pasos <strong>Extras » Re-parse</strong>',

	// Uninstall
	'INSTALLER_DELETE'					=> 'Borrar',
	'INSTALLER_DELETE_WELCOME'			=> 'Bienvenido al menú de borrado de <strong>ABBC3</strong>',
	'INSTALLER_DELETE_WELCOME_NOTE'		=> 'Si usted elige borrar el MOD, todas las modificaciones realizadas en su base de datos sql insertadas en la instalación serán eliminadas.',
	'INSTALLER_DELETE_VERSION'			=> 'Elinimar versión: %1$s',
	'INSTALLER_DELETE_NOTE'				=> 'Borrar',
	'INSTALLER_DELETE_SUCCESSFUL'		=> 'Borrada la versión <strong>%1$s  : %2$s</strong> ha concluido con éxito.<br />Ahora debe proceder al borrado de los ficheros.',
	'INSTALLER_DELETE_UNSUCCESSFUL'		=> '<strong>No</strong> se pudo borrar la versión  %1$s :%2$s .',

	// Re-parse
	'INSTALLER_REPARSE'					=> 'Re-Analizar',
	'INSTALLER_REPARSE_WELCOME'			=> 'Bienvenido al menú Re-analizar ',
	'INSTALLER_REPARSE_WELCOME_NOTE'	=> 'Cuando usted elije <strong>Re-analizar</strong> simplemente se analizan los BBCodes: es útil por si se ha cambiando la sintaxis de un BBCode, lo que da lugar a que no se vea un mensaje escrito igual que en las versiones precedentes. Esta función sólo ajusta algunos valores, no reescribe el texto...',
	'INSTALLER_REPARSE_NOTE'			=> 'Por favor, tenga en cuenta que aunque los riesgos de daños en la base de datos de su foro son poco probables, la instalación de este MOD corre bajo su cuenta y riesgo, por lo que el autor del MOD no se rsponsabiliza por posibles daños: perdida de datos, etc.',
	'INSTALLER_REPARSE_WARNING'			=> 'Usted debe hacer una copia de seguridad de las tablas de la base de datos que contienen los usurios, mensajes y mensajes privados de su foro por si algo no va bien.',
	'INSTALLER_REPARSE_POST'			=> 'Re-analizar el contenido de los mensajes',
	'INSTALLER_REPARSE_SIG'				=> 'Re-analizar firmas',
	'INSTALLER_REPARSE_PM'				=> 'Re-analizar mensajes privados',
	'INSTALLER_REPARSE_SUCCESSFUL'		=> '%1$s ha concluido con éxito.',
	'INSTALLER_REPARSE_UNSUCCESSFUL'	=> '<strong>No</strong> se pudo %1$s.',
	
	'STEP_PERCENT_COMPLETED'			=> 'Paso <strong>%d</strong> de <strong>%d</strong>',
	'INSTALLER_NOTE'					=> '<strong>Nota:</strong> ¡ Antes de añadir este MOD a su foro, debe hacer una copia de seguridad de la base de datos y de todos los archivos de su foro !',
	'INSTALLER_DELETE_INFORMATION'		=> '¡ <strong>No</strong> se pudo encontrar ABBC3 instalado !.',
	'INSTALLER_NEEDS_FOUNDER'			=> 'Usted debe estar identificado en su foro como el administrador/fundador.',
	'MISSING_PARENT_MODULE'				=> 'Módulo #%1$s no está como módulo padre de "%2$s".',
	'WARNING'							=> 'Advertencia',
));

?>