const path = require("path")
const webpack = require('webpack')
const TerserPlugin = require('terser-webpack-plugin')

module.exports = {
    entry: path.resolve(__dirname, "src/js/index.js"),
    output: {
        path: path.resolve(__dirname, "dist"),
        filename: "material.min.js",
        library: "Material",
        libraryTarget: "umd",
    },
    module: {
        rules: [{
            test: /\.(js)$/,
            exclude: /node_modules/,
            use: "babel-loader",
        },],
    },
    mode: "production",
    plugins: [
        new webpack.BannerPlugin(`
a The Creativity Architect Production
https://thethemename.com

Copyright (C) 2021 "The Creativity Architect" CJMTermini
licensed under the MIT license.
https://github.com/figmentdragon/architecture/LICENSE
 `)
    ],
    optimization: {
        minimizer: [new TerserPlugin({
            extractComments: false,
        })],
    },
}
