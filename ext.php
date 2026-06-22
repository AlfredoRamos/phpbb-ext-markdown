<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown;

use phpbb\extension\base;

class ext extends base
{
	/**
	* {@inheritdoc}
	*/
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '4.0.0-a1-dev', '>='); // TODO: Use stable version
	}
}
