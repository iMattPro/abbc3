<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\acp;

use Symfony\Component\DependencyInjection\ContainerInterface;
use PHPUnit\Framework\MockObject\MockObject;

require_once __DIR__ . '/../../../../../includes/functions_acp.php';

class module_test extends \phpbb_database_test_case
{
	/** @var bool A return value for check_form_key() */
	public static $valid_form = false;

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

		// Used in build_select function
		$user = new \phpbb_mock_user();
		$user->lang = new \phpbb_mock_lang();
	}

	/**
	 * @return \vse\abbc3\acp\abbc3_module
	 */
	public function get_main_module()
	{
		$this->container->expects(self::atLeastOnce())
			->method('get')
			->willReturnMap([
				['cache', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->cache],
				['config', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->config],
				['config_text', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->config_text],
				['dbal.conn', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->db],
				['ext.manager', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->ext_manager],
				['language', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->lang],
				['request', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->request],
				['template', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->template],
			]);

		// Test basic module instantiation
		$module = new \vse\abbc3\acp\abbc3_module();
		self::assertInstanceOf('\vse\abbc3\acp\abbc3_module', $module);

		return $module;
	}

	public function test_main_display()
	{
		$module = $this->get_main_module();

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
				'U_ACTION'				=> $module->u_action,
			]);

		$module->main();

		self::assertEquals('acp_abbc3_settings', $module->tpl_name);
	}

	public function test_main_save()
	{
		self::$valid_form = true;

		$module = $this->get_main_module();

		$this->request->expects(self::once())
			->method('is_set_post')
			->willReturn('submit');

		// Throws Notice in PHP 8.0+ and Error in earlier versions
		$exceptionName = PHP_VERSION_ID < 80000 ? \PHPUnit\Framework\Error\Error::class : \PHPUnit\Framework\Error\Notice::class;
		$this->expectException($exceptionName);

		$module->main();
	}

	public function test_main_save_error()
	{
		self::$valid_form = false;

		$module = $this->get_main_module();

		$this->request->expects(self::once())
			->method('is_set_post')
			->willReturn('submit');

		// Throws E_WARNING in PHP 8.0+ and E_USER_WARNING in earlier versions
		$exceptionName = PHP_VERSION_ID < 80000 ? \PHPUnit\Framework\Error\Error::class : \PHPUnit\Framework\Error\Warning::class;
		$this->expectException($exceptionName);

		$module->main();
	}

	public function save_google_fonts_data()
	{
		return [
			['', '[]', \PHPUnit\Framework\Error\Notice::class],
			['Droid Sans', '["Droid Sans"]', \PHPUnit\Framework\Error\Notice::class],
			["Droid Sans\nRoboto", '["Droid Sans","Roboto"]', \PHPUnit\Framework\Error\Notice::class],
			["Droid Sans\nRoboto\nMac Donald", '["Droid Sans","Roboto"]', \PHPUnit\Framework\Error\Warning::class],
			['Mac Donald', '[]', \PHPUnit\Framework\Error\Warning::class],
		];
	}

	/**
	 * @dataProvider save_google_fonts_data
	 * @param $input
	 * @param $expected
	 * @param $error
	 */
	public function test_save_google_fonts($input, $expected, $error)
	{
		self::$valid_form = true;

		$module = $this->get_main_module();

		$this->request->expects(self::once())
			->method('is_set_post')
			->willReturn('submit');

		$this->request->expects(self::at(6))
			->method('variable')
			->with('abbc3_google_fonts', '')
			->willReturn($input);

		// Throws Notice in PHP 8.0+ and Error in earlier versions
		$exceptionName = PHP_VERSION_ID < 80000 ? \PHPUnit\Framework\Error\Error::class : $error;
		$this->expectException($exceptionName);

		$module->main();

		$this->assertSame($expected, $this->config_text->get('abbc3_google_fonts'));
	}

	public function test_info()
	{
		$info_class = new \vse\abbc3\acp\abbc3_info();
		self::assertInstanceOf('\vse\abbc3\acp\abbc3_info', $info_class);
		$info_array = $info_class->module();
		self::assertArrayHasKey('filename', $info_array);
		self::assertEquals('\vse\abbc3\acp\abbc3_module', $info_array['filename']);
		self::assertEquals('ACP_ABBC3_SETTINGS', $info_array['modes']['settings']['title']);
	}
}

/**
 * Mock check_form_key()
 * Note: use the same namespace as the admin_input
 *
 * @return bool
 */
function check_form_key()
{
	return \vse\abbc3\acp\module_test::$valid_form;
}

/**
 * Mock add_form_key()
 * Note: use the same namespace as the admin_input
 */
function add_form_key()
{
}
