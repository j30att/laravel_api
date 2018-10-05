import {EventsListController} from "./Controllers/EventsListController";

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
            menu: 'invest',
            controller: 'InvestController',
            controllerAs: 'InvstCtrl',
        })
        .state('sale-all', {
            url: '/invest/sales',
            template: require('./views/sale/all.template.html'),
            controller: 'SaleAllController',
            controllerAs: 'SaleAllCtrl'
        })

        .state('events', {
            url: '/events',
            template: require('./views/events/index.template.html'),
            controller: 'EventsListController',
            controllerAs: 'EvntsLstCtrl'
        })

        .state('event',{
            url: '/event/{id}',
            template: require('./views/events/detail.template.html'),
            controller: 'EventInfoController',
            controllerAs: 'EventInfoCtrl',
        })
        .state('event-info',{
                url: '/event/info/{id}',
                template: require('./views/events/single.template.html'),
                controller: 'EventController',
                controllerAs: 'EventCtrl',
            })

        .state('bids', {
            url: '/bids',
            template: require('./views/bids/index.template.html'),
            menu: 'bids',
            controller: 'BidsController',
            controllerAs: 'BidsCtrl',
        })

            .state('bids-filter', {
                url: '/bids/{filter}',
                template: require('./views/bids/filter.template.html'),
                controller: 'BidsFilterController',
                controllerAs: 'BidsCtrl',
            })

        .state('sale',{
            url: '/sales',
            data: {
                permissions: {
                    except: 'Guest',
                    redirectTo: () => {
                        return {
                            state: 'invest'
                        }
                    }
                }
            },
            template: require('./views/sale/index.template.html'),
            menu: 'sales',
            controller: 'SaleController',
            controllerAs: 'SaleCtrl',
        })
            .state('sale-create', {
                url: '/sale/create',
                template: require('./views/sale/form.template.html'),
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'invest'
                            }
                        }
                    }
                },
                controller: 'SaleFormController',
                controllerAs: 'SaleFrmCtrl',
            })
            .state('sale-manage',{
                url:'/sale/manage/{id}',
                template: require('./views/sale/manage.template.html'),
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'invest'
                            }
                        }
                    }
                },
                controller: 'SaleManageController',
                controllerAs: 'SaleMngCtrl',

            })
            .state('sale-filter', {
                url: '/sales/{filter}',
                template: require('./views/sale/filter.template.html'),
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'invest'
                            }
                        }
                    }
                },
                controller: 'SaleFilterController',
                controllerAs: 'SaleCtrl',
            })
            .state('sale-edit',{
                url:'/sale/{id}',
                template: require('./views/sale/form.template.html'),
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'invest'
                            }
                        }
                    }
                },
                controller: 'SaleFormController',
                controllerAs: 'SaleFrmCtrl',
            })

        .state('wallet', {
            url: '/wallet',
            template: require('./views/wallet/index.template.html'),
            menu: 'wallet',
        })
        .state('profile', {
            url: '/profile',
            template: require('./views/profile/index.template.html'),
        })


    ;


    $urlRouterProvider.otherwise(function($injector, $location){
        let state = $injector.get('$state');
        state.go('404');
        return $location.path();
    });
}
