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
		return ['core.text_formatter_s9e_configure_after' => 'configure_markdown'];
	}

	/**
	 * Enable markdown.
	 *
	 * @param object $event
	 */
	public function configure_markdown($event)
	{
		$event['configurator']->Litedown;
	}
}
