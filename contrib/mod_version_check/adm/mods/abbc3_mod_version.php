<?php
/**
* @package: phpBB 3.0.7 :: Advanced BBCode box 3 mod version check -> root/adm/mods
* @version: $Id: abbc3_mod_version.php,  v 3.0.7 2010/03/29 10:03:29 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
*
**/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package mod_version_check
*/
class abbc3_mod_version
{
	function version()
	{
		return array(
			'author'	=> 'leviatan21',
			'title'		=> 'Advanced BBCode Box 3 (aka ABBC3)',
			'tag'		=> 'abbc3',
			'version'	=> '3.0.7',
			'file'		=> array('mssti.com', 'phpbb3', 'mssti_phpbb3x_mods.xml'),
		);
	}
}

?>