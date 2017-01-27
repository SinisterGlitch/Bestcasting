var webpack = require("webpack");

module.exports = {
    entry: {
        app: './application/main.jsx',
        vendor: [
            "react",
            "react-addons-linked-state-mixin",
            "react-bootstrap",
            "react-dom",
            "react-router",
            "react-router-bootstrap",
            "react-tap-event-plugin",
            "reflux",
            "superagent",
            "history",
            "lodash"
        ]
    },
    output: {
        path: __dirname + '/../web/',
        filename: 'js/app.js',
        library: "React",
        devtoolModuleFilenameTemplate: '../ui/[resource-path]'
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin("vendor", "js/vendor.js"),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.UglifyJsPlugin(),
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: JSON.stringify('production')
            }
        })
    ],
    module: {
        loaders: [{
            test: /\.jsx?$/,
            exclude: /(node_modules)/,
            loader: 'babel-loader'
        }]
    },
    resolve: {
        modulesDirectories: ['node_modules', 'application'],
        extensions: ['', '.js', '.jsx', '.json']
    }
};