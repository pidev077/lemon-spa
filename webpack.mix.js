const mix = require('laravel-mix');
mix.setPublicPath('dist');
mix.setResourceRoot('../');
mix.autoload({
   jquery: ['$', 'jQuery', 'window.jQuery']
});
mix.copyDirectory('resources/assets/images', 'dist/images');
mix.js('resources/assets/js/theme.js', 'dist/js')
   .sass('resources/assets/scss/theme.scss', 'dist/css')
   .extract()
   .version();