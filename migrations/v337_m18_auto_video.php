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

class v337_m18_auto_video extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		return $this->config->offsetExists('abbc3_auto_video');
	}

	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v330_m13_acp',
			'\vse\abbc3\migrations\v336_m17_unparse',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['config.add', ['abbc3_auto_video', 0]],
		];
	}
}
