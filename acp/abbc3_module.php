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
	 * Main ACP module
	 * @throws \Exception
	 */
	public function main()
	{
		global $phpbb_container;

		$acp_controller = $phpbb_container->get('vse.abbc3.acp_controller');

		$this->tpl_name = 'acp_abbc3_settings';

		$this->page_title = $acp_controller->get_page_title();

		$acp_controller->set_u_action($this->u_action);

		try
		{
			$acp_controller->handle();
		}
		catch (\phpbb\exception\runtime_exception $e)
		{
			trigger_error($e->getMessage() . adm_back_link($this->u_action), $e->getCode());
		}
	}
}
