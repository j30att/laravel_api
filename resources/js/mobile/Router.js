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
        .state('terms-and-conditions', {
            url: '/terms-and-conditions',
            template: require('./views/static/terms.template.html')
        })
        .state('privacy-policy', {
            url: '/privacy-policy',
            template: require('./views/static/privacy.template.html')
        })

        .state('auth',{
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

        .state('invest', {
            url: '/invest',
            template: require('./views/invest/index.template.html'),
            controller: 'InvestController',
            controllerAs: 'InvstCtrl',
        })
        .state('events', {
            url: '/events',
            template: require('./views/events/index.template.html'),
            controller: 'EventsListController',
            controllerAs: 'EvntsLstCtrl',
        })
            .state('event',{
                url: '/event/{id}',
                template: require('./views/events/single.template.html'),
                controller: 'EventController',
                controllerAs: 'EventCtrl',
            })

        .state('bids', {
            url: '/bids',
            template: require('./views/bids/index.template.html'),
            controller: 'BidResponsesController',
            controllerAs: 'BdsRspnsCtrl',
        })

            .state('bids-filter', {
                url: '/bids/{filter}',
                template: require('./views/bids/filter.template.html'),
                controller: 'FilterBidResponsesController',
                controllerAs: 'FltrBdsRspnsCtrl',
            })

        .state('sale',{
            url: '/sales',
            template: require('./views/sale/index.template.html'),
            controller: 'SaleController',
            controllerAs: 'SaleCtrl',
        })
            .state('sale-create', {
                url: '/sale/create',
                template: require('./views/sale/form.template.html'),
                controller: 'SaleFormController',
                controllerAs: 'SaleFrmCtrl',
            })
            .state('sale-manage',{
                url:'/sale/manage',
                template: require('./views/sale/manage.template.html')
            })
            .state('sale-filter', {
                url: '/sales/{filter}',
                template: require('./views/sale/filter.template.html'),
                controller: 'SaleController',
                controllerAs: 'SaleCtrl',
            })
            .state('sale-edit',{
                url:'/sale/{id}',
                template: require('./views/sale/form.template.html'),
                controller: 'SaleFormController',
                controllerAs: 'SaleFrmCtrl',
            })

        .state('wallet', {
            url: '/wallet',
            template: require('./views/wallet/index.template.html'),
        })

    ;


    $urlRouterProvider.otherwise(function($injector, $location){
        let state = $injector.get('$state');
        state.go('404');
        return $location.path();
    });
}
