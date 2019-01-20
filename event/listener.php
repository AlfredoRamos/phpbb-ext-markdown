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
	protected $config;

	/**
	 * Listener constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		global $config;

		$this->config = $config;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return [
			'core.acp_board_config_edit_add' => 'acp_markdown_configuration',
			'core.permissions' => 'acp_markdown_permissions',
			'core.text_formatter_s9e_configure_after' => 'configure_markdown',
			'core.text_formatter_s9e_parser_setup' => 'enable_markdown'
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
	 * Add Markdown permissions.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function acp_markdown_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['f_markdown'] = [
			'lang' => 'ACL_F_MARKDOWN',
			'cat' => 'content'
		];
		$permissions['u_pm_markdown'] = [
			'lang' => 'ACL_U_PM_MARKDOWN',
			'cat' => 'pm'
		];
		$event['permissions'] = $permissions;
	}

	/**
	 * Configure markdown.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function configure_markdown($event)
	{
		if (empty($this->config['allow_markdown']))
		{
			unset($event['configurator']->Litedown);
			return;
		}

		$event['configurator']->Litedown;
	}

	/**
	 * Enable markdown.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function enable_markdown($event)
	{
		if (empty($this->config['allow_markdown']))
		{
			$event['parser']->get_parser()->disablePlugin('Litedown');
		}
	}
}
