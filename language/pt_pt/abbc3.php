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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Conteúdo oculto',
	'ABBC3_HIDDEN_OFF'			=> 'Conteúdo oculto (apenas para membros)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Este forum requer que esteja registado e conectado para ver o conteúdo oculto.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Mostrar «spoiler»',
	'ABBC3_SPOILER_HIDE'		=> '▼ Esconder «spoiler»',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Fora de tópico',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Tipos de letra',
	'ABBC3_FONT_SAFE'			=> 'Tipos de letra seguros',
	'ABBC3_GOOGLE_FONTS'		=> 'Tipos de letra Google',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Alinhar texto: [align=center|left|right|justify]texto[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Incorporar qualquer URL de vídeo: [bbvideo]http://video_url[/bbvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Esborratar texto: [blur=color]texto[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Direcção do diretextction: [dir=ltr|rtl]texto[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Texto com sombra projectada: [dropshadow=color]texto[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Texto aparecendo/desaparecendo gradualmente: [fade]texto[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Texto flutuante: [float=left|right]texto[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Tipo de letra: [font=Comic Sans MS]texto[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Texto com brilho: [glow=color]texto[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Ocultar dos visitantes não registados: [hidden]texto[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Realçar o texto: [highlight=yellow]texto[/highlight]  Dica: também pode usar a notação para côr #FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Rolar texto: [marq=up|down|left|right]texto[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Mensagem de alerta: [mod=username]texto[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'Texto artístico tipo NFO ASCII: [nfo]texto[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Mensagem fora do tópico: [offtopic]texto[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Texto pré-formatado: [pre]texto[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Texto com outro tipo de sombra projectada: [shadow=color]texto[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Mensagem de «spoiler»: [spoil]texto[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Texto riscado: [s]texto[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Texto subscrito: [sub]texto[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Texto sobrescrito: [sup]texto[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'Vídeo no YouTube: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Copiar texto seleccionado',
	'ABBC3_PASTE_BBCODE'		=> 'Colar texto copiado',
	'ABBC3_PASTE_ERROR'			=> 'Tem de copiar uma selecção de texto antes de o colar',
	'ABBC3_PLAIN_BBCODE'		=> 'Remover todas as etiquetas BBCode do texto seleccionado',
	'ABBC3_NOSELECT_ERROR'		=> 'Não foi seleccionado nenhum texto.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Inserir na mensagem',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Exemplo',
	'ABBC3_BBVIDEO_SITES'		=> 'Sites autorizados',
	'ABBC3_URL_LINK'			=> 'Introduza o URL dum site',
	'ABBC3_URL_DESCRIPTION'		=> 'Descrição opcional',
	'ABBC3_URL_EXAMPLE'			=> 'https://www.phpbb-pt.com/',

	// Pipe tables
	'ABBC3_PIPE_TABLES'			=> 'Criar tabelas',
	'ABBC3_PIPE_TABLES_EXPLAIN'	=> 'Criar tabelas usando um dos seguintes formatos tipo ASCII.',
	'ABBC3_PIPE_DOCUMENTATION'	=> 'Guia do utilizador',
	'ABBC3_PIPE_SIMPLE'			=> 'Tabela simples',
	'ABBC3_PIPE_COMPACT'		=> 'Tabela compacta',
	'ABBC3_PIPE_COMPACT_EXPLAIN'=> 'As barras exteriores, assim como os espaços à volta de todas as barras, são opcionais.',
	'ABBC3_PIPE_ALIGNMENT'		=> 'Alinhamento do texto',
	// Pipe Table Example Code: DO NOT NEED TO TRANSLATE THESE EXAMPLES
	'ABBC3_PIPE_SIMPLE_EX'		=> "| Cabeçalho 1 | Cabeçalho 2 |\n|----------|----------|\n| Célula 1   | Célula 2   |",
	'ABBC3_PIPE_COMPACT_EX'		=> "Cabeçalho 1|Cabeçalho 2\n-|-\nCélula 1|Célula 2",
	'ABBC3_PIPE_ALIGNMENT_EX'	=> "| Esquerda | Centro | Direita |\n|:-----|:------:|------:|\n|   x  |    x   |   x   |",

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'A ordem do BBCode foi actualizada.',
	'ABBC3_BBCODE_GROUP'		=> 'Gerir os grupos que podem usar este BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Se nenhum grupo for seleccionado, então todos os utilizadores podem usar estes BBCode. Use CTRL+CLIQUE (or CMD+CLIQUE no Mac) para seleccionar/desmarcar mais de um grupo.',
	'ABBC3_GOOGLE_FONTS_INFO'	=> 'Add <strong><a href="https://fonts.google.com" target="_blank">Google Fonts</a></strong> to the <samp class="error">[font]</samp> BBCode. Use exact spelling and case sensitivity. Place each font name on a separate line. Example: <samp>Droid Sans</samp><br><br>Note that “Allow usage of third party content delivery networks” must be enabled under “Load settings” to use this feature.',
	'ABBC3_SETTINGS_EXPLAIN'	=> 'Aqui pode alterar as configurações do «Advanced BBCode Box». Para mais informações (em inglês) sobre a customização da barra de ícones, visite <a href="https://www.phpbb.com/customise/db/extension/advanced_bbcode_box/faq/1551" target="_blank">a FAQ do ABBC3 <i class="icon fa-external-link fa-fw" aria-hidden="true"></i></a>.',
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
	'PNG' => 'PNG',
	'SVG' => 'SVG',

	// BBCode FAQ
	'ABBC3_FAQ_TITLE'			=> 'Advanced BBCode Box BBCodes',
	'ABBC3_FAQ_SAMPLE_TEXT'		=> 'Bancos fúteis pagavam-lhe queijo, whisky e xadrez.',
	'ABBC3_FAQ_ANSWER'			=> '%1$s<br /><br /><strong>Exemplo:</strong><br />%2$s<br /><br /><strong>Resultado:</strong><br />%3$s<hr />',
));
