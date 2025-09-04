<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2025 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v339_m19_update_bbcodes extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v335_m16_update_bbcodes'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['custom', [[$this, 'install_abbc3_bbcodes']]],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	protected static array $bbcode_data = [
		'offtopic' => [
			'bbcode_helpline'	=> 'ABBC3_OFFTOPIC_HELPLINE',
			'bbcode_match'		=> '[offtopic]{TEXT}[/offtopic]',
			'bbcode_tpl'		=> '<div class="abbc3-off-topic" style="display:flex;align-items:stretch;max-width:100%;margin:1em 0;border-radius:8px;overflow:hidden;color:#333;border:1px solid #ddd;"><div style="background-color:#6c757d;color:#fff;font-weight:bold;font-size:1.8em;display:flex;align-items:center;justify-content:center;padding:10px;width:60px;">ℹ</div><div style="flex:1;display:flex;flex-direction:column;"><div style="background-color:#f1f3f5;font-weight:bold;padding:8px 12px;border-bottom:1px solid #ddd;">{L_ABBC3_OFFTOPIC}</div><div style="background-color:#fff;padding:12px 12px 14px 12px;line-height:1.5;">{TEXT}</div></div></div>',
		],
		'mod=' => [
			'bbcode_helpline'	=> 'ABBC3_MOD_HELPLINE',
			'bbcode_match'		=> '[mod={TEXT1}]{TEXT2}[/mod]',
			'bbcode_tpl'		=> '<div class="abbc3-mod-alert" style="display:flex;align-items:stretch;max-width:100%;margin:1em 0;border-radius:8px;overflow:hidden;color:#333;border:1px solid #ddd;"><div style="background-color:#ff4d4f;color:#fff;font-weight:bold;font-size:2.5em;display:flex;align-items:center;justify-content:center;padding:10px;width:60px;">!</div><div style="flex:1;display:flex;flex-direction:column;"><div style="background-color:#f9f9f9;font-weight:bold;padding:8px 12px;border-bottom:1px solid #eee;">{L_MESSAGE} {L_FROM}{L_COLON} {TEXT1}</div><div style="background-color:#fff;padding:12px 12px 14px 12px;line-height:1.5;">{TEXT2}</div></div></div>',
		],
		'spoil' => [
			'bbcode_helpline'	=> 'ABBC3_SPOILER_HELPLINE',
			'bbcode_match'		=> '[spoil]{TEXT}[/spoil]',
			'bbcode_tpl'		=> '<details class="abbc3-spoiler" data-show="{L_ABBC3_SPOILER_SHOW}" data-hide="{L_ABBC3_SPOILER_HIDE}" style="background:#fff;border:1px solid #ddd;border-radius:8px;margin:1em 0;color:#333;overflow:hidden;"><summary style="display:list-item;background:#f1f3f5;font-weight:bold;cursor:pointer;padding:10px 12px;border-bottom:1px solid #ddd;outline:none;">{L_ABBC3_SPOILER_SHOW}</summary><div style="padding:12px 12px 14px 12px;line-height:1.5;">{TEXT}</div></details>',
		],
		'hidden' => array(
			'bbcode_helpline'	=> 'ABBC3_HIDDEN_HELPLINE',
			'bbcode_match'		=> '[hidden]{TEXT}[/hidden]',
			'bbcode_tpl'		=> '<xsl:choose><xsl:when test="$S_USER_LOGGED_IN and not($S_IS_BOT)"><div class="hc-box hc-box--member"><div class="hc-header"><span class="hc-lock" aria-hidden="true"></span><strong>{L_ABBC3_HIDDEN_OFF}</strong></div><div class="hc-content">{TEXT}</div></div></xsl:when><xsl:otherwise><div class="hc-box" role="group" aria-label="{L_ABBC3_HIDDEN_ON}"><div class="hc-overlay"><span class="hc-lock" aria-hidden="true"></span><div class="hc-text"><strong>{L_ABBC3_HIDDEN_ON}</strong><span>{L_ABBC3_HIDDEN_EXPLAIN}</span><div class="hc-actions"><a class="hc-btn" href="{U_LOGIN}">{L_LOGIN}</a><a class="hc-btn hc-btn--primary" href="{U_REGISTER}">{L_REGISTER}</a></div></div></div></div></xsl:otherwise></xsl:choose>',
		),
	];
}
