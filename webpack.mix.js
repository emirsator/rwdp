const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
//    .styles('node_modules/orgchart/dist/css/jquery.orgchart.min.css', 'public/css/orgchart.css')
   .styles([
    'resources/assets/css/logo/nav.css',
    'resources/assets/css/main.css',
    'resources/assets/css/modal.css',
    'resources/assets/css/table.css',
    'resources/assets/css/tabs.css',
    'resources/assets/css/layout.css'
    ], 'public/css/all.css');

