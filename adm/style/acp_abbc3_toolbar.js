(() => {
	'use strict';

	const composer = document.querySelector('[data-abbc3-composer]');
	const form = document.getElementById('abbc3_settings');
	const inspector = document.querySelector('[data-abbc3-inspector]');
	const iconSelect = inspector ? inspector.querySelector('[data-inspector-icon-select]') : null;
	const placementSelect = inspector ? inspector.querySelector('[data-inspector-placement]') : null;
	const previewPrimary = document.querySelector('[data-preview-primary]');
	const previewMore = document.querySelector('[data-preview-more]');
	const previewToggle = document.querySelector('[data-preview-more-toggle]');
	const saveStatus = document.querySelector('[data-autosave-status]');
	const saveMessage = document.querySelector('[data-autosave-message]');
	const retryButton = document.querySelector('[data-autosave-retry]');
	const fonts = document.querySelector('[data-autosave-fonts]');
	const toolbarEnabled = document.getElementById('abbc3_bbcode_bar');
	const toolbarDisabled = document.querySelector('[data-toolbar-disabled]');
	if (!composer || !form || !inspector || !iconSelect || !placementSelect || !previewPrimary || !previewMore || !previewToggle || !saveStatus || !saveMessage || !retryButton || !fonts) return;

	const columns = [ ...composer.querySelectorAll('[data-composer-column]') ];
	const allItems = () => [ ...composer.querySelectorAll('.abbc3-composer-item') ];
	let selected = null;
	let drag = null;
	let fontTimer = null;
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
		saveStatus.hidden = false;
		saveStatus.dataset.state = state;
		saveMessage.textContent = message;
		retryButton.hidden = state !== 'error';
		form.setAttribute('aria-busy', String(state === 'saving'));
	};

	const responseMessage = response => {
		const holder = document.createElement('div');
		holder.innerHTML = response.MESSAGE_TEXT || '';
		holder.querySelectorAll('a').forEach(link => link.remove());
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
			saveStatus.hidden = true;
			savedTimer = null;
		}, 2000);
	};

	const processQueue = () => {
		if (saving || !pending.size) return;
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
		allItems().forEach(item => {
			const input = item.querySelector('[data-icon-value]');
			payload.append(input.name, input.value);
		});
		enqueue('toolbar', payload);
	};

	const saveSetting = input => {
		if (input.type === 'radio' && !input.checked) return;
		const payload = basePayload('setting');
		payload.set('setting_name', input.name);
		payload.set('setting_value', input.type === 'checkbox' ? (input.checked ? '1' : '0') : input.value);
		enqueue(`setting:${input.name}`, payload);
	};

	const saveFonts = () => {
		if (fontTimer !== null) {
			window.clearTimeout(fontTimer);
			fontTimer = null;
		}
		const payload = basePayload('fonts');
		payload.set('abbc3_google_fonts', fonts.value);
		enqueue('fonts', payload);
	};

	const iconPath = name => {
		const option = [ ...iconSelect.options ].find(candidate => candidate.value === name);
		if (!option) return '';
		const type = iconTypeValue();
		const preferred = option.dataset[`icon${type[0].toUpperCase()}${type.slice(1)}`];
		return preferred || option.dataset.iconPng || option.dataset.iconSvg || '';
	};

	const iconName = item => item.querySelector('[data-icon-value]').value;
	const textFallback = item => item.dataset.name.slice(0, 2);
	const isSelectControl = item => item.dataset.type === 'size' || item.dataset.name === 'font';

	const renderIcon = (container, item) => {
		container.textContent = '';
		if (isSelectControl(item)) {
			container.textContent = 'Aa';
			return;
		}
		const path = iconPath(iconName(item));
		if (!path) {
			container.textContent = textFallback(item);
			return;
		}
		const image = document.createElement('img');
		image.src = path;
		image.alt = '';
		image.addEventListener('error', () => { container.textContent = textFallback(item); }, { once: true });
		container.appendChild(image);
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
		const path = iconPath(iconName(item));
		if (path) {
			control.classList.add('abbc3-control--icon');
			const image = document.createElement('img');
			image.className = 'abbc3-control__icon';
			image.src = path;
			image.alt = '';
			image.addEventListener('error', () => { control.classList.add('abbc3-control--icon-error'); }, { once: true });
			control.appendChild(image);
		}
		const fallback = document.createElement('span');
		fallback.className = `abbc3-control__fallback${path ? ' abbc3-control__fallback--hidden' : ''}`;
		fallback.textContent = item.dataset.name;
		control.appendChild(fallback);
		return control;
	};

	const renderPreview = () => {
		previewPrimary.querySelectorAll('[data-preview-control]').forEach(control => control.remove());
		previewMore.textContent = '';
		columns.forEach(column => {
			if (column.dataset.placement === 'hidden') return;
			column.querySelectorAll('.abbc3-composer-item').forEach(item => {
				const control = previewControl(item);
				control.dataset.previewControl = '';
				if (column.dataset.placement === 'primary') previewPrimary.insertBefore(control, previewToggle);
				else previewMore.appendChild(control);
			});
		});
		previewToggle.hidden = !previewMore.children.length;
		if (!previewMore.children.length) {
			previewToggle.setAttribute('aria-expanded', 'false');
			previewMore.hidden = true;
		}
		columns.forEach(column => { column.querySelector('[data-column-count]').textContent = column.querySelectorAll('.abbc3-composer-item').length; });
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
		if (!item) return;
		inspector.querySelector('[data-inspector-label]').textContent = item.dataset.label;
		inspector.querySelector('[data-inspector-tag]').textContent = `[${item.dataset.name}]`;
		placementSelect.value = item.closest('[data-composer-column]').dataset.placement;
		iconSelect.value = iconName(item);
		iconSelect.disabled = isSelectControl(item);
		renderIcon(inspector.querySelector('[data-inspector-icon]'), item);
	};

	previewToggle.addEventListener('click', () => {
		const expanded = previewToggle.getAttribute('aria-expanded') === 'true';
		previewToggle.setAttribute('aria-expanded', String(!expanded));
		previewToggle.title = expanded ? previewToggle.dataset.titleShow : previewToggle.dataset.titleHide;
		previewMore.hidden = expanded;
	});

	composer.addEventListener('click', event => {
		const trigger = event.target.closest('[data-item-select]');
		if (trigger) selectItem(trigger.closest('.abbc3-composer-item'));
	});

	iconSelect.addEventListener('change', () => {
		if (!selected) return;
		selected.querySelector('[data-icon-value]').value = iconSelect.value;
		updateItemIcon(selected);
		renderIcon(inspector.querySelector('[data-inspector-icon]'), selected);
		renderPreview();
		saveToolbar();
	});

	form.querySelectorAll('[data-autosave-setting]').forEach(input => input.addEventListener('change', () => {
		if (input.name === 'abbc3_icons_type') {
			allItems().forEach(updateItemIcon);
			if (selected) renderIcon(inspector.querySelector('[data-inspector-icon]'), selected);
			renderPreview();
		}
		if (input === toolbarEnabled && toolbarDisabled) toolbarDisabled.hidden = input.checked;
		saveSetting(input);
	}));

	fonts.addEventListener('input', () => {
		if (fontTimer !== null) window.clearTimeout(fontTimer);
		fontTimer = window.setTimeout(saveFonts, 1000);
	});
	fonts.addEventListener('blur', saveFonts);

	retryButton.addEventListener('click', () => {
		failed.forEach((failure, scope) => pending.set(scope, failure.payload));
		failed.clear();
		processQueue();
	});

	placementSelect.addEventListener('change', () => {
		if (!selected) return;
		columns.find(column => column.dataset.placement === placementSelect.value).querySelector('[data-composer-list]').appendChild(selected);
		syncNames();
		saveToolbar();
	});

	inspector.addEventListener('click', event => {
		const move = event.target.closest('[data-inspector-move]');
		if (!move || !selected) return;
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
		if (moved) saveToolbar();
	});

	const clearDropTargets = () => columns.forEach(column => column.classList.remove('abbc3-composer-column--target'));
	const finishDrag = cancelled => {
		if (!drag) return;
		if (cancelled) {
			drag.origin.parentNode.insertBefore(drag.item, drag.origin);
			drag.placeholder.remove();
		} else drag.placeholder.replaceWith(drag.item);
		drag.origin.remove();
		drag.ghost.remove();
		clearDropTargets();
		document.body.classList.remove('abbc3-is-dragging');
		drag = null;
		syncNames();
		if (!cancelled) saveToolbar();
		if (selected) selectItem(selected);
	};

	const moveDrag = event => {
		if (!drag || event.pointerId !== drag.pointerId) return;
		event.preventDefault();
		drag.ghost.style.transform = `translate3d(${event.clientX - drag.startX}px, ${event.clientY - drag.startY}px, 0)`;
		const target = document.elementFromPoint(event.clientX, event.clientY);
		const column = target ? target.closest('[data-composer-column]') : null;
		if (column) {
			const list = column.querySelector('[data-composer-list]');
			const before = [ ...list.querySelectorAll('.abbc3-composer-item') ].find(item => event.clientY < item.getBoundingClientRect().top + item.getBoundingClientRect().height / 2);
			if (before) list.insertBefore(drag.placeholder, before); else list.appendChild(drag.placeholder);
			clearDropTargets();
			column.classList.add('abbc3-composer-column--target');
		}
		if (event.clientY < 48) window.scrollBy(0, -12);
		else if (event.clientY > window.innerHeight - 48) window.scrollBy(0, 12);
	};

	composer.addEventListener('pointerdown', event => {
		const handle = event.target.closest('[data-drag-handle]');
		if (!handle || event.button !== 0 || drag || window.matchMedia('(max-width: 1050px)').matches) return;
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
	window.addEventListener('pointerup', event => { if (drag && event.pointerId === drag.pointerId) finishDrag(false); });
	window.addEventListener('pointercancel', event => { if (drag && event.pointerId === drag.pointerId) finishDrag(true); });
	window.addEventListener('blur', () => finishDrag(true));

	form.addEventListener('submit', event => event.preventDefault());

	allItems().forEach(updateItemIcon);
	syncNames();
	form.querySelectorAll('[data-abbc3-editable]').forEach(fieldset => { fieldset.disabled = false; });
})();
