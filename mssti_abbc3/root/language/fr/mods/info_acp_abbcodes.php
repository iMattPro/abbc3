<?php
/**
*
* info_acp_abbcodes [French]
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
	'ACP_ABBCODES'				=> 'BBCodes Box 3 Avancés',
	'ACP_ABBC3_SETTINGS'		=> 'Paramètres d’ABBC3',
	'ACP_ABBC3_BBCODES'			=> 'BBCodes d’ABBC3',
	'LOG_CONFIG_ABBCODES'		=> '<strong>Modifier les paramètres d’ABBC3</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>Erreur lors de l’enregistrement des paramètres d’ABBC3</strong>',

	// UCP settings
	'UCP_ABBCODES'					=> 'BBCodes Box 3 Avancés',
	'UCP_ABBC3_SETTINGS'			=> 'Interface BBCodes pour l’édition des messages',
	'UCP_ABBC3_SETTINGS_EXPLAIN'	=> 'Notez que dans le mode <i>limité</ i>, tous les BBCodes seront disponibles et doivent être entrés manuellement.',
	'UCP_ABBC3_LIMITED'				=> 'Limité - BBCodes basiques sans icône',
	'UCP_ABBC3_COMPACT' 			=> 'Compact - Tous les BBCodes sont placés dans un menu déroulant',
	'UCP_ABBC3_STANDARD'			=> 'Standard - Tous les BBCodes de la barre d’outils',

	// ABBC3 settings page
	'ABBCODES_SETINGS'					=> 'Paramètres d’ABBC3',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'Vous pouvez configurer ici <strong>ABBC3</strong>. Vous pouvez définir l’apparence et les options de la barre des BBCodes. La section « Wizard » permet de configurer les lignes d’aide d’ABBC3.<br/>La section « Redimensionner les images » permet de paramètrer comment attacher/poster les images et comment elles doivent être manipulées et/ou redimensionnées.<br/>La section « BBvideo » permet de configurer les paramètres du BBCode BBvideo.',

	'ABBCODES_VERSION_CHECK'			=> 'Vérification de la version',
	'ABBCODES_CURRENT_VERSION'			=> 'Version actuellement installée',
	'ABBCODES_LATEST_VERSION'			=> 'Dernière version publiée',
	'ABBCODES_DOWNLOAD_LATEST'			=> 'Télécharger la dernière version',

	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'Activez les <strong>BBCodes Box 3 Avancés</strong> pour tous les utilisateurs ou désactivez-les pour utiliser les BBCodes standards de PhpBB3.',
	'ABBCODES_BG'						=> 'Image de fond',
	'ABBCODES_BG_EXPLAIN'				=> 'Cela va paramétrer l’image de fond des icônes de la barre des BBCodes.<br/>Mettez <em>Aucune image</em> pour utiliser votre style par défaut.',
	'ABBCODES_TAB'						=> 'Afficher les divisions d’icônes entre les balises',
	'ABBCODES_BOXRESIZE'				=> 'Redimensionner l’éditeur de message',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'Afficher les boutons +/- pour redimensionner la zone de saisie de l’éditeur de message.',
	'ABBCODES_UCP_MODE'					=> 'Options de contôle du Panneau de l’utilisateur',
	'ABBCODES_UCP_MODE_EXPLAIN'			=> 'Autoriser les utilisateurs à choisir leur propre éditeur, en choisissant entre les boutons standards de phpBB3, d’ABBC3 « Standard » ou d’ABBC3 « Compact ».',

	'ABBCODES_WIZARD'					=> 'Assistant',
	'ABBCODES_WIZARD_SIZE'				=> 'Dimensions de l’assistant',
	'ABBCODES_WIZARD_SIZE_EXPLAIN'		=> 'Largeur et hauteur par défaut, de la fenêtre pop-up de l’assistant.',
	'ABBCODES_WIZARD_MODE'				=> 'Choisissez un type d’assistant',
##	For translator:                                	Don't			Yes
	'ABBCODES_WIZARD_SELECTOR'			=> array(	'0'			=> 'Désactiver l’assistant',
													'1'			=> 'Fenêtre pop-up',
													'2'			=> 'AJAX (aucune pop-up)'),

	'ABBCODES_RESIZER'					=> 'Redimensionner les images',
	'ABBCODES_RESIZE'					=> 'Redimensionner les grandes images',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'Redimensionner les images affichées en utilisant la balise BBCode [img] lorsque quelqu’un publie une image qui dépasse la largeur de votre forum.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Remarque:</strong> <em>AdvancedBox JS</em> est une application JavaScript utilisée pour afficher des images en taille réelle.<br/>Vous pouvez également utiliser <strong>ABBC3</strong> avec l’un des autres scripts. Ces modifications sont totalement optionnelles. Chaque script a son propre support. Je n’en suis pas responsable. Je ne répondrai pas à des questions / problèmes / bugs ou autres à leur sujet.',
	'ABBCODES_RESIZE_METHOD'			=> 'Méthode de redimensionnement',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Choisissez la méthode de redimensionnement par défaut des images.',
	'ABBCODES_RESIZE_BAR'				=> 'Barre d’informations',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Affiche une barre d’informations en haut des images redimensionnées.',
##	For translate :                                	 Don't				Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'Advanced Box JS',
													'HighslideBox'	=> 'Highslide JS',
													'Lightview'		=> 'Lightview JS',
													'prettyPhoto'	=> 'PrettyPhoto JS',
													'Shadowbox'		=> 'Shadowbox JS',
													'pop-up'		=> 'Fenêtre pop-up',
													'enlarge'		=> 'Agrandir',
													'samewindow'	=> 'Même fenêtre',
													'newwindow'		=> 'Nouvelle fenêtre',
													'none'			=> 'Aucun redimensionnement'),

	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> 'Le fichier <strong>AdvancedBox.js</strong> n’est pas dans le dossier <em>%1$s</em>.',
	'NO_EXIST_EXPLAIN_OTHERS'			=> 'Le fichier <strong>%1$s version %2$s</strong> n’est pas présent dans le dossier <em>%3$s</em>.<br/>Si vous souhaitez utiliser %4$s, vous devez d’abord télécharger le(s) fichier(s) %4$s <a href="%5$s" onclick="window.open(this.href);return false;">ici</a> et charger le(s) fichier(s) dans ce répertoire <em>%3$s</em>.',

	'ABBCODES_MAX_IMAGE_WIDTH'			=> 'Largeur maximale de l’image, en pixels',
	'ABBCODES_MAX_IMAGE_WIDTH_EXPLAIN'	=> 'L’image sera redimensionnée si elle dépasse la largeur définie ici.',
	'ABBCODES_MAX_IMAGE_HEIGHT'			=> 'Hauteur maximale de l’image, en pixels',
	'ABBCODES_MAX_IMAGE_HEIGHT_EXPLAIN'	=> 'L’image sera redimensionnée si elle dépasse la hauteur définie ici.',
	'ABBCODES_MAX_THUMB_WIDTH'			=> 'Largeur maximale de la miniature, en pixels',
	'ABBCODES_MAX_THUMB_WIDTH_EXPLAIN'	=> 'La miniature générée ne dépasse pas la largeur définie ici.',
	'ABBCODES_RESIZE_SIGNATURE'			=> 'Redimensionner les grandes images dans les signatures',
	'ABBCODES_RESIZE_SIGNATURE_EXPLAIN'	=> 'Redimensionner les grandes images dans les signatures ?',
	'ABBCODES_SIG_IMAGE_WIDTH'			=> 'Largeur maximale de l’image dans la signature, en pixels',
	'ABBCODES_SIG_IMAGE_WIDTH_EXPLAIN'	=> 'Les images des signatures seront automatiquement redimensionnées, si elles dépassent la largeur définie ici.',
	'ABBCODES_SIG_IMAGE_HEIGHT'			=> 'Hauteur maximale de l’image dans la signature, en pixels',
	'ABBCODES_SIG_IMAGE_HEIGHT_EXPLAIN'	=> 'Les images des signatures seront automatiquement redimensionnées, si elles dépassent la hauteur définie ici.',

	'ABBCODES_VIDEO_ERROR'				=> '<strong>Erreur :</strong> il y a un trop grand nombre de BBvideos sélectionnés. Désélectionnez certains BBvideos et réessayez.',
	'ABBCODES_VIDEO_SIZE'				=> 'Dimensions des vidéos',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'Largeur et hauteur, par défaut, des vidéos postées.',
	'ABBCODES_VIDEO_ALLOWED'			=> 'Types de vidéos autorisés',
	'ABBCODES_VIDEO_ALLOWED_EXPLAIN'	=> 'Sélectionnez les sites de vidéos et/ou les formats que vous souhaitez autoriser à être insérés dans les messages, lorsque le BBCode BBvideo est activé <em class="error">(*)</em>.',
	'ABBCODES_VIDEO_ALLOWED_NOTE'		=> '<em class="error">(*)</em> Pour sélectionner (ou désélectionner) plusieurs types de vidéos, vous devez faire Ctrl + clic (ou Cmd-clic sur Mac) sur les éléments pour les ajouter. Si vous oubliez de maintenir la touche CTRL / CMD en cliquant sur un élément, tous les éléments précédemment sélectionnés seront désélectionnés.',
	'ABBCODES_VIDEO_WMODE'				=> 'Mode fenêtre transparente',
	'ABBCODES_VIDEO_WMODE_EXPLAIN'		=> 'Définit la variable Flash « wmode » en transparent. Ceci est nécessaire uniquement si votre forum a un objet statique (comme une barre d’outils en bas de page). Les vidéos intégrées seront au-dessus de l’objet statique.',

	'ABBCODES_DESELECT_ALL'				=> 'Tout désélectionner',
	'ABBCODES_SELECT_ALL'				=> 'Tout sélectionner',

	// ABBC3 BBCodes page
	'ABBCODES_CONFIG'					=> 'BBCodes ABBC3',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'Vous pouvez configurer ici l’ordre des BBCodes de la barre d’outils (glissez-déposez les lignes pour organiser) et modifier les options pour chaque BBCode.',

	'ABBCODES_EDIT'						=> 'Édition du BBCode d’ABBC3',
	'ABBCODES_EDIT_EXPLAIN'				=> 'Vous pouvez ici déterminer l’endroit où il sera affiché, qui peut s’en servir et déterminer l’icône de ce BBCode.',

	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>Gérer les groupes :</strong> S’il n’y a pas de groupes sélectionnés, tous les utilisateurs peuvent utiliser ce BBCode.<br/>Pour sélectionner (ou désélectionner) plusieurs groupes, vous devez maintenir Ctrl + clic (ou Cmd-clic sur Mac) sur les éléments pour les ajouter.<br/>Si vous oubliez de maintenir la touche CTRL / CMD en cliquant sur un élément, tous les éléments précédemment sélectionnés seront désélectionnés.',

	'ABBCODES_TIP'						=> 'Description',
	'ABBCODES_NAME'						=> 'Balise BBCode',
	'ABBCODES_TAG'						=> 'Icônes',
	'ABBCODES_ORDER'					=> 'Ordre des balises',
	'ABBCODES_CUSTOM'					=> 'BBCode personnalisé',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Saut de ligne</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>Division</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Ajouter une Division',
	'ABBCODES_ADD_BREAK'				=> 'Ajouter un Saut de ligne',
	'ABBCODES_SYNC'						=> 'Synchronisation',
	'ABBCODES_RESYNC_SUCCESS'			=> 'L’ordre des BBCodes a bien été synchronisé.',

	'ABBCODES_COLOUR_MODE'				=> 'Choisissez le mode de sélection des couleurs',
##	For translator:                                	 Don't			Yes
	'ABBCODES_COLOUR_SELECTOR'			=> array(	'phpbb'		=> 'Style phpBB par défaut',
													'dropdown'	=> 'Menu déroulant',
													'fancy'		=> 'Sélecteur « fantaisie »',
													'tigra'		=> 'Sélecteur de couleurs Tigra'),

	'ABBCODES_MOD_DISABLE'				=> '<strong>BBCodes Box 3 Avancés</strong> est désactivé.<br />',
	'ABBCODES_STATUS'					=> 'statut',
	'ABBCODES_ACTIVATED'				=> 'activé',
	'ABBCODES_DEACTIVATED'				=> 'désactivé',

	// UMIL Installer
	// Main
	'INSTALLER_TITLE'					=> 'BBCodes Box 3 Avancés',
	'INSTALLER_TITLE_EXPLAIN'			=> 'Bienvenue dans le menu d’installation d’<strong>ABBC3</strong>.',
	'INSTALLER_INSTALL_WELCOME'			=> 'Lorsque vous choisissez d’installer ABBC3, la base de données des versions précédentes sera supprimée.',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Notez que ce processus pourrait remplacer des BBCodes personnalisés existants et, par conséquent, ces BBCodes pourraient ne pas s’afficher correctement en raison des changements introduits par les BBCodes d’ABBC3.
	<br/>Si vous rencontrez des problèmes, utilisez le <a href="http://www.phpbb.com/support/stk/" title="" onclick="window.open(this.href);return false;">Support Toolkit<em>(STK)</em></a> et la fonction <strong>Outils d’administration » Réanalyser les BBCodes</strong>.
	<br/><br/>Avant d’ajouter ce MOD, vous devriez sauvegarder vos fichiers et votre base de données.',

	// Stages
	'INSTALLER_CONFIGS_ADD'				=> 'Configuration d’ABBC3',
	'INSTALLER_BBCODES_ADD'				=> 'BBCodes d’ABBC3',
	// Misc
	'INSTALLER_RESIZE_CHECK'			=> 'Vérification de la mise à jour complète de la méthode de redimensionnement',
	'INSTALLER_BBVIDEO_UPDATER'			=> 'BBvideos a été mis à jour avec succès',
));

?>