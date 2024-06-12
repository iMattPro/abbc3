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

use phpbb\finder\finder;
use phpbb\db\migrator;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\ContainerInterface;
use vse\abbc3\ext;

class ext_test extends \phpbb_test_case
{
	/** @var MockObject|ContainerInterface */
	protected $container;

	/** @var MockObject|finder */
	protected $extension_finder;

	/** @var MockObject|migrator */
	protected $migrator;

	protected function setUp(): void
	{
		parent::setUp();

		// Stub the container
		$this->container = $this->createMock('\Symfony\Component\DependencyInjection\ContainerInterface');

		// Stub the ext finder and disable its constructor
		$this->extension_finder = $this->createMock('\phpbb\finder\finder');

		// Stub the migrator and disable its constructor
		$this->migrator = $this->createMock('\phpbb\db\migrator');
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
			['4.0.0', true], // future phpbb is enableable
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

		$ext = new ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

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
			->onlyMethods(['mkdir', 'exists'])
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

		$ext = new ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

		self::assertEquals($expected, $ext->enable_step($old_state));
	}

	public function test_enable_fails()
	{
		$filesystem = $this->getMockBuilder('\phpbb\filesystem\filesystem')
			->disableOriginalConstructor()
			->setMethods(['mkdir', 'exists'])
			->getMock();

		$filesystem->expects( self::once())
			->method('exists')
			->willReturn(false);

		$filesystem->expects(self::once())
			->method('mkdir')
			->willThrowException(new \phpbb\filesystem\exception\filesystem_exception('Test Error', 'images/abbc3/icons'));

		$user = new \phpbb_mock_user();
		$user->data['user_id'] = '2';
		$user->ip = '1.0.0.01';
		$log = $this->getMockBuilder('\phpbb\log\log')
			->disableOriginalConstructor()
			->getMock();

		$log->expects($this->once())
			->method('add')
			->with('critical', '2', '1.0.0.01', 'LOG_ABBC3_ENABLE_FAIL', false, ['images/abbc3/icons']);

		$this->container->expects(self::exactly(3))
			->method('get')
			->withConsecutive(['filesystem'], ['user'], ['log'])
			->willReturnOnConsecutiveCalls($filesystem, $user, $log);

		$ext = new ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

		$ext->enable_step(false);
	}
}
