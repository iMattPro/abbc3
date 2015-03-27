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

class v310_m5_update_bbcodes extends \vse\abbc3\migrations_bbcode_base
{
	/**
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		return !isset($this->config['abbc3_version']);
	}

	/**
	 * {@inheritdoc}
	 */
	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m4_install_data');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return array(
			// Stop tracking the version number in the db
			array('config.remove', array('abbc3_version')),
			array('custom', array(array($this, 'install_abbc3_bbcodes'))),
		);
	}

	/**
	 * @var array An array of bbcodes data to install
	 */
	protected $bbcode_data = array(
		'pre' => array(
			'bbcode_helpline'	=> 'ABBC3_PREFORMAT_HELPLINE',
			'bbcode_match'		=> '[pre]{TEXT}[/pre]',
			'bbcode_tpl'		=> '<pre class="abbc3_pre" style="display: block; font-family: monospace; white-space: pre;">{TEXT}</pre>',
		),
		's' => array(
			'bbcode_helpline'	=> 'ABBC3_STRIKE_HELPLINE',
			'bbcode_match'		=> '[s]{TEXT}[/s]',
			'bbcode_tpl'		=> '<span class="abbc3_strike" style="text-decoration: line-through">{TEXT}</span>',
		),
		'sup' => array(
			'bbcode_helpline'	=> 'ABBC3_SUP_HELPLINE',
			'bbcode_match'		=> '[sup]{TEXT}[/sup]',
			'bbcode_tpl'		=> '<sup style="vertical-align: super; font-size: smaller;">{TEXT}</sup>',
		),
		'sub' => array(
			'bbcode_helpline'	=> 'ABBC3_SUB_HELPLINE',
			'bbcode_match'		=> '[sub]{TEXT}[/sub]',
			'bbcode_tpl'		=> '<sub style="vertical-align: sub; font-size: smaller;">{TEXT}</sub>',
		),
		'marq=' => array(
			'bbcode_helpline'	=> 'ABBC3_MARQUEE_HELPLINE',
			'bbcode_match'		=> '[marq={IDENTIFIER}]{TEXT}[/marq]',
			'bbcode_tpl'		=> '<marquee class="abbc3_marquee" direction="{IDENTIFIER}" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;" style="margin: 10px 0; padding: 5px; display: inline-block;">{TEXT}</marquee>',
		),
		'spoil' => array(
			'bbcode_helpline'	=> 'ABBC3_SPOILER_HELPLINE',
			'bbcode_match'		=> '[spoil]{TEXT}[/spoil]',
			'bbcode_tpl'		=> '<div class="spoilwrapper" style="margin:5px 0;font-weight:normal;padding:4px 10px;background-color:#fff;border:1px solid #dbdbdb;border-radius:4px;color:#333333;"><div class="spoiltitle" style="margin:0;padding:0;width:100%;"><span class="spoilbtn" style="margin:2px 5px;text-transform:uppercase;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:11px;font-weight:bold;display:block;cursor:pointer;color:#333;" data-show="{L_ABBC3_SPOILER_SHOW}" data-hide="{L_ABBC3_SPOILER_HIDE}">{L_ABBC3_SPOILER_SHOW}</span></div><div class="spoilcontent" style="color:#333333;display:none;padding:5px;border-top:1px solid #ccc;">{TEXT}</div></div>',
		),
		'offtopic' => array(
			'bbcode_helpline'	=> 'ABBC3_OFFTOPIC_HELPLINE',
			'bbcode_match'		=> '[offtopic]{TEXT}[/offtopic]',
			'bbcode_tpl'		=> '<div class="offtopic" style="position:relative;margin:5px 0;padding:39px 19px 14px;background:#fff;border:1px solid #ddd;border-radius:4px;"><div class="offtopic_title" style="position:absolute;top:-1px;left:-1px;font-family:\'Helvetica Neue\', Helvetica, Arial, sans-serif;font-weight:bold;font-size:12px;color:#9da0a4;background:#f5f5f5;padding:5px 12px;border:1px solid #ddd;border-radius:4px 0 4px 0;">{L_ABBC3_OFFTOPIC}</div><div class="offtopic_text" style="padding:5px 10px;color:#333333;">{TEXT}</div></div>',
		),
		'mod=' => array(
			'bbcode_helpline'	=> 'ABBC3_MOD_HELPLINE',
			'bbcode_match'		=> '[mod={TEXT1}]{TEXT2}[/mod]',
			'bbcode_tpl'		=> '<table class="ModTable" style="background-color:#FFFFFF;border:1px solid #000000;border-collapse:separate;border-spacing:5px;padding:0;width:100%;color:#333333;overflow:hidden;"><tr><td class="exclamation" rowspan="2" style="background-color:#ff6060;font-weight:bold;font-family:\'Times New Roman\',Verdana,sans-serif;font-size:4em;color:#ffffff;vertical-align:middle;text-align:center;width:1%;">&nbsp;!&nbsp;</td><td class="rowuser" style="border-bottom:1px solid #000000;font-weight:bold;">{L_MESSAGE} {L_FROM}{L_COLON} {TEXT1}</td></tr><tr><td class="rowtext">{TEXT2}</td></tr></table>',
		),
		'nfo' => array(
			'bbcode_helpline'	=> 'ABBC3_NFO_HELPLINE',
			'bbcode_match'		=> '[nfo]{TEXT}[/nfo]',
			'bbcode_tpl'		=> '<pre class="nfo" style="color: #000000; font-weight: normal; line-height: normal; font-size: 10pt; font-family: Terminal, monospace; background-color: #ffffff; white-space: pre; padding: 5px;">{TEXT}</pre>',
		),
	);
}
