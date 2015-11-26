<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\event;

use phpbb\controller\helper;
use phpbb\template\template;
use phpbb\user;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use vse\abbc3\core\bbcodes_display;
use vse\abbc3\core\bbcodes_parser;
use vse\abbc3\ext;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var bbcodes_parser */
	protected $bbcodes_parser;

	/** @var bbcodes_display */
	protected $bbcodes_display;

	/** @var helper */
	protected $helper;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/**
	 * Constructor
	 *
	 * @param bbcodes_parser  $bbcodes_parser
	 * @param bbcodes_display $bbcodes_display
	 * @param helper          $helper
	 * @param template        $template
	 * @param user            $user
	 * @param string          $root_path
	 * @access public
	 */
	public function __construct(bbcodes_parser $bbcodes_parser, bbcodes_display $bbcodes_display, helper $helper, template $template, user $user, $root_path)
	{
		$this->bbcodes_parser = $bbcodes_parser;
		$this->bbcodes_display = $bbcodes_display;
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
			'core.user_setup'							=> 'load_language_on_setup',

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

			// text_formatter events (for phpBB 3.2.x)
			'core.text_formatter_s9e_parser_setup'		=> 's9e_allow_custom_bbcodes',
		);
	}

	/**
	 * Load common files during user setup
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function load_language_on_setup($event)
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
		$event['text'] = $this->bbcodes_parser->pre_parse_bbcodes($event['text'], $event['uid']);
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
		$event['text'] = $this->bbcodes_parser->post_parse_bbcodes($event['text']);
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
	 * @return null
	 * @access public
	 */
	public function setup_custom_bbcodes()
	{
		$this->template->assign_vars(array(
			'ABBC3_USERNAME'			=> $this->user->data['username'],
			'ABBC3_BBCODE_ICONS'		=> ext::ABBC3_ROOT_PATH . 'images/icons',
			'ABBC3_BBVIDEO_HEIGHT'		=> ext::BBVIDEO_HEIGHT,
			'ABBC3_BBVIDEO_WIDTH'		=> ext::BBVIDEO_WIDTH,

			'UA_ABBC3_BBVIDEO_WIZARD'	=> $this->helper->route('vse_abbc3_bbcode_wizard', array('mode' => 'bbvideo')),
			'UA_ABBC3_URL_WIZARD'		=> $this->helper->route('vse_abbc3_bbcode_wizard', array('mode' => 'url')),
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
		$event['custom_tags'] = $this->bbcodes_display->display_custom_bbcodes($event['custom_tags'], $event['row']);
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
		$event['bbcodes'] = $this->bbcodes_display->allow_custom_bbcodes($event['bbcodes'], $event['rowset']);
	}

	/**
	 * Toggle custom BBCodes in the s9e\TextFormatter parser based on user's group memberships
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function s9e_allow_custom_bbcodes($event)
	{
		/** @var $service \phpbb\textformatter\s9e\parser object from the text_formatter.parser service */
		$service = $event['parser'];
		$parser = $service->get_parser();
		foreach ($parser->registeredVars['abbc3.bbcode_groups'] as $bbcode_name => $groups)
		{
			if (!$this->bbcodes_display->user_in_bbcode_group($groups))
			{
				$bbcode_name = rtrim($bbcode_name, '=');
				$service->disable_bbcode($bbcode_name);
			}
		}
	}
}
