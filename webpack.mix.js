const mix = require('laravel-mix');
mix.browserSync({
    open: 'external',
    host: 'babbl.local',
    proxy: 'babbl.local'
});

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

mix.sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/welcome.scss', 'public/css')
   .sass('resources/sass/pages/home.scss', 'public/css/pages')
   .sass('resources/sass/pages/messenger.scss', 'public/css/pages')
   .sass('resources/sass/pages/new_group.scss', 'public/css/pages');

mix.js('resources/js/messenger.js', 'public/js')
   .js('resources/js/new_group.js', 'public/js')
   .js('resources/js/home.js', 'public/js');
