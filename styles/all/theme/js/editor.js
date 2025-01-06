/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

(() => {
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
	const inCodeBlock = (textarea) => {
		const start = textarea.selectionStart;
		const end = textarea.selectionEnd;
		const value = textarea.value.slice(start, end);

		if (value.indexOf('```') >= 0 || value.indexOf('~~~') >= 0) {
			return false;
		}

		const selectedValue = textarea.value.slice(0, start);
		const codeBlocksRegexp = /`{3}|~{3}/g;
		const codeBlocks = selectedValue.match(codeBlocksRegexp);

		if (codeBlocks === null) {
			return false;
		}

		return codeBlocks.length % 2 === 1;
	};

	// Enable tabulations in Markdown code
	document.body.addEventListener('keydown', (e) => {
		// Event already handled
		if (e.defaultPrevented) {
			return;
		}

		// Helpers
		const field = e.target;
		const selector = 'textarea[name="message"], textarea[name="signature"]';

		// Match post, private message and signature
		// Triggered only on Tab key press
		// Cursor must be inside a Markdown code block
		if (
			!field.matches(selector) ||
			e.key !== 'Tab' ||
			!inCodeBlock(field)
		) {
			return;
		}

		// Avoid lossing focus
		e.preventDefault();

		// Get caret position
		const start = field.selectionStart;
		const end = field.selectionEnd;

		// Get previous value
		const value = field.value;

		// Add Tab character at caret position
		field.value = value.substring(0, start) + '\t' + value.substring(end);

		// Update caret position
		field.selectionStart = field.selectionEnd = start + 1;
	});
})();
