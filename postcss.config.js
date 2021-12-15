module.exports = {
	plugins: [
		require('postcss-import')({path: __dirname + '/scss'}),
		require('cssnano'),
		require('autoprefixer')
	]
}
