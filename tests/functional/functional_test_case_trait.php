<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\tests\functional;

trait functional_test_case_trait
{
	static protected function setup_extensions()
	{
		return ['alfredoramos/markdown'];
	}
}
