/**
 *
 * Advanced BBCodes
 *
 * @copyright (c) 2013-2025 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/*global bbfontstyle, is_ie, form_name, text_name, insert_text, storeCaret, baseHeight:true */

// global scope vars
let requestRunning = false;
let bbwizard;

(function($) { // Avoid conflicts with other libraries

	'use strict';

	/**
	 * Show the bbcode wizard (scope must be global)
	 */
	bbwizard = function(href, bbcode) {
		if (!requestRunning) {
			const wizard = $('#bbcode_wizard'),
				modal = $('#darkenwrapper');
			if (!wizard.is(':visible')) {
				requestRunning = true;
				const $loadingIndicator = phpbb.loadingIndicator();
				$.ajax({
					url: href,
					dataType: 'html',
					beforeSend: function() {
						// Clear the bbwizard div
						wizard.hide().empty();
					},
					success: function(data) {
						// Append the new html to the bbwizard div and show it
						modal.fadeIn('fast');
						wizard.append(data).fadeIn('fast').find('#bbcode_wizard_submit').attr('data-bbcode', bbcode);
					},
					error: function() {
						// On AJAX error, revert to default bbcode application
						bbfontstyle('[' + bbcode + ']', '[/' + bbcode + ']');
					},
					complete: function() {
						requestRunning = false;
						if ($loadingIndicator && $loadingIndicator.is(':visible')) {
							$loadingIndicator.fadeOut(phpbb.alertTime);
						}
					},
				});
			}
		}
	};

	/**
	 * DOM READY
	 */
	$(function() {

		const body = $('body');

		/**
		 * Function spoiler toggle
		 */
		body.on('click', '.spoilbtn', function(event) {
			event.preventDefault();
			const trigger = $(this),
				spoiler = trigger.closest('div').next('.spoilcontent');
			spoiler.slideToggle('fast', function() {
				trigger.text(spoiler.is(':visible') ? trigger.data('hide') : trigger.data('show'));
			});
		});

		/**
		 * BBCode Wizard listener events
		 */
		const wizard = $('#bbcode_wizard'),
			modal = $('#darkenwrapper');
		const closeWizard = function() {
			if (wizard.is(':visible')) {
				wizard.fadeOut('fast');
				modal.fadeOut('fast');
			}
		};
		// Click on body or ESC to dismiss bbcode wizard
		body.on('click', closeWizard).on('keyup', function(event) {
			if (event.key === 'Escape' || event.keyCode === 27) {
				event.preventDefault();
				closeWizard();
			}
		});
		wizard
			// Click on the bbcode wizard submit button to apply bbcode to the message
			.on('click', '#bbcode_wizard_submit', function(event) {
				event.preventDefault();
				const bbcode = $(this).data('bbcode');
				switch (bbcode) {
					case 'url':
						const link = $('#bbcode_wizard_link').val(),
							description = $('#bbcode_wizard_description').val();
						insert_text('[' + bbcode + ((description.length) ? '=' + link : '') + ']' + ((description.length) ? description : link) + '' + '[/' + bbcode + ']');
						break;
					case 'bbvideo':
					case 'media':
						insert_text('[' + bbcode + ']' + $('#bbvideo_wizard_link').val() + '' + '[/' + bbcode + ']');
						break;
				}
				closeWizard();
			})
			// Click on the bbcode wizard cancel button to dismiss bbcode wizard
			.on('click', '#bbcode_wizard_cancel', function(event) {
				event.preventDefault();
				closeWizard();
			})
			// Change bbvideo allowed sites option updates bbvideo example
			.on('change', '#bbvideo_wizard_sites', function() {
				$('#bbvideo_wizard_example').val($(this).val());
			})
			// Prevent clicks on bbcode wizard from bubbling up to the body and prematurely dismissing itself
			.on('click', function(event) {
				event.stopPropagation();
			})
		;

	});

})(jQuery); // Avoid conflicts with other libraries
