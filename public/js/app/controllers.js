garden.controller('featureCtrl', ['$scope', '$http', '$sce', 'featuresProvider', function($scope, $http, $sce, featuresProvider) {

        var load = function() {
            featuresProvider.get().then(function(response) {
                $scope.features = response.data;
            });
        };

        load();

        $scope.deleteFeature = function(id) {
            $http.post('/feature/delete/' + id);
        };

        $scope.hideCreate = true;
        $scope.openCreateFeature = function() {
            $scope.hideCreate = false;
        };

        $scope.newfeature = {"name": ""};
        $scope.submitNew = function() {
            $http.post('/feature/create', $scope.newfeature)
                    .success(function() {
                $scope.hideCreate = true;
                load();
            });
        };

    }]);