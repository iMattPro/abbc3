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

class v333_m13_update_bbcodes extends bbcodes_migration_base
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
		'sup' => [
			'bbcode_helpline'	=> 'ABBC3_SUP_HELPLINE',
			'bbcode_match'		=> '[sup]{TEXT}[/sup]',
			'bbcode_tpl'		=> '<sup>{TEXT}</sup>',
		],
		'sub' => [
			'bbcode_helpline'	=> 'ABBC3_SUB_HELPLINE',
			'bbcode_match'		=> '[sub]{TEXT}[/sub]',
			'bbcode_tpl'		=> '<sub>{TEXT}</sub>',
		],
	];
}
