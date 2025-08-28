<?php
/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2018 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace vse\abbc3\core;

use s9e\TextFormatter\Configurator;

/**
 * ABBC3 custom BBCodes configurator
 */
class bbcodes_config
{
	/**
	 * Configure s9e Auto Video plugin
	 *
	 * @param Configurator $configurator
	 * @access public
	 */
	public function auto_video(Configurator $configurator)
	{
		if (!$configurator->registeredVars['abbc3.auto_video_enabled'])
		{
			return;
		}

		$configurator->plugins->load('Autovideo');

		/** @var \s9e\TextFormatter\Configurator\Items\TemplateDocument $dom Add class "auto-video" to allow us to style the video with our CSS */
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
	public function pipes(Configurator $configurator)
	{
		if (!isset($configurator->BBCodes['pipes']) || !$configurator->registeredVars['abbc3.pipes_enabled'])
		{
			return;
		}

		$configurator->plugins->load('PipeTables');

		/** @var \s9e\TextFormatter\Configurator\Items\TemplateDocument $dom Add class "pipe-table" to allow us to style the table with our CSS */
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
	public function bbvideo(Configurator $configurator)
	{
		if (!isset($configurator->BBCodes['bbvideo']))
		{
			return;
		}

		// If MediaEmbed is not already active (for example due to another ext) lets enable it
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
	public function hidden(Configurator $configurator)
	{
		if (!isset($configurator->BBCodes['hidden']))
		{
			return;
		}

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
									<a class="hc-btn" href="ucp.php?mode=login">{L_LOGIN}</a>
									<a class="hc-btn hc-btn--primary" href="ucp.php?mode=register">{L_REGISTER}</a>
								</div>
							</div>
						</div>
					</div>
				</xsl:otherwise>
			</xsl:choose>'
		);
	}
}
