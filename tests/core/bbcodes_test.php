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

	public function getDataSet()
	{
		return $this->createXMLDataSet(dirname(__FILE__) . '/fixtures/user_group.xml');
	}

	public function setUp()
	{
		global $phpbb_root_path;

		parent::setUp();

		$this->db = $this->new_dbal();
		$this->user = new \phpbb\user;
	}

	protected function bbcodes_manager()
	{
		return new \vse\abbc3\core\bbcodes($this->db, $this->user, $phpbb_root_path);
	}

	public function bbcode_data()
	{
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
				array('sup' => array('bbcode_id' => 1)),
			),
			array(
				2, // Allowed: user 2 is member of group 2 and 6
				$bbcode_data[2], // Group 2 allowed only
				array('sub' => array('bbcode_id' => 2)),
			),
			array(
				2, // Disallowd: user 2 is member of group 2 and 6
				$bbcode_data[3], // Groups 3,4,5 allowed only
				array('mod' => array('bbcode_id' => 3, 'disabled' => true)),
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

// 	public function display_bbcodes_data()
// 	{
// 		$bbcode_data = $this->bbcode_data();
// 
// 		return array(
// 			array(
// 				2, // Allowed: user 2 is member of group 2 and 6
// 				$bbcode_data[1], // All groups allowed
// 				array(
// 					'BBCODE_IMG' => './ext/vse/abbc3/images/icons/sup.gif',
// 					'S_CUSTOM_BBCODE_ALLOWED' => true,
// 				),
// 			),
// 			array(
// 				2, // Allowed: user 2 is member of group 2 and 6
// 				$bbcode_data[2], // Group 2 allowed only
// 				array(
// 					'BBCODE_IMG' => './ext/vse/abbc3/images/icons/sub.gif',
// 					'S_CUSTOM_BBCODE_ALLOWED' => true,
// 				),
// 			),
// 			array(
// 				2, // Disallowd: user 2 is member of group 2 and 6
// 				$bbcode_data[3], // Groups 3,4,5 allowed only
// 				array(
// 					'BBCODE_IMG' => './ext/vse/abbc3/images/icons/mod.gif',
// 					'S_CUSTOM_BBCODE_ALLOWED' => false,
// 				),
// 			),
// 		);
// 	}

	/**
	* @dataProvider display_bbcodes_data
	*/
// 	public function test_display_custom_bbcodes($user_id, $data, $expected)
// 	{
// 		$this->markTestSkipped('unable to get images for bbcode icons');
// 
// 		$this->user->data['user_id'] = $user_id;
// 
// 		$bbcodes_manager = $this->bbcodes_manager();
// 
// 		$custom_tags = array();
// 
// 		$this->assertEquals($expected, $bbcodes_manager->display_custom_bbcodes($custom_tags, $data));
// 	}
}
