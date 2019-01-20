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
	'HELP_MARKDOWN_INTRO_MARKDOWN_ANSWER' => 'Markdown is a lightweight markup language with plain text formatting syntax aimed for web writers. It allows you to easily write text, without the need or help of external tools or a user interface, that later will be formatted as HTML while maintaining readability. Markdown can be used instead of or in conjunction of text formatted with BBCode.'
]);
