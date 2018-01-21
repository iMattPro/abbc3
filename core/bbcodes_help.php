<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2017 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\core;

use phpbb\db\driver\driver_interface;
use phpbb\language\language;
use phpbb\template\template;
use phpbb\user;

/**
 * ABBC3 core BBCodes parser class
 */
class bbcodes_help
{
	/** @var driver_interface */
	protected $db;

	/** @var language */
	protected $language;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;
	/**
	 * @var \vse\abbc3\core\bbcodes_display
	 */
	private $bbcodes_display;

	/**
	 * Constructor
	 *
	 * @param \vse\abbc3\core\bbcodes_display   $bbcodes_display
	 * @param \phpbb\db\driver\driver_interface $db
	 * @param language                          $language
	 * @param \phpbb\template\template          $template
	 * @param \phpbb\user                       $user
	 */
	public function __construct(bbcodes_display $bbcodes_display, driver_interface $db, language $language, template $template, user $user)
	{
		$this->bbcodes_display = $bbcodes_display;
		$this->db = $db;
		$this->language = $language;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	 * Generate BBCode help FAQ for ABBC3's custom BBCodes
	 */
	public function faq()
	{
		// Set the block template data
		$this->template->assign_block_vars('faq_block', [
			'BLOCK_TITLE'	=> $this->language->lang('ABBC3_FAQ_TITLE'),
			'SWITCH_COLUMN'	=> false,
		]);

		$example_text = $this->language->lang('ABBC3_FAQ_SAMPLE_TEXT');
		$abbc3_faq_data = array_intersect_key([
			'ABBC3_FONT_HELPLINE'		=> "[font=Comic Sans MS]{$example_text}[/font]",
			'ABBC3_HIGHLIGHT_HELPLINE'	=> "[highlight=yellow]{$example_text}[/highlight]",
			'ABBC3_ALIGN_HELPLINE'		=> "[align=center]{$example_text}[/align]",
			'ABBC3_FLOAT_HELPLINE'		=> "[float=right]{$example_text}[/float]",
			'ABBC3_STRIKE_HELPLINE'		=> "[s]{$example_text}[/s]",
			'ABBC3_SUB_HELPLINE'		=> "[sub]{$example_text}[/sub] {$example_text}",
			'ABBC3_SUP_HELPLINE'		=> "[sup]{$example_text}[/sup] {$example_text}",
			'ABBC3_GLOW_HELPLINE'		=> "[glow=red]{$example_text}[/glow]",
			'ABBC3_SHADOW_HELPLINE'		=> "[shadow=blue]{$example_text}[/shadow]",
			'ABBC3_DROPSHADOW_HELPLINE'	=> "[dropshadow=blue]{$example_text}[/dropshadow]",
			'ABBC3_BLUR_HELPLINE'		=> "[blur=blue]{$example_text}[/blur]",
			'ABBC3_FADE_HELPLINE'		=> "[fade]{$example_text}[/fade]",
			'ABBC3_PREFORMAT_HELPLINE'	=> "[pre]{$example_text}\n\t{$example_text}[/pre]",
			'ABBC3_DIR_HELPLINE'		=> "[dir=rtl]{$example_text}[/dir]",
			'ABBC3_MARQUEE_HELPLINE'	=> "[marq=left]{$example_text}[/marq]",
			'ABBC3_SPOILER_HELPLINE'	=> "[spoil]{$example_text}[/spoil]",
			'ABBC3_HIDDEN_HELPLINE'		=> "[hidden]{$example_text}[/hidden]",
			'ABBC3_MOD_HELPLINE'		=> "[mod=\"{$this->language->lang('USERNAME')}\"]{$example_text}[/mod]",
			'ABBC3_OFFTOPIC_HELPLINE'	=> "[offtopic]{$example_text}[/offtopic]",
			'ABBC3_NFO_HELPLINE'		=> '[nfo]༼ つ ◕_◕ ༽つ    ʕ•ᴥ•ʔ   ¯\_(ツ)_/¯[/nfo]',
			'ABBC3_BBVIDEO_HELPLINE'	=> '[bbvideo]http://www.youtube.com/watch?v=sP4NMoJcFd4[/bbvideo]',
		], $this->allowed_bbcodes());

		// Process faq data for display as parsed and un-parsed bbcodes
		foreach ($abbc3_faq_data as $key => $question)
		{
			$uid = $bitfield = $flags = '';
			generate_text_for_storage($question, $uid, $bitfield, $flags, true);
			$example = generate_text_for_edit($question, $uid, $flags);
			$result = generate_text_for_display($question, $uid, $bitfield, $flags);
			$title = explode(':', $this->language->lang($key), 2);

			$this->template->assign_block_vars('faq_block.faq_row', [
				'FAQ_QUESTION'	=> $title[0],
				'FAQ_ANSWER'	=> $this->language->lang('ABBC3_FAQ_ANSWER', $title[1], $example['text'], $result),
			]);
		}
	}

	/**
	 * Get custom BBCodes the current user is allowed to use
	 *
	 * @return array
	 */
	protected function allowed_bbcodes()
	{
		$allowed = [];
		$sql = 'SELECT bbcode_helpline, bbcode_group
			FROM ' . BBCODES_TABLE . '
			WHERE bbcode_helpline ' . $this->db->sql_like_expression('ABBC3_' . $this->db->get_any_char()) . '
				AND display_on_posting = 1';
		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			if ($this->bbcodes_display->user_in_bbcode_group($row['bbcode_group']))
			{
				$allowed[$row['bbcode_helpline']] = true;
			}
		}
		$this->db->sql_freeresult($result);

		return $allowed;
	}
}
