<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'MARKDOWN_GUIDE' => 'Markdown guide',

	'HELP_MARKDOWN_BLOCK_INTRO' => 'Introduction',
	'HELP_MARKDOWN_INTRO_MARKDOWN_QUESTION' => 'What is Markdown?',
	'HELP_MARKDOWN_INTRO_MARKDOWN_ANSWER' => 'Markdown is a lightweight markup language with plain text formatting syntax aimed for web writers. It allows you to easily write text, without the need or help of external tools or a user interface, that later will be formatted as HTML while maintaining readability. Markdown can be used instead of or in conjunction of text formatted with BBCode.',

	'HELP_MARKDOWN_BLOCK_TEXT' => 'Text formatting',
	'HELP_MARKDOWN_TEXT_BOLD_QUESTION' => 'Creating bold text',
	'HELP_MARKDOWN_TEXT_BOLD_ANSWER' => 'To make a piece of text bold, enclose it in a pair of <code>**</code> or <code>__</code>, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">**Hello**</code></pre> or <pre class="markdown-demo"><code class="markdown" data-lang="markdown">__Hello__</code></pre> will become<br /><br /><strong>Hello</strong>',
	'HELP_MARKDOWN_TEXT_ITALIC_QUESTION' => 'Creating italic text',
	'HELP_MARKDOWN_TEXT_ITALIC_ANSWER' => 'To italicise text, enclose it in a pair of <code>*</code> or <code>_</code>, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">*Great!*</code></pre> or <pre class="markdown-demo"><code class="markdown" data-lang="markdown">_Great!_</code></pre> will become<br /><br /><em>Great!</em>',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_QUESTION' => 'Creating strikethrough text',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_ANSWER' => 'To strikethrough text, enclose it in a pair of <code>~~</code>, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">~~Good morning~~</code></pre> will become<br /><br /><del>Good morning</del>',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_QUESTION' => 'Creating subscript text',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_ANSWER' => 'To create subscript text, enclose it in a pair of<code>~</code>, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">H~2~O</code></pre> will become<br /><br />H<sub>2</sub>O',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_QUESTION' => 'Creating superscript text',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_ANSWER' => 'To create a superscript text, add <code>^</code> before the text, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">2^n</code></pre> will become<br /><br />2<sup>n</sup>',

	'HELP_MARKDOWN_BLOCK_CODE' => 'Quoting and outputting fixed-width text',
	'HELP_MARKDOWN_QUOTE_QUESTION' => 'Quoting text in replies',
	'HELP_MARKDOWN_QUOTE_ANSWER' => 'To quote text, add <code>&gt;</code> and optionally an space before the text line, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">&gt; Quotted text</code></pre> will become <blockquote class="uncited"><div>Quotted text<p></p></div></blockquote>',
	'HELP_MARKDOWN_CODE_QUESTION' => 'Outputting code',
	'HELP_MARKDOWN_CODE_ANSWER' => 'To create code, enclose it in a pair of <code>```</code> or <code>~~~</code>, or alternatively add 4 empty spaces before each line. You can also specify the language in the first marker, e.g.<pre class="markdown-demo"><code class="ruby" data-lang="markdown">```ruby<br />chars = [*letters,*letters.map(&:upcase),*numbers,*symbols].to_a.shuffle!<br />```</code></pre> will become <pre class="markdown-demo"><code class="ruby" data-lang="ruby">chars = [*letters,*letters.map(&:upcase),*numbers,*symbols].to_a.shuffle!</code></pre>',
	'HELP_MARKDOWN_CODE_INLINE_QUESTION' => 'Outputting inline code',
	'HELP_MARKDOWN_CODE_INLINE_ANSWER' => 'To create inline code, enclose it in pair of <code>`</code> or <code>``</code>, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">`&lt;div&gt;` tag</code></pre> or <pre class="markdown-demo"><code class="markdown" data-lang="markdown">``&lt;div&gt;`` tag</code></pre> will become<br /><br /><code>&lt;div&gt;</code> tag'
]);
