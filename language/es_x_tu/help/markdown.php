<?php

/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
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
	'HELP_MARKDOWN_INTRO_MARKDOWN_ANSWER' => 'Markdown es un lenguaje de marcado ligero con sintaxis de formato en texto plano dirigido a escritores web. Te permite escribir fácilmente texto, sin necesidad o ayuda de herramientas externas o interfaz de usuario, que será convertido a HTML sin perder legibilidad. Markdown puede usar en lugar de o junto a texto formateado con BBCode.',

	'HELP_MARKDOWN_BLOCK_TEXT' => 'Formato de texto',
	'HELP_MARKDOWN_TEXT_BOLD_QUESTION' => 'Creando texto en negritas',
	'HELP_MARKDOWN_TEXT_BOLD_ANSWER' => 'Para crear texto en negritas, enciérralo entre un par de <code>**</code> o <code>__</code>, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">**Hola**</code></pre> o <pre class="markdown-code"><code class="markdown" data-lang="markdown">__Hola__</code></pre> se convertirá<br><br><strong>Hola</strong>',
	'HELP_MARKDOWN_TEXT_ITALIC_QUESTION' => 'Creando texto en cursiva',
	'HELP_MARKDOWN_TEXT_ITALIC_ANSWER' => 'Para crear texto en cursiva, enciérralo entre un par de <code>*</code> o <code>_</code>, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">*Genial!*</code></pre> o <pre class="markdown-code"><code class="markdown" data-lang="markdown">_Genial!_</code></pre> se convertirá<br><br><em>Genial!</em>',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_QUESTION' => 'Creando texto tachado',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_ANSWER' => 'Para tachar texto, enciérralo entre un par de <code>~~</code>, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">~~Buenos días~~</code></pre> se convertirá<br><br><del>Buenos días</del>',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_QUESTION' => 'Creando subíndices',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_ANSWER' => 'Para crear subíndices, enciérralo entre un par de <code>~</code>, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">H~2~O</code></pre> se convertirá<br><br>H<sub>2</sub>O',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_QUESTION' => 'Creando superíndices',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_ANSWER' => 'Para crear superíndices, agrega <code>^</code> antes del texto, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">2^n</code></pre> se convertirá<br><br>2<sup>n</sup>',
	'HELP_MARKDOWN_TEXT_HEADER_QUESTION' => 'Creando encabezados',
	'HELP_MARKDOWN_TEXT_HEADER_ANSWER' => 'Para crear encabezados, agrega de 1 a 6 <code>#</code> seguidos por un espacio antes del texto. Cuanto mayor sea el número, más pequeño será el texto, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown"># H1<br>## H2<br>### H3<br>#### H4<br>##### H5<br>###### H6</code></pre> se convertirá<br><br><h1 class="markdown">H1</h1><h2 class="markdown">H2</h2><h3 class="markdown">H3</h3><h4 class="markdown">H4</h4><h5 class="markdown">H5</h5><h6 class="markdown">H6</h6>',

	'HELP_MARKDOWN_BLOCK_CODE' => 'Citando texto y mostrando texto de ancho fijo',
	'HELP_MARKDOWN_QUOTE_QUESTION' => 'Citando texto en respuestas',
	'HELP_MARKDOWN_QUOTE_ANSWER' => 'Para citar texto, agrega <code>&gt;</code> y opcionalmente un espacio antes de la línea de texto, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">&gt; Texto citado</code></pre> se convertirá <blockquote class="uncited"><div><p>Texto citado</p></div></blockquote>',
	'HELP_MARKDOWN_CODE_QUESTION' => 'Mostrando código',
	'HELP_MARKDOWN_CODE_ANSWER' => 'Para mostrar código, enciérralo entre un par de <code>```</code> o <code>~~~</code>, o alternativamente agrega 4 espacios en blanco antes de cada línea. También puedes especificar el lenguaje en el primer marcador, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">```ruby<br>puts "Hola #{usuario}!"<br>```</code></pre> se convertirá <pre class="markdown-code"><code class="ruby" data-lang="ruby">puts "Hola #{usuario}!"</code></pre>',
	'HELP_MARKDOWN_CODE_INLINE_QUESTION' => 'Mostrando código en línea',
	'HELP_MARKDOWN_CODE_INLINE_ANSWER' => 'Para mostrar código en línea, enciérralo entre un par de <code>`</code> o <code>``</code>, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">tag `&lt;div&gt;`</code></pre> o <pre class="markdown-code"><code class="markdown" data-lang="markdown">tag ``&lt;div&gt;``</code></pre> se convertirá<br><br>tag <code>&lt;div&gt;</code>',

	'HELP_MARKDOWN_BLOCK_TABLE' => 'Generando tablas',
	'HELP_MARKDOWN_TABLE_QUESTION' => 'Creando tablas',
	'HELP_MARKDOWN_TABLE_ANSWER' => 'Para crear tablas, agrega una línea de texto dividido con <code>|</code> que serán los encabezados de la tabla, luego en una nueva línea con <code>-</code> y opcionalmente <code>:</code> a la izquierda, en ambos lados o a la derecha para alinear el texto de esa columna, nuevamente dividido con <code>|</code>. Todas las líneas sucesivas divididas con <code>|</code> serán mostradas como filas de la tabla, e.g.<pre class="markdown-code"><code class="markdown" data-lang="markdown">| Izquierda | Centro | Derecha |<br>|:----------|:------:|--------:|<br>|     x     |    x   |    x    |</code></pre> o <pre class="markdown-code"><code class="markdown" data-lang="markdown">Izquierda|Centro|Derecha<br>:-|:-:|-:<br>x|x|x</code></pre> se convertirá<br><br><table class="markdown"><thead><tr><th style="text-align:left">Izquierda</th><th style="text-align:center">Centro</th><th style="text-align:right">Derecha</th></tr></thead><tbody><tr><td style="text-align:left">x</td><td style="text-align:center">x</td><td style="text-align:right">x</td></tr></tbody></table>',

	'HELP_MARKDOWN_BLOCK_SPOILER' => 'Generando spoilers',
	'HELP_MARKDOWN_BLOCK_SPOILER_QUESTION' => 'Creando spoilers de bloque',
	'HELP_MARKDOWN_BLOCK_SPOILER_ANSWER' => 'Para crear un spoiler de bloque, agrega <code>&gt;!</code> y opcionalmente un espacio antes de la línea de texto. Líneas subsecuentes pueden iniciar con <code>&gt;</code>, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">&gt;! Texto de spoiler<br>&gt; Otra línea</code></pre> se convertirá<br><br><details class="spoiler markdown"><p>Texto de spoiler<br>Otra línea</p></details>',
	'HELP_MARKDOWN_INLINE_SPOILER_QUESTION' => 'Creando spoilers en línea',
	'HELP_MARKDOWN_INLINE_SPOILER_ANSWER' => 'Para crear un spoiler en línea, encierra el texto dentro de <code>&gt;!</code> y <code>!&lt;</code> o entre un par de <code>||</code>, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">Este es un &gt;!spoiler!&lt; al estilo de Reddit.<br>Este es un ||spoiler|| al estilo de Discord.</code></pre> se convertirá<br><br><p>Este es un <span class="spoiler markdown" onclick="removeAttribute(\'style\')" style="background:#444;color:transparent">spoiler</span> al estilo de Reddit.<br>Este es un <span class="spoiler markdown" onclick="removeAttribute(\'style\')" style="background:#444;color:transparent">spoiler</span> al estilo de Discord.</p>',

	'HELP_MARKDOWN_BLOCK_LIST' => 'Generando listas',
	'HELP_MARKDOWN_UNORDERED_LIST_QUESTION' => 'Creando lista desordenada',
	'HELP_MARKDOWN_UNORDERED_LIST_ANSWER' => 'Para crear una lista desordenada, agrega <code>*</code>, <code>-</code> o <code>+</code> seguido por un espacio antes de cada elemento de la lista. Las listas pueden ser anidadas añadiendo 4 espacios adicionales o un tabulador para crear un subnivel, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">- Elemento<br>    - Subelemento<br>- Elemento</code></pre> se convertirá<br><br><ul class="markdown"><li>Elemento<ul class="markdown"><li>Subelemento</li></ul></li><li>Elemento</li></ul>',
	'HELP_MARKDOWN_ORDERED_LIST_QUESTION' => 'Creando lista ordenada',
	'HELP_MARKDOWN_ORDERED_LIST_ANSWER' => 'Para crear una lista ordenada, agrega un dígito seguido por un punto y un espacio, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">1. Elemento<br>    1. Subelemento<br>2. Elemento</code></pre> se convertirá<br><br><ol class="markdown"><li>Elemento <ol class="markdown"><li>Subelemento</li></ol></li><li>Elemento</li></ol>',
	'HELP_MARKDOWN_TASK_LIST_QUESTION' => 'Creando una lista de tareas',
	'HELP_MARKDOWN_TASK_LIST_ANSWER' => 'Para crear una lista de tareas, agrega <code>*</code>, <code>-</code> o <code>+</code> seguido por un espacio, ya sea <code>[x]</code> o <code>[ ]</code>, y otro espacio antes de cada elemento de la lista. Los caracteres <code>[x]</code> y <code>[ ]</code> mostrarán una casilla marcada y desmarcada, respectivamente, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">- [x] Elemento<br>    - [x] Subelemento<br>- [ ] Elemento</code></pre> se convertirá<br><br><ul class="markdown"><li data-task-id="x" data-task-state="checked"><input data-task-id="x" type="checkbox" checked="" disabled=""> Elemento<ul class="markdown"><li data-task-id="y" data-task-state="checked"><input data-task-id="y" type="checkbox" checked="" disabled=""> Subelemento</li></ul></li><li data-task-id="z" data-task-state="unchecked"><input data-task-id="z" type="checkbox" disabled=""> Elemento</li></ul>',

	'HELP_MARKDOWN_BLOCK_LINK' => 'Creando enlaces',
	'HELP_MARKDOWN_LINK_QUESTION' => 'Creando un enlace a otro sitio',
	'HELP_MARKDOWN_LINK_ANSWER' => 'Para crear enlaces, agrega el texto del enlace entre corchetes seguido por la URL del enlace entre paréntesis, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">[Texto del enlace](http://example.org)</code></pre> se convertirá<br><br><a href="http://example.org">Texto del enlace</a>',

	'HELP_MARKDOWN_BLOCK_IMAGE' => 'Mostrando imágenes',
	'HELP_MARKDOWN_IMAGE_QUESTION' => 'Agregando imágenes',
	'HELP_MARKDOWN_IMAGE_ANSWER' => 'Para mostrar una imagen, agrega un signo de exclamación seguido por el texto alternativo de la imagen entre corchetes y luego la URL de la imagen entre paréntesis, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">![phpBB](https://www.phpbb.com/assets/images/images/logos/blue/160x52.png)</code></pre> se convertirá<br><br><img src="https://www.phpbb.com/assets/images/images/logos/blue/160x52.png" alt="phpBB">',

	'HELP_MARKDOWN_BLOCK_EXTRA' => 'Extras',
	'HELP_MARKDOWN_HORIZONTAL_RULE_QUESTION' => 'Creando reglas horizontales',
	'HELP_MARKDOWN_HORIZONTAL_RULE_ANSWER' => 'Para crear una regla horizontal, agrega al menos 3 <code>*</code>, <code>-</code> o <code>_</code> opcionalmente separados con un espacio, ej.<pre class="markdown-code"><code class="markdown" data-lang="markdown">***<br>* * *<br>---<br>- - -<br>___<br>_ _ _</code></pre> se convertirá<br><br><hr>'
]);
