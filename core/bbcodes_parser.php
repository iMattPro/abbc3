<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\core;

use phpbb\user;
use vse\abbc3\ext;

/**
 * ABBC3 core BBCodes parser class
 */
class bbcodes_parser
{
	/** @var user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param user $user User object
	 * @access public
	 */
	public function __construct(user $user)
	{
		$this->user = $user;
	}

	/**
	 * Pre-Parser for special custom BBCodes created by ABBC3
	 *
	 * @param string $text The text to parse
	 * @param string $uid  The BBCode UID
	 * @return string The parsed text
	 * @access public
	 */
	public function pre_parse_bbcodes($text, $uid)
	{
		// bbvideo BBCodes (convert from older ABBC3 installations)
		$text = preg_replace_callback('#\[(bbvideo)[\s]?([0-9,]+)?:(' . $uid . ')\]([^[]+)\[/\1:\3\]#is', array($this, 'bbvideo_pass'), $text);

		return $text;
	}

	/**
	 * Post-Parser for special custom BBCodes created by ABBC3
	 *
	 * @param string $text The text to parse
	 * @return string The parsed text
	 * @access public
	 */
	public function post_parse_bbcodes($text)
	{
		// hidden BBCode
		$text = preg_replace_callback('#<!-- ABBC3_BBCODE_HIDDEN -->(.*?)<!-- ABBC3_BBCODE_HIDDEN -->#s', array($this, 'hidden_pass'), $text);

		return $text;
	}

	/**
	 * Convert BBvideo from older ABBC3 posts to the new format
	 *
	 * @param array $matches 1=bbvideo, 2=width,height, 3=uid, 4=url
	 * @return string BBvideo in the correct BBCode format
	 * @access protected
	 */
	protected function bbvideo_pass($matches)
	{
		return (!empty($matches[2])) ?
			"[bbvideo=$matches[2]:$matches[3]]$matches[4][/bbvideo:$matches[3]]" :
			'[bbvideo=' . ext::BBVIDEO_WIDTH . ',' . ext::BBVIDEO_HEIGHT . ":$matches[3]]$matches[4][/bbvideo:$matches[3]]";
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
			$replacements = array(
				$this->user->lang('ABBC3_HIDDEN_ON'),
				$this->user->lang('ABBC3_HIDDEN_EXPLAIN'),
				'hidebox_hidden',
			);
		}
		else
		{
			$replacements = array(
				$this->user->lang('ABBC3_HIDDEN_OFF'),
				$matches[1],
				'hidebox_visible',
			);
		}

		return vsprintf('<div class="hidebox %3$s"><div class="hidebox_title %3$s">%1$s</div><div class="%3$s">%2$s</div></div>', $replacements);
	}
}
