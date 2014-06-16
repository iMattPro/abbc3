<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \vse\abbc3\core\parser */
	protected $abbc3_parser;

	/** @var \vse\abbc3\core\bbcodes */
	protected $abbc3_bbcodes;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var phpbb_template */
	protected $template;

	/** @var phpbb_user */
	protected $user;

	/** @var string */
	protected $root_path;

	/**
	* Constructor
	*
	* @param \vse\abbc3\core\parser $abbc3_parser
	* @param \vse\abbc3\core\bbcodes $abbc3_bbcodes
	* @param \phpbb\controller\helper $helper
	* @param \phpbb\template\template $template
	* @param \phpbb\user $user
	* @param string $root_path
	* @return \vse\abbc3\event\listener
	* @access public
	*/
	public function __construct(\vse\abbc3\core\parser $abbc3_parser, \vse\abbc3\core\bbcodes $abbc3_bbcodes, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, $root_path)
	{
		$this->abbc3_parser = $abbc3_parser;
		$this->abbc3_bbcodes = $abbc3_bbcodes;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $root_path;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'load_abbc3_on_setup',

			// functions_content events
			'core.modify_text_for_display_before'		=> 'parse_bbcodes_before',
			'core.modify_text_for_display_after'		=> 'parse_bbcodes_after',

			// functions_display events
			'core.display_custom_bbcodes'				=> 'setup_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql'	=> 'custom_bbcode_modify_sql',
			'core.display_custom_bbcodes_modify_row'	=> 'display_custom_bbcodes',

			// message_parser events
			'core.modify_format_display_text_after'		=> 'parse_bbcodes_after',
			'core.modify_bbcode_init'					=> 'allow_custom_bbcodes',
		);
	}

	/**
	* Load common files during user setup
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function load_abbc3_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'vse/abbc3',
			'lang_set' => 'abbc3',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	* Alter BBCodes before they are processed by phpBB
	*
	* This is used to change old/malformed ABBC3 BBCodes to a newer structure
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function parse_bbcodes_before($event)
	{
		$event['text'] = $this->abbc3_parser->pre_parse_bbcodes($event['text'], $event['uid']);
	}

	/**
	* Alter BBCodes after they are processed by phpBB
	*
	* This is used on ABBC3 BBCodes that require additional post-processing
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function parse_bbcodes_after($event)
	{
		$event['text'] = $this->abbc3_parser->post_parse_bbcodes($event['text']);
	}

	/**
	* Modify the SQL array to gather custom BBCode data
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function custom_bbcode_modify_sql($event)
	{
		$sql_ary = $event['sql_ary'];
		$sql_ary['SELECT'] .= ', b.bbcode_group';
		$sql_ary['ORDER_BY'] = 'b.bbcode_order, b.bbcode_id';
		$event['sql_ary'] = $sql_ary;
	}

	/**
	* Setup custom BBCode variables
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function setup_custom_bbcodes($event)
	{
		$this->template->assign_vars(array(
			'ABBC3_USERNAME'			=> $this->user->data['username'],
			'ABBC3_BBCODE_ICONS'		=> 'ext/vse/abbc3/images/icons',
			'U_ABBC3_BBVIDEO_WIZARD'	=> $this->helper->route('abbc3_bbcode_wizard', array('mode' => 'bbvideo')),
		));
	}

	/**
	* Alter custom BBCodes display
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function display_custom_bbcodes($event)
	{
		$event['custom_tags'] = $this->abbc3_bbcodes->display_custom_bbcodes($event['custom_tags'], $event['row']);
	}

	/**
	* Set custom BBCodes permissions
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function allow_custom_bbcodes($event)
	{
		$event['bbcodes'] = $this->abbc3_bbcodes->allow_custom_bbcodes($event['bbcodes'], $event['rowset']);
	}
}
