<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\acp;

class abbc3_info
{
	public function module(): array
	{
		return [
			'filename'	=> '\vse\abbc3\acp\abbc3_module',
			'title'		=> 'ACP_ABBC3_MODULE',
			'modes'		=> [
				'settings'	=> [
					'title' => 'ACP_ABBC3_SETTINGS',
					'auth'  => 'ext_vse/abbc3 && acl_a_board',
					'cat'   => ['ACP_ABBC3_MODULE'],
				],
			],
		];
	}
}
