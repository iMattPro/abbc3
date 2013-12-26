<?php
/**
*
* @package Advanced BBCode Box 3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\controller;

class wizard
{
	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper    $helper      Controller helper object
	* @param \phpbb\request\request      $request     Request object
	* @param \phpbb\template\template    $template    Template object
	* @param \phpbb\user                 $user        User object
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->helper = $helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* BBCode wizard controller accessed with the URL /wizard/bbcode/{mode}
	* (where {mode} is the placeholder for a string of the bbcode name)
	* intended to be accessed via AJAX only
	*
	* @param strng	$mode		Mode taken from the URL 
	* @return Symfony\Component\HttpFoundation\Response A Symfony Response object
	* @access public
	*/
	public function bbcode_wizard($mode)
	{
		if (!$this->request->is_ajax())
		{
			return $this->helper->error($this->user->lang['GENERAL_ERROR']);
		}

		switch ($mode)
		{
			case 'bbvideo':

				// Construct BBVideo allowed site select options
				$select_options = '';
				$bbvideo_selected = 'youtube.com';
				$bbvideo_sites_array = $this->bbvideo_sites();
				foreach($bbvideo_sites_array as $site => $example)
				{
					$select_options .= '<option value="' . $example . '"' . (($site == $bbvideo_selected) ? ' selected="selected"' : '') . '>' . $site . '</option>';
				}

				// Construct BBVideo size preset select options
				$size_preset_options = '';
				$bbvideo_size_presets_array = $this->bbvideo_size_presets();
				foreach($bbvideo_size_presets_array as $preset)
				{
					$size_preset_options .= '<option value="' . str_replace(' ', '', $preset) . '">' . $preset . '</option>';
				}

				$this->template->assign_vars(array(
					'S_ABBC3_BBVIDEO_SITES'	=> $select_options,
					'S_ABBC3_BBVIDEO_SIZES'	=> $size_preset_options,
					'ABBC3_BBVIDEO_LINK_EX'	=> $bbvideo_sites_array[$bbvideo_selected],
				));

				return $this->helper->render('bbcode_wizard.html');

			break;

			default:

				return $this->helper->error($this->user->lang['GENERAL_ERROR']);

			break;
		}
	}
	
	/**
	* Return an array of allowed BBvideo sites and example URLs
	*
	* @return array Allowed BBvideo sites and URLs
	* @access private
	*/
	private function bbvideo_sites()
	{
		return array(
			'5min.com' => 'http://www.5min.com/Video/iPad-to-Embrace-New-Name-517297508',
			'allocine.fr' => 'http://www.allocine.fr/video/player_gen_cmedia=19149857&cfilm=126693.html',
			'blip.tv' => 'http://blip.tv/disenchanted/disenchanted-ep-101-once-upon-a-crackhouse-6063266',
			'break.com' => 'http://www.break.com/index/wakeboarding-boss-level-2315925',
			'clipfish.de' => 'http://www.clipfish.de/video/1856437/ac-dc-tnt/',
			'clipmoon.com' => 'http://www.clipmoon.com/videos/9194d9/animation-versus-animator.html',
			'cnbc.com' => 'http://video.cnbc.com/gallery/?video=1548022077&play=1',
			'cnettv.cnet.com' => 'http://cnettv.cnet.com/kinect-controlled-motorized-skateboard/9742-1_53-50118306.html',
			'colbertnation.com' => 'http://www.colbertnation.com/the-colbert-report-videos/180900/october-17-2005/intro---10-17-05',
			'collegehumor.com' => 'http://www.collegehumor.com/video/6747386/skyrim-hoarders',
			'comedycentral.com' => 'http://www.comedycentral.com/video-clips/l56fcp/futurama-trashy-robo-sluts',
			'crackle.com' => 'http://www.crackle.com/c/The_Walking_Dead/TS-19/2483060/',
			'dailymotion.com' => 'http://www.dailymotion.com/video/x4ez1x_alberto-contra-el-heliocentrismo_sport',
			'dotsub.com' => 'http://dotsub.com/view/6a7db231-4d64-407d-8026-a845eaf6c4a9',
			'ebaumsworld.com' => 'http://www.ebaumsworld.com/video/watch/82424906/',
			'facebook.com' => 'https://www.facebook.com/photo.php?v=2031763147233',
			'flickr.com' => 'http://www.flickr.com/photos/chrismar/3071009125',
			'funnyordie.com' => 'http://www.funnyordie.com/videos/5ef1adb57b/between-two-ferns-with-zach-galifianakis',
			'g4tv.com' => 'http://g4tv.com/videos/29265/Infamous-All-Access/',
			'gameprotv.com' => 'http://www.gameprotv.com/socom-4-us-navy-seals-trailer-video-6923.html',
			'gamespot.com' => 'http://www.gamespot.com/video/928334/6185856/lost-odyssey-official-trailer-8',
			'gametrailers.com' => 'http://www.gametrailers.com/videos/j3gx9q/facebreaker-world-premiere-exclusive-debut',
			'gamevideos.1up.com' => 'http://gamevideos.1up.com/video/id/17766',
			'godtube.com' => 'http://www.godtube.com/watch/?v=9JJBE1NU',
			'howcast.com' => 'http://www.howcast.com/videos/499089-How-to-Draw-Manga-How-to-Draw-Monsters',
			'hulu.com' => 'http://www.hulu.com/watch/308687/the-office-dwight-vs-jim-prank-tacular',
			'ign.com' => 'http://www.ign.com/videos/2012/04/05/double-dragon-neon-gameplay-trailer',
			'liveleak.com' => 'http://www.liveleak.com/view?i=166_1194290849',
			'metacafe.com' => 'http://www.metacafe.com/watch/966360/merry_christmas_with_crazy_frog/',
			'moddb.com' => 'http://www.moddb.com/groups/humour-satire-parody/videos/flight-dc132-part-1',
			'mpora.com' => 'http://mpora.com/videos/AAdihftgw4t7',
			'msnbc.msn.com' => 'http://www.msnbc.msn.com/id/21134540/vp/41172078#41190910',
			'myspace.com' => 'https://myspace.com/jasonmraz/video/-quot-lucky-quot-official-video-with-colbie-caillat/49776296',
			'myvideo.de' => 'http://www.myvideo.de/watch/2668372',
			'nbcnews.com' => 'http://www.nbcnews.com/video/nbc-news/53875621/#53875621',
			'on.aol.com' => 'http://on.aol.com/video/ipad-to-embrace-new-name-517297508',
			'photobucket.com' => 'http://s0006.photobucket.com/albums/0006/pbhomepage/Ice%20Age/?action=view&current=TFEIT301100-H264_Oct27.mp4',
			'rutube.ru' => 'http://rutube.ru/video/238973b0c167d0a9f4f26686e42407e4/',
			'sapo.pt' => 'http://videos.sapo.pt/LguPabwSWikK0wzBmU1o',
			'screenr.com' => 'http://www.screenr.com/fTK',
			'scribd.com' => 'http://www.scribd.com/doc/26886617/Dexter-Investigating-Cutting-Edge-Television',
			'sevenload.com' => 'http://www.sevenload.com/videos/moskovskii-most-po-vantam-5129e95932b0c28c55000079',
			'slideshare.net' => 'http://www.slideshare.net/chrisbrogan/social-media-for-publishers-presentation',
			'snotr.com' => 'http://www.snotr.com/video/8753/What_is_nothing',
			'spike.com' => 'http://www.spike.com/video-clips/32xg36/winter-passing-trailer',
			'streetfire.net' => 'http://www.streetfire.net/video/standing-moto-double-fail_2381106.htm',
			'ted.com' => 'http://www.ted.com/talks/henry_evans_and_chad_jenkins_meet_the_robots_for_humanity.html',
			'thedailyshow.com' => 'http://www.thedailyshow.com/watch/thu-june-28-2012/roberts--rules-of-order',
			'theonion.com' => 'http://www.theonion.com/video/stephen-strasburg-ceremoniously-reinjures-arm-on-o,27866/',
			'twitch.tv' => 'http://www.twitch.tv/rzn732',
			'twitvid.com' => 'http://twitvid.com/0U73M',
			'ustream.tv' => 'http://www.ustream.tv/channel/9948292',
			'vbox7.com' => 'http://www.vbox7.com/play:93ab2ba5',
			'veoh.com' => 'http://www.veoh.com/watch/v27458670er62wkCt',
			'viddler.com' => 'http://www.viddler.com/v/7a0d64f2',
			'videogamer.com' => 'http://www.videogamer.com/videos/dead_space_developer_diary_zero_gravity.html',
			'videu.de' => 'http://www.videu.de/video/38',
			'vimeo.com' => 'http://vimeo.com/3759030',
			'vine.co' => 'https://vine.co/v/hBFxTlV36Tg',
			'wat.tv' => 'http://www.wat.tv/video/mords-moi-sans-hesitation-2ykhj_2g5h3_.html',
			'wegame.com' => 'http://www.wegame.com/watch/Clarity_Darkspear_VS_Heigan/',
			'xfire.com' => 'http://www.xfire.com/video/24c86/',
			'yahoo.com' => 'http://screen.yahoo.com/man-steel-trailer-5-163029535.html',
			'youku.com' => 'http://v.youku.com/v_show/id_XMzgxNzY3NTU2.html',
			'youtu.be' => 'http://youtu.be/sP4NMoJcFd4',
			'youtube.com' => 'http://www.youtube.com/watch?v=sP4NMoJcFd4',
		);
	}

	/**
	* Return an array of commonly used size dimensions for embedded video
	*
	* @return array Size dimensions
	* @access private
	*/
	private function bbvideo_size_presets()
	{
		return array(
			$this->user->lang['ABBC3_BBVIDEO_PRESETS_SM'],
			$this->user->lang['ABBC3_BBVIDEO_PRESETS_MD'],
			$this->user->lang['ABBC3_BBVIDEO_PRESETS_LG'],
			$this->user->lang['ABBC3_BBVIDEO_PRESETS_XL'],
		);
	}
}
