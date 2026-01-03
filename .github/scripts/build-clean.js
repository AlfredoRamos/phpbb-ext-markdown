'use strict';

import { readFileSync, writeFileSync } from 'fs';
import { sync } from 'glob';
import { join } from 'path';
import { buildPath, unminifiedAssetFile, deleteAssetFile } from './helper.js';

const cssFileList = sync(join(buildPath, 'styles/**/theme/css/*.css')).concat(
	sync(buildPath + '/adm/style/css/*.css')
);
const jsFileList = sync(join(buildPath, 'styles/**/theme/js/*.js')).concat(
	sync(buildPath + '/adm/style/js/*.js')
);

cssFileList.forEach((c) => {
	const file = unminifiedAssetFile(c);

	if (file) {
		deleteAssetFile(file);
	}
});

jsFileList.forEach((j) => {
	const file = unminifiedAssetFile(j);

	if (file) {
		deleteAssetFile(file);
	}
});
