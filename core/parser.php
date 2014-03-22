<?php
/**
*
* @package Advanced BBCode Box 3.1
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
	* Constructor
	*
	* @param \phpbb\user $user
	* @return \vse\abbc3\core\parser
	* @access public
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
		$event['text'] = preg_replace_callback('#\[(bbvideo)[\s]?([0-9,]+)?:(' . $event['uid'] . ')\]([^[]+)\[/\1:\3\]#is', array($this, 'bbvideo_pass'), $event['text']);
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
	* Convert BBvideo from older ABBC3 posts to the new format
	*
	* @param array $matches
	* @return string BBvideo in the correct BBCode format
	* @access protected
	*/
	protected function bbvideo_pass($matches)
	{
		return (!empty($matches[2])) ? "[bbvideo=$matches[2]:$matches[3]]$matches[4][/bbvideo:$matches[3]]" : '[bbvideo=' . $this->user->lang('ABBC3_BBVIDEO_WIDTH') . ',' . $this->user->lang('ABBC3_BBVIDEO_HEIGHT') . ":$matches[3]]$matches[4][/bbvideo:$matches[3]]";
	}

	/**
	* Convert Hidden BBCode into its final appearance
	*
	* @param array $matches
	* @return string HTML render of hidden bbcode
	* @access protected
	*/
	protected function hidden_pass($matches)
	{
		if ($this->user->data['user_id'] == ANONYMOUS || $this->user->data['is_bot'])
		{
			return str_replace(
				array('{HIDDEN_ON}', '{HIDDEN_TEXT}'),
				array($this->user->lang('ABBC3_HIDDEN_ON'), $this->user->lang('ABBC3_HIDDEN_EXPLAIN')),
				'<div class="hidebox hidebox_hidden"><div class="hidebox_title hidebox_hidden">{HIDDEN_ON}</div><div class="hidebox_hidden">{HIDDEN_TEXT}</div></div>'
			);
		}
		else
		{
			return str_replace(
				array('{HIDDEN_OFF}', '{UNHIDDEN_TEXT}'),
				array($this->user->lang('ABBC3_HIDDEN_OFF'), $matches[1]),
				'<div class="hidebox"><div class="hidebox_title">{HIDDEN_OFF}</div><div>{UNHIDDEN_TEXT}</div></div>'
			);
		}
	}
}
