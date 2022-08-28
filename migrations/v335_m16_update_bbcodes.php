<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2022 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v335_m16_update_bbcodes extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v333_m15_google_fonts'];
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
		'font=' => [
			'bbcode_helpline'	=> 'ABBC3_FONT_HELPLINE',
			'bbcode_match'		=> '[font={INTTEXT}]{TEXT}[/font]',
			'bbcode_tpl'		=> '<span style="font-family: {INTTEXT}, sans-serif;">{TEXT}</span>',
		],
	];
}
