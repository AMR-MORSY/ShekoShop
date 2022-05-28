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
    // .sass('node_modules/swiper/swiper-vars.scss', 'public/css/app.css')
    // .sass('node_modules/swiper/swiper.scss', 'public/css/app.css')
    .scripts(["node_modules/bootstrap/dist/js/bootstrap.bundle.js"], 'public/js/bootstrap.js')
    .scripts(["node_modules/jquery/dist/jquery.js"], 'public/js/jquery.js')
    .scripts(["node_modules/swiper/swiper-bundle.min.js"], 'public/js/swiper.js')
    .copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/bootstrap.css').copy('node_modules/swiper/swiper-bundle.css', 'public/css/swiper.css');
// .copy('node_modules/@fortawesome/fontawesome-free/css/All.css','public/css/fontawsem.css');
