require.config({
    // alias libraries paths
    paths: {
        'domReady': '../vendors/requirejs-domready/domReady',
        'jquery': '../vendors/jquery/dist/jquery',
        'bootstrap': '../vendors/bootstrap-sass/dist/js/bootstrap',
        'd3': '../vendors/d3/d3',
        'ngBootstrap': '../vendors/angular-bootstrap/ui-bootstrap',
        'ngBootstrapColorpicker': '../vendors/angular-bootstrap-colorpicker/js/bootstrap-colorpicker-module',
        'angular': '../vendors/angular/angular',
        'ngRoute': '../vendors/angular-route/angular-route',
        'ngAnimate': '../vendors/angular-animate/angular-animate',
        'ngCharts': '../vendors/angular-charts/dist/angular-charts',
        'ngWysiwyg': '../vendors/angular-wysiwyg/angular-wysiwyg.js'
    },
    // angular does not support AMD out of the box, put it in a shim
    shim: {
        'angular': {
            exports: 'angular'
        },
        'jquery': {
            exports: 'jquery'
        },
        'd3': {
            exports: 'd3'
        },
        'bootstrap': {
            deps: ['jquery']
        },
        'ngBootstrap': {
            deps: ['bootstrap']
        },
        'ngBootstrapColorpicker': {
            deps: ['ngBootstrap']
        },
        'ngRoute': {
            exports: 'ngRoute',
            deps: ['angular']
        },
        'ngAnimate': {
            deps: ['angular']
        },
        'ngCharts': {
            deps: ['angular','d3']
        },
        'ngWysiwyg': {
            deps: ['angular','ngBootstrapColorpicker']
        }
    },
    // kick start application
    deps: ['./app-bootstrap']
});