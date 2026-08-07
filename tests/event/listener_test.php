<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\tests\event;

use vse\abbc3\event\listener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener_test extends listener_base
{
	/**
	 * Test the listener constructor is instantiated
	 */
	public function test_construct(): void
	{
		$this->set_listener();
		$this->assertInstanceOf(EventSubscriberInterface::class, $this->listener);
	}

	/**
	 * Test the event listener is subscribing its events
	 */
	public function test_getSubscribedEvents(): void
	{
		$this->assertEquals([
			'core.user_setup',
			'core.page_header',
			'core.adm_page_header',
			'core.display_custom_bbcodes',
			'core.display_custom_bbcodes_modify_sql',
			'core.display_custom_bbcodes_modify_row',
			'core.text_formatter_s9e_parser_setup',
			'core.text_formatter_s9e_configure_after',
			'core.text_formatter_s9e_renderer_setup',
			'core.help_manager_add_block_after',
			'core.viewtopic_modify_quick_reply_template_vars',
			'core.viewtopic_modify_page_title',
			'core.viewtopic_modify_post_row',
			'core.search_modify_rowset',
			'core.topic_review_modify_post_list',
			'core.mcp_topic_modify_post_data',
		], array_keys(listener::getSubscribedEvents()));
	}

	/**
	 * Test attachment sorting matches viewtopic inline indexes.
	 */
	public function test_sort_attachments()
	{
		$this->set_listener();

		$event = new \phpbb\event\data([
			'attachments' => [
				3 => [
					['attach_id' => 10, 'real_filename' => 'visible.jpg'],
					['attach_id' => 12, 'real_filename' => 'hidden.jpg'],
				],
				4 => [
					['attach_id' => 8, 'real_filename' => 'single.jpg'],
				],
			],
		]);

		$this->listener->sort_attachments($event);

		$attachments = $event['attachments'];

		self::assertSame(12, $attachments[3][0]['attach_id']);
		self::assertSame(10, $attachments[3][1]['attach_id']);
		self::assertSame(8, $attachments[4][0]['attach_id']);
	}

	/**
	 * Test attachments inside [hidden] are not displayed as detached files.
	 */
	public function test_remove_hidden_attachments()
	{
		$this->set_listener();

		$attachments = [3 => [0 => 'hidden', 2 => 'detached']];
		$row = ['post_id' => 3, 'post_text' => '<r/>'];
		$this->bbcodes_display->expects(self::once())
			->method('remove_hidden_attachments')
			->with($attachments, $row)
			->willReturn([3 => [2 => 'detached']]);

		$event = new \phpbb\event\data([
			'attachments' => $attachments,
			'row' => $row,
			'post_row' => ['S_HAS_ATTACHMENTS' => true, 'S_MULTIPLE_ATTACHMENTS' => true],
		]);
		$this->listener->remove_hidden_attachments($event);

		self::assertSame([2 => 'detached'], $event['attachments'][3]);
		self::assertTrue($event['post_row']['S_HAS_ATTACHMENTS']);
		self::assertFalse($event['post_row']['S_MULTIPLE_ATTACHMENTS']);
	}
}
