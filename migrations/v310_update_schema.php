<?php
/**
*
* @package ABBC3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\migrations;

class v310_update_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['abbc3_version']) && version_compare($this->config['abbc3_version'], '3.1.0', '>=');
	}

	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_remove_data');
	}

	public function update_schema()
	{
		return array(
			'change_columns'	=> array(
				$this->table_prefix . 'bbcodes'		=> array(
					'bbcode_id'		=> array('USINT', 0),
				),
			),
			'add_columns'		=> array(
				$this->table_prefix . 'bbcodes'		=> array(
					'bbcode_order'	=> array('USINT', 0),
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
				),
			),
		);
	}
}
