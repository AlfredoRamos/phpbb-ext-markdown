<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\migrations\v10x;

use phpbb\db\migration\migration;

class m01_permissions extends migration
{
	/**
	 * Add Markdown permissions.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			['permission.add', ['f_markdown', false]],
			['permission.permission_set', ['ROLE_FORUM_STANDARD', 'f_markdown']],
			['permission.permission_set', ['ROLE_FORUM_ONQUEUE', 'f_markdown']],
			['permission.permission_set', ['ROLE_FORUM_POLLS', 'f_markdown']],
			['permission.permission_set', ['ROLE_FORUM_FULL', 'f_markdown']],

			['permission.add', ['u_pm_markdown']],
			['permission.permission_set', ['REGISTERED', 'u_pm_markdown', 'group']],
			['permission.permission_set', ['ROLE_USER_STANDARD', 'u_pm_markdown']],
			['permission.permission_set', ['ROLE_USER_FULL', 'u_pm_markdown']]
		];
	}
}
