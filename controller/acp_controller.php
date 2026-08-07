<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2020, 2023 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\controller;

use phpbb\cache\driver\driver_interface as cache;
use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\db\driver\driver_interface as db;
use phpbb\extension\manager as ext_manager;
use phpbb\language\language;
use phpbb\request\request;
use phpbb\template\template;

class acp_controller
{
	/** @var cache */
	protected $cache;

	/** @var config */
	protected $config;

	/** @var db_text */
	protected $config_text;

	/** @var db */
	protected $db;

	/** @var ext_manager */
	protected $ext_manager;

	/** @var language */
	protected $language;

	/** @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var string */
	protected $parser_key;

	/** @var string */
	protected $renderer_key;

	/** @var string */
	public $u_action;

	/** @var array */
	protected $errors = [];

	/**
	 * Constructor
	 *
	 * @param cache $cache
	 * @param config $config
	 * @param db_text $db_text
	 * @param db $db
	 * @param ext_manager $ext_manager
	 * @param language $language
	 * @param request $request
	 * @param template $template
	 * @param $parser_key
	 * @param $renderer_key
	 */
	public function __construct(cache $cache, config $config, db_text $db_text, db $db, ext_manager $ext_manager, language $language, request $request, template $template, $parser_key, $renderer_key)
	{
		$this->cache = $cache;
		$this->config = $config;
		$this->config_text = $db_text;
		$this->db = $db;
		$this->ext_manager = $ext_manager;
		$this->language = $language;
		$this->request = $request;
		$this->template = $template;
		$this->parser_key = $parser_key;
		$this->renderer_key = $renderer_key;
	}

	/**
	 * Main handler for this controller
	 *
	 * @throws \RuntimeException
	 */
	public function handle()
	{
		$this->language->add_lang('acp_abbc3', 'vse/abbc3');

		$form_key = 'vse/abbc3';
		add_form_key($form_key);

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				throw new \RuntimeException($this->language->lang('FORM_INVALID'), E_USER_WARNING);
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
			'S_ABBC3_AUTO_VIDEO'	=> $this->config['abbc3_auto_video'],
			'S_ABBC3_ICONS_TYPE'	=> build_select(['png' => 'PNG', 'svg' => 'SVG'], $this->config['abbc3_icons_type']),
			'S_ABBC3_GOOGLE_FONTS'	=> $this->get_google_fonts(),
			'S_ABBC3_MEDIA_EMBED'	=> (int) $this->ext_manager->is_enabled('phpbb/mediaembed'),
			'U_ACTION'				=> $this->u_action,
		]);
	}

	/**
	 * Save settings data to the database
	 *
	 * @throws \RuntimeException
	 */
	protected function save_settings()
	{
		$this->config->set('abbc3_bbcode_bar', $this->request->variable('abbc3_bbcode_bar', 0));
		$this->config->set('abbc3_qr_bbcodes', $this->request->variable('abbc3_qr_bbcodes', 0));
		$this->config->set('abbc3_auto_video', $this->request->variable('abbc3_auto_video', 0));
		$this->config->set('abbc3_icons_type', $this->request->variable('abbc3_icons_type', 'png'));
		$this->save_pipes();
		$this->save_google_fonts();

		$this->cache->destroy($this->parser_key);
		$this->cache->destroy($this->renderer_key);

		if (!empty($this->errors))
		{
			throw new \RuntimeException(implode('<br>', $this->errors), E_USER_WARNING);
		}

		throw new \RuntimeException($this->language->lang('CONFIG_UPDATED'), E_USER_NOTICE);
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
	}

	/**
	 * Get the Google font setting data and format it for the form.
	 *
	 * @return string
	 */
	protected function get_google_fonts()
	{
		$fonts = json_decode($this->config_text->get('abbc3_google_fonts'), true);
		return $fonts ? implode("\n", $fonts) : '';
	}

	/**
	 * Save the Google fonts setting.
	 * - Normalize and validate all submitted font names.
	 * - Preserve the previous setting if any font cannot be validated.
	 */
	protected function save_google_fonts()
	{
		$fonts = $this->request->variable('abbc3_google_fonts', '');
		$stored_value = $this->config_text->get('abbc3_google_fonts');
		$stored_fonts = json_decode($stored_value, true);

		if (!empty($fonts))
		{
			$fonts = array_values(array_unique(array_filter(
				array_map([$this, 'normalize_google_font'], preg_split('/[\r\n,]+/', $fonts)),
				'strlen'
			)));
		}
		else
		{
			$fonts = [];
		}

		// Avoid contacting Google when the font setting has not changed.
		if (($stored_value === '' && empty($fonts)) ||
			(is_array($stored_fonts) && $fonts === $stored_fonts))
		{
			return;
		}

		// Validate all names locally before making any remote requests.
		foreach ($fonts as $font)
		{
			$this->validate_google_font_name($font);
		}

		if (!empty($this->errors))
		{
			return;
		}

		foreach ($fonts as $font)
		{
			$this->validate_google_font_url($font);
		}

		// Keep the previous font list unless every submitted font is valid.
		if (empty($this->errors))
		{
			$this->config_text->set('abbc3_google_fonts', $fonts ? json_encode($fonts) : '');
		}
	}

	/**
	 * Validate Google Font name syntax.
	 *
	 * @param string $font
	 * @return bool
	 */
	protected function validate_google_font_name($font)
	{
		if (!preg_match('/^[\p{L}\p{N}][\p{L}\p{N} ._-]{0,63}$/u', $font))
		{
			$this->errors[] = $this->language->lang('ABBC3_INVALID_FONT', $font);
			return false;
		}

		return true;
	}

	/**
	 * Validate a Google Font against the CSS2 endpoint used by rendered pages.
	 *
	 * @param string $font
	 * @return bool
	 */
	protected function validate_google_font_url($font)
	{
		$url = 'https://fonts.googleapis.com/css2?family=' . rawurlencode($font) . '&display=swap';
		$status = $this->get_url_status($url);

		if ($status === 200)
		{
			return true;
		}

		$this->errors[] = $status === null
			? $this->language->lang('ABBC3_FONT_CHECK_FAILED', $font)
			: $this->language->lang('ABBC3_INVALID_FONT', $font);
		return false;
	}

	/**
	 * Normalize Google Font names before storing them.
	 *
	 * @param string $font
	 * @return string
	 */
	protected function normalize_google_font($font)
	{
		return trim(preg_replace('/\s+/u', ' ', $font));
	}

	/**
	 * Get final HTTP status for a URL using a bounded request.
	 *
	 * @param string $url
	 * @return int|null HTTP status, or null when the request could not be made.
	 */
	protected function get_url_status($url)
	{
		if (!function_exists('get_headers'))
		{
			return null;
		}

		$context = stream_context_create([
			'http' => [
				'timeout' => 5,
				'follow_location' => 1,
				'max_redirects' => 3,
				'ignore_errors' => true,
			],
		]);
		$headers = @get_headers($url, false, $context);

		if (!$headers)
		{
			return null;
		}

		$status = null;
		foreach ($headers as $header)
		{
			if (is_string($header) && preg_match('#^HTTP/\S+\s+(\d{3})#i', $header, $matches))
			{
				$status = (int) $matches[1];
			}
		}

		return $status;
	}

	/**
	 * Set the u_action variable
	 *
	 * @param string $u_action
	 * @return acp_controller
	 */
	public function set_u_action($u_action)
	{
		$this->u_action = $u_action;
		return $this;
	}
}
