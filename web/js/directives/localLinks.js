define(['./module', 'jquery'], function(module, $) {
    'use strict';
    module.directive('localLinks', ['$location', function($location) {
            function link($scope, element, attrs) {
                $(element).on("click", "a", function(e) {
                    var url, $this;
                    $this = $(this);
                    url = $this.attr("href");
                    if (url.startsWith("/resources/")) {
                        //redirect to recource
                        window.location.href = url;
                    }
                    if (url.startsWith("/")) {
                        //ng route
                        e.preventDefault();
                        $location.path(url);
                        $scope.$apply();
                    }
                });
            }
            return {
                link: link
            };
        }]);
});