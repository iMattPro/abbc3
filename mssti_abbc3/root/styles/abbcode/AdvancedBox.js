/**
* AdvancedBox JS - Start
* This work is open source
* AdvancedBox for resized images 
**/
if (ImageResizerMode === 'AdvancedBox')
{
	var AdvancedBox = (function()
	{
		/** Global Variables **/
	
		/** The browser **/
		var IE = (window.navigator.userAgent.match(/(^|\W)(MSIE)\s+(\d+)(\.\d+)?/)) ? true : false;
		/** Use sexy looks ? **/
		var animate = true; // Options : true | false
		var elemfade;
		/** For display the image (opacity effect) (Integer value from 1 to 100) **/
		var animateInDuration = 6;
		var animateOutDuration = 6;
		/** For enlarge or shrink the lightbox delay (Integer value from 1 to 100) **/
		var BoxScaleSteps = 10;
		/** Set opacity on background element (Integer value from 1 to 100) **/
		var ojbOpacity = 60;
		/** The size of "air" up to page **/
		var borderSize = 20;
		/** If you adjust the padding in the CSS, you will need to update this variable **/
		var padding = 4;
		/** Save the "image object" for global access **/
		var newObjImage = null;
		/** Dimensions of the box **/
		var MaxWidth, MaxHeight = 0;
		/** Zoom level (true | false) **/
		var ZoomLevel = false ;
		/** Loading **/
		var Wait_pass = 0;
		/** Slide Show **/
		var SlideWait = 0;
		/** The number of seconds to wait (if animation is enabled, the animateXXDuration value will be added **/
		var SlideShowDuration = 5;
		var SlideShows = []; //new Array();
	
		/** Initialize all **/
		Start = function(url)
		{
			/** At first run, creates the element container **/
			if (!$ID('AB-BackGround')) { Create(); }
			/** Show the loading image **/
			ElementShow('AB-BackGround');
			ElementShow('AB-LoadingLink');
			/** Create a new image with a Clear the image url **/
			ZoomLevel = false;
			newObjImage = new Image();
			newObjImage.src = url_clean(url);
			/** Let's do some extra checks **/
			Wait_pass = 0;
			var timer = window.setInterval(function()
			{
				/** Safety end the process if can't load the image afer 120 intents (1 Minutes) **/
				Wait_pass++; if (Wait_pass === 120) { window.clearInterval(timer); Close(); }
				/** Seems that IE when create an image gives a default width to 28 **/
				if (newObjImage.readyState !== 'complete' || !newObjImage.complete) { if (newObjImage.width > 100) { window.clearInterval(timer); Prepare(newObjImage, ZoomLevel); } } else { window.clearInterval(timer); Prepare(newObjImage, ZoomLevel); }
			},10);
			return false;
		};
	
		/** Creates the elements container and appends it to the main document (The background, image and close button). **/
		Create = function()
		{
			/** Preload the navbar buttons **/
			var preload_image_array = new Array("advancedbox_blank.gif", "advancedbox_icon_close.gif", "advancedbox_icon_zoom.gif", "advancedbox_icon_next.gif", "advancedbox_icon_prev.gif", "advancedbox_icon_play.gif", "advancedbox_icon_pause.gif", "advancedbox_icon_loading.gif");
			var preload_image_object = new Image(); for(var i = 0, pi = preload_image_array.length; i < pi; i++) { preload_image_object.src = "./styles/abbcode/" + preload_image_array[i]; }
	
			var objBody = document.getElementsByTagName('body').item(0);
			/** Create the background element (div) **/
			var objOverlay = document.createElement('div');
				objOverlay.setAttribute('id', 'AB-BackGround');
				if (IE) { objOverlay.style.filter = 'alpha(opacity:'+ojbOpacity+')'; } else { objOverlay.style.KHTMLOpacity = objOverlay.style.MozOpacity = objOverlay.style.opacity = (ojbOpacity/100); }
				objBody.appendChild(objOverlay);
			/** Create a big container **/
			var objLightbox = document.createElement('div');
				objLightbox.setAttribute('id', 'AB-Overlay');
				objLightbox.style.display = 'none';
				objBody.appendChild(objLightbox);
			/** Create a big image container **/
			var objOuterImageContainer = document.createElement('div');
				objOuterImageContainer.setAttribute('id', 'AB-OuterContainer');
				objLightbox.appendChild(objOuterImageContainer);
			/** Create the image container **/
			var objImageContainer = document.createElement('div');
				objImageContainer.setAttribute('id', 'AB-ImageContainer');
				objOuterImageContainer.appendChild(objImageContainer);
			/** Create the image name container for images less than 300px **/
			var objResizerSpan = document.createElement('span');
				objResizerSpan.setAttribute('id', 'AB-ImageName2');
				objResizerSpan.className = 'resized-txt';
			/** Create the main text **/
			var	objResizerText = document.createTextNode('');
				objResizerSpan.appendChild(objResizerText);
				objOuterImageContainer.appendChild(objResizerSpan);		
			/** Create the image here **/
			var objLightboxImage = document.createElement('img');
				objLightboxImage.setAttribute('id', 'AB-Image');
				objLightboxImage.setAttribute('src', ImageResizerBlankImage);
				objLightboxImage.onclick = function() { Close(); return false; };
				objImageContainer.appendChild(objLightboxImage);
			/** Create the toolbar **/
			var objHoverNav = document.createElement('div');
				objHoverNav.setAttribute('id', 'AB-ToolBar');
				objOuterImageContainer.appendChild(objHoverNav);
			/** Create the image name container for images bigger than 300px **/
				objResizerSpan = document.createElement('span');
				objResizerSpan.setAttribute('id', 'AB-ImageName1');
				objResizerSpan.className = 'resized-txt';
			/** Create the main text **/
				objResizerText = document.createTextNode('');
				objResizerSpan.appendChild(objResizerText);
				objHoverNav.appendChild(objResizerSpan);		
			/** Create the Close button **/
			var objBottomNavCloseLink = document.createElement('a');
				objBottomNavCloseLink.setAttribute('id', 'AB-CloserLink');
				objBottomNavCloseLink.alt = objBottomNavCloseLink.title = ImageResizerCloseAlt;
				objBottomNavCloseLink.onclick = function() { Close(); return false; };
				objHoverNav.appendChild(objBottomNavCloseLink);
			/** Create the Zoom button **/
			var objBottomNavZoomLink = document.createElement('a');
				objBottomNavZoomLink.setAttribute('id', 'AB-ZoomLink');
				objBottomNavZoomLink.onclick = function() { Prepare(newObjImage, true); return false; };
				objHoverNav.appendChild(objBottomNavZoomLink);
			/** Create the Prev button **/
			var objBottomNavPrevLink = document.createElement('a');
				objBottomNavPrevLink.setAttribute('id', 'AB-PrevLink');
				objBottomNavPrevLink.alt = objBottomNavPrevLink.title = ImageResizerPrevtAlt;
				objHoverNav.appendChild(objBottomNavPrevLink);
			/** Create the Next button **/
			var objBottomNavNextLink = document.createElement('a');
				objBottomNavNextLink.setAttribute('id', 'AB-NextLink');
				objBottomNavNextLink.alt = objBottomNavNextLink.title = ImageResizerNextAlt;
				objHoverNav.appendChild(objBottomNavNextLink);
			/** Create the text n of n picture **/
			var objNumberDisplay = document.createElement('span');
				objNumberDisplay.setAttribute('id', 'AB-nOnText');
				objHoverNav.appendChild(objNumberDisplay);
			/** Create the Play button **/
			var objBottomNavPlayLink = document.createElement('a');
				objBottomNavPlayLink = document.createElement('a');
				objBottomNavPlayLink.setAttribute('id', 'AB-PlayLink');
				objBottomNavPlayLink.alt = objBottomNavPlayLink.title = ImageResizerPlayAlt;
				objBottomNavPlayLink.onclick = function() { Slide_Show('play'); return false; };
				objHoverNav.appendChild(objBottomNavPlayLink);
			/** Create the Loading button **/
			var objloadingLink = document.createElement('a');
				objloadingLink.setAttribute('id', 'AB-LoadingLink');
				objloadingLink.alt = objloadingLink.title = ImageResizerCloseAlt;
				objloadingLink.onclick = function() { Close(); return false; };
				objLightbox.appendChild(objloadingLink);
	
			/** Set a default size for the big image container, for the first run **/
			ElementSetWidth('AB-OuterContainer', 250);
			ElementSetHeight('AB-OuterContainer', 250);
		};
	
		/** Adjust sizes **/
		Prepare = function(newObjImage, CurrentZoomLevel)
		{
			/** Hide all images **/
			ImagesHidden();
			ElementSetSrc('AB-Image', ImageResizerBlankImage);
			/** Show the loading image **/
			ElementShow('AB-LoadingLink');
			/** Hide the toolbar **/
			ElementInVisible('AB-ToolBar');
			/** Resize event handlers **/
			window.onresize = Resize;
			/** Stop the body scroll function **/
			ScrollFreeze.on();
			/** Hide some tags **/
			ElementBoxes('hidden');
			/** Show the background overlay **/
			ElementShow('AB-BackGround');
			/** Show the big container, whitout this here, all will be a mess ;) **/
			ElementShow('AB-Overlay');
			/** Determine the dimensions of the entire document & current scroll position within the document **/
			var PageSize   = GetPageSizes();
			var PageScroll = GetPageScroll();
			/** Determine the visible dimensions of the browser window "the viewport" **/
			MaxWidth = Math.floor(PageSize.WWidth - (borderSize*2));
			MaxHeight = Math.floor(PageSize.WHeight - ((borderSize*2) + ElementGetHeight('AB-ToolBar')));
			/** Place the button bar **/
			ElementSetTop('AB-ToolBar', ((ElementGetHeight('AB-ToolBar') + padding) *-1));
			ElementSetLeft('AB-ToolBar', (padding*-1));
			/** The background gets the document's dimensions, so a shadow can be cast over the entire document **/
			ElementSetHeight('AB-BackGround' , PageSize.PHeight);
			/** Place the big container **/
			ElementSetTop('AB-Overlay', (PageScroll.YScroll + (borderSize/2)));
			ElementSetHeight('AB-Overlay', (PageSize.WHeight - (borderSize*2)));
			/** Display the image very sexy like? **/
			FxFade('AB-Image', 100, 0, animateInDuration);
			/** Zoom in to real dimensions? **/
			ZoomLevel = CurrentZoomLevel;
			var objOuterImageContainerdims;
			if (!ZoomLevel) { objOuterImageContainerdims = scale_dims(newObjImage.width, newObjImage.height, MaxWidth, MaxHeight); } else { objOuterImageContainerdims = { W: ((newObjImage.width  > MaxWidth) ? (ElementGetWidth('AB-Overlay') - borderSize): newObjImage.width), H: ((newObjImage.height > MaxHeight) ? (ElementGetHeight('AB-Overlay') - padding): newObjImage.height)}; }
			/** Update the big container **/
			ElementSetHeight('AB-ImageContainer', objOuterImageContainerdims.H);
			/** Place the big image container in the middle of the page **/
			ElementSetTop('AB-OuterContainer', (((ElementGetHeight('AB-Overlay') - ElementGetHeight('AB-OuterContainer')) / 2) + ElementGetHeight('AB-ToolBar')));
			/** Resize the outerImageContainer **/
			BoxScale('AB-OuterContainer', objOuterImageContainerdims.W, objOuterImageContainerdims.H, UpdateImage);
		};
	
		UpdateImage = function()
		{
			var objImagedims;
			/** Resize the image? **/
			if (ZoomLevel)
			{
				/** Maximize the image container, adding scroll bars if necessary **/
				$ID('AB-ImageContainer').style.overflow = 'auto';
				/** Reset the scroll position **/
				$ID('AB-ImageContainer').scrollLeft = 0;
				$ID('AB-ImageContainer').scrollTop = 0;
				/** Swap Zoom In for Zoom Out **/
				$ID('AB-ZoomLink').alt = $ID('AB-ZoomLink').title = ImageResizerZoomOutAlt;
				$ID('AB-ZoomLink').onclick = function() { Prepare(newObjImage, false); return false; };
				/** Image size, zoom in 1:1 **/
				objImagedims = { W: newObjImage.width, H: newObjImage.height };
			}
			else
			{
				/** The image can be zoom ? **/
				if (newObjImage.width < MaxWidth && newObjImage.height < MaxHeight) { ElementDisabled('AB-ZoomLink'); } else { ElementEnabled('AB-ZoomLink'); }
				/** Restore image container **/
				$ID('AB-ImageContainer').style.overflow = '';
				/** Swap Zoom In for Zoom Out **/
				$ID('AB-ZoomLink').alt = $ID('AB-ZoomLink').title = ImageResizerZoomInAlt.replace(/%1\$s/, newObjImage.width).replace(/%2\$s/, newObjImage.height);
				$ID('AB-ZoomLink').onclick = function() { Prepare(newObjImage, true); return false; };
				/** Image size **/
				objImagedims = scale_dims(newObjImage.width, newObjImage.height, MaxWidth, MaxHeight);
			}
			/** Makes visible this image **/
			ElementVisible('AB-Image');
			/** Update the image screen **/
			ElementSetSrc('AB-Image', newObjImage.src);
			/** Resize the image **/
			ElementSetWidth('AB-Image',  objImagedims.W);
			ElementSetHeight('AB-Image', objImagedims.H);
			/** Display the image very sexy like? **/
			FxFade('AB-Image', 0, 100, animateOutDuration);
			/** Update SlideShow **/
			Slide_Show();
			/** Update the image name **/
			var ThePictName = newObjImage.src.substring(newObjImage.src.lastIndexOf("\/") + 1);
			if (objImagedims.W > 300)
			{
				$ID('AB-ImageName1').firstChild.nodeValue = (newObjImage.src.toLowerCase().match(/(^|\s)jpeg|jpg|gif|bmp|png|psd(\s|$ID)/) ? encodeURI(newObjImage.src.substring(newObjImage.src.lastIndexOf("\/") + 1)) : '');
			}
			else
			{
				$ID('AB-ImageName2').firstChild.nodeValue = (newObjImage.src.toLowerCase().match(/(^|\s)jpeg|jpg|gif|bmp|png|psd(\s|$ID)/) ? encodeURI(newObjImage.src.substring(newObjImage.src.lastIndexOf("\/") + 1)) : '');
			}
			/** Update the image container width **/
			ElementSetWidth('AB-ToolBar', ElementGetWidth('AB-OuterContainer'));
			/** Show the toolbar **/
			ElementVisible('AB-ToolBar');
			/** Hide the loading image **/
			ElementHide('AB-LoadingLink');
		};
	
		Slide_Show = function(PlayOnOff, PlayNumber)
		{
			/** Reset to default values **/
			$ID('AB-ImageName1').firstChild.nodeValue = '';
			$ID('AB-ImageName2').firstChild.nodeValue = '';
			ElementDisabled('AB-PrevLink');
			ElementDisabled('AB-NextLink');
			/** Get the proper play/pause button **/
			var BottomNavPlayLink = ($ID('AB-PlayLink') ? 'AB-PlayLink' :  'AB-PauseLink');
			/** Get some values from the the array **/
			var search = contains(url_clean(newObjImage.src), SlideShows);
			/** Do the job **/
			if (search[0])
			{
				/** Get current position of the actual picture, in the array **/
				var pos  = search[1];
				var last = SlideShows.length;
				var prev = SlideShows[pos-1];
				var next = SlideShows[pos+1];
				/** IF this isn't the first picture, enable the "Previous button" **/
				if (pos-1 >= 0) { ElementEnabled('AB-PrevLink'); $ID('AB-PrevLink').onclick = function() { Start(prev); return false; }; }
				/** IF this isn't the last picture, enable the "Next button" **/
				if (pos+1 < last) { ElementEnabled('AB-NextLink'); $ID('AB-NextLink').onclick = function() { Start(next); return false; }; }
				/** If there are only 1 picture, disable the play button **/
				if (last <= 1) { ElementDisabled(BottomNavPlayLink); }
				/** Update the text **/
				ElementSetInnerHTML('AB-nOnText', ImageResizerNumberOf.replace(/%1\$s/, pos+1).replace(/%2\$s/, last));
				/** Run the SlideShow? **/
				if (PlayOnOff && typeof(PlayOnOff) !== 'undefined')
				{
					var PlayNext;
					/** Calling from last pict, so start from first : else : start from next pict :) **/
					if (!PlayNumber && pos+1 === last) { PlayNumber = 1; PlayNext = SlideShows[0]; } else { PlayNumber = pos+1; PlayNext = next; }
					/** Update the play/pause buton **/
					if (PlayOnOff === 'play' && PlayNumber < last)
					{
						$ID(BottomNavPlayLink).setAttribute('id', 'AB-PauseLink');
						$ID('AB-PauseLink').onclick = function() { Slide_Show('pause'); return false; };				
						$ID('AB-PauseLink').alt = $ID('AB-PauseLink').title = ImageResizerPauseAlt;
						/** Run the SlideShow **/
						Start(PlayNext);
						var SlideDuration = (SlideShowDuration + (animate ? animateInDuration : 0)) * 1000;
						SlideWait = window.setTimeout(function() { Slide_Show('play', PlayNumber); }, SlideDuration);
					}
					else
					{
						$ID(BottomNavPlayLink).setAttribute('id', 'AB-PlayLink');
						$ID('AB-PlayLink').onclick = function() { Slide_Show('play'); return false; };
						$ID('AB-PlayLink').alt = $ID('AB-PlayLink').title = ImageResizerPlayAlt;		
						/** Cancel Slideshow timer **/
						window.clearTimeout(SlideWait);
					}
				}
			}
		};
	
		/** If the browser window is resized, recalculate dimensions and positions **/
		Resize = function(e)
		{
			Close();
			ElementShow('AB-Overlay');
			ElementShow('AB-BackGround');
			Prepare(newObjImage, ZoomLevel);
		};
	
		/** Reset to default values **/
		Close = function(e)
		{
			/** Restore images visibility **/
			ImagesVisible();
			/** Return the body scroll function **/
			ScrollFreeze.off();
			/** Canel Resize event handlers **/
			window.onresize = null;
			/** Cancel Slideshow timer **/
			window.clearTimeout(SlideWait);
			/** Reset the play/pause button **/
			var BottomNavPlayLink = ($ID('AB-PlayLink') ? 'AB-PlayLink' : 'AB-PauseLink'); $ID(BottomNavPlayLink).setAttribute('id', 'AB-PlayLink');
			/** Show some tags **/
			ElementBoxes('visible');
			/** Hide the image, background and buttons **/
			ElementSetSrc('AB-ImageContainer', ImageResizerBlankImage);
			ElementHide('AB-LoadingLink');
			ElementHide('AB-Overlay');
			ElementHide('AB-BackGround');
		};
	
	/** Common functions - Start **/
		$ID					= function(elementid)	{ return document.getElementById(elementid); };
		ElementHide			= function(element)		{ $ID(element).style.display = 'none'; };
		ElementShow			= function(element)		{ $ID(element).style.display = ''; };
		ElementVisible		= function(element)		{ $ID(element).style.visibility = 'visible'; };
		ElementInVisible	= function(element)		{ $ID(element).style.visibility = 'hidden'; };
		ElementGetWidth		= function(element)		{ return $ID(element).offsetWidth; };
		ElementSetWidth		= function(element,w)	{ $ID(element).style.width = w + 'px'; };
		ElementGetHeight	= function(element)		{ return $ID(element).offsetHeight; };
		ElementSetHeight	= function(element,h)	{ $ID(element).style.height = h + 'px'; };
		ElementSetTop		= function(element,t)	{ $ID(element).style.top = t + 'px'; };
		ElementSetLeft		= function(element,l)	{ $ID(element).style.left = l + 'px'; };
		ElementSetSrc		= function(element,src) { $ID(element).src = src; };
		ElementOpacity		= function(element, o)	{ if (window.ActiveXObject) { $ID(element).style.filter = 'alpha(opacity=' + o + ')'; } else { $ID(element).style.opacity = $ID(element).style.MozOpacity = $ID(element).style.KhtmlOpacity = o/100; } };
		ElementSetInnerHTML = function(element, c)	{ $ID(element).innerHTML = c; };
		ElementBoxes		= function(action)		{ if (action !== 'visible') { action = 'hidden'; } if (IE) { for (var S = 0; S < document.forms.length; S++) { for (var R = 0; R < document.forms[S].length; R++) { if (document.forms[S].elements[R].options) { document.forms[S].elements[R].style.visibility = action; } } } } var theObjects = document.getElementsByTagName('object'); for (var i = 0; i < theObjects.length; i++) { theObjects[i].style.visibility = action; } };
		ElementDisabled		= function(element)     { $ID(element).className = ($ID(element).className ? $ID(element).className+' ' : '') + 'disabled'; ElementOpacity($ID(element).id, ojbOpacity); $ID(element).onclick = function() {};};
		ElementEnabled		= function(element)     { $ID(element).className = $ID(element).className.replace(/disabled/g, ''); ElementOpacity($ID(element).id, 100); };
	
		ImagesHidden		= function()			{ var ilist = document.images; for(var l = 0; l < ilist.length; l++) { for (var i = 0; i < SlideShows.length; i++) { /* found the image */ if (url_clean(ilist[l].src) === url_clean(SlideShows[i])) { document.images[l].style.visibility = 'hidden' ; } } } };
		ImagesVisible		= function()			{ var ilist = document.images; for(var l = 0; l < ilist.length; l++) { for (var i = 0; i < SlideShows.length; i++) { /* found the image */ if (url_clean(ilist[l].src) === url_clean(SlideShows[i])) { document.images[l].style.visibility = 'visible'; } } } };
	
		/**
		* Code From : http://www.huddletogether.com/forum/comments.php?DiscussionID=1798
		**/
		scale_dims = function(orig_w, orig_h, max_w, max_h) { var new_h; var scale = scale_rate(orig_w, orig_h, max_w, max_h); var new_w = Math.round(scale*orig_w); new_h = Math.round(scale*orig_h); if (new_w < 1) { new_w = 1; } if (new_h < 1) { new_h = 1; } return { W:new_w, H: new_h }; };
		scale_rate = function(orig_w, orig_h, max_w, max_h) { var scale1 = 0; var scale2 = 0; if (orig_w > max_w) { scale1 = (orig_w - max_w) / orig_w; } if (orig_h > max_h) { scale2 = (orig_h - max_h) / orig_h; } var scale = (scale1 > scale2) ? scale1 : scale2; return (1-scale); };
		/**
		* Update the top position and resize both w & h even if is not set a previous value ;)
		**/
		BoxScale  = function(boxElement, boxNewWidth, boxNewHeight, callback) { /** Resize it very sexy like? **/ if (!animate) { ElementSetWidth(boxElement, boxNewWidth); ElementSetHeight(boxElement, boxNewHeight); ElementSetTop(boxElement, (((ElementGetHeight('AB-Overlay') - ElementGetHeight(boxElement)) / 2) + ElementGetHeight('AB-ToolBar'))); } var boxObject = $ID(boxElement); var boxWidth = parseInt(parseFloat(0 + boxObject.style.width), 10); boxNewWidth = parseInt(parseFloat(0 + boxNewWidth), 10); var boxHeight = parseInt(parseFloat(0 + boxObject.style.height), 10); boxNewHeight = parseInt(parseFloat(0 + boxNewHeight), 10); /* if (boxWidth === boxNewWidth && boxHeight === boxNewHeight) { // run me anyway, to prevent image flicker. } */ DoChangeW(boxObject, boxWidth, boxNewWidth, boxHeight, boxNewHeight, BoxScaleSteps, 100, 0.333, callback); };
		DoChangeW = function(elem, startWidth, endWidth, startHeight, endHeight, steps, intervals, powr, callback) { /** The width **/ if (elem.widthChangeMemInt) { window.clearInterval(elem.widthChangeMemInt); } var actStep = 0; elem.widthChangeMemInt = window.setInterval(function() { elem.currentWidth = EaseInOut(startWidth, endWidth, steps, actStep, powr); ElementSetWidth(elem.id, elem.currentWidth); actStep++; if (actStep > steps) { window.clearInterval(elem.widthChangeMemInt); DoChangeH(elem, startWidth, endWidth, startHeight, endHeight, steps, intervals, powr, callback);} },intervals); };
		DoChangeH = function(elem, startWidth, endWidth, startHeight, endHeight, steps, intervals, powr, callback) { /** The height and the top **/ if (elem.widthChangeMemInt) { window.clearInterval(elem.widthChangeMemInt); } var actStep = 0; elem.widthChangeMemInt = window.setInterval(function() { elem.currentHeight = EaseInOut(startHeight, endHeight, steps, actStep, powr); ElementSetHeight(elem.id, elem.currentHeight); elem.currentTop = (((ElementGetHeight('AB-Overlay') - ElementGetHeight(elem.id)) / 2) + ElementGetHeight('AB-ToolBar')); ElementSetTop(elem.id, elem.currentTop); actStep++; if (actStep > steps) { window.clearInterval(elem.widthChangeMemInt); if (typeof callback === 'function') { callback(); } } },intervals); };
		EaseInOut = function(minValue, maxValue, totalSteps, actualStep, powr) { var delta = parseInt(maxValue, 10) - parseInt(minValue, 10); var stepp = minValue+(Math.pow(((1 / totalSteps) * actualStep), powr) * delta); return Math.ceil(stepp); };
		/** 
		* Hide selects/object on page, possible values for action are 'hidden' and 'visible' * Code from : http://www.shawnolson.net/a/1198/hide-select-menus-javascript.html
		**/
		FxFade  = function(elem, start, end, speed, callback) { window.clearInterval(elemfade); elemfade = window.setInterval(function() { start = Findend(start, end, speed); if (!animate) { if (start === 0) { ElementInVisible(elem); } else { ElementVisible(elem); } start = end; } else { ElementOpacity(elem, start); } if (start === end) { if (end === 0) {/** Little trick to prevent sizer flicker **/ ElementSetWidth('AB-Image',  1); ElementSetHeight('AB-Image', 1); } window.clearInterval(elemfade); if (typeof callback === 'function') { callback(); } } }, 1); };
		Findend = function(x, y, speed) { return x < y ? Math.min(x + speed*10, y) : Math.max(x - speed*10, y); };
		/**
		* Pauses code execution for specified time. Uses busy code, not good. - Code from http://www.faqts.com/knowledge_base/view.phtml/aid/1602
		**/
		Pause = function(numberMillis) { var now = new Date(); var exitTime = now.getTime() + numberMillis; while (true) { now = new Date(); if (now.getTime() > exitTime) { return; } } };
		/**
		* Returns array with : page width, page height, window width, window height, x page scroll, y page scroll values. * Code from - quirksmode.org
		**/
		GetPageSizes = function()
		{
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) { xScroll = document.body.scrollWidth; yScroll = window.innerHeight + window.scrollMaxY; }
			/* all but Explorer Mac */
			else if (document.body.scrollHeight > document.body.offsetHeight) { xScroll = document.body.scrollWidth; yScroll = document.body.scrollHeight; }
			/* Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari */
			else { xScroll = document.body.offsetWidth; yScroll = document.body.offsetHeight; }
	
			var windowWidth, windowHeight;
			/* all except Explorer */
			if (self.innerHeight) { windowWidth = self.innerWidth; windowHeight = self.innerHeight; }
			/* Explorer 6 Strict Mode */
			else if (document.documentElement && document.documentElement.clientHeight) { windowWidth = document.documentElement.clientWidth; windowHeight = document.documentElement.clientHeight; }
			/* Other Explorers */
			else if (document.body) { windowWidth = document.body.clientWidth; windowHeight = document.body.clientHeight; }
	
			var pageHeight, pageWidth;
			/* for small pages with total height less then height of the viewport */
			if (yScroll < windowHeight) { pageHeight = windowHeight; } else { pageHeight = yScroll; }
			/* for small pages with total width less then width of the viewport */
			if (xScroll < windowWidth) { pageWidth = windowWidth; } else { pageWidth = xScroll; }
	
			return { PWidth: pageWidth, PHeight: pageHeight, WWidth: windowWidth, WHeight: windowHeight, XScroll: xScroll, YScroll: yScroll };
		};
	
		/**
		* Returns array with x,y page scroll values. * Core code from - quirksmode.org
		**/
		GetPageScroll = function()
		{
			var xScroll, yScroll;
			if (self.pageYOffset) { yScroll = self.pageYOffset; xScroll = self.pageXOffset; }
			/* Explorer 6 Strict */
			else if (document.documentElement && document.documentElement.scrollTop) { yScroll = document.documentElement.scrollTop; xScroll = document.documentElement.scrollLeft; } 
			/* all other Explorers */
			else if (document.body) { yScroll = document.body.scrollTop; xScroll = document.body.scrollLeft; } 
			return { YScroll: yScroll, XScroll: xScroll }; 
		};
	
	/** Common functions - End **/
		this.SlideShows = SlideShows;
		this.Start = Start;
	
		return this;
	})();
	/**
	* If you don't find a better way, this may have to be a job for ScrollFreeze.
	* Code from - http://bytes.com/forum/thread498334.html
	**/
	ScrollFreeze = /*2843293230303620532E4368616C6D657273*/
	{
		propFlag : true,
		Ydisp : 0,
		Xdisp : 0,
		on : function() { if (this.getProp()) { window.onscroll = function() { ScrollFreeze.setXY(); }; } },
		off : function() { window.onscroll=null; },
		getProp : function() { if (typeof window.pageYOffset !== 'undefined') { this.Ydisp = window.pageYOffset; this.Xdisp = window.pageXOffset; } else if (document.documentElement) { this.Ydisp = document.documentElement.scrollTop; this.Xdisp = document.documentElement.scrollLeft; } else if (document.body && typeof document.body.scrollTop !== 'undefined') { this.Ydisp = document.body.scrollTop; this.Xdisp = document.body.scrollLeft; } else { this.propFlag = false; } return this.propFlag; },
		setXY : function() { window.scrollTo(this.Xdisp, this.Ydisp); }
	};
}