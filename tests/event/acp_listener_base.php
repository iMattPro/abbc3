<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\event;

use phpbb_test_case;
use PHPUnit\Framework\MockObject\MockObject;
use vse\abbc3\core\acp_manager;
use vse\abbc3\event\acp_listener;

class acp_listener_base extends phpbb_test_case
{
	/** @var acp_listener */
	protected acp_listener $listener;

	/** @var acp_manager|MockObject */
	protected acp_manager|MockObject $acp_manager;

	/**
	 * Set the acp_listener object
	 */
	protected function set_listener(): void
	{
		global $phpbb_root_path;

		$this->acp_manager = $this->createMock(acp_manager::class);

		$this->listener = new acp_listener($this->acp_manager, $phpbb_root_path);
	}
}
