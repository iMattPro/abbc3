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
use phpbb_mock_event_dispatcher;
use phpbb_test_case;
use PHPUnit\Framework\MockObject\MockObject;
use vse\abbc3\core\bbcodes_config;
use vse\abbc3\core\bbcodes_display;
use vse\abbc3\core\bbcodes_help;
use vse\abbc3\event\listener;
use phpbb\datetime;

class listener_base extends phpbb_test_case
{
	/** @var bbcodes_config */
	protected bbcodes_config $bbcodes_config;

	/** @var MockObject|bbcodes_display */
	protected MockObject|bbcodes_display $bbcodes_display;

	/** @var MockObject|bbcodes_help */
	protected MockObject|bbcodes_help $bbcodes_help;

	/** @var config */
	protected config $config;

	/** @var MockObject|db_text */
	protected MockObject|db_text $config_text;

	/** @var MockObject|helper */
	protected MockObject|helper $helper;

	/** @var language */
	protected language $language;

	/** @var listener */
	protected listener $listener;

	/** @var MockObject|template */
	protected MockObject|template $template;

	/** @var user */
	protected user $user;

	/** @var int|string */
	protected int|string $bbvideo_width;

	/** @var int|string */
	protected int|string $bbvideo_height;

	/** @var string */
	protected string $phpbb_root_path;

	/** @var string */
	protected string $php_ext;

	protected function setUp(): void
	{
		parent::setUp();

		global $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		$phpbb_dispatcher = new phpbb_mock_event_dispatcher();
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;

		$this->bbcodes_config = new bbcodes_config();
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
		$this->user = new user($this->language, datetime::class);
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
			$this->user,
			$this->phpbb_root_path,
			$this->php_ext
		);
	}
}
