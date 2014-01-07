<?php
/**
*
* @package Advanced BBCode Box 3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \vse\abbc3\core\acp_manager */
	protected $acp_manager;

	/** @var ContainerBuilder */
	protected $phpbb_container;

	/** @var phpbb_template */
	protected $template;

	/** @var phpbb_user */
	protected $user;

	/** @var string */
	protected $root_path;

	public function __construct()
	{
		global $phpbb_container;

		$this->template = $phpbb_container->get('template');
		$this->user = $phpbb_container->get('user');
		$this->root_path = $phpbb_container->getParameter('core.root_path');

		$this->phpbb_container = $phpbb_container;
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

			// functions_content.php events
			'core.modify_text_for_display_before'		=> 'parse_bbcodes_before',
			'core.modify_text_for_display_after'		=> 'parse_bbcodes_after',

			// functions_display.php events
			'core.display_custom_bbcodes'				=> 'setup_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql'	=> 'custom_bbcode_modify_sql',
			'core.display_custom_bbcodes_modify_row'	=> 'display_custom_bbcodes',

			// message_parser.php events
			'core.modify_format_display_text_after'		=> 'parse_bbcodes_after',
			'core.modify_bbcode_init'					=> 'allow_custom_bbcodes',

			// acp_bbcodes.php events
			'core.acp_bbcodes_display_form'				=> 'acp_bbcodes_custom_sorting',
			'core.acp_bbcodes_display_bbcodes'			=> 'acp_bbcodes_custom_sorting_buttons',
			'core.acp_bbcodes_modify_create'			=> 'acp_bbcodes_modify_create',
			'core.acp_bbcodes_edit_add'					=> 'acp_bbcodes_group_select_box',
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
		$this->phpbb_container->get('vse.abbc3.parser')->pre_parse_bbcodes($event);
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
		$this->phpbb_container->get('vse.abbc3.parser')->post_parse_bbcodes($event);
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
		$sql_ary['ORDER_BY'] = 'b.bbcode_order';
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
			'ABBC3_BBCODE_ICONS'		=> $this->root_path . 'ext/vse/abbc3/images/icons',
			'U_ABBC3_BBVIDEO_WIZARD'	=> $this->phpbb_container->get('controller.helper')->url('wizard/bbcode/bbvideo'),
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
		$event['custom_tags'] = $this->phpbb_container->get('vse.abbc3.bbcodes')->display_custom_bbcodes($event);
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
		$event['bbcodes'] = $this->phpbb_container->get('vse.abbc3.bbcodes')->allow_custom_bbcodes($event);
	}

	/**
	* Load the BBCode ACP Manager
	*
	* @return null
	* @access public
	*/
	public function load_acp_manager()
	{
		if (is_null($this->acp_manager))
		{
			$this->acp_manager = $this->phpbb_container->get('vse.abbc3.acp_manager');
		}
	}

	/**
	* Add some additional elements to the BBCodes template
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function acp_bbcodes_custom_sorting_buttons($event)
	{
		$row = $event['row'];
		$bbcodes_array = $event['bbcodes_array'];

		$bbcodes_array['U_MOVE_UP'] = $event['u_action'] . '&amp;action=move_up&amp;id=' . $row['bbcode_id'];
		$bbcodes_array['U_MOVE_DOWN'] = $event['u_action'] . '&amp;action=move_down&amp;id=' . $row['bbcode_id'];

		$event['bbcodes_array'] = $bbcodes_array;
	}

	/**
	* Add the Group select form field on BBCode edit page
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function acp_bbcodes_group_select_box($event)
	{
		$this->load_acp_manager();

		$bbcode_group = ($event['action'] == 'edit') ? $this->acp_manager->get_bbcode_group_data($event['bbcode_id']) : false;

		$tpl_ary = $event['tpl_ary'];
		$tpl_ary['S_GROUP_OPTIONS'] = $this->acp_manager->bbcode_group_select_options($bbcode_group);
		$event['tpl_ary'] = $tpl_ary;
	}

	/**
	* Handle BBCode order changes when moving them up/down
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function acp_bbcodes_custom_sorting($event)
	{
		$this->load_acp_manager();

		// Move up/down action
		switch($event['action'])
		{
			case 'move_up':
			case 'move_down':
			case 'drag_drop':

				$this->acp_manager->move($event['action']);

			break;
		}

		// Resync bbcode_order
		$this->acp_manager->resynchronize_bbcode_order();

		// Add some additional template variables
		$template_data = $event['template_data'];
		$template_data['UA_DRAG_DROP'] = str_replace('&amp;', '&', $event['u_action'] . '&amp;action=drag_drop');
		$template_data['IMG_AJAX_IMAGE'] = $this->root_path . 'ext/vse/abbc3/images/accepted.png';
		$event['template_data'] = $template_data;

		// Change SQL so that it orders by bbcode_order
		$sql_ary = $event['sql_ary'];
		$sql_ary['ORDER_BY'] = 'b.bbcode_order';
		$event['sql_ary'] = $sql_ary;
	}

	/**
	* Handle BBCode order and group data during modify/create routines
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function acp_bbcodes_modify_create($event)
	{
		$this->load_acp_manager();

		$sql_ary = $event['sql_ary'];

		// Set a new BBCode order value on create
		if ($event['action'] == 'create')
		{
			$sql_ary['bbcode_order'] = $this->acp_manager->get_max_bbcode_order() + 1;
		}

		// Get the BBCode groups from the form
		$bbcode_group = $this->acp_manager->get_bbcode_group_form_data();
		$sql_ary['bbcode_group'] = $bbcode_group;

		// Return sql_ary array
		$event['sql_ary'] = $sql_ary;

		// Supply BBCode groups to hidden form fields
		$hidden_fields = $event['hidden_fields'];
		$hidden_fields['bbcode_group'] = $bbcode_group;
		$event['hidden_fields'] = $hidden_fields;
	}
}
