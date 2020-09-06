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

	public function setUp(): void
	{
		parent::setUp();
		$this->add_lang_ext('vse/abbc3', 'info_acp_abbc3');
	}

	public function test_module_page()
	{
		$this->login();
		$this->admin_login();

		// Check ACP page
		$crawler = self::request('GET', 'adm/index.php?i=\vse\abbc3\acp\abbc3_module&mode=settings&sid=' . $this->sid);
		$this->assertContainsLang('ACP_ABBC3_MODULE', $crawler->text());
		self::assertEquals('1', $crawler->filter('input[name="abbc3_bbcode_bar"][checked]')->attr('value'));
		self::assertEquals('1', $crawler->filter('input[name="abbc3_pipes"][checked]')->attr('value'));
		self::assertEquals('png', $crawler->filter('option[selected]')->attr('value'));

		// Submit form
		$form_data = [
			'abbc3_bbcode_bar'	=> 0,
			'abbc3_icons_type'	=> 'svg',
			'abbc3_pipes'		=> 0,
		];
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form, $form_data);
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->filter('.successbox')->text());

		// Check ACP page again
		$crawler = self::request('GET', 'adm/index.php?i=\vse\abbc3\acp\abbc3_module&mode=settings&sid=' . $this->sid);
		$this->assertContainsLang('ACP_ABBC3_MODULE', $crawler->text());
		self::assertEquals('0', $crawler->filter('input[name="abbc3_bbcode_bar"][checked]')->attr('value'));
		self::assertEquals('0', $crawler->filter('input[name="abbc3_pipes"][checked]')->attr('value'));
		self::assertEquals('svg', $crawler->filter('option[selected]')->attr('value'));

		// Resubmit form with original settings
		$form_data = [
			'abbc3_bbcode_bar'	=> 1,
			'abbc3_icons_type'	=> 'png',
			'abbc3_pipes'		=> 1,
		];
		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();
		$crawler = self::submit($form, $form_data);
		$this->assertContainsLang('CONFIG_UPDATED', $crawler->filter('.successbox')->text());
	}
}
