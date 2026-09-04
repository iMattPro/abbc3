<?php
/**
*
* Advanced BBCode Box [Greek]
*
* Greek translation by the_observer April 2015(gnikits@gmail.com)
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Εδώ μπορείτε να διαμορφώσετε τις ρυθμίσεις για το Advanced BBCode Box. Για πληροφορίες σχετικά με την προσαρμογή της γραμμής εικονιδίων, επισκεφτείτε το %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Προσθέστε <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Γραμματοσειρές Google</a></strong> στο <samp class="error">[font]</samp> BBCode. Χρησιμοποιήστε ακριβή ορθογραφία και ευαισθησία πεζών-κεφαλαίων. Τοποθετήστε κάθε όνομα γραμματοσειράς σε ξεχωριστή γραμμή.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Η επιλογή "Να επιτρέπεται η χρήση δικτύων παράδοσης περιεχομένου τρίτων" πρέπει να είναι ενεργοποιημένη στην ενότητα "Φόρτωση ρυθμίσεων" για να χρησιμοποιήσετε αυτήν τη δυνατότητα.',
	'ABBC3_INVALID_FONT'		=> 'Μη έγκυρο όνομα γραμματοσειράς για το "%s"',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Δεν ήταν δυνατή η επαλήθευση της γραμματοσειράς Google "%s". Ελέγξτε τη σύνδεση διακομιστή και δοκιμάστε ξανά.',
	'ABBC3_PIPES'				=> 'Ενεργοποίηση της προσθήκης Pipe Table PlugIn',
	'ABBC3_PIPES_EXPLAIN'		=> 'Το πρόσθετο Pipe Table PlugIn επιτρέπει στους χρήστες να δημιουργούν πίνακες στις αναρτήσεις και τα προσωπικά τους μηνύματα χρησιμοποιώντας τη σύνταξη markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Ενεργοποιήστε τη γραμμή εικονιδίων BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Αυτό θα εμφανίσει τη γραμμή εργαλείων BBCode του ABBC3 που βασίζεται σε εικονίδια. Απενεργοποιήστε το για να εμφανίσετε τα προεπιλεγμένα κουμπιά BBCode του phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Ενεργοποίηση BBCodes στη Γρήγορη απάντηση',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Αυτό θα προσθέσει κουμπιά BBCode στη Γρήγορη απάντηση.',
	'ABBC3_ICONS_TYPE'			=> 'Μορφή εικόνας γραμμής εικονιδίων',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Επιλέξτε τη μορφή εικόνας που θα χρησιμοποιήσετε για τα εικονίδια του ABBC3. Σημειώστε ότι μπορείτε να επιλέξετε μόνο μία μορφή για όλα τα εικονίδια σας.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Γραμμή εικονιδίων BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Προσθήκες',
	'ABBC3_AUTO_VIDEO'			=> 'Ενεργοποίηση αυτόματης προσθήκης βίντεο',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Αυτή η προσθήκη μετατρέπει διευθύνσεις URL αρχείων βίντεο απλού κειμένου σε βίντεο με δυνατότητα αναπαραγωγής. Μετατρέπονται μόνο οι διευθύνσεις URL που ξεκινούν με <samp class="error">http://</samp> ή <samp class="error">https://</samp> και τελειώνουν σε <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> ή <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Εγκαταστήστε την προαιρετική επέκταση phpBB Media Embed για πρόσβαση σε ρυθμίσεις και επιλογές διαχείρισης για ενσωματωμένο περιεχόμενο εμπλουτισμένου πολυμέσων.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Η επέκταση phpBB Media Embed δεν είναι εγκατεστημένη. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Έχει εγκατασταθεί η επέκταση phpBB Media Embed. Οι ρυθμίσεις είναι προσβάσιμες στην καρτέλα Δημοσίευση.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
