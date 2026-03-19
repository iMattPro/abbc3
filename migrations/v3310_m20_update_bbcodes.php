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
		return [
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v339_m19_update_bbcodes'];
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
		'highlight=' => array(
			'bbcode_helpline'	=> 'ABBC3_HIGHLIGHT_HELPLINE',
			'bbcode_match'		=> '[highlight={COLOR}]{TEXT}[/highlight]',
			'bbcode_tpl'		=> '<span class="abbc3-highlight" style="background-color: {COLOR};">{TEXT}</span>',
		),
	];
}
