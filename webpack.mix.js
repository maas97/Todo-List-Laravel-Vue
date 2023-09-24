let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue().sass('resources/sass/app.scss', 'public/css', []);

resolve: {
    extensions: ['*', '.wasm', '.mjs', '.js', '.jsx', '.json', '.vue']
  }
  
