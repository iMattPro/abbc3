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

	/** @var \vse\abbc3\core\bbcodes_display|\PHPUnit_Framework_MockObject_MockObject */
	protected $bbcodes_display;

	/** @var \vse\abbc3\core\bbcodes_help|\PHPUnit_Framework_MockObject_MockObject */
	protected $bbcodes_help;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\routing\helper|\PHPUnit_Framework_MockObject_MockObject */
	protected $helper;

	/** @var \vse\abbc3\event\listener */
	protected $listener;

	/** @var \phpbb\template\template|\PHPUnit_Framework_MockObject_MockObject */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $ext_root_path;

	/** @var string */
	protected $bbvideo_width;

	/** @var string */
	protected $bbvideo_height;

	public function setUp()
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
		$this->config = new \phpbb\config\config(array('enable_mod_rewrite' => '0'));

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->user = $this->getMockBuilder('\phpbb\user')
			->setConstructorArgs(array(
				new \phpbb\language\language(new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx)),
				'\phpbb\datetime'
			))
			->getMock();
		$this->user->data['username'] = 'admin';

		$this->helper = $this->getMockBuilder('\phpbb\routing\helper')
			->disableOriginalConstructor()
			->getMock();
		$this->helper->expects($this->atMost(3))
			->method('route')
			->willReturnCallback(function ($route, array $params = array()) {
				return $route . '#' . serialize($params);
			});

		$this->ext_root_path = 'ext/vse/abbc3/';
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
			$this->helper,
			$this->template,
			$this->user,
			$this->ext_root_path
		);
	}
}
