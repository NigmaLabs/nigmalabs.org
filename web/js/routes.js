define(['./app'], function(app) {
    'use strict';
    return app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
            
            /*$routeProvider.when('/', {
                templateUrl: 'partials/deklaracja.html'
            });
            
            $routeProvider.when('/o-nas', {
                templateUrl: 'partials/o-nas.html'
            });*/

            $routeProvider.when('/historia', {
                templateUrl: 'partials/historia.html'
            });

            $routeProvider.when('/statut', {
                templateUrl: 'partials/statut.html'
            });

            $routeProvider.when('/deklaracja', {
                templateUrl: 'partials/deklaracja.html'
            });

            $routeProvider.when('/zarzad', {
                templateUrl: 'partials/zarzad.html'
            });

            $routeProvider.when('/finanse', {
                templateUrl: 'partials/finanse.html',
                controller: 'finance'
            });

            $routeProvider.when('/FAQ', {
                templateUrl: 'partials/FAQ.html'
            });

            $routeProvider.when('/:pageName', {
                template: '<div ng-bind-html="content"></div>',
                controller: 'content'
            });

            $routeProvider.when('/', {
                template: '<div ng-bind-html="content"></div>',
                controller: 'content'
            });

            $routeProvider.otherwise({
                redirectTo: '/'
            });

            // use the HTML5 History API
            $locationProvider.html5Mode(true);
        }]);
});