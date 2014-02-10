
garden.controller('featureCtrl', ['$scope', '$http', '$location', function($scope, $http, $location) {
        var load = function() {
            $http.get('/feature/list')
                    .success(function(data) {
                $scope.features = data.features;
            });
        };

        load();

        $scope.deleteFeature = function(id) {
            $http.post('/feature/delete/' + id);
        };

        $scope.editFeature = function(id) {
            $http.post('/feature/edit/' + id).success(function(response) {
                $("#editform").html(response);
            });
        };

        $scope.hideCreate = true;
        $scope.openCreateFeature = function() {
            $scope.hideCreate = false;
        };

        $scope.newfeature = {"name": ""};
        $scope.submit = function() {
            $('.btn').hide();
            $http.post('feature/create', $scope.newfeature)
                    .success(function(result) {
                $scope.hideCreate = true;
                load();
            });
        };
    }]);