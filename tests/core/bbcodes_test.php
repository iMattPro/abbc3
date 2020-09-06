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

class bbcodes_test extends \phpbb_database_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	protected $config;
	protected $db;
	protected $user;
	protected $root_path;
	protected $ext_manager;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/user_group.xml');
	}

	public function setUp(): void
	{
		global $phpbb_extension_manager, $phpbb_root_path, $phpEx;

		parent::setUp();

		$this->config = new \phpbb\config\config(['abbc3_icons_type' => 'png']);
		$this->db = $this->new_dbal();
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$lang = new \phpbb\language\language($lang_loader);
		$this->user = new \phpbb\user($lang, '\phpbb\datetime');
		$this->root_path = $phpbb_root_path;
		$phpbb_extension_manager = $this->ext_manager = new \phpbb_mock_extension_manager($phpbb_root_path,
			[
				'vse/abbc3' => [
					'ext_name' => 'vse/abbc3',
					'ext_active' => '1',
					'ext_path' => 'ext/vse/abbc3/',
				],
			]);
	}

	protected function bbcodes_manager()
	{
		return new \vse\abbc3\core\bbcodes_display($this->config, $this->db, $this->ext_manager, $this->user, $this->root_path);
	}

	public function bbcode_data()
	{
		return [
			1 => [
				'bbcode_tag'	=> 'sup',
				'bbcode_id'		=> 1,
				'bbcode_group'	=> '',
			],
			2 => [
				'bbcode_tag'	=> 'sub',
				'bbcode_id'		=> 2,
				'bbcode_group'	=> '2',
			],
			3 => [
				'bbcode_tag'	=> 'mod',
				'bbcode_id'		=> 3,
				'bbcode_group'	=> '3,4,5',
			],
		];
	}

	public function allowed_bbcodes_data()
	{
		$bbcode_data = $this->bbcode_data();

		return [
			[
				2, // Allowed: user 2 is member of group 2 and 6
				$bbcode_data[1], // All groups allowed
				false,
			],
			[
				2, // Allowed: user 2 is member of group 2 and 6
				$bbcode_data[2], // Group 2 allowed only
				false,
			],
			[
				2, // Disallowd: user 2 is member of group 2 and 6
				$bbcode_data[3], // Groups 3,4,5 allowed only
				true,
			],
		];
	}

	/**
	 * Test the allow_custom_bbcodes method is calling disable_bbcode()
	 * on registered bbcodes for users not in a group allowed to use it.
	 *
	 * @dataProvider allowed_bbcodes_data
	 */
	public function test_allow_custom_bbcodes($user_id, $data, $disable)
	{
		/** @var \phpbb\textformatter\s9e\parser|\PHPUnit_Framework_MockObject_MockObject $parser */
		$parser = $this->getMockBuilder('\phpbb\textformatter\s9e\parser')
			->disableOriginalConstructor()
			->getMock();
		$parser->expects(self::once())
			->method('get_parser')
			->will(self::returnSelf());
		$parser->registeredVars['abbc3.bbcode_groups'] = [
			$data['bbcode_tag'] => $data['bbcode_group'],
		];

		$parser->expects($disable ? self::once() : self::never())
			->method('disable_bbcode')
			->with($data['bbcode_tag']);

		$this->user->data['user_id'] = $user_id;

		$bbcodes_manager = $this->bbcodes_manager();

		$bbcodes_manager->allow_custom_bbcodes($parser);
	}

	public function display_bbcodes_data()
	{
		global $phpbb_root_path;

		$bbcode_data = $this->bbcode_data();

		return [
			[
				2, // User 2 is member of group 2 and 6
				[
					$bbcode_data[1], // All groups allowed
					$bbcode_data[2], // Group 2 allowed only
					$bbcode_data[3], // Groups 3,4,5 allowed only
				],
				[
					[
						'BBCODE_IMG' => $phpbb_root_path . 'ext/vse/abbc3/images/icons/'. $bbcode_data[1]['bbcode_tag'] . '.png',
						'S_CUSTOM_BBCODE_ALLOWED' => true,
					],
					[
						'BBCODE_IMG' => $phpbb_root_path . 'ext/vse/abbc3/images/icons/'. $bbcode_data[2]['bbcode_tag'] . '.png',
						'S_CUSTOM_BBCODE_ALLOWED' => true,
					],
					[
						'BBCODE_IMG' => $phpbb_root_path . 'ext/vse/abbc3/images/icons/'. $bbcode_data[3]['bbcode_tag'] . '.png',
						'S_CUSTOM_BBCODE_ALLOWED' => false,
					],
				],
			],
		];
	}

	/**
	* @dataProvider display_bbcodes_data
	*/
	public function test_display_custom_bbcodes($user_id, $data, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$bbcodes_manager = $this->bbcodes_manager();

		$custom_tags = [];

		// Test all bbcodes at once instead of one at a time
		// for full coverage of load_memberships()
		foreach ($data as $key => $bbcode_data)
		{
			self::assertEquals($expected[$key], $bbcodes_manager->display_custom_bbcodes($custom_tags, $bbcode_data));
		}
	}

	public function bbcode_group_data()
	{
		return [
			[2, '1,2,3', true],
			[2, '1', false],
			[2, '', true],
			[2, ['1', '2', '3'], true],
			[2, ['1'], false],
			[2, [], true],
			[null, null, true],
		];
	}

	/**
	* @dataProvider bbcode_group_data
	*/
	public function test_user_in_bbcode_group($user_id, $group_ids, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$bbcodes_manager = $this->bbcodes_manager();

		self::assertEquals($expected, $bbcodes_manager->user_in_bbcode_group($group_ids));
	}
}
