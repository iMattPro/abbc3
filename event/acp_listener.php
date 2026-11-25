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

	/**
	 * Constructor
	 *
	 * @param acp_manager $acp_manager
	 * @access public
	 */
	public function __construct(acp_manager $acp_manager)
	{
		$this->acp_manager = $acp_manager;
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
			'core.acp_bbcodes_modify_create'		=> 'acp_bbcodes_modify_create',
			'core.acp_bbcodes_modify_create_after'	=> 'acp_bbcodes_modify_create_after',
			'core.acp_bbcodes_delete_after'			=> 'acp_bbcodes_delete_after',
			'core.acp_bbcodes_edit_add'				=> 'acp_bbcodes_group_select_box',
		];
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
	 * Handle BBCode order and group data during modify/create routines
	 *
	 * @param \phpbb\event\data $event The event object
	 * @access public
	 */
	public function acp_bbcodes_modify_create($event)
	{
		// Get the BBCode groups from the form
		$bbcode_group = $this->acp_manager->get_bbcode_group_form_data();
		// Supply BBCode groups to hidden form fields
		$event->update_subarray('hidden_fields', 'bbcode_group', $bbcode_group);
	}

	public function acp_bbcodes_modify_create_after($event)
	{
		$this->acp_manager->save_bbcode_groups((int) $event['bbcode_id']);
		$this->acp_manager->register_bbcode((int) $event['bbcode_id'], $event['sql_ary']['bbcode_tag'], !empty($event['sql_ary']['display_on_posting']));
	}

	public function acp_bbcodes_delete_after($event)
	{
		$this->acp_manager->remove_toolbar_bbcode((int) $event['bbcode_id']);
	}
}
