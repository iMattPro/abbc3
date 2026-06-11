/**
 * Advanced BBCodes
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

/*global bbfontstyle, insert_text, phpbb */

// global scope vars
let requestRunning = false;
let bbwizard;

(() => {
	'use strict';

	const fadeTime = 180;

	const isVisible = (element) => !!(element && (element.offsetWidth || element.offsetHeight || element.getClientRects().length));

	const fade = (element, show) => {
		if (!element) {
			return;
		}

		clearTimeout(element.abbc3FadeTimer);
		element.style.transition = `opacity ${fadeTime}ms ease`;

		if (show) {
			element.style.opacity = '0';
			element.style.display = 'block';

			requestAnimationFrame(() => {
				element.style.opacity = '1';
			});

			return;
		}

		element.style.opacity = '0';
		element.abbc3FadeTimer = setTimeout(() => {
			element.style.display = 'none';
		}, fadeTime);
	};

	const hideLoadingIndicator = (loadingIndicator) => {
		if (loadingIndicator && typeof loadingIndicator.is === 'function' && loadingIndicator.is(':visible')) {
			loadingIndicator.fadeOut(phpbb.alertTime);
		}
	};

	const getAllowedWizardUrl = (href, bbcode) => {
		const allowedModes = {
			bbvideo: ['bbvideo', 'media'],
			pipes: ['pipes'],
			url: ['url']
		};

		try {
			const url = new URL(href, window.location.href);
			const match = url.pathname.match(/\/wizard\/bbcode\/(bbvideo|pipes|url)$/);
			const mode = match && match[1];

			if (url.origin !== window.location.origin || !mode || !allowedModes[mode].includes(bbcode)) {
				return null;
			}

			return url.toString();
		} catch (error) {
			return null;
		}
	};

	// Show the bbcode wizard (scope must be global)
	bbwizard = (href, bbcode) => {
		const wizard = document.getElementById('bbcode_wizard');
		const modal = document.getElementById('darkenwrapper');
		const wizardUrl = getAllowedWizardUrl(href, bbcode);

		if (!wizard || !wizardUrl) {
			bbfontstyle(`[${bbcode}]`, `[/${bbcode}]`);
			return;
		}

		if (requestRunning || isVisible(wizard)) {
			return;
		}

		requestRunning = true;
		const loadingIndicator = phpbb.loadingIndicator();
		fade(wizard, false);
		wizard.replaceChildren();

		fetch(wizardUrl, {
			credentials: 'same-origin',
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			}
		})
			.then((response) => response.ok ? response.text() : Promise.reject(response))
			.then((data) => {
				wizard.insertAdjacentHTML('beforeend', data);

				const submit = wizard.querySelector('#bbcode_wizard_submit');
				if (submit) {
					submit.dataset.bbcode = bbcode;
				}

				fade(modal, true);
				fade(wizard, true);
			})
			.catch(() => {
				// On AJAX error, revert to default bbcode application.
				bbfontstyle(`[${bbcode}]`, `[/${bbcode}]`);
			})
			.finally(() => {
				requestRunning = false;
				hideLoadingIndicator(loadingIndicator);
			});
	};

	// Document ready
	document.addEventListener('DOMContentLoaded', () => {
		const body = document.body;
		const wizard = document.getElementById('bbcode_wizard');
		const modal = document.getElementById('darkenwrapper');

		// Spoiler toggle
		document.querySelectorAll('.abbc3_spoiler').forEach(spoiler => {
			const summary = spoiler.querySelector('summary');
			const showText = spoiler.dataset.show;
			const hideText = spoiler.dataset.hide;
			spoiler.addEventListener('toggle', () => {
				summary.textContent = spoiler.open ? hideText : showText;
			});
		});

		// Dynamically adjust highlight bbcode's text color
		document.querySelectorAll('.abbc3-highlight').forEach(highlight => {
			const rgb = window.getComputedStyle(highlight).backgroundColor.match(/\d+/g);
			highlight.style.color = (rgb && (rgb[0] * 299 + rgb[1] * 587 + rgb[2] * 114) / 1000 < 128) ? 'white' : 'black';
		});

		// BBCode Wizard listener events
		if (!wizard) {
			return;
		}

		const closeWizard = () => {
			if (isVisible(wizard)) {
				fade(wizard, false);
				fade(modal, false);
			}
		};

		body.addEventListener('click', closeWizard);
		body.addEventListener('keyup', (event) => {
			if (event.key === 'Escape') {
				event.preventDefault();
				closeWizard();
			}
		});

		wizard.addEventListener('click', (event) => {
			event.stopPropagation();
			const submit = event.target.closest('#bbcode_wizard_submit');
			const cancel = event.target.closest('#bbcode_wizard_cancel');
			if (submit) {
				event.preventDefault();
				const bbcode = submit.dataset.bbcode;
				switch (bbcode) {
					case 'url': {
						const link = document.getElementById('bbcode_wizard_link').value;
						const description = document.getElementById('bbcode_wizard_description').value;
						const text = description.length ? description : link;
						const attribute = description.length ? `=${link}` : '';
						insert_text(`[${bbcode}${attribute}]${text}[/${bbcode}]`);
						break;
					}
					case 'bbvideo':
					case 'media':
						insert_text(`[${bbcode}]${document.getElementById('bbvideo_wizard_link').value}[/${bbcode}]`);
						break;
				}
				closeWizard();
				return;
			}
			if (cancel) {
				event.preventDefault();
				closeWizard();
			}
		});

		wizard.addEventListener('change', (event) => {
			if (event.target.id === 'bbvideo_wizard_sites') {
				document.getElementById('bbvideo_wizard_example').value = event.target.value;
			}
		});
	});
})();
