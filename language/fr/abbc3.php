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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Contenu caché',
	'ABBC3_HIDDEN_OFF'			=> 'Contenu caché (accès aux membres seulement)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Vous devez être inscrit et connecté sur ce forum pour voir le contenu caché.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Afficher le texte',
	'ABBC3_SPOILER_HIDE'		=> '▼ Masquer le texte',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Hors-sujet',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Menu des polices',
	'ABBC3_FONT_FANCY'			=> 'Polices fantaisistes',
	'ABBC3_FONT_SAFE'			=> 'Polices communes',
	'ABBC3_FONT_WIN'			=> 'Polices Windows',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Alignement du texte : [align=center|left|right|justify]texte[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Insérer un lien vers n’importe quelle vidéo internet : [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Texte flou : [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Sens d’écriture : [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Texte à courte ombre portée : [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Texte fondant : [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Texte flottant : [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Police de caractères : [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Texte lumineux : [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Masquer aux invités : [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Texte surligné : [highlight=yellow]texte[/highlight]  Astuce: vous pouvez également utiliser color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Texte défilant : [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Message d’alerte : [mod=username]texte[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Texte [ASCII Art] NFO : [nfo]texte[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Message hors-sujet : [offtopic]texte[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Texte préformaté : [pre]texte[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Ombres sur le texte : [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'Son SoundCloud : [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler le message : [spoil]texte[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Texte barré : [s]texte[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Texte en indice : [sub]texte[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Texte en exposant : [sup]texte[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Vidéo YouTube : [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Copier le texte sélectionné',
	'ABBC3_PASTE_BBCODE'		=> 'Coller le texte copié',
	'ABBC3_PASTE_ERROR'			=> 'Vous devez avant tout copier une partie du texte, puis la coller',
	'ABBC3_PLAIN_BBCODE'		=> 'Supprimer toutes les balises BBCode du texte sélectionné',
	'ABBC3_NOSELECT_ERROR'		=> 'Aucun texte sélectionné.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Insérer dans le message',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Exemple',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'Sites autorisés pour vidéo',
	'ABBC3_BBVIDEO_LINK'		=> 'Lien vers la vidéo',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Ajouter une adresse URL',
	'ABBC3_URL_DESCRIPTION'		=> 'Description facultative',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Créer des tables',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Permet de créer des tables au format ASCII.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Guide d’utilisation',
	'ABBC3_PIPE_SIMPLE'			=> 'Table simple',
	'ABBC3_PIPE_COMPACT'		=> 'Table compacte',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Les barres verticales extérieures et les espaces autour de celles-ci sont optionnels.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Alignement du texte',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'L’ordre des BBcode a été mis à jour.',
	'ABBC3_BBCODE_GROUP'		=> 'Gestion des groupes pouvant utiliser ce BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Si aucun groupe n’est sélectionné, tous les utilisateurs pourront utiliser ce BBCode. Appuyer sur la touche <samp>CTRL</samp> (ou <samp>&#8984;CMD</samp> sur Mac) tout en cliquant pour sélectionner / désélectionner plus d’un groupe.',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for Advanced BBCode Box 3. For information about customizing the icon bar, visit the <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">ABBC3 FAQ <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_PIPES'				=> 'Enable the Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'The Pipes Table PlugIn allows users to create tables in their posts and private messages using markdown syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Enable BBCode icon bar',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display ABBC3’s icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Enable BBCodes in Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'This will add BBCode buttons to Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Icon bar image format',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for ABBC3’s icons. Note that you can only choose one format for all your icons.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Icon Bar',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add Ons',
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Boite des BBCodes avancés',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Le renard brun et rapide saute sur le chien paresseux.',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Exemple :</strong><br />%2$s<br /><br /><strong>Résultat :</strong><br />%3$s<hr />',
));
