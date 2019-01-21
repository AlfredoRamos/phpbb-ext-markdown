<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\user;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\language\language;
use alfredoramos\markdown\includes\helper;

class listener implements EventSubscriberInterface
{
	protected $auth;

	protected $config;

	protected $user;

	protected $request;

	protected $template;

	protected $language;

	protected $helper;

	private $markdown_enabled;

	/**
	 * Listener constructor.
	 *
	 * @return void
	 */
	public function __construct(auth $auth, config $config, user $user, request $request, template $template, language $language, helper $helper)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->user = $user;
		$this->request = $request;
		$this->template = $template;
		$this->language = $language;
		$this->helper = $helper;
		$this->markdown_enabled = !empty($this->config['allow_markdown']) &&
			!empty($this->user->data['user_allow_markdown']);
	}

	/**
	 * Assign functions defined in this class to event listeners in the core.
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return [
			'core.user_setup' => 'load_language',
			'core.acp_board_config_edit_add' => 'acp_markdown_configuration',
			'core.permissions' => 'acp_markdown_permissions',
			'core.text_formatter_s9e_configure_after' => 'configure_markdown',
			'core.text_formatter_s9e_parser_setup' => 'enable_markdown',
			'core.ucp_prefs_post_data' => 'ucp_markdown_configuration',
			'core.ucp_prefs_post_update_data' => 'ucp_markdown_configuration_data',
			'core.posting_modify_message_text' => 'check_forum_permissions',
			'core.posting_modify_template_vars' => 'check_forum_permissions_template'
		];
	}

	/**
	 * Load language files.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function load_language($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'alfredoramos/markdown',
			'lang_set'	=> 'posting'
		];
		$event['lang_set_ext'] = $lang_set_ext;
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

		$event['display_vars'] = $this->helper->acp_configuration($event['display_vars']);
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
		if (!$this->markdown_enabled)
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
		if (!$this->markdown_enabled)
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

	/**
	 * Markdown configuration data.
	 *
	 * @param object $event
	 *
	 * @return void;
	 */
	public function ucp_markdown_configuration_data($event)
	{
		$event['sql_ary'] = array_merge([
			'user_allow_markdown' => !empty($event['data']['markdown'])
		], $event['sql_ary']);
	}

	public function check_forum_permissions($event)
	{
		$event['post_data'] = array_merge([
			'enable_markdown' => empty($this->request->is_set_post('disable_markdown'))
		], $event['post_data']);

		$this->markdown_enabled = $this->markdown_enabled &&
			!empty($this->auth->acl_get('f_markdown', $event['forum_id'])) &&
			$event['post_data']['enable_markdown'];
	}

	public function check_forum_permissions_template($event)
	{
		$this->template->assign_var(
			'S_MARKDOWN_CHECKED',
			empty($event['post_data']['enable_markdown']) ? ' checked="checked"' : ''
		);
	}
}
