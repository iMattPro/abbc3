<?php
/**
*
* Advanced BBCode Box [French]
* Translated by ForumsFaciles - http://www.forumsfaciles.fr & Galixte (http://www.galixte.com)
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Ici, vous pouvez configurer les paramètres de Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Ajoutez <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> à la <samp class="error">[font]</samp> BBCode. Utilisez une orthographe exacte et respectez la casse. Placez chaque nom de police sur une ligne distincte.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Autoriser l‘utilisation de réseaux de diffusion de contenu tiers" doit être activé sous "Charger les paramètres" pour utiliser cette fonctionnalité.',
	'ABBC3_FONT_SEARCH'	=> 'Rechercher dans Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Chargement des noms de polices…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Aucune police correspondante.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Le catalogue de polices est indisponible. Saisissez les noms manuellement.',
	'ABBC3_SAVE_FONTS'	=> 'Enregistrer les polices',
	'ABBC3_FONTS_CHECKING'	=> 'Vérification et enregistrement des polices…',
	'ABBC3_FONTS_SAVED'	=> 'Polices enregistrées.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Éditeur de la barre d’outils',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Faites glisser les boutons entre « Principaux », « Plus » et « Masqués ». Sélectionnez un bouton pour le personnaliser. L’icône Font Awesome est prioritaire sur l’image. Choisissez de ne pas utiliser d’image pour afficher le nom du BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Principaux',
	'ABBC3_TOOLBAR_MORE'	=> 'Plus',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Masqués',
	'ABBC3_FONT_ICON'	=> 'Icône Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Icône en image',
	'ABBC3_ICON_NONE'	=> 'Aucune (afficher le texte)',
	'ABBC3_PLACEMENT'	=> 'Emplacement',
	'ABBC3_TOOLBAR_DISABLED'	=> 'La barre d’icônes BBCode est désactivée. Vous pouvez continuer à modifier sa disposition, qui sera appliquée lorsque vous la réactiverez.',
	'ABBC3_LIVE_PREVIEW'	=> 'Aperçu en direct',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Enregistrement…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Enregistré',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Impossible d’enregistrer les modifications.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Réessayer',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'JavaScript est nécessaire pour modifier les paramètres d’Advanced [BBCode] Box.',
	'ABBC3_DRAG_BUTTON'	=> 'Faire glisser %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo et Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Nom de police invalide pour “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Impossible de vérifier la police Google « %s ». Vérifiez la connexion au serveur et réessayez.',
	'ABBC3_PIPES'				=> 'Activer le PlugIn Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Le Pipes Table PlugIn permet aux utilisateurs de créer des tableaux dans leurs messages et leurs messages privés en utilisant la syntaxe de démarquage.',
	'ABBC3_BBCODE_BAR'			=> 'Activer la barre d’icônes BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Cette option affiche une barre d’outils BBCode avec des icônes. Désactivez-la pour afficher les boutons BBCode par défaut de phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Activer les BBCodes dans la réponse rapide',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Cela affichera la barre d’outils BBCode d’ABBC3 dans la réponse rapide.',
	'ABBC3_ICONS_TYPE'			=> 'Format de d’image de la barre d’icônes',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choisissez le format d’image des icônes BBCode. Vous pouvez téléverser des icônes SVG ou PNG supplémentaires dans le répertoire <samp class="error">/images/abbc3/icons/</samp> de votre forum.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barre d’icônes du BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Paramètres supplémentaires',
	'ABBC3_AUTO_VIDEO'			=> 'Activer le plug-in vidéo automatique',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Ce plugin convertit les URL de fichiers vidéo en texte brut en vidéos lisibles. Uniquement les URL commençant par <samp class="error">http://</samp> ou <samp class="error">https://</samp> et se terminant par <samp class="error">.mp4 </samp>, <samp class="error">.ogg</samp> ou <samp class="error">.webm</samp> sont convertis.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installez l‘extension facultative phpBB Media Embed pour accéder aux paramètres et aux options de gestion du contenu multimédia intégré.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'L‘extension phpBB Media Embed n‘est pas installée. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'L‘extension phpBB Media Embed est installée. Les paramètres sont accessibles sous l‘onglet Publication.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
