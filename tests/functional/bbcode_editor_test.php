<?php
/**
*
* Advanced BBCode Box
*
* @copyright (c) 2014 Matt Friedman
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace vse\abbc3\tests\functional;

use vse\abbc3\core\toolbar_repository;

/**
* @group functional
*/
class bbcode_editor_test extends \phpbb_functional_test_case
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
		$this->get_db();
		$this->db->sql_query("UPDATE " . self::$config['table_prefix'] . "abbc3_toolbar SET font_icon = 'star', icon = 'glow' WHERE button_key = 'bbcode:glow'");
		$this->db->sql_query("UPDATE " . self::$config['table_prefix'] . "abbc3_toolbar SET font_icon = '', icon = '' WHERE button_key = 'bbcode:fade'");
		$this->db->sql_query("UPDATE " . CONFIG_TABLE . " SET config_value = '1' WHERE config_name = 'allow_cdn'");
		$this->db->sql_query("UPDATE " . CONFIG_TEXT_TABLE . " SET config_value = '[\"Droid Sans\",\"Roboto\"]' WHERE config_name = 'abbc3_google_fonts'");
		$this->purge_cache();
		$this->login();
	}

	/**
	* Test posting page for presence of our BBCodes template data
	*/
	public function test_posting_page()
	{
		$crawler = self::request('GET', 'posting.php?mode=post&f=2&sid=' . $this->sid);
		$this->run_checks($crawler);
		self::assertSame(0, $crawler->filter('[data-abbc3-acp]')->count());
	}

	public function test_dividers_only_split_visible_controls()
	{
		$repository = new toolbar_repository($this->db, self::$config['table_prefix']);
		$original = [];
		foreach ($repository->get_layout() as $row)
		{
			$original[$row['placement']][] = $row['button_type'] === toolbar_repository::SEPARATOR ? toolbar_repository::SEPARATOR : $row['button_key'];
		}

		try
		{
			$repository->save_layout([
				'primary' => ['separator', 'core:bold', 'separator', 'core:media', 'separator', 'core:italic', 'separator'],
				'more' => ['separator', 'core:underline', 'separator', 'core:image', 'separator'],
			], [], []);

			$url = 'posting.php?mode=post&f=2&sid=' . $this->sid;
			$crawler = self::request('GET', $url);
			$groups = $crawler->filter('.abbc3-toolbar__surface .abbc3-toolbar__group');
			self::assertCount(2, $groups);
			self::assertCount(1, $groups->eq(0)->filter('[data-abbc3-name="bold"]'));
			self::assertCount(1, $groups->eq(1)->filter('[data-abbc3-name="italic"]'));
			self::assertCount(1, $crawler->filter('.abbc3-toolbar__surface .abbc3-toolbar__group--divided'));
			self::assertCount(1, $crawler->filter('.abbc3-more__tray .abbc3-toolbar__group--divided [data-abbc3-name="img"]'));

			$repository->save_layout([
				'primary' => ['core:bold', 'separator', 'core:media'],
				'more' => ['separator', 'core:media', 'separator'],
			], [], []);
			$crawler = self::request('GET', $url);
			self::assertCount(1, $crawler->filter('.abbc3-toolbar__surface > [data-abbc3-name="bold"]'));
			self::assertCount(0, $crawler->filter('.abbc3-toolbar__group'));
			self::assertCount(0, $crawler->filter('[data-abbc3-more-toggle], [data-abbc3-more-tray]'));
		}
		finally
		{
			$repository->save_layout($original, [], []);
		}
	}

	/**
	* Test PM posting page for presence of our BBCodes template data
	*/
	public function test_pm_posting_page()
	{
		$crawler = self::request('GET', 'ucp.php?i=pm&mode=compose&sid=' . $this->sid);
		$this->run_checks($crawler);
	}

	/**
	 * Test quick reply for presence of our BBCodes template data
	 */
	public function test_quick_reply()
	{
		$crawler = self::request('GET', 'viewtopic.php?f=2&p=1&sid=' . $this->sid);
		$this->run_checks($crawler);
	}

	/**
	 * Test ACP user signature for presence of our BBCodes template data
	 */
	public function test_acp_posting_page()
	{
		$this->admin_login();
		$crawler = self::request('GET', 'adm/index.php?i=users&u=2&mode=sig&sid=' . $this->sid);
		$this->run_checks($crawler);
		self::assertSame(1, $crawler->filter('form#user_signature [data-abbc3-toolbar][data-abbc3-acp]')->count());
	}

	/**
	 * Checks to run to assert ABBC3 is loaded
	 *
	 * @param \Symfony\Component\DomCrawler\Crawler $crawler Editor response
	 * @return void
	 */
	protected function run_checks($crawler)
	{
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-toolbar]')->count());
		self::assertGreaterThan(0, $crawler->filter('[role="toolbar"]')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-more-toggle]')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-more-tray]')->count());
		self::assertGreaterThan(0, $crawler->filter('.abbc3-control__icon[src*="/images/icons/"]')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-font-value="Droid Sans"][style*="font-family"]')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-font-value="Roboto"][style*="font-family"]')->count());
		self::assertGreaterThanOrEqual(2, $crawler->filter('.abbc3-menu__panel--font .abbc3-menu__group')->count());
		self::assertSame(0, $crawler->filter('[data-abbc3-size-value][style*="font-size"]')->count());
		self::assertGreaterThan(0, $crawler->filter('link[href*="fonts.googleapis.com/css2?"][href*="family=Droid%20Sans"]')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-name="img"]')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-name="url"]')->count());
		self::assertGreaterThan(0, $crawler->filter('[data-abbc3-name="plain"]')->count());
		self::assertSame(0, $crawler->filter('.abbc3-more__count')->count());
		self::assertNotEmpty($crawler->filter('[data-abbc3-more-toggle]')->attr('title'));
		foreach (['glow', 'shadow', 'dropshadow', 'blur', 'fade', 'marq'] as $bbcode)
		{
			self::assertGreaterThan(0, $crawler->filter('[data-abbc3-name="' . $bbcode . '"]')->count());
		}
		self::assertSame(1, $crawler->filter('[data-abbc3-name="glow"] .fa-star')->count());
		self::assertSame(0, $crawler->filter('[data-abbc3-name="glow"] img')->count());
		self::assertSame(0, $crawler->filter('[data-abbc3-name="fade"] .abbc3-control__fallback--hidden')->count());
		self::assertSame(0, $crawler->filter('[data-abbc3-name="soundcloud"]')->count());

		// test a couple of dynamic bbcodes set in the javascript
		self::assertStringContainsString('[dir=rtl]', $crawler->filter('body')->html());
		self::assertStringContainsString('[mod=admin]', $crawler->filter('body')->html());
	}
}
