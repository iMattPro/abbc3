<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\migrations;

class v340_m22_normalize extends \phpbb\db\migration\migration
{
	// effectively_installed() guard intentionally omitted

	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return ['\vse\abbc3\migrations\v340_m21_toolbar'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_schema()
	{
		return [
			'drop_columns' => [
				$this->table_prefix . 'bbcodes' => ['bbcode_order', 'bbcode_group'],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function revert_schema()
	{
		return [
			'add_columns' => [
				$this->table_prefix . 'bbcodes' => [
					'bbcode_order' => ['USINT', 0],
					'bbcode_group' => ['VCHAR:255', ''],
				],
			],
		];
	}
}
