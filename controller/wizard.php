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

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string default width of bbvideo */
	protected $bbvideo_width;

	/** @var string default height of bbvideo */
	protected $bbvideo_height;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper    $helper      Controller helper object
	* @param \phpbb\request\request      $request     Request object
	* @param \phpbb\template\template    $template    Template object
	* @param \phpbb\user                 $user        User object
	* @param string $root_path
	* @param string $bbvideo_width
	* @param string $bbvideo_height
	* @return \vse\abbc3\controller\wizard
	* @access public
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, $root_path, $bbvideo_width, $bbvideo_height)
	{
		$this->helper = $helper;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->root_path = $root_path;
		$this->bbvideo_width = $bbvideo_width;
		$this->bbvideo_height = $bbvideo_height;
	}

	/**
	* BBCode wizard controller accessed with the URL /wizard/bbcode/{mode}
	* (where {mode} is a placeholder for a string of the bbcode tag name)
	* intended to be accessed via AJAX only
	*
	* @param string	$mode		Mode taken from the URL
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	* @access public
	*/
	public function bbcode_wizard($mode)
	{
		if (!$this->request->is_ajax())
		{
			return $this->helper->error($this->user->lang('GENERAL_ERROR'), 200);
		}

		switch ($mode)
		{
			case 'bbvideo':

				// Construct BBvideo allowed site select options
				$bbvideo_selected = 'youtube.com';
				$bbvideo_sites_array = $this->bbvideo_sites();
				foreach ($bbvideo_sites_array as $site => $example)
				{
					$this->template->assign_block_vars('bbvideo_sites', array(
						'VALUE'			=> $example,
						'LABEL'			=> $site,
						'S_SELECTED'	=> ($site == $bbvideo_selected) ? true : false,
					));
				}

				// Construct BBvideo size preset select options
				$bbvideo_size_presets_array = array(
					'560 x 315',
					'640 x 360',
					'853 x 480',
					'1280 x 720',
				);
				foreach ($bbvideo_size_presets_array as $preset)
				{
					$this->template->assign_block_vars('bbvideo_sizes', array(
						'VALUE'			=> str_replace(' ', '', $preset),
						'LABEL'			=> $preset,
					));
				}

				$this->template->assign_vars(array(
					'ABBC3_BBVIDEO_LINK_EX'	=> $bbvideo_sites_array[$bbvideo_selected],
					'ABBC3_BBVIDEO_HEIGHT'	=> $this->bbvideo_height,
					'ABBC3_BBVIDEO_WIDTH'	=> $this->bbvideo_width,
				));

				return $this->helper->render('bbcode_wizard.html');

			break;

			default:

				return $this->helper->error($this->user->lang('GENERAL_ERROR'), 200);

			break;
		}
	}

	/**
	* Return an array of allowed BBvideo sites and example URLs (stored in bbvideo.json)
	*
	* @return array Allowed BBvideo sites and URLs
	* @access protected
	*/
	protected function bbvideo_sites()
	{
		$bbvideo_json_file = $this->root_path . 'ext/vse/abbc3/assets/bbvideo.json';

		if (!file_exists($bbvideo_json_file))
		{
			throw new \phpbb\extension\exception('The required file does not exist: ' . $bbvideo_json_file);
		}

		return json_decode(file_get_contents($bbvideo_json_file), true);
	}
}
