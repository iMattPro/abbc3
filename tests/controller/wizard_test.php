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
	protected $controller;
	protected $request;

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

	public function bbvideo_data()
	{
		return array(
			array('bbvideo', true, 200, 'abbc3_bbvideo_wizard.html'),
		);
	}

	/**
	* @dataProvider bbvideo_data
	*/
	public function test_bbvideo($mode, $ajax, $status_code, $page_content)
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

	public function bbvideo_data_fails()
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
	 * @dataProvider bbvideo_data_fails
	 * @expectedException \phpbb\exception\http_exception
	 * @expectedExceptionMessage GENERAL_ERROR
	 */
	public function test_unique_anchor_fails($mode, $ajax)
	{
		$this->request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax)
		);

		$this->controller->bbcode_wizard($mode);
	}
}
