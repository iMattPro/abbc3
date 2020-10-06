<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2016 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\system;

use vse\abbc3\ext;

class ext_test extends \phpbb_test_case
{
	/** @var \PHPUnit_Framework_MockObject_MockObject|\Symfony\Component\DependencyInjection\ContainerInterface */
	protected $container;

	/** @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\finder */
	protected $extension_finder;

	/** @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\db\migrator */
	protected $migrator;

	public function setUp(): void
	{
		parent::setUp();

		// Stub the container
		$this->container = $this->getMockBuilder('\Symfony\Component\DependencyInjection\ContainerInterface')
			->disableOriginalConstructor()
			->getMock();

		// Stub the ext finder and disable its constructor
		$this->extension_finder = $this->getMockBuilder('\phpbb\finder')
			->disableOriginalConstructor()
			->getMock();

		// Stub the migrator and disable its constructor
		$this->migrator = $this->getMockBuilder('\phpbb\db\migrator')
			->disableOriginalConstructor()
			->getMock();
	}

	/**
	 * Data set for test_ext
	 *
	 * @return array
	 */
	public function ext_test_data()
	{
		return [
			[ext::PHPBB_MIN_VERSION, true], // current setting is enableable
			['3.3.0', true], // future phpbb is enableable
			['3.1.0', false], // old phpbb is not enableable
		];
	}

	/**
	 * Test the extension can only be enabled when the minimum
	 * phpBB version requirement is satisfied.
	 *
	 * @param $version
	 * @param $expected
	 *
	 * @dataProvider ext_test_data
	 */
	public function test_ext($version, $expected)
	{
		// Instantiate config object and set config version
		$config = new \phpbb\config\config([
			'version' => $version,
		]);

		// Mocked container should return the config object
		// when encountering $this->container->get('config')
		$this->container->expects(self::once())
			->method('get')
			->with('config')
			->willReturn($config);

		/** @var \vse\abbc3\ext */
		$ext = new \vse\abbc3\ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

		self::assertSame($expected, $ext->is_enableable());
	}

	public function enable_test_data()
	{
		return [
			[true, false, 'abbc3-step'],
			[false, false, 'abbc3-step'],
		];
	}

	/**
	 * @dataProvider enable_test_data
	 */
	public function test_enable($exists, $old_state, $expected)
	{
		$filesystem = $this->getMockBuilder('\phpbb\filesystem\filesystem')
			->disableOriginalConstructor()
			->setMethods(['mkdir', 'exists'])
			->getMock();

		$filesystem->expects($exists ? self::never() : self::once())
			->method('mkdir');

		$filesystem->expects($old_state ? self::never() : self::once())
			->method('exists')
			->willReturn($exists);

		$this->container->expects(self::once())
			->method('get')
			->with('filesystem')
			->willReturn($filesystem);

		/** @var \vse\abbc3\ext */
		$ext = new \vse\abbc3\ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

		self::assertEquals($expected, $ext->enable_step($old_state));
	}
}
