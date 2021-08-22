const mix = require('laravel-mix');
const path = require('path');

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
    .vue({
        runtimeOnly: true,
        version: 3,
        "extractStyles": false
    })
    .webpackConfig((webpack) => {
        return {
            output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
            resolve: {
                alias: {
                    '@' : path.resolve('resources/js/Pages'),
                }
            },
            plugins: [
                new webpack.DefinePlugin({
                    __VUE_OPTIONS_API__: true,
                    __VUE_PROD_DEVTOOLS__: true,
                }),
            ]
        };
    })
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('tailwindcss/nesting'),
        require('postcss-nested'),
        require('autoprefixer'),
    ])
    .version()
    .sourceMaps();
    //.browserSync('araba-temizle.test');
