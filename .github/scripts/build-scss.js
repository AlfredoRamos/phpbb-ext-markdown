'use strict';

import { existsSync, mkdirSync, writeFileSync } from 'fs';
import { dirname } from 'path';
import { sync } from 'glob';
import { compile } from 'sass-embedded';
import autoprefixer from 'autoprefixer';
import postcss from 'postcss';

const scssFileList = sync('scss/themes/**/*.scss');
scssFileList.forEach((s) => {
	const normalFile = s.replace('scss/themes/', '').replace('.scss', '.css');
	const normalFilePath = dirname(normalFile);

	if (!existsSync(normalFilePath)) {
		mkdirSync(normalFilePath, { recursive: true, mode: 0o755 });
	}

	const result = compile(s, { style: 'expanded', sourceMap: false });

	postcss([autoprefixer({ cascade: false })])
		.process(result.css, { from: result.css, to: normalFile })
		.then((res) => {
			res.warnings().forEach((warn) => {
				console.warn(warn.toString());
			});

			writeFileSync(normalFile, res.css, { mode: 0o644 });
		});
});
