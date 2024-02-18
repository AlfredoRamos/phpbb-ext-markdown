<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@proton.me>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\markdown\tests\functional;

/**
 * @group functional
 */
class ucp_markdown_test extends \phpbb_functional_test_case
{
	use functional_test_case_trait;

	protected function setUp(): void
	{
		parent::setUp();
		$this->login();
		$this->add_lang_ext('alfredoramos/markdown', 'ucp/markdown');
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

		$this->assertSame(1, $crawler->filter('.markdown-status')->count());
		$this->assertSame(
			'/app.php/help/markdown',
			$crawler->filter('.markdown-status > a')->attr('href')
		);
		$this->assertTrue($form->has('disable_markdown'));
	}

	public function test_ucp_signature()
	{
		$crawler = self::request('GET', sprintf(
			'ucp.php?i=ucp_profile&mode=signature&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton($this->lang('SUBMIT'))->form();

		$this->assertSame(1, $crawler->filter('.markdown-status')->count());
		$this->assertSame(
			'/app.php/help/markdown',
			$crawler->filter('.markdown-status > a')->attr('href')
		);
		$this->assertTrue($form->has('disable_markdown'));
	}

	public function test_ucp_signature_preview()
	{
		$crawler = self::request('GET', sprintf(
			'ucp.php?i=ucp_profile&mode=signature&sid=%s',
			$this->sid
		));

		$markdown = '**Markdown** ~~test~~';

		$form = $crawler->selectButton($this->lang('PREVIEW'))->form([
			'signature' => $markdown
		]);

		$crawler = self::submit($form);

		$expected = '<p><strong>Markdown</strong> <del>test</del></p>';

		$result = $crawler->filter('.postbody .signature');

		$this->assertStringContainsString($expected, $result->html());
	}
}
