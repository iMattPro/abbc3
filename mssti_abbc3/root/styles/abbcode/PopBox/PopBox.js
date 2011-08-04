/********************************************************************************************************************
* PopBox.js, v2.7a Copyright (c) 2009, C6 Software, Inc. (http://www.c6software.com/)
* PopBox is released under the Creative Commons GNU GPL license (http://creativecommons.org/licenses/GPL/2.0/)
* and is free to use in both commercial and non-commercial work, provided this header remains at the top.
* The latest version and documentation can be found at http://www.c6software.com/products/popbox/default.aspx.
* Questions and suggestions can be sent to john.reid@c6software.com. Please put "PopBox" somewhere in the
* email subject so I can easily filter. Send me your URL and I may post it!
* PopBox relies on many methods from Danny Goodman's (www.dannyg.com) javascript library DHTMLAPI.js
* and his books, without which scores of web developers would be totally lost. Thanks Danny.
********************************************************************************************************************/

// Seek nested NN4 layer from string name
function SeekLayer(doc, name) {
    var theObj;
    for (var i = 0; i < doc.layers.length; i++) {
        if (doc.layers[i].name == name) {
            theObj = doc.layers[i];
            break;
        }
        // dive into nested layers if necessary
        if (doc.layers[i].document.layers.length > 0) {
            theObj = SeekLayer(document.layers[i].document, name);
        }
    }
    return theObj;
}

// Convert object name string or object reference into a valid element object reference
function GetRawObject(obj) {
    var theObj;
    if (typeof obj == "string") {
		var isCSS = (document.body && document.body.style) ? true : false;
        if (isCSS && document.getElementById) {
            theObj = document.getElementById(obj);
        } else if (isCSS && document.all) {
            theObj = document.all(obj);
        } else if (document.layers) {
            theObj = SeekLayer(document, obj);
        }
    } else {
        // pass through object reference
        theObj = obj;
    }
    return theObj;
}

// Return the available content width and height space in browser window
function GetInsideWindowSize() {
	 if (window.innerWidth) {
		  return {x:window.innerWidth, y:window.innerHeight};
    }
    else
    {
		 var baseArray = document.getElementsByTagName("base");
		 if (baseArray.length == 0)
		 {
			 if (document.compatMode && document.compatMode.indexOf("CSS1") >= 0) {
				  return {x:document.body.parentNode.clientWidth, y:document.body.parentNode.clientHeight};
			 } else if (document.body && document.body.clientWidth) {
				  return {x:document.body.clientWidth, y:document.body.clientHeight};
			 }
		 }
		 else
		 {
			 if (document.body && document.body.clientWidth) {
				  return {x:document.body.clientWidth, y:document.body.clientHeight};
			 } else if (document.compatMode && document.compatMode.indexOf("CSS1") >= 0) {
				  return {x:document.body.parentNode.clientWidth, y:document.body.parentNode.clientHeight};
			 }
		 }
    }
    return {x:0, y:0};
}

// Retrieve the padding around an object
function GetObjectPadding(obj) {
	var elem = GetRawObject(obj);

	var l = 0;
	var r = 0;
	var t = 0;
	var b = 0;
	if (elem.currentStyle)
	{
		if (elem.currentStyle.paddingLeft)
			l = parseInt(elem.currentStyle.paddingLeft, 10);
		if (elem.currentStyle.paddingRight)
			r = parseInt(elem.currentStyle.paddingRight, 10);
		if (elem.currentStyle.paddingTop)
			t = parseInt(elem.currentStyle.paddingTop, 10);
		if (elem.currentStyle.paddingBottom)
			b = parseInt(elem.currentStyle.paddingBottom, 10);
	}
	else if (window.getComputedStyle)
	{
		l = parseInt(window.getComputedStyle(elem,null).paddingLeft, 10);
		r = parseInt(window.getComputedStyle(elem,null).paddingRight, 10);
		t = parseInt(window.getComputedStyle(elem,null).paddingTop, 10);
		b = parseInt(window.getComputedStyle(elem,null).paddingBottom, 10);
	}
	if (isNaN(l) == true) l = 0;
	if (isNaN(r) == true) r = 0;
	if (isNaN(t) == true) t = 0;
	if (isNaN(b) == true) b = 0;

	return {l:(l),r:(r),t:(t),b:(b)};
}

// Retrieve the rendered size of an element
function GetObjectSize(obj)  {
    var elem = GetRawObject(obj);
    var w = 0;
    var h = 0;
    if (elem.offsetWidth) {
			w = elem.offsetWidth; h = elem.offsetHeight;
    } else if (elem.clip && elem.clip.width) {
			w = elem.clip.width; h = elem.clip.height;
    } else if (elem.style && elem.style.pixelWidth) {
			w = elem.style.pixelWidth; h = elem.style.pixelHeight;
    }
    
    w = parseInt(w, 10);
    h = parseInt(h, 10);
    
   // remove any original element padding
   var padding = GetObjectPadding(elem);
   w -= (padding.l + padding.r);
   h -= (padding.t + padding.b);

   return {w:(w), h:(h)};
}

// Return the element position in the page, not it's parent container
function GetElementPosition(obj)
{
	var elem = GetRawObject(obj);
	var left = 0;
	var top = 0;

	// add any original element padding
	var elemPadding = GetObjectPadding(elem);
	left = elemPadding.l;
	top = elemPadding.t;

	if (elem.offsetParent)
	{
		left += elem.offsetLeft;
		top += elem.offsetTop;
		var parent = elem.offsetParent;
		while (parent)
		{
			left += parent.offsetLeft;
			top += parent.offsetTop;

			if (parent.style && parent.style.overflow && parent.style.overflow != "")
			{
				left -= parent.scrollLeft;
				top -= parent.scrollTop;
			}

			var parentTagName = parent.tagName.toLowerCase();
			if (parentTagName != "table" &&
				parentTagName != "body" && 
				parentTagName != "html" && 
				parentTagName != "div" && 
				parent.clientTop && 
				parent.clientLeft)
			{
				left += parent.clientLeft;
				top += parent.clientTop;
			}

			parent = parent.offsetParent;
		}
	}
	else if (elem.left && elem.top)
	{
		left = elem.left;
		top = elem.top;
	}
	else
	{
		if (elem.x)
			left = elem.x;
		if (elem.y)
			top = elem.y;
	}
	return {x:left, y:top};
}

// return the number of pixels the scrollbar has moved the visible window
function GetScrollOffset()
{
    if (window.pageYOffset) {
        return {x:window.pageXOffset, y:window.pageYOffset};
    } else if (document.compatMode && document.compatMode.indexOf("CSS1") >= 0) {
        return {x:document.documentElement.scrollLeft, y:document.documentElement.scrollTop};
    } else if (document.body && document.body.clientWidth) {
        return {x:document.body.scrollLeft, y:document.body.scrollTop};
    }
    return {x:0, y:0};
}

function CreateRandomId()
{
	var randomNum = 0.0;
	while (randomNum == 0.0)
		randomNum = Math.random();
	var random = randomNum + "";
	return "id" + random.substr(2);
}

function MouseMoveRevert(e)
{
	if (pbMouseMoveRevert != null && pbMouseMoveRevert.length != 0)
	{
		var evt = (e) ? e : window.event;
		var mouse = {x:0, y:0};
		if (evt.pageX || evt.pageY)
		{
			mouse.x = evt.pageX;
			mouse.y = evt.pageY;
		}
		else if (evt.clientX || evt.clientY)
		{
			var scroll = GetScrollOffset();
			mouse.x = evt.clientX + scroll.x;
			mouse.y = evt.clientY + scroll.y;
		}
		
		for (var x = 0; x < pbMouseMoveRevert.length;)
		{
			if (pbMouseMoveRevert[x] != null)
			{
				var id = pbMouseMoveRevert[x].id;
				if (typeof popBox[id] != "undefined" && popBox[id] != null && popBox[id].hTarg != 0)
				{
					// if the mouse is outside the box then call revert
					if (mouse.x < popBox[id].xTarg || mouse.x > (popBox[id].xTarg + popBox[id].wTarg) || mouse.y < popBox[id].yTarg || mouse.y > (popBox[id].yTarg + popBox[id].hTarg))
					{
						var className = pbMouseMoveRevert[x].className;
						pbMouseMoveRevert.splice(x, 1);
						Revert(id, null, className);
						continue;
					}
				}				
			}
			
			x++;
		}
	}
}

// holds numerous properties related to position, size and motion
var popBox = new Array();
var popBoxIds = new Array();
// holds positioning value for the z axis
var popBoxZ = 100;
// holds the popped image for each <img> tag with a pbsrc attribute
var pbSrc = new Array();
// holds the popbar function for each <img> tag with a pbShowPopBar attribute
var pbPopBarFunc = new Array();
// holds the array of image ids for onmousemove Revert calls
var pbMouseMoveRevert = null;

// add initialization to window.onload
if (typeof window.onload == 'function')
{
	var func = window.onload;
	window.onload = function(){func();InitPbSrc();InitPbPopBar();};
}
else
{
	window.onload = function(){InitPbSrc();InitPbPopBar();};
}

// loads all the popped src images
function InitPbSrc()
{
	var images = null;
	if (document.body)
	{
		if (document.body.getElementsByTagName)
			images = document.body.getElementsByTagName("img");
		else if (document.body.all)
			images = document.body.all.tags("img");
	}

	if (images != null)
	{
		for (var x = 0; x < images.length; x++)
		{
			var poppedSrc = images[x].getAttribute('pbSrc');
			if (poppedSrc != null)
			{
				if (images[x].id == "")
					images[x].id = CreateRandomId();
					
				if (pbSrc[images[x].id] == null)
				{
					pbSrc[images[x].id] = new Image();
					pbSrc[images[x].id].src = poppedSrc;
				}
			}
		}
	}
}

// adds PopBar to images
function InitPbPopBar()
{
	var images = null;
	if (document.body)
	{
		if (document.body.getElementsByTagName)
			images = document.body.getElementsByTagName("img");
		else if (document.body.all)
			images = document.body.all.tags("img");
	}

	if (images != null)
	{
		var imgArray = new Array();
		for (var x = 0; x < images.length; x++)
		{
			if (images[x].id == "")
				images[x].id = CreateRandomId();
			
			imgArray[x] = images[x];
		}

		for (var x = 0; x < imgArray.length; x++)
			CreatePopBar(imgArray[x]);
	}
}

// initialize default popbox object
function InitPopBox(obj)
{
	obj = GetRawObject(obj);
	if (typeof popBox[obj.id] != "undefined" && popBox[obj.id] != null)
		return obj;
		
	var parent = document.body;
	if (obj.id == "")
		obj.id = CreateRandomId();

	var elem = obj;
	var startPos = GetElementPosition(elem);
	var initSize = GetObjectSize(elem);

	if (elem.style.position == "absolute" || elem.style.position == "relative")
	{
		parent = elem.parentNode;
		startPos.x = parseInt(elem.style.left, 10);
		startPos.y = parseInt(elem.style.top, 10);
	}

	// if there is a pbsrc then create that, else if it's not absolute or relative then create a copy
	if (pbSrc[elem.id] != null || (elem.style.position != "absolute" && elem.style.position != "relative"))
	{
		var strSrc = (pbSrc[elem.id] != null) ? pbSrc[elem.id].src : elem.src;
		var img = null;
		try{img = document.createElement("<img src='" + strSrc + "' />");}
		catch(ex){img = document.createElement("img"); img.src = strSrc;}
		// copy image properties
		img.border = elem.border;
		img.className = elem.className;
		img.height = elem.height;
		img.id = "popcopy" + elem.id;
		img.alt = elem.alt;
		img.title = elem.title;
		img.width = elem.width;
		img.onclick = elem.onclick;
		img.ondblclick = elem.ondblclick;
		img.onmouseout = elem.onmouseout;

		// remove event so the object doesn't jump
		elem.onmouseout = null;

		img.style.width = initSize.w;
		img.style.height = initSize.h;
		img.style.position = "absolute";
		img.style.left = startPos.x + "px";
		img.style.top = startPos.y + "px";
		img.style.cursor = elem.style.cursor;
		
		parent.appendChild(img);
		elem.style.visibility = "hidden";
		elem = img;
	}

	popBoxIds.push(elem.id);	
	popBox[elem.id] = {	elemId:elem.id,
							xCurr:0.0,
							yCurr:0.0,
							xTarg:0.0,
							yTarg:0.0,
							wCurr:0.0,
							hCurr:0.0,
							wTarg:0.0,
							hTarg:0.0,
							xStep:0.0,
							yStep:0.0,
							wStep:0.0,
							hStep:0.0,
							xDelta:0.0,
							yDelta:0.0,
							wDelta:0.0,
							hDelta:0.0,
							xTravel:0.0,
							yTravel:0.0,
							wTravel:0.0,
							hTravel:0.0,
							velM:1.0,
							velS:1.0,
							interval:null,
							isAnimating:false,
							xOriginal:startPos.x,
							yOriginal:startPos.y,
							wOriginal:parseFloat(initSize.w),
							hOriginal:parseFloat(initSize.h),
							isPopped:false,
							fnClick:null,
							fnDone:null,
							fnPre:null,
							originalId:null,
							cursor:""
							};
							
	if (typeof obj.onclick == "function")
	{
		popBox[elem.id].fnClick = elem.onclick;
		
		if (popBoxAutoClose == true && (typeof obj.ondblclick != "function" || obj.ondblclick == null) && typeof obj.onmouseover != "function")
			elem.ondblclick = function(){Revert(elem.id, null, elem.className);};
	}

	if (popBoxAutoClose == true && typeof obj.onmouseover == "function" && (typeof obj.onmouseout != "function" || obj.onmouseout == null))
	{
		if (popBoxMouseMoveRevert == true)
		{
			if (pbMouseMoveRevert == null)
			{
				pbMouseMoveRevert = new Array();
				if (typeof document.onmousemove == 'function')
				{
					var func = document.onmousemove;
					document.onmousemove = function(e){func(e);MouseMoveRevert(e);};
				}
				else
				{
					document.onmousemove = MouseMoveRevert;
				}
			}
			
			pbMouseMoveRevert.push({id:elem.id, className:elem.className});
		}
		else
		{
			elem.onmouseout = function(){Revert(elem.id, null, elem.className);};
		}
	}

	if (obj.id != elem.id)
		popBox[elem.id].originalId = obj.id;
		
	return elem;
}

// calculate next steps and assign to style properties
function DoPopBox(elem)
{
	if (typeof elem == "string") elem = GetRawObject(elem);
	try
	{
		var bMDone = false;
		var bSDone = false;
		if ((popBox[elem.id].xTravel + Math.abs(popBox[elem.id].xStep)) < popBox[elem.id].xDelta)
		{
			var x = popBox[elem.id].xCurr + popBox[elem.id].xStep;
			elem.style.left = parseInt(x, 10) + "px";
			popBox[elem.id].xTravel += Math.abs(popBox[elem.id].xStep);
			popBox[elem.id].xCurr = x;
		} else {
			popBox[elem.id].xTravel += Math.abs(popBox[elem.id].xStep);
			elem.style.left = parseInt(popBox[elem.id].xTarg, 10) + "px";
			bMDone = true;
		}
		if ((popBox[elem.id].yTravel + Math.abs(popBox[elem.id].yStep)) < popBox[elem.id].yDelta)
		{
			var y = popBox[elem.id].yCurr + popBox[elem.id].yStep;
			elem.style.top = parseInt(y, 10) + "px";
			popBox[elem.id].yTravel += Math.abs(popBox[elem.id].yStep);
			popBox[elem.id].yCurr = y;
			bMDone = false;
		} else {
			popBox[elem.id].yTravel += Math.abs(popBox[elem.id].yStep);
			elem.style.top = parseInt(popBox[elem.id].yTarg, 10) + "px";
		}
		if ((popBox[elem.id].wTravel + Math.abs(popBox[elem.id].wStep)) < popBox[elem.id].wDelta)
		{
			var w = popBox[elem.id].wCurr + popBox[elem.id].wStep;
			elem.style.width = parseInt(w, 10) + "px";
			popBox[elem.id].wTravel += Math.abs(popBox[elem.id].wStep);
			popBox[elem.id].wCurr = w;
		} else {
			popBox[elem.id].wTravel += Math.abs(popBox[elem.id].wStep);
			elem.style.width = parseInt(popBox[elem.id].wTarg, 10) + "px";
			bSDone = true;
		}
		if ((popBox[elem.id].hTravel + Math.abs(popBox[elem.id].hStep)) < popBox[elem.id].hDelta)
		{
			var h = popBox[elem.id].hCurr + popBox[elem.id].hStep;
			elem.style.height = parseInt(h, 10) + "px";
			popBox[elem.id].hTravel += Math.abs(popBox[elem.id].hStep);
			popBox[elem.id].hCurr = h;
			bSDone = false;
		} else {
			popBox[elem.id].hTravel += Math.abs(popBox[elem.id].hStep);
			elem.style.height = parseInt(popBox[elem.id].hTarg, 10) + "px";
		}

		var obj = elem;
		
		if (bMDone == true && bSDone == true)
		{
			clearInterval(popBox[elem.id].interval);
			
			elem.style.cursor = popBox[elem.id].cursor;

			var func = null;
			if (popBox[elem.id].fnDone != null && typeof popBox[elem.id].fnDone == "function")
				func = popBox[elem.id].fnDone;
			
			if (popBox[elem.id].isPopped == true)
			{
				elem.style.zIndex = "";
	
				if (popBox[elem.id].originalId != null)
				{
					obj = GetRawObject(popBox[elem.id].originalId);
					obj.onmouseout = elem.onmouseout; // copy method back to original
					obj.style.visibility = "visible";
					
					// remove the copied object from the body and the array
					elem.parentNode.removeChild(elem);
				}
				else
				{
					elem.style.width = parseInt(popBox[elem.id].wOriginal, 10) + "px";
					elem.style.height = parseInt(popBox[elem.id].hOriginal, 10) + "px";
				
					if (typeof popBox[elem.id].fnClick == "function")
						elem.onclick = popBox[elem.id].fnClick;
				}

				delete popBox[elem.id];
				popBox[elem.id] = null;
				CreatePopBar(obj);
			}
			else
			{
				popBox[elem.id].isPopped = true;
				popBox[elem.id].isAnimating = false;
				CreateRevertBar(elem);
			}
				
			if (func != null && typeof func == "function")
				func(obj);
		}
	}
	catch(ex){}
}

function HasRevertBar(obj)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	
	var elem = obj;
	if (popBox[elem.id] != null && popBox[elem.id].originalId != null)
		elem = GetRawObject(popBox[elem.id].originalId);

	var pbShowBar = elem.getAttribute('pbShowRevertBar');
	var pbShowText = elem.getAttribute('pbShowRevertText');
	var pbShowImage = elem.getAttribute('pbShowRevertImage');
	pbShowBar = (pbShowBar != null) ? (pbShowBar == "true" || pbShowBar == true) : popBoxShowRevertBar;
	pbShowText = (pbShowText != null) ? (pbShowText == "true" || pbShowText == true) : popBoxShowRevertText;
	pbShowImage = (pbShowImage != null) ? (pbShowImage == "true" || pbShowImage == true) : popBoxShowRevertImage;
	
	return (pbShowBar || pbShowText || pbShowImage);
}

function HasCaption(obj)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	var elem = obj;
	if (popBox[elem.id] != null && popBox[elem.id].originalId != null)
		elem = GetRawObject(popBox[elem.id].originalId);

	var pbShowCaption = elem.getAttribute('pbShowCaption');
	pbShowCaption = (pbShowCaption != null) ? (pbShowCaption == "true" || pbShowCaption == true) : popBoxShowCaption;
	var pbCaption = null;
	if (pbShowCaption == true)
	{
		pbCaption = elem.getAttribute('pbCaption');
		if (pbCaption == null && elem.title != "") pbCaption = elem.title;
	}

	return (pbCaption != null && pbCaption != "");
}

function CreateRevertBar(obj)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	
	var elem = obj;
	if (popBox[elem.id] != null && popBox[elem.id].originalId != null)
		elem = GetRawObject(popBox[elem.id].originalId);

	var pbShowBar = elem.getAttribute('pbShowRevertBar');
	var pbShowText = elem.getAttribute('pbShowRevertText');
	var pbShowImage = elem.getAttribute('pbShowRevertImage');
	var pbText = elem.getAttribute('pbRevertText');
	var pbImage = elem.getAttribute('pbRevertImage');
	pbShowBar = (pbShowBar != null) ? (pbShowBar == "true" || pbShowBar == true) : popBoxShowRevertBar;
	pbShowText = (pbShowText != null) ? (pbShowText == "true" || pbShowText == true) : popBoxShowRevertText;
	pbShowImage = (pbShowImage != null) ? (pbShowImage == "true" || pbShowImage == true) : popBoxShowRevertImage;
	if (pbText == null) pbText = popBoxRevertText;
	if (pbImage == null) pbImage = popBoxRevertImage;

	var pbShowCaption = elem.getAttribute('pbShowCaption');
	pbShowCaption = (pbShowCaption != null) ? (pbShowCaption == "true" || pbShowCaption == true) : popBoxShowCaption;
	var pbCaption = null;
	if (pbShowCaption == true)
	{
		pbCaption = elem.getAttribute('pbCaption');
		if (pbCaption == null && elem.title != "") pbCaption = elem.title;
	}

	CreatePbBar(obj, pbShowBar, pbShowText, pbShowImage, pbText, pbImage, popBoxRevertBarAbove, true, pbCaption)
}

function CreatePopBar(obj)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	if (typeof pbPopBarFunc[obj.id] != 'undefined' && pbPopBarFunc[obj.id] != null) return;
	var pbShowBar = obj.getAttribute('pbShowPopBar');
	if (pbShowBar != null)
	{
		var pbShowText = obj.getAttribute('pbShowPopText');
		var pbShowImage = obj.getAttribute('pbShowPopImage');
		var pbText = obj.getAttribute('pbPopText');
		var pbImage = obj.getAttribute('pbPopImage');
		pbShowBar = (pbShowBar == "true" || pbShowBar == true);
		pbShowText = (pbShowText != null) ? (pbShowText == "true" || pbShowText == true) : popBoxShowPopText;
		pbShowImage = (pbShowImage != null) ? (pbShowImage == "true" || pbShowImage == true) : popBoxShowPopImage;
		if (pbText == null) pbText = popBoxPopText;
		if (pbImage == null) pbImage = popBoxPopImage;

		CreatePbBar(obj, pbShowBar, pbShowText, pbShowImage, pbText, pbImage, popBoxPopBarAbove, false, null)
	}
}

function CreatePbBar(obj, pbShowBar, pbShowText, pbShowImage, pbText, pbImage, pbBarAbove, isRevert, pbCaption)
{
	if (pbShowBar == false && pbShowText == false && pbShowImage == false && pbCaption == null) return;
	if (typeof obj == "string") obj = GetRawObject(obj);

	var objCursor = "hand";
	if (obj.currentStyle)
		objCursor = obj.currentStyle.cursor;
	else if (window.getComputedStyle)
		objCursor = window.getComputedStyle(obj,null).cursor;

	var fnClick = function(){if (typeof obj.onclick == 'function') obj.onclick();};
	var fnMouseOut = function(){if (typeof obj.onmouseout == 'function') obj.onmouseout();};
	var fnMouseOver = function(){if (typeof obj.onmouseover == 'function') obj.onmouseover();};
	var fnRemove = new Array();

	var isPositioned = (obj.style.position == "absolute" || obj.style.position == "relative");
	var left = 0;
	var top = 0;
	var parentNode = obj.parentNode;
	var objSpan = null;
	if (isPositioned == true)
	{
		left = parseInt(obj.style.left, 10);
		top = parseInt(obj.style.top, 10);
		var padding = GetObjectPadding(obj);
		left += padding.l;
		top += padding.t;	
	}
	else
	{
		objSpan = document.createElement("span");
		objSpan = (obj.nextSibling != null) ? parentNode.insertBefore(objSpan, obj.nextSibling) : parentNode.appendChild(objSpan);
		objSpan.style.position = "relative";
		objSpan.style.left = "0px";
		objSpan.style.top = "0px";
		var floatValue = "";
		if (obj.align == "left") floatValue = "left";
		else if (obj.align == "right") floatValue = "right";
		floatValue = (obj.style.styleFloat && obj.style.styleFloat != "") ? obj.style.styleFloat : (obj.style.cssFloat && obj.style.cssFloat != "") ? obj.style.cssFloat : floatValue;
		if (typeof obj.style.styleFloat != "undefined") objSpan.style.styleFloat = floatValue;
		else if (typeof obj.style.cssFloat != "undefined") objSpan.style.cssFloat = floatValue;
		
		var imgPos = GetElementPosition(obj);
		var spanPos = GetElementPosition(objSpan);
		objSpan.style.left = (imgPos.x - spanPos.x) + "px";
		objSpan.style.top = (floatValue != "") ? "1px" : (imgPos.y - spanPos.y) + "px";
		
		parentNode = objSpan;
	}

	var width = parseInt(obj.style.width, 10);
	var height = parseInt(obj.style.height, 10);
	var size = GetObjectSize(obj);
	if (isNaN(width) == true)
		width = size.w;
	else if (size.w > width)
		left += ((size.w - width) / 2);
	if (isNaN(height) == true)
		height = size.h;
	else if (size.h > height)
		top += ((size.h - height) / 2);

	if (pbBarAbove == true) top -= 20;
	var z = obj.style.zIndex + 1;

	if (pbShowBar == true)
	{
		var divTrans = document.createElement("div");
		divTrans.id = "popBoxDivTrans" + z;
		divTrans.style.width = width + "px";
		divTrans.style.height = "20px";
		divTrans.style.borderStyle = "none";
		divTrans.style.padding = "0px";
		divTrans.style.margin = "0px";
		divTrans.style.position = "absolute";
		divTrans.style.left = left + "px";
		divTrans.style.top = top + "px";
		divTrans.style.backgroundColor = "#000000";
		divTrans.style.cursor = objCursor;
		divTrans.style.zIndex = z;
		if (pbBarAbove == false)
		{
			if (typeof divTrans.style.filter != 'undefined')
				divTrans.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=20)";
			if (typeof divTrans.style.opacity != 'undefined')
				divTrans.style.opacity = "0.2";
		}
		divTrans.onclick = fnClick;
		if (isRevert == true)
			divTrans.onmouseout = fnMouseOut;
		else
			divTrans.onmouseover = fnMouseOver;
		parentNode.appendChild(divTrans);
		
		fnRemove.push(function(){divTrans.parentNode.removeChild(divTrans);});
	}

	if (pbShowText == true)
	{
		var divText = document.createElement("div");
		divText.id = "popBoxDivText" + z;
		divText.style.width = width + "px";
		divText.style.height = "20px";
		divText.style.borderStyle = "none";
		divText.style.padding = "0px";
		divText.style.margin = "0px";
		divText.style.position = "absolute";
		divText.style.left = left + "px";
		divText.style.top = top + "px";
		divText.style.cursor = objCursor;
		divText.style.textAlign = "center";
		divText.style.fontFamily = "Arial, Verdana, Sans-Serif";
		divText.style.fontSize = "10pt";
		divText.style.backgroundColor = "Transparent";
		divText.style.color = "#ffffff";
		divText.style.zIndex = z;
		divText.innerHTML = pbText;
		divText.onclick = fnClick;
		if (isRevert == true)
			divText.onmouseout = fnMouseOut;
		else
			divText.onmouseover = fnMouseOver;
		parentNode.appendChild(divText);

		fnRemove.push(function(){divText.parentNode.removeChild(divText);});
	}
	
	if (pbShowImage == true)
	{
		var imgPopped = null;
		try{imgPopped = document.createElement("<img src='" + pbImage + "' />");}
		catch(ex){imgPopped = document.createElement("img"); imgPopped.src = pbImage;}
		imgPopped.id = "popBoxImgPopped" + z;
		imgPopped.style.width = "20px";
		imgPopped.style.height = "20px";
		imgPopped.style.borderStyle = "none";
		imgPopped.style.padding = "0px";
		imgPopped.style.margin = "0px";
		imgPopped.style.position = "absolute";
		imgPopped.style.left = (left + width - 20) + "px";
		imgPopped.style.top = top + "px";
		imgPopped.style.cursor = objCursor;
		imgPopped.style.zIndex = z;
		imgPopped.onclick = fnClick;
		if (isRevert == true)
			imgPopped.onmouseout = fnMouseOut;
		else
			imgPopped.onmouseover = fnMouseOver;
		parentNode.appendChild(imgPopped);

		fnRemove.push(function(){imgPopped.parentNode.removeChild(imgPopped);});
	}
	
	if (pbCaption != null && pbCaption != "")
	{
		top += (height - 20);
		if (pbBarAbove == true) top += 20;
		if (popBoxCaptionBelow == true)  top += 20;

		var divCapTrans = document.createElement("div");
		divCapTrans.id = "popBoxDivCapTrans" + z;
		divCapTrans.style.width = width - 2 + "px";
		divCapTrans.style.height = "20px";
		divCapTrans.style.borderStyle = "solid";
		divCapTrans.style.borderWidth = "1px";
		divCapTrans.style.borderColor = "#999999";
		divCapTrans.style.padding = "0px";
		divCapTrans.style.margin = "0px";
		divCapTrans.style.position = "absolute";
		divCapTrans.style.left = left + "px";
		divCapTrans.style.top = top - 1 + "px";
		divCapTrans.style.backgroundColor = "#ffffdd";
		divCapTrans.style.zIndex = z;
		if (popBoxCaptionBelow == false)
		{
			if (typeof divCapTrans.style.filter != 'undefined')
				divCapTrans.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=70)";
			if (typeof divCapTrans.style.opacity != 'undefined')
				divCapTrans.style.opacity = "0.7";
		}
		parentNode.appendChild(divCapTrans);
		fnRemove.push(function(){divCapTrans.parentNode.removeChild(divCapTrans);});

		var divCapText = document.createElement("div");
		divCapText.id = "popBoxDivCapText" + z;
		divCapText.style.width = width - 20 + "px";
		divCapText.style.height = "20px";
		divCapText.style.borderStyle = "none";
		divCapText.style.padding = "0px";
		divCapText.style.margin = "0px";
		divCapText.style.position = "absolute";
		divCapText.style.left = left + 10 + "px";
		divCapText.style.top = top + "px";
		divCapText.style.textAlign = "center";
		divCapText.style.fontFamily = "Arial, Verdana, Sans-Serif";
		divCapText.style.fontSize = "10pt";
		divCapText.style.overflowY = "hidden";
		divCapText.style.backgroundColor = "Transparent";
		divCapText.style.color = "#000000";
		divCapText.style.zIndex = z;
		parentNode.appendChild(divCapText);
		fnRemove.push(function(){divCapText.parentNode.removeChild(divCapText);});

		AddCaptionText(divCapTrans, divCapText, pbCaption);
		
		if (popBoxExpandCaptions == true && divCapText.hasChildNodes() == true)
		{
			var spanMore = divCapText.lastChild;
			if (spanMore && spanMore.onclick)
			{
				spanMore.id = CreateRandomId();
				setTimeout(new Function("", "var spanMore = GetRawObject('" + spanMore.id + "'); if (spanMore != null && spanMore.onclick) { spanMore.onclick(); }"), 10);
			}
		}
	}

	if (fnRemove.length != 0)
	{
		if (objSpan != null)
			fnRemove.push(function(){objSpan.parentNode.removeChild(objSpan);});
		
		if (isRevert == true)
		{
			if(popBox[obj.id].fnPre != null && typeof(popBox[obj.id].fnPre) == 'function')
				fnRemove.push(popBox[obj.id].fnPre);
		
			popBox[obj.id].fnPre = function(){for(var x = 0; x < fnRemove.length; x++){fnRemove[x]();}};
		}
		else
		{
			pbPopBarFunc[obj.id] = function(){for(var x = 0; x < fnRemove.length; x++){fnRemove[x]();}};
		}
	}
}

function AddCaptionText(divCapTrans, divCapText, caption)
{
	var width = parseInt(divCapText.style.width, 10);
	var divSizer = document.createElement("div");
	divSizer.style.position = "absolute";
	divSizer.style.width = width + "px";
	divSizer.style.margin = "0px";
	divSizer.style.fontFamily = divCapText.style.fontFamily;
	divSizer.style.fontSize = divCapText.style.fontSize;
	divSizer.style.visibility = "hidden";
	divSizer.innerHTML = caption;
	document.body.appendChild(divSizer);
	var newSize = GetObjectSize(divSizer);
	if (newSize.h > 20)
	{
		divSizer.innerHTML = caption + "..." + popBoxCaptionLessText;

		newSize = GetObjectSize(divSizer);

		var fullCaption = caption;
		var charCount = parseInt(width * 0.14, 10) - 5; // safe estimate
		divCapText.innerHTML = caption.substr(0, charCount) + "...";
		
		var spanMore = document.createElement("span");
		spanMore.style.color = "#0000ff";
		spanMore.style.textDecoration = "underline";
		spanMore.style.cursor = "pointer";
		spanMore.onclick = function(){spanMore.parentNode.removeChild(spanMore);ResizeCaption(divCapTrans.id,divCapText.id,newSize.h,fullCaption);};
		spanMore.innerHTML = popBoxCaptionMoreText;
		divCapText.appendChild(spanMore);
	}
	else
		divCapText.innerHTML = caption;

	document.body.removeChild(divSizer);
}

function ResizeCaption(divCapTrans, divCapText, height, caption)
{
	if (typeof divCapTrans == "string") divCapTrans = GetRawObject(divCapTrans);
	if (typeof divCapText == "string") divCapText = GetRawObject(divCapText);

	var h = parseInt(divCapText.style.height, 10);
	var top = parseInt(divCapText.style.top, 10);
	
	if (h < height)
	{
		if (h == 20)
		{
			height += 10;
			divCapText.style.paddingTop = "5px";
			divCapText.innerHTML = caption + "...";
			
			var spanLess = document.createElement("span");
			spanLess.style.color = "#0000ff";
			spanLess.style.textDecoration = "underline";
			spanLess.style.cursor = "pointer";
			spanLess.onclick = function(){spanLess.parentNode.removeChild(spanLess);divCapText.innerHTML = caption;ResizeCaption(divCapTrans.id,divCapText.id,20,caption);};
			spanLess.innerHTML = popBoxCaptionLessText;
			divCapText.appendChild(spanLess);
			
			if (popBoxCaptionBelow == false)
			{
				if (typeof divCapTrans.style.filter != 'undefined')
					divCapTrans.style.filter = "";
				if (typeof divCapTrans.style.opacity != 'undefined')
					divCapTrans.style.opacity = "1.0";
			}
		}
		
		if ((h + 10) >= height)
		{
			if (popBoxExpandCaptionsBelow == false)
				top -= (height - h);
			h = height;
		}
		else
		{
			if (popBoxExpandCaptionsBelow == false)
				top -= 10;
			h += 10;
		}
		
		divCapTrans.style.height = h + "px";
		divCapText.style.height = h + "px";
		divCapTrans.style.top = (top - 1) + "px";
		divCapText.style.top = top + "px";

		if (h != height)
			setTimeout("ResizeCaption(\"" + divCapTrans.id + "\",\"" + divCapText.id + "\"," + height + ",\"" + caption + "\")", 10);
	}
	else
	{
		if ((h - 10) <= height)
		{
			if (popBoxExpandCaptionsBelow == false)
				top += (h - height);
			h = height;
		}
		else
		{
			if (popBoxExpandCaptionsBelow == false)
				top += 10;
			h -= 10;
		}
		
		divCapTrans.style.height = h + "px";
		divCapText.style.height = h + "px";
		divCapTrans.style.top = (top - 1) + "px";
		divCapText.style.top = top + "px";
		divCapText.style.paddingTop = "0px";

		if (h == height)
		{
			if (popBoxCaptionBelow == false)
			{
				if (typeof divCapTrans.style.filter != 'undefined')
					divCapTrans.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity=70)";
				if (typeof divCapTrans.style.opacity != 'undefined')
					divCapTrans.style.opacity = "0.7";
			}

			AddCaptionText(divCapTrans, divCapText, caption);
		}
		else
		{
			setTimeout("ResizeCaption(\"" + divCapTrans.id + "\",\"" + divCapText.id + "\"," + height + ",\"" + caption + "\")", 10);
		}
	}
}

function CreateWaitImage(obj)
{
	if (typeof obj == "string") obj = GetRawObject(obj);

	var newId = "popBoxImgWait" + obj.id;
	var imgWait = GetRawObject(newId);
	if (imgWait != null)
		return imgWait;

	var left = 0;
	var top = 0;
	if (obj.style.position == "absolute" || obj.style.position == "relative")
	{
		left = parseInt(obj.style.left, 10);
		top = parseInt(obj.style.top, 10);
	}
	else
	{
		var xy = GetElementPosition(obj);
		left = xy.x;
		top = xy.y;
		var padding = GetObjectPadding(obj);
		left -= padding.l;
		top -= padding.t;
	}

	var width = parseInt(obj.style.width, 10);
	var height = parseInt(obj.style.height, 10);
	var size = GetObjectSize(obj);
	if (isNaN(width) == true)
		width = size.w;
	else if (size.w > width)
		left += ((size.w - width) / 2);
	if (isNaN(height) == true)
		height = size.h;
	else if (size.h > height)
		top += ((size.h - height) / 2);

	var parentNode = obj.parentNode;

	try{imgWait = document.createElement("<img src='" + popBoxWaitImage.src + "' />");}
	catch(ex){imgWait = document.createElement("img"); imgWait.src = popBoxWaitImage.src;}
	imgWait.id = newId;
	imgWait.style.position = "absolute";
	imgWait.style.left = (left + (width / 2) - (popBoxWaitImage.width / 2)) + "px";
	imgWait.style.top = (top + (height / 2) - (popBoxWaitImage.height / 2)) + "px";
	imgWait.style.cursor = obj.style.cursor;
	imgWait.style.zIndex = obj.style.zIndex + 1;
	parentNode.appendChild(imgWait);

	return imgWait;
}

// encapsulates the Popped image sizing logic
function CalculateImageDimensions(newWidth, newHeight, fullWidth, fullHeight, windowSize)
{
	if (newWidth == null)
	{
		if (newHeight == null)
		{
			newWidth = fullWidth;
			newHeight = fullHeight;
		}
		else if (newHeight == 0)
		{
			newHeight = Math.min(windowSize.y, fullHeight);
			var scale = parseFloat(newHeight) / parseFloat(fullHeight);
			newWidth = parseInt(fullWidth * scale);
		}
		else
		{
			var scale = parseFloat(newHeight) / parseFloat(fullHeight);
			newWidth = parseInt(fullWidth * scale);
		}
	}
	else if (newWidth == 0)
	{
		if (newHeight == null)
		{
			newWidth = Math.min(windowSize.x, fullWidth);
			var scale = parseFloat(newWidth) / parseFloat(fullWidth);
			newHeight = parseInt(fullHeight * scale);
		}
		else if (newHeight == 0)
		{
			if (windowSize.x < fullWidth || windowSize.y < fullHeight)
			{
				var scale = Math.min(parseFloat(windowSize.x) / parseFloat(fullWidth), parseFloat(windowSize.y) / parseFloat(fullHeight));
				newWidth = parseInt(fullWidth * scale);
				newHeight = parseInt(fullHeight * scale);
			}
			else
			{
				newWidth = fullWidth;
				newHeight = fullHeight;
			}
		}
		else
		{
			var scale = parseFloat(newHeight) / parseFloat(fullHeight);
			newWidth = Math.min(windowSize.x, parseInt(fullWidth * scale));
		}
	}
	else
	{
		if (newHeight == null)
		{
			var scale = parseFloat(newWidth) / parseFloat(fullWidth);
			newHeight = parseInt(fullHeight * scale);
		}
		else if (newHeight == 0)
		{
			var scale = parseFloat(newWidth) / parseFloat(fullWidth);
			newHeight = Math.min(windowSize.y, parseInt(fullHeight * scale));
		}
	}
	
	return {x:newWidth, y:newHeight};
}

function GetObjectToPop(obj)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	if (obj.id == "")
		obj.id = CreateRandomId();

	var poppedSrc = obj.getAttribute('pbSrcNL');
	if (poppedSrc == null && pbSrc[obj.id] == null)
		poppedSrc = obj.getAttribute('pbSrc');

	if (poppedSrc != null && pbSrc[obj.id] == null)
	{
		var poppedImg = new Image();
		poppedImg.src = poppedSrc;
		
		if (pbSrc[obj.id] != null)
			delete pbSrc[obj.id];
			
		pbSrc[obj.id] = poppedImg;
	}
	
	return (pbSrc[obj.id] != null) ? pbSrc[obj.id] : obj;
}

function GetPoppedImageSize(obj)
{
	var size = {x:0, y:0};
	if (obj != null && typeof obj.id != 'undefined')
	{
		if (pbSrc[obj.id] != null)
		{
			size.x = pbSrc[obj.id].width;
			size.y = pbSrc[obj.id].height;
		}
		else if (obj.naturalWidth && obj.naturalHeight)
		{
			size.x = obj.naturalWidth;
			size.y = obj.naturalHeight;
		}
		else
		{
			var img = new Image();
			img.src = obj.src;
			size.x = img.width;
			size.y = img.height;
			delete img;
		}
	}
	return size;
}

/***************************************************************************************************
* This is where the user-callable section starts.
* Function signatures above this line are subject to change.
***************************************************************************************************/

// Globals you can assign
var popBoxAutoClose = true;
var popBoxMouseMoveRevert = true;
var popBoxWaitImage = new Image();
popBoxWaitImage.src = "/images/spinner40.gif";

var popBoxShowRevertBar = true;
var popBoxShowRevertText = true;
var popBoxShowRevertImage = true;
var popBoxRevertText = "Click the image to shrink it.";
var popBoxRevertImage = "/images/magminus.gif";
var popBoxRevertBarAbove = false;

// there is no popBoxShowPopBar global, but instead the pbShowPopBar attribute must be
// set on the img for the PopBar funtionality to work (can be true or false)
var popBoxShowPopText = true;
var popBoxShowPopImage = true;
var popBoxPopText = "Click to expand.";
var popBoxPopImage = "/images/magplus.gif";
var popBoxPopBarAbove = false;

var popBoxShowCaption = true;
var popBoxCaptionBelow = false;
var popBoxCaptionMoreText = "more";
var popBoxCaptionLessText = "less";
var popBoxExpandCaptions = false;
var popBoxExpandCaptionsBelow = false;

// these custom attributes on the <img> element will override the globals above
// pbShowRevertBar, pbShowRevertText, pbShowRevertImage, pbRevertText, pbRevertImage
// pbShowPopBar, pbShowPopText, pbShowPopImage, pbPopText, pbPopImage, pbShowCaption

// Advanced method to begin moves and resizes. (Use Pop/PopEx and Revert where possible instead.)
// X and Y postfixes refer to the top left pixel. W and H postfixes refer to the width and height
// speedM and speedS are the speeds of the move and size respectively
// className denotes the CSS class to apply to the object that is being moved and/or sized
// fnDone denotes the script method to run when the move/resize is complete. It must have a single
// parameter that holds the object itself.
function PopBox(obj, startX, startY, endX, endY, startW, startH, endW, endH, speedM, speedS, className, fnDone)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	if (obj == null || typeof obj != "object" || isNaN(startX) || isNaN(startY) || isNaN(endX) || isNaN(endY) || isNaN(startW) || isNaN(startH) || isNaN(endW) || isNaN(endH) || isNaN(speedM) || isNaN(speedS))
		return;
	var elem = InitPopBox(obj);

	if (popBox[elem.id].isAnimating == true)
	{
		var str = "PopBox('" + elem.id + "'," + startX + "," + startY + "," + endX + "," + endY + "," + startW + "," + startH + "," + endW + "," + endH + "," + speedM + "," + speedS + ",'" + className + "');";
		setTimeout(str, 10);
	}
	else
	{
		popBox[elem.id].isAnimating = true;
		popBox[elem.id].xCurr = parseFloat(startX);
		popBox[elem.id].yCurr = parseFloat(startY);
		popBox[elem.id].wCurr = parseFloat(startW);
		popBox[elem.id].hCurr = parseFloat(startH);
		popBox[elem.id].xTarg = parseFloat(endX);
		popBox[elem.id].yTarg = parseFloat(endY);
		popBox[elem.id].wTarg = parseFloat(endW);
		popBox[elem.id].hTarg = parseFloat(endH);
		popBox[elem.id].xDelta = Math.abs(parseFloat(endX) - parseFloat(startX));
		popBox[elem.id].yDelta = Math.abs(parseFloat(endY) - parseFloat(startY));
		popBox[elem.id].wDelta = Math.abs(parseFloat(endW) - parseFloat(startW));
		popBox[elem.id].hDelta = Math.abs(parseFloat(endH) - parseFloat(startH));
		popBox[elem.id].velM = (speedM) ? Math.abs(parseFloat(speedM)) : 1.0;
		popBox[elem.id].velS = (speedS) ? Math.abs(parseFloat(speedS)) : 1.0;
		popBox[elem.id].xTravel = 0.0;
		popBox[elem.id].yTravel = 0.0;
		popBox[elem.id].wTravel = 0.0;
		popBox[elem.id].hTravel = 0.0;
		// set element's start position
		elem.style.position = "absolute";
		elem.style.left = startX + "px";
		elem.style.top = startY + "px";
		// set element's start size
		elem.style.width = startW + "px";
		elem.style.height = startH + "px";
		elem.style.display = "inline";

		// the length of the line between start and end points
		var lenMove = Math.sqrt((Math.pow((startX - endX), 2)) + (Math.pow((startY - endY), 2)));
		var lenSize = Math.sqrt((Math.pow((startW - endW), 2)) + (Math.pow((startH - endH), 2)));
		// if the speeds are the same then they should be in sync
		if (popBox[elem.id].velM == popBox[elem.id].velS)
			lenMove = lenSize = Math.sqrt(Math.pow(lenMove, 2) + Math.pow(lenSize, 2));

		// how big the pixel steps are along each axis
		popBox[elem.id].xStep = ((popBox[elem.id].xTarg - popBox[elem.id].xCurr) / lenMove) * popBox[elem.id].velM;
		popBox[elem.id].yStep = ((popBox[elem.id].yTarg - popBox[elem.id].yCurr) / lenMove) * popBox[elem.id].velM;

		// how big the pixel steps are for each resize
		popBox[elem.id].wStep = ((popBox[elem.id].wTarg - popBox[elem.id].wCurr) / lenSize) * popBox[elem.id].velS;
		popBox[elem.id].hStep = ((popBox[elem.id].hTarg - popBox[elem.id].hCurr) / lenSize) * popBox[elem.id].velS;
		
		popBox[elem.id].fnDone = fnDone;
		if (className != null)
			elem.className = className;

		popBox[elem.id].cursor = elem.style.cursor;
		elem.style.cursor = "default";

		if (popBox[elem.id].isPopped == false)
			elem.style.zIndex = ++popBoxZ;

		var id = elem.id;
		if (popBox[elem.id].originalId != null) id = popBox[elem.id].originalId;
		if (pbPopBarFunc[id] != null)
		{
			pbPopBarFunc[id]();
			pbPopBarFunc[id] = null;
		}
			
		if (popBox[elem.id].fnPre != null && typeof popBox[elem.id].fnPre == 'function')
			popBox[elem.id].fnPre();

		// start the repeated invocation of the animation
		popBox[elem.id].interval = setInterval("DoPopBox('" + elem.id + "')", 10);
	}
}

/***************************************************************************************************
* Helper functions. Use these! They are much easier. Call Pop/PopEx and then Revert, or set the
* popBoxAutoClose global to true and Revert will be called for you.
***************************************************************************************************/

// this basic method centers the image in the browser and displays it at its full resolution, subject to window size.
function Pop(obj, speed, className)
{
	PopEx(obj, null, null, 0, 0, speed, className);
}

// If newLeft is null then the image is centered horizontally in the browser. Ditto for newTop (vertically).
// End newLeft and/or newTop with "A" for an absolute position, otherwise it is treated as a relative position.
// Ex: a newLeft of 20 would move right 20 pixels, "20A" would position 20 pixels from the left of it's containing element.
// If newWidth is 0 then the full image width is used, subject to scaling and window size. Ditto for newHeight.
// If newWidth is null the full width is used, regardless of window size, but still subject to scaling. Ditto for newHeight.
function PopEx(obj, newLeft, newTop, newWidth, newHeight, speed, className)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	var objToPop = GetObjectToPop(obj);
	var isReady = (typeof objToPop.readyState != 'undefined') ? (objToPop.readyState == "complete") : ((typeof objToPop.complete != 'undefined') ? (objToPop.complete == true) : true);
	if (isReady == false)
	{
		var imgWait = CreateWaitImage(obj);
		var str = "var imgWait = GetRawObject('" + imgWait.id + "'); if (imgWait != null) { imgWait.parentNode.removeChild(imgWait); } PopEx('" + obj.id + "',";
		if (newLeft == null)
			str += newLeft + ",";
		else
			str += "'" + newLeft + "',";
		if (newTop == null)
			str += newTop + ",";
		else
			str += "'" + newTop + "',";
		str += newWidth + "," + newHeight + "," + speed + ",'" + className + "');";
		objToPop.onload = new Function("", str);
		return;
	}

	var elem = InitPopBox(obj);

	if (popBox[elem.id].isPopped == true) return;

	if (typeof elem.ondblclick == "function")
		elem.onclick = elem.ondblclick;

	var startX = parseInt(elem.style.left);
	var startY = parseInt(elem.style.top);

	// figure out the max window size
	var windowSize = GetInsideWindowSize();
	var hasRevertBar = HasRevertBar(obj);
	var hasCaption = HasCaption(obj);
	if (hasRevertBar == true && popBoxRevertBarAbove == true) windowSize.y -= 20;
	if (hasCaption == true && popBoxCaptionBelow == true) windowSize.y -= 20;

	var fullSize = {x:newWidth, y:newHeight};
	if (newWidth == 0 || newHeight == 0 || newWidth == null || newHeight == null)
	{
		fullSize = GetPoppedImageSize(elem);
		
		// some browsers have a race condition where it still doesn't get set so just fill the window
		if (fullSize.x == 0 || fullSize.y == 0)
		{
			var scale = Math.min(parseFloat(windowSize.x) / parseFloat(elem.width), parseFloat(windowSize.y) / parseFloat(elem.height));
			fullSize.x = parseInt(elem.width * scale);
			fullSize.y = parseInt(elem.height * scale);
		}
	}

	// adjust window size variables for new image boundaries
	if (newLeft != null)
	{
		if (typeof newLeft == "string" && newLeft.indexOf("A") == (newLeft.length - 1))
			newLeft = parseInt(newLeft, 10);
		else
			newLeft = popBox[elem.id].xOriginal + parseInt(newLeft, 10);
			
		windowSize.x -= newLeft;
	}

	if (newTop != null)
	{
		if (typeof newTop == "string" && newTop.indexOf("A") == (newTop.length - 1))
			newTop = parseInt(newTop, 10);
		else
			newTop = popBox[elem.id].yOriginal + parseInt(newTop, 10);
			
		windowSize.y -= newTop;
	}

	// adjust for scrollbars that might appear (quick compromise for browser incompatibilities)
	if (newWidth == null && newHeight == 0 && fullSize.x > (windowSize.x - 20))
		windowSize.y -= 20;
	else if (newWidth == 0 && newHeight == null && fullSize.y > (windowSize.y - 4))
		windowSize.x -= 4;

	var newSize = CalculateImageDimensions(newWidth, newHeight, fullSize.x, fullSize.y, windowSize);

	// width and height are now set, so position it
	if (newLeft == null || newTop == null)
	{
		var scroll = GetScrollOffset();

		if (newLeft == null)
		{
			newLeft = ((windowSize.x / 2) + scroll.x) - (newSize.x / 2);
			if (newLeft < 0) newLeft = 0;
		}
		
		if (newTop == null)
		{
			newTop = ((windowSize.y / 2) + scroll.y) - (newSize.y / 2);
			if (hasRevertBar == true && popBoxRevertBarAbove == true) newTop += 10;
			if (hasCaption == true && popBoxCaptionBelow == true) newTop -= 10;
			if (newTop < 0) newTop = 0;
		}
	}

	var func = null;
	if (typeof PostPopProcessing == "function")
		func = PostPopProcessing;

	if (typeof PrePopProcessing == "function")
		PrePopProcessing(obj);

	PopBox(elem, startX, startY, newLeft, newTop, popBox[elem.id].wOriginal, popBox[elem.id].hOriginal, newSize.x, newSize.y, speed, speed, className, func);
}

function PopInPlace(obj, speed, className)
{
	if (typeof obj == "string") obj = GetRawObject(obj);
	var objToPop = GetObjectToPop(obj);
	var isReady = (typeof objToPop.readyState != 'undefined') ? (objToPop.readyState == "complete") : ((typeof objToPop.complete != 'undefined') ? (objToPop.complete == true) : true);
	if (isReady == false)
	{
		var imgWait = CreateWaitImage(obj);
		var str = "var imgWait = GetRawObject('" + imgWait.id + "'); if (imgWait != null) { imgWait.parentNode.removeChild(imgWait); } PopInPlace('" + obj.id + "'," + speed + ",'" + className + "');";
		objToPop.onload = new Function("", str);
		return;
	}

	var elem = InitPopBox(obj);

	if (popBox[elem.id].isPopped == true) return;

	if (typeof elem.ondblclick == "function")
		elem.onclick = elem.ondblclick;

	var startX = parseInt(elem.style.left);
	var startY = parseInt(elem.style.top);

	// figure out the max window size
	var windowSize = GetInsideWindowSize();
	var hasRevertBar = HasRevertBar(obj);
	var hasCaption = HasCaption(obj);
	if (hasRevertBar == true && popBoxRevertBarAbove == true) windowSize.y -= 20;
	if (hasCaption == true && popBoxCaptionBelow == true) windowSize.y -= 20;
	
	var fullSize = GetPoppedImageSize(elem);
	
	// some browsers have a race condition where it still doesn't get set so just fill the window
	if (fullSize.x == 0 || fullSize.y == 0)
	{
		var scale = Math.min(parseFloat(windowSize.x) / parseFloat(elem.width), parseFloat(windowSize.y) / parseFloat(elem.height));
		fullSize.x = parseInt(elem.width * scale);
		fullSize.y = parseInt(elem.height * scale);
	}

	var newSize = CalculateImageDimensions(0, 0, fullSize.x, fullSize.y, windowSize);
	var newLeft = startX - parseInt(((newSize.x - popBox[elem.id].wOriginal) / 2), 10);
	var newTop = startY - parseInt(((newSize.y - popBox[elem.id].hOriginal) / 2), 10);

	// have the best case position, now adjust it if it would expand beyond the window
	var scroll = GetScrollOffset();
	if (scroll.x > newLeft)
	{
		newLeft = scroll.x;
	}
	else
	{
		var xOffset = ((newLeft + newSize.x) - (windowSize.x + scroll.x));
		if (xOffset > 0) newLeft -= xOffset;
	}

	if (scroll.y > newTop)
	{
		newTop = scroll.y;
	}
	else
	{
		var yOffset = ((newTop + newSize.y) - (windowSize.y + scroll.y));
		if (yOffset > 0) newTop -= yOffset;
	}

	if (hasRevertBar == true && popBoxRevertBarAbove == true) newTop += 10;
	if (hasCaption == true && popBoxCaptionBelow == true) newTop -= 10;
	if (newTop < 0) newTop = 0;
	
	var func = null;
	if (typeof PostPopProcessing == "function")
		func = PostPopProcessing;

	if (typeof PrePopProcessing == "function")
		PrePopProcessing(obj);

	PopBox(elem, startX, startY, newLeft, newTop, popBox[elem.id].wOriginal, popBox[elem.id].hOriginal, newSize.x, newSize.y, speed, speed, className, func);
}

// Helper function for PopBox to move/resize the image back to its original position/size. Use this! It's much easier.
function Revert(obj, speed, className)
{
	if (typeof obj == "string") obj = GetRawObject(obj); 
	if (obj == null || typeof popBox[obj.id] == "undefined" || popBox[obj.id] == null) return;

	if (typeof speed == 'undefined' || speed == null || speed == 0)
		speed = Math.max(popBox[obj.id].velM, popBox[obj.id].velS);
		
	if (typeof className == 'undefined')
		className = popBox[obj.id].originalClassName;
	
	var func = null;
	if (typeof PostRevertProcessing == "function")
		func = PostRevertProcessing;

	if (typeof PreRevertProcessing == "function")
		PreRevertProcessing(obj);

	PopBox(obj, popBox[obj.id].xTarg, popBox[obj.id].yTarg, popBox[obj.id].xOriginal, popBox[obj.id].yOriginal, popBox[obj.id].wTarg, popBox[obj.id].hTarg, popBox[obj.id].wOriginal, popBox[obj.id].hOriginal, speed, speed, className, func);
}

// Helper function to revert all images.
function RevertAll(speed, className)
{
	for (var i = 0; i < popBoxIds.length; i++)
		Revert(popBoxIds[i], speed, className);
}

/***************************************************************************************************
* These methods are the pre and post processing events for Pop/PopEx and Revert.
* Feel free to copy them to your own page script and add your own code to the method bodies.
***************************************************************************************************/

// called before the Pop begins
// The parameter is the original object
//function PrePopProcessing(obj)
//{
//}

// called after the pop is complete
// The parameter is the copy of the object that is resized
//function PostPopProcessing(obj)
//{
//}

// called before the Revert begins
// The parameter is the copy of the object that is resized
//function PreRevertProcessing(obj)
//{
//}

// called after the Revert is complete
// The parameter is the original object
//function PostRevertProcessing(obj)
//{
//}
