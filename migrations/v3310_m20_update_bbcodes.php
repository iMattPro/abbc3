<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2026 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v3310_m20_update_bbcodes extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return ['\vse\abbc3\migrations\v339_m19_update_bbcodes'];
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
	protected static $bbcode_data = [
		// I replaced the emoji in the previous migration already, so this update is just to ensure
		// removal of that emoji from boards that installed the previous migration before I replaced it
		'offtopic' => [
			'bbcode_helpline'	=> 'ABBC3_OFFTOPIC_HELPLINE',
			'bbcode_match'		=> '[offtopic]{TEXT}[/offtopic]',
			'bbcode_tpl'		=> '<div class="abbc3-off-topic" style="display:flex;align-items:stretch;max-width:100%;margin:1em 0;border-radius:8px;overflow:hidden;color:#333;border:1px solid #ddd;"><div style="background-color:#6c757d;color:#fff;font-weight:bold;font-size:1.8em;display:flex;align-items:center;justify-content:center;padding:10px;width:60px;">&#8505;</div><div style="flex:1;display:flex;flex-direction:column;"><div style="background-color:#f1f3f5;font-weight:bold;padding:8px 12px;border-bottom:1px solid #ddd;">{L_ABBC3_OFFTOPIC}</div><div style="background-color:#fff;padding:12px 12px 14px 12px;line-height:1.5;">{TEXT}</div></div></div>',
		],
	];
}
