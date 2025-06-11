<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\event;

use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\event\data;
use phpbb\language\language;
use phpbb\routing\helper;
use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use vse\abbc3\core\bbcodes_display;
use vse\abbc3\core\bbcodes_help;
use vse\abbc3\core\bbcodes_config;
use vse\abbc3\ext;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var bbcodes_config */
	protected bbcodes_config $bbcodes_config;

	/** @var bbcodes_display */
	protected bbcodes_display $bbcodes_display;

	/** @var bbcodes_help */
	protected bbcodes_help $bbcodes_help;

	/** @var config */
	protected config $config;

	/** @var db_text */
	protected db_text $config_text;

	/** @var helper */
	protected helper $helper;

	/** @var language */
	protected language $language;

	/** @var template */
	protected template $template;

	protected bool $quick_reply = false;

	/**
	 * Constructor
	 *
	 * @param bbcodes_config $bbcodes_config
	 * @param bbcodes_display $bbcodes_display
	 * @param bbcodes_help $bbcodes_help
	 * @param config $config
	 * @param db_text $db_text
	 * @param helper $helper
	 * @param language $language
	 * @param template $template
	 * @access public
	 */
	public function __construct(bbcodes_config $bbcodes_config, bbcodes_display $bbcodes_display, bbcodes_help $bbcodes_help, config $config, db_text $db_text, helper $helper, language $language, template $template)
	{
		$this->bbcodes_config = $bbcodes_config;
		$this->bbcodes_display = $bbcodes_display;
		$this->bbcodes_help = $bbcodes_help;
		$this->config = $config;
		$this->config_text = $db_text;
		$this->helper = $helper;
		$this->template = $template;
		$this->language = $language;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	public static function getSubscribedEvents(): array
	{
		return [
			'core.user_setup'							=> 'load_language_on_setup',
			'core.page_header' 							=> 'load_google_fonts',
			'core.adm_page_header' 						=> 'load_google_fonts',

			'core.display_custom_bbcodes'				=> 'setup_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql'	=> 'custom_bbcode_modify_sql',
			'core.display_custom_bbcodes_modify_row'	=> 'display_custom_bbcodes',

			'core.text_formatter_s9e_parser_setup'		=> 'allow_custom_bbcodes',
			'core.text_formatter_s9e_configure_after'	=> ['configure_bbcodes', -1], // force the lowest priority

			'core.help_manager_add_block_after'			=> 'add_bbcode_faq',

			'core.viewtopic_modify_quick_reply_template_vars' 	=> 'set_quick_reply',
			'core.viewtopic_modify_page_title'					=> 'add_to_quickreply',
		];
	}

	/**
	 * Load common files during user setup
	 *
	 * @param data $event The event object
	 * @access public
	 */
	public function load_language_on_setup(data $event): void
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name' => 'vse/abbc3',
			'lang_set' => 'abbc3',
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	/**
	 * Load Google fonts data
	 * For injecting Google Font names into the template
	 *
	 * @access public
	 */
	public function load_google_fonts(): void
	{
		if (!$this->config['allow_cdn'])
		{
			return;
		}

		$this->template->assign_var(
			'abbc3_google_fonts',
			json_decode($this->config_text->get('abbc3_google_fonts'), true)
		);
	}

	/**
	 * Modify the SQL array to gather custom BBCode data
	 *
	 * @param data $event The event object
	 * @access public
	 */
	public function custom_bbcode_modify_sql(data $event): void
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
	public function setup_custom_bbcodes(): void
	{
		$this->template->assign_vars([
			'ABBC3_BBCODE_ICONS'		=> $this->bbcodes_display->get_icons(),
			'ABBC3_BBCODE_FONTS'		=> ext::ABBC3_BBCODE_FONTS,

			'S_ABBC3_BBCODES_BAR'		=> $this->config['abbc3_bbcode_bar'],

			'UA_ABBC3_BBVIDEO_WIZARD'	=> $this->helper->route('vse_abbc3_bbcode_wizard', ['mode' => 'bbvideo']),
			'UA_ABBC3_PIPES_WIZARD'		=> $this->helper->route('vse_abbc3_bbcode_wizard', ['mode' => 'pipes']),
			'UA_ABBC3_URL_WIZARD'		=> $this->helper->route('vse_abbc3_bbcode_wizard', ['mode' => 'url']),
		]);
	}

	/**
	 * Alter custom BBCodes display
	 *
	 * @param data $event The event object
	 * @access public
	 */
	public function display_custom_bbcodes(data $event): void
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
	 * @param data $event The event object
	 * @access public
	 */
	public function allow_custom_bbcodes(data $event): void
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
	 * @param data $event The event object
	 * @access public
	 */
	public function configure_bbcodes(data $event): void
	{
		$configurator = $event['configurator'];
		$configurator->registeredVars['abbc3.pipes_enabled'] = $this->config['abbc3_pipes'];
		$configurator->registeredVars['abbc3.auto_video_enabled'] = $this->config['abbc3_auto_video'];

		$this->bbcodes_config->pipes($configurator);
		$this->bbcodes_config->bbvideo($configurator);
		$this->bbcodes_config->auto_video($configurator);
		$this->bbcodes_config->hidden($configurator);
	}

	/**
	 * Add ABBC3 BBCodes to the BBCode FAQ after the HELP_BBCODE_BLOCK_OTHERS block
	 *
	 * @param data $event The event object
	 * @access public
	 */
	public function add_bbcode_faq(data $event): void
	{
		if ($event['block_name'] === 'HELP_BBCODE_BLOCK_OTHERS')
		{
			$this->bbcodes_help->faq();
		}
	}

	/**
	 * If Quick Reply allowed, set our quick_reply property.
	 * Added a compatibility check for Quick Reply Reloaded (qr_bbcode).
	 *
	 * @access public
	 */
	public function set_quick_reply(): void
	{
		$this->quick_reply = $this->config['abbc3_qr_bbcodes'] && !$this->config['qr_bbcode'];
	}

	/**
	 * Add BBCodes to Quick Reply.
	 *
	 * @param data $event The event object
	 * @access public
	 */
	public function add_to_quickreply(data $event): void
	{
		if ($this->quick_reply)
		{
			$this->language->add_lang('posting');
			$this->template->assign_var('S_ABBC3_QUICKREPLY', true);
			$this->template->assign_vars($this->bbcodes_display->bbcode_statuses($event['forum_id']));
		}
	}
}
