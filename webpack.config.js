module.exports = {
    // context: __dirname,
	entry:{
		grid:"./src/grid/grid.tsx",
	},
	devtool: "source-map",
	output:{
		filename:"./dist/[name].js"
	},
	resolve:{
		modules: ['node_modules'],
		extensions: ['.webpack.js', '.web.js', '.ts', '.tsx', '.js', '.css', '.html']
	},
	module:{
        rules: [
        	{
				test:/\.css$/,
				use:[
					{loader: "style-loader"},
					{loader: "css-loader"}
				]
			},
			{
				test: /\.html$/,
				use:[
					{loader : "file-loader",
					options:{
						name:"dist/[name].[ext]"
					}}

				]
			},
			{
				test:/\.png$/,
				use:[
					{loader:"url-loader"}
				]
			},
            {
                test:/\.ts$/,
                use:[
                    {loader:"awesome-typescript-loader"}
                ]
            },
            {
                test:/\.tsx$/,
                use:[
                    {loader:"awesome-typescript-loader"}
                ]
            }
		]
	}
}