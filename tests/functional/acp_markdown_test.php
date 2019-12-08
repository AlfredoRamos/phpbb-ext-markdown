<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\tests\functional;

/**
 * @group functional
 */
class acp_markdown_test extends abstract_functional_test_case
{
	public function setUp(): void
	{
		parent::setUp();

		$this->add_lang_ext('alfredoramos/markdown', 'acp/info_acp_markdown');

		$this->admin_login();
	}

	public function test_acp_board_features()
	{
		$crawler = self::request('GET', sprintf(
			'adm/index.php?i=acp_board&mode=features&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertContains(
			$this->lang('ALLOW_MARKDOWN'),
			$crawler->filter('label[for="allow_markdown"]')->text()
		);
		$this->assertSame(1, $crawler->filter('#allow_markdown')->count());
		$this->assertTrue($form->has('config[allow_markdown]'));
		$this->assertSame('1', $form->get('config[allow_markdown]')->getValue());
	}

	public function test_acp_post_settings()
	{
		$crawler = self::request('GET', sprintf(
			'adm/index.php?i=acp_board&mode=post&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertContains(
			$this->lang('ALLOW_POST_MARKDOWN'),
			$crawler->filter('label[for="allow_post_markdown"]')->text()
		);
		$this->assertSame(1, $crawler->filter('#allow_post_markdown')->count());
		$this->assertTrue($form->has('config[allow_post_markdown]'));
		$this->assertSame('1', $form->get('config[allow_post_markdown]')->getValue());
	}

	public function test_acp_private_message_settings()
	{
		$crawler = self::request('GET', sprintf(
			'adm/index.php?i=acp_board&mode=message&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertContains(
			$this->lang('ALLOW_PM_MARKDOWN'),
			$crawler->filter('label[for="allow_pm_markdown"]')->text()
		);
		$this->assertSame(1, $crawler->filter('#allow_pm_markdown')->count());
		$this->assertTrue($form->has('config[allow_pm_markdown]'));
		$this->assertSame('1', $form->get('config[allow_pm_markdown]')->getValue());
	}

	public function test_acp_signature_settings()
	{
		$crawler = self::request('GET', sprintf(
			'adm/index.php?i=acp_board&mode=signature&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertContains(
			$this->lang('ALLOW_SIG_MARKDOWN'),
			$crawler->filter('label[for="allow_sig_markdown"]')->text()
		);
		$this->assertSame(1, $crawler->filter('#allow_sig_markdown')->count());
		$this->assertTrue($form->has('config[allow_sig_markdown]'));
		$this->assertSame('1', $form->get('config[allow_sig_markdown]')->getValue());
	}
}
