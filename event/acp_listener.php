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

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use vse\abbc3\core\acp_manager;

/**
 * Event listener
 */
class acp_listener implements EventSubscriberInterface
{
	/** @var acp_manager */
	protected $acp_manager;

	/** @var string */
	protected $root_path;

	/**
	 * Constructor
	 *
	 * @param acp_manager $acp_manager
	 * @param string      $root_path
	 * @access public
	 */
	public function __construct(acp_manager $acp_manager, $root_path)
	{
		$this->acp_manager = $acp_manager;
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
			'core.acp_bbcodes_display_form'				=> 'acp_bbcodes_custom_sorting',
			'core.acp_bbcodes_display_bbcodes'			=> 'acp_bbcodes_custom_sorting_buttons',
			'core.acp_bbcodes_modify_create'			=> 'acp_bbcodes_modify_create',
			'core.acp_bbcodes_edit_add'					=> 'acp_bbcodes_group_select_box',

			// text_formatter events (for phpBB 3.2.x)
			'core.text_formatter_s9e_configure_after'	=> 's9e_store_bbcode_groups',
		);
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

		$bbcodes_array['U_MOVE_UP'] = $event['u_action'] . '&amp;action=move_up&amp;id=' . $row['bbcode_id'] . '&amp;hash=' . generate_link_hash('move_up' . $row['bbcode_id']);
		$bbcodes_array['U_MOVE_DOWN'] = $event['u_action'] . '&amp;action=move_down&amp;id=' . $row['bbcode_id'] . '&amp;hash=' . generate_link_hash('move_down' . $row['bbcode_id']);

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
		// Move up/down action
		switch ($event['action'])
		{
			case 'move_up':
			case 'move_down':
				$this->acp_manager->move($event['action']);
			break;

			case 'drag_drop':
				$this->acp_manager->drag_drop();
			break;
		}

		// Add some additional template variables
		$template_data = $event['template_data'];
		$template_data['UA_DRAG_DROP'] = str_replace('&amp;', '&', $event['u_action'] . '&action=drag_drop');
		$event['template_data'] = $template_data;

		// Change SQL so that it orders by bbcode_order
		$sql_ary = $event['sql_ary'];
		$sql_ary['ORDER_BY'] = 'b.bbcode_order, b.bbcode_id';
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

	/**
	 * Store BBCode groups in a s9e\TextFormatter variable
	 *
	 * @param object $event The event object
	 * @return null
	 * @access public
	 */
	public function s9e_store_bbcode_groups($event)
	{
		$configurator = $event['configurator'];
		$bbcode_groups = $this->acp_manager->get_bbcode_groups_data();

		// Save BBCode groups in a registered variable in the configurator. That variable will be
		// copied in the parser's configuration and be available during parser setup.
		$configurator->registeredVars['abbc3.bbcode_groups'] = $bbcode_groups;
	}
}
