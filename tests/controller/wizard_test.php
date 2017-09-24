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

	/** @var \phpbb\request\request|\PHPUnit_Framework_MockObject_MockObject */
	protected $request;

	public function setUp()
	{
		parent::setUp();

		global $phpbb_root_path, $phpEx;

		$this->request = $this->getMock('\phpbb\request\request');

		/** @var $controller_helper \phpbb\controller\helper|\PHPUnit_Framework_MockObject_MockObject */
		$controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$controller_helper->expects($this->any())
			->method('render')
			->willReturnCallback(function ($template_file, $page_title = '', $status_code = 200, $display_online_list = false) {
				return new \Symfony\Component\HttpFoundation\Response($template_file, $status_code);
			});

		/** @var $template \phpbb\template\template|\PHPUnit_Framework_MockObject_MockObject */
		$template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$this->controller = new \vse\abbc3\controller\wizard(
			$controller_helper,
			$this->request,
			$template,
			new \phpbb\user(new \phpbb\language\language(new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx)), '\phpbb\datetime'),
			$phpbb_root_path . 'ext/vse/abbc3/'
		);
	}

	public function bbcode_wizard_data()
	{
		return array(
			array('bbvideo', true, 200, 'abbc3_bbvideo_wizard.html'),
			array('url', true, 200, 'abbc3_url_wizard.html'),
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
			array('url', false),
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
			$this->invokeMethod($this->controller, 'load_json_data', array($file));
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

	/**
	 * Call protected/private method of a class.
	 *
	 * @param \vse\abbc3\controller\wizard &$object    Instantiated object that we will run method on.
	 * @param string                       $methodName Method name to call
	 * @param array                        $parameters Array of parameters to pass into method.
	 *
	 * @return mixed Method return.
	 */
	public function invokeMethod(&$object, $methodName, array $parameters = array())
	{
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);

		return $method->invokeArgs($object, $parameters);
	}
}
