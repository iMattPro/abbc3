<?php
/**
*
* Advanced BBCodes [Brazilian Portuguese]
*
* @copyright (c) 2013-2025 Matt Friedman
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Here you can configure settings for ' . \vse\abbc3\ext::ABBC3_EXT_NAME . '. For information about customizing the icon bar, visit the %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Adicione <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> ao <samp class="error">[font]</samp> BBCode. Use ortografia exata e distinção entre maiúsculas e minúsculas. Coloque cada nome de fonte em uma linha separada.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Permitir uso de redes de entrega de conteúdo de terceiros” deve estar habilitado em “Configurações de carregamento” para usar este recurso.',
	'ABBC3_INVALID_FONT'		=> 'Nome de fonte inválido para “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Não foi possível verificar a fonte do Google “%s”. Verifique a conexão do servidor e tente novamente.',
	'ABBC3_PIPES'				=> 'Ativar plug-in de tabela de tubos',
	'ABBC3_PIPES_EXPLAIN'		=> 'O Pipe Table PlugIn permite aos usuários criar tabelas em suas postagens e mensagens privadas usando a sintaxe markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Habilitar barra de ícones BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'This will display an icon-based BBCode toolbar. Disable this to display phpBB’s default BBCode buttons.',
	'ABBC3_QR_BBCODES'			=> 'Habilite BBCodes na Resposta Rápida',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Isso adicionará botões BBCode à Resposta Rápida.',
	'ABBC3_ICONS_TYPE'			=> 'Formato de imagem da barra de ícones',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Choose the image format to use for Advanced BBCode icons. Note that you can only choose one format for all your icons.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra de ícones BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Complementos',
	'ABBC3_AUTO_VIDEO'			=> 'Ativar plug-in de vídeo automático',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Este plugin converte URLs de arquivos de vídeo de texto simples em vídeos reproduzíveis. Somente URLs começando com <samp class="error">http://</samp> ou <samp class="error">https://</samp> e terminando com <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> ou <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Instale a extensão opcional phpBB Media Embed para acessar configurações e opções de gerenciamento de conteúdo rich media incorporado.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'A extensão phpBB Media Embed não está instalada. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'A extensão phpBB Media Embed está instalada. As configurações estão acessíveis na guia Postagem.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
