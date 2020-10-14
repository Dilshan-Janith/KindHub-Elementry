const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.styles([
    'public/plugins/css/bootstrap.min.css',
    'public/plugins/css/icons.min.css',
    'public/plugins/css/app.min.css'
], 'plugins/css/all.css');
mix.scripts([
    'public/plugins/js/vendor.min.js',
    'public/plugins/libs/jquery-knob/jquery.knob.min.js',
    'public/plugins/libs/morris-js/morris.min.js',
    'public/plugins/libs/raphael/raphael.min.js',
    'public/plugins/js/pages/dashboard.init.js',
    'public/plugins/js/app.min.js'
], 'plugins/js/all.js');
