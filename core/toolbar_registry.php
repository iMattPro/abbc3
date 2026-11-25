<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\core;

class toolbar_registry
{
	/** @var toolbar_repository */
	protected $repository;

	/** @var array */
	protected $custom = [];

	public function __construct(toolbar_repository $repository)
	{
		$this->repository = $repository;
	}

	public function add_custom(array $button)
	{
		$this->custom['bbcode:' . strtolower(rtrim($button['tag'], '='))] = $button;
	}

	public function get_buttons()
	{
		$definitions = $this->core_definitions() + $this->custom;
		$layout = $this->repository->get_layout();
		$buttons = ['primary' => [], 'more' => [], 'hidden' => []];

		foreach ($layout as $key => $row)
		{
			if (!isset($definitions[$key]))
			{
				continue;
			}
			$button = $definitions[$key];
			$button['key'] = $key;
			$button['icon'] = $row['icon'];
			$button['font_icon'] = $row['font_icon'];
			$button['order'] = (int) $row['sort_order'];
			$buttons[$row['placement']][] = $button;
		}

		foreach ($buttons as &$group)
		{
			usort($group, static function ($a, $b) {
				return $a['order'] <=> $b['order'];
			});
		}
		unset($group);

		return $buttons;
	}

	public function get_editor_buttons()
	{
		$buttons = $this->get_buttons();
		unset($buttons['hidden']);
		return $buttons;
	}

	public function get_admin_buttons()
	{
		$layout = $this->repository->get_layout();
		$definitions = $this->core_definitions();
		$buttons = ['primary' => [], 'more' => [], 'hidden' => []];
		foreach ($layout as $key => $row)
		{
			$name = !empty($row['bbcode_tag']) ? strtolower(rtrim($row['bbcode_tag'], '=')) : preg_replace('/^[^:]+:/', '', $key);
			$button = $definitions[$key] ?? [
				'type' => $row['button_type'],
				'name' => $name,
				'label' => !empty($row['bbcode_helpline']) ? html_entity_decode($row['bbcode_helpline'], ENT_QUOTES, 'UTF-8') : $name,
				'condition' => '',
			];
			$button['key'] = $key;
			$button['icon'] = $row['icon'];
			$button['font_icon'] = $row['font_icon'];
			$button['order'] = (int) $row['sort_order'];
			$buttons[$row['placement']][] = $button;
		}
		foreach ($buttons as &$group)
		{
			usort($group, static function ($a, $b) {
				return $a['order'] <=> $b['order'];
			});
		}
		unset($group);

		return $buttons;
	}

	protected function core_definitions()
	{
		return [
			'core:bold' => $this->button('bold', 'BBCODE_B_HELP', '[b]', '[/b]', 'b'),
			'core:italic' => $this->button('italic', 'BBCODE_I_HELP', '[i]', '[/i]', 'i'),
			'core:underline' => $this->button('underline', 'BBCODE_U_HELP', '[u]', '[/u]', 'u'),
			'core:quote' => $this->button('quote', 'BBCODE_Q_HELP', '[quote]', '[/quote]', 'q', 'quote'),
			'core:code' => $this->button('code', 'BBCODE_C_HELP', '[code]', '[/code]', 'c'),
			'core:list' => $this->button('listb', 'BBCODE_L_HELP', '[list]', '[/list]', 'l'),
			'core:list_ordered' => $this->button('listo', 'BBCODE_O_HELP', '[list=1]', '[/list]', 'o'),
			'core:list_item' => $this->button('listitem', 'BBCODE_LISTITEM_HELP', '[*]', '', 'y'),
			'core:image' => $this->button('img', 'BBCODE_P_HELP', '[img]', '[/img]', 'p', 'image'),
			'core:url' => $this->button('url', 'BBCODE_W_HELP', '[url]', '[/url]', 'w', 'url', 'wizard'),
			'core:media' => $this->button('media', 'BBCODE_MEDIA_HELP', '[media]', '[/media]', 'm', 'media', 'wizard'),
			'core:color' => ['type' => 'color', 'name' => 'fontcolor', 'label' => 'BBCODE_S_HELP', 'condition' => ''],
			'core:size' => ['type' => 'size', 'name' => 'size', 'label' => 'BBCODE_F_HELP', 'condition' => ''],
			'action:plain' => ['type' => 'plain', 'name' => 'plain', 'label' => 'ABBC3_PLAIN_BBCODE', 'condition' => ''],
		];
	}

	protected function button($name, $label, $open, $close, $accesskey = '', $condition = '', $action = '')
	{
		return [
			'type' => 'button',
			'name' => $name,
			'label' => $label,
			'open' => $open,
			'close' => $close,
			'accesskey' => $accesskey,
			'condition' => $condition,
			'action' => $action,
		];
	}
}
