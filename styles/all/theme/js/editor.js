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
		const codeBlocksRegexp = /`{3}|~{3}/g;
		let codeBlocks = selectedValue.match(codeBlocksRegexp);

		if (codeBlocks === null) {
			return false;
		}

		return (codeBlocks.length % 2 === 1);
	};

	// Enable tabulations in Markdown code
	document.body.addEventListener('keydown', function(e) {
		// Event already handled
		if (e.defaultPrevented) {
			return;
		}

		let field = e.target;

		// Match post, private message and signature
		if (!field.matches('textarea[name="message"], textarea[name="signature"]')) {
			return;
		}

		// Tab key
		if (e.key !== 'Tab') {
			return;
		}

		// Check if cursor is inside a Markdown code block
		let isCodeBlock = inCodeBlock(field);

		// There's nothing to do
		if (!isCodeBlock) {
			return;
		}

		// Avoid lossing focus
		e.preventDefault();

		// Get caret position
		let start = field.selectionStart;
		let end = field.selectionEnd;

		// Get previous value
		let value = field.value;

		// Add Tab character at caret position
		field.value = value.substring(0, start) + '\t' + value.substring(end);

		// Update caret position
		field.selectionStart = field.selectionEnd = (start + 1);
	});
})();
