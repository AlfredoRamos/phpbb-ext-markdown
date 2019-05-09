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

		$this->add_lang_ext('alfredoramos/markdown', [
			'acp/info_acp_markdown',
			'help/markdown'
		]);

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
		$this->admin_login();

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
		$this->admin_login();

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
		$this->admin_login();

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

		// It needs phpBB v3.2.6-RC1 or greater
		// https://tracker.phpbb.com/browse/PHPBB3-15949
		// https://github.com/phpbb/phpbb/pull/5519
		$this->assertTrue($form->has('disable_markdown'));
	}

	public function test_post_reply()
	{
		$crawler = self::request('GET', sprintf(
			'posting.php?mode=reply&f=2&t=1&sid=%s',
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

	public function test_post_markdown()
	{
		$markdown = <<<EOT
Code:

```php
echo 'message';
```

Inline `code`
EOT;
		$post = $this->create_topic(
			2,
			'Markdown functional test 1',
			$markdown
		);

		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=%d&sid=%s',
			$post['topic_id'],
			$this->sid
		));

		$expected = <<<EOT
<p>Code:</p>

<div class="codebox">
<p>Code: <a href="#" onclick="selectCode(this); return false;">Select all</a></p>
<pre><code>echo 'message';</code></pre>
</div>

<p>Inline <code>code</code></p>
EOT;

		$result = $crawler->filter(sprintf(
			'#post_content%d .content',
			$post['topic_id']
		));

		$this->assertContains($expected, $result->html());
	}

	public function test_private_message()
	{
		$markdown = <<<EOT
Code:

```php
echo 'message';
```

Inline `code`
EOT;
		$private_message = $this->create_private_message(
			'Markdown private message test 1',
			$markdown,
			[2]
		);

		$crawler = self::request('GET', sprintf(
			'ucp.php?i=pm&mode=view&p=%d&sid=%s',
			$private_message,
			$this->sid
		));

		$expected = <<<EOT
<p>Code:</p>

<div class="codebox">
<p>Code: <a href="#" onclick="selectCode(this); return false;">Select all</a></p>
<pre><code>echo 'message';</code></pre>
</div>

<p>Inline <code>code</code></p>
EOT;

		$result = $crawler->filter(sprintf(
			'#post-%d .content',
			$private_message
		));

		$this->assertContains($expected, $result->html());
	}

	public function test_user_signature()
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

		$this->assertContains($expected, $result->html());
	}

	public function test_markdown_help_page()
	{
		$crawler = self::request('GET', 'app.php/help/markdown');

		$elements = [
			'title' => $crawler->filter('#page-body > .faq-title'),
			'blocks' => $crawler->filter('#faqlinks .faq')
		];

		$this->assertSame(1, $elements['title']->count());
		$this->assertSame(
			$this->lang('MARKDOWN_GUIDE'),
			$elements['title']->text()
		);

		$this->assertSame(7, $elements['blocks']->count());

		$items = $elements['blocks']->each(function($node) {
			return [
				'title' => $node->filter('dt > strong'),
				'links' => $node->filter('dd > a')
			];
		});

		foreach ($items as $key => $value)
		{
			switch ($key)
			{
				case 0: // Introduction
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_INTRO'),
						$value['title']->text()
					);
					$this->assertSame(1, $value['links']->count());
				break;

				case 1: // Text formatting
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_TEXT'),
						$value['title']->text()
					);
					$this->assertSame(6, $value['links']->count());
				break;

				case 2: // Quoting and outputting
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_CODE'),
						$value['title']->text()
					);
					$this->assertSame(3, $value['links']->count());
				break;

				case 3: // Generating lists
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_LIST'),
						$value['title']->text()
					);
					$this->assertSame(2, $value['links']->count());
				break;

				case 4: // Creating links
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_LINK'),
						$value['title']->text()
					);
					$this->assertSame(1, $value['links']->count());
				break;

				case 5: // Showing images
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_IMAGE'),
						$value['title']->text()
					);
					$this->assertSame(1, $value['links']->count());
				break;

				case 6: // Extras
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_EXTRA'),
						$value['title']->text()
					);
					$this->assertSame(2, $value['links']->count());
				break;
			}
		}
	}
}
