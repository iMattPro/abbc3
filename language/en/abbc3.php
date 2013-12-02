<?php
/**
*
* abbc3 [English]
*
* @package language
* @copyright (c) 2013 Matt Friedman 
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
	// Hidden BBcode
	'ABBC3_HIDDEN_ON'			=> 'Hidden Content',
	'ABBC3_HIDDEN_OFF'			=> 'Hidden Content (for members only)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'This board requires you to be registered and logged-in to view hidden content.',

	// Spoiler BBcode
	'SPOILER_SHOW'				=> '&#9658; Show Spoiler',
	'SPOILER_HIDE'				=> '&#9660; Hide Spoiler',

	// Off Topic BBcode
	'OFFTOPIC'					=> 'OFF TOPIC',

	// Font BBcode
	'ABBC3_FONT_BBCODE'			=> 'Font Menu',
	'ABBC3_FONT_FANCY'			=> 'Fancy fonts',
	'ABBC3_FONT_SAFE'			=> 'Safe fonts',
	'ABBC3_FONT_WIN'			=> 'Windows fonts',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Align text: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Embed any video site url: [BBvideo=width,height]Video URL[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Blur text: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Text direction: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Drop shadow text: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Fade text: [fade]text[/fade]',
	'ABBC3_FONT_HELPLINE'		=> 'Font Type: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Glow text: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Hide text from guests: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Highlight text: [highlight=yellow]text[/highlight]',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Marquee text: [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Alert text: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art text: [nfo]NFO text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off Topic text: [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Preformatted text: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Shadow text: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler text: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Strike-through text: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Subscript text: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Superscript text: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]URL[/youtube]',

	// Utility BBcodes
	'ABBC3_COPY_BBCODE'			=> 'Copy selected text',
	'ABBC3_PASTE_BBCODE'		=> 'Paste copied text',
	'ABBC3_PASTE_ERROR'			=> 'You must first copy a selection of text, then paste it',
	'ABBC3_PLAIN_BBCODE'		=> 'Remove all BBCode tags from the selected text',

	'ABBC3_ERROR'				=> 'Error',
	'ABBC3_NOSELECT_ERROR'		=> 'No text was seleted.',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'The BBCode order has been resynchronised.',
	'ABBC3_BBCODE_GROUP'		=> 'Manage groups that can use this BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'If no groups are selected, then all users can use this BBCode. Use CTRL+CLICK (or CMD+CLICK on Mac) to select/deselect more than one group.',
));
