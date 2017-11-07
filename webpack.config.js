let webpack = require('webpack');
let path = require('path');

module.exports = {
	// This is the "main" file which should include all other modules
	entry: './assets/src/tickets.js',
	// Where should the compiled file go?
	output: {
		path: path.resolve( __dirname, './assets/js' ),

		filename: 'build-tickets.js'
	},

	module: {
		rules: [
			{
				test: /\.js$/,
				use: 'babel-loader',
				exclude: /node_modules/
			},
			{
				test: /\.vue$/,
				use: 'vue-loader'
			}
		]
	},

    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        }
    }

}