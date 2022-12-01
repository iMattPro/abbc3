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

class acp_listener_base extends \phpbb_test_case
{
	/** @var \vse\abbc3\event\listener */
	protected $listener;

	/** @var \vse\abbc3\core\acp_manager|\PHPUnit\Framework\MockObject\MockObject */
	protected $acp_manager;

	/**
	 * Set the acp_listener object
	 */
	protected function set_listener()
	{
		global $phpbb_root_path;

		$this->acp_manager = $this->createMock('\vse\abbc3\core\acp_manager');

		$this->listener = new \vse\abbc3\event\acp_listener($this->acp_manager, $phpbb_root_path);
	}
}
