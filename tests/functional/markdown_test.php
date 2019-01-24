<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\tests\functional;

use phpbb_functional_test_case;

/**
 * @group functional
 */
class markdown_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return ['alfredoramos/markdown'];
	}

	public function setUp()
	{
		parent::setUp();

		$this->login();
	}

	public function test_acp_board_features()
	{
		$this->admin_login();

		$crawler = self::request('GET', sprintf(
			'adm/index.php?i=acp_board&mode=features&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertSame(1, $crawler->filter('#allow_markdown')->count());
		$this->assertTrue($form->has('config[allow_markdown]'));
		$this->assertSame('1', $form->get('config[allow_markdown]')->getValue());
	}

	public function test_ucp_posting_defaults()
	{
		$crawler = self::request('GET', sprintf(
			'ucp.php?i=ucp_prefs&mode=post&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertTrue($form->has('markdown'));
		$this->assertSame('1', $form->get('markdown')->getValue());
	}

	public function test_ucp_private_message()
	{
		$crawler = self::request('GET', sprintf(
			'ucp.php?i=pm&mode=compose&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertSame(1, $crawler->filter('#markdown_status')->count());
		$this->assertTrue($form->has('disable_markdown'));

	}

	public function test_ucp_signature()
	{
		$crawler = self::request('GET', sprintf(
			'ucp.php?i=ucp_profile&mode=signature&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertSame(1, $crawler->filter('#markdown_status')->count());

		// Has not been implemented
		// https://tracker.phpbb.com/browse/PHPBB3-15949
		// https://github.com/phpbb/phpbb/pull/5519
		//$this->assertTrue($form->has('disable_markdown'));
	}
}
