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
	 * Configure s9e Pipes table plugin
	 *
	 * @param Configurator $configurator
	 * @access public
	 */
	public function pipes(Configurator $configurator)
	{
		if (!isset($configurator->BBCodes['pipes']))
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
					<div class="hidebox hidebox_visible">
						<div class="hidebox_title hidebox_visible">{L_ABBC3_HIDDEN_OFF}</div>
						<div class="hidebox_visible">{TEXT}</div>
					</div>
				</xsl:when>
				<xsl:otherwise>
					<div class="hidebox hidebox_hidden">
						<div class="hidebox_title hidebox_hidden">{L_ABBC3_HIDDEN_ON}</div>
						<div class="hidebox_hidden">{L_ABBC3_HIDDEN_EXPLAIN}</div>
					</div>
				</xsl:otherwise>
			</xsl:choose>'
		);
	}
}
