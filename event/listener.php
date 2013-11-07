<?php
/**
*
* @package ABBC3
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

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'load_abbc3_on_setup',
			'core.modify_text_for_display_before'		=> 'parse_abbcodes_before',
			'core.modify_text_for_display_after'		=> 'parse_abbcodes_after',
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
	* Alter bbcodes before they are processed by phpBB
	*
	* This is used to change old/malformed ABBC3 BBcodes to a newer structure
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function parse_abbcodes_before($event)
	{
 		$event['text'] = preg_replace('#\[(bbvideo)([0-9, ]+)?:([A-Za-z0-9]+)\]([^[]+)\[/\1:\3\]#is', '[bbvideo:$3]$4[/bbvideo:$3]', $event['text']);
	}

	/**
	* Alter bbcodes after they are processed by phpBB
	*
	* This is used on ABBC3 BBcodes that require additional post-processing
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function parse_abbcodes_after($event)
	{
		global $phpbb_container;

 		$phpbb_container->get('abbc3.manager')->parse_bbcodes($event);
	}
}
