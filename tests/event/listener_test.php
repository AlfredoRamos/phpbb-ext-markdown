<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\tests\event;

use phpbb_test_case;
use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\user;
use phpbb\request\request;
use phpbb\template\template;
use phpbb\language\language;
use alfredoramos\markdown\includes\helper;
use alfredoramos\markdown\event\listener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @group event
 */
class listener_test extends phpbb_test_case
{
	protected $auth;

	protected $config;

	protected $user;

	protected $request;

	protected $template;

	protected $language;

	protected $helper;

	public function setUp()
	{
		parent::setUp();

		$this->auth = $this->getMockBuilder(auth::class)->getMock();
		$this->config = $this->getMockBuilder(config::class)
			->disableOriginalConstructor()->getMock();
		$this->user = $this->getMockBuilder(user::class)
			->disableOriginalConstructor()->getMock();
		$this->request = $this->getMockBuilder(request::class)
		   ->disableOriginalConstructor()->getMock();
		$this->template = $this->getMockBuilder(template::class)->getMock();
		$this->language = $this->getMockBuilder(language::class)
		   ->disableOriginalConstructor()->getMock();
		$this->helper = $this->getMockBuilder(helper::class)
			->disableOriginalConstructor()->getMock();
	}

	public function test_instance()
	{
		$this->assertInstanceOf(
			EventSubscriberInterface::class,
			new listener(
				$this->auth,
				$this->config,
				$this->user,
				$this->request,
				$this->template,
				$this->language,
				$this->helper
			)
		);
	}

	public function test_suscribed_events()
	{
		$this->assertSame(
			[
				'core.user_setup',
				'core.acp_board_config_edit_add',
				'core.permissions',
				'core.text_formatter_s9e_configure_after',
				'core.text_formatter_s9e_parser_setup',
				'core.ucp_prefs_post_data',
				'core.ucp_prefs_post_update_data',
				'core.posting_modify_message_text',
				'core.ucp_pm_compose_modify_parse_before',
				'core.ucp_profile_modify_signature'
			],
			array_keys(listener::getSubscribedEvents())
		);
	}
}
