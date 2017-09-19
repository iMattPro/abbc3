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

class v320_m8_update_bbcodes extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m7_update_bbcodes');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'install_abbc3_bbcodes'))),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected static $bbcode_data = array(
		'align=center' => array(
			'bbcode_helpline'	=> 'ABBC3_ALIGN_HELPLINE',
			'bbcode_match'		=> '[align={IDENTIFIER}]{TEXT}[/align]',
			'bbcode_tpl'		=> '<div style="text-align:{IDENTIFIER};">{TEXT}</div>',
		),
	);
}
