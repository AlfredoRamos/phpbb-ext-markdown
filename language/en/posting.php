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
	'MARKDOWN_STATUS_FORMAT' => '<a href="%s">Markdown</a> is <em>%s</em>',
	'MARKDOWN_IS_ON' => 'ON',
	'MARKDOWN_IS_OFF' => 'OFF',
	'DISABLE_MARKDOWN' => 'Disable Markdown',

	// Imgur extension
	'IMGUR_OUTPUT_MARKDOWN_IMAGE' => 'Markdown image',
	'ACP_IMGUR_OUTPUT_MARKDOWN_IMAGE_EXPLAIN' => '<code>![<var>{title}</var>](<var>{image}</var>)</code>',
	'IMGUR_OUTPUT_MARKDOWN_THUMBNAIL' => 'Markdown thumbnail',
	'ACP_IMGUR_OUTPUT_MARKDOWN_THUMBNAIL_EXPLAIN' => '<code>[![<var>{title}</var>](<var>{thumbnail}</var>)](<var>{image}</var>)</code>'
]);
