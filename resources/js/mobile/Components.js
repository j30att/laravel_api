
let angular = require('angular');

import {BidsComponent} from "./Components/bids/bids.controller";
import {BidsCarouselComponent} from "./Components/bids-carousel/bids-carousel.controller";
import {EventsComponent} from "./Components/events/events.controller";
import {EventsCarouselComponent} from "./Components/events-carousel/events-carousel.controller";
import {EventsFilterComponent} from "./Components/events-filter/events-filter.controller";
import {SalesInvestComponent} from "./Components/sales/invest/sales-invest.component";
import {SalesListComponent} from "./Components/sales/list/sales-list.component";
import {SalesRowComponent} from "./Components/sales/row/sales-row.component";
import {SalesCarouselComponent} from "./Components/sales-carousel/sales-carousel.controller";
import {SaleCreateComponent} from "./Components/sale-create/sale-create.controller";
import {BidPlaceComponent} from "./Components/bid-place/bid-place.controller";
import {SaleManageComponent} from "./Components/sale-manage/sale-manage.controller";

import {InputMarkupComponent} from "../common/components/input/input-markup/input-markup.controller";
import {InputAmountComponent} from "../common/components/input/input-amount/input-amount.controller";
import {InputShareComponent} from "../common/components/input/input-share/input-share.controller";

let module = angular.module('Components', []);
module.component('bids', BidsComponent);
module.component('bidsCarousel', BidsCarouselComponent);
module.component('events', EventsComponent);
module.component('eventsCarousel', EventsCarouselComponent);
module.component('eventsFilter', EventsFilterComponent);
module.component('salesInvest', SalesInvestComponent);
module.component('salesList', SalesListComponent);
module.component('salesRow', SalesRowComponent);
module.component('salesCarousel', SalesCarouselComponent);

module.component('bidPlace', BidPlaceComponent);
module.component('saleManage', SaleManageComponent);
module.component('saleCreate', SaleCreateComponent);

module.component('inputMarkup', InputMarkupComponent);
module.component('inputAmount', InputAmountComponent);
module.component('inputShare', InputShareComponent);


export default module.name;

