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
class help_markdown_test extends \phpbb_functional_test_case
{
	use functional_test_case_trait;

	protected function setUp(): void
	{
		parent::setUp();
		$this->add_lang_ext('alfredoramos/markdown', [
			'help/markdown'
		]);
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

		$this->assertSame(9, $elements['blocks']->count());

		$items = $elements['blocks']->each(function ($node) {
			return [
				'title' => $node->filter('dt > strong'),
				'links' => $node->filter('dd > a')
			];
		});

		foreach ($items as $key => $value) {
			switch ($key) {
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

				case 2: // Quoting and outputting fixed-width text
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_CODE'),
						$value['title']->text()
					);
					$this->assertSame(3, $value['links']->count());
					break;

				case 3: // Generating tables
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_TABLE'),
						$value['title']->text()
					);
					$this->assertSame(1, $value['links']->count());
					break;

				case 4: // Generating spoilers
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_SPOILER'),
						$value['title']->text()
					);
					$this->assertSame(2, $value['links']->count());
					break;

				case 5: // Generating lists
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_LIST'),
						$value['title']->text()
					);
					$this->assertSame(3, $value['links']->count());
					break;

				case 6: // Creating links
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_LINK'),
						$value['title']->text()
					);
					$this->assertSame(1, $value['links']->count());
					break;

				case 7: // Showing images
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_IMAGE'),
						$value['title']->text()
					);
					$this->assertSame(1, $value['links']->count());
					break;

				case 8: // Extras
					$this->assertSame(
						$this->lang('HELP_MARKDOWN_BLOCK_EXTRA'),
						$value['title']->text()
					);
					$this->assertSame(1, $value['links']->count());
					break;
			}
		}
	}
}
