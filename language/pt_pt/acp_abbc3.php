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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Aqui pode alterar as configurações do «Advanced BBCode Box». Para mais informações (em inglês) sobre a customização da barra de ícones, visite %s.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Adicione <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> ao <samp class="error">[font]</samp> BBCode. Use ortografia exata e distinção entre maiúsculas e minúsculas. Coloque cada nome de fonte em uma linha separada.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Permitir uso de redes de entrega de conteúdo de terceiros” deve estar habilitado em “Configurações de carregamento” para usar este recurso.',
	'ABBC3_INVALID_FONT'		=> 'Nome de fonte inválido para “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Não foi possível verificar a fonte do Google “%s”. Verifique a conexão do servidor e tente novamente.',
	'ABBC3_PIPES'				=> 'Activar o plugin «Pipe Table PlugIn»',
	'ABBC3_PIPES_EXPLAIN'		=> 'O «Pipes Table PlugIn» permite aos utilizadores criarem tabelas nos seus posts e mensagens privadas usando a sintaxe <a href="https://pt.wikipedia.org/wiki/Markdown" target="_blank" rel="noopener noreferrer">markdown</a>.',
	'ABBC3_BBCODE_BAR'			=> 'Activar este BBCode na barra de ícones',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Isto irá activar o plugin ABBC3, uma barra de ferramentas BBCode, baseada em ícones. Desactive para ver os botões por omissão do phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Activar BBCodes na Resposta Rápida',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Esta opção irá acrescentar botões BBCode à Resposta Rápida.',
	'ABBC3_ICONS_TYPE'			=> 'Fomato das imagens para a barra de ícones',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Escolha o formato de imagem usado pelos ícones do ABBC3. Note que só pode usar um único formato para todos os ícones.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra de ícones BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Extras',
	'ABBC3_AUTO_VIDEO'			=> 'Ativar plug-in de vídeo automático',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Este plugin converte URLs de arquivos de vídeo de texto simples em vídeos reproduzíveis. Somente URLs começando com <samp class="error">http://</samp> ou <samp class="error">https://</samp> e terminando com <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> ou <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO'				=> 'BBVideo',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Instale a extensão opcional phpBB Media Embed para acessar configurações e opções de gerenciamento de conteúdo rich media incorporado.',
	'ABBC3_MEDIA_EMBED_INSTALL'	=> [
		0	=> 'A extensão phpBB Media Embed não está instalada. %2$s.',
		1	=> 'A extensão phpBB Media Embed está instalada. As configurações estão acessíveis na guia Postagem.'
	],
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
