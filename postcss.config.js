import postcssImport from 'postcss-import';
import cssnano from 'cssnano';
import autoprefixer from 'autoprefixer';
import { join, dirname } from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

export default {
	plugins: [
		postcssImport({ path: join(__dirname, 'scss') }),
		autoprefixer(),
		cssnano({
			preset: [
				'default',
				{
					discardComments: { removeAll: true },
					normalizeString: { preferredQuote: 'single' },
				},
			],
		}),
	],
};
