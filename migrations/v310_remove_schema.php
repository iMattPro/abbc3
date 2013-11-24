<?php
/**
*
* @package ABBC3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\migrations;

class v310_remove_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return !$this->db_tools->sql_column_exists($this->table_prefix . 'bbcodes', 'abbcode');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'clicks',
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
//					'bbcode_order',
//					'bbcode_group',
				),
			),
		);
	}
}
