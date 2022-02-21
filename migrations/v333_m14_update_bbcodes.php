<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2021 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v333_m14_update_bbcodes extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v310_m5_update_bbcodes'];
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
		'marq=' => [
			'bbcode_helpline'	=> 'ABBC3_MARQUEE_HELPLINE',
			'bbcode_match'		=> '[marq={IDENTIFIER}]{TEXT}[/marq]',
			'bbcode_tpl'		=> '<div class="abbc3-marquee"><div class="abbc3-marquee-{IDENTIFIER}">{TEXT}</div></div>',
		],
	];
}
