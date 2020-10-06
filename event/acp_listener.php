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
use vse\abbc3\ext;

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
	public static function getSubscribedEvents()
	{
		return [
			'core.acp_bbcodes_display_form'				=> 'acp_bbcodes_custom_sorting',
			'core.acp_bbcodes_display_bbcodes'			=> 'acp_bbcodes_custom_sorting_buttons',
			'core.acp_bbcodes_modify_create'			=> 'acp_bbcodes_modify_create',
			'core.acp_bbcodes_edit_add'					=> 'acp_bbcodes_group_select_box',

			// text_formatter events (for phpBB 3.2.x)
			'core.text_formatter_s9e_configure_after'	=> 's9e_store_bbcode_groups',
		];
	}

	/**
	 * Add some additional elements to the BBCodes template
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function acp_bbcodes_custom_sorting_buttons($event)
	{
		$bbcode_id = $event['row']['bbcode_id'];
		$event->update_subarray('bbcodes_array', 'U_MOVE_UP', $event['u_action'] . '&amp;action=' . ext::MOVE_UP . '&amp;id=' . $bbcode_id . '&amp;hash=' . generate_link_hash(ext::MOVE_UP . $bbcode_id));
		$event->update_subarray('bbcodes_array', 'U_MOVE_DOWN', $event['u_action'] . '&amp;action=' . ext::MOVE_DOWN . '&amp;id=' . $bbcode_id . '&amp;hash=' . generate_link_hash(ext::MOVE_DOWN . $bbcode_id));
	}

	/**
	 * Add the Group select form field on BBCode edit page
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function acp_bbcodes_group_select_box($event)
	{
		$bbcode_group = ($event['action'] === 'edit') ? $this->acp_manager->get_bbcode_group_data($event['bbcode_id']) : [];

		$event->update_subarray('tpl_ary', 'S_GROUP_OPTIONS', $this->acp_manager->bbcode_group_select_options($bbcode_group));
	}

	/**
	 * Handle BBCode order changes when moving them up/down
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function acp_bbcodes_custom_sorting($event)
	{
		// Move up/down actions
		switch ($event['action'])
		{
			case ext::MOVE_UP:
			case ext::MOVE_DOWN:
				$this->acp_manager->move($event['action']);
			break;

			case ext::MOVE_DRAG:
				$this->acp_manager->move_drag();
			break;
		}

		// Add some additional template variables
		$event->update_subarray('template_data', 'UA_DRAG_DROP', str_replace('&amp;', '&', $event['u_action'] . '&action=' . ext::MOVE_DRAG));

		// Change SQL so that it orders by bbcode_order
		$event->update_subarray('sql_ary', 'ORDER_BY', 'b.bbcode_order, b.bbcode_id');
	}

	/**
	 * Handle BBCode order and group data during modify/create routines
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function acp_bbcodes_modify_create($event)
	{
		// Set a new BBCode order value on create
		if ($event['action'] === 'create')
		{
			$event->update_subarray('sql_ary', 'bbcode_order', $this->acp_manager->get_max_bbcode_order() + 1);
		}

		// Get the BBCode groups from the form
		$bbcode_group = $this->acp_manager->get_bbcode_group_form_data();
		$event->update_subarray('sql_ary', 'bbcode_group', $bbcode_group);

		// Supply BBCode groups to hidden form fields
		$event->update_subarray('hidden_fields', 'bbcode_group', $bbcode_group);
	}

	/**
	 * Store BBCode groups in a s9e\TextFormatter variable
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function s9e_store_bbcode_groups($event)
	{
		/** @var \s9e\TextFormatter\Configurator $configurator */
		$configurator = $event['configurator'];
		$bbcode_groups = $this->acp_manager->get_bbcode_groups_data();

		// Save BBCode groups in a registered variable in the configurator. That variable will be
		// copied in the parser's configuration and be available during parser setup.
		$configurator->registeredVars['abbc3.bbcode_groups'] = $bbcode_groups;
	}
}
