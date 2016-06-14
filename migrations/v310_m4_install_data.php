<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v310_m4_install_data extends \vse\abbc3\core\bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		return isset($this->config['abbc3_version']) && version_compare($this->config['abbc3_version'], '3.1.0', '>=');
	}

	/**
	 * {@inheritdoc}
	 */
	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m3_install_schema');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('abbc3_version', '3.1.0')),
			array('custom', array(array($this, 'install_abbc3_bbcodes'))),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected static $bbcode_data = array(
		'font=' => array(
			'bbcode_helpline'	=> 'ABBC3_FONT_HELPLINE',
			'bbcode_match'		=> '[font={INTTEXT}]{TEXT}[/font]',
			'bbcode_tpl'		=> '<span style="font-family: {INTTEXT};">{TEXT}</span>',
		),
		'highlight=' => array(
			'bbcode_helpline'	=> 'ABBC3_HIGHLIGHT_HELPLINE',
			'bbcode_match'		=> '[highlight={COLOR}]{TEXT}[/highlight]',
			'bbcode_tpl'		=> '<span style="background-color: {COLOR};">{TEXT}</span>',
		),
		'align=center' => array(
			'bbcode_helpline'	=> 'ABBC3_ALIGN_HELPLINE',
			'bbcode_match'		=> '[align={IDENTIFIER}]{TEXT}[/align]',
			'bbcode_tpl'		=> '<span style="text-align:{IDENTIFIER}; display:block;">{TEXT}</span>',
		),
		'float=' => array(
			'bbcode_helpline'	=> 'ABBC3_FLOAT_HELPLINE',
			'bbcode_match'		=> '[float={IDENTIFIER}]{TEXT}[/float]',
			'bbcode_tpl'		=> '<div style="float:{IDENTIFIER}; padding:0 10px;">{TEXT}</div>',
		),
		'pre' => array(
			'bbcode_helpline'	=> 'ABBC3_PREFORMAT_HELPLINE',
			'bbcode_match'		=> '[pre]{TEXT}[/pre]',
			'bbcode_tpl'		=> '<pre class="abbc3_pre">{TEXT}</pre>',
		),
		's' => array(
			'bbcode_helpline'	=> 'ABBC3_STRIKE_HELPLINE',
			'bbcode_match'		=> '[s]{TEXT}[/s]',
			'bbcode_tpl'		=> '<span class="abbc3_strike">{TEXT}</span>',
		),
		'sup' => array(
			'bbcode_helpline'	=> 'ABBC3_SUP_HELPLINE',
			'bbcode_match'		=> '[sup]{TEXT}[/sup]',
			'bbcode_tpl'		=> '<sup>{TEXT}</sup>',
		),
		'sub' => array(
			'bbcode_helpline'	=> 'ABBC3_SUB_HELPLINE',
			'bbcode_match'		=> '[sub]{TEXT}[/sub]',
			'bbcode_tpl'		=> '<sub>{TEXT}</sub>',
		),
		'glow=' => array(
			'bbcode_helpline'	=> 'ABBC3_GLOW_HELPLINE',
			'bbcode_match'		=> '[glow={COLOR}]{TEXT}[/glow]',
			'bbcode_tpl'		=> '<span class="glow" style="display: inline; padding: 0 6px; color: #ffffff; text-shadow: 0 0 1em {COLOR}, 0 0 1em {COLOR}, 0 0 1.2em {COLOR};">{TEXT}</span>',
		),
		'shadow=' => array(
			'bbcode_helpline'	=> 'ABBC3_SHADOW_HELPLINE',
			'bbcode_match'		=> '[shadow={COLOR}]{TEXT}[/shadow]',
			'bbcode_tpl'		=> '<span class="shadow" style="display: inline; padding: 0 6px; color: {COLOR}; text-shadow: -2px 2px 2px #999;">{TEXT}</span>',
		),
		'dropshadow=' => array(
			'bbcode_helpline'	=> 'ABBC3_DROPSHADOW_HELPLINE',
			'bbcode_match'		=> '[dropshadow={COLOR}]{TEXT}[/dropshadow]',
			'bbcode_tpl'		=> '<span class="dropshadow" style="display: inline; padding: 0 6px; color: {COLOR}; text-shadow: -1px 1px 0 #999;">{TEXT}</span>',
		),
		'blur=' => array(
			'bbcode_helpline'	=> 'ABBC3_BLUR_HELPLINE',
			'bbcode_match'		=> '[blur={COLOR}]{TEXT}[/blur]',
			'bbcode_tpl'		=> '<span class="blur" style="display: inline; padding: 0 6px; color: transparent; text-shadow: 0 0 0.2em {COLOR};">{TEXT}</span>',
		),
		'fade' => array(
			'bbcode_helpline'	=> 'ABBC3_FADE_HELPLINE',
			'bbcode_match'		=> '[fade]{TEXT}[/fade]',
			'bbcode_tpl'		=> '<span class="fadeEffect">{TEXT}</span>',
		),
		'dir=ltr' => array(
			'bbcode_helpline'	=> 'ABBC3_DIR_HELPLINE',
			'bbcode_match'		=> '[dir={IDENTIFIER}]{TEXT}[/dir]',
			'bbcode_tpl'		=> '<bdo dir="{IDENTIFIER}">{TEXT}</bdo>',
		),
		'marq=up' => array(
			'bbcode_helpline'	=> 'ABBC3_MARQUEE_HELPLINE',
			'bbcode_match'		=> '[marq={IDENTIFIER}]{TEXT}[/marq]',
			'bbcode_tpl'		=> '<marquee class="abbc3_marquee" direction="{IDENTIFIER}" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
		),
		'spoil' => array(
			'bbcode_helpline'	=> 'ABBC3_SPOILER_HELPLINE',
			'bbcode_match'		=> '[spoil]{TEXT}[/spoil]',
			'bbcode_tpl'		=> '<div class="spoilwrapper"><div class="spoiltitle"><span class="spoilbtn" data-show="{L_ABBC3_SPOILER_SHOW}" data-hide="{L_ABBC3_SPOILER_HIDE}">{L_ABBC3_SPOILER_SHOW}</span></div><div style="display: none;" class="spoilcontent">{TEXT}</div></div>',
		),
		'hidden' => array(
			'bbcode_helpline'	=> 'ABBC3_HIDDEN_HELPLINE',
			'bbcode_match'		=> '[hidden]{TEXT}[/hidden]',
			'bbcode_tpl'		=> '<!-- ABBC3_BBCODE_HIDDEN -->{TEXT}<!-- ABBC3_BBCODE_HIDDEN -->',
		),
		'offtopic' => array(
			'bbcode_helpline'	=> 'ABBC3_OFFTOPIC_HELPLINE',
			'bbcode_match'		=> '[offtopic]{TEXT}[/offtopic]',
			'bbcode_tpl'		=> '<div class="offtopic"><div class="offtopic_title">{L_ABBC3_OFFTOPIC}</div><div class="offtopic_text">{TEXT}</div></div>',
		),
		'mod=' => array(
			'bbcode_helpline'	=> 'ABBC3_MOD_HELPLINE',
			'bbcode_match'		=> '[mod={TEXT1}]{TEXT2}[/mod]',
			'bbcode_tpl'		=> '<table class="ModTable"><tr><td class="exclamation" rowspan="2">&nbsp;!&nbsp;</td><td class="rowuser">{L_MESSAGE} {L_FROM}{L_COLON} {TEXT1}</td></tr><tr><td class="rowtext">{TEXT2}</td></tr></table>',
		),
		'nfo' => array(
			'bbcode_helpline'	=> 'ABBC3_NFO_HELPLINE',
			'bbcode_match'		=> '[nfo]{TEXT}[/nfo]',
			'bbcode_tpl'		=> '<pre class="nfo">{TEXT}</pre>',
		),
		'soundcloud' => array(
			'bbcode_helpline'	=> 'ABBC3_SOUNDCLOUD_HELPLINE',
			'bbcode_match'		=> '[soundcloud]{URL}[/soundcloud]',
			'bbcode_tpl'		=> '<object height="81" width="100%"><param name="movie" value="http://player.soundcloud.com/player.swf?url={URL}&amp;g=bb"><param name="allowscriptaccess" value="always"><embed allowscriptaccess="always" height="81" src="http://player.soundcloud.com/player.swf?url={URL}&amp;g=bb" type="application/x-shockwave-flash" width="100%"></embed></object>',
		),
		'BBvideo' => array(
			'bbcode_helpline'	=> 'ABBC3_BBVIDEO_HELPLINE',
			'bbcode_match'		=> '[BBvideo={NUMBER1},{NUMBER2}]{URL}[/BBvideo]',
			'bbcode_tpl'		=> '<a href="{URL}" class="bbvideo" data-bbvideo="{NUMBER1},{NUMBER2}" target="_blank">{URL}</a>',
		),
		'youtube' => array(
			'bbcode_helpline'	=> 'ABBC3_YOUTUBE_HELPLINE',
			'bbcode_match'		=> '[youtube]{URL}[/youtube]',
			'bbcode_tpl'		=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,315">{URL}</a>',
			'display_on_posting'=> 0,
		),
	);
}
