const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const defaultConfig = require("@wordpress/scripts/config/webpack.config");

const lessLoaders = [MiniCSSExtractPlugin.loader, "css-loader", "less-loader"];

const entryPoint = {
  style: "./resources/assets/less/style.less",
};

module.exports = {
  ...defaultConfig,
  entry: {
    ...defaultConfig.entry(),
    ...entryPoint,
  },
  module: {
    ...defaultConfig.module,
    rules: [
      ...defaultConfig.module.rules,
      {
        test: /\.less$/,
        use: lessLoaders,
      },
    ],
  },
  plugins: [...defaultConfig.plugins, new MiniCSSExtractPlugin()],
};
