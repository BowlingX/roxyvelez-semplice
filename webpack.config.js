var path = require("path");
var webpack = require("webpack"), fs = require('fs');
var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
    watch: false,
    devtool: "source-map",
    module: {
        loaders: [
            {
                include: [
                    path.resolve(__dirname, "assets/js"),
                    fs.realpathSync(path.resolve(__dirname, "node_modules/flexcss"))
                ],
                test: /\.jsx?$/,
                loader: 'babel-loader?optional=runtime&sourceMap=inline'
            },
            {
                test: /\.scss$/,
                loader: ExtractTextPlugin.extract(
                    // activate source maps via loader query
                    'css?sourceMap!' +
                    'autoprefixer?browsers=last 2 versions!' +
                    'sass?outputStyle=expanded&sourceMap=true&sourceMapContents=true'
                )
            },
            {test: /\.(png|woff|woff2|eot|ttf|svg)$/, loader: 'url-loader?limit=50000'}
        ]
    },
    resolve: {
        // add bower components, main source and flexcss framework (for internal resolves) to resolve requires
        root: [
            path.join(__dirname, "node_modules"),
            path.join(__dirname, 'assets'),
            path.join(__dirname, 'node_modules/flexcss/src/main')]
    },
    entry: {
        'App': ['js/index']
    },
    output: {
        path:__dirname + "/build",
        filename: '[name].js',
        libraryTarget: 'umd',
        library: '[name]',
        sourceMapFilename: '[name].map',
        chunkFilename: '[id].js'
    },
    plugins: [
        new webpack.EnvironmentPlugin(['NODE_ENV']),
        new ExtractTextPlugin('[name].css')
    ]
};

if ("production" === process.env.NODE_ENV) {
    module.exports.plugins.push(new webpack.optimize.UglifyJsPlugin());
}