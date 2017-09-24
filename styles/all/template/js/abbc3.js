/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

// global scope vars
var requestRunning = false;
var bbwizard;

(function($) { // Avoid conflicts with other libraries

	'use strict';

	/**
	 * BBvideo function
	 */
	$.fn.bbvideo = function(options) {

		var settings = $.extend({
			width: 560,
			height: 315
		}, options);

		var bbvideos = [{
				'site': '5min.com',
				'type': 'flash',
				'regex': /http:\/\/(?:.*)?5min.com\/Video\/(?:.*)-([0-9]+)/i,
				'embed': ['http://embed.5min.com/$1/']
			}, {
				'site': 'allocine.fr',
				'regex': /http:\/\/www.allocine.fr\/video\/player_gen_cmedia=(\d+)?([^[]*)?/i,
				'embed': '<iframe src="http://www.allocine.fr/_video/iblogvision.aspx?cmedia=$1" style="width:{WIDTH}px; height:{HEIGHT}px" frameborder="0"></iframe>'
			}, {
				'site': 'on.aol.com',
				'type': 'yqlOgp',
				'regex': /http:\/\/on.aol.com\/video\/(?:.*)-([0-9]+)/i
			}, {
				'site': 'break.com',
				'regex': /http:\/\/(.*?)break.com\/([^[]*)?-([0-9]+)?([^[]*)?/i,
				'embed': '<iframe src="http://www.break.com/embed/$3?embed=1" width="{WIDTH}" height="{HEIGHT}" webkitallowfullscreen mozallowfullscreen allowfullscreen frameborder="0"></iframe>'
			}, {
				'site': 'clipfish.de',
				'type': 'flash',
				'regex': /http:\/\/www.clipfish.de\/(.*\/)?video\/([0-9]+)([^[]*)?/i,
				'embed': ['http://www.clipfish.de/cfng/flash/clipfish_player_3.swf?as=0&amp;vid=$2']
			}, {
				'site': 'clipmoon.com',
				'type': 'flash',
				'regex': /http:\/\/www.clipmoon.com\/(.*?)\/(([0-9A-Za-z-_]+)([0-9A-Za-z-_]{2}))\/([^[]*)/i,
				'embed': ['http://www.clipmoon.com/flvplayer.swf?config=http://www.clipmoon.com/flvplayer.php?viewkey=$2&amp;external=yes&amp;vimg=http://www.clipmoon.com/thumb/$3.jpg']
			}, {
				'site': 'cnbc.com',
				'regex': /http:\/\/.*\.cnbc.com\/[^?]+\?video=(\d+)?([^[]+)?/i,
				'embed': '<iframe src="http://player.theplatform.com/p/gZWlPC/vcps_inline?byGuid=$1&size={WIDTH}_{HEIGHT}" width="{WIDTH}" height="{HEIGHT}" type="application/x-shockwave-flash" allowFullScreen="true"></iframe>'
			}, {
				'site': 'cnet.com',
				'regex': /http:\/\/([\w]+\.)?cnet\.com\/(videos\/)?([^(\.|\/)]*)([^[]*)?/i,
				'embed': '<iframe src="http://www.cnet.com/videos/share/$3/" width="{WIDTH}" height="{HEIGHT}" frameborder="0" seamless="seamless" allowfullscreen></iframe>'
			}, {
				'site': 'colbertnation.com',
				'regex': /http:\/\/(?:.*?)colbertnation.com\/the-colbert-report-videos\/([0-9]+)\/([^[]*)?/i,
				'embed': '<iframe src="http://media.mtvnservices.com/embed/mgid:cms:video:colbertnation.com:$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>'
			}, {
				'site': 'collegehumor.com',
				'regex': /http:\/\/www.collegehumor.com\/video\/([0-9]+)\/([^[]*)/i,
				'embed': '<iframe src="http://www.collegehumor.com/e/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'
			}, {
				'site': 'comedycentral.com',
				'type': 'yqlOgp',
				'regex': /http:\/\/(?:.*?)comedycentral.com\/video-clips\/([^[]*)?/i
			}, {
				'site': 'crackle.com',
				'type': 'flash',
				'regex': /http:\/\/((.*?)?)crackle.com\/(.*?)\/(.*?)\/(.*?)\/([0-9]+)?([^[]*)?/i,
				'embed': ['http://www.crackle.com/p/$4/$5.swf', 'id=$6&amp;mu=0&amp;ap=0']
			}, {
				'site': 'dailymotion.com',
				'regex': /https?:\/\/(?:.*?)dailymotion.com(?:.*?)\/video\/(([^[_]*)?([^[]*)?)?/i,
				'embed': '<iframe frameborder="0" width="{WIDTH}" height="{HEIGHT}" src="//www.dailymotion.com/embed/video/$2"></iframe>'
			}, {
				'site': 'dotsub.com',
				'regex': /http:\/\/dotsub.com\/view\/(.*)/i,
				'embed': '<iframe src="http://dotsub.com/media/$1/embed/" frameborder="0" width="{WIDTH}" height="{HEIGHT}"></iframe>'
			}, {
				'site': 'ebaumsworld.com',
				'regex': /http:\/\/(.*?)ebaumsworld.com\/video\/watch\/(.*?)\//i,
				'embed': '<iframe src="http://www.ebaumsworld.com/media/embed/$2" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>'
			}, {
				'site': 'facebook.com',
				'regex': /https?:\/\/www.facebook.com\/(?:.*)(?:(?:video|photo).php\?v=|(?:videos|photos)\/)([0-9A-Za-z-_]+)(?:[^[]*)?/i,
				'embed': '<iframe src="https://www.facebook.com/video/embed?video_id=$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>'
			}, {
				'site': 'flickr.com',
				'type': 'oembed',
				'regex': /https?:\/\/((.*?)?)flickr.com\/(.*?)\/(.*?)\/([0-9]+)([^[]*)?/i,
				'embed': '//flickr.com/services/oembed/?url=$&&format=json&jsoncallback=?'
			}, {
				'site': 'funnyordie.com',
				'regex': /http:\/\/(?:.*?)funnyordie.com\/(.*?)\/(.*?)\/(?:[^[]*)?/i,
				'embed': '<iframe src="http://www.funnyordie.com/embed/$2" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>'
			}, {
				'site': 'g4tv.com',
				'type': 'flash',
				'regex': /http:\/\/(?:www\.)?g4tv.com\/(.*?videos)\/([0-9]+)\/([^[]*)?/i,
				'embed': ['http://www.g4tv.com/lv3/$2']
			}, {
				'site': 'gameprotv.com',
				'type': 'flash',
				'regex': /http:\/\/www.gameprotv.com\/(.*)-video-([0-9]+)?.([^[]*)?/i,
				'embed': ['http://www.gameprotv.com/player-viral.swf', 'file=http%3A%2F%2Fvideos.gameprotv.com%2Fvideos%2F$2.flv&amp;linktarget=_self&amp;image=http%3A%2F%2Fvideos.gameprotv.com%2Fvideos%2F$2.jpg&amp;plugins=adtonomy,viral-1']
			}, {
				'site': 'gamespot.com',
				'regex': /http:\/\/www.gamespot.com\/videos\/.*\/\d+\-(\d+)\/([^[]*)?/i,
				'embed': '<iframe src="http://www.gamespot.com/videos/embed/$1/" width="{WIDTH}" height="{HEIGHT}" scrolling="no" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
			}, {
				'site': 'howcast.com',
				'type': 'flash',
				'regex': /http:\/\/(.*?)howcast.com\/videos\/([0-9]+)?-([^[]*)?/i,
				'embed': ['http://www.howcast.com/flash/howcast_player.swf?file=$2']
			}, {
				'site': 'hulu.com',
				'type': 'oembed',
				'regex': /https?:\/\/(.*?)hulu.com\/([^[]*)?/i,
				'embed': '//www.hulu.com/api/oembed?url=$&&format=json'
			}, {
				'site': 'ign.com',
				'regex': /http:\/\/(.*?)ign\.com\/videos\/([0-9]+)\/([0-9]+)\/([0-9]+)\/([^?]*)?([^[]*)?/i,
				'embed': '<iframe src="http://widgets.ign.com/video/embed/content.html?url=$&" width="{WIDTH}" height="{HEIGHT}" scrolling="no" frameborder="0" allowfullscreen></iframe>'
			}, {
				'site': 'instagram.com',
				'regex': /https?:\/\/.*?instagram.com\/p\/(.*)\/([^[]*)?/i,
				'embed': '<iframe src="//instagram.com/p/$1/embed/" width="612" height="710" frameborder="0" scrolling="no" allowtransparency="true"></iframe>'
			}, {
				'site': 'kickstarter.com',
				'regex': /https?:\/\/.*?kickstarter.com\/projects\/(.*)\/([^[]*)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="https://www.kickstarter.com/projects/$1/$2/widget/video.html" frameborder="0" scrolling="no"></iframe>'
			}, {
				'site': 'liveleak.com',
				'regex': /http:\/\/www.liveleak.com\/view\?i=([0-9A-Za-z-_]+)?(&[^\/]+)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://www.liveleak.com/ll_embed?f=$1" frameborder="0" allowfullscreen></iframe>'
			}, {
				'site': 'maker.tv',
				'regex': /http:\/\/(.*?)maker.tv\/([^[]*)?video\/([^\/]+)?\/([^[]*)?/i,
				'embed': '<iframe src="http://makerplayer.com/embed/maker/$3" width="{WIDTH}" height="{HEIGHT}" frameborder="0" allowfullscreen seamless scrolling="no"></iframe>'
			}, {
				'site': 'metacafe.com',
				'regex': /http:\/\/www.metacafe.com\/watch\/([0-9]+)?((\/[^\/]+)\/?)?/i,
				'embed': '<iframe src="http://www.metacafe.com/embed/$1/" width="{WIDTH}" height="{HEIGHT}" allowFullScreen frameborder=0></iframe>'
			}, {
				'site': 'moddb.com',
				'type': 'yqlOgp',
				'regex': /http:\/\/www.moddb.com\/([^[]*)?/i
			}, {
				'site': 'mpora.com',
				'regex': /http:\/\/(?:.*?)mpora.com\/(?:.*?)\/([^\/]+)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://mpora.com/videos/$1/embed" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
			}, {
				'site': 'msnbc.msn.com',
				'type': 'flash',
				'regex': /http:\/\/www.msnbc.msn.com\/id\/(\d+)?\/vp\/(\d+)?#(\d+)?([^[]*)?/i,
				'embed': ['http://www.msnbc.msn.com/id/32545640', 'launch=$3&amp;width={WIDTH}&amp;height={HEIGHT}']
			}, {
				'site': 'myspace.com',
				'regex': /https?:\/\/(www.)?myspace.com\/.*\/video\/(.*)\/([0-9]+)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="//media.myspace.com/play/video/$2-$3-$3" frameborder="0" allowtransparency="true" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
			}, {
				'site': 'myvideo.de',
				'regex': /http:\/\/(.*?).myvideo.(.*?)\/(.*?)\/([^[]*)?/i,
				'embed': '<iframe src="http://$1.myvideo.$2/embed/$4" style="width:{WIDTH}px;height:{HEIGHT}px;border:0 none;padding:0;margin:0;" width="{WIDTH}" height="{HEIGHT}" frameborder="0" scrolling="no"></iframe>'
			}, {
				'site': 'nbcnews.com',
				'type': 'flash',
				'regex': /http:\/\/www.nbcnews.com\/video\/.+?\/(\d+)\/#?(\d+)?/i,
				'embed': ['http://www.msnbc.msn.com/id/32545640', 'launch=$1&amp;width={WIDTH}&amp;height={HEIGHT}']
			}, {
				'site': 'photobucket.com',
				'type': 'flash',
				'regex': /http:\/\/[a-z](.*?).photobucket.com\/(albums\/[^[]*\/([0-9A-Za-z-_ ]*)?)?([^[]*=)+?([^[]*)?/i,
				'embed': ['http://static.photobucket.com/player.swf?file=http://vid$1.photobucket.com/$2$5']
			}, {
				'site': 'revision3.com',
				'type': 'yqlOembed',
				'regex': /http:\/\/(.*revision3\.com\/.*)/i,
				'embed': 'http://revision3.com/api/oembed/?url=$&&format=json'
			}, {
				'site': 'rutube.ru',
				'type': 'yqlOembed',
				'regex': /http:\/\/rutube.ru\/(.*?)\/([^[]*)?/i,
				'embed': 'http://rutube.ru/api/oembed/?url=$&&format=json'
			}, {
				'site': 'sapo.pt',
				'regex': /http:\/\/(.*?)sapo.pt\/(.*\/)?([^[]*)?/i,
				'embed': '<iframe src="http://videos.sapo.pt/playhtml?file=http://rd3.videos.sapo.pt/$3/mov/1" frameborder="0" scrolling="no" width="{WIDTH}" height="{HEIGHT}"></iframe>'
			}, {
				'site': 'screenr.com',
				'regex': /http:\/\/(?:.*?)\.screenr.com\/([^[]*)?/i,
				'embed': '<iframe src="http://www.screenr.com/embed/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>'
			}, {
				'site': 'scribd.com',
				'regex': /https?:\/\/(?:www\.)?scribd\.com\/(mobile\/documents|doc)\/(.*?)\/([^[]*)?/i,
				'embed': '<iframe class="scribd_iframe_embed" src="//www.scribd.com/embeds/$2/content?start_page=1&view_mode=scroll" data-auto-height="false" data-aspect-ratio="undefined" scrolling="no" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>'
			}, {
				'site': 'slideshare.net',
				'type': 'oembed',
				'regex': /https?:\/\/www.slideshare.net\/(.*?)\/([^[]*)?/i,
				'embed': '//www.slideshare.net/api/oembed/2?url=$&&format=json'
			}, {
				'site': 'snotr.com',
				'regex': /http:\/\/(?:.*?)snotr.com\/video\/([0-9]+)\/.*/i,
				'embed': '<iframe src="http://www.snotr.com/embed/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0"></iframe>'
			}, {
				'site': 'spike.com',
				'type': 'yqlOgp',
				'regex': /http:\/\/www.spike.com\/([^[]*)?/i
			}, {
				'site': 'streetfire.net',
				'type': 'yqlOgp',
				'regex': /http:\/\/(.*?)streetfire.net\/video\/([^[]*)?/i
			}, {
				'site': 'ted.com',
				'regex': /https?:\/\/.*?ted.com\/talks\/([a-zA-Z0-9-_]+).html/i,
				'embed': '<iframe src="//embed.ted.com/talks/$1.html" width="{WIDTH}" height="{HEIGHT}" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
			}, {
				'site': 'testtube.com',
				'type': 'yqlOembed',
				'regex': /http:\/\/(.*testtube\.com\/.*)/i,
				'embed': 'http://testtube.com/api/oembed/?url=$&&format=json'
			}, {
				'site': 'thedailyshow.cc.com',
				'type': 'yqlOgp',
				'regex': /http:\/\/(?:.*?)thedailyshow.cc.com\/videos\/([^[]*)?/i
			}, {
				'site': 'theonion.com',
				'regex': /http:\/\/((.*?)?)theonion.com\/([^,]+),([0-9]+)([^[]*)?/i,
				'embed': '<iframe frameborder="no" width="{WIDTH}" height="{HEIGHT}" scrolling="no" src="http://www.theonion.com/video_embed/?id=$4"></iframe>'
			}, {
				'site': 'tu.tv',
				'type': 'yqlOembed',
				'regex': /http:\/\/(.*?)tu.tv\/videos\/([^[]*)?/i,
				'embed': 'http://tu.tv/oembed/?url=$&&format=json'
			}, {
				'site': 'tudou.com',
				'regex': /http:\/\/.*?tudou.com\/programs\/view\/(.+)\//i,
				'embed': '<iframe src="http://www.tudou.com/programs/view/html5embed.action?code=$1&resourceId=0_06_05_99" allowtransparency="true" scrolling="no" frameborder="0" style="width:{WIDTH}px;height:{HEIGHT}px;"></iframe>'
			}, {
				'site': 'twitch.tv',
				'regex': /http:\/\/(.*?)twitch.tv\/([^[]*)?/i,
				'embed': '<iframe src="http://www.twitch.tv/$2/embed" frameborder="0" scrolling="no" height="{HEIGHT}" width="{WIDTH}"></iframe>'
			}, {
				'site': 'ustream.tv',
				'regex': /http:\/\/(?:www\.)ustream\.tv\/(?:channel\/([0-9]{1,8}))/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://www.ustream.tv/embed/$1" scrolling="no" frameborder="0" style="border: 0 none transparent;"></iframe>'
			}, {
				'site': 'vbox7.com',
				'regex': /http:\/\/(?:.*?)vbox7.com\/play:([^[]+)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://vbox7.com/emb/external.php?vid=$1" frameborder="0" allowfullscreen></iframe>'
			}, {
				'site': 'veoh.com',
				'type': 'flash',
				'regex': /http:\/\/(.*?).veoh.com\/([0-9A-Za-z-_\/]+)?\/([0-9A-Za-z-_]+)/i,
				'embed': ['http://www.veoh.com/swf/webplayer/WebPlayer.swf?version=AFrontend.5.7.0.1361&amp;permalinkId=$3&amp;player=videodetailsembedded&amp;videoAutoPlay=0&amp;id=anonymous']
			}, {
				'site': 'vevo.com',
				'regex': /http:\/\/(?:www\.)?vevo\.com\/watch\/([^?]*)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://cache.vevo.com/m/html/embed.html?video=$1" frameborder="0" allowfullscreen></iframe>'
			}, {
				'site': 'viddler.com',
				'regex': /http:\/\/(?:.*?).viddler.com\/v\/([0-9A-Za-z-_]+)([^[]*)?/i,
				'embed': '<iframe id="viddler-$1" src="//www.viddler.com/embed/$1/?f=1&autoplay=0&player=full&loop=false&nologo=false&hd=false" width="{WIDTH}" height="{HEIGHT}" frameborder="0" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>'
			}, {
				'site': 'videogamer.com',
				'type': 'yqlOgp',
				'regex': /http:\/\/www.videogamer.com\/([^[]*)?/i
			}, {
				'site': 'vimeo.com',
				'regex': /https?:\/\/(?:.*?)vimeo.com(?:\/groups\/(?:.*)\/videos\/|\/)([^[]*)?/i,
				'embed': '<iframe src="//player.vimeo.com/video/$1" width="{WIDTH}" height="{HEIGHT}" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
			}, {
				'site': 'vine.co',
				'regex': /https:\/\/vine\.co\/v\/([a-zA-Z0-9]{1,13})/i,
				'embed': '<iframe class="vine-embed" src="https://vine.co/v/$1/embed/simple" width="480" height="480" frameborder="0"></iframe>'
			}, {
				'site': 'screen.yahoo.com',
				'regex': /http:\/\/screen.yahoo.com\/((([^-]+)?-)*)([0-9]+).html/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" scrolling="no" frameborder="0" src="$&?format=embed&player_autoplay=false"></iframe>'
			}, {
				'site': 'youku.com',
				'regex': /http:\/\/v.youku.com\/v_show\/id_(.*)\.html.*/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="http://player.youku.com/embed/$1" frameborder=0 allowfullscreen></iframe>'
			}, {
				'site': 'youtu.be',
				'regex': /https?:\/\/(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)([^[]*)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>'
			}, {
				'site': 'youtube.com',
				'regex': /https?:\/\/(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube\.com\S*[^\w\-\s])([\w\-]{11})(?=[^\w\-]|$)([^[]*)?/i,
				'embed': '<iframe width="{WIDTH}" height="{HEIGHT}" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>'
			}];

		/**
		 * Perform an oEmbed request for an embed code
		 */
		function oembedRequest(el, url, dimensions) {
			$.getJSON(url + '&callback=?', function(data) {
				embedWrapper(el, fixDimensions(data.html, dimensions));
			});
		}

		/**
		 * Perform a YQL request for an embed code via OGP or oEmbed
		 */
		function yqlRequest(el, url, regex, dimensions, type) {
			if (url.match(regex)) {
				var from = (type === 'yqlOembed') ? 'json' : 'html';
				var path = (type === 'yqlOembed') ? 'itemPath="/"' : 'xpath="//meta" and compat="html5"';
				$.ajax({
					url: '//query.yahooapis.com/v1/public/yql',
					dataType: 'jsonp',
					data: {
						q: 'select * from ' + from + ' where url="' + url + '" and ' + path,
						format: 'json',
						env: 'store://datatables.org/alltableswithkeys',
						callback: '?'
					},
					success: function(data) {
						var embedCode = '';
						if (data.query.results !== null) {
							if (type === 'yqlOembed') {
								// oEmbed
								embedCode = fixDimensions(data.query.results.json.html, dimensions);
							} else {
								// Open Graph Protocol
								var meta = {};
								for (var i = 0, l = data.query.results.meta.length; i < l; i++) {
									var name = data.query.results.meta[i].name || data.query.results.meta[i].property || null;
									if (name === null) {
										continue;
									}
									meta[name] = data.query.results.meta[i].content;
								}

								var videoUrl = meta['og:video'] || meta['og:video:url'];
								if (videoUrl) {
									embedCode = $('<embed />')
										.attr('src', videoUrl.replace('https:', ''))
										.attr('type', meta['og:video:type'] || 'application/x-shockwave-flash')
										.attr('width', dimensions.width || meta['og:video:width'])
										.attr('height', dimensions.height || meta['og:video:height'])
										.attr('allowfullscreen', 'true')
										.attr('autostart', 'false');
								}
							}
						}
						embedWrapper(el, embedCode);
					}
				});
			}
		}

		/**
		 * Construct and return a flash object embed code
		 */
		function flashCode(url, flashVars, dimensions) {
			return '<object width="' + dimensions.width + '" height="' + dimensions.height + '" type="application/x-shockwave-flash" data="' + url + '">' +
				'<param name="movie" value="' + url + '" />' +
				(flashVars !== undefined ? '<param name="flashvars" value="' + flashVars.replace(/&/g, '&amp;').replace(/\{WIDTH}/g, dimensions.width).replace(/\{HEIGHT}/g, dimensions.height) + '" />' : '') +
				'<param name="quality" value="high" />' +
				'<param name="allowFullScreen" value="true" />' +
				'<param name="allowScriptAccess" value="always" />' +
				'<param name="pluginspage" value="http://www.macromedia.com/go/getflashplayer" />' +
				'<param name="autoplay" value="false" />' +
				'<param name="autostart" value="false" />' +
				'<param name="wmode" value="transparent" />' +
				'</object>';
		}

		/**
		 * Insert embed code, after the URL, wrapped in a div tag
		 */
		function embedWrapper(el, content) {
			if (el.attr('href') !== content) {
				el.after(content).wrap('<div />');
			}
		}

		/**
		 * Replace height and width dimensions inside an HTML string
		 */
		function fixDimensions(html, dimensions) {
			// In rare case where no width param exists, add them
			if (/width=["']/.test(html) === false) {
				return html.replace(/(\/?>)/, ' width="' + dimensions.width + '" height="' + dimensions.height + '"$1');
			}
			// More typical, replace any width and height with our dimensions
			return html.replace(/width=(['"])[0-9]{1,4}\1/gi, 'width="' + dimensions.width + '"').replace(/height=(['"])[0-9]{1,4}\1/gi, 'height="' + dimensions.height + '"');
		}

		return this.each(function() {
			var el = $(this),
				url = el.attr('href'),
				dimensions = {
					width: settings.width,
					height: settings.height
				};

			// Set bbvideo width and height data
			if (el.data('bbvideo') !== undefined && el.data('bbvideo').length) {
				dimensions.width = el.data('bbvideo').split(',')[0].trim() || settings.width;
				dimensions.height = el.data('bbvideo').split(',')[1].trim() || settings.height;
			}

			// Set width and height based on responsive layout
			var container = el.closest('div');
			var aspectRatio = dimensions.height / dimensions.width;
			if (container.length > 0 && aspectRatio !== 0 && container.width() < dimensions.width) {
				dimensions.width = container.width();
				dimensions.height = dimensions.width * aspectRatio;
			}

			for (var i = 0, l = bbvideos.length; i < l; i++) {
				var regExp = new RegExp(bbvideos[i].site + '/', 'i');
				if (regExp.test(url)) {
					switch (bbvideos[i].type) {
						case 'flash':
							embedWrapper(el, url.replace(bbvideos[i].regex, flashCode(bbvideos[i].embed[0], bbvideos[i].embed[1], dimensions)));
							break;

						case 'yqlOgp':
							yqlRequest(el, url, bbvideos[i].regex, dimensions, bbvideos[i].type);
							break;

						case 'yqlOembed':
							yqlRequest(el, url.replace(bbvideos[i].regex, bbvideos[i].embed), bbvideos[i].regex, dimensions, bbvideos[i].type);
							break;

						case 'oembed':
							oembedRequest(el, url.replace(bbvideos[i].regex, bbvideos[i].embed), dimensions);
							break;

						default:
							embedWrapper(el, url.replace(bbvideos[i].regex, bbvideos[i].embed.replace(/\{WIDTH}/g, dimensions.width).replace(/\{HEIGHT}/g, dimensions.height)));
							break;
					}
					break;
				}
			}
		});
	};

	/**
	 * Show the bbcode wizard (scope must be global)
	 */
	bbwizard = function(href, bbcode) {
		if (!requestRunning) {
			var wizard = $('#bbcode_wizard');
			if (!wizard.is(':visible')) {
				requestRunning = true;
				$.ajax({
					url: href,
					dataType: 'html',
					beforeSend: function() {
						// Clear the bbwizard div
						wizard.hide().empty();
					},
					success: function(data) {
						// Append the new html to the bbwizard div and show it
						wizard.append(data).fadeIn('fast');
					},
					error: function() {
						// On AJAX error, revert to default bbcode application
						switch (bbcode) {
							case 'bbvideo':
								bbfontstyle('[BBvideo=560,315]', '[/BBvideo]');
								break;
							default:
								bbfontstyle('[' + bbcode + ']', '[/' + bbcode + ']');
								break;
						}
					},
					complete: function() {
						requestRunning = false;
					}
				});
			}
		}
	};

	/**
	 * Insert BBCode into message (position cursor after insertion)
	 */
	var bbinsert = function(bbopen, bbclose) {
		var textarea;

		if (is_ie) {
			textarea = document.forms[form_name].elements[text_name];
			textarea.focus();
			baseHeight = document.selection.createRange().duplicate().boundingHeight;
		}

		//initInsertions();
		insert_text(bbopen + bbclose);

		// The new position for the cursor after adding the bbcode
		if (is_ie) {
			var text = bbopen + bbclose;
			var pos = textarea.innerHTML.indexOf(text);
			if (pos > 0) {
				var new_pos = pos + text.length;
				var range = textarea.createTextRange();
				range.move('character', new_pos);
				range.select();
				storeCaret(textarea);
				textarea.focus();
			}
		}
	};

	/**
	 * DOM READY
	 */
	$(document).ready(function() {

		var body = $('body');

		/**
		 * Attach bbvideo listener
		 */
		$('.bbvideo').bbvideo();

		/**
		 * Function spoiler toggle
		 */
		body.on('click', '.spoilbtn', function(event) {
			event.preventDefault();
			var trigger = $(this),
				spoiler = trigger.closest('div').next('.spoilcontent');
			spoiler.slideToggle('fast', function() {
				trigger.text(spoiler.is(':visible') ? trigger.data('hide') : trigger.data('show'));
			});
		});

		/**
		 * BBCode Wizard listener events
		 */
		var wizard = $('#bbcode_wizard');
		// Click on body to dismiss bbcode wizard
		body.on('click', function() {
			wizard.fadeOut('fast');
		});
		wizard
			// Click on bbcode wizard submit button to apply bbcode to message
			.on('click', '#bbcode_wizard_submit', function(event) {
				event.preventDefault();
				var bbcode = $(this).data('bbcode');
				switch (bbcode) {
					case 'url':
						var link = $('#bbcode_wizard_link').val(),
							description = $('#bbcode_wizard_description').val();
						bbinsert('[' + bbcode + ((description.length) ? '=' + link : '') + ']' + ((description.length) ? description : link) + '', '[/' + bbcode + ']');
						break;
					case 'bbvideo':
						bbinsert('[BBvideo=' + $('#bbvideo_wizard_width').val() + ',' + $('#bbvideo_wizard_height').val() + ']' + $('#bbvideo_wizard_link').val() + '', '[/BBvideo]');
						break;
				}
				wizard.fadeOut('fast');
			})
			// Click on bbcode wizard cancel button to dismiss bbcode wizard
			.on('click', '#bbcode_wizard_cancel', function(event) {
				event.preventDefault();
				wizard.fadeOut('fast');
			})
			// Change bbvideo allowed sites option updates bbvideo example
			.on('change', '#bbvideo_wizard_sites', function() {
				$('#bbvideo_wizard_example').val($(this).val());
			})
			// Change bbvideo size presets updates bbvideo height and width
			.on('change', '#bbvideo_wizard_size_presets', function() {
				if ($(this).val().length !== 0) {
					var dims = $(this).val().split(',');
					$('#bbvideo_wizard_width').val(dims[0]);
					$('#bbvideo_wizard_height').val(dims[1]);
				}
			})
			// Prevent clicks on bbcode wizard from bubbling up
			// to the body and prematurely dismissing itself
			.click(function(event) {
				event.stopPropagation();
			});

	});

})(jQuery); // Avoid conflicts with other libraries
