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

/**
 * Class disable_bbcodes
 *
 * This is a specialized migration. It will set original (un-altered) ABBC3 BBCodes
 * to be hidden from the posting pages when ABBC3 is removed. This will make it look
 * like the default phpBB BBCode toolbar again, but ABBC3 BBCodes are not deleted
 * so posts won't suddenly break. Users can manually re-enable the BBCodes they want to keep,
 * delete the one's they do not, etc. If ABBC3 is re-installed again, it will attempt
 * to re-enable them in the BBCode toolbar, restoring the ABBC3 BBCode toolbar appearance.
 *
 * @package vse\abbc3\migrations
 */
class disable_bbcodes extends container_aware_migration
{
	/** @var \phpbb\config\db_text */
	protected $configText;

	/**
	 * {@inheritDoc}
	 */
	public function effectively_installed()
	{
		return $this->getConfigText()->get('abbc3_bbcodes') === null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['custom', [[$this, 'display_bbcodes_on']]],
			['config_text.remove', ['abbc3_bbcodes']],
		];
	}

	/**
	 * {@inheritdoc}
	 *
	 * This will leave behind an entry in the config_text table storing the
	 * IDs of the BBCodes that were hidden after uninstalling this extension.
	 * This data is used so if this extension is re-installed at a later time,
	 * it can re-display on posting page only the BBCodes it has hidden.
	 */
	public function revert_data()
	{
		return [
			['custom', [[$this, 'display_bbcodes_off']]], // using a custom func because config_text.add was being called twice
		];
	}

	/**
	 * Get ABBC3 BBCodes that were disabled from a previous extension purge,
	 * and re-display them on post.
	 */
	public function display_bbcodes_on()
	{
		$bbcodes = json_decode($this->getConfigText()->get('abbc3_bbcodes'), true);

		if (is_array($bbcodes))
		{
			$bbcodes = array_map('intval', $bbcodes);

			$this->update_displayed_bbcodes($bbcodes, true);
		}
	}

	/**
	 * Set ABBC3 BBCodes Display on Post to 0 so they will no longer
	 * appear in posting buttons when extension is purged.
	 */
	public function display_bbcodes_off()
	{
		$bbcodes = [];

		$sql = 'SELECT bbcode_id 
			FROM ' . BBCODES_TABLE . '
			WHERE display_on_posting = 1
				AND bbcode_helpline ' . $this->db->sql_like_expression('ABBC3_' . $this->db->get_any_char());
		$this->db->sql_query($sql);
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$bbcodes[] = $row['bbcode_id'];
		}
		$this->db->sql_freeresult($result);

		$this->update_displayed_bbcodes($bbcodes, false);

		$this->getConfigText()->set('abbc3_bbcodes', json_encode($bbcodes));
	}

	/**
	 * Update the display on posting state for custom BBCodes
	 *
	 * @param array $bbcodes
	 * @param bool  $display
	 */
	protected function update_displayed_bbcodes(array $bbcodes, $display)
	{
		if (!empty($bbcodes))
		{
			$sql = 'UPDATE ' . BBCODES_TABLE . '
				SET display_on_posting = ' . (int) $display . '
				WHERE ' . $this->db->sql_in_set('bbcode_id', $bbcodes);
			$this->db->sql_query($sql);
		}
	}

	/**
	 * Get the config text object
	 *
	 * @return \phpbb\config\db_text
	 */
	protected function getConfigText()
	{
		if ($this->configText === null)
		{
			$this->configText = $this->container->get('config_text');
		}

		return $this->configText;
	}
}
