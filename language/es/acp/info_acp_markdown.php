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
	'ALLOW_MARKDOWN' => 'Permitir Markdown',
	'ALLOW_POST_MARKDOWN' => 'Permitir Markdown en mensajes',
	'ALLOW_PM_MARKDOWN' => 'Permitir Markdown en mensajes privados',
	'ALLOW_SIG_MARKDOWN' => 'Permitir Markdown en la firma del usuario'
]);
