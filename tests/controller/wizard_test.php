<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\controller;

class wizard_test extends \phpbb_test_case
{
	/** @var \ReflectionClass */
	protected static $reflection_method_load_json_data;

	/** @var \vse\abbc3\controller\wizard */
	protected $controller;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $request;

	public static function setUpBeforeClass()
	{
		parent::setUpBeforeClass();

		// ReflectClass on wizard to be able to test protected load_json_data()
		$reflection_class = new \ReflectionClass('\vse\abbc3\controller\wizard');
		self::$reflection_method_load_json_data = $reflection_class->getMethod('load_json_data');
		self::$reflection_method_load_json_data->setAccessible(true);
	}

	public function setUp()
	{
		parent::setUp();

		global $phpbb_root_path;

		$this->request = $this->getMock('\phpbb\request\request');

		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->any())
			->method('render')
			->willReturnCallback(function ($template_file, $page_title = '', $status_code = 200, $display_online_list = false) {
				return new \Symfony\Component\HttpFoundation\Response($template_file, $status_code);
			});

		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->controller = new \vse\abbc3\controller\wizard(
			$controller_helper,
			$this->request,
			$template,
			new \phpbb\user('\phpbb\datetime'),
			$phpbb_root_path,
			'ext/vse/abbc3/',
			'',
			''
		);
	}

	public function bbcode_wizard_data()
	{
		return array(
			array('bbvideo', true, 200, 'abbc3_bbvideo_wizard.html'),
		);
	}

	/**
	* @dataProvider bbcode_wizard_data
	*/
	public function test_bbcode_wizard($mode, $ajax, $status_code, $page_content)
	{
		$this->request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax)
		);

		$response = $this->controller->bbcode_wizard($mode);
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}

	public function bbcode_wizard_fails_data()
	{
		return array(
			array('bbvideo', false),
			array('foobars', true),
			array('foobars', false),
			array('', true),
			array('', false),
		);
	}

	/**
	 * Test the controller throws an exception on erroneous calls
	 *
	 * @dataProvider bbcode_wizard_fails_data
	 * @expectedException \phpbb\exception\http_exception
	 * @expectedExceptionMessage GENERAL_ERROR
	 */
	public function test_bbcode_wizard_fails($mode, $ajax)
	{
		$this->request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax)
		);

		$this->controller->bbcode_wizard($mode);
	}

	public function load_json_data_fails_data()
	{
		return array(
			array('../tests/controller/assets/foo.json', 'FILE_CONTENT_ERR'),
			array('../tests/controller/assets/bar.json', 'FILE_JSON_DECODE_ERR'),
			array('../tests/controller/assets/non.json', 'FILE_NOT_FOUND'),
		);
	}

	/**
	 * Test exceptions are thrown by load_json_data() when
	 * receiving bad JSON file data.
	 *
	 * @dataProvider load_json_data_fails_data
	 */
	public function test_load_json_data_fails($file, $message)
	{
		try
		{
			self::$reflection_method_load_json_data->invokeArgs($this->controller, array($file));
			$this->fail('Expected \\phpbb\\exception\\runtime_exception to be thrown but no exception thrown');
		}
		catch (\phpbb\exception\runtime_exception $exception)
		{
			$this->assertEquals($message, $exception->getMessage());
		}
		catch (\Exception $exception)
		{
			$this->fail('Expected \\phpbb\\exception\\runtime_exception to be thrown but "' . get_class($exception) . '" thrown');
		}
	}
}
