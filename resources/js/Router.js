routes.$inject = [
    '$locationProvider',
    '$stateProvider',
    '$urlRouterProvider'
];

export default function routes($locationProvider, $stateProvider, $urlRouterProvider) {
    $locationProvider.html5Mode({enabled:true, requireBase: false});

    $urlRouterProvider.rule(function($injector, $location) {
        let path = $location.path();
        if (path !== '/' && path.slice(-1) === '/') {
            $location.replace().path(path.slice(0, -1));
        }
    });


    $stateProvider
        .state('index', {
            url: '/',
            template: require('./views/main.template.html'),
        })
        .state('events', {
            url: '/events',
            template: require('./views/events/index.template.html'),
            controller: 'EventsController',
            controllerAs: 'EvntsCtrl',
        })

    ;


    $urlRouterProvider.otherwise(function($injector, $location){
        let state = $injector.get('$state');
        state.go('404');
        return $location.path();
    });
}