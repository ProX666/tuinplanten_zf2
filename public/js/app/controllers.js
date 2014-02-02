
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
//            $location.path('/feature/edit/' + id);
            $http.post('/feature/edit/' + id).success(function(response) {
                console.log(response);
                $("#editform").html(response);
            });
        };

        $scope.createFeature = function() {
            console.log('call addAlbum');
            $location.path("/feature/create");
        };
    }]);