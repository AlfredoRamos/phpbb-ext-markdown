<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@skiff.com>
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
	'ACL_F_MARKDOWN' => 'Peut-utiliser Markdown',
	'ACL_U_POST_MARKDOWN' => 'Peut-utiliser Markdown',
	'ACL_U_PM_MARKDOWN' => 'Peut-utiliser Markdown dans les messages privés',
	'ACL_U_SIG_MARKDOWN' => 'Peut-utiliser Markdown dans la signature'
]);
