module.exports = {
    context: __dirname,
	entry:{
		//liste des fichiers d'entrées
		//exemple 1 chat="./src/chat.js"
		application:"./src/pdf.tsx"
	},
	devtool: "source-map",
	output:{
		/*exemple 1 
		path:"dist",
		filename:"[name].bind.js" OU SINON "[hash].bind.js"
		*/
		filename:"dist/pdf.js"
	},
    resolve: {
        modules: [
            "node_modules"
        ],      
        extensions: [ 
            ".webpack.js", 
            ".web.js", 
            ".ts", 
            ".tsx", 
            ".js", 
            ".css", 
            ".html"
        ]
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
                test:/\.ts/,
                use:[
                    {loader:"awesome-typescript-loader"}
                ]
            },
            {
                test:/\.tsx/,
                use:[
                    {loader:"awesome-typescript-loader"}
                ]
            }
		]
	}
	/*exemple 1
	"cheap-source-map" -> numéro ligne
	"none" -> pas de source map
	 */
}