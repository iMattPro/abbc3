<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v310_m7_update_bbcodes extends \vse\abbc3\migrations_bbcode_base
{
	/**
	 * {@inheritdoc}
	 */
	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m6_update_bbcodes');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return array(
			// Custom functions
			array('custom', array(array($this, 'remove_abbc3_bbcodes'))),
			array('custom', array(array($this, 'install_abbc3_bbcodes'))),
		);
	}

	/**
	 * @var array An array of bbcodes data to install
	 */
	protected $bbcode_data = array(
		/* class name & styles updated */
		'blur=' => array(
			'bbcode_helpline'	=> 'ABBC3_BLUR_HELPLINE',
			'bbcode_match'		=> '[blur={COLOR}]{TEXT}[/blur]',
			'bbcode_tpl'		=> '<span class="abbc3_blur" style="display: inline; padding: 0 1px; color: rgba(0, 0, 0, 0.15); text-shadow: 0 0 0.2em {COLOR};">{TEXT}</span>',
		),
		/* new tag ( old: align=center ) */
		'center' => array(
			'bbcode_helpline'	=> 'ABBC3_CENTER_HELPLINE',
			'bbcode_match'		=> '[center]{TEXT}[/center]',
			'bbcode_tpl'		=> '<span style="text-align:center; display:block;">{TEXT}</span>',
		),
		/* class name & styles updated */
		'dropshadow=' => array(
			'bbcode_helpline'	=> 'ABBC3_DROPSHADOW_HELPLINE',
			'bbcode_match'		=> '[dropshadow={COLOR}]{TEXT}[/dropshadow]',
			'bbcode_tpl'		=> '<span class="abbc3_dropshadow" style="display: inline; color: {COLOR}; text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.4);">{TEXT}</span>',
		),
		/* class name updated */
		'fade' => array(
			'bbcode_helpline'	=> 'ABBC3_FADE_HELPLINE',
			'bbcode_match'		=> '[fade]{TEXT}[/fade]',
			'bbcode_tpl'		=> '<span class="abbc3_fade">{TEXT}</span>',
		),
		/* class name & styles updated */
		'glow=' => array(
			'bbcode_helpline'	=> 'ABBC3_GLOW_HELPLINE',
			'bbcode_match'		=> '[glow={COLOR}]{TEXT}[/glow]',
			'bbcode_tpl'		=> '<span class="abbc3_glow" style="display: inline; padding: 0 3px; color: #ffffff; text-shadow: 0 0 0.4em {COLOR}, 0 0 0.5em {COLOR}, 0 0 0.6em {COLOR};">{TEXT}</span>',
		),
		/* class name added & styles updated */
		'highlight=' => array(
			'bbcode_helpline'	=> 'ABBC3_HIGHLIGHT_HELPLINE',
			'bbcode_match'		=> '[highlight={COLOR}]{TEXT}[/highlight]',
			'bbcode_tpl'		=> '<span class="abbc3_highlight" style="padding: 0 2px; background-color: {COLOR};">{TEXT}</span>',
		),
		/* new tag ( old: align=justify ) */
		'justify' => array(
			'bbcode_helpline'	=> 'ABBC3_JUSTIFY_HELPLINE',
			'bbcode_match'		=> '[justify]{TEXT}[/justify]',
			'bbcode_tpl'		=> '<span style="text-align:justify; display:block;">{TEXT}</span>',
		),
		/* new tag ( old: align=left ) */
		'left' => array(
			'bbcode_helpline'	=> 'ABBC3_LEFT_HELPLINE',
			'bbcode_match'		=> '[left]{TEXT}[/left]',
			'bbcode_tpl'		=> '<span style="text-align:left; display:block;">{TEXT}</span>',
		),
		/* class names updated */
		'mod=' => array(
			'bbcode_helpline'	=> 'ABBC3_MOD_HELPLINE',
			'bbcode_match'		=> '[mod={TEXT1}]{TEXT2}[/mod]',
			'bbcode_tpl'		=> '<table class="abbc3_mod" style="background-color:#FFFFFF;border:1px solid #000000;border-collapse:separate;border-spacing:5px;padding:0;width:100%;color:#333333;overflow:hidden;"><tr><td class="abbc3_mod_icon" rowspan="2" style="background-color:#ff6060;font-weight:bold;font-family:\'Times New Roman\',Verdana,sans-serif;font-size:4em;color:#ffffff;vertical-align:middle;text-align:center;width:1%;">&nbsp;!&nbsp;</td><td class="abbc3_mod_user" style="border-bottom:1px solid #000000;font-weight:bold;">{L_MESSAGE} {L_FROM}{L_COLON} {TEXT1}</td></tr><tr><td class="abbc3_mod_text">{TEXT2}</td></tr></table>',
		),
		/* class name updated */
		'nfo' => array(
			'bbcode_helpline'	=> 'ABBC3_NFO_HELPLINE',
			'bbcode_match'		=> '[nfo]{TEXT}[/nfo]',
			'bbcode_tpl'		=> '<pre class="abbc3_nfo" style="color: #000000; font-weight: normal; line-height: normal; font-size: 10pt; font-family: Terminal, monospace; background-color: #ffffff; white-space: pre; padding: 5px;">{TEXT}</pre>',
		),
		/* class names updated */
		'offtopic' => array(
			'bbcode_helpline'	=> 'ABBC3_OFFTOPIC_HELPLINE',
			'bbcode_match'		=> '[offtopic]{TEXT}[/offtopic]',
			'bbcode_tpl'		=> '<div class="abbc3_offtopic" style="position:relative;margin:5px 0;padding:39px 19px 14px;background:#fff;border:1px solid #ddd;border-radius:4px;"><div class="abbc3_offtopic_title" style="position:absolute;top:-1px;left:-1px;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-weight:bold;font-size:12px;color:#9da0a4;background:#f5f5f5;padding:5px 12px;border:1px solid #ddd;border-radius:4px 0 4px 0;">{L_ABBC3_OFFTOPIC}</div><div class="abbc3_offtopic_text" style="padding:5px 10px;color:#333333;">{TEXT}</div></div>',
		),
		/* new tag ( old: align=right ) */
		'right' => array(
			'bbcode_helpline'	=> 'ABBC3_RIGHT_HELPLINE',
			'bbcode_match'		=> '[right]{TEXT}[/right]',
			'bbcode_tpl'		=> '<span style="text-align:right; display:block;">{TEXT}</span>',
		),
		/* class name & styles updated */
		'shadow=' => array(
			'bbcode_helpline'	=> 'ABBC3_SHADOW_HELPLINE',
			'bbcode_match'		=> '[shadow={COLOR}]{TEXT}[/shadow]',
			'bbcode_tpl'		=> '<span class="abbc3_shadow" style="display: inline; color: {COLOR}; text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.4);">{TEXT}</span>',
		),
		/* class name added */
		'soundcloud' => array(
			'bbcode_helpline'	=> 'ABBC3_SOUNDCLOUD_HELPLINE',
			'bbcode_match'		=> '[soundcloud]{URL}[/soundcloud]',
			'bbcode_tpl'		=> '<iframe class="abbc3_soundcloud" width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url={URL}&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>',
		),
		/* class names updated */
		'spoil' => array(
			'bbcode_helpline'	=> 'ABBC3_SPOILER_HELPLINE',
			'bbcode_match'		=> '[spoil]{TEXT}[/spoil]',
			'bbcode_tpl'		=> '<div class="abbc3_spoil" style="margin:5px 0;font-weight:normal;padding:4px 10px;background-color:#fff;border:1px solid #dbdbdb;border-radius:4px;color:#333333;"><div class="abbc3_spoil_title" style="margin:0;padding:0;width:100%;"><span class="abbc3_spoil_btn" style="margin:2px 5px;text-transform:uppercase;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:11px;font-weight:bold;display:block;cursor:pointer;color:#333;" data-show="{L_ABBC3_SPOILER_SHOW}" data-hide="{L_ABBC3_SPOILER_HIDE}">{L_ABBC3_SPOILER_SHOW}</span></div><div class="abbc3_spoil_text" style="color:#333333;display:none;padding:5px;border-top:1px solid #ccc;">{TEXT}</div></div>',
		),
		/* new tag */
		'table' => array(
			'bbcode_helpline'	=> 'ABBC3_TABLE_HELPLINE',
			'bbcode_match'		=> '[table]{TEXT}[/table]',
			'bbcode_tpl'		=> '<table class="abbc3_table">{TEXT}</table>',
		),
		/* new tag */
		'td' => array(
			'bbcode_helpline'	=> 'ABBC3_TD_HELPLINE',
			'bbcode_match'		=> '[td]{TEXT}[/td]',
			'bbcode_tpl'		=> '<td class="abbc3_td">{TEXT}</td>',
		),
		/* new tag */
		'tr' => array(
			'bbcode_helpline'	=> 'ABBC3_TR_HELPLINE',
			'bbcode_match'		=> '[tr]{TEXT}[/tr]',
			'bbcode_tpl'		=> '<tr class="abbc3_tr">{TEXT}</tr>',
		),
		/* tag name changed ( old: hidden ) */
		'users' => array(
			'bbcode_helpline'	=> 'ABBC3_USERS_HELPLINE',
			'bbcode_match'		=> '[users]{TEXT}[/users]',
			'bbcode_tpl'		=> '<!-- ABBC3_BBCODE_HIDDEN -->{TEXT}<!-- ABBC3_BBCODE_HIDDEN -->',
		),
	);
	
	/**
	 * Array of ABBC3 MOD BBCodes to remove
	 *
	 * @return array
	 */
	public function abbc3_bbcodes()
	{
		return array(

			// These are being replaced by new BBCodes
			'align=',			// replaced by left,right,center,justify
			// 'hidden',			// (deprecated) replaced by users

		);
	}
}
