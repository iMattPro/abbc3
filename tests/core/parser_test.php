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

class parser_test extends \phpbb_test_case
{
	protected $user;
	protected $bbvideo_width;
	protected $bbvideo_height;

	public function get_user_instance()
	{
		// Must do this for testing with the user class
		global $config;
		$config['default_lang'] = 'en';

		// Must mock extension manager for the user class
		global $phpbb_extension_manager, $phpbb_root_path;
		$phpbb_extension_manager = new \phpbb_mock_extension_manager($phpbb_root_path);

		// Get instance of phpbb\user (dataProvider is called before setUp(), so this must be done here)
		$this->user = new \phpbb\user('\phpbb\datetime');

		$this->user->add_lang_ext('vse/abbc3', 'abbc3');
		$this->bbvideo_width = 560;
		$this->bbvideo_height = 315;
	}

	public function setUp()
	{
		parent::setUp();

		$this->get_user_instance();
	}

	protected function get_parser()
	{
		return new \vse\abbc3\core\bbcodes_parser($this->user, $this->bbvideo_width, $this->bbvideo_height);
	}

	public function pre_parse_data()
	{
		$this->get_user_instance();

		return array(
			array( // not bbvideo, pass through
				array(
					'text' => 'Hello world',
					'uid' => '2sy55ot3'
				),
				'Hello world',
			),
			array( // convert
				array(
					'text' => '[BBvideo 560,340:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/BBvideo:2sy55ot3]',
					'uid' => '2sy55ot3'
				),
				'[bbvideo=560,340:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo:2sy55ot3]',
			),
			array( // convert (no size)
				array(
					'text' => '[BBvideo:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/BBvideo:2sy55ot3]',
					'uid' => '2sy55ot3'
				),
				'[bbvideo=' . $this->bbvideo_width . ',' . $this->bbvideo_height . ':2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo:2sy55ot3]',
			),
			array( // convert bbvideo among other bbcodes
				array(
					'text' => 'Hello [b:2sy55ot3]world[/b:2sy55ot3] [bbvideo:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo:2sy55ot3] Goodbye world',
					'uid' => '2sy55ot3'
				),
				'Hello [b:2sy55ot3]world[/b:2sy55ot3] [bbvideo=' . $this->bbvideo_width . ',' . $this->bbvideo_height . ':2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo:2sy55ot3] Goodbye world',
			),
			array( // convert multiple bbvideos
				array(
					'text' => 'Hello [BBvideo:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/BBvideo:2sy55ot3] [bbvideo:2sy55ot3]http://youtu.be/ZZZZZZZZZZ[/bbvideo:2sy55ot3] Goodbye world',
					'uid' => '2sy55ot3'
				),
				'Hello [bbvideo=' . $this->bbvideo_width . ',' . $this->bbvideo_height . ':2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo:2sy55ot3] [bbvideo=' . $this->bbvideo_width . ',' . $this->bbvideo_height . ':2sy55ot3]http://youtu.be/ZZZZZZZZZZ[/bbvideo:2sy55ot3] Goodbye world',
			),
			array( // pass through (already correct)
				array(
					'text' => '[bbvideo=560,340:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo:2sy55ot3]',
					'uid' => '2sy55ot3'
				),
				'[bbvideo=560,340:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo:2sy55ot3]',
			),
			array( // pass through (malformed and unexpected)
				array(
					'text' => '[bbvideo=560,340:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo]',
					'uid' => '2sy55ot3'
				),
				'[bbvideo=560,340:2sy55ot3]http://youtu.be/XXXXXXXXXXX[/bbvideo]',
			),
		);
	}

	/**
	* @dataProvider pre_parse_data
	*/
	public function test_pre_parse_bbcodes($data, $expected)
	{
		$parser = $this->get_parser();

		$this->assertEquals($expected, $parser->pre_parse_bbcodes($data['text'], $data['uid']));
	}

	public function post_parse_data()
	{
		$this->get_user_instance();

		// user_id
		// message to parse
		// expected message after parse
		return array(
			array(
				1,	// anonymous
				'Hello world',
				'Hello world',
			),
			array(
				1,	// anonymous
				'<!-- ABBC3_BBCODE_HIDDEN -->Hello world<!-- ABBC3_BBCODE_HIDDEN -->',
				'<div class="hidebox hidebox_hidden"><div class="hidebox_title hidebox_hidden">' . $this->user->lang('ABBC3_HIDDEN_ON') . '</div><div class="hidebox_hidden">' . $this->user->lang('ABBC3_HIDDEN_EXPLAIN') . '</div></div>',
			),
			array(
				2,	// registered user
				'<!-- ABBC3_BBCODE_HIDDEN -->Hello world<!-- ABBC3_BBCODE_HIDDEN -->',
				'<div class="hidebox hidebox_visible"><div class="hidebox_title hidebox_visible">' . $this->user->lang('ABBC3_HIDDEN_OFF') . '</div><div class="hidebox_visible">Hello world</div></div>',
			),
			array(
				2,	// registered user
				'This is a test <!-- ABBC3_BBCODE_HIDDEN -->Hello world<!-- ABBC3_BBCODE_HIDDEN --> message',
				'This is a test <div class="hidebox hidebox_visible"><div class="hidebox_title hidebox_visible">' . $this->user->lang('ABBC3_HIDDEN_OFF') . '</div><div class="hidebox_visible">Hello world</div></div> message',
			),
		);
	}

	/**
	* @dataProvider post_parse_data
	*/
	public function test_post_parse_bbcodes($user_id, $text, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$parser = $this->get_parser();

		$this->assertEquals($expected, $parser->post_parse_bbcodes($text));
	}
}
