<?php
/**
*
* Advanced BBCode Box [Brazilian Portuguese]
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
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Aqui você pode definir as configurações do Advanced [BBCode] Box.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Adicione <strong><a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer">Google Fonts</a></strong> ao <samp class="error">[font]</samp> BBCode. Use ortografia exata e distinção entre maiúsculas e minúsculas. Coloque cada nome de fonte em uma linha separada.',
	'ABBC3_GOOGLE_FONTS_NOTE'	=> '“Permitir uso de redes de entrega de conteúdo de terceiros” deve estar habilitado em “Configurações de carregamento” para usar este recurso.',
	'ABBC3_FONT_SEARCH'	=> 'Pesquisar no Google Fonts',
	'ABBC3_FONT_SEARCH_LOADING'	=> 'Carregando nomes de fontes…',
	'ABBC3_FONT_SEARCH_EMPTY'	=> 'Nenhuma fonte correspondente.',
	'ABBC3_FONT_SEARCH_UNAVAILABLE'	=> 'O catálogo de fontes está indisponível. Digite os nomes manualmente.',
	'ABBC3_SAVE_FONTS'	=> 'Salvar fontes',
	'ABBC3_FONTS_CHECKING'	=> 'Verificando e salvando fontes…',
	'ABBC3_FONTS_SAVED'	=> 'Fontes salvas.',
	'ABBC3_TOOLBAR_COMPOSER'	=> 'Editor da barra de ferramentas',
	'ABBC3_TOOLBAR_COMPOSER_EXPLAIN'	=> 'Arraste os botões entre Principais, Mais e Ocultos. Selecione um botão para personalizá-lo. O ícone do Font Awesome tem prioridade sobre a imagem. Sem imagem, será exibido o nome do BBCode.',
	'ABBC3_TOOLBAR_PRIMARY'	=> 'Principais',
	'ABBC3_TOOLBAR_MORE'	=> 'Mais',
	'ABBC3_TOOLBAR_HIDDEN'	=> 'Ocultos',
	'ABBC3_FONT_ICON'	=> 'Ícone do Font Awesome',
	'ABBC3_IMAGE_ICON'	=> 'Ícone de imagem',
	'ABBC3_ICON_NONE'	=> 'Nenhum (usar texto)',
	'ABBC3_PLACEMENT'	=> 'Posição',
	'ABBC3_TOOLBAR_DISABLED'	=> 'A barra de ícones de BBCode está desativada. Você ainda pode editar a disposição, que será aplicada quando a barra for reativada.',
	'ABBC3_LIVE_PREVIEW'	=> 'Visualização em tempo real',
	'ABBC3_AUTOSAVE_SAVING'	=> 'Salvando…',
	'ABBC3_AUTOSAVE_SAVED'	=> 'Salvo',
	'ABBC3_AUTOSAVE_ERROR'	=> 'Não foi possível salvar as alterações.',
	'ABBC3_AUTOSAVE_RETRY'	=> 'Tentar novamente',
	'ABBC3_JAVASCRIPT_REQUIRED'	=> 'É necessário JavaScript para alterar as configurações do Advanced [BBCode] Box.',
	'ABBC3_DRAG_BUTTON'	=> 'Arrastar %s',
	'ABBC3_MEDIA_EMBED_STATUS'	=> 'BBVideo e Media Embed',
	'ABBC3_INVALID_FONT'		=> 'Nome de fonte inválido para “%s”',
	'ABBC3_FONT_CHECK_FAILED'	=> 'Não foi possível verificar a fonte do Google “%s”. Verifique a conexão do servidor e tente novamente.',
	'ABBC3_PIPES'				=> 'Ativar plug-in de tabela de tubos',
	'ABBC3_PIPES_EXPLAIN'		=> 'O Pipe Table PlugIn permite aos usuários criar tabelas em suas postagens e mensagens privadas usando a sintaxe markdown.',
	'ABBC3_BBCODE_BAR'			=> 'Habilitar barra de ícones BBCode',
	'ABBC3_BBCODE_BAR_EXPLAIN'	=> 'Esta opção exibe uma barra de ferramentas de BBCode com ícones. Desative-a para exibir os botões de BBCode padrão do phpBB.',
	'ABBC3_QR_BBCODES'			=> 'Habilite BBCodes na Resposta Rápida',
	'ABBC3_QR_BBCODES_EXPLAIN'	=> 'Isso adicionará botões BBCode à Resposta Rápida.',
	'ABBC3_ICONS_TYPE'			=> 'Formato de imagem da barra de ícones',
	'ABBC3_ICONS_TYPE_EXPLAIN'	=> 'Escolha o formato de imagem dos ícones de BBCode. Você pode enviar ícones SVG ou PNG adicionais para o diretório <samp class="error">/images/abbc3/icons/</samp> do seu fórum.',
	'ABBC3_LEGEND_ICON_BAR'		=> 'Barra de ícones BBCode',
	'ABBC3_LEGEND_ADD_ONS'		=> 'Complementos',
	'ABBC3_AUTO_VIDEO'			=> 'Ativar plug-in de vídeo automático',
	'ABBC3_AUTO_VIDEO_EXPLAIN'	=> 'Este plugin converte URLs de arquivos de vídeo de texto simples em vídeos reproduzíveis. Somente URLs começando com <samp class="error">http://</samp> ou <samp class="error">https://</samp> e terminando com <samp class="error">.mp4</samp>, <samp class="error">.ogg</samp> ou <samp class="error">.webm</samp>.',
	'ABBC3_BBVIDEO_EXPLAIN'		=> 'Instale a extensão opcional phpBB Media Embed para acessar configurações e opções de gerenciamento de conteúdo rich media incorporado.',
	'ABBC3_MEDIA_EMBED_NOT_INSTALLED'	=> 'A extensão phpBB Media Embed não está instalada. %s.',
	'ABBC3_MEDIA_EMBED_INSTALLED'		=> 'A extensão phpBB Media Embed está instalada. As configurações estão acessíveis na guia Postagem.',
	'PNG' => 'PNG',
	'SVG' => 'SVG',
));
