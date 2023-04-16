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
	 * @throws http_exception A http exception
	 * @access public
	 */
	public function bbcode_wizard($mode)
	{
		// Only allow valid AJAX requests
		if (!$this->request->is_ajax() || !in_array($mode, ['bbvideo', 'pipes', 'url']))
		{
			throw new http_exception(404, 'GENERAL_ERROR');
		}

		if ($mode === 'bbvideo')
		{
			$this->template->assign_vars([
				'ABBC3_BBVIDEO_SITES'	=> $this->get_bbvideo_sites(),
				'ABBC3_BBVIDEO_DEFAULT'	=> self::BBVIDEO_DEFAULT,
			]);
		}

		return $this->helper->render("@vse_abbc3/abbc3_{$mode}_wizard.html");
	}

	/**
	 * Get BBvideo sites
	 *
	 * @access protected
	 * @return array An array of BBVideo sites containing [id => name, example]
	 */
	protected function get_bbvideo_sites()
	{
		if (($bbvideo_sites = $this->cache->get('_bbvideo_sites')) !== false)
		{
			return $bbvideo_sites;
		}

		$bbvideo_sites = [];
		$configurator = $this->textformatter->get_configurator();
		foreach ($configurator->MediaEmbed->defaultSites as $siteId => $siteConfig)
		{
			// check that siteID is not already a custom bbcode and that it exists in MediaEmbed
			if (!isset($configurator->BBCodes[$siteId]) && $configurator->tags->exists($siteId))
			{
				$bbvideo_sites[$siteId] = [
					'name'    => $siteConfig['name'],
					'example' => isset($siteConfig['example']) ? current((array) $siteConfig['example']) : '',
				];
			}
		}

		ksort($bbvideo_sites);

		$this->cache->put('_bbvideo_sites', $bbvideo_sites);

		return $bbvideo_sites;
	}
}
