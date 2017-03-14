const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //app.scss includes app css, Boostrap and Ionicons
    mix.sass('app.scss')
        .less('./node_modules/admin-lte/build/less/AdminLTE.less', './public/css/adminlte-less.css')
        .less('adminlte-app.less')
        .less('./node_modules/toastr/toastr.less')
        .sass('stylo.scss')
        .styles([
            './public/css/app.css',
            './node_modules/admin-lte/dist/css/skins/_all-skins.css',
            './public/css/adminlte-less.css',
            './public/css/adminlte-app.css',
            './node_modules/icheck/skins/square/blue.css',
            './public/css/toastr.css',
            './public/css/stylo.css',
        ])

        .copy('node_modules/font-awesome/fonts/*.*','public/fonts/')
        .copy('node_modules/ionicons/dist/fonts/*.*','public/fonts/')
        .copy('node_modules/admin-lte/bootstrap/fonts/*.*','public/fonts/bootstrap')
        .copy('node_modules/admin-lte/dist/css/skins/*.*','public/css/skins')
        .copy('node_modules/admin-lte/dist/img','public/img')
        .copy('node_modules/admin-lte/plugins','public/plugins')
        .copy('node_modules/icheck/skins/square/blue.png','public/css')
        .copy('node_modules/icheck/skins/square/blue@2x.png','public/css')
        .copy('node_modules/trumbowyg/dist/**', 'public/plugins/trumbowyg')
        .copy('node_modules/select2/dist/**','public/plugins/select2')
        .copy('node_modules/select2-bootstrap-theme/dist/*.*', 'public/plugins/select2/css')
        .webpack('app.js');
});
