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
	 * Keep BBVideo distinct for group checks and send allowed tags to Media Embed.
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

		if (!isset($configurator->tags['MEDIA']))
		{
			return;
		}

		unset($configurator->BBCodes['bbvideo'], $configurator->tags['bbvideo']);
		$configurator->BBCodes->add(
			'bbvideo',
			[
				'contentAttributes' => ['url'],
				'tagName'           => 'BBVIDEO',
			]
		);

		$configurator->tags->add('BBVIDEO')->filterChain->prepend([self::class, 'forward_bbvideo_to_media'])
			->resetParameters()
			->addParameterByName('tag')
			->addParameterByName('parser');
	}

	/**
	 * Forward a permitted paired or standalone BBVideo tag to Media Embed.
	 *
	 * @param \s9e\TextFormatter\Parser\Tag $tag Parsed BBVideo tag
	 * @param \s9e\TextFormatter\Parser $parser Active TextFormatter parser
	 * @return void
	 */
	public static function forward_bbvideo_to_media($tag, $parser)
	{
		$end_tag = $tag->getEndTag();
		if ($end_tag)
		{
			$parser->addTagPair('MEDIA', $tag->getPos(), $tag->getLen(), $end_tag->getPos(), $end_tag->getLen(), $tag->getSortPriority())
				->setAttribute('url', $tag->getAttribute('url'));
		}
		else if ($tag->hasAttribute('url'))
		{
			$parser->addSelfClosingTag('MEDIA', $tag->getPos(), $tag->getLen(), $tag->getSortPriority())
				->setAttribute('url', $tag->getAttribute('url'));
		}

		$tag->invalidate();
	}
}
