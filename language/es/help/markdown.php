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
	'MARKDOWN_GUIDE' => 'Guía Markdown',

	'HELP_MARKDOWN_BLOCK_INTRO' => 'Introducción',
	'HELP_MARKDOWN_INTRO_MARKDOWN_QUESTION' => '¿Qué es Markdown?',
	'HELP_MARKDOWN_INTRO_MARKDOWN_ANSWER' => 'Markdown es un lenguaje de marcado ligero con sintáxis de formato en texto plano dirigido a escritores web. Le permite escribir fácilmente texto, sin necesidad o ayuda de herramientas externas o interfáz de usuario, que será convertido a HTML sin perder legibilidad. Markdown puede usar en lugar de o junto a texto formateado con BBCode.',

	'HELP_MARKDOWN_BLOCK_TEXT' => 'Formato de texto',
	'HELP_MARKDOWN_TEXT_BOLD_QUESTION' => 'Creando texto en negritas',
	'HELP_MARKDOWN_TEXT_BOLD_ANSWER' => 'Para crear texto en negritas, enciérrelo entre un par de <code>**</code> o <code>__</code>, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">**Hola**</code></pre> o <pre class="markdown-demo"><code class="markdown" data-lang="markdown">__Hola__</code></pre> se convertirá<br /><br /><strong>Hola</strong>',
	'HELP_MARKDOWN_TEXT_ITALIC_QUESTION' => 'Creando texto en cursiva',
	'HELP_MARKDOWN_TEXT_ITALIC_ANSWER' => 'Para crear texto en cursiva, enciérrelo entre un par de <code>*</code> o <code>_</code>, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">*Genial!*</code></pre> o <pre class="markdown-demo"><code class="markdown" data-lang="markdown">_Genial!_</code></pre> se convertirá<br /><br /><em>Genial!</em>',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_QUESTION' => 'Creando texto tachado',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_ANSWER' => 'Para tachar texto, enciérrelo entre un par de <code>~~</code>, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">~~Buenos días~~</code></pre> se convertirá<br /><br /><del>Buenos días</del>',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_QUESTION' => 'Creando subíndices',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_ANSWER' => 'Para crear subíndices, enciérrelo entre un par de <code>~</code>, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">H~2~O</code></pre> se convertirá<br /><br />H<sub>2</sub>O',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_QUESTION' => 'Creando superíndices',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_ANSWER' => 'Para crear superíndices, agregue <code>^</code> antes del texto, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">2^n</code></pre> se convertirá<br /><br />2<sup>n</sup>',
	'HELP_MARKDOWN_TEXT_HEADER_QUESTION' => 'Creando encabezados',
	'HELP_MARKDOWN_TEXT_HEADER_ANSWER' => 'Para crear encabezados, agregue de 1 a 6 <code>#</code> seguidos por un espacio antes del texto. Cuanto mayor sea el número, más pequeño será el texto, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown"># H1<br />## H2<br />### H3<br />#### H4<br />##### H5<br />###### H6</code></pre> se convertirá<br /><br /><h1>H1</h1><h2>H2</h2><h3>H3</h3><h4>H4</h4><h5>H5</h5><h6>H6</h6>',

	'HELP_MARKDOWN_BLOCK_CODE' => 'Citando texto y mostrando texto de ancho fijo',
	'HELP_MARKDOWN_QUOTE_QUESTION' => 'Citando texto en respuestas',
	'HELP_MARKDOWN_QUOTE_ANSWER' => 'Para citar texto, agregue <code>&gt;</code> y opcionalmente un espacio antes de la línea de texto, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">&gt; Texto citado</code></pre> se convertirá <blockquote class="uncited"><div>Texto citado<p></p></div></blockquote>',
	'HELP_MARKDOWN_CODE_QUESTION' => 'Mostrando código',
	'HELP_MARKDOWN_CODE_ANSWER' => 'Para mostrar código, enciérrelo entre un par de <code>```</code> o <code>~~~</code>, o alternativamente agregue 4 espacios en blanco antes de cada línea. También puede especificar el lenguaje en el primer marcador, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">```ruby<br />puts "Hola #{usuario}!"<br />```</code></pre> se convertirá <pre class="markdown-demo"><code class="ruby" data-lang="ruby">puts "Hola #{usuario}!"</code></pre>',
	'HELP_MARKDOWN_CODE_INLINE_QUESTION' => 'Mostrando código en línea',
	'HELP_MARKDOWN_CODE_INLINE_ANSWER' => 'Para mostrar código en línea, enciérrelo entre un par de <code>`</code> o <code>``</code>, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">tag `&lt;div&gt;`</code></pre> o <pre class="markdown-demo"><code class="markdown" data-lang="markdown">tag ``&lt;div&gt;``</code></pre> se convertirá<br /><br />tag <code>&lt;div&gt;</code>',

	'HELP_MARKDOWN_BLOCK_LIST' => 'Generando listas',
	'HELP_MARKDOWN_UNORDERED_LIST_QUESTION' => 'Creando lista desordenada',
	'HELP_MARKDOWN_UNORDERED_LIST_ANSWER' => 'Para crear una lista desordenada, agregue <code>*</code>, <code>-</code> o <code>+</code> seguido por un espacio antes de cada elemento de la lista. Las listas pueden ser anidadas añadiendo 4 espacios adicionales o un tabulador para crear un subnivel, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">- Elemento<br />    - Subelemento<br />- Elemento</code></pre> se convertirá<br /><br /><ul><li>Elemento<ul><li>Subelemento</li></ul></li><li>Elemento</li></ul>',
	'HELP_MARKDOWN_ORDERED_LIST_QUESTION' => 'Creando lista ordenada',
	'HELP_MARKDOWN_ORDERED_LIST_ANSWER' => 'Para crear una lista ordenada, agregue un dígito seguido por un punto y un espacio, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">1. Elemento<br />    1. Subelemento<br />2. Elemento</code></pre> se convertirá<br /><br /><ol><li>Elemento <ol><li>Subelemento</li></ol></li><li>Elemento</li></ol>',

	'HELP_MARKDOWN_BLOCK_LINK' => 'Creando enlaces',
	'HELP_MARKDOWN_LINK_QUESTION' => 'Creando un enlace a otro sitio',
	'HELP_MARKDOWN_LINK_ANSWER' => 'Para crear enlaces, agregue el texto del enlace entre corchetes seguido por la URL del enlace entre paréntesis, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">[Texto del enlace](http://example.org)</code></pre> se convertirá<br /><br /><a href="http://example.org">Texto del enlace</a>',

	'HELP_MARKDOWN_BLOCK_IMAGE' => 'Mostrando iḿagenes',
	'HELP_MARKDOWN_IMAGE_QUESTION' => 'Agregando imágenes',
	'HELP_MARKDOWN_IMAGE_ANSWER' => 'Para mostrar una imágen, agregue un signo de exclamación seguido por el texto alternativo de la imagen entre corchetes y luego la URL de la imagen entre paréntesis, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">![phpBB](https://www.phpbb.com/assets/images/images/logos/blue/160x52.png)</code></pre> se convertirá<br /><br /><img src="https://www.phpbb.com/assets/images/images/logos/blue/160x52.png" alt="phpBB" />',

	'HELP_MARKDOWN_BLOCK_EXTRA' => 'Extras',
	'HELP_MARKDOWN_TABLE_QUESTION' => 'Creando tablas',
	'HELP_MARKDOWN_TABLE_ANSWER' => 'Para crear tablas, agregue una línea de texto dividido con <code>|</code> que serán los encabezados de la tabla, luego en una nueva línea con <code>-</code> y opcionalmente <code>:</code> a la izquierda, en ambos lados o a la derecha para alinear el texto de esa columna, nuevamente dividido con <code>|</code>. Todas las líneas sucesivas divididas con <code>|</code> serán mostradas como filas de la tabla, e.g.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">| Izquierda | Centro | Derecha |<br />|:----------|:------:|--------:|<br />|     x     |    x   |    x    |</code></pre> o <pre class="markdown-demo"><code class="markdown" data-lang="markdown">Izquierda|Centro|Derecha<br />:-|:-:|-:<br />x|x|x</code></pre> se convertirá<br /><br /><table><thead><tr><th style="text-align:left">Izquierda</th><th style="text-align:center">Centro</th><th style="text-align:right">Derecha</th></tr></thead><tbody><tr><td style="text-align:left">x</td><td style="text-align:center">x</td><td style="text-align:right">x</td></tr></tbody></table>',
	'HELP_MARKDOWN_HORIZONTAL_RULE_QUESTION' => 'Creando reglas horizontales',
	'HELP_MARKDOWN_HORIZONTAL_RULE_ANSWER' => 'Para crear una regla horizontal, agregue al menos 3 <code>*</code>, <code>-</code> o <code>_</code> opcionalmente separados con un espacio, ej.<pre class="markdown-demo"><code class="markdown" data-lang="markdown">***<br />* * *<br />---<br />- - -<br />___<br />_ _ _</code></pre> se convertirá<br /><br /><hr />'
]);
