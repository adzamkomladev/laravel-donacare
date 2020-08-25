const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/vendor/custom.js", "public/js/custom.js")
    .sass("resources/sass/app.scss", "public/css")
    .styles(
        [
            "resources/css/themify-icons.css",
            "resources/css/flaticon.css",
            "resources/css/style.css"
        ],
        "public/css/landing.css"
    )
    .copyDirectory("resources/img", "public/img");
