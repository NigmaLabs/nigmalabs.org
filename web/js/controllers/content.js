define(['./module'], function(controllers) {
    'use strict';

    controllers.controller('content', ['$scope', '$http', '$location', '$sce', '$routeParams', function($scope, $http, $location, $sce, $routeParams) {
            var pageName, errorContent;
            errorContent = $sce.trustAsHtml("<h1>Strona nie istnieje.</h1>\n\
                 Prosimy spróbować później lub skontaktować się z\n\
                 administratorami serwisu.");
            pageName = $routeParams.pageName ? $routeParams.pageName : '/';
            $http({method: 'GET', url: pageName}).
                    success(function(data, status, headers, config) {
                        var $content, title, $parsed, trustAsHtml;
                        $parsed = $('<div/>').append(data);
                        $content = $parsed.find("#content");
                        if ($content.size() == 1) {
                            title = $parsed.find("title").text();
                            if (title) {
                                document.title = title;
                            }
                            trustAsHtml = $sce.trustAsHtml($content.html());
                            $scope.content = trustAsHtml;
                        } else {
                            $scope.content = errorContent;
                        }
                    }).
                    error(function(data, status, headers, config) {
                        console.log("error when load site");
                        $scope.content = errorContent;
                    });
        }]);
});