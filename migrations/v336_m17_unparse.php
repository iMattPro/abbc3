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

class v336_m17_unparse extends \phpbb\db\migration\container_aware_migration
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
		// Check if very first migration was skipped (proves we're not updating ABBC3 3.0)
		$sql = 'SELECT 1 as no_30
			FROM ' . $this->table_prefix . "migrations
			WHERE migration_name = '\\\\vse\\\\abbc3\\\\migrations\\\\v310_m1_remove_data'
				AND migration_start_time = 0
				AND migration_end_time = 0";
		$result = $this->db->sql_query_limit($sql, 1);
		$no_30 = (bool) $this->db->sql_fetchfield('no_30');
		$this->db->sql_freeresult($result);

		// Check if any ABBC3 v310 migrations were installed less than a minute ago (proves we're not updating ABBC3 3.1)
		$sql = 'SELECT 1 as fresh_install
			FROM ' . $this->table_prefix . 'migrations
			WHERE migration_name ' . $this->db->sql_like_expression('\\\\vse\\\\abbc3\\\\migrations\\\\v310' . $this->db->get_any_char()) . '
				AND migration_start_time >= ' . (time() - 60);
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
			]],
			['if', [
				$this->config->offsetExists('text_reparser.post_text_last_cron') && $this->config->offsetGet('text_reparser.post_text_last_cron') == 0,
				['config.remove', ['text_reparser.post_text_last_cron']],
			]],
			['if', [
				!$this->config->offsetExists('text_reparser.pm_text_last_cron'),
				['config.remove', ['text_reparser.pm_text_cron_interval']],
			]],
			['if', [
				!$this->config->offsetExists('text_reparser.post_text_last_cron'),
				['config.remove', ['text_reparser.post_text_cron_interval']],
			]],
			['custom', [[$this, 'clear_reparsers']]],
		];
	}

	/**
	 * Prevent CLI command from wanting to run post and pm re-parsers
	 * after ABBC3 installation.
	 *
	 * @return void
	 */
	public function clear_reparsers()
	{
		/** @var \phpbb\textreparser\manager $reparser_manager */
		$reparser_manager = $this->container->get('text_reparser.manager');

		/** @var \phpbb\di\service_collection $reparsers */
		$reparsers = $this->container->get('text_reparser_collection');

		foreach ($reparsers as $name => $reparser)
		{
			if (in_array($name, ['text_reparser.post_text', 'text_reparser.pm_text']))
			{
				$resume_data = $reparser_manager->get_resume_data($name);

				if (!empty($resume_data['range-max']))
				{
					$reparser_manager->update_resume_data($name, 1, 0, 100);
				}
			}
		}
	}
}
