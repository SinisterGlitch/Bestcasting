module.exports = {
    entry: './application/main.jsx',
    output: {
        path: __dirname + '/../web/',
        filename: 'js/app.js',
        devtoolModuleFilenameTemplate: '../ui/[resource-path]'
    },
    module: {
        loaders: [{
            test: /\.css$/,
            loader: "style-loader!css-loader"
        }, {
            test: /\.jsx?$/,
            exclude: /(node_modules)/,
            loader: 'babel-loader',
            plugins: ["import", {
                    libraryName: "antd",
                    libraryDirectory: "lib",
                    style: 'css'
                }
            ]
        }]
    },
    resolve: {
        modulesDirectories: ['node_modules', 'application'],
        extensions: ['', '.js', '.jsx', '.json', '.css']
    }
};