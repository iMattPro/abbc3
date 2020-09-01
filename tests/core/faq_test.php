<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2017 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\core;

class faq_test extends \phpbb_database_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\template\template|\PHPUnit_Framework_MockObject_MockObject */
	protected $template;

	/** @var \vse\abbc3\core\bbcodes_help */
	protected $bbcodes_help;

	public function getDataSet()
	{
		// Aggregate multiple fixtures into a single dataset
		$ds1 = $this->createXMLDataSet(__DIR__ . '/fixtures/bbcodes.xml');
		$ds2 = $this->createXMLDataSet(__DIR__ . '/fixtures/user_group.xml');

		$compositeDs = new \PHPUnit\DbUnit\DataSet\CompositeDataSet();
		$compositeDs->addDataSet($ds1);
		$compositeDs->addDataSet($ds2);

		return $compositeDs;
	}

	public function setUp(): void
	{
		parent::setUp();

		global $config, $phpbb_dispatcher, $phpbb_container, $phpbb_root_path, $phpEx;
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();
		$this->get_test_case_helpers()->set_s9e_services($phpbb_container);

		$db = $this->new_dbal();
		$lang_loader = new \phpbb\language\language_file_loader($phpbb_root_path, $phpEx);
		$this->language = new \phpbb\language\language($lang_loader);
		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->disableOriginalConstructor()
			->getMock();
		$this->user = new \phpbb\user($this->language , '\phpbb\datetime');
		$phpbb_extension_manager = new \phpbb_mock_extension_manager($phpbb_root_path);
		$bbcodes_display = new \vse\abbc3\core\bbcodes_display($config, $db, $phpbb_extension_manager, $this->user, $phpbb_root_path);
		$this->bbcodes_help = new \vse\abbc3\core\bbcodes_help($bbcodes_display, $db, $this->language, $this->template, $this->user);
	}

	public function faq_test_data()
	{
		return [
			[1, ['ABBC3_FONT_HELPLINE', 'ABBC3_HIGHLIGHT_HELPLINE', 'ABBC3_ALIGN_HELPLINE']],
			[2, ['ABBC3_FONT_HELPLINE', 'ABBC3_HIGHLIGHT_HELPLINE', 'ABBC3_FLOAT_HELPLINE', 'ABBC3_SUP_HELPLINE']],
		];
	}

	/**
	 * @dataProvider faq_test_data
	 */
	public function test_faq($user_id, $expected)
	{
		$this->user->data['user_id'] = $user_id;

		$this->template->expects(self::exactly(count($expected) + 1))
			->method('assign_block_vars')
			->withConsecutive(
				['faq_block', [
					'BLOCK_TITLE'	=> 'ABBC3_FAQ_TITLE',
					'SWITCH_COLUMN'	=> false,
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> $expected[0],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> $expected[1],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> $expected[2],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]],
				['faq_block.faq_row', [
					'FAQ_QUESTION'	=> $expected[3],
					'FAQ_ANSWER'	=> 'ABBC3_FAQ_ANSWER',
				]]
			);

		$this->bbcodes_help->faq();
	}
}
