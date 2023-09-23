<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\controller;

use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\ContainerInterface;

require_once __DIR__ . '/../../../../../includes/functions_acp.php';

class acp_test extends \phpbb_database_test_case
{
	/** @var bool A return value for check_form_key() */
	public static $valid_form = false;

	/** @var \vse\abbc3\controller\acp_controller */
	protected $acp_controller;

	/** @var ContainerInterface|MockObject */
	protected $container;

	/** @var \phpbb\cache\driver\driver_interface|MockObject */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb_mock_extension_manager */
	protected $ext_manager;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\request\request|MockObject */
	protected $request;

	/** @var \phpbb\template\template|MockObject */
	protected $template;

	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/../core/fixtures/config_text.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();

		global $user, $phpbb_container, $phpbb_root_path, $phpEx;

		$this->cache = $this->createMock('\phpbb\cache\driver\driver_interface');
		$this->config = new \phpbb\config\config([
			'enable_mod_rewrite' => '0',
			'abbc3_icons_type' => 'png',
			'abbc3_bbcode_bar' => 1,
			'abbc3_qr_bbcodes' => 1,
			'abbc3_pipes' => 1,
			'abbc3_auto_video' => 1,
		]);
		$this->db = $this->new_dbal();
		$this->config_text = new \phpbb\config\db_text($this->db, 'phpbb_config_text');
		$this->config_text->set('abbc3_google_fonts', '["Droid Sans","Roboto"]');
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = new \phpbb\language\language($lang_loader);
		$this->request = $this->createMock('\phpbb\request\request');
		$this->template = $this->createMock('\phpbb\template\template');
		$this->ext_manager = new \phpbb_mock_extension_manager($phpbb_root_path);
		$this->container = $phpbb_container = $this->createMock('\Symfony\Component\DependencyInjection\ContainerInterface');
		$this->acp_controller = new \vse\abbc3\controller\acp_controller($this->cache, $this->config, $this->config_text, $this->db, $this->ext_manager, $this->lang, $this->request, $this->template, '', '');

		// Used in build_select function
		$user = new \phpbb_mock_user();
		$user->lang = new \phpbb_mock_lang();
	}

	public function main_module_data()
	{
		return [
			[0],
			[E_USER_NOTICE],
			[E_USER_WARNING],
		];
	}

	/**
	 * @dataProvider main_module_data
	 * @param $error
	 * @return void
	 * @throws \Exception
	 */
	public function test_main_module($error)
	{
		$controller = $this->container->expects(self::once())
			->method('get')
			->willReturnMap([
				['vse.abbc3.acp_controller', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->acp_controller],
			]);

		if ($error)
		{
			$controller->willThrowException(new \RuntimeException('ERROR_TEST', $error));
			$this->setExpectedTriggerError($error, 'ERROR_TEST');
		}

		$module = new \vse\abbc3\acp\abbc3_module();

		$module->main();

		self::assertEquals('acp_abbc3_settings', $module->tpl_name);
	}

	public function test_main_display()
	{
		$this->template->expects(self::once())
			->method('assign_vars')
			->with([
				'S_ABBC3_PIPES'			=> $this->config['abbc3_pipes'],
				'S_ABBC3_BBCODE_BAR'	=> $this->config['abbc3_bbcode_bar'],
				'S_ABBC3_QR_BBCODES'	=> $this->config['abbc3_qr_bbcodes'],
				'S_ABBC3_AUTO_VIDEO'	=> $this->config['abbc3_auto_video'],
				'S_ABBC3_ICONS_TYPE'	=> build_select(['png' => 'PNG', 'svg' => 'SVG'], $this->config['abbc3_icons_type']),
				'S_ABBC3_GOOGLE_FONTS'	=> "Droid Sans\nRoboto",
				'S_ABBC3_MEDIA_EMBED'	=> 0,
				'U_ACTION'				=> 'foo',
			]);

		$this->acp_controller
			->set_u_action('foo')
			->handle();
	}

	public function test_main_save()
	{
		self::$valid_form = true;

		$this->request->expects(self::once())
			->method('is_set_post')
			->willReturn('submit');

		$this->expectException('\RuntimeException');
		$this->expectExceptionCode(E_USER_NOTICE);
		$this->expectExceptionMessage('CONFIG_UPDATED');

		$this->acp_controller->handle();
	}

	public function test_main_save_error()
	{
		self::$valid_form = false;

		$this->request->expects(self::once())
			->method('is_set_post')
			->willReturn('submit');

		$this->expectException('\RuntimeException');
		$this->expectExceptionCode(E_USER_WARNING);
		$this->expectExceptionMessage($this->lang->lang('FORM_INVALID'));

		$this->acp_controller->handle();
	}

	public function save_google_fonts_data()
	{
		return [
			['', '[]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			['Droid Sans', '["Droid Sans"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["Droid Sans\nRoboto", '["Droid Sans","Roboto"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["Droid Sans\nRoboto\nMac Donald", '["Droid Sans","Roboto"]', E_USER_WARNING, 'ABBC3_INVALID_FONT'],
			['Mac Donald', '[]', E_USER_WARNING, 'ABBC3_INVALID_FONT'],
		];
	}

	/**
	 * @dataProvider save_google_fonts_data
	 * @param $input
	 * @param $expected
	 * @param $error
	 * @param $error_message
	 */
	public function test_save_google_fonts($input, $expected, $error, $error_message)
	{
		self::$valid_form = true;

		$this->request->expects(self::once())
			->method('is_set_post')
			->willReturn('submit');

		$this->request->expects(self::exactly(6))
			->method('variable')
			->willReturnMap([
				['abbc3_bbcode_bar', 0, false, \phpbb\request\request_interface::REQUEST, 0],
				['abbc3_qr_bbcodes', 0, false, \phpbb\request\request_interface::REQUEST, 0],
				['abbc3_auto_video', 0, false, \phpbb\request\request_interface::REQUEST, 0],
				['abbc3_icons_type', 'png', false, \phpbb\request\request_interface::REQUEST, 'png'],
				['abbc3_pipes', 0, false, \phpbb\request\request_interface::REQUEST, 0],
				['abbc3_google_fonts', '', false, \phpbb\request\request_interface::REQUEST, $input],
			]);

		$this->expectException('\RuntimeException');
		$this->expectExceptionCode($error);
		$this->expectExceptionMessage($error_message);

		$this->acp_controller->handle();

		$this->assertSame($expected, $this->config_text->get('abbc3_google_fonts'));
	}

	public function test_info()
	{
		$info_class = new \vse\abbc3\acp\abbc3_info();
		$info_array = $info_class->module();
		self::assertArrayHasKey('filename', $info_array);
		self::assertEquals('\vse\abbc3\acp\abbc3_module', $info_array['filename']);
		self::assertEquals('ACP_ABBC3_SETTINGS', $info_array['modes']['settings']['title']);
	}
}

/**
 * Mock check_form_key()
 * Note: use the same namespace as the controller
 *
 * @return bool
 */
function check_form_key()
{
	return \vse\abbc3\controller\acp_test::$valid_form;
}

/**
 * Mock add_form_key()
 * Note: use the same namespace as the controller
 */
function add_form_key()
{
}
