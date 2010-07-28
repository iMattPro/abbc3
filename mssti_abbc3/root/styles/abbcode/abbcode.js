// <![CDATA[

/**
* Function Rainbow text - START
**/
function Rainbow( )
{
	var myRainbowSpan = new Array();
	elem = getElementsByClassName("Rainbow");
	for (var i=0; i < elem.length; i++)
	{
		// Bring the element an ID
		var rand_id = parseInt(Math.random()*10000);
		if ( !elem[i].id )
		{
			// Set the ID
			elem[i].setAttribute("id", rand_id );
			var r1 = document.getElementById( elem[i].id );

			// remove/strip HTML tags : Script by hscripts.com
			var re		 = /(<([^>]+)>)/gi;
			r1.innerHTML = r1.innerHTML.replace(re, "");
			// Run the function
			myRainbowSpan[rand_id] = new RainbowSpan( r1 );
			// Set the timer
			myRainbowSpan[rand_id].timer =  window.setInterval( function( )
			{
				myRainbowSpan[rand_id].moveRainbow( );
			}, myRainbowSpan[rand_id].speed )
		}
	}
}

function RainbowSpan(elem, hue, deg, brt, spd, hspd)
{
	this.span		= elem;

	this.hue		= ( hue == null ? 0   : Math.abs(hue) % 360	);
	this.hspd		= ( hspd== null ? 3   : Math.abs(hspd) % 360);
	this.speed		= ( spd == null ? 10  : Math.abs(spd)		);
	this.brt		= ( brt == null ? 255 : Math.abs(brt) % 256	);
	this.deg		= ( deg == null ? 360 : Math.abs(deg)		);
	this.length		= this.span.firstChild.data.length;
	this.hInc		= this.deg/this.length;

	var str			= this.span.firstChild.data;
	this.span.removeChild(this.span.firstChild);
	for( var i = 0, a = str.length; i < a; i++ )
	{
		var theSpan = document.createElement("SPAN");
		theSpan.appendChild(document.createTextNode(str.charAt(i)));
		this.span.appendChild(theSpan);
	}
	this.timer		= null;
	this.moveRainbow();
}

RainbowSpan.prototype.moveRainbow = function( )
{
	if ( this.hue > 359 )
	{
		this.hue-=360;
	}

	var color;
	var b = this.brt;
	var h = this.hue;

	/** Change the color direction, depending on the user's language direction **/
	var pagedir = ( document.documentElement.dir == null ? 'ltr' : document.documentElement.dir );
	for( var i = ( pagedir == 'ltr' ? -1 : 0 ), a = a = this.length; i < a; ( pagedir == 'ltr' ? a-- : i++) )
	{
		if(h>359) h-=360;

		if		( h < 60  ) { color = Math.floor( ( (h    ) / 60 ) * b ); red = b;		grn = color;	blu=0;		}
		else if	( h < 120 ) { color = Math.floor( ( (h-60 ) / 60 ) * b ); red = b-color;grn = b;		blu=0;		}
		else if	( h < 180 ) { color = Math.floor( ( (h-120) / 60 ) * b ); red = 0;		grn = b;		blu=color;	}
		else if	( h < 240 ) { color = Math.floor( ( (h-180) / 60 ) * b ); red = 0;		grn = b-color;	blu=b;		}
		else if	( h < 300 ) { color = Math.floor( ( (h-240) / 60 ) * b ); red = color;	grn = 0;		blu=b;		}
		else 				{ color = Math.floor( ( (h-300) / 60 ) * b ); red = b;		grn = 0;		blu=b-color;}

		h+=this.hInc;

		if ( this.span.childNodes[( pagedir == 'ltr' ? a : i)] )
		{
			this.span.childNodes[( pagedir == 'ltr' ? a : i)].style.color="rgb("+red+", "+grn+", "+blu+")";
		}
	}
	this.hue+=this.hspd;
}
/** Funtion Rainbow text - End **/

/**
* Function Fade-in fade-out text - START
**/
var FadeOut	 = true
var FadePas	 = 0;
var FadeMax	 = 100; // 255;
var FadeMin	 = 0;
var FadeStep = 10; // 20;
var FadeInt	 = 100;
var FadeInterval;

function fade_ontimer()
{
	var IE = ( window.navigator.userAgent.match(/(^|\W)(MSIE)\s+(\d+)(\.\d+)?/) ) ? true : false;
	if ( FadeOut )
	{
		FadePas += FadeStep;
		if (FadePas > FadeMax)
		{
			FadeOut = false;
		}
	}
	else
	{
		FadePas -= FadeStep;
		if (FadePas < FadeMin)
		{
			FadeOut = true;
			window.clearInterval( FadeInterval );
		}
	}

	if ((FadePas < FadeMax) && (FadePas > FadeMin) )
	{
		elem = getElementsByClassName("fade_link");
		for (var i=0; i < elem.length; i++)
		{
		/**	elem[i].style.color="rgb(" + FadePas + "," + FadePas + "," + FadePas + ")"; **/
			if (IE) { elem[i].style.filter = 'alpha(opacity=' + FadePas + ')'; } else { elem[i].style.opacity = elem[i].style.MozOpacity = elem[i].style.KHTMLOpacity = (FadePas/100); }
		}
	}
	FadeInterval = setTimeout( 'fade_ontimer()', FadeInt );
}
/** Funtion Fade-in fade-out text - END **/

/**
* Developed by Robert Nyman, http://www.robertnyman.com
* Code/licensing: http://code.google.com/p/getelementsbyclassname/
* http://www.anieto2k.com/2008/07/04/getelementsbyclassname-version-2008/
**/
var getElementsByClassName = function (className, tag, elm){
	if (document.getElementsByClassName) {
		getElementsByClassName = function (className, tag, elm) {
			elm = elm || document;
			var elements = elm.getElementsByClassName(className),
				nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
				returnElements = [],
				current;
			for(var i=0, il=elements.length; i<il; i+=1){
				current = elements[i];
				if(!nodeName || nodeName.test(current.nodeName)) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	else if (document.evaluate) {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = "",
				xhtmlNamespace = "http://www.w3.org/1999/xhtml",
				namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
				returnElements = [],
				elements,
				node;
			for(var j=0, jl=classes.length; j<jl; j+=1){
				classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
			}
			try	{
				elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
			}
			catch (e) {
				elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
			}
			while ((node = elements.iterateNext())) {
				returnElements.push(node);
			}
			return returnElements;
		};
	}
	else {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = [],
				elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
				current,
				returnElements = [],
				match;
			for(var k=0, kl=classes.length; k<kl; k+=1){
				classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
			}
			for(var l=0, ll=elements.length; l<ll; l+=1){
				current = elements[l];
				match = false;
				for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
					match = classesToCheck[m].test(current.className);
					if (!match) {
						break;
					}
				}
				if (match) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	return getElementsByClassName(className, tag, elm);
};

/**
* My Special function Get element by class - START
**/
function MyGetElementsByClassName(classname)
{
	if (document.getElementsByTagName)
	{
		var els = document.getElementsByTagName("*");
		var c = new RegExp('/b^|' + classname + '|$/b');
		varfinal = new Array();
		var n=0;
		for (var i=0; i < els.length; i++)
		{
			if (els[i].className)
			{
				if(c.test(els[i].className))
				{
					varfinal[n] = els[i];
					n++;
				}
			}
		}
		return varfinal;
	}
	else
	{
		return false;
	}
}
/** Funtion Get element by class - END **/

/**
* Funtion toggle spoiler - START
**/
function abbc3_spoiler( el, hide_text, show_text )
{
	if ( el.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display !='')
	{
		el.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; 
		el.getElementsByTagName('a')[0].innerHTML = '<strong>' + hide_text + '</strong>'; 
	}
	else
	{
		el.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none';
		el.getElementsByTagName('a')[0].innerHTML = '<strong>' + show_text + '</strong>';
	}
	el.blur();
}
/** Funtion toggle spoiler - END **/

/**
* Funtion toggle an element visibility - START
**/
function abbc3_toggle( id )
{
	if (document.getElementById(id))
	{
		if (document.getElementById(id).style.display == 'block')
		{
			document.getElementById(id).style.display = 'none';
		}
		else
		{
			document.getElementById(id).style.display = 'block';
		}
	}
}

/**
* Funtion download ed2k tag - START
**/
function checkAll( str )
{
	var a = document.getElementsByName( str );
	var n = a.length;

	for (var i = 0; i < n; i++)
	{
		if ( a[i].checked )
		{
			a[i].checked = false;
		}
		else
		{
			a[i].checked = true;
		}
	}
}

function download( str, i, first )
{
	var a = document.getElementsByName( str );
	var n = a.length;

	for (var i = i; i < n; i++)
	{
		if( a[i].checked )
		{
			window.location=a[i].value;
			if (first)
			{
				timeout = 6000;
			}
			else
			{
				timeout = 500;
			}
			i++;
			window.setTimeout( "download('"+str+"', "+i+", 0)", timeout );
			break;
		}
	}
}
/** Funtion download ed2k tag - END **/

/**
* Funtion copy to clipboard - START
*
* specify whether contents should be auto copied to clipboard (memory)
* Applies only to IE 4+
**/
var copytoclip=1 /** 0=no, 1=yes **/

function HighlightAll( theField )
{
	var tempval = eval("document."+theField);
	tempval.focus();
	tempval.select();
	
	if (document.all && copytoclip == 1)
	{
		therange=tempval.createTextRange();
		therange.execCommand("Copy");
	}
}
/** Funtion copy to clipboard - END **/

/**
* target compatibility for XHTML 1.0 Strict! - START
**/
function externalLinks( anchor )
{
	if ( anchor.getAttribute("href") && ( anchor.getAttribute("rel") == "external" || anchor.getAttribute("rel") == "gb_imageset[]" ) )
	{
		anchor.target = "_blank";
	}
}
/** target compatibility for XHTML 1.0 Strict! - END **/

/** simpleTabs v1.2
* Author: Fotis Evangelou (Komrade Ltd.)
* License: GNU/GPL v2.0
* Credits:
* - Peter-Paul Koch for the "Cookies" functions. More on: http://www.quirksmode.org/js/cookies.html
* - Simon Willison for the "addLoadEvent" function. More on: http://simonwillison.net/2004/May/26/addLoadEvent/
* Last updated: March 13th, 2009
* Updated for phpbb3x and fixed by MSSTI
* CHANGELOG:
* - v1.2: Fixed IE syntax error
* - v1.1: Namespaced the entire script
*
* FEATURES TO COME:
* - Enable cookie per tab set
* - Enable tab selection via URL anchor
**/

/** Main SimpleTabs function **/
var kmrSimpleTabs = {

	init: function()
	{
		if(!document.getElementsByTagName) return false;
		if(!document.getElementById) return false;
		var containerDiv = document.getElementsByTagName("div");

		var Tabber_id = 1;
		for(var i=0; i<containerDiv.length; i++)
		{
			if (containerDiv[i].className == "simpleTabs")
			{
				Tabber_id++;
				// assign a unique ID for this tab block and then grab it
				containerDiv[i].setAttribute("id","tabber"+Tabber_id);		
				var containerDivId = containerDiv[i].getAttribute("id");

				// Navigation
				var ul = containerDiv[i].getElementsByTagName("ul");
				
				for(var j=0; j<ul.length; j++)
				{
					if (ul[j].className == "simpleTabsNavigation")
					{
						var a = ul[j].getElementsByTagName("a");
						for(var k=0; k<a.length; k++)
						{
							a[k].setAttribute("id",containerDivId+"_a_"+k);
							// get current
							if(kmrSimpleTabs.readCookie('simpleTabsCookie'))
							{
								var cookieElements = kmrSimpleTabs.readCookie('simpleTabsCookie').split("_");
								var curTabCont = cookieElements[1];
								var curAnchor = cookieElements[2];
								if(a[k].parentNode.parentNode.parentNode.getAttribute("id")=="tabber"+curTabCont)
								{
									if(a[k].getAttribute("id")=="tabber"+curTabCont+"_a_"+curAnchor)
									{
										a[k].className = "current";
									} else {
										a[k].className = "";
									}
								} else {
									a[0].className = "current";
								}
							} else {
								a[0].className = "current";
							}

							a[k].onclick = function()
							{
								kmrSimpleTabs.setCurrent(this,'simpleTabsCookie');
								return false;
							}
						}
					}
				}

				var TabContent_id = -1;
				// Tab Content
				var div = containerDiv[i].getElementsByTagName("div");
				for(var l=0; l<div.length; l++)
				{
					if (div[l].className == "simpleTabsContent")
					{
						TabContent_id++;
						div[l].setAttribute("id",containerDivId+"_div_"+TabContent_id);	
						if(kmrSimpleTabs.readCookie('simpleTabsCookie'))
						{
							var cookieElements = kmrSimpleTabs.readCookie('simpleTabsCookie').split("_");
							var curTabCont = cookieElements[1];
							var curAnchor = cookieElements[2];		
							if(div[l].parentNode.getAttribute("id")=="tabber"+curTabCont)
							{
								if(div[l].getAttribute("id")=="tabber"+curTabCont+"_div_"+curAnchor)
								{
									div[l].className = "simpleTabsContent currentTab";
								} else {
									div[l].className = "simpleTabsContent";
								}
							} else {
								div[0].className = "simpleTabsContent currentTab";
							}
						} else {
							div[0].className = "simpleTabsContent currentTab";
						}
					}
				}	
				// End navigation and content block handling	
			}
		}
	},
	
	// Function to set the current tab
	setCurrent: function(elm,cookie)
	{
		this.eraseCookie(cookie);

		//get container ID
		var thisContainerID = elm.parentNode.parentNode.parentNode.getAttribute("id");

		// get current anchor position
		var regExpAnchor = thisContainerID+"_a_";

		//var regExpAnchor=new RegExp(this.parentNode.parentNode.parentNode.getAttribute("id")+"_a_");
		var thisLinkPosition = elm.getAttribute("id").replace(regExpAnchor,"");

		// change to clicked anchor
		var otherLinks = elm.parentNode.parentNode.getElementsByTagName("a");
		for(var n=0; n<otherLinks.length; n++){
			otherLinks[n].className = "";
		}

		elm.className = "current";

		// change to associated div
		var otherDivs = document.getElementById(thisContainerID).getElementsByTagName("div");
		for(var i=0; i<otherDivs.length; i++)
		{
			if ( /simpleTabsContent/.test(otherDivs[i].className) )
			{
				otherDivs[i].className = "simpleTabsContent";
			}
		}
		document.getElementById(thisContainerID+"_div_"+thisLinkPosition).className = "simpleTabsContent currentTab";
	
		// get Tabs container ID
		var thisContainerPosition = thisContainerID.replace(/tabber/,"");
		
		// set cookie
		this.createCookie(cookie,'simpleTabsCookie_'+thisContainerPosition+'_'+thisLinkPosition,1);
	},
	
	// Cookies
	createCookie: function(name,value,days)
	{
		if (days)
		{
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	},
	
	readCookie: function(name)
	{
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++)
		{
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	},
	
	eraseCookie: function(name)
	{
		this.createCookie(name,"",-1);
	},

	// Loader
	addLoadEvent: function( )
	{
		/** Install the safety net to run once the main function - START **/
		if (window.onload_functions) // prosilver
		{
			onload_functions[onload_functions.length] = "kmrSimpleTabs.init();";
		}
		else if (typeof(window.addEventListener) != "undefined") // DOM
		{
			window.addEventListener( "load", kmrSimpleTabs.init, false);
		}
		else if (typeof(window.attachEvent) != "undefined") // MSIE
		{
			window.attachEvent( "onload", kmrSimpleTabs.init);
		}
		/** Install the safety net to run once the main function - END **/
	}
	// END
};

// ]]>