var garden = angular.module('gardenApp', ['ui.router']);

garden.config(['$urlRouterProvider', '$stateProvider', '$interpolateProvider',
    function($urlRouterProvider, $stateProvider, $interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

        $urlRouterProvider.otherwise('/');
        $stateProvider
//                .state('home', {
//            url: '/',
//            templateUrl: 'application/index',
//            controller: 'homeCtrl'
//        })
                .state('garden', {
            url: '/tuin',
            templateUrl: '/index/index',
            controller: 'gardenCtrl'
        })
                .state('createplant', {
            url: '/nieuwe-tuinplant',
            templateUrl: '/plant/create',
            controller: 'plantCtrl'
        })
                .state('editplant', {
            url: '/tuinplant-aanpassen',
            templateUrl: '/plant/create',
            controller: 'plantCtrl'
        })
                .state('features', {
            url: '/kenmerken',
            templateUrl: '/js/app/partials/garden/feature/list.twig',
            controller: 'featureCtrl'
        })
                .state('newfeature', {
            url: '/nieuw-kenmerk',
            templateUrl: '/feature/create',
            controller: 'featureCtrl'
        })
                .state('habitats', {
            url: '/groeiplaatsen',
            templateUrl: '/habitat/index',
            controller: 'habitatCtrl'
        })
                .state('newhabitat', {
            url: '/nieuwe-groeiplaats',
            templateUrl: '/habitat/create',
            controller: 'habitatCtrl'
        });
    }
]);
