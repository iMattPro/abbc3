<?php
/**
*
* Advanced BBCode Box [Polish]
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
* Tłumaczenie na Polski: Tomasz Hetman - ToTemat YT and Pico88
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tutaj możesz skonfigurować ustawienia Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Dodaj <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> do BBCode <samp class="error">[font]</samp>. Używaj dokładnej pisowni i zwracaj uwagę na wielkość liter. Nazwę każdej czcionki umieść w nowej linii.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Opcja „Zezwalaj na używanie zewnętrznych sieci dostarczania treści” (CDN) musi być włączona w „Ustawieniach obciążenia”, aby móc korzystać z tej funkcji.',
	'ABBC3_FONT_SEARCH'	=> 'Szukaj w Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Wczytywanie nazw czcionek…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Brak pasujących czcionek.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'Katalog czcionek jest niedostępny. Wpisz nazwy ręcznie.',
	'ABBC3_SAVE_FONTS'	=> 'Zapisz czcionki',
	'ABBC3_FONTS_CHECKING'	=> 'Sprawdzanie i zapisywanie czcionek…',
	'ABBC3_FONTS_SAVED'	=> 'Czcionki zapisano.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Edytor paska narzędzi',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Przeciągaj przyciski między grupami „Główne”, „Więcej” i „Ukryte”. Wybierz przycisk, aby go dostosować. Ikona Font Awesome zastępuje obraz. Jeśli nie wybierzesz obrazu, będzie widoczna nazwa BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Główne',
	'ABBC3_TOOLBAR_MORE'	=> 'Więcej',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Ukryte',
	'ABBC3_FONT_ICON'	=> 'Ikona Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Ikona graficzna',
	'ABBC3_ICON_NONE'	=> 'Brak (użyj tekstu)',
	'ABBC3_PLACEMENT'	=> 'Położenie',
	'ABBC3_TOOLBAR_DISABLED'	=> 'Pasek ikon BBCode jest wyłączony. Nadal możesz edytować jego układ, który zostanie użyty po ponownym włączeniu paska.',
	'ABBC3_LIVE_PREVIEW'	=> 'Podgląd na żywo',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Zapisywanie…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Zapisano',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Nie udało się zapisać zmian.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Ponów próbę',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'Zmiana ustawień Advanced [BBCode] Box wymaga JavaScriptu.',
	'ABBC3_DRAG_BUTTON'	=> 'Przeciągnij %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo i Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Nieprawidłowa nazwa czcionki dla „%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Nie można zweryfikować czcionki Google „%s”. Sprawdź połączenie z serwerem i spróbuj ponownie.',
	'ABBC3_PIPES'				=> 'Włącz wtyczkę Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Wtyczka Pipe Table pozwala użytkownikom tworzyć tabele w postach i prywatnych wiadomościach przy użyciu składni markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Włącz pasek ikon BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Ta opcja wyświetla pasek narzędzi BBCode z ikonami. Wyłącz ją, aby wyświetlać domyślne przyciski BBCode w phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Włącz BBCode w szybkiej odpowiedzi',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Spowoduje to dodanie przycisków BBCode do okna szybkiej odpowiedzi.',
	'ABBC3_ICONS_TYPE'			=> 'Format obrazów paska ikon',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Wybierz format plików ikon BBCode. Dodatkowe ikony SVG lub PNG możesz przesłać do katalogu <samp class="error">/images/abbc3/icons/</samp> na swoim forum.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Pasek ikon BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Dodatki',
	'ABBC3_AUTO_VIDEO'			=> 'Włącz wtyczkę Auto Video',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Ta wtyczka konwertuje adresy URL plików wideo w formie czystego tekstu na odtwarzalne wideo. Konwertowane są tylko adresy URL zaczynające się od <samp class="error">http://</samp> lub <samp class="error">https://</samp> i kończące się na <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> lub <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Zainstaluj opcjonalne rozszerzenie phpBB Media Embed, aby uzyskać dostęp do ustawień i opcji zarządzania osadzoną zawartością multimedialną.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'Rozszerzenie phpBB Media Embed nie jest zainstalowane. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'Rozszerzenie phpBB Media Embed jest zainstalowane. Ustawienia są dostępne w zakładce Pisanie.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
