const postcssPlugins = require( '@wordpress/postcss-plugins-preset' );

module.exports = ( ctx ) => {
	const isDevelopment = ( 'development' === ctx.env );

	return {
		map: { inline: isDevelopment },
		plugins: [
			...postcssPlugins,
			// Additional plugins here.
		]
	};
};
