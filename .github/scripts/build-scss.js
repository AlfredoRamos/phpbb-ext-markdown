'use strict';

const fs = require('fs');
const path = require('path');
const glob = require('glob');
const sass = require('sass');
const autoprefixer = require('autoprefixer');
const postcss = require('postcss');

const scssFileList = glob.sync('scss/themes/**/*.scss');
scssFileList.forEach(function(s) {
	const normalFile = s.replace('scss/themes/', '').replace('.scss', '.css');
	const normalFilePath = path.dirname(normalFile);

	if (!fs.existsSync(normalFilePath)) {
		fs.mkdirSync(normalFilePath, {recursive: true, mode: 0o755});
	}

	const result = sass.renderSync({
		file: s,
		indentType: 'tab',
		indentWidth: 1,
		omitSourceMapUrl: true,
		outFile: normalFile,
		outputStyle: 'expanded',
		sourceMap: false
	});

	postcss([autoprefixer({cascade: false})]).process(result.css, {from: normalFile}).then(function(res) {
		res.warnings().forEach(function(warn) {
			console.warn(warn.toString());
		});

		fs.writeFileSync(normalFile, res.css, {mode: 0o644});
	});
});
