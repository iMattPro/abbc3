<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

use phpbb\config\config;
use phpbb\filesystem\filesystem;
use phpbb\group\helper;
use phpbb\language\language;
use phpbb\language\language_file_loader;
use phpbb\path_helper;
use phpbb\symfony_request;
use phpbb\user;
use vse\abbc3\core\acp_manager;

class acp_base extends \phpbb_database_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\group\helper */
	protected $group_helper;

	/** @var \phpbb\language\language */
	protected $lang;

	/** @var \phpbb\request\request|\PHPUnit_Framework_MockObject_MockObject */
	protected $request;

	/** @var \phpbb\user */
	protected $user;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/bbcodes.xml');
	}

	public function setUp(): void
	{
		global $phpbb_root_path, $phpEx;

		parent::setUp();

		$this->db = $this->new_dbal();
		$this->request = $this->getMockBuilder('\phpbb\request\request')
			->disableOriginalConstructor()
			->getMock();
		$lang_loader = new language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = new language($lang_loader);
		$this->user = new user($this->lang, '\phpbb\datetime');
		$this->group_helper = new helper(
			$this->getMockBuilder('\phpbb\auth\auth')->disableOriginalConstructor()->getMock(),
			$this->getMockBuilder('\phpbb\cache\service')->disableOriginalConstructor()->getMock(),
			new config([]),
			$this->lang,
			new \phpbb_mock_event_dispatcher(),
			new path_helper(
				new symfony_request(
					new \phpbb_mock_request()
				),
				new filesystem(),
				$this->request,
				$phpbb_root_path,
				$phpEx
			),
			$this->user
		);
	}

	protected function get_acp_manager()
	{
		return new acp_manager($this->db, $this->group_helper, $this->lang, $this->request);
	}
}
