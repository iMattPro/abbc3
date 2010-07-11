/**
* @package: phpBB 3.0.8 :: Advanced BBCode box 3 -> root/styles/abbcode
* @version: $Id: posting_abbcode_buttons.js, v 3.0.8 2010/06/28 10:06:28 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @Co-Author: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
**/

var copy_paste = '';
/**
* Default values for width and height values for the wizard pop-up window
**/
var popup_width		= <!-- IF S_ABBC3_WIZARD_WIDTH -->{S_ABBC3_WIZARD_WIDTH}<!-- ELSE -->700<!-- ENDIF -->;
var popup_height	= <!-- IF S_ABBC3_WIZARD_HEIGHT -->{S_ABBC3_WIZARD_HEIGHT}<!-- ELSE -->400<!-- ENDIF -->;

/**
* Default wizard mode
* 0=Disable wizards | 1=Pop Up window | 2=In post (Ajax)
**/
var popup_wizards	= <!-- IF S_ABBC3_WIZARD_MODE eq '0' -->false<!-- ELSE -->true<!-- ENDIF -->;

/**
* Help line tips values
**/
var help_line2 = {
<!-- BEGIN abbc3_tags -->
	<!-- IF (abbc3_tags.TAG_MOVER or abbc3_tags.TAG_TIP or abbc3_tags.TAG_NOTE or abbc3_tags.TAG_EXAMPLE ) -->
	'{abbc3_tags.TAG_NAME}'	: ("{abbc3_tags.TAG_MOVER}" ? "{abbc3_tags.TAG_MOVER}" : "") + (("{abbc3_tags.TAG_TIP}" || "{abbc3_tags.TAG_NOTE}") ? " :" : "") + (("{abbc3_tags.TAG_TIP}") ? " {abbc3_tags.TAG_TIP}" : "") + (("{abbc3_tags.TAG_NOTE}") ? " {abbc3_tags.TAG_NOTE}" : "") + (("{abbc3_tags.TAG_EXAMPLE}") ? "\n{L_ABBC3_EXAMPLE} : {abbc3_tags.TAG_EXAMPLE}" : ""),
	<!-- ENDIF -->
<!-- END abbc3_tags -->
	'abbc3_font'			: "{LA_ABBC3_FONT_MOVER}" + "{LA_ABBC3_FONT_TIP}" + '\n' + "{LA_ABBC3_FONT_NOTE}",
	'abbc3_size'			: "{LA_ABBC3_SIZE_MOVER}" + "{LA_ABBC3_SIZE_TIP}" + '\n' + "{LA_ABBC3_SIZE_NOTE}",
	'abbc3_highlight'		: "{LA_ABBC3_HIGHLIGHT_MOVER}" + "{LA_ABBC3_HIGHLIGHT_TIP}" + '\n' + "{LA_ABBC3_HIGHLIGHT_NOTE}",
	'abbc3_color'			: "{LA_ABBC3_COLOR_MOVER}" + "{LA_ABBC3_COLOR_TIP}" + '\n' + "{LA_ABBC3_COLOR_NOTE}",
	'abbc3_tip'				: "{LA_BBCODE_STYLES_TIP}"
};

/**
* Show help line tips
* @param string		help		string to display
* @param string		help_box	the element ID where the tip will be displayed
**/
function helpline2(help, help_box)
{
	if (!help)
	{
		help = 'abbc3_tip';
	}
	if (!help_box)
	{
		help_box = 'helpbox';
	}

	var helpbox = document.forms[form_name].elements[help_box];
	if (helpbox)
	{
		helpbox.value = (help_line2[help]) ? help_line2[help] : help_line[help];
	}
}

/**
* Replace all bbcodes to a plain text
* Code based off : http://ufku.com/personal/bbc2html
* @param string		data		post text to convert
**/
function bbcode_to_plain(data)
{
	/** Have a possible bbcode ? **/
	if (data.indexOf('[') < 0)
	{
		return data;
	}
	/**
	* the RegExp() built a regular expression
	* Regular expressions are patterns used to match character combinations in strings.
	**/
	function bbcode_to_plain_create_regexp(pattern, modifiers)
	{
		return new RegExp(pattern, modifiers);
	}
	/**
	* The exec() method tests for a match in a string.
	* This method returns the matched text if it finds a match, otherwise it returns null.
	**/
	function bbcode_to_plain_matched_text(str, pattern, modifiers)
	{
		return bbcode_to_plain_create_regexp(pattern, modifiers).exec(str);
	}
	/**
	* The replace() method searches for a match between a substring and a string, and replaces the matched substring with a new substring
	**/
	function bbcode_to_plain_simple_replace(str)
	{
		return str.replace(basic_bbcode_match, bbcode_to_plain_pattern);
	}
	/**
	* The replace() method searches for a match between a regular expression and a string, and replaces the matched substring with a new substring
	**/
	function bbcode_to_plain_regexp_replace(str, replace)
	{
		for (var i in replace)
		{
			if (bbcode_to_plain_matched_text(str, i, 'gim'))
			{
				str = str.replace(bbcode_to_plain_create_regexp(i, 'gim'), replace[i]);
			}
		}
		return str;
	}
	/**
	* Check wich replacement we should apply
	**/
	function bbcode_to_plain_pattern(match_0, match_1, match_2, match_3)
	{
		if (match_3 && match_3.indexOf('[') > -1)
		{
			match_3 = bbcode_to_plain_simple_replace(match_3);
		}
	/** alert( '0('+$0+') 1('+$1+') 2('+$2+') 3('+$3+')'); **/
		switch (match_1)
		{
			case 'url':
			case 'email':
				if (match_3 != '' && match_2 != '')
				{
					match_3 = match_2;
				}
				break;
			case 'click':
					match_3 = match_2;
				break;
		}
		/** Nothing to do ? **/
		return match_3;
	/** return '['+ match_1 + (match_2 ? '='+ match_2 : '') +']'+ match_3 +'[/'+ match_1 +']'; **/
	}

	var basic_bbcode_match	 = bbcode_to_plain_create_regexp('\\[([a-z][a-z0-9]*)(?:=([^\\]]+))?]((?:.|[\r\n])*?)\\[/\\1]', 'gim');
	var basic_bbcode_replace = bbcode_to_plain_create_regexp('^(\\d+)x(\\d+)$');

	/** Special bbcodes **/
	var special_bbcodes_init = {
			code : [{'': ''}, '', ''],
			quote : [{'': ''}, '', ''],
			list : [{'': ''}, '', ''],
			bbvideo : [{'': ''}, '', ''],
			align : [{'': ''}, '', ''],
			tr : [{'': ''}, '', ''],
			td : [{'': ''}, '', ''],
			video : [{'': ''}, '', ''],
			gvideo : [{'': ''}, '', ''],
			quicktime : [{'': ''}, '', ''],
			ram : [{'': ''}, '', ''],
			flv : [{'': ''}, '', ''],
			flash : [{'': ''}, '', ''],
			web : [{'': ''}, '', '']
	};

	var special_bbcodes_array = {};
	for (var i in special_bbcodes_init)
	{
		if(i)
		{
			special_bbcodes_array['\\[('+ i +')]((?:.|[\r\n])*?)\\[/\\1]'] = function(match_0, match_1, match_2) { return bbcode_to_plain_regexp_replace(match_2, ''); };
			special_bbcodes_array['\\[('+ i +')(.*?)]((?:.|[\r\n])*?)\\[/\\1]'] = function(match_0, match_1, match_2, match_3) { return bbcode_to_plain_regexp_replace(match_3, ''); };
			special_bbcodes_array['\\[('+ i +')(\\=|\\s|)?(.*?)]((?:.|[\r\n])*?)\\[/\\1]'] = function(match_0, match_1, match_2, match_3) { return bbcode_to_plain_regexp_replace(match_3, ''); };
		//	special_bbcodes_array['\\[('+ i +')=(.*?)]((?:.|[\r\n])*?)\\[/\\1]'] = function(match_0, match_1, match_2, match_3) { return bbcode_to_plain_regexp_replace(match_3, ''); };
		}
	}

	/** Extra bbcodes **/
	var	extra_bbcodes_array = {
		'\\[\\*]' : ' ',
		'\\[tabs]' : '',
		'\\[tabs\\:(.*?)]' : ' $1',
		'\\[/tabs]' : '',
		'\\[(hr|tab(=[a-z0-9]*))]' : ''
	};

	return bbcode_to_plain_simple_replace(bbcode_to_plain_regexp_replace(bbcode_to_plain_regexp_replace(data, special_bbcodes_array), extra_bbcodes_array));
}

/**
* Main function Apply bbcodes
* based-of editor.js -> function bbfontstyle()
* @param string		bbcode		Apply bbcodes
**/
function bbstyle2(bbcode)
{
	theSelection = false;

	var textarea = document.forms[form_name].elements[text_name];
	textarea.focus();

	var selLength, selStart, selEnd, s1, s2, s3;

	if ((clientVer >= 4) && is_ie && is_win)
	{
		/** Get text selection **/
		theSelection = document.selection.createRange().text;
	}
	else if (document.forms[form_name].elements[text_name].selectionEnd && (document.forms[form_name].elements[text_name].selectionEnd - document.forms[form_name].elements[text_name].selectionStart > 0))
	{
		selLength	= textarea.textLength;
		selLength	= (typeof(selLength) == 'undefined' || selLength == '' || selLength === null) ? textarea.value.length : selLength;
		selStart	= textarea.selectionStart;
		selEnd		= textarea.selectionEnd;

		if (selEnd == 1 || selEnd == 2)
		{
			selEnd = selLength;
		}

		s1 = (textarea.value).substring(0, selStart);
		s2 = (textarea.value).substring(selStart, selEnd);
		s3 = (textarea.value).substring(selEnd, selLength);
		theSelection = s2;
	}

	var theSelectionLength = theSelection.length;
	var bbcode_extra = " {S_ABBC3_VIDEO_WIDTH},{S_ABBC3_VIDEO_HEIGHT}";

	switch (bbcode)
	{
		case "abbc3_alignjustify" :
			bbfontstyle("[align=justify]", "[/align]");
			break;
		case "abbc3_alignright":
			bbfontstyle("[align=right]", "[/align]");
			break;
		case "abbc3_aligncenter" :
			bbfontstyle("[align=center]", "[/align]");
			break;
		case "abbc3_alignleft" :
			bbfontstyle("[align=left]", "[/align]");
			break;
		case "abbc3_sup" :
			bbfontstyle("[sup]", "[/sup]");
			break;
		case "abbc3_sub" :
			bbfontstyle("[sub]", "[/sub]");
			break;
		case "abbc3_b" :
			bbfontstyle("[b]", "[/b]");
			break;
		case "abbc3_i" :
			bbfontstyle("[i]", "[/i]");
			break;
		case "abbc3_u" :
			bbfontstyle("[u]", "[/u]");
			break;
		case "abbc3_s" :
			bbfontstyle("[s]", "[/s]");
			break;
		case "abbc3_pre" :
			bbfontstyle("[pre]", "[/pre]");
			break;
		case "abbc3_tab" :
			bbfontstyle("[tab=30]", "");
			break;
		case "abbc3_fade" :
			bbfontstyle("[fade]", "[/fade]");
			break;
		case "abbc3_dirrtl" :
			bbfontstyle("[dir=rtl]", "[/dir]");
			break;
		case "abbc3_dirltr" :
			bbfontstyle("[dir=ltr]", "[/dir]");
			break;
		case "abbc3_marqdown" :
			bbfontstyle("[marq=down]", "[/marq]");
			break;
		case "abbc3_marqup" :
			bbfontstyle("[marq=up]", "[/marq]");
			break;
		case "abbc3_marqleft" :
			bbfontstyle("[marq=left]", "[/marq]");
			break;
		case "abbc3_marqright" :
			bbfontstyle("[marq=right]", "[/marq]");
			break;
		case "abbc3_html" :
			bbfontstyle("[html]", "[/html]");
			break;
		case "abbc3_anchor" :
			bbfontstyle("[anchor= goto=]", "[/anchor]");
			break;
		case "abbc3_code" :
			bbfontstyle("[code]", "[/code]");
			break;
		case "abbc3_quote" :
			bbfontstyle("[quote]", "[/quote]");
			break;
		case "abbc3_spoil" :
			bbfontstyle("[spoil]", "[/spoil]");
			break;
		case "abbc3_hidden" :
			bbfontstyle("[hidden]", "[/hidden]");
			break;
		case "abbc3_mod" :
			bbfontstyle("[mod=\"{S_POST_AUTHOR}\"]", "[/mod]");
			break;
		case "abbc3_offtopic" :
			bbfontstyle("[offtopic]", "[/offtopic]");
			break;
		case "abbc3_scrippet" :
			bbfontstyle("[scrippet]", "[/scrippet]");
			break;
		case "abbc3_tabs" :
			bbfontstyle("[tabs][tabs: ]", "[/tabs]");
			break;
		case "abbc3_listb" :
			bbfontstyle("[list][*]", "[/list]");
			break;
		case "abbc3_listo" :
			bbfontstyle("[list=1][*]", "[/list]");
			break;
		case "abbc3_listitem" :
			bbfontstyle("[*]", "");
			break;
		case "abbc3_hr" :
			bbfontstyle("[hr]", "");
			break;
		case "abbc3_imgshack" :
			popup('http://imageshack.us/', popup_width, popup_height);
		/*	popup('http://ipostimage.org/', popup_width, popup_height);	*/
		/*	popup('http://www.imageposter.com/uploads/?mode=phpbb&forumurl=' + escape(document.location.href), '_imagehost', 'resizable=yes,width=500,height=400', popup_width, popup_height);	*/
			break;

/** Custom bbcodes - Start **/
		case "abbc3_dm" :
			bbfontstyle("[dm]", "[/dm]");
			break;
		case "abbc3_gamespot" :
			bbfontstyle("[gamespot]", "[/gamespot]");
			break;
		case "abbc3_gametrailers" :
			bbfontstyle("[gametrailers]", "[/gametrailers]");
			break;
		case "abbc3_ignvideo" :
			bbfontstyle("[ignvideo]", "[/ignvideo]");
			break;
		case "abbc3_putfile" :
			bbfontstyle("[Putfile]", "[/Putfile]");
			break;
		case "abbc3_liveleak" :
			bbfontstyle("[liveleak]", "[/liveleak]");
			break;
		case "abbc3_nfo" :
			bbfontstyle("[nfo]", "[/nfo]");
			break;
		case "abbc3_glow" :
			bbfontstyle("[glow=red]", "[/glow]");
			break;
		case "abbc3_shadow" :
			bbfontstyle("[shadow=blue]", "[/shadow]");
			break;
		case "abbc3_dropshadow" :
			bbfontstyle("[dropshadow=blue]", "[/dropshadow]");
			break;
		case "abbc3_blur" :
			bbfontstyle("[blur=blue]", "[/blur]");
			break;
		case "abbc3_wave" :
			bbfontstyle("[wave=blue]", "[/wave]");
			break;
		case "abbc3_search" :
			bbfontstyle("[search]", "[/search]");
			break;
/** Custom bbcodes - End **/

/** This bbcodes needs wizard - Start **/
		/** This bbcodes was deprecated in v3.0.7 **/
		case "abbc3_upload" :

		case "abbc3_url" :
		case "abbc3_ed2k" :
		case "abbc3_email" :
		case "abbc3_web" :
		case "abbc3_img" :
		case "abbc3_thumbnail" :
		case "abbc3_rapidshare" :
		case "abbc3_testlink" :
		case "abbc3_click" :
		case "abbc3_table" :
		/** This bbcodes needs extra data **/
		case "abbc3_bbvideo" :
		case "abbc3_flash" :
		case "abbc3_flv" :
		case "abbc3_video" :
		case "abbc3_quicktime" :
		case "abbc3_ram" :
		/** Web videos bbcodes **/
		case "abbc3_stream" :
		case "abbc3_veoh" :
		case "abbc3_collegehumor" :
		case "abbc3_gvideo" :
		case "abbc3_youtube" :
		/** Gradient needs his own function **/
		case "abbc3_grad" :
		/** Extra Custom bbcodes - Start **/
		case "deezer" :

		/** Extra Custom bbcodes - End **/
			if (bbcode == "abbc3_grad")
			{
				if (typeof(theSelection) == 'undefined' || theSelection === null || theSelection == '')
				{
					alert("{LA_ABBC3_ERROR}" + '\n' + "{LA_ABBC3_GRAD_MIN_ERROR}");
					return;
				}

				if (theSelectionLength > 120)
				{
					alert("{LA_ABBC3_ERROR}" + '\n' + "{LA_ABBC3_GRAD_MAX_ERROR}" + theSelectionLength);
					return;
				}
			}
			else if (bbcode != "abbc3_table")
			{
				if (theSelection || !popup_wizards)
				{
					bbcode_extra = (bbcode == 'abbc3_bbvideo' || bbcode == 'abbc3_flash' || bbcode == 'abbc3_flv' || bbcode == 'abbc3_video' || bbcode == 'abbc3_quicktime' || bbcode == 'abbc3_ram') ? " {S_ABBC3_VIDEO_WIDTH},{S_ABBC3_VIDEO_HEIGHT}" : ( bbcode == 'abbc3_web') ? ' 100%,100' : '';

					if ( bbcode == "abbc3_ed2k")
					{
						bbcode = "abbc3_url";
					}

					bbcode = bbcode.replace("abbc3_" , "");
					bbfontstyle('[' + bbcode + bbcode_extra + ']', '[/' + bbcode + ']', '');
					return;
				}
			}
			else if (bbcode == "abbc3_table" && !popup_wizards)
			{
				bbfontstyle("[table=][tr=][td=]", "[/td][/tr][/table]");
				return;
			}

			var wizards_url = '{S_ABBC3_WIZARD_PAGE}';
			var wizards_params = '&amp;abbc3=' + bbcode + '&amp;form_name=' + form_name + '&amp;text_name=' + text_name<!-- IF S_ABBC3_IN_ADMIN --> + '&amp;admin=1'<!-- ENDIF -->;
		<!-- IF S_ABBC3_WIZARD_MODE eq '2' -->
			ABBC3_Ajax_send(wizards_url, wizards_params, bbcode);
		<!-- ELSE -->
			popup(wizards_url + wizards_params, popup_width, popup_height);
		<!-- ENDIF -->
			break;
/** This bbcodes needs wizard - End **/

		case "abbc3_plain" :
			if (typeof(theSelection) == 'undefined' || theSelection == '' || theSelection === null)
			{
				alert("{LA_ABBC3_ERROR}" + '\n' + "{LA_ABBC3_NOSELECT_ERROR}");
				return;
			}
			else
			{
				try {//	tempSelection = tempSelection.replace(/\[[^\]]*\]/gi,"");
						var tempSelection = bbcode_to_plain(theSelection);

						if ((clientVer >= 4) && is_ie && is_win)
						{
							document.selection.createRange().text = tempSelection;
						}
						else if (textarea.selectionEnd && (textarea.selectionEnd - textarea.selectionStart > 0))
						{
							textarea.value = s1 + tempSelection + s3;
							selEnd = textarea.selectionEnd = (textarea.value).substring(0, selStart).length + tempSelection.length;
						}
				} catch (e) {}
			}
			break;
		case "abbc3_cut" :
			if (typeof(theSelection) == 'undefined' || theSelection === null || theSelection == '')
			{
				alert("{LA_ABBC3_ERROR}" + '\n' + "{LA_ABBC3_NOSELECT_ERROR}");
				return;
			}
			else
			{
				if ((clientVer >= 4) && is_ie && is_win)
				{
					document.selection.createRange().text = '';
				}
				else if (textarea.selectionEnd && (textarea.selectionEnd - textarea.selectionStart > 0))
				{
					textarea.value = (textarea.value).substring(0, selStart) + (textarea.value).substring(selEnd, selLength);
					selEnd = textarea.selectionEnd = (textarea.value).substring(0, selStart).length;
				}
			}
			break;
		case "abbc3_copy" :
			if (typeof(theSelection) == 'undefined' || theSelection == '' || theSelection === null)
			{
				alert("{LA_ABBC3_ERROR}" + '\n' + "{LA_ABBC3_NOSELECT_ERROR}");
				return;
			}
			else
			{
				copy_paste = theSelection;
			}
			break;
		case "abbc3_paste" :
			if (copy_paste)
			{
				bbfontstyle(copy_paste, '');
			}
			else
			{
				alert("{LA_ABBC3_ERROR}" + '\n' + "{LA_ABBC3_PASTE_ERROR}");
			}
			break;

/** Else should be a phpbb3 custom bbcode from ACP, so let's phpbb3 take care of it **/
		default :
			bbfontstyle("["+bbcode+"]", "[/"+bbcode+"]");
			break;
	}

	theSelection = '';
}

<!-- IF (S_ABBC3_COLOR_MODE eq 'dropdown' or S_ABBC3_HIGHLIGHT_MODE eq 'dropdown') or (S_ABBC3_COLOR_MODE eq 'fancy' or S_ABBC3_HIGHLIGHT_MODE eq 'fancy') -->
/**
* Dropdown Color pallette for highlight text & colour text
* Code from : http://www.mredkj.com/tutorials/tutorial005.html
* @param string		el		the element id
* @param string		mode	(fancy | dropdown)
**/
function ABBC3_palette(el, mode)
{
	var elSel = document.getElementById(el);

	if (!elSel)
	{
		return;
	}
	if (!mode)
	{
		mode = 'dropdown';
	}
	var color;
	var optn;
	var item;
	var numberList = {
		0 : '00',
		1 : '40',
		2 : '80',
		3 : 'BF',
		4 : 'FF'
	};

	if (mode == 'dropdown' && el == 'abbc3_color')
	{
		var topic_cur_post_id = document.forms[form_name].elements['topic_cur_post_id'];
			topic_cur_post_id = (topic_cur_post_id) ? parseInt(topic_cur_post_id.value) + 1 : parseInt('{S_POST_ID}', 10);
		var optn_className = (isEven(topic_cur_post_id)) ? 'bg2 row1' : 'bg1 row2';
	}

	for (var r = 4; r > -1; r--)
	{
		for (var g = 4; g > -1; g--)
		{
			for (var b = 4; b > -1; b--)
			{
				if (mode == 'fancy')
				{
					color = String(numberList[r]) + String(numberList[g]) + String(numberList[b]);
					color = color.toLowerCase()
					item = document.createElement('li');
					item.innerHTML = '{LA_SAMPLE_TEXT}' + '&nbsp;(#' + color + ')';

					if (el == 'ul_color_selector')
					{
						item.setAttribute("onclick", "bbfontstyle('[color=#" + color + "]', '[/color]')");
						item.style.color = '#' + color;
					}
					else
					{
						item.setAttribute("onclick", "bbfontstyle('[highlight=#" + color + "]', '[/highlight]')");
						item.style.backgroundColor = '#' + color;
					}
					elSel.appendChild(item);
				}
				else if (mode == 'dropdown')
				{
					color = String(numberList[r]) + String(numberList[g]) + String(numberList[b]);
					color = color.toLowerCase()
					optn = document.createElement('option');
					optn.text = '#' + color;
					optn.value = color;

					if (el == 'abbc3_color')
					{
						optn.className = optn_className;
						optn.style.color = '#' + color;
					}
					else
					{
						optn.style.backgroundColor = '#' + color;
					}
					elSel.options.add(optn);
				}
			}
		}
	}
}
/**
* The given number is even or odd ?
**/
function isEven(Number)
{
	return (Number%2 == 0) ? true : false;
}
<!-- ENDIF -->

<!-- IF S_ABBC3_BOXRESIZE -->
/**
* Resize a textbox - START
* @param int		height		amount of height to apply
* @param string		el			the element ID
* @param string		cookie_name	the name of the cookie to store the height
**/
function textbox_resize(height, el, cookie_name)
{
	/* if no element ID was passed, use the main ID */
	if (typeof(el) == 'undefined')
	{
		el = text_name;
	}

	/* if no cookir ID was passed, use the main ID */
	if (typeof(cookie_name) == 'undefined')
	{
		cookie_name = '{S_ABBC3_COOKIE_NAME}' + el;
	}

	/* Get the editor element */
	var editor = document.getElementById(el);

	/* Get the cookie height for this editor */
	/* If no cookie exist, create it whith the actual height for this editor */
	var the_cookie = ABBC3_load_cookie(cookie_name, editor.rows, 365);

	/* if no height was passed, try to read the cookie value */
	if (the_cookie !== 0 && typeof(height) != 'number')
	{
		height = parseInt(the_cookie, 10);
	}
	/* if height was passed, try to read the actual height */
	else
	{
		height = editor.rows + parseInt(height/10, 10);
	}

	/* if we have a new height, use it */
	if (!isNaN(height))
	{
		/* Reset the actual style height */
		if (editor.style.height)
		{
			editor.style.height = null;
		}
		/* resize the textarea */
		editor.rows = height;
		/* store the cookie */
		createCookie(cookie_name, editor.rows, 365)
	}
}

/**
* Manage the cookies
*	Get the cookie height for this editor
*	If no cookie exist, create it whith the actual height for this editor
* @param string		name		the name of the cookie to store the height
* @param int		value		height for this editor
* @param int		days		the numbers of days to store the cookie
**/
function ABBC3_load_cookie(name, value, days)
{
	var the_cookie = null;

	/* Get the cookie height for this editor */
	the_cookie = readCookie(name);

	/* If no cookie exist, create it whith the actual height for this editor */
	if (!the_cookie)
	{
		the_cookie = createCookie(name, value, days);
	}

	return the_cookie;
}

if (typeof createCookie != 'function')
{
	function createCookie(name, value, days)
	{
		if (days)
		{
			var date = new Date();
			date.setTime(date.getTime() + (days*24*60*60*1000));
			var expires = '; expires=' + date.toGMTString();
		}
		else
		{	
			expires = '';
		}

		document.cookie = name + '=' + value + expires + 'A_COOKIE_SETTINGS';
	}
}

if (typeof readCookie != 'function')
{
	function readCookie(name)
	{
		var nameEQ = name + '=';
		var ca = document.cookie.split(';');

		for (var i = 0; i < ca.length; i++)
		{
			var c = ca[i];

			while (c.charAt(0) == ' ')
			{
				c = c.substring(1, c.length);
			}

			if (c.indexOf(nameEQ) == 0)
			{
				return c.substring(nameEQ.length, c.length);
			}
		}

		return null;
	}
}
/** Resize a textbox - END **/
<!-- ENDIF -->

<!-- IF S_ABBC3_COMPACT -->
/**
* javascript for Bubble Tooltips by Alessandro Fulciniti
* http://pro.html.it - http://web-graphics.com 
* obtained from: http://web-graphics.com/mtarchive/001717.php
*
* MSSTI :
*	- added ability to perform tooltips on list elements
* @param string		id					the element ID
* @param string		headline			the title
* @param string		sub_id				unknown 
* @param string		content_direction	the text direction (rtl|ltr)
**/
function ABBC3_enable_tooltips_list(id, headline, sub_id, content_direction)
{
	var links, i, hold;

	s_content_direction = (content_direction) ? content_direction : 'rtl';
	head_text = headline;

	if (!document.getElementById || !document.getElementsByTagName)
	{
		return;
	}

	hold = document.createElement('span');
	hold.id = '_tooltip_container';
	hold.setAttribute('id', '_tooltip_container');
	hold.style.position = 'absolute';

	document.getElementsByTagName('body')[0].appendChild(hold);

	if (id === null)
	{
		links = document.getElementsByTagName('a');
	}
	else
	{
		links = document.getElementById(id).getElementsByTagName('a');
	}

	for (i = 0; i < links.length; i++)
	{
		if (sub_id)
		{
			if (links[i].id.substr(0, sub_id.length) == sub_id)
			{
				prepare(links[i]);
			}
		}
		else
		{
			prepare(links[i]);
		}
	}
}

/**
* Correct positioning of tooltip container
* dependance prepare()
*/
function locate(e)
{
	var posx = 0;
	var posy = 0;

	e = e.parentNode.parentNode;

	if (e.offsetParent)
	{
		for (posx = 0, posy = 0; e.offsetParent; e = e.offsetParent)
		{
			posx += e.offsetLeft;
			posy += e.offsetTop;
		}
	}
	else
	{
		posx = e.offsetLeft;
		posy = e.offsetTop;
	}

	document.getElementById('_tooltip_container').style.left = (s_content_direction == 'rtl' ? (posx-140) : (posx)) + 'px';
	document.getElementById('_tooltip_container').style.top  = (s_content_direction == 'rtl' ? (posy-90) : (posy-100)) + 'px';
}
<!-- ENDIF -->

<!-- IF S_ABBC3_WIZARD_MODE eq '2' -->
/**
* AJAX Form POST Request - HTML Form POST/Submit with AJAX/Javascript
*
* Base code :
*	http://www.captain.at/howto-ajax-form-post-request.php
*	http://en.wikipedia.org/wiki/XMLHttpRequest
*	http://developer.apple.com/internet/webcontent/xmlhttpreq.html
*	http://msdn.microsoft.com/en-us/library/ms537505%28VS.85%29.aspx
* @param string		url				the url to call
* @param string		parameters		the parameters for the url
* @param string		bbcode			the bbcode name 
* @param string		container_id	the element ID to display the result
**/
function ABBC3_Ajax_send(url, parameters, bbcode, container_id)
{
	var xmlhttp = false;

	if (!container_id)
	{
		container_id = 'ABBC3_Ajax_Wizards';
	}

    // branch for native XMLHttpRequest object (IE7, Opera 8.0+, Firefox, Safari)
    if (window.XMLHttpRequest && !(window.ActiveXObject))
	{
		try {
			xmlhttp = new XMLHttpRequest();
		} catch(e) {
			xmlhttp = false;
		}
	}
	// Support versions of Internet Explorer prior to Internet Explorer 7
	else if (window.ActiveXObject)
	{
		// modern versions
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e){
			// oldest versions
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xmlhttp = false;
			}
		}
	}
	/**
	* Provide the XMLHttpRequest constructor for IE 5.x-6.x:
	* Other browsers (including IE 7.x-8.x) do not redefine
	* XMLHttpRequest if it already exists.
	* If native XMLHTTP has been disabled, developers can override the XMLHttpRequest property of the window object with the MSXML-XMLHTTP control, unless ActiveX has also been disabled, as in the following example.
	**/
	else if (typeof(XMLHttpRequest) == "undefined")
	{
		xmlhttp = function ()
		{
			try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); } catch (e) {}
			try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); } catch (e) {}
			try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
		};
	}
	else
	{
		document.getElementById(container_id).innerHTML = "{LA_ABBC3_AJAX_DISABLED}";
		return false;
	}

	if (xmlhttp)
	{
		ABBC3_Ajax_indicator('on');
		url = url.replace(/&amp;/g, '&');
		parameters = parameters.replace(/&amp;/g, '&') + '&ajax=true';
		// Event handler for an event that fires at every state change
		xmlhttp.onreadystatechange = function(){ ABBC3_Ajax_handler(xmlhttp, container_id, bbcode); }
		xmlhttp.open('POST', url + parameters, true);
		xmlhttp.send(parameters);
	}
}

/**
* Create a function that will handle the received data sent from the server
* @param string		xmlhttp			the ajax oblect
* @param string		bbcode			the bbcode name 
* @param string		container_id	the element ID to display the result
**/
function ABBC3_Ajax_handler(xmlhttp, container_id, bbcode)
{
	// Object status integer
	     if (xmlhttp.readyState == 0) { /* 0 = uninitialized */	}
	else if (xmlhttp.readyState == 1) { /* 1 = loading */		}
	else if (xmlhttp.readyState == 2) { /* 2 = loaded */		}
	else if (xmlhttp.readyState == 3) { /* 3 = interactive */	}
	else if (xmlhttp.readyState == 4) { /* 4 = complete */
		// in HTTP there are various status codes returned by both HEAD and GET requests, 200 means success, 404 means failure, and the others mean other things.
		if (xmlhttp.status == 200) // || xmlhttp.status == 0)
		{
			ABBC3_Ajax_indicator('off');
			// String version of data returned from server process
			var results = xmlhttp.responseText;
			ABBC3_Ajax_update(container_id, results);
			document.getElementById(container_id).style.display = 'block';
			if (bbcode == "abbc3_grad")
			{
				gradient_init();
			}
		}
		// And the others mean other things.
		else
		{	// Numeric code returned by server + String message accompanying the status code
			alert('{LA_GENERAL_ERROR} : ' + "\n" + xmlhttp.status + ' => ' + xmlhttp.statusText);
		}
	}
}

/**
* Pure innerHTML is slightly faster in IE 
*	code from : http://blog.stevenlevithan.com/archives/faster-than-innerhtml
* @param string		el			the element ID to display the result
* @param string		str			the result to display
**/
function ABBC3_Ajax_update(el, str)
{
	var ABBC3_Ajax_new_El;
	var ABBC3_Ajax_old_El = document.getElementById(el);

	if (ABBC3_Ajax_old_El !== null && typeof(str) != 'undefined')
	{
		ABBC3_Ajax_new_El = ABBC3_Ajax_old_El.cloneNode(false);
		ABBC3_Ajax_new_El.innerHTML = str;
		ABBC3_Ajax_old_El.parentNode.replaceChild(ABBC3_Ajax_new_El, ABBC3_Ajax_old_El);
	}
}

/**
* Manae the ajax spinning loading image
* @param string		mode	(on=display|off=hide|null=create)
**/
function ABBC3_Ajax_indicator(mode)
{
	var ABBC3_Ajax_image = document.getElementById('ABBC3_Ajax_image');
	var ABBC3_Ajax_indicator = document.getElementById('ABBC3_Ajax_indicator');

	if (ABBC3_Ajax_image)
	{
		ABBC3_Ajax_image.style.display = (mode == 'on') ? 'block' : 'none';
	}
	else
	{
		if (ABBC3_Ajax_indicator)
		{
			/** Create the image here **/
			ABBC3_Ajax_image = document.createElement('img');
			ABBC3_Ajax_image.setAttribute('id', 'ABBC3_Ajax_image');
			ABBC3_Ajax_image.setAttribute('src', '{S_ABBC3_PATH}/abbcode_ajax_loading.gif');
			ABBC3_Ajax_image.style.display = 'none';
			ABBC3_Ajax_indicator.appendChild(ABBC3_Ajax_image);
		}
	}
}
<!-- ENDIF -->
/**
* Manage initial functions
**/
function ABBC3_init()
{
<!-- IF S_ABBC3_COMPACT -->
	ABBC3_enable_tooltips_list('ul_selector', '{LA_ABBC3_HELP_DESC}', false, '{S_CONTENT_DIRECTION}');
<!-- ENDIF -->

<!-- IF S_ABBC3_HIGHLIGHT_MODE eq 'fancy' -->
	ABBC3_palette('ul_highlight_selector', '{S_ABBC3_HIGHLIGHT_MODE}');
<!-- ELSEIF S_ABBC3_HIGHLIGHT_MODE eq 'dropdown' -->
	ABBC3_palette('abbc3_highlight', '{S_ABBC3_HIGHLIGHT_MODE}');
<!-- ENDIF -->

<!-- IF S_ABBC3_COLOR_MODE eq 'fancy' -->
	ABBC3_palette('ul_color_selector', '{S_ABBC3_COLOR_MODE}');
<!-- ELSEIF S_ABBC3_COLOR_MODE eq 'dropdown' -->
	ABBC3_palette('abbc3_color', '{S_ABBC3_COLOR_MODE}');
<!-- ENDIF -->

<!-- IF S_ABBC3_BOXRESIZE -->
	textbox_resize();
<!-- ENDIF -->

<!-- IF S_ABBC3_WIZARD_MODE eq '2' -->
	ABBC3_Ajax_indicator('');
<!-- ENDIF -->
}

/** Install the safety net - START **/
if (window.onload_functions) // prosilver
{
	onload_functions[onload_functions.length] = "ABBC3_init();";
}
else if (typeof(window.addEventListener) != "undefined") // DOM
{
	window.addEventListener("load", ABBC3_init, false);
}
else if (typeof(window.attachEvent) != "undefined") // MSIE
{
	window.attachEvent("onload", ABBC3_init);
}
/** Install the safety net - END **/
