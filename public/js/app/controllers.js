garden.controller('featureCtrl', ['$scope', '$http', '$sce', 'featuresProvider', function($scope, $http, $sce, featuresProvider) {
        /*var load = function() {
         $http.get('/feature/list')
         .success(function(data) {
         $scope.features = data.features;
         });
         };*/
//        featureLoader.get().then(function(data) {
//            $scope.features = data;
//            console.log($scope.features);
//        });

        var load = function() {
            featuresProvider.get().then(function(response) {
                console.log(response);
                $scope.features = response.data;
            });
        };

        load();

        $scope.deleteFeature = function(id) {
            $http.post('/feature/delete/' + id);
        };

        $scope.editFeature = function(id) {
            alert("edit");
            $http.post('/feature/edit/' + id).success(function(response) {
                $scope.editform = $sce.trustAsHtml(response);
            });
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

        // id?
        $scope.submitUpdate = function() {
            alert("update");
            /* $http.post('/feature/edit').success(function() {
             $scope.hideCreate = true;
             load();
             });*/
        };
    }]);