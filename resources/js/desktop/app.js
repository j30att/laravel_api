import Services from "../mobile/Services";

let angular = require('angular');

import Controllers from './Controllers';
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

app.config(['$interpolateProvider', ($interpolateProvider) => {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
}]);

app.config(routes);
app.run(middlewares);
app.run(templateCache);