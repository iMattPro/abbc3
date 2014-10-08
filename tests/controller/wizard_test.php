<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\controller;

class wizard_test extends \phpbb_test_case
{
	/**
	* Data set for test_bbvideo
	*
	* @return array Array of test data
	* @access public
	*/
	public function bbvideo_data()
	{
		return array(
			array('bbvideo', true, 200, 'bbcode_wizard.html'),
			array('foobars', true, 200, 'GENERAL_ERROR'),
			array('', true, 200, 'GENERAL_ERROR'),
			array('bbvideo', false, 200, 'GENERAL_ERROR'),
			array('foobars', false, 200, 'GENERAL_ERROR'),
			array('', false, 200, 'GENERAL_ERROR'),
		);
	}

	/**
	* Test the controller with bbvideo
	*
	* @dataProvider bbvideo_data
	* @access public
	*/
	public function test_bbvideo($mode, $ajax, $status_code, $page_content)
	{
		global $phpbb_root_path;

		$request = $this->getMock('\phpbb\request\request');
		$request->expects($this->any())
			->method('is_ajax')
			->will($this->returnValue($ajax)
		);

		$controller = new \vse\abbc3\controller\wizard(
			new \vse\abbc3\tests\mock\controller_helper(),
			$request,
			new \vse\abbc3\tests\mock\template(),
			new \phpbb\user('\phpbb\datetime'),
			$phpbb_root_path,
			'',
			''
		);

		$response = $controller->bbcode_wizard($mode);
		$this->assertInstanceOf('\Symfony\Component\HttpFoundation\Response', $response);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}
}
