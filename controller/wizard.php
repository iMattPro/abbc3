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

use phpbb\controller\helper;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\user;
use vse\abbc3\ext;

/**
 * ABBC3 BBCode Wizard class
 */
class wizard
{
	/** @var string The default BBvideo site */
	const BBVIDEO_DEFAULT = 'youtube.com';

	/** @var helper */
	protected $helper;

	/** @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/** @var string */
	protected $ext_root_path;

	/**
	 * Constructor
	 *
	 * @param helper   $helper        Controller helper object
	 * @param request  $request       Request object
	 * @param template $template      Template object
	 * @param user     $user          User object
	 * @param string   $ext_root_path Path to abbc3 extension root
	 * @access public
	 */
	public function __construct(helper $helper, request $request, template $template, user $user, $ext_root_path)
	{
		$this->helper = $helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->ext_root_path = $ext_root_path;
	}

	/**
	 * BBCode wizard controller accessed with the URL /wizard/bbcode/{mode}
	 * (where {mode} is a placeholder for a string of the bbcode tag name)
	 * intended to be accessed via AJAX only
	 *
	 * @param string $mode Mode taken from the URL
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 * @throws \phpbb\exception\http_exception An http exception
	 * @access public
	 */
	public function bbcode_wizard($mode)
	{
		// Only allow AJAX requests
		if ($this->request->is_ajax())
		{
			switch ($mode)
			{
				case 'bbvideo':
					$this->generate_bbvideo_wizard();
					return $this->helper->render('abbc3_bbvideo_wizard.html');
				// no break here

				case 'url':
					return $this->helper->render('abbc3_url_wizard.html');
				// no break here
			}
		}

		throw new \phpbb\exception\http_exception(404, 'GENERAL_ERROR');
	}

	/**
	 * Set template variables for the BBvideo wizard
	 *
	 * @access protected
	 */
	protected function generate_bbvideo_wizard()
	{
		// Construct BBvideo allowed site select options
		$bbvideo_sites = $this->load_json_data('bbvideo.json');

		// Construct BBvideo size preset select options
		$bbvideo_size_presets = array(
			array('w' => '560', 'h' => '315'),
			array('w' => '640', 'h' => '360'),
			array('w' => '853', 'h' => '480'),
			array('w' => '1280', 'h' => '720'),
		);

		$this->template->assign_vars(array(
			'ABBC3_BBVIDEO_SITES'	=> $bbvideo_sites,
			'ABBC3_BBVIDEO_LINK_EX'	=> isset($bbvideo_sites[self::BBVIDEO_DEFAULT]) ? $bbvideo_sites[self::BBVIDEO_DEFAULT] : '',
			'ABBC3_BBVIDEO_DEFAULT'	=> self::BBVIDEO_DEFAULT,
			'ABBC3_BBVIDEO_HEIGHT'	=> ext::BBVIDEO_HEIGHT,
			'ABBC3_BBVIDEO_WIDTH'	=> ext::BBVIDEO_WIDTH,
			'ABBC3_BBVIDEO_PRESETS'	=> $bbvideo_size_presets,
		));
	}

	/**
	 * Return decoded JSON data from a JSON file (stored in assets/)
	 *
	 * @param string $json_file The name of the JSON file to get
	 * @return array JSON data
	 * @throws \phpbb\exception\runtime_exception
	 * @access protected
	 */
	protected function load_json_data($json_file)
	{
		$json_file = $this->ext_root_path . 'assets/' . $json_file;

		if (!file_exists($json_file))
		{
			throw new \phpbb\exception\runtime_exception('FILE_NOT_FOUND', array($json_file));
		}

		if (!($file_contents = file_get_contents($json_file)))
		{
			throw new \phpbb\exception\runtime_exception('FILE_CONTENT_ERR', array($json_file));
		}

		if (($json_data = json_decode($file_contents, true)) === null)
		{
			throw new \phpbb\exception\runtime_exception('FILE_JSON_DECODE_ERR', array($json_file));
		}

		return $json_data;
	}
}
