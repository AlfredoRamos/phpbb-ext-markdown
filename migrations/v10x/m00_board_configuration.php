<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\migrations\v10x;

use phpbb\db\migration\migration;

class m00_board_configuration extends migration
{
	/**
	 * Add Markdown configuration.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			[
				'config.add',
				['allow_markdown', 1]
			]
		];
	}
}
