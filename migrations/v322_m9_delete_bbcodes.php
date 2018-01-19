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

class v322_m9_delete_bbcodes extends bbcodes_migration_base
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m4_install_data');
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
		'youtube' => array(
			'bbcode_helpline'	=> 'ABBC3_YOUTUBE_HELPLINE',
			'bbcode_match'		=> '[youtube]{URL}[/youtube]',
			'bbcode_tpl'		=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,315">{URL}</a>',
		),
	);
}
