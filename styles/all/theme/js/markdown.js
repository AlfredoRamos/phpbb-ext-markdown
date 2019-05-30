/**
 * Markdown extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2019 Alfredo Ramos
 * @license GPL-2.0-only
 */

(function($) {
	'use strict';

	// Add extra Imgur output
	$(document.body).on('alfredoramos.imgur.output_append', function($event, $output, $image) {
		$.extend($output, {
			markdown_image: '![' + $image.title + '](' + $image.link + ')',
			markdown_thumbnail: '[![' + $image.title + '](' + $image.thumbnail + ')](' + $image.link + ')'
		});
	});
})(jQuery);
