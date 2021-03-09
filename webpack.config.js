let webpack = require('webpack');
let path = require('path');
let MiniCssExtractPlugin = require('mini-css-extract-plugin');
let WebpackNotifierPlugin = require('webpack-notifier');

module.exports = (env, options) => {
    return {
        stats: 'minimal',

        entry: [
            './resources/assets/js/app.js',
            './resources/assets/scss/app.scss',
        ],

        output: {
            path: path.resolve(__dirname, 'public/assets/js'),
            filename: 'app.js',
            publicPath: './public',
        },

        resolve: {
            alias: {
                'vue': 'vue/dist/vue.esm-bundler.js'
            }
        },

        module: {
            rules: [
                {
                    test: /\.s[ac]ss$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        {
                            loader: 'css-loader',
                            options: {
                                url: false
                            }
                        },
                        "postcss-loader",
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true,
                            },
                        },
                    ],
                }
            ],
        },

        plugins: [
            new MiniCssExtractPlugin({
                filename: '../css/app.css',
            }),
            new WebpackNotifierPlugin({
                emoji: true,
                alwaysNotify: true,
                title: function (params) {
                    return `Slim Starter`;
                }
            }),
        ],
    }
};
