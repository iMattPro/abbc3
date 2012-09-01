/**
* Add a new value to an Array if isn't repeat
*/
function ArrayPush(arr, val) { 
	val = url_clean(val);
	var found = contains(val, arr);
	if (!found[0]) {
		arr.push(val);
	}
}

/**
* To cover IE 5.0's lack of the push method
*/
if (typeof Array.prototype.push === ' undefined') {
	Array.prototype.push = function(value) {
		this[this.length] = value;
	};
}

/**
* Search in array
* Returns (true and number) if 'v' is contained in the array 'a'
*/
function contains(v, a) {
	for (var j=0; j<a.length; j++) {
		if (a[j] === v) {
			return new Array(true, j);
		}
	}
	return new Array(false, 0);
}

/**
* Clean the image url
*/
function url_clean(url)
{
	url = decodeURI(url.toString().replace(/\s/g, ' ')); // stopped using decodeURIComponent

	// Is this an attached image? if yes, we need to do more clean up to the image url.
	if (url.indexOf('download/') !== -1)
	{
		// Will get the real url to the download script, Ex : http://www.mssti.com/phpbb3/download/file.php
		var param1 = url.substring(0, url.indexOf('?'));
		// Will get a string starting from the id, Ex : id=65&mode=view or only id=65
		var param2 = url.substring(url.indexOf('id='));
		// Will get only the id value, Ex : id=65 or null if have no extra params
		var param3 = param2.substring(param2.indexOf('id='), param2.indexOf('&'));
		// Recreate the image url, Ex : http://www.mssti.com/phpbb3/download/file.php?id=65
		url = param1 + '?' + (param3 ? param3 : param2);
	}

	return url;
}


/**
* Clean the image name
*/
function name_clean(ObjImage)
{
	var title = '';

	if (ObjImage.className.indexOf('resize_me') !== -1)
	{
		title = ObjImage.src.substring(ObjImage.src.lastIndexOf('/') + 1);
	}
	else if ((ObjImage.className.indexOf('attach_me') !== -1) || (ObjImage.className.indexOf('attach_parent') !== -1))
	{
		title = ObjImage.alt;
	}
	else
	{
		title = ObjImage.src;
	}

	return title;
}

/**
* Scale the image to big size
* @param obj		the image wrapper object
* @param img_obj	the image object
* @param img_src	the actual image scr
* @param new_src	the new image src
* @param img_width	the actual image width
* @param img_height	the actual image height
*/
function image_scale(obj, img_obj, img_src, new_src, img_width, img_height)
{
	var new_img = new Image();
	new_img.src = new_src;
	img_obj.src = new_src;
	if (obj !== img_obj) { obj.style.width = new_img.width + 'px'; }
	// Let's do some extra checks
	var Wait_pass = 0;
	var timer = window.setInterval(function()
	{
		// Safely end the process if can't load the image afer 120 intents (1 Minutes)
		Wait_pass++; if (Wait_pass >= 120) { window.clearInterval(timer); return false; }
		// Seems that IE when create an image gives a default width to 28
		if (new_img.readyState === 'complete' || new_img.complete) 
		{
			window.clearInterval(timer);
			img_obj.width = new_img.width;
			img_obj.height = new_img.height;
			img_obj.onclick = function() { return image_unscale(obj, img_obj, img_src, new_src, img_width, img_height); };
		}
	}, 10);
}

/**
* un Scale the image to small size
* @param obj		the image wrapper object
* @param img_obj	the image object
* @param img_src	the actual image scr
* @param new_src	the new image src
* @param img_width	the actual image width
* @param img_height	the actual image height
*/
function image_unscale(obj, img_obj, img_src, new_src, img_width, img_height)
{
	img_obj.src = img_src;
	img_width  = (img_width  > 0) ? img_width  : ImageResizerMaxWidth;
	img_height = (img_height > 0) ? img_height : ImageResizerMaxHeight;
	if (obj !== img_obj) { obj.style.width = img_width + 'px'; }
	img_obj.width = img_width;
	img_obj.height = img_height;
	img_obj.onclick = function() { return image_scale(obj, img_obj, img_src, new_src, img_width, img_height); };
}

/**
* How to replace an element (HTML tag) by 100% pure DOM method
* http://my.opera.com/Ti/blog/show.dml/423621
*/
function wrap_by_anchor(ObjImage, objResizerDiv, mode)
{
	// Add the magnifying glass cursor
	ObjImage.className = ObjImage.className + ' resized';

	var anchor, clone, fragment, source;
	if (mode !== 'attach_parent')
	{
		// duplicate elements: http://books.mozdev.org/html/mozilla-chp-5-sect-2.html#mozilla-CHP-5-SECT-2.3.8
		clone = ObjImage.cloneNode(false);
		source = ObjImage;
		// New page fragment
		fragment = document.createDocumentFragment();
		// New anchor
		anchor = document.createElement('a');
		anchor.href = url_clean(ObjImage.src);
		anchor.title = name_clean(ObjImage);
	}

	// http://planetozh.com/projects/lightbox-clones/
	switch (ImageResizerMode)
	{
		case 'AdvancedBox':
			if (mode === 'attach_parent')
			{
				ArrayPush(AdvancedBox.SlideShows, ObjImage.parentNode.href);
				ObjImage.onclick = function() { return AdvancedBox.Start(this.parentNode.href); };
			}
			else
			{
				ArrayPush(AdvancedBox.SlideShows, ObjImage.src);
				ObjImage.onclick = function() { return AdvancedBox.Start(this.src); };
			}
			return true;
		//break;

		case 'HighslideBox':
			if (mode === 'attach_parent')
			{
				ObjImage.parentNode.className = ObjImage.parentNode.className + ' highslide';
				ObjImage.parentNode.onclick = function() { return hs.expand(this, {slideshowGroup: 'gallery'}); };
				return true;
			}
			else
			{
				anchor.className = anchor.className + ' highslide';
				anchor.onclick = function() { return hs.expand(anchor, {slideshowGroup: 'gallery'}); };
			}
		break;

		case 'Lightview':
			if (mode === 'attach_parent')
			{
				ObjImage.parentNode.className = ObjImage.parentNode.className + ' lightview';
				ObjImage.parentNode.rel = 'gallery[lightview_gallery]';
				return true;
			}
			else
			{
				anchor.className = (anchor.className) ? anchor.className + ' lightview' : 'lightview';
				anchor.rel = 'gallery[lightview_gallery]';
			}
		break;

		case 'prettyPhoto':
			if (mode === 'attach_parent')
			{
				ObjImage.parentNode.rel = 'prettyPhoto[gallery]';
				return true;
			}
			else
			{
				anchor.rel = 'prettyPhoto[gallery]';
			}
		break;

		case 'Shadowbox':
			if (mode === 'attach_parent')
			{
				ObjImage.parentNode.className = ObjImage.parentNode.className + ' shadowbox-gallery';
				ObjImage.parentNode.setAttribute('rel', 'shadowbox;player=img');
				return true;
			}
			else
			{
				anchor.className = (anchor.className) ? anchor.className + ' shadowbox-gallery' : 'shadowbox-gallery';
				anchor.rel = 'shadowbox;player=img';
			}
		break;

		case 'pop-up':
			if (mode === 'attach_parent')
			{
				ObjImage.onclick = function() { return popup(this.parentNode.href, this.width, this.height); };
			}
			else
			{
				var popup_url = (ObjImage.className.indexOf('attach_parent') !== -1) ? ObjImage.parentNode.href : ObjImage.src ;
				var popup_width = (ObjImage.width + 30);
				var popup_height = (ObjImage.height + 30);
				ObjImage.onclick = function() { return popup(popup_url, popup_width, popup_height, name_clean(ObjImage)); };
			}
			return true;
		//break;

		case 'enlarge':
			if (mode === 'attach_parent')
			{
				ObjImage.onclick = function() { return image_scale(this, this, this.src, this.parentNode.href, this.width, this.height); };
			}
			else
			{
				if (objResizerDiv)
				{
					ObjImage.onclick = function() { return image_scale(objResizerDiv, this, this.src, this.src, this.width, this.height); };
				}
				else
				{
					ObjImage.onclick = function() { return image_scale(this, this, this.src, this.src, this.width, this.height); };
				}
			}
			return true;
		//break;

		case 'samewindow':
			if (mode === 'attach_parent')
			{
				ObjImage.onclick = function() { return window.open(this.parentNode.href.replace(/&amp;/g, '&'), '_self', 'resizable=yes,scrollbars=yes'); /*return false;*/ };
			}
			else
			{
				ObjImage.onclick = function() { return window.open(ObjImage.src, '_self'); };
			}
			return true;
		//break;

		default:
		case 'newwindow':
			if (mode === 'attach_parent')
			{
				ObjImage.onclick = function() { return window.open(this.parentNode.href, '_blank'); };
			}
			else
			{
				ObjImage.onclick = function() { return window.open(ObjImage.src, '_blank'); };
			}
			return true;
		//break;
	}

	// Put the image inside the anchor
	anchor.appendChild(clone);
	// Put anchor in page fragment
	fragment.appendChild(anchor);
	// Replace source with new fragment (contains a copy of source)
	source.parentNode.replaceChild(fragment, source);

	return true;
}

/**
* Image Resizer JS
* http://codepunk.hardwar.org.uk/css2js.htm
*/
function ImageResizerOn(ObjImage)
{
	var ResizerId = 'image_' + Math.floor(Math.random() * (100));
	var ResizerW  = ObjImage.width;
	var ResizerH  = ObjImage.height;
	var ResizerP  = 0;
	var objResizerDiv;

	// Check the width
	if (ObjImage.width > ImageResizerMaxWidth && ImageResizerMaxWidth > 0 && ObjImage.width > 0)
	{
		// Adjust the image width
		ObjImage.width  = ImageResizerMaxWidth;
		// Adjust the width of the image while preserving proportions
		ObjImage.height = (ImageResizerMaxWidth / ResizerW) * ResizerH;
		// Calculate the re-size ratio
		ResizerP = Math.ceil(parseInt(ObjImage.width / ResizerW * 100, 10));
	}

	if (ObjImage.height > ImageResizerMaxHeight && ImageResizerMaxHeight > 0 && ObjImage.height > 0)
	{
		// Adjust the image height
		ObjImage.height = ImageResizerMaxHeight;
		// Adjust the height of the image while preserving proportions
		ObjImage.width  = (ImageResizerMaxHeight / ResizerH) * ResizerW;
		// Calculate the re-size ratio
		ResizerP = Math.ceil(parseInt(ObjImage.height / ResizerH * 100, 10));
	}

	// Add the Image Resizer Bar
	if (!ImageResizerUseBar)
	{
		if (ObjImage.fileSize && ObjImage.fileSize > 0)
		{
			ObjImage.title = ImageResizerWarningFilesize.replace('%1$s', ResizerW).replace('%2$s', ResizerH).replace('%3$s', Math.round(ObjImage.fileSize / 1024)) + "\n\r" + ImageResizerWarningSmall;
		}
		else
		{
			ObjImage.title = ImageResizerWarningNoFilesize.replace('%1$s', ResizerW).replace('%2$s', ResizerH) + "\n\r" + ImageResizerWarningSmall;
		}
	}
	else
	{
		objResizerDiv				= document.createElement('div');
		objResizerDiv.className		= 'resized-div';
		objResizerDiv.style.width	= ObjImage.width + 'px';

		if (ObjImage.parentNode.style.textAlign === 'right')
		{
			objResizerDiv.style.marginLeft = 'auto';
		}

		if (ObjImage.fileSize && ObjImage.fileSize > 0)
		{
			objResizerDiv.title = ImageResizerWarningFilesize.replace('%1$s', ResizerW).replace('%2$s', ResizerH).replace('%3$s', Math.round(ObjImage.fileSize / 1024)) + "\n\r" + ImageResizerWarningSmall;
		}
		else
		{
			objResizerDiv.title = ImageResizerWarningNoFilesize.replace('%1$s', ResizerW).replace('%2$s', ResizerH) + "\n\r" + ImageResizerWarningSmall;
		}

//		var	objResizerImg				= document.createElement('img');
//			objResizerImg.src			= ImageResizerWarningImage;
//			objResizerImg.width			= 16;
//			objResizerImg.height		= 16;
//			objResizerImg.alt			= '';
//			objResizerImg.border		= 0;
//			objResizerImg.setAttribute('style', 'vertical-align:middle;');

		var objResizerSpan				= document.createElement('span');
			objResizerSpan.className	= 'resized-txt';

		var	objResizerText				= document.createTextNode('');
		if (ObjImage.width <= 250)
		{
			objResizerText.data			= ImageResizerWarningSmall;
		}
		else
		{
			objResizerText.data			= ImageResizerWarningFullsize.replace('%1$s', ResizerP).replace('%2$s', ResizerW).replace('%3$s', ResizerH); // + " " + ImageResizerWarningSmall;
		}

//		objResizerDiv.appendChild(objResizerImg);
		objResizerSpan.appendChild(objResizerText);
		objResizerDiv.appendChild(objResizerSpan);
		ObjImage.parentNode.insertBefore(objResizerDiv, ObjImage);
	}

	wrap_by_anchor(ObjImage, objResizerDiv, null);
}

/**
* Initialize the Resizer
*/
function ImgOnLoad()
{
	/**
	* phpbb images in signatures
	* class ="resize_me"
	* Recomended true - Options : false | true
	* This setting is currently mannaged in the ACP
	*/
	var include_signatures = (ImageResizerSignature === 1) ? true : false;
	/**
	* ABBC3 thumbnail
	* class="hoverbox resize_me"
	* Recomended true - Options : false | true
	*/
	var include_thumbnail_abbc3 = true;

	/**
	* phpbb thumbnail attached
	* class ="attach_parent"
	* Recomended true - Options : false | true
	*/
	var include_thumbnail_attached = true;

	/**
	* phpbb image attached
	* class="attach_me"
	* Recomended true - Options  false | true
	*/
	var include_images_attached = true;

	// Search for images in signatures
	var sig_images_ary = []; //new Array();
	var sig_elm_ary=[].slice.call(getElementsByClassName('signature', 'div')).concat([].slice.call(getElementsByClassName('postbody', 'span'))); //.concat([].slice.call(getElementsByClassName('postbody', 'div')));
	for (var e = 0, sea = sig_elm_ary.length; e < sea; e++)
	{
		if (sig_elm_ary[e].id)
		{
			var sig_img_ary = getElementsByClassName('resize_me', 'img', document.getElementById(sig_elm_ary[e].id));
			for (var i = 0, sia = sig_img_ary.length; i < sia; i++) { sig_images_ary.push(sig_img_ary[i].src); }
		}
	}
	
	// Search for images inside posts
	var posted_images_ary = MyGetElementsByClassName('resize_me|attach_me|attach_parent');

	// Start resizing images
	for (var pia = 0; pia < posted_images_ary.length; pia++)
	{
		var img = posted_images_ary[pia];

		// Unhide the image, still using its real (full) dimensions.
		//img.style.visibility = "visible";

		ImageResizerMaxWidth = ImageResizerMaxWidth_post;
		ImageResizerMaxHeight = ImageResizerMaxHeight_post;

		// Skip to resize signatures
		if (!include_signatures && sig_images_ary.length > 0)
		{
			if (contains(img.src, sig_images_ary)[0]) { continue; }
		}
		else if (include_signatures && sig_images_ary.length > 0)
		{
			if (contains(img.src, sig_images_ary)[0])
			{
				ImageResizerMaxWidth = ImageResizerMaxWidth_sig;
				ImageResizerMaxHeight = ImageResizerMaxHeight_sig;
			}
		}

		// Check if this image will not be resized
		if (
			// If thumbnail are disabled
			(img.className === 'hoverbox resize_me' && !include_thumbnail_abbc3) ||
			// If phpbb thumbnail attached are disabled
			(img.className === 'attach_parent' && !include_thumbnail_attached) ||
			// If phpbb image attached are disabled 
			(img.className === 'attach_me' && !include_images_attached) ||
			// If the image is smaller than max width and max height specified in the ACP
			((img.className === 'resize_me' || img.className === 'attach_me') && (!ImageResizerMaxWidth || ImageResizerMaxWidth > 0 && img.width <= ImageResizerMaxWidth) && (!ImageResizerMaxHeight || ImageResizerMaxHeight > 0 && img.height <= ImageResizerMaxHeight))
		)
		{
			continue;
		}

		switch (img.className)
		{
			// [thumbnail] bbcode
			case 'hoverbox resize_me':
				wrap_by_anchor(img, null, null);
			break;

			// [IMG] bbcode
			case 'resize_me':
				ImageResizerOn(img);
			break;

			// phpbb image attached
			case 'attach_me':
				ImageResizerOn(img);
			break;

			// phpbb thumbnail attached
			case 'attach_parent':
				// Disable the attachment.html onclick="viewableArea(this);"
				img.parentNode.onclick = function() { return false; };
				// Clean the image url, mostly for IE, but also works better for other browsers
				img.parentNode.href = url_clean(img.parentNode.href);
				img.parentNode.title = name_clean(img); 
				wrap_by_anchor(img, null, 'attach_parent');
			break;

			default:
			break;
		}
	}

	// Init code for any 3rd party image resizers that should be run
	switch (ImageResizerMode)
	{
		case 'prettyPhoto':
			$(function() {			
				$("a[rel^='prettyPhoto']").prettyPhoto({
					opacity: 0.60,
					show_title: false,
					deeplinking: false,
					social_tools: false,
					overlay_gallery: false,
					theme: 'pp_default' // light_rounded | dark_rounded | light_square | dark_square | facebook
				});
			});
		break;

		case 'Shadowbox':
			Shadowbox.init({
				overlayOpacity: 0.8
			});
			Shadowbox.setup('a.shadowbox-gallery', {
				gallery: 'shadowbox-gallery',
				player: 'img',
				continuous: true,
				counterType: 'skip',
				handleOversize: 'resize'
			});
		break;
	}

	return true;
}

// Install the safety net to catch any images that need to be resized
if (window.onload_functions) // prosilver
{
	onload_functions.push('ImgOnLoad()');
}
else if (typeof(window.addEventListener) !== 'undefined') // DOM
{
	window.addEventListener('load', ImgOnLoad, false);
}
else if (typeof(window.attachEvent) !== 'undefined') // MSIE
{
	window.attachEvent('onload', ImgOnLoad);
}
