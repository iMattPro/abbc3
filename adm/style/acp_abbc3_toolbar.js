(() => {
	'use strict';

	const composer = document.querySelector('[data-abbc3-composer]');
	const form = document.getElementById('abbc3_settings');
	const inspector = document.querySelector('[data-abbc3-inspector]');
	const iconSelect = inspector ? inspector.querySelector('[data-inspector-icon-select]') : null;
	const fontIconInput = inspector ? inspector.querySelector('[data-inspector-font-icon]') : null;
	const placementSelect = inspector ? inspector.querySelector('[data-inspector-placement]') : null;
	const previewPrimary = document.querySelector('[data-preview-primary]');
	const previewMore = document.querySelector('[data-preview-more]');
	const previewToggle = document.querySelector('[data-preview-more-toggle]');
	const saveStatus = document.querySelector('[data-autosave-status]');
	const saveMessage = document.querySelector('[data-autosave-message]');
	const retryButton = document.querySelector('[data-autosave-retry]');
	const fonts = document.querySelector('[data-google-fonts]');
	const fontSaveButton = document.querySelector('[data-save-fonts]');
	const fontStatus = document.querySelector('[data-font-status]');
	const fontPicker = document.querySelector('[data-font-picker]');
	const toolbarEnabled = document.getElementById('abbc3_bbcode_bar');
	const toolbarDisabled = document.querySelector('[data-toolbar-disabled]');
	if (!composer || !form || !inspector || !iconSelect || !fontIconInput || !placementSelect || !previewPrimary || !previewMore || !previewToggle || !saveStatus || !saveMessage || !retryButton || !fonts || !fontSaveButton || !fontStatus) {
		return;
	}

	const columns = [ ...composer.querySelectorAll('[data-composer-column]') ];
	const allItems = () => [ ...composer.querySelectorAll('.abbc3-composer-item') ];
	const isDivider = item => item.dataset.type === 'separator';
	const buttonItems = () => allItems().filter(item => !isDivider(item));
	const dividerTemplate = composer.querySelector('[data-divider-template]');
	const removeDivider = inspector.querySelector('[data-remove-divider]');
	const inspectorIcon = inspector.querySelector('[data-inspector-icon]');
	const inspectorTag = inspector.querySelector('[data-inspector-tag]');
	const hiddenPlacement = placementSelect.querySelector('option[value="hidden"]');
	let selected = null;
	let drag = null;
	let saving = false;
	let savedTimer = null;
	const pending = new Map();
	const failed = new Map();

	const iconTypeValue = () => {
		const checked = form.querySelector('input[name="abbc3_icons_type"]:checked');
		return checked ? checked.value : 'png';
	};

	const showStatus = (state, message) => {
		if (savedTimer !== null) {
			window.clearTimeout(savedTimer);
			savedTimer = null;
		}
		saveStatus.dataset.state = state;
		saveMessage.textContent = message;
		if (state !== 'error' && document.activeElement === retryButton) {
			saveMessage.focus({ preventScroll: true });
		}
		retryButton.hidden = state !== 'error';
		form.setAttribute('aria-busy', String(state === 'saving'));
	};

	const responseMessage = response => {
		const holder = document.createElement('div');
		holder.innerHTML = response.MESSAGE_TEXT || '';
		holder.querySelectorAll('a').forEach(link => link.remove());
		holder.querySelectorAll('br').forEach(lineBreak => lineBreak.replaceWith('\n'));
		return holder.textContent || form.dataset.statusError;
	};

	const basePayload = scope => {
		const payload = new URLSearchParams();
		payload.set('abbc3_save_scope', scope);
		form.querySelectorAll('input[name="form_token"], input[name="creation_time"]').forEach(input => payload.set(input.name, input.value));
		return payload;
	};

	const finishQueue = () => {
		saving = false;
		if (pending.size) {
			processQueue();
			return;
		}
		if (failed.size) {
			showStatus('error', failed.values().next().value.message);
			return;
		}
		showStatus('saved', form.dataset.statusSaved);
		savedTimer = window.setTimeout(() => {
			delete saveStatus.dataset.state;
			saveMessage.textContent = '';
			savedTimer = null;
		}, 4000);
	};

	const processQueue = () => {
		if (saving || !pending.size) {
			return;
		}
		const current = pending.entries().next().value;
		const scope = current[0];
		const payload = current[1];
		pending.delete(scope);
		saving = true;
		showStatus('saving', form.dataset.statusSaving);
		window.fetch(form.action, {
			method: 'POST',
			credentials: 'same-origin',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
				'X-Requested-With': 'XMLHttpRequest',
			},
			body: payload.toString(),
			keepalive: true,
		})
			.then(response => response.ok ? response.json() : Promise.reject(new Error(form.dataset.statusError)))
			.then(response => {
				if (response.S_USER_WARNING || !response.S_USER_NOTICE) {
					throw new Error(responseMessage(response));
				}
				failed.delete(scope);
			})
			.catch(error => {
				failed.set(scope, { payload, message: error.message || form.dataset.statusError });
			})
			.then(finishQueue);
	};

	const enqueue = (scope, payload) => {
		failed.delete(scope);
		pending.set(scope, payload);
		processQueue();
	};

	const saveToolbar = () => {
		const payload = basePayload('toolbar');
		columns.forEach(column => column.querySelectorAll('[data-toolbar-key]').forEach(input => payload.append(input.name, input.value)));
		buttonItems().forEach(item => {
			const imageInput = item.querySelector('[data-icon-value]');
			const fontInput = item.querySelector('[data-font-icon-value]');
			payload.append(imageInput.name, imageInput.value);
			payload.append(fontInput.name, fontInput.value);
		});
		enqueue('toolbar', payload);
	};

	const saveSetting = input => {
		if (input.type === 'radio' && !input.checked) {
			return;
		}
		const payload = basePayload('setting');
		payload.set('setting_name', input.name);
		payload.set('setting_value', input.type === 'checkbox' ? (input.checked ? '1' : '0') : input.value);
		enqueue(`setting:${input.name}`, payload);
	};

	const normalizeFonts = value => [ ...new Set(value.split(/[\r\n,]+/).map(font => font.trim().replace(/\s+/g, ' ')).filter(Boolean)) ].join('\n');
	let savedFonts = normalizeFonts(fonts.value);
	const syncFontButton = () => { fontSaveButton.disabled = normalizeFonts(fonts.value) === savedFonts; };

	if (fontPicker) {
		const search = fontPicker.querySelector('[data-font-search]');
		const status = fontPicker.querySelector('[data-font-search-status]');
		const results = fontPicker.querySelector('[data-font-results]');
		let catalog;
		let loading = false;

		const addFont = family => {
			const separator = fonts.value && !fonts.value.endsWith('\n') ? '\n' : '';
			fonts.value += separator + family;
			search.value = '';
			search.focus();
			fonts.dispatchEvent(new Event('input', { bubbles: true }));
		};

		const renderFontResults = () => {
			results.textContent = '';
			results.hidden = true;
			const query = search.value.trim().toLowerCase();
			status.textContent = '';
			if (!query) {
				return;
			}

			if (catalog === undefined) {
				status.textContent = fontPicker.dataset.loading;
				if (!loading) {
					loading = true;
					window.fetch(fontPicker.dataset.catalogUrl)
						.then(response => response.ok ? response.json() : Promise.reject())
						.then(names => {
							catalog = Array.isArray(names) && names.length && names.every(name => typeof name === 'string' && name.trim())
								? names.map(name => ({ name, folded: name.toLowerCase() })) : null;
						})
						.catch(() => { catalog = null; })
						.then(renderFontResults);
				}
				return;
			}
			if (!catalog) {
				status.textContent = fontPicker.dataset.unavailable;
				return;
			}

			const existing = new Set(normalizeFonts(fonts.value).toLowerCase().split('\n'));
			const prefix = [];
			const other = [];
			catalog.forEach(({ name, folded }) => {
				if (existing.has(folded)) {
					return;
				}
				if (folded.startsWith(query)) {
					prefix.push(name);
				} else if (folded.includes(query)) {
					other.push(name);
				}
			});
			const matches = prefix.concat(other).slice(0, 8);
			if (!matches.length) {
				status.textContent = fontPicker.dataset.empty;
				return;
			}
			matches.forEach(name => {
				const item = document.createElement('li');
				const button = document.createElement('button');
				button.type = 'button';
				button.textContent = name;
				button.addEventListener('click', () => addFont(name));
				item.appendChild(button);
				results.appendChild(item);
			});
			results.hidden = false;
		};

		search.addEventListener('input', renderFontResults);
		fonts.addEventListener('input', renderFontResults);
	}

	const setFontStatus = (state, message) => {
		fontStatus.dataset.state = state;
		fontStatus.textContent = message;
	};

	const saveFonts = () => {
		const payload = basePayload('fonts');
		const submittedFonts = normalizeFonts(fonts.value);
		payload.set('abbc3_google_fonts', submittedFonts);
		fontSaveButton.disabled = true;
		fonts.disabled = true;
		if (fontPicker) {
			fontPicker.disabled = true;
		}
		fonts.setAttribute('aria-busy', 'true');
		setFontStatus('saving', form.dataset.fontChecking);
		window.fetch(form.action, {
			method: 'POST',
			credentials: 'same-origin',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
				'X-Requested-With': 'XMLHttpRequest',
			},
			body: payload.toString(),
			keepalive: true,
		})
			.then(response => response.ok ? response.json() : Promise.reject(new Error(form.dataset.statusError)))
			.then(response => {
				if (response.S_USER_WARNING || !response.S_USER_NOTICE) {
					throw new Error(responseMessage(response));
				}
				savedFonts = submittedFonts;
				fonts.value = savedFonts;
				setFontStatus('saved', form.dataset.fontSaved);
			})
			.catch(error => {
				setFontStatus('error', error.message || form.dataset.statusError);
			})
			.then(() => {
				fonts.disabled = false;
				if (fontPicker) {
					fontPicker.disabled = false;
				}
				fonts.removeAttribute('aria-busy');
				syncFontButton();
			});
	};

	const iconPath = name => {
		const option = [ ...iconSelect.options ].find(candidate => candidate.value === name);
		if (!option) {
			return '';
		}
		const type = iconTypeValue();
		const preferred = option.dataset[`icon${type[0].toUpperCase()}${type.slice(1)}`];
		return preferred || option.dataset.iconPng || option.dataset.iconSvg || '';
	};

	const iconName = item => item.querySelector('[data-icon-value]').value;
	const fontIconName = item => item.querySelector('[data-font-icon-value]').value;
	const normalizeFontIcon = value => value.trim().replace(/^fa-/i, '').toLowerCase().replace(/[^a-z0-9-]/g, '');
	const isSelectControl = item => item.dataset.type === 'size' || item.dataset.name === 'font';
	const setIconVisibility = (container, visible) => {
		container.hidden = !visible;
		const button = container.closest('[data-item-select]');
		if (button) {
			button.classList.toggle('abbc3-item-select--text', !visible);
		}
	};

	const renderIcon = (container, item) => {
		container.textContent = '';
		if (isSelectControl(item)) {
			container.textContent = 'Aa';
			setIconVisibility(container, true);
			return;
		}
		const fontIcon = fontIconName(item);
		if (fontIcon) {
			const icon = document.createElement('i');
			icon.className = `fa fa-${fontIcon} fa-fw`;
			icon.setAttribute('aria-hidden', 'true');
			container.appendChild(icon);
			setIconVisibility(container, true);
			return;
		}
		const path = iconPath(iconName(item));
		if (!path) {
			setIconVisibility(container, false);
			return;
		}
		const image = document.createElement('img');
		image.src = path;
		image.alt = '';
		image.addEventListener('error', () => {
			container.textContent = '';
			setIconVisibility(container, false);
		}, { once: true });
		container.appendChild(image);
		setIconVisibility(container, true);
	};

	const updateItemIcon = item => renderIcon(item.querySelector('[data-item-icon]'), item);

	const previewControl = item => {
		if (isSelectControl(item)) {
			const control = document.createElement('span');
			control.className = 'abbc3-select abbc3-menu__trigger abbc3-preview-select';
			const label = document.createElement('span');
			label.textContent = item.dataset.type === 'size' ? item.dataset.label.split(':')[0] : item.dataset.name;
			const chevron = document.createElement('span');
			chevron.className = 'abbc3-menu__chevron';
			chevron.textContent = '⌄';
			control.appendChild(label);
			control.appendChild(chevron);
			control.title = item.dataset.label;
			return control;
		}
		const control = document.createElement('button');
		control.type = 'button';
		control.className = 'abbc3-control';
		control.tabIndex = -1;
		control.title = item.dataset.label;
		control.setAttribute('aria-hidden', 'true');
		const fontIcon = fontIconName(item);
		const path = fontIcon ? '' : iconPath(iconName(item));
		if (fontIcon) {
			control.classList.add('abbc3-control--font-icon');
			const icon = document.createElement('i');
			icon.className = `fa fa-${fontIcon} fa-fw abbc3-control__font-icon`;
			icon.setAttribute('aria-hidden', 'true');
			control.appendChild(icon);
		} else if (path) {
			control.classList.add('abbc3-control--icon');
			const image = document.createElement('img');
			image.className = 'abbc3-control__icon';
			image.src = path;
			image.alt = '';
			image.addEventListener('error', () => { control.classList.add('abbc3-control--icon-error'); }, { once: true });
			control.appendChild(image);
		} else {
			control.classList.add('abbc3-control--text');
		}
		const fallback = document.createElement('span');
		fallback.className = `abbc3-control__fallback${fontIcon || path ? ' abbc3-control__fallback--hidden' : ''}`;
		fallback.textContent = item.dataset.name;
		control.appendChild(fallback);
		return control;
	};

	const renderPreview = () => {
		previewPrimary.querySelectorAll('[data-preview-control]').forEach(control => control.remove());
		previewMore.textContent = '';
		columns.forEach(column => {
			if (column.dataset.placement === 'hidden') {
				return;
			}
			const groups = [];
			let group = [];
			column.querySelectorAll('.abbc3-composer-item').forEach(item => {
				if (isDivider(item)) {
					if (group.length) {
						groups.push(group);
					}
					group = [];
				} else {
					group.push(previewControl(item));
				}
			});
			if (group.length) {
				groups.push(group);
			}
			groups.forEach((controls, index) => {
				if (groups.length > 1) {
					const wrapper = document.createElement('div');
					wrapper.className = 'abbc3-toolbar__group';
					if (index) {
						wrapper.classList.add('abbc3-toolbar__group--divided');
					}
					wrapper.append(...controls);
					controls = [wrapper];
				}
				controls.forEach(control => {
					control.dataset.previewControl = '';
					if (column.dataset.placement === 'primary') {
						previewPrimary.insertBefore(control, previewToggle);
					} else {
						previewMore.appendChild(control);
					}
				});
			});
		});
		previewToggle.hidden = !previewMore.children.length;
		if (!previewMore.children.length) {
			previewToggle.setAttribute('aria-expanded', 'false');
			previewMore.hidden = true;
		}
		columns.forEach(column => {
			column.querySelector('[data-column-count]').textContent = column.querySelectorAll('.abbc3-composer-item:not(.abbc3-composer-item--divider)').length;
		});
	};

	const syncNames = () => {
		columns.forEach(column => column.querySelectorAll('[data-toolbar-key]').forEach(input => { input.name = `toolbar_${column.dataset.placement}[]`; }));
		renderPreview();
	};

	const selectItem = item => {
		allItems().forEach(candidate => {
			const active = candidate === item;
			candidate.classList.toggle('abbc3-composer-item--selected', active);
			candidate.querySelector('[data-item-select]').setAttribute('aria-pressed', String(active));
		});
		selected = item;
		inspector.hidden = !item;
		if (!item) {
			return;
		}
		const divider = isDivider(item);
		inspector.classList.toggle('abbc3-inspector--divider', divider);
		inspector.querySelector('[data-inspector-label]').textContent = item.dataset.label;
		placementSelect.value = item.closest('[data-composer-column]').dataset.placement;
		hiddenPlacement.disabled = divider;
		removeDivider.hidden = !divider;
		iconSelect.closest('label').hidden = divider;
		fontIconInput.closest('label').hidden = divider;
		inspectorTag.hidden = divider;
		inspectorIcon.hidden = divider;
		if (divider) {
			return;
		}
		inspectorTag.textContent = `[${item.dataset.name}]`;
		iconSelect.value = iconName(item);
		fontIconInput.value = fontIconName(item);
		iconSelect.disabled = isSelectControl(item);
		fontIconInput.disabled = isSelectControl(item);
		renderIcon(inspectorIcon, item);
	};

	previewToggle.addEventListener('click', () => {
		const expanded = previewToggle.getAttribute('aria-expanded') === 'true';
		previewToggle.setAttribute('aria-expanded', String(!expanded));
		previewToggle.title = expanded ? previewToggle.dataset.titleShow : previewToggle.dataset.titleHide;
		previewMore.hidden = expanded;
	});

	composer.addEventListener('click', event => {
		const add = event.target.closest('[data-add-divider]');
		if (add) {
			const list = add.closest('[data-composer-column]').querySelector('[data-composer-list]');
			const divider = dividerTemplate.content.firstElementChild.cloneNode(true);
			const next = selected && selected.parentNode === list ? selected.nextElementSibling : null;
			list.insertBefore(divider, next);
			selectItem(divider);
			divider.querySelector('[data-item-select]').focus();
			syncNames();
			saveToolbar();
			return;
		}
		const trigger = event.target.closest('[data-item-select]');
		if (trigger) {
			selectItem(trigger.closest('.abbc3-composer-item'));
		}
	});

	removeDivider.addEventListener('click', () => {
		if (!selected || !isDivider(selected)) {
			return;
		}
		const next = selected.nextElementSibling || selected.previousElementSibling;
		const add = selected.closest('[data-composer-column]').querySelector('[data-add-divider]');
		selected.remove();
		selectItem(next);
		(next ? next.querySelector('[data-item-select]') : add).focus();
		syncNames();
		saveToolbar();
	});

	iconSelect.addEventListener('change', () => {
		if (!selected || isDivider(selected)) {
			return;
		}
		selected.querySelector('[data-icon-value]').value = iconSelect.value;
		updateItemIcon(selected);
		renderIcon(inspectorIcon, selected);
		renderPreview();
		saveToolbar();
	});

	fontIconInput.addEventListener('blur', () => {
		if (!selected || isDivider(selected)) {
			return;
		}
		fontIconInput.value = normalizeFontIcon(fontIconInput.value);
		selected.querySelector('[data-font-icon-value]').value = fontIconInput.value;
		updateItemIcon(selected);
		renderIcon(inspectorIcon, selected);
		renderPreview();
		saveToolbar();
	});

	form.querySelectorAll('[data-autosave-setting]').forEach(input => input.addEventListener('change', () => {
		if (input.name === 'abbc3_icons_type') {
			buttonItems().forEach(updateItemIcon);
			if (selected && !isDivider(selected)) {
				renderIcon(inspectorIcon, selected);
			}
			renderPreview();
		}
		if (input === toolbarEnabled && toolbarDisabled) {
			toolbarDisabled.hidden = input.checked;
		}
		saveSetting(input);
	}));

	fontSaveButton.addEventListener('click', saveFonts);
	fonts.addEventListener('input', () => {
		fontStatus.textContent = '';
		delete fontStatus.dataset.state;
		syncFontButton();
	});

	retryButton.addEventListener('click', () => {
		failed.forEach((failure, scope) => pending.set(scope, failure.payload));
		failed.clear();
		processQueue();
	});

	placementSelect.addEventListener('change', () => {
		if (!selected || (isDivider(selected) && placementSelect.value === 'hidden')) {
			return;
		}
		columns.find(column => column.dataset.placement === placementSelect.value).querySelector('[data-composer-list]').appendChild(selected);
		syncNames();
		saveToolbar();
	});

	inspector.addEventListener('click', event => {
		const move = event.target.closest('[data-inspector-move]');
		if (!move || !selected) {
			return;
		}
		let moved = false;
		if (move.dataset.inspectorMove === 'up' && selected.previousElementSibling) {
			selected.parentNode.insertBefore(selected, selected.previousElementSibling);
			moved = true;
		}
		if (move.dataset.inspectorMove === 'down' && selected.nextElementSibling) {
			selected.parentNode.insertBefore(selected.nextElementSibling, selected);
			moved = true;
		}
		syncNames();
		if (moved) {
			saveToolbar();
		}
	});

	const clearDropTargets = () => columns.forEach(column => column.classList.remove('abbc3-composer-column--target'));
	const finishDrag = cancelled => {
		if (!drag) {
			return;
		}
		if (cancelled) {
			drag.origin.parentNode.insertBefore(drag.item, drag.origin);
			drag.placeholder.remove();
		} else {
			drag.placeholder.replaceWith(drag.item);
		}
		drag.origin.remove();
		drag.ghost.remove();
		clearDropTargets();
		document.body.classList.remove('abbc3-is-dragging');
		drag = null;
		syncNames();
		if (!cancelled) {
			saveToolbar();
		}
		if (selected) {
			selectItem(selected);
		}
	};

	const moveDrag = event => {
		if (!drag || event.pointerId !== drag.pointerId) {
			return;
		}
		event.preventDefault();
		drag.ghost.style.transform = `translate3d(${event.clientX - drag.startX}px, ${event.clientY - drag.startY}px, 0)`;
		const target = document.elementFromPoint(event.clientX, event.clientY);
		const column = target ? target.closest('[data-composer-column]') : null;
		if (column && !(isDivider(drag.item) && column.dataset.placement === 'hidden')) {
			const list = column.querySelector('[data-composer-list]');
			const before = [ ...list.querySelectorAll('.abbc3-composer-item') ].find(item => event.clientY < item.getBoundingClientRect().top + item.getBoundingClientRect().height / 2);
			if (before) {
				list.insertBefore(drag.placeholder, before);
			} else {
				list.appendChild(drag.placeholder);
			}
			clearDropTargets();
			column.classList.add('abbc3-composer-column--target');
		} else {
			clearDropTargets();
		}
		if (event.clientY < 48) {
			window.scrollBy(0, -12);
		} else if (event.clientY > window.innerHeight - 48) {
			window.scrollBy(0, 12);
		}
	};

	composer.addEventListener('pointerdown', event => {
		const handle = event.target.closest('[data-drag-handle]');
		if (!handle || event.button !== 0 || drag || window.matchMedia('(max-width: 1050px)').matches) {
			return;
		}
		event.preventDefault();
		const item = handle.closest('.abbc3-composer-item');
		const rect = item.getBoundingClientRect();
		const origin = document.createComment('abbc3-origin');
		item.parentNode.insertBefore(origin, item);
		const placeholder = document.createElement('li');
		placeholder.className = 'abbc3-composer-placeholder';
		placeholder.style.height = `${rect.height}px`;
		item.parentNode.insertBefore(placeholder, item);
		const ghost = item.cloneNode(true);
		ghost.classList.add('abbc3-composer-ghost');
		ghost.style.width = `${rect.width}px`;
		ghost.style.left = `${rect.left}px`;
		ghost.style.top = `${rect.top}px`;
		document.body.appendChild(ghost);
		item.remove();
		drag = { item, origin, placeholder, ghost, pointerId: event.pointerId, startX: event.clientX, startY: event.clientY };
		document.body.classList.add('abbc3-is-dragging');
	});

	window.addEventListener('pointermove', moveDrag, { passive: false });
	window.addEventListener('pointerup', event => {
		if (!drag || event.pointerId !== drag.pointerId) {
			return;
		}
		const target = document.elementFromPoint(event.clientX, event.clientY);
		finishDrag(isDivider(drag.item) && !!(target && target.closest('[data-placement="hidden"]')));
	});
	window.addEventListener('pointercancel', event => {
		if (drag && event.pointerId === drag.pointerId) {
			finishDrag(true);
		}
	});
	window.addEventListener('blur', () => finishDrag(true));

	form.addEventListener('submit', event => event.preventDefault());

	buttonItems().forEach(updateItemIcon);
	syncNames();
	syncFontButton();
	form.querySelectorAll('[data-abbc3-editable]').forEach(fieldset => { fieldset.disabled = false; });
})();
