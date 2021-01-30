const path = require("path");
const webpack = require("webpack");
const CopyPlugin = require("copy-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { VueLoaderPlugin } = require('vue-loader');

let config = {
    entry: ["./resources/js/bootstrap.js"],
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
        ],
    },
    externals: {
        // 'vue': {
        //     root: 'Vue', commonjs2: 'vue', commonjs: 'vue', amd: 'vue'
        // },
        // 'vue': {
        //     root: 'Vue', commonjs2: 'vue', commonjs: 'vue', amd: 'vue'
        // },
        // '@kizmann/pico-js': {
        //     root: 'pi', commonjs2: '@kizmann/pico-js', commonjs: '@kizmann/pico-js', amd: '@kizmann/pico-js'
        // }
    },
    resolve: {
        alias: {
            '@src': path.resolve(__dirname, 'resources'),
            '@kizmann/pico-js': '@kizmann/pico-js/dist/pico-js.esm.js',
            '@kizmann/nano-ui': '@kizmann/nano-ui/dist/nano-ui.esm.js'
        },
        extensions: [
            '.js', '.jsx', '.vue'
        ]
    },
    plugins: [
        new CopyPlugin([
            { from: '**/*', to: 'img/', context: 'resources/img/' }
        ]),
        new VueLoaderPlugin()
    ]
};

let style = {
    entry: ["./resources/sass/bootstrap.scss"],
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader, 'css-loader?url=false', 'postcss-loader', 'sass-loader'
                ]
            }
        ],

    },
    resolve: {
        alias: {
            '@src': path.resolve(__dirname, 'resources')
        },
        extensions: ['.scss', '.css']
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/index.css'
        }),
    ]
};

module.exports = function (env, argv) {

    config.mode = argv.mode;

    if ( argv.mode === 'development' ) {
        config.devtool = 'eval-source-map';
    }

    if ( argv.mode === 'production' ) {
        config.devtool = 'source-map';
    }

    /**
     * @const __dirname
     */

    let globalPackage = Object.assign({

        output: {
            filename: "js/index.js",
            path: path.resolve(__dirname, "public"),
        }

    }, config);

    let stylePackage = Object.assign({

        output: {
            filename: ".ignore.js",
            path: path.resolve(__dirname, "public"),
        }

    }, style);

    if ( argv.mode === 'development' ) {
        return [globalPackage, stylePackage];
    }

    let loaderOptions = new webpack.LoaderOptionsPlugin({
        minimize: true
    });

    globalPackage.plugins.push(loaderOptions);
    stylePackage.plugins.push(loaderOptions);

    let terserOptions = {
        mangle: true
    }

    let terser = new TerserPlugin({
        terserOptions, extractComments: false,
    });

    let optimization = {
        minimize: true, minimizer: []
    };

    optimization.minimizer.push(terser);

    globalPackage.optimization = optimization;
    stylePackage.optimization = optimization;

    return [globalPackage, stylePackage];
}
