import tailwind from '@tailwindcss/postcss';
import cssnano from 'cssnano';
import autoprefixer from 'autoprefixer';

export default {
	plugins: [
		tailwind(),
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
