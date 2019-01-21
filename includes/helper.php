<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\includes;

class helper
{
	public function acp_configuration($display_vars = [])
	{
		if (empty($display_vars) || empty($display_vars['vars']))
		{
			return [];
		}

		$display_vars['vars'] = $this->array_insert_after(
			$display_vars['vars'],
			'allow_pm_report',
			[
				'allow_markdown' => [
					'lang' => 'ALLOW_MARKDOWN',
					'validate' => 'bool',
					'type' => 'radio:yes_no',
					'explain' => false
				]
			]
		);

		return $display_vars;
	}

	/**
	 * Insert a pair of key/value after given key.
	 *
	 * @link https://gist.github.com/wpscholar/0deadce1bbfa4adb4e4c
	 *
	 * @param array		$source
	 * @param string	$key
	 * @param array		$data
	 *
	 * @return array
	 */
	private function array_insert_after($source = [], $key = '', $data = [])
	{
		if (empty($source) || empty($key) || empty($data))
		{
			return [];
		}

		$keys = array_keys($source);
		$index = array_search($key, $keys);
		$position = ($index === false) ? count($source) : $index + 1;

		return array_merge(
			array_slice($source, 0, $position),
			$data,
			array_slice($source, $position)
		);
	}
}
