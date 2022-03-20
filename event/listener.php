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
use phpbb\routing\helper as routing_helper;
use phpbb\language\language;
use alfredoramos\markdown\includes\helper;

class listener implements EventSubscriberInterface
{
	/** @var auth */
	protected $auth;

	/** @var config */
	protected $config;

	/** @var user */
	protected $user;

	/** @var request */
	protected $request;

	/** @var template */
	protected $template;

	/** @var routing_helper */
	protected $routing_helper;

	/** @var language */
	protected $language;

	/** @var helper */
	protected $helper;

	/** @var bool */
	private $markdown_enabled;

	/**
	 * Listener constructor.
	 *
	 * @param auth				$auth
	 * @param config			$config
	 * @param user				$user
	 * @param request			$request
	 * @param template			$template
	 * @param routing_helper	$routing_helper
	 * @param language			$language
	 * @param helper			$helper
	 *
	 * @return void
	 */
	public function __construct(auth $auth, config $config, user $user, request $request, template $template, routing_helper $routing_helper, language $language, helper $helper)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->user = $user;
		$this->request = $request;
		$this->template = $template;
		$this->routing_helper = $routing_helper;
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
			'core.ucp_display_module_before' => 'ucp_markdown_status',
			'core.ucp_prefs_post_data' => 'ucp_markdown_configuration',
			'core.ucp_prefs_post_update_data' => 'ucp_markdown_configuration_data',
			'core.posting_modify_default_variables' => 'default_post_data',
			'core.posting_modify_message_text' => 'check_forum_permissions',
			'core.posting_modify_submit_post_before' => 'add_post_data',
			'core.submit_post_modify_sql_data' => 'save_post_data',
			'core.posting_modify_template_vars' => 'posting_template_variables',
			'core.ucp_pm_compose_modify_parse_before' => 'check_pm_permissions',
			'core.message_parser_check_message' => 'check_signature_permissions'
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
		// Allowed modes
		$modes = [
			'features',
			'post',
			'message',
			'signature'
		];

		if (!in_array($event['mode'], $modes, true))
		{
			return;
		}

		$event['display_vars'] = $this->helper->acp_configuration(
			$event['display_vars'],
			$event['mode']
		);
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
		$event->update_subarray(
			'permissions',
			'f_markdown',
			[
				'lang' => 'ACL_F_MARKDOWN',
				'cat' => 'content'
			]
		);

		$event->update_subarray(
			'permissions',
			'u_post_markdown',
			[
				'lang' => 'ACL_U_POST_MARKDOWN',
				'cat' => 'post'
			]
		);

		$event->update_subarray(
			'permissions',
			'u_pm_markdown',
			[
				'lang' => 'ACL_U_PM_MARKDOWN',
				'cat' => 'pm'
			]
		);

		$event->update_subarray(
			'permissions',
			'u_sig_markdown',
			[
				'lang' => 'ACL_U_SIG_MARKDOWN',
				'cat' => 'profile'
			]
		);
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
		$configurator = $event['configurator'];

		// Check if plugins should be disabled
		if (!$this->markdown_enabled)
		{
			unset(
				$configurator->Litedown,
				$configurator->PipeTables,
				$configurator->TaskLists
			);
			return;
		}

		// Enable plugins
		$configurator->Litedown->addHeadersId();
		$configurator->PipeTables;
		$configurator->TaskLists;

		// List of tag that will get a CSS class
		$tags = [
			// Litedown
			'H1', 'H2', 'H3', 'H4', 'H5', 'H6',
			'LIST', 'SPOILER', 'ISPOILER',

			// PipeTables
			'TABLE'
		];

		// Add CSS class
		foreach ($tags as $tag)
		{
			$tag = trim($tag);

			// Tag must exist
			if (!isset($configurator->tags[$tag]))
			{
				continue;
			}

			// Setup DOM
			$object = $configurator->tags[$tag];
			$dom = $object->template->asDom();
			$xpath = new \DOMXPath($dom);

			// XPath expression
			switch ($tag)
			{
				case 'LIST':
					$exp = '//ul | //ol';
				break;

				case 'SPOILER':
					$exp = '//details';
				break;

				case 'ISPOILER':
					$exp = '//span[contains(@class, "spoiler")]';
				break;

				default:
					$exp = '//' . strtolower($tag);
				break;
			}

			foreach ($xpath->query($exp) as $node)
			{
				$node->setAttribute('class', trim(sprintf(
					'%s markdown',
					trim($node->getattribute('class'))
				)));
			}

			$dom->saveChanges();
		}
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
		if ($this->markdown_enabled)
		{
			return;
		}

		$parser = $event['parser']->get_parser();
		$parser->disablePlugin('Litedown');
		$parser->disablePlugin('PipeTables');
		$parser->disablePlugin('TaskLists');
	}

	/**
	 * Check Markdown status in the UCP.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function ucp_markdown_status($event)
	{
		if (($event['id'] !== 'ucp_prefs' && $event['mode'] !== 'post') &&
			($event['id'] !== 'pm' && $event['mode'] !== 'compose') &&
			($event['id'] !== 'ucp_profile' && $event['mode'] !== 'signature'))
		{
			return;
		}

		// Globally enabled
		$enabled = !empty($this->config['allow_markdown']);

		// Post, private messages or signature
		$enabled = $enabled &&
			(
				!empty($this->config['allow_post_markdown']) ||
				!empty($this->config['allow_pm_markdown']) ||
				!empty($this->config['allow_sig_markdown'])
			);

		// User permissions for post, private messages or signature
		$enabled = $enabled &&
			(
				!empty($this->auth->acl_get('u_post_markdown')) ||
				!empty($this->auth->acl_get('u_pm_markdown')) ||
				!empty($this->auth->acl_get('u_sig_markdown'))
			);

		$allowed = !empty($this->config['allow_markdown']) &&
			!empty($this->user->data['user_allow_markdown']);

		if ($event['id'] === 'pm' && $event['mode'] === 'compose')
		{
			$allowed = $allowed &&
				!empty($this->config['allow_pm_markdown']) &&
				!empty($this->auth->acl_get('u_pm_markdown'));
		}
		else if ($event['id'] === 'ucp_profile' && $event['mode'] === 'signature')
		{
			$allowed = $allowed &&
				!empty($this->config['allow_sig_markdown']) &&
				!empty($this->auth->acl_get('u_sig_markdown'));
		}

		$this->template->assign_vars([
			'S_MARKDOWN_ENABLED' => $enabled,
			'S_MARKDOWN_ALLOWED' => $allowed,
			'MARKDOWN_STATUS' => $this->language->lang(
				'MARKDOWN_STATUS_FORMAT',
				$this->routing_helper->route('alfredoramos_markdown_help'),
				$allowed ? $this->language->lang('MARKDOWN_IS_ON') : $this->language->lang('MARKDOWN_IS_OFF')
			)
		]);
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

		$event['data'] = array_merge($event['data'], [
			'markdown' => $this->request->variable(
				'markdown',
				(bool) $this->user->data['user_allow_markdown']
			)
		]);

		$this->template->assign_var('S_MARKDOWN', $event['data']['markdown']);
	}

	/**
	 * Markdown configuration data.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function ucp_markdown_configuration_data($event)
	{
		$event['sql_ary'] = array_merge($event['sql_ary'], [
			'user_allow_markdown' => !empty($event['data']['markdown'])
		]);
	}

	/**
	 * Add default post data.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function default_post_data($event)
	{
		if (isset($event['post_data']['enable_markdown']))
		{
			return;
		}

		// Markdown enabled by default for new topics,
		// it is read from database when user edits a post
		$event['post_data'] = array_merge($event['post_data'], [
			'enable_markdown' => !empty($this->config['allow_post_markdown']) &&
				!empty($this->auth->acl_get('f_markdown', $event['post_data']['forum_id'])) &&
				!empty($this->auth->acl_get('u_post_markdown'))
		]);
	}

	/**
	 * Check Markdown forum permissions.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function check_forum_permissions($event)
	{
		$event['post_data'] = array_merge($event['post_data'], [
			'enable_markdown' => empty($this->request->variable('disable_markdown', false))
		]);

		$this->markdown_enabled = $this->markdown_enabled &&
			!empty($this->config['allow_post_markdown']) &&
			!empty($this->auth->acl_get('f_markdown', $event['forum_id'])) &&
			!empty($this->auth->acl_get('u_post_markdown')) &&
			!empty($event['post_data']['enable_markdown']);
	}

	/**
	 * Add Markdown status to post data.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function add_post_data($event)
	{
		$event['data'] = array_merge($event['data'], [
			'enable_markdown' => (bool) $event['post_data']['enable_markdown']
		]);
	}

	/**
	 * Add Markdown status to SQL query of posts table.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function save_post_data($event)
	{
		$sql_data = $event['sql_data'];
		$sql_data[POSTS_TABLE]['sql'] = array_merge($sql_data[POSTS_TABLE]['sql'], [
			'enable_markdown' => (bool) $event['data']['enable_markdown']
		]);
		$event['sql_data'] = $sql_data;
	}

	/**
	 * Set template variables in posting editor.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function posting_template_variables($event)
	{
		$allowed = !empty($this->config['allow_markdown']) &&
			!empty($this->config['allow_post_markdown']) &&
			!empty($this->auth->acl_get('f_markdown', $event['forum_id'])) &&
			!empty($this->auth->acl_get('u_post_markdown')) &&
			!empty($this->user->data['user_allow_markdown']);

		$event['page_data'] = array_merge($event['page_data'], [
			'S_MARKDOWN_ALLOWED' => $allowed,
			'MARKDOWN_STATUS' => $this->language->lang(
				'MARKDOWN_STATUS_FORMAT',
				$this->routing_helper->route('alfredoramos_markdown_help'),
				$allowed ? $this->language->lang('MARKDOWN_IS_ON') : $this->language->lang('MARKDOWN_IS_OFF')
			),
			'S_MARKDOWN_CHECKED' => (empty($event['post_data']['enable_markdown']) ? ' checked="checked"' : '')
		]);
	}

	/**
	 * Check Markdown private messages permissions.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function check_pm_permissions($event)
	{
		$event['enable_markdown'] = empty($this->request->variable('disable_markdown', false));

		$this->markdown_enabled = $this->markdown_enabled &&
			!empty($this->config['allow_pm_markdown']) &&
			!empty($this->auth->acl_get('u_pm_markdown')) &&
			!empty($event['enable_markdown']);

		$this->template->assign_var(
			'S_MARKDOWN_CHECKED',
			empty($event['enable_markdown']) ? ' checked="checked"' : ''
		);
	}

	/**
	 * Check Markdown signature permissions.
	 *
	 * @param object $event
	 *
	 * @return void
	 */
	public function check_signature_permissions($event)
	{
		if (!in_array($event['mode'], ['sig', 'text_reparser.user_signature'], true))
		{
			return;
		}

		$event['allow_markdown'] = empty($this->request->variable('disable_markdown', false));

		$this->markdown_enabled = $this->markdown_enabled &&
			!empty($this->config['allow_sig_markdown']) &&
			!empty($this->auth->acl_get('u_sig_markdown')) &&
			!empty($event['allow_markdown']);

		$this->template->assign_var(
			'S_MARKDOWN_CHECKED',
			empty($event['allow_markdown']) ? ' checked="checked"' : ''
		);
	}
}
