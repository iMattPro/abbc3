/**
 *
 * Advanced BBCode Box
 *
 * @copyright (c) 2013 Matt Friedman
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

/*global bbfontstyle, is_ie, form_name, text_name, insert_text, storeCaret, baseHeight:true */

// global scope vars
var requestRunning = false;
var bbwizard;

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
	 * Insert BBCode into message (position cursor after insertion)
	 */
	const bbinsert = function(bbopen, bbclose) {
		let textarea;

		if (is_ie) {
			textarea = document.forms[form_name].elements[text_name];
			textarea.focus();
			baseHeight = document.selection.createRange().duplicate().boundingHeight;
		}

		//initInsertions();
		insert_text(bbopen + bbclose);

		// The new position for the cursor after adding the bbcode
		if (is_ie) {
			const text = bbopen + bbclose;
			const pos = textarea.innerHTML.indexOf(text);
			if (pos > 0) {
				const new_pos = pos + text.length;
				const range = textarea.createTextRange();
				range.move('character', new_pos);
				range.select();
				storeCaret(textarea);
				textarea.focus();
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
			// Click on bbcode wizard submit button to apply bbcode to message
			.on('click', '#bbcode_wizard_submit', function(event) {
				event.preventDefault();
				const bbcode = $(this).data('bbcode');
				switch (bbcode) {
					case 'url':
						const link = $('#bbcode_wizard_link').val(),
							description = $('#bbcode_wizard_description').val();
						bbinsert('[' + bbcode + ((description.length) ? '=' + link : '') + ']' + ((description.length) ? description : link) + '', '[/' + bbcode + ']');
						break;
					case 'bbvideo':
					case 'media':
						bbinsert('[' + bbcode + ']' + $('#bbvideo_wizard_link').val() + '', '[/' + bbcode + ']');
						break;
				}
				closeWizard();
			})
			// Click on bbcode wizard cancel button to dismiss bbcode wizard
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
