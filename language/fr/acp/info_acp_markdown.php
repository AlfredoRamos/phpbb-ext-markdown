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
	'ALLOW_MARKDOWN' => 'Autoriser le Markdown',
	'ALLOW_POST_MARKDOWN' => 'Autoriser le Markdown dans les messages',
	'ALLOW_PM_MARKDOWN' => 'Autoriser le Markdown dans les messages privés',
	'ALLOW_SIG_MARKDOWN' => 'Autoriser le Markdown dans les signatures'
]);
