<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return [
			'core.acp_board_config_edit_add' => 'acp_markdown_configuration',
			'core.text_formatter_s9e_configure_after' => 'configure_markdown'
		];
	}

	/**
	 * Add markdown configuration in ACP.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function acp_markdown_configuration($event)
	{
		if ($event['mode'] !== 'features')
		{
			return;
		}

		// Insert after BBCode configuration
		$display_vars = $event['display_vars'];
		$keys = array_keys($display_vars['vars']);
		$index = array_search('allow_bbcode', $keys);
		$position = ($index === false) ? count($display_vars['vars']) : $index + 1;
		$display_vars['vars'] = array_merge(
			array_slice($display_vars['vars'], 0, $position),
			[
				'allow_markdown' => [
					'lang' => 'ALLOW_MARKDOWN',
					'validate' => 'bool',
					'type' => 'radio:yes_no',
					'explain' => false
				]
			],
			array_slice($display_vars['vars'], $position)
		);

		$event['display_vars'] = $display_vars;
	}

	/**
	 * Enable markdown.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function configure_markdown($event)
	{
		$event['configurator']->Litedown;
	}
}
