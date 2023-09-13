const abbc3mainBox = document.querySelector("#abbc3_buttons");
const abbc3buttons = [
	...document.querySelectorAll("#abbc3_buttons .button-secondary"),
];
const abbc3selectElements = [
	...document.querySelectorAll("#abbc3_buttons select"),
];
const abbc3modal = document.querySelector("#bbcode_wizard");
const abbc3dropdown = document.querySelector(".abbc3_font_menu_btn");
const abbc3dropdownLists = [
	...document.querySelectorAll(".abbc3_font_menu_btn ul"),
];
const abbc3icons = document.querySelectorAll(".materialbutton .icon");
abbc3icons.forEach((icon) => {
	icon.classList.add("fa");
	icon.parentElement.classList.add("btn", "btn-sm", "btn-secondary");
});
const abbc3tables = document.querySelectorAll(".pipe-table");
abbc3tables.forEach((table) => {
	table.parentElement.classList.add("table-responsive");
	table.parentElement.style.lineHeight = "inherit";
	table.parentElement.style.border = "inherit";
	table.classList.add(
		"table",
		"table-sm",
		"table-striped",
		"table-bordered",
		"table-hover"
	);
	table.querySelectorAll("th").forEach((th) => {
		th.style.backgroundColor = "var(--bs-table-bg)";
		th.style.color = "var(--bs-body-color)";
	});
});

if (abbc3mainBox !== null) {
	const abbc3rows = Array.from(abbc3mainBox.children);
	abbc3modal.classList.add("modal");
	abbc3modal.setAttribute("tabindex", "-1");
	abbc3modal.style.cssText +=
		"border: inherit;font-size: inherit;background: inherit;border-radius: inherit;box-shadow: inherit;";
	abbc3mainBox.classList.add("my-2", "gx-0", "row");
	abbc3mainBox.firstElementChild.classList.remove("abbc3_buttons_row");
	abbc3mainBox.firstElementChild.classList.add(
		"bg-gradient",
		"bg-body",
		"border",
		"px-3",
		"rounded-top"
	);
	abbc3mainBox.lastElementChild.classList.remove("abbc3_buttons_row");
	abbc3mainBox.lastElementChild.classList.add(
		"bg-gradient",
		"bg-body",
		"border",
		"border-top-0",
		"px-3",
		"rounded-bottom",
		"pt-1",
		"pb-2"
	);

	if (document.body.contains(document.querySelector(".section-viewtopic"))) {
		abbc3mainBox.firstElementChild.classList.add("col-md-12");
		abbc3mainBox.lastElementChild.classList.add("col-md-12");
	} else {
		abbc3mainBox.firstElementChild.classList.add("col-md-10");
		abbc3mainBox.lastElementChild.classList.add("col-md-10");
	}

	abbc3buttons.forEach((button) => {
		button.classList.add(
			"btn",
			"btn-sm",
			"btn-secondary",
			"bg-gradient",
			"button",
			"button-secondary"
		);
	});
	abbc3selectElements.forEach((element) => {
		element.classList.remove("form-select", "form-select-sm");
		element.style.cssText +=
			"border: 1px solid #ced4da;padding-top: 0.25rem;padding-bottom: 0.25rem;padding-left: 0.5rem;font-size: 0.875rem;border-radius: 0.2rem;height: auto;";
	});

	abbc3dropdown.classList.add("dropdown");
	abbc3dropdown.classList.remove("dropdown-container");
	abbc3dropdown.firstElementChild.classList.add("dropdown-toggle");
	abbc3dropdown.firstElementChild.classList.remove("dropdown-trigger");
	abbc3dropdown.firstElementChild.setAttribute("id", "abbc3-dropdown");
	abbc3dropdown.firstElementChild.setAttribute("data-bs-toggle", "dropdown");
	abbc3dropdown.firstElementChild.setAttribute("aria-expanded", "false");
	abbc3dropdown.firstElementChild.lastChild.remove();

	abbc3dropdown.lastElementChild.classList.remove("dropdown");
	abbc3dropdown.lastElementChild.classList.add("dropdown-menu");
	abbc3dropdown.lastElementChild.setAttribute(
		"aria-labelledby",
		"abbc3-dropdown"
	);
	abbc3dropdown.lastElementChild.lastElementChild.classList.add(
		"list-unstyled"
	);
	abbc3dropdown.lastElementChild.lastElementChild.classList.remove(
		"dropdown-contents"
	);

	abbc3dropdownLists.forEach((elem) => {
		elem.classList.add("list-unstyled", "dropdown-header");
	});
	abbc3rows.forEach((row) => {
		row.classList.remove("abbc3_buttons_row_legacy");
	});
}
