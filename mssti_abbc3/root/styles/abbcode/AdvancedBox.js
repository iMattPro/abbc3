// <![CDATA[
/**
* @ignore 
* Some JavaSccript help : http://www.gtalbot.org/DHTMLSection/ListAllAttributesAndMethodsOfObjects.html
**/

/** Some css on-the-fly - Start **/
document.write( "\n\r" + '<style type="text/css" media="all">'+ "\r" + '<!--' + "\r" );

document.write( '.reimg { visibility: hidden; }' );

/** Opera doesn't know URL cursor **/
if ( !navigator.userAgent.match(/(^|\W)(Opera)\/(\d+)(\.\d+)?/) )
{
	document.write( "\r" + '.resized, .resized-div, .attach_me, .attach_parent, .hoverbox { cursor: url("./styles/abbcode/zoomin.cur"), pointer; }' );
}
document.write( "\r" + '-->' + "\r" + '</style>' + "\n\r");
/** Some css on-the-fly - End **/

/**************************************************************************************************************************************************************************************************************************
* AdvancedBox JS - Start
* This work is open source
* AdvancedBox for resized images 
* Paked : A JavaScript Compressor.  version 3.0 - http://dean.edwards.name/packer/
**/
if ( ImageResizerMode == 'AdvancedBox' )
{
var AdvancedBox = new function( )
{
	/** Global Variables **/

	/** The browser **/
	var IE = ( window.navigator.userAgent.match(/(^|\W)(MSIE)\s+(\d+)(\.\d+)?/) ) ? true : false;
	/** Use sexy looks ? **/
	var animate = true; // Options : true | false
	var elemfade;
	/** For display the image (opacity effect) ( Integer value from 1 to 100 )**/
	var animateInDuration = 6;
	var animateOutDuration = 6;
	/** For enlarge or shrink the lightbox delay ( Integer value from 1 to 100 ) **/
	var BoxScaleSteps = 10;
	/** Set opacity on background element ( Integer value from 1 to 100 ) **/
	var ojbOpacity = 60;
	/** The size of "air" up to page **/
	var borderSize = 20;
	/** If you adjust the padding in the CSS, you will need to update this variable **/
	var padding = 4;
	/** Save the "image object" for global access **/
	var newObjImage = null;
	/** Dimensions of the box **/
	var MaxWidth, MaxHeight = 0;
	/** Zoom level ( true | false ) **/
	var ZoomLevel = false ;
	/** Loading **/
	var Wait_pass = 0;
	/** Slide Show **/
	var SlideWait = 0;
	/** The number of seconds to wait ( if animation is enabled, the animateXXDuration value will be added **/
	var SlideShowDuration = 5;
	var SlideShows = new Array( );

	/** Initialize all **/
	Start = function( url )
	{
		/** At first run, creates the element container **/
		if ( !$ID( 'AB-BackGround' ) ) { Create( ); }
		/** Show the loading image **/
		ElementShow( 'AB-BackGround' );
		ElementShow( 'AB-LoadingLink' );
		/** Create a new image with a Clear the image url **/
		ZoomLevel = false;
		newObjImage = new Image( );
		newObjImage.src = url_clean( url );
		/** Let's do some extra checks **/
		Wait_pass = 0;
		var timer = window.setInterval( function( )
		{
			/** Safety end the process if can't load the image afer 120 intents ( 1 Minutes ) **/
			Wait_pass++; if ( Wait_pass == 120 ) { window.clearInterval( timer ); Close( ); }
			/** Seems that IE when create an image gives a default width to 28 **/
			if ( !newObjImage.readyState == 'complete' || !newObjImage.complete ) { if ( newObjImage.width > 100) { window.clearInterval( timer ); Prepare( newObjImage, ZoomLevel ); } } else { window.clearInterval( timer ); Prepare( newObjImage, ZoomLevel ); }
		},10)
		return false;
	},

	/** Creates the elements container and appends it to the main document ( The background, image and close button ). **/
	Create = function( )
	{
		/** Preload the navbar buttons **/
		var preload_image_array = new Array( "advancedbox_blank.gif", "advancedbox_icon_close.gif", "advancedbox_icon_zoom.gif", "advancedbox_icon_next.gif", "advancedbox_icon_prev.gif", "advancedbox_icon_play.gif", "advancedbox_icon_pause.gif", "advancedbox_icon_loading.gif" );
		var preload_image_object = new Image(); for( i = 0, pi = preload_image_array.length; i < pi; i++ ) { preload_image_object.src = "./styles/abbcode/" + preload_image_array[i]; }

		var objBody = document.getElementsByTagName( 'body' ).item(0);
		/** Create the background element (div) **/
		var objOverlay = document.createElement( 'div' );
			objOverlay.setAttribute( 'id', 'AB-BackGround' );
			if ( IE ) { objOverlay.style.filter = 'alpha(opacity:'+ojbOpacity+')'; } else { objOverlay.style.KHTMLOpacity = objOverlay.style.MozOpacity = objOverlay.style.opacity = (ojbOpacity/100); }
			objBody.appendChild(objOverlay);
		/** Create a big container **/
		var objLightbox = document.createElement( 'div' );
			objLightbox.setAttribute( 'id', 'AB-Overlay' );
			objLightbox.style.display = 'none';
			objBody.appendChild(objLightbox);
		/** Create a big image container **/
		var objOuterImageContainer = document.createElement( 'div' );
			objOuterImageContainer.setAttribute( 'id', 'AB-OuterContainer' );
			objLightbox.appendChild(objOuterImageContainer);
		/** Create the image container **/
		var objImageContainer = document.createElement( 'div' );
			objImageContainer.setAttribute( 'id', 'AB-ImageContainer' );
			objOuterImageContainer.appendChild(objImageContainer);
		/** Create the image name container for images less than 300px **/
		var objResizerSpan = document.createElement( 'span' );
			objResizerSpan.setAttribute( 'id', 'AB-ImageName2' );
			objResizerSpan.className = 'resized-txt';
		/** Create the mane text **/
		var	objResizerText = document.createTextNode( '' );
			objResizerSpan.appendChild(objResizerText);
			objOuterImageContainer.appendChild(objResizerSpan);		
		/** Create the image here **/
		var objLightboxImage = document.createElement( 'img' );
			objLightboxImage.setAttribute( 'id', 'AB-Image' );
			objLightboxImage.setAttribute( 'src', ImageResizerBlankImage);
			objLightboxImage.onclick = function() { Close(); return false; }
			objImageContainer.appendChild(objLightboxImage);
		/** Create the toolbar **/
		var objHoverNav = document.createElement( 'div' );
			objHoverNav.setAttribute( 'id', 'AB-ToolBar' );
			objOuterImageContainer.appendChild(objHoverNav);
		/** Create the image name container for images bigger than 300px **/
		var objResizerSpan = document.createElement( 'span' );
			objResizerSpan.setAttribute( 'id', 'AB-ImageName1' );
			objResizerSpan.className = 'resized-txt';
		/** Create the mane text **/
		var	objResizerText = document.createTextNode( '' );
			objResizerSpan.appendChild(objResizerText);
			objHoverNav.appendChild(objResizerSpan);		
		/** Create the Close button **/
		var objBottomNavCloseLink = document.createElement( 'a' );
			objBottomNavCloseLink.setAttribute( 'id', 'AB-CloserLink' );
			objBottomNavCloseLink.alt = objBottomNavCloseLink.title = ImageResizerCloseAlt;
			objBottomNavCloseLink.onclick = function() { Close(); return false; }
			objHoverNav.appendChild(objBottomNavCloseLink);
		/** Create the Zoom button **/
		var objBottomNavZoomLink = document.createElement( 'a' );
			objBottomNavZoomLink.setAttribute( 'id', 'AB-ZoomLink' );
			objBottomNavZoomLink.onclick = function() { Prepare( newObjImage, true ); return false; };
			objHoverNav.appendChild(objBottomNavZoomLink);
		/** Create the Prev button **/
		var objBottomNavPrevLink = document.createElement( 'a' );
			objBottomNavPrevLink.setAttribute( 'id', 'AB-PrevLink' );
			objBottomNavPrevLink.alt = objBottomNavPrevLink.title = ImageResizerPrevtAlt;
			objHoverNav.appendChild(objBottomNavPrevLink);
		/** Create the Next button **/
		var objBottomNavNextLink = document.createElement( 'a' );
			objBottomNavNextLink.setAttribute( 'id', 'AB-NextLink' );
			objBottomNavNextLink.alt = objBottomNavNextLink.title = ImageResizerNextAlt;
			objHoverNav.appendChild(objBottomNavNextLink);
		/** Create the text n of n picture **/
		var objNumberDisplay = document.createElement( 'span' );
			objNumberDisplay.setAttribute( 'id', 'AB-nOnText' );
			objHoverNav.appendChild(objNumberDisplay);
		/** Create the Play button **/
		var objBottomNavPlayLink = document.createElement( 'a' );
			objBottomNavPlayLink = document.createElement( 'a' );
			objBottomNavPlayLink.setAttribute( 'id', 'AB-PlayLink' );
			objBottomNavPlayLink.alt = objBottomNavPlayLink.title = ImageResizerPlayAlt;
			objBottomNavPlayLink.onclick = function() { Slide_Show( 'play' ); return false; };
			objHoverNav.appendChild(objBottomNavPlayLink);
		/** Create the Loading button **/
		var objloadingLink = document.createElement( 'a' );
			objloadingLink.setAttribute( 'id', 'AB-LoadingLink' );
			objloadingLink.alt = objloadingLink.title = ImageResizerCloseAlt;
			objloadingLink.onclick = function() { Close(); return false; }
			objLightbox.appendChild(objloadingLink);

		/** Set a default size for the big image container, for the first run **/
		ElementSetWidth( 'AB-OuterContainer', 250 );
		ElementSetHeight( 'AB-OuterContainer', 250 );
	},

	/** Adjust sizes **/
	Prepare = function( newObjImage, CurrentZoomLevel )
	{
		/** Hide all images **/
		ImagesHidden();
		ElementSetSrc( 'AB-Image', ImageResizerBlankImage );
		/** Show the loading image **/
		ElementShow( 'AB-LoadingLink' );
		/** Hide the toolbar **/
		ElementInVisible( 'AB-ToolBar' );
		/** Resize event handlers **/
		window.onresize = Resize;
		/** Stop the body scroll function **/
		ScrollFreeze.on( );
		/** Hide some tags **/
		ElementBoxes( 'hidden' );
		/** Show the background overlay **/
		ElementShow( 'AB-BackGround' );
		/** Show the big container, whitout this here, all will be a mess ;) **/
		ElementShow( 'AB-Overlay' );
		/** Determine the dimensions of the entire document & current scroll position within the document **/
		var PageSize   = GetPageSizes( );
		var PageScroll = GetPageScroll( )
		/** Determine the visible dimensions of the browser window "the viewport" **/
		MaxWidth = Math.floor( PageSize.WWidth - ( borderSize*2 ) );
		MaxHeight = Math.floor( PageSize.WHeight - ( ( borderSize*2 ) + ElementGetHeight( 'AB-ToolBar' ) ) );
		/** Place the button bar **/
		ElementSetTop( 'AB-ToolBar', ( ( ElementGetHeight( 'AB-ToolBar' ) + padding ) *-1 ) );
		ElementSetLeft( 'AB-ToolBar', ( padding*-1 ) );
		/** The background gets the document's dimensions, so a shadow can be cast over the entire document **/
		ElementSetHeight( 'AB-BackGround' , PageSize.PHeight );
		/** Place the big container **/
		ElementSetTop( 'AB-Overlay', ( PageScroll.YScroll + ( borderSize/2 ) ) );
		ElementSetHeight( 'AB-Overlay', ( PageSize.WHeight - ( borderSize*2 ) ) );
		/** Display the image very sexy like? **/
		FxFade( 'AB-Image', 100, 0, animateInDuration );
		/** Zoom in to real dimensions? **/
		ZoomLevel = CurrentZoomLevel;
		if ( !ZoomLevel ) { var objOuterImageContainerdims = scale_dims( newObjImage.width, newObjImage.height, MaxWidth, MaxHeight ); } else { var objOuterImageContainerdims = { W: ( ( newObjImage.width  > MaxWidth  ) ? ( ElementGetWidth( 'AB-Overlay' ) - borderSize ) : newObjImage.width ), H: ( ( newObjImage.height > MaxHeight ) ? ( ElementGetHeight( 'AB-Overlay' ) - padding ) : newObjImage.height ) }; }
		/** Update the big container **/
		ElementSetHeight( 'AB-ImageContainer', objOuterImageContainerdims.H );
		/** Place the big image container in the middle of the page **/
		ElementSetTop( 'AB-OuterContainer', ( ( ( ElementGetHeight( 'AB-Overlay' ) - ElementGetHeight( 'AB-OuterContainer' ) ) / 2 ) + ElementGetHeight( 'AB-ToolBar' ) ) );
		/** Resize the outerImageContainer **/
		BoxScale( 'AB-OuterContainer', objOuterImageContainerdims.W, objOuterImageContainerdims.H, UpdateImage );
	},

	UpdateImage = function( )
	{
		/** Resize the image? **/
		if ( ZoomLevel )
		{
			/** Maximize the image container, adding scroll bars if necessary **/
			$ID( 'AB-ImageContainer' ).style.overflow = 'auto';
			/** Reset the scroll position **/
			$ID( 'AB-ImageContainer' ).scrollLeft = 0;
			$ID( 'AB-ImageContainer' ).scrollTop = 0;
			/** Swap Zoom In for Zoom Out **/
			$ID( 'AB-ZoomLink' ).alt = $ID( 'AB-ZoomLink' ).title = ImageResizerZoomOutAlt;
			$ID( 'AB-ZoomLink' ).onclick = function() { Prepare( newObjImage, false ); return false; };
			/** Image size, zoom in 1:1 **/
			var objImagedims = { W: newObjImage.width, H: newObjImage.height };
		}
		else
		{
			/** The image can be zoom ? **/
			if ( newObjImage.width < MaxWidth && newObjImage.height < MaxHeight ) { ElementDisabled( 'AB-ZoomLink' ); } else { ElementEnabled( 'AB-ZoomLink' ); }
			/** Restore image container **/
			$ID( 'AB-ImageContainer' ).style.overflow = '';
			/** Swap Zoom In for Zoom Out **/
			$ID( 'AB-ZoomLink' ).alt = $ID( 'AB-ZoomLink' ).title = ImageResizerZoomInAlt.replace(/%1\$s/, newObjImage.width).replace(/%2\$s/, newObjImage.height);
			$ID( 'AB-ZoomLink' ).onclick = function() { Prepare( newObjImage, true ); return false; };
			/** Image size **/
			var objImagedims = scale_dims( newObjImage.width, newObjImage.height, MaxWidth, MaxHeight );
		}
		/** Makes visible this image **/
		ElementVisible( 'AB-Image' );
		/** Update the image screen **/
		ElementSetSrc( 'AB-Image', newObjImage.src );
		/** Resize the image **/
		ElementSetWidth( 'AB-Image',  objImagedims.W );
		ElementSetHeight( 'AB-Image', objImagedims.H );
		/** Display the image very sexy like? **/
		FxFade( 'AB-Image', 0, 100, animateOutDuration);
		/** Update SlideShow **/
		Slide_Show( );
		/** Update the image name **/
		var ThePictName = newObjImage.src.substring( newObjImage.src.lastIndexOf("\/") + 1);
		if (objImagedims.W > 300 )
		{
			$ID( 'AB-ImageName1' ).firstChild.nodeValue = ( newObjImage.src.toLowerCase().match(/(^|\s)jpeg|jpg|gif|bmp|png|psd(\s|$ID)/) ? unescape(newObjImage.src.substring( newObjImage.src.lastIndexOf("\/") + 1)) : '' );
		}
		else
		{
			$ID( 'AB-ImageName2' ).firstChild.nodeValue = ( newObjImage.src.toLowerCase().match(/(^|\s)jpeg|jpg|gif|bmp|png|psd(\s|$ID)/) ? unescape(newObjImage.src.substring( newObjImage.src.lastIndexOf("\/") + 1)) : '' );
		}
		/** Update the image container width **/
		ElementSetWidth( 'AB-ToolBar', ElementGetWidth( 'AB-OuterContainer' ) );
		/** Show the toolbar **/
		ElementVisible( 'AB-ToolBar' );
		/** Hide the loading image **/
		ElementHide( 'AB-LoadingLink' );
	},

	Slide_Show = function( PlayOnOff, PlayNumber )
	{
		/** Reset to default values **/
		$ID( 'AB-ImageName1' ).firstChild.nodeValue = '';
		$ID( 'AB-ImageName2' ).firstChild.nodeValue = '';
		ElementDisabled( 'AB-PrevLink' );
		ElementDisabled( 'AB-NextLink' );
		/** Get the proper play/pause button **/
		var BottomNavPlayLink = ( $ID( 'AB-PlayLink' ) ? 'AB-PlayLink' :  'AB-PauseLink' );
		/** Get some values from the the array **/
		var search = contains( url_clean( newObjImage.src ), SlideShows );
		/** Do the job **/
		if ( search[0] )
		{
			/** Get current position of the actual picture, in the array **/
			var pos	 = search[1];
			var last = SlideShows.length;
			var prev = SlideShows[pos-1];
			var next = SlideShows[pos+1];
			/** IF this isn't the first picture, enable the "Previous button" **/
			if ( pos-1 >= 0 ) { ElementEnabled( 'AB-PrevLink' ); $ID( 'AB-PrevLink' ).onclick = function() { Start( prev ); return false; }; }
			/** IF this isn't the last picture, enable the "Next button" **/
			if ( pos+1 < last ) { ElementEnabled( 'AB-NextLink' ); $ID( 'AB-NextLink' ).onclick = function() { Start( next ); return false; }; }
			/** If there are only 1 picture, disable the play button **/
			if ( last <= 1 ) { ElementDisabled( BottomNavPlayLink ); }
			/** Update the text **/
			ElementSetInnerHTML( 'AB-nOnText', ImageResizerNumberOf.replace(/%1\$s/, pos+1 ).replace(/%2\$s/, last));
			/** Run the SlideShow? **/
			if ( PlayOnOff && typeof(PlayOnOff) != 'undefined' )
			{
				/** Calling from last pict, so start from first : else : start from next pict :) **/
				if ( !PlayNumber && pos+1 == last ) { PlayNumber = 1; PlayNext = SlideShows[0]; } else { PlayNumber = pos+1; PlayNext = next; }
				/** Update the play/pause buton **/
				if ( PlayOnOff == 'play' && PlayNumber < last )
				{
					$ID( BottomNavPlayLink ).setAttribute( 'id', 'AB-PauseLink' );
					$ID( 'AB-PauseLink' ).onclick = function() { Slide_Show( 'pause' ); return false; };				
					$ID( 'AB-PauseLink' ).alt = $ID( 'AB-PauseLink' ).title = ImageResizerPauseAlt;
					/** Run the SlideShow **/
					Start( PlayNext );
					var SlideDuration = ( SlideShowDuration + ( animate ? animateInDuration : 0 ) ) * 1000;
					SlideWait = window.setTimeout( function() { Slide_Show( 'play', PlayNumber ); }, SlideDuration );
				}
				else
				{
					$ID( BottomNavPlayLink ).setAttribute( 'id', 'AB-PlayLink' );
					$ID( 'AB-PlayLink' ).onclick = function() { Slide_Show( 'play' ); return false; };
					$ID( 'AB-PlayLink' ).alt = $ID( 'AB-PlayLink' ).title = ImageResizerPlayAlt;		
					/** Cancel Slideshow timer **/
					window.clearTimeout( SlideWait );
				}
			}
		}
	},

	/** If the browser window is resized, recalculate dimensions and positions **/
	Resize = function( e )
	{
		Close( );
		ElementShow( 'AB-Overlay' );
		ElementShow( 'AB-BackGround' );
		Prepare( newObjImage, ZoomLevel );
	},

	/** Reset to default values **/
	Close = function( e )
	{
		/** Restore images visibility **/
		ImagesVisible()
		/** Return the body scroll function **/
		ScrollFreeze.off( );
		/** Canel Resize event handlers **/
		window.onresize = null;
		/** Cancel Slideshow timer **/
		window.clearTimeout( SlideWait );
		/** Reset the play/pause button **/
		var BottomNavPlayLink = ( $ID( 'AB-PlayLink' ) ? 'AB-PlayLink' : 'AB-PauseLink' ); $ID( BottomNavPlayLink ).setAttribute( 'id', 'AB-PlayLink' );
		/** Show some tags **/
		ElementBoxes( 'visible' );
		/** Hide the image, background and buttons **/
		ElementSetSrc( 'AB-ImageContainer', ImageResizerBlankImage );
		ElementHide( 'AB-LoadingLink' );
		ElementHide( 'AB-Overlay' );
		ElementHide( 'AB-BackGround' );
	},

/** Common functions - Start **/
	$ID					= function(elementid)	{ return document.getElementById(elementid); },
	ElementHide			= function(element)		{ $ID(element).style.display = 'none'; },
	ElementShow			= function(element)		{ $ID(element).style.display = ''; },
	ElementVisible		= function(element)		{ $ID(element).style.visibility = 'visible'; },
	ElementInVisible	= function(element)		{ $ID(element).style.visibility = 'hidden'; },
	ElementGetWidth		= function(element)		{ return $ID(element).offsetWidth; },
	ElementSetWidth		= function(element,w)	{ $ID(element).style.width = w + 'px'; },
	ElementGetHeight	= function(element)		{ return $ID(element).offsetHeight; },
	ElementSetHeight	= function(element,h)	{ $ID(element).style.height = h + 'px'; },
	ElementSetTop		= function(element,t)	{ $ID(element).style.top = t + 'px'; },
	ElementSetLeft		= function(element,l)	{ $ID(element).style.left = l + 'px'; },
	ElementSetSrc		= function(element,src) { $ID(element).src = src; },
	ElementOpacity		= function(element, o)	{ if (window.ActiveXObject) { $ID(element).style.filter = 'alpha(opacity=' + o + ')'; } else { $ID(element).style.opacity = $ID(element).style.MozOpacity = $ID(element).style.KhtmlOpacity = o/100; } },
	ElementSetInnerHTML = function(element, c)	{ $ID(element).innerHTML = c; },
	ElementBoxes		= function(action)		{ if (action != 'visible' ) { action = 'hidden'; } if (IE) { for (var S = 0; S < document.forms.length; S++) { for (var R = 0; R < document.forms[S].length; R++) { if (document.forms[S].elements[R].options) { document.forms[S].elements[R].style.visibility = action; } } } } var theObjects = document.getElementsByTagName( 'object' ); for (var i = 0; i < theObjects.length; i++) { theObjects[i].style.visibility = action; }; },
	ElementDisabled		= function(element)     { $ID(element).className = ( $ID(element).className ? $ID(element).className+' ' : '') + 'disabled'; ElementOpacity( $ID(element).id, ojbOpacity); $ID(element).onclick = function() {};},
	ElementEnabled		= function(element)     { $ID(element).className = $ID(element).className.replace(/disabled/g, ''); ElementOpacity( $ID(element).id, 100); },

	ImagesHidden		= function()			{ var ilist = document.images; for(var l = 0; l < ilist.length; l++) { for (var i = 0; i < SlideShows.length; i++) { /* found the image */ if( url_clean(ilist[l].src) == url_clean(SlideShows[i]) ) { document.images[l].style.visibility = 'hidden' ; } } } },
	ImagesVisible		= function()			{ var ilist = document.images; for(var l = 0; l < ilist.length; l++) { for (var i = 0; i < SlideShows.length; i++) { /* found the image */ if( url_clean(ilist[l].src) == url_clean(SlideShows[i]) ) { document.images[l].style.visibility = 'visible'; } } } },

	/**
	* Code From : http://www.huddletogether.com/forum/comments.php?DiscussionID=1798
	**/
	scale_dims = function( orig_w, orig_h, max_w, max_h ) { var scale = scale_rate( orig_w, orig_h, max_w, max_h ); var new_w = Math.round( scale*orig_w ); new_h = Math.round( scale*orig_h ); if ( new_w < 1 ) { new_w = 1; } if ( new_h < 1 ) { new_h = 1; } return { W:new_w, H: new_h }; },
	scale_rate = function( orig_w, orig_h, max_w, max_h ) { var scale1 = 0; var scale2 = 0; if ( orig_w > max_w ) { scale1 = ( orig_w - max_w ) / orig_w; } if ( orig_h > max_h ) { scale2 = ( orig_h - max_h ) / orig_h; } var scale = ( scale1 > scale2 ) ? scale1 : scale2; return ( 1-scale ); },
	/**
	* Update the top position and resize both w & h even if is not set a previous value ;)
	**/
	BoxScale  = function( boxElement, boxNewWidth, boxNewHeight, callback ) { /** Resize it very sexy like? **/ if ( !animate ) { ElementSetWidth( boxElement, boxNewWidth ); ElementSetHeight( boxElement, boxNewHeight ); ElementSetTop( boxElement, ( ( ( ElementGetHeight( 'AB-Overlay' ) - ElementGetHeight( boxElement ) ) / 2 ) + ElementGetHeight( 'AB-ToolBar' ) ) ); } var boxObject = $ID( boxElement ); var boxWidth = parseInt( parseFloat( 0 + boxObject.style.width ) ); var boxNewWidth = parseInt( parseFloat( 0 + boxNewWidth ) ); var boxHeight = parseInt( parseFloat( 0 + boxObject.style.height ) ); var boxNewHeight = parseInt( parseFloat( 0 + boxNewHeight ) ); /* if ( boxWidth === boxNewWidth && boxHeight === boxNewHeight) { // run me anyway, to prevent image flicker. } */ DoChangeW( boxObject, boxWidth, boxNewWidth, boxHeight, boxNewHeight, BoxScaleSteps, 100, 0.333, callback ); },
	DoChangeW = function( elem, startWidth, endWidth, startHeight, endHeight, steps, intervals, powr, callback ) { /** The width **/ if (elem.widthChangeMemInt) { window.clearInterval(elem.widthChangeMemInt); } var actStep = 0; elem.widthChangeMemInt = window.setInterval( function() { elem.currentWidth = EaseInOut( startWidth, endWidth, steps, actStep, powr ); ElementSetWidth( elem.id, elem.currentWidth ); actStep++; if ( actStep > steps ) { window.clearInterval( elem.widthChangeMemInt ); DoChangeH( elem, startWidth, endWidth, startHeight, endHeight, steps, intervals, powr, callback ) } },intervals); },
	DoChangeH = function( elem, startWidth, endWidth, startHeight, endHeight, steps, intervals, powr, callback ) { /** The height and the top **/ if (elem.widthChangeMemInt) { window.clearInterval(elem.widthChangeMemInt); } var actStep = 0; elem.widthChangeMemInt = window.setInterval( function() { elem.currentHeight = EaseInOut( startHeight, endHeight, steps, actStep, powr ); ElementSetHeight( elem.id, elem.currentHeight ); elem.currentTop = ( ( ( ElementGetHeight( 'AB-Overlay' ) - ElementGetHeight( elem.id ) ) / 2 ) + ElementGetHeight( 'AB-ToolBar' ) ); ElementSetTop( elem.id, elem.currentTop ); actStep++; if ( actStep > steps ) { window.clearInterval( elem.widthChangeMemInt ); if ( typeof callback == 'function' ) { callback( ); } } },intervals); },
	EaseInOut = function( minValue, maxValue, totalSteps, actualStep, powr ) { var delta = parseInt(maxValue) - parseInt(minValue); var stepp = minValue+(Math.pow(((1 / totalSteps) * actualStep), powr) * delta); return Math.ceil(stepp); },
	/** 
	* Hide selects/object on page, possible values for action are 'hidden' and 'visible' * Code from : http://www.shawnolson.net/a/1198/hide-select-menus-javascript.html
	**/
	FxFade  = function( elem, start, end, speed, callback ) { window.clearInterval( elemfade ); elemfade = window.setInterval( function() { start = Findend(start, end, speed); if ( !animate ) { if ( start = 0 ) { ElementInVisible( elem ); } else { ElementVisible( elem ); } start = end; } else { ElementOpacity( elem, start ); } if(start == end) { if ( end == 0 ) {/** Little trick to prevent sizer flicker **/ ElementSetWidth( 'AB-Image',  1 ); ElementSetHeight( 'AB-Image', 1 ); } window.clearInterval( elemfade ); if ( typeof callback == 'function' ) { callback(); } } }, 1); },
	Findend = function( x, y, speed ) { return x < y ? Math.min(x + speed*10, y) : Math.max(x - speed*10, y); },
	/**
	* Pauses code execution for specified time. Uses busy code, not good. - Code from http://www.faqts.com/knowledge_base/view.phtml/aid/1602
	**/
	Pause = function( numberMillis ) { var now = new Date(); var exitTime = now.getTime() + numberMillis; while (true) { now = new Date(); if ( now.getTime() > exitTime ) return; } }
	/**
	* Returns array with : page width, page height, window width, window height, x page scroll, y page scroll values. * Code from - quirksmode.org
	**/
	GetPageSizes = function( )
	{
		var xScroll, yScroll;
		if ( window.innerHeight && window.scrollMaxY ) { xScroll = document.body.scrollWidth; yScroll = window.innerHeight + window.scrollMaxY; }
		/* all but Explorer Mac */
		else if ( document.body.scrollHeight > document.body.offsetHeight) { xScroll = document.body.scrollWidth; yScroll = document.body.scrollHeight; }
		/* Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari */
		else { xScroll = document.body.offsetWidth; yScroll = document.body.offsetHeight; }

		var windowWidth, windowHeight;
		/* all except Explorer */
		if (self.innerHeight) { windowWidth = self.innerWidth; windowHeight = self.innerHeight; }
		/* Explorer 6 Strict Mode */
		else if ( document.documentElement && document.documentElement.clientHeight ) { windowWidth = document.documentElement.clientWidth; windowHeight = document.documentElement.clientHeight; }
		/* Other Explorers */
		else if ( document.body ) { windowWidth = document.body.clientWidth; windowHeight = document.body.clientHeight; }

		var pageHeight, pageWidth;
		/* for small pages with total height less then height of the viewport */
		if( yScroll < windowHeight ) { pageHeight = windowHeight; } else { pageHeight = yScroll; }
		/* for small pages with total width less then width of the viewport */
		if( xScroll < windowWidth ) { pageWidth = windowWidth; } else { pageWidth = xScroll; }

		return { PWidth: pageWidth, PHeight: pageHeight, WWidth: windowWidth, WHeight: windowHeight, XScroll: xScroll, XScroll: yScroll };
	},

	/**
	* Returns array with x,y page scroll values. * Core code from - quirksmode.org
	**/
	GetPageScroll = function( )
	{
		var yScroll;
		if ( self.pageYOffset ) { yScroll = self.pageYOffset; xScroll = self.pageXOffset; }
		/* Explorer 6 Strict */
		else if ( document.documentElement && document.documentElement.scrollTop ){ yScroll = document.documentElement.scrollTop; xScroll = document.documentElement.scrollLeft; } 
		/* all other Explorers */
		else if ( document.body ) { yScroll = document.body.scrollTop; xScroll = document.body.scrollLeft; } 
		return { YScroll: yScroll, XScroll: xScroll }; 
	},

/** Common functions - End **/
	this.SlideShows = SlideShows;
	this.Start = Start;
}
/**
* If you don't find a better way, this may have to be a job for ScrollFreeze.
* Code from - http://bytes.com/forum/thread498334.html
**/
ScrollFreeze = /*2843293230303620532E4368616C6D657273*/
{
	propFlag : true,
	Ydisp : 0,
	Xdisp : 0,
	on : function() { if ( this.getProp( ) ) { window.onscroll = function(){ ScrollFreeze.setXY(); } } },
	off : function() { window.onscroll=null; },
	getProp : function() { if( typeof window.pageYOffset != 'undefined' ) { this.Ydisp = window.pageYOffset; this.Xdisp = window.pageXOffset; } else if ( document.documentElement ) { this.Ydisp = document.documentElement.scrollTop; this.Xdisp = document.documentElement.scrollLeft; } else if ( document.body && typeof document.body.scrollTop != 'undefined' ) { this.Ydisp = document.body.scrollTop; this.Xdisp = document.body.scrollLeft; } else { this.propFlag = false; } return this.propFlag; },
	setXY : function() { window.scrollTo( this.Xdisp, this.Ydisp ); }
}
}
/**
* AdvancedBox JS - End 
**************************************************************************************************************************************************************************************************************************/

/**
* Add a new value to an Array if isn't repeat
**/
function ArrayPush( arr, val ) { val = url_clean( val ); /** have this array this value ? **/ var found = contains( val, arr ); if( !found[0] ) { arr.push( val ); /* arr[arr.length] = val; */ } }

/**
* To cover IE 5.0's lack of the push method
**/
if (typeof Array.prototype.push ==' undefined')
{
	Array.prototype.push = function(value) { this[this.length] = value; }
}

/**
* Search in the gallery array
**/
function find_in_galleryset( arr, val ) { for (var row = 0; row < arr.length; ++row) { if (arr[row].url == val || arr[row].content == val) { return row + 1 } } return -1 }

/**
* Search in array
* Returns (true and number ) if 'v' is contained in the array 'a'
**/
function contains( v, a ) { for( var j=0; j<a.length; j++ ) { if( a[j] == v ) { return new Array( true, j ); } } return new Array( false, 0 ); }

/** Clear the image url **/
function url_clean( url )
{
	url = decodeURIComponent( url.toString().replace(/\s/g, ' ') );

	/** Is this an attached image ? if yes, need more work to clear the image url **/
	if ( url.indexOf( 'download' ) != -1 )
	{
		/** Will get the real url to the download script, Ex : http://www.mssti.com/phpbb3/download/file.php **/
		var valor   = url.substring( 0, url.indexOf( '?' ) );
		/** Will get an string starting from the id, Ex : id=65&mode=view or only id=65 **/
		var valorId1= url.substring( url.indexOf( 'id' ) );
		/** Will get only the id value, Ex : id=65 or null if have no extra params **/
		var valorId2 = valorId1.substring( valorId1.indexOf( 'id' ), valorId1.indexOf( '&' ) );
		/** Recreate the image url, Ex : http://www.mssti.com/phpbb3/download/file.php?id=65 **/
		url = valor + '?' + ( valorId2 ? valorId2 : valorId1 );
		/** MOD : kb - Start
		if (valorId1.indexOf('kb') != -1)
		{
			url += '&kb=1';
		}
		 MOD : kb - End **/
	}
	return url;
}

/** Image Resizer JS - START **/
/** http://codepunk.hardwar.org.uk/css2js.htm **/
var ImageResizerMaxWidth, ImageResizerMaxHeight = 0;
function ImageResizerOn( ObjImage )
{
	var ResizerId = 'image_' + Math.floor(Math.random()*(100));
	var ResizerW  = ObjImage.width;
	var ResizerH  = ObjImage.height;
	var ResizerP  = 0;

	/** Check the width **/
	if ( ObjImage.width > ImageResizerMaxWidth && ImageResizerMaxWidth > 0 && ObjImage.width > 0 )
	{
		/** Adjust the image width **/
		ObjImage.width  = ImageResizerMaxWidth;
		/** Adjust the width of the image while preserving proportions **/
		ObjImage.height = (ImageResizerMaxWidth / ResizerW) * ResizerH;
		/** Calculate the re-size ratio **/
		ResizerP = Math.ceil( parseInt( ObjImage.width / ResizerW * 100 ) );
	}

	if ( ObjImage.height > ImageResizerMaxHeight && ImageResizerMaxHeight > 0 && ObjImage.height > 0 )
	{
		/** Adjust the image height **/
		ObjImage.height = ImageResizerMaxHeight;
		/** Adjust the height of the image while preserving proportions **/
		ObjImage.width  = (ImageResizerMaxHeight / ResizerH) * ResizerW;
		/** Calculate the re-size ratio **/
		ResizerP = Math.ceil( parseInt( ObjImage.height / ResizerH * 100 ) );
	}
/**
	if (ObjImage.parentNode.style.cssText.match(/float/gi) )
	{
		ObjImage.parentNode.style.height = ObjImage.height + 'px';
		ObjImage.parentNode.style.width = ObjImage.width + 'px';
		ObjImage.parentNode.style.border='3px solid red';
		alert( ObjImage.height);
	}
**/
	/**
	* Use the image top bar for click or use the image instead ?
	* Recomended true - Options  false | true
	**/

	/** Use the image for click on - START **/
	if ( !ImageResizerUseBar )
	{
		if (ObjImage.fileSize && ObjImage.fileSize > 0)
		{
			ObjImage.alt = ObjImage.title = ImageResizerWarningFilesize.replace( '%1$s', ResizerW).replace( '%2$s', ResizerH).replace( '%3$s', Math.round(ObjImage.fileSize / 1024));
		}
		else
		{
			ObjImage.alt = ObjImage.title = ImageResizerWarningNoFilesize.replace( '%1$s', ResizerW).replace( '%2$s', ResizerH);
		}
		ObjImage.className		= ObjImage.className + ' resized';
		ObjImage.onclick		= function() { ImageResizeronclick( ObjImage, ResizerId ); return false; };
		if ( ImageResizerMode == 'HighslideBox'	)
		{
			if ( ObjImage.className == 'attach_parent' ) { ObjImage.onclick = function() { return hs.expand( ObjImage.parentNode, { src: ObjImage.parentNode.href } ) } } else { ObjImage.onclick = function() { return hs.expand(ObjImage, { src: ObjImage.src } ); }; }
		};

	}
	/** Use the image for click on - End **/
	else
	/** Adding the image top bar for click on - START **/
	{
		var objResizerDiv				= document.createElement('div');
			objResizerDiv.setAttribute('id', ResizerId );
			objResizerDiv.className		= 'resized-div';
			objResizerDiv.style.width	= ObjImage.width + 'px';
		//	objResizerDiv.onclick		= function() { ImageResizeronclick( ObjImage, ResizerId ); return false; };

		if ( ObjImage.parentNode.style.textAlign == 'right')
		{
			objResizerDiv.style.marginLeft  = 'auto';
		}

		if (ObjImage.fileSize && ObjImage.fileSize > 0)
		{
			objResizerDiv.alt = objResizerDiv.title = ImageResizerWarningFilesize.replace( '%1$s', ResizerW).replace( '%2$s', ResizerH).replace( '%3$s', Math.round(ObjImage.fileSize / 1024));
		}
		else
		{
			objResizerDiv.alt = objResizerDiv.title = ImageResizerWarningNoFilesize.replace( '%1$s', ResizerW).replace( '%2$s', ResizerH);
		}
		var	objResizerImg				= document.createElement('img');
			objResizerImg.src			= ImageResizerWarningImage;
			objResizerImg.width			= 16;
			objResizerImg.height		= 16;
			objResizerImg.alt			= '';
			objResizerImg.border		= 0;

		var objResizerSpan				= document.createElement('span');
			objResizerSpan.className	= 'resized-txt';

		var	objResizerText			= document.createTextNode('');
		if ( ObjImage.width <= 250 )
		{
			objResizerText.data		= ImageResizerWarningSmall;
		}
		else
		{
			objResizerText.data		= ImageResizerWarningFullsize.replace( '%1$s', ResizerP).replace( '%2$s', ResizerW).replace( '%3$s', ResizerH);
		}

		objResizerDiv.appendChild(objResizerImg);
		objResizerSpan.appendChild(objResizerText);
		objResizerDiv.appendChild(objResizerSpan);
		ObjImage.parentNode.insertBefore(objResizerDiv,ObjImage);
		
		objResizerDiv.onclick		= function() { ImageResizeronclick( ObjImage, ResizerId ); return false; };
		if ( ImageResizerMode == 'HighslideBox'	)
		{
			if ( ObjImage.className == 'attach_parent' ) { ObjImage.onclick = function() { return hs.expand( ObjImage.parentNode, { src: ObjImage.parentNode.href } ) } } else { ObjImage.onclick = function() { return hs.expand(ObjImage, { src: ObjImage.src } ); }; }
		};

	}
	/** Adding the image top bar for click on - END **/

	/** AdvancedBox Gallery - Working **/
	if ( ImageResizerMode == 'AdvancedBox'	) { ArrayPush( AdvancedBox.SlideShows , ObjImage.src ); }
	/** HighslideBox Gallery - Working **/
//	if ( ImageResizerMode == 'HighslideBox'	) { ObjImage.className = ObjImage.className + ' highslide'; }
	/** LiteBox Gallery - Working **/
	if ( ImageResizerMode == 'LiteBox'		) { myLightbox.imageArray.push([ObjImage.src, ObjImage.title]); }
	/** GreyBox Gallery - Working **/
	if ( ImageResizerMode == 'GreyBox'		) { ObjImage.setAttribute('rel', 'gb_imageset[gallery]'); if ( ObjImage.className == 'attach_parent' ) { gb_imageset.push({'caption': ObjImage.parentNode.src, 'url': ObjImage.parentNode.src}); } else { gb_imageset.push({'caption': ObjImage.src, 'url': ObjImage.src}); } }
	/** Lightview Gallery - Not Working **/
	if ( ImageResizerMode == 'Lightview'	) { ObjImage.setAttribute('rel', 'set[myset]'); }
	/** Ibox Gallery - Working **/
	if ( ImageResizerMode == 'Ibox'			) { ObjImage.setAttribute('rel', 'IBGallery'); if ( ObjImage.className == 'attach_parent' ) { ib_imageset.push({player:'img', content:ObjImage.parentNode.src, gallery:'IBGallery'}); } else { ib_imageset.push({player:'img', content:ObjImage.src, gallery:'IBGallery'}); } }
	/** PopBox gallery - I have no gallery mode **/
}

function ImageResizeronclick( ObjImage, Id )
{
	switch ( ImageResizerMode )
	{
		case 'AdvancedBox' :
			if ( ObjImage.className == 'attach_parent' ) { AdvancedBox.Start( ObjImage.parentNode.href ); } else { AdvancedBox.Start( ObjImage.src ); }
			break;

		case 'HighslideBox' :
			if ( ObjImage.className == 'attach_parent' ) { return hs.expand( ObjImage.parentNode, { src: ObjImage.parentNode.href } ) } else { return hs.expand(ObjImage, { src: ObjImage.src } ); }
			break;

		case 'LiteBox' :
			if ( ObjImage.className == 'attach_parent' ) { myLightbox.start(ObjImage.parentNode); } else { myLightbox.start(ObjImage); }
			break;

		case 'GreyBox' :
			if ( ObjImage.className == 'attach_parent' ) { var index = find_in_galleryset( gb_imageset, ObjImage.parentNode.href ); return GB_showImageSet(gb_imageset, (index) ? index : 1); } else { var index = find_in_galleryset( gb_imageset, ObjImage.src ); return GB_showImageSet(gb_imageset, (index) ? index : 1); }
		//	if ( ObjImage.className == 'attach_parent' ) { return GB_showImage(ObjImage.parentNode.src,ObjImage.parentNode.src); } else { return GB_showImage(ObjImage.src,ObjImage.src); }
			break;

		case 'Lightview' :
			if ( ObjImage.className == 'attach_parent' ) { Lightview.show({ href: ObjImage.parentNode.href, rel: 'image', options: { width: 800, height: 600 }}); } else { Lightview.show({ href: ObjImage.src, rel: 'image', options: { width: 800, height: 600 }}); }
			break;

		case 'Ibox' :
			if ( ObjImage.className == 'attach_parent' ) { var index = find_in_galleryset( ib_imageset, ObjImage.parentNode.href ); Shadowbox.open( ib_imageset, { current:(index) ? index : 1, gallery:'IBGallery' ,continuous:true, autoplay:true }); } else { var index = find_in_galleryset( ib_imageset, ObjImage.src ); Shadowbox.open( ib_imageset, { current:(index) ? index : 1, gallery:'IBGallery' ,continuous:true, autoplay:true }); }
		//	if ( ObjImage.className == 'attach_parent' ) { Shadowbox.open( { player:'img', content:ObjImage.parentNode.href} ); } else { Shadowbox.open( { player:'img', content:ObjImage.src } ); }
			break;

		case 'PopBox' :
			if ( ObjImage.className == 'attach_parent' ) { PopEx(ObjImage, null,  null, 0, 0, 50, 'PopBoxImageLarge'); } else { PopEx(ObjImage, null,  null, 0, 0, 50, 'PopBoxImageLarge'); }
			break;

		case 'pop-up':
			var popup_url = ( ObjImage.className == 'attach_parent' ) ? ObjImage.parentNode.href : ObjImage.src ;
			var popup_width = ( ObjImage.width + 30 );
			var popup_height = ( ObjImage.height + 30 );
			popup( popup_url, popup_width, popup_height );
			break;

		case 'enlarge':
			var ParentId = document.getElementById(Id);
			if ( !ImageResizerUseBar )
			{
				if ( ObjImage.className == 'attach_parent' ) { ImgOnLoad_scale( ParentId, ObjImage, ObjImage.parentNode.href, ObjImage.width, ObjImage.height ); } else { ImgOnLoad_scale( ObjImage, ObjImage, ObjImage.src, ObjImage.width, ObjImage.height ); }
			}else{
				if ( ObjImage.className == 'attach_parent' ) { ImgOnLoad_scale( ParentId, ObjImage, ObjImage.parentNode.href, ObjImage.width, ObjImage.height ); } else { ImgOnLoad_scale( ParentId, ObjImage, ObjImage.src, ObjImage.width, ObjImage.height ); }
			}
			break;

		case 'samewindow':
			if ( ObjImage.className == 'attach_parent' ) { window.open( ObjImage.parentNode.href, '_self' ); } else { window.open( ObjImage.src, '_self' ); }
			break;

		default:
		case 'newwindow':
			if ( ObjImage.className == 'attach_parent' ) { window.open( ObjImage.parentNode.href, '_blank' ); } else { window.open( ObjImage.src, '_blank' ); }
			break;
	}
	return false;
};
/** Image Resizer JS - END **/

	if ( ImageResizerMode == 'GreyBox'	) { var gb_imageset = new Array(); }
	if ( ImageResizerMode == 'Ibox'		) { var ib_imageset = new Array(); }

/** Initialize the Resizer **/
function ImgOnLoad()
{
	if ( ImageResizerMode == 'LiteBox'	) { myLightbox = new Lightbox(); }
	if ( ImageResizerMode == 'Ibox'		) { Shadowbox.init({ skipSetup: true, players: ['img'] }); }	// skip the automatic setup

	/**
	* phpbb images in signatures
	* class ="resize_me"
	* Recomended true - Options  false | true
	* This setting is currently mannaged in the ACP
	**/
	var exclude_signatures  = (ImageResizerSignature == 1) ? false : true;

	/**
	* ABBC3 thumbnail
	* class="hoverbox resize_me"
	* Recomended true - Options  false | true
	**/
	var exclude_thumbnail_abbc3		= true;

	/**
	* phpbb thumbnail attached
	* class ="attach_parent"
	* Recomended true - Options  false | true
	**/
	var exclude_thumbnail_attached	= true;

	/**
	* phpbb image attached
	* class="attach_me"
	* Recomended false - Options  false | true
	**/
	var exclude_images_attached		= false;

/** Search images in signatures - Start **/
	if ( exclude_signatures || (ImageResizerMaxWidth_sig > 0 || ImageResizerMaxHeight_sig > 0) )
	{
		var sig_images_ary = new Array();
		var sig_elm_ary=[].slice.call(getElementsByClassName( 'signature', 'div' )).concat([].slice.call(getElementsByClassName( 'postbody', 'span' ))); //.concat([].slice.call(getElementsByClassName( 'postbody', 'div' )));
		for (var e = 0, sea = sig_elm_ary.length; e < sea; e++)
		{
			if ( sig_elm_ary[e].id )
			{
				var sig_img_ary = getElementsByClassName( 'resize_me', 'img', document.getElementById( sig_elm_ary[e].id ));
				for (var i = 0, sia = sig_img_ary.length; i < sia; i++) { sig_images_ary.push( sig_img_ary[i].src); }
			}
		}
		/** Now the array sig_images_ary contain all images in signatures **/
	}
/** Search images in signatures - End **/
	
/** Search all images inside posts - Start **/
	var post_images_ary = post_attach_ary = posted_images_ary = new Array();

	/** Real images - Attached images - Attached thumbnail **/
	post_images_ary = MyGetElementsByClassName( 'resize_me|attach_me|attach_parent' )
	for (var i = 0, ipia = post_images_ary.length; i < ipia; i++)
	{
		posted_images_ary.push( post_images_ary[i] );
	}
	/** Now the array posted_images_ary contain all images in post **/
/** Search all images inside posts - End **/

/** Go ahead and to the jod **/
	for (var pia = 0; pia < posted_images_ary.length; pia++)
	{
		var ImageResizer = false;
		var ContinueResizer = true;

		var img = posted_images_ary[pia];

		// Unhide the image, still using its real (full) dimensions.
		img.style.visibility = "visible";
		img.className = img.className.replace(/(^|.*\s)reimg(\s+(.*)|$)/, '$1$3');

		/** Skip to resize signatures **/
		ImageResizerMaxWidth = ImageResizerMaxWidth_post; ImageResizerMaxHeight = ImageResizerMaxHeight_post;
		if ( exclude_signatures && sig_images_ary.length > 0 )
		{
			if ( contains( img.src, sig_images_ary )[0] ) { continue; } 
		}
		else if ( !exclude_signatures && sig_images_ary.length > 0 )
		{
			if ( contains( img.src, sig_images_ary )[0] ) { ImageResizerMaxWidth = ImageResizerMaxWidth_sig; ImageResizerMaxHeight = ImageResizerMaxHeight_sig; }
		}

		/** Check if this image will be resized **/
		if ( ( ImageResizerMaxWidth > 0 && img.width > ImageResizerMaxWidth ) || ( ImageResizerMaxHeight > 0 && img.height > ImageResizerMaxHeight ) )
		{
			ImageResizer = true;
			if (img.className == 'hoverbox resize_me')	{ ImageResizer = (exclude_thumbnail_abbc3 ? false : true); }
			if (img.className == 'attach_parent')		{ ImageResizer = (exclude_thumbnail_attached ? false : true); }
			if (img.className == 'attach_me')			{ ImageResizer = (exclude_images_attached ? false : true); }
		}
		
		switch (img.className)
		{
			default:
			break;

			/** ABBC3 thumbnail **/
			case 'hoverbox resize_me':
				switch (ImageResizerMode)
				{
					case 'AdvancedBox':
						img.onclick = function() { AdvancedBox.Start( this.src ); return false; }; ArrayPush( AdvancedBox.SlideShows, img.src );
						break;
					case 'HighslideBox':
						img.className = img.className + ' highslide'; img.onclick = function() { return hs.expand(this, { src: this.src } ); }
						break;
					case 'LiteBox':
						myLightbox.imageArray.push([img.src, img.title]); img.onclick = function () {myLightbox.start(this);}
						break;
					case 'GreyBox':
						img.setAttribute('rel', 'gb_imageset[gallery]'); gb_imageset.push({'caption': img.src, 'url': img.src}); img.onclick = function () { var index = find_in_galleryset( gb_imageset, this.src ); return GB_showImageSet(gb_imageset, (index) ? index : 1); }
					//	img.setAttribute('rel', 'gb_imageset[gallery]'); img.onclick = function () {GB_showImage(this.href,this.href); return false; } }
						break;
					case 'Lightview':
						img.setAttribute('rel', 'set[myset]'); img.onclick = function () { Lightview.show({ href: this.src, rel: 'image', options: { width: 800, height: 600 }}); return false; }
						break;
					case 'Ibox':
						img.setAttribute('rel', 'IBGallery'); ib_imageset.push({player:'img', content:img.src, gallery:'IBGallery'}); img.onclick = function () { var index = find_in_galleryset( ib_imageset, this.src ); Shadowbox.open( ib_imageset, { current:(index) ? index : 1, gallery:'IBGallery' ,continuous:true, autoplay:true }); return false; }
					//	img.setAttribute('rel', 'gallery[myset]'); img.onclick = function () { Shadowbox.open( {player:'img', content:this.src } ); return false; }
						break;
					case 'PopBox':
						img.onclick = function() { Pop( this, 50, 'PopBoxImageLarge' ); return false; };
						break;
					case 'pop-up':
						img.onclick = function() { popup( this.src, this.width, this.height ); return false; }
						break;									
					case 'enlarge':
						img.onclick = function() { ImgOnLoad_scale( this, this, this.src, this.width, this.height ); return false; }
						break;
					case 'samewindow':
						img.onclick = function() { window.open(this.src, '_self' ); return false; }
						break;									
					default:
					case 'newwindow':
						img.onclick = function() { window.open(this.src, '_blank' ); return false; }
						break;
				}
				break;
			/** phpbb image attached **/
			case 'attach_parent':
				/** Disable the attachment.html onclick="viewableArea(this);" **/
				img.parentNode.onclick = function() { return false; }

				/** Clear the image url, mostly for IE, but also works better for other browsers **/
				img.parentNode.href = url_clean(img.parentNode.href);

				switch (ImageResizerMode)
				{
					case 'AdvancedBox':
						if (!ImageResizer) { img.onclick = function() { AdvancedBox.Start(this.parentNode.href); return false; }; ArrayPush(AdvancedBox.SlideShows, img.parentNode.href); }
						break;
					case 'HighslideBox':
						if (!ImageResizer) { img.className = img.className + ' highslide'; img.parentNode.onclick = function() {return hs.expand(this)} }
						break;
					case 'LiteBox':
						if (!ImageResizer) { myLightbox.imageArray.push([img.parentNode.href, img.title]); img.parentNode.onclick = function () { myLightbox.start(this); return false; } }
						break;
					case 'GreyBox':
						if (!ImageResizer) { img.setAttribute('rel', 'gb_imageset[gallery]'); gb_imageset.push({'caption': img.src, 'url': img.parentNode.href}); img.parentNode.onclick = function () { var index = find_in_galleryset( gb_imageset, this.href ); return GB_showImageSet(gb_imageset, (index) ? index : 1); } }
					//	if (!ImageResizer) { img.setAttribute('rel', 'gb_imageset[gallery]'); img.parentNode.onclick = function () {GB_showImage(this.href,this.href); return false; } }
						break;
					case 'Lightview':
						if (!ImageResizer) { img.setAttribute('rel', 'set[myset]'); img.onclick = function () { Lightview.show({ href: this.parentNode.href, rel: 'image', options: { width: 800, height: 600 }}); return false; } }
						break;
					case 'Ibox':
						if (!ImageResizer) { img.setAttribute('rel', 'IBGallery'); ib_imageset.push({player:'img', content:img.parentNode.href, gallery:'IBGallery'}); img.onclick = function () { var index = find_in_galleryset( ib_imageset, this.parentNode.href ); Shadowbox.open( ib_imageset, { current:(index) ? index : 1, gallery:'IBGallery' ,continuous:true, autoplay:true }); return false; } }
					//	if (!ImageResizer) { img.setAttribute('rel', 'gallery[myset]'); img.onclick = function () {  Shadowbox.open( {player:'img', content:this.parentNode.href} ); return false; } }
						break;
					case 'PopBox':
						if (!ImageResizer) { img.setAttribute('pbSrc', img.parentNode.href); img.onclick = function() { Pop(this, 50, 'PopBoxImageLarge'); return false; }; }
						break;
					case 'pop-up':
						if (!ImageResizer) { img.onclick = function() { popup(this.parentNode.href, this.width, this.height); return false; } }
						break;									
					case 'enlarge':
						if (!ImageResizer) { img.onclick = function() { ImgOnLoad_scale(this, this, this.parentNode.href, this.width, this.height); return false; } }
						break;
					case 'samewindow':
						if (!ImageResizer) { img.onclick = function() { window.open(this.parentNode.href, '_self'); return false; } }
						break;									
					default:
					case 'newwindow':
						if (!ImageResizer) { img.onclick = function() { window.open(this.parentNode.href, '_blank'); return false; } }
						break;
				}
				break;
			/** phpbb image attached **/
			case 'attach_me':
				img.onclick = function() { return false; }
				switch (ImageResizerMode)
				{
					case 'AdvancedBox':
						if (!ImageResizer) { img.onclick = function() { AdvancedBox.Start(this.src); return false; }; ArrayPush(AdvancedBox.SlideShows, img.src); }
						break;
					case 'HighslideBox':
						if (!ImageResizer) { img.className = img.className + ' highslide'; img.onclick = function () {return hs.expand(this, { src: this.src });} }
						break;
					case 'LiteBox':
						if (!ImageResizer) { myLightbox.imageArray.push([img.src, img.title]); img.onclick = function () { myLightbox.start(this); return false; } }
						break;
					case 'GreyBox':
						if (!ImageResizer) { img.setAttribute('rel', 'gb_imageset[gallery]'); gb_imageset.push({'caption': img.src, 'url': img.src}); img.onclick = function () { var index = find_in_galleryset( gb_imageset, this.src ); return GB_showImageSet(gb_imageset, (index) ? index : 1); } }
					//	if (!ImageResizer) { img.setAttribute('rel', 'gb_imageset[]'); img.onclick = function () {GB_showImage(this.src,this.src);} }
						break;
					case 'Lightview':
						if (!ImageResizer) { img.setAttribute('rel', 'set[myset]'); img.onclick = function () { Lightview.show({ href: this.src, rel: 'image', options: { width: 800, height: 600 }}); return false; } }
						break;
					case 'Ibox':
						if (!ImageResizer) { img.setAttribute('rel', 'IBGallery'); ib_imageset.push({player:'img', content:img.src, gallery:'IBGallery'}); img.onclick = function () { var index = find_in_galleryset( ib_imageset, this.src ); Shadowbox.open( ib_imageset, { current:(index) ? index : 1, gallery:'IBGallery' ,continuous:true, autoplay:true }); return false; } }
					//	if (!ImageResizer) { img.setAttribute('rel', 'gallery[myset]'); img.onclick = function () { Shadowbox.open( {player:'img', content:this.src} ); return false; } }
						break;
					case 'PopBox':
						if (!ImageResizer) { img.setAttribute('pbSrc', img.src); img.onclick = function() { Pop(this, 50, 'PopBoxImageLarge'); return false; }; }
						break;
					case 'pop-up':
						if (!ImageResizer) { ImgOnLoad_unScale(img, img, img.src); img.onclick = function() { popup(this.src, this.width, this.height); return false; } }
						break;									
					case 'enlarge':
						if (!ImageResizer) { ImgOnLoad_unScale(img, img, img.src); }
						break;
					case 'samewindow':
						if (!ImageResizer) { ImgOnLoad_unScale(img, img, img.src); img.onclick = function() { window.open(this.src, '_self'); return false; } }
						break;
					default:
					case 'newwindow':
						if (!ImageResizer) { ImgOnLoad_unScale(img, img, img.src); img.onclick = function() { window.open(this.src, '_blank'); return false; } }
						break;
				}
		}

		if ( ImageResizer ) {ImageResizerOn(img);}
	}
	/* MSIE if (typeof(window.detachEvent) != 'undefined' ) { window.detachEvent( 'onload', ImgOnLoad); } */ 

	return true;
}

function ImgOnLoad_scale(obj, imgobj, imgsrc, imgwidth, imgheight)
{
	var new_img = new Image();
	new_img.setAttribute('src', imgsrc);
//	new_img.onload = function() { obj.style.width = new_img.width+'px'; imgobj.setAttribute( 'width', new_img.width); imgobj.setAttribute( 'height', new_img.height); return false; }
//	obj.onclick = function() { ImgOnLoad_unScale( obj, imgobj, imgsrc, imgwidth, imgheight ); return false; }
	/** Let's do some extra checks **/
	Wait_pass = 0;
	var timer = window.setInterval( function()
	{
		/** Safety end the process if can't load the image afer 120 intents ( 1 Minutes ) **/
		Wait_pass++; if (Wait_pass >= 120) { window.clearInterval(timer); return false; }
		/** Seems that IE when create an image gives a default width to 28 **/
		if (new_img.readyState == 'complete' || new_img.complete) 
		{
			window.clearInterval(timer);
			obj.style.width  = new_img.width+'px';  imgobj.setAttribute( 'width', new_img.width); imgobj.setAttribute('height', new_img.height); 
			obj.onclick = function() { ImgOnLoad_unScale(obj, imgobj, imgsrc, imgwidth, imgheight); return false; }
		}
	},10)
}

function ImgOnLoad_unScale(obj, imgobj, imgsrc, imgwidth, imgheight)
{
	obj.style.width	= imgwidth+'px';
	imgwidth  = (imgwidth  > 0) ? imgwidth  : ImageResizerMaxWidth;
	imgheight = (imgheight > 0 ) ? imgheight : ImageResizerMaxHeight;
	imgobj.setAttribute('width', imgwidth);
	if (imgheight > 0) { imgobj.setAttribute('height', imgheight); } else { imgobj.setAttribute('height', imgwidth); }
	obj.onclick = function() { ImgOnLoad_scale(obj, imgobj, imgsrc, imgwidth, imgheight); return false; }
}

/** Install the safety net to catch any images that needs to be resized - START **/
if (window.onload_functions) // prosilver
{//	onload_functions.push('ImgOnLoad()');
	onload_functions[onload_functions.length] = "ImgOnLoad();";
}
else if (typeof(window.addEventListener) != "undefined") // DOM
{
	window.addEventListener("load", ImgOnLoad, false);
}
else if (typeof(window.attachEvent) != "undefined") // MSIE
{
	window.attachEvent("onload", ImgOnLoad);
}
/** Install the safety net to catch any images that needs to be resized - END **/

// ]]>