<?php
/**
* @package: phpBB :: Advanced BBCode Box 3 -> root/language/de/mods :: [de][German]
* @version: $Id: info_acp_abbcode.php, v 3.0.10 10/27/11 10:41 PM VSE Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @translator (German): femu - http://die-muellers.org
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
	'ACP_ABBCODES'				=> 'Advanced BBCode Box 3',
	'ACP_ABBC3_SETTINGS'		=> 'ABBC3 Einstellungen',
	'ACP_ABBC3_BBCODES'			=> 'ABBC3 BBCodes',
	'LOG_CONFIG_ABBCODES'		=> '<strong>ABBC3 Einstellungen geändert</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>Fehler beim Speichern der ABBC3 Einstellungen</strong>',
));

// This lines are for the UCP
$lang = array_merge($lang, array(
	'UCP_ABBCODES'					=> 'Advanced BBCode Box 3',
	'UCP_ABBC3_SETTINGS'			=> 'Message-Editor BBCode schnittstelle',
	'UCP_ABBC3_SETTINGS_EXPLAIN'	=> 'Beachten Sie, dass in <i>begrenzten</i> Modus nicht alle BBCodes verfügbar sein werden und müssen manuell eingegeben werden.',
	'UCP_ABBC3_LIMITED'				=> 'Begrenzt - Einfach nur mit BBCodes keine Symbole',
	'UCP_ABBC3_COMPACT'				=> 'Kompakt - Alle BBCodes in einem kompakten Dropdown-Menü',
	'UCP_ABBC3_STANDARD'			=> 'Standard - Ausführliche BBCodes Symbolleiste',
));

// abbc3_details
$lang = array_merge($lang, array(
	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'Die <strong>Advanced BBodes Box 3</strong> für die Benutzer ein - bzw. ausschalten. Ist sie ausgeschaltet, werden die Standard Buttons von phpBB3 verwendet.',
	'ABBCODES_PATH'						=> 'Script Pfad',
	'ABBCODES_PATH_EXPLAIN'				=> 'Pfad zu den ABBC3 Dateien unterhalb deines phpBB Root Verzeichnisses, z.B. <samp>styles/abbcode</samp>',
	'ABBCODES_BG'						=> 'Hintergrundbild',
	'ABBCODES_BG_EXPLAIN'				=> 'Ein Hintergrundbild für deine Icons.<br />Wähle  <em>Kein Bild</em> aus, um es passend zu deinem Style zu halten.',
	'ABBCODES_TAB'						=> 'Zeige einen Trenner für die einzelnen Tags',
	'ABBCODES_BOXRESIZE'				=> 'Verändere die Größe der Text Eingabebox',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'Zeige Buttons, um die Größe Text Eingabe Box zu verändern.',

	'ABBCODES_RESIZER'					=> 'Image Resizer',
	'ABBCODES_RESIZE'					=> 'Große Bilder verkleinern',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'Hiermit wird der Fehler des [img] BBCode korrigiert, wenn jemand ein Bild hochlädt, das die Dimensionen deines Forums überschreitet.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Hinweis:</strong> Die <em>AdvancedBox JS</em> ist eine Javascript Software, die Bilder in voller Größe anzeigt.<br />Du kannst  <strong>ABBC3</strong> aber auch anderen Scripts verwenden. Diese Scripts sind optional. Jedes Script hat seinen eigenen Support. Daher bin ich dafür nicht verantwortlich. Ich werde auch keinerlei Fragen zu Problemen oder Fehlern zu diesen Sripts beantworten.',
	'ABBCODES_RESIZE_METHOD'			=> 'Änderungsmethode',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Wähle aus, wie die Bilder in verschiedenen Situationen als Vollbild dargestellt werden sollen.',
	'ABBCODES_RESIZE_BAR'				=> 'Hinweis zur Größenänderung',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Verwende den oberen Rand für die geänderten Bilder',
##	For translate :                                	 Don't				Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'Advanced Box JS',
													'HighslideBox'	=> 'Highslide JS',
													'LiteBox'		=> 'Lightbox2 JS',
													'GreyBox'		=> 'GreyBox JS',
													'Lightview'		=> 'Lightview JS',
													'Shadowbox'		=> 'Shadowbox JS',
													'PopBox'		=> 'PopBox JS',
													'pop-up'		=> 'Pop Up Fenster',
													'enlarge'		=> 'Vergrößern',
													'samewindow'	=> 'Gleiches Fenster',
													'newwindow'		=> 'Neues Fenster',
													'none'			=> 'Nicht ändern'),

	'NO_EXIST_EXPLAIN_ADVANCEDBOX'		=> 'Die Datei <strong>AdvancedBox.js</strong> ist nicht im Verzeichnis <em>%1$s</em> vorhanden',
	'NO_EXIST_EXPLAIN_OTHERS'			=> 'Die Date <strong>%1$s version %2$s</strong> ist nicht im Verzeichnis <em>%3$s</em> vorhanden<br />Wenn du %4$s verwenden willst, musst du erst die Datei(en) von %4$s von <a href="%5$s" onclick="window.open(this.href);return false;">hier</a> downloaden und sie dann in das Verzeichnis <em>%3$s</em> hochladen.',

	'ABBCODES_MAX_IMAGE_WIDTH'			=> 'Maximale Bildbreite in Pixeln',
	'ABBCODES_MAX_IMAGE_WIDTH_EXPLAIN'	=> 'Die Größe des Bildes wird verändert, sobald die Breite des Bildes den hier eingestellten Wert überschreitet.',
	'ABBCODES_MAX_IMAGE_HEIGHT'			=> 'Maximale Bildhöhe in Pixeln',
	'ABBCODES_MAX_IMAGE_HEIGHT_EXPLAIN'	=> 'Die Größe des Bildes wird verändert, sobald die Höhe des Bildes den hier eingestellten Wert überschreitet.',
	'ABBCODES_MAX_THUMB_WIDTH'			=> 'Maximale Breite des Thumbnails in Pixeln',
	'ABBCODES_MAX_THUMB_WIDTH_EXPLAIN'	=> 'Ein generiertes Thumbnail wird den hier eingestellten Wert nicht überschreiten.',
	'ABBCODES_RESIZE_SIGNATURE'			=> 'Größere Bilder in den Signaturen verkleinern',
	'ABBCODES_RESIZE_SIGNATURE_EXPLAIN'	=> 'Sollen auch größere Bilder in den Signaturen verkleinert werden?',
	'ABBCODES_SIG_IMAGE_WIDTH'			=> 'Maximale Breite des Signatur Bildes in Pixeln',
	'ABBCODES_SIG_IMAGE_WIDTH_EXPLAIN'	=> 'Die Größe des Signatur Bildes wird verändert, sobald die Breite des Bildes den hier eingestellten Wert überschreitet.',
	'ABBCODES_SIG_IMAGE_HEIGHT'			=> 'Maximale Höhe des Signatur Bildes in Pixeln',
	'ABBCODES_SIG_IMAGE_HEIGHT_EXPLAIN'	=> 'Die Größe des Signaturbildes wird verändert, sobald die Höhe des Bildes den hier eingestellten Wert überschreitet.',

	'ABBCODES_VIDEO_SIZE'				=> 'Video Abmessungen',
	'ABBCODES_VIDEO_SIZE_EXPLAIN'		=> 'Die Standard Höhe und Breite für ein Beitragsvideo.',
	'ABBCODES_VIDEO_ALLOWED'			=> 'Erlaubte Video Typen',
	'ABBCODES_VIDEO_ALLOWED_EXPLAIN'	=> 'Wähle hier aus, von welchen Seiten und/oder welche Formate deine Benutzer in ihren Beiträgen verwenden dürfen, wenn der BBvideo BBCode aktiviert ist <em class="error">(*)</em>',
	'ABBCODES_VIDEO_ALLOWED_NOTE'		=> '<em class="error">(*)</em> Um mehrere Einstellungen zu aktivieren/deaktivieren, verwende CTRL+CLICK (oder CMD-CLICK beim Mac), um sie hinzuzufügen. Wenn du vergisst  CTRL/CMD gedrückt zu halten, werden alle zuvor ausgewähltem Einstellung ausgeschaltet.',
	'ABBCODES_VIDEO_WMODE'				=> 'Transparent modus',
	'ABBCODES_VIDEO_WMODE_EXPLAIN'		=> 'Legt die Flash-Variable "wmode", um transparent. Dies wird nur benötigt, wenn Ihr Forum hat eine geschichtete statischen Objekt (z. B. eine Fußzeile Symbolleiste) und die eingebetteten Videos werden auf dem statischen Objekt gerendert.',

	'ABBCODES_COLOUR_MODE'				=> 'Wähle Farbauswahlmodus',
##	For translate :                                	 Don't			Yes
	'ABBCODES_COLOUR_SELECTOR'			=> array(	'phpbb'		=> 'phpBB standard Style',
													'dropdown'	=> 'Aufklappmenü',
													'fancy'		=> '“witzigen” Auswähler',
													'tigra'		=> 'Tigra Farbwähler'),
	'ABBCODES_WIZARD_MODE'				=> 'Wähle den Unterstützungsmodus',
##	For translate :                                	Don't			Yes
	'ABBCODES_WIZARD_SELECTOR'			=> array(	'0'			=> 'Unterstützung deaktivieren',
													'1'			=> 'Pop Up Fenster',
													'2'			=> 'Im Beitrag'),
	'ABBCODES_UCP_MODE'					=> 'UCP Kontrolloptionen',
	'ABBCODES_UCP_MODE_EXPLAIN'			=> 'Erlaube den Benutzern ihren eigenen Editormodus zu verwenden. Sie können dann zwischen den standard phpBB3 BBCode Buttons, der ABBC3 “Erweiterten” oder der ABBC3 “Kompakt” Ansicht wählen.',

	'ABBCODES_WIZARD'					=> 'Helfer',
	'ABBCODES_WIZARD_SIZE'				=> 'Größe der Helferanzeige',
	'ABBCODES_WIZARD_SIZE_EXPLAIN'		=> 'Standard Breite und Höhe des PupUp Helfer Fensters.',

	'ABBCODES_DESELECT_ALL'				=> 'Alle abwählen',
	'ABBCODES_SELECT_ALL'				=> 'Alle auswählen',

	'ABBCODES_VERSION_CHECK'			=> 'Versionsprüfung',
	'ABBCODES_CURRENT_VERSION'			=> 'Derzeit installierte Version',
	'ABBCODES_LATEST_VERSION'			=> 'Neueste Version',
	'ABBCODES_DOWNLOAD_LATEST'			=> 'Neueste Version Herunterladen',
));

// bbcodes_edit
$lang = array_merge($lang, array(
	'ABBCODES_SETINGS'					=> 'ABBC3 Einstellungen',
	'ABBCODES_SETINGS_EXPLAIN'			=> 'Hier kannst du die Basiseinstellungen für den <strong>ABBC3</strong> festlegen, ihn aktivieren oder deaktivieren, sowie weitere Standardeinstellungen vornehmen.',

	'ABBCODES_EDIT'						=> 'ABBC3 BBCode bearbeiten',
	'ABBCODES_EDIT_EXPLAIN'				=> 'Hier kannst du festlegen, wer welche BBCodes verwenden darf, sowie die Reihenfolge und das dazugehörige Icon festlegen.',

	'ABBCODES_CONFIG'					=> 'ABBC3 Komponenteneinstellungen',
	'ABBCODES_CONFIG_EXPLAIN'			=> 'Hier kannst du die Reihenfolge der Tags festlegen oder auch die Icons ändern.',
	'ABBCODES_GROUPS_EXPLAIN'			=> '<strong>Gruppen verwalten:</strong> Wenn keine Gruppen angegeben wurden, kann dieser BBCode von allen Benutzer verwendet werden.<br />Um mehrere Gruppen gleichzeitig auszuwählen bzw. abzuwählen, verwende die CTRL Taste zusammen mit der Maus (Cmd beim Mac), um die gewünschten Gruppen auszuwählen. Falls du vergisst die CTRL/Cmd Taste gedrückt zu halten, gehen die vorherigen Einstellungen verloren.',

	'ABBCODES_TIP'						=> 'Tag Tipp',
	'ABBCODES_NAME'						=> 'Tag Name',
	'ABBCODES_TAG'						=> 'Tag Icon',
	'ABBCODES_ORDER'					=> 'Tag Reihenfolge',
	'ABBCODES_CUSTOM'					=> 'Custom BBCode',

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Zeilenumbruch</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>Trennlinie</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Eine neue Trennlinie hinzufügen',
	'ABBCODES_ADD_BREAK'				=> 'Einen neuen Zeilumbruch hinzufügen',
	'ABBCODES_SYNC'						=> 'Synchronisiere die Reihenfolge',
	'ABBCODES_RESYNC_SUCCESS'			=> 'Die Reihenfolge der BBCodes wurde neu synchronisiert.',

	'ABBCODES_MOD_DISABLE'				=> 'Die <strong>Advanced BBCode Box 3</strong> ist deaktiviert.<br />',
	'ABBCODES_STATUS'					=> 'Status',
	'ABBCODES_ACTIVATED'				=> 'aktiviert',
	'ABBCODES_DEACTIVATED'				=> 'deaktiviert',
));

// UMIL Installer
$lang = array_merge($lang, array(
// Main
	'INSTALLER_TITLE'					=> 'Advanced BBCode Box 3',
	'INSTALLER_TITLE_EXPLAIN'			=> 'Willkommen im <strong>ABBC3</strong> Installationsmenü',

	'INSTALLER_INSTALL_WELCOME'			=> 'Wenn du auswählst, daß du ABBC3 installieren möchtest, werden alle Datenbankeinträge früherer Version gelöscht.',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Bitte beachte, daß einige BBCodes möglicherweise <strong>nicht</strong> korrekt angezeigt werden können.
	<br />Falls du Probleme bei der Verwendung des <a href="http://www.phpbb.com/support/stk/" title="" onclick="window.open(this.href);return false;">Support Toolkit <em>(STK)</em></a> <strong> haben solltest, verwenden in den Admin Tools » Reparse BBCode</strong>.
	<br /><br />Bevor du diese MOD auf deinem Board installierst, solltest du ein Backup der Dateien und der Datenbank machen.',
	'INSTALLER_INSTALL_END'				=> 'Du kannst dich nun auf <a href="./index.php">deinem Board einloggen</a> und prüfen, ob alles so funktioniert, wie es sollte. <br />Nicht vergessen, die Datei <strong><em>install_abbc3.php</em></strong> zu löschen, umzubenennen oder zu verschieben!',
// Stages
	'INSTALLER_CONFIGS_ADD'				=> 'ABBC3 Konfiguration',
	'INSTALLER_BBCODES_ADD'				=> 'ABBC3 bbCodes',
// Misc
	'INSTALLER_RESIZE_CHECK'			=> 'Image Resizer update-prüfung abgeschlossen',
));

?>