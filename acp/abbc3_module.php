<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020, 2023 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\acp;

class abbc3_module
{
	/** @var string */
	public $page_title;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $u_action;

	/**
	 * Run the ACP controller and send its notices and warnings through phpBB.
	 *
	 * @throws \Throwable If the controller fails unexpectedly
	 */
	public function main()
	{
		global $phpbb_container;

		$this->tpl_name = 'acp_abbc3_settings';
		$this->page_title = 'ACP_ABBC3_SETTINGS';

		try
		{
			$phpbb_container->get('vse.abbc3.acp_controller')
				->set_u_action($this->u_action)
				->handle();
		}
		catch (\RuntimeException $e)
		{
			if (!in_array($e->getCode(), [E_USER_NOTICE, E_USER_WARNING], true))
			{
				throw $e;
			}

			trigger_error($e->getMessage() . adm_back_link($this->u_action), $e->getCode());
		}
	}
}
