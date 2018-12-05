let angular = require('angular');

import {BidsResourceService} from "./api/BidsResourceService";
import {SalesResourceService} from "./api/SalesResourceService";
import {EventsResourceService} from "./api/EventsResourceService";
import {SubEventsResourceService} from "./api/SubEventsResourceService";
import {CurrencyResourceService} from "./api/CurrencyResourceService";
import {DealerResourceService} from "./api/DealerResourceService";
import {CountriesResourceService} from "./api/CountriesResourceService";
import {TransactionsResourceService} from "./api/TransactionsResourceService";

import {BidsService} from "./services/BidService";
import {SalesService} from "./services/SaleService";
import {RegistrationService} from "./services/RegistrationService";

let module = angular.module('Services', []);

module.service('BidsResourceService', BidsResourceService);
module.service('SalesResourceService', SalesResourceService);
module.service('EventsResourceService', EventsResourceService);
module.service('SubEventsResourceService', SubEventsResourceService);
module.service('BidsService', BidsService);
module.service('SalesService', SalesService);
module.service('DealerResourceService', DealerResourceService);
module.service('CountriesResourceService', CountriesResourceService);
module.service('RegistrationService', RegistrationService);
module.service('CurrencyResourceService', CurrencyResourceService);
module.service('TransactionsResourceService', TransactionsResourceService);

export default module.name;
