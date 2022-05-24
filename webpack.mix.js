const mix = require('laravel-mix');
const { bindAll } = require('lodash');

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
.scripts([ "node_modules/bootstrap/dist/js/bootstrap.bundle.js"],'public/js/bootstrap.js')
.scripts([ "node_modules/jquery/dist/jquery.js"],'public/js/jquery.js')
.scripts([ "node_modules/typed.js/lib/typed.js"],'public/js/typed.js')
.copy('node_modules/bootstrap/dist/css/bootstrap.css','public/css/bootstrap.css').copy('node_modules/animate.css/animate.min.css','public/css/animation.css');
// .copy('node_modules/@fortawesome/fontawesome-free/css/All.css','public/css/fontawsem.css');
