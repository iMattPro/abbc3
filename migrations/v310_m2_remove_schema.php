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

/**
* This migration removes old schema from 3.0
* installations of Advanced BBCode Box 3 MOD.
*/
class v310_m2_remove_schema extends \phpbb\db\migration\migration
{
	/**
	 * Run migration if abbcode column exists in the bbcodes table
	 *
	 * @return bool
	 */
	public function effectively_installed()
	{
		return !$this->db_tools->sql_column_exists($this->table_prefix . 'bbcodes', 'abbcode');
	}

	/**
	 * {@inheritdoc}
	 */
	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m1_remove_data');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'clicks',
			),

			'drop_keys'	=> array(
				$this->table_prefix . 'bbcodes'		=> array(
					'display_order',
				),
			),

			'drop_columns'		=> array(
				$this->table_prefix . 'users'		=> array(
					'user_abbcode_mod',
					'user_abbcode_compact',
				),
				$this->table_prefix . 'bbcodes'		=> array(
					'display_on_pm',
					'display_on_sig',
					'abbcode',
					'bbcode_image',
				),
			),

			'change_columns'	=> array(
				$this->table_prefix . 'bbcodes'		=> array(
					'bbcode_id'		=> array('USINT', 0),
				),
			),
		);
	}
}
