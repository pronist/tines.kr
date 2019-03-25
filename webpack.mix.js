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
const Dotenv = require('dotenv-webpack');

mix.copy('resources/static/', 'public/');
mix.browserSync({
    proxy: 'http://homestead.test',
    port: 80,
    // Don't show any notifications in the browser.
    notify: false
});
mix.webpackConfig({
    resolve: {
        //...
        symlinks: false
    },
    plugins: [
        new Dotenv({
            path: process.env.NODE_ENV == 'production' 
                ? './.env.example'
                : './.env'
        })
    ],
});
mix.js('resources/js/app.js', 'public/js')
   .stylus('resources/styl/app.styl', 'public/css')
;