<?php
/**
*
* Advanced BBCode Box [European Portuguese]
*
* Translation by Gwyneth Llewelyn
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Aqui pode alterar as configurações do «Advanced BBCode Box». Para mais informações (em inglês) sobre a customização da barra de ícones, visite <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">a FAQ do ABBC3 <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_INVALID_FONT'		=> 'Invalid font name for “%s”',
	'ABBC3_PIPES'				=> 'Activar o plugin «Pipe Table PlugIn»',
	'ABBC3_PIPES_EXPLAIN'		=> 'O «Pipes Table PlugIn» permite aos utilizadores criarem tabelas nos seus posts e mensagens privadas usando a sintaxe <a href="https://pt.wikipedia.org/wiki/Markdown" target="_blank">markdown</a>.',
	'ABBC3_BBCODE_BAR'			=> 'Activar este BBCode na barra de ícones',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Isto irá activar o plugin ABBC3, uma barra de ferramentas BBCode, baseada em ícones. Desactive para ver os botões por omissão do phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Activar BBCodes na Resposta Rápida',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Esta opção irá acrescentar botões BBCode à Resposta Rápida.',
	'ABBC3_ICONS_TYPE'			=> 'Fomato das imagens para a barra de ícones',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Escolha o formato de imagem usado pelos ícones do ABBC3. Note que só pode usar um único formato para todos os ícones.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra de ícones BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Extras',
	'ABBC3_AUTO_VIDEO'			=> 'Enable Auto Video PlugIn',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'This plugin converts plain-text video file URLs into playable videos. Only URLs starting with <samp class="error">http://</samp> or <samp class="error">https://</samp> and ending with <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> or <samp class="error">.webm</samp> are converted.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Install the optional phpBB Media Embed extension to access settings and management options for embedded rich media content.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'phpBB Media Embed extension is not installed. <a href="https://www.phpbb.com/customise/db/extension/mediaembed/" target="_blank">Download <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
		1	=> 'phpBB Media Embed extension is installed. Settings are accessible under the Posting tab.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
