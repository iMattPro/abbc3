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
	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $bbcodes;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $controller_helper;

	/** @var \vse\abbc3\event\listener */
	protected $listener;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $parser;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $ext_root_path;

	/** @var string */
	protected $bbvideo_width;

	/** @var string */
	protected $bbvideo_height;

	public function setUp()
	{
		parent::setUp();

		global $phpbb_root_path;

		$this->parser = $this->getMockBuilder('\vse\abbc3\core\bbcodes_parser')
			->disableOriginalConstructor()
			->getMock();
		$this->bbcodes = $this->getMockBuilder('\vse\abbc3\core\bbcodes_display')
			->disableOriginalConstructor()
			->getMock();
		$this->config = new \phpbb\config\config(array('enable_mod_rewrite' => '0'));

		$this->template = $this->getMockBuilder('\phpbb\template\template')
			->getMock();
		$this->user = $this->getMock('\phpbb\user', array(), array('\phpbb\datetime'));
		$this->user->data['username'] = 'admin';

		$this->controller_helper = $this->getMockBuilder('\phpbb\controller\helper')
			->disableOriginalConstructor()
			->getMock();
		$this->controller_helper->expects($this->any())
			->method('route')
			->willReturnCallback(function ($route, array $params = array()) {
				return $route . '#' . serialize($params);
			});

		$this->root_path = $phpbb_root_path;
		$this->ext_root_path = 'ext/vse/abbc3/';
		$this->bbvideo_width = 560;
		$this->bbvideo_height = 315;
	}

	protected function set_listener()
	{
		$this->listener = new \vse\abbc3\event\listener(
			$this->parser,
			$this->bbcodes,
			$this->controller_helper,
			$this->template,
			$this->user,
			$this->root_path,
			$this->ext_root_path,
			$this->bbvideo_width,
			$this->bbvideo_height
		);
	}

	public function test_construct()
	{
		$this->set_listener();
		$this->assertInstanceOf('\Symfony\Component\EventDispatcher\EventSubscriberInterface', $this->listener);
	}

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
	* @dataProvider load_language_on_setup_data
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
	* @dataProvider custom_bbcode_modify_sql_data
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

	public function test_setup_custom_bbcodes()
	{
		$this->set_listener();

		$this->template->expects($this->once())
			->method('assign_vars')
			->with(array(
				'ABBC3_USERNAME'			=> 'admin',
				'ABBC3_BBCODE_ICONS' 		=> $this->ext_root_path . 'images/icons',
				'ABBC3_BBVIDEO_HEIGHT'		=> $this->bbvideo_height,
				'ABBC3_BBVIDEO_WIDTH'		=> $this->bbvideo_width,
				'UA_ABBC3_BBVIDEO_WIZARD'	=> 'vse_abbc3_bbcode_wizard#a:1:{s:4:"mode";s:7:"bbvideo";}',
			));

		$dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
		$dispatcher->addListener('core.display_custom_bbcodes', array($this->listener, 'setup_custom_bbcodes'));
		$dispatcher->dispatch('core.display_custom_bbcodes');
	}
}
