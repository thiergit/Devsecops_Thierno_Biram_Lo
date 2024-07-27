const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/bootstrap.js', 'public/js') // Assurez-vous d'inclure bootstrap.js ici si nécessaire
   .sass('resources/sass/app.scss', 'public/css');
