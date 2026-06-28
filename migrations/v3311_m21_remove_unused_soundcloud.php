<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\migrations;

class v3311_m21_remove_unused_soundcloud extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return ['\vse\abbc3\migrations\v3310_m20_update_bbcodes'];
	}

	/**
	 * Remove soundcloud bbcode only if this is a completely fresh install.
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
		return array(
			array('custom', array(array($this, 'delete_abbc3_bbcodes'))),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	protected static $bbcode_data = array(
		'soundcloud' => array(
			'bbcode_helpline'	=> 'ABBC3_SOUNDCLOUD_HELPLINE',
			'bbcode_match'		=> '[soundcloud]{URL}[/soundcloud]',
			'bbcode_tpl'		=> '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url={URL}&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>',
		),
	);
}
