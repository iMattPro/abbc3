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

use Exception;
use RuntimeException;

class abbc3_module
{
	/** @var string */
	public string $page_title = '';

	/** @var string */
	public string $tpl_name = '';

	/** @var string */
	public string $u_action = '';

	/**
	 * Main ACP module
	 */
	public function main(): void
	{
		global $phpbb_container;

		$this->tpl_name = 'acp_abbc3_settings';
		$this->page_title = 'ACP_ABBC3_SETTINGS';

		try
		{
			$controller = $phpbb_container->get('vse.abbc3.acp_controller');
			$controller->set_u_action($this->u_action)
				->handle();
		}
		catch (RuntimeException $e)
		{
			trigger_error($e->getMessage() . adm_back_link($this->u_action), $e->getCode());
		}
		catch (Exception $e)
		{
			trigger_error($e->getMessage() . adm_back_link($this->u_action), E_USER_WARNING);
		}
	}
}
