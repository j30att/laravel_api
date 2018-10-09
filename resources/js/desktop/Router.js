routes.$inject = [
    '$locationProvider',
    '$stateProvider',
    '$urlRouterProvider'
];

export default function routes($locationProvider, $stateProvider, $urlRouterProvider) {
    $locationProvider.html5Mode({enabled: true, requireBase: false});

    $urlRouterProvider.rule(function ($injector, $location) {
        let path = $location.path();
        if (path !== '/' && path.slice(-1) === '/') {
            $location.replace().path(path.slice(0, -1));
        }
    });

    $stateProvider
        .state('index', {
            url: '/',
            template: require('./views/main.template.html'),
            data: {
                permissions: {
                    except: 'Auth',
                    redirectTo: () => {
                        return {
                            state: 'invest'
                        }
                    }
                }
            }
        })
        .state('invest', {
            url: '/invest',
            template: require('./views/invest/index.template.html'),
            controller: 'InvestController',
            controllerAs: 'InvestCtrl'
        })
        .state('invest-events', {
            url: '/invest/events',
            template: require('./views/events/index.template.html'),
            /*controller: 'EventsListController',
            controllerAs: 'EvntsLstCtrl',*/
        })
        .state('invest-events-detail', {
            url: '/invest/events/{id}',
            template: require('./views/events/detail.template.html'),
            /*controller: 'EventsListController',
            controllerAs: 'EvntsLstCtrl',*/
        })
        .state('bids', {
            url: '/bids',
            template: require('./views/bids/index.template.html'),
            controller: 'BidsController',
            controllerAs: 'BidsCtrl'
        })
        .state('bids-list', {
            url: '/bids/{type}',
            template: require('./views/bids/list.template.html'),
            controller: 'BidsController',
            controllerAs: 'BidsCtrl'
        })
        .state('sale', {
            url: '/sales',
            template: require('./views/sale/index.template.html'),
            controller: 'SaleController',
            controllerAs: 'SaleCtrl',
        })
        .state('sale-active', {
            url: '/sales/active',
            template: require('./views/sale/list.template.html'),
            /*  controller: 'SaleController',
              controllerAs: 'SaleCtrl',*/
        })
        .state('sale-closed', {
            url: '/sales/closed',
            template: require('./views/sale/list.template.html'),
            /*  controller: 'SaleController',
              controllerAs: 'SaleCtrl',*/
        })

        .state ('sale-create', {
            url: '/sales/create',
            template: require('./views/sale/create.template.html')
        })

        /*.state('bids', {
            url: '/bids',
            controller: 'BidsController',
            template: require('./views/bids/index.template.html')
        })
        .state('bids-matched', {
            url: '/bids/matched',
            template: require('./views/bids/list.template.html')
        })
        .state('bids-unmatched', {
            url: '/bids/unmatched',
            template: require('./views/bids/list.template.html')
        })
        .state('bids-settled', {
            url: '/bids/settled',
            template: require('./views/bids/list.template.html')
        })
        .state('bids-canceled', {
            url: '/bids/canceled',
            template: require('./views/bids/list.template.html')
        })*/

        .state('terms-and-conditions', {
            url: '/terms-and-conditions',
            template: require('./views/static/terms.template.html')
        })
        .state('privacy-policy', {
            url: '/privacy-policy',
            template: require('./views/static/privacy.template.html')
        })
        .state('auth', {
            template: require('./views/auth/base.template.html'),
            data: {
                permissions: {
                    except: 'Auth',
                    redirectTo: () => {
                        return {
                            state: 'invest'
                        }
                    }
                }
            }
        })
        .state('auth.login', {
            //ng-controller="LoginController as LgCtrl"
            url: '/login',
            template: require('./views/auth/login.template.html'),
            controller: 'LoginController',
            controllerAs: 'LgCtrl'
        })
        .state('auth.registration', {
            url: '/register',
            template: require('./views/auth/registration.template.html'),
            //ng-controller="RegisterController as RgCtrl"
            controller: 'RegisterController',
            controllerAs: 'RgCtrl'
        })
        .state('event-detail', {
            url: '/event/detail',
            //template: require('./views/events/singl.template.html'),
        });



    $urlRouterProvider.otherwise(function ($injector, $location) {
        let state = $injector.get('$state');
        state.go('404');
        return $location.path();
    });
}
