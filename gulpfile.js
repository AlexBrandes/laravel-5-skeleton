var elixir = require('laravel-elixir');

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

 var paths = {
 	'resources': './resources/assets/',
    'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/',
    'jquery': './vendor/bower_components/jquery/',
    'jqueryUi': './vendor/bower_components/jquery-ui/',
    'fontAwesome': './vendor/bower_components/fontawesome/'
}

elixir(function(mix) {
		// css
    mix.styles([
    	paths.jqueryUi + 'themes/base/core.css',
    	paths.jqueryUi + 'themes/base/accordion.css',
    	paths.jqueryUi + 'themes/base/autocomplete.css',
    	paths.jqueryUi + 'themes/base/button.css',
    	paths.jqueryUi + 'themes/base/datepicker.css',
    	paths.jqueryUi + 'themes/base/dialog.css',
    	paths.jqueryUi + 'themes/base/draggable.css',
    	paths.jqueryUi + 'themes/base/menu.css',
    	paths.jqueryUi + 'themes/base/progressbar.css',
    	paths.jqueryUi + 'themes/base/resizable.css',
    	paths.jqueryUi + 'themes/base/selectable.css',
    	paths.jqueryUi + 'themes/base/selectmenu.css',
    	paths.jqueryUi + 'themes/base/sortable.css',
    	paths.jqueryUi + 'themes/base/slider.css',
    	paths.jqueryUi + 'themes/base/spinner.css',
    	paths.jqueryUi + 'themes/base/tabs.css',
    	paths.jqueryUi + 'themes/base/tooltip.css',
    	paths.jqueryUi + 'themes/base/theme.css',
    ], 'public/css/jqueryui/', './');


	// sass
    mix.sass("app.scss", 'public/css/', {includePaths: [paths.bootstrap + 'stylesheets/', paths.fontAwesome + 'scss/']});

    // js
    mix.scripts([
			paths.jquery + 'dist/jquery.js',
			paths.jqueryUi + 'jquery-ui.js',
			paths.bootstrap + 'javascripts/bootstrap.js',
            paths.resources + 'js/jquery.cookies.js',
            paths.resources + 'js/theme.js',
			paths.resources + 'js/app.js'
		], 'public/js/app.js', './');

	mix.version(['js/app.js', 'css/app.css']);

    // fonts (must go after version since it deletes build dir)
    mix
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/build/fonts')
        .copy(paths.fontAwesome + 'fonts/**', 'public/fonts')
        .copy(paths.fontAwesome + 'fonts/**', 'public/build/fonts');
});
