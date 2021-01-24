let postcssPrefix = require('autoprefixer');

let postcssSvg = require('postcss-inline-svg')({
    paths: [__dirname + '/resources/img']
});

module.exports = {
    plugins: [
        postcssPrefix, postcssSvg
    ],
};
