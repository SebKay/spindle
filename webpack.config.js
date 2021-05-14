let webpack = require('webpack');
let path = require('path');
const { VueLoaderPlugin } = require('vue-loader');
let MiniCssExtractPlugin = require('mini-css-extract-plugin');
let WebpackNotifierPlugin = require('webpack-notifier');

module.exports = (env, options) => {
    return {
        stats: 'minimal',

        entry: {
            app: [
                './resources/assets/js/app.js',
                './resources/assets/scss/app.scss',
            ],
        },

        output: {
            path: path.resolve(__dirname, 'public/assets/js'),
            filename: '[name].js',
            publicPath: './public',
        },

        resolve: {
            alias: {
                'vue': 'vue/dist/vue.esm-bundler.js'
            },
        },

        module: {
            rules: [
                {
                    test: /\.(js)$/,
                    exclude: /node_modules/,
                    use: ['babel-loader'],
                },
                {
                    test: /\.vue$/,
                    use: ['vue-loader'],
                },
                {
                    test: /\.s[ac]ss$/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        {
                            loader: 'css-loader',
                            options: {
                                url: false,
                            },
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
            new VueLoaderPlugin(),
            new MiniCssExtractPlugin({
                filename: '../css/[name].css',
            }),
            new WebpackNotifierPlugin({
                emoji: true,
                alwaysNotify: true,
                title: function (params) {
                    return `Spindle`;
                },
            }),
        ],
    }
};
