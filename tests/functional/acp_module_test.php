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

	protected function setUp(): void
	{
		parent::setUp();
		$this->add_lang_ext('vse/abbc3', 'info_acp_abbc3');
	}

	public function test_module_page()
	{
		$this->login();
		$this->admin_login();

		// Check ABBC3 ACP module
		$crawler = self::request('GET', 'adm/index.php?i=\vse\abbc3\acp\abbc3_module&mode=settings&sid=' . $this->sid);
		$this->assertContainsLang('ACP_ABBC3_MODULE', $crawler->text());
		self::assertEquals('1', $crawler->filter('input[name="abbc3_bbcode_bar"][checked]')->attr('value'));
		self::assertEquals('0', $crawler->filter('input[name="abbc3_qr_bbcodes"][checked]')->attr('value'));
		self::assertEquals('1', $crawler->filter('input[name="abbc3_pipes"][checked]')->attr('value'));
		self::assertEquals('0', $crawler->filter('input[name="abbc3_auto_video"][checked]')->attr('value'));
		self::assertEquals('png', $crawler->filter('option[selected]')->attr('value'));
		self::assertEquals('', $crawler->filter('textarea#abbc3_google_fonts')->text());

		// Check the BBCodes module is installed in the ABBC3 module
		$this->assertContainsLang('ACP_BBCODES', $crawler->filter("#menu")->text());

		// Submit form with settings changed
		$form_data = [
			'abbc3_bbcode_bar'	=> 0,
			'abbc3_icons_type'	=> 'svg',
			'abbc3_pipes'		=> 0,
			'abbc3_qr_bbcodes'	=> 1,
			'abbc3_auto_video'	=> 1,
			'abbc3_google_fonts'=> "Droid Sans\nRoboto",
		];
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form, $form_data);
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->filter('.successbox')->text());

		// Verify ABBC3 module settings have been updated
		$crawler = self::request('GET', 'adm/index.php?i=\vse\abbc3\acp\abbc3_module&mode=settings&sid=' . $this->sid);
		$this->assertContainsLang('ACP_ABBC3_MODULE', $crawler->text());
		self::assertEquals('0', $crawler->filter('input[name="abbc3_bbcode_bar"][checked]')->attr('value'));
		self::assertEquals('1', $crawler->filter('input[name="abbc3_qr_bbcodes"][checked]')->attr('value'));
		self::assertEquals('0', $crawler->filter('input[name="abbc3_pipes"][checked]')->attr('value'));
		self::assertEquals('1', $crawler->filter('input[name="abbc3_auto_video"][checked]')->attr('value'));
		self::assertEquals('svg', $crawler->filter('option[selected]')->attr('value'));
		self::assertEquals("Droid Sans\nRoboto", $crawler->filter('textarea#abbc3_google_fonts')->text());

		// Resubmit form with settings needed for future functional tests
		$form_data = [
			'abbc3_bbcode_bar'	=> 1,
			'abbc3_qr_bbcodes'	=> 1,
			'abbc3_icons_type'	=> 'png',
			'abbc3_pipes'		=> 1,
			'abbc3_auto_video'	=> 1,
		];
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form, $form_data);
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->filter('.successbox')->text());

		// While we're here, lets enable quick reply, so we can test that later
		$crawler = self::request('GET', "adm/index.php?i=acp_forums&icat=6&mode=manage&parent_id=1&f=2&action=edit&sid=$this->sid");
		$form_data = ['enable_quick_reply' => 1];
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form, $form_data);
		self::assertGreaterThan(0, $crawler->filter('.successbox')->count());
	}
}
