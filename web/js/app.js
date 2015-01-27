define([
    'angular',
    './controllers/index',
    './directives/index',
    './filters/index',
    './services/index',
    'ngRoute',
    'ngBootstrap',
    'ngAnimate',
    'ngCharts',
    'units/javascript',
], function(ng) {
    'use strict';

    //Load ng
    return ng.module('app', [
        'app.services',
        'app.controllers',
        'app.filters',
        'app.directives',
        'ngRoute',
        'ngAnimate'
    ]);
});