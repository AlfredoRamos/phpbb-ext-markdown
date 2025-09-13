'use strict';

import { readFileSync, writeFileSync } from 'fs';
import { sync } from 'glob';
import { join } from 'path';
import { buildPath, replaceAssetFile } from './helper.js';

const templateFileList = sync(join(buildPath, 'styles/**/*.html')).concat(
	sync(buildPath + '/adm/style/**/*.html')
);
const cssFileList = sync(join(buildPath, 'styles/**/theme/css/*.css')).concat(
	sync(buildPath + '/adm/style/css/*.css')
);
const jsFileList = sync(join(buildPath, 'styles/**/theme/js/*.js')).concat(
	sync(buildPath + '/adm/style/js/*.js')
);

templateFileList.forEach((t) => {
	const oldHtml = readFileSync(t).toString();
	let html = oldHtml;

	cssFileList.forEach((c) => {
		html = replaceAssetFile(c, html);
	});

	jsFileList.forEach((j) => {
		html = replaceAssetFile(j, html);
	});

	if (html === oldHtml) {
		return;
	}

	writeFileSync(t, html, { mode: 0o644 });
});
