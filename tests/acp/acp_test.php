<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\controller;

use Exception;
use phpbb\cache\driver\driver_interface;
use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\db\driver\driver_interface as dbal;
use phpbb\language\language;
use phpbb\language\language_file_loader;
use phpbb\request\request;
use phpbb\request\request_interface;
use phpbb\template\template;
use phpbb_database_test_case;
use phpbb_mock_extension_manager;
use phpbb_mock_lang;
use phpbb_mock_user;
use PHPUnit\DbUnit\DataSet\DefaultDataSet;
use PHPUnit\DbUnit\DataSet\XmlDataSet;
use PHPUnit\Framework\MockObject\MockObject;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use vse\abbc3\acp\abbc3_info;
use vse\abbc3\acp\abbc3_module;

require_once __DIR__ . '/../../../../../includes/functions_acp.php';

class acp_test extends phpbb_database_test_case
{
	/** @var bool A return value for check_form_key() */
	public static bool $valid_form = false;

	/** @var acp_controller */
	protected acp_controller $acp_controller;

	/** @var ContainerInterface|MockObject */
	protected ContainerInterface|MockObject $container;

	/** @var driver_interface|MockObject */
	protected driver_interface|MockObject $cache;

	/** @var config */
	protected config $config;

	/** @var db_text */
	protected db_text $config_text;

	/** @var dbal */
	protected dbal $db;

	/** @var phpbb_mock_extension_manager */
	protected phpbb_mock_extension_manager $ext_manager;

	/** @var language */
	protected language $lang;

	/** @var request|MockObject */
	protected MockObject|request $request;

	/** @var template|MockObject */
	protected template|MockObject $template;

	protected static function setup_extensions(): array
	{
		return ['vse/abbc3'];
	}

	public function getDataSet(): XmlDataSet|DefaultDataSet
	{
		return $this->createXMLDataSet(__DIR__ . '/../core/fixtures/config_text.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();

		global $user, $language, $phpbb_container, $phpbb_root_path, $phpEx;

		$this->cache = $this->createMock(driver_interface::class);
		$this->config = new config([
			'enable_mod_rewrite' => '0',
			'abbc3_icons_type' => 'png',
			'abbc3_bbcode_bar' => 1,
			'abbc3_qr_bbcodes' => 1,
			'abbc3_pipes' => 1,
			'abbc3_auto_video' => 1,
		]);
		$this->db = $this->new_dbal();
		$this->config_text = new db_text($this->db, 'phpbb_config_text');
		$this->config_text->set('abbc3_google_fonts', '["Droid Sans","Roboto"]');
		$lang_loader = new language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = $language = new language($lang_loader);
		$this->request = $this->createMock(request::class);
		$this->template = $this->createMock(template::class);
		$this->ext_manager = new phpbb_mock_extension_manager($phpbb_root_path);
		$this->container = $phpbb_container = $this->createMock(ContainerInterface::class);
		$this->acp_controller = new acp_controller($this->cache, $this->config, $this->config_text, $this->db, $this->ext_manager, $this->lang, $this->request, $this->template, '', '');

		// Used in build_select function
		$user = new phpbb_mock_user();
		$user->lang = new phpbb_mock_lang();
	}

	public function main_module_data(): array
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
	 * @throws Exception
	 */
	public function test_main_module($error)
	{
		$controller = $this->container->expects($this->once())
			->method('get')
			->willReturnMap([
				['vse.abbc3.acp_controller', ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE, $this->acp_controller],
			]);

		if ($error)
		{
			$controller->willThrowException(new RuntimeException('ERROR_TEST', $error));
			$this->setExpectedTriggerError($error, 'ERROR_TEST');
		}

		$module = new abbc3_module();

		$module->main();

		$this->assertEquals('acp_abbc3_settings', $module->tpl_name);
	}

	public function test_main_display()
	{
		$this->template->expects($this->once())
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

		$this->request->expects($this->once())
			->method('is_set_post')
			->willReturn('submit');

		$this->expectException(RuntimeException::class);
		$this->expectExceptionCode(E_USER_NOTICE);
		$this->expectExceptionMessage('CONFIG_UPDATED');

		$this->acp_controller->handle();
	}

	public function test_main_save_error()
	{
		self::$valid_form = false;

		$this->request->expects($this->once())
			->method('is_set_post')
			->willReturn('submit');

		$this->expectException(RuntimeException::class);
		$this->expectExceptionCode(E_USER_WARNING);
		$this->expectExceptionMessage($this->lang->lang('FORM_INVALID'));

		$this->acp_controller->handle();
	}

	public function save_google_fonts_data(): array
	{
		return [
			['', '', E_USER_NOTICE, 'CONFIG_UPDATED'],
			['Droid Sans', '["Droid Sans"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["Droid Sans\nRoboto", '["Droid Sans","Roboto"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["\n\nDroid Sans\n\nRoboto\n\n", '["Droid Sans","Roboto"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["Droid Sans\nRoboto\nMac Donald", '["Droid Sans","Roboto"]', E_USER_WARNING, 'ABBC3_INVALID_FONT'],
			['Mac Donald', '', E_USER_WARNING, 'ABBC3_INVALID_FONT'],
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

		$this->request->expects($this->once())
			->method('is_set_post')
			->willReturn('submit');

		$this->request->expects($this->exactly(6))
			->method('variable')
			->willReturnMap([
				['abbc3_bbcode_bar', 0, false, request_interface::REQUEST, 0],
				['abbc3_qr_bbcodes', 0, false, request_interface::REQUEST, 0],
				['abbc3_auto_video', 0, false, request_interface::REQUEST, 0],
				['abbc3_icons_type', 'png', false, request_interface::REQUEST, 'png'],
				['abbc3_pipes', 0, false, request_interface::REQUEST, 0],
				['abbc3_google_fonts', '', false, request_interface::REQUEST, $input],
			]);

		try {
			$this->acp_controller->handle();
		} catch (RuntimeException $e) {
			$this->assertSame($expected, $this->config_text->get('abbc3_google_fonts'));
			$this->assertEquals($error, $e->getCode());
			$this->assertEquals($error_message, $e->getMessage());
		}
	}

	public function test_info()
	{
		$info_class = new abbc3_info();
		$info_array = $info_class->module();
		$this->assertArrayHasKey('filename', $info_array);
		$this->assertEquals('\\vse\\abbc3\\acp\\abbc3_module', $info_array['filename']);
		$this->assertEquals('ACP_ABBC3_SETTINGS', $info_array['modes']['settings']['title']);
	}
}

/**
 * Mock check_form_key()
 * Note: use the same namespace as the controller
 *
 * @return bool
 */
function check_form_key(): bool
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
