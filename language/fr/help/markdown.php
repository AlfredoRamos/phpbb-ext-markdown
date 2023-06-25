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
	'MARKDOWN_GUIDE' => 'Guide Markdown',

	'HELP_MARKDOWN_BLOCK_INTRO' => 'Introduction',
	'HELP_MARKDOWN_INTRO_MARKDOWN_QUESTION' => 'Le Markdown c\'est quoi?',
	'HELP_MARKDOWN_INTRO_MARKDOWN_ANSWER' => 'Markdown est un langage de balisage léger avec une syntaxe de formatage de texte brut destiné aux rédacteurs web. Il vous permet d\'écrire facilement du texte, sans besoin ou aide d\'outils externes ou d\'une interface utilisateur, qui sera ensuite formaté en HTML tout en conservant sa lisibilité. Markdown peut être utilisé à la place ou en conjonction avec un texte formaté avec BBCode.',

	'HELP_MARKDOWN_BLOCK_TEXT' => 'Mise en forme du texte',
	'HELP_MARKDOWN_TEXT_BOLD_QUESTION' => 'Création d\'un texte en gras',
	'HELP_MARKDOWN_TEXT_BOLD_ANSWER' => 'Pour mettre un texte en gras, il suffit de l\'entourer d\'une paire d\'éléments de type <code>**</code> ou <code>__</code>, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">**Bonjour**</code></pre> ou <pre class="markdown-code"><code class="markdown" data-lang="markdown">__Bonjour__</code></pre> vont devenir<br><br><strong>Bonjour</strong>',
	'HELP_MARKDOWN_TEXT_ITALIC_QUESTION' => 'Création d\'un texte en italique',
	'HELP_MARKDOWN_TEXT_ITALIC_ANSWER' => 'Pour mettre un texte en italique, il suffit de l\'entourer d\'une paire de symboles <code>*</code> ou <code>_</code>, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">*Super!*</code></pre> ou <pre class="markdown-code"><code class="markdown" data-lang="markdown">_Super!_</code></pre> vont devenir<br><br><em>Super!</em>',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_QUESTION' => 'Création d\'un texte barré',
	'HELP_MARKDOWN_TEXT_STRIKETHROUGH_ANSWER' => 'Pour barrer un texte, il suffit de l\'entourer d\'une paire de symboles <code>~~</code>, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">~~Bonne matinée~~</code></pre> va devenir<br><br><del>Bonne matinée</del>',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_QUESTION' => 'Création d\'un texte en indice',
	'HELP_MARKDOWN_TEXT_SUBSCRIPT_ANSWER' => 'Pour créer un texte en indice, il suffit de l\'entourer d\'une paire de symboles <code>~</code>, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">H~2~O</code></pre> va devenir<br><br>H<sub>2</sub>O',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_QUESTION' => 'Création d\'un texte en exposant',
	'HELP_MARKDOWN_TEXT_SUPERSCRIPT_ANSWER' => 'Pour créer un texte en exposant, ajoutez <code>^</code> avant le texte, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">2^n</code></pre> va devenir<br><br>2<sup>n</sup>',
	'HELP_MARKDOWN_TEXT_HEADER_QUESTION' => 'Création d\'en-têtes',
	'HELP_MARKDOWN_TEXT_HEADER_ANSWER' => 'Pour créer des en-têtes, ajoutez de 1 à 6 <code>#</code> suivi d\'un espace avant le texte. Plus le nombre est élevé, plus le texte est petit, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown"># H1<br>## H2<br>### H3<br>#### H4<br>##### H5<br>###### H6</code></pre> vont devenir<br><br><h1 class="markdown">H1</h1><h2 class="markdown">H2</h2><h3 class="markdown">H3</h3><h4 class="markdown">H4</h4><h5 class="markdown">H5</h5><h6 class="markdown">H6</h6>',

	'HELP_MARKDOWN_BLOCK_CODE' => 'Citation et édition d\'un texte à largeur fixe',
	'HELP_MARKDOWN_QUOTE_QUESTION' => 'Citation de texte dans les réponses',
	'HELP_MARKDOWN_QUOTE_ANSWER' => 'Pour citer du texte ajoutez <code>&gt;</code> et éventuellement un espace avant la ligne de texte, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">&gt; Texte cité</code></pre> va devenir <blockquote class="uncited"><div><p>Texte cité</p></div></blockquote>',
	'HELP_MARKDOWN_CODE_QUESTION' => 'Affichage de code',
	'HELP_MARKDOWN_CODE_ANSWER' => 'Pour afficher du code, il suffit de l\'entourer d\'une paire de symbole <code>```</code> ou <code>~~~</code>, ou ajouter 4 espaces vides avant chaque ligne. Vous pouvez également spécifier la langue dans le premier marqueur, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">```ruby<br>puts "Bonjour #{user}!"<br>```</code></pre> va devenir <pre class="markdown-code"><code class="ruby" data-lang="ruby">puts "Bonjour #{user}!"</code></pre>',
	'HELP_MARKDOWN_CODE_INLINE_QUESTION' => 'Affichage de code en ligne',
	'HELP_MARKDOWN_CODE_INLINE_ANSWER' => 'Pour produire du code en ligne, il faut l\'entourer d\'une paire d\'éléments <code>`</code> ou <code>``</code>, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">`&lt;div&gt;` tag</code></pre> ou <pre class="markdown-code"><code class="markdown" data-lang="markdown">``&lt;div&gt;`` tag</code></pre> vont devenir<br><br><code>&lt;div&gt;</code> tag',

	'HELP_MARKDOWN_BLOCK_TABLE' => 'Générer des tableaux',
	'HELP_MARKDOWN_TABLE_QUESTION' => 'Création de tableaux',
	'HELP_MARKDOWN_TABLE_ANSWER' => 'Pour créer des tableaux, ajoutez une ligne de texte divisée par <code>|</code> qui sera l\'en-tête du tableau, puis une nouvelle ligne avec <code>-</code> et éventuellement <code>:</code> à gauche, sur les deux côtés ou à droite pour aligner le texte de cette colonne, à nouveau divisée par des <code>|</code>. Toutes les lignes successives divisées par <code>|</code> seront affichées sous forme de lignes de tableau, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">| Gauche | Centre | Droite |<br>|:-----|:------:|------:|<br>|   x  |    x   |   x   |</code></pre> ou <pre class="markdown-code"><code class="markdown" data-lang="markdown">Gauche|Centre|Droite<br>:-|:-:|-:<br>x|x|x</code></pre> vont devenir<br><br><table class="markdown"><thead><tr><th style="text-align:left">Gauche</th><th style="text-align:center">Centre</th><th style="text-align:right">Droite</th></tr></thead><tbody><tr><td style="text-align:left">x</td><td style="text-align:center">x</td><td style="text-align:right">x</td></tr></tbody></table>',

	'HELP_MARKDOWN_BLOCK_SPOILER' => 'Générer des spoilers',
	'HELP_MARKDOWN_BLOCK_SPOILER_QUESTION' => 'Créer des blocs de spoilers',
	'HELP_MARKDOWN_BLOCK_SPOILER_ANSWER' => 'Pour créer un bloc de spoilers, ajoutez <code>&gt;!</code> et éventuellement un espace avant la ligne de texte. Les lignes suivantes peuvent être démarrées avec <code>&gt;</code>, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">&gt;! Texte caché<br>&gt; Une autre ligne</code></pre> va devenir<br><br><details class="spoiler markdown"><p>Texte caché<br>Une autre ligne</p></details>',
	'HELP_MARKDOWN_INLINE_SPOILER_QUESTION' => 'Création de spoilers en ligne',
	'HELP_MARKDOWN_INLINE_SPOILER_ANSWER' => 'Pour créer un spoiler en ligne, placez le texte à l\'intérieur de <code>&gt;!</code> et <code>!&lt;</code> ou à l\'intérieur d\'une paire de <code>||</code>, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">Ceci est un spoiler (Reddit-style) &gt;!spoiler!&lt;.<br>Ceci est un spoiler (Discord-style)||spoiler||.</code></pre> va devenir<br><br><p>Ceci est un (Reddit-style) <span class="spoiler markdown" onclick="removeAttribute(\'style\')" style="background:#444;color:transparent">spoiler</span>.<br>Ceci est un (Discord-style) <span class="spoiler markdown" onclick="removeAttribute(\'style\')" style="background:#444;color:transparent">spoiler</span>.</p>',

	'HELP_MARKDOWN_BLOCK_LIST' => 'Générer des listes',
	'HELP_MARKDOWN_UNORDERED_LIST_QUESTION' => 'Création d\'une liste non ordonnée',
	'HELP_MARKDOWN_UNORDERED_LIST_ANSWER' => 'Pour créer une liste non ordonnée, ajoutez <code>*</code>, <code>-</code> ou <code>+</code> suivi d\'un espace avant chaque élément de la liste. Les listes peuvent être imbriquées en ajoutant 4 espaces supplémentaires ou une tabulation pour créer un sous-niveau., exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">- Element<br>    - Subelement<br>- Element</code></pre> va devenir<br><br><ul class="markdown"><li>Element<ul class="markdown"><li>Subelement</li></ul></li><li>Element</li></ul>',
	'HELP_MARKDOWN_ORDERED_LIST_QUESTION' => 'Création d\'une liste ordonnée',
	'HELP_MARKDOWN_ORDERED_LIST_ANSWER' => 'Pour créer une liste ordonnée, ajoutez un chiffre suivi d\'un point et d\'un espace, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">1. Element<br>    1. Subelement<br>2. Element</code></pre> va devenir<br><br><ol class="markdown"><li>Element <ol class="markdown"><li>Subelement</li></ol></li><li>Element</li></ol>',
	'HELP_MARKDOWN_TASK_LIST_QUESTION' => 'Création d\'une liste de tâches',
	'HELP_MARKDOWN_TASK_LIST_ANSWER' => 'Pour créer une liste de tâches, ajoutez <code>*</code>, <code>-</code> ou <code>+</code> suivi d\'un espace, soit <code>[x]</code> ou <code>[ ]</code>, et un autre espace avant chaque élément de la liste. Les <code>[x]</code> et <code>[ ]</code> affichent respectivement une case cochée et une case non cochée, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">- [x] Element<br>    - [x] Subelement<br>- [ ] Element</code></pre> vont devenir<br><br><ul class="markdown"><li data-task-id="x" data-task-state="checked"><input data-task-id="x" type="checkbox" checked="" disabled=""> Element<ul class="markdown"><li data-task-id="y" data-task-state="checked"><input data-task-id="y" type="checkbox" checked="" disabled=""> Subelement</li></ul></li><li data-task-id="z" data-task-state="unchecked"><input data-task-id="z" type="checkbox" disabled=""> Element</li></ul>',

	'HELP_MARKDOWN_BLOCK_LINK' => 'Créer des liens',
	'HELP_MARKDOWN_LINK_QUESTION' => 'Lien vers un autre site',
	'HELP_MARKDOWN_LINK_ANSWER' => 'Pour créer des liens, ajoutez le texte du lien entre crochets, suivi de l\'URL du lien entre parenthèses., exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">[Google](http://google.fr)</code></pre> va devenir<br><br><a href="https://google.fr">Google</a>',

	'HELP_MARKDOWN_BLOCK_IMAGE' => 'Afficher des images',
	'HELP_MARKDOWN_IMAGE_QUESTION' => 'Ajouter des images',
	'HELP_MARKDOWN_IMAGE_ANSWER' => 'Pour afficher une image, ajoutez un point d\'exclamation suivi du texte alternatif de l\'image entre crochets et de l\'URL de l\'image entre parenthèses, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">![Image](https://picsum.photos/160/52)</code></pre> va devenir<br><br><img src="https://picsum.photos/160/52" alt="Image">',

	'HELP_MARKDOWN_BLOCK_EXTRA' => 'Extras',
	'HELP_MARKDOWN_HORIZONTAL_RULE_QUESTION' => 'Création de règles horizontales',
	'HELP_MARKDOWN_HORIZONTAL_RULE_ANSWER' => 'Pour créer une règle horizontale, ajoutez au moins 3 <code>*</code>, <code>-</code> ou <code>_</code> éventuellement séparés par un espace, exemple:<pre class="markdown-code"><code class="markdown" data-lang="markdown">***<br>* * *<br>---<br>- - -<br>___<br>_ _ _</code></pre> va devenir<br><br><hr>'
]);
