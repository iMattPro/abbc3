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

	/** @var array|false Mock response for get_headers() */
	public static $font_headers = ['HTTP/1.1 200 OK'];

	/** @var int Number of get_headers() calls */
	public static $font_header_calls = 0;

	/** @var string Last URL passed to get_headers() */
	public static $font_url = '';

	/** @var array Last stream context options passed to get_headers() */
	public static $font_context_options = [];

	/** @var acp_controller */
	protected acp_controller $acp_controller;

	/** @var ContainerInterface|MockObject */
	protected ContainerInterface|MockObject $container;

	/** @var MockObject|driver_interface */
	protected MockObject|driver_interface $cache;

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

	/** @var MockObject|request */
	protected MockObject|request $request;

	/** @var MockObject|template */
	protected MockObject|template $template;

	protected static function setup_extensions(): array
	{
		return ['vse/abbc3'];
	}

	public function getDataSet(): DefaultDataSet|XmlDataSet
	{
		return $this->createXMLDataSet(__DIR__ . '/../core/fixtures/config_text.xml');
	}

	protected function setUp(): void
	{
		parent::setUp();
		self::$font_headers = ['HTTP/1.1 200 OK'];
		self::$font_header_calls = 0;
		self::$font_url = '';
		self::$font_context_options = [];

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

	public static function main_module_data(): array
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
	public function test_main_module($error): void
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

	public function test_main_display(): void
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

	public function test_main_save(): void
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

	public function test_main_save_error(): void
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

	public static function save_google_fonts_data(): array
	{
		return [
			['', '', E_USER_NOTICE, 'CONFIG_UPDATED'],
			['Droid Sans', '["Droid Sans"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["Droid Sans\nRoboto", '["Droid Sans","Roboto"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			['Droid Sans, Roboto', '["Droid Sans","Roboto"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["Droid   Sans\nRoboto\nDroid Sans", '["Droid Sans","Roboto"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["\n\nDroid Sans\n\nRoboto\n\n", '["Droid Sans","Roboto"]', E_USER_NOTICE, 'CONFIG_UPDATED'],
			["Droid Sans\nRoboto\nBad<script>", '["Droid Sans","Roboto"]', E_USER_WARNING, 'ABBC3_INVALID_FONT'],
			['Bad<script>', '["Droid Sans","Roboto"]', E_USER_WARNING, 'ABBC3_INVALID_FONT'],
		];
	}

	/**
	 * @dataProvider save_google_fonts_data
	 * @param $input
	 * @param $expected
	 * @param $error
	 * @param $error_message
	 */
	public function test_save_google_fonts($input, $expected, $error, $error_message): void
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

	public function test_unchanged_google_fonts_are_not_checked_remotely()
	{
		$this->save_google_fonts_request("Droid Sans\nRoboto");

		$this->assertSame(0, self::$font_header_calls);
	}

	public function test_google_font_uses_css2_endpoint_and_bounded_timeout()
	{
		$this->save_google_fonts_request('Noto Sans JP');

		$this->assertSame(1, self::$font_header_calls);
		$this->assertSame(
			'https://fonts.googleapis.com/css2?family=Noto%20Sans%20JP&display=swap',
			self::$font_url
		);
		$this->assertSame(5, self::$font_context_options['http']['timeout']);
		$this->assertSame('["Noto Sans JP"]', $this->config_text->get('abbc3_google_fonts'));
	}

	public function test_invalid_remote_google_font_preserves_stored_fonts()
	{
		self::$font_headers = ['HTTP/1.1 400 Bad Request'];

		$exception = $this->save_google_fonts_request('Not A Google Font');

		$this->assertSame(E_USER_WARNING, $exception->getCode());
		$this->assertStringContainsString('ABBC3_INVALID_FONT', $exception->getMessage());
		$this->assertSame('["Droid Sans","Roboto"]', $this->config_text->get('abbc3_google_fonts'));
	}

	public function test_unavailable_google_fonts_preserves_stored_fonts()
	{
		self::$font_headers = false;

		$exception = $this->save_google_fonts_request('Noto Sans JP');

		$this->assertSame(E_USER_WARNING, $exception->getCode());
		$this->assertStringContainsString('ABBC3_FONT_CHECK_FAILED', $exception->getMessage());
		$this->assertSame('["Droid Sans","Roboto"]', $this->config_text->get('abbc3_google_fonts'));
	}

	public function test_google_font_uses_final_redirect_status()
	{
		self::$font_headers = [
			'HTTP/1.1 302 Found',
			'Location: https://fonts.googleapis.com/example',
			'HTTP/2 200',
		];

		$this->save_google_fonts_request('Noto Sans JP');

		$this->assertSame('["Noto Sans JP"]', $this->config_text->get('abbc3_google_fonts'));
	}

	/**
	 * Submit an ACP save request with Google font data.
	 *
	 * @param string $fonts
	 * @return \RuntimeException
	 */
	protected function save_google_fonts_request($fonts)
	{
		self::$valid_form = true;

		$this->request->method('is_set_post')->willReturn('submit');
		$this->request->method('variable')->willReturnMap([
			['abbc3_bbcode_bar', 0, false, \phpbb\request\request_interface::REQUEST, 0],
			['abbc3_qr_bbcodes', 0, false, \phpbb\request\request_interface::REQUEST, 0],
			['abbc3_auto_video', 0, false, \phpbb\request\request_interface::REQUEST, 0],
			['abbc3_icons_type', 'png', false, \phpbb\request\request_interface::REQUEST, 'png'],
			['abbc3_pipes', 0, false, \phpbb\request\request_interface::REQUEST, 0],
			['abbc3_google_fonts', '', false, \phpbb\request\request_interface::REQUEST, $fonts],
		]);

		try
		{
			$this->acp_controller->handle();
		}
		catch (\RuntimeException $exception)
		{
			return $exception;
		}

		$this->fail('Expected save_settings() to throw a status exception.');
	}

	public function test_info(): void
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
	return acp_test::$valid_form;
}

/**
 * Mock add_form_key()
 * Note: use the same namespace as the controller
 */
function add_form_key()
{
}

/**
 * Mock get_headers() without making network requests.
 *
 * @param string $url
 * @param bool $associative
 * @param resource|null $context
 * @return array|false
 */
function get_headers($url, $associative = false, $context = null)
{
	acp_test::$font_header_calls++;
	acp_test::$font_url = $url;
	acp_test::$font_context_options = stream_context_get_options($context);
	return acp_test::$font_headers;
}
