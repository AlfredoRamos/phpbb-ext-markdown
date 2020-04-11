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
class markdown_test extends abstract_functional_test_case
{
	public function setUp(): void
	{
		parent::setUp();

		$this->add_lang_ext('alfredoramos/markdown', [
			'posting'
		]);
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

		if (version_compare(PHP_VERSION, '7.3.0', '>='))
		{
			$expected = <<<EOT
<p>Code:</p>

<div class="codebox"><p>Code: <a href="#" onclick="selectCode(this); return false;">Select all</a></p><pre><code>echo 'message';</code></pre></div>

<p>Inline <code>code</code></p>
EOT;
		}
		else
		{
			$expected = <<<EOT
<p>Code:</p>

<div class="codebox">
<p>Code: <a href="#" onclick="selectCode(this); return false;">Select all</a></p>
<pre><code>echo 'message';</code></pre>
</div>

<p>Inline <code>code</code></p>
EOT;
		}

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

		if (version_compare(PHP_VERSION, '7.3.0', '>='))
		{
			$expected = <<<EOT
<p>Code:</p>

<div class="codebox"><p>Code: <a href="#" onclick="selectCode(this); return false;">Select all</a></p><pre><code>echo 'message';</code></pre></div>

<p>Inline <code>code</code></p>
EOT;
		}
		else
		{
			$expected = <<<EOT
<p>Code:</p>

<div class="codebox">
<p>Code: <a href="#" onclick="selectCode(this); return false;">Select all</a></p>
<pre><code>echo 'message';</code></pre>
</div>

<p>Inline <code>code</code></p>
EOT;
		}

		$result = $crawler->filter(sprintf(
			'#post-%d .content',
			$private_message
		));

		$this->assertContains($expected, $result->html());
	}

	public function test_simple_table()
	{
		$markdown = <<<EOT
| Header 1 | Header 2 |
|----------|----------|
| Cell 1   | Cell 2   |
EOT;

		$post = $this->create_topic(
			2,
			'Markdown tables test 1',
			$markdown
		);

		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=%d&sid=%s',
			$post['topic_id'],
			$this->sid
		));

		if (version_compare(PHP_VERSION, '7.3.0', '>='))
		{
			$expected = '<table class="markdown"><thead><tr><th>Header 1</th><th>Header 2</th></tr></thead><tbody><tr><td>Cell 1</td><td>Cell 2</td></tr></tbody></table>';
		}
		else
		{
			$expected = <<<EOT
<table class="markdown">
<thead><tr>
<th>Header 1</th>
<th>Header 2</th>
</tr></thead>
<tbody><tr>
<td>Cell 1</td>
<td>Cell 2</td>
</tr></tbody>
</table>
EOT;
		}

		$result = $crawler->filter(sprintf(
			'#post_content%d .content',
			$post['topic_id']
		));

		$this->assertSame(1, $crawler->filter('table')->count());
		$this->assertContains($expected, $result->html());
	}

	public function test_compact_table()
	{
		$markdown = <<<EOT
Header 1|Header 2
-|-
Cell 1|Cell 2
EOT;

		$post = $this->create_topic(
			2,
			'Markdown tables test 2',
			$markdown
		);

		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=%d&sid=%s',
			$post['topic_id'],
			$this->sid
		));

		if (version_compare(PHP_VERSION, '7.3.0', '>='))
		{
			$expected = '<table class="markdown"><thead><tr><th>Header 1</th><th>Header 2</th></tr></thead><tbody><tr><td>Cell 1</td><td>Cell 2</td></tr></tbody></table>';
		}
		else
		{
			$expected = <<<EOT
<table class="markdown">
<thead><tr>
<th>Header 1</th>
<th>Header 2</th>
</tr></thead>
<tbody><tr>
<td>Cell 1</td>
<td>Cell 2</td>
</tr></tbody>
</table>
EOT;
		}

		$result = $crawler->filter(sprintf(
			'#post_content%d .content',
			$post['topic_id']
		));

		$this->assertSame(1, $crawler->filter('table')->count());
		$this->assertContains($expected, $result->html());
	}

	public function test_table_text_aligntment()
	{
		$markdown = <<<EOT
| Left | Center | Right |
|:-----|:------:|------:|
|   x  |    x   |   x   |
EOT;

		$post = $this->create_topic(
			2,
			'Markdown tables test 3',
			$markdown
		);

		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=%d&sid=%s',
			$post['topic_id'],
			$this->sid
		));

		if (version_compare(PHP_VERSION, '7.3.0', '>='))
		{
			$expected = '<table class="markdown"><thead><tr><th style="text-align:left">Left</th><th style="text-align:center">Center</th><th style="text-align:right">Right</th></tr></thead><tbody><tr><td style="text-align:left">x</td><td style="text-align:center">x</td><td style="text-align:right">x</td></tr></tbody></table>';
		}
		else
		{
			$expected = <<<EOT
<table class="markdown">
<thead><tr>
<th style="text-align:left">Left</th>
<th style="text-align:center">Center</th>
<th style="text-align:right">Right</th>
</tr></thead>
<tbody><tr>
<td style="text-align:left">x</td>
<td style="text-align:center">x</td>
<td style="text-align:right">x</td>
</tr></tbody>
</table>
EOT;
		}

		$result = $crawler->filter(sprintf(
			'#post_content%d .content',
			$post['topic_id']
		));

		$this->assertSame(1, $crawler->filter('table')->count());
		$this->assertContains($expected, $result->html());
	}

	public function test_block_spoiler()
	{
		$markdown = <<<EOT
>! Spoiler text
> Another line
EOT;

		$post = $this->create_topic(
			2,
			'Markdown spoilers test 1',
			$markdown
		);

		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=%d&sid=%s',
			$post['topic_id'],
			$this->sid
		));

		$expected = <<<EOT
<details class="spoiler"><p>Spoiler text<br>
Another line</p></details>
EOT;

		$result = $crawler->filter(sprintf(
			'#post_content%d .content',
			$post['topic_id']
		));

		$this->assertSame(1, $crawler->filter('.spoiler')->count());
		$this->assertContains($expected, $result->html());
	}

	public function test_inline_spoiler()
	{
		$markdown = <<<EOT
This is a Reddit-style >!spoiler!<.
This is a Discord-style ||spoiler||.
EOT;

		$post = $this->create_topic(
			2,
			'Markdown spoilers test 1',
			$markdown
		);

		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=%d&sid=%s',
			$post['topic_id'],
			$this->sid
		));

		$expected = <<<EOT
<p>This is a Reddit-style <span class="spoiler" onclick="removeAttribute('style')" style="background:#444;color:transparent">spoiler</span>.<br>
This is a Discord-style <span class="spoiler" onclick="removeAttribute('style')" style="background:#444;color:transparent">spoiler</span>.</p>
EOT;

		$result = $crawler->filter(sprintf(
			'#post_content%d .content',
			$post['topic_id']
		));

		$this->assertSame(2, $crawler->filter('.spoiler')->count());
		$this->assertContains($expected, $result->html());
	}
}
