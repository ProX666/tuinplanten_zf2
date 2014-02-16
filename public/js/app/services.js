garden.factory('featuresProvider', ['$http', function($http) {
        return {
            get: function() {
                return $http.get('/feature/list');
            }
        };
    }]);
