const mix = require('laravel-mix');

const assetPath = 'assets';

mix.disableNotifications();
mix.setPublicPath(assetPath);

mix.js(`${assetPath}/src/index.js`, `${assetPath}/js/site-template-picker.js`);
mix.sass(`${assetPath}/sass/site-template-picker.scss`, `${assetPath}/css`)
	.options({
		processCssUrls: false
	});

/*
 * Add custom Webpack configuration.
 *
 * @link https://laravel.com/docs/8.x/mix#custom-webpack-configuration
 * @link https://webpack.js.org/configuration/
 */
mix.webpackConfig( {
	devtool      : false,
	performance  : { hints  : false },
	watchOptions : { ignored: /node_modeuls/, }
} );
