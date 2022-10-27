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

mix.autoload({
    jquery: ['$', 'jQuery', 'window.jQuery']
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()

// Copy plugin files to public folder
mix.copyDirectory(['node_modules/datatables.net/js/jquery.dataTables.js', 'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'], 'public/assets/plugins/datatables-net')
    .copyDirectory('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js', 'public/assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js')
    .copyDirectory('node_modules/bootstrap-datepicker/dist', 'public/assets/plugins/bootstrap-datepicker')
    .copyDirectory(['node_modules/select2/dist/js/select2.min.js', 'node_modules/select2/dist/css/select2.min.css'], 'public/assets/plugins/select2')
    .copyDirectory(['node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'], 'public/assets/plugins/bootstrap-datepicker')
    .copyDirectory('node_modules/font-awesome', 'public/assets/plugins/font-awesome')
    .copyDirectory(['node_modules/perfect-scrollbar/dist', 'node_modules/perfect-scrollbar/css'], 'public/assets/plugins/perfect-scrollbar')
