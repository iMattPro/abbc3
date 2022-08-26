<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class listener_base extends \phpbb_test_case
{
	/** @var \vse\abbc3\core\bbcodes_config */
	protected $bbcodes_config;

	/** @var \vse\abbc3\core\bbcodes_display|\PHPUnit\Framework\MockObject\MockObject */
	protected $bbcodes_display;

	/** @var \vse\abbc3\core\bbcodes_help|\PHPUnit\Framework\MockObject\MockObject */
	protected $bbcodes_help;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text|\PHPUnit\Framework\MockObject\MockObject */
	protected $config_text;

	/** @var \phpbb\routing\helper|\PHPUnit\Framework\MockObject\MockObject */
	protected $helper;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \vse\abbc3\event\listener */
	protected $listener;

	/** @var \phpbb\template\template|\PHPUnit\Framework\MockObject\MockObject */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $bbvideo_width;

	/** @var string */
	protected $bbvideo_height;

	protected function setUp(): void
	{
		parent::setUp();

		global $phpbb_root_path, $phpEx;

		$this->bbcodes_config = new \vse\abbc3\core\bbcodes_config();
		$this->bbcodes_display = $this->getMockBuilder('\vse\abbc3\core\bbcodes_display')
			->disableOriginalConstructor()
			->getMock();
		$this->bbcodes_help = $this->getMockBuilder('\vse\abbc3\core\bbcodes_help')
			->disableOriginalConstructor()
			->getMock();
		$this->config = new \phpbb\config\config([
			'enable_mod_rewrite' => '0',
			'allow_cdn' => '1',
			'abbc3_icons_type' => 'png',
			'abbc3_bbcode_bar' => 1,
			'abbc3_pipes' => 1,
		]);

		$this->config_text = $this->getMockBuilder('\phpbb\config\db_text')
			->disableOriginalConstructor()
			->getMock();
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->language = new \phpbb\language\language(new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx));
		$this->user = $this->getMockBuilder('\phpbb\user')
			->setConstructorArgs([$this->language, '\phpbb\datetime'])
			->getMock();
		$this->user->data['username'] = 'admin';

		$this->helper = $this->getMockBuilder('\phpbb\routing\helper')
			->disableOriginalConstructor()
			->getMock();
		$this->helper->expects(self::atMost(3))
			->method('route')
			->willReturnCallback(function ($route, array $params = []) {
				return $route . '#' . serialize($params);
			});

		$this->bbvideo_width = 560;
		$this->bbvideo_height = 315;
	}

	/**
	 * Set up an instance of the event listener
	 */
	protected function set_listener()
	{
		$this->listener = new \vse\abbc3\event\listener(
			$this->bbcodes_config,
			$this->bbcodes_display,
			$this->bbcodes_help,
			$this->config,
			$this->config_text,
			$this->helper,
			$this->language,
			$this->template,
			$this->user
		);
	}
}
