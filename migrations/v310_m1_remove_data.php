<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\migrations;

/**
* This migration removes old data from 3.0
* installations of Advanced BBCode Box 3 MOD.
*/
class v310_m1_remove_data extends \phpbb\db\migration\container_aware_migration
{
	/**
	 * Run migration if ABBC3_VERSION config exists
	 *
	 * @return bool
	 */
	public function effectively_installed()
	{
		return !isset($this->config['ABBC3_VERSION']);
	}

	/**
	 * This dependency is needed mostly for testing, to ensure
	 * phpBB migrations are installed before ABBC3.
	 *
	 * @return array An array of migration class names
	 */
	public static function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\beta4');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		// use module tool explicitly since module.exists does not work in 'if'
		$module_tool = $this->container->get('migrator.tool.module');

		return array(
			array('if', array(
				$module_tool->exists('acp', false, 'ACP_ABBC3_BBCODES', true),
				array('module.remove', array('acp', false, 'ACP_ABBC3_BBCODES')),
			)),
			array('if', array(
				$module_tool->exists('acp', false, 'ACP_ABBC3_SETTINGS', true),
				array('module.remove', array('acp', false, 'ACP_ABBC3_SETTINGS')),
			)),
			array('if', array(
				$module_tool->exists('acp', false, 'ACP_ABBCODES', true),
				array('module.remove', array('acp', false, 'ACP_ABBCODES')),
			)),

			// Custom functions
			array('custom', array(array($this, 'remove_abbc3_configs'))),
			array('custom', array(array($this, 'remove_abbc3_bbcodes'))),
		);
	}

	/**
	 * Remove config data from ABBC3 MOD
	 */
	public function remove_abbc3_configs()
	{
		$sql = 'DELETE FROM ' . $this->table_prefix . 'config
			WHERE config_name ' . $this->db->sql_like_expression('ABBC3_' . $this->db->get_any_char());
		$this->db->sql_query($sql);
	}

	/**
	 * Remove BBCodes from ABBC3 MOD
	 */
	public function remove_abbc3_bbcodes()
	{
		$abbc3_bbcode_deprecated = $this->abbc3_bbcodes();

		// Add all breaks and divisions to the array
		$sql = 'SELECT bbcode_tag
			FROM ' . $this->table_prefix . 'bbcodes
			WHERE bbcode_tag ' . $this->db->sql_like_expression('break' . $this->db->get_any_char()) . '
			OR bbcode_tag ' . $this->db->sql_like_expression('division' . $this->db->get_any_char());

		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$abbc3_bbcode_deprecated[] = $row['bbcode_tag'];
		}
		$this->db->sql_freeresult($result);

		// Delete all the unwanted BBCodes
		$sql = 'DELETE FROM ' . $this->table_prefix . 'bbcodes
			WHERE ' . $this->db->sql_in_set('bbcode_tag', $abbc3_bbcode_deprecated) . '
			OR bbcode_id < 0';
		$this->db->sql_query($sql);
	}

	/**
	 * Array of ABBC3 MOD BBCodes to remove
	 *
	 * @return array
	 */
	public function abbc3_bbcodes()
	{
		return array(
			// These exist in core
			'b',
			'code',
			'color',
			'email',
			'flash',
			'i',
			'img=',
			'listb',
			'listitem',
			'listo',
			'quote',
			'size',
			'u',
			'url',
			'url=',

			// These were not really BBCodes
			'copy',
			'cut',
			'grad',
			'paste',
			'plain',
			'imgshack',

			// These are deprecated
			'click',
			'ed2k',
			'flv',
			'quicktime',
			'ram',
			'rapidshare',
			'stream',
			'testlink',
			'video',
			'wave=',
			'web',
			'scrippet',
			'search',
			'thumbnail',
			'hr',
			'tab=',
			'tabs',
			'table=',
			'anchor=',
			'upload',
			'html',
			'collegehumor',
			'dm',
			'gamespot',
			'ignvideo',
			'liveleak',
			'veoh',

			// These are being replaced by new BBCodes
			'align=justify',	// replaced by align=
			'align=left',		// replaced by align=
			'align=right',		// replaced by align=
			'dir=rtl',			// replaced by dir=
			'marq=down',		// replaced by marq=
			'marq=left',		// replaced by marq=
			'marq=right',		// replaced by marq=
		);
	}
}
