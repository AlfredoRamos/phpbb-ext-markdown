<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\tests\event;

use phpbb_test_case;
use alfredoramos\markdown\event\listener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @group event
 */
class listener_test extends phpbb_test_case
{
	public function test_instance()
	{
		$this->assertInstanceOf(
			EventSubscriberInterface::class,
			new listener
		);
	}

	public function test_suscribed_events()
	{
		$this->assertSame(
			[
				'core.acp_board_config_edit_add',
				'core.permissions',
				'core.text_formatter_s9e_configure_after',
				'core.text_formatter_s9e_parser_setup',
				'core.ucp_prefs_post_data',
				'core.ucp_prefs_post_update_data'
			],
			array_keys(listener::getSubscribedEvents())
		);
	}
}
