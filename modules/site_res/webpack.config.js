module.exports = [
    {
      entry: './src/index.js',
      output: {
        libraryTarget: 'umd',
        library: 'page',
        filename: 'index.min.js'
      },
      module : {
        rules: [
            { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" },
            { test: /\.css$/i, use: ['bundle-loader', 'css-loader'] },
            { test: /\.s[ac]ss$/i, use: ['bundle-loader', 'css-loader', 'sass-loader'] }
        ]
      },
      optimization: { minimize: true },
      mode: 'production'
    },
    {
        entry: './src/index.js',
        output: {
            libraryTarget: 'umd',
            library: 'page',
            filename: 'index.js'
        },
        module : {
            rules: [
                { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" },
                { test: /\.css$/i, use: ['bundle-loader', 'css-loader'] },
                { test: /\.s[ac]ss$/i, use: ['bundle-loader', 'css-loader', 'sass-loader'] }
            ]
        },
        optimization: { minimize: false },
        mode: 'production'
    }
]
