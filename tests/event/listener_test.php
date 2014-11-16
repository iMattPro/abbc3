<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\event;

class listener_test extends \phpbb_test_case
{
	/** @var \vse\abbc3\event\listener */
	protected $listener;

	/**
	* Setup test environment
	*
	* @access public
	*/
	public function setUp()
	{
		parent::setUp();

		global $phpbb_dispatcher, $phpbb_root_path, $phpEx;

		// Mock some global classes that may be called during code execution
		$phpbb_dispatcher = new \phpbb_mock_event_dispatcher();

		// Load/Mock classes required by the event listener class
		$this->parser = new \vse\abbc3\tests\mock\bbcodes_parser();
		$this->bbcodes = new \vse\abbc3\tests\mock\bbcodes_display();
		$this->config = new \phpbb\config\config(array('enable_mod_rewrite' => '0'));
		$this->template = new \vse\abbc3\tests\mock\template();
		$this->user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$this->user->data['username'] = 'admin';

		$request = new \phpbb_mock_request();
		$request->overwrite('SCRIPT_NAME', 'app.php', \phpbb\request\request_interface::SERVER);
		$request->overwrite('SCRIPT_FILENAME', 'app.php', \phpbb\request\request_interface::SERVER);
		$request->overwrite('REQUEST_URI', 'app.php', \phpbb\request\request_interface::SERVER);

		$this->controller_helper = new \phpbb_mock_controller_helper(
			$this->template,
			$this->user,
			$this->config,
			new \phpbb\controller\provider(),
			new \phpbb_mock_extension_manager($phpbb_root_path),
			new \phpbb\symfony_request($request),
			$request,
			new \phpbb\filesystem(),
			'',
			$phpEx,
			dirname(__FILE__) . '/../../'
		);
		$this->root_path = $phpbb_root_path;
		$this->bbvideo_width = 560;
		$this->bbvideo_height = 315;
	}

	/**
	* Create our event listener
	*
	* @access protected
	*/
	protected function set_listener()
	{
		$this->listener = new \vse\abbc3\event\listener(
			$this->parser,
			$this->bbcodes,
			$this->controller_helper,
			$this->template,
			$this->user,
			$this->root_path,
			$this->bbvideo_width,
			$this->bbvideo_height
		);
	}

	/**
	* Test the event listener is constructed correctly
	*
	* @access public
	*/
	public function test_construct()
	{
		$this->set_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

	/**
	* Test the event listener is subscribing events
	*
	* @access public
	*/
	public function test_getSubscribedEvents()
	{
		$this->assertEquals(array(
			'core.user_setup',
			'core.modify_text_for_display_before',
			'core.modify_text_for_display_after',
			'core.display_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql',
			'core.display_custom_bbcodes_modify_row',
			'core.modify_format_display_text_after',
			'core.modify_bbcode_init',
		), array_keys(\vse\abbc3\event\listener::getSubscribedEvents()));
	}

	/**
	* Data set for test_load_language_on_setup
	*
	* @return array Array of test data
	* @access public
	*/
	public function load_language_on_setup_data()
	{
		return array(
			array(
				array(),
				array(
					array(
						'ext_name' => 'vse/abbc3',
						'lang_set' => 'abbc3',
					),
				),
			),
			array(
				array(
					array(
						'ext_name' => 'foo/bar',
						'lang_set' => 'foobar',
					),
				),
				array(
					array(
						'ext_name' => 'foo/bar',
						'lang_set' => 'foobar',
					),
					array(
						'ext_name' => 'vse/abbc3',
						'lang_set' => 'abbc3',
					),
				),
			),
		);
	}

	/**
	* Test the load_language_on_setup event
	*
	* @dataProvider load_language_on_setup_data
	* @access public
	*/
	public function test_load_language_on_setup($lang_set_ext, $expected_contains)
	{
		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.user_setup', array($this->listener, 'load_language_on_setup'));

		$event_data = array('lang_set_ext');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.user_setup', $event);

		$lang_set_ext = $event->get_data_filtered($event_data);
		$lang_set_ext = $lang_set_ext['lang_set_ext'];

		foreach ($expected_contains as $expected)
		{
			$this->assertContains($expected, $lang_set_ext);
		}
	}

	/**
	* Data set for test_custom_bbcode_modify_sql
	*
	* @return array Array of test data
	* @access public
	*/
	public function custom_bbcode_modify_sql_data()
	{
		return array(
			array(
				array(),
				array(
					'SELECT'	=> ', b.bbcode_group',
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				),
			),
			array(
				array(
					'SELECT'	=> 'b.bbcode_id, b.bbcode_tag, b.bbcode_helpline',
					'FROM'		=> array(BBCODES_TABLE => 'b'),
					'WHERE'		=> 'b.display_on_posting = 1',
					'ORDER_BY'	=> 'b.bbcode_tag',
				),
				array(
					'SELECT'	=> 'b.bbcode_id, b.bbcode_tag, b.bbcode_helpline, b.bbcode_group',
					'FROM'		=> array(BBCODES_TABLE => 'b'),
					'WHERE'		=> 'b.display_on_posting = 1',
					'ORDER_BY'	=> 'b.bbcode_order, b.bbcode_id',
				),
			),
		);
	}

	/**
	* Test the custom_bbcode_modify_sql event
	*
	* @dataProvider custom_bbcode_modify_sql_data
	* @access public
	*/
	public function test_custom_bbcode_modify_sql($sql_ary, $expected)
	{
		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes_modify_sql', array($this->listener, 'custom_bbcode_modify_sql'));

		$num_predefined_bbcodes = 22;
		$event_data = array('sql_ary', 'num_predefined_bbcodes');
		$event = new \phpbb\event\data(compact($event_data));
		$dispatcher->dispatch('core.display_custom_bbcodes_modify_sql', $event);

		$sql_ary = $event->get_data_filtered($event_data);
		$sql_ary = $sql_ary['sql_ary'];

		$this->assertEquals($expected, $sql_ary);
	}

	/**
	* Test the setup_custom_bbcodes event
	*
	* @access public
	*/
	public function test_setup_custom_bbcodes()
	{
		$this->set_listener();

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes', array($this->listener, 'setup_custom_bbcodes'));
		$dispatcher->dispatch('core.display_custom_bbcodes');

		$this->assertEquals(array(
			'ABBC3_USERNAME'			=> 'admin',
			'ABBC3_BBCODE_ICONS' 		=> 'ext/vse/abbc3/images/icons',
			'ABBC3_BBVIDEO_HEIGHT'		=> $this->bbvideo_height,
			'ABBC3_BBVIDEO_WIDTH'		=> $this->bbvideo_width,
			'U_ABBC3_BBVIDEO_WIZARD'	=> 'app.php/wizard/bbcode/bbvideo',
		), $this->template->get_template_vars());
	}
}
