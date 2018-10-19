
let angular = require('angular');

import {BidsComponent} from "./Components/bids/bids.controller";
import {BidsCarouselComponent} from "./Components/bids-carousel/bids-carousel.controller";
import {EventsComponent} from "./Components/events/events.controller";
import {EventsCarouselComponent} from "./Components/events-carousel/events-carousel.controller";
import {SalesComponent} from "./Components/sales/sales.controller";
import {SalesCarouselComponent} from "./Components/sales-carousel/sales-carousel.controller";
import {SaleModalComponent} from "./Components/sale-modal/sale-modal.controller";


import {BidPlaceComponent} from "./Components/bid-place/bid-place.controller";
import {SaleManageComponent} from "./Components/sale-manage/sale-manage.controller";


let module = angular.module('Components', []);
module.component('bids', BidsComponent);
module.component('bidsCarousel', BidsCarouselComponent);
module.component('events', EventsComponent);
module.component('eventsCarousel', EventsCarouselComponent);
module.component('sales', SalesComponent);
module.component('salesCarousel', SalesCarouselComponent);
module.component('saleModal', SaleModalComponent);


module.component('bidPlace',BidPlaceComponent);
module.component('saleManage', SaleManageComponent);

export default module.name;

