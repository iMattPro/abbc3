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
use vse\abbc3\core\toolbar_registry;
use vse\abbc3\core\toolbar_repository;

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

	/** @var toolbar_repository */
	protected $toolbar_repository;

	/** @var toolbar_registry */
	protected $toolbar_registry;

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
	 * @param string $parser_key TextFormatter parser cache key
	 * @param string $renderer_key TextFormatter renderer cache key
	 * @param toolbar_repository|null $toolbar_repository
	 * @param toolbar_registry|null $toolbar_registry
	 */
	public function __construct(cache $cache, config $config, db_text $db_text, db $db, ext_manager $ext_manager, language $language, request $request, template $template, $parser_key, $renderer_key, toolbar_repository $toolbar_repository = null, toolbar_registry $toolbar_registry = null)
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
		$this->toolbar_repository = $toolbar_repository;
		$this->toolbar_registry = $toolbar_registry;
	}

	/**
	 * Process an ACP autosave request or display the settings page.
	 *
	 * @return void
	 * @throws \RuntimeException To report an ACP notice or warning
	 * @throws \Throwable If a toolbar or visibility save fails
	 */
	public function handle()
	{
		$this->language->add_lang('posting');
		$this->language->add_lang('abbc3', 'vse/abbc3');
		$this->language->add_lang('acp_abbc3', 'vse/abbc3');

		$form_key = 'vse/abbc3';
		add_form_key($form_key);

		if ($this->request->is_set_post('abbc3_save_scope'))
		{
			if (!check_form_key($form_key))
			{
				throw new \RuntimeException($this->language->lang('FORM_INVALID'), E_USER_WARNING);
			}

			$this->save_scope($this->request->variable('abbc3_save_scope', ''));
		}

		$this->display_settings();
	}

	/**
	 * Assign settings, icon choices, and the saved toolbar layout to the ACP template.
	 *
	 * @return void
	 */
	protected function display_settings()
	{
		$icon_data = $this->get_icon_data();
		$this->template->assign_vars([
			'S_ABBC3_PIPES'			=> $this->config['abbc3_pipes'],
			'S_ABBC3_BBCODE_BAR'	=> $this->config['abbc3_bbcode_bar'],
			'S_ABBC3_QR_BBCODES'	=> $this->config['abbc3_qr_bbcodes'],
			'S_ABBC3_AUTO_VIDEO'	=> $this->config['abbc3_auto_video'],
			'ABBC3_ICONS_TYPE'		=> $this->config['abbc3_icons_type'],
			'S_ABBC3_GOOGLE_FONTS'	=> $this->get_google_fonts(),
			'S_ABBC3_MEDIA_EMBED'	=> (int) $this->ext_manager->is_enabled('phpbb/mediaembed'),
			'ABBC3_AVAILABLE_ICONS'	=> $icon_data['names'],
			'ABBC3_ICON_PATHS'		=> $icon_data['paths'],
			'U_ACTION'				=> $this->u_action,
		]);

		if ($this->toolbar_registry)
		{
			foreach ($this->toolbar_registry->get_admin_buttons() as $placement => $buttons)
			{
				foreach ($buttons as $button)
				{
					$this->template->assign_block_vars('toolbar_' . $placement, [
						'KEY' => $button['key'],
						'TYPE' => $button['type'],
						'NAME' => $button['name'],
						'LABEL' => $button['label'],
						'ICON' => $button['icon'],
						'FONT_ICON' => $button['font_icon'],
					]);
				}
			}
		}
	}

	/**
	 * Find bundled and board-local toolbar icons for both image formats.
	 *
	 * @return array Icon names and paths grouped by format
	 */
	protected function get_icon_data()
	{
		$names = [];
		$paths = ['png' => [], 'svg' => []];
		foreach (['svg', 'png'] as $extension)
		{
			$found = $this->ext_manager->get_finder()
				->set_extensions(['vse/abbc3'])
				->suffix('.' . $extension)
				->extension_directory('/images/icons')
				->core_path('images/abbc3/icons/')
				->find();
			foreach (array_keys($found) as $path)
			{
				$name = pathinfo($path, PATHINFO_FILENAME);
				$names[$name] = $name;
				$paths[$extension][$name] = $path;
			}
		}
		ksort($names);
		ksort($paths['png']);
		ksort($paths['svg']);
		return ['names' => array_values($names), 'paths' => $paths];
	}

	/**
	 * Save one autosave scope.
	 *
	 * @param string $scope Autosave scope (setting, toolbar, or fonts)
	 * @throws \RuntimeException To report autosave success or failure to phpBB
	 * @throws \Throwable If a toolbar or visibility save fails
	 */
	protected function save_scope($scope)
	{
		$this->errors = [];
		switch ($scope)
		{
			case 'setting':
				$this->save_setting();
			break;

			case 'toolbar':
				$this->save_toolbar();
			break;

			case 'fonts':
				$this->save_google_fonts();
			break;

			default:
				throw new \RuntimeException($this->language->lang('FORM_INVALID'), E_USER_WARNING);
		}

		if (!empty($this->errors))
		{
			throw new \RuntimeException(implode('<br>', $this->errors), E_USER_WARNING);
		}

		throw new \RuntimeException($this->language->lang('CONFIG_UPDATED'), E_USER_NOTICE);
	}

	/**
	 * Validate and save one submitted ACP setting.
	 *
	 * @return void
	 * @throws \RuntimeException If the name or value is invalid
	 * @throws \Throwable If synchronizing Pipe Tables visibility fails
	 */
	protected function save_setting()
	{
		$name = $this->request->variable('setting_name', '');
		if ($name === 'abbc3_icons_type')
		{
			$value = $this->request->variable('setting_value', '');
			if (!in_array($value, ['png', 'svg'], true))
			{
				throw new \RuntimeException($this->language->lang('FORM_INVALID'), E_USER_WARNING);
			}
			$this->config->set($name, $value);
			return;
		}

		$boolean_settings = [
			'abbc3_bbcode_bar',
			'abbc3_qr_bbcodes',
			'abbc3_pipes',
			'abbc3_auto_video',
		];
		if (!in_array($name, $boolean_settings, true))
		{
			throw new \RuntimeException($this->language->lang('FORM_INVALID'), E_USER_WARNING);
		}

		$value = $this->request->variable('setting_value', 0);
		if (!in_array($value, [0, 1], true))
		{
			throw new \RuntimeException($this->language->lang('FORM_INVALID'), E_USER_WARNING);
		}
		$this->config->set($name, $value);
		if ($name === 'abbc3_pipes' && $this->toolbar_repository)
		{
			$this->toolbar_repository->sync_visibility(['pipes' => (bool) $value]);
		}
		if (in_array($name, ['abbc3_pipes', 'abbc3_auto_video'], true))
		{
			$this->cache->destroy($this->parser_key);
			$this->cache->destroy($this->renderer_key);
		}
	}

	/**
	 * Save the submitted toolbar layout, icons, and feature visibility.
	 *
	 * @return void
	 * @throws \Throwable If saving the toolbar layout fails
	 */
	protected function save_toolbar()
	{
		if (!$this->toolbar_repository)
		{
			return;
		}

		$placements = [];
		foreach (['primary', 'more', 'hidden'] as $placement)
		{
			$placements[$placement] = $this->request->variable('toolbar_' . $placement, [0 => '']);
		}
		$icons = $this->request->variable('toolbar_icon', ['' => '']);
		$font_icons = $this->request->variable('toolbar_font_icon', ['' => '']);
		$this->toolbar_repository->save_layout($placements, $icons, $font_icons, ['pipes' => !empty($this->config['abbc3_pipes'])]);
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
