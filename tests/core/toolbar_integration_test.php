<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\tests\core;

use phpbb\auth\auth;
use phpbb\cache\driver\dummy;
use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\event\dispatcher;
use phpbb\extension\manager;
use phpbb\filesystem\filesystem;
use phpbb\path_helper;
use phpbb\request\request;
use phpbb\routing\helper;
use phpbb\routing\resources_locator\resources_locator_interface;
use phpbb\routing\router;
use phpbb\symfony_request;
use phpbb\template\context;
use phpbb\template\twig\environment;
use phpbb\template\twig\extension;
use phpbb\template\twig\loader;
use phpbb\template\twig\twig;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use vse\abbc3\controller\acp_controller;
use vse\abbc3\controller\acp_test;
use vse\abbc3\controller\wizard;
use vse\abbc3\core\acp_manager;
use vse\abbc3\core\bbcodes_config;
use vse\abbc3\core\bbcodes_display;
use vse\abbc3\core\bbcodes_help;
use vse\abbc3\core\toolbar_registry;
use vse\abbc3\core\toolbar_repository;
use vse\abbc3\event\acp_listener;
use vse\abbc3\event\listener;

class toolbar_integration_test extends acp_base
{
	private $config;
	private $config_text;
	private $context;
	private $template;
	private $filesystem;
	private $manager;
	private $dispatcher;
	private $repository;
	private $registry;

	public function getDataSet()
	{
		return new \PHPUnit\DbUnit\DataSet\CompositeDataSet([
			parent::getDataSet(),
			$this->createXMLDataSet(__DIR__ . '/fixtures/toolbar_integration.xml'),
		]);
	}

	protected function setUp(): void
	{
		parent::setUp();
		global $phpbb_root_path, $phpEx, $phpbb_dispatcher;

		$this->request = new request(null, false);
		$this->request->overwrite('SCRIPT_NAME', '/app.php', request::SERVER);
		$this->config = new config([
			'version' => PHPBB_VERSION,
			'force_server_vars' => 0,
			'enable_mod_rewrite' => 0,
			'abbc3_bbcode_bar' => 1,
			'abbc3_pipes' => 1,
			'abbc3_qr_bbcodes' => 1,
			'abbc3_auto_video' => 0,
			'abbc3_icons_type' => 'png',
			'allow_cdn' => 1,
		]);
		$this->config_text = new db_text($this->db, CONFIG_TEXT_TABLE);
		$this->filesystem = new filesystem();
		$this->dispatcher = $phpbb_dispatcher = new dispatcher();
		$this->manager = new manager(new Container(), $this->db, $this->config, $this->filesystem, EXT_TABLE, $phpbb_root_path, $phpEx);
		$path_helper = new path_helper(new symfony_request($this->request), $this->filesystem, $this->request, $phpbb_root_path, $phpEx);
		$this->context = new context();
		$environment = new environment($this->config, $this->filesystem, $path_helper, '', null, new loader($this->filesystem, ''), $this->dispatcher, ['cache' => false]);
		$environment->getLoader()->setPaths($phpbb_root_path . 'ext/vse/abbc3/styles/prosilver/template', 'vse_abbc3');
		$this->template = new twig($path_helper, $this->config, $this->context, $environment, '', $this->user, [new extension($this->context, $environment, $this->user)]);
		$this->repository = new toolbar_repository($this->db, 'phpbb_');
		$this->registry = new toolbar_registry($this->repository);
		$this->user->data['user_id'] = 2;
	}

	public function test_posting_events_produce_editor_buttons_and_redacted_results()
	{
		global $phpbb_root_path, $phpEx, $phpbb_extension_manager;
		$phpbb_extension_manager = $this->manager;
		$this->config_text->set('abbc3_google_fonts', '["Roboto", " Open Sans ", "Roboto", ""]');

		// Use the extension's routing file and the real URL generator without a compiled route cache.
		$router = new class(new Container(), new class implements resources_locator_interface {
			public function locate_resources()
			{
				return ['ext/vse/abbc3/config/routing.yml'];
			}
		}, new YamlFileLoader(new FileLocator($phpbb_root_path)), $phpEx, '') extends router {
			protected function create_dumped_url_generator()
			{
				$this->create_new_url_generator();
			}
		};
		$display = new bbcodes_display(new auth(), $this->config, $this->db, $this->manager, $this->user, $phpbb_root_path, $this->repository);
		$toolbar = new listener(
			new bbcodes_config(),
			$display,
			new bbcodes_help($display, $this->config, $this->db, $this->lang, $this->template),
			$this->config,
			$this->config_text,
			new helper($this->config, $router, new symfony_request($this->request), $this->request, $this->filesystem, $phpbb_root_path, $phpEx),
			$this->lang,
			$this->template,
			$this->user,
			$phpbb_root_path,
			$phpEx,
			$this->registry
		);
		$this->dispatcher->addSubscriber($toolbar);

		$this->repository->sync_bbcode(13, 'font=');
		$this->repository->sync_bbcode(14, 'highlight=');
		$this->repository->sync_bbcode(15, 'align=');
		$this->repository->sync_bbcode(17, 'sup');
		$this->repository->sync_bbcode(18, 'pipes');
		$this->repository->set_group_ids(17, []);
		$this->repository->save_layout(['primary' => ['bbcode:font'], 'more' => ['bbcode:highlight', 'bbcode:align', 'bbcode:sup', 'bbcode:pipes']], [], ['bbcode:sup' => 'star']);

		foreach ([
			[13, 'font=', '[font={INTTEXT}]{TEXT}[/font]', 'Font &amp; family', true],
			[14, 'highlight=', '[highlight={COLOR}]{TEXT}[/highlight]', 'Highlight', true],
			[15, 'align=', '[align={IDENTIFIER}]{TEXT}[/align]', 'Align', false],
			[17, 'sup', '[sup]{TEXT}[/sup]', 'Superscript', true],
			[18, 'pipes', '[pipes]{TEXT}[/pipes]', 'Pipe Tables', true],
		] as [$id, $tag, $match, $label, $allowed])
		{
			$result = $this->dispatcher->trigger_event('core.display_custom_bbcodes_modify_row', [
				'custom_tags' => ['BBCODE_HELPLINE' => $label] + ($id === 14 ? ['BBCODE_FONT_ICON' => 'heart'] : []),
				'row' => ['bbcode_id' => $id, 'bbcode_tag' => $tag, 'bbcode_match' => $match],
			]);
			self::assertSame($allowed, $result['custom_tags']['S_CUSTOM_BBCODE_ALLOWED'], $tag);
		}
		$this->dispatcher->trigger_event('core.display_custom_bbcodes', []);

		$blocks = $this->context->get_data_ref();
		self::assertSame(['font'], array_column($blocks['abbc3_primary'], 'TYPE'));
		self::assertSame(['Font & family'], array_column($blocks['abbc3_primary'], 'LABEL'));
		self::assertSame(['highlight', 'sup', 'pipes'], array_column($blocks['abbc3_more'], 'NAME'));
		self::assertSame(['[highlight=yellow]', '[sup]', '[pipes]'], array_column($blocks['abbc3_more'], 'OPEN'));
		self::assertSame(['[/highlight]', '[/sup]', '[/pipes]'], array_column($blocks['abbc3_more'], 'CLOSE'));
		self::assertSame(['', '', 'wizard'], array_column($blocks['abbc3_more'], 'ACTION'));
		self::assertSame(['', 'star', ''], array_column($blocks['abbc3_more'], 'FONT_ICON'));
		self::assertSame(['Open Sans', 'Roboto'], $this->context->retrieve_var('ABBC3_BBCODE_FONTS')['ABBC3_GOOGLE_FONTS']);
		self::assertStringContainsString('/wizard/bbcode/url', $this->context->retrieve_var('UA_ABBC3_URL_WIZARD'));

		$this->user->data['user_id'] = ANONYMOUS;
		$result = $this->dispatcher->trigger_event('core.search_modify_post_row', [
			'row' => ['post_text' => '<r>public<HIDDEN>private</HIDDEN></r>', 'bbcode_uid' => 'abc', 'post_id' => 10],
		]);
		self::assertSame(['post_text' => '<r>public<HIDDEN> </HIDDEN></r>', 'bbcode_uid' => 'abc', 'post_id' => 10], $result['row']);
	}

	public function test_acp_custom_bbcode_events_persist_groups_and_placement()
	{
		$listener = new acp_listener(new acp_manager($this->db, $this->group_helper, $this->lang, $this->request, $this->repository));
		$this->dispatcher->addSubscriber($listener);
		$this->request->overwrite('bbcode_group', ['2', '2', '3']);
		$this->dispatcher->trigger_event('core.acp_bbcodes_modify_create_after', [
			'bbcode_id' => '13',
			'sql_ary' => ['bbcode_tag' => 'font=', 'display_on_posting' => 1],
		]);
		self::assertSame([2, 3], $this->repository->get_group_ids(13));
		self::assertSame('more', $this->repository->get_layout()['bbcode:font']['placement']);

		$this->request->overwrite('bbcode_group', '');
		$this->dispatcher->trigger_event('core.acp_bbcodes_modify_create_after', [
			'bbcode_id' => 13,
			'sql_ary' => ['bbcode_tag' => 'font=', 'display_on_posting' => 0],
		]);
		self::assertSame([], $this->repository->get_group_ids(13));
		self::assertSame('hidden', $this->repository->get_layout()['bbcode:font']['placement']);

		$this->dispatcher->trigger_event('core.acp_bbcodes_delete_after', ['bbcode_id' => 13]);
		self::assertArrayNotHasKey('bbcode:font', $this->repository->get_layout());
	}

	public function test_acp_displays_saved_placements_and_icons()
	{
		$this->repository->sync_bbcode(13, 'font=');
		$this->repository->sync_bbcode(14, 'highlight=');
		$this->repository->sync_bbcode(15, 'align=');
		$this->repository->save_layout(
			['primary' => ['bbcode:font'], 'more' => ['bbcode:highlight']],
			['bbcode:font' => 'custom-font'],
			['bbcode:highlight' => 'fa-star']
		);
		$this->controller($this->repository)->handle();

		$blocks = $this->context->get_data_ref();
		self::assertSame(['bbcode:font'], array_column($blocks['toolbar_primary'], 'KEY'));
		self::assertSame(['custom-font'], array_column($blocks['toolbar_primary'], 'ICON'));
		self::assertSame(['bbcode:highlight'], array_column($blocks['toolbar_more'], 'KEY'));
		self::assertSame(['star'], array_column($blocks['toolbar_more'], 'FONT_ICON'));
		self::assertSame(['bbcode:align'], array_column($blocks['toolbar_hidden'], 'KEY'));
	}
	public function media_sites()
	{
		return [
			'YouTube preferred over alphabetic first' => [['youtube', 'vimeo'], false, ['Vimeo', 'YouTube'], 'YouTube'],
			'custom YouTube BBCode takes precedence' => [['youtube', 'vimeo'], true, ['Vimeo'], 'Vimeo'],
			'no eligible sites' => [[], false, [], ''],
		];
	}

	/** @dataProvider media_sites */
	public function test_wizard_renders_real_media_sites(array $sites, $youtube_bbcode, array $options, $selected)
	{
		global $phpbb_root_path, $phpEx, $config;
		$config = $this->config;
		$config->set('server_protocol', 'https://');
		$config->set('server_name', 'example.test');
		$config->set('server_port', 443);
		$config->set('script_path', '');
		$config->set('cookie_secure', 1);
		$this->db->sql_query('DELETE FROM ' . BBCODES_TABLE);
		$this->config->set('allowed_schemes_links', 'http,https');
		$this->lang->add_lang('abbc3', 'vse/abbc3');
		$this->request->overwrite('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest', request::SERVER);
		$this->dispatcher->addListener('core.text_formatter_s9e_configure_after', static function ($event) use ($sites, $youtube_bbcode) {
			foreach ($sites as $site)
			{
				$event['configurator']->MediaEmbed->add($site);
			}
			if ($youtube_bbcode)
			{
				$event['configurator']->BBCodes->add('youtube', []);
			}
		});
		$auth = new auth();
		$cache = new dummy();
		$logging = new \phpbb\log\log($this->db, $this->user, $auth, $this->dispatcher, $phpbb_root_path, 'adm/', $phpEx, LOG_TABLE);
		$data_access = new \phpbb\textformatter\data_access($this->db, BBCODES_TABLE, SMILIES_TABLE, STYLES_TABLE, WORDS_TABLE, $phpbb_root_path . 'styles/');
		$formatter = new \phpbb\textformatter\s9e\factory($data_access, $cache, $this->dispatcher, $this->config, new \phpbb\textformatter\s9e\link_helper(), $logging, sys_get_temp_dir(), '_parser', '_renderer');

		// Render the real template without starting phpBB's full page header and footer.
		$renderer = new class($this->template) extends \phpbb\controller\helper {
			private $wizard_template;

			public function __construct(twig $template)
			{
				$this->wizard_template = $template;
			}

			public function render($template_file, $page_title = '', $status_code = 200, $display_online_list = false, $item_id = 0, $item = 'forum', $send_headers = false)
			{
				$this->wizard_template->set_filenames(['body' => $template_file]);
				return new \Symfony\Component\HttpFoundation\Response($this->wizard_template->assign_display('body'), $status_code);
			}
		};
		$response = (new wizard($cache, $renderer, $this->request, $this->template, $formatter))->bbcode_wizard('bbvideo');
		$html = new \DOMDocument();
		$html->loadHTML($response->getContent());
		$document = new \DOMXPath($html);
		$labels = [];
		foreach ($document->query('//select[@id="bbvideo_wizard_sites"]/option') as $option)
		{
			$labels[] = $option->textContent;
		}
		self::assertSame(200, $response->getStatusCode());
		self::assertSame($options, $labels);
		self::assertSame($selected, $document->evaluate('string(//option[@selected])'));
		self::assertSame(
			$document->evaluate('string(//option[@selected]/@value)'),
			$document->evaluate('string(//input[@id="bbvideo_wizard_example"]/@value)')
		);
	}

	public function acp_submissions()
	{
		return [
			'valid icon choice' => ['setting', ['setting_name' => 'abbc3_icons_type', 'setting_value' => 'svg'], true, true, E_USER_NOTICE, 'svg', 'more'],
			'invalid icon choice' => ['setting', ['setting_name' => 'abbc3_icons_type', 'setting_value' => 'jpg'], true, true, E_USER_WARNING, 'png', 'more'],
			'invalid form token' => ['setting', ['setting_name' => 'abbc3_icons_type', 'setting_value' => 'svg'], false, true, E_USER_WARNING, 'png', 'more'],
			'toolbar placement' => ['toolbar', ['toolbar_primary' => ['bbcode:font']], true, true, E_USER_NOTICE, 'png', 'primary'],
			'toolbar storage unavailable' => ['toolbar', ['toolbar_primary' => ['bbcode:font']], true, false, E_USER_NOTICE, 'png', 'more'],
		];
	}

	/** @dataProvider acp_submissions */
	public function test_acp_submission_changes_only_allowed_settings($scope, array $input, $valid_token, $has_repository, $status, $icon_type, $placement)
	{
		$this->repository->sync_bbcode(13, 'font=');
		$controller = $this->controller($has_repository ? $this->repository : null);
		$controller->handle();
		$fields = new \DOMDocument();
		$fields->loadHTML($this->context->retrieve_var('S_FORM_TOKEN'));
		$form = new \DOMXPath($fields);
		$created = (int) $form->evaluate('string(//input[@name="creation_time"]/@value)');
		self::assertGreaterThan(0, $created);
		// phpBB expects time to elapse before form submission, even when the token is valid.
		$created--;
		$input += [
			'abbc3_save_scope' => $scope,
			'creation_time' => $created,
			'form_token' => $valid_token ? sha1($created . $this->user->data['user_form_salt'] . 'vse/abbc3') : 'invalid',
		];
		foreach ($input as $name => $value)
		{
			$this->request->overwrite($name, $value);
			$this->request->overwrite($name, $value, request::POST);
		}
		try
		{
			$controller->handle();
			self::fail('An ACP autosave should report its result.');
		}
		catch (\RuntimeException $exception)
		{
			self::assertSame($status, $exception->getCode());
		}

		self::assertSame($icon_type, (new \phpbb\config\db($this->db, new dummy(), CONFIG_TABLE))['abbc3_icons_type']);
		self::assertSame($placement, (new toolbar_repository($this->db, 'phpbb_'))->get_layout()['bbcode:font']['placement']);
	}

	private function controller(toolbar_repository $repository = null)
	{
		global $phpbb_extension_manager, $config, $request, $template, $phpbb_dispatcher;
		$phpbb_extension_manager = $this->manager;
		$config = new \phpbb\config\db($this->db, new dummy(), CONFIG_TABLE);
		foreach ($this->config as $name => $value)
		{
			$config->set($name, $value);
		}
		$config->set('form_token_lifetime', 7200);

		$request = $this->request;
		$template = $this->template;
		$phpbb_dispatcher = $this->dispatcher;
		if (class_exists(acp_test::class, false))
		{
			acp_test::$valid_form = null;
		}
		return new acp_controller(new dummy(), $config, $this->config_text, $this->db, $this->manager, $this->lang, $this->request, $this->template, 'parser', 'renderer', $repository, $this->registry);
	}

}
