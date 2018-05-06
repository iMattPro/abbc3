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

	/** @var \phpbb\template\template|\PHPUnit_Framework_MockObject_MockObject */
	protected $template;

	/** @var \phpbb\textformatter\s9e\factory $factory */
	protected $textformatter;

	/**
	 * {@inheritdoc}
	 */
	public function setUp()
	{
		parent::setUp();

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

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();

		$container = $this->get_test_case_helpers()->set_s9e_services();
		$this->textformatter = $container->get('text_formatter.s9e.factory');

		$this->controller = new \vse\abbc3\controller\wizard(
			new \phpbb_mock_cache,
			$controller_helper,
			$this->request,
			$this->template,
			$this->textformatter
		);
	}

	public function bbcode_wizard_data()
	{
		return array(
			array('bbvideo', true, 200, 'abbc3_bbvideo_wizard.html'),
			array('pipes', true, 200, 'abbc3_pipes_wizard.html'),
			array('url', true, 200, 'abbc3_url_wizard.html'),
		);
	}

	/**
	 * @dataProvider bbcode_wizard_data
	 * @param $mode
	 * @param $ajax
	 * @param $status_code
	 * @param $page_content
	 */
	public function test_bbcode_wizard($mode, $ajax, $status_code, $page_content)
	{
		$this->request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax)
			)
		;

		$response = $this->controller->bbcode_wizard($mode);
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}

	public function bbcode_wizard_fails_data()
	{
		return array(
			array('bbvideo', false),
			array('pipes', false),
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
	 * @dataProvider             bbcode_wizard_fails_data
	 * @expectedException \phpbb\exception\http_exception
	 * @expectedExceptionMessage GENERAL_ERROR
	 * @param $mode
	 * @param $ajax
	 */
	public function test_bbcode_wizard_fails($mode, $ajax)
	{
		$this->request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax));

		$this->controller->bbcode_wizard($mode);
	}

	/**
	 * Test generate_bbvideo_wizard works
	 */
	public function test_generate_bbvideo_wizard()
	{
		$bbvideo_sites = [];
		$configurator = $this->textformatter->get_configurator();
		foreach ($configurator->MediaEmbed->defaultSites as $siteId => $siteConfig)
		{
			$bbvideo_sites[$siteId] = current((array) $siteConfig['example']);
		}

		$bbvideo_default = \vse\abbc3\controller\wizard::BBVIDEO_DEFAULT;

		$this->template->expects($this->once())
			->method('assign_vars')
			->will($this->returnValue(array(
				'ABBC3_BBVIDEO_SITES'   => $bbvideo_sites,
				'ABBC3_BBVIDEO_LINK_EX' => isset($bbvideo_sites[$bbvideo_default]) ? $bbvideo_sites[$bbvideo_default] : '',
				'ABBC3_BBVIDEO_DEFAULT' => $bbvideo_default,
			)));

		$this->invokeMethod($this->controller, 'generate_bbvideo_wizard');
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
