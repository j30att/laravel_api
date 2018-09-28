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
            template: require('./views/dashboard/dashboard.template.html'),
            resource: 'dashboard'
        })
        .state('ngbids', {
                url: '/ngbids',
                template: require('./views/bids/index.template.html'),
                resource: 'ngbids',
                //middleware: 'admin'
        })

    ;


    $urlRouterProvider.otherwise(function($injector, $location){
        let state = $injector.get('$state');
        state.go('404');
        return $location.path();
    });
}