<?php
/**
*
* @package ABBC3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\migrations;

class remove extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . MODULES_TABLE . "
			WHERE module_class = 'acp'
				AND module_langname = 'ACP_ABBCODES'";
		$result = $this->db->sql_query($sql);
		$module_id = $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return $module_id == false;
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'clicks',
			),
			'drop_columns'		=> array(
				$this->table_prefix . 'users'		=> array(
					'user_abbcode_mod',
					'user_abbcode_compact',
				),
				$this->table_prefix . 'bbcodes'		=> array(
					'upload',
					'html',
					'display_on_pm',
					'display_on_sig',
					'abbcode',
					'bbcode_image',
					'bbcode_order',
					'bbcode_group',
				),
			),
			'change_columns'	=> array(
				$this->table_prefix . 'bbcodes'		=> array(
					'bbcode_id'		=> array('USINT', 0),
				),
			),
		);
	}

	public function update_data()
	{
		return array(
			// Custom functions
			array('custom', array(array($this, 'remove_abbc3_configs'))),
			array('custom', array(array($this, 'remove_abbc3_modules'))),
		);
	}

	public function remove_abbc3_configs()
	{
		$abbc3_config_names = array(
			'ABBC3_MOD',
			'ABBC3_BG',
			'ABBC3_TAB',
			'ABBC3_BOXRESIZE',
			'ABBC3_RESIZE',
			'ABBC3_RESIZE_METHOD',
			'ABBC3_RESIZE_BAR',
			'ABBC3_MAX_IMG_WIDTH',
			'ABBC3_MAX_IMG_HEIGHT',
			'ABBC3_RESIZE_SIGNATURE',
			'ABBC3_MAX_SIG_WIDTH',
			'ABBC3_MAX_SIG_HEIGHT',
			'ABBC3_MAX_THUM_WIDTH',
			'ABBC3_COLOR_MODE',
			'ABBC3_HIGHLIGHT_MODE',
			'ABBC3_WIZARD_MODE',
			'ABBC3_WIZARD_width',
			'ABBC3_WIZARD_height',
			'ABBC3_VIDEO_width',
			'ABBC3_VIDEO_height',
			'ABBC3_VIDEO_OPTIONS',
			'ABBC3_VIDEO_WMODE',
			'ABBC3_UCP_MODE',
			'ABBC3_PATH',
			'ABBC3_GREYBOX',
			'ABBC3_JAVASCRIPT',
			'ABBC3_UPLOAD_MAX_SIZE',
			'ABBC3_UPLOAD_EXTENSION',
		);

		// Delete all the unwanted ABBC3 configs
		$sql = 'DELETE FROM ' . CONFIG_TABLE . '
			WHERE ' . $this->db->sql_in_set('config_name', $abbc3_config_names);
		$this->db->sql_query($sql);
	}
	
	public function remove_abbc3_modules()
	{
		$abbc3_modules = array(
			'ACP_ABBC3_BBCODES',
			'ACP_ABBC3_SETTINGS',
			'ACP_ABBCODES',
		);

		if (!class_exists('acp_modules'))
		{
			include($this->phpbb_root_path . 'includes/acp/acp_modules.' . $this->php_ext);
		}
		// acp_modules calls adm_back_link, which is undefined at this point
		if (!function_exists('adm_back_link'))
		{
			include($this->phpbb_root_path . 'includes/functions_acp.' . $this->php_ext);
		}
		$module_manager = new \acp_modules();
		$module_manager->module_class = 'acp';

		foreach ($abbc3_modules as $module_langname)
		{
			$sql = 'SELECT module_id FROM ' . MODULES_TABLE . "
				WHERE module_langname = '$module_langname'";
			$result = $this->db->sql_query($sql);
			$module_id = $this->db->sql_fetchfield('module_id');
			$this->db->sql_freeresult($result);
			
			if (!empty($module_id))
			{
				$module_manager->delete_module($module_id);
			}
		}
	}
}
