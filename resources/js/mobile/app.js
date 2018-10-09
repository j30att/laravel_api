let angular = require('angular');

import Controllers from './Controllers';
import Components from './Components';
import Services from './Services'
import routes from './Router';
import middlewares from './Middlewares';
import {permission, uiPermission} from 'angular-permission';
import hack from './Hack';

let ngRouter = require('angular-ui-router').default;
let ngMaterial = require('angular-material');
let ngAria = require('angular-aria');
let ngAnimate = require('angular-animate');

let app = angular.module('poker', [
    ngMaterial,
    ngAria,
    ngAnimate,
    ngRouter,
    Controllers,
    Components,
    Services,
    permission,
    uiPermission
]);

angular.module('poker').config(['$mdThemingProvider', function($mdThemingProvider) {
    $mdThemingProvider.theme('formSelect');
    $mdThemingProvider.setDefaultTheme('formSelect');
}]);

app.config(['$interpolateProvider', ($interpolateProvider) => {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
}]);

app.config(routes);
app.run(middlewares);
app.run(hack);