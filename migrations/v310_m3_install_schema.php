<?php
/**
*
* @package Advanced BBCode Box 3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\migrations;

class v310_m3_install_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'bbcodes', 'bbcode_order');
	}

	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m2_remove_schema');
	}

	public function update_schema()
	{
		return array(
			'add_columns'		=> array(
				$this->table_prefix . 'bbcodes'		=> array(
					'bbcode_order'	=> array('USINT', 0),
					'bbcode_group'	=> array('VCHAR:255', ''),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'		=> array(
				$this->table_prefix . 'bbcodes'		=> array(
					'bbcode_order',
					'bbcode_group',
				),
			),
		);
	}
}
