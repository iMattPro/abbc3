<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\migrations;

class v3312_m23_toolbar_integrity extends \phpbb\db\migration\migration
{
	public static function depends_on()
	{
		return ['\vse\abbc3\migrations\v3312_m22_normalize'];
	}

	public function update_data()
	{
		return [
			['custom', [[$this, 'normalize_toolbar_bbcodes']]],
		];
	}

	public function normalize_toolbar_bbcodes()
	{
		$table = $this->table_prefix . 'abbc3_toolbar';
		$sql = 'SELECT t.button_key, t.bbcode_id, b.bbcode_tag
			FROM ' . $table . ' t
			JOIN ' . BBCODES_TABLE . ' b ON b.bbcode_id = t.bbcode_id
			WHERE t.button_type = \'bbcode\'
			ORDER BY t.bbcode_id, t.button_key';
		$result = $this->db->sql_query($sql);
		$rows = [];
		while ($row = $this->db->sql_fetchrow($result))
		{
			$rows[(int) $row['bbcode_id']][] = $row;
		}
		$this->db->sql_freeresult($result);

		foreach ($rows as $bbcode_id => $buttons)
		{
			$desired_key = 'bbcode:' . strtolower(rtrim($buttons[0]['bbcode_tag'], '='));
			$keeper = $buttons[0]['button_key'];
			foreach ($buttons as $button)
			{
				if ($button['button_key'] === $desired_key)
				{
					$keeper = $desired_key;
					break;
				}
			}

			foreach ($buttons as $button)
			{
				if ($button['button_key'] !== $keeper)
				{
					$this->db->sql_query('DELETE FROM ' . $table . "
						WHERE button_key = '" . $this->db->sql_escape($button['button_key']) . "'");
				}
			}

			if ($keeper !== $desired_key)
			{
				$this->db->sql_query('UPDATE ' . $table . "
					SET button_key = '" . $this->db->sql_escape($desired_key) . "'
					WHERE bbcode_id = " . (int) $bbcode_id);
			}
		}
	}
}
