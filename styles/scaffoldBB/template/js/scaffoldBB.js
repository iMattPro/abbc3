(() => {
	'use strict';

	document.querySelectorAll('.materialbutton .icon').forEach(icon => {
		icon.classList.add('fa');
		icon.parentElement.classList.add('btn', 'btn-sm', 'btn-secondary');
	});

	document.querySelectorAll('.pipe-table').forEach(table => {
		table.parentElement.classList.add('table-responsive');
		table.parentElement.style.lineHeight = 'inherit';
		table.parentElement.style.border = 'inherit';
		table.classList.add('table', 'table-sm', 'table-striped', 'table-bordered', 'table-hover');
		table.querySelectorAll('th').forEach(th => {
			th.style.backgroundColor = 'var(--bs-table-bg)';
			th.style.color = 'var(--bs-body-color)';
		});
	});
})();
