/**
* Add a new value to an Array if isn't repeat
**/
function ArrayPush(arr, val) { val = url_clean(val); /** have this array this value ? **/ var found = contains(val, arr); if (!found[0]) { arr.push(val); } }

/**
* To cover IE 5.0's lack of the push method
**/
if (typeof Array.prototype.push === ' undefined') { Array.prototype.push = function(value) { this[this.length] = value; }; }

/**
* Search in the gallery array
**/
function find_in_galleryset(arr, val) { for (var row = 0; row < arr.length; ++row) { if (arr[row].url === val || arr[row].content === val) { return row + 1; } } return -1; }

/**
* Search in array
* Returns (true and number) if 'v' is contained in the array 'a'
**/
function contains(v, a) { for (var j=0; j<a.length; j++) { if (a[j] === v) { return new Array(true, j); } } return new Array(false, 0); }

/**
* Clear the image url - Start
**/
function url_clean(url)
{
//	url = decodeURIComponent(url.toString().replace(/\s/g, ' '));
	url = decodeURI(url.toString().replace(/\s/g, ' '));

	/** Is this an attached image ? if yes, need more work to clear the image url **/
	if (url.indexOf('download/') !== -1)
	{
		/** Will get the real url to the download script, Ex : http://www.mssti.com/phpbb3/download/file.php **/
		var valor   = url.substring(0, url.indexOf('?'));
		/** Will get an string starting from the id, Ex : id=65&mode=view or only id=65 **/
		var valorId1= url.substring(url.indexOf('id='));
		/** Will get only the id value, Ex : id=65 or null if have no extra params **/
		var valorId2 = valorId1.substring(valorId1.indexOf('id='), valorId1.indexOf('&'));
		/** Recreate the image url, Ex : http://www.mssti.com/phpbb3/download/file.php?id=65 **/
		url = valor + '?' + (valorId2 ? valorId2 : valorId1);
		/** MOD : kb - Start
		if (valorId1.indexOf('kb') != -1)
		{
			url += '&kb=1';
		}
		MOD : kb - End **/
	}

	return url;
}
/** Clear the image url - End **/

/**
* Clear the image name - Start
**/
function name_clean(ObjImage)
{
	var title = '';

	if (ObjImage.className.indexOf('resize_me') !== -1)
	{
		title = ObjImage.src.substring(ObjImage.src.lastIndexOf('/') + 1);
	}
	else if ( (ObjImage.className.indexOf('attach_me') !== -1) || (ObjImage.className.indexOf('attach_parent') !== -1) )
	{
		title = ObjImage.alt;
	}
	else
	{
		title = ObjImage.src;
	}
	return title;
}
/** Clear the image name - End **/

/**
* Scale the image to big size - Start
* @param obj		the image wrapper object
* @param img_obj	the image object
* @param img_src	the actual image scr
* @param new_src	the new image src
* @param img_width	the actual image width
* @param img_height	the actual image height
**/
function image_scale(obj, img_obj, img_src, new_src, img_width, img_height)
{
	var new_img = new Image();
	new_img.src = new_src;
	img_obj.src = new_src;
	if (obj !== img_obj) { obj.style.width = new_img.width + 'px'; }
	/** Let's do some extra checks **/
	var Wait_pass = 0;
	var timer = window.setInterval(function()
	{
		/** Safety end the process if can't load the image afer 120 intents (1 Minutes) **/
		Wait_pass++; if (Wait_pass >= 120) { window.clearInterval(timer); return false; }
		/** Seems that IE when create an image gives a default width to 28 **/
		if (new_img.readyState === 'complete' || new_img.complete) 
		{
			window.clearInterval(timer);
			img_obj.width = new_img.width;
			img_obj.height = new_img.height;
			img_obj.onclick = function() { return image_unscale(obj, img_obj, img_src, new_src, img_width, img_height); };
		}
	},10);
}
/** Scale the inage to big size - End **/

/**
* un Scale the inage to small size - Start
* @param obj		the image wrapper object
* @param img_obj	the image object
* @param img_src	the actual image scr
* @param new_src	the new image src
* @param img_width	the actual image width
* @param img_height	the actual image height
**/
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
/** un Scale the inage to small size - End **/

/**
* How to replace an element (HTML tag) by 100% pure DOM method
* http://my.opera.com/Ti/blog/show.dml/423621
**/
function wrap_by_anchor(ObjImage, objResizerDiv, mode)
{
	/** Add the magnifying glass cursor **/
	ObjImage.className = ObjImage.className + ' resized';

	var anchor, clone, fragment, source;
	if (mode !== 'attach_parent')
	{
		/**
		* duplicate elements
		* http://books.mozdev.org/html/mozilla-chp-5-sect-2.html#mozilla-CHP-5-SECT-2.3.8
		**/
		clone = ObjImage.cloneNode(false);
		/** **/
		source = ObjImage;
		/** New page fragment **/
		fragment = document.createDocumentFragment();
		/** New anchor **/
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

		case 'LiteBox':
			if (mode === 'attach_parent')
			{
				ObjImage.parentNode.rel = 'lightbox[lightbox_gallery]';
				return true;
			}
			else
			{
				anchor.rel = 'lightbox[lightbox_gallery]';
			}
		break;

		case 'Lightview':
			if (mode === 'attach_parent')
			{
				ObjImage.parentNode.className = ObjImage.parentNode.className + ' lightview';
				ObjImage.parentNode.rel = 'gallery[lightview_gallery]';
//				ObjImage.onclick = function () { return Lightview.show({ href: this.parentNode.href, rel: 'image', options: { width: 800, height: 600 }}); }
				return true;
			}
			else
			{
				anchor.className = (anchor.className) ? anchor.className + ' lightview' : 'lightview';
				anchor.rel = 'gallery[lightview_gallery]';
//				ObjImage.onclick = function () { return Lightview.show({ href: this.src, rel: 'image', options: { width: 800, height: 600 }}); }
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

	/** Put the image inside the anchor **/
	anchor.appendChild(clone);
	/** put anchor in page fragment **/
	fragment.appendChild(anchor);
	/** replace source with new fragment (contains a copy of source) **/
	source.parentNode.replaceChild(fragment, source);

	return true;
}

/**
* Image Resizer JS - Start 
* http://codepunk.hardwar.org.uk/css2js.htm
**/
function ImageResizerOn(ObjImage)
{
	var ResizerId = 'image_' + Math.floor(Math.random() * (100));
	var ResizerW  = ObjImage.width;
	var ResizerH  = ObjImage.height;
	var ResizerP  = 0;
	var objResizerDiv;

	/** Check the width **/
	if (ObjImage.width > ImageResizerMaxWidth && ImageResizerMaxWidth > 0 && ObjImage.width > 0)
	{
		/** Adjust the image width **/
		ObjImage.width  = ImageResizerMaxWidth;
		/** Adjust the width of the image while preserving proportions **/
		ObjImage.height = (ImageResizerMaxWidth / ResizerW) * ResizerH;
		/** Calculate the re-size ratio **/
		ResizerP = Math.ceil(parseInt(ObjImage.width / ResizerW * 100, 10));
	}

	if (ObjImage.height > ImageResizerMaxHeight && ImageResizerMaxHeight > 0 && ObjImage.height > 0)
	{
		/** Adjust the image height **/
		ObjImage.height = ImageResizerMaxHeight;
		/** Adjust the height of the image while preserving proportions **/
		ObjImage.width  = (ImageResizerMaxHeight / ResizerH) * ResizerW;
		/** Calculate the re-size ratio **/
		ResizerP = Math.ceil(parseInt(ObjImage.height / ResizerH * 100, 10));
	}

	/**
	* Use the image info bar along the top of resized images.
	* Recomended true - Options  false | true
	**/
	
	/** Use the image for click on - Start **/
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
	/** Use the image for click on - End **/
	else
	/** Adding the image top bar - Start **/
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

// 		var	objResizerImg				= document.createElement('img');
// 			objResizerImg.src			= ImageResizerWarningImage;
// 			objResizerImg.width			= 16;
// 			objResizerImg.height		= 16;
// 			objResizerImg.alt			= '';
// 			objResizerImg.border		= 0;
// 			objResizerImg.setAttribute('style', 'vertical-align:middle;');

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
	/** Adding the image top bar - End **/

	wrap_by_anchor(ObjImage, objResizerDiv, null);
}
/** Image Resizer JS - End **/

/** Initialize the Resizer **/
function ImgOnLoad()
{
	/**
	* phpbb images in signatures
	* class ="resize_me"
	* Recomended true - Options : false | true
	* This setting is currently mannaged in the ACP
	**/
	var include_signatures = (ImageResizerSignature === 1) ? true : false;
	/**
	* ABBC3 thumbnail
	* class="hoverbox resize_me"
	* Recomended true - Options : false | true
	**/
	var include_thumbnail_abbc3 = true;

	/**
	* phpbb thumbnail attached
	* class ="attach_parent"
	* Recomended true - Options : false | true
	**/
	var include_thumbnail_attached = true;

	/**
	* phpbb image attached
	* class="attach_me"
	* Recomended true - Options  false | true
	**/
	var include_images_attached = true;

/** Search images in signatures - Start **/
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
/** Now the array sig_images_ary contain all images in signatures **/
/** Search images in signatures - End **/
	
/** Search all images inside posts - Start **/
	/** Real images - Attached images - Attached thumbnail **/
	var posted_images_ary = MyGetElementsByClassName('resize_me|attach_me|attach_parent');
/** Now the array posted_images_ary contain all images in post **/
/** Search all images inside posts - End **/

/** Go ahead and to the job **/
	for (var pia = 0; pia < posted_images_ary.length; pia++)
	{
		var img = posted_images_ary[pia];

		// Unhide the image, still using its real (full) dimensions.
	//	img.style.visibility = "visible";

		ImageResizerMaxWidth = ImageResizerMaxWidth_post;
		ImageResizerMaxHeight = ImageResizerMaxHeight_post;

		/** Skip to resize signatures **/
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

		/** Check if this image will be resized - Start **/
		if (
			// If thumbnail are disabled
			(img.className === 'hoverbox resize_me' && !include_thumbnail_abbc3) ||
			// If phpbb thumbnail attached are disabled
			(img.className === 'attach_parent' && !include_thumbnail_attached) ||
			// If phpbb image attached are disabled 
			(img.className === 'attach_me' && !include_images_attached) ||
			// If the image is smaller then we specify in the ACP
			((img.className === 'resize_me' || img.className === 'attach_me') && (!ImageResizerMaxWidth || ImageResizerMaxWidth > 0 && img.width < ImageResizerMaxWidth) && (!ImageResizerMaxHeight || ImageResizerMaxHeight > 0 && img.height < ImageResizerMaxHeight))
		)
		{
			continue;
		}
		/** Check if this image will be resized - End **/

		switch (img.className)
		{
			/** [thumbnail] bbcode - Start **/
			case 'hoverbox resize_me':
				wrap_by_anchor(img, null, null);
			break;
			/** [thumbnail] bbcode - End **/

			/** [IMG] bbcode - Start **/
			case 'resize_me':
				ImageResizerOn(img);
			break;
			/** [IMG] bbcode - End **/

			/** phpbb image attached - Start **/
			case 'attach_me':
				ImageResizerOn(img);
			break;
			/** phpbb image attached - End **/

			/** phpbb thumbnail attached - Start **/
			case 'attach_parent':
				/** Disable the attachment.html onclick="viewableArea(this);" **/
				img.parentNode.onclick = function() { return false; };

				/** Clear the image url, mostly for IE, but also works better for other browsers **/
				img.parentNode.href = url_clean(img.parentNode.href);
				img.parentNode.title = name_clean(img); 
				wrap_by_anchor(img, null, 'attach_parent');
			break;
			/** phpbb thumbnail attached - End **/

			default:
			break;
		}
	}

	if (ImageResizerMode === 'Shadowbox')
	{
		Shadowbox.init({
			// a darker overlay looks better on this particular site
			overlayOpacity: 0.8
		});
		Shadowbox.setup('a.shadowbox-gallery', {
			gallery: 'shadowbox-gallery',
			player: 'img',
			continuous: true,
			counterType: 'skip',
			handleOversize: 'resize'
		});
	}
//	if (ImageResizerMode == 'Lightview') { Lightview.load(); Lightview.start.bind(Lightview); }

	return true;
}

/** Install the safety net to catch any images that needs to be resized - START **/
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
/** Install the safety net to catch any images that needs to be resized - END **/
