/**
 * Advanced BBCode Box
 * @copyright (c) 2013-2026 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

(() => {
	'use strict';

	const stripBBCodes = value => {
		let result = value;
		let previous;
		const pattern = /\[([a-z][a-z0-9]*?)(?:=[^\]]*)?]([\s\S]*?)\[\/\1]/gi;
		do {
			previous = result;
			result = result.replace(pattern, '$2');
		} while (result !== previous);
		return result;
	};

	const targetFor = toolbar => {
		const form = toolbar.closest('form');
		if (!form) {
			return null;
		}
		if (toolbar.hasAttribute('data-abbc3-acp') && typeof window.text_name === 'string') {
			const editor = form.elements.namedItem(window.text_name);
			if (editor instanceof HTMLTextAreaElement) return editor;
		}
		return form.elements[toolbar.dataset.abbc3Target] || form.querySelector('textarea');
	};

	const insert = (textarea, open, close, transform) => {
		if (!textarea) {
			return;
		}
		const start = typeof textarea.selectionStart === 'number' ? textarea.selectionStart : textarea.value.length;
		const end = typeof textarea.selectionEnd === 'number' ? textarea.selectionEnd : start;
		const direction = textarea.selectionDirection;
		const selected = textarea.value.slice(start, end);
		const inner = transform ? transform(selected) : selected;
		const replacement = open + inner + close;
		textarea.setRangeText(replacement, start, end, 'end');
		textarea.focus();
		if (start !== end || close) {
			const innerStart = start + open.length;
			const innerEnd = start !== end ? innerStart + inner.length : innerStart;
			textarea.setSelectionRange(innerStart, innerEnd, direction);
		}
		textarea.dispatchEvent(new Event('input', { bubbles: true }));
	};

	const hasAncestorFontColor = element => {
		let ancestor = element.parentElement;
		while (ancestor) {
			if (ancestor.tagName === 'SPAN' && !ancestor.classList.contains('abbc3-highlight') && ancestor.style.color) {
				return true;
			}
			ancestor = ancestor.parentElement;
		}
		return false;
	};

	const allowedWizardUrl = (toolbar, mode) => {
		const sourceKey = mode === 'url' ? 'wizardUrl' : (mode === 'pipes' ? 'wizardPipes' : 'wizardBbvideo');
		const source = toolbar.dataset[sourceKey];
		if (!source) {
			return null;
		}
		try {
			const url = new URL(source, window.location.href);
			return url.origin === window.location.origin ? url.toString() : null;
		} catch (error) {
			return null;
		}
	};

	let wizardRequestId = 0;

	const closeWizard = wizard => {
		if (!wizard) {
			return;
		}
		wizard.abbc3RequestId = ++wizardRequestId;
		if (wizard.hidden) return;
		wizard.hidden = true;
		wizard.textContent = '';
		const darken = document.getElementById('darkenwrapper');
		if (darken) darken.classList.remove('abbc3-darken');
		wizard.abbc3Textarea.focus();
	};

	const openWizard = (toolbar, button, mode, textarea) => {
		const wizard = toolbar.parentElement.querySelector('.abbc3-wizard') || document.querySelector('.abbc3-wizard');
		const url = allowedWizardUrl(toolbar, mode);
		if (!wizard || !url) {
			insert(textarea, button.dataset.abbc3Open, button.dataset.abbc3Close);
			return;
		}
		const requestId = ++wizardRequestId;
		wizard.abbc3RequestId = requestId;
		wizard.hidden = true;
		wizard.textContent = '';
		const darken = document.getElementById('darkenwrapper');
		if (darken) darken.classList.remove('abbc3-darken');
		fetch(url, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
			.then(response => response.ok ? response.text() : Promise.reject(response))
			.then(html => {
				if (wizard.abbc3RequestId !== requestId) return;
				wizard.abbc3Textarea = textarea;
				wizard.abbc3Mode = mode;
				wizard.innerHTML = html;
				wizard.hidden = false;
				if (darken) darken.classList.add('abbc3-darken');
				const firstControl = wizard.querySelector('input:not([type="hidden"]), select, button');
				if (firstControl) firstControl.focus();
			})
			.catch(() => {
				if (wizard.abbc3RequestId === requestId) insert(textarea, button.dataset.abbc3Open, button.dataset.abbc3Close);
			});
	};

	const menuOptions = menu => [ ...menu.querySelectorAll('[role="option"]') ];
	let menuPositionFrame = null;
	const openMenus = new Set();

	const closeMenu = (menu, focusTrigger = false) => {
		if (!menu) return;
		openMenus.delete(menu);
		const trigger = menu.querySelector('[data-abbc3-menu-trigger]');
		const panel = menu.querySelector('[data-abbc3-menu-panel]');
		if (!trigger || !panel || panel.hidden) return;
		panel.hidden = true;
		trigger.setAttribute('aria-expanded', 'false');
		if (focusTrigger) trigger.focus();
	};

	const closeToolbarMenus = toolbar => toolbar.querySelectorAll('[data-abbc3-menu]').forEach(menu => closeMenu(menu));

	const positionMenu = menu => {
		const toolbar = menu.closest('[data-abbc3-toolbar]');
		const trigger = menu.querySelector('[data-abbc3-menu-trigger]');
		const panel = menu.querySelector('[data-abbc3-menu-panel]');
		const toolbarRect = toolbar.getBoundingClientRect();
		const rect = trigger.getBoundingClientRect();
		const edge = 8;
		const gap = 4;
		panel.style.minWidth = `${Math.min(rect.width, window.innerWidth - 2 * edge)}px`;
		panel.style.maxHeight = '';
		const panelRect = panel.getBoundingClientRect();
		const left = Math.max(edge, Math.min(rect.left, window.innerWidth - panelRect.width - edge));
		const spaceBelow = window.innerHeight - rect.bottom - gap - edge;
		const spaceAbove = rect.top - gap - edge;
		const below = panelRect.height <= spaceBelow || spaceBelow >= spaceAbove;
		const height = Math.min(panelRect.height, below ? spaceBelow : spaceAbove);
		if (height < panelRect.height) panel.style.maxHeight = `${height}px`;
		const top = below ? rect.bottom + gap : rect.top - gap - height;
		panel.style.left = `${left - toolbarRect.left - toolbar.clientLeft}px`;
		panel.style.top = `${top - toolbarRect.top - toolbar.clientTop}px`;
	};

	const scheduleOpenMenuPositions = () => {
		if (!openMenus.size || menuPositionFrame !== null) return;
		menuPositionFrame = window.requestAnimationFrame(() => {
			menuPositionFrame = null;
			const root = document.scrollingElement;
			if (root && (root.scrollTop < -1 || root.scrollTop > root.scrollHeight - root.clientHeight + 1)) return;
			openMenus.forEach(menu => {
				const panel = menu.querySelector('[data-abbc3-menu-panel]');
				if (!document.documentElement.contains(menu) || !panel || panel.hidden) openMenus.delete(menu);
				else positionMenu(menu);
			});
		});
	};

	const openMenu = (menu, focus = 'none') => {
		const toolbar = menu.closest('[data-abbc3-toolbar]');
		closeToolbarMenus(toolbar);
		const trigger = menu.querySelector('[data-abbc3-menu-trigger]');
		const panel = menu.querySelector('[data-abbc3-menu-panel]');
		panel.hidden = false;
		trigger.setAttribute('aria-expanded', 'true');
		openMenus.add(menu);
		positionMenu(menu);
		const options = menuOptions(menu);
		if (focus === 'first' && options[0]) options[0].focus();
		if (focus === 'last' && options.length) options[options.length - 1].focus();
	};

	const trayStateKey = (toolbar, index) => {
		const source = new URLSearchParams(window.location.search);
		const stable = new URLSearchParams();
		[ 'mode', 'f', 't', 'p', 'u', 'i' ].forEach(key => {
			if (source.has(key)) stable.set(key, source.get(key));
		});
		return `abbc3:tray:${window.location.pathname}?${stable.toString()}:${toolbar.dataset.abbc3Target}:${index}`;
	};

	const storedTrayState = key => {
		try { return window.sessionStorage.getItem(key) === 'open'; } catch (error) { return false; }
	};

	const storeTrayState = (key, expanded) => {
		try { window.sessionStorage.setItem(key, expanded ? 'open' : 'closed'); } catch (error) { /* Storage can be unavailable. */ }
	};

	const initToolbar = (toolbar, toolbarIndex) => {
		const textarea = targetFor(toolbar);
		if (!textarea) {
			return;
		}
		if (toolbar.hasAttribute('data-abbc3-acp') && textarea instanceof HTMLTextAreaElement &&
			textarea.matches('dd > textarea') &&
			toolbar.closest('fieldset') === textarea.closest('fieldset')) {
			textarea.before(toolbar);
		}
		toolbar.classList.add('abbc3-toolbar--ready');
		toolbar.querySelectorAll('.abbc3-control__icon').forEach(icon => {
			icon.addEventListener('error', () => icon.closest('.abbc3-control').classList.add('abbc3-control--icon-error'), { once: true });
		});
		const form = toolbar.closest('form');
		if (form) form.classList.add('abbc3-editor--ready');
		const moreToggle = toolbar.querySelector('[data-abbc3-more-toggle]');
		const moreTray = toolbar.querySelector('[data-abbc3-more-tray]');
		if (moreToggle && moreTray) {
			const trayId = `abbc3-more-${Math.random().toString(36).slice(2)}`;
			const stateKey = trayStateKey(toolbar, toolbarIndex);
			moreTray.id = trayId;
			moreToggle.setAttribute('aria-controls', trayId);
			const setTray = (expanded, persist = true) => {
				moreToggle.setAttribute('aria-expanded', String(expanded));
				moreToggle.title = expanded ? moreToggle.dataset.titleHide : moreToggle.dataset.titleShow;
				moreTray.hidden = !expanded;
				if (!expanded) closeToolbarMenus(toolbar);
				if (persist) storeTrayState(stateKey, expanded);
			};
			toolbar.abbc3SetTray = setTray;
			setTray(storedTrayState(stateKey), false);
			moreToggle.addEventListener('pointerdown', event => {
				if (event.isPrimary && event.button === 0 && document.activeElement === textarea) {
					event.preventDefault();
				}
			});
			moreToggle.addEventListener('click', () => {
				const expanded = moreToggle.getAttribute('aria-expanded') === 'true';
				setTray(!expanded);
			});
		}

		toolbar.addEventListener('click', event => {
			const menuTrigger = event.target.closest('[data-abbc3-menu-trigger]');
			if (menuTrigger) {
				event.preventDefault();
				const menu = menuTrigger.closest('[data-abbc3-menu]');
				if (menuTrigger.getAttribute('aria-expanded') === 'true') closeMenu(menu);
				else openMenu(menu);
				return;
			}
			const option = event.target.closest('[role="option"]');
			const menu = option && option.closest('[data-abbc3-menu]');
			if (menu) {
				event.preventDefault();
				closeMenu(menu);
				if (option.dataset.abbc3SizeValue) insert(textarea, `[size=${option.dataset.abbc3SizeValue}]`, '[/size]');
				if (option.dataset.abbc3FontValue) insert(textarea, `[font=${option.dataset.abbc3FontValue}]`, '[/font]');
				return;
			}
			const button = event.target.closest('[data-abbc3-action]');
			if (!button) {
				return;
			}
			event.preventDefault();
			const action = button.dataset.abbc3Action;
			if (action === 'color') {
				const editorForm = toolbar.closest('form');
				if (editorForm && editorForm.id) {
					window.form_name = editorForm.id;
					window.text_name = textarea.name;
				}
				if (typeof window.change_palette === 'function') {
					window.change_palette();
				}
				return;
			}
			if (action === 'plain') {
				if (textarea.selectionStart === textarea.selectionEnd) {
					window.alert(toolbar.dataset.abbc3NoSelection);
					return;
				}
				insert(textarea, '', '', stripBBCodes);
				return;
			}
			if (action === 'wizard') {
				const mode = button.dataset.abbc3Name.toLowerCase();
				const selected = textarea.value.slice(textarea.selectionStart, textarea.selectionEnd);
				if (!selected) {
					openWizard(toolbar, button, mode, textarea);
					return;
				}
			}
			insert(textarea, button.dataset.abbc3Open || '', button.dataset.abbc3Close || '');
		});

		toolbar.addEventListener('keydown', event => {
			const menu = event.target.closest('[data-abbc3-menu]');
			if (!menu) return;
			const trigger = event.target.closest('[data-abbc3-menu-trigger]');
			const options = menuOptions(menu);
			if (trigger && [ 'ArrowDown', 'ArrowUp' ].includes(event.key)) {
				event.preventDefault();
				openMenu(menu, event.key === 'ArrowDown' ? 'first' : 'last');
				return;
			}
			const index = options.indexOf(event.target);
			if (index < 0) return;
			if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
				event.preventDefault();
				options[(index + (event.key === 'ArrowDown' ? 1 : -1) + options.length) % options.length].focus();
			} else if (event.key === 'Home' || event.key === 'End') {
				event.preventDefault();
				options[event.key === 'Home' ? 0 : options.length - 1].focus();
			} else if (event.key === 'Escape') {
				event.preventDefault();
				closeMenu(menu, true);
			}
		});
		if (form) form.addEventListener('submit', () => closeToolbarMenus(toolbar));
	};

	const initWizard = wizard => {
		wizard.addEventListener('click', event => {
			const cancel = event.target.closest('#bbcode_wizard_cancel');
			const submit = event.target.closest('#bbcode_wizard_submit');
			if (cancel) {
				event.preventDefault();
				closeWizard(wizard);
				return;
			}
			if (!submit) {
				return;
			}
			event.preventDefault();
			const mode = wizard.abbc3Mode;
			if (mode === 'url') {
				const link = wizard.querySelector('#bbcode_wizard_link').value;
				const description = wizard.querySelector('#bbcode_wizard_description').value;
				insert(wizard.abbc3Textarea, description ? `[url=${link}]` : '[url]', '[/url]', () => description || link);
			} else if (mode === 'bbvideo' || mode === 'media') {
				const link = wizard.querySelector('#bbvideo_wizard_link').value;
				insert(wizard.abbc3Textarea, `[${mode}]`, `[/${mode}]`, () => link);
			}
			closeWizard(wizard);
		});
		wizard.addEventListener('change', event => {
			if (event.target.id === 'bbvideo_wizard_sites') {
				wizard.querySelector('#bbvideo_wizard_example').value = event.target.value;
			}
		});
	};

	document.addEventListener('keydown', event => {
		if (event.key === 'Escape') {
			if (event.repeat) return;
			const wizard = document.querySelector('.abbc3-wizard:not([hidden])');
			if (wizard) {
				event.preventDefault();
				closeWizard(wizard);
				return;
			}
			const openMenuElement = openMenus.values().next().value;
			if (openMenuElement) {
				event.preventDefault();
				closeMenu(openMenuElement, true);
				return;
			}
			document.querySelectorAll('.abbc3-wizard').forEach(closeWizard);
			document.querySelectorAll('[data-abbc3-more-toggle][aria-expanded="true"]').forEach(toggle => {
				const toolbar = toggle.closest('[data-abbc3-toolbar]');
				if (toolbar && toolbar.abbc3SetTray) toolbar.abbc3SetTray(false);
				toggle.focus();
			});
			return;
		}
		if (event.key === 'Tab') {
			const wizard = [ ...document.querySelectorAll('.abbc3-wizard') ].find(dialog => !dialog.hidden);
			if (!wizard) {
				return;
			}
			const focusable = [ ...wizard.querySelectorAll('button, input, select, textarea, a[href], [tabindex]:not([tabindex="-1"])') ]
				.filter(element => !element.disabled && element.offsetParent !== null);
			if (!focusable.length) {
				event.preventDefault();
				return;
			}
			const first = focusable[0];
			const last = focusable[focusable.length - 1];
			if (event.shiftKey && document.activeElement === first) {
				event.preventDefault();
				last.focus();
			} else if (!event.shiftKey && document.activeElement === last) {
				event.preventDefault();
				first.focus();
			}
		}
	});

	document.addEventListener('pointerdown', event => {
		openMenus.forEach(menu => {
			if (!menu.contains(event.target)) closeMenu(menu);
		});
	});

	window.addEventListener('resize', () => openMenus.forEach(menu => closeMenu(menu)));
	window.addEventListener('scroll', event => {
		if (!openMenus.size) return;
		if (event.target instanceof Element && event.target.closest('[data-abbc3-menu-panel]')) return;
		scheduleOpenMenuPositions();
	}, true);

	document.addEventListener('DOMContentLoaded', () => {
		document.querySelectorAll('[data-abbc3-toolbar]').forEach(initToolbar);
		document.querySelectorAll('.abbc3-wizard').forEach(initWizard);

		document.querySelectorAll('details.abbc3-spoiler').forEach(spoiler => {
			const summary = spoiler.querySelector('summary');
			if (!summary) {
				return;
			}
			const show = spoiler.dataset.show || summary.textContent;
			const hide = spoiler.dataset.hide || show;
			spoiler.addEventListener('toggle', () => { summary.textContent = spoiler.open ? hide : show; });
		});

		document.querySelectorAll('.abbc3-highlight').forEach(highlight => {
			if (hasAncestorFontColor(highlight)) return;
			const rgb = window.getComputedStyle(highlight).backgroundColor.match(/\d+/g);
			if (rgb) {
				highlight.style.color = (rgb[0] * 299 + rgb[1] * 587 + rgb[2] * 114) / 1000 < 128 ? 'white' : 'black';
			}
		});
	});
})();
