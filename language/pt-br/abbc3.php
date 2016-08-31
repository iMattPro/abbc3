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
	// Hidden BBCode
	'ABBC3_HIDDEN_ON'			=> 'Esconder conteúdo',
	'ABBC3_HIDDEN_OFF'			=> 'Esconder conteúdo (somente para membros)',
	'ABBC3_HIDDEN_EXPLAIN'		=> 'Você tem que está registrado e logado para ver o conteúdo oculto.',

	// Spoiler BBCode
	'ABBC3_SPOILER_SHOW'		=> '► Exibir Spoiler',
	'ABBC3_SPOILER_HIDE'		=> '▼ Esconder Spoiler',

	// Off Topic BBCode
	'ABBC3_OFFTOPIC'			=> 'Off Topic',

	// Font BBCode
	'ABBC3_FONT_BBCODE'			=> 'Fontes',
	'ABBC3_FONT_FANCY'			=> 'Fancy fonts',
	'ABBC3_FONT_SAFE'			=> 'Safe fonts',
	'ABBC3_FONT_WIN'			=> 'Windows fonts',

	// BBCode help lines
	'ABBC3_ALIGN_HELPLINE'		=> 'Alinhar texto: [align=center|left|right|justify]texto[/align]',
	'ABBC3_BBVIDEO_HELPLINE'	=> 'Incorporar qualquer URL de vídeo: [BBvideo=width,height]http://video_url[/BBvideo]',
	'ABBC3_BLUR_HELPLINE'		=> 'Borrão no texto: [blur=color]texto[/blur]',
	'ABBC3_DIR_HELPLINE'		=> 'Direção do texto: [dir=ltr|rtl]texto[/dir]',
	'ABBC3_DROPSHADOW_HELPLINE'	=> 'Sombra do texto: [dropshadow=color]textp[/dropshadow]',
	'ABBC3_FADE_HELPLINE'		=> 'Texto fadein / fadeout: [fade]texto[/fade]',
	'ABBC3_FLOAT_HELPLINE'		=> 'Texto flutuante: [float=left|right]texto[/float]',
	'ABBC3_FONT_HELPLINE'		=> 'Tipo de fonte: [font=Comic Sans MS]texto[/font]',
	'ABBC3_GLOW_HELPLINE'		=> 'Texto com brilho: [glow=color]texto[/glow]',
	'ABBC3_HIDDEN_HELPLINE'		=> 'Hide from guests: [hidden]texto[/hidden]',
	'ABBC3_HIGHLIGHT_HELPLINE'	=> 'Realçar o texto: [highlight=yellow]texto[/highlight]  Dica: você também pode usar color=#FF0000',
	'ABBC3_MARQUEE_HELPLINE'	=> 'Letreiro: [marq=up|down|left|right]texto[/marq]',
	'ABBC3_MOD_HELPLINE'		=> 'Mensagem de alerta: [mod=username]text[/mod]',
	'ABBC3_NFO_HELPLINE'		=> 'NFO ascii art text: [nfo]texto[/nfo]',
	'ABBC3_OFFTOPIC_HELPLINE'	=> 'Mensagem Off Topic: [offtopic]texto[/offtopic]',
	'ABBC3_PREFORMAT_HELPLINE'	=> 'Texto pré-formatado: [pre]texto[/pre]',
	'ABBC3_SHADOW_HELPLINE'		=> 'Segunda sobra do texto [shadow=color]texto[/shadow]',
	'ABBC3_SOUNDCLOUD_HELPLINE'	=> 'SoundCloud: [soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
	'ABBC3_SPOILER_HELPLINE'	=> 'Spoiler: [spoil]texto[/spoil]',
	'ABBC3_STRIKE_HELPLINE'		=> 'Texto exponecial: [s]texto[/s]',
	'ABBC3_SUB_HELPLINE'		=> 'Texto subscrito: [sub]text[/sub]',
	'ABBC3_SUP_HELPLINE'		=> 'Texto sobrescrito: [sup]text[/sup]',
	'ABBC3_YOUTUBE_HELPLINE'	=> 'YouTube: [youtube]http://youtube_url[/youtube]',

	// Utility BBCodes
	'ABBC3_COPY_BBCODE'			=> 'Copie o texto selecionado',
	'ABBC3_PASTE_BBCODE'		=> 'Colar texto copiado',
	'ABBC3_PASTE_ERROR'			=> 'Primeiro, você deve copiar uma seleção de texto, em seguida, colá-lo',
	'ABBC3_PLAIN_BBCODE'		=> 'Remover todas as tags BBCode do texto selecionado',
	'ABBC3_NOSELECT_ERROR'		=> 'Nenhum texto foi selecionado.',

	// BBCode Wizards
	'ABBC3_BBCODE_WIZ_SUBMIT'	=> 'Inserir na mensagem',
	'ABBC3_BBCODE_WIZ_EXAMPLE'	=> 'Exemplo',

	// BBvideo Wizard
	'ABBC3_BBVIDEO_SITES'		=> 'BBvideo sites permitidos',
	'ABBC3_BBVIDEO_LINK'		=> 'Vídeo URL',
	'ABBC3_BBVIDEO_SIZE'		=> 'Vídeo largura x altura',
	'ABBC3_BBVIDEO_PRESETS'		=> 'Predefinições de Tamanho',
	'ABBC3_BBVIDEO_SEPARATOR'	=> 'x',

	// URL Wizard
	'ABBC3_URL_LINK'			=> 'Digite uma URL do site',
	'ABBC3_URL_DESCRIPTION'		=> 'Descrição opcional',
	'ABBC3_URL_EXAMPLE'			=> 'http://www.google.com.br',

	// ACP
	'ABBC3_BBCODE_ORDERED'		=> 'A ordem BBCode foi atualizado.',
	'ABBC3_BBCODE_GROUP'		=> 'Gerenciar grupos que podem usar esse BBCode',
	'ABBC3_BBCODE_GROUP_INFO'	=> 'Se nenhum grupo é selecionado, em seguida, todos os usuários podem usar este BBCode. Use Ctrl + clique (ou CMD + clique no Mac) para selecionar / desmarcar mais de um grupo.',
));
