let mix = require('laravel-mix');

mix.js('public/frontend/src/js/apps.js', 'public/frontend/dist/script').sass('public/frontend/src/scss/apps.scss', 'public/frontend/dist/style');