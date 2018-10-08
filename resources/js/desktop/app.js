let angular = require('angular');

import Controllers from './Controllers';
import routes from './Router';
import middlewares from './Middlewares';
import Components from './Components';
import Filters from './Filters';
import {permission, uiPermission} from 'angular-permission';
import templateCache from './TemplateCache';

let ngRouter = require('angular-ui-router').default;

let app = angular.module('poker', [
    ngRouter,
    Controllers,
    Components,
    Filters,
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