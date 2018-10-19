let angular = require('angular');

import {BidsResourceService} from "./api/BidsResourceService";
import {SalesResourceService} from "./api/SalesResourceService";
import {EventsResourceService} from "./api/EventsResourceService";
import {SubEventsResourceService} from "./api/SubEventsResourceService";
import {BidsService} from "./services/BidService";
import {SalesService} from "./services/SaleService";

let module = angular.module('Services', []);

module.service('BidsResourceService', BidsResourceService);
module.service('SalesResourceService', SalesResourceService);
module.service('EventsResourceService', EventsResourceService);
module.service('SubEventsResourceService', SubEventsResourceService);
module.service('BidsService', BidsService);
module.service('SalesService', SalesService);

export default module.name;