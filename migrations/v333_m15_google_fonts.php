<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2022 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v333_m15_google_fonts extends bbcodes_migration_base
{
	/**
	 * {@inheritDoc}
	 */
	public function effectively_installed()
	{
		$config_text = $this->container->get('config_text');

		return $config_text->get('abbc3_google_fonts') !== null;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v333_m14_update_bbcodes'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['config_text.add', ['abbc3_google_fonts', '']],
		];
	}
}
