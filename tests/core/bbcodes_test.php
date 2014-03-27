<?php
/**
*
* @package Advanced BBCode Box 3.1 testing
* @copyright (c) 2014 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\tests\core;

class bbcodes_test extends \extension_database_test_case
{
	protected $db;
	protected $user;
	protected $root_path;

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/user_group.xml');
	}

	public function setUp()
	{
		global $phpbb_extension_manager, $phpbb_root_path;

		parent::setUp();

		$this->db = $this->new_dbal();
		$this->user = new \phpbb\user;
		$this->root_path = $phpbb_root_path;
		$phpbb_extension_manager = new \phpbb_mock_extension_manager(dirname(__FILE__) . '/../../../../../phpBB/');
	}

	protected function bbcodes_manager()
	{
		return new \vse\abbc3\core\bbcodes($this->db, $this->user, $this->root_path);
	}

	public function bbcode_data()
	{
		global $phpbb_root_path;

		$this->phpbb_root_path = $phpbb_root_path;

		return array(
			1 => array(
				'bbcode_tag'	=> 'sup',
				'bbcode_id'		=> 1,
				'bbcode_group'	=> '',
			),
			2 => array(
				'bbcode_tag'	=> 'sub',
				'bbcode_id'		=> 2,
				'bbcode_group'	=> '2',
			),
			3 => array(
				'bbcode_tag'	=> 'mod',
				'bbcode_id'		=> 3,
				'bbcode_group'	=> '3,4,5',
			),
		);
	}

	public function allowed_bbcodes_data()
	{
		$bbcode_data = $this->bbcode_data();

		return array(
			array(
				2, // Allowed: user 2 is member of group 2 and 6
				$bbcode_data[1], // All groups allowed
				array($bbcode_data[1]['bbcode_tag'] => array('bbcode_id' => $bbcode_data[1]['bbcode_id'])),
			),
			array(
				2, // Allowed: user 2 is member of group 2 and 6
				$bbcode_data[2], // Group 2 allowed only
				array($bbcode_data[2]['bbcode_tag'] => array('bbcode_id' => $bbcode_data[2]['bbcode_id'])),
			),
			array(
				2, // Disallowd: user 2 is member of group 2 and 6
				$bbcode_data[3], // Groups 3,4,5 allowed only
				array($bbcode_data[3]['bbcode_tag'] => array('bbcode_id' => $bbcode_data[3]['bbcode_id'], 'disabled' => true)),
			),
		);
	}

	/**
	* @dataProvider allowed_bbcodes_data
	*/
	public function test_allow_custom_bbcodes($user_id, $data, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$bbcodes_manager = $this->bbcodes_manager();

		$bbcodes = array($data['bbcode_tag'] => array('bbcode_id' => $data['bbcode_id']));
		$rowset = array($data);

		$this->assertEquals($expected, $bbcodes_manager->allow_custom_bbcodes($bbcodes, $rowset));
	}

	public function display_bbcodes_data()
	{
		$bbcode_data = $this->bbcode_data();

		return array(
			array(
				2, // Allowed: user 2 is member of group 2 and 6
				$bbcode_data[1], // All groups allowed
				array(
					'BBCODE_IMG' => $this->phpbb_root_path . 'ext/vse/abbc3/images/icons/'. $bbcode_data[1]['bbcode_tag'] .'.gif',
					'S_CUSTOM_BBCODE_ALLOWED' => true,
				),
			),
			array(
				2, // Allowed: user 2 is member of group 2 and 6
				$bbcode_data[2], // Group 2 allowed only
				array(
					'BBCODE_IMG' => $this->phpbb_root_path . 'ext/vse/abbc3/images/icons/'. $bbcode_data[2]['bbcode_tag'] .'.gif',
					'S_CUSTOM_BBCODE_ALLOWED' => true,
				),
			),
			array(
				2, // Disallowd: user 2 is member of group 2 and 6
				$bbcode_data[3], // Groups 3,4,5 allowed only
				array(
					'BBCODE_IMG' => $this->phpbb_root_path . 'ext/vse/abbc3/images/icons/'. $bbcode_data[3]['bbcode_tag'] .'.gif',
					'S_CUSTOM_BBCODE_ALLOWED' => false,
				),
			),
		);
	}

	/**
	* @dataProvider display_bbcodes_data
	*/
	public function test_display_custom_bbcodes($user_id, $data, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$bbcodes_manager = $this->bbcodes_manager();

		$custom_tags = array();

		$this->assertEquals($expected, $bbcodes_manager->display_custom_bbcodes($custom_tags, $data));
	}
}
