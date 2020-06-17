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
	'HELP_MARKDOWN_TEXT_BOLD_ANSWER' => 'To make a piece of text bold, enclose it in a pair of <code>**</code> or <code>__</code>, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">**Hello**</code></pre> or <pre class="markdown-code"><code class="markdown" data-lang="markdown">__Hello__</code></pre> will become<br><br><strong>Hello</strong>',
	'HELP_MARKDOWN_TEXT_ITALIC_QUESTION' => 'Creating italic text',
	'HELP_MARKDOWN_TEXT_ITALIC_ANSWER' => 'To italicise text, enclose it in a pair of <code>*</code> or <code>_</code>, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">*Great!*</code></pre> or <pre class="markdown-code"><code class="markdown" data-lang="markdown">_Great!_</code></pre> will become<br><br><em>Great!</em>',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_QUESTION' => 'Creating strikethrough text',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_ANSWER' => 'To strikethrough text, enclose it in a pair of <code>~~</code>, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">~~Good morning~~</code></pre> will become<br><br><del>Good morning</del>',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_QUESTION' => 'Creating subscript text',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_ANSWER' => 'To create subscript text, enclose it in a pair of <code>~</code>, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">H~2~O</code></pre> will become<br><br>H<sub>2</sub>O',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_QUESTION' => 'Creating superscript text',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_ANSWER' => 'To create a superscript text, add <code>^</code> before the text, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">2^n</code></pre> will become<br><br>2<sup>n</sup>',
	'HELP_MARKDOWN_TEXT_HEADER_QUESTION' => 'Creating headers',
	'HELP_MARKDOWN_TEXT_HEADER_ANSWER' => 'To create headers, add from 1 up to 6 <code>#</code> followed by a space before the text. The higher the number, the smaller the text would be, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown"># H1<br>## H2<br>### H3<br>#### H4<br>##### H5<br>###### H6</code></pre> will become<br><br><h1 class="markdown">H1</h1><h2 class="markdown">H2</h2><h3 class="markdown">H3</h3><h4 class="markdown">H4</h4><h5 class="markdown">H5</h5><h6 class="markdown">H6</h6>',

	'HELP_MARKDOWN_BLOCK_CODE' => 'Quoting and outputting fixed-width text',
	'HELP_MARKDOWN_QUOTE_QUESTION' => 'Quoting text in replies',
	'HELP_MARKDOWN_QUOTE_ANSWER' => 'To quote text, add <code>&gt;</code> and optionally an space before the text line, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">&gt; Quoted text</code></pre> will become <blockquote class="uncited"><div><p>Quoted text</p></div></blockquote>',
	'HELP_MARKDOWN_CODE_QUESTION' => 'Outputting code',
	'HELP_MARKDOWN_CODE_ANSWER' => 'To output code, enclose it in a pair of <code>```</code> or <code>~~~</code>, or alternatively add 4 empty spaces before each line. You can also specify the language in the first marker, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">```ruby<br>puts "Hello #{user}!"<br>```</code></pre> will become <pre class="markdown-code"><code class="ruby" data-lang="ruby">puts "Hello #{user}!"</code></pre>',
	'HELP_MARKDOWN_CODE_INLINE_QUESTION' => 'Outputting inline code',
	'HELP_MARKDOWN_CODE_INLINE_ANSWER' => 'To output inline code, enclose it in pair of <code>`</code> or <code>``</code>, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">`&lt;div&gt;` tag</code></pre> or <pre class="markdown-code"><code class="markdown" data-lang="markdown">``&lt;div&gt;`` tag</code></pre> will become<br><br><code>&lt;div&gt;</code> tag',

	'HELP_MARKDOWN_BLOCK_TABLE' => 'Generating tables',
	'HELP_MARKDOWN_TABLE_QUESTION' => 'Creating tables',
	'HELP_MARKDOWN_TABLE_ANSWER' => 'To create tables, add a line of text divided with <code>|</code> which will be the table headers, after that a new line with <code>-</code> and optionally <code>:</code> to the left, on both sides or to the right to align the text of that column, again divided with <code>|</code>. All successive lines divided with <code>|</code> will be rendered as table rows, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">| Left | Center | Right |<br>|:-----|:------:|------:|<br>|   x  |    x   |   x   |</code></pre> or <pre class="markdown-code"><code class="markdown" data-lang="markdown">Left|Center|Right<br>:-|:-:|-:<br>x|x|x</code></pre> will become<br><br><table class="markdown"><thead><tr><th style="text-align:left">Left</th><th style="text-align:center">Center</th><th style="text-align:right">Right</th></tr></thead><tbody><tr><td style="text-align:left">x</td><td style="text-align:center">x</td><td style="text-align:right">x</td></tr></tbody></table>',

	'HELP_MARKDOWN_BLOCK_SPOILER' => 'Generating spoilers',
	'HELP_MARKDOWN_BLOCK_SPOILER_QUESTION' => 'Creating block spoilers',
	'HELP_MARKDOWN_BLOCK_SPOILER_ANSWER' => 'To create a block spoiler, add <code>&gt;!</code> and optionally an space before the text line. Subsequent lines can be started with <code>&gt;</code>, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">&gt;! Spoiler text<br>&gt; Another line</code></pre> will become<br><br><details class="spoiler markdown"><p>Spoiler text<br>Another line</p></details>',
	'HELP_MARKDOWN_INLINE_SPOILER_QUESTION' => 'Creating inline spoilers',
	'HELP_MARKDOWN_INLINE_SPOILER_ANSWER' => 'To create an inline spoiler, enclose the text inside <code>&gt;!</code> and <code>!&lt;</code> or inside a pair of <code>||</code>, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">This is a Reddit-style &gt;!spoiler!&lt;.<br>This is a Discord-style ||spoiler||.</code></pre> will become<br><br><p>This is a Reddit-style <span class="spoiler markdown" onclick="removeAttribute(\'style\')" style="background:#444;color:transparent">spoiler</span>.<br>This is a Discord-style <span class="spoiler markdown" onclick="removeAttribute(\'style\')" style="background:#444;color:transparent">spoiler</span>.</p>',

	'HELP_MARKDOWN_BLOCK_LIST' => 'Generating lists',
	'HELP_MARKDOWN_UNORDERED_LIST_QUESTION' => 'Creating unordered list',
	'HELP_MARKDOWN_UNORDERED_LIST_ANSWER' => 'To create an unordered list, add <code>*</code>, <code>-</code> or <code>+</code> followed by an space before each list item. Lists can be nested by adding 4 additional spaces or a tab to create a sublevel, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">- Element<br>    - Subelement<br>- Element</code></pre> will become<br><br><ul class="markdown"><li>Element<ul class="markdown"><li>Subelement</li></ul></li><li>Element</li></ul>',
	'HELP_MARKDOWN_ORDERED_LIST_QUESTION' => 'Creating ordered list',
	'HELP_MARKDOWN_ORDERED_LIST_ANSWER' => 'To create an ordered list, add a digit followed by a dot and a space, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">1. Element<br>    1. Subelement<br>2. Element</code></pre> will become<br><br><ol class="markdown"><li>Element <ol class="markdown"><li>Subelement</li></ol></li><li>Element</li></ol>',
	'HELP_MARKDOWN_TASK_LIST_QUESTION' => 'Creating task list',
	'HELP_MARKDOWN_TASK_LIST_ANSWER' => 'To create a task list, add <code>*</code>, <code>-</code> or <code>+</code> followed by an space, either <code>[x]</code> or <code>[ ]</code>, and another space before each list item. The <code>[x]</code> and <code>[ ]</code> characters would display a checked box and an uncheked box, respectively, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">- [x] Element<br>    - [x] Subelement<br>- [ ] Element</code></pre> will become<br><br><ul class="markdown"><li data-task-id="x" data-task-state="checked"><input data-task-id="x" type="checkbox" checked="" disabled=""> Element<ul class="markdown"><li data-task-id="y" data-task-state="checked"><input data-task-id="y" type="checkbox" checked="" disabled=""> Subelement</li></ul></li><li data-task-id="z" data-task-state="unchecked"><input data-task-id="z" type="checkbox" disabled=""> Element</li></ul>',

	'HELP_MARKDOWN_BLOCK_LINK' => 'Creating links',
	'HELP_MARKDOWN_LINK_QUESTION' => 'Linking to another site',
	'HELP_MARKDOWN_LINK_ANSWER' => 'To create links, add the link text inside square brackets followed by the link URL inside parentheses, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">[Link text](http://example.org)</code></pre> will become<br><br><a href="http://example.org">Link text</a>',

	'HELP_MARKDOWN_BLOCK_IMAGE' => 'Showing images',
	'HELP_MARKDOWN_IMAGE_QUESTION' => 'Adding images',
	'HELP_MARKDOWN_IMAGE_ANSWER' => 'To show an image, add an exclamation mark followed by the image alternate text inside square brackets and then the image URL inside parenthesis, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">![phpBB](https://www.phpbb.com/assets/images/images/logos/blue/160x52.png)</code></pre> will become<br><br><img src="https://www.phpbb.com/assets/images/images/logos/blue/160x52.png" alt="phpBB">',

	'HELP_MARKDOWN_BLOCK_EXTRA' => 'Extras',
	'HELP_MARKDOWN_HORIZONTAL_RULE_QUESTION' => 'Creating horizontal rules',
	'HELP_MARKDOWN_HORIZONTAL_RULE_ANSWER' => 'To create a horizontal rule, add at least 3 <code>*</code>, <code>-</code> or <code>_</code> optionally separated with a space, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">***<br>* * *<br>---<br>- - -<br>___<br>_ _ _</code></pre> will become<br><br><hr>'
]);
