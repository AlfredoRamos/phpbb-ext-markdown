<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\migrations\v10x;

use phpbb\db\migration\migration;

class m02_user_configuration extends migration
{
	/**
	 * Check configuration data exist.
	 *
	 * @return bool
	 */
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists(USERS_TABLE, 'user_allow_markdown');
	}

	/**
	 * Add user configuration.
	 *
	 * @return array
	 */
	public function update_schema()
	{
		return [
			'add_columns' => [
				USERS_TABLE => [
					'user_allow_markdown' => ['BOOL', 1]
				]
			]
		];
	}

	/**
	 * Revert user configuration.
	 *
	 * @return array
	 */
	public function revert_schema()
	{
		return [
			'drop_columns' => [
				USERS_TABLE => [
					'user_allow_markdown'
				]
			]
		];
	}
}
