<?php
/**
* @package: phpBB 3.0.9 :: Advanced BBCode Box 3 -> root/language/de/mods :: [de][German]
* @version: $Id: abbcode.php, v 3.0.9.3 2010/10/04 19:11:22 femu Exp $
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

$lang = array_merge($lang, array(
// Help page
	'ABBC3_HELP_TITLE'			=> 'Advanced BBCode Box 3 :: Hilfe Seite',
	'ABBC3_HELP_DESC'			=> 'Beschreibung',
	'ABBC3_HELP_WRITE'			=> 'Dein Schreibformat',
	'ABBC3_HELP_VIEW'			=> 'Unser Anzeigeformat',
	'ABBC3_HELP_ABOUT'			=> 'Advanced BBCode Box 3 by <a href="http://www.mssti.com/phpbb3" onclick="window.open(this.href);return false;">mssti</a>',
	'ABBC3_HELP_ALT'			=> 'Advanced BBCode Box 3 (aka ABBC3)',

// Image Resizer JS
	'ABBC3_RESIZE_SMALL'		=> 'Klicke um das Bild in voller Größe zu sehen.',
	'ABBC3_RESIZE_ZOOM_IN'		=> 'Vergrößern (tatsächliche Abmessungen: %1$s x %2$s)',
	'ABBC3_RESIZE_CLOSE'		=> 'Schließen',
	'ABBC3_RESIZE_ZOOM_OUT'		=> 'Verkleinern',
	'ABBC3_RESIZE_FILESIZE'		=> 'Die Abmessungen wurden verändert. Die Originalabmessungen lauten %1$s x %2$s und das Bild hat eine Größe von %3$sKB.',
	'ABBC3_RESIZE_NOFILESIZE'	=> 'Die Bildabmessungen wurden verändert. Die Originalabmessungen lauten %1$s x %2$s.',
	'ABBC3_RESIZE_FULLSIZE'		=> 'Bildabmessungen geändert auf: %1$s % seiner Originalabmessungen [ %2$s x %3$s ]',
	'ABBC3_RESIZE_NUMBER'		=> 'Bild %1$s von %2$s',
	'ABBC3_RESIZE_PLAY'			=> 'Diashow wiedergeben',
	'ABBC3_RESIZE_PAUSE'		=> 'Diashow unterbrechen',

// Pop Box JS
	'ABBC3_POPBOX_REVERSETEXT'	=> 'Klicke auf das Bild, um es zu verkleinern.',

// Highslide JS - http://vikjavev.no/highslide/forum/viewtopic.php?t=2119
	'ABBC3_HIGHSLIDE_LOADINGTEXT'		=> 'Lade ...',
	'ABBC3_HIGHSLIDE_LOADINGTITLE'		=> 'Klicke hier, um abzubrechen',
	'ABBC3_HIGHSLIDE_FOCUSTITLE'		=> 'Klicke hier, um es in den Vordergrund zu stellen',
	'ABBC3_HIGHSLIDE_FULLEXPANDTITLE'	=> 'Vergrößere es auf die aktuelle Größe',
	'ABBC3_HIGHSLIDE_FULLEXPANDTEXT'	=> 'Vollbild',
	'ABBC3_HIGHSLIDE_CREDITSTEXT'		=> 'Powered by <i>Highslide JS</i>',
	'ABBC3_HIGHSLIDE_CREDITSTITLE'		=> 'Gehe zur Homepage von Highslide JS',
	'ABBC3_HIGHSLIDE_PREVIOUSTEXT'		=> 'Vorheriges',
	'ABBC3_HIGHSLIDE_PREVIOUSTITLE'		=> 'Vorheriges (Pfeil links)',
	'ABBC3_HIGHSLIDE_NEXTTEXT'			=> 'Nächstes',
	'ABBC3_HIGHSLIDE_NEXTTITLE'			=> 'Nächstes (Pfeil rechts)',
	'ABBC3_HIGHSLIDE_MOVETITLE'			=> 'Verschieben',
	'ABBC3_HIGHSLIDE_MOVETEXT'			=> 'Verschieben',
	'ABBC3_HIGHSLIDE_CLOSETEXT'			=> 'Schließen',
	'ABBC3_HIGHSLIDE_CLOSETITLE'		=> 'Schließen (ESC)',
	'ABBC3_HIGHSLIDE_RESIZETITLE'		=> 'Größe ändern',
	'ABBC3_HIGHSLIDE_PLAYTEXT'			=> 'Abspielen',
	'ABBC3_HIGHSLIDE_PLAYTITLE'			=> 'Diashow abspielen (Leertaste)',
	'ABBC3_HIGHSLIDE_PAUSETEXT'			=> 'Anhalten',
	'ABBC3_HIGHSLIDE_PAUSETITLE'		=> 'Diashow anhalten (Leertaste)',
	'ABBC3_HIGHSLIDE_NUMBER'			=> 'Bild %1 von %2',
	'ABBC3_HIGHSLIDE_RESTORETITLE'		=> 'Klicke auf das Bild, um es zu schließen. Klicke auf das Bild und halte die Maustaste gedrückt, um es zu verschieben. Benutze die Pfeiltasten, um zum nächsten bzw. vorherigen Bild zu gelangen.',

// Text to be applied to the helpline & mouseover & help page & Wizard texts
	'BBCODE_STYLES_TIP'			=> 'Tipp: Der Stil kann einfach auf den markierten Text angewendet werden.',

	'ABBC3_ERROR'				=> 'Fehler: ',
	'ABBC3_ERROR_TAG'			=> 'Unerwarteter Fehler beim Verwenden des Tags: ',
	'ABBC3_NO_EXAMPLE'			=> 'Kein Datenbeispiel',

	'ABBC3_ID'					=> 'Bezeichnung eingeben: ',
	'ABBC3_NOID'				=> 'Du hast keine Bezeichnung eingegeben',
	'ABBC3_LINK'				=> 'Gib einen Link ein für ',
	'ABBC3_DESC'				=> 'Gib eine Beschreibung ein für ',
	'ABBC3_NAME'				=> 'Beschreibung',
	'ABBC3_NOLINK'				=> 'Du hast keinen Link eingegeben für ',
	'ABBC3_NODESC'				=> 'Du hast keine Beschreibung eingegeben für ',
	'ABBC3_WIDTH'				=> 'Gib die Breite ein',
	'ABBC3_WIDTH_NOTE'			=> 'Hinweis: Dieser Wert kann auch als Prozentwert eingegeben werden',
	'ABBC3_NOWIDTH'				=> 'Du hast keine Breite eingegeben',
	'ABBC3_HEIGHT'				=> 'Gib die Höhe ein',
	'ABBC3_HEIGHT_NOTE'			=> 'Hinweis: Dieser Wert kann auch als Prozentwert eingegeben werden',
	'ABBC3_NOHEIGHT'			=> 'Du hast keine Höhe eingegeben',

	'ABBC3_NOTE'				=> 'Hinweis',
	'ABBC3_EXAMPLE'				=> 'Beispiel',
	'ABBC3_EXAMPLES'			=> 'Beispiele',
	'ABBC3_SHORT'				=> 'Wähle BBCode',
	'ABBC3_DEPRECATED'			=> '<div class="error">Den <em>%1$s</em> bbcode gibt es seit der Version <em>%2$s</em> nicht mehr</div>',
	'ABBC3_UNAUTHORISED'		=> 'Bestimmte Wörter kannst du nicht verwenden: <br /><strong> %s </strong>',
	'ABBC3_NOSCRIPT'			=> 'Bei deinem Browser ist die Verwendung von Scripts deaktiviert oder er unterstützt keine Client-seitige Scripts. <em>( JavaScript! )</em>',
	'ABBC3_NOSCRIPT_EXPLAIN'	=> 'Die Seite, die du ansehen willst benötigt die Verwendung von Javascripts.<br />Falls du die Verwendung absichtlich deaktiviert hast, mußt sie wieder aktivieren.',
	'ABBC3_FUNCTION_DISABLED'	=> 'Diese Funktion ist hier nicht verfügbar.',
	'ABBC3_AJAX_DISABLED'		=> 'Dein Browser unterstützt kein AJAX (XMLHttpRequest) und kann daher deine Anfrage nicht bearbeiten.',
	'ABBC3_SUBMIT'				=> 'In den Beitrag einfügen',
	'ABBC3_SUBMIT_SIG'			=> 'In die Signatur einfügen',
	'SAMPLE_TEXT'				=> 'Dies ist ein Beispieltext' //	' . $lang['SAMPLE_TEXT'] . '
));

/**
* TRANSLATORS PLEASE Hinweis
*	Several lines have an special Hinweis like '##	For translate : ' follow for one or more 'yes'
*	These means that you can/have to translate the word under
**/
$lang = array_merge($lang, array(
// bbcodes texts
	// Font Type Dropdown
	'ABBC3_FONT_MOVER'			=> 'Font Typ',
	'ABBC3_FONT_TIP'			=> '[font=Comic Sans MS]Text[/font]',
	'ABBC3_FONT_NOTE'			=> 'Hinweis: Du kannst deinen eigenen Font verwenden',
	'ABBC3_FONT_VIEW'			=> '[font=Comic Sans MS]' . $lang['SAMPLE_TEXT'] . '[/font]',

	// Font family Groups
	'ABBC3_FONT_ABBC3'			=> 'ABBC Box 3',
	'ABBC3_FONT_SAFE'			=> 'Websichere Schriftarten',
	'ABBC3_FONT_WIN'			=> 'Standard',

	// Font Size Dropdown
	'ABBC3_FONT_GIANT'			=> 'Riesig',
	'ABBC3_SIZE_MOVER'			=> 'Font Größe',
	'ABBC3_SIZE_TIP'			=> '[size=150]Großer Text[/size]',
	'ABBC3_SIZE_NOTE'			=> 'Hinweis: Dieser Wert kann auch als Prozentwert verwendet werden',
	'ABBC3_SIZE_VIEW'			=> '[size=150]' . $lang['SAMPLE_TEXT'] . '[/size]',

	// Highlight Font Color Dropdown
	'ABBC3_HIGHLIGHT_MOVER'		=> 'Text hervorheben',
	'ABBC3_HIGHLIGHT_TIP'		=> '[highlight=yellow]Text[/highlight]',
	'ABBC3_HIGHLIGHT_NOTE'		=> 'Hinweis: Du kannst HTML Farben verwenden (color=#FF0000 oder color=red)',
	'ABBC3_HIGHLIGHT_VIEW'		=> '[highlight=yellow]' . $lang['SAMPLE_TEXT'] . '[/highlight]',

	// Font Color Dropdown
	'ABBC3_COLOR_MOVER'			=> 'Font Farbe',
	'ABBC3_COLOR_TIP'			=> '[color=red]Text[/color]',
	'ABBC3_COLOR_NOTE'			=> 'Hinweis: Du kanst HTML Farben verwenden (color=#FF0000 oder color=red)',
	'ABBC3_COLOR_VIEW'			=> '[color=red]' . $lang['SAMPLE_TEXT'] . '[/color]',

	// Tigra Color & Highlight family Groups
	'ABBC3_COLOUR_SAFE'			=> 'Web sichere Palette',
	'ABBC3_COLOUR_WIN'			=> 'Windows System Palette',
	'ABBC3_COLOUR_GREY'			=> 'Grauskalierte Palette',
	'ABBC3_COLOUR_MAC'			=> 'Mac OS Palette',
	'ABBC3_SAMPLE'				=> 'Beispiel',

	// Cut selected text
	'ABBC3_CUT_MOVER'			=> 'Den markierten Text entfernen',
	// Copy selected text
	'ABBC3_COPY_MOVER'			=> 'Den markierten Text kopieren',
	// Paste previously copy text
	'ABBC3_PASTE_MOVER'			=> 'Den kopierten Text einfügen',
	'ABBC3_PASTE_ERROR'			=> 'Du mußt erst einen Text kopieren, bevor du ihn einfügen kannst ',
	// Remove BBCode (Removes all BBCode tags from selected text)
	'ABBC3_PLAIN_MOVER'			=> 'Entferne alle BBCodes aus dem markierten Text',
	'ABBC3_NOSELECT_ERROR'		=> 'Du mußt erst einen Text markieren ',

	// Code
	'ABBC3_CODE_MOVER'			=> 'Programmcode',
	'ABBC3_CODE_TIP'			=> '[code]Code[/code]',
	'ABBC3_CODE_VIEW'			=> '[code]' . $lang['SAMPLE_TEXT'] . '[/code]',

	// Quote
	'ABBC3_QUOTE_MOVER'			=> 'Zitat',
	'ABBC3_QUOTE_TIP'			=> '[quote]Text[/quote] oder [quote=â€œmemberâ€œ]Text[/quote]',
##	For translate :                                                            yes              yes
	'ABBC3_QUOTE_VIEW'			=> '[quote]' . $lang['SAMPLE_TEXT'] . '[/quote] oder [quote=&quot;member&quot;]' . $lang['SAMPLE_TEXT'] . '[/quote]',

	// Spoiler
	'ABBC3_SPOIL_MOVER'			=> 'Text einblenden',
	'ABBC3_SPOIL_TIP'			=> '[spoil]Text[/spoil]',
	'ABBC3_SPOIL_VIEW'			=> '[spoil]' . $lang['SAMPLE_TEXT'] . '[/spoil]',
	'SPOILER_SHOW'				=> 'Text einblenden',
	'SPOILER_HIDE'				=> 'Text ausblenden',

	// hidden
	'ABBC3_HIDDEN_MOVER'		=>	'Inhalt für Gäste verstecken',
	'ABBC3_HIDDEN_TIP'			=>	'[hidden]Text[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=>	'Verstecken ist deaktiviert',
	'HIDDEN_ON'					=>	'Verstecken ist aktiviert',
	'HIDDEN_EXPLAIN'			=>	'Um diesen versteckten Text lesen zu können, mußt du registriert und angemeldet sein',

	// Moderator tag
	'ABBC3_MOD_MOVER'			=> 'Moderator Nachricht',
	'ABBC3_MOD_TIP'				=> '[mod=name]Text[/mod]',
##	For translate :                      yes
	'ABBC3_MOD_VIEW'			=> '[mod=Moderator_name]' . $lang['SAMPLE_TEXT'] . '[/mod]',

	// Off topic tag
	'OFFTOPIC'					=> 'Off Topic',
	'ABBC3_OFFTOPIC_MOVER'		=> 'Füge einen Off Topic Text ein',
	'ABBC3_OFFTOPIC_TIP'		=> '[offtopic]Text[/offtopic]',
	'ABBC3_OFFTOPIC_VIEW'		=> '[offtopic]' . $lang['SAMPLE_TEXT'] . '[/offtopic]',

	// SCRIPPET
	'ABBC3_SCRIPPET_MOVER'		=> 'Schattenbox',
	'ABBC3_SCRIPPET_TIP'		=> '[scrippet]Text in schattierter Box[/scrippet]',
##	For translate :                 don't change the "<br />" and don't join the lines in one !
	'ABBC3_SCRIPPET_VIEW'		=> '[scrippet]EXT. ANCIENT ROME - DAY<br />
	ANTONIUS and IPSUM are walking down a tiny, crowded street.<br />
	ANTONIUS<br />
	Do you think in a thousand years, anyone will remember our names?<br />
	IPSUM<br />
	Not yours. But they’ll know mine. Because I intend to write something so profound that it will be remembered for the ages. Designers in the 20th Century call for Lorem Ipsum whenever they need to fill text blocks.[/scrippet]',

	// Tabs
	'ABBC3_TABS_MOVER'			=> 'Tabs',
	'ABBC3_TABS_TIP'			=> '[tabs] [tabs:]Text für diesen Tab[tabs:Another]Text für diesen Tab[/tabs]',
##	For translate :                              yes             yes                                                                                                                              yes               Yes
	'ABBC3_TABS_VIEW'			=> '[tabs] [tabs:Tab Title]&nbsp;Der gesamte Inhalte nach diesem Tab, wird innerhalb dieses Tabs dargestellt, solange bis ein neuer Tab mit: &#91;tabs:XXX&#93; definiert wird.[tabs:Another Tab]&nbsp;Und so weiter .. bis zum Ende der Seite oder alternativ mit dem nachfolgenden Code zum Beenden des letzten Tabs und zum normalen weiterschreiben: [/tabs]',

	// NFO
	'ABBC3_NFO_TITLE'			=> 'NFO Text',
	'ABBC3_NFO_MOVER'			=> 'NFO Text (besser beim Internet Explorer)',
	'ABBC3_NFO_TIP'				=> '[nfo]NFO Text[/nfo]',
	'ABBC3_NFO_VIEW'			=> '[nfo]		Ü²Ü  Û Û²²     ÛÛÛÛ  Û ÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛÛ     ÛÛÛÛ Û  Û ÛÛÛÛÛ ²² ±[/nfo]',

	// Justify Align
	'ABBC3_ALIGNJUSTIFY_MOVER'	=> 'Blocktext',
	'ABBC3_ALIGNJUSTIFY_TIP'	=> '[align=justify]Text[/align]',
##	For translate :                                yes           yes
	'ABBC3_ALIGNJUSTIFY_VIEW'	=> '[align=justify]Dies ist<br />ein Beispieltext<br />' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Right Align
	'ABBC3_ALIGNRIGHT_MOVER'	=> 'Rechtsbündiger Text',
	'ABBC3_ALIGNRIGHT_TIP'		=> '[align=right]Text[/align]',
	'ABBC3_ALIGNRIGHT_VIEW'		=> '[align=right]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Center Align
	'ABBC3_ALIGNCENTER_MOVER'	=> 'Zentrierter Text',
	'ABBC3_ALIGNCENTER_TIP'		=> '[align=center]Text[/align]',
	'ABBC3_ALIGNCENTER_VIEW'	=> '[align=center]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Left Align
	'ABBC3_ALIGNLEFT_MOVER'		=> 'Linksbündiger Text',
	'ABBC3_ALIGNLEFT_TIP'		=> '[align=left]Text[/align]',
	'ABBC3_ALIGNLEFT_VIEW'		=> '[align=left]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Preformat
	'ABBC3_PRE_MOVER'			=> 'Vorformatierter Text',
	'ABBC3_PRE_TIP'				=> '[pre]Text[/pre]',
	'ABBC3_PRE_VIEW'			=> '[pre]' . $lang['SAMPLE_TEXT'] . '<br />		' . $lang['SAMPLE_TEXT'] . '[/pre]',

	// Tab
	'ABBC3_TAB_MOVER'			=> 'Normaler Einzug',
	'ABBC3_TAB_TIP'				=> '[tab=nn]',
	'ABBC3_TAB_NOTE'			=> 'Gib eine Zahl ein, die den Abstand in Pixeln darstellt.',
	'ABBC3_TAB_VIEW'			=> '[tab=30]' . $lang['SAMPLE_TEXT'],

	// Superscript
	'ABBC3_SUP_MOVER'			=> 'Hochgestellter Text',
	'ABBC3_SUP_TIP'				=> '[sup]Text[/sup]',
##	For translate :                 yes                                                           yes
	'ABBC3_SUP_VIEW'			=> 'Das ist ein normaler Text [sup]' . $lang['SAMPLE_TEXT'] . '[/sup] Das ist ein hochgestellter Text',

	// Subscript
	'ABBC3_SUB_MOVER'			=> 'Tiefgestellter Text',
	'ABBC3_SUB_TIP'				=> '[sub]Text[/sub]',
##	For translate :                 yes                                                           yes
	'ABBC3_SUB_VIEW'			=> 'Das ist ein normaler Text [sub]' . $lang['SAMPLE_TEXT'] . '[/sub] Das ist ein tiefgestellter Text',

	// Bold
	'ABBC3_B_MOVER'				=> 'Text fett',
	'ABBC3_B_TIP'				=> '[b]Text[/b]',
	'ABBC3_B_VIEW'				=> '[b]' . $lang['SAMPLE_TEXT'] . '[/b]',

	// Italic
	'ABBC3_I_MOVER'				=> 'Text kursiv',
	'ABBC3_I_TIP'				=> '[i]Text[/i]',
	'ABBC3_I_VIEW'				=> '[i]' . $lang['SAMPLE_TEXT'] . '[/i]',

	// Underline
	'ABBC3_U_MOVER'				=> 'Text unterstrichen',
	'ABBC3_U_TIP'				=> '[u]Text[/u]',
	'ABBC3_U_VIEW'				=> '[u]' . $lang['SAMPLE_TEXT'] . '[/u]',

	// Strikethrough
	'ABBC3_S_MOVER'				=> 'Text durchgestrichen',
	'ABBC3_S_TIP'				=> '[s]Text[/s]',
	'ABBC3_S_VIEW'				=> '[s]' . $lang['SAMPLE_TEXT'] . '[/s]',

	// Text Fade
	'ABBC3_FADE_MOVER'			=> 'Text ein-/ausblenden',
	'ABBC3_FADE_TIP'			=> '[fade]Text[/fade]',
	'ABBC3_FADE_VIEW'			=> '[fade]' . $lang['SAMPLE_TEXT'] . '[/fade]',

	// Text Gradient
	'ABBC3_GRAD_MOVER'			=> 'Text mit Farbverlauf',
	'ABBC3_GRAD_TIP'			=> 'Stellt den Text als Farbverlauf dar',
##For translate (The separate words are 'This is a sample text')
##												   yes                     yes                     yes                     yes                      yes                     yes                      yes                      yes                     yes                     yes                     yes                     yes                     yes                      yes                     yes                     yes                     yes
	'ABBC3_GRAD_VIEW'			=> '[color=#FF0000]T[/color][color=#F2000D]h[/color][color=#E6001A]i[/color][color=#D90026]s[/color] [color=#BF0040]i[/color][color=#B3004D]s[/color] [color=#990066]a[/color] [color=#800080]s[/color][color=#73008C]a[/color][color=#660099]m[/color][color=#5900A6]p[/color][color=#4D00B3]l[/color][color=#4000BF]e[/color] [color=#2600D9]t[/color][color=#1A00E6]e[/color][color=#0D00F2]x[/color][color=#0000FF]t[/color]',
	'ABBC3_GRAD_MIN_ERROR'		=> 'Bitte zuerst den Text markieren: ',
	'ABBC3_GRAD_MAX_ERROR'		=> 'Du darfst nur max. 119 Zeichen markieren : ',
	'ABBC3_GRAD_COLORS'			=> 'Vordefinierte Farben',
	'ABBC3_GRAD_ERROR'			=> 'Fehler: Der ColorCode Generator ist fehlgeschlagen',

	// Glow text
	'ABBC3_GLOW_MOVER'			=> 'Glühender Text',
	'ABBC3_GLOW_TIP'			=> '[glow=(color)]Text[/glow]',
	'ABBC3_GLOW_VIEW'			=> '[glow=red]' . $lang['SAMPLE_TEXT'] . '[/glow]',

	// Shadow text
	'ABBC3_SHADOW_MOVER'		=> 'Text mit Schatten',
	'ABBC3_SHADOW_TIP'			=> '[shadow=(color)]Text[/shadow]',
	'ABBC3_SHADOW_VIEW'			=> '[shadow=blue]' . $lang['SAMPLE_TEXT'] . '[/shadow]',

	// Dropshadow text
	'ABBC3_DROPSHADOW_MOVER'	=> 'Text mit Schattenfall',
	'ABBC3_DROPSHADOW_TIP'		=> '[dropshadow=(color)]Text[/dropshadow]',
	'ABBC3_DROPSHADOW_VIEW'		=> '[dropshadow=blue]' . $lang['SAMPLE_TEXT'] . '[/dropshadow]',

	// Blur text
	'ABBC3_BLUR_MOVER'			=> 'Unscharfer Text (nur Internet Explorer)',
	'ABBC3_BLUR_TIP'			=> '[blur=(color)]Text[/blur]',
	'ABBC3_BLUR_VIEW'			=> '[blur=blue]' . $lang['SAMPLE_TEXT'] . '[/blur]',

	// Wave text
	'ABBC3_WAVE_MOVER'			=> 'Wellentext (nur Internet Explorer)',
	'ABBC3_WAVE_TIP'			=> '[wave=(color)]Text[/wave]',
	'ABBC3_WAVE_VIEW'			=> '[wave=blue]' . $lang['SAMPLE_TEXT'] . '[/wave]',

	// Unordered List
	'ABBC3_LISTB_MOVER'			=> 'Aufzählungsliste',
	'ABBC3_LISTB_TIP'			=> '[list]Text[/list]',
	'ABBC3_LISTB_NOTE'			=> 'Hinweis: Verwende [*], um Aufzählungspunkte zu erstellen',
##	For translate :                          yes      yes      yes           yes         yes            yes                yes
	'ABBC3_LISTB_VIEW'			=> '[list][*]Punkt 1[*]Punkt 2[*]Punkt 3[/list] oder [list][*]Punkt 1[list][*]Unterpunkt 1[list][*]Unter-Unterpunkt 1[/list][/list][/list]',

	// Ordered List
	'ABBC3_LISTO_MOVER'			=> 'Sortierte Liste',
	'ABBC3_LISTO_TIP'			=> '[list=1|a|A|i|I]Text[/list]',
	'ABBC3_LISTO_NOTE'			=> 'Hinweis: Verwende [*], um Aufzählungespunkte zu erstellen',
##	For translate :                            yes      yes     yes          yes           yes      yes      yes           yes           yes      yes      yes           yes           yes      yes       yes             yes           yes      yes       yes
	'ABBC3_LISTO_VIEW'			=> '[list=1][*]Punkt 1[*]Punkt 2[*]Punkt 3[/list] oder [list=a][*]Punkt a[*]Punkt b[*]Punkt c[/list] oder [list=A][*]Punkt A[*]Punkt B[*]Punkt C[/list] oder [list=i][*]Punkt i[*]Punkt ii[*]Punkt iii[/list] oder [list=I][*]Punkt I[*]Punkt II[*]Punkt III[/list]',

	// List item
	'ABBC3_LISTITEM_MOVER'		=> 'Listenpunkt',
	'ABBC3_LISTITEM_TIP'		=> '[*]',
	'ABBC3_LISTITEM_NOTE'		=> 'Hinweis: Erstellt Aufzählungsspunkte innerhalb der Liste',

	// Line Break
	'ABBC3_HR_MOVER'			=> 'Trennlinie',
	'ABBC3_HR_TIP'				=> '[hr]',
	'ABBC3_HR_NOTE'				=> 'Hinweis: Erstellt eine Trennlinie, um den Text abzugrenzen',
	'ABBC3_HR_VIEW'				=> '[hr]',

	// Message Box text direction right to Left
	'ABBC3_DIRRTL_MOVER'		=> 'Text zum Lesen von Rechts nach Links',
	'ABBC3_DIRRTL_TIP'			=> '[dir=rtl]Text[/dir]',
	'ABBC3_DIRRTL_VIEW'			=> '[dir=rtl]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Message Box text direction Left to right
	'ABBC3_DIRLTR_MOVER'		=> 'Text zum Lesen von von Links nach Rechts',
	'ABBC3_DIRLTR_TIP'			=> '[dir=ltr]Text[/dir]',
	'ABBC3_DIRLTR_VIEW'			=> '[dir=ltr]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Marquee Down
	'ABBC3_MARQDOWN_MOVER'		=> 'Lauftext nach unten',
	'ABBC3_MARQDOWN_TIP'		=> '[marq=down]Text[/marq]',
	'ABBC3_MARQDOWN_VIEW'		=> '[marq=down]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Up
	'ABBC3_MARQUP_MOVER'		=> 'Lauftext nach oben',
	'ABBC3_MARQUP_TIP'			=> '[marq=up]Text[/marq]',
	'ABBC3_MARQUP_VIEW'			=> '[marq=up]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Right
	'ABBC3_MARQRIGHT_MOVER'		=> 'Lauftext nach rechts',
	'ABBC3_MARQRIGHT_TIP'		=> '[marq=right]Text[/marq]',
	'ABBC3_MARQRIGHT_VIEW'		=> '[marq=right]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Left
	'ABBC3_MARQLEFT_MOVER'		=> 'Lauftext nach links',
	'ABBC3_MARQLEFT_TIP'		=> '[marq=left]Text[/marq]',
	'ABBC3_MARQLEFT_VIEW'		=> '[marq=left]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Table row cell wizard
	'ABBC3_TABLE_MOVER'			=> 'Eine Tabelle einfügen',
	'ABBC3_TABLE_TIP'			=> '[table=(ccs style)][tr=(ccs style)][td=(ccs style)]text[/td][/tr][/table]',
	'ABBC3_TABLE_VIEW'			=> '[table=width:50%;border:1px solid #cccccc][tr=text-align:center][td=border:1px solid #cccccc]' . $lang['SAMPLE_TEXT'] . '[/td][/tr][/table]',

	'ABBC3_TABLE_STYLE'			=> 'Den Tabellen Stil eingeben',
	'ABBC3_TABLE_EXAMPLE'		=> 'width:50%;border:1px solid #cccccc;',

	'ABBC3_ROW_NUMBER'			=> 'Gib die Anzahl der Zeilen ein',
	'ABBC3_ROW_ERROR'			=> 'Du hast keine Zeilenzahl eingegeben',
	'ABBC3_ROW_STYLE'			=> 'Gib den Stil für die Zeilen ein',
	'ABBC3_ROW_EXAMPLE'			=> 'text-align:center;',

	'ABBC3_CELL_NUMBER'			=> 'Gib die Anzahl der Spalten ein',
	'ABBC3_CELL_ERROR'			=> 'Du hast keine Spaltenzahl eingegeben',
	'ABBC3_CELL_STYLE'			=> 'Gib den Stil für die Spalten ein',
	'ABBC3_CELL_EXAMPLE'		=> 'border:1px solid #cccccc;',

	// Anchor
	'ABBC3_ANCHOR_MOVER'		=> 'Verweise',
	'ABBC3_ANCHOR_TIP'			=> '[anchor=(dieser Verweisname) goto=(der Name eines anderen Verweises)]Text[/anchor]',
	'ABBC3_ANCHOR_EXAMPLE'		=> '[anchor=a1 goto=a2]Gehe zum Verweis a2[/anchor]',
##	For translate :                                           yes                         Yes               Yes
	'ABBC3_ANCHOR_VIEW'			=> '[anchor=help0 goto=help_1]Gehe zum Link 1[/anchor]<br /> oder  [anchor=help1]Das ist der Link 1[/anchor]',

	// Hyperlink Wizard
	'ABBC3_URL_TAG'				=> 'Seite',
	'ABBC3_URL_MOVER'			=> 'Web Adresse',
	'ABBC3_URL_TIP'				=> '[url]http://...[/url] oder [url=http://...]Name Web[/url]',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.mssti.com',
	'ABBC3_URL_VIEW'			=> '[url=http://www.mssti.com].:: MSSTI ::.[/url]',

	// Email Wizard
	'ABBC3_EMAIL_TAG'			=> 'Email',
	'ABBC3_EMAIL_MOVER'			=> 'Email Adresse',
	'ABBC3_EMAIL_TIP'			=> '[email]user@server.ext[/email] oder [email=user@server.ext]My email[/email]',
	'ABBC3_EMAIL_EXAMPLE'		=> 'user@server.ext',
	'ABBC3_EMAIL_VIEW'			=> '[email=user@server.ext]user@server.ext[/email]',

	// Ed2k link Wizard
	'ABBC3_ED2K_TAG'			=> 'eD2K',
	'ABBC3_ED2K_MOVER'			=> 'Link eD2K',
	'ABBC3_ED2K_TIP'			=> '[url]Link ed2k[/url] oder [url=link ed2k]Name ed2k[/url]',
	'ABBC3_ED2K_EXAMPLE'		=> 'ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/',
	'ABBC3_ED2K_VIEW'			=> '[url=ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/]The_Two_Towers-The_Purist_Edit-Trailer.avi[/url]',
	'ABBC3_ED2K_ADD'			=> 'Gewählte Links zu deinem your ed2k client hinzufügen',
	'ABBC3_ED2K_FRIEND'			=> 'ed2k Freund',
	'ABBC3_ED2K_SERVER'			=> 'ed2k Server',
	'ABBC3_ED2K_SERVERLIST'		=> 'ed2k Server Liste',

	// Web included by iframe
	'ABBC3_WEB_TAG'				=> 'Web',
	'ABBC3_WEB_MOVER'			=> 'Web Seite in den Beitrag einfügen',
	'ABBC3_WEB_TIP'				=> '[web width=200 height=100]URL Web[/web]',
	'ABBC3_WEB_EXAMPLE'			=> 'http://www.mssti.com',
	'ABBC3_WEB_VIEW'			=> '[web width=99% height=140]http://www.mssti.com[/web]',
	'ABBC3_WEB_EXPLAIN'			=> '<strong class="error">Hinweis:</strong> Anderen Webseiten zu erlauben im Beitrag zu stehen, kann ein Sicherheitsriskio darstellen. Du verwendest dies auf eigene Gefahr, oder lasse diese Funktion nur für Gruppen zu, denen du verstraust.',

	// Image & Thumbnail Wizard
	'ABBC3_ALIGN_MODE'			=> 'Bild formatieren',
##	For translate :							 Don't				Yes
	'ABBC3_ALIGN_SELECTOR'		=> array(	'none'			=> 'Standard',
											'left'			=> 'Links',
											'center'		=> 'Zentriert',
											'right'			=> 'Rechts',
											'float-left'	=> 'Text Links',
											'float-right'	=> 'Text Rechts'),

	// Image
	'ABBC3_IMG_TAG'				=> 'Bild',
	'ABBC3_IMG_MOVER'			=> 'Bild einfügen',
	'ABBC3_IMG_TIP'				=> '[img=(left|center|right)]http://...[/img]',
	'ABBC3_IMG_EXAMPLE'			=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_IMG_VIEW'			=> '[img=center]http://www.google.com/intl/en_com/images/logo_plain.png[/img]',

	// Thumbnail
	'ABBC3_THUMBNAIL_TAG'		=> 'Thumbnail',
	'ABBC3_THUMBNAIL_MOVER'		=> 'Thumbnail einfügen',
	'ABBC3_THUMBNAIL_TIP'		=> '[thumbnail(=left|right)]http://...[/thumbnail]',
	'ABBC3_THUMBNAIL_EXAMPLE'	=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_THUMBNAIL_VIEW'		=> '[thumbnail]http://www.google.com/intl/en_com/images/logo_plain.png[/thumbnail]',

	// Imgshack
	'ABBC3_IMGSHACK_MOVER'		=> 'Bild von Imageshack einfügen',
	'ABBC3_IMGSHACK_TIP'		=> '[url=http://imageshack.us][img]http://...[/img][/url]',
	'ABBC3_IMGSHACK_VIEW'		=> '[url=http://img22.imageshack.us/my.php?image=abbc3v1012newscreen.gif][img]http://img22.imageshack.us/img22/6241/abbc3v1012newscreen.th.gif[/img][/url]',

	// Rapid share checker
	'ABBC3_FOPEN_ERROR'			=> '<strong>Error : </strong> Sorry, aber wie es aussieht, ist <strong>allow_url_fopen</strong> deaktiviert. Diese Fuktion erfordert es, daß die PHP Einstellung allow_url_fopen aktiviert ist.',
	'ABBC3_RAPIDSHARE_TAG'		=> 'RapidShare',
	'ABBC3_RAPIDSHARE_MOVER'	=> 'Füge eine Datei von RapidShare hinzu',
	'ABBC3_RAPIDSHARE_TIP'		=> '[rapidshare]http://rapidshare.com/files/...[/rapidshare]',
	'ABBC3_RAPIDSHARE_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/ABBC3_v1012.zip.html',
	'ABBC3_RAPIDSHARE_VIEW'		=> '[rapidshare]http://rapidshare.com/files/86587996/ABBC3_v1012.zip.html[/rapidshare]',
	'ABBC3_RAPIDSHARE_GOOD'		=> 'Datei wurde auf dem Server gefunden!',
	'ABBC3_RAPIDSHARE_WRONG'	=> 'Datei wurde nicht gefunden!',

	// testlink
	'ABBC3_CURL_ERROR'			=> '<strong>Fehler: </strong> Sorry, aber wie es aussieht, wurde CURL nicht geladen. Bitte installiere CURL, um diese Funktion nutzen zu können.',
	'ABBC3_LOGIN_EXPLAIN_VIEW'	=> 'Um Links sehen zu können, mußt du registriert und angemeldet sein.',
	'ABBC3_TESTLINK_TAG'		=> 'Link Checker',
	'ABBC3_TESTLINK_MOVER'		=> 'Füge eine Datei hinzu, die auf einer öffentlichen Seite gespeichert wurde',
	'ABBC3_TESTLINK_TIP'		=> '[testlink]http://rapidshare.com/files/...[/testlink]',
	'ABBC3_TESTLINK_NOTE'		=> 'Gültige Server: rapidshare, megaupload, megarotic, depositfiles, megashares',
	'ABBC3_TESTLINK_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/ABBC3_v1012.zip.html',
	'ABBC3_TESTLINK_VIEW'		=> '[testlink]http://rapidshare.com/files/86587996/ABBC3_v1012.zip.html[/testlink]',
	'ABBC3_TESTLINK_GOOD'		=> 'Datei wurde auf dem Server gefunden!',
	'ABBC3_TESTLINK_WRONG'		=> 'Datei wurde nicht gefunden!',

	// Click counter
	'ABBC3_CLICK_TAG'			=> 'Klickzähler',
	'ABBC3_CLICK_MOVER'			=> 'Einen Klickzähler einfügen',
	'ABBC3_CLICK_TIP'			=> '[click]http://...[/click] or [click=http://...]Name Web[/click] or [click][img]http://...[/img][/click]',
	'ABBC3_CLICK_EXAMPLE' 		=> 'http://www.mssti.com ' . ' ' . 'http://www.google.com/intl/en_com/images/logo_plain.png' ,
##	For translate :                                                                     yes
	'ABBC3_CLICK_VIEW'			=> '[click=http://www.mssti.com] .:: MSSTI ::. [/click] oder [click]http://www.google.com/intl/en_com/images/logo_plain.png[/click]',
	'ABBC3_CLICK_TIME'			=> '( Wurde %d mal angeklickt )',
	'ABBC3_CLICK_TIMES'			=> '( Wurde %d mal angeklickt )',
	'ABBC3_CLICK_ERROR'			=> '<strong>FEHLER:</strong> Bitte gib eine GÜLTIGE klick ID in die URL ein',

	// Search tag
	'ABBC3_SEARCH_MOVER'		=> 'Gib das Suchwort ein',
	'ABBC3_SEARCH_TIP'			=> '[search(=(bing|yahoo|google|altavista|lycos|wikipedia))]Text[/search]',
##	For translate :                                                              yes                                                 yes                                                   yes                                                    yes                                                       yes                                                   yes
	'ABBC3_SEARCH_VIEW'			=> '[search]Advanced BBCode Box 3[/search]<br /> oder [search=bing]Advanced BBCode Box 3[/search]<br /> oder [search=yahoo]Advanced BBCode Box 3[/search]<br /> oder [search=google]Advanced BBCode Box 3[/search]<br /> oder [search=altavista]Advanced BBCode Box 3[/search]<br /> oder [search=lycos]Advanced BBCode Box 3[/search]<br /> oder [search=wikipedia]Advanced BBCode Box 3[/search]',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_TAG'			=> 'BBvideo',
	'ABBC3_BBVIDEO_MOVER'		=> 'Füge ein Web Video hinzu',
	'ABBC3_BBVIDEO_TIP'			=> '[BBvideo]Video URL[/BBvideo]',
	'ABBC3_BBVIDEO_EXAMPLE'		=> 'http://www.youtube.com/watch?v=PDGxfsf-xwQ',
	'ABBC3_BBVIDEO_VIEW'		=> '[BBvideo 425,350]http://www.youtube.com/watch?v=PDGxfsf-xwQ[/BBvideo]',
	'ABBC3_BBVIDEO_SELECT'		=> 'Wähle ein Video Typ',
	'ABBC3_BBVIDEO_SELECT_ERROR'=> 'Zur Zeit sind keine eingebette Videocodes erlaubt. Bitte informier den %sBoard Administrator%s darüber.<br />In der Zwischenzeit kannst du selbstverständlich die standard URL BBCodes verwenden.',
	'ABBC3_BBVIDEO_FILE'		=> 'Dateiformat',
	'ABBC3_BBVIDEO_VIDEO'		=> 'Video von',
	'ABBC3_BBVIDEO_EXTERNAL'	=> 'Externes Video von',

	// Flash (swf) Wizard
	'ABBC3_FLASH_TAG'			=> 'Flash',
	'ABBC3_FLASH_MOVER'			=> 'Eine Flash Datei hinzufügen (swf)',
	'ABBC3_FLASH_TIP'			=> '[flash width=# height=#]URL flash[/flash] oder [flash width,height]URL flash[/flash]',
	'ABBC3_FLASH_EXAMPLE'		=> 'http://www.adobe.com/support/flash/ts/documents/test_version/version.swf',
	'ABBC3_FLASH_VIEW'			=> '[flash 250,200]http://www.adobe.com/support/flash/ts/documents/test_version/version.swf[/flash]',

	// Flash (flv) Wizard
	'ABBC3_FLV_TAG'				=> 'Flash',
	'ABBC3_FLV_MOVER'			=> 'Eine Flash Datei hinzufügen (flv)',
	'ABBC3_FLV_TIP'				=> '[flv width=# height=#]URL flash video[/flv] oder [flv width,height]URL flash video[/flv]',
	'ABBC3_FLV_EXAMPLE' 		=> 'http://www.channel-ai.com/video/eyn/demo1.flv',
	'ABBC3_FLV_VIEW'			=> '[flv 250,200]http://www.channel-ai.com/video/eyn/demo1.flv[/flv]',

	// Streaming Video Wizard
	'ABBC3_VIDEO_TAG'			=> 'Video',
	'ABBC3_VIDEO_MOVER'			=> 'Ein Video einfügen',
	'ABBC3_VIDEO_TIP'			=> '[video width=# height=#]URL Video[/video]',
	'ABBC3_VIDEO_EXAMPLE'		=> 'http://www.sarahsHinweiscards.com/catalunyalive/fishstore.wmv',
	'ABBC3_VIDEO_VIEW'			=> '[video 250,200]http://www.sarahsHinweiscards.com/catalunyalive/fishstore.wmv[/video]',

	// Streaming Audio Wizard
	'ABBC3_STREAM_TAG'			=> 'Tonquelle',
	'ABBC3_STREAM_MOVER'		=> 'Eine Tonquelle einfügen',
	'ABBC3_STREAM_TIP'			=> '[stream]URL Stream[/stream]',
	'ABBC3_STREAM_EXAMPLE'		=> 'http://realdev1.realise.com/rossa/mov/demo.mp3',
	'ABBC3_STREAM_VIEW'			=> '[stream]http://realdev1.realise.com/rossa/mov/demo.mp3[/stream]',

	// Quick time
	'ABBC3_QUICKTIME_TAG'		=> 'Quick Time',
	'ABBC3_QUICKTIME_MOVER'		=> 'Eine Quick Time Datei einfügen',
	'ABBC3_QUICKTIME_TIP'		=> '[quicktime width=# height=#]URL Quick Time[/quicktime]',
	'ABBC3_QUICKTIME_EXAMPLE'	=> 'http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt' . ' ' . 'http://www.carnivalmidways.com/images/Music/thisisatest.mp3',
	'ABBC3_QUICKTIME_VIEW'		=> '[quicktime width=250 height=200]http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt[/quicktime]',

	// Real Media Wizard
	'ABBC3_RAM_TAG'				=> 'Real Media',
	'ABBC3_RAM_MOVER'			=> 'Eine Real Media Datei einfügen',
	'ABBC3_RAM_TIP'				=> '[ram]URL Real Media[/ram]',
	'ABBC3_RAM_EXAMPLE'			=> 'http://www.bbc.co.uk/scotland/radioscotland/media/radioscotland.ram',
	'ABBC3_RAM_VIEW'			=> '[ram]http://www.bbc.co.uk/scotland/radioscotland/media/radioscotland.ram[/ram]',

	// Google video Wizard
	'ABBC3_GVIDEO_TAG'			=> 'Google Video',
	'ABBC3_GVIDEO_MOVER'		=> 'Ein Google Video einfügen',
	'ABBC3_GVIDEO_TIP'			=> '[GVideo]URL Video[/GVideo]',
	'ABBC3_GVIDEO_EXAMPLE'		=> 'http://video.google.com/videoplay?docid=-8351924403384451128',
	'ABBC3_GVIDEO_VIEW'			=> '[GVideo]http://video.google.com/videoplay?docid=-8351924403384451128[/GVideo]',

	// Youtube video Wizard
	'ABBC3_YOUTUBE_TAG'			=> 'Youtube Video',
	'ABBC3_YOUTUBE_MOVER'		=> 'Ein YouTube Video einfügen',
	'ABBC3_YOUTUBE_TIP'			=> '[youtube]URL Video[/youtube]',
	'ABBC3_YOUTUBE_EXAMPLE'		=> 'http://www.youtube.com/watch?v=PDGxfsf-xwQ',
	'ABBC3_YOUTUBE_VIEW'		=> '[youtube]http://www.youtube.com/watch?v=PDGxfsf-xwQ[/youtube]',

	// Veoh video
	'ABBC3_VEOH_TAG'			=> 'Veoh',
	'ABBC3_VEOH_MOVER'			=> 'Ein Video von Veoh einfügen',
	'ABBC3_VEOH_TIP'			=> '[veoh]URL Video[/veoh]',
	'ABBC3_VEOH_EXAMPLE'		=> 'http://www.veoh.com/videos/v1409404EqT5SJjM',
	'ABBC3_VEOH_VIEW'			=> '[veoh]http://www.veoh.com/videos/v1409404EqT5SJjM[/veoh]',

	// Collegehumor video
	'ABBC3_COLLEGEHOMOR_TAG'	=> 'Collegehumor',
	'ABBC3_COLLEGEHUMOR_MOVER'	=> 'Ein Video von Collegehumor einfügen',
	'ABBC3_COLLEGEHUMOR_TIP'	=> '[collegehumor]Collegehumor Video URL[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXAMPLE'=> 'http://www.collegehumor.com/video:1802097',
	'ABBC3_COLLEGEHUMOR_VIEW'	=> '[collegehumor]http://www.collegehumor.com/video:1802097[/collegehumor]',

	// Dailymotion video
	'ABBC3_DM_MOVER'			=> 'Ein Video von Dailymotion einfügen', // from http://www.dailymotion.com/
	'ABBC3_DM_TIP'				=> '[dm]Dailymotion ID[/dm]',
	'ABBC3_DM_EXAMPLE'			=> 'http://www.dailymotion.com/swf/x3hm7o',
	'ABBC3_DM_VIEW'				=> '[dm]http://www.dailymotion.com/swf/x3hm7o[/dm]',

	// Gamespot video
	'ABBC3_GAMESPOT_MOVER'		=> 'Ein Video von Gamespot einfügen',
	'ABBC3_GAMESPOT_TIP'		=> '[gamespot]Gamespot Video URL[gamespot]',
	'ABBC3_GAMESPOT_EXAMPLE'	=> 'http://www.gamespot.com/video/944074/6185798/tom-clancys-rainbow-six-vegas-2-official-trailer-3',
	'ABBC3_GAMESPOT_VIEW'		=> '[gamespot]http://www.gamespot.com/video/944074/6185798/tom-clancys-rainbow-six-vegas-2-official-trailer-3[gamespot]',

	// Gametrailers video
	'ABBC3_GAMETRAILERS_MOVER'	=> 'Ein Video von Gametrailers einfügen',
	'ABBC3_GAMETRAILERS_TIP'	=> '[gametrailers]Gametrailers Video URL[/gametrailers]',
	'ABBC3_GAMETRAILERS_EXAMPLE'=> 'http://www.gametrailers.com/player/30461.html',
	'ABBC3_GAMETRAILERS_VIEW'	=> '[gametrailers]http://www.gametrailers.com/player/30461.html[/gametrailers]',

	// IGN video
	'ABBC3_IGNVIDEO_MOVER'		=> 'Ein Video von IGN einfügen',
	'ABBC3_IGNVIDEO_TIP'		=> '[ignvideo]IGN Video URL[/ignvideo]',
	'ABBC3_IGNVIDEO_EXAMPLE'	=> 'object_ID=967025&downloadURL=http://tvmovies.ign.com/tv/video/article/850/850894/knightrider_trailer_020808_flvlow.flv',
	'ABBC3_IGNVIDEO_VIEW'		=> '[ignvideo]object_ID=967025&downloadURL=http://tvmovies.ign.com/tv/video/article/850/850894/knightrider_trailer_020808_flvlow.flv[/ignvideo]',

	// LiveLeak video
	'ABBC3_LIVELEAK_MOVER'		=> 'Ein Video von Liveleak einfügen',
	'ABBC3_LIVELEAK_TIP'		=> '[liveleak]Liveleak Video URL[/liveleak]',
	'ABBC3_LIVELEAK_EXAMPLE'	=> 'http://www.liveleak.com/view?i=413_1202590393',
	'ABBC3_LIVELEAK_VIEW'		=> '[liveleak]http://www.liveleak.com/view?i=413_1202590393[/liveleak]',

// Custom BBCodes
	// Deezer audio
	'DEEZER_TAG'				=> 'Deezer',
	'DEEZER_MOVER'				=> 'Eine Audiodatei von Deezer einfügen',
	'DEEZER_TIP'				=> '[Deezer]Deezer Audio URL[/Deezer]',
	'DEEZER_EXAMPLE'			=> 'http://www.deezer.com/track/351534',
	'DEEZER_VIEW'				=> '[Deezer]http://www.deezer.com/track/351534[/Deezer]',

));

?>