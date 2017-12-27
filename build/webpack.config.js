const webpack = require('webpack');
const merge = require('webpack-merge');
const path = require('path');
const jsonImporter = require('node-sass-json-importer');
const CleanPlugin = require('clean-webpack-plugin');
const CopyGlobsPlugin = require('copy-globs-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');

const config = require('./utils/config');

const assetsFilenames = (config.enabled.cacheBusting) ? config.cacheBusting : '[name]';

let webpackConfig = {
  context: config.paths.assets,
  entry: config.entry,
  output: {
    path: config.paths.dist,
    publicPath: config.publicPath,
    filename: `scripts/${assetsFilenames}.js`
  },
  devtool: (config.enabled.sourceMaps ? '#source-map' : undefined),
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.(js|s?[ca]ss)$/,
        include: config.paths.assets,
        use: 'import-glob'
      },
      { test: /\.js$/,
        exclude: [/(node_modules)(?![/|\\](bootstrap|foundation-sites))/],
        use: [
          { loader: 'cache' },
          { loader: 'buble', options: { objectAssign: 'Object.assign' } },
        ]
      },
      {
        test: /\.css$/,
        include: config.paths.assets,
        use: ExtractTextPlugin.extract({
          fallback: 'style',
          use: [
            { loader: 'cache' },
            { loader: 'css', options: { sourceMap: config.enabled.sourceMaps } },
            {
              loader: 'postcss', options: {
                config: { path: __dirname, ctx: config },
                sourceMap: config.enabled.sourceMaps,
              },
            },
          ],
        }),
      },
      { test: /\.scss$/,
        include: config.paths.assets,
        use: ExtractTextPlugin.extract({
          fallback: 'style',
          use: [
            { loader: 'cache' },
            { loader: 'css', options: { sourceMap: config.enabled.sourceMaps } },
            {
              loader: 'postcss', options: {
                config: { path: __dirname, ctx: config },
                sourceMap: config.enabled.sourceMaps
              }
            },
            { loader: 'resolve-url', options: { sourceMap: config.enabled.sourceMaps } },
            { loader: 'sass', options: {
                importer: jsonImporter,
                sourceMap: config.enabled.sourceMaps
              }
            },
          ]
        })
      },
      {
        test: /\.(ttf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
        include: config.paths.assets,
        loader: 'url',
        options: {
          limit: 4096,
          name: `[path]${assetsFilenames}.[ext]`
        }
      },
      {
        test: /\.(ttf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
        include: /node_modules/,
        loader: 'url',
        options: {
          limit: 4096,
          outputPath: 'vendor/',
          name: `${config.cacheBusting}.[ext]`
        }
      }
    ]
  },
  resolve: {
    alias: {
      "assets": path.resolve(__dirname, '../assets'),
      "styles": path.resolve(__dirname, '../assets/styles'),
      "scripts": path.resolve(__dirname, '../assets/scripts'),
      "images": path.resolve(__dirname, '../assets/images'),
      "fonts": path.resolve(__dirname, '../assets/fonts')
    },
    modules: [
      config.paths.assets,
      'node_modules'
    ],
    enforceExtension: false
  },
  resolveLoader: {
    moduleExtensions: ['-loader']
  },
  externals: {
    jquery: 'jQuery'
  },
  stats: {
    hash: false,
    version: false,
    timings: false,
    children: false,
    errors: false,
    errorDetails: false,
    warnings: false,
    chunks: false,
    modules: false,
    reasons: false,
    source: false,
    publicPath: false
  },
  plugins: [
    new CleanPlugin([config.paths.dist], {
      root: config.paths.root,
      verbose: false
    }),
    new CopyGlobsPlugin({
      pattern: config.copy,
      output: `[path]${assetsFilenames}.[ext]`,
      manifest: config.manifest
    }),
    new ExtractTextPlugin({
      filename: `styles/${assetsFilenames}.css`,
      allChunks: true,
      disable: (config.enabled.watcher),
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      Popper: 'popper.js/dist/umd/popper.js',
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: config.enabled.optimize,
      debug: config.enabled.watcher,
      stats: { colors: true }
    }),
    new webpack.LoaderOptionsPlugin({
      test: /\.s?css$/,
      options: {
        output: { path: config.paths.dist },
        context: config.paths.assets,
      }
    }),
    new webpack.LoaderOptionsPlugin({
      test: /\.js$/,
      options: {
        eslint: { failOnWarning: false, failOnError: true }
      }
    }),
    new FriendlyErrorsWebpackPlugin()
  ],
};

/*
if (config.enabled.optimize) {
  webpackConfig = merge(webpackConfig, require('./webpack.config.optimize'));
}
*/

if (config.env.production) {
  webpackConfig.plugins.push(new webpack.NoEmitOnErrorsPlugin());
}

if (config.enabled.cacheBusting) {
  const WebpackAssetsManifest = require('webpack-assets-manifest');

  webpackConfig.plugins.push(
    new WebpackAssetsManifest({
      output: 'assets.json',
      space: 2,
      writeToDisk: false,
      assets: config.manifest,
      replace: require('./utils/assetManifestsFormatter')
    })
  );
}

if (config.enabled.watcher) {
  webpackConfig.entry = require('./utils/addHotMiddleware')(webpackConfig.entry);
  webpackConfig = merge(webpackConfig, require('./webpack.config.watch'));
}

module.exports = webpackConfig;
