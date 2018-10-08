let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";


import {FilterBidsController} from "./Controllers/FilterBidsController";
import {BidResponsesController} from "./Controllers/BidResponsesController";
import {MainController} from "./Controllers/MainController";
import {BidsController} from "./Controllers/bids/BidsController";

////////////////////////////////////////////////////////
import {SaleController} from "./Controllers/SaleController"
import {SaleFormController} from "./Controllers/SaleFormController"
import {SaleFilterController} from "./Controllers/SaleFilterController"
import {InvestController} from "./Controllers/InvestController";
import {EventController} from "./Controllers/EventController";
import {EventsListController} from "./Controllers/EventsListController";

let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('MainController', MainController);
module.controller('ProfileController', ProfileController);
module.controller('EventsListController', EventsListController);
module.controller('FilterBidsController', FilterBidsController);
module.controller('BidResponsesController', BidResponsesController);
module.controller('BidsController', BidsController);

/////////////////////////////////////////////////////////////

module.controller('SaleController', SaleController);
module.controller('SaleFormController', SaleFormController);
module.controller('SaleFilterController', SaleFilterController);
module.controller('InvestController', InvestController);
module.controller('EventController', EventController);
module.controller('EventsListController', EventsListController);

export default module.name;










