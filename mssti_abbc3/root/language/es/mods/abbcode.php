<?php
/**
* @package: phpBB 3.0.9 :: Advanced BBCode Box 3 -> root/language/es/mods :: [es][Spanish]
* @version: $Id: abbcode.php, v 3.0.9.3 2010/10/04 19:12:22 leviatan21 Exp $
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
// You do not need this where single placeholders are used, e.g. "Message %d" is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., "Click %sHERE%s" is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
// Help page
	'ABBC3_HELP_TITLE'			=> 'Advanced BBCode Box 3 :: Página de ayuda',
	'ABBC3_HELP_DESC'			=> 'Descripción',
	'ABBC3_HELP_WRITE'			=> 'BBCode formato de uso',
	'ABBC3_HELP_VIEW'			=> 'BBCode ejemplo se muestra como',
	'ABBC3_HELP_ABOUT'			=> 'Advanced BBCode Box 3 por <a href="http://www.mssti.com/phpbb3" onclick="window.open(this.href);return false;">mssti</a>',
	'ABBC3_HELP_ALT'			=> 'Advanced BBCode Box 3 (aka ABBC3)',
	
// Image Resizer JS
	'ABBC3_RESIZE_SMALL'		=> 'Click para ver la imagen completa.',
	'ABBC3_RESIZE_ZOOM_IN'		=> 'Ampliar (dimensiones reales : %1$ss x %2$s)',
	'ABBC3_RESIZE_CLOSE'		=> 'Cerrar',
	'ABBC3_RESIZE_ZOOM_OUT'		=> 'Reducir',
	'ABBC3_RESIZE_FILESIZE'		=> 'Esta imagen ha sido redimensionada. El tamaño original es %1$s x %2$s y pesa %3$sKB.',
	'ABBC3_RESIZE_NOFILESIZE'	=> 'Esta imagen ha sido redimensionada. El tamaño original es %1$s x %2$s',
	'ABBC3_RESIZE_FULLSIZE'		=> 'Imagen reducida : %1$s % de su tamaño original [ %2$s x %3$s ]',
	'ABBC3_RESIZE_NUMBER'		=> 'Imagen %1$s de %2$s',
	'ABBC3_RESIZE_PLAY'			=> 'Comenzar Proyector automático',
	'ABBC3_RESIZE_PAUSE'		=> 'Detener Proyector automático',

// Pop Box JS
	'ABBC3_POPBOX_REVERSETEXT'	=> 'Clic en la imagen para reducirla.',

// Highslide JS - http://vikjavev.no/highslide/forum/viewtopic.php?t=2119
	'ABBC3_HIGHSLIDE_LOADINGTEXT'		=> 'Cargando...',
	'ABBC3_HIGHSLIDE_LOADINGTITLE'		=> 'Click para cancelar',
	'ABBC3_HIGHSLIDE_FOCUSTITLE'		=> 'Click para traer al frente',
	'ABBC3_HIGHSLIDE_FULLEXPANDTITLE'	=> 'Expandir al tamaño actual',
	'ABBC3_HIGHSLIDE_FULLEXPANDTEXT'	=> 'Tamaño real',
	'ABBC3_HIGHSLIDE_CREDITSTEXT'		=> 'Potenciado por <i>Highslide JS</i>',
	'ABBC3_HIGHSLIDE_CREDITSTITLE'		=> 'Ir a la página web de Highslide JS',
	'ABBC3_HIGHSLIDE_PREVIOUSTEXT'		=> 'Anterior',
	'ABBC3_HIGHSLIDE_PREVIOUSTITLE'		=> 'Anterior (flecha izquierda)',
	'ABBC3_HIGHSLIDE_NEXTTEXT'			=> 'Siguiente',
	'ABBC3_HIGHSLIDE_NEXTTITLE'			=> 'Siguiente (flecha derecha)',
	'ABBC3_HIGHSLIDE_MOVETITLE'			=> 'Mover',
	'ABBC3_HIGHSLIDE_MOVETEXT'			=> 'Mover',
	'ABBC3_HIGHSLIDE_CLOSETEXT'			=> 'Cerrar',
	'ABBC3_HIGHSLIDE_CLOSETITLE'		=> 'Cerrar (esc)',
	'ABBC3_HIGHSLIDE_RESIZETITLE'		=> 'Redimensionar',
	'ABBC3_HIGHSLIDE_PLAYTEXT'			=> 'Iniciar',
	'ABBC3_HIGHSLIDE_PLAYTITLE'			=> 'Iniciar slideshow (barra espaciadora)',
	'ABBC3_HIGHSLIDE_PAUSETEXT'			=> 'Pausar',
	'ABBC3_HIGHSLIDE_PAUSETITLE'		=> 'Pausar slideshow (barra espaciadora)',
	'ABBC3_HIGHSLIDE_NUMBER'			=> 'Imagen %1 de %2',
	'ABBC3_HIGHSLIDE_RESTORETITLE'		=> 'Click para cerrar la imagen, click y arrastrar para mover. Usa las flechas del teclado para avanzar o retroceder.',

// Text to be applied to the helpline & mouseover & help page & Wizard texts
	'BBCODE_STYLES_TIP'			=> 'Consejo: Pueden aplicarse estilos rápidamente al texto seleccionado.',
	
	'ABBC3_ERROR'				=> 'Error : ',
	'ABBC3_ERROR_TAG'			=> 'Error inesperado al utilizar etiqueta : ',
	'ABBC3_NO_EXAMPLE'			=> 'No se dispone de datos ejemplo',
	
	'ABBC3_ID'					=> 'Introduzca identificador :',
	'ABBC3_NOID'				=> 'Usted no escribió el identificador',
	'ABBC3_LINK'				=> 'Introduzca el enlace a ',
	'ABBC3_DESC'				=> 'Introduzca la descripción del enlace a ',
	'ABBC3_NAME'				=> 'Descripción',
	'ABBC3_NOLINK'				=> 'Usted no escribió el enlace a ',
	'ABBC3_NODESC'				=> 'Usted no escribió la descripción a ',
	'ABBC3_WIDTH'				=> 'Introduzca el ancho',
	'ABBC3_WIDTH_NOTE'			=> 'Nota: el valor puede ser expresado en porcentaje',
	'ABBC3_NOWIDTH'				=> 'Usted no escribió la anchura',
	'ABBC3_HEIGHT'				=> 'Introduzca el alto',
	'ABBC3_HEIGHT_NOTE'			=> 'Nota: el valor puede ser expresado en porcentaje',
	'ABBC3_NOHEIGHT'			=> 'Usted no escribió la altura',
	
	'ABBC3_NOTE'				=> 'Nota',
	'ABBC3_EXAMPLE'				=> 'Ejemplo',
	'ABBC3_EXAMPLES'			=> 'Ejemplos',
	'ABBC3_SHORT'				=> 'Seleccione BBCode',
	'ABBC3_DEPRECATED'			=> '<div class="error">El bbcode <em>%1$s</em> está obsoleto desde ABBC3 version <em>%2$s</em></div>',	
	'ABBC3_UNAUTHORISED'		=> 'No está permitido usar ciertas palabras : <br /><strong> %s </strong>',
	'ABBC3_NOSCRIPT'			=> 'Su navegador tiene desactivado scripts o no admite client-side scripting. <em>(JavaScript!)</em>',
	'ABBC3_NOSCRIPT_EXPLAIN'	=> 'La página que está viendo requiere el uso de JavaScript para un mejor funcionamiento.<br />Si lo has deshabilitado intencionadamente, por favor vuelve a activarlo.',
	'ABBC3_FUNCTION_DISABLED'	=> 'Esta función no está disponible en este foro.',
	'ABBC3_AJAX_DISABLED'		=> 'Su navegador no es compatible con AJAX (XMLHttpRequest) y es incapaz de procesar esta solicitud.',
	'ABBC3_SUBMIT'				=> 'Insertar en el mensaje',
	'ABBC3_SUBMIT_SIG'			=> 'Insertar en la firma',
	'SAMPLE_TEXT'				=> 'Esto es una muestra de texto', //	' . $lang['SAMPLE_TEXT'] . '
));

/**
* TRANSLATORS PLEASE NOTE 
*	Several lines have an special note like "##	For translate : " followed for one or more "yes"
*	These means that you can/have to translate the word under
**/
$lang = array_merge($lang, array(
// bbcodes texts
	// Font Type Dropdown
	'ABBC3_FONT_MOVER'			=> 'Tipo de fuente',
	'ABBC3_FONT_TIP'			=> '[font=Comic Sans MS]texto[/font]',
	'ABBC3_FONT_NOTE'			=> 'Nota: Puede usar su propia familia de fuentes',
	'ABBC3_FONT_VIEW'			=> '[font=Comic Sans MS]' . $lang['SAMPLE_TEXT'] . '[/font]',

	// Font family Groups
	'ABBC3_FONT_ABBC3'			=> 'ABBC Box 3',
	'ABBC3_FONT_SAFE'			=> 'Lista segura',
	'ABBC3_FONT_WIN'			=> 'Fuentes Windows',

	// Font Size Dropdown
	'ABBC3_FONT_GIANT'			=> 'Gigante',
	'ABBC3_SIZE_MOVER'			=> 'Tamaño de texto',
	'ABBC3_SIZE_TIP'			=> '[size=150]texto grande[/size]',
	'ABBC3_SIZE_NOTE'			=> 'Nota: el valor debe ser expresado en porcentaje',
	'ABBC3_SIZE_VIEW'			=> '[size=150]' . $lang['SAMPLE_TEXT'] . '[/size]',

	// Highlight Font Color Dropdown
	'ABBC3_HIGHLIGHT_MOVER'		=> 'Texto Resaltado',
	'ABBC3_HIGHLIGHT_TIP'		=> '[highlight=yellow]texto[/highlight]',
	'ABBC3_HIGHLIGHT_NOTE'		=> 'Nota: puede usar colores HTML (color=#FF0000 o color=red)',
	'ABBC3_HIGHLIGHT_VIEW'		=> '[highlight=yellow]' . $lang['SAMPLE_TEXT'] . '[/highlight]',

	// Font Color Dropdown
	'ABBC3_COLOR_MOVER'			=> 'Color de texto',
	'ABBC3_COLOR_TIP'			=> '[color=red]texto[/color]',
	'ABBC3_COLOR_NOTE'			=> 'Nota: puede usar colores HTML (color=#FF0000 o color=red)',
	'ABBC3_COLOR_VIEW'			=> '[color=red]' . $lang['SAMPLE_TEXT'] . '[/color]',

	// Tigra Color & Highlight family Groups
	'ABBC3_COLOUR_SAFE'			=> 'Paleta segura para la Web',
	'ABBC3_COLOUR_WIN'			=> 'Paleta del sistema Windows',
	'ABBC3_COLOUR_GREY'			=> 'Paleta de escala de grises',
	'ABBC3_COLOUR_MAC'			=> 'Paleta del sistema Mac OS',
	'ABBC3_SAMPLE'				=> 'Muestra',

	// Cut selected text
	'ABBC3_CUT_MOVER'			=> 'Borrar el texto seleccionado',
	// Copy selected text
	'ABBC3_COPY_MOVER'			=> 'Copiar el texto seleccionado',
	// Paste previously copy text	
	'ABBC3_PASTE_MOVER'			=> 'Pegar el texto copiado',
	'ABBC3_PASTE_ERROR'			=> 'Por favor, primero copie un texto, luego péguelo ',
	// Remove BBCode (Removes all BBCode tags from selected text)
	'ABBC3_PLAIN_MOVER'			=> 'Quitar las etiquetas BBCodes del texto seleccionado',
	'ABBC3_NOSELECT_ERROR'		=> 'Por favor, primero seleccione el texto ',

	// Code
	'ABBC3_CODE_MOVER'			=> 'Código',
	'ABBC3_CODE_TIP'			=> '[code]texto código[/code]',
	'ABBC3_CODE_VIEW'			=> '[code]' . $lang['SAMPLE_TEXT'] . '[/code]',

	// Quote
	'ABBC3_QUOTE_MOVER'			=> 'Citar',
	'ABBC3_QUOTE_TIP'			=> '[quote]texto[/quote] o [quote=“usuario”]texto[/quote]',
##	For translate :                                                             yes            yes
	'ABBC3_QUOTE_VIEW'			=> '[quote]' . $lang['SAMPLE_TEXT'] . '[/quote] o [quote=&quot;usuario&quot;]' . $lang['SAMPLE_TEXT'] . '[/quote]',

	// Spoiler
	'ABBC3_SPOIL_MOVER'			=> 'Ocultar texto',
	'ABBC3_SPOIL_TIP'			=> '[spoil]texto[/spoil]',
	'ABBC3_SPOIL_VIEW'			=> '[spoil]' . $lang['SAMPLE_TEXT'] . '[/spoil]',
	'SPOILER_SHOW'				=> 'Ver el Spoiler',
	'SPOILER_HIDE'				=> 'Ocultar el Spoiler',

	// hidden
	'ABBC3_HIDDEN_MOVER'		=> 'Ocultar el contenido a visitantes',
	'ABBC3_HIDDEN_TIP'			=> '[hidden]texto[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=> 'Ocultar está OFF',
	'HIDDEN_ON'					=> 'Ocultar está ON',
	'HIDDEN_EXPLAIN'			=> 'La Administración del Sitio requiere que esté registrado y se haya identificado para ver este mensaje.',

	// Moderator tag
	'ABBC3_MOD_MOVER'			=> 'Mensaje del moderator',
	'ABBC3_MOD_TIP'				=> '[mod=nombre]texto[/mod]',
##	For translate :                      yes
	'ABBC3_MOD_VIEW'			=> '[mod=Nombre_de_moderador]' . $lang['SAMPLE_TEXT'] . '[/mod]',

	// Off topic tag
	'OFFTOPIC'					=> 'Fuera de tema',
	'ABBC3_OFFTOPIC_MOVER'		=> 'Insertar texto fuera de tema',
	'ABBC3_OFFTOPIC_TIP'		=> '[offtopic]texto[/offtopic]',
	'ABBC3_OFFTOPIC_VIEW'		=> '[offtopic]' . $lang['SAMPLE_TEXT'] . '[/offtopic]',

	// SCRIPPET
	'ABBC3_SCRIPPET_MOVER'		=> 'Scrippet',
	'ABBC3_SCRIPPET_TIP'		=> '[scrippet]Texto del guión[/scrippet]',
##	For translate :                 don't change the "<br />" and don't join the lines in one !
	'ABBC3_SCRIPPET_VIEW'		=> '[scrippet]EXT. ANTIGUA ROMA - DIA<br />
	ANTONIO e IPSUM estan caminando por las calles atestadas.<br />
	ANTONIO<br />
	¿Cree usted que en mil años, alguien recordará nuestros nombres?<br />
	IPSUM<br />
	No el suyo. Pero ellos recordaran el mio. Porque tengo la intención de escribir algo tan profundo que será recordado por los tiempos. Los diseñadores en el siglo 20 utilizarán Lorem Ipsum, siempre que necesitan para cubrir los bloques de texto.[/scrippet]',

	// Tabs
	'ABBC3_TABS_MOVER'			=> 'Tabs',
	'ABBC3_TABS_TIP'			=> '[tabs] [tabs:Titulo_solapa]Texto de la solapa[tabs:Otro_Titulo]Texto de la solapa[/tabs]',
##	For translate :                              yes                 yes                                                                                                                               yes               Yes
	'ABBC3_TABS_VIEW'			=> '[tabs] [tabs:Titulo solapa]&nbsp;Todo el contenido abajo este código se inserta dentro de la ficha, hasta que otra ficha se declara con: &#91;tabs:XXX&#93;.[tabs:Otra solapa]&nbsp;Y continúa así... hasta el final de la página o, opcionalmente, puede añadir el código de abajo para poner fin a la última ficha y añadir más texto fuera de las pestañas: [/tabs]',

	// NFO
	'ABBC3_NFO_TITLE'			=> 'Texto NFO',
	'ABBC3_NFO_MOVER'			=> 'Texto NFO (Mejor vista en Internet explorer)',
	'ABBC3_NFO_TIP'				=> '[nfo]Texto NFO[/nfo]',
	'ABBC3_NFO_VIEW'			=> '[nfo]		Ü²Ü  Û Û²²     ÛÛÛÛ  Û ÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛ     ÛÛÛÛ Û  Û ÛÛÛÛÛ ²² ±[/nfo]',

	// Justify Align
	'ABBC3_ALIGNJUSTIFY_MOVER'	=> 'Texto justificado',
	'ABBC3_ALIGNJUSTIFY_TIP'	=> '[align=justify]texto[/align]',
##	For translate :                                yes           yes
	'ABBC3_ALIGNJUSTIFY_VIEW'	=> '[align=justify]This is <br />a sample text<br />' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Right Align
	'ABBC3_ALIGNRIGHT_MOVER'	=> 'Texto alineado a la derecha',
	'ABBC3_ALIGNRIGHT_TIP'		=> '[align=right]texto[/align]',
	'ABBC3_ALIGNRIGHT_VIEW'		=> '[align=right]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Center Align
	'ABBC3_ALIGNCENTER_MOVER'	=> 'Texto alineado al centro',
	'ABBC3_ALIGNCENTER_TIP'		=> '[align=center]texto[/align]',
	'ABBC3_ALIGNCENTER_VIEW'	=> '[align=center]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Left Align
	'ABBC3_ALIGNLEFT_MOVER'		=> 'Texto alineado a la izquierda',
	'ABBC3_ALIGNLEFT_TIP'		=> '[align=left]texto[/align]',
	'ABBC3_ALIGNLEFT_VIEW'		=> '[align=left]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Preformat
	'ABBC3_PRE_MOVER'			=> 'Texto preformateado',
	'ABBC3_PRE_TIP'				=> '[pre]texto[/pre]',
	'ABBC3_PRE_VIEW'			=> '[pre]' . $lang['SAMPLE_TEXT'] . '<br />		' . $lang['SAMPLE_TEXT'] . '[/pre]',

	// Tab
	'ABBC3_TAB_MOVER'			=> 'Insertar tabulación',
	'ABBC3_TAB_TIP'				=> '[tab=nn]',
	'ABBC3_TAB_NOTE'			=> 'Introduzca un número que será el margen, medido en pixels.',
	'ABBC3_TAB_VIEW'			=> '[tab=30]' . $lang['SAMPLE_TEXT'],

	// Superscript
	'ABBC3_SUP_MOVER'			=> 'Texto superíndice',
	'ABBC3_SUP_TIP'				=> '[sup]texto[/sup]',
##	For translate :                 yes                                                             yes
	'ABBC3_SUP_VIEW'			=> 'Esto es un texto normal [sup]' . $lang['SAMPLE_TEXT'] . '[/sup] esto es un texto normal',

	// Subscript
	'ABBC3_SUB_MOVER'			=> 'Texto subíndice',
	'ABBC3_SUB_TIP'				=> '[sub]texto[/sub]',
##	For translate :                 yes                                                             yes
	'ABBC3_SUP_VIEW'			=> 'Esto es un texto normal [sub]' . $lang['SAMPLE_TEXT'] . '[/sub] esto es un texto normal',

	// Bold
	'ABBC3_B_MOVER'				=> 'Texto en negrita',
	'ABBC3_B_TIP'				=> '[b]texto[/b]',
	'ABBC3_B_VIEW'				=> '[b]' . $lang['SAMPLE_TEXT'] . '[/b]',

	// Italic
	'ABBC3_I_MOVER'				=> 'Texto en itálica',
	'ABBC3_I_TIP'				=> '[i]texto[/i]',
	'ABBC3_I_VIEW'				=> '[i]' . $lang['SAMPLE_TEXT'] . '[/i]',

	// Underline
	'ABBC3_U_MOVER'				=> 'Texto subrayado',
	'ABBC3_U_TIP'				=> '[u]texto[/u]',
	'ABBC3_U_VIEW'				=> '[u]' . $lang['SAMPLE_TEXT'] . '[/u]',

	// Strikethrough
	'ABBC3_S_MOVER'				=> 'Texto tachado',
	'ABBC3_S_TIP'				=> '[s]texto[/s]',
	'ABBC3_S_VIEW'				=> '[s]' . $lang['SAMPLE_TEXT'] . '[/s]',

	// Text Fade
	'ABBC3_FADE_MOVER'			=> 'Texto descolorido',
	'ABBC3_FADE_TIP'			=> '[fade]texto[/fade]',
	'ABBC3_FADE_VIEW'			=> '[fade]' . $lang['SAMPLE_TEXT'] . '[/fade]',

	// Text Gradient
	'ABBC3_GRAD_MOVER'			=> 'Texto arcoiris',
	'ABBC3_GRAD_TIP'			=> 'Seleccione el texto primero',
##For translate (The separate words are "This is a sample text") 
##                                                  yes                    yes                     yes                     yes                      yes                     yes                      yes                     yes                     yes                      yes                     yes                     yes                     yes                     yes                     yes                     yes                      yes                     yes                      yes                     yes                     yes                     yes                     yes
	'ABBC3_GRAD_VIEW'			=> '[color=#FF0000]E[/color][color=#F60009]s[/color][color=#EC0013]t[/color][color=#E3001C]o[/color] [color=#D0002F]e[/color][color=#C60039]s[/color] [color=#B3004C]u[/color][color=#AA0055]n[/color][color=#A1005E]a[/color] [color=#8E0071]m[/color][color=#84007B]u[/color][color=#7B0084]e[/color][color=#71008E]s[/color][color=#680097]t[/color][color=#5E00A1]r[/color][color=#5500AA]a[/color] [color=#4200BD]d[/color][color=#3900C6]e[/color] [color=#2600D9]t[/color][color=#1C00E3]e[/color][color=#1300EC]x[/color][color=#0900F6]t[/color][color=#0000FF]o[/color]',
	'ABBC3_GRAD_MIN_ERROR'		=> 'Por favor, primero seleccione el texto : ',
	'ABBC3_GRAD_MAX_ERROR'		=> 'Solo se permite un tamaño inferior a 120 caracteres : ',
	'ABBC3_GRAD_COLORS'			=> 'Colores Pre Seleccionados',
	'ABBC3_GRAD_ERROR'			=> 'Error: falla en el contrutor ColorCode()',

	// Glow text
	'ABBC3_GLOW_MOVER'			=> 'Texto Resplandor',
	'ABBC3_GLOW_TIP'			=> '[glow=(color)]texto[/glow]',
	'ABBC3_GLOW_VIEW'			=> '[glow=red]' . $lang['SAMPLE_TEXT'] . '[/glow]',

	// Shadow text
	'ABBC3_SHADOW_MOVER'		=> 'Texto doble',
	'ABBC3_SHADOW_TIP'			=> '[shadow=(color)]texto[/shadow]',
	'ABBC3_SHADOW_VIEW'			=> '[shadow=blue]' . $lang['SAMPLE_TEXT'] . '[/shadow]',

	// Dropshadow text
	'ABBC3_DROPSHADOW_MOVER'	=> 'Texto con sombra',
	'ABBC3_DROPSHADOW_TIP'		=> '[dropshadow=(color)]texto[/dropshadow]',
	'ABBC3_DROPSHADOW_VIEW'		=> '[dropshadow=blue]' . $lang['SAMPLE_TEXT'] . '[/dropshadow]',

	// Blur text
	'ABBC3_BLUR_MOVER'			=> 'Texto esfumado (Mejor vista en Internet explorer)',
	'ABBC3_BLUR_TIP'			=> '[blur=(color)]texto[/blur]',
	'ABBC3_BLUR_VIEW'			=> '[blur=blue]' . $lang['SAMPLE_TEXT'] . '[/blur]',

	// Wave text
	'ABBC3_WAVE_MOVER'			=> 'Text ondeado (Mejor vista en Internet explorer)',
	'ABBC3_WAVE_TIP'			=> '[wave=(color)]texto[/wave]',
	'ABBC3_WAVE_VIEW'			=> '[wave=blue]' . $lang['SAMPLE_TEXT'] . '[/wave]',

	// Unordered List
	'ABBC3_LISTB_MOVER'			=> 'Lista Desordenada',
	'ABBC3_LISTB_TIP'			=> '[list]texto[/list]',
	'ABBC3_LISTB_NOTE'			=> 'Nota: usted puede usar [*] para insertar puntos',
##	For translate :                          yes      yes      yes           yes        yes            yes                yes
	'ABBC3_LISTB_VIEW'			=> '[list][*]Item 1[*]Item 2[*]Item 3[/list] o [list][*]Item 1[list][*]sub-item 1[list][*]sub-sub-item1[/list][/list][/list]',

	// Ordered List
	'ABBC3_LISTO_MOVER'			=> 'Lista Ordenada',
	'ABBC3_LISTO_TIP'			=> '[list=1|a]texto[/list]',
	'ABBC3_LISTO_NOTE'			=> 'Nota: usted puede usar [*] para insertar puntos',
##	For translate :                            yes      yes     yes          yes          yes      yes      yes           yes          yes      yes      yes           yes          yes      yes       yes             yes          yes      yes       yes
	'ABBC3_LISTO_VIEW'			=> '[list=1][*]Item 1[*]Item2[*]Item3[/list] o [list=a][*]Item a[*]Item b[*]Item c[/list] o [list=A][*]Item A[*]Item B[*]Item C[/list] o [list=i][*]Item i[*]Item ii[*]Item iii[/list] o [list=I][*]Item I[*]Item II[*]Item III[/list]',

	// List item
	'ABBC3_LISTITEM_MOVER'		=> 'Item de lista',
	'ABBC3_LISTITEM_TIP'		=> '[*]',
	'ABBC3_LISTITEM_NOTE'		=> 'Nota: Insertar puntos dentro de la lista.',

	// Line Break
	'ABBC3_HR_MOVER'			=> 'Línea divisoria',
	'ABBC3_HR_TIP'				=> '[hr]',
	'ABBC3_HR_NOTE'				=> 'Nota: Crea una línea para separar texto.',
	'ABBC3_HR_VIEW'				=> $lang['SAMPLE_TEXT'] . '[hr]' . $lang['SAMPLE_TEXT'],

	// Message Box text direction Left to Light
	'ABBC3_DIRRTL_MOVER'		=> 'Texto con lectura derecha a izquierda',
	'ABBC3_DIRRTL_TIP'			=> '[dir=rtl]texto[/dir]',
	'ABBC3_DIRRTL_VIEW'			=> '[dir=rtl]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Message Box text direction right to Left
	'ABBC3_DIRLTR_MOVER'		=> 'Texto con lectura izquierda a derecha',
	'ABBC3_DIRLTR_TIP'			=> '[dir=ltr]texto[/dir]',
	'ABBC3_DIRLTR_VIEW'			=> '[dir=ltr]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Marquee Down
	'ABBC3_MARQDOWN_MOVER'		=> 'Desplazamiento de texto hacia abajo',
	'ABBC3_MARQDOWN_TIP'		=> '[marq=down]texto[/marq]',
	'ABBC3_MARQDOWN_VIEW'		=> '[marq=down]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Up
	'ABBC3_MARQUP_MOVER'		=> 'Desplazamiento de texto hacia arriba',
	'ABBC3_MARQUP_TIP'			=> '[marq=up]texto[/marq]',
	'ABBC3_MARQUP_VIEW'			=> '[marq=up]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Right
	'ABBC3_MARQRIGHT_MOVER'		=> 'Desplazamiento de texto hacia la derecha',
	'ABBC3_MARQRIGHT_TIP'		=> '[marq=right]texto[/marq]',
	'ABBC3_MARQRIGHT_VIEW'		=> '[marq=right]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Left
	'ABBC3_MARQLEFT_MOVER'		=> 'Desplazamiento de texto hacia la izquierda',
	'ABBC3_MARQLEFT_TIP'		=> '[marq=left]texto[/marq]',
	'ABBC3_MARQLEFT_VIEW'		=> '[marq=left]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Table row cell wizard
	'ABBC3_TABLE_MOVER'			=> 'Insertar una tabla',
	'ABBC3_TABLE_TIP'			=> '[table=(ccs style)][tr=(ccs style)][td=(ccs style)]text[/td][/tr][/table]',
	'ABBC3_TABLE_VIEW'			=> '[table=width:50%;border:1px solid #cccccc][tr=text-align:center][td=border:1px solid #cccccc]' . $lang['SAMPLE_TEXT'] . '[/td][/tr][/table]',

	'ABBC3_TABLE_STYLE'			=> 'Introduzca estilo de tabla',
	'ABBC3_TABLE_EXAMPLE'		=> 'width: 50%; border: 1px solid #cccccc;',

	'ABBC3_ROW_NUMBER'			=> 'Introduzca cantidad de filas',
	'ABBC3_ROW_ERROR'			=> 'Usted no escribió la cantidad de filas',
	'ABBC3_ROW_STYLE'			=> 'Introduzca estilo de filas',
	'ABBC3_ROW_EXAMPLE'			=> 'text-align: center;',

	'ABBC3_CELL_NUMBER'			=> 'Introduzca cantidad de columnas',
	'ABBC3_CELL_ERROR'			=> 'Usted no escribió la cantidad de columnas',
	'ABBC3_CELL_STYLE'			=> 'Introduzca estilo de filas',
	'ABBC3_CELL_EXAMPLE'		=> 'border: 1px solid #cccccc;',

	// Anchor
	'ABBC3_ANCHOR_MOVER'		=> 'Ancla',
	'ABBC3_ANCHOR_TIP'			=> '[anchor=(el nombre de esta ancla) goto=(el nombre de la otra ancla)]texto[/anchor]',
	'ABBC3_ANCHOR_EXAMPLE'		=> '[anchor=a1 goto=a2]ir al ancla a2[/anchor]',
##	For translate :                                           yes                                Yes               Yes
	'ABBC3_ANCHOR_VIEW'			=> '[anchor=help_0 goto=help_1]ir al ancla ayuda 1[/anchor]<br /> o [anchor=help_1]esta es el ancla ayuda 1[/anchor]',

	// Hyperlink Wizard
	'ABBC3_URL_TAG'				=> 'página',
	'ABBC3_URL_MOVER'			=> 'Enlace Web',	
	'ABBC3_URL_TIP'				=> '[url]http://...[/url] o [url=http://...]Nombre de Web[/url]',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.mssti.com',
	'ABBC3_URL_VIEW'			=> '[url=http://www.mssti.com].:: MSSTI ::.[/url]',

	// Email Wizard
	'ABBC3_EMAIL_TAG'			=> 'correo electrónico',
	'ABBC3_EMAIL_MOVER'			=> 'Correo electrónico',
	'ABBC3_EMAIL_TIP'			=> '[email]nombre@servidor.ext[/email] o [email=nombre@servidor.ext]Mi correo[/email]',
	'ABBC3_EMAIL_EXAMPLE'		=> 'user@server.ext',
	'ABBC3_EMAIL_VIEW'			=> '[email=user@server.ext]user@server.ext[/email]',

	// Ed2k link Wizard
	'ABBC3_ED2K_TAG'			=> 'ed2k',
	'ABBC3_ED2K_MOVER'			=> 'Enlace eD2K',
	'ABBC3_ED2K_TIP'			=> '[url]enlace ed2k[/url] o [url=enlace ed2k]Nombre ed2k[/url]',
	'ABBC3_ED2K_EXAMPLE'		=> 'ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/',
	'ABBC3_ED2K_VIEW'			=> '[url=ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/]The_Two_Towers-The_Purist_Edit-Trailer.avi[/url]',
	'ABBC3_ED2K_ADD'			=> 'Agregar los enlaces selecionados a su cliente ed2k',
	'ABBC3_ED2K_FRIEND'			=> 'ed2k friend',
	'ABBC3_ED2K_SERVER'			=> 'ed2k server',
	'ABBC3_ED2K_SERVERLIST'		=> 'ed2k serverlist',

	// Web included by iframe
	'ABBC3_WEB_TAG'				=> 'web',
	'ABBC3_WEB_MOVER'			=> 'Insertar página web en el mensaje',
	'ABBC3_WEB_TIP'				=> '[web width=200 height=100]URL página[/web]',
	'ABBC3_WEB_EXAMPLE'			=> 'http://www.mssti.com',
	'ABBC3_WEB_VIEW'			=> '[web width=99% height=140]http://www.mssti.com[/web]',
	'ABBC3_WEB_EXPLAIN'			=> '<strong class="error">Nota:</strong> permitir que otros sitios web se incluyan en los mensajes, puede suponer un riesgo de seguridad. Utilícelo bajo su propio riesgo, o asignelo a grupos de confianza.',

	// Image & Thumbnail Wizard
	'ABBC3_ALIGN_MODE'			=> 'Alinear Imagen',
##	For translate :							 Don't				Yes
	'ABBC3_ALIGN_SELECTOR'		=> array(	'none'			=> 'Sin alinear',
											'left'			=> 'Izquierda',
											'center'		=> 'Centro',
											'right'			=> 'Derecha',
											'float-left'	=> 'Flotar a la izquierda',
											'float-right'	=> 'Flotar a la derecha'),

	// Image
	'ABBC3_IMG_TAG'				=> 'imagen',
	'ABBC3_IMG_MOVER'			=> 'Insertar imagen',
	'ABBC3_IMG_TIP'				=> '[img=(left|center|right|float-left|float-right)]http://...[/img]',
	'ABBC3_IMG_EXAMPLE'			=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_IMG_VIEW'			=> '[img=center]http://www.google.com/intl/en_com/images/logo_plain.png[/img]',

	// Thumbnail
	'ABBC3_THUMBNAIL_TAG'		=> 'miniatura',
	'ABBC3_THUMBNAIL_MOVER'		=> 'Insertar imagen miniatura',
	'ABBC3_THUMBNAIL_TIP'		=> '[thumbnail(=(left|center|right|float-left|float-right))]http://...[/thumbnail]',
	'ABBC3_THUMBNAIL_EXAMPLE'	=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_THUMBNAIL_VIEW'		=> '[thumbnail]http://www.google.com/intl/en_com/images/logo_plain.png[/thumbnail]',

	// Imgshack
	'ABBC3_IMGSHACK_MOVER'		=> 'Insertar imagen desde imageshack',
	'ABBC3_IMGSHACK_TIP'		=> '[url=http://imageshack.us][img=http://...][/img][/url]',
	'ABBC3_IMGSHACK_VIEW'		=> '[url=http://img22.imageshack.us/my.php?image=abbc3v1012newscreen.gif][img]http://img22.imageshack.us/img22/6241/abbc3v1012newscreen.th.gif[/img][/url]',

	// Rapid share checker
	'ABBC3_FOPEN_ERROR'			=> '<strong>Error : </strong> Lo sentimos pero parece que <strong>allow_url_fopen</strong> no está habilitada, esta funcion requiere que la diretiva PHP allow_url_fopen esté habilitada.',
	'ABBC3_RAPIDSHARE_TAG'		=> 'rapidshare',
	'ABBC3_RAPIDSHARE_MOVER'	=> 'Insertar un archivo desde rapidshare',
	'ABBC3_RAPIDSHARE_TIP'		=> '[rapidshare]http://rapidshare.com/files/...][/rapidshare]',
	'ABBC3_RAPIDSHARE_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip.html',
	'ABBC3_RAPIDSHARE_VIEW'		=> '[rapidshare]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip.html[/rapidshare]',
	'ABBC3_RAPIDSHARE_GOOD'		=> 'Archivo encontrado el servidor !',
	'ABBC3_RAPIDSHARE_WRONG'	=> 'Archivo no encontrado !',

	// testlink
	'ABBC3_CURL_ERROR'			=> '<strong>Error : </strong> Lo sentimos pero parece que CURL no está cargado, por favor instalarlo para usar esta función.',
	'ABBC3_LOGIN_EXPLAIN_VIEW'	=> 'La Administración del Sitio requiere que esté registrado y se haya identificado para ver enlaces.',
	'ABBC3_TESTLINK_TAG'		=> 'Inspector de enlace',
	'ABBC3_TESTLINK_MOVER'		=> 'Comprobar la validez de un archivo almacenado en el servidor público',
	'ABBC3_TESTLINK_TIP'		=> '[testlink]http://rapidshare.com/files/...[/testlink]',
	'ABBC3_TESTLINK_NOTE'		=> 'Servidores validos:rapidshare,megaupload,megarotic,depositfiles,megashares.',
	'ABBC3_TESTLINK_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip.html',
	'ABBC3_TESTLINK_VIEW'		=> '[testlink]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip.html[/testlink]',
	'ABBC3_TESTLINK_GOOD'		=> 'Archivo encontrado el servidor !',
	'ABBC3_TESTLINK_WRONG'		=> 'Archivo no encontrado !',

	// Click counter
	'ABBC3_CLICK_TAG'			=> 'click',
	'ABBC3_CLICK_MOVER'			=> 'Insertar contador de Clicks',
	'ABBC3_CLICK_TIP'			=> '[click]http://...[/click] o [click=http://...]Nombre Web[/click] o [click][img]http://...[/img][/click]',
	'ABBC3_CLICK_EXAMPLE'		=> 'http://www.google.com' . ' | ' . 'http://www.google.com/intl/en_com/images/logo_plain.png',
##	For translate :                                                                     yes
	'ABBC3_CLICK_VIEW'			=> '[click=http://www.mssti.com] .:: MSSTI ::. [/click] o [click][img]http://www.google.com/intl/en_com/images/logo_plain.png[/img][/click]',
	'ABBC3_CLICK_TIME'			=> '( Clickeado %d vez )',
	'ABBC3_CLICK_TIMES'			=> '( Clickeado %d veces )',
	'ABBC3_CLICK_ERROR'			=> '<strong>ERROR:</strong> Por favor ingrese in ID válido',

	// Search tag
	'ABBC3_SEARCH_MOVER'		=> 'Insertar enlace a buscador ',
	'ABBC3_SEARCH_TIP'			=> '[search(=(bing|yahoo|google|altavista|lycos|wikipedia))]texto[/search]',
##	For translate :                                                              yes                                                yes                                                  yes                                                   yes                                                      yes                                                  yes
	'ABBC3_SEARCH_VIEW'			=> '[search]Advanced BBCode Box 3[/search]<br /> o [search=bing]Advanced BBCode Box 3[/search]<br /> o [search=yahoo]Advanced BBCode Box 3[/search]<br /> o [search=google]Advanced BBCode Box 3[/search]<br /> o [search=altavista]Advanced BBCode Box 3[/search]<br /> o [search=lycos]Advanced BBCode Box 3[/search]<br /> o [search=wikipedia]Advanced BBCode Box 3[/search]',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_TAG'			=> 'BBvideo',
	'ABBC3_BBVIDEO_MOVER'		=> 'Insertar video desde web',
	'ABBC3_BBVIDEO_TIP'			=> '[BBvideo]Video URL[/BBvideo]',
	'ABBC3_BBVIDEO_EXAMPLE'		=> 'http://www.youtube.com/watch?v=PDGxfsf-xwQ',
	'ABBC3_BBVIDEO_VIEW'		=> '[BBvideo 425,350]http://www.youtube.com/watch?v=PDGxfsf-xwQ[/BBvideo]',
	'ABBC3_BBVIDEO_SELECT'		=> 'Seleccione un tipo de vídeo',
	'ABBC3_BBVIDEO_SELECT_ERROR'=> 'Actualmente no hay vídeos permitidos. Por favor notifique al %sAdministrador del Sitio%s acerca de este problema.<br />Mientras tanto, puede publicar enlaces a vídeos mediante el BBCode URL.',
	'ABBC3_BBVIDEO_FILE'		=> 'Formato del archivo',
	'ABBC3_BBVIDEO_VIDEO'		=> 'Video desde',
	'ABBC3_BBVIDEO_EXTERNAL'	=> 'Video externo desde',

	// Flash (swf) Wizard
	'ABBC3_FLASH_TAG'			=> 'flash',
	'ABBC3_FLASH_MOVER'			=> 'Insertar video de flash (swf)',
	'ABBC3_FLASH_TIP'			=> '[flash width=# height=#]URL flash[/flash] o [flash width,height]URL flash[/flash]',
	'ABBC3_FLASH_EXAMPLE'		=> 'http://www.mssti.com/phpbb3/images/media/relojanalogo.swf',
	'ABBC3_FLASH_VIEW'			=> '[flash 250,200]http://www.mssti.com/phpbb3/images/media/relojanalogo.swf[/flash]',

	// Flash (flv) Wizard
	'ABBC3_FLV_TAG'				=> 'flash',
	'ABBC3_FLV_MOVER'			=> 'Insertar video de flash (flv)',
	'ABBC3_FLV_TIP'				=> '[flv width=# height=#]URL flash video[/flv] o [flv width,height]URL flash video[/flv]',
	'ABBC3_FLV_EXAMPLE'			=> 'http://www.mssti.com/phpbb3/images/media/Demo.flv',
	'ABBC3_FLV_VIEW'			=> '[flv 250,200]http://www.mssti.com/phpbb3/images/media/Demo.flv[/flv]',

	// Streaming Video Wizard
	'ABBC3_VIDEO_TAG'			=> 'video',
	'ABBC3_VIDEO_MOVER'			=> 'Insertar video',
	'ABBC3_VIDEO_TIP'			=> '[video width=# height=#]URL video[/video]',
	'ABBC3_VIDEO_EXAMPLE'		=> 'http://www.mssti.com/phpbb3/images/media/calmate.wmv',
	'ABBC3_VIDEO_VIEW'			=> '[video 250,200]http://www.mssti.com/phpbb3/images/media/calmate.wmv[/video]',

	// Streaming Audio Wizard
	'ABBC3_STREAM_TAG'			=> 'sonido',
	'ABBC3_STREAM_MOVER'		=> 'Insertar sonido',
	'ABBC3_STREAM_TIP'			=> '[stream]URL Archivo[/stream]',
	'ABBC3_STREAM_EXAMPLE'		=> 'http://www.mssti.com/phpbb3/images/media/Cake_I_Will_Survive.mp3',
	'ABBC3_STREAM_VIEW'			=> '[stream]http://www.mssti.com/phpbb3/images/media/Cake_I_Will_Survive.mp3[/stream]',

	// Quick time
	'ABBC3_QUICKTIME_TAG'		=> 'Quick time',
	'ABBC3_QUICKTIME_MOVER'		=> 'Insertar Quick time',
	'ABBC3_QUICKTIME_TIP'		=> '[quicktime width=# height=#]URL Quick time[/quicktime]',
	'ABBC3_QUICKTIME_EXAMPLE'	=> 'http://www.mssti.com/phpbb3/images/media/Buenos_Aires.qt',
	'ABBC3_QUICKTIME_VIEW'		=> '[quicktime width=250 height=200]http://www.mssti.com/phpbb3/images/media/Buenos_Aires.qt[/quicktime]',

	// Real Media Wizard
	'ABBC3_RAM_TAG'				=> 'Real Media',
	'ABBC3_RAM_MOVER'			=> 'Insertar Real Media',
	'ABBC3_RAM_TIP'				=> '[ram]URL Real Media[/ram]',
	'ABBC3_RAM_EXAMPLE'			=> 'http://www.mssti.com/phpbb3/images/media/Dr_Who.ram',
	'ABBC3_RAM_VIEW'			=> '[ram width=250 height=200]http://www.mssti.com/phpbb3/images/media/Dr_Who.ram[/ram]',

	// Google video Wizard
	'ABBC3_GVIDEO_TAG'			=> 'Google Video',
	'ABBC3_GVIDEO_MOVER'		=> 'Insertar video desde Google',
	'ABBC3_GVIDEO_TIP'			=> '[GVideo]URL video[/GVideo]',
	'ABBC3_GVIDEO_EXAMPLE'		=> 'http://video.google.com/videoplay?docid=-8351924403384451128',
	'ABBC3_GVIDEO_VIEW'			=> '[GVideo]http://video.google.com/videoplay?docid=-8351924403384451128[/GVideo]',

	// Youtube video Wizard
	'ABBC3_YOUTUBE_TAG'			=> 'Youtube Video',
	'ABBC3_YOUTUBE_MOVER'		=> 'Insertar video desde Youtube',
	'ABBC3_YOUTUBE_TIP'			=> '[youtube]URL video[/youtube]',
	'ABBC3_YOUTUBE_EXAMPLE'		=> 'http://www.youtube.com/watch?v=PDGxfsf-xwQ',
	'ABBC3_YOUTUBE_VIEW'		=> '[youtube]http://www.youtube.com/watch?v=PDGxfsf-xwQ[/youtube]',

	// Veoh video
	'ABBC3_VEOH_TAG'			=> 'Veoh',
	'ABBC3_VEOH_MOVER'			=> 'Insertar video desde Veoh',
	'ABBC3_VEOH_TIP'			=> '[veoh]URL video[/veoh].',
	'ABBC3_VEOH_EXAMPLE'		=> 'http://www.veoh.com/browse/videos/category/entertainment/watch/v18183513AEp9gT8J',
	'ABBC3_VEOH_VIEW'			=> '[veoh]http://www.veoh.com/browse/videos/category/entertainment/watch/v18183513AEp9gT8J[/veoh]',

	// Collegehumor video
	'ABBC3_COLLEGEHUMOR_TAG'	=> 'collegehumor',
	'ABBC3_COLLEGEHUMOR_MOVER'	=> 'Insertar video desde collegehumor',
	'ABBC3_COLLEGEHUMOR_TIP'	=> '[collegehumor]collegehumor video URL[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXAMPLE'=> 'http://www.collegehumor.com/video:1802097',
	'ABBC3_COLLEGEHUMOR_VIEW'	=> '[collegehumor]http://www.collegehumor.com/video:1802097[/collegehumor]',

	// Dailymotion video
	'ABBC3_DM_MOVER'			=> 'Insertar video desde dailymotion', // from http://www.dailymotion.com/
	'ABBC3_DM_TIP'				=> '[dm]Dailymotion ID[/dm]',
	'ABBC3_DM_EXAMPLE'			=> 'http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
	'ABBC3_DM_VIEW'				=> '[dm]http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport[/dm]',

	// Gamespot video
	'ABBC3_GAMESPOT_MOVER'		=> 'Insertar video desde Gamespot',
	'ABBC3_GAMESPOT_TIP'		=> '[gamespot]Gamespot video URL [gamespot]',
	'ABBC3_GAMESPOT_EXAMPLE'	=> 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
	'ABBC3_GAMESPOT_VIEW'		=> '[gamespot]http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8[gamespot]',

	// Gametrailers video
	'ABBC3_GAMETRAILERS_MOVER'	=> 'Insertar video desde Gametrailers',
	'ABBC3_GAMETRAILERS_TIP'	=> '[gametrailers]Gametrailers video URL[/gametrailers]',
	'ABBC3_GAMETRAILERS_EXAMPLE'=> 'http://www.gametrailers.com/player/30461.html',
	'ABBC3_GAMETRAILERS_VIEW'	=> '[gametrailers]http://www.gametrailers.com/video/game-of-best-of-e3/701407[/gametrailers]',

	// IGN video
	'ABBC3_IGNVIDEO_MOVER'		=> 'Insertar video desde Ign',
	'ABBC3_IGNVIDEO_TIP'		=> '[ignvideo]ING video URL[/ignvideo]',
	'ABBC3_IGNVIDEO_EXAMPLE'	=> 'http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html',
	'ABBC3_IGNVIDEO_VIEW'		=> '[ignvideo]http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html[/ignvideo]',

	// LiveLeak video
	'ABBC3_LIVELEAK_MOVER'		=> 'Insertar video desde Liveleak',
	'ABBC3_LIVELEAK_TIP'		=> '[liveleak]Liveleak video URL[/liveleak]',
	'ABBC3_LIVELEAK_EXAMPLE'	=> 'http://www.liveleak.com/view?i=166_1194290849',
	'ABBC3_LIVELEAK_VIEW'		=> '[liveleak]http://www.liveleak.com/view?i=166_1194290849[/liveleak]',

// Custom BBCodes
	// Deezer audio
	'DEEZER_TAG'				=> 'Deezer',
	'DEEZER_MOVER'				=> 'Insertar audio desde Deezer',
	'DEEZER_TIP'				=> '[Deezer]Deezer audio URL[/Deezer]',
	'DEEZER_EXAMPLE'			=> 'http://www.deezer.com/track/351534',
	'DEEZER_VIEW'				=> '[Deezer]http://www.deezer.com/track/351534[/Deezer]',

));

?>