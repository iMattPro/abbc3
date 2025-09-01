<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\event;

use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\language\language;
use phpbb\language\language_file_loader;
use phpbb\routing\helper;
use phpbb\template\template;
use phpbb\user;
use phpbb_test_case;
use PHPUnit\Framework\MockObject\MockObject;
use vse\abbc3\core\bbcodes_config;
use vse\abbc3\core\bbcodes_display;
use vse\abbc3\core\bbcodes_help;
use vse\abbc3\event\listener;

class listener_base extends phpbb_test_case
{
	/** @var bbcodes_config */
	protected bbcodes_config $bbcodes_config;

	/** @var bbcodes_display|MockObject */
	protected bbcodes_display|MockObject $bbcodes_display;

	/** @var bbcodes_help|MockObject */
	protected bbcodes_help|MockObject $bbcodes_help;

	/** @var config */
	protected config $config;

	/** @var db_text|MockObject */
	protected db_text|MockObject $config_text;

	/** @var helper|MockObject */
	protected helper|MockObject $helper;

	/** @var language */
	protected language $language;

	/** @var listener */
	protected listener $listener;

	/** @var template|MockObject */
	protected template|MockObject $template;

	/** @var user */
	protected user $user;

	/** @var string|int */
	protected string|int $bbvideo_width;

	/** @var string|int */
	protected string|int $bbvideo_height;

	protected function setUp(): void
	{
		parent::setUp();

		global $phpbb_root_path, $phpEx;

		$this->bbcodes_config = new bbcodes_config($phpbb_root_path, $phpEx);
		$this->bbcodes_display = $this->createMock(bbcodes_display::class);
		$this->bbcodes_help = $this->createMock(bbcodes_help::class);
		$this->config = new config([
			'enable_mod_rewrite' => '0',
			'allow_cdn' => '1',
			'abbc3_icons_type' => 'png',
			'abbc3_bbcode_bar' => 1,
			'abbc3_pipes' => 1,
			'abbc3_auto_video' => 1,
		]);

		$this->config_text = $this->createMock(db_text::class);
		$this->template = $this->createMock(template::class);
		$this->language = new language(new language_file_loader($phpbb_root_path, $phpEx));
		$this->user = new \phpbb\user($this->language, '\phpbb\datetime');
		$this->helper = $this->createMock(helper::class);
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
	protected function set_listener(): void
	{
		$this->listener = new listener(
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
