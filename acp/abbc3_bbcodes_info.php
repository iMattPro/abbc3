<?php
/**
*
* @package Advanced BBCode Box 3
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\acp;

/**
* @package module_install
*/
class abbc3_bbcodes_info
{
	function module()
	{
		return array(
			'filename'	=> '\vse\abbc3\acp\abbc3_bbcodes_module',
			'title'		=> 'ACP_ABBC3_BBCODES',
			'version'	=> '3.1.0',
			'modes'		=> array(
				'bbcodes'	=> array('title' => 'ACP_ABBC3_BBCODES', 'auth' => 'acl_a_bbcode', 'cat' => array('ACP_MESSAGES')),
			),
		);
	}
}
