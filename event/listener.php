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
use vse\abbc3\core\bbcodes_help;
use vse\abbc3\core\bbcodes_config;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var bbcodes_config */
	protected $bbcodes_config;

	/** @var bbcodes_display */
	protected $bbcodes_display;

	/** @var bbcodes_help */
	protected $bbcodes_help;

	/** @var helper */
	protected $helper;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var string phpBB root path */
	protected $ext_root_path;

	/**
	 * Constructor
	 *
	 * @param bbcodes_config  $bbcodes_config
	 * @param bbcodes_display $bbcodes_display
	 * @param bbcodes_help    $bbcodes_help
	 * @param helper          $helper
	 * @param template        $template
	 * @param user            $user
	 * @param string          $ext_root_path
	 * @access public
	 */
	public function __construct(bbcodes_config $bbcodes_config, bbcodes_display $bbcodes_display, bbcodes_help $bbcodes_help, helper $helper, template $template, user $user, $ext_root_path)
	{
		$this->bbcodes_config = $bbcodes_config;
		$this->bbcodes_display = $bbcodes_display;
		$this->bbcodes_help = $bbcodes_help;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->ext_root_path = $ext_root_path;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'load_language_on_setup',

			'core.display_custom_bbcodes'				=> 'setup_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql'	=> 'custom_bbcode_modify_sql',
			'core.display_custom_bbcodes_modify_row'	=> 'display_custom_bbcodes',

			'core.text_formatter_s9e_parser_setup'		=> 'allow_custom_bbcodes',
			'core.text_formatter_s9e_configure_after'	=> ['configure_bbcodes', -1], // force lowest priority

			'core.help_manager_add_block_after'			=> 'add_bbcode_faq',
		);
	}

	/**
	 * Load common files during user setup
	 *
	 * @param \phpbb\event\data $event The event object
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
	 * Modify the SQL array to gather custom BBCode data
	 *
	 * @param \phpbb\event\data $event The event object
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
	 * @access public
	 */
	public function setup_custom_bbcodes()
	{
		$this->template->assign_vars(array(
			'ABBC3_USERNAME'			=> $this->user->data['username'],
			'ABBC3_BBCODE_ICONS'		=> $this->ext_root_path . 'images/icons',

			'UA_ABBC3_BBVIDEO_WIZARD'	=> $this->helper->route('vse_abbc3_bbcode_wizard', array('mode' => 'bbvideo')),
			'UA_ABBC3_PIPES_WIZARD'		=> $this->helper->route('vse_abbc3_bbcode_wizard', array('mode' => 'pipes')),
			'UA_ABBC3_URL_WIZARD'		=> $this->helper->route('vse_abbc3_bbcode_wizard', array('mode' => 'url')),
		));
	}

	/**
	 * Alter custom BBCodes display
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function display_custom_bbcodes($event)
	{
		$event['custom_tags'] = $this->bbcodes_display->display_custom_bbcodes($event['custom_tags'], $event['row']);
	}

	/**
	 * Allow custom BBCodes based on user's group memberships
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function allow_custom_bbcodes($event)
	{
		if (defined('IN_CRON'))
		{
			return; // do no apply bbcode permissions if in a cron job (for 3.1 to 3.2 update reparsing)
		}

		$this->bbcodes_display->allow_custom_bbcodes($event['parser']);
	}

	/**
	 * Configure TextFormatter powered PlugIns and BBCodes
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function configure_bbcodes($event)
	{
		$this->bbcodes_config->pipes($event['configurator']);
		$this->bbcodes_config->bbvideo($event['configurator']);
		$this->bbcodes_config->hidden($event['configurator']);
	}

	/**
	 * Add ABBC3 BBCodes to the BBCode FAQ after the HELP_BBCODE_BLOCK_OTHERS block
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function add_bbcode_faq($event)
	{
		if ($event['block_name'] === 'HELP_BBCODE_BLOCK_OTHERS')
		{
			$this->bbcodes_help->faq();
		}
	}
}
