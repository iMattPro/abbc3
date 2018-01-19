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

class v322_disable_bbcodes extends container_aware_migration
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return array(
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v310_m5_update_bbcodes',
			'\vse\abbc3\migrations\v310_m6_update_bbcodes',
			'\vse\abbc3\migrations\v310_m7_update_bbcodes',
			'\vse\abbc3\migrations\v322_m8_update_bbcodes',
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function revert_data()
	{
		return array(
			array('custom', array(array($this, 'disable_bbcodes'))),
		);
	}
	/**
	 * Set ABBC3 BBCodes Display on Post to 0 so they will no longer
	 * appear in posting buttons when extension is purged. Users can manage
	 * themselves and decide if they want to keep or delete any of the BBCodes.
	 */
	public function disable_bbcodes()
	{
		$sql = 'UPDATE ' . BBCODES_TABLE . '
			SET display_on_posting = 0
			WHERE ' . $this->db->sql_in_set('bbcode_tag', [
				'font=', 'highlight=', 'align=', 'float=', 'pre', 's', 'sup', 'sub',
				'glow=', 'shadow=', 'dropshadow=', 'blur=', 'fade', 'dir=', 'marq=',
				'spoil', 'hidden', 'offtopic', 'mod=', 'nfo', 'soundcloud', 'BBvideo=',
			]);
		$this->db->sql_query($sql);
	}
}
