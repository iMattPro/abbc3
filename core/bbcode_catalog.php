<?php
/**
 * Advanced BBCode Box
 *
 * @copyright (c) 2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace vse\abbc3\core;

class bbcode_catalog
{
	public function all()
	{
		return [
			'font' => $this->entry('[font={INTTEXT}]{TEXT}[/font]', '<span style="font-family: {INTTEXT}, sans-serif;">{TEXT}</span>', '<span style="font-family:{INTTEXT},sans-serif">{TEXT}</span>'),
			'highlight' => $this->entry('[highlight={COLOR}]{TEXT}[/highlight]', '<span class="abbc3-highlight" style="background-color: {COLOR};">{TEXT}</span>', '<mark style="background-color:{COLOR}">{TEXT}</mark>'),
			'align' => $this->entry('[align={IDENTIFIER}]{TEXT}[/align]', '<div style="text-align:{IDENTIFIER}">{TEXT}</div>', '<div style="text-align:{IDENTIFIER}">{TEXT}</div>'),
			'float' => $this->entry('[float={IDENTIFIER}]{TEXT}[/float]', '<div style="float:{IDENTIFIER}; padding:0 10px;">{TEXT}</div>', '<div style="float:{IDENTIFIER};padding:0 10px">{TEXT}</div>'),
			'pre' => $this->entry('[pre]{TEXT}[/pre]', '<pre class="abbc3_pre" style="display: block; font-family: monospace; white-space: pre;">{TEXT}</pre>', '<pre>{TEXT}</pre>'),
			's' => $this->entry('[s]{TEXT}[/s]', '<span class="abbc3_strike" style="text-decoration: line-through">{TEXT}</span>', '<s>{TEXT}</s>'),
			'sup' => $this->entry('[sup]{TEXT}[/sup]', '<sup>{TEXT}</sup>', '<sup>{TEXT}</sup>'),
			'sub' => $this->entry('[sub]{TEXT}[/sub]', '<sub>{TEXT}</sub>', '<sub>{TEXT}</sub>'),
			'glow' => $this->entry('[glow={COLOR}]{TEXT}[/glow]', '<span class="glow" style="display: inline; padding: 0 6px; color: #ffffff; text-shadow: 0 0 1em {COLOR}, 0 0 1em {COLOR}, 0 0 1.2em {COLOR};">{TEXT}</span>', '<span style="color:{COLOR}">{TEXT}</span>'),
			'shadow' => $this->entry('[shadow={COLOR}]{TEXT}[/shadow]', '<span class="shadow" style="display: inline; padding: 0 6px; color: {COLOR}; text-shadow: -2px 2px 2px #999;">{TEXT}</span>', '<span style="color:{COLOR}">{TEXT}</span>'),
			'dropshadow' => $this->entry('[dropshadow={COLOR}]{TEXT}[/dropshadow]', '<span class="dropshadow" style="display: inline; padding: 0 6px; color: {COLOR}; text-shadow: -1px 1px 0 #999;">{TEXT}</span>', '<span style="color:{COLOR}">{TEXT}</span>'),
			'blur' => $this->entry('[blur={COLOR}]{TEXT}[/blur]', '<span class="blur" style="display: inline; padding: 0 6px; color: transparent; text-shadow: 0 0 0.2em {COLOR};">{TEXT}</span>', '<span style="color:{COLOR}">{TEXT}</span>'),
			'fade' => $this->entry('[fade]{TEXT}[/fade]', '<span class="fadeEffect">{TEXT}</span>', '<span>{TEXT}</span>'),
			'dir' => $this->entry('[dir={IDENTIFIER}]{TEXT}[/dir]', '<bdo dir="{IDENTIFIER}">{TEXT}</bdo>', '<bdo dir="{IDENTIFIER}">{TEXT}</bdo>'),
			'marq' => $this->entry('[marq={IDENTIFIER}]{TEXT}[/marq]', '<div class="abbc3-marquee"><div class="abbc3-marquee-{IDENTIFIER}">{TEXT}</div></div>', '<div>{TEXT}</div>'),
			'spoil' => $this->entry('[spoil]{TEXT}[/spoil]', '<details class="abbc3-spoiler" data-show="{L_ABBC3_SPOILER_SHOW}" data-hide="{L_ABBC3_SPOILER_HIDE}" style="background:#fff;border:1px solid #ddd;border-radius:8px;margin:1em 0;color:#333;overflow:hidden;"><summary style="display:list-item;background:#f1f3f5;font-weight:bold;cursor:pointer;padding:10px 12px;border-bottom:1px solid #ddd;outline:none;">{L_ABBC3_SPOILER_SHOW}</summary><div style="padding:12px 12px 14px 12px;line-height:1.5;">{TEXT}</div></details>', '<details><summary>Spoiler</summary><div>{TEXT}</div></details>'),
			'hidden' => $this->entry('[hidden]{TEXT}[/hidden]', '<xsl:choose><xsl:when test="$S_USER_LOGGED_IN and not($S_IS_BOT)"><div class="hc-box hc-box--member"><div class="hc-header"><span class="hc-lock" aria-hidden="true"></span><strong>{L_ABBC3_HIDDEN_OFF}</strong></div><div class="hc-content">{TEXT}</div></div></xsl:when><xsl:otherwise><div class="hc-box" role="group" aria-label="{L_ABBC3_HIDDEN_ON}"><div class="hc-overlay"><span class="hc-lock" aria-hidden="true"></span><div class="hc-text"><strong>{L_ABBC3_HIDDEN_ON}</strong><span>{L_ABBC3_HIDDEN_EXPLAIN}</span><div class="hc-actions"><a class="hc-btn" href="{U_LOGIN}">{L_LOGIN}</a><a class="hc-btn hc-btn--primary" href="{U_REGISTER}">{L_REGISTER}</a></div></div></div></div></xsl:otherwise></xsl:choose>', '<xsl:choose><xsl:when test="$S_USER_LOGGED_IN and not($S_IS_BOT)"><div>{TEXT}</div></xsl:when><xsl:otherwise><p>{L_LOGIN}</p></xsl:otherwise></xsl:choose>'),
			'offtopic' => $this->entry('[offtopic]{TEXT}[/offtopic]', '<div class="abbc3-off-topic" style="display:flex;align-items:stretch;max-width:100%;margin:1em 0;border-radius:8px;overflow:hidden;color:#333;border:1px solid #ddd;"><div style="background-color:#6c757d;color:#fff;font-weight:bold;font-size:1.8em;display:flex;align-items:center;justify-content:center;padding:10px;width:60px;">&#8505;</div><div style="flex:1;display:flex;flex-direction:column;"><div style="background-color:#f1f3f5;font-weight:bold;padding:8px 12px;border-bottom:1px solid #ddd;">{L_ABBC3_OFFTOPIC}</div><div style="background-color:#fff;padding:12px 12px 14px 12px;line-height:1.5;">{TEXT}</div></div></div>', '<aside><blockquote>{TEXT}</blockquote></aside>'),
			'mod' => $this->entry('[mod={TEXT1}]{TEXT2}[/mod]', '<div class="abbc3-mod-alert" style="display:flex;align-items:stretch;max-width:100%;margin:1em 0;border-radius:8px;overflow:hidden;color:#333;border:1px solid #ddd;"><div style="background-color:#ff4d4f;color:#fff;font-weight:bold;font-size:2.5em;display:flex;align-items:center;justify-content:center;padding:10px;width:60px;">!</div><div style="flex:1;display:flex;flex-direction:column;"><div style="background-color:#f9f9f9;font-weight:bold;padding:8px 12px;border-bottom:1px solid #eee;">{L_MESSAGE} {L_FROM}{L_COLON} {TEXT1}</div><div style="background-color:#fff;padding:12px 12px 14px 12px;line-height:1.5;">{TEXT2}</div></div></div>', '<blockquote><strong>{L_MESSAGE} {L_FROM}{L_COLON} {TEXT1}</strong><br>{TEXT2}</blockquote>'),
			'nfo' => $this->entry('[nfo]{TEXT}[/nfo]', '<pre class="nfo" style="color:#000000;font-weight:normal;line-height:normal;font-size:10pt;font-family:Terminal, monospace;background-color:#ffffff;white-space:pre;margin:1em 0;padding:5px;">{TEXT}</pre>', '<pre>{TEXT}</pre>'),
			'soundcloud' => $this->entry('[soundcloud]{URL}[/soundcloud]', '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url={URL}&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>', '<a href="{URL}">{URL}</a>'),
			'bbvideo' => $this->entry('[bbvideo={NUMBER1},{NUMBER2}]{URL}[/bbvideo]', '<a href="{URL}" class="bbvideo" data-bbvideo="{NUMBER1},{NUMBER2}" target="_blank">{URL}</a>', '<a href="{URL}">{URL}</a>'),
			'pipes' => $this->entry('[pipes]{TEXT}[/pipes]', '{TEXT}', '<pre>{TEXT}</pre>'),
		];
	}

	public function get($tag)
	{
		$all = $this->all();
		return $all[strtolower(rtrim($tag, '='))] ?? null;
	}

	protected function entry($match, $enhanced, $fallback)
	{
		return ['match' => $match, 'enhanced' => $enhanced, 'fallback' => $fallback];
	}
}
