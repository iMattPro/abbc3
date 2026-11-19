<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\core;

use phpbb\cache\driver\driver_interface;
use phpbb\config\db_text;
use phpbb\db\driver\driver_interface as db;

class uninstall_manager
{
	protected $db;
	protected $config_text;
	protected $cache;
	protected $catalog;
	protected $parser_key;
	protected $renderer_key;
	protected $root_path;
	protected $php_ext;

	public function __construct(db $db, db_text $config_text, driver_interface $cache, bbcode_catalog $catalog, $parser_key, $renderer_key, $root_path, $php_ext)
	{
		$this->db = $db;
		$this->config_text = $config_text;
		$this->cache = $cache;
		$this->catalog = $catalog;
		$this->parser_key = $parser_key;
		$this->renderer_key = $renderer_key;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	public function prepare_disable()
	{
		if ($this->config_text->get('abbc3_disable_state') !== null)
		{
			return;
		}
		$state = ['managed' => [], 'unmanaged' => []];
		$this->db->sql_transaction('begin');
		try
		{
			$sql = 'SELECT bbcode_id, bbcode_tag, bbcode_match, bbcode_tpl, display_on_posting
				FROM ' . BBCODES_TABLE . "
				WHERE bbcode_helpline " . $this->db->sql_like_expression('ABBC3_' . $this->db->get_any_char());
			$result = $this->db->sql_query($sql);
			while ($row = $this->db->sql_fetchrow($result))
			{
				$entry = $this->catalog->get($row['bbcode_tag']);
				if (!$entry || $entry['match'] !== $row['bbcode_match'] || !hash_equals(hash('sha256', $entry['enhanced']), hash('sha256', $row['bbcode_tpl'])))
				{
					$state['unmanaged'][$row['bbcode_id']] = (int) $row['display_on_posting'];
					continue;
				}
				$state['managed'][$row['bbcode_id']] = [
					'template' => $row['bbcode_tpl'],
					'match' => $row['bbcode_match'],
					'display' => (int) $row['display_on_posting'],
				];
				$data = $this->build_definition($row['bbcode_match'], $entry['fallback']);
				$data['display_on_posting'] = 0;
				$sql = 'UPDATE ' . BBCODES_TABLE . '
					SET ' . $this->db->sql_build_array('UPDATE', $data) . "
					WHERE bbcode_id = " . (int) $row['bbcode_id'];
				$this->db->sql_query($sql);
			}
			$this->db->sql_freeresult($result);
			$this->config_text->set('abbc3_disable_state', json_encode($state));
			$this->db->sql_transaction('commit');
		}
		catch (\Throwable $e)
		{
			$this->db->sql_transaction('rollback');
			throw $e;
		}
		$this->clear_formatter_cache();
	}

	public function restore_enable()
	{
		$state = json_decode($this->config_text->get('abbc3_disable_state'), true);
		if (!is_array($state))
		{
			return;
		}
		foreach (($state['managed'] ?? []) as $bbcode_id => $original)
		{
			$sql = 'SELECT bbcode_tag, bbcode_match, bbcode_tpl FROM ' . BBCODES_TABLE . ' WHERE bbcode_id = ' . (int) $bbcode_id;
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);
			$entry = $row ? $this->catalog->get($row['bbcode_tag']) : null;
			if (!$entry || $row['bbcode_match'] !== $original['match'] || !hash_equals(hash('sha256', $entry['fallback']), hash('sha256', $row['bbcode_tpl'])))
			{
				continue;
			}
			$data = $this->build_definition($original['match'], $original['template']);
			$data['display_on_posting'] = (int) $original['display'];
			$sql = 'UPDATE ' . BBCODES_TABLE . '
				SET ' . $this->db->sql_build_array('UPDATE', $data) . '
				WHERE bbcode_id = ' . (int) $bbcode_id;
			$this->db->sql_query($sql);
		}
		$this->config_text->delete('abbc3_disable_state');
		$this->clear_formatter_cache();
	}

	public function finish_purge()
	{
		$state = json_decode($this->config_text->get('abbc3_disable_state'), true);
		foreach (($state['unmanaged'] ?? []) as $bbcode_id => $display)
		{
			$this->db->sql_query('UPDATE ' . BBCODES_TABLE . '
				SET display_on_posting = ' . (int) $display . '
				WHERE bbcode_id = ' . (int) $bbcode_id);
		}
		$this->config_text->delete('abbc3_disable_state');
		$this->config_text->delete('abbc3_bbcodes');
		$this->clear_formatter_cache();
	}

	protected function clear_formatter_cache()
	{
		$this->cache->destroy($this->parser_key);
		$this->cache->destroy($this->renderer_key);
	}

	protected function build_definition($match, $template)
	{
		if (!class_exists('acp_bbcodes'))
		{
			include $this->root_path . 'includes/acp/acp_bbcodes.' . $this->php_ext;
		}
		$compiled = (new \acp_bbcodes())->build_regexp($match, $template);

		return [
			'bbcode_tpl' => $template,
			'first_pass_match' => $compiled['first_pass_match'],
			'first_pass_replace' => $compiled['first_pass_replace'],
			'second_pass_match' => $compiled['second_pass_match'],
			'second_pass_replace' => $compiled['second_pass_replace'],
		];
	}
}
