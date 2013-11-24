<?php
/**
*
* @package ABBC3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\migrations;

class v310_update_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['abbc3_version']) && version_compare($this->config['abbc3_version'], '3.1.0', '>=');
	}

	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_update_schema');
	}

	public function update_data()
	{
		return array(
			array('custom', array(array($this, 'update_abbc3_bbcodes'))),

			array('config.add', array('abbc3_version', '3.1.0')),
		);
	}

	public function update_abbc3_bbcodes()
	{
		// Load the acp_bbcode class
		if (!class_exists('acp_bbcodes'))
		{
			include($this->phpbb_root_path . 'includes/acp/acp_bbcodes.' . $this->php_ext);
		}
		$bbcode_module = new \acp_bbcodes();
			
		$bbcode_data = $this->abbc3_bbcode_data();

		foreach ($bbcode_data as $bbcode_name => $bbcode_array)
		{
			// Build the BBCodes
			$data = $bbcode_module->build_regexp($bbcode_array['bbcode_match'], $bbcode_array['bbcode_tpl']);

			$bbcode_array += array(
				'first_pass_match'			=> $data['first_pass_match'],
				'first_pass_replace'		=> $data['first_pass_replace'],
				'second_pass_match'			=> $data['second_pass_match'],
				'second_pass_replace'		=> $data['second_pass_replace']
			);
			
			$sql = 'SELECT bbcode_id
					FROM ' . $this->table_prefix . "bbcodes
					WHERE LOWER(bbcode_tag) = '" . strtolower($bbcode_name) . "' OR LOWER(bbcode_tag) = '" . strtolower($bbcode_array['bbcode_tag']) . "'";
			$result = $this->db->sql_query($sql);
			$row_exists = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($row_exists)
			{
				// Update exisiting BBcode
				$bbcode_id = $row_exists['bbcode_id'];

				$sql = 'UPDATE ' . $this->table_prefix . 'bbcodes
						SET ' . $this->db->sql_build_array('UPDATE', $bbcode_array) . '
						WHERE bbcode_id = ' . $bbcode_id;
				$this->db->sql_query($sql);
			}
			else
			{
				// Create new BBcode
				$sql = 'SELECT MAX(bbcode_id) AS max_bbcode_id
					FROM ' . $this->table_prefix . 'bbcodes';
				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);
				$this->db->sql_freeresult($result);

				if ($row)
				{
					$bbcode_id = $row['max_bbcode_id'] + 1;

					// Make sure it is greater than the core bbcode ids...
					if ($bbcode_id <= NUM_CORE_BBCODES)
					{
						$bbcode_id = NUM_CORE_BBCODES + 1;
					}
				}
				else
				{
					$bbcode_id = NUM_CORE_BBCODES + 1;
				}

				if ($bbcode_id <= BBCODE_LIMIT)
				{
					$bbcode_array['bbcode_id'] = (int) $bbcode_id;
					$bbcode_array['display_on_posting'] = 1;

					$this->db->sql_query('INSERT INTO ' . $this->table_prefix . 'bbcodes ' . $this->db->sql_build_array('INSERT', $bbcode_array));
				}
			}
		}
	}

	public function abbc3_bbcode_data()
	{
		return array(
			'BBvideo' => array(
				'bbcode_tag'			=> 'BBvideo=',
				'bbcode_helpline'		=> '[BBvideo=width,height]Video URL[/BBvideo]',
				'bbcode_match'			=> '[BBvideo={NUMBER1},{NUMBER2}]{URL}[/BBvideo]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="{NUMBER1},{NUMBER2}">{URL}</a>',
			),
			'glow=' => array(
				'bbcode_tag'			=> 'glow=',
				'bbcode_helpline'		=> 'Glow text: [glow=color]text[/glow]',
				'bbcode_match'			=> '[glow={COLOR}]{TEXT}[/glow]',
				'bbcode_tpl'			=> '<span class="glow" style="display: inline-block; padding: 0 0.5em; color: #ffffff; text-shadow: 0 0 1em {COLOR}, 0 0 1em {COLOR}, 0 0 1.2em {COLOR};">{TEXT}</span>',
			),
			'shadow=' => array(
				'bbcode_tag'			=> 'shadow=',
				'bbcode_helpline'		=> 'Shadow text: [shadow=color]text[/shadow]',
				'bbcode_match'			=> '[shadow={COLOR}]{TEXT}[/shadow]',
				'bbcode_tpl'			=> '<span class="shadow" style="display: inline-block; padding: 0 0.5em; color: {COLOR}; text-shadow: -0.2em 0.2em 0.2em #999;">{TEXT}</span>',
			),
			'dropshadow=' => array(
				'bbcode_tag'			=> 'dropshadow=',
				'bbcode_helpline'		=> 'Drop shadow text: [dropshadow=color]text[/dropshadow]',
				'bbcode_match'			=> '[dropshadow={COLOR}]{TEXT}[/dropshadow]',
				'bbcode_tpl'			=> '<span class="dropshadow" style="display: inline-block; padding: 0 0.5em; color: {COLOR}; text-shadow: -0.1em 0.1em 0.05em #999;">{TEXT}</span>',
			),
			'blur=' => array(
				'bbcode_tag'			=> 'blur=',
				'bbcode_helpline'		=> 'Blur text: [blur=color]text[/blur]',
				'bbcode_match'			=> '[blur={COLOR}]{TEXT}[/blur]',
				'bbcode_tpl'			=> '<span class="blur" style="display: inline-block; padding: 0 0.5em; color: transparent; text-shadow: 0 0 0.2em {COLOR};">{TEXT}</span>',
			),
			'fade' => array(
				'bbcode_tag'			=> 'fade',
				'bbcode_helpline'		=> 'Fade text: [fade]text[/fade]',
				'bbcode_match'			=> '[fade]{TEXT}[/fade]',
				'bbcode_tpl'			=> '<span class="fadeEffect">{TEXT}</span>',
			),
			'mod=' => array(
				'bbcode_tag'			=> 'mod=',
				'bbcode_helpline'		=> 'Alert text: [mod=username]text[/mod]',
				'bbcode_match'			=> '[mod={TEXT1}]{TEXT2}[/mod]',
				'bbcode_tpl'			=> '<table class="ModTable"><tr><td class="exclamation" rowspan="2">&nbsp;!&nbsp;</td><td class="rowuser">{TEXT1} {L_MESSAGE}:</td></tr><tr><td class="rowtext">{TEXT2}</td></tr></table>',
			),
			'spoil' => array(
				'bbcode_tag'			=> 'spoil',
				'bbcode_helpline'		=> 'Spoiler text: [spoil]text[/spoil]',
				'bbcode_match'			=> '[spoil]{TEXT}[/spoil]',
				'bbcode_tpl'			=> '<div class="spoilwrapper"><div class="spoiltitle"><span class="btnspoil" data-show="{L_SPOILER_SHOW}" data-hide="{L_SPOILER_HIDE}">{L_SPOILER_SHOW}</span></div><div style="display: none;" class="spoilcontent">{TEXT}</div></div>',
			),
			'nfo' => array(
				'bbcode_tag'			=> 'nfo',
				'bbcode_helpline'		=> 'NFO ascii art text: [nfo]NFO text[/nfo]',
				'bbcode_match'			=> '[nfo]{TEXT}[/nfo]',
				'bbcode_tpl'			=> '<pre class="nfo">{TEXT}</pre>',
			),
			'offtopic' => array(
				'bbcode_tag'			=> 'offtopic',
				'bbcode_helpline'		=> 'Off topic text: [offtopic]text[/offtopic]',
				'bbcode_match'			=> '[offtopic]{TEXT}[/offtopic]',
				'bbcode_tpl'			=> '<div class="OffTopic"><div class="OffTopicTitle">{L_OFFTOPIC}</div><div class="OffTopicText">{TEXT}</div></div>',
			),
			'hidden' => array(
				'bbcode_tag'			=> 'hidden',
				'bbcode_helpline'		=> 'Hide text from guests: [hidden]text[/hidden]',
				'bbcode_match'			=> '[hidden]{TEXT}[/hidden]',
				'bbcode_tpl'			=> '<!-- ABBC3_BBCODE_HIDDEN -->{TEXT}<!-- ABBC3_BBCODE_HIDDEN -->',
			),
			'align=center' => array(
				'bbcode_tag'			=> 'align=',
				'bbcode_helpline'		=> 'Align text: [align=center|left|right|justify]text[/align]',
				'bbcode_match'			=> '[align={SIMPLETEXT}]{TEXT}[/align]',
				'bbcode_tpl'			=> '<span style="text-align: {SIMPLETEXT}; display: block;">{TEXT}</span>',
			),
			'dir=ltr' => array(
				'bbcode_tag'			=> 'dir=',
				'bbcode_helpline'		=> 'Text direction: [dir=ltr|rtl]text[/dir]',
				'bbcode_match'			=> '[dir={SIMPLETEXT}]{TEXT}[/dir]',
				'bbcode_tpl'			=> '<bdo dir="{SIMPLETEXT}">{TEXT}</bdo>',
			),
			'marq=up' => array(
				'bbcode_tag'			=> 'marq=',
				'bbcode_helpline'		=> 'Marquee text: [marq=up|down|left|right]text[/marq]',
				'bbcode_match'			=> '[marq={SIMPLETEXT}]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee direction="{SIMPLETEXT}" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
			),
			'font=' => array(
				'bbcode_tag'			=> 'font=',
				'bbcode_helpline'		=> 'Font Type: [font=Comic Sans MS]text[/font]',
				'bbcode_match'			=> '[font={INTTEXT}]{TEXT}[/font]',
				'bbcode_tpl'			=> '<span style="font-family: {INTTEXT};">{TEXT}</span>',
			),
			'highlight=' => array(
				'bbcode_tag'			=> 'highlight=',
				'bbcode_helpline'		=> 'Highlight text: [highlight=yellow]text[/highlight]',
				'bbcode_match'			=> '[highlight={COLOR}]{TEXT}[/highlight]',
				'bbcode_tpl'			=> '<span style="background-color: {COLOR};">{TEXT}</span>',
			),
			's' => array(
				'bbcode_tag'			=> 's',
				'bbcode_helpline'		=> 'Strike-through text: [s]text[/s]',
				'bbcode_match'			=> '[s]{TEXT}[/s]',
				'bbcode_tpl'			=> '<span style="text-decoration: line-through;">{TEXT}</span>',
			),
			'sup' => array(
				'bbcode_tag'			=> 'sup',
				'bbcode_helpline'		=> 'Superscript text: [sup]text[/sup]',
				'bbcode_match'			=> '[sup]{TEXT}[/sup]',
				'bbcode_tpl'			=> '<sup>{TEXT}</sup>',
			),
			'sub' => array(
				'bbcode_tag'			=> 'sub',
				'bbcode_helpline'		=> 'Subscript text: [sub]text[/sub]',
				'bbcode_match'			=> '[sub]{TEXT}[/sub]',
				'bbcode_tpl'			=> '<sub>{TEXT}</sub>',
			),
			'pre' => array(
				'bbcode_tag'			=> 'pre',
				'bbcode_helpline'		=> 'Preformatted text: [pre]text[/pre]',
				'bbcode_match'			=> '[pre]{TEXT}[/pre]',
				'bbcode_tpl'			=> '<pre>{TEXT}</pre>',
			),
			'youtube' => array(
				'bbcode_tag'			=> 'youtube',
				'bbcode_helpline'		=> 'YouTube Video: [youtube]URL[/youtube]',
				'bbcode_match'			=> '[youtube]{URL}[/youtube]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
			),
			'soundcloud' => array(
				'bbcode_tag'			=> 'soundcloud',
				'bbcode_helpline'		=> '[soundcloud]http://soundcloud.com/user-name/song-title[/soundcloud]',
				'bbcode_match'			=> '[soundcloud]{URL}[/soundcloud]',
				'bbcode_tpl'			=> '<object height="81" width="100%"><param name="movie" value="http://player.soundcloud.com/player.swf?url={URL}&amp;g=bb"></param><param name="allowscriptaccess" value="always"></param><embed allowscriptaccess="always" height="81" src="http://player.soundcloud.com/player.swf?url={URL}&amp;g=bb" type="application/x-shockwave-flash" width="100%"></embed></object>',
			),
		);
	}
}
