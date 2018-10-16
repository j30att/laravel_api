let angular = require('angular');

import Controllers from './Controllers';
import Services from "../common/Services";
import routes from './Router';
import middlewares from './Middlewares';
import Components from './Components';
import Filters from './Filters';
import {permission, uiPermission} from 'angular-permission';
import templateCache from './TemplateCache';

let ngRouter = require('angular-ui-router').default;
let ngMaterial = require('angular-material');
let ngAria = require('angular-aria');
let ngAnimate = require('angular-animate');
let ngSanitize = require('angular-sanitize');

let app = angular.module('poker', [
    ngSanitize,
    ngMaterial,
    ngAria,
    ngAnimate,
    ngRouter,
    Filters,
    Controllers,
    Components,
    Services,
    permission,
    uiPermission
]);

app.config(['$interpolateProvider', ($interpolateProvider) => {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
}]);

app.config(routes);
app.run(middlewares);
app.run(templateCache);