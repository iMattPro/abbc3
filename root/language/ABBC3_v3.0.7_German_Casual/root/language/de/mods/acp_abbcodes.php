<?php
/**
* @package: phpBB 3.0.5 :: Advanced BBCode box 3 -> root/language/de/mods :: [de][German]
* @version: $Id$
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
// â€™ Â» â€œ â€? â€¦
// ’ » “ ” …
//

// This lines are the same as root/language/en/acp/common.php
$lang = array_merge($lang, array(
	'ACP_ABBCODES'				=> 'Advanced BBcodes Box 3',
	'ACP_ABBC3_SETTINGS'		=> 'ABBC3 Einstellungen',
	'ACP_ABBC3_BBCODES'			=> 'ABBC3 BBCodes',
	'LOG_CONFIG_ABBCODES'		=> '<strong>ABBC3 Einstellungen geändert</strong>',
	'LOG_CONFIG_ABBCODES_ERROR'	=> '<strong>Fehler beim Speichern der ABBC3 Einstellungen</strong>',
	'LOG_CONFIG_ADD'			=> '<strong>Board Einstellungen hinzugefügt</strong><br />Â» %s',
	'LOG_DATABASE_SCHEMA'		=> '<strong>Datenbank Schemas aktualisiert</strong><br />Â» %s',
	'LOG_DELETE_ABBCODES'		=> '<strong>MOD ABBC3 aus der Datenbank entfernt</strong>',
));

// abbc3_details
$lang = array_merge($lang, array(
	'ACP_ABBCODES'						=> 'Advanced BBcodes Box 3',
	'ABBCODES_DISABLE'					=> 'ABBC3',
	'ABBCODES_DISABLE_EXPLAIN'			=> 'Die <strong>Advanced BBodes Box 3</strong> für die Benutzer ein - bzw. ausschalten. Ist sie ausgeschaltet, werden die Standard Buttons von phpBB3 verwendet.',
	'ABBCODES_PATH'						=> 'Script Pfad',
	'ABBCODES_PATH_EXPLAIN'				=> 'Pfad zu den ABBC3 Dateien unterhalb deines phpBB Root Verzeichnisses, z.B. <samp>styles/abbcode</samp>',
	'ABBCODES_BG'						=> 'Hintergrundbild',
	'ABBCODES_BG_EXPLAIN'				=> 'Ein Hintergrundbild für deine Icons.<br />Wähle  <em>Kein Bild</em> aus, um es passend zu deinem Style zu halten.',
	'ABBCODES_TAB'						=> 'Zeige einen Trenner für die einzelnen Tags',
	'ABBCODES_BOXRESIZE'				=> 'Verändere die Größe der Text Eingabebox',
	'ABBCODES_BOXRESIZE_EXPLAIN'		=> 'Zeige Buttons, um die Größe Text Eingabe Box zu verändern.',
	'ABBCODES_RESIZE'					=> 'Große Bilder verkleinern',
	'ABBCODES_RESIZE_EXPLAIN'			=> 'Hiermit wird der Fehler des [img] BBCode korrigiert, wenn jemand ein Bild hochlädt, das die Dimensionen deines Forums überschreitet.',
	'ABBCODES_JAVASCRIPT_EXPLAIN'		=> '<strong>Hinweis:</strong> Die <em>AdvancedBox JS</em> ist eine Javascript Software, die Bilder in voller Größe anzeigt.<br />Du kannst  <strong>ABBC3</strong> aber auch anderen Scripts verwenden. Diese Scripts sind optional. Jedes Script hat seinen eigenen Support. Daher bin ich dafür nicht verantwortlich. Ich werde auch keinerlei Fragen zu Problemen oder Fehlern zu diesen Sripts beantworten.',
	'ABBCODES_RESIZE_METHOD'			=> 'Änderungsmethode',
	'ABBCODES_RESIZE_METHOD_EXPLAIN'	=> 'Wähle aus, wie die Bilder in verschiedenen Situationen als Vollbild dargestellt werden sollen.',
	'ABBCODES_RESIZE_BAR'				=> 'Hinweis zur Größenänderung',
	'ABBCODES_RESIZE_BAR_EXPLAIN'		=> 'Verwende den oberen Rand für die geänderten Bilder',
##	For translate :                                	 Don't				Yes
	'ABBCODES_RESIZE_METHODS'			=> array(	'AdvancedBox'	=> 'Advanced Box JS', 
													'HighslideBox'	=> 'Highslide Box JS', 
													'LiteBox'		=> 'Lite Box JS', 
													'GreyBox'		=> 'Grey Box JS', 
													'Lightview'		=> 'Light view JS', 
													'Ibox'			=> 'Schattenbox mit Ibox JS', 
													'PopBox'		=> 'Pop Box JS', 
													'pop-up'		=> 'Pop Up Fenster', 
													'enlarge'		=> 'Vergrößern', 
													'samewindow'	=> 'Gleiches Fenster', 
													'newwindow'		=> 'Neues Fenster', 
													'none'			=> 'Nicht ändern'),

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

	'ABBCODES_UPLOAD_EXTENSION'			=> 'Verfügbare Dateiendungen',
	'ABBCODES_UPLOAD_EXTENSION_EXPLAIN'	=> 'Hier kannst du verfügbare Dateiendungen hinzufügen/ändern/löschen. Trenne die einzelnen Endungen mit einem Komma (,)<br /><strong>Hinweis: </strong> Diese Werte überschreiben die Dateiendungen, die im Attachment Modul angegeben wurden.',
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

	'ABBCODES_BREAK_MOVER'				=> '<strong><i>Zeilenumbruch</i></strong>',
	'ABBCODES_DIVISION_MOVER'			=> '<strong><i>Trennlinie</i></strong>',
	'ABBCODES_ADD_DIVISION'				=> 'Eine neue Trennlinie hinzufügen',
	'ABBCODES_ADD_BREAK'				=> 'Einen neuen Zeilumbruch hinzufügen',
	'ABBCODES_SYNC'						=> 'Synchronisiere die Reihenfolge',
	'ABBCODES_RESYNC_SUCCESS'			=> 'Die Reihenfolge der BBCodes wurde neu synchronisiert.',

	'ABBCODES_MOD_DISABLE'				=> 'Die <strong>Advanced BBcodes Box 3</strong> ist deaktiviert.<br />',
	'ABBCODES_STATUS'					=> 'Status',
	'ABBCODES_ACTIVATED'				=> 'aktiviert',
	'ABBCODES_DEACTIVATED'				=> 'deaktiviert',
));

// Installer 
$lang = array_merge($lang, array(
	// Main
	'INSTALLER_TITLE'					=> 'Advanced BBcodes Box 3',
	'INSTALLER_VERSION'					=> ' Version: %1$s',

	'INSTALLER_INTRO'					=> 'Einführung',
	'INSTALLER_INTRO_WELCOME'			=> 'Willkommen zur Installation des <strong>%1$s</strong>',
	'INSTALLER_INTRO_WELCOME_NOTE'		=> 'Bitte wähle aus, was du tun willst.',
	'INSTALLER_INSTALL_MENU'			=> 'Menü',
	'INSTALLER_EXTRA_MENU'				=> 'Extras',

	// Install
	'INSTALLER_INSTALL'					=> 'Installieren',
	'INSTALLER_INSTALL_WELCOME'			=> 'Willkommen im Installationsmenü von  <strong>ABBC3</strong>',
	'INSTALLER_INSTALL_WELCOME_NOTE'	=> 'Wenn du jetzt die Installation des ABBC3 auswählst, gehen alle Datenbankeinträge vorheriger Versionen verloren.',
	'INSTALLER_INSTALL_SUCCESSFUL'		=> 'Die Installation des ABBC3 wurde erfolgreich durchgeführt.',
	'INSTALLER_INSTALL_UNSUCCESSFUL'	=> 'Die Installation des ABBC3 war <strong>nicht</strong> erfolgreich.',
	'INSTALLER_INSTALL_VERSION'			=> 'Installiere die Version: %1$s',
	'INSTALLER_INSTALL_END'				=> 'Die Installation der Version <strong>%1$s: %2$s</strong> wurde erfolgreich beendet. <br /> <p>Du solltest dich jetzt in deinem Forum <a href="./index.php">anmelden</a> und prüfen, ob alles normal funktioniert. <br />Nicht vergessen, die Datei <strong>install_abbc3.php</strong> umzubenennen, zu löschen oder zu verschieben!</p>',

	// Update
	'INSTALLER_UPDATE'					=> 'Aktualisieren',
	'INSTALLER_UPDATE_WELCOME'			=> 'Willkommen im <strong>ABBC3</strong> Aktualisierungsmenü',
	'INSTALLER_UPDATE_WELCOME_NOTE'		=> 'Wenn du die Aktualisierung des ABBC3 auswählst, werden alle Datenbakeinträge vorheriger Versionen gelöscht.',
	'INSTALLER_UPDATE_SUCCESSFUL'		=> 'Die Aktualisierung des ABBC3 wurde erfolgreich abgeschlossen.',
	'INSTALLER_UPDATE_UNSUCCESSFUL'		=> 'Die Aktualisierung des ABBC3 war <strong>nicht</strong> erfolgreich.',
	'INSTALLER_UPDATE_VERSION'			=> 'Aktualisierung auf die Version: %1$s',
	'INSTALLER_UPDATE_END'				=> 'Bitte beachte, daß - auf Grund von Änderungen in den BBCodes - einzelne BBCodes <strong>nicht</strong> richtig dargestellt werden könnten. Solltest du Probleme mit einzelnen BBCodes haben, befolge die Anweisungen unter <strong>Extras -> Re-Parse</strong>',

	// Uninstall
	'INSTALLER_DELETE'					=> 'Deinstallation',
	'INSTALLER_DELETE_WELCOME'			=> 'Willkommen im <strong>ABBC3</strong> Deinstallationsmenü',
	'INSTALLER_DELETE_WELCOME_NOTE'		=> 'Wenn du diese Option auswählst, werden alle Datenbankeinträge, die während der Installation gemacht wurden, wieder entfernt.',
	'INSTALLER_DELETE_VERSION'			=> 'Entferne die Version: %1$s',
	'INSTALLER_DELETE_NOTE'				=> 'Enfernen',
	'INSTALLER_DELETE_SUCCESSFUL'		=> 'Entfernen der Version <strong>%1$s: %2$s</strong> war erfolgreich.<br />Lösche nun alle Dateien.',
	'INSTALLER_DELETE_UNSUCCESSFUL'		=> 'Konnte die %1$s Version <strong>nicht</strong> löschen: %2$s .',

	// Re-parse
	'INSTALLER_REPARSE'					=> 'Re-Parse',
	'INSTALLER_REPARSE_WELCOME'			=> 'Willkommen im Re-Parse Menü',
	'INSTALLER_REPARSE_WELCOME_NOTE'	=> 'Wenn du dich entscheidest, die <strong>Re-Parse</strong> Funktion zu nutzen, werden BBCodes mit einem Klick neu geparst -- das ist sinnvoll, wenn du z.B. den Sytax von BBCodes geändert hast. Ändere nur Werte, aber keine Text ...',
	'INSTALLER_REPARSE_NOTE'			=> 'Bitte beachte, daß es Datenbankfehler geben kann. Du benutzt diese Funktion auf eigenes Risiko und ich bin nicht verantwortlich, wenn etwas nicht funktioniert. Ein Backup der Datenbank sollte vorher durchgeführt werden.',
	'INSTALLER_REPARSE_WARNING'			=> 'Du solltest mindestens ein Backup deiner Benutzer Tabelle, der  Nachrichten und der privaten Nachrichten Tabellen durchführen, für den Fall, daß etwas schief läuft.',
	'INSTALLER_REPARSE_POST'			=> 'Re-parse Inhalt der Nachrichten',
	'INSTALLER_REPARSE_SIG'				=> 'Re-parse Signaturen',
	'INSTALLER_REPARSE_PM'				=> 'Re-parse Private Nachrichten',
	'INSTALLER_REPARSE_SUCCESSFUL'		=> '%1$s war erfolgreich.',
	'INSTALLER_REPARSE_UNSUCCESSFUL'	=> 'Konnte <strong>icht</strong> %1$s.',
	
	'STEP_PERCENT_COMPLETED'			=> 'Schritt <strong>%d</strong> von <strong>%d</strong>',
	'INSTALLER_NOTE'					=> '<strong>Hinweis:</strong> Bevor du diesen MOD installierst, solltest du ein Backup deiner Datenbank und allen dazugehörigen Dateien durchführen!',
	'INSTALLER_DELETE_INFORMATION'		=> 'Konnte <strong>keine</strong> ABBC3 Installation finden!',
	'INSTALLER_NEEDS_FOUNDER'			=> 'Du mußt als Gründer angemeldet sein.',
	'MISSING_PARENT_MODULE'				=> 'Modul #%1$s fehlt als übergeordnetes Modul für "%2$s".',
	'WARNING'							=> 'Warnung',
));

?>