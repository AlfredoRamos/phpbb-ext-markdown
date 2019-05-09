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
	'ACL_F_MARKDOWN' => 'Puede usar Markdown',
	'ACL_U_POST_MARKDOWN' => 'Puede usar Markdown',
	'ACL_U_PM_MARKDOWN' => 'Puede usar Markdown en mensajes privados',
	'ACL_U_SIG_MARKDOWN' => 'Puede usar Markdown en la firma del usuario'
]);
