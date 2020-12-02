let postcssSvg = require('postcss-inline-svg')({
    paths: [__dirname + '/resources/img']
});

module.exports = {
    plugins: [
        postcssSvg
    ],
};
