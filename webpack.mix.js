const mix = require('laravel-mix');

const assetPath = 'assets';

mix.disableNotifications();
mix.setPublicPath(assetPath);

mix.js(`${assetPath}/src/index.js`, `${assetPath}/js/site-template-picker.js`);
mix.sass(`${assetPath}/sass/site-template-picker.scss`, `${assetPath}/css`)
	.options({
		processCssUrls: false
	});
