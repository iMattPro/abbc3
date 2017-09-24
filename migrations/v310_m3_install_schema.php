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

class v310_m3_install_schema extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'bbcodes', 'bbcode_order');
	}

	/**
	 * {@inheritdoc}
	 */
	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m2_remove_schema');
	}

	/**
	 * {@inheritdoc}
	 */
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

	/**
	 * {@inheritdoc}
	 */
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
