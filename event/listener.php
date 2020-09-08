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

use phpbb\config\config;
use phpbb\routing\helper;
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

	/** @var config */
	protected $config;

	/** @var helper */
	protected $helper;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	protected $quick_reply = false;

	/**
	 * Constructor
	 *
	 * @param bbcodes_config  $bbcodes_config
	 * @param bbcodes_display $bbcodes_display
	 * @param bbcodes_help    $bbcodes_help
	 * @param config          $config
	 * @param helper          $helper
	 * @param template        $template
	 * @param user            $user
	 * @access public
	 */
	public function __construct(bbcodes_config $bbcodes_config, bbcodes_display $bbcodes_display, bbcodes_help $bbcodes_help, config $config, helper $helper, template $template, user $user)
	{
		$this->bbcodes_config = $bbcodes_config;
		$this->bbcodes_display = $bbcodes_display;
		$this->bbcodes_help = $bbcodes_help;
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
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
		return [
			'core.user_setup'							=> 'load_language_on_setup',

			'core.display_custom_bbcodes'				=> 'setup_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql'	=> 'custom_bbcode_modify_sql',
			'core.display_custom_bbcodes_modify_row'	=> 'display_custom_bbcodes',

			'core.text_formatter_s9e_parser_setup'		=> 'allow_custom_bbcodes',
			'core.text_formatter_s9e_configure_after'	=> ['configure_bbcodes', -1], // force lowest priority

			'core.help_manager_add_block_after'			=> 'add_bbcode_faq',

			'core.viewtopic_modify_quick_reply_template_vars' 	=> 'set_quick_reply',
			'core.viewtopic_modify_page_title'					=> 'add_to_quickreply',
		];
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
		$lang_set_ext[] = [
			'ext_name' => 'vse/abbc3',
			'lang_set' => 'abbc3',
		];
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
		$this->template->assign_vars([
			'ABBC3_USERNAME'			=> $this->user->data['username'],
			'ABBC3_BBCODE_ICONS'		=> $this->bbcodes_display->get_icons(),

			'S_ABBC3_BBCODES_BAR'		=> $this->config['abbc3_bbcode_bar'],

			'UA_ABBC3_BBVIDEO_WIZARD'	=> $this->helper->route('vse_abbc3_bbcode_wizard', ['mode' => 'bbvideo']),
			'UA_ABBC3_PIPES_WIZARD'		=> $this->helper->route('vse_abbc3_bbcode_wizard', ['mode' => 'pipes']),
			'UA_ABBC3_URL_WIZARD'		=> $this->helper->route('vse_abbc3_bbcode_wizard', ['mode' => 'url']),
		]);
	}

	/**
	 * Alter custom BBCodes display
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function display_custom_bbcodes($event)
	{
		if (!$this->config['abbc3_bbcode_bar'])
		{
			return;
		}

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
	 * @access public
	 */
	public function configure_bbcodes($event)
	{
		$configurator = $event['configurator'];
		$configurator->registeredVars['abbc3.pipes_enabled'] = $this->config['abbc3_pipes'];

		$this->bbcodes_config->pipes($configurator);
		$this->bbcodes_config->bbvideo($configurator);
		$this->bbcodes_config->hidden($configurator);
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

	/**
	 * If Quick Reply allowed, set our quick_reply property.
	 *
	 * @access public
	 */
	public function set_quick_reply()
	{
		$this->quick_reply = $this->config['abbc3_qr_bbcodes'];
	}

	/**
	 * Add BBCodes to Quick Reply.
	 *
	 * @access public
	 */
	public function add_to_quickreply()
	{
		if ($this->quick_reply)
		{
			$this->user->add_lang('posting');
			$this->template->assign_var('S_BBCODE_ALLOWED', true);
			display_custom_bbcodes();
		}
	}
}
