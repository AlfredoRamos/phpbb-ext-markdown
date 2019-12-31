<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\tests\functional;

use phpbb_functional_test_case;

abstract class abstract_functional_test_case extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return ['alfredoramos/markdown'];
	}

	public function setUp(): void
	{
		parent::setUp();

		$this->login();
	}
}
