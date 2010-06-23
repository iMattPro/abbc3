<?php
/**
*
* @package phpBB3
* @version $Id: abbcode.php,v 1 2008/01/07 18:18:18 leviatan21 Exp $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @todo ACP config for ABBC3
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

define('IN_ABBC3', true);

/**
* Display the mod and/or buttons
*/
function display_abbc3()
{
	global $template;
	/************************************************************************************
	* Some settings untill I made an ACP control for Advanced bbcode
	************************************************************************************/

	//  Display options
	$abbcode_config = array(
		'ABBC3_MOD'			=> true,	// Display ABBC3 ?
		'ABBC3_LITEBOX'		=> true,	// Display thumbnails with litebox ?
	
		// First line
		'ABBC3_FONTTYPE'	=> true,	// Display dropdown for font type options?
		'ABBC3_FONTSIZE'	=> true,	// Display dropdown for font size options?
		'ABBC3_FONTCOLOR'	=> true,	// Display color button?
		'ABBC3_FONTHILI'	=> true,	// Display dropdown for font highlighted options?
		// Second line
		'ABBC3_ALIGNJUSTIFY'=> true,	// Display icon for [align=justify]text[/align] code.. ?
		'ABBC3_ALIGNCENTER'	=> true,	// Display icon for [align=center]text[/align] code.. ?
		'ABBC3_ALIGNLEFT'	=> true,	// Display icon for [align=left]text[/align] code.. ?
		'ABBC3_ALIGNRIGHT'	=> true,	// Display icon for [align=right]text[/align] code.. ?
		'ABBC3_PRE'			=> true,	// Display icon for [pre]text[/pre] code.. ?
		'ABBC3_SUP'			=> true,	// Display icon for [sup]Superscript[/sup] code.. ?
		'ABBC3_SUB'			=> true,	// Display icon for [sub]Subscrip[/sub] code.. ?
		'ABBC3_BOLD'		=> true,	// Display icon for [b]text[/b] code.. ?
		'ABBC3_ITALIC'		=> true,	// Display icon for [i]text[/i] code.. ?
		'ABBC3_UNDERLINE'	=> true,	// Display icon for [u]text[/u] code.. ?
		'ABBC3_STRIKE'		=> true,	// Display icon for [s]Strikethrough[/s] code.. ?
		'ABBC3_FADE'		=> true,	// Display icon for [fade]Faded text[/fade] code.. ?
		'ABBC3_GRAD'		=> true,	// Display icon for [grad]Gradient text[/grad] code..?
		'ABBC3_RTL'			=> true,	// Display icon for [dir=rtl]Direction[/dir] code.. ?
		'ABBC3_LTR'			=> true,	// Display icon for [dir=ltr]Direction[/dir] code.. ?
		'ABBC3_MARQD'		=> true,	// Display icon for [marquee=down]Marquee text[/marquee] code.. ?
		'ABBC3_MARQU'		=> true,	// Display icon for [marquee=up]Marquee text[/marquee] code.. ?
		'ABBC3_MARQL'		=> true,	// Display icon for [marquee=left]Marquee text[/marquee] code.. ?
		'ABBC3_MARQR'		=> true,	// Display icon for [marquee=right]Marquee text[/marquee] code.. ?
		'ABBC3_TABLE'		=> true,	// Display icon for [table=(ccs style)][tr=(ccs style)][td=(ccs style)]text[/td][/tr][/table] code.. ?
		// Third line
		'ABBC3_CODE'		=> true, 	// Display icon for [CODE] and [/CODE] (for posting code (HTML, PHP, C etc etc) in your posts) code.. ?
		'ABBC3_QUOTE'		=> true,	// Display icon for [QUOTE] and [/QUOTE] (for posting replies with quote, or just for quoting stuff) code.. ?
		'ABBC3_SPOIL'		=> true,	// Display icon for [spoil]Spoiler[/spoil] code.. ?
		'ABBC3_URL'			=> true,	// Display icon for [url=xxxx]Page[/url] or [url]url[/url] code.. ?
		'ABBC3_EMAIL'		=> true,	// Display icon for [email=user@domain.tld]email[/email] o [email]user@domain.tld[/email] code.. ?
		'ABBC3_ED2K'		=> true,	// Display icon for [url]ed2k://[/url] or [url=ed2k://]ed2k[/url] code.. ?
		'ABBC3_WEB'			=> true,	// Display icon for [web]Web Iframe URL[/web] code.. ?
		'ABBC3_IMG'			=> true,	// Display icon for [img]image_url_here[/img] code.. ?
		'ABBC3_THUMB'		=> true,	// Display icon for [thumbnail]image URL[/thumbnail] or [thumbnail=(left|right)]image URL[/thumbnail] code.. ?
		'ABBC3_IMGSHACK'	=> true,	// Display icon for upload pics with ImageShack ?
		'ABBC3_FLASH'		=> true, 	// Display icon for [flash width=X height=X]Flash URL[/flash] code.. ?
		'ABBC3_VIDEO'		=> true,	// Display icon for [video]file Video URL[/video] or [video width=X height=X]file Video URL[/video] code.. ?
		'ABBC3_SOUND'		=> true,	// Display icon for [stream]file Sound URL[/stream] code.. ?
		'ABBC3_QUICKTIME'	=> true,	// Display icon for [quicktime width=X height=X]file Quicktime URL[/quicktime] code..  ?
		'ABBC3_RAM'			=> true,	// Display icon for [ram]file Ram URL[/ram] code.. ?
		'ABBC3_STAGE6'		=> true,	// Display icon for [stage6 width=X height=X]Video ID[/stage6] code.. ?
		'ABBC3_GOOGLEVIDEO'	=> true,	// Display icon for [Gvideo]video.google URL[/Gvideo] code.. ?
		'ABBC3_YOUTUBE'		=> true,	// Display icon for [youtube]YouTube URL[/youtube] code.. ?
		'ABBC3_LISTB'		=> true,	// Display icon for [list][*]text[/list] code.. ?
		'ABBC3_LISTL'		=> true,	// Display icon for [list=(a|1)][*]text[/list] code.. ?
		'ABBC3_HR'			=> true,	// Display icon for [hr] code.. ?
		'ABBC3_CUT'			=> true,	// Display icon for cut selected text ?
		'ABBC3_COPY'		=> true,	// Display icon for copy selected text ?
		'ABBC3_PASTE'		=> true,	// Display icon for paste previous copy text ?
		'ABBC3_PLAIN'		=> true,	// Display icon for delete all bbcodes from selected text ?
		'ABBC3_TAB'			=> true,	// Display icon division for tags ?

		// Config Custom bbcodes
		
	);
	
	foreach ( $abbcode_config as $abbcode_template => $abbcode_value )
	{
		if ($abbcode_value)
		{
			$template->assign_vars(array(
			 'S_' . $abbcode_template => $abbcode_value,
			));
		}
	}
}

/**
* Parse ABBC3 bbodes
*/
function process_abbcode_box ( $text )
{
	global $user;

	// Other seting
	$abbc3_unique_id = substr(base_convert(unique_id(), 16, 36), 0, 8);
	$abbc3_thumb_width = 100 . 'px';
	
	/************************************************************************************
	* Let´s phpbb3 take care of it
	*************************************************************************************
	* 
	* [b]text[/b] code..
	* [i]text[/i] code..
	* [u]text[/u] code..
	* [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	* [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	* [list][*]text[/list] code..
	* [list=(a|1)][*]text[/list] code..
	* [img]image_url_here[/img] code..
	* [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
	* [url=xxxx://www.phpbb.com]phpBB[/url] code..
	* [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).	
	* [email]user@domain.tld[/email] code..
	* [color]text[/color] code..
	*
	************************************************************************************/

	// pad it with a space so we can match things at the start of the 1st line.
	$post_text = ' ' . $text;

	// Patterns and replacements for URL processing
	$abbcode_ary = array (
		// [font=fonttype]text[/font] code..
		"#\[font=(.*?)\](.*?)\[/font\]#si"
		=> '<span style="font-family:\\1">\\2</span>',
		
		// [highlight=color]text[/highlight] code..
		"#\[highlight=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/highlight\]#si"
		=> '<span style="background-color: \\1;">\\2</span>',
		
		// [align=left/center/right/justify]text[/align] code..
		"#\[align=(left|right|center|justify)\](.*?)\[/align\]#si"
		=>	'<div style="text-align:\\1">\\2</div>',

		// [pre]text[/pre] code..
		"#\[pre\](.*?)\[/pre\]#si"
		=>	'<pre>\\1</pre>',
		
		// [sub]Subscrip[/sub] code..
		"#\[sup\](.*?)\[/sup\]#si"
		=>	'<sup>\\1</sup>',
		
		// [sup]Superscript[/sup] code..
		"#\[sub\](.*?)\[/sub\]#si"
		=>	'<sub>\\1</sub>',
		
		// [s]Strikethrough[/s] code..
		"#\[s\](.*?)\[/s\]#si"
		=>	'<strike>\\1</strike>',
		
		// [fade]Faded Text[/fade] code..
		"#\[fade\](.*?)\[/fade\]#si"
		=>	'<span class="fade_link">\\1</span> <script type="text/javascript">fade_ontimer();</script>',
		
		// [marquee=left/right/up/down]Marquee Code[/marquee] code..
		"#\[marq=(left|right|up|down)\](.*?)\[/marq\]#si"
		=>	'<marquee direction="\\1" scrolldelay="120">\\2</marquee>',
		
		// [dir=XXX]Direction[/dir] code..
		"#\[dir=(rtl|ltr)\](.*?)\[/dir\]#si"
		=>	'<PRE><BDO lang="he" dir="\\1">\\2</BDO></PRE>',
		
		// [spoil]Spoiler[/spoil] code..
		"#\[spoil\](.*?)\[/spoil\]#si"
		=>	'<div class="spoilwrapper"><div class="spoiltitle"><input class="btnspoil" type="button" value="' . $user->lang['SPOILER_SHOW'] . '" onClick="javascript:if (this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display != \'\') { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'\'; this.innerText = \'\'; this.value = \'' . $user->lang['SPOILER_HIDE'] . '\'; } else { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'none\'; this.innerText = \'\'; this.value = \'' . $user->lang['SPOILER_SHOW'] .'\'; }" onfocus="this.blur();"></div><div class="spoilcontent"><div style="display: none;">\\1</div></div></div>',
		
		// [hr]
		"#\[hr\]#si"
		=>	'<hr noshade color="#000000" size="1px">',
		
		// [url]ed2k://|file|...[/url] code
		"#\[url\](ed2k://\|file\|(.*?)\|\d+\|\w+\|(h=\w+\|)?/?)\[/url\]#is"
		=>	'<a href="$1" class="postlink">$2</a>',
		// [url=ed2k://|file|...]name[/url] code
		"#\[url=(ed2k://\|file\|(.*?)\|\d+\|\w+\|(h=\w+\|)?/?)\](.*?)\[/url\]#si"
		=>	'<a href="$1" class="postlink">$4</a>',
		// [url]ed2k://|server|ip|port|/[/url] code
		"#\[url\](ed2k://\|server\|([\d\.]+?)\|(\d+?)\|/?)\[/url\]#si"
		=>	'ed2k server: <a href="$1" class="postlink">$2:$3</a>',
		// [url=ed2k://|server|ip|port|/]name[/url] code
		"#\[url=(ed2k://\|server\|[\d\.]+\|\d+\|/?)\](.*?)\[/url\]#si"
		=>	'<a href="$1" class="postlink">$2</a>',
		// [url]ed2k://|friend|name|ip|port|/[/url] code
		"#\[url\](ed2k://\|friend\|(.*?)\|[\d\.]+\|\d+\|/?)\[/url\]#si"
		=>	'ed2k friend: <a href="$1" class="postlink">$2</a>',
		// [url=ed2k://|friend|name|ip|port|/]name[/url] code
		"#\[url=(ed2k://\|friend\|(.*?)\|[\d\.]+\|\d+\|/?)\](.*?)\[/url\]#si"
		=>	'<a href="$1" class="postlink">$3</a>',

		// [web]Web Iframe URL[/web] code..
		"#\[web width=([0-9]?[0-9]?[0-9]?[(%|\w+)]) height=([0-9]?[0-9]?[0-9]?[(%|\w+)])\](.*?)\[/web\]#si"
		=>	'<iframe width="\\1" height="\\2" src="\\3" style="font-size: 2px;"></iframe>',

		// [thumbnail]image URL[/thumbnail] code..
		"#\[thumbnail\](.*?)\[\/thumbnail\]#si"
		=>	'<a href="\\1" rel="lightbox[]" alt="\\1" title="" class="hoverbox"><img src="\\1" border="0" width="' . $abbc3_thumb_width . '"/></a>',
		"#\[thumbnail=(left|right)\](.*?)\[\/thumbnail\]#si"
		=>	'<a href="\\2" rel="lightbox[]" alt="\\2" title="" class="hoverbox"><img src="\\2" border="0" width="' . $abbc3_thumb_width . '" align="\\1"/></a>',
		
		// [flash width=X height=X]Flash URL[/flash] code..
		"#\[flash width=([0-9]?[0-9]?[0-9]) height=([0-49]?[0-9]?[0-9])\](.*?)\[/flash\]#si"
		=>	'<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=5,0,0,0" width="\\1" height="\\2">
				<param name="movie" value="\\3" /><param name="play" value="true" /><param name="loop" value="true" /><param name="quality" value="high" /><param name="allowScriptAccess" value="never" /><param name="allowNetworking" value="internal" />
				<embed src="\\3" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="\\1" height="\\2" play="true" loop="true" quality="high" allowscriptaccess="never" allownetworking="internal"></embed>
			</object>',
		
		// [video]file Video URL[/video] code..
		"#\[video\](.*?)\[/video\]#si"
		=>	'<object id="MediaPlayer' . $abbc3_unique_id . '" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components..." type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">
				<param name="filename" value="\\1">
				<param name="Showcontrols" value="True">
				<param name="autoStart" value="True">
				<embed type="application/x-mplayer10" src="\\1" name="MediaPlayer" width=320 height=240></embed>
			</object>',
		// [video width=X height=X]file Video URL[/video] code..
		"#\[video width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9])\](.*?)\[/video\]#si"
		=>	'<object width="\\1" height="\\2" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" id="wmstream_' . $abbc3_unique_id . '">
				<param name="url" value="\\3" />
				<param name="showcontrols" value="1" />
				<param name="showdisplay" value="0" />
				<param name="showstatusbar" value="0" />
				<param name="autosize" value="1" />
				<param name="autostart" value="0" />
				<param name="visible" value="1" />
				<param name="animationstart" value="0" />
				<param name="loop" value="0" />
				<param name="src" value="\\3" />
				<!--[if !IE]>-->
					<object width="\\1" height="\\2" type="video/x-ms-wmv" data="\\3">
						<param name="src" value="\\3" />
						<param name="controller" value="1" />
						<param name="showcontrols" value="1" />
						<param name="showdisplay" value="0" />
						<param name="showstatusbar" value="0" />
						<param name="autosize" value="1" />
						<param name="autostart" value="0" />
						<param name="visible" value="1" />
						<param name="animationstart" value="0" />
						<param name="loop" value="0" />
					</object>
				<!--<![endif]-->
			</object>',
		
		// [stream]file Sound URL[/stream] code..
		"#\[stream\](.*?)\[/stream\]#si"
		=>	'<object width="320" height="45" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" id="wmstream_' . $abbc3_unique_id . '">
				<param name="url" value="\\1" />
				<param name="showcontrols" value="1" />
				<param name="showdisplay" value="0" />
				<param name="showstatusbar" value="0" />
				<param name="autosize" value="1" />
				<param name="autostart" value="0" />
				<param name="visible" value="1" />
				<param name="animationstart" value="0" />
				<param name="loop" value="0" />
				<param name="src" value="\\1" />
				<!--[if !IE]>-->
					<object width="320" height="45" type="video/x-ms-wmv" data="\\1">
						<param name="src" value="\\1" />
						<param name="controller" value="1" />
						<param name="showcontrols" value="1" />
						<param name="showdisplay" value="0" />
						<param name="showstatusbar" value="0" />
						<param name="autosize" value="1" />
						<param name="autostart" value="0" />
						<param name="visible" value="1" />
						<param name="animationstart" value="0" />
						<param name="loop" value="0" />
					</object>
				<!--<![endif]-->
			</object>',
		
		// [ram]file Ram URL[/ram] code..
		"#\[ram width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9])\](.*?)\[/ram\]#si"
		=>	'<object id="rmstream_' . $abbc3_unique_id . '" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" width="\\1" height="\\2">
				<param name="src" value="\\3" />
				<param name="autostart" value="false" />
				<param name="controls" value="ImageWindow" />
				<param name="console" value="ctrls_' . $abbc3_unique_id . '" />
				<param name="prefetch" value="false" />
				<embed name="rmstream_' . $abbc3_unique_id . '" type="audio/x-pn-realaudio-plugin" src="\\3" width="\\1" height="\\2" autostart="false" controls="ImageWindow" console="ctrls_' . $abbc3_unique_id . '" prefetch="false"></embed>
			</object>
			<br />
			<object id="ctrls_' . $abbc3_unique_id . '" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" width="\\1" height="36">
				<param name="controls" value="ControlPanel" />
				<param name="console" value="ctrls_{_file.ATTACH_ID}" />
				<embed name="ctrls_' . $abbc3_unique_id . '" type="audio/x-pn-realaudio-plugin" width="\\1" height="36" controls="ControlPanel" console="ctrls_' . $abbc3_unique_id . '"></embed>
			</object>',
		
		// [quicktime width=X height=X]file Quicktime URL[/quicktime] code.. 
		"#\[quicktime width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9])\](.*?)\[/quicktime\]#si"
		=>	'<object id="qtstream_' . $abbc3_unique_id . '" classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0" width="\\1" height="\\2">
				<param name="src" value="\\3" />
				<param name="controller" value="true" />
				<param name="autoplay" value="false" />
				<param name="type" value="video/quicktime" />
				<embed name="qtstream_' . $abbc3_unique_id . '" src="\\3" pluginspage="http://www.apple.com/quicktime/download/" enablejavascript="true" controller="true" width="\\1" height="\\2" type="video/quicktime" autoplay="false"></embed>
			</object>',

		// [stage6 width=X height=X]Video ID[/stage6] code..
		"#\[stage6 width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9])\](.*?)\[/stage6\]#si"
		=>	'<object  classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" codebase="http://download.divx.com/player/DivXBrowserPlugin.cab" width="\\1" height="\\2" ><param name="src" value="http://video.stage6.com/\\3/.divx" /><param name="autoplay" value="false" /><param name="custommode" value="Stage6" /><param name="showpostplaybackad" value="false" /><embed type="video/divx" src="http://video.stage6.com/\\3/.divx" pluginspage="http://go.divx.com/plugin/download/" showpostplaybackad="false" custommode="Stage6" autoplay="false" width="\\1" height="\\2" /></object><br /><!--<a href="http://video.stage6.com/\\3/.divx">Download Video</a><br />-->',
		
		// [Gvideo]video.google URL[/Gvideo] code.. http://video.google.com/videoplay?docid=-8071916037166432748
		"#\[Gvideo\]http://video.google.(.*?)/videoplay\?docid=(.*?)\[/Gvideo\]#si"
		=>	'<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=5,0,0,0" width="425" height="350"><param name="movie" value="http://video.google.\\1/googleplayer.swf?docid=\\2" /><param name="play" value="false" /><param name="loop" value="false" /><param name="quality" value="high" /><param name="allowScriptAccess" value="never" /><param name="allowNetworking" value="internal" /><embed src="http://video.google.\\1/googleplayer.swf?docid=\\2" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="425" height="350" play="false" loop="false" quality="high" allowscriptaccess="never" allownetworking="internal"></embed></object>',
		
		// [youtube]YouTube URL[/youtube] code.. http://www.youtube.com/watch?v=p21nZmtq56M
		"#\[youtube\]http://(.*?).youtube.com/watch\?v=([0-9A-Za-z-_]{11})[^[]*\[/youtube\]#is"
		=>	'<object width="425" height="350"><param name="movie" value="http://\\1.youtube.com/v/\\2"></param><param name="wmode" value="transparent"></param><embed src="http://\\1.youtube.com/v/\\2" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>',
		
		// Custom bbcodes
		
	);

	foreach ( $abbcode_ary as $abbcode_found => $abbcode_replace )
	{
		if ( preg_match ( $abbcode_found, $post_text ) )
		{
			$post_text = preg_replace ( $abbcode_found, $abbcode_replace, $post_text );
		}
	}

	if ( preg_match_all ( "/\[table=(.*?)\](.*?)\[\/table\]/i", $post_text, $table_ary ) )
	{
		$post_text = table_pass ( $post_text, $table_ary );
	}

	return substr ( $post_text, 1 );	// Remove our padding from the string..
}

function table_pass ( $post_text, $table_ary )
{
	foreach ( $table_ary[0] as $i => $table )
	{
		$table_style = $table_ary[1][$i];
		$table_inner = str_replace(array ('<br />', "\n"), array ("\n", "\r"), $table_ary[2][$i]);

		if ( preg_match_all ( "/\[tr=(.*?)\](.*?)\[\/tr\]/i", $table_inner, $row_ary ) )
		{
			foreach ( $row_ary[0] as $i => $row )
			{
				$row_style = $row_ary[1][$i];
				$row_inner = $row_ary[2][$i];

				if ( preg_match_all ( "/\[td=(.*?)\](.*?)\[\/td\]/i", $row_inner, $cell_ary ) )
				{
					foreach ( $cell_ary[0] as $i => $cell )
					{
						$cell_style = $cell_ary[1][$i];
						$cell_inner = $cell_ary[2][$i];
						$cell_seek = array ( '{CELL_STYLE}', '{CELL_INNER}' );
						$cell_with = array ( $cell_style, $cell_inner );
						$cell_replace = str_replace( $cell_seek, $cell_with, '<td style="{CELL_STYLE}">{CELL_INNER}</td>' );
						$row_inner = str_replace( $cell, $cell_replace, $row_inner );
					}
				}
				
				$row_seek = array ( '{ROW_STYLE}', '{ROW_INNER}' );
				$row_with = array ( $row_style, $row_inner );
				$row_replace = str_replace( $row_seek, $row_with, '<tr style="{ROW_STYLE}">{ROW_INNER}</tr>' );
				$table_inner = str_replace( $row, $row_replace, $table_inner );
			}
		}
		
		$table_seek = array ( '{TABLE_STYLE}', '{TABLE_INNER}' );
		$table_with = array ( $table_style, $table_inner );
		$table_replace = str_replace( $table_seek, $table_with, '<table style="{TABLE_STYLE}" cellspacing="0" cellpadding="0">{TABLE_INNER}</table>' );
		$post_text = str_replace( $table, $table_replace, $post_text );
	}
	
	return $post_text;
}

/**
 * ******************************************************************
 * IMAGES BBCODE
 * You can do it yourself in ACP -> Posting -> Messages -> BBCodes [Add a new BBcode]
 * ******************************************************************
 * LEFT aligned			:	[Add a new BBCode]
 * BBCode usage			:	[img_l]{TEXT}[/img_l]
 * HTML replacement		:	<div align="left"><img src="{TEXT}" /></div>
 * Help line			:	[img_l]image url[/img_l]
 * Settings				:	checked
 * [ Submit ]
 * 
 * RIGHT aligned		:	[Add a new BBCode]
 * BBCode usage			:	[img_r]{TEXT}[/img_r]
 * HTML replacement		:	<div align="right"><img src="{TEXT}" /></div>
 * Help line			:	[img_r]image url[/img_r]
 * Settings				:	checked
 * [ Submit ]
 *  
 * CENTER aligned		:	[Add a new BBCode]
 * BBCode usage			:	[img_c]{TEXT}[/img_c]
 * HTML replacement		:	<div align="center"><img src="{TEXT}" /></div>
 * Help line			:	[img_c]image url[/img_c]
 * Settings				:	checked
 * [ Submit ]
 * 
 */

?>
