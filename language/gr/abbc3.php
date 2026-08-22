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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Κρυφό Κείμενο',
	'ABBC3_HIDDEN_OFF'			=> 'Κρυφό Κείμενο (μόνο για εγγεγραμένους χρήστες)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Αυτο το φόρουμ απαιτεί να είσαι εγγεγραμένος και συνδεδεμένος για να σου επιτραπεί να δεις το κρυφό κείμενο.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '&#9658; Εμφάνιση Spoiler',
	'ABBC3_SPOILER_HIDE'		=> '&#9660; Απόκρυψη Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Εκτός Θέματος',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Γραμματοσειρές',
	'ABBC3_FONT_SAFE'			=> 'Ασφαλής Γραμματοσειρές',
	'ABBC3_GOOGLE_FONTS'		=> 'Γραμματοσειρές Google',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Ευθυγραμμισμένο κείμενο: [align=center|left|right|justify]text[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Ενσωμάτωσε video url από οποιοδήποτε video site: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Θολωμένο κείμενο: [blur=color]text[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Φορά κειμένου: [dir=ltr|rtl]text[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Σκιώδες κείμενο: [dropshadow=color]text[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Αναβοσβύνων κείμενο: [fade]text[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Επιπλέων κείμενο: [float=left|right]text[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Είδος Γραμματοσειράς: [font=Comic Sans MS]text[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Λαμπερό κείμενο: [glow=color]text[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Απόκρυψη από επισκέπτες: [hidden]text[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Κείμενο έμφασης: [highlight=yellow]text[/highlight]  Συμβουλή: μπορείτε επίσης να χρησιμοποιήσετε color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Κείμενο μαρκίζας: [marq=up|down|left|right]text[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Μύνημα συναγερμού: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Κείμενο NFO τέχνης ascii: [nfo]text[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Μύνημα εκτός θέματος: [offtopic]text[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Προδιαμορφωμένο κείμενο: [pre]text[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Σκιασμένο κείμενο: [shadow=color]text[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]https://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Μύνημα Spoiler: [spoil]text[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Διεγραμένο κείμενο: [s]text[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Κείμενο στο κάτω μέρος της γραμμής: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Κείμενο στο πάνω μέρος της γραμμής: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Βίντεο YouTube: [youtube]http://youtube_url[/youtube]',
	'ABBC3_AUTOVIDEO_HELPLINE'	=> 'Ενσωμάτωση αρχείων βίντεο MP4/OGG/WEBM: το URL πρέπει να αρχίζει με <samp class="error">https</samp> ή <samp class="error">http</samp> και να τελειώνει σε <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> ή <samp class="error">.webm</samp> (δεν απαιτείται BBCode). Η υποστήριξη του προγράμματος περιήγησης και η υλοποίηση του περιβάλλοντος διαφέρουν.',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Αντιγραφή επιλεγμένου κειμένου',
	'ABBC3_PASTE_BBCODE'		=> 'Επικόληση αντεγραμένου κειμένου',
	'ABBC3_PASTE_ERROR'			=> 'Πρώτα πρέπει να αντιγράψεις κάποιο επιλεγμένο κείμενο και μετά να το επικολήσεις',
	'ABBC3_PLAIN_BBCODE'		=> 'Αφαίρεση όλων των BBCode ετικετών από το επιλεγμένο κείμενο',
	'ABBC3_NOSELECT_ERROR'		=> 'Δεν έχει επιλεχθεί κείμενο.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Εισαγωγή στο μύνημα',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Παράδειγμα',
	'ABBC3_BBVIDEO_SITES'		=> 'επιτρεπόμενα sites',
	'ABBC3_URL_LINK'			=> 'URL ιστοσελίδας',
	'ABBC3_URL_DESCRIPTION'		=> 'Προαιρετική περιγραφή',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb.com',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Δημιουργία πινάκων',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Δημιουργήστε πίνακες χρησιμοποιώντας οποιαδήποτε από αυτές τις μορφές τύπου ASCII.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Οδηγός χρήσης',
	'ABBC3_PIPE_SIMPLE'			=> 'Απλό τραπέζι',
	'ABBC3_PIPE_COMPACT'		=> 'Συμπαγές τραπέζι',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'Οι εξωτερικοί σωλήνες και οι χώροι γύρω από τους σωλήνες είναι προαιρετικοί.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Στοίχιση κειμένου',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Header 1 | Header 2 |\n|----------|----------|\n| Cell 1   | Cell 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Header 1|Header 2\n-|-\nCell 1|Cell 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Left | Center | Right |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'Η σειρά των BBCode ενημερώθηκε.',
	'ABBC3_BBCODE_ORDERED_FAIL'	=> 'Δεν ήταν δυνατή η ενημέρωση της παραγγελίας του BBCode.',
	'ABBC3_BBCODE_ORDER_NO_TABLE'	=> 'Δεν ελήφθη όνομα πίνακα BBCode.',
	'ABBC3_BBCODE_ORDER_NO_DATA'	=> 'Δεν ελήφθησαν δεδομένα παραγγελίας BBCode.',
	'ABBC3_BBCODE_ORDER_NO_ORDER'	=> 'Δεν ενημερώθηκαν σειρές BBCode.',
	'ABBC3_BBCODE_GROUP'		=> 'Δειχείρηση των ομάδων που θα μπορούν να χρησιμοποιήσουν αυτό το BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Αν δεν επιλεχθεί ομάδα τότε όλοι οι χρήστες μπορούν να χρησιμοποιήσουν αυτό το BBCode. Πάτα CTRL+CLICK (ή CMD+CLICK για Mac) για να επιλέξεις/αποεπιλέξεις περισσότερες από μία ομάδες.',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'BBCodes του Advanced BBCode Box',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Η γρήγορη καφετιά αλεπού πηδά πάνω από το τεμπέλικο σκυλί',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br><br><strong>Παράδειγμα:</strong><br>%2$s<br><br><strong>Αποτέλεσμα:</strong><br>%3$s<hr>',
));
