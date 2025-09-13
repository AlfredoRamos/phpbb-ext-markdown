'use strict';

import { existsSync, readFileSync, writeFileSync } from 'fs';
import { sync } from 'glob';
import { minify } from 'uglify-js';
import { join } from 'path';
import { buildPath } from './helper.js';

const jsFileList = sync(join(buildPath, 'styles/**/theme/js/*.js')).concat(
	sync(join(buildPath, 'adm/style/js/*.js'))
);

jsFileList.forEach((j) => {
	if (j.endsWith('.min.js')) {
		return;
	}

	const minFileName = j.replace('.js', '.min.js');
	const isMinified = existsSync(minFileName);

	if (isMinified) {
		return;
	}

	const js = readFileSync(j).toString();
	const result = minify(js, {
		toplevel: true,
		output: {
			quote_style: 1,
			shebang: false,
		},
		mangle: {
			toplevel: true,
		},
	});

	writeFileSync(minFileName, result.code, { mode: 0o644 });
});
