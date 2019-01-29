<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'MARKDOWN_GUIDE' => 'Markdown guide',

	'HELP_MARKDOWN_BLOCK_INTRO' => 'Introduction',
	'HELP_MARKDOWN_INTRO_MARKDOWN_QUESTION' => 'What is Markdown?',
	'HELP_MARKDOWN_INTRO_MARKDOWN_ANSWER' => 'Markdown is a lightweight markup language with plain text formatting syntax aimed for web writers. It allows you to easily write text, without the need or help of external tools or a user interface, that later will be formatted as HTML while maintaining readability. Markdown can be used instead of or in conjunction of text formatted with BBCode.',

	'HELP_MARKDOWN_BLOCK_TEXT' => 'Text formatting',
	'HELP_MARKDOWN_TEXT_BOLD_QUESTION' => 'How to create bold text?',
	'HELP_MARKDOWN_TEXT_BOLD_ANSWER' => 'To make a piece of text bold, enclose it in a pair of <strong>**</strong> or <strong>__</strong>, e.g.<br /><br /><strong>**</strong>Hello<strong>**</strong> or <strong>__</strong>Hello<strong>__</strong> will become <strong>Hello</strong>',
	'HELP_MARKDOWN_TEXT_ITALIC_QUESTION' => 'How to create italic text?',
	'HELP_MARKDOWN_TEXT_ITALIC_ANSWER' => 'To italicise text, enclose it in a pair of <strong>*</strong> or <strong>_</strong>, e.g.<br /><br /><strong>*</strong>Great!<strong>*</strong> or <strong>_</strong>Great!<strong>_</strong> will become <em>Great!</em>',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_QUESTION' => 'How to create strikethrough text?',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_ANSWER' => 'To strikethrough text, enclose it in a pair of <strong>~~</strong>, e.g.<br /><br />Good <strong>~~</strong>morning<strong>~~</strong> will become Good <del>morning</del>',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_QUESTION' => 'How to create subscript text?',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_ANSWER' => 'To create subscript text, enclose it in a pair of<strong>~</strong>, e.g.<br /><br />H<strong>~</strong>2<strong>~</strong>O will become H<sub>2</sub>O',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_QUESTION' => 'How to create superscript text?',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_ANSWER' => 'To create a superscript text, add <strong>^</strong> before the text, e.g.<br /><br />2^n will become 2<sup>n</sup>',
	'HELP_MARKDOWN_TEXT_INLINE_CODE_QUESTION' => 'How to create inline code?',
	'HELP_MARKDOWN_TEXT_INLINE_CODE_ANSWER' => 'To create inline code, enclose it in pair of <strong>`</strong> or <strong>``</strong>, e.g.<br /><br /><strong>`</strong>&lt;div&gt;<strong>`</strong> or <strong>``</strong>&lt;div&gt;<strong>``</strong> will become <code>&lt;div&gt;</code>'
]);
