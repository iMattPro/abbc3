const mainBox = document.querySelector('#abbc3_buttons');
const buttons = [ ...document.querySelectorAll('#abbc3_buttons .button-secondary') ];
const selectElements = [ ...document.querySelectorAll('#abbc3_buttons select') ];
const modal = document.querySelector('#bbcode_wizard');
const dropdown = document.querySelector('.abbc3_font_menu_btn');
const dropdownLists = [ ...document.querySelectorAll('.abbc3_font_menu_btn ul') ];

if (mainBox !== null) {
	modal.classList.add('modal');
	modal.setAttribute('tabindex', '-1');
	modal.style.cssText += 'border: inherit;font-size: inherit;background: inherit;border-radius: inherit;box-shadow: inherit;top: 0;left: 0;width: 100%;margin-top: unset;margin-left: unset;';
	mainBox.classList.add('my-2', 'gx-0', 'row');
	mainBox.firstElementChild.classList.remove('abbc3_buttons_row');
	mainBox.firstElementChild.classList.add('bg-gradient', 'bg-body', 'border', 'px-3', 'rounded-top');
	mainBox.lastElementChild.classList.remove('abbc3_buttons_row');
	mainBox.lastElementChild.classList.add('bg-gradient', 'bg-body', 'border', 'border-top-0', 'px-3', 'rounded-bottom', 'pt-1', 'pb-2');

	if (document.body.contains(document.querySelector('.section-viewtopic'))) {
		mainBox.firstElementChild.classList.add('col-md-12');
		mainBox.lastElementChild.classList.add('col-md-12');
	} else {
		mainBox.firstElementChild.classList.add('col-md-10');
		mainBox.lastElementChild.classList.add('col-md-10');
	}

	buttons.forEach(button => {
		button.classList.add('btn', 'btn-sm', 'btn-secondary', 'bg-gradient', 'button', 'button-secondary');
	});
	selectElements.forEach(element => {
		element.style.cssText += 'border: 1px solid #ced4da;padding-top: 0.25rem;padding-bottom: 0.25rem;padding-left: 0.5rem;font-size: 0.875rem;border-radius: 0.2rem;height: auto;';
	});

	dropdown.classList.add('dropdown');
	dropdown.classList.remove('dropdown-container');
	dropdown.firstElementChild.classList.add('dropdown-toggle');
	dropdown.firstElementChild.classList.remove('dropdown-trigger');
	dropdown.firstElementChild.setAttribute('id', 'abbc3-dropdown');
	dropdown.firstElementChild.setAttribute('data-bs-toggle', 'dropdown');
	dropdown.firstElementChild.setAttribute('aria-expanded', 'false');
	dropdown.firstElementChild.lastChild.remove();

	dropdown.lastElementChild.classList.remove('dropdown');
	dropdown.lastElementChild.classList.add('dropdown-menu');
	dropdown.lastElementChild.setAttribute('aria-labelledby', 'abbc3-dropdown');
	dropdown.lastElementChild.lastElementChild.classList.add('list-unstyled');
	dropdown.lastElementChild.lastElementChild.classList.remove('dropdown-contents');

	dropdownLists.forEach(elem => {
		elem.classList.add('list-unstyled', 'dropdown-header');
	});
}
