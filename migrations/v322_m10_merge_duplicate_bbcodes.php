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

use phpbb\db\migration\container_aware_migration;

class v322_m10_merge_duplicate_bbcodes extends container_aware_migration
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v310_m5_update_bbcodes',
			'\vse\abbc3\migrations\v310_m6_update_bbcodes',
			'\vse\abbc3\migrations\v310_m7_update_bbcodes',
			'\vse\abbc3\migrations\v322_m8_update_bbcodes',
			'\vse\abbc3\migrations\v322_m9_delete_bbcodes',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['custom', [[$this, 'update_bbcodes_table']]],
		];
	}

	/**
	 * Copied from Core migrations
	 */
	public function update_bbcodes_table()
	{
		$sql     = 'SELECT bbcode_id, bbcode_tag, bbcode_helpline, bbcode_match, bbcode_tpl FROM ' . BBCODES_TABLE;
		$result  = $this->sql_query($sql);
		$bbcodes = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$variant = (substr($row['bbcode_tag'], -1) === '=') ? 'with' : 'without';
			$bbcode_name = strtolower(rtrim($row['bbcode_tag'], '='));
			$bbcodes[$bbcode_name][$variant] = $row;
		}
		$this->db->sql_freeresult($result);

		foreach ($bbcodes as $bbcode_name => $variants)
		{
			if (count($variants) === 2)
			{
				$this->merge_bbcodes($variants['without'], $variants['with']);
			}
		}
	}

	/**
	 * Copied from Core migrations
	 */
	protected function merge_bbcodes(array $without, array $with)
	{
		$merged = $this->container->get('text_formatter.s9e.bbcode_merger')->merge_bbcodes(
			[
				'usage'    => $without['bbcode_match'],
				'template' => $without['bbcode_tpl']
			],
			[
				'usage'    => $with['bbcode_match'],
				'template' => $with['bbcode_tpl']
			]
		);
		$bbcode_data = [
			'bbcode_tag'      => $without['bbcode_tag'],
			'bbcode_helpline' => $without['bbcode_helpline'] . ' | ' . $with['bbcode_helpline'],
			'bbcode_match'    => $merged['usage'],
			'bbcode_tpl'      => $merged['template']
		];

		$sql = 'UPDATE ' . BBCODES_TABLE . '
			SET ' . $this->db->sql_build_array('UPDATE', $bbcode_data) . '
			WHERE bbcode_id = ' . (int) $without['bbcode_id'];
		$this->sql_query($sql);

		$sql = 'DELETE FROM ' . BBCODES_TABLE . '
			WHERE bbcode_id = ' . (int) $with['bbcode_id'];
		$this->sql_query($sql);
	}
}
