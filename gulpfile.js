var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss')
       .scripts([
           '../../../node_modules/jquery/dist/jquery.js',
           '../../../node_modules/vue/dist/vue.js',
           '../../../node_modules/bootstrap/dist/js/bootstrap.js',
           'app.js'
       ], './public/js/app.js');
});
