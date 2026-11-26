<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2020 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\functional;

/**
* @group functional
*/
class acp_module_test extends \phpbb_functional_test_case
{
	protected static function setup_extensions()
	{
		return ['vse/abbc3'];
	}

	/**
	 * {@inheritdoc}
	 */
	protected function setUp(): void
	{
		parent::setUp();
		$this->add_lang('posting');
		$this->add_lang_ext('vse/abbc3', 'info_acp_abbc3');
		$this->add_lang_ext('vse/abbc3', 'acp_abbc3');
	}

	/**
	 * Verify the toolbar composer and settings saves on the ACP page.
	 */
	public function test_module_page()
	{
		$this->login();
		$this->admin_login();
		$db = $this->get_db();
		$db->sql_query("UPDATE " . self::$config['table_prefix'] . "abbc3_toolbar SET font_icon = '', icon = '' WHERE button_key = 'bbcode:fade'");

		// Check ABBC3 ACP module
		$crawler = self::request('GET', 'adm/index.php?i=\vse\abbc3\acp\abbc3_module&mode=settings&sid=' . $this->sid);
		$this->assertContainsLang('ACP_ABBC3_MODULE', $crawler->text());
		self::assertSame(1, $crawler->filter('input[name="abbc3_bbcode_bar"][checked]')->count());
		self::assertSame(0, $crawler->filter('input[name="abbc3_qr_bbcodes"][checked]')->count());
		self::assertSame(1, $crawler->filter('input[name="abbc3_pipes"][checked]')->count());
		self::assertSame(0, $crawler->filter('input[name="abbc3_auto_video"][checked]')->count());
		self::assertSame('png', $crawler->filter('input[name="abbc3_icons_type"][checked]')->attr('value'));
		self::assertEquals('', $crawler->filter('textarea#abbc3_google_fonts')->text());
		self::assertSame(1, $crawler->filter('[data-font-picker][data-catalog-url] input[type="search"]')->count());
		self::assertSame(1, $crawler->filter('[data-font-picker] [data-font-results][hidden]')->count());
		self::assertSame(1, $crawler->filter('[data-abbc3-live-preview]')->count());
		self::assertSame(1, $crawler->filter('[data-abbc3-inspector]')->count());
		self::assertSame(1, $crawler->filter('#abbc3_settings + [data-autosave-status] [role="status"]')->count());
		self::assertSame(2, $crawler->filter('[data-abbc3-live-preview] input[name="abbc3_icons_type"]')->count());
		self::assertSame(1, $crawler->filter('[data-save-fonts]')->count());
		self::assertSame(1, $crawler->filter('[data-font-status]')->count());
		self::assertSame(0, $crawler->filter('[data-autosave-fonts]')->count());
		self::assertSame(3, $crawler->filter('[data-abbc3-editable][disabled]')->count());
		self::assertSame(1, $crawler->filter('noscript')->count());
		self::assertSame(0, $crawler->filter('[data-abbc3-save-state], [type="submit"], [type="reset"]')->count());
		self::assertSame(3, $crawler->filter('[data-composer-column]')->count());
		self::assertSame(0, $crawler->filter('[data-composer-column] select')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-key="core:bold"]')->count());
		self::assertSame(1, $crawler->filter('[data-key="bbcode:fade"] .abbc3-item-select--text')->count());
		self::assertSame(1, $crawler->filter('[data-key="bbcode:fade"] [data-item-icon][hidden]')->count());
		self::assertSame(1, $crawler->filter('[data-inspector-font-icon]')->count());
		self::assertSame(1, $crawler->filter('[data-inspector-icon-select] option[value=""]')->count());
		self::assertSame(4, $crawler->filter('.abbc3-settings-group .abbc3-setting-row input[type="checkbox"]')->count());
		self::assertSame(1, $crawler->filter('.abbc3-settings-group + fieldset [data-abbc3-composer]')->count());
		self::assertSame(2, $crawler->filter('.abbc3-integration-status')->count());
		self::assertStringNotContainsString('BBCODE_B_HELP', $crawler->text());
		self::assertSame($this->lang('BBCODE_B_HELP'), $crawler->filter('[data-key="core:bold"] [data-item-select]')->attr('title'));
		self::assertLessThan(strpos($crawler->html(), $this->lang('ABBC3_LEGEND_ADD_ONS')), strpos($crawler->html(), $this->lang('ABBC3_TOOLBAR_COMPOSER')));

		// Check the BBCodes module is installed in the ABBC3 module
		$this->assertContainsLang('ACP_BBCODES', $crawler->filter("#menu")->text());

		// Submit scoped autosave requests with settings changed
		$form = $crawler->filter('#abbc3_settings')->form();
		$this->submit_ajax_setting($form, 'abbc3_bbcode_bar', 0);
		$this->submit_setting($form, 'abbc3_icons_type', 'svg');
		$this->submit_setting($form, 'abbc3_pipes', 0);
		$this->submit_setting($form, 'abbc3_qr_bbcodes', 1);
		$this->submit_setting($form, 'abbc3_auto_video', 1);
		$crawler = self::submit($form, ['abbc3_save_scope' => 'fonts', 'abbc3_google_fonts' => "Droid Sans\nRoboto"]);
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->filter('.successbox')->text());
		self::assertSame(0, (int) $this->get_bbcode_display_state('pipes'));

		// Verify ABBC3 module settings have been updated
		$crawler = self::request('GET', 'adm/index.php?i=\vse\abbc3\acp\abbc3_module&mode=settings&sid=' . $this->sid);
		$this->assertContainsLang('ACP_ABBC3_MODULE', $crawler->text());
		self::assertSame(0, $crawler->filter('input[name="abbc3_bbcode_bar"][checked]')->count());
		self::assertSame(1, $crawler->filter('input[name="abbc3_qr_bbcodes"][checked]')->count());
		self::assertSame(0, $crawler->filter('input[name="abbc3_pipes"][checked]')->count());
		self::assertSame(1, $crawler->filter('input[name="abbc3_auto_video"][checked]')->count());
		self::assertSame('svg', $crawler->filter('input[name="abbc3_icons_type"][checked]')->attr('value'));
		self::assertEquals("Droid Sans\nRoboto", $crawler->filter('textarea#abbc3_google_fonts')->text());

		// Restore settings needed for future functional tests
		$form = $crawler->filter('#abbc3_settings')->form();
		$this->submit_setting($form, 'abbc3_bbcode_bar', 1);
		$this->submit_setting($form, 'abbc3_qr_bbcodes', 1);
		$this->submit_setting($form, 'abbc3_icons_type', 'png');
		$crawler = $this->submit_setting($form, 'abbc3_pipes', 1);
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->filter('.successbox')->text());
		self::assertSame(1, (int) $this->get_bbcode_display_state('pipes'));

		// While we're here, lets enable quick reply, so we can test that later
		$crawler = self::request('GET', "adm/index.php?i=acp_forums&icat=6&mode=manage&parent_id=1&f=2&action=edit&sid=$this->sid");
		$form_data = ['enable_quick_reply' => 1];
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form, $form_data);
		self::assertGreaterThan(0, $crawler->filter('.successbox')->count());
	}

	/**
	 * Submit one setting using the standard ACP form.
	 *
	 * @param \Symfony\Component\DomCrawler\Form $form ACP settings form
	 * @param string $name Setting name
	 * @param string|int $value Submitted setting value
	 * @return \Symfony\Component\DomCrawler\Crawler ACP response
	 */
	protected function submit_setting($form, $name, $value)
	{
		return self::submit($form, [
			'abbc3_save_scope' => 'setting',
			'setting_name' => $name,
			'setting_value' => $value,
		]);
	}

	/**
	 * Submit one setting via AJAX and verify the success response.
	 *
	 * @param \Symfony\Component\DomCrawler\Form $form ACP settings form
	 * @param string $name Setting name
	 * @param string|int $value Submitted setting value
	 * @return void
	 */
	protected function submit_ajax_setting($form, $name, $value)
	{
		self::$client->setServerParameter('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
		self::submit($form, [
			'abbc3_save_scope' => 'setting',
			'setting_name' => $name,
			'setting_value' => $value,
		], false);
		$response = json_decode(self::get_content(), true);
		self::$client->setServerParameter('HTTP_X_REQUESTED_WITH', '');
		self::assertTrue($response['S_USER_NOTICE']);
	}

	/**
	 * Read the posting visibility flag for the supplied tag.
	 *
	 * @param string $tag Stored BBCode tag
	 * @return mixed Stored display flag, or false if the row is missing
	 */
	protected function get_bbcode_display_state($tag)
	{
		$db = $this->get_db();
		$result = $db->sql_query('SELECT display_on_posting FROM ' . BBCODES_TABLE . " WHERE bbcode_tag = '" . $db->sql_escape($tag) . "'");
		$state = $db->sql_fetchfield('display_on_posting');
		$db->sql_freeresult($result);
		return $state;
	}
}
