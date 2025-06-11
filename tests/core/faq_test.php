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

use phpbb\auth\auth;
use phpbb\language\language;
use phpbb\language\language_file_loader;
use phpbb\template\template;
use phpbb\user;
use phpbb_database_test_case;
use phpbb_mock_event_dispatcher;
use phpbb_mock_extension_manager;
use PHPUnit\DbUnit\DataSet\CompositeDataSet;
use PHPUnit\Framework\MockObject\MockObject;
use vse\abbc3\core\bbcodes_display;
use vse\abbc3\core\bbcodes_help;
use phpbb\datetime;

class faq_test extends phpbb_database_test_case
{
	protected static function setup_extensions(): array
	{
		return ['vse/abbc3'];
	}

	/** @var user */
	protected user $user;

	/** @var language */
	protected language $language;

	/** @var template|MockObject */
	protected template|MockObject $template;

	/** @var bbcodes_help */
	protected bbcodes_help $bbcodes_help;

	public function getDataSet(): CompositeDataSet
	{
		// Aggregate multiple fixtures into a single dataset
		$ds1 = $this->createXMLDataSet(__DIR__ . '/fixtures/bbcodes.xml');
		$ds2 = $this->createXMLDataSet(__DIR__ . '/fixtures/user_group.xml');

		$compositeDs = new CompositeDataSet();
		$compositeDs->addDataSet($ds1);
		$compositeDs->addDataSet($ds2);

		return $compositeDs;
	}

	protected function setUp(): void
	{
		parent::setUp();

		global $config, $phpbb_dispatcher, $phpbb_container, $phpbb_root_path, $phpEx;
		$phpbb_dispatcher = new phpbb_mock_event_dispatcher();
		$this->get_test_case_helpers()->set_s9e_services($phpbb_container);
		$config->set('abbc3_auto_video', true);
		$db = $this->new_dbal();
		$auth = new auth();
		$lang_loader = new language_file_loader($phpbb_root_path, $phpEx);
		$this->language = new language($lang_loader);
		$this->template = $this->createMock(template::class);
		$this->user = new user($this->language , datetime::class);
		$phpbb_extension_manager = new phpbb_mock_extension_manager($phpbb_root_path);
		$bbcodes_display = new bbcodes_display($auth, $config, $db, $phpbb_extension_manager, $this->user, $phpbb_root_path);
		$this->bbcodes_help = new bbcodes_help($bbcodes_display, $config, $db, $this->language, $this->template);
	}

	public function faq_test_data(): array
	{
		return [
			[1, ['ABBC3_FONT_HELPLINE', 'ABBC3_HIGHLIGHT_HELPLINE', 'ABBC3_ALIGN_HELPLINE', 'ABBC3_AUTOVIDEO_HELPLINE']],
			[2, ['ABBC3_FONT_HELPLINE', 'ABBC3_HIGHLIGHT_HELPLINE', 'ABBC3_FLOAT_HELPLINE', 'ABBC3_SUP_HELPLINE', 'ABBC3_AUTOVIDEO_HELPLINE']],
		];
	}

	/**
	 * @dataProvider faq_test_data
	 */
	public function test_faq($user_id, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$this->template->expects($this->exactly(count($expected) + 1))
			->method('assign_block_vars')
			->withConsecutive(
				['faq_block', [
					'BLOCK_TITLE'	=> 'ABBC3_FAQ_TITLE',
					'SWITCH_COLUMN'	=> false,
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> @$expected[0],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> @$expected[1],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> @$expected[2],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> @$expected[3],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]]
			);

		$this->bbcodes_help->faq();
	}
}
