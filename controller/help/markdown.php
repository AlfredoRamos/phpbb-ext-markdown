<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\controller\help;

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
				'HELP_MARKDOWN_TEXT_HEADER_QUESTION' => 'HELP_MARKDOWN_TEXT_HEADER_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_CODE',
			false,
			[
				'HELP_MARKDOWN_QUOTE_QUESTION' => 'HELP_MARKDOWN_QUOTE_ANSWER',
				'HELP_MARKDOWN_CODE_QUESTION' => 'HELP_MARKDOWN_CODE_ANSWER',
				'HELP_MARKDOWN_CODE_INLINE_QUESTION' => 'HELP_MARKDOWN_CODE_INLINE_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_TABLE',
			false,
			[
				'HELP_MARKDOWN_TABLE_QUESTION' => 'HELP_MARKDOWN_TABLE_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_SPOILER',
			true,
			[
				'HELP_MARKDOWN_BLOCK_SPOILER_QUESTION' => 'HELP_MARKDOWN_BLOCK_SPOILER_ANSWER',
				'HELP_MARKDOWN_INLINE_SPOILER_QUESTION' => 'HELP_MARKDOWN_INLINE_SPOILER_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_LIST',
			true,
			[
				'HELP_MARKDOWN_UNORDERED_LIST_QUESTION' => 'HELP_MARKDOWN_UNORDERED_LIST_ANSWER',
				'HELP_MARKDOWN_ORDERED_LIST_QUESTION' => 'HELP_MARKDOWN_ORDERED_LIST_ANSWER',
				'HELP_MARKDOWN_TASK_LIST_QUESTION' => 'HELP_MARKDOWN_TASK_LIST_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_LINK',
			true,
			[
				'HELP_MARKDOWN_LINK_QUESTION' => 'HELP_MARKDOWN_LINK_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_IMAGE',
			true,
			[
				'HELP_MARKDOWN_IMAGE_QUESTION' => 'HELP_MARKDOWN_IMAGE_ANSWER'
			]
		);

		$this->manager->add_block(
			'HELP_MARKDOWN_BLOCK_EXTRA',
			true,
			[
				'HELP_MARKDOWN_HORIZONTAL_RULE_QUESTION' => 'HELP_MARKDOWN_HORIZONTAL_RULE_ANSWER'
			]
		);

		return $this->language->lang('MARKDOWN_GUIDE');
	}
}
