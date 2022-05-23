const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css/app.css')
.scripts([ "node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"],'public/js/bootstrap.js')
.scripts([ "node_modules/jquery/dist/jquery.js"],'public/js/jquery.js')
.copy('node_modules/bootstrap/dist/css/bootstrap.min.css','public/css/bootstrap.css').copy('node_modules/animate.css/animate.min.css','public/css/animation.css');

