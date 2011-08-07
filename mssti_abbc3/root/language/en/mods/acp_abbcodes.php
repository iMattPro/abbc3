<?php
/**
* @package: phpBB 3.0.9 :: Advanced BBCode box 3 -> root/language/en/mods :: [en][English]
* @version: $Id: acp_abbcode.php, v 3.0.9.2 8/5/11 4:57 PM VSE Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @translator: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
**/

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

// This lines are the same as root/language/en/acp/common.php
$lang = array_merge($lang, array(
	'ACP_ABBCODES'				=> 'Advanced BBcodes Box 3',
	'ACP_ABBC3_SETTINGS'		=> 'ABBC3 Settings',
	'ACP_ABBC3_BBCODES'			=> 'ABBC3 BBCodes',
	'LOG_CONFIG_ABBCODES'		=> '<strong>Altered ABBC3 settings</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>Error while saving ABBC3 settings</strong>',
));

// This lines are for the UCP
$lang = array_merge($lang, array(
	'UCP_ABBCODES'					=> 'Advanced BBcodes Box 3',
	'UCP_ABBC3_SETTINGS'			=> 'Message editor BBcode interface',
	'UCP_ABBC3_SETTINGS_EXPLAIN'	=> 'Note that in <i>Limited</i> mode, not all BBcodes will be available and must be typed in manually.',
	'UCP_ABBC3_LIMITED'				=> 'Limited - Basic BBcodes only with no icons',
	'UCP_ABBC3_COMPACT'				=> 'Compact - All BBcodes in a compact drop menu',
	'UCP_ABBC3_STANDARD'			=> 'Standard - Full BBcodes toolbar',
));

// abbc3_details
$lang = array_merge($lang, array(
	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'Enable <strong>Advanced BBcodes Box 3</strong> or disable to use standard phpBB3 BBcode buttons.',
//	'ABBCODES_PATH'						=> 'Script path',
//	'ABBCODES_PATH_EXPLAIN'				=> 'Path to ABBC3 files in your phpBB root directory, e.g. <samp>styles/abbcode</samp>',
	'ABBCODES_BG'						=> 'Background image',
	'ABBCODES_BG_EXPLAIN'				=> 'This will set the background image for icons.<br />Set to <em>no image</em> to use your default style.',
	'ABBCODES_TAB'						=> 'Display icon divisions between tags',
	'ABBCODES_BOXRESIZE'				=> 'Resize post editors',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'Display +/- buttons to resize the post editor textarea.',

	'ABBCODES_RESIZER'					=> 'Image Resizer',
	'ABBCODES_RESIZE'					=> 'Resize large images',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'This will resize images posted using the [img] BBcode when someone publishes a picture that exceeds the width of your forum.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Note : </strong> <em>AdvancedBox JS</em> is a JavaScript application used to display images in full size.<br />You can also use <strong>ABBC3</strong> with any of the other included scripts. These modifications are totally optional. Each script has its own support. I’m not responsible for it. I will not answer questions/problems/bugs or any other issues about them.',
	'ABBCODES_RESIZE_METHOD'			=> 'Resize method',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Choose how to display resized images in full size, in all possible situations.',
	'ABBCODES_RESIZE_BAR'				=> 'Resizer Info Bar',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Use an Info Bar along the top of resized images.',
##	For translate :                                	 Don't				Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'Advanced Box JS',
													'HighslideBox'	=> 'Highslide JS',
													'LiteBox'		=> 'Lightbox2 JS',
													'GreyBox'		=> 'GreyBox JS',
													'Lightview'		=> 'Lightview JS',
													'Shadowbox'		=> 'Shadowbox JS',
													'PopBox'		=> 'PopBox JS',
													'pop-up'		=> 'Pop Up window',
													'enlarge'		=> 'Enlarge',
													'samewindow'	=> 'Same window',
													'newwindow'		=> 'New window',
													'none'			=> 'No resize'),

	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> 'The file <strong>AdvancedBox.js</strong> is not in the <em>%1$s</em> folder',
	'NO_EXIST_EXPLAIN_OTHERS'			=> 'The file <strong>%1$s version %2$s</strong> is not present in the <em>%3$s</em> folder<br />If you wish to use %4$s, you must first download the %4$s file(s) from <a href="%5$s" onclick="window.open(this.href);return false;">here</a> and upload the downloaded file(s) into the <em>%3$s</em> directory.',

	'ABBCODES_MAX_IMAGE_WIDTH'			=> 'Maximum image width in pixels',
	'ABBCODES_MAX_IMAGE_WIDTH_EXPLAIN'	=> 'Image will be resized if it exceeds the width set here.',
	'ABBCODES_MAX_IMAGE_HEIGHT'			=> 'Maximum image height in pixels',
	'ABBCODES_MAX_IMAGE_HEIGHT_EXPLAIN'	=> 'Image will be resized if it exceeds the height set here.',
	'ABBCODES_MAX_THUMB_WIDTH'			=> 'Maximum thumbnail width in pixels',
	'ABBCODES_MAX_THUMB_WIDTH_EXPLAIN'	=> 'A generated thumbnail will not exceed the width set here.',
	'ABBCODES_RESIZE_SIGNATURE'			=> 'Resize large images in signatures',
	'ABBCODES_RESIZE_SIGNATURE_EXPLAIN'	=> 'Also resize large images in user signatures?',
	'ABBCODES_SIG_IMAGE_WIDTH'			=> 'Maximum signature image width in pixels',
	'ABBCODES_SIG_IMAGE_WIDTH_EXPLAIN'	=> 'Images in signatures will be resized if they exceed the width set here.',
	'ABBCODES_SIG_IMAGE_HEIGHT'			=> 'Maximum signature image height in pixels',
	'ABBCODES_SIG_IMAGE_HEIGHT_EXPLAIN'	=> 'Images in signatures will be resized if they exceed the height set here.',

	'ABBCODES_VIDEO_SIZE'				=> 'Video dimensions',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'Default width and height for posted video.',
	'ABBCODES_VIDEO_ALLOWED'			=> 'Video types allowed',
	'ABBCODES_VIDEO_ALLOWED_EXPLAIN'	=> 'Select the video sites and/or formats you would like to allow users to embed in their posts when the BBvideo BBcode is enabled <em class="error">(*)</em>',
	'ABBCODES_VIDEO_ALLOWED_NOTE'		=> '<em class="error">(*)</em> In order to select (or deselect) multiple items, you must CTRL+CLICK (or CMD-CLICK on Mac) items to add them. If you forget to hold down CTRL/CMD when clicking an item, then all the previously selected items will be deselected.',

	'ABBCODES_COLOUR_MODE'				=> 'Choose the colour picker mode',
##	For translate :                                	 Don't			Yes
	'ABBCODES_COLOUR_SELECTOR'			=> array(	'phpbb'		=> 'phpBB style Default',
													'dropdown'	=> 'Drop Down Menu',
													'fancy'		=> '“fancy” selector',
													'tigra'		=> 'Tigra color picker'),
	'ABBCODES_WIZARD_MODE'				=> 'Choose the wizards mode',
##	For translate :                                	Don't			Yes
	'ABBCODES_WIZARD_SELECTOR'			=> array(	'0'			=> 'Disable wizards',
													'1'			=> 'Pop Up window',
													'2'			=> 'In post'),
	'ABBCODES_UCP_MODE'					=> 'UCP Control options',
	'ABBCODES_UCP_MODE_EXPLAIN'			=> 'Allow users to select their own editor mode, by choosing between the standard phpBB3 BBcode buttons, ABBC3 “Extended” or ABBC3 “Compact” view.',

	'ABBCODES_WIZARD'					=> 'Wizard',
	'ABBCODES_WIZARD_SIZE'				=> 'Wizard dimensions',
	'ABBCODES_WIZARD_SIZE_EXPLAIN'		=> 'Default width and height for pop-up wizard window.',

	'ABBCODES_DESELECT_ALL'				=> 'Deselect all',
	'ABBCODES_SELECT_ALL'				=> 'Select all',
));

// bbcodes_edit
$lang = array_merge($lang, array(
	'ABBCODES_SETINGS'					=> 'ABBC3 settings',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'Here you can determine the basic operation of <strong>ABBC3</strong>, enable or disable, and among other settings adjust the default values for the background.',

	'ABBCODES_EDIT'						=> 'ABBC3 edit BBcode',
	'ABBCODES_EDIT_EXPLAIN'				=> 'Here you can determine where it will be displayed, who can use it, and the icon for this BBcode.',

	'ABBCODES_CONFIG'					=> 'ABBC3 Component config',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'From this page you can alter the order of the BBcode tags on the posting page and edit the BBcodes tags.',
	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>Manage groups : </strong>If there are no selected groups then all users can use this BBcode.<br />In order to select (or deselect) multiple groups, you must CTRL+CLICK (or CMD-CLICK on Mac) items to add them. If you forget to hold down CTRL/CMD when clicking an item, then all the previously selected items will be deselected.',

	'ABBCODES_TIP'						=> 'Tag tip',
	'ABBCODES_NAME'						=> 'BBcode tag',
	'ABBCODES_TAG'						=> 'Tag image icon',
	'ABBCODES_ORDER'					=> 'Tag order',
	'ABBCODES_CUSTOM'					=> 'Custom BBcode',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Line break</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>Division</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Add new Division',
	'ABBCODES_ADD_BREAK'				=> 'Add new Line break',
	'ABBCODES_SYNC'						=> 'Synchronise order',
	'ABBCODES_RESYNC_SUCCESS'			=> 'The BBcode order has been resynchronised.',

	'ABBCODES_MOD_DISABLE'				=> '<strong>Advanced BBcodes Box 3</strong> is disabled.<br />',
	'ABBCODES_STATUS'					=> 'status',
	'ABBCODES_ACTIVATED'				=> 'activated',
	'ABBCODES_DEACTIVATED'				=> 'deactivated',
));

// UMIL Installer 
$lang = array_merge($lang, array(
// Main
	'INSTALLER_TITLE'					=> 'Advanced BBcodes Box 3',
	'INSTALLER_TITLE_EXPLAIN'			=> 'Welcome to the <strong>ABBC3</strong> Installation menu',

	'INSTALLER_INSTALL_WELCOME'			=> 'When you choose to install ABBC3, any database of previous versions will be dropped.',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Please be advised that this process might overwrite existing custom BBcodes and as a result, those BBcodes might not display correctly due to the changes introduced by ABBC3’s BBcodes.
	<br />If you experience problems use the <a href="http://www.phpbb.com/support/stk/" title="" onclick="window.open(this.href);return false;">Support Toolkit <em>(STK)</em></a> <strong>Admin tools » Reparse BBCode</strong> feature.
	<br /><br />Before adding this MOD to your board, you should back up files and database first.',
	'INSTALLER_INSTALL_END'				=> 'You should now <a href="./index.php">login to your board</a> and check if everything is working fine. <br />Do not forget to delete, rename or move this file! <strong><em>install_abbc3.php</em></strong>',
// Stages
	'INSTALLER_CONFIGS_ADD'				=> 'ABBC3 config',
	'INSTALLER_BBCODES_ADD'				=> 'ABBC3 bbcodes',
// Misc
	'INSTALLER_RESIZE_CHECK'			=> 'Resizer Method update check complete',
));

?>