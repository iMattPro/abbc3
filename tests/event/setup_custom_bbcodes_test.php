<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

use vse\abbc3\ext;

class setup_custom_bbcodes_test extends listener_base
{
	/**
	 * Test the setup_custom_bbcodes event is assigning
	 * the expected data to the template vars array.
	 */
	public function test_setup_custom_bbcodes()
	{
		$this->set_listener();

		$this->bbcodes_display
			->method('get_icons')
			->willReturn(['foo' => 'path/to/foo']);

		$this->template->expects(self::once())
			->method('assign_vars')
			->with([
				'ABBC3_BBCODE_ICONS' 		=> ['foo' => 'path/to/foo'],
				'ABBC3_BBCODE_FONTS'		=> ext::ABBC3_BBCODE_FONTS,
				'S_ABBC3_BBCODES_BAR'		=> $this->config['abbc3_bbcode_bar'],
				'UA_ABBC3_BBVIDEO_WIZARD'	=> 'vse_abbc3_bbcode_wizard#a:1:{s:4:"mode";s:7:"bbvideo";}',
				'UA_ABBC3_PIPES_WIZARD'		=> 'vse_abbc3_bbcode_wizard#a:1:{s:4:"mode";s:5:"pipes";}',
				'UA_ABBC3_URL_WIZARD'		=> 'vse_abbc3_bbcode_wizard#a:1:{s:4:"mode";s:3:"url";}',
			]);

		$dispatcher = new \phpbb\event\dispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes', [$this->listener, 'setup_custom_bbcodes']);
		$dispatcher->trigger_event('core.display_custom_bbcodes');
	}
}
