<?php
/**
*
* @package Advanced BBCode Box 3
* @version $Id$
* @copyright (c) 2010 leviatan21 (Gabriel Vazquez) and VSE (Matt Friedman)
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
			'version'	=> '3.0.13',
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