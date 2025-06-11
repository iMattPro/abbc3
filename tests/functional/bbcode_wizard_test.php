<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\functional;

use phpbb_functional_test_case;

/**
* @group functional
*/
class bbcode_wizard_test extends phpbb_functional_test_case
{
	protected static function setup_extensions(): array
	{
		return ['vse/abbc3'];
	}

	/**
	* Test accessing the bbcode wizard directly, w/o ajax
	*/
	public function test_wizard_fails()
	{
		$crawler = self::request('GET', 'app.php/wizard/bbcode/bbvideo', [], false);
		self::assert_response_status_code(404);
		$this->assertStringContainsString($this->lang('GENERAL_ERROR'), $crawler->text());
	}
}
