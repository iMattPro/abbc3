<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2023 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\migrations;

class v336_m17_unparse extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v322_m11_reparse',
		];
	}

	/**
	 * We don't need to reparse posts if this is a completely fresh install, so
	 * this migration will check for that and if it is totally fresh, it will undo
	 * the changes from v322_m11_reparse.
	 *
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		$sql = 'SELECT 1 as no_30
			FROM ' . $this->table_prefix . "migrations
			WHERE migration_name = '\\\\vse\\\\abbc3\\\\migrations\\\\v310_m1_remove_data'
				AND migration_start_time = 0
				AND migration_start_time = 0";
		$result = $this->db->sql_query_limit($sql, 1);
		$no_30 = (bool) $this->db->sql_fetchfield('no_30');
		$this->db->sql_freeresult($result);

		$sql = 'SELECT 1 as fresh_install
			FROM ' . $this->table_prefix . 'migrations
			WHERE migration_name ' . $this->db->sql_like_expression('\\\\vse\\\\abbc3\\\\migrations\\\\v310' . $this->db->get_any_char()) . '
				AND migration_start_time >= ' . (time() - 180) . '
				AND migration_start_time <= ' . (time() + 180);
		$result = $this->db->sql_query_limit($sql, 1);
		$fresh_install = (bool) $this->db->sql_fetchfield('fresh_install');
		$this->db->sql_freeresult($result);

		return !($no_30 && $fresh_install);
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['config.remove', ['abbc3_reparse']],
			['if', [
				$this->config->offsetExists('text_reparser.pm_text_last_cron') && $this->config->offsetGet('text_reparser.pm_text_last_cron') == 0,
				['config.remove', ['text_reparser.pm_text_last_cron']],
				['config.remove', ['text_reparser.pm_text_cron_interval']],
			]],
			['if', [
				$this->config->offsetExists('text_reparser.post_text_last_cron') && $this->config->offsetGet('text_reparser.post_text_last_cron') == 0,
				['config.remove', ['text_reparser.post_text_last_cron']],
				['config.remove', ['text_reparser.post_text_cron_interval']],
			]],
		];
	}
}
