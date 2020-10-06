<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\migrations;

class v330_m13_acp extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		return $this->config->offsetExists('abbc3_bbcode_bar');
	}

	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return [
			'\vse\abbc3\migrations\v310_m1_remove_data',
			'\vse\abbc3\migrations\v310_m2_remove_schema',
			'\vse\abbc3\migrations\v310_m3_install_schema',
			'\vse\abbc3\migrations\v310_m4_install_data',
			'\vse\abbc3\migrations\v322_m11_reparse',
			'\vse\abbc3\migrations\v323_m12_table_bbcode',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return [
			['config.add', ['abbc3_pipes', 1]],
			['config.add', ['abbc3_bbcode_bar', 1]],
			['config.add', ['abbc3_qr_bbcodes', 0]],
			['config.add', ['abbc3_icons_type', 'png']],

			['module.add', ['acp', 'ACP_CAT_DOT_MODS', 'ACP_ABBC3_MODULE']],
			['module.add', ['acp', 'ACP_ABBC3_MODULE', [
				'module_basename'	=> '\vse\abbc3\acp\abbc3_module',
				'modes'				=> ['settings'],
			]]],
			// Add phpBB's BBCodes settings to the ABBC3 module (this for convenience to the user)
			['module.add', ['acp', 'ACP_ABBC3_MODULE', [
				'module_basename'	=> 'acp_bbcodes',
				'module_langname'	=> 'ACP_BBCODES',
				'module_mode'		=> 'bbcodes',
				'module_auth'		=> 'ext_vse/abbc3 && acl_a_bbcode',
				'after'				=> ['settings', 'ACP_ABBC3_SETTINGS'],
			]]],
		];
	}
}
