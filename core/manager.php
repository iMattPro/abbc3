<?php
/**
*
* @package ABBC3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\core;

/**
* ABBC3 core manager class
*/
class manager
{
	/** @var \phpbb\user */
	protected $user;
	
	/**
	* ABBC3 manager constructor method
	* 
	* @param \phpbb\user $user
	*/
	public function __construct(\phpbb\user $user)
	{
		$this->user = $user;
	}

	/**
	* Post-Parser for special custom BBcodes created by ABBC3
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function parse_bbcodes($event)
	{
		$event['text'] = preg_replace_callback('#<!-- ABBC3_BBCODE_HIDDEN -->(.*?)<!-- ABBC3_BBCODE_HIDDEN -->#', array($this, 'hidden_pass'), $event['text']);
	}

	/**
	* BBcode [hidden]text[/hidden]
	*
	* @param array $matches
	* @return null
	* @access private
	*/
	private function hidden_pass($matches)
	{
		if ($this->user->data['user_id'] == ANONYMOUS || $this->user->data['is_bot'])
		{
			return str_replace(
				array('{HIDDEN_ON}', '{HIDDEN_TEXT}'),
				array($this->user->lang['HIDDEN_ON'], $this->user->lang['HIDDEN_EXPLAIN']),
				'<dl class="hiddenbox"><dt class="hidden">{HIDDEN_ON}</dt><dd class="hiddentext">{HIDDEN_TEXT}</dd></dl>'
			);	
		}
		else
		{
			return str_replace(
				array('{HIDDEN_OFF}', '{UNHIDDEN_TEXT}'),
				array($this->user->lang['HIDDEN_OFF'], $matches[0]),
				'<dl class="unhiddenbox"><dt class="unhidden">{HIDDEN_OFF}</dt><dd>{UNHIDDEN_TEXT}</dd></dl>'
			);
		}
 	}	
}
