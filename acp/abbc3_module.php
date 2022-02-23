<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\acp;

class abbc3_module
{
	/** @var \phpbb\cache\driver\driver_interface */
	protected $cache;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \Symfony\Component\DependencyInjection\ContainerInterface */
	protected $container;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var string */
	public $page_title;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $u_action;

	/**
	 * Constructor
	 *
	 * @throws \Exception
	 */
	public function __construct()
	{
		global $phpbb_container;

		$this->container   = $phpbb_container;
		$this->cache       = $this->container->get('cache');
		$this->config      = $this->container->get('config');
		$this->config_text = $this->container->get('config_text');
		$this->db          = $this->container->get('dbal.conn');
		$this->language    = $this->container->get('language');
		$this->request     = $this->container->get('request');
		$this->template    = $this->container->get('template');
	}

	/**
	 * Main ACP module
	 */
	public function main()
	{
		$this->language->add_lang('abbc3', 'vse/abbc3');

		$this->tpl_name   = 'acp_abbc3_settings';
		$this->page_title = $this->language->lang('ACP_ABBC3_SETTINGS');

		$form_key = 'vse/abbc3';
		add_form_key($form_key);

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$this->save_settings();
		}

		$this->display_settings();
	}

	/**
	 * Add settings template vars to the form
	 */
	protected function display_settings()
	{
		$this->template->assign_vars([
			'S_ABBC3_PIPES'			=> $this->config['abbc3_pipes'],
			'S_ABBC3_BBCODE_BAR'	=> $this->config['abbc3_bbcode_bar'],
			'S_ABBC3_QR_BBCODES'	=> $this->config['abbc3_qr_bbcodes'],
			'S_ABBC3_ICONS_TYPE'	=> build_select(['png' => 'PNG', 'svg' => 'SVG'], $this->config['abbc3_icons_type']),
			'S_ABBC3_GOOGLE_FONTS'	=> $this->show_google_fonts(),
			'U_ACTION'				=> $this->u_action,
		]);
	}

	/**
	 * Save settings data to the database
	 */
	protected function save_settings()
	{
		$this->config->set('abbc3_bbcode_bar', $this->request->variable('abbc3_bbcode_bar', 0));
		$this->config->set('abbc3_qr_bbcodes', $this->request->variable('abbc3_qr_bbcodes', 0));
		$this->config->set('abbc3_icons_type', $this->request->variable('abbc3_icons_type', 'png'));
		$this->save_pipes();
		$this->save_google_fonts();

		trigger_error($this->language->lang('CONFIG_UPDATED') . adm_back_link($this->u_action));
	}

	/**
	 * Save the Pipes Table setting.
	 * - Set the config
	 * - Show or hide the Pipes BBCode button
	 * - Purge BBCode caches.
	 */
	protected function save_pipes()
	{
		$enable_pipes = $this->request->variable('abbc3_pipes', 0);

		$this->config->set('abbc3_pipes', $enable_pipes);

		$sql = 'UPDATE ' . BBCODES_TABLE . '
			SET display_on_posting = ' . (int) $enable_pipes . "
			WHERE bbcode_tag = 'pipes'";
		$this->db->sql_query($sql);

		$this->cache->destroy($this->container->getParameter('text_formatter.cache.parser.key'));
		$this->cache->destroy($this->container->getParameter('text_formatter.cache.renderer.key'));
	}

	/**
	 * Get the Google font setting data and format it for the form.
	 *
	 * @return string
	 */
	protected function show_google_fonts()
	{
		$fonts = json_decode($this->config_text->get('abbc3_google_fonts'), true);
		return $fonts ? implode("\n", $fonts) : '';
	}

	/**
	 * Save the Google fonts setting.
	 * - If field has data, explode it to an array and save as JSON data.
	 * - If field is empty, store just an empty string.
	 */
	protected function save_google_fonts()
	{
		$fonts = $this->request->variable('abbc3_google_fonts', '');
		$fonts = $fonts ? json_encode(explode("\n", $fonts)) : '';
		$this->config_text->set('abbc3_google_fonts', $fonts);
	}
}
