<?php
/**
*
* @package ABBC3
* @copyright (c) 2013 Matt Friedman
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace vse\abbc3\migrations;

class v310_remove_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		$sql = 'SELECT module_id
			FROM ' . $this->table_prefix . "modules
			WHERE module_class = 'acp'
				AND module_langname = 'ACP_ABBCODES'";
		$result = $this->db->sql_query($sql);
		$module_id = $this->db->sql_fetchfield('module_id');
		$this->db->sql_freeresult($result);

		return $module_id == false;
	}

	static public function depends_on()
	{
		return array('\vse\abbc3\migrations\v310_remove_schema');
	}

	public function update_data()
	{
		return array(
			array('if', array(
				array('module.exists', array('acp', false, 'ACP_ABBC3_BBCODES')),
				array('module.remove', array('acp', false, 'ACP_ABBC3_BBCODES')),
			)),
			array('if', array(
				array('module.exists', array('acp', false, 'ACP_ABBC3_SETTINGS')),
				array('module.remove', array('acp', false, 'ACP_ABBC3_SETTINGS')),
			)),
			array('if', array(
				array('module.exists', array('acp', false, 'ACP_ABBCODES')),
				array('module.remove', array('acp', false, 'ACP_ABBCODES')),
			)),

			// Custom functions
			array('custom', array(array($this, 'remove_abbc3_configs'))),
			array('custom', array(array($this, 'delete_abbc3_bbcodes'))),
		);
	}

	public function remove_abbc3_configs()
	{
		$abbc3_config_names = array(
			'ABBC3_VERSION',
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
		$sql = 'DELETE FROM ' . $this->table_prefix . 'config
			WHERE ' . $this->db->sql_in_set('config_name', $abbc3_config_names);
		$this->db->sql_query($sql);
	}

	public function delete_abbc3_bbcodes()
	{
		$abbc3_bbcode_deprecated = $this->abbc3_bbcodes();

		// Add all breaks and divisions to the array
		$sql = 'SELECT bbcode_tag
			FROM ' . $this->table_prefix . "bbcodes
			WHERE bbcode_tag LIKE 'break%' OR bbcode_tag LIKE 'division%' ";

		$result = $this->db->sql_query($sql);
		while ($row = $this->db->sql_fetchrow($result))
		{
			$abbc3_bbcode_deprecated[] = $row['bbcode_tag'];
		}
		$this->db->sql_freeresult($result);

		// Delete all the unwanted bbcodes
		$sql = 'DELETE FROM ' . $this->table_prefix . 'bbcodes
			WHERE ' . $this->db->sql_in_set('bbcode_tag', $abbc3_bbcode_deprecated);
		$this->db->sql_query($sql);
	}
	
	public function abbc3_bbcodes()
	{
		return array(
			// exists in core
			'b',
			'code',
			'color',
			'email',
			'flash',
			'i',
			'img=',
			'listb',
			'listitem',
			'listo',
			'quote',
			'size',			
			'u',
			'url',
			'url=',

			// not really bbcodes
			'copy',
			'cut',
			'grad',
			'paste',
			'plain',
			'imgshack',

			// deprecated
			'click',		// click_pass
			'ed2k',
			'flv',			// auto_embed_video
			'quicktime',
			'ram',
			'rapidshare',	// rapidshare_pass
			'stream',
			'testlink',		// testlink_pass
			'video',
			'wave=',		// Text_effect_pass
			'web',
	 		'scrippet',		// scrippets_pass
	 		'search',		// search_pass
			'thumbnail',	// thumb_pass
			'hr',			// no closing
			'tab=',			// no closing
	 		'tabs',			// simpleTabs_pass
	 		'table=',		// table_pass
	 		'anchor=',		// anchor_pass
	 		'upload',
	 		'html',
			'collegehumor',	// auto_embed_video
			'dm',			// auto_embed_video
			'gamespot',		// auto_embed_video
			'ignvideo',		// auto_embed_video
			'liveleak',		// auto_embed_video
			'veoh',			// auto_embed_video

			// replaced by new bbcodes
			'align=justify',	// replaced by align=
			'align=left',		// replaced by align=
			'align=right',		// replaced by align=
			'dir=rtl',			// replaced by dir=
			'marq=down',		// replaced by marq=
			'marq=left',		// replaced by marq=
			'marq=right',		// replaced by marq=

			// updated bbcodes
	//		'align=center',	// replaced by align=
	//		'blur=',		// Text_effect_pass
	//		'dir=ltr',		// replaced by dir=
	//		'dropshadow=',	// Text_effect_pass
	//		'fade',
	//		'font=',
	//		'glow=',		// Text_effect_pass
	//		'highlight=',
	//		'marq=up',		// replaced by marq=
	//		'mod=',			// mod_pass
	//		'nfo',			// nfo_pass
	//		'offtopic',		// offtopic_pass
	//		'pre',
	//		's',
	//		'shadow=',		// Text_effect_pass
	//		'spoil',		// spoil_pass
	//		'sub',
	//		'sup',
	//		'youtube',		// BBvideo_pass
	// 		'BBvideo',		// BBvideo_pass
	// 		'hidden',		// hidden_pass
		);
	}
}
