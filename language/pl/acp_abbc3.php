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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Tutaj możesz skonfigurować ustawienia Advanced BBCode Box. Aby uzyskać informacje na temat dostosowywania paska ikon, odwiedź %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Dodaj <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> do BBCode <samp class="error">[font]</samp>. Używaj dokładnej pisowni i zwracaj uwagę na wielkość liter. Nazwę każdej czcionki umieść w nowej linii.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> 'Opcja „Zezwalaj na używanie zewnętrznych sieci dostarczania treści” (CDN) musi być włączona w „Ustawieniach obciążenia”, aby móc korzystać z tej funkcji.',
	'ABBC3_INVALID_FONT'		=> 'Nieprawidłowa nazwa czcionki dla „%s”',
	'ABBC3_PIPES'				=> 'Włącz wtyczkę Pipe Table',
	'ABBC3_PIPES_EXPLAIN'		=> 'Wtyczka Pipe Table pozwala użytkownikom tworzyć tabele w postach i prywatnych wiadomościach przy użyciu składni markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Włącz pasek ikon BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Spowoduje to wyświetlenie paska narzędzi BBCode opartego na ikonach ABBC3. Wyłącz to, aby wyświetlać domyślne przyciski BBCode phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Włącz BBCode w szybkiej odpowiedzi',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Spowoduje to dodanie przycisków BBCode do okna szybkiej odpowiedzi.',
	'ABBC3_ICONS_TYPE'			=> 'Format obrazów paska ikon',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Wybierz format obrazu, który ma być używany dla ikon ABBC3. Pamiętaj, że możesz wybrać tylko jeden format dla wszystkich ikon.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Pasek ikon BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Dodatki',
	'ABBC3_AUTO_VIDEO'			=> 'Włącz wtyczkę Auto Video',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Ta wtyczka konwertuje adresy URL plików wideo w formie czystego tekstu na odtwarzalne wideo. Konwertowane są tylko adresy URL zaczynające się od <samp class="error">http://</samp> lub <samp class="error">https://</samp> i kończące się na <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> lub <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Zainstaluj opcjonalne rozszerzenie phpBB Media Embed, aby uzyskać dostęp do ustawień i opcji zarządzania osadzoną zawartością multimedialną.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'Rozszerzenie phpBB Media Embed nie jest zainstalowane. %2$s.',
		1	=> 'Rozszerzenie phpBB Media Embed jest zainstalowane. Ustawienia są dostępne w zakładce Pisanie.',
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
