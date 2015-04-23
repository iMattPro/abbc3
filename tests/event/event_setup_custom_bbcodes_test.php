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

class event_setup_custom_bbcodes_test extends event_listener_base
{
	/**
	 * Test the setup_custom_bbcodes event is assigning
	 * the expected data to the template vars array.
	 */
	public function test_setup_custom_bbcodes()
	{
		$this->set_listener();

		$this->template->expects($this->once())
			->method('assign_vars')
			->with(array(
				'ABBC3_USERNAME'			=> 'admin',
				'ABBC3_BBCODE_ICONS' 		=> $this->ext_root_path . 'images/icons',
				'ABBC3_BBVIDEO_HEIGHT'		=> $this->bbvideo_height,
				'ABBC3_BBVIDEO_WIDTH'		=> $this->bbvideo_width,
				'UA_ABBC3_BBVIDEO_WIZARD'	=> 'vse_abbc3_bbcode_wizard#a:1:{s:4:"mode";s:7:"bbvideo";}',
				'UA_ABBC3_URL_WIZARD'		=> 'vse_abbc3_bbcode_wizard#a:1:{s:4:"mode";s:3:"url";}',
			));

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes', array($this->listener, 'setup_custom_bbcodes'));
		$dispatcher->dispatch('core.display_custom_bbcodes');
	}
}
