/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

(function() {
	'use strict';

	/**
	 * Check if cursor is inside a Markdown code block.
	 *
	 * Modified version of Ben Nadel's code
	 * https://github.com/bennadel/JavaScript-Demos/tree/master/demos/fenced-code-block-tabbing
	 *
	 * @param {HTMLElement} textarea Textarea DOM object to check.
	 *
	 * @return {bool}
	 */
	const inCodeBlock = function(textarea) {
		const start = textarea.selectionStart;
		const end = textarea.selectionEnd;
		const value = textarea.value.slice(start, end);

		if (value.indexOf('```') >= 0 || value.indexOf('~~~') >= 0) {
			return false;
		}

		let selectedValue = textarea.value.slice(0, start);
		const codeBlockRegexp = /`{3}|~{3}/g;
		let codeBlocks = selectedValue.match(codeBlockRegexp);

		if (codeBlocks === null) {
			return false;
		}

		return (codeBlocks.length % 2 === 1);
	}

	// Get postingbox and signature textarea
	let textarea = document.body.querySelectorAll('textarea[name="message"], textarea[name="signature"]');

	// Iterate over all textareas
	textarea.forEach(function(item) {
		if (!item) {
			return;
		}

		// Keydown event on each textarea
		item.addEventListener('keydown', function(e) {
			// Tab key
			if (e.keyCode !== 9) {
				return;
			}

			// Check if cursor is inside Markdown fenced code block
			let isCodeBlock = inCodeBlock(this);

			// There's nothing to do
			if (!isCodeBlock) {
				return;
			}

			// Avoid lossing focus
			e.preventDefault();

			// Get caret position
			let start = this.selectionStart;
			let end = this.selectionEnd;

			// Get previous value
			let value = this.value;

			// Add Tab character at caret position
			this.value = value.substring(0, start) + '\t' + value.substring(end);

			// Update caret position
			this.selectionStart = this.selectionEnd = (start + 1);
		});
	});
})();
