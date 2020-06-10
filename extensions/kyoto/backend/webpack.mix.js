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
 * Webfont files
 */

mix.copyDirectory(
    'node_modules/@fortawesome/fontawesome-free/webfonts',
    'public/webfonts',
);

/**
 * Image files
 */

mix.copyDirectory(
    'resources/img',
    'public/img',
);

/**
 * JS files
 */

mix.js(
    'resources/js/bootstrap.js',
    'public/js/index.js'
).version();

/**
 * CSS files
 */

mix.sass(
    'resources/scss/bootstrap.scss',
    'public/css/index.css',
    { precision: 3 }
).version();
