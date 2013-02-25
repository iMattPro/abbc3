<?php
/**
*
* abbcode [French]
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @translators fr (c) darky - http://www.foruminfopc.fr/ and Team http://www.phpBB-fr.com/
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
	'ABBC3_HELP_TITLE'			=> 'BBCodes Box 3 Avancés : Page d’aide',
	'ABBC3_HELP_DESC'			=> 'Description',
	'ABBC3_HELP_WRITE'			=> 'Format d’utilisation du BBCode',
	'ABBC3_HELP_VIEW'			=> 'Le BBCode affiche par exemple',
	'ABBC3_HELP_ABOUT'			=> 'BBCodes Box 3 Avancés par <a href="http://www.phpbb.com/customise/db/mod/advanced_bbcode_box_3/" onclick="window.open(this.href);return false;">mssti</a> - Traduction française par <a href="http://www.foruminfopc.fr/" onclick="window.open(this.href);return false;">darky</a> et l’équipe <a href="http://www.phpbb-fr.com/" onclick="window.open(this.href);return false;">phpBB-fr.com</a>',
//	'ABBC3_HELP_ALT'			=> 'BBCodes Box 3 Avancés (alias ABBC3)',

// Image Resizer JS
	'ABBC3_RESIZE_SMALL'		=> 'Cliquez pour voir l’image complète.',
	'ABBC3_RESIZE_ZOOM_IN'		=> 'Zoom avant (dimensions réelles : %1$s x %2$s)',
	'ABBC3_RESIZE_CLOSE'		=> 'Fermer',
	'ABBC3_RESIZE_ZOOM_OUT'		=> 'Zoom arrière',
	'ABBC3_RESIZE_FILESIZE'		=> 'Cette image a été redimensionnée. L’image originale fait %1$s x %2$s et est de %3$s Ko.',
	'ABBC3_RESIZE_NOFILESIZE'	=> 'Cette image a été redimensionnée. L’image originale fait %1$s x %2$s.',
	'ABBC3_RESIZE_FULLSIZE'		=> 'Image redimensionnée de %1$s% de sa taille originale [ %2$s x %3$s ]',
	'ABBC3_RESIZE_NUMBER'		=> 'Image %1$s sur %2$s',
	'ABBC3_RESIZE_PLAY'			=> 'Lancer le diaporama',
	'ABBC3_RESIZE_PAUSE'		=> 'Arrêter le diaporama',
	'ABBC3_RESIZE_IMAGE'		=> 'Image',
	'ABBC3_RESIZE_OF'			=> 'sur',

// Highslide JS - http://vikjavev.no/highslide/forum/viewtopic.php?t=2119
	'ABBC3_HIGHSLIDE_LOADINGTEXT'		=> 'Chargement…',
	'ABBC3_HIGHSLIDE_LOADINGTITLE'		=> 'Cliquez pour annuler',
	'ABBC3_HIGHSLIDE_FOCUSTITLE'		=> 'Cliquez pour mettre au premier plan',
	'ABBC3_HIGHSLIDE_FULLEXPANDTITLE'	=> 'Développer à la taille réelle',
	'ABBC3_HIGHSLIDE_FULLEXPANDTEXT'	=> 'Agrandir',
	'ABBC3_HIGHSLIDE_CREDITSTEXT'		=> 'Développé par <i>Highslide JS</i>',
	'ABBC3_HIGHSLIDE_CREDITSTITLE'		=> 'Aller sur le site d’Highslide JS',
	'ABBC3_HIGHSLIDE_PREVIOUSTEXT'		=> 'Précédent',
	'ABBC3_HIGHSLIDE_PREVIOUSTITLE'		=> 'Précédent (flèche gauche)',
	'ABBC3_HIGHSLIDE_NEXTTEXT'			=> 'Suivant',
	'ABBC3_HIGHSLIDE_NEXTTITLE'			=> 'Suivant (flèche droite)',
	'ABBC3_HIGHSLIDE_MOVETITLE'			=> 'Déplacer',
	'ABBC3_HIGHSLIDE_MOVETEXT'			=> 'Déplacer',
	'ABBC3_HIGHSLIDE_CLOSETEXT'			=> 'Fermer',
	'ABBC3_HIGHSLIDE_CLOSETITLE'		=> 'Fermer (échap.)',
	'ABBC3_HIGHSLIDE_RESIZETITLE'		=> 'Redimensionner',
	'ABBC3_HIGHSLIDE_PLAYTEXT'			=> 'Lecture',
	'ABBC3_HIGHSLIDE_PLAYTITLE'			=> 'Lecture du diaporama (barre d’espace)',
	'ABBC3_HIGHSLIDE_PAUSETEXT'			=> 'Pause',
	'ABBC3_HIGHSLIDE_PAUSETITLE'		=> 'Arrêter le diaporama (barre d’espace)',
	'ABBC3_HIGHSLIDE_NUMBER'			=> 'Image %1 sur %2',
	'ABBC3_HIGHSLIDE_RESTORETITLE'		=> 'Cliquez pour fermer l’image. Cliquez et faites glisser pour déplacer. Utilisez les touches fléchées pour suivant et précédent.',

// Text to be applied to the helpline & mouseover & help page & Wizard texts
	'BBCODE_STYLES_TIP'			=> 'Astuce : les styles peuvent être appliqués rapidement au texte sélectionné.',

	'ABBC3_ERROR'				=> 'Erreur: ',
	'ABBC3_ERROR_TAG'			=> 'Erreur inattendue lors de l’utilisation de la balise : ',
	'ABBC3_NO_EXAMPLE'			=> 'Aucun exemple de données',

	'ABBC3_ID'					=> 'Saisissez l’identifiant :',
	'ABBC3_NOID'				=> 'Vous n’avez pas saisi l’identifiant',
	'ABBC3_LINK'				=> 'Saisissez un lien pour ',
	'ABBC3_DESC'				=> 'Saisissez une description pour ',
	'ABBC3_NAME'				=> 'Description',
	'ABBC3_NOLINK'				=> 'Vous n’avez pas saisi de lien pour ',
	'ABBC3_NODESC'				=> 'Vous n’avez pas saisi de description pour ',
	'ABBC3_WIDTH'				=> 'Saisissez la largeur',
	'ABBC3_WIDTH_NOTE'			=> 'Remarque : la valeur peut être exprimée en pourcentage.',
	'ABBC3_NOWIDTH'				=> 'Vous n’avez pas saisi de largeur',
	'ABBC3_HEIGHT'				=> 'Saisissez la hauteur',
	'ABBC3_HEIGHT_NOTE'			=> 'Remarque : la valeur peut être exprimée en pourcentage.',
	'ABBC3_NOHEIGHT'			=> 'Vous n’avez pas saisi de hauteur',

	'ABBC3_NOTE'				=> 'Remarque',
	'ABBC3_EXAMPLE'				=> 'Exemple',
	'ABBC3_EXAMPLES'			=> 'Exemples',
	'ABBC3_SHORT'				=> 'Sélectionnez le BBCode',
	'ABBC3_DEPRECATED'			=> '<div class="error">Le BBCode <em>%1$s</em> a été abandonné depuis la version <em>%2$s</em> d’ABBC3</div>',
	'ABBC3_UNAUTHORISED'		=> 'Vous ne pouvez pas utiliser certains mots : <br/><strong>%s</strong>',
	'ABBC3_NOSCRIPT'			=> 'Votre navigateur a désactivé les scripts ou il ne prend pas en charge le script côté client <em>( JavaScript ! )</em>.',
	'ABBC3_NOSCRIPT_EXPLAIN'	=> 'La page que vous voyez nécessite l’utilisation de JavaScript pour de meilleures performances.<br/>Si vous avez volontairement désactivé JavaScript, merci de l’activer.',
	'ABBC3_FUNCTION_DISABLED'	=> 'Cette fonction n’est pas disponible sur ce forum.',
	'ABBC3_AJAX_DISABLED'		=> 'Votre navigateur ne supporte pas AJAX (XMLHttpRequest) et n’a pas pu traiter cette demande.',
	'ABBC3_SUBMIT'				=> 'Insérer dans le message',
	'ABBC3_SUBMIT_SIG'			=> 'Insérer dans la signature',
	'SAMPLE_TEXT'				=> 'Il s’agit d’un exemple de texte',
	'DEPRECATED_BBCODE'			=> '<strong class="error">Remarque :</strong> ce BBCode est obsolète et a été remplacé par BBvideo.',
));

/**
* TRANSLATORS PLEASE NOTE
*	Several lines have an special note like "##	For translator: " followed by "yes" and "no"
*	These are lines with mixed code and language. For these lines you can translate anything
*	under a "yes" but do not change any text under a "no"
**/
$lang = array_merge($lang, array(
// bbcodes texts
	// Font Type Dropdown
	'ABBC3_FONT_MOVER'			=> 'Police de texte',
	'ABBC3_FONT_TIP'			=> '[font=Comic Sans MS]texte[/font]',
	'ABBC3_FONT_NOTE'			=> 'Remarque: vous pouvez définir d’autres polices.',
	'ABBC3_FONT_VIEW'			=> '[font=Comic Sans MS]' . $lang['SAMPLE_TEXT'] . '[/font]',

	// Font family Groups
	'ABBC3_FONT_ABBC3'			=> 'ABBC Box 3',
	'ABBC3_FONT_SAFE'			=> 'Liste déroulante',
	'ABBC3_FONT_WIN'			=> 'Win par défaut',

	// Font Size Dropdown
	'ABBC3_FONT_GIANT'			=> 'Très grande',
	'ABBC3_SIZE_MOVER'			=> 'Taille de la police',
	'ABBC3_SIZE_TIP'			=> '[size=150]grand texte[/size]',
	'ABBC3_SIZE_NOTE'			=> 'Remarque : la valeur peut être exprimée en pourcentage.',
	'ABBC3_SIZE_VIEW'			=> '[size=150]' . $lang['SAMPLE_TEXT'] . '[/size]',

	// Highlight Font Color Dropdown
	'ABBC3_HIGHLIGHT_MOVER'		=> 'Surligner',
	'ABBC3_HIGHLIGHT_TIP'		=> '[highlight=yellow]texte[/highlight]',
	'ABBC3_HIGHLIGHT_NOTE'		=> 'Remarque : vous pouvez utiliser les valeurs hexadécimales (color=#FF0000 ou color=red).',
	'ABBC3_HIGHLIGHT_VIEW'		=> '[highlight=yellow]' . $lang['SAMPLE_TEXT'] . '[/highlight]',

	// Font Color Dropdown
	'ABBC3_COLOR_MOVER'			=> 'Couleur de la police',
	'ABBC3_COLOR_TIP'			=> '[color=red]texte[/color]',
	'ABBC3_COLOR_NOTE'			=> 'Remarque : vous pouvez utiliser les valeurs hexadécimales (color=#FF0000 ou color=red).',
	'ABBC3_COLOR_VIEW'			=> '[color=red]' . $lang['SAMPLE_TEXT'] . '[/color]',

	// Tigra Color & Highlight family Groups
	'ABBC3_COLOUR_TIGRA'		=> 'Tigra Color Picker',
	'ABBC3_COLOUR_SAFE'			=> 'Liste des palettes',
	'ABBC3_COLOUR_WIN'			=> 'Palette Système Windows',
	'ABBC3_COLOUR_GREY'			=> 'Palette des niveaux de gris',
	'ABBC3_COLOUR_MAC'			=> 'Palette Mac OS',
	'ABBC3_SAMPLE'				=> 'Échantillon',

	// Cut selected text
	'ABBC3_CUT_MOVER'			=> 'Supprimer le texte sélectionné',
	// Copy selected text
	'ABBC3_COPY_MOVER'			=> 'Copier le texte sélectionné',
	// Paste previously copy text
	'ABBC3_PASTE_MOVER'			=> 'Coller le texte copié',
	'ABBC3_PASTE_ERROR'			=> 'Vous devez d’abord copier une sélection de texte, puis la coller',
	// Remove BBCode (Removes all BBCode tags from selected text)
	'ABBC3_PLAIN_MOVER'			=> 'Supprimer tous les BBCodes du texte sélectionné',
	'ABBC3_NOSELECT_ERROR'		=> 'Aucun texte n’a été sélectionné.',

	// Code
	'ABBC3_CODE_MOVER'			=> 'Code',
	'ABBC3_CODE_TIP'			=> '[code]code[/code]',
	'ABBC3_CODE_VIEW'			=> '[code]' . $lang['SAMPLE_TEXT'] . '[/code]',

	// Quote
	'ABBC3_QUOTE_MOVER'			=> 'Citer',
	'ABBC3_QUOTE_TIP'			=> '[quote]texte[/quote] ou [quote=“membre”]texte[/quote]',
##	For translator:                                                            yes              yes
	'ABBC3_QUOTE_VIEW'			=> '[quote]' . $lang['SAMPLE_TEXT'] . '[/quote] ou [quote=&quot;membre&quot;]' . $lang['SAMPLE_TEXT'] . '[/quote]',

	// Spoiler
	'ABBC3_SPOIL_MOVER'			=> 'Spoiler',
	'ABBC3_SPOIL_TIP'			=> '[spoil]texte[/spoil]',
	'ABBC3_SPOIL_VIEW'			=> '[spoil]' . $lang['SAMPLE_TEXT'] . '[/spoil]',
	'SPOILER_SHOW'				=> 'Voir le texte',
	'SPOILER_HIDE'				=> 'Cacher le texte',

	// Hidden
	'ABBC3_HIDDEN_MOVER'		=> 'Cacher le contenu aux invités',
	'ABBC3_HIDDEN_TIP'			=> '[hidden]texte[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=> 'La fonction « Cacher » est désactivée',
	'HIDDEN_ON'					=> 'La fonction « Cacher » est activée',
	'HIDDEN_EXPLAIN'			=> 'Le forum vous oblige à être enregistré et connecté, pour pouvoir lire le contenu caché.',

	// Moderator tag
	'ABBC3_MOD_MOVER'			=> 'Message des Modérateurs',
	'ABBC3_MOD_TIP'				=> '[mod=Nom]texte[/mod]',
##	For translator:                      yes
	'ABBC3_MOD_VIEW'			=> '[mod=Nom_Modérateur]' . $lang['SAMPLE_TEXT'] . '[/mod]',

	// Off Topic
	'OFFTOPIC'					=> 'Hors Sujet',
	'ABBC3_OFFTOPIC_MOVER'		=> 'Insérer un texte hors sujet',
	'ABBC3_OFFTOPIC_TIP'		=> '[offtopic]texte[/offtopic]',
	'ABBC3_OFFTOPIC_VIEW'		=> '[offtopic]' . $lang['SAMPLE_TEXT'] . '[/offtopic]',

	// SCRIPPET
	'ABBC3_SCRIPPET_MOVER'		=> 'Dialogue',
	'ABBC3_SCRIPPET_TIP'		=> '[scrippet]Texte du dialogue[/scrippet]',
##	For translator:                 don't change the "<br />" and don't join the lines in one !
	'ABBC3_SCRIPPET_VIEW'		=> '[scrippet]ROME ANTIQUE - JOUR<br />' . "\n" . 'ANTONIUS et IPSUM se promènent dans une minuscule rue bondée.<br />' . "\n" . 'ANTONIUS<br />' . "\n" . 'Pensez-vous que dans mille ans, tout le monde se souviendra de nos noms ?<br />' . "\n" . 'IPSUM<br />' . "\n" . 'Pas du vôtre. Mais ils vont connaître le mien. Car j’ai l’intention d’écrire quelque chose dont ils se souviendront tous dans l’avenir. Les Designers du 20ème siècle l’appelleront Lorem Ipsum et l’utiliseront pour remplir les blocs de texte.[/scrippet]',

	// Tabs
	'ABBC3_TABS_MOVER'			=> 'Onglets',
	'ABBC3_TABS_TIP'			=> '[tabs] [tabs:Title]Titre d’un onglet[tabs:Another]Contenu de l’onglet[/tabs]',
##   For translator:                          yes                               yes                                                                                                                                                          yes                Yes
	'ABBC3_TABS_VIEW'			=> '[tabs] [tabs:Titre de l’onglet]&nbsp;Tout le contenu en dessous de cette balise sera affiché à l’intérieur de l’onglet, jusqu’à ce qu’un autre onglet soit déclaré avec : &#91;tabs:XXX&#93;.[tabs:Autre onglet]&nbsp;Et ainsi de suite… jusqu’à la fin de la page où vous pouvez éventuellement utiliser &#91;/tabs&#93; pour mettre fin au dernier onglet et afficher du texte normal en dehors des onglets.[/tabs]',

	// NFO
	'ABBC3_NFO_TITLE'			=> 'Texte NFO',
	'ABBC3_NFO_MOVER'			=> 'Texte NFO (Seulement pour Internet Explorer)',
	'ABBC3_NFO_TIP'				=> '[nfo]Texte NFO[/nfo]',
	'ABBC3_NFO_VIEW'			=> '[nfo]         /\_/\
    ____/ o o \
  /~____  =ø= /
 (______)__m_m)
[/nfo]',

	// Justify Align
	'ABBC3_ALIGNJUSTIFY_MOVER'	=> 'Texte justifié',
	'ABBC3_ALIGNJUSTIFY_TIP'	=> '[align=justify]texte[/align]',
	'ABBC3_ALIGNJUSTIFY_VIEW'	=> '[align=justify]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Right Align
	'ABBC3_ALIGNRIGHT_MOVER'	=> 'Texte aligné à droite',
	'ABBC3_ALIGNRIGHT_TIP'		=> '[align=right]texte[/align]',
	'ABBC3_ALIGNRIGHT_VIEW'		=> '[align=right]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Center Align
	'ABBC3_ALIGNCENTER_MOVER'	=> 'Texte aligné au centre',
	'ABBC3_ALIGNCENTER_TIP'		=> '[align=center]texte[/align]',
	'ABBC3_ALIGNCENTER_VIEW'	=> '[align=center]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Left Align
	'ABBC3_ALIGNLEFT_MOVER'		=> 'Texte aligné à gauche',
	'ABBC3_ALIGNLEFT_TIP'		=> '[align=left]texte[/align]',
	'ABBC3_ALIGNLEFT_VIEW'		=> '[align=left]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Preformat
	'ABBC3_PRE_MOVER'			=> 'Text préformaté',
	'ABBC3_PRE_TIP'				=> '[pre]texte[/pre]',
	'ABBC3_PRE_VIEW'			=> '[pre]' . $lang['SAMPLE_TEXT'] . '<br />		' . $lang['SAMPLE_TEXT'] . '[/pre]',

	// Tab
	'ABBC3_TAB_MOVER'			=> 'Créer une indentation',
	'ABBC3_TAB_TIP'				=> '[tab=nn]',
	'ABBC3_TAB_NOTE'			=> 'Saisissez un nombre qui sera l’indentation mesurée en pixels.',
	'ABBC3_TAB_VIEW'			=> '[tab=30]' . $lang['SAMPLE_TEXT'],

	// Superscript
	'ABBC3_SUP_MOVER'			=> 'Texte en exposant',
	'ABBC3_SUP_TIP'				=> '[sup]texte[/sup]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUP_VIEW'			=> 'C’est un texte normal [sup]' . $lang['SAMPLE_TEXT'] . '[/sup] c’est un texte normal',

	// Subscript
	'ABBC3_SUB_MOVER'			=> 'Texte en indice',
	'ABBC3_SUB_TIP'				=> '[sub]text[/sub]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUB_VIEW'			=> 'C’est un texte normal [sub]' . $lang['SAMPLE_TEXT'] . '[/sub] c’est un texte normal',

	// Bold
	'ABBC3_B_MOVER'				=> 'Texte en gras',
	'ABBC3_B_TIP'				=> '[b]texte[/b]',
	'ABBC3_B_VIEW'				=> '[b]' . $lang['SAMPLE_TEXT'] . '[/b]',

	// Italic
	'ABBC3_I_MOVER'				=> 'Texte en italique',
	'ABBC3_I_TIP'				=> '[i]texte[/i]',
	'ABBC3_I_VIEW'				=> '[i]' . $lang['SAMPLE_TEXT'] . '[/i]',

	// Underline
	'ABBC3_U_MOVER'				=> 'Texte souligné',
	'ABBC3_U_TIP'				=> '[u]texte[/u]',
	'ABBC3_U_VIEW'				=> '[u]' . $lang['SAMPLE_TEXT'] . '[/u]',

	// Strikethrough
	'ABBC3_S_MOVER'				=> 'Texte barré',
	'ABBC3_S_TIP'				=> '[s]texte[/s]',
	'ABBC3_S_VIEW'				=> '[s]' . $lang['SAMPLE_TEXT'] . '[/s]',

	// Text Fade
	'ABBC3_FADE_MOVER'			=> 'Texte fondu / normal',
	'ABBC3_FADE_TIP'			=> '[fade]texte[/fade]',
	'ABBC3_FADE_VIEW'			=> '[fade]' . $lang['SAMPLE_TEXT'] . '[/fade]',

	// Text Gradient
	'ABBC3_GRAD_MOVER'			=> 'Texte multi-couleurs',
	'ABBC3_GRAD_TIP'			=> 'Sélectionnez du texte en premier',
	'ABBC3_GRAD_VIEW'			=> '[color=#40FF00]u[/color][color=#B6FF00]n[/color] [color=#F0FF00]a[/color][color=#DD9845]r[/color][color=#BF4A94]c[/color] [color=#BF5EBB]e[/color][color=#BF71E2]n[/color] [color=#B57BFF]c[/color][color=#8E67FF]i[/color][color=#6754FF]e[/color][color=#4040FF]l[/color]',
	'ABBC3_GRAD_MIN_ERROR'		=> 'Aucun texte n’a été sélectionné.',
	'ABBC3_GRAD_MAX_ERROR'		=> 'Seulement les textes sélectionnés de moins de 120 caractères sont autorisés.',
	'ABBC3_GRAD_COLORS'			=> 'Couleurs pré-choisies',
	'ABBC3_GRAD_ERROR'			=> 'Erreur: échec du code couleur',

	// Glow text
	'ABBC3_GLOW_MOVER'			=> 'Lueur de texte',
	'ABBC3_GLOW_TIP'			=> '[glow=couleur]texte[/glow]',
	'ABBC3_GLOW_VIEW'			=> '[glow=red]' . $lang['SAMPLE_TEXT'] . '[/glow]',

	// Shadow text
	'ABBC3_SHADOW_MOVER'		=> 'Ombre de texte',
	'ABBC3_SHADOW_TIP'			=> '[shadow=couleur]texte[/shadow]',
	'ABBC3_SHADOW_VIEW'			=> '[shadow=blue]' . $lang['SAMPLE_TEXT'] . '[/shadow]',

	// Dropshadow text
	'ABBC3_DROPSHADOW_MOVER'	=> 'Ombre portée de texte',
	'ABBC3_DROPSHADOW_TIP'		=> '[dropshadow=couleur]texte[/dropshadow]',
	'ABBC3_DROPSHADOW_VIEW'		=> '[dropshadow=blue]' . $lang['SAMPLE_TEXT'] . '[/dropshadow]',

	// Blur text
	'ABBC3_BLUR_MOVER'			=> 'Texte flou',
	'ABBC3_BLUR_TIP'			=> '[blur=(couleur)]texte[/blur]',
	'ABBC3_BLUR_VIEW'			=> '[blur=blue]' . $lang['SAMPLE_TEXT'] . '[/blur]',

	// Wave text
	'ABBC3_WAVE_MOVER'			=> 'Déferlement de texte (Seulement pour Internet Explorer)',
	'ABBC3_WAVE_TIP'			=> '[wave=couleur]texte[/wave]',
	'ABBC3_WAVE_VIEW'			=> '[wave=blue]' . $lang['SAMPLE_TEXT'] . '[/wave]',

	// Unordered List
	'ABBC3_LISTB_MOVER'			=> 'Liste à puces',
	'ABBC3_LISTB_TIP'			=> '[list]texte[/list]',
	'ABBC3_LISTB_NOTE'			=> 'Remarque: utilisez [*] pour créer une ligne',
##	For translator:                          yes      yes      yes           yes         yes            yes                yes
	'ABBC3_LISTB_VIEW'			=> '[list][*]Exemple 1[*]Exemple 2[*]Exemple 3[/list] ou [list][*]Exemple 1[list][*]Sous-Exemple 1[list][*]Sous-sous-Exemple 1[/list][/list][/list]',

	// Ordered List
	'ABBC3_LISTO_MOVER'			=> 'Liste à chiffres ou lettres',
	'ABBC3_LISTO_TIP'			=> '[list=1|a|A|i|I]texte[/list]',
	'ABBC3_LISTO_NOTE'			=> 'Remarque: utilisez [*] pour créer une ligne',
##	For translator:                            yes      yes     yes          yes           yes      yes      yes           yes           yes      yes      yes           yes           yes      yes       yes             yes           yes      yes       yes
	'ABBC3_LISTO_VIEW'			=> '[list=1][*]Exemple 1[*]Exemple 2[*]Exemple 3[/list] ou [list=a][*]Exemple a[*]Exemple b[*]Exemple c[/list] ou [list=A][*]Exemple A[*]Exemple B[*]Exemple C[/list] ou [list=i][*]Exemple i[*]Exemple ii[*]Exemple iii[/list] ou [list=I][*]Exemple I[*]Exemple II[*]Exemple III[/list]',

	// List item
	'ABBC3_LISTITEM_MOVER'		=> 'Ligne d’une liste',
	'ABBC3_LISTITEM_TIP'		=> '[*]texte',
	//'ABBC3_LISTITEM_NOTE'		=> 'Remarque: crée des lignes dans une liste',

	// Line Break
	'ABBC3_HR_MOVER'			=> 'Ligne horizontale',
	'ABBC3_HR_TIP'				=> '[hr]',
	'ABBC3_HR_NOTE'				=> 'Remarque : créé une ligne horizontale pour séparer le texte',
	'ABBC3_HR_VIEW'				=> $lang['SAMPLE_TEXT'] . '[hr]' . $lang['SAMPLE_TEXT'],

	// Message Box text direction right to Left
	'ABBC3_DIRRTL_MOVER'		=> 'Sens du texte pour la lecture de droite à gauche',
	'ABBC3_DIRRTL_TIP'			=> '[dir=rtl]texte[/dir]',
	'ABBC3_DIRRTL_VIEW'			=> '[dir=rtl]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Message Box text direction Left to right
	'ABBC3_DIRLTR_MOVER'		=> 'Sens du texte pour la lecture de gauche à droite',
	'ABBC3_DIRLTR_TIP'			=> '[dir=ltr]texte[/dir]',
	'ABBC3_DIRLTR_VIEW'			=> '[dir=ltr]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Marquee Down
	'ABBC3_MARQDOWN_MOVER'		=> 'Texte défilant vers le bas',
	'ABBC3_MARQDOWN_TIP'		=> '[marq=down]texte[/marq]',
	'ABBC3_MARQDOWN_VIEW'		=> '[marq=down]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Up
	'ABBC3_MARQUP_MOVER'		=> 'Texte défilant vers le haut',
	'ABBC3_MARQUP_TIP'			=> '[marq=up]texte[/marq]',
	'ABBC3_MARQUP_VIEW'			=> '[marq=up]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Right
	'ABBC3_MARQRIGHT_MOVER'		=> 'Texte défilant vers la droite',
	'ABBC3_MARQRIGHT_TIP'		=> '[marq=right]texte[/marq]',
	'ABBC3_MARQRIGHT_VIEW'		=> '[marq=right]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Left
	'ABBC3_MARQLEFT_MOVER'		=> 'Texte défilant vers la gauche',
	'ABBC3_MARQLEFT_TIP'		=> '[marq=left]texte[/marq]',
	'ABBC3_MARQLEFT_VIEW'		=> '[marq=left]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Table row cell wizard
	'ABBC3_TABLE_MOVER'			=> 'Insérer un tableau',
	'ABBC3_TABLE_TIP'			=> '[table=(style CSS)][tr=(style CSS)][td=(style CSS)]texte[/td][/tr][/table]',
	'ABBC3_TABLE_VIEW'			=> '[table=width:50%;border:1px solid #cccccc][tr=text-align:center][td=border:1px solid #cccccc]' . $lang['SAMPLE_TEXT'] . '[/td][/tr][/table]',

	'ABBC3_TABLE_STYLE'			=> 'Saisissez le style CSS du tableau',
	'ABBC3_TABLE_EXAMPLE'		=> 'width:50%;border:1px solid #cccccc;',

	'ABBC3_ROW_NUMBER'			=> 'Saisissez le nombre de lignes du tableau',
	'ABBC3_ROW_ERROR'			=> 'Vous n’avez pas saisi le nombre de lignes',
	'ABBC3_ROW_STYLE'			=> 'Saisisez le style CSS de la ligne',
	'ABBC3_ROW_EXAMPLE'			=> 'text-align: center;',

	'ABBC3_CELL_NUMBER'			=> 'Saisissez le nombre de cellules',
	'ABBC3_CELL_ERROR'			=> 'Vous n’avez pas saisi le nombre de cellules',
	'ABBC3_CELL_STYLE'			=> 'Saisisez le style CSS de la cellule',
	'ABBC3_CELL_EXAMPLE'		=> 'border: 1px solid #cccccc;',

	// Anchor
	'ABBC3_ANCHOR_MOVER'		=> 'Ancre',
	'ABBC3_ANCHOR_TIP'			=> '[anchor=(nom de l’ancre) goto=(nom d’une autre ancre)]texte[/anchor]',
	'ABBC3_ANCHOR_EXAMPLE'		=> '[anchor=a1 goto=a2]Allez à l’ancre a2[/anchor]',
##	For translate :                                           yes                         Yes               Yes
	'ABBC3_ANCHOR_VIEW'			=> '[anchor=aide_0 goto=aide_1]Aller au lien 1[/anchor]<br/> ou  [anchor=aide_1]c’est le lien 1[/anchor]',

	// Hyperlink Wizard
	'ABBC3_URL_TAG'				=> 'page',
	'ABBC3_URL_MOVER'			=> 'Site Internet',
	'ABBC3_URL_TIP'				=> '[url]http://url[/url] ou [url=http://url]Nom du site[/url]',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.mssti.com',
	'ABBC3_URL_VIEW'			=> '[url=http://www.phpbb.com]Visitez phpbb.com ![/url]',

	// Email Wizard
	'ABBC3_EMAIL_TAG'			=> 'email',
	'ABBC3_EMAIL_MOVER'			=> 'Adresse e-mail',
	'ABBC3_EMAIL_TIP'			=> '[email]user@server.ext[/email] ou [email=user@server.ext]Mon adresse e-mail[/email]',
	'ABBC3_EMAIL_EXAMPLE'		=> 'user@server.ext',
	'ABBC3_EMAIL_VIEW'			=> '[email=user@server.ext]user@server.ext[/email]',

	// Ed2k link Wizard
	'ABBC3_ED2K_TAG'			=> 'ed2k',
	'ABBC3_ED2K_MOVER'			=> 'Lien ed2k',
	'ABBC3_ED2K_TIP'			=> '[url]lien ed2k[/url] ou [url=lien ed2k]Nom ed2k[/url]',
	'ABBC3_ED2K_EXAMPLE'		=> 'ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/',
	'ABBC3_ED2K_VIEW'			=> '[url=ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/]The_Two_Towers-The_Purist_Edit-Trailer.avi[/url]',
	'ABBC3_ED2K_ADD'			=> 'Ajouter des liens sélectionnés pour votre client ed2k',
	'ABBC3_ED2K_FRIEND'			=> 'Ami ed2k',
	'ABBC3_ED2K_SERVER'			=> 'Serveur ed2k',
	'ABBC3_ED2K_SERVERLIST'		=> 'Liste des serveurs ed2k',

	// Web included by iframe
	'ABBC3_WEB_TAG'				=> 'web',
	'ABBC3_WEB_MOVER'			=> 'Insérer un site Internet dans un message',
	'ABBC3_WEB_TIP'				=> '[web width=99% height=100]http://url[/web]',
	'ABBC3_WEB_EXAMPLE'			=> 'http://www.phpbb.com',
	'ABBC3_WEB_VIEW'			=> '[web width=99% height=140]http://www.phpbb.com[/web]',
	'ABBC3_WEB_EXPLAIN'			=> '<strong class="error">Remarque:</strong> permet d’insérer des sites Internet dans les messages. Peut constituer un risque pour la sécurité. À utiliser à vos risques et périls ou céder à des groupes de confiance.',

	// Image & Thumbnail Wizard
	'ABBC3_ALIGN_MODE'			=> 'Aligner l’image',
##	For translator:							 Don't				Yes
	'ABBC3_ALIGN_SELECTOR'		=> array(	'none'			=> 'Par défaut',
											'left'			=> 'Gauche',
											'center'		=> 'Centre',
											'right'			=> 'Droite',
											'float-left'	=> 'Flotte à gauche',
											'float-right'	=> 'Flotte à droite'),

	// Image
	'ABBC3_IMG_TAG'				=> 'image',
	'ABBC3_IMG_MOVER'			=> 'Insérer une image',
	'ABBC3_IMG_TIP'				=> '[img]http://image_url[/img] ou [img=left|center|right|float-left|float-right]http://image_url[/img]',
	'ABBC3_IMG_EXAMPLE'			=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_IMG_VIEW'			=> '[img]http://www.google.com/intl/en_com/images/logo_plain.png[/img]',

	// Thumbnail
	'ABBC3_THUMBNAIL_TAG'		=> 'thumbnail',
	'ABBC3_THUMBNAIL_MOVER'		=> 'Insérer une miniature',
	'ABBC3_THUMBNAIL_TIP'		=> '[thumbnail]http://image_url[/thumbnail] ou [thumbnail=left|center|right|float-left|float-right]http://image_url[/thumbnail]',
	'ABBC3_THUMBNAIL_EXAMPLE'	=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_THUMBNAIL_VIEW'		=> '[thumbnail]http://www.google.com/intl/en_com/images/logo_plain.png[/thumbnail]',

	// Imgshack
	'ABBC3_IMGSHACK_MOVER'		=> 'Insérer une image d’Imageshack',
	'ABBC3_IMGSHACK_TIP'		=> '[url=http://imageshack.us][img]http://image_url[/img][/url]',
	'ABBC3_IMGSHACK_VIEW'		=> '[url=http://img22.imageshack.us/my.php?image=abbc3v1012newscreen.gif][img]http://img22.imageshack.us/img22/6241/abbc3v1012newscreen.th.gif[/img][/url]',

	// Rapid share checker
	'ABBC3_RAPIDSHARE_TAG'		=> 'rapidshare',
	'ABBC3_RAPIDSHARE_MOVER'	=> 'Insérer un fichier de Rapidshare',
	'ABBC3_RAPIDSHARE_TIP'		=> '[rapidshare]http://rapidshare.com/files/…[/rapidshare]',
	'ABBC3_RAPIDSHARE_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_RAPIDSHARE_VIEW'		=> '[rapidshare]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/rapidshare]',
	'ABBC3_RAPIDSHARE_GOOD'		=> 'Fichier introuvable sur le serveur !',
	'ABBC3_RAPIDSHARE_WRONG'	=> 'Fichier non trouvé !',

	// testlink
	'ABBC3_CURL_ERROR'			=> '<strong>Erreur :</strong> Désolé mais il semble que cURL n’est pas chargé. Installez-le pour pouvoir utiliser cette fonction.',
	'ABBC3_LOGIN_EXPLAIN_VIEW'	=> 'Ce forum vous oblige à être enregistré et connecté pour afficher les liens.',
	'ABBC3_TESTLINK_TAG'		=> 'Vérificateur de liens',
	'ABBC3_TESTLINK_MOVER'		=> 'Insérer un fichier stocké sur le serveur public',
	'ABBC3_TESTLINK_TIP'		=> '[testlink]http://rapidshare.com/files/…[/testlink]',
	'ABBC3_TESTLINK_NOTE'		=> 'Serveurs valides: Rapidshare, Depositfiles, Megashares.',
	'ABBC3_TESTLINK_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_TESTLINK_VIEW'		=> '[testlink]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/testlink]',
	'ABBC3_TESTLINK_GOOD'		=> 'Fichier introuvable sur le serveur !',
	'ABBC3_TESTLINK_WRONG'		=> 'Fichier non trouvé !',

	// Click counter
	'ABBC3_CLICK_TAG'			=> 'clic',
	'ABBC3_CLICK_MOVER'			=> 'Insérer un lien avec un compteur de clics',
	'ABBC3_CLICK_TIP'			=> '[click]http://url[/click] ou [click=http://url]Nom du site Internet[/click] ou [click][img]http://url[/img][/click]',
	'ABBC3_CLICK_EXAMPLE' 		=> 'http://www.google.com' . ' | ' . 'http://www.google.com/intl/en_com/images/logo_plain.png',
##	For translator:                                                                     yes
	'ABBC3_CLICK_VIEW'			=> '[click=http://www.google.com] Google [/click] ou [click][img]http://www.google.com/intl/en_com/images/logo_plain.png[/img][/click]',
	'ABBC3_CLICK_TIME'			=> '( %d clic )',
	'ABBC3_CLICK_TIMES'			=> '( %d clics )',
	'ABBC3_CLICK_ERROR'			=> '<strong>ERREUR :</strong> merci de saisir un ID valide dans l’URL',

	// Search tag
	'ABBC3_SEARCH_MOVER'		=> 'Insérer un mot à chercher',
	'ABBC3_SEARCH_TIP'			=> '[search]texte[/search] ou [search=bing|yahoo|google|altavista|lycos|wikipedia]texte[/search]',
##	For translator:                                                              yes                                                 yes                                                   yes                                                    yes                                                       yes                                                   yes
	'ABBC3_SEARCH_VIEW'			=> '[search]Advanced BBcode Box 3[/search]<br /> ou [search=bing]Advanced BBcode Box 3[/search]<br /> ou [search=yahoo]Advanced BBcode Box 3[/search]<br /> ou [search=google]Advanced BBcode Box 3[/search]<br /> ou [search=altavista]Advanced BBcode Box 3[/search]<br /> ou [search=lycos]Advanced BBcode Box 3[/search]<br /> ou [search=wikipedia]Advanced BBcode Box 3[/search]',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_TAG'			=> 'BBvideo',
	'ABBC3_BBVIDEO_MOVER'		=> 'Insérer une vidéo',
	'ABBC3_BBVIDEO_TIP'			=> '[BBvideo largeur,hauteur]URL de la vidéo[/BBvideo]',
	'ABBC3_BBVIDEO_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_BBVIDEO_VIEW'		=> '[BBvideo 560,340]http://www.youtube.com/watch?v=sP4NMoJcFd4[/BBvideo]',
	'ABBC3_BBVIDEO_SELECT'		=> 'BBvideo sites et fichiers',
	'ABBC3_BBVIDEO_SELECT_ERROR'=> 'Il n’y a actuellement aucun lien de vidéos autorisé. Avisez l’%sAdministrateur%s de ce problème.<br/>En attendant, vous pouvez poster vos liens vidéos en utilisant le BBCode URL standard.',
	'ABBC3_BBVIDEO_FILE'		=> 'Format de fichier',
	'ABBC3_BBVIDEO_VIDEO'		=> 'Sites autorisés',
	'ABBC3_BBVIDEO_WATCH'		=> 'Regarder sur',

	// Flash (swf) Wizard
	'ABBC3_FLASH_TAG'			=> 'flash',
	'ABBC3_FLASH_MOVER'			=> 'Insérer un fichier Flash (swf)',
	'ABBC3_FLASH_TIP'			=> '[flash width=# height=#]URL du fichier Flash[/flash] ou [flash width,height]URL du fichier Flash[/flash]',
	'ABBC3_FLASH_EXAMPLE'		=> 'http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf',
	'ABBC3_FLASH_VIEW'			=> '[flash 250,200]http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf[/flash]',

	// Flash (flv) Wizard
	'ABBC3_FLV_TAG'				=> 'flash',
	'ABBC3_FLV_MOVER'			=> 'Insérer une vidéo Flash (flv)',
	'ABBC3_FLV_TIP'				=> '[flv width=# height=#]URL de la vidéo Flash[/flv] ou [flv width,height]URL de la vidéo Flash[/flv]',
	'ABBC3_FLV_EXAMPLE'			=> 'http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv',
	'ABBC3_FLV_VIEW'			=> '[flv 250,200]http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flvv[/flv]',
	'ABBC3_FLV_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Streaming Video Wizard
	'ABBC3_VIDEO_TAG'			=> 'video',
	'ABBC3_VIDEO_MOVER'			=> 'Insérer une vidéo',
	'ABBC3_VIDEO_TIP'			=> '[video width=# height=#]URL de la vidéo[/video]',
	'ABBC3_VIDEO_EXAMPLE'		=> 'http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv',
	'ABBC3_VIDEO_VIEW'			=> '[video 250,200]http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv[/video]',
	'ABBC3_VIDEO_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Streaming Audio Wizard
	'ABBC3_STREAM_TAG'			=> 'sound',
	'ABBC3_STREAM_MOVER'		=> 'Insérer un son',
	'ABBC3_STREAM_TIP'			=> '[stream]URL du son[/stream]',
	'ABBC3_STREAM_EXAMPLE'		=> 'http://www.robtowns.com/music/first_noel.mp3',
	'ABBC3_STREAM_VIEW'			=> '[stream]http://www.robtowns.com/music/first_noel.mp3[/stream]',
	'ABBC3_STREAM_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Quicktime
	'ABBC3_QUICKTIME_TAG'		=> 'Quicktime',
	'ABBC3_QUICKTIME_MOVER'		=> 'Insérer une vidéo Quicktime',
	'ABBC3_QUICKTIME_TIP'		=> '[quicktime width=# height=#]URL de la vidéo Quicktime[/quicktime]',
	'ABBC3_QUICKTIME_EXAMPLE'	=> 'http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt',
	'ABBC3_QUICKTIME_VIEW'		=> '[quicktime width=250 height=200]http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt[/quicktime]',
	'ABBC3_QUICKTIME_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// Real Media Wizard
	'ABBC3_RAM_TAG'				=> 'Real Media',
	'ABBC3_RAM_MOVER'			=> 'Insérer une vidéo Real Média',
	'ABBC3_RAM_TIP'				=> '[ram]URL de la vidéo Real Média[/ram]',
	'ABBC3_RAM_EXAMPLE'			=> 'http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram',
	'ABBC3_RAM_VIEW'			=> '[ram width=250 height=200]http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram[/ram]',
	'ABBC3_RAM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Youtube video Wizard
	'ABBC3_YOUTUBE_TAG'			=> 'Youtube Video',
	'ABBC3_YOUTUBE_MOVER'		=> 'Insérer une vidéo Youtube',
	'ABBC3_YOUTUBE_TIP'			=> '[youtube]URL de la vidéo[/youtube]',
	'ABBC3_YOUTUBE_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_YOUTUBE_VIEW'		=> '[youtube]http://www.youtube.com/watch?v=sP4NMoJcFd4[/youtube]',
	'ABBC3_YOUTUBE_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Veoh video
	'ABBC3_VEOH_TAG'			=> 'Veoh',
	'ABBC3_VEOH_MOVER'			=> 'Insérer une vidéo Veoh',
	'ABBC3_VEOH_TIP'			=> '[veoh]URL de la vidéo[/veoh]',
	'ABBC3_VEOH_EXAMPLE'		=> 'http://www.veoh.com/watch/v27458670er62wkCt',
	'ABBC3_VEOH_VIEW'			=> '[veoh]http://www.veoh.com/watch/v27458670er62wkCt[/veoh]',
	'ABBC3_VEOH_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Collegehumor video
	'ABBC3_COLLEGEHOMOR_TAG'	=> 'collegehumor',
	'ABBC3_COLLEGEHUMOR_MOVER'	=> 'Insérer une vidéo Collegehumor',
	'ABBC3_COLLEGEHUMOR_TIP'	=> '[collegehumor]URL de la vidéo Collegehumor[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXAMPLE'=> 'http://www.collegehumor.com/video:1802097',
	'ABBC3_COLLEGEHUMOR_VIEW'	=> '[collegehumor]http://www.collegehumor.com/video:1802097[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXPLAIN'=> $lang['DEPRECATED_BBCODE'],

	// Dailymotion video
	'ABBC3_DM_MOVER'			=> 'Insérer une vidéo Dailymotion',
	'ABBC3_DM_TIP'				=> '[dm]Dailymotion ID[/dm]',
	'ABBC3_DM_EXAMPLE'			=> 'http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
	'ABBC3_DM_VIEW'				=> '[dm]http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport[/dm]',
	'ABBC3_DM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Gamespot video
	'ABBC3_GAMESPOT_MOVER'		=> 'Insérer une vidéo Gamespot',
	'ABBC3_GAMESPOT_TIP'		=> '[gamespot]URL de la vidéo Gamespot[gamespot]',
	'ABBC3_GAMESPOT_EXAMPLE'	=> 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
	'ABBC3_GAMESPOT_VIEW'		=> '[gamespot]http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8[/gamespot]',
	'ABBC3_GAMESPOT_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// IGN video
	'ABBC3_IGNVIDEO_MOVER'		=> 'Insérer une vidéo IGN',
	'ABBC3_IGNVIDEO_TIP'		=> '[ignvideo]URL de la vidéo IGN[/ignvideo]',
	'ABBC3_IGNVIDEO_EXAMPLE'	=> 'http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html',
	'ABBC3_IGNVIDEO_VIEW'		=> '[ignvideo]http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html[/ignvideo]',
	'ABBC3_IGNVIDEO_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// LiveLeak video
	'ABBC3_LIVELEAK_MOVER'		=> 'Insérer une vidéo Liveleak',
	'ABBC3_LIVELEAK_TIP'		=> '[liveleak]URL de la vidéo Liveleak[/liveleak]',
	'ABBC3_LIVELEAK_EXAMPLE'	=> 'http://www.liveleak.com/view?i=166_1194290849',
	'ABBC3_LIVELEAK_VIEW'		=> '[liveleak]http://www.liveleak.com/view?i=166_1194290849[/liveleak]',
	'ABBC3_LIVELEAK_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

// Custom BBCodes

));

?>