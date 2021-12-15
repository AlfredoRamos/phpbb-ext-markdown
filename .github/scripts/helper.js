'use strict';

const fs = require('fs');
const path = require('path');

const rootPath = fs.realpathSync(__dirname + '../../../');
const schema = JSON.parse(fs.readFileSync(rootPath + '/composer.json').toString());
const ext = schema.name.split('/');
const namespace = '@' + ext[0] + '_' + ext[1];
const buildPath = path.join(rootPath, 'build', 'package', ext[0], ext[1]);

if (!fs.existsSync(buildPath)) {
	fs.mkdirSync(buildPath, {recursive: true, mode: 0o755});
}

exports.buildPath = buildPath;
exports.replaceAssetFile = function(file, html) {
	const fileExt = path.extname(file);

	if (file.endsWith('.min' + fileExt)) {
		return html;
	}

	const isMinified = fs.existsSync(file.replace(fileExt, '.min' + fileExt));

	if (!isMinified) {
		return html;
	}

	const filePath = path.basename(path.dirname(file));
	const fileName = path.basename(file);
	const twigNamespace = path.join(namespace, filePath, fileName);

	if (!html.includes(twigNamespace)) {
		return html;
	}

	html = html.replace(twigNamespace, twigNamespace.replace(fileExt, '.min' + fileExt));

	return html;
};
