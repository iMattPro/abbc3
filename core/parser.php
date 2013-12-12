<?php
/**
*
* @package Advanced BBCode Box 3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\core;

/**
* ABBC3 core parser class
*/
class parser
{
	/** @var \phpbb\user */
	protected $user;

	/**
	* ABBC3 parser constructor method
	* 
	* @param \phpbb\user $user
	*/
	public function __construct(\phpbb\user $user)
	{
		$this->user = $user;
	}

	/**
	* Pre-Parser for special custom BBCodes created by ABBC3
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function pre_parse_bbcodes($event)
	{
		// bbvideo BBCode
		$event['text'] = preg_replace_callback('#\[(bbvideo)[\s]?([0-9,]+)?:([A-Za-z0-9]+)\]([^[]+)\[/\1:\3\]#is', array($this, 'bbvideo_pass'), $event['text']);
	}

	/**
	* Post-Parser for special custom BBCodes created by ABBC3
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function post_parse_bbcodes($event)
	{
		// hidden BBCode
		$event['text'] = preg_replace_callback('#<!-- ABBC3_BBCODE_HIDDEN -->(.*?)<!-- ABBC3_BBCODE_HIDDEN -->#', array($this, 'hidden_pass'), $event['text']);
	}

	/**
	* BBCode [bbvideo=width,height]url[/bbvideo]
	*
	* @param array $matches
	* @return null
	* @access private
	*/
	private function bbvideo_pass($matches)
	{
		return (!empty($matches[2])) ? "[bbvideo=$matches[2]:$matches[3]]$matches[4][/bbvideo:$matches[3]]" : "[bbvideo=560,340:$matches[3]]$matches[4][/bbvideo:$matches[3]]";
	}

	/**
	* BBCode [hidden]text[/hidden]
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
				array($this->user->lang['ABBC3_HIDDEN_ON'], $this->user->lang['ABBC3_HIDDEN_EXPLAIN']),
				'<div class="hidebox hideMe"><div class="hideboxTitle hideMe">{HIDDEN_ON}</div><div class="hideMe">{HIDDEN_TEXT}</div></div>'
			);
		}
		else
		{
			return str_replace(
				array('{HIDDEN_OFF}', '{UNHIDDEN_TEXT}'),
				array($this->user->lang['ABBC3_HIDDEN_OFF'], $matches[1]),
				'<div class="hidebox"><div class="hideboxTitle">{HIDDEN_OFF}</div><div>{UNHIDDEN_TEXT}</div></div>'
			);
		}
	}
}
