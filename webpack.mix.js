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

mix.webpackConfig(
    {
        resolve: {
            fallback: {
                fs: false
            }
        }
    }
);


mix.js('resources/js/desktop/app.js', 'public/js/desktop')
    .sass('resources/sass/desktop/app.scss', 'public/css/desktop')
    .copyDirectory('resources/sass/images', 'public/images');



if (mix.inProduction()) {
    mix.version();
}
