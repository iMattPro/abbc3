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
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* MOD : parse Advanced BBCode Box - INICIO
* 
*/
function process_abbcode_box($text)
{
	/************************************************************************************
	* Let´s phpbb3 take care of it
	*************************************************************************************
	* 
	* [CODE] and [/CODE] for posting code (HTML, PHP, C etc etc) in your posts.
	* [QUOTE] and [/QUOTE] for posting replies with quote, or just for quoting stuff.
	* [url]www.phpbb.com[/url] code.. (no xxxx:// prefix).
	* [url=xxxx://www.phpbb.com]phpBB[/url] code..
	* [url=www.phpbb.com]phpBB[/url] code.. (no xxxx:// prefix).	
	* [img]image_url_here[/img] code..
	* [email]user@domain.tld[/email] code..
	* // $patterns_bbcode_box[] = "#\[email\]([a-z0-9&\-_.]+?@[\w\-]+\.([\w\-\.]+\.)?[\w]+)\[/email\]#si";
	* // $replacements_bbcode_box[] = '<a href="mailto:\\1}">\\1</A>';
	*
	************************************************************************************/

	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

	// Patterns and replacements for URL processing
	$patterns_bbcode_box = array();
	$replacements_bbcode_box = array();

	// [font=fonttype]text[/font] code..
	$patterns_bbcode_box[]     = "#\[font=(.*?)\](.*?)\[/font\]#si";
	$replacements_bbcode_box[] = '<span style="font-family:\\1">\\2</span>';

	// [highlight=color]text[/highlight] code..
	$patterns_bbcode_box[]     = "#\[highlight=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/highlight\]#si";
	$replacements_bbcode_box[] = '<span style="background-color: \\1;">\\2</span>';

	// [align=left/center/right/justify]Formatted Code[/align] code..
	$patterns_bbcode_box[]     = "#\[align=(left|right|center|justify)\](.*?)\[/align\]#si";
	$replacements_bbcode_box[] = '<div style="text-align:\\1">\\2</div>';
	
	// [sub]Subscrip[/sub] code..
	$ret = str_replace("[sub]", '<sub>', $ret); 	// $patterns_bbcode_box[]     = "#\[sup\](.*?)\[/sup\]#si";
	$ret = str_replace("[/sub]", '</sub>', $ret);	// $replacements_bbcode_box[] = '<sup>\\1</sup>';

	// [sup]Superscript[/sup] code..
	$ret = str_replace("[sup]", '<sup>', $ret);		// $patterns_bbcode_box[]     = "#\[sub\](.*?)\[/sub\]#si";
	$ret = str_replace("[/sup]", '</sup>', $ret);	// $replacements_bbcode_box[] = '<sub>\\1</sub>';
	
	// [strike]Strikethrough[/strike] code..
	$ret = str_replace("[s]", '<strike>', $ret);
	$ret = str_replace("[/s]", '</strike>', $ret);
	
	// [fade]Faded Text[/fade] code..
	$ret = str_replace("[fade]", '<span class="fade_link">', $ret);
	$ret = str_replace("[/fade]", '</span> <script type="text/javascript">fade_ontimer();</script>', $ret);
	
	// [marquee=left/right/up/down]Marquee Code[/marquee] code..
	$patterns_bbcode_box[]     = "#\[marq=(left|right|up|down)\](.*?)\[/marq\]#si";
	$replacements_bbcode_box[] = '<marquee direction="\\1" scrolldelay="120">\\2</marquee>';

	// [dir=XXX]Direction[/dir] code..
	$patterns_bbcode_box[]     = "#\[dir=(rtl|ltr)\](.*?)\[/dir\]#si";
	$replacements_bbcode_box[] = '<PRE><BDO lang="he" dir="\\1">\\2</BDO></PRE>';

	// [spoil]Spoiler[/spoil] code..
	$patterns_bbcode_box[]     = "#\[spoil\](.*?)\[/spoil\]#si";
	$replacements_bbcode_box[] = '<div class="quotewrapper"><div class="quotetitle"><input class="btnlite" type="button" value="Ver el Spoiler" onClick="javascript:if (this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display != \'\') { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'\'; this.innerText = \'\'; this.value = \'Ocultar el Spoiler\'; } else { this.parentNode.parentNode.getElementsByTagName(\'div\')[1].getElementsByTagName(\'div\')[0].style.display = \'none\'; this.innerText = \'\'; this.value = \'Ver el Spoiler\'; }" onfocus="this.blur();"></div><div class="quotecontent"><div style="display: none;">\\1</div></div></div>';
	
	// [flash width=X height=X]Flash URL[/flash] code..
	$patterns_bbcode_box[]		= "#\[flash width=([0-9]?[0-9]?[0-9]) height=([0-49]?[0-9]?[0-9])\](.*?)\[/flash\]#si";
	$replacements_bbcode_box[]	='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="\\1" height="\\2" ><param name=movie value="\\3"><param name="quality" value="high" /> <param name="scale" value="noborder" /><param name="wmode" value="transparent" /> <param name="bgcolor" value="#000000" /><embed type="application/x-shockwave-flash" src="\\3" quality="high" scale="noborder" wmode="transparent" bgcolor="#000000" width="\\1" height="\\2" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></embed></object>';

	// [video width=X height=X]Video URL[/video] code..
	$patterns_bbcode_box[]		= "#\[video width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9])\](.*?)\[/video\]#si";
	$replacements_bbcode_box[]	= '<embed src="\\3" width="\\1" height="\\2"></embed>';

	// Stage6 Video bbcode mod by reef_01
	$patterns_bbcode_box[]		= "#\[stage6\](.*?)\[/stage6\]#si";
	$replacements_bbcode_box[]	= '<object classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" codebase="http://download.divx.com/player/DivXBrowserPlugin.cab" width="704" height="396" ><param name="src" value="http://video.stage6.com/\\1/.divx" /><param name="autoplay" value="false" /><param name="custommode" value="Stage6" /><param name="showpostplaybackad" value="false" /><embed type="video/divx" src="http://video.stage6.com/\\1/.divx" pluginspage="http://go.divx.com/plugin/download/" showpostplaybackad="false" custommode="Stage6" autoplay="false" width="704" height="396" /></object><br /><a href="http://video.stage6.com/\\1/.divx">Descargar Video</a><br />';
	$patterns_bbcode_box[]		= "#\[stage6 width=([0-9]?[0-9]?[0-9]) height=([0-9]?[0-9]?[0-9])\](.*?)\[/stage6\]#si";
	$replacements_bbcode_box[]	= '<object  classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" codebase="http://download.divx.com/player/DivXBrowserPlugin.cab" width="\\1" height="\\2" ><param name="src" value="http://video.stage6.com/\\3/.divx" /><param name="autoplay" value="false" /><param name="custommode" value="Stage6" /><param name="showpostplaybackad" value="false" /><embed type="video/divx" src="http://video.stage6.com/\\3/.divx" pluginspage="http://go.divx.com/plugin/download/" showpostplaybackad="false" custommode="Stage6" autoplay="false" width="\\1" height="\\2" /></object><br /><!--<a href="http://video.stage6.com/\\3/.divx">Download Video</a><br />-->';
	
	// [Gvideo]video.google URL[/Gvideo] code.. //http://video.google.com/videoplay?docid=-8071916037166432748
	$patterns_bbcode_box[]		= "#\[Gvideo\]http://video.google.(.*?)/videoplay\?docid=(.*?)\[/Gvideo\]#si";
	$replacements_bbcode_box[]	= '<object classid="clsid:D27CDB6E-AE6D-11CF-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=5,0,0,0" width="425" height="350"><param name="movie" value="http://video.google.\\1/googleplayer.swf?docid=\\2" /><param name="play" value="false" /><param name="loop" value="false" /><param name="quality" value="high" /><param name="allowScriptAccess" value="never" /><param name="allowNetworking" value="internal" /><embed src="http://video.google.\\1/googleplayer.swf?docid=\\2" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" width="425" height="350" play="false" loop="false" quality="high" allowscriptaccess="never" allownetworking="internal"></embed></object>';

	// [youtube]YouTube URL[/youtube] code.. //http://www.youtube.com/watch?v=p21nZmtq56M
	$patterns_bbcode_box[]		= "#\[youtube\]http://(.*?).youtube.com/watch\?v=([0-9A-Za-z-_]{11})[^[]*\[/youtube\]#is";
	$replacements_bbcode_box[]	= '<object width="425" height="350"><param name="movie" value="http://\\1.youtube.com/v/\\2"></param><param name="wmode" value="transparent"></param><embed src="http://\\1.youtube.com/v/\\2" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>';

	// [hr]
	$ret = str_replace("[hr]", "<hr noshade color='#000000' size='1'>", $ret);
	
	// [ram]Ram URL[/ram] code..
	$patterns_bbcode_box[]		= "#\[ram\](.*?)\[/ram\]#si";
	$replacements_bbcode_box[]	= '<embed src="\\1" align="center" width="275" height="40" type="audio/x-pn-realaudio-plugin" console="cons" controls="ControlPanel" autostart="false"></embed>';
	
	// [stream]Sound URL[/stream] code..
	$patterns_bbcode_box[]		= "#\[stream\](.*?)\[/stream\]#si";
	$replacements_bbcode_box[]	= '<object id="wmp" width=300 height=70 classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,0,0,0" standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject"><param name="FileName" value="\\1"><param name="ShowControls" value="1"><param name="ShowDisplay" value="0"><param name="ShowStatusBar" value="1"><param name="AutoSize" value="1"><embed type="application/x-mplayer2" pluginspage="http://www.microsoft.com/windows95/downloads/contents/wurecommended/s_wufeatured/mediaplayer/default.asp" src="\\1" name=MediaPlayer2 showcontrols=1 showdisplay=0 showstatusbar=1 autosize=1 visible=1 animationatstart=0 transparentatstart=1 loop=0 height=70 width=300></embed></object>';

	// [web]Web Iframe URL[/web] code..
	$patterns_bbcode_box[]		= "#\[web width=([0-9]?[0-9]?[0-9]?[(%|\w+)]) height=([0-9]?[0-9]?[0-9]?[(%|\w+)])\](.*?)\[/web\]#si";
	$replacements_bbcode_box[]	= '<iframe width="\\1" height="\\2" src="\\3" style="font-size: 2px;"></iframe>';

	// [table=blah]Table[/table] code..
	$ret = preg_replace("/\[table=(.*?)\]/si", '<table style="\\1">', $ret);
	$ret = str_replace("[/table]", '</table>', $ret);

	// [tr=blah]tr[/tr] code..
	$ret = preg_replace("/\[tr=(.*?)\]/si", '<tr style="\\1">', $ret);
	$ret = str_replace("[/tr]", '</tr>', $ret);

	// [td=blah]td[/td] code..
	$ret = preg_replace("/\[td=(.*?)\]/si", '<td style="\\1">', $ret);
	$ret = str_replace("[/td]", '</td>', $ret);

	// ed2k://|server|serverIP|serverPort
	// [url]ed2k://|file|...[/url] code
	$patterns_bbcode_box[]		= "#\[url\](ed2k://\|file\|(.*?)\|\d+\|\w+\|(h=\w+\|)?/?)\[/url\]#is";
	$replacements_bbcode_box[]	= '<a href="$1" class="postlink">$2</a>';
	// [url=ed2k://|file|...]name[/url] code
	$patterns_bbcode_box[]		= "#\[url=(ed2k://\|file\|(.*?)\|\d+\|\w+\|(h=\w+\|)?/?)\](.*?)\[/url\]#si";
	$replacements_bbcode_box[]	= '<a href="$1" class="postlink">$4</a>';
	// [url]ed2k://|server|ip|port|/[/url] code
	$patterns_bbcode_box[]		= "#\[url\](ed2k://\|server\|([\d\.]+?)\|(\d+?)\|/?)\[/url\]#si";
	$replacements_bbcode_box[]	= 'ed2k server: <a href="$1" class="postlink">$2:$3</a>';
	// [url=ed2k://|server|ip|port|/]name[/url] code
	$patterns_bbcode_box[]		= "#\[url=(ed2k://\|server\|[\d\.]+\|\d+\|/?)\](.*?)\[/url\]#si";
	$replacements_bbcode_box[]	= '<a href="$1" class="postlink">$2</a>';
	// [url]ed2k://|friend|name|ip|port|/[/url] code
	$patterns_bbcode_box[]		= "#\[url\](ed2k://\|friend\|(.*?)\|[\d\.]+\|\d+\|/?)\[/url\]#si";
	$replacements_bbcode_box[]	= 'ed2k friend: <a href="$1" class="postlink">$2</a>';
	// [url=ed2k://|friend|name|ip|port|/]name[/url] code
	$patterns_bbcode_box[]		= "#\[url=(ed2k://\|friend\|(.*?)\|[\d\.]+\|\d+\|/?)\](.*?)\[/url\]#si";
	$replacements_bbcode_box[]	= '<a href="$1" class="postlink">$3</a>';

	$ret = preg_replace($patterns_bbcode_box, $replacements_bbcode_box, $ret);
	
	// Remove our padding from the string..
	$ret = substr($ret, 1);

	return $ret;
}

?>