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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Ici, vous pouvez configurer les paramètres de Advanced BBCode Box. Pour plus d’informations sur la personnalisation de la barre d’icônes, visitez le site <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
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
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Install the optional phpBB Media Embed extension to access settings and management options for embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extension is not installed. <a href="https://www.phpbb.com/customise/db/extension/mediaembed/" target="_blank">Download <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
		1	=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
