<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\migrations\v13x;

use phpbb\db\migration\migration;

class m00_post_configuration extends migration
{
	/**
	 * Check if configuration data exists.
	 *
	 * @return bool
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists(POSTS_TABLE, 'enable_markdown');
	}

	/**
	 * Add post configuration.
	 *
	 * @return array
	 */
	public function update_schema()
	{
		return [
			'add_columns' => [
				POSTS_TABLE => [
					'enable_markdown' => ['BOOL', 1]
				]
			]
		];
	}

	/**
	 * Revert post configuration.
	 *
	 * @return array
	 */
	public function revert_schema()
	{
		return [
			'drop_columns' => [
				POSTS_TABLE => [
					'enable_markdown'
				]
			]
		];
	}
}
