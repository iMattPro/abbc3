<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2015 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\migrations;

class v310_m6_update_bbcodes extends \vse\abbc3\migrations_bbcode_base
{
	/**
	 * {@inheritdoc}
	 */
	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_m5_update_bbcodes');
	}

	/**
	 * {@inheritdoc}
	 */
	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'install_abbc3_bbcodes'))),
		);
	}

	/**
	 * @var array An array of bbcodes data to install
	 */
	protected $bbcode_data = array(
		'soundcloud' => array(
			'bbcode_helpline'	=> 'ABBC3_SOUNDCLOUD_HELPLINE',
			'bbcode_match'		=> '[soundcloud]{URL}[/soundcloud]',
			'bbcode_tpl'		=> '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url={URL}&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>',
		),
	);
}
