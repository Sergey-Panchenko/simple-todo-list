var mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js/all.js')
    .scripts([
        'resources/assets/js/libraries/jquery.min.js',
        'resources/assets/js/libraries/jquery-ui.min.js',
        'resources/assets/js/libraries/popper.min.js',
        'resources/assets/js/libraries/bootstrap.min.js',
        'resources/assets/js/libraries/vue.min.js',
    ], 'public/js/libraries.js').version();
