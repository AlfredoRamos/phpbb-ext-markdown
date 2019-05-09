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
	'ACL_F_MARKDOWN' => 'Can use Markdown',
	'ACL_U_POST_MARKDOWN' => 'Can use Markdown',
	'ACL_U_PM_MARKDOWN' => 'Can use Markdown in private messages',
	'ACL_U_SIG_MARKDOWN' => 'Can use Markdown in signature'
]);
