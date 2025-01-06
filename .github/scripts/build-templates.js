'use strict';

const fs = require('fs');
const glob = require('glob');
const helper = require('./helper');

const templateFileList = glob
	.sync(helper.buildPath + '/styles/**/*.html')
	.concat(glob.sync(helper.buildPath + '/adm/style/**/*.html'));
const cssFileList = glob
	.sync(helper.buildPath + '/styles/**/theme/css/*.css')
	.concat(glob.sync(helper.buildPath + '/adm/style/css/*.css'));
const jsFileList = glob
	.sync(helper.buildPath + '/styles/**/theme/js/*.js')
	.concat(glob.sync(helper.buildPath + '/adm/style/js/*.js'));

templateFileList.forEach((t) => {
	const oldHtml = fs.readFileSync(t).toString();
	let html = oldHtml;

	cssFileList.forEach((c) => {
		html = helper.replaceAssetFile(c, html);
	});

	jsFileList.forEach((j) => {
		html = helper.replaceAssetFile(j, html);
	});

	if (html === oldHtml) {
		return;
	}

	fs.writeFileSync(t, html, { mode: 0o644 });
});
