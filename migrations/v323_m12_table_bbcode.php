<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2018 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v323_m12_table_bbcode extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return array(
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v322_m11_reparse',
		);
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

	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'delete_abbc3_bbcodes'))),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected static $bbcode_data = array(
		'pipes' => array(
			'bbcode_helpline'	=> 'ABBC3_PIPE_TABLES',
			'bbcode_match'		=> '[pipes]{TEXT}[/pipes]',
			'bbcode_tpl'		=> '{TEXT}',
			'bbcode_order'		=> 999,
		),
	);
}
