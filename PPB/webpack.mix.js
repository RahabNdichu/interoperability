const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.webpackConfig({
  output: { chunkFilename: 'js/chunks/[name].js?id=[chunkhash]' },
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': __dirname + '/resources/js',
      '@pages': __dirname + '/resources/js/pages',
      '@components': __dirname + '/resources/js/components',
      '@cruds': __dirname + '/resources/js/cruds'
    }
  }
})

// Admin App
mix
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')

if (mix.inProduction()) {
  mix.version()
}
