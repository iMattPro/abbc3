/**
* @package: phpBB 3.0.9 :: Advanced BBCode box 3 -> root/styles/abbcode
* @version: $Id: posting_abbcode_wizards.js, v 3.0.9.3 2010/05/18 10:05:18 leviatan21 Exp $
* @copyright: leviatan21 < info@mssti.com > (Gabriel) http://www.mssti.com/phpbb3/
* @license: http://opensource.org/licenses/gpl-license.php GNU Public License 
* @author: leviatan21 - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=345763
* @Co-Author: VSE - http://www.phpbb.com/community/memberlist.php?mode=viewprofile&u=868795
**/

<!-- IF S_ABBC3_IN_WIZARD -->
var form_name = '{FORM_NAME}';
var text_name = '{TEXT_NAME}';
<!-- ENDIF -->


function win_close(text)
{
	var in_popup = <!-- IF S_ABBC3_WIZARD_MODE eq '2' -->false<!-- ELSE -->true<!-- ENDIF -->;

	if (is_ie && !in_popup)
	{
		var textarea = document.forms[form_name].elements[text_name];
		textarea.focus();
		baseHeight = document.selection.createRange().duplicate().boundingHeight;
	}

	if (text)
	{
		initInsertions();
		insert_text(text, false, in_popup);
	}

	if (in_popup)
	{
		window.close();
	}
	else
	{
		// The new position for the cursor after adding the bbcode
		if (is_ie && !in_popup)
		{
			// dirty and slow IE way
			var pos = textarea.innerHTML.indexOf(text);
			if (pos > 0)
			{
				var new_pos = pos + text.length;
				var range = textarea.createTextRange();
				range.move("character", new_pos);
				range.select();
				storeCaret(textarea);
				textarea.focus();
			}
		}

		document.getElementById('ABBC3_Ajax_Wizards').style.display = 'none';
	}
}

/** Startup variables **/
var theSelection = false;

var tohex = new Array(256);
var hex   = "0123456789ABCDEF";
var count = 0;
for (var x = 0; x < 16; x++)
{
	for (var y = 0; y < 16; y++)
	{
		tohex[count] = hex.charAt(x) + hex.charAt(y);
		count++;
	}
}

var browser = "unknown";
var version = 0;

if (navigator.userAgent.indexOf("Opera") >= 0)
{
	browser = "opera";
}
else if (navigator.userAgent.indexOf("obot") >= 0)
{
	browser = "robot";
}
else if (navigator.appName.indexOf("etscape") >= 0)
{
	browser = "netscape";
}
else if (navigator.appName.indexOf("icrosoft") >= 0)
{
	browser = "msie";
}

version = parseFloat(navigator.appVersion);
if (isNaN(version))
{
	version = 0;
}

if ((browser == "msie") && (version == 2))
{
	version = 3;
}

function getValue(clr_id)
{
	var clr = document.getElementById(clr_id);

	if (clr.options[clr.selectedIndex].value == "")
	{
		return "";
	}
	else
	{
		return " " + clr.options[clr.selectedIndex].value;
	}
}

function ColorCode(hexcode)
{
	if (hexcode.length == 7)
	{
		this.r = parseInt(hexcode.substring(1,3),16);
		this.g = parseInt(hexcode.substring(3,5),16);
		this.b = parseInt(hexcode.substring(5,7),16);
	}
	else if (hexcode.length == 6)
	{
		this.r = parseInt(hexcode.substring(0,2),16);
		this.g = parseInt(hexcode.substring(2,4),16);
		this.b = parseInt(hexcode.substring(4,6),16);
	}
	else
	{
		this.r = this.g = this.b = 0;
		alert("{LA_ABBC3_GRAD_ERROR}");
	}

	if (isNaN(this.r) || isNaN(this.g) || isNaN(this.b))
	{
		alert("{LA_ABBC3_GRAD_ERROR}");
	}
}

function ColorList(hexcodes)
{
	var i = 0;
	var c = 0;
	this.codes = new Array(Math.round(hexcodes.length/7));

	while (i < hexcodes.length)
	{
		if (isNaN(parseInt(hexcodes.substring(i,i+6),16)))
		{
			++i;
		}
		else
		{
			this.codes[c] = new ColorCode(hexcodes.substring(i,i+6));
			i += 7;
			++c;
		}
	}
	this.len = c;
}

function lowcolorindex(x, y, z)
{
	if (y == 1)
	{
		return 0;
	}
	else
	{
		return Math.floor((x * (z - 1)) / (y - 1));
	}
}

function hicolorindex(x, y, z, low)
{
	if (low * (y - 1) == x * (z - 1))
	{
		return low;
	}
	else if (y == 1)
	{
		return 0;
	}
	else
	{
		return Math.floor((x*(z-1))/(y-1) + 1);
	}
}

function interpolate(x1, y1, x3, y3, x2)
{
	if (x3 == x1)
	{
		return y1;
	}
	else
	{
		return (x2 - x1) * (y3 - y1) / (x3 - x1) + y1;
	}
}

function gradient(thetext, priv)
{
	var grad      = "";
	var thecolors = getValue('clr1');
	thecolors    += getValue('clr2');
	thecolors    += getValue('clr3');
	thecolors    += getValue('clr4');
	thecolors    += getValue('clr5');
	thecolors     = thecolors.substr(1);

	if (((browser == "netscape") || (browser == "msie") || (browser == "opera")) && (version >= 3.0))
	{
		var colors = new ColorList(thecolors);

		if (colors.len < 2)
		{
			return  thetext;
		}

		var numcolors = colors.len;
		var numchars = theSelection.length;
		var rr = 0;
		var gg = 0;
		var bb = 0;
		var lci = 0; /** lower color index **/
		var hci = 0; /** high color index **/

		for ( var i = 0; i < numchars; ++i)
		{
			lci = lowcolorindex(i, numchars, numcolors);
			hci = hicolorindex(i, numchars, numcolors, lci);
			rr = Math.round(interpolate(lci/(numcolors-1), colors.codes[lci].r, hci/(numcolors-1), colors.codes[hci].r, i/(numchars-1)));
			gg = Math.round(interpolate(lci/(numcolors-1), colors.codes[lci].g, hci/(numcolors-1), colors.codes[hci].g, i/(numchars-1)));
			bb = Math.round(interpolate(lci/(numcolors-1), colors.codes[lci].b, hci/(numcolors-1), colors.codes[hci].b, i/(numchars-1)));

			if (browser == "opera")
			{
				rr = 255 - rr;
				gg = 255 - gg;
				bb = 255 - bb;
			}

			if (thetext.charAt(i) !== ' ')
			{
				if (priv == "priv")
				{
					grad += "<font color=#" + tohex[rr] + tohex[gg] + tohex[bb] + ">" + thetext.charAt(i) + "</font>";
				}
				else
				{
					grad += "[color=#" + tohex[rr] + tohex[gg] + tohex[bb] + "]" + thetext.charAt(i) + "[/color]";
				}
			}
			else
			{
				grad+=' ';
			}
		}
	}
	else
	{
		grad = thetext;
	}
	return grad;
}

function gradient_preview(submit)
{
	var doc;
	var in_popup = <!-- IF S_ABBC3_WIZARD_MODE eq '2' -->false<!-- ELSE -->true<!-- ENDIF -->;

	if (in_popup)
	{
		doc = opener.document;
	}
	else
	{
		doc = document;
	}

	var txtarea = doc.forms[form_name].elements[text_name];
	var selLength, selStart, selEnd, s1, s2, s3, varreturn;

	if ((clientVer >= 4) && is_ie && is_win)
	{
		/** Get text selection **/
		theSelection = doc.selection.createRange().text;
		oSelectLength = theSelection.length;

		if (submit)
		{
			varreturn = gradient(theSelection, "add");
			doc.selection.createRange().text = varreturn;
			win_close();
			return true;
		}
	}
	else if (txtarea.selectionEnd && (txtarea.selectionEnd - txtarea.selectionStart > 0))
	{
		selLength = txtarea.textLength;
		selStart = txtarea.selectionStart;
		selEnd = txtarea.selectionEnd;

		if (selEnd == 1 || selEnd == 2) 
		{
			selEnd = selLength;
		}

		s1 = (txtarea.value).substring(0, selStart);
		s2 = (txtarea.value).substring(selStart, selEnd);
		s3 = (txtarea.value).substring(selEnd, selLength);

		theSelection = s2;
		oSelectLength = selEnd - selStart;

		if (submit)
		{
			varreturn = gradient(theSelection, "add");
			txtarea.value = (txtarea.value).substring(0, selStart) + varreturn + (txtarea.value).substring(selEnd, selLength);
			win_close();
			return true;
		}
	}

	gradient_update('grad_preview', gradient(theSelection, "priv"));
}

function gradient_update(el, str)
{
	var gradient_new_El;
	var gradient_old_El = document.getElementById(el);

	if (gradient_old_El !== null && typeof(str) != 'undefined')
	{
		/**
		* Pure innerHTML is slightly faster in IE 
		*	code from : http://blog.stevenlevithan.com/archives/faster-than-innerhtml
		**/
		gradient_new_El = gradient_old_El.cloneNode(false);
		gradient_new_El.innerHTML = str;
		gradient_old_El.parentNode.replaceChild(gradient_new_El, gradient_old_El);
	}
}

function gradient_template()
{
	var template = document.getElementById("clr0");
	if (template)
	{
		var t = template.options[template.selectedIndex].value.split(",");

		document.getElementById('clr1').options.selectedIndex = t[0];
		document.getElementById('clr2').options.selectedIndex = t[1];
		document.getElementById('clr3').options.selectedIndex = t[2];
		document.getElementById('clr4').options.selectedIndex = t[3];
		document.getElementById('clr5').options.selectedIndex = t[4];

		gradient_preview();
	}
}

/**
* Dropdown Color pallette for colour selector
* Code from : http://www.mredkj.com/tutorials/tutorial005.html
**/
function gradient_colorPalette(el_id, form_id)
{
	if (!form_id)
	{
		form_id = 'abbcode_wizards';
	}

	var elSel = document.getElementById(el_id);

	if (!elSel)
	{
		return;
	}
	var numberList = {
		0 : '00',
		1 : '40',
		2 : '80',
		3 : 'BF',
		4 : 'FF'
	};

	for (var r = 4; r > -1; r--)
	{
		for (var g = 4; g > -1; g--)
		{
			for (var b = 4; b > -1; b--)
			{
				var color = String(numberList[r]) + String(numberList[g]) + String(numberList[b]);
				var optn = document.createElement('option');
					optn.text = '#' + color;
					optn.value = color;
					optn.style.backgroundColor = '#' + color;

				elSel.options.add(optn);
			}
		}
	}
}

function gradient_init()
{
	gradient_colorPalette('clr1');
	gradient_colorPalette('clr2');
	gradient_colorPalette('clr3');
	gradient_colorPalette('clr4');
	gradient_colorPalette('clr5');

	gradient_template();
}

function win_accept(tag)
{
	var FoundErrors = '';
	var tag_bbcode;
	if (!tag)
	{
		var tag_open = '{ABBC3_OPEN}';
		var tag_close = '{ABBC3_CLOSE}';
	}
	else
	{
		var tag_open = tag;
		var tag_close = '/' + tag;
	}

	if (tag === 'table')
	{
		var styleT			= (document.getElementById("promptbox1")	) ? document.getElementById("promptbox1").value	: '';

		var enterR			= (document.getElementById("promptbox2")	) ? document.getElementById("promptbox2").value	: '';
		var enterR_error	= (document.getElementById("errorbox2")		) ? document.getElementById("errorbox2").value	: '';
		if (!enterR && enterR_error)
		{
			FoundErrors += '\n' + enterR_error;
		}

		var styleR			= (document.getElementById("promptbox3")	) ? document.getElementById("promptbox3").value	: '';

		var enterC			= (document.getElementById("promptbox4")	) ? document.getElementById("promptbox4").value	: '';
		var enterC_error	= (document.getElementById("errorbox4")		) ? document.getElementById("errorbox4").value	: '';
		if (!enterC && enterC_error)
		{
			FoundErrors += '\n' + enterC_error;
		}

		var styleC			= (document.getElementById("promptbox5")	) ? document.getElementById("promptbox5").value	: '';

		if (FoundErrors != '')
		{
			alert("{LA_ABBC3_ERROR}" + FoundErrors);
			return;
		}

		var Row = '';
		for (var R = 0; R < parseInt(enterR, 10); R++)
		{
			Col = '';
			for (var C = 0; C < parseInt(enterC, 10); C++)
			{
				Col += "[td=" + styleC + "]" + "[/td]";
			}
			Row += "[tr=" + styleR + "]" + Col + "[/tr]\n";
		}

		tag_bbcode = '[' + tag_open + '=' + styleT + "]\n" + Row + '[' + tag_close + ']';
	}
	else
	{

		var tag_url			= (document.getElementById("promptbox1")	) ? document.getElementById("promptbox1").value			: '';
		var tag_url_error	= (document.getElementById("errorbox1")		) ? document.getElementById("errorbox1").value			: '';
		if (!tag_url && tag_url_error)
		{
			FoundErrors += '\n' + tag_url_error;
		}

		var tag_desc		= (document.getElementById("promptbox2")	) ? document.getElementById("promptbox2").value			: '';
		var tag_desc_error	= (document.getElementById("errorbox2")		) ? document.getElementById("errorbox2").value			: '';
		var tag_width		= (document.getElementById("promptbox3")	) ? " " + document.getElementById("promptbox3").value	: '';
		var tag_width_error	= (document.getElementById("errorbox3")		) ? document.getElementById("errorbox3").value			: '';
		if (tag_width === " " && tag_width_error)
		{
			FoundErrors += '\n' + tag_width_error;
		}

		var tag_height		= (document.getElementById("promptbox4")	) ? "," + document.getElementById("promptbox4").value	: '';
		var tag_height_error= (document.getElementById("errorbox4")		) ? document.getElementById("errorbox4").value			: '';
		if (tag_height == "," && tag_height_error)
		{
			FoundErrors += '\n' + tag_height_error;
		}

		if (FoundErrors != '')
		{
			alert("{LA_ABBC3_ERROR}" + FoundErrors);
			return;
		}

		close1 = (tag_desc || tag_desc) ? '' : ']';
		close2 = (tag_desc || tag_desc) ? ']' : '';
		tag_open += (tag_desc || tag_desc) ? '=' : '';

		var image_aligned = document.forms['abbcode_wizards'].elements['image_align'];
		if (image_aligned)
		{
			for (var i = 0; i < image_aligned.length; i++)
			{
				if (image_aligned[i].checked && image_aligned[i].value != 'none')
				{
					tag_open += '=' + image_aligned[i].value;
					break;
				}
			}
		}

		tag_bbcode = '[' + tag_open + tag_width + tag_height + close1 + tag_url + close2 + tag_desc + '[' + tag_close + ']';
	}
	win_close(tag_bbcode);
}

<!-- IF S_ABBC3_WIZARD_MODE eq '1' -->
/** Install the safety net  - START **/
if (window.onload_functions) // prosilver
{
	onload_functions[onload_functions.length] = "gradient_init();";
}
else if (typeof(window.addEventListener) != "undefined") // DOM
{
	window.addEventListener("load", gradient_init, false);
}
else if (typeof(window.attachEvent) != "undefined") // MSIE
{
	window.attachEvent("onload", gradient_init);
}
/** Install the safety net - END **/
<!-- ENDIF -->
