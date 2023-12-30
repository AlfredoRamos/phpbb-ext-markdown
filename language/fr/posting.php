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
	'MARKDOWN_STATUS_FORMAT' => '<a href="%1$s">Markdown</a> est <em>%2$s</em>',
	'MARKDOWN_IS_ON' => 'Activé',
	'MARKDOWN_IS_OFF' => 'Désactivé',
	'DISABLE_MARKDOWN' => 'Désactiver le Markdown'
]);
