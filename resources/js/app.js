let angular = require('angular');

import Controllers from './Controllers';
import routes from './Router';
import middlewares from './Middlewares';
import Components from './Components';
import {permission, uiPermission} from 'angular-permission';
import hack from './Hack';

let ngRouter = require('angular-ui-router').default;
let bootstrap = require('angular-ui-bootstrap');

let app = angular.module('poker', [
    bootstrap,
    ngRouter,
    Controllers,
    Components,
    permission,
    uiPermission
]);

app.config(['$interpolateProvider', ($interpolateProvider) => {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
}]);

app.config(routes);
app.run(middlewares);
app.run(hack);