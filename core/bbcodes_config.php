<?php
/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\core;

use s9e\TextFormatter\Configurator;
use s9e\TextFormatter\Configurator\Items\TemplateDocument;

/**
 * ABBC3 custom BBCodes configurator
 */
class bbcodes_config
{
	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $php_ext;

	public function __construct($phpbb_root_path, $phpEx)
	{
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
	}

	/**
	 * Configure s9e Auto Video plugin
	 *
	 * @param Configurator $configurator
	 * @access public
	 */
	public function auto_video(Configurator $configurator): void
	{
		if (!$configurator->registeredVars['abbc3.auto_video_enabled'])
		{
			return;
		}

		$configurator->plugins->load('Autovideo');

		/** @var TemplateDocument $dom Add class "auto-video" to allow us to style the video with our CSS */
		$dom = $configurator->tags['VIDEO']->template->asDOM();
		foreach ($dom->getElementsByTagName('video') as $video)
		{
			$video->setAttribute('class', 'auto-video');
		}
		$dom->saveChanges();
	}

	/**
	 * Configure s9e Pipes table plugin
	 *
	 * @param Configurator $configurator
	 * @access public
	 */
	public function pipes(Configurator $configurator): void
	{
		if (!isset($configurator->BBCodes['pipes']) || !$configurator->registeredVars['abbc3.pipes_enabled'])
		{
			return;
		}

		$configurator->plugins->load('PipeTables');

		/** @var TemplateDocument $dom Add class "pipe-table" to allow us to style the table with our CSS */
		$dom = $configurator->tags['TABLE']->template->asDOM();
		foreach ($dom->getElementsByTagName('table') as $table)
		{
			$table->setAttribute('class', 'pipe-table');
		}
		$dom->saveChanges();
	}

	/**
	 * Configure BBVideo to use the MEDIA tag with the Media Embed plugin
	 *
	 * @param Configurator $configurator
	 * @access public
	 */
	public function bbvideo(Configurator $configurator): void
	{
		if (!isset($configurator->BBCodes['bbvideo']))
		{
			return;
		}

		// If MediaEmbed is not already active (for example, due to another ext), let's enable it
		if (!isset($configurator->MediaEmbed) && !isset($configurator->BBCodes['MEDIA']))
		{
			foreach ($configurator->MediaEmbed->defaultSites as $tagName => $tag)
			{
				if (!isset($configurator->BBCodes[$tagName]))
				{
					$configurator->MediaEmbed->add($tagName);
				}
			}
		}

		unset($configurator->BBCodes['bbvideo'], $configurator->tags['bbvideo']);
		$configurator->BBCodes->add(
			'bbvideo',
			[
				'contentAttributes' => ['url'],
				'tagName'           => 'MEDIA',
			]
		);
	}

	/**
	 * Configure Hidden BBCode
	 *
	 * @param Configurator $configurator
	 * @access public
	 */
	public function hidden(Configurator $configurator): void
	{
		if (!isset($configurator->BBCodes['hidden']))
		{
			return;
		}

		$u_login = append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=login');
		$u_register = append_sid("{$this->phpbb_root_path}ucp.$this->php_ext", 'mode=register');

		unset($configurator->BBCodes['hidden'], $configurator->tags['hidden']);
		$configurator->BBCodes->addCustom(
			'[hidden]{TEXT}[/hidden]',
			'<xsl:choose>
				<xsl:when test="$S_USER_LOGGED_IN and not($S_IS_BOT)">
					<div class="hc-box hc-box--member">
						<div class="hc-header">
							<span class="hc-lock" aria-hidden="true"></span>
							<strong>{L_ABBC3_HIDDEN_OFF}</strong>
						</div>
						<div class="hc-content">
							{TEXT}
						</div>
					</div>
				</xsl:when>
				<xsl:otherwise>
					<div class="hc-box" role="group" aria-label="{L_ABBC3_HIDDEN_ON}">
						<div class="hc-overlay">
							<span class="hc-lock" aria-hidden="true"></span>
							<div class="hc-text">
								<strong>{L_ABBC3_HIDDEN_ON}</strong>
								<span>{L_ABBC3_HIDDEN_EXPLAIN}</span>
								<div class="hc-actions">
									<a class="hc-btn" href="' . $u_login . '&redirect={U_USER_PAGE_ABBC3}">{L_LOGIN}</a>
									<a class="hc-btn hc-btn--primary" href="' . $u_register . '">{L_REGISTER}</a>
								</div>
							</div>
						</div>
					</div>
				</xsl:otherwise>
			</xsl:choose>'
		);
	}
}
