const mix = require('laravel-mix');


mix.js('resources/js/ShopVue.js', 'public/js/ShopVue.js')
   .sass('resources/sass/app.scss', 'public/css');
