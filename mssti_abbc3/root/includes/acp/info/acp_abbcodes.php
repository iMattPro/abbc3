<?php
/**
*
* @package acp
* @copyright (c) 2012 MSSTI Advanced BBCodes Box 3 by leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @package module_install
*/
class acp_abbcodes_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_abbcodes',
			'title'		=> 'ACP_ABBCODES',
			'version'	=> '3.0.11',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_ABBC3_SETTINGS', 'auth' => 'acl_a_styles', 'cat' => array('ACP_ABBCODES')),
				'bbcodes'	=> array('title' => 'ACP_ABBC3_BBCODES' , 'auth' => 'acl_a_bbcode', 'cat' => array('ACP_ABBCODES')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>