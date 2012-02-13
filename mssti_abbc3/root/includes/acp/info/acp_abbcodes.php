<?php
/**
* @package: phpBB :: Advanced BBCode Box 3 -> root/includes/acp/info
* @version: $Id: acp_abbcode.php, v 3.0.11 2/12/12 8:07 PM VSE Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel)
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @co-author: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
**/

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
			'version'	=> '3.0.10',
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