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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Ici, vous pouvez configurer les paramètres de Advanced BBCode Box. Pour plus d’informations sur la personnalisation de la barre d’icônes, visitez le site %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Ajoutez <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> à la <samp class="error">[font]</samp> BBCode. Utilisez une orthographe exacte et respectez la casse. Placez chaque nom de police sur une ligne distincte.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Autoriser l‘utilisation de réseaux de diffusion de contenu tiers" doit être activé sous "Charger les paramètres" pour utiliser cette fonctionnalité.',
	'ABBC3_INVALID_FONT'		=> 'Nom de police invalide pour “%s”',
	'ABBC3_PIPES'				=> 'Activer le PlugIn Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Le Pipes Table PlugIn permet aux utilisateurs de créer des tableaux dans leurs messages et leurs messages privés en utilisant la syntaxe de démarquage.',
	'ABBC3_BBCODE_BAR'			=> 'Activer la barre d’icônes BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Cela affichera la barre d’outils BBCode d’ABBC3. Désactivez cette option pour afficher les boutons BBCode par défaut de phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Activer les BBCodes dans la réponse rapide',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Cela affichera la barre d’outils BBCode d’ABBC3 dans la réponse rapide.',
	'ABBC3_ICONS_TYPE'			=> 'Format de d’image de la barre d’icônes',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choisissez le format d’image à utiliser pour les icônes d’ABBC3. Notez que vous ne pouvez choisir qu’un seul format pour toutes vos icônes.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barre d’icônes du BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Paramètres supplémentaires',
	'ABBC3_AUTO_VIDEO'			=> 'Activer le plug-in vidéo automatique',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Ce plugin convertit les URL de fichiers vidéo en texte brut en vidéos lisibles. Uniquement les URL commençant par <samp class="error">http://</samp> ou <samp class="error">https://</samp> et se terminant par <samp class="error">.mp4 </samp>, <samp class="error">.ogg</samp> ou <samp class="error">.webm</samp> sont convertis.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Installez l‘extension facultative phpBB Media Embed pour accéder aux paramètres et aux options de gestion du contenu multimédia intégré.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'L‘extension phpBB Media Embed n‘est pas installée. %2$s.',
		1	=> 'L‘extension phpBB Media Embed est installée. Les paramètres sont accessibles sous l‘onglet Publication.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
