const path = require('path');
const webpack = require('webpack');
const TerserPlugin = require('terser-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

let jsExport = {
    entry: ['./resources/js/bootstrap.js'],
    output: {
        filename: 'index.js',
        path: path.resolve('public/js'),
    },
    module: {
        rules: [
            {
                test: /.jsx?$/,
                include: [
                    path.resolve('resources/js'),
                ],
                loader: 'babel-loader',
                options: {
                    configFile: path.resolve('babel.config.js')
                },
            },
            {
                test: /\.vue$/,
                include: [
                    path.resolve('resources/js'),
                ],
                use: ['vue-loader']
            }
        ]
    },
    resolve: {
        alias: {
            'vue$': path.resolve('node_modules/vue/dist/vue.esm.js'),
            'nano-js$': path.resolve('node_modules/nano-js/dist/nano-js.js'),
            'nano-ui$': path.resolve('node_modules/nano-ui/dist/nano-ui.js'),
        },
        extensions: [
            '.js', '.jsx', '.vue'
        ]
    },
    optimization: {
        minimizer: [new TerserPlugin()]
    },
    plugins: [
        new webpack.LoaderOptionsPlugin({
            minimize: true,
            debug: false,
        }),
        new VueLoaderPlugin(
            //
        ),
        new webpack.optimize.AggressiveMergingPlugin(),
    ],
};

let cssExport = {
    entry: "./resources/sass/bootstrap.scss",
    output: {
        filename: '.ignore.js',
        path: path.resolve('public/css')
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                include: [
                    path.resolve('resources/sass'),
                    path.resolve('node_modules/nano-js'),
                    path.resolve('node_modules/nano-ui'),
                ],
                use: [MiniCssExtractPlugin.loader, 'css-loader?url=false', 'postcss-loader', 'sass-loader']
            },
            {
                test: /\.css$/,
                include: [
                    path.resolve('resources/sass'),
                    path.resolve('node_modules/nano-js/'),
                    path.resolve('node_modules/nano-ui/'),
                ],
                use: [MiniCssExtractPlugin.loader, 'css-loader?url=false', 'postcss-loader', 'style-loader']
            }
        ]
    },
    resolve: {
        extensions: ['.scss', '.css']
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "index.css"
        }),
        new CopyPlugin([
            //{ from: '**/*', to: 'public/img/', context: 'resources/img/' },
        ]),
    ]
};

module.exports = [jsExport, cssExport];
