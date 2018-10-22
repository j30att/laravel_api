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
        })

        .state ('bids-empty', {
            url: '/bids/empty',
            template: require('./views/bids/empty.template.html'),
            controller: 'MainController',
            controllerAs: 'MainCtrl',
        })

        .state ('sale-empty', {
            url: '/sale/empty',
            template: require('./views/sale/empty.template.html'),
            controller: 'MainController',
            controllerAs: 'MainCtrl',
        })

        .state ('wallet-empty', {
            url: '/wallet/empty',
            template: require('./views/wallet/empty.template.html'),
            controller: 'MainController',
            controllerAs: 'MainCtrl',
        })

            .state('bids-filter', {
                url: '/bids/{filter}',
                template: require('./views/bids/filter.template.html'),
                controller: 'BidsFilterController',
                controllerAs: 'BidsCtrl',
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'index'
                            }
                        }
                    }
                },
            })

        .state('sale',{
            url: '/sales',
            template: require('./views/sale/index.template.html'),
            menu: 'sales',
            controller: 'SaleController',
            controllerAs: 'SaleCtrl',
            data: {
                permissions: {
                    except: 'Guest',
                    redirectTo: () => {
                        return {
                            state: 'index'
                        }
                    }
                }
            },
        })
            .state('sale-create', {
                url: '/sale/create',
                template: require('./views/sale/form.template.html'),
                controller: 'SaleFormController',
                controllerAs: 'SaleFrmCtrl',
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'index'
                            }
                        }
                    }
                },
            })
            .state('sale-manage',{
                url:'/sale/manage/{id}',
                template: require('./views/sale/manage.template.html'),
                controller: 'SaleManageController',
                controllerAs: 'SaleMngCtrl',
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'index'
                            }
                        }
                    }
                },

            })
            .state('sale-filter', {
                url: '/sales/{filter}',
                template: require('./views/sale/filter.template.html'),
                controller: 'SaleFilterController',
                controllerAs: 'SaleCtrl',
                data: {
                    permissions: {
                        except: 'Guest',
                        redirectTo: () => {
                            return {
                                state: 'index'
                            }
                        }
                    }
                },
            })

        .state('wallet', {
            url: '/wallet',
            template: require('./views/wallet/index.template.html'),
            menu: 'wallet',
            data: {
                permissions: {
                    except: 'Guest',
                    redirectTo: () => {
                        return {
                            state: 'index'
                        }
                    }
                }
            },
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
