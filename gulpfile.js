var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass([//all the files in this array are what gets compiled, don't forget to update it!
              'landingpage.scss',
              'loginandregistration.scss',
              'green-header.scss',
              'global_styles.scss',
              'footer.scss',
              'profile.scss',
              'catalog.scss',
              'product.scss',
              'cart.scss'
             ],
              'public/css/app.css'//this is the file all the SCSS in the array above is compiled into.
            );//just plop in the names of our CSS files here!
});
