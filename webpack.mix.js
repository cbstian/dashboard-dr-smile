const mix = require('laravel-mix');

mix.scripts(['resources/js/app.js'], 'public/js/app.js')
    .scripts(['resources/js/form.js'], 'public/js/form.js')
    .scripts(['resources/js/dashboard.js'], 'public/js/dashboard.js')

    .styles([
        'node_modules/daterangepicker/daterangepicker.css'
    ], 'public/css/daterangepicker.css')

    .styles([
        'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css'
    ], 'public/css/bootstrap-datepicker3.css')

    .scripts([
        'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
        'node_modules/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js'
    ], 'public/js/bootstrap-datepicker3.js')

    .scripts([
        'node_modules/daterangepicker/moment.min.js',
        'node_modules/daterangepicker/daterangepicker.js'
    ], 'public/js/core.js')

    .scripts([
        'node_modules/daterangepicker/moment.min.js',
        'node_modules/daterangepicker/daterangepicker.js'
    ], 'public/js/daterangepicker.js')

    /** SELECT2 */
    .styles([
        'node_modules/select2/dist/css/select2.css'
    ], 'public/css/select2.css')
    .scripts([
        'node_modules/select2/dist/js/select2.js',
		'node_modules/select2/dist/js/i18n/es.js'
    ], 'public/js/select2.js')

    /** FRONTEND */
    .styles([
        'node_modules/@fortawesome/fontawesome-free/css/all.css',
        'node_modules/bootstrap/dist/css/bootstrap.css'
    ], 'public/css/landing/core.css')

    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js'
    ], 'public/js/landing/core.js')

    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts')

    .less('resources/less/landing.less', 'public/css/landing')
    .scripts(['resources/js/landing.js'], 'public/js/landing/landing.js')
    /** FRONTEND */

if (mix.inProduction()) {
    mix.version();
}
