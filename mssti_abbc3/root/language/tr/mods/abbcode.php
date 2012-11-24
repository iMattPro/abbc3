<?php
/**
*
* abbcode [Turkish]
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @turkish translator 2012 ZeNaNLi zenanli@hotmail.com.tr
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. "Message %d" is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., "Click %sHERE%s" is fine
// Reference : http://www.phpbb.com/mods/documentation/phpbb-documentation/language/index.php#lang-use-php
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
// Help page
	'ABBC3_HELP_TITLE'			=> 'Gelişmiş yazı editörü, Yardım sayfası',
	'ABBC3_HELP_DESC'			=> 'Açıklama',
	'ABBC3_HELP_WRITE'			=> 'BBcode kullanım biçimi',
	'ABBC3_HELP_VIEW'			=> 'BBcode önizlemesi',
	'ABBC3_HELP_ABOUT'			=> 'Gelişmiş yazı editörü 3 by <a href="http://www.phpbb.com/customise/db/mod/advanced_bbcode_box_3/" onclick="window.open(this.href);return false;">mssti</a> | Çeviri: <a href="http://www.phpbbturkey.com/forums/memberlist.php?mode=viewprofile&u=16082" onclick="window.open(this.href);return false;">ZeNaNLi</a>',
//	'ABBC3_HELP_ALT'			=> 'Gelişmiş yazı editörü 3 (aka ABBC3)',

// Image Resizer JS
	'ABBC3_RESIZE_SMALL'		=> 'Resmim tam boyutunu görmek için çubuğa tıklayın.',
	'ABBC3_RESIZE_ZOOM_IN'		=> 'Yakınlaştır (gerçek boyutlar: %1$s x %2$s)',
	'ABBC3_RESIZE_CLOSE'		=> 'Kapat',
	'ABBC3_RESIZE_ZOOM_OUT'		=> 'Uzaklaştır',
	'ABBC3_RESIZE_FILESIZE'		=> 'Bu resim yeniden boyutlandırılmıştır. Gerçek boyutları %1$s x %2$s ve  dosya boyutu %3$sKB.',
	'ABBC3_RESIZE_NOFILESIZE'	=> 'Bu resim yeniden boyutlandırılmıştır. Orjinal resim %1$s x %2$s.',
	'ABBC3_RESIZE_FULLSIZE'		=> 'Resim yeniden boyutlandırılmıştır : %1$s % orjinal boyutları [ %2$s x %3$s ]',
	'ABBC3_RESIZE_NUMBER'		=> 'Görüntü %1$s ve %2$s',
	'ABBC3_RESIZE_PLAY'			=> 'Slayt gösterisi olarak oynat',
	'ABBC3_RESIZE_PAUSE'		=> 'Slayt gösterisini durdur',
	'ABBC3_RESIZE_IMAGE'		=> 'Görüntü',
	'ABBC3_RESIZE_OF'			=> 've',

// Highslide JS - http://vikjavev.no/highslide/forum/viewtopic.php?t=2119
	'ABBC3_HIGHSLIDE_LOADINGTEXT'		=> 'Yükleniyor...',
	'ABBC3_HIGHSLIDE_LOADINGTITLE'		=> 'İptal etmek için tıklayın',
	'ABBC3_HIGHSLIDE_FOCUSTITLE'		=> 'Öne getirmek için tıklayın',
	'ABBC3_HIGHSLIDE_FULLEXPANDTITLE'	=> 'Gerçek boyut',
	'ABBC3_HIGHSLIDE_FULLEXPANDTEXT'	=> 'Tam boyut',
	'ABBC3_HIGHSLIDE_CREDITSTEXT'		=> 'Powered by <i>Highslide JS</i>',
	'ABBC3_HIGHSLIDE_CREDITSTITLE'		=> 'Highslide JS ana sayfasına git',
	'ABBC3_HIGHSLIDE_PREVIOUSTEXT'		=> 'Geri',
	'ABBC3_HIGHSLIDE_PREVIOUSTITLE'		=> 'Geri (Sol ok)',
	'ABBC3_HIGHSLIDE_NEXTTEXT'			=> 'İleri',
	'ABBC3_HIGHSLIDE_NEXTTITLE'			=> 'İleri (sağ ok)',
	'ABBC3_HIGHSLIDE_MOVETITLE'			=> 'Oynat',
	'ABBC3_HIGHSLIDE_MOVETEXT'			=> 'Oynat',
	'ABBC3_HIGHSLIDE_CLOSETEXT'			=> 'Kapat',
	'ABBC3_HIGHSLIDE_CLOSETITLE'		=> 'Kapat (Esc)',
	'ABBC3_HIGHSLIDE_RESIZETITLE'		=> 'Yeniden boyutlandır',
	'ABBC3_HIGHSLIDE_PLAYTEXT'			=> 'Oynat',
	'ABBC3_HIGHSLIDE_PLAYTITLE'			=> 'Slaytı başlat (Boşluk tuşu)',
	'ABBC3_HIGHSLIDE_PAUSETEXT'			=> 'Durdur',
	'ABBC3_HIGHSLIDE_PAUSETITLE'		=> 'Slaytı durdur (Boşluk tuşu)',
	'ABBC3_HIGHSLIDE_NUMBER'			=> 'Görüntü %1 - %2',
	'ABBC3_HIGHSLIDE_RESTORETITLE'		=> 'Resmi kapatmak için tıklayın. Önceki ve sonraki görüntüler için yön tuşlarını kullanın.',

// Text to be applied to the helpline & mouseover & help page & Wizard texts
	'BBCODE_STYLES_TIP'			=> 'İpucu: Seçili metinlere kolaylıkla şekil verebilirsiniz.',

	'ABBC3_ERROR'				=> 'Hata : ',
	'ABBC3_ERROR_TAG'			=> 'Kullanılan etikette bekleynmeyen bir hata : ',
	'ABBC3_NO_EXAMPLE'			=> 'Veri örneği yok',

	'ABBC3_ID'					=> 'Tanımlayıcı girin :',
	'ABBC3_NOID'				=> 'Tanımlayıcı yazılmadı',
	'ABBC3_LINK'				=> 'Linki girin',
	'ABBC3_DESC'				=> 'Bir açıklama girin ',
	'ABBC3_NAME'				=> 'Açıklama',
	'ABBC3_NOLINK'				=> 'Link girmediniz ',
	'ABBC3_NODESC'				=> 'Açıklama girmediniz ',
	'ABBC3_WIDTH'				=> 'Genişliği girin',
	'ABBC3_WIDTH_NOTE'			=> 'Not: Bu değer yüzde olarak ifade edilebilir',
	'ABBC3_NOWIDTH'				=> 'Genişliği girmediniz',
	'ABBC3_HEIGHT'				=> 'Yüksekliği girin',
	'ABBC3_HEIGHT_NOTE'			=> 'Not: Bu değer yüzde olarak ifade edilebilir',
	'ABBC3_NOHEIGHT'			=> 'Yüksekliği girmediniz',

	'ABBC3_NOTE'				=> 'Not',
	'ABBC3_EXAMPLE'				=> 'Örnek',
	'ABBC3_EXAMPLES'			=> 'Örnekler',
	'ABBC3_SHORT'				=> 'BBcode seçin',
	'ABBC3_DEPRECATED'			=> '<div class="error"> <em>%1$s</em> BBcode ABBC3 sürümü olarak onaylanmaz<em>%2$s</em></div>',
	'ABBC3_UNAUTHORISED'		=> 'Belirli kelimeler kullanmayın : <br /><strong> %s </strong>',
	'ABBC3_NOSCRIPT'			=> 'Tarayıcı komutunuz devredışı veya istemci tarafından komut dosyası desteklenmiyor. <em>( JavaScript! )</em>',
	'ABBC3_NOSCRIPT_EXPLAIN'	=> 'Görüntülediğiniz sayfa en iyi performans için JavaScript kullanımını gerektirir.<br />JavaScript devredışı ise lütfen etkinleştirin.',
	'ABBC3_FUNCTION_DISABLED'	=> 'Bu fonksiyon, panoda mevcut değildir.',
	'ABBC3_AJAX_DISABLED'		=> 'Tarayıcınızda AJAX (XMLHttpRequest) desteği bulunmamaktadır.',
	'ABBC3_SUBMIT'				=> 'Mesaja Ekle',
	'ABBC3_SUBMIT_SIG'			=> 'İmzaya Ekle',
	'SAMPLE_TEXT'				=> 'Bu bir örnek metindir',
	'DEPRECATED_BBCODE'			=> '<strong class="error">Not:</strong> Bu BBCode artık kullanılmamakta olup, BBvideo kodu ile değiştirilmiştir..',
));

/**
* TRANSLATORS PLEASE NOTE 
*	Several lines have an special note like "##	For translator: " followed by "yes" and "no"
*	These are lines with mixed code and language. For these lines you can translate anything 
*	under a "yes" but do not change any text under a "no"
**/
$lang = array_merge($lang, array(
// bbcodes texts
	// Font Type Dropdown
	'ABBC3_FONT_MOVER'			=> 'Yazı tipi',
	'ABBC3_FONT_TIP'			=> '[font=Comic Sans MS]yazınız[/font]',
	'ABBC3_FONT_NOTE'			=> 'Not: Ek yazı tipi de tanımlayabilirsiniz',
	'ABBC3_FONT_VIEW'			=> '[font=Comic Sans MS]' . $lang['SAMPLE_TEXT'] . '[/font]',

	// Font family Groups
	'ABBC3_FONT_ABBC3'			=> 'ABBC Box 3',
	'ABBC3_FONT_SAFE'			=> 'Güvenli liste',
	'ABBC3_FONT_WIN'			=> 'Varsayılan',

	// Font Size Dropdown
	'ABBC3_FONT_GIANT'			=> 'Çok büyük',
	'ABBC3_SIZE_MOVER'			=> 'Yazı boyutu',
	'ABBC3_SIZE_TIP'			=> '[size=150]metin[/size]',
	'ABBC3_SIZE_NOTE'			=> 'Not: Bu değer yüzde olarak yorumlanır',
	'ABBC3_SIZE_VIEW'			=> '[size=150]' . $lang['SAMPLE_TEXT'] . '[/size]',

	// Highlight Font Color Dropdown
	'ABBC3_HIGHLIGHT_MOVER'		=> 'Yazı vurgulama',
	'ABBC3_HIGHLIGHT_TIP'		=> '[highlight=yellow]metin[/highlight]',
	'ABBC3_HIGHLIGHT_NOTE'		=> 'Not: HTML renk kodlarını kullanabilirsiniz (color=#FF0000 veya color=red)',
	'ABBC3_HIGHLIGHT_VIEW'		=> '[highlight=yellow]' . $lang['SAMPLE_TEXT'] . '[/highlight]',

	// Font Color Dropdown
	'ABBC3_COLOR_MOVER'			=> 'Yazı rengi',
	'ABBC3_COLOR_TIP'			=> '[color=red]metin[/color]',
	'ABBC3_COLOR_NOTE'			=> 'Not: HTML renk kodlarını kullanabilirsiniz (color=#FF0000 veya color=red)',
	'ABBC3_COLOR_VIEW'			=> '[color=red]' . $lang['SAMPLE_TEXT'] . '[/color]',

	// Tigra Color & Highlight family Groups
	'ABBC3_COLOUR_TIGRA'		=> 'Tigra Color Picker',
	'ABBC3_COLOUR_SAFE'			=> 'Güvenli web paleti',
	'ABBC3_COLOUR_WIN'			=> 'Windows sistem paleti',
	'ABBC3_COLOUR_GREY'			=> 'Gri skala paleti',
	'ABBC3_COLOUR_MAC'			=> 'Mac OS paleti',
	'ABBC3_SAMPLE'				=> 'örnek',

	// Cut selected text
	'ABBC3_CUT_MOVER'			=> 'Seçilen metni kaldır',
	// Copy selected text
	'ABBC3_COPY_MOVER'			=> 'Seçilen metni kopyala',
	// Paste previously copy text
	'ABBC3_PASTE_MOVER'			=> 'Seçilen metni yapıştır',
	'ABBC3_PASTE_ERROR'			=> 'Yapıştırma seçeneğini kullanmak için, öncelikle metin kopyalamanız gerekmektedir.',
	// Remove BBCode (Removes all BBCode tags from selected text)
	'ABBC3_PLAIN_MOVER'			=> 'Seçili metinlerdeki tüm BB-kodları kaldırın',
	'ABBC3_NOSELECT_ERROR'		=> 'Seçili metin bulunamadı.',

	// Code
	'ABBC3_CODE_MOVER'			=> 'Kod',
	'ABBC3_CODE_TIP'			=> '[code]kod[/code]',
	'ABBC3_CODE_VIEW'			=> '[code]' . $lang['SAMPLE_TEXT'] . '[/code] veya [code=php]' . $lang['SAMPLE_TEXT'] . '[/code]',

	// Quote
	'ABBC3_QUOTE_MOVER'			=> 'Alıntı',
	'ABBC3_QUOTE_TIP'			=> '[quote]metin[/quote] veya [quote=“kullanıcı”]metin[/quote]',
##	For translator:                                                            yes              yes
	'ABBC3_QUOTE_VIEW'			=> '[quote]' . $lang['SAMPLE_TEXT'] . '[/quote] veya [quote=&quot;kullanıcı&quot;]' . $lang['SAMPLE_TEXT'] . '[/quote]',

	// Spoiler
	'ABBC3_SPOIL_MOVER'			=> 'Açılır/Kapanır metin',
	'ABBC3_SPOIL_TIP'			=> '[spoil]metin[/spoil]',
	'ABBC3_SPOIL_VIEW'			=> '[spoil]' . $lang['SAMPLE_TEXT'] . '[/spoil]',
	'SPOILER_SHOW'				=> 'Göster',
	'SPOILER_HIDE'				=> 'Gizle',

	// Hidden
	'ABBC3_HIDDEN_MOVER'		=> 'Misafirlerden içerik gizle',
	'ABBC3_HIDDEN_TIP'			=> '[hidden]metin[/hidden]',
	'ABBC3_HIDDEN_VIEW'			=> '[hidden]' . $lang['SAMPLE_TEXT'] . '[/hidden]',
	'HIDDEN_OFF'				=> 'Kapalı',
	'HIDDEN_ON'					=> 'Açık',
	'HIDDEN_EXPLAIN'			=> 'Mesaj içeriğini görmek için kayıt ve giriş gerektirir',

	// Moderator
	'ABBC3_MOD_MOVER'			=> 'Moderatör mesajı',
	'ABBC3_MOD_TIP'				=> '[mod=“name”]text[/mod]',
##	For translator:                      yes
	'ABBC3_MOD_VIEW'			=> '[mod=&quot;Moderator_name&quot;]' . $lang['SAMPLE_TEXT'] . '[/mod]',

	// Off Topic
	'OFFTOPIC'					=> 'Kapalı konu',
	'ABBC3_OFFTOPIC_MOVER'		=> 'Kapalı konu metni ekle',
	'ABBC3_OFFTOPIC_TIP'		=> '[offtopic]metin[/offtopic]',
	'ABBC3_OFFTOPIC_VIEW'		=> '[offtopic]' . $lang['SAMPLE_TEXT'] . '[/offtopic]',

	// SCRIPPET
	'ABBC3_SCRIPPET_MOVER'		=> 'Scrippet',
	'ABBC3_SCRIPPET_TIP'		=> '[scrippet]Senaryo metni[/scrippet]',
##	For translator:                 don't change the "<br />" and don't join the lines into one!
	'ABBC3_SCRIPPET_VIEW'		=> '[scrippet]EXT. ANCIENT ROME - DAY<br />' . "\n" . 'ANTONIUS and IPSUM are walking down a tiny, crowded street.<br />' . "\n" . 'ANTONIUS<br />' . "\n" . 'Do you think in a thousand years, anyone will remember our names?<br />' . "\n" . 'IPSUM<br />' . "\n" . 'Not yours. But they’ll know mine. Because I intend to write something so profound that it will be remembered for the ages. Designers in the 20th Century call for Lorem Ipsum whenever they need to fill text blocks.[/scrippet]',

	// Tabs
	'ABBC3_TABS_MOVER'			=> 'Sekmeler',
	'ABBC3_TABS_TIP'			=> '[tabs] [tabs:Başlık]sekme için metin girin[tabs:diğer]sekme için metin girin[/tabs]',
##	For translator:                              yes             yes                                                                                                                              yes               Yes
	'ABBC3_TABS_VIEW'			=> '[tabs] [tabs:Tab Title]&nbsp;Başka bir sekme yayınlanıncaya kadar bu etiket altındaki tüm içerik bu sekme içinde görüntülenecektir: &#91;tabs:XXX&#93;.[tabs:Another Tab]&nbsp;And so on...until the end of the page or optionally you can use &#91;/tabs&#93; to end the last tab and display normal text outside the tabs.[/tabs]',

	// NFO
	'ABBC3_NFO_TITLE'			=> 'Bilgi metni',
	'ABBC3_NFO_MOVER'			=> 'Bilgi metni',
	'ABBC3_NFO_TIP'				=> '[nfo]NFO metin[/nfo]',
	'ABBC3_NFO_VIEW'			=> '[nfo]         /\_/\
    ____/ o o \
  /~____  =ø= /
 (______)__m_m)
[/nfo]',

	// Justify Align
	'ABBC3_ALIGNJUSTIFY_MOVER'	=> 'Ayarlı metin',
	'ABBC3_ALIGNJUSTIFY_TIP'	=> '[align=justify]metin[/align]',
	'ABBC3_ALIGNJUSTIFY_VIEW'	=> '[align=justify]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Right Align
	'ABBC3_ALIGNRIGHT_MOVER'	=> 'Sağa hizalı metin',
	'ABBC3_ALIGNRIGHT_TIP'		=> '[align=right]metin[/align]',
	'ABBC3_ALIGNRIGHT_VIEW'		=> '[align=right]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Center Align
	'ABBC3_ALIGNCENTER_MOVER'	=> 'Ortalanmış metin',
	'ABBC3_ALIGNCENTER_TIP'		=> '[align=center]metin[/align]',
	'ABBC3_ALIGNCENTER_VIEW'	=> '[align=center]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Left Align
	'ABBC3_ALIGNLEFT_MOVER'		=> 'Sola hizalı metin',
	'ABBC3_ALIGNLEFT_TIP'		=> '[align=left]metin[/align]',
	'ABBC3_ALIGNLEFT_VIEW'		=> '[align=left]' . $lang['SAMPLE_TEXT'] . '[/align]',

	// Preformat
	'ABBC3_PRE_MOVER'			=> 'Biçimlendirilmiş metin',
	'ABBC3_PRE_TIP'				=> '[pre]metin[/pre]',
	'ABBC3_PRE_VIEW'			=> '[pre]' . $lang['SAMPLE_TEXT'] . '<br />		' . $lang['SAMPLE_TEXT'] . '[/pre]',

	// Tab
	'ABBC3_TAB_MOVER'			=> 'Normal bir girinti oluştur',
	'ABBC3_TAB_TIP'				=> '[tab=nn]',
	'ABBC3_TAB_NOTE'			=> 'Piksel cinsinden ölçülür bir sayı girin.',
	'ABBC3_TAB_VIEW'			=> '[tab=30]' . $lang['SAMPLE_TEXT'],

	// Superscript
	'ABBC3_SUP_MOVER'			=> 'Üst bilgi',
	'ABBC3_SUP_TIP'				=> '[sup]metin[/sup]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUP_VIEW'			=> 'Bu bir normal metin [sup]' . $lang['SAMPLE_TEXT'] . '[/sup] bu bir normal metin',

	// Subscript
	'ABBC3_SUB_MOVER'			=> 'Alt bilgi',
	'ABBC3_SUB_TIP'				=> '[sub]metin[/sub]',
##	For translator:                 yes                                                         yes
	'ABBC3_SUB_VIEW'			=> 'Bu bir normal metin [sub]' . $lang['SAMPLE_TEXT'] . '[/sub] bu bir normal metin',

	// Bold
	'ABBC3_B_MOVER'				=> 'Kalın metin',
	'ABBC3_B_TIP'				=> '[b]metin[/b]',
	'ABBC3_B_VIEW'				=> '[b]' . $lang['SAMPLE_TEXT'] . '[/b]',

	// Italic
	'ABBC3_I_MOVER'				=> 'İtalik metin',
	'ABBC3_I_TIP'				=> '[i]metin[/i]',
	'ABBC3_I_VIEW'				=> '[i]' . $lang['SAMPLE_TEXT'] . '[/i]',

	// Underline
	'ABBC3_U_MOVER'				=> 'Altı çizili metin',
	'ABBC3_U_TIP'				=> '[u]metin[/u]',
	'ABBC3_U_VIEW'				=> '[u]' . $lang['SAMPLE_TEXT'] . '[/u]',

	// Strikethrough
	'ABBC3_S_MOVER'				=> 'Üstü çizili metin',
	'ABBC3_S_TIP'				=> '[s]metin[/s]',
	'ABBC3_S_VIEW'				=> '[s]' . $lang['SAMPLE_TEXT'] . '[/s]',

	// Text Fade
	'ABBC3_FADE_MOVER'			=> 'Soluk metin',
	'ABBC3_FADE_TIP'			=> '[fade]metin[/fade]',
	'ABBC3_FADE_VIEW'			=> '[fade]' . $lang['SAMPLE_TEXT'] . '[/fade]',

	// Text Gradient
	'ABBC3_GRAD_MOVER'			=> 'Renkli metin',
	'ABBC3_GRAD_TIP'			=> 'Önce metni seçin',
	'ABBC3_GRAD_VIEW'			=> '[color=#40FF00]I[/color] [color=#B6FF00]a[/color][color=#F0FF00]m[/color] [color=#DD9845]a[/color] [color=#BF4A94]r[/color][color=#BF5EBB]a[/color][color=#BF71E2]i[/color][color=#B57BFF]n[/color][color=#8E67FF]b[/color][color=#6754FF]o[/color][color=#4040FF]w[/color]',
	'ABBC3_GRAD_MIN_ERROR'		=> 'Seçili metin bulunamadı.',
	'ABBC3_GRAD_MAX_ERROR'		=> 'Yalnızca 120 karakterden az metinler için.',
	'ABBC3_GRAD_COLORS'			=> 'Önceden seçilen renkler',
	'ABBC3_GRAD_ERROR'			=> 'Hata: Renk kodu yapıcısı başarısız oldu',

	// Glow text
	'ABBC3_GLOW_MOVER'			=> 'Kızıl metin',
	'ABBC3_GLOW_TIP'			=> '[glow=color]metin[/glow]',
	'ABBC3_GLOW_VIEW'			=> '[glow=red]' . $lang['SAMPLE_TEXT'] . '[/glow]',

	// Shadow text
	'ABBC3_SHADOW_MOVER'		=> 'Gölgeli metin',
	'ABBC3_SHADOW_TIP'			=> '[shadow=color]metin[/shadow]',
	'ABBC3_SHADOW_VIEW'			=> '[shadow=blue]' . $lang['SAMPLE_TEXT'] . '[/shadow]',

	// Dropshadow text
	'ABBC3_DROPSHADOW_MOVER'	=> 'Silik gölgeli metin',
	'ABBC3_DROPSHADOW_TIP'		=> '[dropshadow=color]metin[/dropshadow]',
	'ABBC3_DROPSHADOW_VIEW'		=> '[dropshadow=blue]' . $lang['SAMPLE_TEXT'] . '[/dropshadow]',

	// Blur text
	'ABBC3_BLUR_MOVER'			=> 'Bulanık metin (Sadece İnternet Explorer için)',
	'ABBC3_BLUR_TIP'			=> '[blur=color]metin[/blur]',
	'ABBC3_BLUR_VIEW'			=> '[blur=blue]' . $lang['SAMPLE_TEXT'] . '[/blur]',

	// Wave text
	'ABBC3_WAVE_MOVER'			=> 'Dalgalı metin (Sadece İnternet Explorer için)',
	'ABBC3_WAVE_TIP'			=> '[wave=color]metin[/wave]',
	'ABBC3_WAVE_VIEW'			=> '[wave=blue]' . $lang['SAMPLE_TEXT'] . '[/wave]',

	// Unordered List
	'ABBC3_LISTB_MOVER'			=> 'Liste',
	'ABBC3_LISTB_TIP'			=> '[list]metin[/list]',
	'ABBC3_LISTB_NOTE'			=> 'Not: İşaret oluşturmak için [*] kullanın',
##	For translator:                          yes      yes      yes           yes         yes            yes                yes
	'ABBC3_LISTB_VIEW'			=> '[list][*]Öğe 1[*]Öğe 2[*]Öğe 3[/list] veya [list][*]Öğe 1[list][*]alt-öğe 1[list][*]alt-alt-öğe1[/list][/list][/list]',

	// Ordered List
	'ABBC3_LISTO_MOVER'			=> 'Sıralı liste',
	'ABBC3_LISTO_TIP'			=> '[list=1|a|A|i|I]metin[/list]',
	'ABBC3_LISTO_NOTE'			=> 'Not: İşaret oluşturmak için [*] kullanın',
##	For translator:                            yes      yes     yes          yes           yes      yes      yes           yes           yes      yes      yes           yes           yes      yes       yes             yes           yes      yes       yes
	'ABBC3_LISTO_VIEW'			=> '[list=1][*]Öğe 1[*]Öğe 2[*]Öğe 3[/list] veya [list=a][*]Öğe a[*]Öğe b[*]Öğe c[/list] veya [list=A][*]Öğe A[*]Öğe B[*]Öğe C[/list] veya [list=i][*]Öğe i[*]Öğe ii[*]Öğe iii[/list] veya [list=I][*]Öğe I[*]Öğe II[*]Öğe III[/list]',

	// List item
	'ABBC3_LISTITEM_MOVER'		=> 'Liste öğesi',
	'ABBC3_LISTITEM_TIP'		=> '[*]metin',
	//'ABBC3_LISTITEM_NOTE'		=> 'Not: Listeleme için işaret veya numara ekler',

	// Line Break
	'ABBC3_HR_MOVER'			=> 'Yatay çizgi',
	'ABBC3_HR_TIP'				=> '[hr]',
	'ABBC3_HR_NOTE'				=> 'Not: Ayrı bir metin için yatay bir çizgi oluşturur.',
	'ABBC3_HR_VIEW'				=> $lang['SAMPLE_TEXT'] . '[hr]' . $lang['SAMPLE_TEXT'],

	// Message Box text direction right to Left
	'ABBC3_DIRRTL_MOVER'		=> 'Metin yönünü sağdan sola oku',
	'ABBC3_DIRRTL_TIP'			=> '[dir=rtl]metin[/dir]',
	'ABBC3_DIRRTL_VIEW'			=> '[dir=rtl]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Message Box text direction Left to right
	'ABBC3_DIRLTR_MOVER'		=> 'Metin yönünü soldan sağa oku',
	'ABBC3_DIRLTR_TIP'			=> '[dir=ltr]metin[/dir]',
	'ABBC3_DIRLTR_VIEW'			=> '[dir=ltr]' . $lang['SAMPLE_TEXT'] . '[/dir]',

	// Marquee Down
	'ABBC3_MARQDOWN_MOVER'		=> 'Aşağı doğru kayan metin',
	'ABBC3_MARQDOWN_TIP'		=> '[marq=down]metin[/marq]',
	'ABBC3_MARQDOWN_VIEW'		=> '[marq=down]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Up
	'ABBC3_MARQUP_MOVER'		=> 'Yukarı doğru kayan metin',
	'ABBC3_MARQUP_TIP'			=> '[marq=up]metin[/marq]',
	'ABBC3_MARQUP_VIEW'			=> '[marq=up]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Right
	'ABBC3_MARQRIGHT_MOVER'		=> 'Sağa doğru kayan metin',
	'ABBC3_MARQRIGHT_TIP'		=> '[marq=right]metin[/marq]',
	'ABBC3_MARQRIGHT_VIEW'		=> '[marq=right]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Marquee Left
	'ABBC3_MARQLEFT_MOVER'		=> 'Sola doğru kayan metin',
	'ABBC3_MARQLEFT_TIP'		=> '[marq=left]metin[/marq]',
	'ABBC3_MARQLEFT_VIEW'		=> '[marq=left]' . $lang['SAMPLE_TEXT'] . '[/marq]',

	// Table row cell wizard
	'ABBC3_TABLE_MOVER'			=> 'Tablo ekle',
	'ABBC3_TABLE_TIP'			=> '[table=(CSS style)][tr=(CSS style)][td=(CSS style)]metin[/td][/tr][/table]',
	'ABBC3_TABLE_VIEW'			=> '[table=width:50%;border:1px solid #cccccc][tr=text-align:center][td=border:1px solid #cccccc]' . $lang['SAMPLE_TEXT'] . '[/td][/tr][/table]',

	'ABBC3_TABLE_STYLE'			=> 'Tablo stilini girin',
	'ABBC3_TABLE_EXAMPLE'		=> 'width:50%;border:1px solid #cccccc;',

	'ABBC3_ROW_NUMBER'			=> 'Tablo satır sayısı girin',
	'ABBC3_ROW_ERROR'			=> 'satır sayısı girmediniz',
	'ABBC3_ROW_STYLE'			=> 'Satır stilini gir',
	'ABBC3_ROW_EXAMPLE'			=> 'text-align:center;',

	'ABBC3_CELL_NUMBER'			=> 'Hücre sayısı girin',
	'ABBC3_CELL_ERROR'			=> 'Hücre sayısı girmediniz',
	'ABBC3_CELL_STYLE'			=> 'Hücre stilini gir',
	'ABBC3_CELL_EXAMPLE'		=> 'border:1px solid #cccccc;',

	// Anchor
	'ABBC3_ANCHOR_MOVER'		=> 'Site içi bağlantı ekle',
	'ABBC3_ANCHOR_TIP'			=> '[anchor=(bağlantı adı) goto=(hedef bağlantı adı)]metin[/anchor]',
	'ABBC3_ANCHOR_EXAMPLE'		=> '[anchor=a1 goto=a2]a2 bağlantısına git[/anchor]',
##	For translator:                                            yes                         Yes               Yes
	'ABBC3_ANCHOR_VIEW'			=> '[anchor=help_0 goto=help_1]1 nolu bağlantıya git[/anchor]<br /> veya  [anchor=help_1]1 nolu bağlantı[/anchor]',

	// Hyperlink Wizard
	'ABBC3_URL_TAG'				=> 'sayfa',
	'ABBC3_URL_MOVER'			=> 'Bağlantı ekle',	
	'ABBC3_URL_TIP'				=> '[url]http://url[/url] veya [url=http://url]bağlantı metni[/url]',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.phpbb.com',
	'ABBC3_URL_VIEW'			=> '[url=http://www.phpbb.com]Visit phpBB![/url]',

	// Email Wizard
	'ABBC3_EMAIL_TAG'			=> 'e-posta',
	'ABBC3_EMAIL_MOVER'			=> 'E-posta ekle',
	'ABBC3_EMAIL_TIP'			=> '[email]user@server.ext[/email] veya [email=user@server.ext]E-postam[/email]',
	'ABBC3_EMAIL_EXAMPLE'		=> 'user@server.ext',
	'ABBC3_EMAIL_VIEW'			=> '[email=user@server.ext]user@server.ext[/email]',

	// Ed2k link Wizard
	'ABBC3_ED2K_TAG'			=> 'ed2k',
	'ABBC3_ED2K_MOVER'			=> 'eD2K bağlantısı ekle',
	'ABBC3_ED2K_TIP'			=> '[url]ed2k bağlantısı[/url] veya [url=link ed2k]d2k adı[/url]',
	'ABBC3_ED2K_EXAMPLE'		=> 'ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/',
	'ABBC3_ED2K_VIEW'			=> '[url=ed2k://|file|The_Two_Towers-The_Purist_Edit-Trailer.avi|14997504|965c013e991ee246d63d45ea71954c4d|/]The_Two_Towers-The_Purist_Edit-Trailer.avi[/url]',
	'ABBC3_ED2K_ADD'			=> 'ed2k istemciye seçilen bağlantıyı ekle',
	'ABBC3_ED2K_FRIEND'			=> 'ed2k arkadaş',
	'ABBC3_ED2K_SERVER'			=> 'ed2k sunucusu',
	'ABBC3_ED2K_SERVERLIST'		=> 'ed2k sunucu listesi',

	// Web included by iframe
	'ABBC3_WEB_TAG'				=> 'web',
	'ABBC3_WEB_MOVER'			=> 'Mesaj içerğine web adresi ekle',
	'ABBC3_WEB_TIP'				=> '[web width=99% height=400]http://url[/web]',
	'ABBC3_WEB_EXAMPLE'			=> 'http://www.phpbb.com',
	'ABBC3_WEB_VIEW'			=> '[web width=99% height=400]http://www.phpbb.com[/web]',
	'ABBC3_WEB_EXPLAIN'			=> '<strong class="error">Not:</strong> mesaj içeriğine eklenecek olan web adresi ile beraber bir güvenlik riski meydana gelebilir, bu nedenle güvenilir gruplara atama yapmayı unutmayın.',

	// Image & Thumbnail Wizard
	'ABBC3_ALIGN_MODE'			=> 'Resmi hizala',
##	For translator:							 Don't				Yes
	'ABBC3_ALIGN_SELECTOR'		=> array(	'none'			=> 'Varsayılan',
											'left'			=> 'Sol',
											'center'		=> 'Orta',
											'right'			=> 'Sağ',
											'float-left'	=> 'Sola yasla',
											'float-right'	=> 'Sağa yasla'),

	// Image
	'ABBC3_IMG_TAG'				=> 'Resim',
	'ABBC3_IMG_MOVER'			=> 'Resim ekle',
	'ABBC3_IMG_TIP'				=> '[img]http://image_url[/img] veya [img=left|center|right|float-left|float-right]http://image_url[/img]',
	'ABBC3_IMG_EXAMPLE'			=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_IMG_VIEW'			=> '[img]http://www.google.com/intl/en_com/images/logo_plain.png[/img]',

	// Thumbnail
	'ABBC3_THUMBNAIL_TAG'		=> 'Küçük resim',
	'ABBC3_THUMBNAIL_MOVER'		=> 'Küçük resim ekle',
	'ABBC3_THUMBNAIL_TIP'		=> '[thumbnail]http://image_url[/thumbnail] veya [thumbnail=left|center|right|float-left|float-right]http://image_url[/thumbnail]',
	'ABBC3_THUMBNAIL_EXAMPLE'	=> 'http://www.google.com/intl/en_com/images/logo_plain.png',
	'ABBC3_THUMBNAIL_VIEW'		=> '[thumbnail]http://www.google.com/intl/en_com/images/logo_plain.png[/thumbnail]',

	// Imgshack
	'ABBC3_IMGSHACK_MOVER'		=> 'imageshack sitesinden görüntü ekle',
	'ABBC3_IMGSHACK_TIP'		=> '[url=http://imageshack.us][img]http://image_url[/img][/url]',
	'ABBC3_IMGSHACK_VIEW'		=> '[url=http://img22.imageshack.us/my.php?image=abbc3v1012newscreen.gif][img]http://img22.imageshack.us/img22/6241/abbc3v1012newscreen.th.gif[/img][/url]',

	// Rapid share checker
	'ABBC3_RAPIDSHARE_TAG'		=> 'rapidshare',
	'ABBC3_RAPIDSHARE_MOVER'	=> 'Rapidshare sitesinden dosya ekle',
	'ABBC3_RAPIDSHARE_TIP'		=> '[rapidshare]http://rapidshare.com/files/...[/rapidshare]',
	'ABBC3_RAPIDSHARE_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_RAPIDSHARE_VIEW'		=> '[rapidshare]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/rapidshare]',
	'ABBC3_RAPIDSHARE_GOOD'		=> 'Dosya sunucuda bulunamadı!',
	'ABBC3_RAPIDSHARE_WRONG'	=> 'Dosya bulunamadı!',

	// testlink
	'ABBC3_CURL_ERROR'			=> '<strong>Hata : </strong> Üzügünüz, ama bu CURL yüklü değil. İşlevi kullanmak için lütfen yükleme yapın.',
	'ABBC3_LOGIN_EXPLAIN_VIEW'	=> 'Bağlantıları görüntülemek için kayıt olmanız ve giriş yapmanız gerekmektedir.',
	'ABBC3_TESTLINK_TAG'		=> 'link kontrolü',
	'ABBC3_TESTLINK_MOVER'		=> 'Çeşitli sunucular üzerinden dosya ekleyin',
	'ABBC3_TESTLINK_TIP'		=> '[testlink]http://rapidshare.com/files/...[/testlink]',
	'ABBC3_TESTLINK_NOTE'		=> 'Geçerli sunucular: rapidshare, depositfiles, megashares',
	'ABBC3_TESTLINK_EXAMPLE'	=> 'http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip',
	'ABBC3_TESTLINK_VIEW'		=> '[testlink]http://rapidshare.com/files/86587996/MSSTI_ABBC3.zip[/testlink]',
	'ABBC3_TESTLINK_GOOD'		=> 'Sunucu dosya bulunamadı !',
	'ABBC3_TESTLINK_WRONG'		=> 'Dosya bulunamadı !',

	// Click counter
	'ABBC3_CLICK_TAG'			=> 'tıklama',
	'ABBC3_CLICK_MOVER'			=> 'Tıklama sayacı ekle',
	'ABBC3_CLICK_TIP'			=> '[click]http://url[/click] veya [click=http://url]Name Web[/click] veya [click][img]http://url[/img][/click]',
	'ABBC3_CLICK_EXAMPLE' 		=> 'http://www.google.com' . ' | ' . 'http://www.google.com/intl/en_com/images/logo_plain.png',
##	For translator:                                                               yes
	'ABBC3_CLICK_VIEW'			=> '[click=http://www.google.com] Google [/click] veya [click][img]http://www.google.com/intl/en_com/images/logo_plain.png[/img][/click]',
	'ABBC3_CLICK_TIME'			=> '( %d kez tıklandı )',
	'ABBC3_CLICK_TIMES'			=> '( %d kez tıklandı )',
	'ABBC3_CLICK_ERROR'			=> '<strong>HATA::</strong> Geçerli bir ID veya URL giriniz',

	// Search tag
	'ABBC3_SEARCH_MOVER'		=> 'Aranacak kelime ekle',
	'ABBC3_SEARCH_TIP'			=> '[search]metin[/search] veya [search=bing|yahoo|google|altavista|lycos|wikipedia]metin[/search]',
##	For translator:                                                              yes                                                 yes                                                   yes                                                    yes                                                       yes                                                   yes
	'ABBC3_SEARCH_VIEW'			=> '[search]Gelişmiş yazı editörü 3[/search]<br /> veya [search=bing]Gelişmiş yazı editörü 3[/search]<br /> veya [search=yahoo]Gelişmiş yazı editörü 3[/search]<br /> veya [search=google]Gelişmiş yazı editörü 3[/search]<br /> veya [search=altavista]Gelişmiş yazı editörü 3[/search]<br /> veya [search=lycos]Gelişmiş yazı editörü 3[/search]<br /> veya [search=wikipedia]Gelişmiş yazı editörü 3[/search]',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_TAG'			=> 'BBvideo',
	'ABBC3_BBVIDEO_MOVER'		=> 'Web videosu ekle',
	'ABBC3_BBVIDEO_TIP'			=> '[BBvideo width,height]Video adresi[/BBvideo]',
	'ABBC3_BBVIDEO_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_BBVIDEO_VIEW'		=> '[BBvideo 560,340]http://www.youtube.com/watch?v=sP4NMoJcFd4[/BBvideo]',
	'ABBC3_BBVIDEO_SELECT'		=> 'BBvideo video siteleri ve dosyaları',
	'ABBC3_BBVIDEO_SELECT_ERROR'=> 'Video ekleme izniniz bulunmamaktadır. Lütfen %ssite yöneticisi%s ile iletişime geçin.<br />Standart BBcode kullanarak video eklemeyi deneyin.',
	'ABBC3_BBVIDEO_FILE'		=> 'Dosya formatı',
	'ABBC3_BBVIDEO_VIDEO'		=> 'İzin verilen siteler',
	'ABBC3_BBVIDEO_WATCH'		=> 'İzleyin',

	// Flash (swf) Wizard
	'ABBC3_FLASH_TAG'			=> 'flash',
	'ABBC3_FLASH_MOVER'			=> 'Flash (swf) dosyası ekle',
	'ABBC3_FLASH_TIP'			=> '[flash width=# height=#]flash adresi[/flash] veya [flash width,height]flash adresi[/flash]',
	'ABBC3_FLASH_EXAMPLE'		=> 'http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf',
	'ABBC3_FLASH_VIEW'			=> '[flash 250,200]http://flash-clocks.com/free-flash-clocks-blog-topics/free-flash-clock-177.swf[/flash]',

	// Flash (flv) Wizard
	'ABBC3_FLV_TAG'				=> 'flash',
	'ABBC3_FLV_MOVER'			=> 'Flash video (flv) ekle',
	'ABBC3_FLV_TIP'				=> '[flv width=# height=#]flash video adresi[/flv] veya [flv width,height]flash video adresi[/flv]',
	'ABBC3_FLV_EXAMPLE'			=> 'http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv',
	'ABBC3_FLV_VIEW'			=> '[flv 250,200]http://www.mediacollege.com/video-gallery/testclips/20051210-w50s.flv[/flv]',
	'ABBC3_FLV_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Streaming Video Wizard
	'ABBC3_VIDEO_TAG'			=> 'video',
	'ABBC3_VIDEO_MOVER'			=> 'Video ekle',
	'ABBC3_VIDEO_TIP'			=> '[video width=# height=#]video adresi[/video]',
	'ABBC3_VIDEO_EXAMPLE'		=> 'http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv',
	'ABBC3_VIDEO_VIEW'			=> '[video 250,200]http://www.mediacollege.com/video/format/windows-media/streaming/videofilename.wmv[/video]',
	'ABBC3_VIDEO_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Streaming Audio Wizard
	'ABBC3_STREAM_TAG'			=> 'ses',
	'ABBC3_STREAM_MOVER'		=> 'Ses ekle',
	'ABBC3_STREAM_TIP'			=> '[stream]ses adresi[/stream]',
	'ABBC3_STREAM_EXAMPLE'		=> 'http://www.robtowns.com/music/first_noel.mp3',
	'ABBC3_STREAM_VIEW'			=> '[stream]http://www.robtowns.com/music/first_noel.mp3[/stream]',
	'ABBC3_STREAM_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Quicktime
	'ABBC3_QUICKTIME_TAG'		=> 'Quicktime',
	'ABBC3_QUICKTIME_MOVER'		=> 'Quicktime ekle',
	'ABBC3_QUICKTIME_TIP'		=> '[quicktime width=# height=#]Quicktime adresi[/quicktime]',
	'ABBC3_QUICKTIME_EXAMPLE'	=> 'http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt',
	'ABBC3_QUICKTIME_VIEW'		=> '[quicktime width=250 height=200]http://www.nature.com/neuro/journal/v3/n3/extref/Li_control.mov.qt[/quicktime]',
	'ABBC3_QUICKTIME_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// Real Media Wizard
	'ABBC3_RAM_TAG'				=> 'Real Media',
	'ABBC3_RAM_MOVER'			=> 'Real Media ekle',
	'ABBC3_RAM_TIP'				=> '[ram]Real Media adresi[/ram]',
	'ABBC3_RAM_EXAMPLE'			=> 'http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram',
	'ABBC3_RAM_VIEW'			=> '[ram width=250 height=200]http://service.real.com/help/library/guides/realone/IntroToStreaming/samples/ramfiles/startend.ram[/ram]',
	'ABBC3_RAM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Youtube video Wizard
	'ABBC3_YOUTUBE_TAG'			=> 'Youtube Video',
	'ABBC3_YOUTUBE_MOVER'		=> 'Youtube sitesinden video ekle',
	'ABBC3_YOUTUBE_TIP'			=> '[youtube]video adresi[/youtube]',
	'ABBC3_YOUTUBE_EXAMPLE'		=> 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
	'ABBC3_YOUTUBE_VIEW'		=> '[youtube]http://www.youtube.com/watch?v=sP4NMoJcFd4[/youtube]',
	'ABBC3_YOUTUBE_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Veoh video
	'ABBC3_VEOH_TAG'			=> 'Veoh',
	'ABBC3_VEOH_MOVER'			=> 'Veoh sitesinden video ekle',
	'ABBC3_VEOH_TIP'			=> '[veoh]video adresi[/veoh]',
	'ABBC3_VEOH_EXAMPLE'		=> 'http://www.veoh.com/watch/v27458670er62wkCt',
	'ABBC3_VEOH_VIEW'			=> '[veoh]http://www.veoh.com/watch/v27458670er62wkCt[/veoh]',
	'ABBC3_VEOH_EXPLAIN'		=> $lang['DEPRECATED_BBCODE'],

	// Collegehumor video
	'ABBC3_COLLEGEHUMOR_TAG'	=> 'Collegehumor',
	'ABBC3_COLLEGEHUMOR_MOVER'	=> 'Collegehumor sitesinden video ekle',
	'ABBC3_COLLEGEHUMOR_TIP'	=> '[collegehumor]collegehumor video adresi[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXAMPLE'=> 'http://www.collegehumor.com/video:1802097',
	'ABBC3_COLLEGEHUMOR_VIEW'	=> '[collegehumor]http://www.collegehumor.com/video:1802097[/collegehumor]',
	'ABBC3_COLLEGEHUMOR_EXPLAIN'=> $lang['DEPRECATED_BBCODE'],

	// Dailymotion video
	'ABBC3_DM_MOVER'			=> 'Dailymotion sitesinden video ekle',
	'ABBC3_DM_TIP'				=> '[dm]Dailymotion ID[/dm]',
	'ABBC3_DM_EXAMPLE'			=> 'http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
	'ABBC3_DM_VIEW'				=> '[dm]http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport[/dm]',
	'ABBC3_DM_EXPLAIN'			=> $lang['DEPRECATED_BBCODE'],

	// Gamespot video
	'ABBC3_GAMESPOT_MOVER'		=> 'Gamespot sitesinden video ekle',
	'ABBC3_GAMESPOT_TIP'		=> '[gamespot]Gamespot video adresi[gamespot]',
	'ABBC3_GAMESPOT_EXAMPLE'	=> 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
	'ABBC3_GAMESPOT_VIEW'		=> '[gamespot]http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8[/gamespot]',
	'ABBC3_GAMESPOT_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// IGN video
	'ABBC3_IGNVIDEO_MOVER'		=> 'IGN sitesinden video ekle',
	'ABBC3_IGNVIDEO_TIP'		=> '[ignvideo]IGN video adresi[/ignvideo]',
	'ABBC3_IGNVIDEO_EXAMPLE'	=> 'http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html',
	'ABBC3_IGNVIDEO_VIEW'		=> '[ignvideo]http://movies.ign.com/dor/objects/14299069/che/videos/che_pt2_exclip_010609.html[/ignvideo]',
	'ABBC3_IGNVIDEO_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

	// LiveLeak video
	'ABBC3_LIVELEAK_MOVER'		=> 'Liveleak sitesinden video ekle',
	'ABBC3_LIVELEAK_TIP'		=> '[liveleak]Liveleak video adresi[/liveleak]',
	'ABBC3_LIVELEAK_EXAMPLE'	=> 'http://www.liveleak.com/view?i=166_1194290849',
	'ABBC3_LIVELEAK_VIEW'		=> '[liveleak]http://www.liveleak.com/view?i=166_1194290849[/liveleak]',
	'ABBC3_LIVELEAK_EXPLAIN'	=> $lang['DEPRECATED_BBCODE'],

// Custom BBCodes

));

?>