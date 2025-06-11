<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\controller;

use phpbb\controller\helper;
use phpbb\exception\http_exception;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\textformatter\s9e\factory;
use phpbb_mock_cache;
use phpbb_test_case;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\HttpFoundation\Response;
use vse\abbc3\controller\wizard;

class wizard_test extends phpbb_test_case
{
	/** @var phpbb_mock_cache */
	protected phpbb_mock_cache $cache;

	/** @var wizard */
	protected wizard $controller;

	/** @var MockObject|request */
	protected MockObject|request $request;

	/** @var template|MockObject */
	protected template|MockObject $template;

	/** @var factory $factory */
	protected mixed $textformatter;

	/**
	 * {@inheritdoc}
	 */
	protected function setUp(): void
	{
		parent::setUp();

		$this->request = $this->createMock(request::class);

		/** @var $controller_helper helper|MockObject */
		$controller_helper = $this->createMock(helper::class);
		$controller_helper->expects($this->atMost(1))
			->method('render')
			->willReturnCallback(function ($template_file, $page_title = '', $status_code = 200) {
				return new Response($template_file, $status_code);
			});

		$this->template = $this->createMock(template::class);

		$container = $this->get_test_case_helpers()->set_s9e_services();
		$this->textformatter = $container->get('text_formatter.s9e.factory');

		$this->cache = new phpbb_mock_cache;

		$this->controller = new wizard(
			$this->cache,
			$controller_helper,
			$this->request,
			$this->template,
			$this->textformatter
		);
	}

	public function bbcode_wizard_data(): array
	{
		return [
			['bbvideo', true, 200, '@vse_abbc3/abbc3_bbvideo_wizard.html'],
			['pipes', true, 200, '@vse_abbc3/abbc3_pipes_wizard.html'],
			['url', true, 200, '@vse_abbc3/abbc3_url_wizard.html'],
		];
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
		$this->request->expects($this->once())
			->method('is_ajax')
			->willReturn($ajax)
		;

		$this->template->expects($mode === 'bbvideo' ? $this->once() : $this->never())
			->method('assign_vars')
			->with([
				'ABBC3_BBVIDEO_SITES'   => [],
				'ABBC3_BBVIDEO_DEFAULT' => wizard::BBVIDEO_DEFAULT,
			]);

		$response = $this->controller->bbcode_wizard($mode);
		$this->assertEquals($status_code, $response->getStatusCode());
		$this->assertEquals($page_content, $response->getContent());
	}

	public function test_bbvideo_sites_cached()
	{
		$cached_data = [
			'youtube' => [
				'name'    => 'YouTube',
				'example' => 'https://www.youtube.com/foobar',
			]
		];

		$this->cache->put('_bbvideo_sites', $cached_data);

		$this->request->expects($this->once())
			->method('is_ajax')
			->willReturn(true)
		;

		$this->template->expects($this->once())
			->method('assign_vars')
			->with([
				'ABBC3_BBVIDEO_SITES'   => $cached_data,
				'ABBC3_BBVIDEO_DEFAULT' => wizard::BBVIDEO_DEFAULT,
			]);

		$response = $this->controller->bbcode_wizard('bbvideo');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function bbcode_wizard_fails_data(): array
	{
		return [
			['bbvideo', false],
			['pipes', false],
			['url', false],
			['foobars', true],
			['foobars', false],
			['', true],
			['', false],
		];
	}

	/**
	 * Test the controller throws an exception on erroneous calls
	 *
	 * @dataProvider bbcode_wizard_fails_data
	 * @param $mode
	 * @param $ajax
	 */
	public function test_bbcode_wizard_fails($mode, $ajax)
	{
		$this->expectExceptionMessage('GENERAL_ERROR');
		$this->expectException(http_exception::class);
		$this->request->expects($this->once())
			->method('is_ajax')
			->willReturn($ajax);
		$this->template->expects($this->never())
			->method('assign_vars');

		$this->controller->bbcode_wizard($mode);
	}
}
