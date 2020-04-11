const mix = require('laravel-mix');

const tailwindcss = require('tailwindcss');
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
const domain = 'icanmart.test';
const homedir = require('os').homedir();

mix
    .setPublicPath('public')
    .js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css')
    .browserSync({
        // proxy: 'https://'+ domain,
        proxy: domain,
        host: domain,
        open: 'external',
        // https: {
        //    key: homedir + '/.valet/Certificates/'+domain+'.key',
        //    cert: homedir + '/.valet/Certificates/'+domain+'.crt',
        // },
        files: [
            'resources/**/*',
        ],
    })
    .options({
        processCssUrls: false,
        postCss: [
            tailwindcss('./tailwind.config.js'),
        ],
    });
