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
  .sass('resources/sass/app.scss', 'public/css')
  .sourceMaps(true, 'source-map')
  // .webpackConfig({ devtool: 'source-map' })
  .browserSync({
    proxy: '127.0.0.1:8000',
    port: 3100,
    ghostMode: false,
    notify: false
  });


// Copy plugin files to public folder
mix.copyDirectory('node_modules/feather-icons/dist', 'public/assets/plugins/feather-icons')
  .copyDirectory('node_modules/flag-icon-css', 'public/assets/plugins/flag-icon-css')
  .copyDirectory(['node_modules/perfect-scrollbar/dist', 'node_modules/perfect-scrollbar/css'] , 
    'public/assets/plugins/perfect-scrollbar')
  .copyDirectory('node_modules/owl.carousel/dist', 'public/assets/plugins/owl-carousel')
  .copyDirectory('node_modules/jquery-mousewheel/jquery.mousewheel.js', 'public/assets/plugins/jquery-mousewheel/jquery.mousewheel.js')
  .copyDirectory('node_modules/jquery.flot', 'public/assets/plugins')
  .copyDirectory('node_modules/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js', 'public/assets/plugins/jquery-flot-tooltip/jquery.flot.tooltip.min.js')
  .copyDirectory('node_modules/jquery-sparkline/jquery.sparkline.min.js', 'public/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')

  .copyDirectory(['node_modules/datatables.net/js/jquery.dataTables.js', 'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css'] , 
    'public/assets/plugins/datatables-net')
  .copyDirectory('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js', 'public/assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js')

  .copyDirectory('node_modules/bootstrap-datepicker/dist', 'public/assets/plugins/bootstrap-datepicker')
  .copyDirectory('node_modules/progressbar.js/dist/progressbar.min.js', 'public/assets/plugins/progressbar-js/progressbar.min.js')
  // .copyDirectory('node_modules/select2/dist', 'public/assets/plugins/select2')
  .copyDirectory(['node_modules/select2/dist/js/select2.min.js', 'node_modules/select2/dist/css/select2.min.css'] , 
    'public/assets/plugins/select2')
  .copyDirectory('node_modules/jquery-tags-input/dist', 'public/assets/plugins/jquery-tags-input')
  .copyDirectory('node_modules/dropify/dist', 'public/assets/plugins/dropify')
  .copyDirectory(['node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'] , 
    'public/assets/plugins/bootstrap-datepicker')
  .copyDirectory('node_modules/jquery-validation/dist/jquery.validate.min.js', 'public/assets/plugins/jquery-validation/jquery.validate.min.js')
  .copyDirectory(['node_modules/jquery-steps/build/jquery.steps.min.js', 'node_modules/jquery-steps/demo/css/jquery.steps.css'] , 
    'public/assets/plugins/jquery-steps')

  .copyDirectory('node_modules/font-awesome', 'public/assets/plugins/font-awesome')

  .copyDirectory('node_modules/jquery-ui-dist/jquery-ui.min.js', 'public/assets/plugins/jquery-ui-dist/jquery-ui.min.js')
