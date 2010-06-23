<?php
/**
*
* abbcode [Francais]
* @package language
* @version $Id: abbcode.php, v 1.0.6 2008/01/10 15:25:07 leviatan21 Exp $
* @Francais version $Id: $ phpBB 3.0.0 - 1.0.0
* @copyright leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb2/
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @translator: FNK - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=425835
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
* � - é
* � - è
* � - ê
* � - ë
* � - �
* � - â
* � - ä
* � - î
* � - ï
* � - ò
* � - ô
* � - ù
* � - û
* � - ç
* � = á
* � = �  XX
* � = é
* � = É XX
* � = í
* � = �?
* � = ó
* � = Ó
* � = ú
* � = Ú
* � = ñ
* � = Ñ
* ? = ¿
********************************************************************/

$lang = array_merge($lang, array(
	'BBCODE_STYLES_TIP'			=> 'Astuce : Les balises peuvent être appliquées sur le texte sélectionné.',
	
	// Dropdown titles options
	'ABBCODE_FONT_TYPE'			=> 'Police',
	'ABBCODE_FONT_SIZE'			=> 'Taille de la police',
	'ABBCODE_FONT_HILI'			=> 'Surlignage',
	'ABBCODE_FONT_GIANT'		=> 'Enorme',
	
	// Text to be applied to the helpline & mouseover
	'ABBCODE_JUSTIFY_MOVER'		=> 'Texte justifié',
	'ABBCODE_JUSTIFY_HELP'		=> ' [align=justify]texte[/align]',

	'ABBCODE_RIGHT_MOVER'		=> 'Texte aligné sur la droite',
	'ABBCODE_RIGHT_HELP'		=> ' [align=right]texte[/align]',

	'ABBCODE_CENTER_MOVER'		=> 'Texte centré',
	'ABBCODE_CENTER_HELP'		=> ' [align=center]texte[/align]',

	'ABBCODE_LEFT_MOVER'		=> 'Texte aligné sur la gauche',
	'ABBCODE_LEFT_HELP'			=> ' [align=left]texte[/align]',

	'ABBCODE_PRE_MOVER'			=> 'Texte préformaté',
	'ABBCODE_PRE_HELP'			=> ' [pre]texte[/pre]',

	'ABBCODE_SUP_MOVER'			=> 'Texte en exposant',
	'ABBCODE_SUP_HELP'			=> ' [sup]texte[/sup]',

	'ABBCODE_SUB_MOVER'			=> 'Texte en indice',
	'ABBCODE_SUB_HELP'			=> ' [sub]texte[/sub]',

	'ABBCODE_BOLD_MOVER'		=> 'Texte en gras',
	'ABBCODE_BOLD_HELP'			=> ' [b]texte[/b]',

	'ABBCODE_ITA_MOVER'			=> 'Texte en italique',
	'ABBCODE_ITA_HELP'			=> ' [i]texte[/i]',

	'ABBCODE_UNDER_MOVER'		=> 'Texte souligné',
	'ABBCODE_UNDER_HELP'		=> ' [u]texte[/u]',

	'ABBCODE_STRIKE_MOVER'		=> 'Texte barré',
	'ABBCODE_STRIKE_HELP'		=> ' [s]texte[/s]',

	'ABBCODE_FADE_MOVER'		=> 'Texte en fondu',
	'ABBCODE_FADE_HELP'			=> ' [fade]texte[/fade]',

	'ABBCODE_GRAD_MOVER'		=> 'Texte en arc en ciel',
	'ABBCODE_GRAD_HELP'			=> ' [grad]texte[/grad]',

	'ABBCODE_RTL_MOVER'			=> 'Texte se lisant de la droite vers la gauche',
	'ABBCODE_RTL_HELP'			=> ' [dir=rtl]texte[/dir]',

	'ABBCODE_LTR_MOVER'			=> 'Texte se lisant de la gauche vers la droite',
	'ABBCODE_LTR_HELP'			=> ' [dir=LTR]texte[/dir]',

	'ABBCODE_MARQD_MOVER'		=> 'Texte se déplacant vers le bas',
	'ABBCODE_MARQD_HELP'		=> ' [marq=down]texte[/marq]',

	'ABBCODE_MARQU_MOVER'		=> 'Texte se déplacant vers le haut',
	'ABBCODE_MARQU_HELP'		=> ' [marq=up]texte[/marq]',

	'ABBCODE_MARQR_MOVER'		=> 'Texte se déplacant vers la droite',
	'ABBCODE_MARQR_HELP'		=> ' [marq=right]texte[/marq]',

	'ABBCODE_MARQL_MOVER'		=> 'Texte se déplacant vers la gauche',
	'ABBCODE_MARQL_HELP'		=> ' [marq=left]texte[/marq]',

	'ABBCODE_TABLE_MOVER'		=> 'Insérer un tableau',
	'ABBCODE_TABLE_HELP'		=> ' [table=(ccs style)][tr=(ccs style)][td=(ccs style)]texte[/td][/tr][/table]',

	'ABBCODE_QUOTE_MOVER'		=> 'Citer',
	'ABBCODE_QUOTE_HELP'		=> ' [quote]texte[/quote] ou [quote=\"membre\"]texte[/quote]',

	'ABBCODE_CODE_MOVER'		=> 'Insérer du code',
	'ABBCODE_CODE_HELP'			=> ' [code]texte[/code]',

	'ABBCODE_SPOIL_MOVER'		=> 'Créer un spoiler',
	'ABBCODE_SPOIL_HELP'		=> ' [spoil]texte[/spoil]',

	'ABBCODE_ED2K_MOVER'		=> 'Lien eD2K',
	'ABBCODE_ED2K_HELP'			=> ' [url]link ed2k[/url] ou [url=lien eD2K]Nom du lien eD2K[/url]',

	'ABBCODE_URL_MOVER'			=> 'Site internet',
	'ABBCODE_URL_HELP'			=> ' [url]http://...[/url] ou [url=http://...]Nom du site[/url]',

	'ABBCODE_EMAIL_MOVER'		=> 'Email',
	'ABBCODE_EMAIL_HELP'		=> ' [email]utilisateur@domaine.fr[/email] ou [email=utilisateur@domaine.fr]utilisateur[/email]',

	'ABBCODE_WEB_MOVER'			=> 'Insérer un site dans le message',
	'ABBCODE_WEB_HELP'			=> ' [web]Adresse du site[/web]',

	'ABBCODE_IMG_MOVER'			=> 'Insérer une image',
	'ABBCODE_IMG_HELP'			=> ' [img]http://...[/img]',

	'ABBCODE_THUMB_MOVER'		=> 'Insérer une vignette',
	'ABBCODE_THUMB_HELP'		=> ' [thumbnail(=left|right)]http://...[/thumbnail]',

	'ABBCODE_IMGSHARK_MOVER'	=> 'Insérer une image sur imageshack',
	'ABBCODE_IMGSHARK_HELP'		=> ' [url=http://imageshack.us][img=http://...][/img][/url]',

	'ABBCODE_FLASH_MOVER'		=> 'Insérer un fichier Flash (swf)',
	'ABBCODE_FLASH_HELP'		=> ' [flash width=# height=#]Adresse du flash[/flash]',

	'ABBCODE_VIDEO_MOVER'		=> 'Insérer une vidéo',
	'ABBCODE_VIDEO_HELP'		=> ' [video width=# height=#]Adresse de la vidéo[/video]',

	'ABBCODE_STREAM_MOVER'		=> 'Insérer un fichier audio',
	'ABBCODE_STREAM_HELP'		=> ' [stream]Adresse du fichier audio[/stream]',

	'ABBCODE_RAM_MOVER'			=> 'Insérer un fichier Real Media (ram ou rm)',
	'ABBCODE_RAM_HELP'			=> ' [ram]Adresse du fichier Real Media[/ram]',

	'ABBCODE_QUICKTIME_MOVER'	=> 'Insérer un fichier Quick time',
	'ABBCODE_QUICKTIME_HELP'	=> ' [quicktime width=# height=#]URL Quick time[/quicktime]',

	'ABBCODE_STAGE6_MOVER'		=> 'Insérer une vidéo publiée sur Stage6',
	'ABBCODE_STAGE6_HELP'		=> ' [stage6]Identifiant Stage6[/stage6]',

	'ABBCODE_GVIDEO_MOVER'		=> 'Insérer une vidéo publiée sur GoogleVidéo',
	'ABBCODE_GVIDEO_HELP'		=> ' [GVideo]Adresse de la vidéo[/GVideo]',

	'ABBCODE_YOUTUBE_MOVER'		=> 'Insérer une vidéo publiée sur Youtube',
	'ABBCODE_YOUTUBE_HELP'		=> ' [youtube]Adresse de la vidéo[/youtube]',

	'ABBCODE_LISTB_MOVER'		=> 'Liste a puces',
	'ABBCODE_LISTB_HELP'		=> ' [list]texte[/list] Note: Utiliser [*] pour créer une puce',

	'ABBCODE_LISTM_MOVER'		=> 'Liste ordonnée',
	'ABBCODE_LISTM_HELP'		=> ' [list=1|a]texte[/list] Note: Utiliser [*] pour créer une puce',

	'ABBCODE_HR_MOVER'			=> 'Ligne de séparation',
	'ABBCODE_HR_HELP'			=> ' [hr] Note: Créer une ligne pour séparer du texte',

	'ABBCODE_TEXTC_MOVER'		=> 'Couleur du texte',
	'ABBCODE_TEXTC_HELP'		=> ' [color=red]texte[/color] Note: Vous pouvez utiliser le code de couleur HTML (color=#FF0000 ou color=red)',

	'ABBCODE_TEXTS_MOVER'		=> 'Taille de la police',
	'ABBCODE_TEXTS_HELP'		=> ' [size=300]texte[/size] Note: La valeur spécifiée sera interprétée comme un pourcentage',

	'ABBCODE_TEXTF_MOVER'		=> 'Choix de la police',
	'ABBCODE_TEXTF_HELP'		=> ' [font=Tahoma]texte[/font]',

	'ABBCODE_TEXTH_MOVER'		=> 'Texte surligné',
	'ABBCODE_TEXTH_HELP'		=> ' [highlight=red]texte[/highlight] Note: Vous pouvez utiliser le code de couleur HTML (color=#FF0000 ou color=red)',

	'ABBCODE_CUT_MOVER'			=> 'Supprimer le texte sélectionné',
	'ABBCODE_COPY_MOVER'		=> 'Copier le texte sélectionné',
	'ABBCODE_PASTE_MOVER'		=> 'Coller le texte copié',
	'ABBCODE_PLAIN_MOVER'		=> 'Supprimer les balises BBCodes du texte sélectionné',
	'ABBCODE_PASTE_ERROR'		=> 'Merci de premi�re copie le texte, de les coller ',
	'ABBCODE_NOSELECT_ERROR'	=> 'Merci de sélectionner d’abord le texte ',
	
	// Wizard texts
	'ABBCODE_ERROR'				=> 'Erreur : ',
	'ABBCODE_ERROR_TAG'			=> 'Erreur inattendue en utilisant les balises BBCode : ',

	'ABBCODE_ID'				=> 'Entrer l’identifiant :',
	'ABBCODE_NOID'				=> 'Vous n’avez pas spécifié l’identifiant',
	'ABBCODE_LINK'				=> 'Entrer le lien pour ',
	'ABBCODE_DESC'				=> 'Entrer une description du lien pour ',
	'ABBCODE_NAME'				=> 'Description',
	'ABBCODE_NOLINK'			=> 'Vous n’avez pas spécifié de lien pour ',
	'ABBCODE_NODESC'			=> 'Vous n’avez pas spécifié de description pour ',
	'ABBCODE_WIDTH'				=> 'Entrer la largeur',
	'ABBCODE_WIDTH_NOTE'		=> 'Note: La valeur peut être exprimée en pourcentage',
	'ABBCODE_NOWIDTH'			=> 'Vous n’avez pas spécifié la largeur',
	'ABBCODE_HEIGHT'			=> 'Entrer la hauteur',
	'ABBCODE_HEIGHT_NOTE'		=> 'Note: La valeur peut être exprimée en pourcentage',
	'ABBCODE_NOHEIGHT'			=> 'Vous n’avez pas spécifié la hauteur',
	
	'ABBCODE_ED2K_TAG'			=> 'eD2K',
	'ABBCODE_ED2K_NOTE' 		=> '', //'Exemple: ed2k://|file|Robin.Hood.S02E01.Sisterhood.HDTV.XviD-BiA.avi|367335424|6EB031138DE4A80997A13C272760202F|h=CJZXHKH25ZONIMWVUOENVQKJSZDV5JI6|/',

	'ABBCODE_URL_TAG'			=> 'page',
	'ABBCODE_URL_NOTE' 			=> 'Exemple: http://www.google.com',

	'ABBCODE_WEB_TAG'			=> 'adresse',
	'ABBCODE_WEB_NOTE'			=> 'Exemple: http://www.google.com',

	'ABBCODE_EMAIL_TAG'			=> 'email',
	'ABBCODE_EMAIL_NOTE' 		=> 'Exemple: user@server.ext',

	'ABBCODE_IMG_TAG'			=> 'image',
	'ABBCODE_IMG_NOTE'			=> 'Exemple: http://www.google.com/intl/en_com/images/logo_plain.png',

	'ABBCODE_THUMB_TAG'			=> 'vignette',
	'ABBCODE_THUMB_NOTE'		=> 'Exemple: http://www.google.com/intl/en_com/images/logo_plain.png',
	
	'ABBCODE_FLASH_TAG'			=> 'flash',
	'ABBCODE_FLASH_NOTE'		=> 'Exemple: http://www.adobe.com/support/flash/ts/documents/test_version/version.swf',

	'ABBCODE_VIDEO_TAG'			=> 'video',
	'ABBCODE_VIDEO_NOTE'		=> '', //'Exemple: ???',

	'ABBCODE_STREAM_TAG'		=> 'sound',
	'ABBCODE_STREAM_NOTE'		=> '', //'Exemple: ???',

	'ABBCODE_RAM_TAG'			=> 'Real Media',
	'ABBCODE_RAM_NOTE'			=> '', //'Exemple: ???',

	'ABBCODE_QUICKTIME_TAG'		=> 'Quick time',
	'ABBCODE_QUICKTIME_NOTE'	=> 'Exemple: http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt' . '<br/>' .'http://www.carnivalmidways.com/images/Music/thisisatest.mp3',

	'ABBCODE_STAGE6_TAG'		=> 'Stage6 Video',
	'ABBCODE_STAGE6_NOTE'		=> 'Exemple: 2068715',

	'ABBCODE_GVIDEO_TAG'		=> 'Google Video',
	'ABBCODE_GVIDEO_NOTE'		=> 'Exemple: http://video.google.com/videoplay?docid=-8351924403384451128.',

	'ABBCODE_YOUTUBE_TAG'		=> 'Youtube Video',
	'ABBCODE_YOUTUBE_NOTE'		=> 'Exemple: http://www.youtube.com/watch?v=aabbcc12.',
	
	'ABBCODE_TABLE_STYLE'		=> 'Entrer les paramètres du tableau',
	'ABBCODE_TABLE_NOTE'		=> 'Exemple: width:50%;border:1px solid #cccccc;',
	'ABBCODE_ROW_NUMBER'		=> 'Entrer le nombre de lignes',
	'ABBCODE_ROW_ERROR'			=> 'Vous n’avez pas spécifié le nombre de lignes',
	'ABBCODE_ROW_STYLE'			=> 'Entrer les paramttres des lignes',
	'ABBCODE_ROW_NOTE'			=> 'Exemple: text-align:center;',
	'ABBCODE_CELL_NUMBER'		=> 'Entrer le nombre de cellules',
	'ABBCODE_CELL_ERROR'		=> 'Vous n’avez pas spécifié le nombre de cellules',
	'ABBCODE_CELL_STYLE'		=> 'Entrer les paramètres des cellules',
	'ABBCODE_CELL_NOTE'			=> 'Exemple: border:1px solid #cccccc;',
	
	'ABBCODE_GRAD_MIN_ERROR'	=> 'Merci de sélectionner d’abord le texte : ',
	'ABBCODE_GRAD_MAX_ERROR'	=> 'Seulement autorisé sur moins de 120 caractères : ',
	
	'SPOILER_SHOW'				=> 'Afficher le spoiler',
	'SPOILER_HIDE'				=> 'Masquer le spoiler',
	
	// Custom bbcodes

));

?>