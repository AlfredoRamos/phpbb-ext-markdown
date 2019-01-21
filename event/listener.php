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

	protected $user;

	protected $request;

	protected $template;

	protected $language;

	/**
	 * Listener constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		global $config, $user, $request, $template, $phpbb_container;

		$this->config = $config;
		$this->user = $user;
		$this->request = $request;
		$this->template = $template;
		$this->language = $phpbb_container->get('language');
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
			'core.text_formatter_s9e_parser_setup' => 'enable_markdown',
			'core.ucp_prefs_post_data' => 'ucp_markdown_configuration',
			'core.ucp_prefs_post_update_data' => 'ucp_markdown_configuration_data'
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

	/**
	 * Markdown configuration.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function ucp_markdown_configuration($event)
	{
		$this->language->add_lang('ucp/markdown', 'alfredoramos/markdown');

		$event['data'] = array_merge([
			'markdown' => $this->request->variable(
				'markdown',
				(bool) $this->user->data['user_allow_markdown']
			)
		], $event['data']);

		$this->template->assign_var('S_MARKDOWN', $event['data']['markdown']);
	}

	public function ucp_markdown_configuration_data($event)
	{
		$event['sql_ary'] = array_merge([
			'user_allow_markdown' => !empty($event['data']['markdown'])
		], $event['sql_ary']);
	}
}
