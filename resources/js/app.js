let angular = require('angular');

import Controllers from './Controllers';
import routes from './Router';


import {BidsComponent} from "./Components/bids/bids.controller";
import {BidsCarouselComponent} from "./Components/bids-carousel/bids-carousel.controller";
import {EventsComponent} from "./Components/events/events.controller";
import {EventsCarouselComponent} from "./Components/events-carousel/events-carousel.controller";

let ngRouter = require('angular-ui-router').default;

let app = angular.module('poker', [
    ngRouter,
    Controllers,

]);

app.config(['$interpolateProvider', ($interpolateProvider) => {
    $interpolateProvider.startSymbol('{%');
    $interpolateProvider.endSymbol('%}');
}]);

app.component('bids', BidsComponent);
app.component('bidsCarousel', BidsCarouselComponent);
app.component('events', EventsComponent);
app.component('eventsCarousel', EventsCarouselComponent);

app.config(routes);
