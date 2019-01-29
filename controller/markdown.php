<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\controller;

use phpbb\help\controller\controller;

class markdown extends controller
{
	/**
	 * Show markdown help.
	 *
	 * @return string
	 */
	public function display()
	{
		$this->language->add_lang('help/markdown', 'alfredoramos/markdown');

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_INTRO',
			false,
			[
				'HELP_MARKDOWN_INTRO_MARKDOWN_QUESTION' => 'HELP_MARKDOWN_INTRO_MARKDOWN_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_TEXT',
			false,
			[
				'HELP_MARKDOWN_TEXT_BOLD_QUESTION' => 'HELP_MARKDOWN_TEXT_BOLD_ANSWER',
				'HELP_MARKDOWN_TEXT_ITALIC_QUESTION' => 'HELP_MARKDOWN_TEXT_ITALIC_ANSWER',
				'HELP_MARKDOWN_TEXT_STRIKETHROUGH_QUESTION' => 'HELP_MARKDOWN_TEXT_STRIKETHROUGH_ANSWER',
				'HELP_MARKDOWN_TEXT_SUBSCRIPT_QUESTION' => 'HELP_MARKDOWN_TEXT_SUBSCRIPT_ANSWER',
				'HELP_MARKDOWN_TEXT_SUPERSCRIPT_QUESTION' => 'HELP_MARKDOWN_TEXT_SUPERSCRIPT_ANSWER',
				'HELP_MARKDOWN_TEXT_INLINE_CODE_QUESTION' => 'HELP_MARKDOWN_TEXT_INLINE_CODE_ANSWER'
			]
		);

		return $this->language->lang('MARKDOWN_GUIDE');
	}
}
