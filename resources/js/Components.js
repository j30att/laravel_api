import {SalesCarouselComponent} from "./Components/sales-carousel/sales-carousel.controller";

let angular = require('angular');

import {BidsComponent} from "./Components/bids/bids.controller";
import {BidsCarouselComponent} from "./Components/bids-carousel/bids-carousel.controller";
import {EventsComponent} from "./Components/events/events.controller";
import {EventsCarouselComponent} from "./Components/events-carousel/events-carousel.controller";
import {SalesComponent} from "./Components/sales/sales.controller";
import {SalesCarousel} from "./Components/sales-carousel/sales-carousel.controller";

let module = angular.module('Components', []);
module.component('bids', BidsComponent);
module.component('bidsCarousel', BidsCarouselComponent);
module.component('events', EventsComponent);
module.component('eventsCarousel', EventsCarouselComponent);
module.component('sales', SalesComponent);
module.component('salesCarousel', SalesCarouselComponent);

export default module.name;

