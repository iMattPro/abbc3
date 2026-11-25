<?php
/**
*
* Advanced BBCode Box [English]
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_FONT_SEARCH'	=> 'Search Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Loading font names…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'No matching fonts.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'The font catalog is unavailable. Enter font names manually.',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Could not verify Google Font “%s”. Check the server connection and try again.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_SAVE_FONTS'			=> 'Save fonts',
	'ABBC3_FONTS_CHECKING'		=> 'Checking and saving fonts…',
	'ABBC3_FONTS_SAVED'			=> 'Fonts saved.',
	'ABBC3_PIPES'				=> 'Enable Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'The Pipe Table PlugIn allows users to create tables in their posts and private messages using markdown syntax.',
	'ABBC3_BBCODE_BAR'			=> 'Enable BBCode icon bar',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display an icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Enable BBCodes in Quick Reply',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'This will add BBCode buttons to Quick Reply.',
	'ABBC3_ICONS_TYPE'			=> 'Icon bar image format',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for BBCode icons. Additional SVG or PNG icons can be uploaded to your board’s <samp class="error">/images/abbc3/icons/</samp> directory.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'BBCode Icon Bar',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Add-ons',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Toolbar composer',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN' => 'Drag buttons between Primary, More and Hidden. Select a button to customize it. Font Awesome overrides its image; choose no image to display the BBCode name.',
	'ABBC3_TOOLBAR_PRIMARY'		=> 'Primary',
	'ABBC3_TOOLBAR_MORE'		=> 'More',
	'ABBC3_TOOLBAR_HIDDEN'		=> 'Hidden',
	'ABBC3_FONT_ICON'			=> 'Font Awesome icon',
	'ABBC3_IMAGE_ICON'			=> 'Image icon',
	'ABBC3_ICON_NONE'			=> 'None (use text)',
	'ABBC3_PLACEMENT'		=> 'Placement',
	'ABBC3_TOOLBAR_DISABLED'	=> 'The BBCode icon bar is disabled. Its layout remains editable and will be ready if you enable it again.',
	'ABBC3_LIVE_PREVIEW'		=> 'Live preview',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Saving…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Saved',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Could not save changes.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Retry',
	'ABBC3_JAVASCRIPT_REQUIRED' => 'JavaScript is required to change Advanced [BBCode] Box settings.',
	'ABBC3_DRAG_BUTTON'		=> 'Drag %s',
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'BBVideo handles direct video URLs. The optional phpBB Media Embed extension adds support and settings for additional media services.',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo and Media Embed',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'phpBB Media Embed extension is not installed. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
