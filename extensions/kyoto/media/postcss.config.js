let postcssSvg = require('postcss-inline-svg')({
    paths: [__dirname + '/src/img']
});

module.exports = {
    plugins: [
        postcssSvg
    ],
};
