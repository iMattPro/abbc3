<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\core;

use phpbb\config\config;
use phpbb\db\driver\driver_interface as db;
use phpbb\group\helper;
use phpbb\language\language;
use phpbb\language\language_file_loader;
use phpbb\path_helper;
use phpbb\request\request;
use phpbb\symfony_request;
use phpbb\user;
use phpbb_database_test_case;
use phpbb_mock_event_dispatcher;
use phpbb_mock_request;
use PHPUnit\DbUnit\DataSet\DefaultDataSet;
use PHPUnit\DbUnit\DataSet\XmlDataSet;
use PHPUnit\Framework\MockObject\MockObject;
use vse\abbc3\core\acp_manager;
use phpbb\datetime;
use phpbb\auth\auth;
use phpbb\cache\service;

class acp_base extends phpbb_database_test_case
{
	protected static function setup_extensions(): array
	{
		return ['vse/abbc3'];
	}

	/** @var db */
	protected db $db;

	/** @var helper */
	protected helper $group_helper;

	/** @var language */
	protected language $lang;

	/** @var MockObject|request */
	protected MockObject|request $request;

	/** @var user */
	protected user $user;

	public function getDataSet(): XmlDataSet|DefaultDataSet
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/bbcodes.xml');
	}

	protected function setUp(): void
	{
		global $user, $phpbb_root_path, $phpEx;

		parent::setUp();

		$this->db = $this->new_dbal();
		$this->request = $this->createMock(request::class);
		$lang_loader = new language_file_loader($phpbb_root_path, $phpEx);
		$this->lang = new language($lang_loader);
		$this->user = $user = new user($this->lang, datetime::class);
		$user->data['user_form_salt'] = '';
		$avatar_helper = $this->createMock(\phpbb\avatar\helper::class);
		$this->group_helper = new helper(
			$this->createMock(auth::class),
			$avatar_helper,
			$this->createMock(service::class),
			new config([]),
			$this->lang,
			new phpbb_mock_event_dispatcher(),
			new path_helper(
				new symfony_request(
					new phpbb_mock_request()
				),
				$this->request,
				$phpbb_root_path,
				$phpEx
			),
			$this->user
		);
	}

	protected function get_acp_manager(): acp_manager
	{
		return new acp_manager($this->db, $this->group_helper, $this->lang, $this->request);
	}
}
