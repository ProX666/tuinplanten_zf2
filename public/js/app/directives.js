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

garden.directive("clickToEdit", ['$http', function($http) {

    return {
        restrict: "A",
        replace: true,
        templateUrl: '/js/app/partials/garden/feature/edit.twig',
        scope: {
            value: "=clickToEdit"
        },
        controller: function($scope) {
            $scope.view = {
                editableValue: $scope.value.name,
                editorEnabled: false
            };

            $scope.enableEditor = function() {
                $scope.view.editorEnabled = true;
                $scope.view.editableValue = $scope.value.name;
            };

            $scope.disableEditor = function() {
                $scope.view.editorEnabled = false;
            };

            $scope.save = function() {
                name = $scope.view.editableValue;

                $scope.updatefeature = {
                    "name": name,
                    "id": $scope.value.id
                };

                $http.post('/feature/update', $scope.updatefeature)
                        .success(function() {
                    $scope.value.name = $scope.updatefeature.name;
                    $scope.disableEditor();
                });
            };
        }
    };
}]);
