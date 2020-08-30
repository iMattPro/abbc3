<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\controller;

use phpbb\cache\driver\driver_interface as cache_driver;
use phpbb\controller\helper;
use phpbb\exception\http_exception;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\textformatter\s9e\factory as textformatter;

/**
 * ABBC3 BBCode Wizard class
 */
class wizard
{
	/** @var string The default BBvideo site */
	const BBVIDEO_DEFAULT = 'youtube';

	/** @var cache_driver */
	protected $cache;

	/** @var helper */
	protected $helper;

	/** @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var textformatter */
	protected $textformatter;

	/**
	 * Constructor
	 *
	 * @param cache_driver  $cache         Cache driver
	 * @param helper        $helper        Controller helper object
	 * @param request       $request       Request object
	 * @param template      $template      Template object
	 * @param textformatter $textformatter TextFormatter Factory
	 * @access public
	 */
	public function __construct(cache_driver $cache, helper $helper, request $request, template $template, textformatter $textformatter)
	{
		$this->cache = $cache;
		$this->helper = $helper;
		$this->request = $request;
		$this->template = $template;
		$this->textformatter = $textformatter;
	}

	/**
	 * BBCode wizard controller accessed with the URL /wizard/bbcode/{mode}
	 * (where {mode} is a placeholder for a string of the bbcode tag name)
	 * intended to be accessed via AJAX only
	 *
	 * @param string $mode Mode taken from the URL
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 * @throws \phpbb\exception\http_exception An http exception
	 * @throws \phpbb\exception\runtime_exception Runtime exception if JSON fails
	 * @access public
	 */
	public function bbcode_wizard($mode)
	{
		// Only allow valid AJAX requests
		if ($this->request->is_ajax() && in_array($mode, ['bbvideo', 'pipes', 'url']))
		{
			if ($mode === 'bbvideo')
			{
				$this->generate_bbvideo_wizard();
			}

			return $this->helper->render("abbc3_{$mode}_wizard.html");
		}

		throw new http_exception(404, 'GENERAL_ERROR');
	}

	/**
	 * Set template variables for the BBvideo wizard
	 *
	 * @access protected
	 */
	protected function generate_bbvideo_wizard()
	{
		if (($bbvideo_sites = $this->cache->get('_bbvideo_sites')) === false)
		{
			$bbvideo_sites = [];
			$configurator = $this->textformatter->get_configurator();
			foreach ($configurator->MediaEmbed->defaultSites as $siteId => $siteConfig)
			{
				// check that siteID is not already a custom bbcode and that it exists in MediaEmbed
				if (!isset($configurator->BBCodes[$siteId]) && $configurator->tags->exists($siteId))
				{
					$bbvideo_sites[$siteId] = isset($siteConfig['example']) ? current((array) $siteConfig['example']) : '';
				}
			}

			$this->cache->put('_bbvideo_sites', $bbvideo_sites);
		}

		ksort($bbvideo_sites);

		$this->template->assign_vars([
			'ABBC3_BBVIDEO_SITES'	=> $bbvideo_sites,
			'ABBC3_BBVIDEO_LINK_EX'	=> isset($bbvideo_sites[self::BBVIDEO_DEFAULT]) ? $bbvideo_sites[self::BBVIDEO_DEFAULT] : '',
			'ABBC3_BBVIDEO_DEFAULT'	=> self::BBVIDEO_DEFAULT,
		]);
	}
}
