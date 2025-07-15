<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\system;

use phpbb\config\config;
use phpbb\filesystem\exception\filesystem_exception;
use phpbb\finder\finder;
use phpbb\db\migrator;
use phpbb_mock_user;
use phpbb_test_case;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\ContainerInterface;
use vse\abbc3\ext;
use phpbb\filesystem\filesystem;
use phpbb\log\log;

class ext_test extends phpbb_test_case
{
	/** @var MockObject|ContainerInterface */
	protected ContainerInterface|MockObject $container;

	/** @var MockObject|finder */
	protected finder|MockObject $extension_finder;

	/** @var MockObject|migrator */
	protected MockObject|migrator $migrator;

	protected function setUp(): void
	{
		parent::setUp();

		// Stub the container
		$this->container = $this->createMock(ContainerInterface::class);

		// Stub the ext finder and disable its constructor
		$this->extension_finder = $this->createMock(finder::class);

		// Stub the migrator and disable its constructor
		$this->migrator = $this->createMock(migrator::class);
	}

	/**
	 * Data set for test_ext
	 *
	 * @return array
	 */
	public function ext_test_data(): array
	{
		return [
			[ext::PHPBB_MIN_VERSION, true], // the current setting is enableable
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
		$config = new config([
			'version' => $version,
		]);

		// Mocked container should return the config object
		// when encountering $this->container->get('config')
		$this->container->expects($this->once())
			->method('get')
			->with('config')
			->willReturn($config);

		$ext = new ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

		$this->assertSame($expected, $ext->is_enableable());
	}

	public function enable_test_data(): array
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
		$filesystem = $this->getMockBuilder(filesystem::class)
			->disableOriginalConstructor()
			->onlyMethods(['mkdir', 'exists'])
			->getMock();

		$filesystem->expects($exists ? self::never() : $this->once())
			->method('mkdir');

		$filesystem->expects($old_state ? self::never() : $this->once())
			->method('exists')
			->willReturn($exists);

		$this->container->expects($this->once())
			->method('get')
			->with('filesystem')
			->willReturn($filesystem);

		$ext = new ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

		$this->assertEquals($expected, $ext->enable_step($old_state));
	}

	public function test_enable_fails()
	{
		$filesystem = $this->getMockBuilder(filesystem::class)
			->disableOriginalConstructor()
			->onlyMethods(['mkdir', 'exists'])
			->getMock();

		$filesystem->expects( $this->once())
			->method('exists')
			->willReturn(false);

		$filesystem->expects($this->once())
			->method('mkdir')
			->willThrowException(new filesystem_exception('Test Error', 'images/abbc3/icons'));

		$user = new phpbb_mock_user();
		$user->data['user_id'] = '2';
		$user->ip = '1.0.0.01';
		$log = $this->getMockBuilder(log::class)
			->disableOriginalConstructor()
			->getMock();

		$log->expects($this->once())
			->method('add')
			->with('critical', '2', '1.0.0.01', 'LOG_ABBC3_ENABLE_FAIL', false, ['images/abbc3/icons']);

		$services = ['filesystem', 'user', 'log'];
		$returns = [$filesystem, $user, $log];
		$callCount = 0;
		$this->container->expects(self::exactly(3))
			->method('get')
			->willReturnCallback(function($service) use ($services, $returns, &$callCount) {
				$this->assertEquals($services[$callCount], $service);
				return $returns[$callCount++];
			});

		$ext = new ext($this->container, $this->extension_finder, $this->migrator, 'vse/abbc3', '');

		$ext->enable_step(false);
	}
}
