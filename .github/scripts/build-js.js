'use strict';

const fs = require('fs');
const path = require('path');
const glob = require('glob');
const uglifyjs = require('uglify-js');
const helper = require('./helper');

const jsFileList = glob.sync(helper.buildPath + '/styles/**/theme/js/*.js').concat(glob.sync(helper.buildPath + '/adm/style/js/*.js'));

jsFileList.forEach(function(j) {
	if (j.endsWith('.min.js')) {
		return;
	}

	const minFileName = j.replace('.js', '.min.js');
	const isMinified = fs.existsSync(minFileName);

	if (isMinified){
		return;
	}

	const js = fs.readFileSync(j).toString();
	const result = uglifyjs.minify(js, {
		toplevel: true,
		output: {
			quote_style: 1,
			shebang: false
		},
		mangle: {
			toplevel: true
		}
	});

	fs.writeFileSync(minFileName, result.code, {mode: 0o644});
});
