<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2019 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\ui;

use Facebook\WebDriver\WebDriverBy;

/**
 * @group ui
 */
class ui_test extends \phpbb_ui_test_case
{
	/**
	 * {@inheritdoc}
	 */
	public static function setUpBeforeClass()
	{
		// Set these properties to true so we can use the same board created for functional tests
		// instead of having to create and set up a whole new board.
		self::$already_installed = true;
		self::$install_success = true;
		parent::setUpBeforeClass();
	}

	/**
	 * Test JavaScript user interactions
	 *
	 * @throws \Facebook\WebDriver\Exception\NoSuchElementException
	 * @throws \Facebook\WebDriver\Exception\TimeOutException
	 */
	public function test_bbcode_wizard()
	{
		$this->login();
		$this->admin_login();

		$this->visit('posting.php?mode=post&f=2');

		$wizard = $this->find_element('cssSelector', '#bbcode_wizard');
		$this->assertFalse($wizard->isDisplayed());
		$buttons = $this->find_element('cssSelector', '#abbc3_buttons')
			->findElements(WebDriverBy::className('abbc3_button'));
		foreach ($buttons as $button)
		{
			if ($button->getAttribute('title') === 'Create tables')
			{
				$button->click();
				break;
			}
		}
		$this->waitForAjax();
		$this->assertTrue($wizard->isDisplayed());
//		$wizard->findElement(WebDriverBy::name('bbcode_wizard_cancel'))->click();
//		$this->assertFalse($wizard->isDisplayed());
	}
}
