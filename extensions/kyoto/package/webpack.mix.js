/**
 * Webpack / Mix configuration file
 */

let mix = require('laravel-mix');
let path = require('path');

/**
 * Do default configuration
 */

mix.options({
    clearConsole: true,
    processCssUrls: false
});

/**
 * Set public and resource path to root
 */

mix.setPublicPath(
    path.resolve(__dirname)
);

mix.setResourceRoot(
    path.resolve(__dirname)
);

/**
 * Define externals
 */
mix.webpackConfig({
    externals: {
        jquery: '$', vue: 'Vue',
    }
});

/**
 * JS files
 */

mix.js('resources/js/bootstrap.js', 'public/js/index.js');

/**
 * CSS files
 */

mix.sass('resources/sass/bootstrap.scss', 'public/css/index.css', {
    precision: 3
});


mix.version();
