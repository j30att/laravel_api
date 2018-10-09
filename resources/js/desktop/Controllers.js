let angular = require('angular');

import {LoginController} from "./Controllers/LoginController";
import {RegisterController} from "./Controllers/RegisterController";
import {ProfileController} from "./Controllers/ProfileController";
import {FilterBidsController} from "./Controllers/FilterBidsController";
import {BidResponsesController} from "./Controllers/BidResponsesController";
import {MainController} from "./Controllers/MainController";
import {BidsController} from "./Controllers/bids/BidsController";
import {InvestController} from "./Controllers/invest/InvestController";
import {SaleFormController} from "./Controllers/SaleFormController"

import {EventController} from "./Controllers/EventController";
import {EventsListController} from "./Controllers/EventsListController";
import {DialogController} from "./Controllers/DialogController"


////////////////////////////////////////////////////////////////////////////
import {SaleController} from "./Controllers/sales/SaleController";
import {SaleFilterController} from "./Controllers/sales/SaleFilterController"



let module = angular.module('Controllers', []);

module.controller('LoginController', LoginController);
module.controller('RegisterController', RegisterController);
module.controller('MainController', MainController);
module.controller('ProfileController', ProfileController);
module.controller('EventsListController', EventsListController);
module.controller('FilterBidsController', FilterBidsController);
module.controller('BidResponsesController', BidResponsesController);
module.controller('BidsController', BidsController);
module.controller('SaleFormController', SaleFormController);
module.controller('SaleFilterController', SaleFilterController);
module.controller('InvestController', InvestController);
module.controller('EventController', EventController);
module.controller('EventsListController', EventsListController);
module.controller('DialogController', DialogController);


/////////////////////////////////////////////////////////////

module.controller('SaleController', SaleController);

export default module.name;










