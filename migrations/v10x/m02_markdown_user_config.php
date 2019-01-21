<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\migrations\v10x;

use phpbb\db\migration\migration;

class m02_markdown_user_config extends migration
{
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists(USERS_TABLE, 'user_allow_markdown');
	}

	public function update_schema()
	{
		return [
			'add_columns' => [
				USERS_TABLE => [
					'user_allow_markdown' => ['BOOL', true]
				]
			]
		];
	}

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
