<?php
/**
*
* @package ABBC3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\migrations;

class convert extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['abbc3_version']) && version_compare($this->config['abbc3_version'], '3.1.0', '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_data()
	{
		return array(
			// Custom functions
			array('custom', array(array($this, 'delete_abbc3_bbcodes'))),
			array('custom', array(array($this, 'update_abbc3_bbcodes'))),

			// Keep track of version in the database
			array('config.add', array('abbc3_version', '3.1.0')),
		);
	}

	public function delete_abbc3_bbcodes()
	{
		$abbc3_bbcode_deprecated = $this->abbc3_bbcodes();

		// Add all breaks and divisions to the array
		$sql = 'SELECT bbcode_tag
			FROM ' . BBCODES_TABLE . "
			WHERE bbcode_tag LIKE 'break%' OR bbcode_tag LIKE 'division%' ";

		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$abbc3_bbcode_deprecated[] = $row['bbcode_tag'];
		}
		$this->db->sql_freeresult($result);

		// Delete all the unwanted bbcodes
		$sql = 'DELETE FROM ' . BBCODES_TABLE . '
			WHERE ' . $this->db->sql_in_set('bbcode_tag', $abbc3_bbcode_deprecated);
		$this->db->sql_query($sql);
	}
	
	public function update_abbc3_bbcodes()
	{
		$bbcode_data = $this->abbc3_bbcode_data();

		foreach ($bbcode_data as $bbcode_name => $bbcode_array)
		{
			$this->db->sql_query('UPDATE ' . BBCODES_TABLE . ' SET ' . $this->db->sql_build_array('UPDATE', $bbcode_array) . " WHERE lower(bbcode_tag) = '" . strtolower($bbcode_name) ."'");
		}
	}

	public function abbc3_bbcode_data()
	{
		return array(
			'BBvideo' => array(
				'bbcode_tag'			=> 'BBvideo',
				'bbcode_helpline'		=> '[BBvideo]Video URL[/BBvideo]',
				'bbcode_match'			=> '[BBvideo]{URL}[/BBvideo]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[bbvideo\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/bbvideo\]!ie',
				'first_pass_replace'	=> '\'[bbvideo:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/bbvideo:$uid]\'',
				'second_pass_match'		=> '!\[bbvideo:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/bbvideo:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
			'glow=' => array(
				'bbcode_tag'			=> 'glow=',
				'bbcode_helpline'		=> 'Glow text: [glow=color]text[/glow]',
				'bbcode_match'			=> '[glow={COLOR}]{TEXT}[/glow]',
				'bbcode_tpl'			=> '<span class="glow" style="display: inline-block; padding: 0 0.5em; color: #ffffff; text-shadow: 0 0 1.0em {COLOR}, 0 0 1.0em {COLOR}, 0 0 1.2em {COLOR};">{TEXT}</span>',
				'first_pass_match'		=> '!\[glow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/glow\]!ies',
				'first_pass_replace'	=> '\'[glow=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/glow:$uid]\'',
				'second_pass_match'		=> '!\[glow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/glow:$uid\]!s',
				'second_pass_replace'	=> '<span class="glow" style="display: inline-block; padding: 0 0.5em; color: #ffffff; text-shadow: 0 0 1.0em ${1}, 0 0 1.0em ${1}, 0 0 1.2em ${1};">${2}</span>',
			),
			'shadow=' => array(
				'bbcode_tag'			=> 'shadow=',
				'bbcode_helpline'		=> 'Shadow text: [shadow=color]text[/shadow]',
				'bbcode_match'			=> '[shadow={COLOR}]{TEXT}[/shadow]',
				'bbcode_tpl'			=> '<span class="shadow" style="display: inline-block; padding: 0 0.5em; color: {COLOR}; text-shadow: -0.2em 0.2em 0.2em #999;">{TEXT}</span>',
				'first_pass_match'		=> '!\[shadow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/shadow\]!ies',
				'first_pass_replace'	=> '\'[shadow=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/shadow:$uid]\'',
				'second_pass_match'		=> '!\[shadow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/shadow:$uid\]!s',
				'second_pass_replace'	=> '<span class="shadow" style="display: inline-block; padding: 0 0.5em; color: ${1}; text-shadow: -0.2em 0.2em 0.2em #999;">${2}</span>',
			),
			'dropshadow=' => array(
				'bbcode_tag'			=> 'dropshadow=',
				'bbcode_helpline'		=> 'Drop shadow text: [dropshadow=color]text[/dropshadow]',
				'bbcode_match'			=> '[dropshadow={COLOR}]{TEXT}[/dropshadow]',
				'bbcode_tpl'			=> '<span class="dropshadow" style="display: inline-block; padding: 0 0.5em; color: {COLOR}; text-shadow: -0.1em 0.1em 0.05em #999;">{TEXT}</span>',
				'first_pass_match'		=> '!\[dropshadow\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/dropshadow\]!ies',
				'first_pass_replace'	=> '\'[dropshadow=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/dropshadow:$uid]\'',
				'second_pass_match'		=> '!\[dropshadow\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/dropshadow:$uid\]!s',
				'second_pass_replace'	=> '<span class="dropshadow" style="display: inline-block; padding: 0 0.5em; color: ${1}; text-shadow: -0.1em 0.1em 0.05em #999;">${2}</span>',
			),
			'blur=' => array(
				'bbcode_tag'			=> 'blur=',
				'bbcode_helpline'		=> 'Blur text: [blur=color]text[/blur]',
				'bbcode_match'			=> '[blur={COLOR}]{TEXT}[/blur]',
				'bbcode_tpl'			=> '<span class="blur" style="display: inline-block; padding: 0 0.5em; color: transparent; text-shadow: 0 0 0.2em {COLOR};">{TEXT}</span>',
				'first_pass_match'		=> '!\[blur\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/blur\]!ies',
				'first_pass_replace'	=> '\'[blur=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/blur:$uid]\'',
				'second_pass_match'		=> '!\[blur\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/blur:$uid\]!s',
				'second_pass_replace'	=> '<span class="blur" style="display: inline-block; padding: 0 0.5em; color: transparent; text-shadow: 0 0 0.2em ${1};">${2}</span>',
			),
			'fade' => array(
				'bbcode_tag'			=> 'fade',
				'bbcode_helpline'		=> 'Fade text: [fade]text[/fade]',
				'bbcode_match'			=> '[fade]{TEXT}[/fade]',
				'bbcode_tpl'			=> '<div class="fadeEffect">{TEXT}</div>',
				'first_pass_match'		=> '!\[fade\](.*?)\[/fade\]!ies',
				'first_pass_replace'	=> '\'[fade:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/fade:$uid]\'',
				'second_pass_match'		=> '!\[fade:$uid\](.*?)\[/fade:$uid\]!s',
				'second_pass_replace'	=> '<div class="fadeEffect">${1}</div>',
			),
			'mod=' => array(
				'bbcode_tag'			=> 'mod=',
				'bbcode_helpline'		=> 'Alert text: [mod=username]text[/mod]',
				'bbcode_match'			=> '[mod={TEXT1}]{TEXT2}[/mod]',
				'bbcode_tpl'			=> '<table class="ModTable"><tr><td class="exclamation" rowspan="2">&nbsp;!&nbsp;</td><td class="rowuser">{TEXT1} {L_WROTE}:</td></tr><tr><td class="rowtext">{TEXT2}</td></tr></table>',
				'first_pass_match'		=> '!\[mod\=(.*?)\](.*?)\[/mod\]!ies',
				'first_pass_replace'	=> '\'[mod=\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\':$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/mod:$uid]\'',
				'second_pass_match'		=> '!\[mod\=(.*?):$uid\](.*?)\[/mod:$uid\]!s',
				'second_pass_replace'	=> '<table class="ModTable"><tr><td class="exclamation" rowspan="2">&nbsp;!&nbsp;</td><td class="rowuser">${1} {L_WROTE}:</td></tr><tr><td class="rowtext">${2}</td></tr></table>',
			),
			'spoil' => array(
				'bbcode_tag'			=> 'spoil',
				'bbcode_helpline'		=> 'Spoiler text: [spoil]text[/spoil]',
				'bbcode_match'			=> '[spoil]{TEXT}[/spoil]',
				'bbcode_tpl'			=> '<div class="spoilwrapper"><div class="spoiltitle"><span class="btnspoil" data-show="{L_SPOILER_SHOW}" data-hide="{L_SPOILER_HIDE}">{L_SPOILER_SHOW}</span></div><div style="display: none;" class="spoilcontent">{TEXT}</div></div>',
				'first_pass_match'		=> '!\[spoil\](.*?)\[/spoil\]!ies',
				'first_pass_replace'	=> '\'[spoil:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/spoil:$uid]\'',
				'second_pass_match'		=> '!\[spoil:$uid\](.*?)\[/spoil:$uid\]!s',
				'second_pass_replace'	=> '<div class="spoilwrapper"><div class="spoiltitle"><span class="btnspoil" data-show="{L_SPOILER_SHOW}" data-hide="{L_SPOILER_HIDE}">{L_SPOILER_SHOW}</span></div><div style="display: none;" class="spoilcontent">${1}</div></div>',
			),
			'nfo' => array(
				'bbcode_tag'			=> 'nfo',
				'bbcode_helpline'		=> 'NFO ascii art text: [nfo]NFO text[/nfo]',
				'bbcode_match'			=> '[nfo]{TEXT}[/nfo]',
				'bbcode_tpl'			=> '<pre class="nfo">{TEXT}</pre>',
				'first_pass_match'		=> '!\[nfo\](.*?)\[/nfo\]!ies',
				'first_pass_replace'	=> '\'[nfo:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/nfo:$uid]\'',
				'second_pass_match'		=> '!\[nfo:$uid\](.*?)\[/nfo:$uid\]!s',
				'second_pass_replace'	=> '<pre class="nfo">${1}</pre>',
			),
			'offtopic' => array(
				'bbcode_tag'			=> 'offtopic',
				'bbcode_helpline'		=> 'Off topic text: [offtopic]text[/offtopic]',
				'bbcode_match'			=> '[offtopic]{TEXT}[/offtopic]',
				'bbcode_tpl'			=> '<div class="OffTopic"><div class="OffTopicTitle">{L_OFFTOPIC}</div><div class="OffTopicText">{TEXT}</div></div>',
				'first_pass_match'		=> '!\[offtopic\](.*?)\[/offtopic\]!ies',
				'first_pass_replace'	=> '\'[offtopic:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/offtopic:$uid]\'',
				'second_pass_match'		=> '!\[offtopic:$uid\](.*?)\[/offtopic:$uid\]!s',
				'second_pass_replace'	=> '<div class="OffTopic"><div class="OffTopicTitle">{L_OFFTOPIC}</div><div class="OffTopicText">${1}</div></div>',
			),
			'hidden' => array(
				'bbcode_tag'			=> 'hidden',
				'bbcode_helpline'		=> 'Hide text from guests: [hidden]text[/hidden]',
				'bbcode_match'			=> '[hidden]{TEXT}[/hidden]',
				'bbcode_tpl'			=> '<!-- ABBC3_BBCODE_HIDDEN -->{TEXT}<!-- ABBC3_BBCODE_HIDDEN -->',
				'first_pass_match'		=> '!\[hidden\](.*?)\[/hidden\]!ies',
				'first_pass_replace'	=> '\'[hidden:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/hidden:$uid]\'',
				'second_pass_match'		=> '!\[hidden:$uid\](.*?)\[/hidden:$uid\]!s',
				'second_pass_replace'	=> '<!-- ABBC3_BBCODE_HIDDEN -->${1}<!-- ABBC3_BBCODE_HIDDEN -->',
			),
			'align=center' => array(
				'bbcode_tag'			=> 'align=',
				'bbcode_helpline'		=> 'Align text: [align=center|left|right|justify]text[/align]',
				'bbcode_match'			=> '[align={SIMPLETEXT}]{TEXT}[/align]',
				'bbcode_tpl'			=> '<span style="text-align: {SIMPLETEXT}; display: block;">{TEXT}</span>',
				'first_pass_match'		=> '!\[align\=([a-zA-Z0-9-+.,_ ]+)\](.*?)\[/align\]!ies',
				'first_pass_replace'	=> '\'[align=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/align:$uid]\'',
				'second_pass_match'		=> '!\[align\=([a-zA-Z0-9-+.,_ ]+):$uid\](.*?)\[/align:$uid\]!s',
				'second_pass_replace'	=> '<span style="text-align: ${1}; display: block;">${2}</span>',
			),
			'dir=ltr' => array(
				'bbcode_tag'			=> 'dir=',
				'bbcode_helpline'		=> 'Text direction: [dir=ltr|rtl]text[/dir]',
				'bbcode_match'			=> '[dir={SIMPLETEXT}]{TEXT}[/dir]',
				'bbcode_tpl'			=> '<bdo dir="{SIMPLETEXT}">{TEXT}</bdo>',
				'first_pass_match'		=> '!\[dir\=([a-zA-Z0-9-+.,_ ]+)\](.*?)\[/dir\]!ies',
				'first_pass_replace'	=> '\'[dir=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/dir:$uid]\'',
				'second_pass_match'		=> '!\[dir\=([a-zA-Z0-9-+.,_ ]+):$uid\](.*?)\[/dir:$uid\]!s',
				'second_pass_replace'	=> '<bdo dir="${1}">${2}</bdo>',
			),
			'marq=up' => array(
				'bbcode_tag'			=> 'marq=',
				'bbcode_helpline'		=> 'Marquee text: [marq=up|down|left|right]text[/marq]',
				'bbcode_match'			=> '[marq={SIMPLETEXT}]{TEXT}[/marq]',
				'bbcode_tpl'			=> '<marquee direction="{SIMPLETEXT}" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">{TEXT}</marquee>',
				'first_pass_match'		=> '!\[marq\=([a-zA-Z0-9-+.,_ ]+)\](.*?)\[/marq\]!ies',
				'first_pass_replace'	=> '\'[marq=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/marq:$uid]\'',
				'second_pass_match'		=> '!\[marq\=([a-zA-Z0-9-+.,_ ]+):$uid\](.*?)\[/marq:$uid\]!s',
				'second_pass_replace'	=> '<marquee direction="${1}" scrolldelay="100" onmouseover="this.scrollDelay=10000000;" onmouseout="this.scrollDelay=100;">${2}</marquee>',
			),
			'font=' => array(
				'bbcode_tag'			=> 'font=',
				'bbcode_helpline'		=> 'Font Type: [font=Comic Sans MS]text[/font]',
				'bbcode_match'			=> '[font={INTTEXT}]{TEXT}[/font]',
				'bbcode_tpl'			=> '<span style="font-family: {INTTEXT};">{TEXT}</span>',
				'first_pass_match'		=> '!\[font\=([\p{L}\p{N}\-+,_. ]+)\](.*?)\[/font\]!iues',
				'first_pass_replace'	=> '\'[font=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/font:$uid]\'',
				'second_pass_match'		=> '!\[font\=([\p{L}\p{N}\-+,_. ]+):$uid\](.*?)\[/font:$uid\]!su',
				'second_pass_replace'	=> '<span style="font-family: ${1};">${2}</span>',
			),
			'highlight=' => array(
				'bbcode_tag'			=> 'highlight=',
				'bbcode_helpline'		=> 'Highlight text: [highlight=yellow]text[/highlight]',
				'bbcode_match'			=> '[highlight={COLOR}]{TEXT}[/highlight]',
				'bbcode_tpl'			=> '<span style="background-color: {COLOR};">{TEXT}</span>',
				'first_pass_match'		=> '!\[highlight\=([a-z]+|#[0-9abcdef]+)\](.*?)\[/highlight\]!ies',
				'first_pass_replace'	=> '\'[highlight=${1}:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${2}\')).\'[/highlight:$uid]\'',
				'second_pass_match'		=> '!\[highlight\=([a-zA-Z]+|#[0-9abcdefABCDEF]+):$uid\](.*?)\[/highlight:$uid\]!s',
				'second_pass_replace'	=> '<span style="background-color: ${1};">${2}</span>',
			),
			's' => array(
				'bbcode_tag'			=> 's',
				'bbcode_helpline'		=> 'Strike-through text: [s]text[/s]',
				'bbcode_match'			=> '[s]{TEXT}[/s]',
				'bbcode_tpl'			=> '<span style="text-decoration: line-through;">{TEXT}</span>',
				'first_pass_match'		=> '!\[s\](.*?)\[/s\]!ies',
				'first_pass_replace'	=> '\'[s:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/s:$uid]\'',
				'second_pass_match'		=> '!\[s:$uid\](.*?)\[/s:$uid\]!s',
				'second_pass_replace'	=> '<span style="text-decoration: line-through;">${1}</span>',
			),
			'sup' => array(
				'bbcode_tag'			=> 'sup',
				'bbcode_helpline'		=> 'Superscript text: [sup]text[/sup]',
				'bbcode_match'			=> '[sup]{TEXT}[/sup]',
				'bbcode_tpl'			=> '<sup>{TEXT}</sup>',
				'first_pass_match'		=> '!\[sup\](.*?)\[/sup\]!ies',
				'first_pass_replace'	=> '\'[sup:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/sup:$uid]\'',
				'second_pass_match'		=> '!\[sup:$uid\](.*?)\[/sup:$uid\]!s',
				'second_pass_replace'	=> '<sup>${1}</sup>',
			),
			'sub' => array(
				'bbcode_tag'			=> 'sub',
				'bbcode_helpline'		=> 'Subscript text: [sub]text[/sub]',
				'bbcode_match'			=> '[sub]{TEXT}[/sub]',
				'bbcode_tpl'			=> '<sub>{TEXT}</sub>',
				'first_pass_match'		=> '!\[sub\](.*?)\[/sub\]!ies',
				'first_pass_replace'	=> '\'[sub:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/sub:$uid]\'',
				'second_pass_match'		=> '!\[sub:$uid\](.*?)\[/sub:$uid\]!s',
				'second_pass_replace'	=> '<sub>${1}</sub>',
			),
			'pre' => array(
				'bbcode_tag'			=> 'pre',
				'bbcode_helpline'		=> 'Preformatted text: [pre]text[/pre]',
				'bbcode_match'			=> '[pre]{TEXT}[/pre]',
				'bbcode_tpl'			=> '<pre>{TEXT}</pre>',
				'first_pass_match'		=> '!\[pre\](.*?)\[/pre\]!ies',
				'first_pass_replace'	=> '\'[pre:$uid]\'.str_replace(array("\r\n", \'\"\', \'\\\'\', \'(\', \')\'), array("\n", \'"\', \'&#39;\', \'&#40;\', \'&#41;\'), trim(\'${1}\')).\'[/pre:$uid]\'',
				'second_pass_match'		=> '!\[pre:$uid\](.*?)\[/pre:$uid\]!s',
				'second_pass_replace'	=> '<pre>${1}</pre>',
			),
			'collegehumor' => array(
				'bbcode_tag'			=> 'collegehumor',
				'bbcode_helpline'		=> 'CollegHumor Video: [collegehumor]URL[/collegehumor]',
				'bbcode_match'			=> '[collegehumor]{URL}[/collegehumor]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[collegehumor\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/collegehumor\]!ie',
				'first_pass_replace'	=> '\'[collegehumor:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/collegehumor:$uid]\'',
				'second_pass_match'		=> '!\[collegehumor:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/collegehumor:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
			'dm' => array(
				'bbcode_tag'			=> 'dm',
				'bbcode_helpline'		=> 'Daily Motion Video: [dm]URL[/dm]',
				'bbcode_match'			=> '[dm]{URL}[/dm]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[dm\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/dm\]!ie',
				'first_pass_replace'	=> '\'[dm:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/dm:$uid]\'',
				'second_pass_match'		=> '!\[dm:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/dm:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
			'gamespot' => array(
				'bbcode_tag'			=> 'gamespot',
				'bbcode_helpline'		=> 'GameSpot Video: [gamespot]URL[/gamespot]',
				'bbcode_match'			=> '[gamespot]{URL}[/gamespot]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[gamespot\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/gamespot\]!ie',
				'first_pass_replace'	=> '\'[gamespot:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/gamespot:$uid]\'',
				'second_pass_match'		=> '!\[gamespot:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/gamespot:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
			'ignvideo' => array(
				'bbcode_tag'			=> 'ignvideo',
				'bbcode_helpline'		=> 'IGN Video: [ignvideo]URL[/ignvideo]',
				'bbcode_match'			=> '[ignvideo]{URL}[/ignvideo]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[ignvideo\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/ignvideo\]!ie',
				'first_pass_replace'	=> '\'[ignvideo:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/ignvideo:$uid]\'',
				'second_pass_match'		=> '!\[ignvideo:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/ignvideo:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
			'liveleak' => array(
				'bbcode_tag'			=> 'liveleak',
				'bbcode_helpline'		=> 'LiveLeak Video: [liveleak]URL[/liveleak]',
				'bbcode_match'			=> '[liveleak]{URL}[/liveleak]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[liveleak\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/liveleak\]!ie',
				'first_pass_replace'	=> '\'[liveleak:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/liveleak:$uid]\'',
				'second_pass_match'		=> '!\[liveleak:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/liveleak:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
			'veoh' => array(
				'bbcode_tag'			=> 'veoh',
				'bbcode_helpline'		=> 'Veoh Video: [veoh]URL[/veoh]',
				'bbcode_match'			=> '[veoh]{URL}[/veoh]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[veoh\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/veoh\]!ie',
				'first_pass_replace'	=> '\'[veoh:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/veoh:$uid]\'',
				'second_pass_match'		=> '!\[veoh:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/veoh:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
			'youtube' => array(
				'bbcode_tag'			=> 'youtube',
				'bbcode_helpline'		=> 'YouTube Video: [youtube]URL[/youtube]',
				'bbcode_match'			=> '[youtube]{URL}[/youtube]',
				'bbcode_tpl'			=> '<a href="{URL}" class="bbvideo" data-bbvideo="560,340">{URL}</a>',
				'first_pass_match'		=> '!\[youtube\](?:([a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))\[/youtube\]!ie',
				'first_pass_replace'	=> '\'[youtube:$uid]\'.$this->bbcode_specialchars((\'${1}\') ? \'${1}\' : \'http://${2}\').\'[/youtube:$uid]\'',
				'second_pass_match'		=> '!\[youtube:$uid\](?i)((?:[a-z][a-z\d+\-.]*:/{2}(?:(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+|[0-9.]+|\[[a-z0-9.]+:[a-z0-9.]+:[a-z0-9.:]+\])(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?)|(?:www\.(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})+(?::\d*)?(?:/(?:[a-z0-9\-._~\!$&\'()*+,;=:@|]+|%[\dA-F]{2})*)*(?:\?(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?(?:#(?:[a-z0-9\-._~\!$&\'()*+,;=:@/?|]+|%[\dA-F]{2})*)?))(?-i)\[/youtube:$uid\]!s',
				'second_pass_replace'	=> '<a href="${1}" class="bbvideo" data-bbvideo="560,340">${1}</a>',
			),
		);
	}

	public function abbc3_bbcodes()
	{
		return array(
			// exist in core
			'b',
			'code',
			'color',
			'email',
			'flash',
			'i',
			'img=',
			'listb',
			'listitem',
			'listo',
			'quote',
			'size',			
			'u',
			'url',
			'url=',

			// deprecated
			'click',		// click_pass
			'ed2k',
			'flv',			// auto_embed_video
			'quicktime',
			'ram',
			'rapidshare',	// rapidshare_pass
			'stream',
			'testlink',		// testlink_pass
			'video',
			'wave=',		// Text_effect_pass
			'web',
	 		'scrippet',		// scrippets_pass
	 		'search',		// search_pass
			'thumbnail',	// thumb_pass
			'hr',			// no closing
			'tab=',			// no closing
	 		'tabs',			// simpleTabs_pass
	 		'table=',		// table_pass
	 		'anchor=',		// anchor_pass

			// not really bbcodes
			'copy',
			'cut',
			'grad',
			'paste',
			'plain',
			'imgshack',

			// replaced by new bbcodes
			'align=justify',	// replaced by align=
			'align=left',		// replaced by align=
			'align=right',		// replaced by align=
			'dir=rtl',			// replaced by dir=
			'marq=down',		// replaced by marq=
			'marq=left',		// replaced by marq=
			'marq=right',		// replaced by marq=

			// updated bbcodes
	//		'align=center',	// replaced by align=
	//		'blur=',		// Text_effect_pass
	//		'collegehumor',	// auto_embed_video
	//		'dir=ltr',		// replaced by dir=
	//		'dm',			// auto_embed_video
	//		'dropshadow=',	// Text_effect_pass
	//		'fade',
	//		'font=',
	//		'gamespot',		// auto_embed_video
	//		'glow=',		// Text_effect_pass
	//		'highlight=',
	//		'ignvideo',		// auto_embed_video
	//		'liveleak',		// auto_embed_video
	//		'marq=up',		// replaced by marq=
	//		'mod=',			// mod_pass
	//		'nfo',			// nfo_pass
	//		'offtopic',		// offtopic_pass
	//		'pre',
	//		's',
	//		'shadow=',		// Text_effect_pass
	//		'spoil',		// spoil_pass
	//		'sub',
	//		'sup',
	//		'veoh',			// auto_embed_video
	//		'youtube',		// BBvideo_pass
	// 		'BBvideo',		// BBvideo_pass
	// 		'hidden',		// hidden_pass

		);
	}
}
