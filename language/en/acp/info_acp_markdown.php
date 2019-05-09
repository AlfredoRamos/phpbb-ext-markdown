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
	'ALLOW_MARKDOWN' => 'Allow Markdown',
	'ALLOW_POST_MARKDOWN' => 'Allow Markdown in posts',
	'ALLOW_PM_MARKDOWN' => 'Allow Markdown in private messages',
	'ALLOW_SIG_MARKDOWN' => 'Allow Markdown in user signatures'
]);
