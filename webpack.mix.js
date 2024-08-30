let mix = require("laravel-mix");
const AutoImport = require("unplugin-auto-import/webpack").default;
const Components = require("unplugin-vue-components/webpack").default;
const { ElementPlusResolver } = require("unplugin-vue-components/resolvers");
const path = require("path");

// Webpack configuration
mix.webpackConfig({
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: "vue-loader",
      },
      {
        test: /\.js$/,
        loader: "babel-loader",
        exclude: /node_modules/,
      },
      {
        test: /\.css$/,
        use: ["vue-style-loader", "css-loader"],
      },
      {
        test: /\.scss$/,
        use: ["vue-style-loader", "css-loader", "sass-loader"],
      },
    ],
  },
  plugins: [
    AutoImport({
      resolvers: [ElementPlusResolver()],
    }),
    Components({
      resolvers: [ElementPlusResolver()],
    }),
  ],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "src"),
    },
    extensions: [".js", ".vue", ".json"],
  },
});

// Mix Asset Management
mix.js("src/main.js", "assets/js/admin_app").vue({ version: 3 });
