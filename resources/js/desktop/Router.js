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
            redirectTo : ()=>{
                return {
                    state: 'invest'
                }
            }
        })

        /*.state ('logout', {
            url: '/logout',
            template: require('./views/main.template.html'),
        })*/
        .state('invest', {
            url: '/invest',
            template: require('./views/invest/index.template.html'),
            controller: 'InvestController',
            controllerAs: 'InvestCtrl'
        })
        .state('invest-events', {
            url: '/invest/events',
            template: require('./views/events/index.template.html'),
            controller: 'EventsController',
            controllerAs: 'EventsCtrl',
        })
        .state('invest-events-detail', {
            url: '/invest/events/{id}',
            template: require('./views/events/detail.template.html'),
            controller: 'EventsDetailController',
            controllerAs: 'EventsDetailCtrl',
        })
        .state('invest-sales', {
            url:'/invest/sales',
            template: require('./views/sale/sales.template.html'),
            controller: 'SaleInvestController',
            controllerAs: 'SaleInvestCtrl'
        })
        .state('bids', {
            url: '/bids',
            template: require('./views/bids/index.template.html'),
            data: {
                permissions: {
                    except: 'Guest',
                    redirectTo: () => {
                        return {
                            state: 'bids-empty'
                        }
                    }
                }
            },
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
            data: {
                permissions: {
                    except: 'Guest',
                    redirectTo: () => {
                        return {
                            state: 'sale-empty'
                        }
                    }
                }
            },
            controller: 'SaleController',
            controllerAs: 'SaleCtrl',
        })
        .state('sale-list', {
            url: '/sales/{type}',
            template: require('./views/sale/list.template.html'),
            controller: 'SaleFilterController',
            controllerAs: 'SaleFltrCtrl',
        })


        .state ('sale-empty', {
            url: '/sales',
            template: require('./views/sale/empty.template.html'),
            controller: 'MainController',
            controllerAs: 'MainCtrl',
        })

        .state ('bids-empty', {
            url: '/bids/empty',
            template: require('./views/bids/empty.template.html'),
            controller: 'MainController',
            controllerAs: 'MainCtrl',
        })

        .state ('wallet-empty', {
            url: '/wallet/empty',
            template: require('./views/wallet/empty.template.html'),
            controller: 'MainController',
            controllerAs: 'MainCtrl',
        })

        .state ('profile', {
            url: '/profile',
            template: require('./views/profile/profile.trmplate.html')
        })
        .state ('place-bit', {
            url: '/bids/place-a-bit',
            template: require('./views/bids/place.template.html')
        })
        .state ('wallet', {
            url: '/wallet',
            template: require('./views/wallet/index.temlate.html'),
            data: {
                permissions: {
                    except: 'Guest',
                    redirectTo: () => {
                        return {
                            state: 'wallet-empty'
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
        })
        .state('dealer-events', {
            url: '/dealer/events',
            template: require('./views/dealer/events.template.html')
        });
        /*.state('dealer-events-detail', {
            url: '/dealer/events/detail/{id}',
            template: require('./views/dealer/events_detail.template.html')
        })

        .state('dealer-users', {
            url: '/dealer/users'
        })*/




    $urlRouterProvider.otherwise(function ($injector, $location) {
        let state = $injector.get('$state');
        state.go('404');
        return $location.path();
    });
}
