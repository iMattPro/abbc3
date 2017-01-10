<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

class acp_install_bbcodes_test extends acp_base
{
	public function install_bbcodes_data()
	{
		return array(
			array(array(
				'foo' => array( // new
					'bbcode_helpline'	=> 'ABBC3_FOO_HELPLINE',
					'bbcode_match'		=> '[foo]{TEXT}[/foo]',
					'bbcode_tpl'		=> '<span class="foo">{TEXT}</span>',
				),
				'bar' => array( // new
					'bbcode_helpline'	=> 'ABBC3_BAR_HELPLINE',
					'bbcode_match'		=> '[bar]{TEXT}[/bar]',
					'bbcode_tpl'		=> '<span class="bar">{TEXT}</span>',
				),
				'align=' => array( // update
					'bbcode_helpline'	=> 'ABBC3_ALIGN_HELPLINE',
					'bbcode_match'		=> '[align={IDENTIFIER}]{TEXT}[/align]',
					'bbcode_tpl'		=> '<span class="align-{IDENTIFIER}">{TEXT}</span>',
				),
				'sup' => array( // update
					'bbcode_helpline'	=> 'ABBC3_SUP_HELPLINE',
					'bbcode_match'		=> '[sup]{TEXT}[/sup]',
					'bbcode_tpl'		=> '<span class="sup">{TEXT}</span>',
				),
			)),
		);
	}

	/**
	* @dataProvider install_bbcodes_data
	*/
	public function test_install_bbcodes($data)
	{
		global $phpbb_root_path, $phpEx;

		$bbcodes_installer = new \vse\abbc3\core\bbcodes_installer(
			$this->db,
			$this->group_helper,
			$this->request,
			$this->user,
			$phpbb_root_path,
			$phpEx
		);

		$bbcodes_installer->install_bbcodes($data);

		foreach ($data as $bbcode_tag => $bbcode_data)
		{
			$sql = "SELECT bbcode_helpline, bbcode_match, bbcode_tpl
				FROM phpbb_bbcodes
				WHERE bbcode_tag = '" . $bbcode_tag . "'";
			$result = $this->db->sql_query($sql);

			$this->assertEquals($bbcode_data, $this->db->sql_fetchrow($result));
		}
	}

	/**
	 * @dataProvider install_bbcodes_data
	 */
	public function test_clean_install_bbcodes($data)
	{
		// Remove any existing bbcodes from database
		$this->db->sql_query('DELETE FROM phpbb_bbcodes');

		$this->test_install_bbcodes($data);
	}
}
