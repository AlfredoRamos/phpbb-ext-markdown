'use strict';

import { realpathSync, readFileSync, existsSync, mkdirSync } from 'fs';
import { join, extname, basename, dirname } from 'path';

const __filename = new URL(import.meta.url).pathname;
const __dirname = dirname(__filename);

const rootPath = realpathSync(__dirname + '../../../');
const schema = JSON.parse(readFileSync(rootPath + '/composer.json').toString());
const ext = schema.name.split('/');
const namespace = '@' + ext[0] + '_' + ext[1];
const buildPath = join(rootPath, 'build', 'package', ext[0], ext[1]);

if (!existsSync(buildPath)) {
	mkdirSync(buildPath, { recursive: true, mode: 0o755 });
}

const replaceAssetFile = (file, html) => {
	const fileExt = extname(file);

	if (file.endsWith('.min' + fileExt)) {
		return html;
	}

	const isMinified = existsSync(file.replace(fileExt, '.min' + fileExt));

	if (!isMinified) {
		return html;
	}

	const filePath = basename(dirname(file));
	const fileName = basename(file);
	const twigNamespace = join(namespace, filePath, fileName);

	if (!html.includes(twigNamespace)) {
		return html;
	}

	html = html.replace(
		twigNamespace,
		twigNamespace.replace(fileExt, '.min' + fileExt)
	);

	return html;
};

export { buildPath, replaceAssetFile };
