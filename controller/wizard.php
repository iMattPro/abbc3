<?php
/**
*
* Advanced BBCode Box 3.1
*
* @copyright (c) 2013 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\controller;

/**
* ABBC3 BBCode Wizard class
*/
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

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $ext_root_path;

	/** @var string */
	protected $bbvideo_width;

	/** @var string */
	protected $bbvideo_height;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper    $helper         Controller helper object
	* @param \phpbb\request\request      $request        Request object
	* @param \phpbb\template\template    $template       Template object
	* @param \phpbb\user                 $user           User object
	* @param string                      $root_path      phpBB root path
	* @param string                      $ext_root_path  Extension root path
	* @param string                      $bbvideo_width  Default width of bbvideo
	* @param string                      $bbvideo_height Default height of bbvideo
	* @access public
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, $root_path, $ext_root_path, $bbvideo_width, $bbvideo_height)
	{
		$this->helper = $helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->ext_root_path = $ext_root_path;
		$this->bbvideo_width = $bbvideo_width;
		$this->bbvideo_height = $bbvideo_height;
	}

	/**
	* BBCode wizard controller accessed with the URL /wizard/bbcode/{mode}
	* (where {mode} is a placeholder for a string of the bbcode tag name)
	* intended to be accessed via AJAX only
	*
	* @param string	$mode Mode taken from the URL
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
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

					return $this->helper->render('bbvideo_wizard.html');

				break;
			}
		}

		return $this->helper->error($this->user->lang('GENERAL_ERROR'), 200);
	}

	/**
	* Set template variables for the BBvideo wizard
	*
	* @access protected
	*/
	protected function generate_bbvideo_wizard()
	{
		// Construct BBvideo allowed site select options
		$bbvideo_default = 'youtube.com';
		$bbvideo_sites_array = $this->bbvideo_sites();
		foreach ($bbvideo_sites_array as $site => $example)
		{
			$this->template->assign_block_vars('bbvideo_sites', array(
				'VALUE'			=> $example,
				'LABEL'			=> $site,
				'S_SELECTED'	=> ($site == $bbvideo_default) ? true : false,
			));
		}

		// Construct BBvideo size preset select options
		$bbvideo_size_presets_array = array(
			'560,315',
			'640,360',
			'853,480',
			'1280,720',
		);
		foreach ($bbvideo_size_presets_array as $preset)
		{
			$this->template->assign_block_vars('bbvideo_sizes', array(
				'VALUE'			=> $preset,
				'LABEL'			=> str_replace(',', ' ' . $this->user->lang('ABBC3_BBVIDEO_SEPARATOR') . ' ', $preset),
			));
		}

		$this->template->assign_vars(array(
			'ABBC3_BBVIDEO_LINK_EX'	=> (isset($bbvideo_sites_array[$bbvideo_default])) ? $bbvideo_sites_array[$bbvideo_default] : '',
			'ABBC3_BBVIDEO_HEIGHT'	=> $this->bbvideo_height,
			'ABBC3_BBVIDEO_WIDTH'	=> $this->bbvideo_width,
		));
	}

	/**
	* Return an array of allowed BBvideo sites and example URLs (stored in assets/bbvideo.json)
	*
	* @return array Allowed BBvideo sites and URLs
	* @throws \phpbb\extension\exception
	* @access protected
	*/
	protected function bbvideo_sites()
	{
		$bbvideo_json_file = $this->root_path . $this->ext_root_path . 'assets/bbvideo.json';

		if (!file_exists($bbvideo_json_file))
		{
			throw new \phpbb\extension\exception($this->user->lang('FILE_NOT_FOUND', $bbvideo_json_file));
		}
		else
		{
			if (!($file_contents = file_get_contents($bbvideo_json_file)))
			{
				throw new \phpbb\extension\exception($this->user->lang('FILE_CONTENT_ERR', $bbvideo_json_file));
			}

			if (($bbvideo_data = json_decode($file_contents, true)) === null)
			{
				throw new \phpbb\extension\exception($this->user->lang('FILE_JSON_DECODE_ERR', $bbvideo_json_file));
			}

			return $bbvideo_data;
		}
	}
}
