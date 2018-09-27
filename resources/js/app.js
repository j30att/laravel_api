let angular = require('angular');

import Controllers from './Controllers';
//import Components from  './Components'

import {BidsRowComponent} from "./Components/bids/bids-row.controller";
import {BidsCarouselComponent} from "./Components/bids-carousel/bids-carousel.controller";


let app = angular.module('poker', [
    Controllers,
//    Components
]);

app.config(['$interpolateProvider', ($interpolateProvider) => {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
}]);

app.component('bidsCarousel', BidsCarouselComponent);
app.component('bidsRow', BidsRowComponent);
