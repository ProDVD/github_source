let mix = require('laravel-mix');
mix.options({
    notify: false
});
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

const config = {
    proxy: 'webserver3',
    tunnel: false,
    host: "localhost",
    port: 9000,
    logPrefix: "Vue-Laravel-Tasks",
    notify: false
};

mix.disableNotifications();
mix.browserSync(config);

