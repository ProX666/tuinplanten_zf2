garden.directive('pleasewait', ['$rootScope', function($rootScope) {

        return {
            restrict: 'A',
            replace: true,
            scope: {pleasewait: '='},
            link: function(scope, element, attrs) {
                element.addClass('hide');

                $rootScope.$on('$locationChangeStart', function() {
                    element.removeClass('hide');
                });

                $rootScope.$on('$locationChangeSuccess', function() {
                    element.addClass('hide');
                });
            }
        };
    }]);