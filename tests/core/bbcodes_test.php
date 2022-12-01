<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\core;

class bbcodes_test extends \phpbb_database_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	/** @var \PHPUnit\Framework\MockObject\MockObject|\phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $root_path;

	/** @var \phpbb_mock_extension_manager */
	protected $ext_manager;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/user_group.xml');
	}

	protected function setUp(): void
	{
		global $phpbb_extension_manager, $phpbb_root_path, $phpEx;

		parent::setUp();

		$this->auth = $this->createMock('\phpbb\auth\auth');
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
		return new \vse\abbc3\core\bbcodes_display($this->auth, $this->config, $this->db, $this->ext_manager, $this->user, $this->root_path);
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
	 * @param $user_id
	 * @param $data
	 * @param $disable
	 */
	public function test_allow_custom_bbcodes($user_id, $data, $disable)
	{
		/** @var \s9e\TextFormatter\Parser|\PHPUnit\Framework\MockObject\MockObject $parser */
		$parser = $this->createMock('\s9e\TextFormatter\Parser');
		$parser->registeredVars['abbc3.bbcode_groups'] = [
			$data['bbcode_tag'] => $data['bbcode_group'],
		];

		/** @var \phpbb\textformatter\s9e\parser|\PHPUnit\Framework\MockObject\MockObject $service */
		$service = $this->createMock('\phpbb\textformatter\s9e\parser');
		$service->expects($disable ? self::once() : self::never())
			->method('disable_bbcode')
			->with($data['bbcode_tag']);
		$service->expects(self::once())
			->method('get_parser')
			->willReturn($parser);

		$this->user->data['user_id'] = $user_id;

		$bbcodes_manager = $this->bbcodes_manager();

		$bbcodes_manager->allow_custom_bbcodes($service);
	}

	public function display_bbcodes_data()
	{
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
						'BBCODE_IMG' => 'ext/vse/abbc3/images/icons/'. $bbcode_data[1]['bbcode_tag'] . '.png',
						'S_CUSTOM_BBCODE_ALLOWED' => true,
					],
					[
						'BBCODE_IMG' => 'ext/vse/abbc3/images/icons/'. $bbcode_data[2]['bbcode_tag'] . '.png',
						'S_CUSTOM_BBCODE_ALLOWED' => true,
					],
					[
						'BBCODE_IMG' => 'ext/vse/abbc3/images/icons/'. $bbcode_data[3]['bbcode_tag'] . '.png',
						'S_CUSTOM_BBCODE_ALLOWED' => false,
					],
				],
			],
		];
	}

	/**
	 * @dataProvider display_bbcodes_data
	 * @param $user_id
	 * @param $data
	 * @param $expected
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
	 * @param $user_id
	 * @param $group_ids
	 * @param $expected
	 */
	public function test_user_in_bbcode_group($user_id, $group_ids, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$bbcodes_manager = $this->bbcodes_manager();

		self::assertEquals($expected, $bbcodes_manager->user_in_bbcode_group($group_ids));
	}

	public function bbcode_statuses_test_data()
	{
		return [
			[
				[2 => ['f_bbcode' => true, 'f_img' => true, 'f_flash' => true]],
				true,
				true,
				true,
				[
					'S_BBCODE_ALLOWED' => true,
					'S_BBCODE_IMG'     => true,
					'S_BBCODE_FLASH'   => true,
					'S_BBCODE_QUOTE'   => true,
					'S_LINKS_ALLOWED'  => true,
				]
			],
			[
				[3 => ['f_bbcode' => true, 'f_img' => true, 'f_flash' => true]],
				false,
				false,
				false,
				[
					'S_BBCODE_ALLOWED' => false,
					'S_BBCODE_IMG'     => false,
					'S_BBCODE_FLASH'   => false,
					'S_BBCODE_QUOTE'   => true,
					'S_LINKS_ALLOWED'  => false,
				]
			],
			[
				[4 => ['f_bbcode' => false, 'f_img' => false, 'f_flash' => false]],
				true,
				true,
				true,
				[
					'S_BBCODE_ALLOWED' => false,
					'S_BBCODE_IMG'     => false,
					'S_BBCODE_FLASH'   => false,
					'S_BBCODE_QUOTE'   => true,
					'S_LINKS_ALLOWED'  => true,
				]
			],
		];
	}

	/**
	 * @dataProvider bbcode_statuses_test_data
	 * @param $forum
	 * @param $allow_bbcode
	 * @param $allow_links
	 * @param $allow_flash
	 * @param $expected
	 */
	public function test_bbcode_statuses($forum, $allow_bbcode, $allow_links, $allow_flash, $expected)
	{
		$forum_id = key($forum);
		$forum_acl = $forum[$forum_id];

		$this->config['allow_bbcode'] = $allow_bbcode;
		$this->config['allow_post_links'] = $allow_links;
		$this->config['allow_post_flash'] = $allow_flash;

		$this->auth->method('acl_get')
			->with(self::stringContains('f_'), self::anything())
			->willReturnMap([
				['f_bbcode', $forum_id, $forum_acl['f_bbcode']],
				['f_img', $forum_id, $forum_acl['f_img']],
				['f_flash', $forum_id, $forum_acl['f_flash']],
			]);

		$bbcodes_manager = $this->bbcodes_manager();

		self::assertEquals($expected, $bbcodes_manager->bbcode_statuses($forum_id));
	}
}

function display_custom_bbcodes()
{
}
