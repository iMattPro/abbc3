<?php
/**
* @package: phpBB 3.0.6 :: Advanced BBCode box 3 -> root/language/en/mods :: [en][English]
* @version: $Id: acp_abbcode.php, v 3.0.6 2010/01/10 10:01:10 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @translator: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
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
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>Error while save ABBC3 settings</strong>',
	'LOG_CONFIG_ADD'			=> '<strong>Added board settings</strong><br />» %s',
	'LOG_DATABASE_SCHEMA'		=> '<strong>Updating database schema</strong><br />» %s',
	'LOG_DELETE_ABBCODES'		=> '<strong>Deleted MOD ABBC3 from database</strong>',
));

// abbc3_details
$lang = array_merge($lang, array(
	'ACP_ABBCODES'						=> 'Advanced BBcodes Box 3',
	
	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'Enable or disable <strong>Advanced BBodes Box 3</strong> to users, and/or use standard phpbb3 posting buttons.',
	'ABBCODES_PATH'						=> 'Script path',
	'ABBCODES_PATH_EXPLAIN'				=> 'Path to ABBC3 files under your phpBB root directory, e.g. <samp>styles/abbcode</samp>',
	'ABBCODES_BG'						=> 'Background image',
	'ABBCODES_BG_EXPLAIN'				=> 'This will set the back ground image for icons.<br />Set to <em>no image</em> for fit to your style.',
	'ABBCODES_TAB'						=> 'Display icon division for tags',
	'ABBCODES_BOXRESIZE'				=> 'Resize posting textarea',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'Display buttons to resize posting textarea.',

	'ABBCODES_RESIZE'					=> 'Resize larger images',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'This corrects the error of the [img] bbcode, when someone publishes a picture that exceeds the width of your forum.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Note : </strong> <em>AdvancedBox JS</em> is an JavaScript software used to display images in full size.<br />Also you can use <strong>ABBC3</strong> with other’s script. This modifications are totally optionals. Each script have his own support. I’m not responsible about it. I will not answer question/problem/bug or any kind of issues about them.',
	'ABBCODES_RESIZE_METHOD'			=> 'Resize method',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Choose how to display resized images to full size, in all possible situations.',
	'ABBCODES_RESIZE_BAR'				=> 'Resizer note',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Use the top bar for the resized images',
##	For translate :                                	 Don't				Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'Advanced Box JS', 
													'HighslideBox'	=> 'Highslide Box JS', 
													'LiteBox'		=> 'Lite Box JS', 
													'GreyBox'		=> 'Grey Box JS', 
													'Lightview'		=> 'Light view JS', 
													'Ibox'			=> 'Shadow box with Ibox JS', 
													'PopBox'		=> 'Pop Box JS', 
													'pop-up'		=> 'Pop Up window', 
													'enlarge'		=> 'Enlarge', 
													'samewindow'	=> 'Same window', 
													'newwindow'		=> 'New window', 
													'none'			=> 'No resize'),

	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> 'The file <strong>AdvancedBox.js</strong> is not in the <em>%1$s</em> folder',
	'NO_EXIST_EXPLAIN_OTHERS'			=> 'The file <strong>%1$s version %2$s</strong>, is not present in the <em>%3$s</em> folder<br />If you wish to use %4$s, you must first download the %4$s file/s from <a href="%5$s" onclick="window.open(this.href);return false;">here</a> and upload the downloaded file/s into the <em>%3$s</em> directory.',

	'ABBCODES_MAX_IMAGE_WIDTH'			=> 'Maximum image width in pixel',
	'ABBCODES_MAX_IMAGE_WIDTH_EXPLAIN'	=> 'Image will be resized if exceed the width set here.',
	'ABBCODES_MAX_IMAGE_HEIGHT'			=> 'Maximum image height in pixel',
	'ABBCODES_MAX_IMAGE_HEIGHT_EXPLAIN'	=> 'Image will be resized if exceed the height set here.',
	'ABBCODES_MAX_THUMB_WIDTH'			=> 'Maximum thumbnail width in pixel',
	'ABBCODES_MAX_THUMB_WIDTH_EXPLAIN'	=> 'A generated thumbnail will not exceed the width set here.',
	'ABBCODES_RESIZE_SIGNATURE'			=> 'Resize larger images in Signatures',
	'ABBCODES_RESIZE_SIGNATURE_EXPLAIN'	=> 'Also resize larger images in Signatures ?',
	'ABBCODES_SIG_IMAGE_WIDTH'			=> 'Maximum signature image width in pixel',
	'ABBCODES_SIG_IMAGE_WIDTH_EXPLAIN'	=> 'Image on signatures will be resized if exceed the width set here.',
	'ABBCODES_SIG_IMAGE_HEIGHT'			=> 'Maximum signature image height in pixel',
	'ABBCODES_SIG_IMAGE_HEIGHT_EXPLAIN'	=> 'Image on signatures will be resized if exceed the height set here.',

	'ABBCODES_VIDEO_SIZE'				=> 'Video dimensions',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'Default width and height for posted video.',

	'ABBCODES_UPLOAD_EXTENSION'			=> 'Available extensions',
	'ABBCODES_UPLOAD_EXTENSION_EXPLAIN'	=> 'You can add/change/delete allowed datatypes. Separate extensions with a comma (,)<br /><strong>Note : </strong> These values will overwrite the Attachments Manage extensions setings.',
));

// bbcodes_edit
$lang = array_merge($lang, array(
	'ABBCODES_SETINGS'					=> 'ABBC3 settings',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'Here you can determine the basic operation of <strong>ABBC3</strong>, enable or disable, and among other settings adjust the default values for the background.',

	'ABBCODES_EDIT'						=> 'ABBC3 edit bbcode',
	'ABBCODES_EDIT_EXPLAIN'				=> 'Here you can determine where will be displayed or who can use it and the image of each bbcode.',

	'ABBCODES_CONFIG'					=> 'ABBC3 Component config',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'From this page you can alter the order of tags on posting page or edit the icons,',
	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>Manage groups : </strong>If there are no selected groups all users can use this bbcode.<br />In order to select (or un-select) multiple groups, you must use Ctrl-Click (or Cmd-Click on Mac) items to add them. If you forget to hold down Ctrl/Cmd when clicking an item, then all the previously selected items are lost.',

	'ABBCODES_TIP'						=> 'Tag tip',
	'ABBCODES_NAME'						=> 'Tag name',
	'ABBCODES_TAG'						=> 'Tag image icon',
	'ABBCODES_ORDER'					=> 'Tag order',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Line break</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>Division</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Add new Division',
	'ABBCODES_ADD_BREAK'				=> 'Add new Line break',
	'ABBCODES_SYNC'						=> 'Synchronise order',
	'ABBCODES_RESYNC_SUCCESS'			=> 'The bbcode order have been resynchronised.',

	'ABBCODES_MOD_DISABLE'				=> '<strong>Advanced BBcodes Box 3</strong> is disabled.<br />',
	'ABBCODES_STATUS'					=> 'status',
	'ABBCODES_ACTIVATED'				=> 'activated',
	'ABBCODES_DEACTIVATED'				=> 'deactivated',
));

// Installer 
$lang = array_merge($lang, array(
	// Main
	'INSTALLER_TITLE'					=> 'Advanced BBcodes Box 3',
	'INSTALLER_VERSION'					=> ' version : %1$s',

	'INSTALLER_INTRO'					=> 'Intro',
	'INSTALLER_INTRO_WELCOME'			=> 'Welcome to the <strong>%1$s</strong> Installation',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Please choose what you want to do.',
	'INSTALLER_INSTALL_MENU'			=> 'Menu',
	'INSTALLER_EXTRA_MENU'				=> 'Extras',

	// Install
	'INSTALLER_INSTALL'					=> 'Install',
	'INSTALLER_INSTALL_WELCOME'			=> 'Welcome to the <strong>ABBC3</strong> Installation menu',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'When you choose to install ABBC3, any database of previous versions will be dropped.',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Installation of ABBC3 was successful.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Installation of ABBC3 was <strong>not</strong> successful.',
	'INSTALLER_INSTALL_VERSION'			=> 'Install version : %1$s',
	'INSTALLER_INSTALL_END'				=> 'Installation of <strong>%1$s version : %2$s</strong> was successful. <br /> <p>You should now <a href="./index.php">login to your board</a> and check if everything is working fine. <br />Do not forget to delete, rename or move your <strong>install_abbc3.php</strong> file!</p>',

	// Update
	'INSTALLER_UPDATE'					=> 'Update',
	'INSTALLER_UPDATE_WELCOME'			=> 'Welcome to the <strong>ABBC3</strong> Update menu',
	'INSTALLER_UPDATE_WELCOME_NOTE'		=> 'When you choose to Update ABBC3, any database of previous versions will be dropped.',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Update of ABBC3 was successful.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'Update of ABBC3 was <strong>not</strong> successful.',
	'INSTALLER_UPDATE_VERSION'			=> 'Update to version : %1$s',
	'INSTALLER_UPDATE_END'				=> 'Please be advised that some BBCodes might <strong>not</strong> display correctly due to the changes introduced in BBCodes, if you experience problems please run <strong>Extras » Re-parse</strong> Steps',

	// Uninstall
	'INSTALLER_DELETE'					=> 'Delete',
	'INSTALLER_DELETE_WELCOME'			=> 'Welcome to the <strong>ABBC3</strong> Delete menu',
	'INSTALLER_DELETE_WELCOME_NOTE'		=> 'When you choose to delete the MOD, we remove all sql-data insert by the installation.',
	'INSTALLER_DELETE_VERSION'			=> 'Delete version : %1$s',
	'INSTALLER_DELETE_NOTE'				=> 'Delete',
	'INSTALLER_DELETE_SUCCESSFUL'		=> 'Deleted the <strong>%1$s version : %2$s</strong> was successfully.<br />Now delete all files.',
	'INSTALLER_DELETE_UNSUCCESSFUL'		=> 'Could <strong>not</strong> delete %1$s version :%2$s .',

	// Re-parse
	'INSTALLER_REPARSE'					=> 'Re-parse',
	'INSTALLER_REPARSE_WELCOME'			=> 'Welcome to the Re-parse menu',
	'INSTALLER_REPARSE_WELCOME_NOTE'	=> 'When you choose to <strong>Re-parse</strong> simply reparses BBCodes upon a click -- it is useful if you change the syntax of a BBCode, Only adjust some values, do not rewrite text...',
	'INSTALLER_REPARSE_NOTE'			=> 'Please note that while the chance of any database damage is unlikely, you are running it at your own risk and I am not responsible if something goes wrong.',
	'INSTALLER_REPARSE_WARNING'			=> 'You should make a backup from your users, posts and privmsgs table in case something goes wrong.',
	'INSTALLER_REPARSE_POST'			=> 'Re-parse post content',
	'INSTALLER_REPARSE_SIG'				=> 'Re-parse signatures',
	'INSTALLER_REPARSE_PM'				=> 'Re-parse Private messages',
	'INSTALLER_REPARSE_SUCCESSFUL'		=> '%1$s was successfully.',
	'INSTALLER_REPARSE_UNSUCCESSFUL'	=> 'Could <strong>not</strong> %1$s.',
	
	'STEP_PERCENT_COMPLETED'			=> 'Step <strong>%d</strong> of <strong>%d</strong>',
	'INSTALLER_NOTE'					=> '<strong>Note :</strong> Before adding this MOD to your forum, you should back up the database and all files related to this MOD!',
	'INSTALLER_DELETE_INFORMATION'		=> 'Could <strong>not</strong> find ABBC3 installed !.',
	'INSTALLER_NEEDS_FOUNDER'			=> 'You must be logged in as a founder.',
	'MISSING_PARENT_MODULE'				=> 'Module #%1$s is missing as a parent module for "%2$s".',
	'WARNING'							=> 'Warning',
));

?>