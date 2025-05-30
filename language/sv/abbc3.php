<?php
/**
*
* Advanced BBCode Box [Swedish]
* Swedish translation by Kimmy (http://www.dreadheads.se)
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
	'ABBC3_HIDDEN_ON'			=> 'Dolt Innehåll',
	'ABBC3_HIDDEN_OFF'			=> 'Dolt Innehåll (för medlemmar endast)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Detta forum kräver att du registrera eller loggar in för att se dolt innehåll.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Visa Spoiler',
	'ABBC3_SPOILER_HIDE'		=> '▼ Göm Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Typsnitt',
	'ABBC3_FONT_SAFE'			=> 'Säkra typsnitt',
	'ABBC3_GOOGLE_FONTS'		=> 'Google typsnitt',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Justera text: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Embed any video site url: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Oskärpt text: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Textriktning: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Skugga text: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Tona in / tona ut text: [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Flytande text: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Typsnitt: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Lysande text: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Göm för gäster: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Makera text: [highlight=yellow]text[/highlight]  Tip: you can also use color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Rörlig text: [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Viktigt meddelande: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art text: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Off Topic meddelande: [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Förformaterad text: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Skugga text: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]https://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler meddelande: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Stryk text: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Nedsänkt text: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Upphöjd text: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube Video: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Embed MP4/OGG/WEBM video files: URL must start with <samp class="error">https</samp> or <samp class="error">http</samp> and end with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> (no BBCode needed). Note that browser support and GUI implementation varies.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Kopiera makerad text',
	'ABBC3_PASTE_BBCODE'		=> 'Klistra in kopierad text',
	'ABBC3_PASTE_ERROR'			=> 'Du måste först kopiera vald text, sen klistra in den',
	'ABBC3_PLAIN_BBCODE'		=> 'Radera all BBcode taggar från makerad text',
	'ABBC3_NOSELECT_ERROR'		=> 'Ingen text var makerad.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Sätt in meddelande',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Exempel',
	'ABBC3_BBVIDEO_SITES'		=> 'Tillåtna hemsidor',
	'ABBC3_URL_LINK'			=> 'Ange en länk',
	'ABBC3_URL_DESCRIPTION'		=> 'Valfritt beskrivning',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Create tables',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Create tables using any of these ASCII-style formats.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'User Guide',
	'ABBC3_PIPE_SIMPLE'			=> 'Simple table',
	'ABBC3_PIPE_COMPACT'		=> 'Compact table',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'The outer pipes and spaces around pipes are optional.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Text alignment',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'BBCode ordningen har uppdaterats.',
	'ABBC3_BBCODE_GROUP'		=> 'Hantera grupper som kan använda denna BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Om inga grupper är valda, kan alla användare använda denna BBCode. Använd CTRL+CLICK (eller CMD+CLICK på Mac) för att makera eller avmakera mer än en grupp..',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'The quick brown fox jumps over the lazy dog',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Example:</strong><br>%2$s<br><br><strong>Result:</strong><br>%3$s<hr>',
));
