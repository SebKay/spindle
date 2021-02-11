let webpack = require('webpack');
let path = require('path')

module.exports = {
    entry: './resources/assets/js/app.js',

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
};
